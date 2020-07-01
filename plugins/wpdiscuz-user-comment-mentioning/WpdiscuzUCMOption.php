<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WpdiscuzUCMOption
 *
 * @author User
 */
class WpdiscuzUCMOption {

    public $optionSlug = "wpdiscuz_ucm";
    public $options;
    public $versionSlug = "wpdiscuz_ucm_version";
    public $wpucmVersion = "1.0.0";
    public $tabKey = "wucm";
    public $posts;
    public $comments;
    public $viewAvatarInComment;
    public $viewAvatarInTooltip;
    public $adminEmail;
    public $userEmail;
    public $authorMailSubject;
    public $userMailSubject;
    public $authorMailMessage;
    public $userMailMessage;
    public $userListCount;
    public $textLength;
    public $viewID;
    public $guestMentioning;
    public $displayNicename;
    public $enableCommentMentioning;

    public function __construct() {
        $this->addOptions();
        $this->initOptions();
    }

    public function addOptions() {
        $options = [
            "posts" => __("Posts", "wpdiscuz_ucm"),
            "comments" => __("Comments", "wpdiscuz_ucm"),
            "adminemail" => 1,
            "useremail" => 1,
            "userlistcount" => 8,
            "viewat" => 1,
            "viewid" => 0,
            "viewavatarincomment" => 1,
            "viewavatarintooltip" => 1,
            "guestMentioning" => 0,
            "displayNicename" => 1,
            "enableCommentMentioning" => 1,
            "authormailsubject" => __("Your Comment has been mentioned", "wpdiscuz_ucm"),
            "usermailsubject" => __("You have been mentioned in comment", "wpdiscuz_ucm"),
            "authormailmessage" => __("Hi [mentionedUserName]!\r\nYour comment on \"[postTitle]\" post has been mentioned by [authorUserName].<br/>\r\n<br/>\r\nComment URL: [commentURL]", "wpdiscuz_ucm"),
            "usermailmessage" => __("Hi [mentionedUserName]!\r\nYou have been mentioned in a comment posted on \"[postTitle]\" post by [authorUserName].<br/>\r\n<br/>\r\nComment URL: [commentURL]", "wpdiscuz_ucm"),
            "textlength" => 150
        ];
        add_option($this->optionSlug, $options, "", "no");
        $this->options = $options;
    }

    public function initOptions() {
        $options = get_option($this->optionSlug);
        $this->posts = $options["posts"];
        $this->comments = $options["comments"];
        $this->adminEmail = $options["adminemail"];
        $this->userEmail = $options["useremail"];
        $this->userListCount = $options["userlistcount"];
        $this->viewID = $options["viewid"];
        $this->viewAvatarInComment = $options["viewavatarincomment"];
        $this->viewAvatarInTooltip = $options["viewavatarintooltip"];
        $this->guestMentioning = isset($options["guestMentioning"]) ? $options["guestMentioning"] : 0;
        $this->displayNicename = isset($options["displayNicename"]) ? $options["displayNicename"] : 0;
        $this->enableCommentMentioning = isset($options["enableCommentMentioning"]) ? $options["enableCommentMentioning"] : 1;
        $this->authorMailSubject = $options["authormailsubject"];
        $this->userMailSubject = $options["usermailsubject"];
        $this->authorMailMessage = $options["authormailmessage"];
        $this->userMailMessage = $options["usermailmessage"];
        $this->textLength = $options["textlength"];
    }

    public function saveOptions() {
        if ($_POST["wpd_tab"] === $this->tabKey) {
            $this->posts = isset($_POST[$this->tabKey]["posts"]) ? wp_unslash($_POST[$this->tabKey]["posts"]) : __("Posts", "wpdiscuz_ucm");
            $this->comments = isset($_POST[$this->tabKey]["comments"]) ? wp_unslash($_POST[$this->tabKey]["comments"]) : __("Comments", "wpdiscuz_ucm");
            $this->adminEmail = isset($_POST[$this->tabKey]["adminEmail"]) ? intval($_POST[$this->tabKey]["adminEmail"]) : 0;
            $this->userEmail = isset($_POST[$this->tabKey]["userEmail"]) ? intval($_POST[$this->tabKey]["userEmail"]) : 0;
            $this->userListCount = isset($_POST[$this->tabKey]["userListCount"]) ? absint($_POST[$this->tabKey]["userListCount"]) : 8;
            $this->viewID = isset($_POST[$this->tabKey]["viewID"]) ? intval($_POST[$this->tabKey]["viewID"]) : 0;
            $this->viewAvatarInComment = isset($_POST[$this->tabKey]["viewAvatarInComment"]) ? intval($_POST[$this->tabKey]["viewAvatarInComment"]) : 0;
            $this->viewAvatarInTooltip = isset($_POST[$this->tabKey]["viewAvatarInTooltip"]) ? intval($_POST[$this->tabKey]["viewAvatarInTooltip"]) : 0;
            $this->guestMentioning = isset($_POST[$this->tabKey]["guestMentioning"]) ? intval($_POST[$this->tabKey]["guestMentioning"]) : 0;
            $this->displayNicename = isset($_POST[$this->tabKey]["displayNicename"]) ? intval($_POST[$this->tabKey]["displayNicename"]) : 0;
            $this->enableCommentMentioning = isset($_POST[$this->tabKey]["enableCommentMentioning"]) ? intval($_POST[$this->tabKey]["enableCommentMentioning"]) : 0;
            $this->authorMailSubject = isset($_POST[$this->tabKey]["authorMailSubject"]) ? wp_unslash($_POST[$this->tabKey]["authorMailSubject"]) : __("Your Comment has been mentioned", "wpdiscuz_ucm");
            $this->userMailSubject = isset($_POST[$this->tabKey]["userMailSubject"]) ? wp_unslash($_POST[$this->tabKey]["userMailSubject"]) : __("You have been mentioned in comment", "wpdiscuz_ucm");
            $this->authorMailMessage = isset($_POST[$this->tabKey]["authorMailMessage"]) ? wp_unslash($_POST[$this->tabKey]["authorMailMessage"]) : __("Hi [mentionedUserName]!\r\nYour comment on \"[postTitle]\" post has been mentioned by [authorUserName].</br>\r\n</br>\r\nComment URL: [commentURL]", "wpdiscuz_ucm");
            $this->userMailMessage = isset($_POST[$this->tabKey]["userMailMessage"]) ? wp_unslash($_POST[$this->tabKey]["userMailMessage"]) : __("Hi [mentionedUserName]!\r\nYou have been mentioned in a comment posted on \"[postTitle]\" post by [authorUserName].</br>\r\n</br>\r\nComment URL: [commentURL]", "wpdiscuz_ucm");
            $this->textLength = isset($_POST[$this->tabKey]["textLength"]) ? intval($_POST[$this->tabKey]["textLength"]) : 150;
            update_option($this->optionSlug, [
                "posts" => $this->posts,
                "comments" => $this->comments,
                "adminemail" => $this->adminEmail,
                "useremail" => $this->userEmail,
                "userlistcount" => $this->userListCount,
                "viewid" => $this->viewID,
                "viewavatarincomment" => $this->viewAvatarInComment,
                "viewavatarintooltip" => $this->viewAvatarInTooltip,
                "guestMentioning" => $this->guestMentioning,
                "displayNicename" => $this->displayNicename,
                "enableCommentMentioning" => $this->enableCommentMentioning,
                "authormailsubject" => $this->authorMailSubject,
                "usermailsubject" => $this->userMailSubject,
                "authormailmessage" => $this->authorMailMessage,
                "usermailmessage" => $this->userMailMessage,
                "textlength" => $this->textLength
            ]);
        }
    }

