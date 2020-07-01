<?php

defined("ABSPATH") or exit;

class TrnsCommentOption {

    public $apiType;
    public $keyValid;
    public $apiKey;
    public $bgColor;
    public $borderColor;
    public $lineColor;
    public $langList;
    public $tabKey = "trns";

    public function getTrnsSettings() {
        $settings = get_option("translate_settings");
        $this->apiType = isset($settings["api"]) ? $settings["api"] : "yandex";
        $this->keyValid = isset($settings["valid"]) ? $settings["valid"] : "0";
        $this->apiKey = isset($settings["key"]) ? $settings["key"] : "";
        $this->bgColor = isset($settings["trns_form_bg_color"]) ? $settings["trns_form_bg_color"] : "#FFFFFF";
        $this->borderColor = isset($settings["trns_form_border_color"]) ? $settings["trns_form_border_color"] : "#333333";
        $this->lineColor = isset($settings["trns_text_bottom_line_color"]) ? $settings["trns_text_bottom_line_color"] : "#CCCCCC";
        $this->langList = langList($this->apiType);
    }

    public function translateSaveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->getTrnsSettings();

            $options_arr = [
                "api" => $this->apiType,
                "valid" => $this->keyValid,
                "key" => $this->apiKey,
                "trns_form_bg_color" => $_POST[$this->tabKey]["trns_form_bg_color"] ? $_POST[$this->tabKey]["trns_form_bg_color"] : "#FFFFFF",
                "trns_form_border_color" => $_POST[$this->tabKey]["trns_form_border_color"] ? $_POST[$this->tabKey]["trns_form_border_color"] : "#333333",
                "trns_text_bottom_line_color" => $_POST[$this->tabKey]["trns_text_bottom_line_color"] ? $_POST[$this->tabKey]["trns_text_bottom_line_color"] : "#CCCCCC"
            ];
            update_option("translate_settings", $options_arr);

            $phrases_arr = [
                "Translate" => $_POST[$this->tabKey]["tr_translate"] ? trim($_POST[$this->tabKey]["tr_translate"]) : "",
                "Show all" => $_POST[$this->tabKey]["tr_show_all"] ? trim($_POST[$this->tabKey]["tr_show_all"]) : "",
                "Show all languages" => $_POST[$this->tabKey]["tr_show_all_languages"] ? trim($_POST[$this->tabKey]["tr_show_all_languages"]) : "",
                "Original" => $_POST[$this->tabKey]["tr_original"] ? trim($_POST[$this->tabKey]["tr_original"]) : "",
                "Translate into" => $_POST[$this->tabKey]["tr_translate_into"] ? trim($_POST[$this->tabKey]["tr_translate_into"]) : "",
                "Can't translate" => $_POST[$this->tabKey]["tr_cant_translate"] ? trim($_POST[$this->tabKey]["tr_cant_translate"]) : "",
                "Can't translate this comment" => $_POST[$this->tabKey]["tr_cant_translate_the_comment"] ? trim($_POST[$this->tabKey]["tr_cant_translate_the_comment"]) : "",
                "The original coment in" => $_POST[$this->tabKey]["tr_the_original_comment_in"] ? trim($_POST[$this->tabKey]["tr_the_original_comment_in"]) : ""
            ];
            $phrases_arr = array_diff($phrases_arr, [""]);
            update_option("translate_phrases", $phrases_arr);
        }
    }

    public function resetOptions($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            $this->getTrnsSettings();
            $options = ["api" => $this->apiType, "valid" => $this->keyValid, "key" => $this->apiKey];
            update_option("translate_settings", $options);
            delete_option("translate_phrases");
        }
    }

    public function settingsArray($settings) {
        $verify = isset($_GET["_trns_nonce"]) ? wp_verify_nonce($_GET["_trns_nonce"], "trns-nonce") : false;
        $trns_options = isset($_GET["trns_options"]) ? $_GET["trns_options"] : null;
        if ($verify && $trns_options === "empty_database") {
            global $wpdb;
            $wpdb->query("DELETE FROM {$wpdb->commentmeta} WHERE `meta_key` = '_comment_leng' OR `meta_key` LIKE '_comment_trns_%'");
        }
        $this->getTrnsSettings();
        $settings["addons"][$this->tabKey] = [
            "title" => __("Translation", "wpdiscuz-translate"),
            "title_original" => "Translation",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WPDISCUZ_TRNS_PATH . "/options/html-options.php",
            "values" => $this,
            "options" => [
                "trns_form_bg_color" => [
                    "label" => __("Translation Form Background Color", "wpdiscuz-translate"),
                    "label_original" => "Translation Form Background Color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "trns_form_border_color" => [
                    "label" => __("Translation Form Border Color", "wpdiscuz-translate"),
                    "label_original" => "Translation Form Border Color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "trns_text_bottom_line_color" => [
                    "label" => __("Translation Languages' Bottom Line Color", "wpdiscuz-translate"),
                    "label_original" => "Translation Languages' Bottom Line Color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_translate" => [
                    "label" => __("Translate", "wpdiscuz-translate"),
                    "label_original" => "Translate",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_show_all" => [
                    "label" => __("Show all", "wpdiscuz-translate"),
                    "label_original" => "Show all",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_show_all_languages" => [
                    "label" => __("Show all languages", "wpdiscuz-translate"),
                    "label_original" => "Show all languages",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_original" => [
                    "label" => __("Original", "wpdiscuz-translate"),
                    "label_original" => "Original",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_translate_into" => [
                    "label" => __("Translate into", "wpdiscuz-translate"),
                    "label_original" => "Translate into",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_cant_translate" => [
                    "label" => __("Can't translate", "wpdiscuz-translate"),
                    "label_original" => "Can't translate",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_cant_translate_the_comment" => [
                    "label" => __("Can't translate this comment", "wpdiscuz-translate"),
                    "label_original" => "Can't translate this comment",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "tr_the_original_comment_in" => [
                    "label" => __("The original comment in", "wpdiscuz-translate"),
                    "label_original" => "The original comment in",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "empty_database" => [
                    "label" => __("Remove All Translated Comments", "wpdiscuz-translate"),
                    "label_original" => "Remove All Translated Comments",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}
