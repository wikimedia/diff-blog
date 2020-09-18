<?php
/*
 * Plugin Name: wpDiscuz - Widgets
 * Description: Plugin for displaying the most popular and the newest comments
 * Version: 7.0.6
 * Author: gVectors Team
 * Contributors: A. Chakhoyan, G. Zakaryan, H. Martirosyan
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/wpdiscuz-widgets/
 * Text Domain: wpdiscuz-widgets
 * Domain Path: /languages/
 */

define("WIDG_DIR_PATH", dirname(__FILE__));

include_once WIDG_DIR_PATH . "/includes/gvt-api-manager.php";
include_once WIDG_DIR_PATH . "/wpdiscuz-widgets-class.php";

class wpDiscuzWidgets {

    public $widgetOptionsName = "widget_options_array";
    public $options;
    private $version;
    public $tabKey = "widg";
	public $apimanager;

    /**
     * 
     */
    public function __construct() {
        add_action("plugins_loaded", [&$this, "pluginsLoaded"], 1894.5);
    }

    public function pluginsLoaded() {
        if (function_exists("wpDiscuz")) {
	        $this->apimanager = new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            load_plugin_textdomain("wpdiscuz-widgets", false, dirname(plugin_basename(__FILE__)) . "/languages/");
            $this->version = get_option("widgetPluginVersion");
            if (!$this->version) {
                $this->version = "1.0.0";
            }
            $this->addOptions();
            $this->initOptions();
            add_action("wpdiscuz_check_version", [&$this, "widgetPluginVersion"]);
            add_action("widgets_init", [&$this, "registerWpdiscuzWidget"], 13);
            add_filter("admin_enqueue_scripts", [&$this, "wpdiscuz_widgets_comment_vot_widg_script"], 150);
            add_action("wpdiscuz_save_options", [$this, "widgetSaveOptions"], 13);
            add_action("wpdiscuz_reset_options", [$this, "widgetResetOptions"], 13);
            add_filter("wpdiscuz_settings", [$this, "settingsArray"]);
            add_action("wp_head", [&$this, "initDynamicCss"]);
        } else {
            add_action("admin_notices", [$this, "wpDiscuzWidgets_requirements"]);
        }
    }

