<?php

defined("ABSPATH") or exit;

class TranslateAjax {

    private $apiType;
    private $keyValid;
    private $apiKey;
    private $bgColor;
    private $borderColor;
    private $lineColor;
    private $comment;
    private $commentId;
    private $commentContent;

    public function __construct($settings) {
        $this->apiType = isset($settings["api"]) ? $settings["api"] : "yandex";
        $this->keyValid = isset($settings["valid"]) ? $settings["valid"] : "0";
        $this->apiKey = isset($settings["key"]) ? $settings["key"] : "";
        $this->bgColor = isset($settings["trns_form_bg_color"]) ? $settings["trns_form_bg_color"] : "#FFFFFF";
        $this->borderColor = isset($settings["trns_form_border_color"]) ? $settings["trns_form_border_color"] : "#333333";
        $this->lineColor = isset($settings["trns_text_bottom_line_color"]) ? $settings["trns_text_bottom_line_color"] : "#CCCCCC";
    }

    public function actionKind() {
        $kind = isset($_POST["action_kind"]) ? $_POST["action_kind"] : wp_die(json_encode(["error" => "kind error"]));
        if ($kind == "set-key") {
            $this->setApiKey();
            return;
        }
        $this->commentId = isset($_POST["comm_id"]) ? $_POST["comm_id"] : wp_die(json_encode(["error" => "comment's id error"]));
        $comment = get_comment($this->commentId);
        $this->comment = $comment;
        $this->commentContent = $comment->comment_content;
        if ($kind == "detect-lang") {
            $this->detectCommLang();
        } elseif ($kind == "trns-comm") {
            $this->TrnsComment();
        }
    }

    private function setApiKey() {
        $apiType = isset($_POST["trns_api_type"]) ? $_POST["trns_api_type"] : wp_die(json_encode(["valid" => "0", "error" => "API type error"]));
        $key = isset($_POST["trns_api_key"]) ? trim($_POST["trns_api_key"]) : wp_die(json_encode(["valid" => "0", "error" => "API key error"]));
        $url = $apiType == "google" ? "https://www.googleapis.com/language/translate/v2/detect?q=testing&key=" . $key : "https://translate.yandex.net/api/v1.5/tr.json/detect?text=testing&key=" . $key;

        $response = wp_remote_get($url);
        if (is_array($response)) {
            $response_body = json_decode($response["body"]);
            $valid = ($apiType == "google" && $response_body->data->detections[0]) || ($apiType == "yandex" && $response_body->code == "200") ? "1" : "0";
        } else {
            wp_die(json_encode(["valid" => "0", "error" => "Respons error"]));
        }
        $options_arr = [
            "api" => $apiType,
            "valid" => $valid,
            "key" => $key,
            "trns_form_bg_color" => $this->bgColor,
            "trns_form_border_color" => $this->borderColor,
            "trns_text_bottom_line_color" => $this->lineColor
        ];
        update_option("translate_settings", $options_arr);
        wp_die(json_encode(["valid" => $valid]));
    }

    private function detectCommLang() {
        if ($this->commentContent) {
            $lang = get_comment_meta($this->commentId, "_comment_leng", true);
            if ($lang && $lang !== "") {
                wp_die(json_encode(["lang" => $lang]));
            }
            $short_text = substr(preg_replace("#(:[^:]+:)#is", "$1", $this->commentContent), 0, 200);
            if ($this->apiType == "google") {
                $data = ["key" => $this->apiKey, "q" => $short_text];
                $data_string = http_build_query($data);
                $url = "https://www.googleapis.com/language/translate/v2/detect?" . $data_string;

                $response = wp_remote_get($url);
                if (is_array($response)) {
                    $response_body = json_decode($response["body"]);
                    update_comment_meta($this->commentId, "_comment_leng", $response_body->data->detections[0][0]->language);
                    wp_die(json_encode(["lang" => $response_body->data->detections[0][0]->language]));
                } else {
                    wp_die(json_encode(["error" => "Respons error"]));
                }
            }
            if ($this->apiType == "yandex") {
                $data = ["key" => $this->apiKey, "text" => $short_text];
                $data_string = http_build_query($data);
                $url = "https://translate.yandex.net/api/v1.5/tr.json/detect?" . $data_string;

                $response = wp_remote_get($url);
                if (is_array($response)) {
                    $response_body = json_decode($response["body"]);
                    if ($response_body->lang == "") {
                        wp_die(json_encode(["lang" => "und"]));
                    }
                    update_comment_meta($this->commentId, "_comment_leng", $response_body->lang);
                    wp_die(json_encode(["lang" => $response_body->lang]));
                } else {
                    wp_die(json_encode(["error" => "Respons error"]));
                }
            }
        } else {
            wp_die(json_encode(["error" => "comment error"]));
        }
    }

    private function TrnsComment() {
        if ($this->commentContent) {
            $lang_from = isset($_POST["lang_from"]) ? $_POST["lang_from"] : wp_die(json_encode(["error" => "lang_from error"]));
            $lang_to = isset($_POST["lang_to"]) ? $_POST["lang_to"] : wp_die(json_encode(["error" => "lang_to error"]));
            $trns_comment = get_comment_meta($this->commentId, "_comment_trns_" . $lang_to, true);
            if ($trns_comment && $trns_comment !== "") {
                wp_die(json_encode(["trnsComment" => $trns_comment]));
            }
            $this->commentContent = apply_filters("comment_text", $this->commentContent, $this->comment, []);
            if ($this->apiType == "google") {
                $data = ["key" => $this->apiKey, "q" => $this->commentContent, "source" => $lang_from, "target" => $lang_to];
                $data_string = http_build_query($data);
                $url = "https://www.googleapis.com/language/translate/v2?" . $data_string;

                $response = wp_remote_get($url);
                if (is_array($response)) {
                    $response_body = json_decode($response["body"]);
                    update_comment_meta($this->commentId, "_comment_trns_" . $lang_to, $response_body->data->translations[0]->translatedText);
                    wp_die(json_encode(["trnsComment" => $response_body->data->translations[0]->translatedText]));
                } else {
                    wp_die(json_encode(["error" => "Respons error"]));
                }
            }
            if ($this->apiType == "yandex") {
                $data = ["key" => $this->apiKey, "text" => $this->commentContent, "lang" => $lang_from . "-" . $lang_to, "format" => "html"];
                $data_string = http_build_query($data);
                $url = "https://translate.yandex.net/api/v1.5/tr.json/translate?" . $data_string;

                $response = wp_remote_get($url);
                if (is_array($response)) {
                    $response_body = json_decode($response["body"]);
                    update_comment_meta($this->commentId, "_comment_trns_" . $lang_to, $response_body->text[0]);
                    wp_die(json_encode(["trnsComment" => $response_body->text[0]]));
                } else {
                    wp_die(json_encode(["error" => "Respons error"]));
                }
            }
        } else {
            wp_die(json_encode(["error" => "comment error"]));
        }
    }

}
