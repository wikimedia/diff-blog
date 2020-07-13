<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzSearchWidgetWalker extends Walker_Comment {

    private $options;
    private $search_data;
    private $display_avatar;

    public function __construct($options, $search_data, $display_avatar) {
        $this->options = $options;
        $this->search_data = $search_data;
        $this->display_avatar = $display_avatar;
    }

    public function start_el(&$output, $comment, $depth = 0, $args = [], $id = 0) {
        $depth++;
        $GLOBALS["comment_depth"] = $depth;
        $GLOBALS["comment"] = $comment;
        $post_info = get_post(intval($comment->comment_post_ID));
        $user_info = get_userdata(intval($comment->user_id));
        $output .= "<div class='wpdiscuz-comm-search-all-item clearfix'>";
        if ($this->display_avatar == "on") {
            $user_avatar_url = get_avatar_url(intval($comment->user_id), [
                "size" => 50,
                "default" => "mystery"
            ]);
            $output .= "<div class='wpdiscuz-comm-search-all-avatar'>";
            $output .= "<img src='" . $user_avatar_url . "' alt='" . (isset($user_info->display_name) ? $user_info->display_name : "guest") . "' />";
            $output .= "</div>";
        }
        $output .= "<div>";
        $output .= "<a class='wpdscuz-comm-search-all-post-title' target='_blank' href='" . get_comment_link($comment->comment_ID) . "'>";
        $output .= "<b style='color:" . (isset($this->options->savedOptions["widget_post_title_color"]) ? $this->options->savedOptions["widget_post_title_color"] : "#00B490") . "' class='widget-post-title'> " . $post_info->post_title . "</b>";
        $output .= "</a>";
        $output .= "<p style='color:" . (isset($this->options->savedOptions["widget_post_author_date_color"]) ? $this->options->savedOptions["widget_post_author_date_color"] : "#CCC") . "'  class='widget-post-author-date'>";
        $output .= (isset($user_info->display_name) ? $user_info->display_name : "Guest") . ", " . substr($comment->comment_date, 0, 10) . "</p>";
        $output .= "<div style='color:" . (isset($this->options->savedOptions["widget_post_content_color"]) ? $this->options->savedOptions["widget_post_content_color"] : "#686868") . ";word-wrap:break-word;' class='widget-post-content'>";
        $comment->comment_content = apply_filters("comment_text", $comment->comment_content, $comment, []);
        $comment->comment_content = preg_replace("~\[[^\]]+\]~s", "", $comment->comment_content);
        $comment->comment_content = strip_tags($comment->comment_content);
        if (strlen($comment->comment_content) > $this->options->savedOptions["widget_post_letters_count"]) {
            $output .= $this->convertPrintData(substr($comment->comment_content, 0, $this->options->savedOptions["widget_post_letters_count"]) . "...");
        } else {
            $output .= $this->convertPrintData($comment->comment_content);
        }
        $output .= "</div>";
        $output .= "</div>";
    }

    public function end_el(&$output, $comment, $depth = 0, $args = []) {
        $output .= "</div>";
        return $output;
    }

    public function convertPrintData($text) {
        $output = "";
        if ($text && $this->search_data) {
            $textarr = preg_split('/(<.*>)/U', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
            $stop = count($textarr);
            $tags_to_ignore = "";
            $ignore_block_element = "";

            for ($i = 0; $i < $stop; $i++) {
                $content = $textarr[$i];
                if ("" == $ignore_block_element && preg_match('/^<(' . $tags_to_ignore . ')>/', $content, $matches)) {
                    $ignore_block_element = $matches[1];
                }
                if ("" == $ignore_block_element && strlen($content) > 0 && "<" != $content[0]) {
                    $pattern = preg_quote($this->search_data);
                    $content = preg_replace("#($pattern)#is", "<span class='wpdiscuz-searched-data'>$1</span>", $content);
                }
                if ("" != $ignore_block_element && "</" . $ignore_block_element . ">" == $content) {
                    $ignore_block_element = "";
                }

                $output .= $content . " ";
            }
        } else {
            $output = $text;
        }
        return $output;
    }

}
