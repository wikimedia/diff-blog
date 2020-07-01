<?php

/*
 * Plugin Name: wpDiscuz - Comment Translation
 * Description: Smart, intuitive, fast and powerful tool to surprise your website visitors and comment readers. This is an unique function on your comment area which will translate comment content to more than 100 different languages. 
 * Version: 7.0.0
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/product/wpdiscuz-comment-translation/
 * Text Domain: wpdiscuz-translate
 * Domain Path: /languages/
 */
defined("ABSPATH") or exit;
define("WPDISCUZ_TRNS_PATH", dirname(__FILE__));

require_once WPDISCUZ_TRNS_PATH . "/class.CommentTrns.php";
require_once WPDISCUZ_TRNS_PATH . "/options/class.TrnsCommentOption.php";
require_once WPDISCUZ_TRNS_PATH . "/options/phrases.php";
require_once WPDISCUZ_TRNS_PATH . "/options/lang-list.php";
require_once WPDISCUZ_TRNS_PATH . "/ajax/class.TranslateAjax.php";
require_once WPDISCUZ_TRNS_PATH . "/includes/gvt-api-manager.php";

class wpDiscuzTranslate {

    public $commentTrns;
    private $option;
    private $apiType;
    private $keyValid;
    private $apiKey;
    private $langList;
    private $trnsAjax;

    public function __construct() {
        add_action("plugins_loaded", [&$this, "pluginsLoaded"], 14);
    }

    public function pluginsLoaded() {
        if (function_exists("wpDiscuz")) {
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            $settings = $this->getTrnsSettings();
            $this->langList = langList($this->apiType);
            $this->commentTrns = new CommentTrns($settings);
            $this->option = new TrnsCommentOption();
            $this->trnsAjax = new TranslateAjax($settings);

            load_plugin_textdomain("wpdiscuz-translate", false, dirname(plugin_basename(__FILE__)) . "/languages/");

            add_action("wp_ajax_discuz-trns", [&$this->trnsAjax, "actionKind"]);
            add_action("wp_ajax_nopriv_discuz-trns", [&$this->trnsAjax, "actionKind"]);

            add_action("admin_enqueue_scripts", [$this, "styleAdmin"], 14);
            add_action("wpdiscuz_save_options", [&$this->option, "translateSaveOptions"], 14);
            add_action("wpdiscuz_reset_options", [&$this->option, "resetOptions"], 14);
            add_filter("wpdiscuz_settings", [&$this->option, "settingsArray"], 14);

            if ($this->keyValid === "1") {
                add_action("wpdiscuz_front_scripts", [$this, "styleWp"], 14);
                add_filter("wpdiscuz_js_options", [&$this, "translateScriptArray"], 14);
                add_filter("wpdiscuz_after_reply_button", [&$this->commentTrns, "addTranslateButton"], 14, 4);
                add_action("wpdiscuz_dynamic_css", [&$this->commentTrns, "dynamicStyles"], 14);
                add_action("wp_footer", [&$this->commentTrns, "allLangList"], 14);
                add_filter("wpdiscuz_comment_edit_save", [&$this->commentTrns, "deleteCommentMeta"], 14);
            }
        } else {
            add_action("admin_notices", [&$this, "trnsRequirements"], 1);
        }
    }

    public function trnsRequirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Comment Translation requires wpDiscuz to be installed!", "wpdiscuz-translate") . "</p></div>";
        }
    }

    protected function getTrnsSettings() {
        $settings = get_option("translate_settings");
        $this->apiType = isset($settings["api"]) ? $settings["api"] : "yandex";
        $this->keyValid = isset($settings["valid"]) ? $settings["valid"] : "0";
        $this->apiKey = isset($settings["key"]) ? $settings["key"] : "";
        return $settings;
    }

    public function styleAdmin() {
        wp_register_style("trns-menu-style", plugins_url("assets/css/option-style.css", __FILE__));
        wp_enqueue_style("trns-menu-style");

        wp_register_script("trns-menu-js", plugins_url("assets/js/options-script.js", __FILE__), ["jquery"], "1.0.0", false);
        wp_enqueue_script("trns-menu-js");
        wp_localize_script("trns-menu-js", "tr_php_obj", ["pl_url" => plugins_url("", __FILE__), "ajax_url" => admin_url("admin-ajax.php")]);
    }

    public function styleWp($options) {
        $min = $options->general["loadMinVersion"] ? ".min" : "";
        wp_register_style("trns-tr-style", plugins_url("assets/css/comm-trns-style$min.css", __FILE__));
        wp_enqueue_style("trns-tr-style");
        wp_register_script("trns-google-translate-js", plugins_url("assets/js/translate-script$min.js", __FILE__), ["jquery"], "1.0.0", true);
        wp_enqueue_script("trns-google-translate-js");
    }

    public function translateScriptArray($mod_obj) {
        $mod_obj["trns_lang_list"] = $this->langList;
        $mod_obj["trns_err"] = wpd_trns_phrases("Can't translate");
        $mod_obj["trns_error_dialog"] = wpd_trns_phrases("Can't translate this comment");
        $mod_obj["trns_same_lang_msg"] = wpd_trns_phrases("The original comment in");
        return $mod_obj;
    }

}

$wpDiscuzTranslate = new wpDiscuzTranslate();
