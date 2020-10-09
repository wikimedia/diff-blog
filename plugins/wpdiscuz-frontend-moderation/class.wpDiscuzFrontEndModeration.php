<?php
/*
 * Plugin Name: wpDiscuz - Front-end Moderation
 * Description: All in one toolset to manage comments on front-end (approve, unapprove, trash, spam, email, move, blacklist, delete)
 * Version: 7.0.4
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/wpdiscuz-frontend-moderation/
 * Text Domain: wpdiscuz-frontend-moderation
 * Domain Path: /languages/
 */

if (!defined("ABSPATH")) {
    exit();
}

define("WPDISCUZ_FEM_DIR_PATH", dirname(__FILE__));

include_once WPDISCUZ_FEM_DIR_PATH . "/includes/gvt-api-manager.php";
include WPDISCUZ_FEM_DIR_PATH . "/options/class.WFEMSettings.php";

class wpDiscuzFrontEndModeration {

    private static $instance;
    private $settings;
    private $version;
    private $versionOptionName = "wpdiscuz_fem_plugin_version";
    private $wpdiscuz;
    public $apimanager;

    private function __construct() {
        add_action("plugins_loaded", [&$this, "pluginsLoaded"], 13);
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function pluginsLoaded() {
        if (function_exists("wpDiscuz")) {
            if ($version = get_option($this->versionOptionName)) {
                $this->version = $version;
            } else if ($modVersion = get_option("wpdiscuz_mod_plugin_version")) {
                delete_option("wpdiscuz_mod_plugin_version");
                $this->version = $modVersion;
                add_option($this->versionOptionName, $modVersion, "", "no");
            } else {
                $this->version = "1.0.0";
            }
            $this->apimanager = new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            load_plugin_textdomain("wpdiscuz-frontend-moderation", false, dirname(plugin_basename(__FILE__)) . "/languages/");
            $this->settings = new WFEMSettings();
            $this->wpdiscuz = wpDiscuz();
            register_activation_hook(__FILE__, [&$this, "pluginNewVersion"]);
            add_action("wpdiscuz_filtering_buttons", [&$this, "filterButton"], 13, 2);
            add_action("wp_ajax_wfem_move_comment", [&$this, "moveComment"], 13);
            add_action("wp_ajax_wfem_post_titles", [&$this, "postTitles"], 13);
            add_filter("wpdiscuz_comment_buttons", [&$this, "addButtons"], 13, 4);
            add_action("wp_ajax_wfem_blacklist", [&$this, "setToBlacklist"], 13);
            add_action("wpdiscuz_check_version", [&$this, "pluginNewVersion"], 13);
            add_filter("wpdiscuz_comments_args", [&$this, "commentArguments"], 13);
            add_action("wpdiscuz_front_scripts", [&$this, "moderationScriptsStyles"], 13);
            add_action("wp_ajax_wfem_moderate", [&$this, "responseToModeration"], 13);
            add_filter("wpdiscuz_filter_args", [&$this, "filterArgs"], 13);
            add_filter("wpdiscuz_js_options", [&$this, "moderateScriptArray"], 13);
            add_action("wp_ajax_wfem_delete", [&$this, "deleteComment"], 13);
            add_action("wp_ajax_wfem_email", [&$this, "sendMail"], 13);
            add_action("wp_footer", [&$this, "emailAndMoveCommentForms"], 13);
        } else {
            add_action("admin_notices", [&$this, "requirements"], 1);
        }
    }

    public function requirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Front-end Moderation requires wpDiscuz to be installed!", "wpdiscuz-frontend-moderation") . "</p></div>";
        }
    }

    public function pluginNewVersion() {
        $pluginData = get_plugin_data(__FILE__);
        if (version_compare($pluginData["Version"], $this->version, ">")) {
            if ($this->version !== "1.0.0") {
                if (version_compare($this->version, "1.1.3", "<=")) {
                    $this->changePrefix();
                }
                if (version_compare($this->version, "1.1.5", "<=")) {
                    $this->changeOldOptions();
                }
            }
            $this->settings->initOptions(get_option($this->settings->settingsOptionName));
            $this->settings->initPhrases(get_option($this->settings->phrasesOptionName));
            update_option($this->versionOptionName, $pluginData["Version"]);
        } else {
            update_option($this->versionOptionName, $this->version);
        }
    }

    private function changePrefix() {
        if ($modOptions = get_option("wpdiscuz_mod_settings")) {
            delete_option("wpdiscuz_mod_settings");
            $femOptions = [];
            foreach ($modOptions as $key => $modOption) {
                $femOptions[preg_replace("#^mod_([\w\d]+)#is", "fem_$1", $key)] = $modOption;
            }
            update_option($this->settings->settingsOptionName, $femOptions);
        }
        if ($modPhrases = get_option("wpdiscuz_mod_phrases")) {
            delete_option("wpdiscuz_mod_phrases");
            $femPhrases = [];
            foreach ($modPhrases as $key => $modPhrase) {
                $femPhrases[preg_replace("#^mod_([\w\d]+)#is", "fem_$1", $key)] = $modPhrase;
            }
            update_option($this->settings->phrasesOptionName, $femPhrases);
        }
    }

    private function changeOldOptions() {
        $options = get_option($this->settings->settingsOptionName);
        $newOptions = [
            "userCanDelete" => (int) ($options["fem_user_can_delete"] === "yes"),
            "displayFilterButton" => (int) ($options["fem_display_filtering_button"] === "yes"),
        ];
        update_option($this->settings->settingsOptionName, $newOptions);
        $phrases = get_option($this->settings->phrasesOptionName);
        $newPhrases = [
            "approve" => stripslashes($phrases["fem_phrase_approve"]),
            "unapprove" => stripslashes($phrases["fem_phrase_unapprove"]),
            "trash" => stripslashes($phrases["fem_phrase_trash"]),
            "spam" => stripslashes($phrases["fem_phrase_spam"]),
            "email" => stripslashes($phrases["fem_phrase_email"]),
            "move" => stripslashes($phrases["fem_phrase_move"]),
            "blacklist" => stripslashes($phrases["fem_phrase_blacklist"]),
            "delete" => stripslashes($phrases["fem_phrase_delete"]),
            "email_subject" => stripslashes($phrases["fem_phrase_email_subject"]),
            "email_message" => stripslashes($phrases["fem_phrase_email_message"]),
            "going_to_mail" => stripslashes($phrases["fem_phrase_going_to_mail"]),
            "send" => stripslashes($phrases["fem_phrase_send"]),
            "move_comment" => stripslashes($phrases["fem_phrase_move_comment"]),
            "post_title" => stripslashes($phrases["fem_phrase_post_title"]),
            "confirm_blacklist" => stripslashes($phrases["fem_phrase_confirm_blacklist"]),
            "confirm_delete" => stripslashes($phrases["fem_phrase_confirm_delete"]),
            "status_trashed" => stripslashes($phrases["fem_phrase_status_trashed"]),
            "status_spam" => stripslashes($phrases["fem_phrase_status_spam"]),
            "ops_message" => stripslashes($phrases["fem_phrase_ops_message"]),
            "cant_moderate" => stripslashes($phrases["fem_phrase_cant_moderate"]),
            "blacklist_success" => stripslashes($phrases["fem_phrase_blacklist_success"]),
            "blacklist_ops_message" => stripslashes($phrases["fem_phrase_blacklist_ops_message"]),
            "blacklist_cant_set" => stripslashes($phrases["fem_phrase_blacklist_cant_set"]),
            "ok" => stripslashes($phrases["fem_phrase_ok"]),
            "move_response_success" => stripslashes($phrases["fem_phrase_move_response_success"]),
            "fill_correct_data" => stripslashes($phrases["fem_phrase_fill_correct_data"]),
            "delete_cant_delete" => stripslashes($phrases["fem_phrase_delete_cant_delete"]),
            "email_cant_mail" => stripslashes($phrases["fem_phrase_email_cant_mail"]),
            "email_dont_sended" => stripslashes($phrases["fem_phrase_email_dont_sended"]),
            "email_success" => stripslashes($phrases["fem_phrase_email_success"]),
            "please_fill" => stripslashes($phrases["fem_phrase_please_fill"]),
            "choose_post" => stripslashes($phrases["fem_phrase_choose_post"]),
        ];
        update_option($this->settings->phrasesOptionName, $newPhrases);
    }

    public function moderationScriptsStyles($options) {
        if (is_user_logged_in()) {
            $suf = $options->general["loadMinVersion"] ? ".min" : "";
            wp_register_script("wpdiscuz-fem-script", plugins_url("assets/js/script$suf.js", __FILE__), ["jquery"], $this->version, true);
            wp_register_style("wpdiscuz-fem-styles", plugins_url("assets/css/style$suf.css", __FILE__), [], $this->version, "all");
            wp_enqueue_script("wpdiscuz-fem-script");
            wp_enqueue_style("wpdiscuz-fem-styles");
        }
    }

    public function commentArguments($args) {
        global $post;
        if (!$post) {
            $post = get_post($args["post_id"]);
        }
        $current_user = wp_get_current_user();
        if (!$this->wpdiscuz->options->wp["isPaginate"] && (isset($current_user->allcaps["moderate_comments"]) || $post->post_author == $current_user->ID)) {
            $args["status"] = "all";
        }
        return $args;
    }

    public function moderateScriptArray($jsOptions) {
        $jsOptions["fem_confirm_approve"] = __($this->settings->phrases["approved_confirm"], "wpdiscuz-frontend-moderation") . "?";
        $jsOptions["fem_confirm_unapprove"] = __($this->settings->phrases["unapproved_confirm"], "wpdiscuz-frontend-moderation") . "?";
        $jsOptions["fem_confirm_trash"] = __($this->settings->phrases["trashed_confirm"], "wpdiscuz-frontend-moderation") . "?";
        $jsOptions["fem_confirm_spam"] = __($this->settings->phrases["spam_confirm"], "wpdiscuz-frontend-moderation") . "?";
        $jsOptions["fem_confirm_blacklist"] = __($this->settings->phrases["confirm_blacklist"], "wpdiscuz-frontend-moderation") . "?";
        $jsOptions["fem_confirm_delete"] = __($this->settings->phrases["confirm_delete"], "wpdiscuz-frontend-moderation") . "?";
        $jsOptions["fem_please_fill"] = __($this->settings->phrases["please_fill"], "wpdiscuz-frontend-moderation");
        $jsOptions["fem_choose_post"] = __($this->settings->phrases["choose_post"], "wpdiscuz-frontend-moderation");
        return $jsOptions;
    }

    public function emailAndMoveCommentForms() {
        global $post;
        if ($this->wpdiscuz->helper->isLoadWpdiscuz($post)) {
            $forms = "<div class='wpdiscuz-fem-email' style='display: none;'></div><div class='wpdiscuz-fem-email-form' style='display: none;'>";
            $forms .= "<span class='wpdiscuz-fem-author'>" . __($this->settings->phrases["going_to_mail"], "wpdiscuz-frontend-moderation") . " <em></em></span>";
            $forms .= "<i class='fas fa-times'></i><div class='wpdiscuz_clear'></div>";
            $forms .= "<input placeholder='" . __($this->settings->phrases["email_subject"], "wpdiscuz-frontend-moderation") . "' type='text' class='wpdiscuz-fem-subj' value='' />";
            $forms .= "<textarea class='wpdiscuz-fem-msg' placeholder='" . __($this->settings->phrases["email_message"], "wpdiscuz-frontend-moderation") . "'></textarea><br />";
            $forms .= "<div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-send'>" . __($this->settings->phrases["send"], "wpdiscuz-frontend-moderation") . "</button></div>";
            $forms .= "<input type='hidden' id='wpdiscuz_fem_email_comment_id' /></div>";
            $forms .= "<div class='wpdiscuz-fem-moving' style='display: none;'></div><div class='wpdiscuz-fem-move-form' style='display: none;'>";
            $forms .= "<span class='wpdiscuz-fem-author'>" . __($this->settings->phrases["move_comment"], "wpdiscuz-frontend-moderation") . "<br /><em></em></span>";
            $forms .= "<i class='fas fa-times'></i><div class='wpdiscuz_clear'></div>";
            $forms .= "<div class='wpdiscuz-fem-posts-search'><input type='text' class='wpdiscuz-fem-post' placeholder='" . __($this->settings->phrases["post_title"], "wpdiscuz-frontend-moderation") . "' />";
            $forms .= "<div class='wpdiscuz-fem-posts'></div></div>";
            $forms .= "<div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-move'>" . __($this->settings->phrases["move"], "wpdiscuz-frontend-moderation") . "</button></div>";
            $forms .= "<input type='hidden' id='wpdiscuz_fem_move_comment_id' /></div>";
            echo $forms;
        }
    }

    public function addButtons($output, $comment, $user, $current_user) {
        if (!empty($current_user->ID)) {
            if (current_user_can("edit_comment", $comment->comment_ID)) {
                if ("1" === $comment->comment_approved) {
                    $output .= "<span class='wpdiscuz-fem-unapprove-comment wpd-cta-button'>" . __($this->settings->phrases["unapprove"], "wpdiscuz-frontend-moderation") . "</span>";
                } else {
                    $output .= "<span class='wpdiscuz-fem-approve-comment wpd-cta-button'>" . __($this->settings->phrases["approve"], "wpdiscuz-frontend-moderation") . "</span>";
                }
                $output .= "<span class='wpdiscuz-fem-trash-comment wpd-cta-button'>" . __($this->settings->phrases["trash"], "wpdiscuz-frontend-moderation") . "</span>";
                $output .= "<span class='wpdiscuz-fem-spam-comment wpd-cta-button'>" . __($this->settings->phrases["spam"], "wpdiscuz-frontend-moderation") . "</span>";
                $output .= "<span class='wpdiscuz-fem-email-comment wpd-cta-button'>" . __($this->settings->phrases["email"], "wpdiscuz-frontend-moderation") . "</span>";
                $output .= "<span class='wpdiscuz-fem-move-comment wpd-cta-button'>" . __($this->settings->phrases["move"], "wpdiscuz-frontend-moderation") . "</span>";
                $output .= "<span class='wpdiscuz-fem-blacklist-comment wpd-cta-button'>" . __($this->settings->phrases["blacklist"], "wpdiscuz-frontend-moderation") . "</span>";
                $output .= "<span class='wpdiscuz-fem-delete-comment wpd-cta-button'>" . __($this->settings->phrases["delete"], "wpdiscuz-frontend-moderation") . "</span>";
            } else if ($this->settings->options["userCanDelete"] && !empty($current_user->ID) && $comment->user_id == $current_user->ID) {
                $output .= "<span class='wpdiscuz-fem-delete-comment wpd-cta-button'>" . __($this->settings->phrases["delete"], "wpdiscuz-frontend-moderation") . "</span>";
            }
        }
        return $output;
    }

    public function responseToModeration() {
        if (!empty($_POST["commentID"]) && ($commentID = intval($_POST["commentID"])) && !empty($_POST["status"]) && ($status = trim($_POST["status"])) && in_array($status, ["approve", "hold", "trash", "spam"])) {
            if (current_user_can("edit_comment", $commentID) || current_user_can("moderate_comments", $commentID)) {
                if (wp_set_comment_status($commentID, $status)) {
                    $response = "";
                    if ("trash" === $status) {
                        $response = __($this->settings->phrases["status_trashed"], "wpdiscuz-frontend-moderation");
                    } else if ("spam" === $status) {
                        $response = __($this->settings->phrases["status_spam"], "wpdiscuz-frontend-moderation");
                    }
                    wp_send_json_success($response);
                }
            } else {
                wp_send_json_error(__($this->settings->phrases["cant_moderate"], "wpdiscuz-frontend-moderation"));
            }
        }
        wp_send_json_error(__($this->settings->phrases["ops_message"], "wpdiscuz-frontend-moderation"));
    }

    public function sendMail() {
        if (!empty($_POST["commentID"]) && ($commentID = intval($_POST["commentID"])) && !empty($_POST["message"]) && ($message = trim($_POST["message"]))) {
            if (current_user_can("edit_comment", $commentID) || current_user_can("moderate_comments", $commentID)) {
                if ($comment = get_comment($commentID, ARRAY_A)) {
                    $commentLink = get_comment_link($commentID);
                    $subject = !empty($_POST["subject"]) ? trim($_POST["subject"]) : "";
                    $message = $message . "<br />" . $commentLink;
                    $mail = $comment["comment_author_email"];
                    $headers = [];
                    $content_type = "text/html";
                    $from_name = get_option("blogname");
                    $from_email = get_option("admin_email");
                    $headers[] = "Content-Type:  $content_type; charset=UTF-8";
                    $headers[] = "From: " . $from_name . " <" . $from_email . "> \r\n";
                    if (wp_mail($mail, $subject, $message, $headers)) {
                        $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["email_success"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
                    } else {
                        $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["email_dont_sended"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
                    }
                    wp_die($response);
                }
            } else {
                $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["email_cant_mail"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
                wp_die($response);
            }
        }
        $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["fill_correct_data"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
        wp_die($response);
    }

    public function postTitles() {
        $response = "";
        if (isset($_POST["postsLike"]) && ($postsLike = trim($_POST["postsLike"])) && !empty($_POST["commentPostID"]) && ($commentPostID = intval($_POST["commentPostID"])) && strlen($postsLike) > 2) {
            global $wpdb;
            $postsLike = esc_sql($postsLike);
            $wpPostTypes = get_post_types();
            $postTypes = "";
            foreach ($wpPostTypes as $type) {
                if (post_type_supports($type, "comments")) {
                    $postTypes .= $wpdb->prepare("%s", $type) . ",";
                }
            }
            $postTypes = rtrim($postTypes, ",");
            $sql = "SELECT `ID`, `post_title`, `post_type` FROM `" . $wpdb->posts . "`  
                        WHERE `ID` != $commentPostID AND `post_type` IN ($postTypes) AND `post_status` IN ('publish', 'private') AND `comment_status` = 'open' AND 
                        `post_title` LIKE '%" . $postsLike . "%' ORDER BY `ID` ASC LIMIT 20";
            $posts = $wpdb->get_results($sql, ARRAY_A);
            $length = apply_filters("wfem_title_length", 30);
            $titleMaxLength = intval($length) ? $length : 30;
            foreach ($posts as $post) {
                $postTypeObject = get_post_type_object($post["post_type"]);
                $postTypeLabel = $postTypeObject && is_object($postTypeObject) ? $postTypeObject->labels->singular_name : "";
                if (function_exists("mb_strlen")) {
                    if (function_exists("mb_substr")) {
                        $postTitle = mb_strlen($post["post_title"]) < $titleMaxLength ? $post["post_title"] : mb_substr($post["post_title"], 0, $titleMaxLength) . "&hellip;";
                    } else {
                        $postTitle = mb_strlen($post["post_title"]) < $titleMaxLength ? $post["post_title"] : substr($post["post_title"], 0, $titleMaxLength) . "&hellip;";
                    }
                } else {
                    if (function_exists("mb_substr")) {
                        $postTitle = strlen($post["post_title"]) < $titleMaxLength ? $post["post_title"] : mb_substr($post["post_title"], 0, $titleMaxLength) . "&hellip;";
                    } else {
                        $postTitle = strlen($post["post_title"]) < $titleMaxLength ? $post["post_title"] : substr($post["post_title"], 0, $titleMaxLength) . "&hellip;";
                    }
                }
                $postTitle .= " &nbsp;|&nbsp; ID: " . $post["ID"] . "&nbsp;|&nbsp;";
                $response .= "<div id='fem-post-" . esc_html($post["ID"]) . "' class='wpdiscuz-fem-result'>";
                $response .= esc_html($postTitle);
                $response .= $postTypeLabel ? __("Type: ", "wpdiscuz-frontend-moderation") . $postTypeLabel : "";
                $response .= "</div>";
            }
        }
        wp_die($response);
    }

    public function moveComment() {
        if (!empty($_POST["commentID"]) && ($commentID = intval($_POST["commentID"])) && !empty($_POST["moveToPost"]) && ($moveToPost = intval($_POST["moveToPost"]))) {
            if ($comment = get_comment($commentID)) {
                if ($post = get_post($moveToPost)) {
                    if (intval($comment->comment_post_ID) !== intval($post->ID)) {
                        if (current_user_can("edit_comment", $comment->comment_ID) || current_user_can("moderate_comments", $comment->comment_ID)) {
                            if (($post->post_status === "publish" || $post->post_status === "private") && comments_open($post->ID) && post_type_supports($post->post_type, "comments")) {
                                $commentIdsToUpdate = [$comment->comment_ID];
                                $parentCommentArray = [
                                    "comment_ID" => $comment->comment_ID,
                                    "comment_post_ID" => $post->ID,
                                    "comment_parent" => 0,
                                ];
                                $commentArray = [
                                    "comment_post_ID" => $post->ID,
                                ];
                                if (wp_update_comment($parentCommentArray)) {
                                    $children = [];
                                    $this->wpdiscuz->helperOptimization->getTreeByParentId($comment->comment_ID, $children);
                                    if ($children) {
                                        foreach ($children as $child) {
                                            $commentIdsToUpdate[] = intval($child);
                                            $commentArray["comment_ID"] = intval($child);
                                            wp_update_comment($commentArray);
                                        }
                                    }
                                    wp_update_comment_count($post->ID);
                                    wp_update_comment_count($comment->comment_post_ID);
                                    global $wpdb;
                                    $sql = $wpdb->prepare("UPDATE `" . $wpdb->prefix . "wc_users_voted` SET `post_id` = %d WHERE `comment_id` IN (" . implode(',', $commentIdsToUpdate) . ")", $post->ID);
                                    $wpdb->query($sql);
                                    $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["move_response_success"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . $this->settings->phrases["ok"] . "</button></div></div>";
                                    wp_die($response);
                                }
                            }
                        } else {
                            $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["cant_moderate"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
                            wp_die($response);
                        }
                    } else {
                        $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["fill_correct_data"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
                        wp_die($response);
                    }
                }
            }
        }
        $response = "<div class='wpdiscuz-fem-response'><div class='wpdiscuz-fem-information'>" . __($this->settings->phrases["ops_message"], "wpdiscuz-frontend-moderation") . "</div><div class='wpdiscuz-fem-button-align'><button type='button' class='wpdiscuz-fem-ok'>" . __($this->settings->phrases["ok"], "wpdiscuz-frontend-moderation") . "</button></div></div>";
        wp_die($response);
    }

    public function setToBlacklist() {
        if (!empty($_POST["commentID"]) && ($commentID = intval($_POST["commentID"]))) {
            if (current_user_can("edit_comment", $commentID) || current_user_can("moderate_comments", $commentID)) {
                if ($comment = get_comment($commentID, ARRAY_A)) {
                    $blacklist = get_option("blacklist_keys");
                    $new_blacklist = $blacklist;
                    if ("" !== $comment["comment_author_email"]) {
                        $new_blacklist .= "\n" . $comment["comment_author_email"];
                    }
                    if ("" !== $comment["comment_author_url"]) {
                        $new_blacklist .= "\n" . $comment["comment_author_url"];
                    }
                    if ("" !== $comment["comment_author_IP"]) {
                        $new_blacklist .= "\n" . $comment["comment_author_IP"];
                    }
                    if ($new_blacklist !== $blacklist) {
                        if (update_option("blacklist_keys", $new_blacklist)) {
                            if (wp_set_comment_status($commentID, "trash")) {
                                wp_send_json_success(__($this->settings->phrases["blacklist_success"], "wpdiscuz-frontend-moderation"));
                            }
                        }
                    }
                }
            } else {
                wp_send_json_error(__($this->settings->phrases["blacklist_cant_set"], "wpdiscuz-frontend-moderation"));
            }
        }
        wp_send_json_error(__($this->settings->phrases["blacklist_ops_message"], "wpdiscuz-frontend-moderation"));
    }

    public function deleteComment() {
        if (!empty($_POST["commentID"]) && ($commentID = intval($_POST["commentID"]))) {
            if ($comment = get_comment($commentID)) {
                $current_user = wp_get_current_user();
                if ((current_user_can("edit_comment", $commentID) || current_user_can("moderate_comments", $commentID)) || ($this->settings->options["userCanDelete"] && !empty($current_user->ID) && $comment->user_id == $current_user->ID)) {
                    if (wp_delete_comment($commentID, true)) {
                        wp_send_json_success();
                    }
                } else {
                    wp_send_json_error(__($this->settings->phrases["delete_cant_delete"], "wpdiscuz-frontend-moderation"));
                }
            }
        }
        wp_send_json_error(__($this->settings->phrases["ops_message"], "wpdiscuz-frontend-moderation"));
    }

    public function filterButton($currentUser, $options) {
        global $post;
        if (!$options->wp["isPaginate"] && $this->settings->options["displayFilterButton"] && (current_user_can("moderate_comments") || (!empty($currentUser->ID) && $currentUser->ID == $post->post_author)) && get_comments(["status" => "hold", "count" => true, "post_id" => $post->ID])) {
            ?>
            <div class="wpd-filter wpdf-unapproved wpd_not_clicked" data-filter-type="unapproved" wpd-tooltip="<?php echo $options->phrases["wc_awaiting_for_approval"]; ?>"><i class="fas fa-exclamation-circle"></i></div>
            <?php
        }
    }

    public function filterArgs($args) {
        $post = get_post($args["post_id"]);
        $currentUser = WpdiscuzHelper::getCurrentUser();
        if ($args["wpdType"] === "unapproved" && (current_user_can("moderate_comments") || (!empty($currentUser->ID) && $currentUser->ID == $post->post_author))) {
            $args["status"] = "hold";
            $args["parent"] = "";
            add_filter("wpdiscuz_comment_list_args", function ($args) {
                $args["max_depth"] = -1;
                return $args;
            }, 999);
            add_filter("wpdiscuz_comment_wrap_classes", function ($commentWrapperClass) {
                if (($key = array_search('wpd-reply', $commentWrapperClass)) !== false) {
                    unset($commentWrapperClass[$key]);
                }
                return $commentWrapperClass;
            }, 999);
        }
        return $args;
    }

}

$wpDiscuzFrontEndModeration = wpDiscuzFrontEndModeration::getInstance();