    public function addJSOptions($jsOptions) {
        $jsOptions["wpdumc_text_posts"] = __($this->posts, "wpdiscuz_ucm");
        $jsOptions["wpdumc_text_comments"] = __($this->comments, "wpdiscuz_ucm");
        $jsOptions["wpdumc_is_id_mentioning"] = $this->viewID;
        $jsOptions["wpdumc_displayNicename"] = $this->displayNicename;
        return $jsOptions;
    }

    public function resetOptions($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            delete_option($this->optionSlug);
            $this->addOptions();
            $this->initOptions();
        }
    }

    public function settingsArray($settings) {
        $settings["addons"][$this->tabKey] = [
            "title" => __("User &amp; Comment Mentioning", "wpdiscuz_ucm"),
            "title_original" => "User &amp; Comment Mentioning",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WUCM_DIR_PATH . "/view/ucm_view.php",
            "values" => $this,
            "options" => [
                "enableCommentMentioning" => [
                    "label" => __("Enable mentioning by comment ID:", "wpdiscuz_ucm"),
                    "label_original" => "Enable mentioning by comment ID:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "guestMentioning" => [
                    "label" => __("Enable guest mentioning:", "wpdiscuz_ucm"),
                    "label_original" => "Enable guest mentioning:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "displayNicename" => [
                    "label" => __("Display user nicename (names for mentioning) in user search result:", "wpdiscuz_ucm"),
                    "label_original" => "Display user nicename (names for mentioning) in user search result:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "viewAvatarInComment" => [
                    "label" => __("Display mentioned user avatar with username link:", "wpdiscuz_ucm"),
                    "label_original" => "Display mentioned user avatar with username link:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "viewAvatarInTooltip" => [
                    "label" => __("Display avatar in user pop-up information:", "wpdiscuz_ucm"),
                    "label_original" => "Display avatar in user pop-up information:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "viewID" => [
                    "label" => __("Mention user by user ID in comment content", "wpdiscuz_ucm"),
                    "label_original" => "Mention user by user ID in comment content",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "textLength" => [
                    "label" => __("Text length in user/comment pop-up information:", "wpdiscuz_ucm"),
                    "label_original" => "Text length in user/comment pop-up information:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "userListCount" => [
                    "label" => __('Maximum number of users in "User Selector" bar:', "wpdiscuz_ucm"),
                    "label_original" => 'Maximum number of users in "User Selector" bar:',
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "adminEmail" => [
                    "label" => __("Enable Email Notification", "wpdiscuz_ucm"),
                    "label_original" => "Enable Email Notification",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "authorMailSubject" => [
                    "label" => __("Email Subject", "wpdiscuz_ucm"),
                    "label_original" => "Email Subject",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "authorMailMessage" => [
                    "label" => __("Email Body", "wpdiscuz_ucm"),
                    "label_original" => "Email Body",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "userEmail" => [
                    "label" => __("Enable Email Notification", "wpdiscuz_ucm"),
                    "label_original" => "Enable Email Notification",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "userMailSubject" => [
                    "label" => __("Email Subject", "wpdiscuz_ucm"),
                    "label_original" => "Email Subject",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "userMailMessage" => [
                    "label" => __("Email Body", "wpdiscuz_ucm"),
                    "label_original" => "Email Body",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "posts" => [
                    "label" => __("Posts:", "wpdiscuz_ucm"),
                    "label_original" => "Posts:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "comments" => [
                    "label" => __("Comments:", "wpdiscuz_ucm"),
                    "label_original" => "Comments:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}
