<?php

defined("ABSPATH") or exit;

class CommentTrns {

    private $apiType;
    private $keyValid;
    private $apiKey;
    private $bgColor;
    private $borderColor;
    private $lineColor;
    private $langList;

    public function __construct($settings) {
        $this->apiType = isset($settings["api"]) ? $settings["api"] : "yandex";
        $this->keyValid = isset($settings["valid"]) ? $settings["valid"] : "0";
        $this->apiKey = isset($settings["key"]) ? $settings["key"] : "";
        $this->bgColor = isset($settings["trns_form_bg_color"]) ? $settings["trns_form_bg_color"] : "#FFFFFF";
        $this->borderColor = isset($settings["trns_form_border_color"]) ? $settings["trns_form_border_color"] : "#333333";
        $this->lineColor = isset($settings["trns_text_bottom_line_color"]) ? $settings["trns_text_bottom_line_color"] : "#CCCCCC";
        $this->langList = langList($this->apiType);
    }

    public function dynamicStyles($options) {
//        $style = ".trns-lang{color:" . $options->buttonColor["secondary_button_color"] . ";}"
        $style = ".trns-lang:hover{color:" . $options->thread_styles["primaryColor"] . ";}"
//                . ".show-all-langs{color:" . $options->buttonColor["secondary_button_color"] . ";}"
                . ".show-all-langs:hover{color:" . $options->thread_styles["primaryColor"] . ";}"
//                . ".single-trns-lang{color:" . $options->buttonColor["secondary_button_color"] . ";}"
//                . ".single-trns-lang:hover{color:" . $options->buttonColor["secondary_button_color"] . ";}"
//                . ".original-text, .trns-moderate-comment{color:" . $options->buttonColor["secondary_button_color"] . ";}"
                . "#wpcomm .trns-moderate-comments .lang-board{background-color:" . $this->bgColor . ";border:1px solid " . $this->borderColor . ";}"
                . "#wpcomm .trns-moderate-comments .trns-arrow{border-bottom: 9px solid " . $this->borderColor . ";}"
                . "#wpcomm .trns-moderate-comments .trns-arrow-no-border{border-bottom:9px solid " . $this->bgColor . ";}"
                . ".translate-buttons span{border-bottom:1px solid " . $this->lineColor . ";font-size:" . $options->thread_styles["commentTextSize"] . " !important;}"
                . ".all-lang-content{background-color:" . $this->bgColor . ";border:1px solid " . $this->borderColor . ";border-top:none;}"
//                . ".trns-into{border:1px solid " . $this->borderColor . ";border-bottom:none;background-color:" . $this->bgColor . ";color:" . $options->buttonColor["secondary_button_color"] . ";}"
                . ".trns-into-cc{border-bottom: 1px solid " . $this->lineColor . ";}"
                . ".trns-into-cl > font{color:" . $options->thread_styles["primaryColor"] . ";}"
                . ".trns-lang-all{border-left:1px solid " . $this->lineColor . ";}"
                . "html[dir=rtl] .trns-lang-all{border-left: none;border-right:1px solid " . $this->lineColor . ";}";

        echo $style;
    }

    public function addTranslateButton($output, $comment, $user, $current_user) {
        $primary_langs = [];

        if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            $accept_lang = " " . $_SERVER["HTTP_ACCEPT_LANGUAGE"];
            preg_match_all("#([a-z]{2,3})#s", $accept_lang, $match);
            $langs = array_unique($match[1]);
            foreach ($this->langList as $lang_kay => $lang_val) {
                if (in_array($lang_kay, $langs)) {
                    $primary_langs[$lang_kay] = $lang_val;
                }
            }
        }
        $output .= "<div class='trns-moderate-comments' id='mod-" . esc_attr($comment->comment_ID) . "'>"
                . "<span data-lang='none' class='trns-moderate-comment wc-cta-button' id='trns-" . esc_attr($comment->comment_ID) . "'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none'/><path d='M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z'/></svg> " . wpd_trns_phrases("Translate") . "</span>"
                . "<div class='lang-board' style='display: none;'>"
                . "<span class='trns-arrow'></span>"
                . "<span class='trns-arrow-no-border'></span>"
                . "<div class='translate-buttons'>";
        foreach ($primary_langs as $kay => $language) {
            $output .= "<span class='trns-lang trns-primary'  id='" . esc_attr($kay) . "-" . esc_attr($comment->comment_ID) . "'>" . esc_attr($language) . "</span>";
        }
        if (isset($_COOKIE["translateLanguage"]) && isset($this->langList[$_COOKIE["translateLanguage"]])) {
            $temp_kay = $_COOKIE["translateLanguage"];
            $output .= "<span class='trns-lang trns-temporary'  id='" . esc_attr($temp_kay) . "-" . esc_attr($comment->comment_ID) . "'>" . esc_attr($this->langList[$temp_kay]) . "</span>";
        }
        $output .= "<span class='show-all-langs' id='all-" . esc_attr($comment->comment_ID) . "' title='" . wpd_trns_phrases("Show all languages") . "' >" . esc_html(wpd_trns_phrases("Show all")) . "</span>"
                . "</div></div></div>"
                . "<span class='original-text wc-cta-button' id='orig-" . esc_attr($comment->comment_ID) . "' style='display: none;'><svg xmlns='https://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24'><path d='M0 0h24v24H0z' fill='none'/><path d='M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z'/></svg> " . esc_html(wpd_trns_phrases("Original")) . "</span>";

        return $output;
    }

    public function allLangList() {
        global $post;
        $wpdiscuz = wpDiscuz();
        if ($wpdiscuz->helper->isLoadWpdiscuz($post)) {
            $lang_board = "<div class='all-lang-board' style='display:none;'>"
                    . "<div class='trns-into'>"
                    . "<span class='trns-into-cc'><span class='trns-into-cl'> " . esc_html(wpd_trns_phrases("Translate into")) . " <font> </font></span>"
                    . "<span class='trns-into-cr'><i class='fas fa-times'></i>"
                    . "</span></span></div>"
                    . "<div class='all-lang-content'>"
                    . "<div class='translate-buttons-all'>";
            foreach ($this->langList as $kay => $language) {
                $lang_board .= "<span class='trns-lang trns-lang-all trns-" . esc_attr($kay) . "' id='" . esc_attr($kay) . "'>" . esc_html($language) . "</span>";
            }
            $lang_board .= "</div></div></div>";

            echo $lang_board;
        }
    }

    public function deleteCommentMeta($response) {
        global $wpdb;
        $comment_id = isset($_POST["commentId"]) ? intval($_POST["commentId"]) : 0;
        $wpdb->query("DELETE FROM {$wpdb->commentmeta} WHERE (`meta_key` = '_comment_leng' OR `meta_key` LIKE '_comment_trns_%') AND `comment_id` = '$comment_id'");
        return $response;
    }

}
