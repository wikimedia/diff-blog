<?php
/*
 * Plugin Name: wpDiscuz - Subscription Manager
 * Description: Displays all users and guests subscriptions. Allows to monitor and manage comment subscribers. 
 * Version: 7.0.0
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/product/wpdiscuz-subscribe-manager/
 * Text Domain: wpdiscuz_sbm
 * Domain Path: /languages/
 */

define("WSM_DIR_PATH", dirname(__FILE__));

require_once WSM_DIR_PATH . "/includes/gvt-api-manager.php";
require_once WSM_DIR_PATH . "/includes/wpdSubscribersDBManager.php";
require_once WSM_DIR_PATH . "/includes/wpdSubscriptionsList.php";
require_once WSM_DIR_PATH . "/includes/wpdUserSubscriptionsList.php";

class wpdSubscribeManager {

    private $db;

    const WPDS_ADMIN_SLUG = "wpdiscuz-subscribe";
    const WPDS_USER_SLUG = "wpdiscuz-user-subscribe";
    const WPDS_EMAIL_FORM_ACTION = "wpds_mail_form";
    const WPDS_SEND_EMAIL_ACTION = "wpds_send_mail";
    const WPDS_VIEW_STATS_ACTION = "wpds_view_stats";

    public function __construct() {
        add_action("plugins_loaded", [&$this, "pluginLoad"], 1);
    }

    public function pluginLoad() {
        if (function_exists("wpDiscuz")) {
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            $this->db = new wpdSubscribersDBManager();
            load_plugin_textdomain("wpdiscuz_sbm", false, dirname(plugin_basename(__FILE__)) . "/languages/");
            add_action("admin_menu", [&$this, "addSubscriptionsToAdminMenu"], 876);
            add_filter("wpdiscuz_admin_pages", [&$this, "addPluginAdminPages"]);
            add_filter("wpdiscuz_wp_admin_pages", [&$this, "addPluginWpPages"]);
            add_action("admin_enqueue_scripts", [&$this, "adminPageStylesScripts"], 100);
            add_action("admin_post_wpdiscuz_sbm_action", [&$this, "action"]);
            add_action("profile_update", [&$this, "userProfileUpdate"], 10, 2);
            add_action("before_delete_post", [&$this, "deletePost"]);
            add_action("delete_comment", [&$this, "deleteComment"]);
            add_action("wp_ajax_" . self::WPDS_EMAIL_FORM_ACTION, [&$this, "getEmailForm"]);
            add_action("wp_ajax_" . self::WPDS_SEND_EMAIL_ACTION, [&$this, "sendEmail"]);
            add_action("wp_ajax_" . self::WPDS_VIEW_STATS_ACTION, [&$this, "viewStatistics"]);
        } else {
            add_action("admin_notices", [&$this, "wpdsRequirements"], 1);
        }
    }

