<?php

if (!defined("ABSPATH")) {
    exit();
}

/*
 * Plugin Name: wpDiscuz - Comment Search
 * Description: AJAX powered comment search form and widget. Starts searching while you're typing a word.
 * Version: 7.0.0
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/wpdiscuz-comment-search/
 * Text Domain: wpdiscuz-search
 * Domain Path: /languages/
 */

define("WPDS_DIR_PATH", dirname(__FILE__));
define("PLUGIN_DIR_NAME", basename(WPDS_DIR_PATH));

include_once WPDS_DIR_PATH . "/includes/wcsDBManager.php";
include_once WPDS_DIR_PATH . "/options/wpDiscuzCommentSearchOption.php";
include_once WPDS_DIR_PATH . "/includes/gvt-api-manager.php";
include_once WPDS_DIR_PATH . "/wpDiscuzCommentSearchWidget.php";
include_once WPDS_DIR_PATH . "/wpDiscuzSearchWidgetWalker.php";

class wpDiscuzCommentSearch {

    private $dbManager;
    private $options;
    private $version;
    private $search_data;

    public function __construct() {
        add_action("plugins_loaded", [&$this, "pluginsLoaded"], 13);
    }

    public function pluginsLoaded() {
        if (function_exists("wpDiscuz")) {
            $this->version = get_option("wpdiscuz_search_version");
            if (!$this->version) {
                $this->version = "1.0.0";
            }
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            $this->dbManager = new SearchDBManager();
            $this->options = new wpDiscuzCommentSearchOption();
            $this->dbManager->setOptions($this->options);
            load_plugin_textdomain("wpdiscuz-search", false, dirname(plugin_basename(__FILE__)) . "/languages/");
            add_action("wp_enqueue_scripts", [&$this, "registerFrontScripts"], 105);
            add_action("wpdiscuz_before_thread_list", [&$this, "printSearchForm"], 15, 3);
            add_action("wp_ajax_wpdiscuz_search_data", [&$this, "printSearchData"], 15);
            if ($this->options->savedOptions["display_form_for_guests"]) {
                add_action("wp_ajax_nopriv_wpdiscuz_search_data", [&$this, "printSearchData"], 15);
            }
            add_action("wpdiscuz_check_version", [&$this, "pluginNewVersion"], 15);
            add_action("widgets_init", [&$this, "wpb_load_widget"], 15);
            add_shortcode("commSearch", [&$this, "wpdiscuzCommentSaerchShortcode"], 15);
            add_action("wpdiscuz_save_options", [$this->options, "searchSaveOptions"], 15);
            add_action("wpdiscuz_reset_options", [$this->options, "resetOptions"], 15);
            add_filter("wpdiscuz_settings", [&$this->options, "settingsArray"], 15);
            add_action("wp_head", [$this->options, "commentSearchDynamicStyles"], 15);
        } else {
            add_action("admin_notices", [&$this, "csRequirements"], 1);
        }
    }

    public function wpdiscuzCommentSaerchShortcode() {
        ob_start();
        include WPDS_DIR_PATH . "/search-form-all-comments.php";
        return ob_get_clean();
    }

