<?php

if (!defined("ABSPATH")) {
    exit();
}
/*
 * Plugin Name: wpDiscuz - Syntax Highlighter
 * Description: Syntax highlighting for comments, automatic language detection and multi-language code highlighting.
 * Version: 1.0.0
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/product/wpdiscuz-syntax-highlighter/
 * Text Domain: wpdiscuz_syntax
 * Domain Path: /languages/
 */
define("WSH_DIR_PATH", dirname(__FILE__));

require_once WSH_DIR_PATH . "/includes/gvt-api-manager.php";
require_once WSH_DIR_PATH . "/options/wpDiscuzSyntaxHighlighterOptions.php";

class wpDiscuzSyntaxHighlighter {

    private $version;
    private $options;

    public function __construct() {
        add_action("plugins_loaded", [&$this, "pluginLoad"], 1);
    }

    public function pluginLoad() {
        if (function_exists("wpDiscuz")) {
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            load_plugin_textdomain("wpdiscuz_syntax", false, dirname(plugin_basename(__FILE__)) . "/languages/");
            $this->options = new wpDiscuzSyntaxHighlighterOptions();
            add_action("wpdiscuz_front_scripts", [&$this, "frontFiles"]);
            add_filter("wpdiscuz_js_options", [&$this, "jsOptions"]);
            add_action("wpdiscuz_check_version", [&$this, "initVersion"]);
        } else {
            add_action("admin_notices", [&$this, "wpdsRequirements"], 1);
        }
    }

    public function wpdsRequirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Syntax Highlighter requires wpDiscuz to be installed!", "wpdiscuz_syntax") . "</p></div>";
        }
    }
    
    public function initVersion(){
        $pluginData = get_plugin_data(__FILE__);
        $this->version = $pluginData["Version"];
    }

    public function frontFiles($options) {
        wp_register_style("wpdiscuz-syntax-highlighter-css", plugins_url("/assets/highlight/styles/{$this->options->style}.css", __FILE__), null, $this->version);
        wp_enqueue_style("wpdiscuz-syntax-highlighter-css");
        $dep = $options->general["loadComboVersion"] ? "wpdiscuz-combo-js" : "wpdiscuz-ajax-js";
        wp_register_script("wpdiscuz-syntax-highlighter-js", plugins_url("/assets/js/wpdiscuz-syntax-highlighter.js", __FILE__), [$dep], $this->version, true);
        wp_enqueue_script("wpdiscuz-syntax-highlighter-js");
    }

    public function jsOptions($options) {
        $options["syntaxPackage"] = $this->options->package;
        $options["syntaxLanguages"] = $this->options->languages;
        $options["syntaxWorkerURL"] = plugins_url("/assets/js/wpdiscuz-syntax-highligh-worker.js", __FILE__);
        $options["syntaxCustomSelector"] = $this->options->customSelector;
        return $options;
    }

}

$wpDiscuzSyntaxHighlighter = new wpDiscuzSyntaxHighlighter();
