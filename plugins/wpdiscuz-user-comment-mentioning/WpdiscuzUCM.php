<?php
/*
 * Plugin Name: wpDiscuz - User & Comment Mentioning
 * Description: Allows to mention certain comments and users in comment text using #comment-id and @username tags.
 * Version: 7.0.4
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/product/wpdiscuz-user-comment-mentioning/
 * Text Domain: wpdiscuz_ucm
 * Domain Path: /languages/
 */

if (!defined("ABSPATH")) {
    exit();
}

define("WUCM_DIR_PATH", dirname(__FILE__));

include_once WUCM_DIR_PATH . "/WpdiscuzUCMOption.php";
include_once WUCM_DIR_PATH . "/includes/gvt-api-manager.php";

class WpdiscuzUCM {

    private $comment_author;
    public $option;
    public $pVersion;
    private static $instance;
    private $userList = [];

    private function __construct() {
        add_action("plugins_loaded", [&$this, "loaded"], 120);
    }

    function loaded() {
        if (function_exists("wpDiscuz")) {
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            $this->option = new WpdiscuzUCMOption();
            $this->pVersion = get_option($this->option->versionSlug);
            if (!$this->pVersion) {
                $this->pVersion = "1.0.0";
            }
            add_action("wpdiscuz_front_scripts", [$this, "frontEndStylesScripts"], 211);
            add_action("admin_enqueue_scripts", [$this, "admin_style_basic"]);
            add_action("wp_ajax_get_all_users", [&$this, "search_users"]);
            add_action("wp_ajax_nopriv_get_all_users", [&$this, "search_users"]);
            add_action("wp_ajax_get_all_users_post", [&$this, "get_users_in_post"]);
            add_action("wp_ajax_nopriv_get_all_users_post", [&$this, "get_users_in_post"]);
            add_action("wp_ajax_get_user", [&$this, "get_user"]);
            add_action("wp_ajax_nopriv_get_user", [&$this, "get_user"]);
            add_action("wp_ajax_nopriv_get_comment_info", [&$this, "get_comment_info"]);
            add_action("wp_ajax_get_comment_info", [&$this, "get_comment_info"]);
            add_action("wp_insert_comment", [&$this, "inserted_comment"], 205, 2);
            add_filter("comment_text", [&$this, "replace_users"], 200, 2);
            add_filter("comment_text", [&$this, "replace_comment_id"], 13, 2);
            add_filter("transition_comment_status", [&$this, "approved_comment"], 45.5, 3);
            add_filter("wpdiscuz_comment_link_img", [&$this, "view_comment_id"], 250, 2);
            add_action("wpdiscuz_save_options", [&$this->option, "saveOptions"]);
            add_action("wpdiscuz_reset_options", [&$this->option, "resetOptions"]);
            add_filter("wpdiscuz_settings", [&$this->option, "settingsArray"]);
            add_filter("wpdiscuz_js_options", [&$this->option, "addJSOptions"]);
            add_filter("wpdiscuz_enable_user_mentioning", "__return_false");
            add_action("wpdiscuz_editor_modules", [&$this, "addMentionModule"]);
            add_filter("wpdiscuz_after_comment_author", [&$this, "userNicename"], 1, 3);
            load_plugin_textdomain("wpdiscuz_ucm", false, dirname(plugin_basename(__FILE__)) . "/languages/");
        } else {
            add_action("admin_notices", [&$this, "ucmRequirements"], 1);
        }
    }

