<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzCommentSearchOption {

    private $optionName;
    public $savedOptions;
    public $tabKey = "wpds";

    public function __construct() {
        $this->optionName = "wpdiscuz_comment_search";
        $this->addOption();
        $this->initOption();
    }

    public function resetOptions($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            $options = $this->defaultValues();
            update_option($this->optionName, $options);
            $this->initOption();
        }
    }

    private function addOption() {
        add_option($this->optionName, $this->defaultValues());
        $options = [
            "widget_title" => __("Comment Search", "wpdiscuz-search"),
            "widget_display_post_count" => 5,
            "widget_display_avatar" => "off",
        ];
        add_option("widget_wpdiscuz_search_widget_options", $options, "", "no");
    }

    public function defaultValues() {
        $options = [
            "display_form_for_guests" => 1,
            "search_text_min_length" => 3,
            "display_setting" => 1,
            "search_available_fields" => $this->getAvailableFields(),
            "search_default_field" => "all",
            "searched_data_bg" => "#C4ECE4",
            "search_icons_color" => "#00B38F",
            "search_text_color" => "#666666",
            "search_bg_color" => "#FFFFFF",
            "search_box_border_color" => "#CDCDCD",
            "dialog_text_color" => "#666666",
            "dialog_bg_color" => "#FFFFFF",
            "dialog_hover_color" => "#EEEEEE",
            "pagination_text_color" => "#666666",
            "pagination_item_bg_color" => "#C4ECE4",
            "widget_post_letters_count" => 60,
            "widget_post_title_color" => "#00B490",
            "widget_post_content_color" => "#686868",
            "widget_post_author_date_color" => "#CCC",
            "widget_title" => __("wpDiscuz All Comment Search", "wpdiscuz-search"),
            "widget_display_post_count" => 10,
            "widget_display_avatar" => "on",
            "widget_loadmore_bg" => "#DAF3EE",
            "widget_loadmore_text" => "#666666",
            "widget_loadmore_border" => "#CCCCCC",
            "search_result_phrase" => __("Search result", "wpdiscuz-search"),
            "search_no_result_phrase" => __("No comment found", "wpdiscuz-search"),
            "search_placeholder" => __("Comment search...", "wpdiscuz-search"),
            "dialog_search_by_all" => __("All", "wpdiscuz-search"),
            "dialog_search_by_content" => __("Content", "wpdiscuz-search"),
            "dialog_search_by_author" => __("Author", "wpdiscuz-search"),
            "dialog_search_by_email" => __("E-mail", "wpdiscuz-search"),
            "dialog_search_by_custom_fields" => __("Custom Fields", "wpdiscuz-search"),
        ];
        return $options;
    }

    public function searchSaveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->options["display_form_for_guests"] = isset($_POST[$this->tabKey]["display_form_for_guests"]) ? $_POST[$this->tabKey]["display_form_for_guests"] : 0;
            $this->options["search_text_min_length"] = isset($_POST[$this->tabKey]["search_text_min_length"]) && ($v = absint($_POST[$this->tabKey]["search_text_min_length"])) ? $v : 3;
            $this->options["display_setting"] = isset($_POST[$this->tabKey]["display_setting"]) ? $_POST[$this->tabKey]["display_setting"] : 0;
            $this->options["search_available_fields"] = isset($_POST[$this->tabKey]["search_available_fields"]) ? $_POST[$this->tabKey]["search_available_fields"] : $this->getAvailableFields();
            $this->options["search_default_field"] = isset($_POST[$this->tabKey]["search_default_field"]) && in_array($_POST[$this->tabKey]["search_default_field"], $this->options["search_available_fields"]) ? $_POST[$this->tabKey]["search_default_field"] : "content";
            $this->options["searched_data_bg"] = isset($_POST[$this->tabKey]["searched_data_bg"]) ? $_POST[$this->tabKey]["searched_data_bg"] : "#C4ECE4";
            $this->options["search_icons_color"] = isset($_POST[$this->tabKey]["search_icons_color"]) ? $_POST[$this->tabKey]["search_icons_color"] : "#00B38F";
            $this->options["search_text_color"] = isset($_POST[$this->tabKey]["search_text_color"]) ? $_POST[$this->tabKey]["search_text_color"] : "#666666";
            $this->options["search_bg_color"] = isset($_POST[$this->tabKey]["search_bg_color"]) ? $_POST[$this->tabKey]["search_bg_color"] : "#FFFFFF";
            $this->options["search_box_border_color"] = isset($_POST[$this->tabKey]["search_box_border_color"]) ? $_POST[$this->tabKey]["search_box_border_color"] : "#CDCDCD";
            $this->options["dialog_text_color"] = isset($_POST[$this->tabKey]["dialog_text_color"]) ? $_POST[$this->tabKey]["dialog_text_color"] : "#666666";
            $this->options["dialog_bg_color"] = isset($_POST[$this->tabKey]["dialog_bg_color"]) ? $_POST[$this->tabKey]["dialog_bg_color"] : "#FFFFFF";
            $this->options["dialog_hover_color"] = isset($_POST[$this->tabKey]["dialog_hover_color"]) ? $_POST[$this->tabKey]["dialog_hover_color"] : "#EEEEEE";
            $this->options["pagination_text_color"] = isset($_POST[$this->tabKey]["pagination_text_color"]) ? $_POST[$this->tabKey]["pagination_text_color"] : "#666666";
            $this->options["pagination_item_bg_color"] = isset($_POST[$this->tabKey]["pagination_item_bg_color"]) ? $_POST[$this->tabKey]["pagination_item_bg_color"] : "#C4ECE4";
            $this->options["widget_post_letters_count"] = isset($_POST[$this->tabKey]["widget_post_letters_count"]) && ($v = absint($_POST[$this->tabKey]["widget_post_letters_count"])) ? $v : 60;
            $this->options["widget_post_title_color"] = isset($_POST[$this->tabKey]["widget_post_title_color"]) ? $_POST[$this->tabKey]["widget_post_title_color"] : "#00B490";
            $this->options["widget_post_content_color"] = isset($_POST[$this->tabKey]["widget_post_content_color"]) ? $_POST[$this->tabKey]["widget_post_content_color"] : "#686868";
            $this->options["widget_post_author_date_color"] = isset($_POST[$this->tabKey]["widget_post_author_date_color"]) ? $_POST[$this->tabKey]["widget_post_author_date_color"] : "#CCC";
            $this->options["widget_loadmore_bg"] = isset($_POST[$this->tabKey]["widget_loadmore_bg"]) ? $_POST[$this->tabKey]["widget_loadmore_bg"] : "#DAF3EE";
            $this->options["widget_loadmore_text"] = isset($_POST[$this->tabKey]["widget_loadmore_text"]) ? $_POST[$this->tabKey]["widget_loadmore_text"] : "#666666";
            $this->options["widget_loadmore_border"] = isset($_POST[$this->tabKey]["widget_loadmore_border"]) ? $_POST[$this->tabKey]["widget_loadmore_border"] : "#CCCCCC";
            $this->options["search_result_phrase"] = isset($_POST[$this->tabKey]["search_result_phrase"]) ? $_POST[$this->tabKey]["search_result_phrase"] : __("Search result", "wpdiscuz-search");
            $this->options["search_no_result_phrase"] = isset($_POST[$this->tabKey]["search_no_result_phrase"]) ? $_POST[$this->tabKey]["search_no_result_phrase"] : __("No comment found", "wpdiscuz-search");
            $this->options["search_placeholder"] = isset($_POST[$this->tabKey]["search_placeholder"]) ? $_POST[$this->tabKey]["search_placeholder"] : __("Comment search...", "wpdiscuz-search");
            $this->options["dialog_search_by_all"] = isset($_POST[$this->tabKey]["dialog_search_by_all"]) ? $_POST[$this->tabKey]["dialog_search_by_all"] : __("All", "wpdiscuz-search");
            $this->options["dialog_search_by_content"] = isset($_POST[$this->tabKey]["dialog_search_by_content"]) ? $_POST[$this->tabKey]["dialog_search_by_content"] : __("Content", "wpdiscuz-search");
            $this->options["dialog_search_by_author"] = isset($_POST[$this->tabKey]["dialog_search_by_author"]) ? $_POST[$this->tabKey]["dialog_search_by_author"] : __("Author", "wpdiscuz-search");
            $this->options["dialog_search_by_email"] = isset($_POST[$this->tabKey]["dialog_search_by_email"]) ? $_POST[$this->tabKey]["dialog_search_by_email"] : __("E-mail", "wpdiscuz-search");
            $this->options["dialog_search_by_custom_fields"] = isset($_POST[$this->tabKey]["dialog_search_by_custom_fields"]) ? $_POST[$this->tabKey]["dialog_search_by_custom_fields"] : __("Custom Fields", "wpdiscuz-search");

            update_option($this->optionName, $this->options);
            $this->savedOptions = get_option($this->optionName);
        }
    }

    public function initOption() {
        $this->savedOptions = get_option($this->optionName);
    }

    public function commentSearchDynamicStyles() {
        $wpdiscuz = wpDiscuz();
        $style = "<style>";
//        $style .= "#wpcomm .wc-footer-left .wc-cta-button a{color:" . $wpdiscuz->optionsSerialized->buttonColor["secondary_button_color"] . "}";
        $style .= "#wpcomm .wc-footer-left .wc-cta-button:hover a{color:#FFFFFF}";
        $style .= "#wpdiscuz-search-form .fas,.wpdiscuz-widget-search-form .fas{color:" . $this->savedOptions["search_icons_color"] . "}";
        $style .= "#wpdiscuz-search-form .wpdiscuz-comm-search{color:" . $this->savedOptions["search_text_color"] . "!important}";
        $style .= "#wpdiscuz-search-form .wpdiscuz-search-box{background-color:" . $this->savedOptions["search_bg_color"] . ";border:1px solid " . $this->savedOptions["search_box_border_color"] . "}";
        $style .= "#wpdiscuz-search-form .wpdiscuz-search-setting{border:1px solid" . $this->savedOptions["search_box_border_color"] . "}";
        $style .= ".wpdiscuz-search-setting .shearch-arrow{border-color: transparent transparent " . $this->savedOptions["search_box_border_color"] . "}";
        $style .= ".wpdiscuz-search-setting{background-color:" . $this->savedOptions["dialog_bg_color"] . "!important;}";
        $style .= ".wpdiscuz-search-setting .shearch-arrow-no-border{border-bottom: 9px solid " . $this->savedOptions["dialog_bg_color"] . "!important}";
        $style .= ".wpdiscuz-search-setting input{color:" . $this->savedOptions["dialog_text_color"] . " !important}";
        $style .= ".wc-thread-wrapper-search p.wpd-search-result-title{border-bottom:1px solid " . $this->savedOptions["search_box_border_color"] . "}";
        $style .= ".wpdiscuz-search-setting p:hover{background-color:" . $this->savedOptions["dialog_hover_color"] . "}";
        $style .= "#wpdiscuz-search-pagination .wpdiscuz-search-pagination-item{background-color:" . $this->savedOptions["pagination_item_bg_color"] . ";color:" . $this->savedOptions["pagination_text_color"] . "}";
        $style .= "#wpdiscuz-search-pagination .pagination-current-page{border:2px solid" . $this->savedOptions["pagination_text_color"] . "}";
        $style .= ".wpdiscuz-search-widget-loadmore{background-color:" . $this->savedOptions["widget_loadmore_bg"] . ";color:" . $this->savedOptions["widget_loadmore_text"] . ";border:1px solid" . $this->savedOptions["widget_loadmore_border"] . "}";
        $style .= ".wpdiscuz-searched-data{background-color:" . $this->savedOptions["searched_data_bg"] . "}";
        $style .= "</style>";
        echo $style;
    }

    public function addNewOptions($options) {
        update_option("wpdiscuz_search_version", $options);
        $this->initOption();
    }

    public function getAvailableFields() {
        return ["all", "content", "author", "email", "custom_fields"];
    }

    public function settingsArray($settings) {
        $settings["addons"][$this->tabKey] = [
            "title" => __("Comment Search", "wpdiscuz-search"),
            "title_original" => "Comment Search",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WPDS_DIR_PATH . "/options/option-html.php",
            "values" => $this,
            "options" => [
                "display_form_for_guests" => [
                    "label" => __("Display search form for guests", "wpdiscuz-search"),
                    "label_original" => "Display search form for guests",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "display_setting" => [
                    "label" => __("Display search setting button", "wpdiscuz-search"),
                    "label_original" => "Display search setting button",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_available_fields" => [
                    "label" => __("Search options", "wpdiscuz-search"),
                    "label_original" => "Search options",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_default_field" => [
                    "label" => __("Default search field", "wpdiscuz-search"),
                    "label_original" => "Default search field",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_text_min_length" => [
                    "label" => __("Search text min length", "wpdiscuz-search"),
                    "label_original" => "Search text min length",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "searched_data_bg" => [
                    "label" => __("Searched data background", "wpdiscuz-search"),
                    "label_original" => "Searched data background",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_icons_color" => [
                    "label" => __("Search icons color", "wpdiscuz-search"),
                    "label_original" => "Search icons color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_text_color" => [
                    "label" => __("Search form text color", "wpdiscuz-search"),
                    "label_original" => "Search form text color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_bg_color" => [
                    "label" => __("Search box background color", "wpdiscuz-search"),
                    "label_original" => "Search box background color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_box_border_color" => [
                    "label" => __("Search box border color", "wpdiscuz-search"),
                    "label_original" => "Search box border color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_text_color" => [
                    "label" => __("Dialog text color", "wpdiscuz-search"),
                    "label_original" => "Dialog text color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_bg_color" => [
                    "label" => __("Dialog background color", "wpdiscuz-search"),
                    "label_original" => "Dialog background color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_hover_color" => [
                    "label" => __("Dialog item hover color", "wpdiscuz-search"),
                    "label_original" => "Dialog item hover color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "pagination_text_color" => [
                    "label" => __("Pagination text color", "wpdiscuz-search"),
                    "label_original" => "Pagination text color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "pagination_item_bg_color" => [
                    "label" => __("Pagination item background color", "wpdiscuz-search"),
                    "label_original" => "Pagination item background color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpdiscuz_search_shortcode" => [
                    "label" => __("Shortcode", "wpdiscuz-search"),
                    "label_original" => "Shortcode",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_post_letters_count" => [
                    "label" => __("Comment letters count", "wpdiscuz-search"),
                    "label_original" => "Comment letters count",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_post_content_color" => [
                    "label" => __("Comment content color", "wpdiscuz-search"),
                    "label_original" => "Comment content color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_post_title_color" => [
                    "label" => __("Post title color", "wpdiscuz-search"),
                    "label_original" => "Post title color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_post_author_date_color" => [
                    "label" => __("Post author and date color", "wpdiscuz-search"),
                    "label_original" => "Post author and date color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_loadmore_bg" => [
                    "label" => __("Load more button background color", "wpdiscuz-search"),
                    "label_original" => "Load more button background color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_loadmore_text" => [
                    "label" => __("Load more button text color", "wpdiscuz-search"),
                    "label_original" => "Load more button text color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "widget_loadmore_border" => [
                    "label" => __("Load more button border color", "wpdiscuz-search"),
                    "label_original" => "Load more button border color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_result_phrase" => [
                    "label" => __("Search result", "wpdiscuz-search"),
                    "label_original" => "Search result",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_no_result_phrase" => [
                    "label" => __("No comment found", "wpdiscuz-search"),
                    "label_original" => "No comment found",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "search_placeholder" => [
                    "label" => __("Search form placeholder", "wpdiscuz-search"),
                    "label_original" => "Search form placeholder",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_search_by_all" => [
                    "label" => __("All", "wpdiscuz-search"),
                    "label_original" => "All",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_search_by_content" => [
                    "label" => __("Content", "wpdiscuz-search"),
                    "label_original" => "Content",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_search_by_author" => [
                    "label" => __("Author", "wpdiscuz-search"),
                    "label_original" => "Author",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_search_by_email" => [
                    "label" => __("E-mail", "wpdiscuz-search"),
                    "label_original" => "E-mail",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dialog_search_by_custom_fields" => [
                    "label" => __("Custom Fields", "wpdiscuz-search"),
                    "label_original" => "Custom Fields",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}
