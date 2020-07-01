<?php
if (!defined('ABSPATH')) {
    exit();
}
if (!class_exists('GVT_API_Manager')) {

    class GVT_API_Manager {

        private $api_url = 'https://gvectors.com/gvt-api.php';
        private $plugin_slug;
        private $plugin_filename;
        private $plugin_option_slug;
        private $plugin_name;
        private $activation_action;

        public function __construct($plugin_filename, $plugin_option_slug, $admin_hook) {
            $this->plugin_slug = basename(dirname($plugin_filename));
            $this->plugin_filename = basename($plugin_filename);
            $this->plugin_option_slug = $plugin_option_slug;
            $this->activation_action = $this->activation_action_slug($this->plugin_slug);
            $plugin_update_hook = "in_plugin_update_message-{$this->plugin_slug}/{$this->plugin_filename}";
            add_action($plugin_update_hook, array(&$this, 'update_message'));
            add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_for_plugin_update'));
            add_filter('plugins_api', array(&$this, 'plugin_api_call'), 100, 3);
            add_action('admin_notices', array(&$this, 'activate_required'));
            add_action($admin_hook, array(&$this, 'activation_form'));
            add_action('admin_post_' . $this->activation_action, array(&$this, 'activate_product'));
            add_action('admin_footer', array(&$this, 'noticeDismissibleJS'));
            add_action('wp_ajax_dismiss_' . $this->plugin_slug, array(&$this, 'dismissNotice'));
            register_deactivation_hook($plugin_filename, array($this, 'pluginDeactivate'));
        }

        public function plugin_activate($activation_key) {
            $args = array(
                'gvt_activation_key' => $activation_key,
                'gvt_site_domain' => get_bloginfo('url'),
                'gvt_site_name' => get_bloginfo('name'),
                'gvt_slug' => $this->plugin_slug
            );
            $request_string = array(
                'timeout' => 45,
                'body' => array(
                    'action' => 'gvt_activate_product',
                    'gvt_request' => json_encode($args)
                )
            );
            $response = wp_remote_post($this->api_url, $request_string);
            if (is_wp_error($response)) {
                $error_message = $response->get_error_message();
                return $response_data = array('gvt_message_id' => 3, 'gvt_message' => "Something went wrong: $error_message");
            } else {
                $response_body = wp_remote_retrieve_body($response);
                $response_data = json_decode($response_body, true);
                if (is_array($response_data) && $response_data['gvt_message_id'] && $response_data['gvt_message']) {
                    return $response_data;
                }
            }
        }

        public function check_for_plugin_update($checked_data) {
            $gvt_plugin_version = $this->get_plugin_inf('Version');
            $args = array(
                'slug' => $this->plugin_slug,
                'version' => $gvt_plugin_version,
            );
            $response = $this->getUpdateResponse($args);
            if ($response && is_object($response) && isset($response->new_version) && version_compare($response->new_version, $gvt_plugin_version, '>')) {
                $response->plugin = $this->plugin_slug . '/' . $this->plugin_filename;
                $checked_data->response[$response->plugin] = $response;
            }
            return $checked_data;
        }

        private function getUpdateResponse($args) {
            $cachedObject = get_option('gvt_api_update_respose_' . $this->plugin_slug);
            $response = null;
            if ($this->useCache($cachedObject)) {
                $response = $cachedObject->response;
            } else {
                $gvt_plugin_data = $this->get_activation_data();
                if (!$gvt_plugin_data)
                    return $response;


                $request_string = array(
                    'timeout' => 45,
                    'body' => array(
                        'action' => 'gvt_basic_check',
                        'gvt_request' => json_encode($args),
                        'gvt_plugin_check_data' => json_encode($gvt_plugin_data)
                    )
                );

                $raw_response = wp_remote_post($this->api_url, $request_string);
                $response = '';
                if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
                    $response = maybe_unserialize($raw_response['body']);
                }
                if ($response && is_object($response) && $response->slug != '') {
                    if ($gvt_plugin_data['gvt_secret_key'] && $response->expired) {
                        delete_option('gvt_product_secret_' . $this->plugin_slug);
                        if (isset($response->gvtUpdateMsg) && $response->gvtUpdateMsg) {
                            update_option('_gvt_product_gvtUpdateMsg_' . $this->plugin_slug, $response->gvtUpdateMsg, 'no');
                        }
                    }
                    $newCachedResponse = new stdClass();
                    $newCachedResponse->last_checked = time();
                    $newCachedResponse->response = $response;
                    update_option('gvt_api_update_respose_' . $this->plugin_slug, $newCachedResponse, 'no');
                }
            }
            return $response;
        }

        private function useCache($cachedObject) {
            $forceCheck = filter_input(INPUT_GET, 'force-check', FILTER_SANITIZE_NUMBER_INT);
            if (!$forceCheck && $cachedObject && isset($cachedObject->last_checked) && isset($cachedObject->response) && is_object($cachedObject->response) && ($cachedObject->last_checked + 43200) > time()) {
                return true;
            }
            return false;
        }

        public function pluginDeactivate() {
            delete_option('gvt_api_update_respose_' . $this->plugin_slug);
        }

        public function plugin_api_call($def, $action, $args) {
            if (!isset($args->slug) || ($args->slug != $this->plugin_slug))
                return $def;
            $current_version = $this->get_plugin_inf('Version');
            $args->version = $current_version;
            $gvt_plugin_data = $this->get_activation_data();
            if (!$gvt_plugin_data)
                return false;
            $request_string = array(
                'timeout' => 45,
                'body' => array(
                    'action' => $action,
                    'gvt_request' => json_encode($args),
                    'gvt_plugin_check_data' => json_encode($gvt_plugin_data)
                )
            );
            $request = wp_remote_post($this->api_url, $request_string);
            if (is_wp_error($request)) {
                $res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
            } else {
                $res = $request['body'] ? maybe_unserialize($request['body']) : '';
                if ($res === false) {
                    $res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
                }
            }
            return $res;
        }

        public function activate_product() {
            $activationKey = filter_input(INPUT_POST, 'gvt_product_activation_key', FILTER_SANITIZE_STRING);
            $activationSecret = filter_input(INPUT_POST, 'plugin_activate_secret', FILTER_SANITIZE_STRING);
            if ($activationKey && $activationSecret && wp_verify_nonce($activationSecret, 'plugin_secret')) {
                $activation_data = $this->plugin_activate($activationKey);
                update_option('_gvt_product_activation_msg_' . $this->plugin_slug, array(
                    'gvt_message_id' => $activation_data['gvt_message_id'],
                    'gvt_message' => $activation_data['gvt_message']
                        ), 'no');
            }
            wp_redirect(admin_url('admin.php?page=' . $this->plugin_option_slug));
            exit();
        }

        public function get_activation_data() {
            return array('gvt_site_domain' => get_bloginfo('url'),
                'gvt_secret_key' => $this->getSecret(),
                'gvt_parent_version' => $this->init_parent_version());
        }

        public function activation_form() {
            if (!$this->getSecret()) {
                $activationData = get_option('_gvt_product_activation_msg_' . $this->plugin_slug, array());
                if (isset($activationData['gvt_message']) && isset($activationData['gvt_message_id'])) {
                    $message = '<div class="error" id="message"><p>' . $activationData['gvt_message'] . '</p></div>';
                    if ($activationData['gvt_message_id'] == 1) {
                        add_option('gvt_product_secret_' . $this->plugin_slug, $activationData['gvt_message'], '', 'no');
                        delete_option('_gvt_product_gvtUpdateMsg_' . $this->plugin_slug);
                        add_action('admin_notices', array(&$this, 'activate_required'));
                        $message = '<div class="updated" id="message"><p>Congratulations! Plugin activated successfully.</p></div>';
                    }
                    echo '<div class="gvt_message_' . $activationData['gvt_message_id'] . '">' . $message . '</div>';
                    delete_option('_gvt_product_activation_msg_' . $this->plugin_slug);
                }
                if (!$this->getSecret()) {
                    ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0px 20px 0px; background: #dddddd;">
                        <form action="<?php echo admin_url('admin-post.php'); ?>" method="POST">
                            <?php wp_nonce_field('plugin_secret', 'plugin_activate_secret'); ?>
                            <input type="hidden" name="action" value="<?php echo $this->activation_action; ?>">
                            <input type="text" name="gvt_product_activation_key" value="" placeholder="Activation Key">
                            <input type="submit" value="<?php _e('Activate', 'default'); ?>" class="button button-primary"> / <?php echo $this->plugin_name; ?>
                        </form>
                        <p style="margin:5px 0px 0px 0px; color:#333; font-size:12px; padding:5px 0px 0px 0px;">
                            Please do not activate this plugin if you are on local host (127.0.0.1) or you use IP address to access to WordPress website. 
                            <br />This plugin should only be activated if WordPress is located in WEB under a real domain name.
                            <br />If you have an issue with plugin activation please contact us via support@gvectors.com email address. 
                            <br />Please do not forget to send order number and activation key.
                        </p>
                    </div>
                    <?php
                }
            }
        }

        private function getSecret() {
            return get_option('gvt_product_secret_' . $this->plugin_slug, '');
        }

        public function activate_required() {
            $this->plugin_name = $this->get_plugin_inf('Name');
            $activationData = get_option('_gvt_product_activation_msg_' . $this->plugin_slug, array());
            $gvtUpdateMsg = get_option('_gvt_product_gvtUpdateMsg_' . $this->plugin_slug, '');
            $id_exist = isset($activationData['gvt_message_id']) ? $activationData['gvt_message_id'] : 0;
            if (!$this->getSecret() && $id_exist != 1 && !get_transient('dismiss_' . $this->plugin_slug)) {
                echo "<div class='notice error  is-dismissible {$this->plugin_slug}'><p>Activate <a href='" . admin_url('admin.php?page=' . $this->plugin_option_slug) . "'> $this->plugin_name </a> plugin !</p>  $gvtUpdateMsg</div>";
            }
        }

        private function get_plugin_inf($key) {
            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            $all_plugins = get_plugins();
            return $all_plugins[$this->plugin_slug . '/' . $this->plugin_filename][$key];
        }

        private function init_parent_version() {
            $parent_version = '';
            if (strpos($this->plugin_slug, 'wpdiscuz') === 0) {
                $parent_version = get_option('wc_plugin_version', '');
            } elseif (strpos($this->plugin_slug, 'wpforo') === 0) {
                $parent_version = get_option('wpforo_version', '');
            }
            return $parent_version;
        }

        private function activation_action_slug($slug) {
            $symbols = array('-', ' ');
            return 'gvt_activate_' . str_replace($symbols, '_', $slug);
        }

        public function dismissNotice() {
            set_transient('dismiss_' . $this->plugin_slug, 1, MONTH_IN_SECONDS);
        }

        public function update_message() {
            if (!$this->getSecret()) {
                echo "To receive automatic updates license activation is required. Please visit settings page to activate your plugin.";
            }
        }

        public function noticeDismissibleJS() {
            if (!get_transient('dismiss_' . $this->plugin_slug) && !$this->getSecret()) {
                ?>
                <script>
                    jQuery(document).on('click', '.<?php echo $this->plugin_slug; ?> .notice-dismiss', function () {
                        jQuery.ajax({
                            url: ajaxurl,
                            data: {
                                action: 'dismiss_<?php echo $this->plugin_slug; ?>'
                            }
                        });

                    });
                </script>
                <?php
            }
        }

    }

}