    public function wpdsRequirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Subscription Manager requires wpDiscuz to be installed!", "wpdiscuz_sbm") . "</p></div>";
        }
    }

    public function action() {
        $url = preg_replace('#action[\d]*\=[^&]+[&]*#is', "", wp_get_referer());
        $nonce = filter_input(INPUT_GET, "wpdiscuz-sbm-nonce", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $action = filter_input(INPUT_GET, "action-name", FILTER_SANITIZE_STRING);
        if ($id && $nonce && wp_verify_nonce($nonce, "wpdiscuz-sbm")) {
            if ("confirm" === $action) {
                $this->changeConfirmationStatus($id, 1);
            } else if ("cancel" === $action) {
                $this->changeConfirmationStatus($id, 0);
            } else if ("delete" === $action) {
                $this->deleteSubscription($id);
            }
        }
        wp_redirect($url);
        exit();
    }

    private function changeConfirmationStatus($id, $status) {
        $currentUser = wp_get_current_user();
        if (current_user_can("manage_options")) {
            $this->db->changeConfirmationStatus($id, $status);
        } elseif ($currentUser->user_email) {
            $a = $currentUser->user_email;
            $this->db->changeConfirmationStatus($id, $status, $currentUser->user_email);
        }
    }

    private function deleteSubscription($id) {
        $currentUser = wp_get_current_user();
        if (current_user_can("manage_options")) {
            $this->db->deleteSubscription($id);
        } elseif ($currentUser->user_email) {
            $this->db->deleteSubscription($id, $currentUser->user_email);
        }
    }

    public function getEmailForm() {
        $wpdsID = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $email = $this->db->getEmailBySubscribeID($wpdsID);
        if (current_user_can("manage_options") && $email) {
            $this->_getEmailForm($wpdsID, $email);
        } else {
            _e("Subscription not found", "wpdiscuz_sbm");
        }
        wp_die();
    }

    private function _getEmailForm($id, $email) {
        $user = get_user_by("email", $email);
        $userName = $user->display_name;
        ?>
        <div class="wpds-email-form">
            <form id="wpds-mail-form">
                <input id="wpds-mail-id" type="hidden" name="id" value="<?php echo $id; ?>" >
                <input id="wpds-mail-subject" type="text" size="250" required="required" placeholder="<?php _e("Subject *", "wpdiscuz_sbm"); ?>" name="wpds_mail_subject" value="">
                <textarea id="wpds-mail-text" name="wpds_mail_text" required placeholder="<?php _e("Message *", "wpdiscuz_sbm"); ?>"><?php echo ( isset($userName) && $userName ) ? __("Hi ", "wpdiscuz_sbm") . $userName . "," : ""; ?></textarea>
                <input type="submit" id="wpds-mail-submit" value="<?php _e("Send Email", "wpdiscuz_sbm"); ?>">
            </form>
        </div>
        <?php
    }

    public function sendEmail() {
        $wpdiscuz = wpDiscuz();
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);
        $respons = ["code" => 0, "message" => __("Error! Can't send email.", "wpdiscuz_sbm")];
        if ($id && $subject && $message) {
            global $wp_rewrite;
            $sRow = $this->db->getSubscription($id);
            $emailLink = !$wp_rewrite->using_permalinks() ? get_permalink($sRow["post_id"]) . "&" : get_permalink($sRow["post_id"]) . "?";
            $email = $sRow["email"];
            $message = nl2br($message);
            $message .= "<br>=======================<br>";
            if (!$sRow["confirm"]) {
                $emailSubscribText = $wpdiscuz->options->phrases["wc_confirm_email"];
                $emailSubscribLink = $emailLink . "subscribeAnchor&wpdiscuzConfirmID=" . $sRow["id"] . "&wpdiscuzConfirmKey=" . $sRow["activation_key"] . "&wpDiscuzComfirm=yes&#wc_unsubscribe_message";
                $message .= "<a href='" . $emailSubscribLink . "'>" . $emailSubscribText . "</a><br>";
            }
            $emailUnsubscribText = $wpdiscuz->options->phrases["wc_unsubscribe"];
            $emailUnsubscribLink = $emailLink . "subscribeAnchor&wpdiscuzSubscribeID=" . $sRow["id"] . "&key=" . $sRow["activation_key"] . "&#wc_unsubscribe_message";
            $message .= "<a href='" . $emailUnsubscribLink . "'>" . $emailUnsubscribText . "</a>";

            $headers = [];
            $headers[] = "Content-Type: text/html; charset=UTF-8";
            $headers[] = "From: " . get_option("blogname") . " <" . get_option("admin_email") . "> \r\n";
            if (wp_mail($email, $subject, $message, $headers)) {
                $respons = ["code" => 1, "message" => __("Email sent successfully!", "wpdiscuz_sbm")];
            }
        }
        wp_die(json_encode($respons));
    }

    public function viewStatistics() {
        if (current_user_can("manage_options")) {
            $all = $this->db->subscriptionsCount();
            $confirmed = $this->db->getConfirmedSubscriptionsCount();
            $awaiting = $all - $confirmed;
            $subscribers = $this->db->getSubscribersCount();
            ?>
            <div class="wpd_stats_cont">
                <div class="wpds-stat-all"> <div class="wpds-stat-rowname"><?php _e("All Subscriptions", "wpdiscuz_sbm"); ?></div>  :  <div class="wpds-stat-count"><?php echo $all; ?></div></div>
                <div class="wpds-stat-confirmed"><div class="wpds-stat-rowname"><?php _e("Confirmed", "wpdiscuz_sbm"); ?></div>  :  <div class="wpds-stat-count"><?php echo $confirmed; ?></div></div>
                <div class="wpds-stat-awaiting"><div class="wpds-stat-rowname"><?php _e("Awaiting confirmation", "wpdiscuz_sbm"); ?></div>  : <div class="wpds-stat-count"><?php echo $awaiting; ?></div></div>
                <div class="wpds-stat-subscribers"><div class="wpds-stat-rowname"><?php _e("Subscribers", "wpdiscuz_sbm"); ?></div>  :  <div class="wpds-stat-count"><?php echo $subscribers; ?></div></div>
            </div>
            <?php
        }
        wp_die();
    }

    public function adminPageStylesScripts() {
        $screen = get_current_screen();
        if ($screen && ($screen->id == "wpdiscuz_page_" . self::WPDS_ADMIN_SLUG || $screen->id == "users_page_" . self::WPDS_USER_SLUG || $screen->id == "profile_page_" . self::WPDS_USER_SLUG)) {
            wp_register_style("wpdiscuz-subscribe-style", plugins_url("/assets/css/wpdsubscribe.css", __FILE__), null, "1.0.0");
            wp_enqueue_style("wpdiscuz-subscribe-style");
            if ($screen && $screen->id == "wpdiscuz_page_" . self::WPDS_ADMIN_SLUG) {
                wp_register_script("wpds-scripts", plugins_url("/assets/js/wpds-scripts.js", __FILE__), ["jquery"], "1.0.0", true);
                wp_enqueue_script("wpds-scripts");
                wp_localize_script("wpds-scripts", "wpdsScripts", ["email_caption" => __("Send Email", "wpdiscuz_sbm"),
                    "stat_caption" => __("Statistics", "wpdiscuz_sbm"),
                    "action_form" => self::WPDS_EMAIL_FORM_ACTION,
                    "action_send_mail" => self::WPDS_SEND_EMAIL_ACTION,
                    "action_view_stats" => self::WPDS_VIEW_STATS_ACTION,
                    "loader" => plugins_url("/assets/img/form-loading.gif", __FILE__)]);
            }
        }
    }

    public function addPluginWpPages($pages) {
        $pages[] = "users.php";
        return $pages;
    }

    public function addPluginAdminPages($pages) {
        $pages[] = self::WPDS_ADMIN_SLUG;
        $pages[] = self::WPDS_USER_SLUG;
        return $pages;
    }

    public function addSubscriptionsToAdminMenu() {
        add_submenu_page(WpdiscuzCore::PAGE_WPDISCUZ, "&raquo; " . __("Subscriptions", "wpdiscuz_sbm"), "&raquo; " . __("Subscriptions", "wpdiscuz_sbm"), "manage_options", self::WPDS_ADMIN_SLUG, [&$this, "subscriptionList"]);
        add_submenu_page("users.php", __("Your Subscriptions", "wpdiscuz_sbm"), __("Your Subscriptions", "wpdiscuz_sbm"), "read", self::WPDS_USER_SLUG, [&$this, "userSubscriptionList"]);
    }

    public function subscriptionList() {
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e("Subscriptions", "wpdiscuz_sbm"); ?></h1>
            <span id="wpds-view-stat" class="page-title-action"><?php _e("View Statistics", "wpdiscuz_sbm"); ?></span>
            <div id="poststuff">
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <form method="GET">
                            <p class="search-box">
                                <label class="screen-reader-text" for="search-input"><?php _e("Search", "wpdiscuz_sbm"); ?></label>
                                <input id="search-input" name="wpds_search" value="" type="search" placeholder="<?php _e("Post Title or Email", "wpdiscuz_sbm"); ?>">
                                <input id="search-submit" class="button" value="<?php _e("Search", "wpdiscuz_sbm"); ?>" type="submit">
                            </p>
                            <input type="hidden" value="<?php echo self::WPDS_ADMIN_SLUG ?>" name="page" >
                            <?php
                            $list = new wpdSubscriptionsList($this->db);
                            $list->prepare_items();
                            $list->display();
                            ?>
                        </form>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
        <?php
        add_thickbox();
    }

    public function userSubscriptionList() {
        ?>
        <div class="wrap">
            <h2><?php _e("Subscriptions", "wpdiscuz_sbm"); ?></h2>
            <div id="poststuff">
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <form method="GET">
                            <p class="search-box">
                                <label class="screen-reader-text" for="search-input"><?php _e("Search", "wpdiscuz_sbm"); ?></label>
                                <input id="search-input" name="wpds_search" value="" type="search" placeholder="<?php _e("Post Title", "wpdiscuz_sbm"); ?>">
                                <input id="search-submit" class="button" value="<?php _e("Search", "wpdiscuz_sbm"); ?>" type="submit">
                            </p>
                            <input type="hidden" value="<?php echo self::WPDS_USER_SLUG ?>" name="page" >
                            <?php
                            $list = new wpdUserSubscriptionsList($this->db);
                            $list->prepare_items();
                            $list->display();
                            ?>
                        </form>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
        <?php
    }

    public function userProfileUpdate($userID, $oldData) {
        $user = get_user_by("ID", $userID);
        if ($user->user_email != $oldData->user_email) {
            $this->db->updateUserEmail($user->user_email, $oldData->user_email);
        }
    }

    public function deletePost($postID) {
        $this->db->deletSubscriptionsByPostID($postID);
    }

    public function deleteComment($commentID) {
        $this->db->deletSubscriptionsByCommentID($commentID);
    }

}

new wpdSubscribeManager();