    public function ucmRequirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz User & Comment Mentioning requires wpDiscuz to be installed!", "wpdiscuz_ucm") . "</p></div>";
        }
    }

    public function view_comment_id($commentLinkImg, $comment) {
        if ($this->option->enableCommentMentioning) {
            $commentLink = get_comment_link($comment);
            $commentLinkImg = "<span wpd-tooltip='" . __("Comment Link", "wpdiscuz") . "' data-comment-url='" . $commentLink . "'>#" . $comment->comment_ID . "</span>";
        }
        return $commentLinkImg;
    }

    public function replace_users($text, $comment) {
        $users_comm = $this->getUsersInComment($text);
        if ($users_comm) {
            foreach ($users_comm as $com_user) {
                if ($com_user["u_id"] == 0) {
                    $guestAvatar = $this->option->viewAvatarInComment ? get_avatar($com_user["email"], 30) : "";
                    $html = "<a class='wpd-umcguest'  href='" . get_comment_link($com_user["comment_id"]) . "'>" . $guestAvatar . $com_user["display_name"] . "</a>";
                    $text = str_replace($com_user["nik_name"], $html, $text);
                } else {
                    $viewin = $this->option->viewID ? $com_user["u_id"] : $com_user["nik_name"];
                    $link_user = $this->author_link($com_user["u_id"], $viewin);
                    if (class_exists("BuddyPress") && $com_user["u_id"]) {
                        $bp_user_url = bp_core_get_user_domain($com_user["u_id"]);
                        $text = preg_replace('|<a[^><]*class\=[\'\"]+bp\-suggestions\-mention[\'\"]+[^><]*>(\@.+?)<\/a>|is', " $1 ", $text);
                        $text = preg_replace('|<a[^>]+href=[\'\"]' . addcslashes($bp_user_url, '\\') . '[\'\"][^>]*>(.*?)<\/a>|is', " $1 ", $text);
                    }
                    $text = preg_replace('|<a[<]*>(.+?)<\/a>|is', " $1 ", $text);
                    $text = preg_replace("/(" . $com_user["nik_name"] . ")([\s\n\r\t\@\,\.\!\?\#\$\%\-\:\;\'\"\`\~\)\(\}\{\|\\\[\]]?)/", $link_user . "$2", $text);
                    $text = preg_replace("/^(" . $com_user["nik_name"] . ")/", $link_user, $text);
                    $text = preg_replace("/(" . $com_user["nik_name"] . ")$/", $link_user, $text);
                }
            }
        }
        return $text;
    }

    public function replace_comment_id($text, $comment) {
        if ($this->option->enableCommentMentioning) {
            $ids_comm = $this->getComment_ID_In_Comment($text);
            if ($ids_comm) {
                foreach ($ids_comm as $id_comm) {
                    $id_comm = trim($id_comm, "# ");
                    $comment_obj = get_comment($id_comm);
                    if ($comment_obj && $comment_obj->comment_ID) {
                        $_link = "<a href='" . esc_url(get_comment_link($comment_obj)) . "'  class='ucm-comment-id'>#" . $comment_obj->comment_ID . " </a>";
                        $text = preg_replace("/#({$comment_obj->comment_ID})([\s\n\r\t\w+\@\,\.\!\?\#\$\%\-\:\;\'\"\`\~\)\(\}\{\|\\\[\]]?)/", $_link . "$2", $text);
                        $text = preg_replace("/^#({$comment_obj->comment_ID})/", $_link, $text);
                        $text = preg_replace("/#({$comment_obj->comment_ID})$/", $_link, $text);
                    }
                }
            }
        }
        return $text;
    }

    public function get_users_in_post() {
        global $wpdb;
        $users = [];
        $postID = filter_input(INPUT_POST, "wcm_post_id", FILTER_SANITIZE_NUMBER_INT);
        if ($postID) {
            $sql = $wpdb->prepare("SELECT `user_id` FROM {$wpdb->comments} WHERE comment_post_ID = %d AND  user_id!=0 GROUP BY user_id LIMIT %d", $postID, $this->option->userListCount);
            $results = $wpdb->get_results($sql);
            foreach ($results as $val) {
                $userData = get_user_by("ID", $val->user_id);
                if ($userData) {
                    $user = new stdClass();
                    $user->ID = $userData->ID;
                    $user->display_name = $userData->display_name;
                    $user->user_nicename = $userData->user_nicename;
                    $user->avatar = $this->option->viewAvatarInTooltip ? "<div class='ucm-avatar'>" . get_avatar($val->user_id, 30) . "</div>" : "";
                    $users[] = $user;
                }
            }
            $users = apply_filters("wpdumc_user_search_result", $users, $postID, "");
            wp_die(json_encode($users));
        }
    }

    public function get_user() {
        global $wpdb;
        $user_data = [];
        if (isset($_POST["wcm_user_id"])) {
            $user_id = wp_slash(esc_attr($_POST["wcm_user_id"]));
            if ($user_id) {
                $user_info = get_userdata($user_id);
                $comment_count_sql = "SELECT count(`user_id`) as comment_count FROM $wpdb->comments WHERE user_id='$user_id'";
                $comment_count = $wpdb->get_results($comment_count_sql);
                if (strlen($user_info->display_name) > 15) {
                    $user_data["user_name"] = substr($user_info->display_name, 0, 15) . "...";
                } else {
                    $user_data["user_name"] = $user_info->display_name;
                }
                $user_data["avatar"] = $this->option->viewAvatarInTooltip ? "<div class='ucm-avatar'>" . get_avatar($user_id, 300) . "</div>" : "";
                $user_data["comment_count"] = $comment_count[0]->comment_count ? $comment_count[0]->comment_count : 0;
                $user_data["post_count"] = count_user_posts($user_id);
                if (strlen($user_info->description) > $this->option->textLength) {
                    $user_data["description"] = substr($user_info->description, 0, $this->option->textLength) . "...";
                } else {
                    $user_data["description"] = $user_info->description;
                }

                if (!empty($user_data)) {
                    wp_die(json_encode($user_data));
                } else {
                    $user_data["error"] = __("User not found", "wpdiscuz_ucm");
                }
            } else {
                $user_data["error"] = __("User not found", "wpdiscuz_ucm");
            }
        } else {
            $user_data["error"] = __("User not found", "wpdiscuz_ucm");
        }
        wp_die(json_encode($user_data));
    }

    public function get_comment_info() {
        $comment_data = [];
        if (isset($_POST["wcm_comment_id"])) {
            $comment_id = wp_slash(esc_attr(trim(ltrim($_POST["wcm_comment_id"], "#"))));
            $comment = get_comment($comment_id);
            $comment_data = $this->buildCommentInfo($comment);
        } else {
            $comment_data["error"] = __("Comment not found", "wpdiscuz_ucm");
        }
        wp_die(json_encode($comment_data));
    }

    private function buildCommentInfo($comment) {
        global $wpdb;
        $comment_data = [];
        $userNik = $comment->comment_author;
        $userEmail = $comment->comment_author_email;
        $commentContent = $comment->comment_content;
        if ($userNik && $userEmail) {
            $comment_count_sql = $wpdb->prepare("SELECT count(*) as comment_count FROM {$wpdb->comments} WHERE `comment_author_email`=%s", $userEmail);
            $comment_count = $wpdb->get_var($comment_count_sql);
            if (function_exists("mb_strlen") && function_exists("mb_substr")) {
                if (mb_strlen($userNik) > 30) {
                    $userNik = mb_substr($userNik, 0, 29) . "...";
                }
                if (mb_strlen($commentContent) > $this->option->textLength) {
                    $commentContent = mb_substr($commentContent, 0, $this->option->textLength) . "...";
                }
            } else {
                if (strlen($userNik) > 30) {
                    $userNik = substr($userNik, 0, 29) . "...";
                }
                if (strlen($commentContent) > $this->option->textLength) {
                    $commentContent = substr($commentContent, 0, $this->option->textLength) . "...";
                }
            }
            $comment_data["user_name"] = $userNik;
            $comment_data["avatar"] = $this->option->viewAvatarInTooltip ? "<div class='ucm-avatar'>" . get_avatar($userEmail, 301) . "</div>" : "";
            $comment_data["comment"] = $commentContent;

            wp_die(json_encode($comment_data));
        } else {
            $comment_data["error"] = __("undefind comment", "wpdiscuz_ucm");
        }
        return $comment_data;
    }

    public function search_users() {
        $ch_user = filter_input(INPUT_POST, "key_name", FILTER_SANITIZE_STRING);
        $postID = filter_input(INPUT_POST, "post_id", FILTER_SANITIZE_NUMBER_INT);
        if ($ch_user) {
            $args = ["fields" => ["ID", "display_name", "user_nicename"], "search" => "*" . $ch_user . "*", "number" => $this->option->userListCount];
        } else {
            $args = ["fields" => ["ID", "display_name", "user_nicename"], "number" => $this->option->userListCount];
        }
        $users = get_users($args);
        $this->getGuestUsersInPost($postID, $ch_user, $users);
        $users = apply_filters("wpdumc_user_search_result", $users, $postID, $ch_user);
        if (isset($users)) {
            foreach ($users as $key => $value) {
                if ($this->option->viewID) {
                    $users[$key]->value = $value->ID;
                    if ($value->ID == 0) {
                        $users[$key]->value = $value->user_nicename;
                    }
                } else {
                    $users[$key]->value = $value->user_nicename;
                }
                unset($users[$key]->user_nicename);
                if (strlen($users[$key]->display_name) > 30) {
                    $users[$key]->display_name = substr($users[$key]->display_name, 0, 29) . "...";
                }
                $id_or_emile = $value->ID ? $value->ID : $value->comment_author_email;
                $users[$key]->avatar = $this->option->viewAvatarInTooltip ? "<div class='ucm-avatar'>" . get_avatar($id_or_emile, 30) . "</div>" : "";
            }
            if ($users) {
                wp_die(json_encode($users));
            }
        }
    }

    private function getGuestUsersInPost($postID, $searchKey, &$users) {
        global $wpdb;
        $key = trim($searchKey);
        if ($postID && $key && $this->option->guestMentioning) {
            $key = $key . "%";
            $sql = $wpdb->prepare("SELECT 
                        0 AS `ID`,
                        CONCAT('guest_',`comment_ID`) AS `user_nicename`,
                        `comment_author` AS `display_name`,
                        `comment_author_email` 
                      FROM
                        {$wpdb->comments}
                        WHERE `comment_post_ID` = %d
                        AND `comment_author` LIKE %s
                        AND `user_id` = 0
                        AND `comment_approved` = '1'
                        GROUP BY `comment_author_email`
                        LIMIT  %d", $postID, $key, $this->option->userListCount);
            $guestUsers = $wpdb->get_results($sql);
            $users = array_merge($users, $guestUsers);
        }
    }

    public function author_link($user_id, $user_nik) {
        $link_user = "";
        $user_slug_or_id = trim($user_nik, "@");
        $user = get_user_by("slug", $user_slug_or_id);
        if (!$user) {
            $user = get_user_by("ID", $user_slug_or_id);
        }
        if ($user) {
            $avatar = "";
            if ($this->option->viewAvatarInComment) {
                $avatar = get_avatar($user_id, 30);
            }
            if (class_exists("BuddyPress")) {
                $link_user = bp_core_get_user_domain($user_id);
            } else if (class_exists("UM_API")) {
                um_fetch_user($user_id);
                $link_user = um_user_profile_url();
            } else if (count_user_posts($user_id)) {
                $link_user = get_author_posts_url($user_id);
            }

            if ($link_user) {
                $user_nik = "<a class='hint hint--right' data-ucm_user_id='" . $user_id . "' href='" . $link_user . "' rel='author external'>" . ($avatar ? $avatar . '&nbsp;' : '@') . $user->display_name . "</a>";
            } else {
                $user_nik = "<span class='hint hint--right' data-ucm_user_id='" . $user_id . "' >" . ($avatar ? $avatar . '&nbsp;' : '@') . $user->display_name . "</span>";
            }
        }
        return $user_nik;
    }

    public function frontEndStylesScripts($options) {
        wp_deregister_script('jquery-caret');
        wp_deregister_script('jquery-atwho');
        wp_deregister_script('bp-mentions');
        wp_deregister_script('bp-mentions');
        wp_deregister_style('bp-mentions-css');

        if (is_rtl()) {
            wp_register_style("wpdumc-styles-rtl", plugins_url("/css/style-rtl.css", __FILE__), [], $this->pVersion);
            wp_enqueue_style("wpdumc-styles-rtl");
        } else {
            wp_register_style("wpdumc-styles", plugins_url("/css/style.css", __FILE__), [], $this->pVersion);
            wp_enqueue_style("wpdumc-styles");
        }
        if ($options->form["richEditor"] === "both" || (!wp_is_mobile() && $options->form["richEditor"] === "desktop")) {
            $dep = $options->general["loadComboVersion"] ? "wpdiscuz-combo-js" : "wpd-editor";
            wp_register_script("quill-mention-js", plugins_url("/js/third-party/quill-mention/quill.mention.min.js", __FILE__), [$dep], $this->pVersion, true);
            wp_localize_script("quill-mention-js", "wpdUCMObj", ["is_rtl" => is_rtl()]);
            wp_enqueue_script("quill-mention-js");
        }
        wp_register_script("wpdumc-script", plugins_url("/js/wpdiscuz-ucm.js", __FILE__), ["jquery"], $this->pVersion, true);
        wp_enqueue_script("wpdumc-script");
    }

    public function admin_style_basic() {
        if (isset($_GET["page"]) && isset($_GET["wpd_tab"]) && $_GET["page"] === WpdiscuzCore::PAGE_SETTINGS && $_GET["wpd_tab"] === $this->option->tabKey) {
            wp_register_style("wpdiscuz-ucm-css", plugin_dir_url(__FILE__) . "css/admin-ucm.css", null, $this->pVersion);
            wp_enqueue_style("wpdiscuz-ucm-css");
        }
    }

    public function getUsersInComment($comment) {
        global $wpdb;
        $data_uses = [];
        $text = preg_replace('|<a[^><]*>(.+?)<\/a>|is', " $1 ", $comment);
        preg_match_all("/(@[^<\s\,\@\.\!\?\#\$\%\:\;\'\"\`\~\)\(\}\{\|\\\[\]]*)/is", $text, $users_nik, PREG_PATTERN_ORDER);
        $users_nik = array_unique($users_nik[0]);
        if (!empty($users_nik)) {
            $coun = 0;
            foreach ($users_nik as $value) {
                $nik = trim(trim($value, "@"));
                $user_query = $wpdb->prepare("SELECT ID, user_email, display_name FROM " . $wpdb->users . " WHERE user_nicename=%s OR ID = %d LIMIT 1", $nik, intval($nik));
                $user_d = $wpdb->get_results($user_query);
                if ($user_d) {
                    $data_uses[$coun]["u_id"] = $user_d[0]->ID;
                    $data_uses[$coun]["email"] = $user_d[0]->user_email;
                    $data_uses[$coun]["display_name"] = $user_d[0]->display_name;
                    $data_uses[$coun]["nik_name"] = $value;
                    $coun++;
                }
            }
            if ($this->option->guestMentioning && preg_match_all('|@guest_([\d]+)|is', $comment, $matches, PREG_PATTERN_ORDER)) {
                $guestCommID = array_unique($matches[1]);
                foreach ($guestCommID as $commentID) {
                    $guestComment = get_comment($commentID);
                    if (!$guestComment) {
                        continue;
                    }
                    $data_uses[$coun]["u_id"] = 0;
                    $data_uses[$coun]["email"] = $guestComment->comment_author_email;
                    $data_uses[$coun]["display_name"] = $guestComment->comment_author;
                    $data_uses[$coun]["nik_name"] = "@guest_" . $commentID;
                    $data_uses[$coun]["comment_id"] = $commentID;
                    $coun++;
                }
            }
        }
        return apply_filters("wpdumc_mentioned_users", $data_uses, $comment);
    }

    public function getComment_ID_In_Comment($comment) {
        $comment_ids = [];
        $comment_un_ids = [];
        if (preg_match_all("/(?:^|[>\s\t])(\#\d+)(?:$|[<\s\t])/ium", $comment, $comment_ids, PREG_SET_ORDER)) {
            $comment_un_ids = array_unique($comment_ids[0]);
            rsort($comment_un_ids);
        }
        return $comment_un_ids;
    }

    public function getUsersList() {
        return $this->userList;
    }

    public function setUsersList($userList) {
        $this->userList = $userList;
    }

    public function getUserByCommentID($commentIds) {
        $userList = [];
        $count = 0;
        foreach ($commentIds as $comment_id) {
            $trimedComment = trim($comment_id, "#");
            $commentData = get_comment($trimedComment);
            $userList[$count]["display_name"] = $commentData->comment_author;
            $userList[$count]["email"] = $commentData->comment_author_email;
        }
        return $userList;
    }

    public function inserted_comment($id, $comment_data) {
        $userList = [];
        if ($this->option->enableCommentMentioning) {
            $comment_un_ids = $this->getComment_ID_In_Comment($comment_data->comment_content);
            $userList = $this->getUserByCommentID($comment_un_ids);
        }
        $this->comment_author["name"] = $comment_data->comment_author;
        $this->comment_author["email"] = $comment_data->comment_author_email;
        $post_title = get_the_title($comment_data->comment_post_ID);
        if ($comment_data->comment_approved === "1") {
            $users_data = $this->getUsersInComment($comment_data->comment_content);
            $this->sendMail($users_data, $userList, $this->comment_author, $post_title, $comment_data);
        }
    }

    public function approved_comment($newStatus, $oldStatus, $comment_data) {
        if ($newStatus != $oldStatus) {
            if ($newStatus == "approved") {
                $userList = $this->getUsersList();
                $this->comment_author["name"] = $comment_data->comment_author;
                $this->comment_author["email"] = $comment_data->comment_author_email;
                $post = get_the_title($comment_data->comment_post_ID);
                $users_data = $this->getUsersInComment($comment_data->comment_content);
                $this->sendMail($users_data, $userList, $this->comment_author, $post, $comment_data);
            }
        }
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new WpdiscuzUCM();
        }
        return self::$instance;
    }

    public function sendMail($users, $userList, $comment_author, $post_title, $comment_data) {
        $content_type = "text/html";
        $from_name = html_entity_decode(get_option("blogname"));
        $siteUrl = get_site_url();
        $parsedUrl = parse_url($siteUrl);
        $domain = isset($parsedUrl["host"]) ? WpdiscuzHelper::fixEmailFrom($parsedUrl["host"]) : "";
        $from_email = "no-reply@" . $domain;
        $headers[] = "Content-Type:  $content_type; charset=UTF-8";
        $headers[] = "From: " . $from_name . " <" . $from_email . "> \r\n";
        $comment_link = get_comment_link($comment_data->comment_ID);
        $comment_url = "<a href='" . $comment_link . "' target='_blank'>" . $comment_link . "</a>";
        if (!empty($comment_author) && !empty($userList) && $this->option->adminEmail) {
            $message_author = __($this->option->authorMailMessage, "wpdiscuz_ucm");
            $subject_author = __($this->option->authorMailSubject, "wpdiscuz_ucm");
            foreach ($userList as $value) {
                if ($value["email"] && $value["email"] != $comment_author["email"] && apply_filters("wpducm_mail_to_comment_author", true, $value, $comment_data)) {
                    $body_author = str_replace(["[mentionedUserName]", "[postTitle]", "[commentURL]", "[authorUserName]", "[commentContent]",], [$value["display_name"], $post_title, $comment_url, $comment_author["name"], wpautop($comment_data->comment_content),], $message_author);
                    wp_mail($value["email"], $subject_author, $body_author, $headers);
                }
            }
        }
        if ($users && $comment_author) {
            $message_user = __($this->option->userMailMessage, "wpdiscuz_ucm");
            $subject_user = __($this->option->userMailSubject, "wpdiscuz_ucm");
            foreach ($users as $user) {
                if ($this->option->userEmail && $user["email"] && $user["email"] != $comment_author["email"]) {
                    if (apply_filters("wpducm_mail_to_mentioned_user", true, $user, $comment_data)) {
                        $body_user = str_replace(["[mentionedUserName]", "[postTitle]", "[commentURL]", "[authorUserName]", "[commentContent]",], [$user["display_name"], $post_title, $comment_url, $comment_data->comment_author, wpautop($comment_data->comment_content),], $message_user);
                        wp_mail($user["email"], $subject_user, $body_user, $headers);
                    }
                }
            }
        }
    }

    public function userNicename($html, $comment, $user) {
        if (isset($user->data->user_nicename)) {
            $html .= "<span class='wpducm-user-nicename'>&nbsp;(@" . $user->data->user_nicename . ")</span>";
        } else if ($this->option->guestMentioning) {
            $html .= "<span class='wpducm-user-nicename'>&nbsp;(@guest_" . $comment->comment_ID . ")</span>";
        }
        return $html;
    }

    public function addMentionModule() {
        ?>
        mention: {
        mentionDenotationChars: ["@"],
        source: function(searchTerm, renderList, mentionChar){
        wpdiscuzUMCRenderList(searchTerm, renderList, mentionChar);
        },
        onSelect(item, insertItem) {
        wpdUMCInsertItem(item, insertItem);
        },
        renderItem(item, searchTerm){
        return wpdUMCRenderItem(item, searchTerm);
        },
        listItemClass: 'wpducm-mention-list-item',
        mentionContainerClass: 'wpducm-mention-list-container',
        mentionListClass: 'wpducm-mention-list',
        minChars: 1,
        },
        <?php
    }

}

$wpDiscuzUCM = WpdiscuzUCM::getInstance();