    public function csRequirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Comment Search requires wpDiscuz to be installed!", "wpdiscuz-search") . "</p></div>";
        }
    }

    public function wpb_load_widget() {
        register_widget("wpDiscuzCommentSearchWidget");
    }

    public function printSearchForm($post, $currentUser, $commentsCount) {
        if (($currentUser->ID || $this->options->savedOptions["display_form_for_guests"]) && $commentsCount) {
            include_once WPDS_DIR_PATH . "/search-form.php";
        }
    }

    public function printSearchData() {
        $wpdiscuz = wpDiscuz();
        $search_data = isset($_POST["search_data"]) ? $_POST["search_data"] : "";
        $isPage = isset($_POST["is_page"]) ? intval($_POST["is_page"]) : 0;
        $post_id = isset($_POST["post_id"]) ? $_POST["post_id"] : 0;
        $searchBy = isset($_POST["searchBy"]) ? $_POST["searchBy"] : "";
        $page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
        $allcomm = isset($_POST["allComm"]) ? $_POST["allComm"] : false;
        $printed_data = isset($_POST["printed_data"]) ? $_POST["printed_data"] : "";
        if ($allcomm) {
            $this->SearchAllCommData($search_data, $wpdiscuz, $isPage, $post_id, $searchBy, $page, $allcomm, $printed_data);
        } else {
            $this->SearchCommData($search_data, $wpdiscuz, $isPage, $post_id, $searchBy, $page);
        }
        wp_die();
    }

    private function SearchCommData($search_data, $wpdiscuz, $isPage, $post_id, $searchBy, $page) {
        if ($searchResult = $this->dbManager->searchData($search_data, $searchBy, $post_id)) {
            $per_page = intval($wpdiscuz->options->wp["commentPerPage"]);
            if ($commentIds = array_slice($searchResult, ($page - 1) * $per_page, $per_page)) {
                $comments = get_comments(["comment__in" => $commentIds]);
                $this->search_data = $search_data;
                add_filter("comment_text", [&$this, "convertPrintData"], 999);
                add_filter("wpdiscuz_after_reply_button", [&$this, "searchCommentView"], 362, 3);
                add_filter("wpdiscuz_comment_wrap_classes", [&$this, "removeReplyClass"], 362, 2);
                $args = $wpdiscuz->getCommentListArgs($post_id);
                $args["max_depth"] = -1;
                $args["reverse_top_level"] = true;
                $print_data = wp_list_comments($args, $comments);
                $search_results_phrase = isset($this->options->savedOptions["search_result_phrase"]) ? __($this->options->savedOptions["search_result_phrase"], "wpdiscuz-search") : __("Search result", "wpdiscuz-search");
                $html = "<div class='search-result'><p class='wpd-search-result-title'>" . $search_results_phrase . "</p>" . $print_data . "</div>";
                $pageCount = ceil(count($searchResult) / $per_page);
                if ($isPage == 0 && $pageCount > 1) {
                    $html .= "<div id='wpdiscuz-search-pagination'>";
                    for ($i = 1; $i <= $pageCount; $i++) {
                        if ($i == 1) {
                            $html .= "<span id='pagination-$i' class='wpdiscuz-search-pagination-item pagination-current-page'>$i</span>";
                        } else {
                            $html .= "<span id='pagination-$i' class='wpdiscuz-search-pagination-item'>$i</span>";
                        }
                    }
                    $html .= "</div>";
                }
                echo $html;
            } else {
                $search_no_results_phrase = isset($this->options->savedOptions["search_no_result_phrase"]) ? __($this->options->savedOptions["search_no_result_phrase"], "wpdiscuz-search") : __("No comment found", "wpdiscuz-search");
                echo "<p class='wpd-search-result-title'>" . $search_no_results_phrase . "</p>";
            }
        } else {
            $search_no_results_phrase = isset($this->options->savedOptions["search_no_result_phrase"]) ? __($this->options->savedOptions["search_no_result_phrase"], "wpdiscuz-search") : __("No comment found", "wpdiscuz-search");
            echo "<p class='wpd-search-result-title'>" . $search_no_results_phrase . "</p>";
        }
    }

    private function SearchAllCommData($search_data, $wpdiscuz, $isPage, $post_id, $searchBy, $page, $allComments, $printed_data) {
        if ($searchResult = $this->dbManager->searchData($search_data, $searchBy, $post_id, $allComments)) {
            $widget_options = get_option("widget_wpdiscuz_search_widget_options");
            $per_page = $widget_options["widget_display_post_count"];
            if ($commentIds = array_slice($searchResult, ($page - 1) * $per_page, $per_page)) {
                $display_avatar = $widget_options["widget_display_avatar"];
                $comments = get_comments(["comment__in" => $commentIds]);
                echo stripslashes($printed_data);
                $args = [
                    "walker" => new wpDiscuzSearchWidgetWalker($this->options, $search_data, $display_avatar),
                    "reverse_top_level" => true,
                    "style" => "div",
                    "echo" => false,
                ];

                if ($page == 1) {
                    $search_results_phrase = isset($this->options->savedOptions["search_result_phrase"]) ? __($this->options->savedOptions["search_result_phrase"], "wpdiscuz-search") : __("Search result", "wpdiscuz-search");
                    echo "<p class='wpd-search-result-title'>" . $search_results_phrase . "</p>";
                }
                echo wp_list_comments($args, $comments);
                $pageCount = ceil(count($searchResult) / $per_page);
                if ($pageCount > 1 && $pageCount > $page) {
                    echo "<button class='wpdiscuz-search-widget-loadmore' data-id='" . $page . "'>" . __("Load More", "wpdiscuz-search") . "</button>";
                }
            } else {
                $search_no_results_phrase = isset($this->options->savedOptions["search_no_result_phrase"]) ? __($this->options->savedOptions["search_no_result_phrase"], "wpdiscuz-search") : __("No comment found", "wpdiscuz-search");
                echo "<p class='wpd-search-result-title'>" . $search_no_results_phrase . "</p>";
            }
        } else {
            $search_no_results_phrase = isset($this->options->savedOptions["search_no_result_phrase"]) ? __($this->options->savedOptions["search_no_result_phrase"], "wpdiscuz-search") : __("No comment found", "wpdiscuz-search");
            echo "<p class='wpd-search-result-title'>" . $search_no_results_phrase . "</p>";
        }
    }

    public function pluginNewVersion() {
        $pluginData = get_plugin_data(__FILE__);
        if (version_compare($pluginData["Version"], $this->version, ">")) {
            $this->options->addNewOptions($this->options->defaultValues());
            update_option("wpdiscuz_search_version", $pluginData["Version"]);
        } else {
            update_option("wpdiscuz_search_version", $this->version);
        }
    }

    public function registerFrontScripts() {
        $wpdiscuz = wpDiscuz();
        $defaultField = is_array($this->options->savedOptions["search_available_fields"]) && in_array($this->options->savedOptions["search_default_field"], $this->options->savedOptions["search_available_fields"]) ? $this->options->savedOptions["search_default_field"] : "all";
        $searchTextMinLength = isset($this->options->savedOptions["search_text_min_length"]) && $this->options->savedOptions["search_text_min_length"] ? $this->options->savedOptions["search_text_min_length"] : 3;
        $vars = ["url" => admin_url("admin-ajax.php"), "searchDefaultField" => $defaultField, "searchTextMinLength" => $searchTextMinLength];
        $suf = $wpdiscuz->options->general["loadMinVersion"] ? ".min" : "";
        wp_register_script("wpdiscuz-search-scripts", plugins_url(PLUGIN_DIR_NAME) . "/assets/js/front$suf.js", ["jquery"], $this->version, true);
        wp_enqueue_script("wpdiscuz-search-scripts");
        wp_localize_script("wpdiscuz-search-scripts", "search_ajax", $vars);
        wp_register_style("wpdiscuz-search-styles", plugins_url(PLUGIN_DIR_NAME) . "/assets/css/front$suf.css", null, $this->version);
        wp_enqueue_style("wpdiscuz-search-styles");
        if ($wpdiscuz->options->thread_styles["enableFontAwesome"]) {
            wp_enqueue_style("wpdiscuz-font-awesome");
        }
    }

    public function convertPrintData($text) {
        $output = '';
        if ($text) {
            $textarr = preg_split('/(<.*>)/U', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
            $stop = count($textarr);
            for ($i = 0; $i < $stop; $i++) {
                $content = $textarr[$i];
                if (strlen($content) > 0 && '<' != $content[0]) {
                    $pattern = preg_quote($this->search_data);
                    $content = preg_replace_callback("#($pattern)#isu", array(&$this, 'addBackground'), $content);
                }
                $output .= $content;
            }
        } else {
            $output = $text;
        }
        return $output;
    }

    private function addBackground($matches) {
        return sprintf("<span style='background-color:{$this->options->savedOptions['searched_data_bg']}'>%s</span>", $matches[1]);
    }

    public function searchCommentView($output, $comment, $user) {
        $output .= "<div class='view-comment wpd-cta-button'><a href='" . get_comment_link($comment) . "' title='" . __('View Tree', 'wpdiscuz-search') . "' target='_blank'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"19\" height=\"19\" viewBox=\"0 0 24 24\"><path fill=\"none\" d=\"M0 0h24v24H0V0z\"/><path d=\"M21 11.01L3 11v2h18zM3 16h12v2H3zM21 6H3v2.01L21 8z\"/></svg> " . __('View Tree', 'wpdiscuz-search') . "</a></div>";
        return $output;
    }

    public function removeReplyClass($commentWrapperClass, $comment) {
        if (($key = array_search('wpd-reply', $commentWrapperClass)) !== false) {
            unset($commentWrapperClass[$key]);
        }
        return $commentWrapperClass;
    }

}

$wpDiscuzCommentSearch = new wpDiscuzCommentSearch();