    public function wpDiscuzWidgets_requirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Widgets requires wpDiscuz to be installed!", "wpdiscuz-widgets") . "</p></div>";
        }
    }

    /*
     * checking a version
     */

    public function widgetPluginVersion() {
        $pluginData = get_plugin_data(__FILE__);
        if (version_compare($pluginData["Version"], $this->version, ">")) {
            update_option("widgetPluginVersion", $pluginData["Version"]);
            $old_options = maybe_unserialize(get_option($this->widgetOptionsName));
            if (count($this->widgetDefaultOptions()) > count(maybe_unserialize(get_option($this->widgetOptionsName)))) {
                $result_options = array_merge($this->widgetDefaultOptions(), maybe_unserialize(get_option($this->widgetOptionsName)));
                update_option($this->widgetOptionsName, $result_options);
            }
        } else {
            update_option("widgetPluginVersion", $this->version);
        }
    }

    /**
     * Dynamic css which will be written in the head of document
     * using the values of fields from addons settings
     */
    public function initDynamicCss() {
        ?>
        <style type='text/css'>.like-count-first.wpdiscuz-widget-comment .wpdiscuz-widget-icon-show-box{background:<?php echo $this->options["wc_icons_background_color"] ?>;}#widget-comments-container .wpdiscuz-widgets-tab-title-list li .fas{color:<?php echo $this->options["wc_icons_color"] ?>;}div#widget-comments-container.widget-comments-container{max-width:<?php echo $this->options["wpdiscuz_widget_max_width"]; ?>px;margin-left:<?php echo $this->options["wpdiscuz_widget_lmargin"]; ?>px;margin-right:<?php echo $this->options["wpdiscuz_widget_rmargin"]; ?>px;}div#widget-comments-container div.wpdiscuz-widgets-content{padding-right:<?php echo $this->options["wpdiscuz_widget_rpadding"]; ?>px;padding-left:<?php echo $this->options["wpdiscuz_widget_lpadding"]; ?>px;}div.widget-comments-container>div,div.widget-comments-container>ul>.tab-title-list-active-item{background-color:<?php echo $this->options["wc_widget_background_color"]; ?>;}#widget-comments-container ul.wpdiscuz-widgets-tab-title-list li.tab-title-list-active-item{border-top-color:<?php echo $this->options["wc_icons_color"]; ?>}#widget-comments-container .wpd_widgets_items_wrapper .slick-arrow{background:<?php echo $this->options["wc_icons_background_color"] ?>;} <?php echo stripslashes($this->options["wpdiscuz_widget_custom_css"]); ?></style>
        <?php
    }

    /**
     * Register widgets with widgets classnames
     */
    public function registerWpdiscuzWidget() {
        register_widget("wpDiscuzWidgetsClass");
    }

    /**
     * Connecting css and js files to admin page
     */
    public function wpdiscuz_widgets_comment_vot_widg_script() {
        global $pagenow;
        if ((isset($_GET["page"]) && isset($_GET["wpd_tab"]) && $_GET["page"] === WpdiscuzCore::PAGE_SETTINGS && $_GET["wpd_tab"] === $this->tabKey) || $pagenow == "widgets.php") {
            wp_enqueue_style("jquery-ui-datepicker-style", plugins_url("/assets/third-party/jquery-ui.min.css", __FILE__), null, $this->version);
            wp_enqueue_style("jquery-ui-style");
            wp_enqueue_script("jquery-ui-datepicker");
            wp_register_script("wpdiscuz_widgets_comm_vot_admin_srcipt", plugins_url("/assets/js/admin-js.js", __FILE__), ["jquery"], $this->version, true);
            wp_enqueue_script("wpdiscuz_widgets_comm_vot_admin_srcipt");
            wp_enqueue_style("wpdiscuz-font-awesome");
            wp_register_style("wpdiscuz_widgets_comm_vot_admin_style", plugins_url("/assets/css/admin-style.css", __FILE__), null, $this->version);
            wp_enqueue_style("wpdiscuz_widgets_comm_vot_admin_style");
        }
    }

    private function initOptions() {
        $this->options = get_option($this->widgetOptionsName);
    }

    private function addOptions() {
        $options = $this->widgetDefaultOptions();
        add_option($this->widgetOptionsName, $options, "", "no");
    }

    /**
     * update widget settings from WpDiscuz settings
     * @param array $args
     */
    public function widgetSaveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->options["wpdiscuz_widget_post_title_cutting"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_post_title_cutting"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_post_title_cutting"]) : 0;
            $this->options["wpdiscuz_widgets_post_title_word_count"] = isset($_POST[$this->tabKey]["wpdiscuz_widgets_post_title_word_count"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widgets_post_title_word_count"]) : 5;
            $this->options["wpdiscuz_widget_content_cutting"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_content_cutting"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_content_cutting"]) : 0;
            $this->options["wpdiscuz_widgets_post_content_word_count"] = isset($_POST[$this->tabKey]["wpdiscuz_widgets_post_content_word_count"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widgets_post_content_word_count"]) : 10;
            $this->options["mvc_displaying_style"] = isset($_POST[$this->tabKey]["mvc_displaying_style"]) ? $_POST[$this->tabKey]["mvc_displaying_style"] : "votes_style";
            $this->options["wc_widget_background_color"] = isset($_POST[$this->tabKey]["wc_widget_background_color"]) ? trim($_POST[$this->tabKey]["wc_widget_background_color"]) : "rgba(255, 255, 255, 0)";
            $this->options["wc_icons_background_color"] = isset($_POST[$this->tabKey]["wc_icons_background_color"]) ? trim($_POST[$this->tabKey]["wc_icons_background_color"]) : "#20252B";
            $this->options["wpdiscuz_widget_icon_circle"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_icon_circle"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_icon_circle"]) : 0;
            $this->options["wc_icons_color"] = isset($_POST[$this->tabKey]["wc_icons_color"]) ? trim($_POST[$this->tabKey]["wc_icons_color"]) : "#20252B";
            $this->options["wpdiscuz_widget_max_width"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_max_width"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_max_width"]) : 350;
            $this->options["wpdiscuz_widget_lmargin"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_lmargin"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_lmargin"]) : 10;
            $this->options["wpdiscuz_widget_rmargin"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_rmargin"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_rmargin"]) : 10;
            $this->options["wpdiscuz_widget_lpadding"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_lpadding"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_lpadding"]) : 10;
            $this->options["wpdiscuz_widget_rpadding"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_rpadding"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_rpadding"]) : 10;
            $this->options["wpdiscuz_widget_displaying_guests"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_displaying_guests"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_displaying_guests"]) : 0;
            $this->options["excluded_user_roles"] = isset($_POST[$this->tabKey]["excluded_user_roles"]) ? $_POST[$this->tabKey]["excluded_user_roles"] : [];
            $this->options["enable_for_post_types"] = isset($_POST[$this->tabKey]["enable_for_post_types"]) ? $_POST[$this->tabKey]["enable_for_post_types"] : [];
            $this->options["wpdiscuz_widget_author_link"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_author_link"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_author_link"]) : 0;
            $this->options["wpdiscuz_widget_slider_enable"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_slider_enable"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_slider_enable"]) : 0;
            $this->options["wpdiscuz_widget_theme_title_struct"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_theme_title_struct"]) ? intval($_POST[$this->tabKey]["wpdiscuz_widget_theme_title_struct"]) : 0;
            $this->options["wpdiscuz_widget_custom_css"] = isset($_POST[$this->tabKey]["wpdiscuz_widget_custom_css"]) ? $_POST[$this->tabKey]["wpdiscuz_widget_custom_css"] : "#widget-comments-container{font-size:100%}";
            update_option($this->widgetOptionsName, $this->options);
        }
    }

    public function widgetResetOptions($tab) {
        if ($this->tabKey === $tab || $tab === "all") {
            $options = $this->widgetDefaultOptions();
            update_option($this->widgetOptionsName, $options);
            $this->options = $options;
        }
    }

    /**
     * 
     * @return array
     */
    public function widgetDefaultOptions() {
        $posttypes = array_filter(get_post_types(), function ($v) {
	        return post_type_supports($v, 'comments');
        });
        $def_opt = [
            "wpdiscuz_widget_post_title_cutting" => 1,
            "wpdiscuz_widgets_post_title_word_count" => 5,
            "wpdiscuz_widget_content_cutting" => 1,
            "wpdiscuz_widgets_post_content_word_count" => 10,
            "mvc_displaying_style" => "votes_style",
            "wc_widget_background_color" => "rgba(255, 255, 255, 0)",
            "wc_icons_background_color" => "#20252B",
            "wpdiscuz_widget_icon_circle" => 1,
            "wc_icons_color" => "#20252B",
            "wpdiscuz_widget_max_width" => 550,
            "wpdiscuz_widget_lmargin" => 10,
            "wpdiscuz_widget_rmargin" => 10,
            "wpdiscuz_widget_lpadding" => 10,
            "wpdiscuz_widget_rpadding" => 10,
            "wpdiscuz_widget_displaying_guests" => 1,
            "excluded_user_roles" => [],
            "enable_for_post_types" => $posttypes,
            "wpdiscuz_widget_author_link" => 1,
            "wpdiscuz_widget_slider_enable" => 1,
            "wpdiscuz_widget_theme_title_struct" => 1,
            "wpdiscuz_widget_custom_css" => "#widget-comments-container{font-size:100%}",
        ];
        return $def_opt;
    }

    public function settingsArray($settings) {
        $settings["addons"][$this->tabKey] = [
            "title" => __("Widgets", "wpdiscuz-widgets"),
            "title_original" => "Widgets",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WIDG_DIR_PATH . "/options/addons-settings-html.php",
            "values" => $this,
            "options" => [
                "wpdiscuz_widget_post_title_cutting" => [
                    "label" => __("Enable post title shortening", "wpdiscuz-widgets"),
                    "label_original" => "Enable post title shortening",
                    "description" => __("If this option is enabled all titles will be cut with below defined number of words", "wpdiscuz-widgets"),
                    "description_original" => "If this option is enabled all titles will be cut with below defined number of words",
                    "docurl" => "#"
                ],
                "wpdiscuz_widgets_post_title_word_count" => [
                    "label" => __("number of words in shortened titles", "wpdiscuz-widgets"),
                    "label_original" => "number of words in shortened titles",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_content_cutting" => [
                    "label" => __("Enable content shortening", "wpdiscuz-widgets"),
                    "label_original" => "Enable content shortening",
                    "description" => __("This option enables post and comment excerpts shortening with below defined number of words", "wpdiscuz-widgets"),
                    "description_original" => "This option enables post and comment excerpts shortening with below defined number of words",
                    "docurl" => "#"
                ],
                "wpdiscuz_widgets_post_content_word_count" => [
                    "label" => __("number of words in shortened excerpts", "wpdiscuz-widgets"),
                    "label_original" => "number of words in shortened excerpts",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "mvc_displaying_style" => [
                    "label" => __("Most Voted Comments Style", "wpdiscuz-widgets"),
                    "label_original" => "Most Voted Comments Style",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wc_widget_background_color" => [
                    "label" => __("Widget Background Color", "wpdiscuz-widgets"),
                    "label_original" => "Widget Background Color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wc_icons_background_color" => [
                    "label" => __("Items Icon Background Color", "wpdiscuz-widgets"),
                    "label_original" => "Items Icon Background Color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_icon_circle" => [
                    "label" => __("Items Icon/Avatar Circle", "wpdiscuz-widgets"),
                    "label_original" => "Items Icon/Avatar Circle",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wc_icons_color" => [
                    "label" => __("Tab Icons Color", "wpdiscuz-widgets"),
                    "label_original" => "Tab Icons Color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_max_width" => [
                    "label" => __("Widget max width", "wpdiscuz-widgets"),
                    "label_original" => "Widget max width",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_lmargin" => [
                    "label" => __("Widget left margin", "wpdiscuz-widgets"),
                    "label_original" => "Widget left margin",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_rmargin" => [
                    "label" => __("Widget right margin", "wpdiscuz-widgets"),
                    "label_original" => "Widget right margin",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_lpadding" => [
                    "label" => __("Widget left padding", "wpdiscuz-widgets"),
                    "label_original" => "Widget left padding",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_rpadding" => [
                    "label" => __("Widget right padding", "wpdiscuz-widgets"),
                    "label_original" => "Widget right padding",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "excluded_user_roles" => [
                    "label" => __("Exclude user roles", "wpdiscuz-widgets"),
                    "label_original" => "Exclude user roles",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "enable_for_post_types" => [
                    "label" => __("Display comments of certain post types", "wpdiscuz-widgets"),
                    "label_original" => "Display comments of certain post types",
                    "description" => __('This option is only for "Most Commented Posts" tab', "wpdiscuz-widgets"),
                    "description_original" => 'This option is only for "Most Commented Posts" tab',
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_displaying_guests" => [
                    "label" => __("Show guest commenters", "wpdiscuz-widgets"),
                    "label_original" => "Show guest commenters",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_author_link" => [
                    "label" => __("Enable user link for all users", "wpdiscuz-widgets"),
                    "label_original" => "Enable user link for all users",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_slider_enable" => [
                    "label" => __("Enable slider in single tab", "wpdiscuz-widgets"),
                    "label_original" => "Enable slider in single tab",
                    "description" => __("You can display comments in slider when in each widget enabled only one tab", "wpdiscuz-widgets"),
                    "description_original" => "You can display comments in slider when in each widget enabled only one tab",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_theme_title_struct" => [
                    "label" => __("Use theme's widget title structure", "wpdiscuz-widgets"),
                    "label_original" => "Use theme's widget title structure",
                    "description" => __("This option can help you solve problems with theme widget title structure. If your theme widget title structure does not match with our plugin's title structure you should uncheck this option", "wpdiscuz-widgets"),
                    "description_original" => "This option can help you solve problems with theme widget title structure. If your theme widget title structure does not match with our plugin's title structure you should uncheck this option",
                    "docurl" => "#"
                ],
                "wpdiscuz_widget_custom_css" => [
                    "label" => __("Widget custom CSS", "wpdiscuz-widgets"),
                    "label_original" => "Widget custom CSS",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}

$wpdiscuzWidgets = new wpDiscuzWidgets();
