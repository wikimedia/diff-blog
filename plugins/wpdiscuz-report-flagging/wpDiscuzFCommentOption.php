<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzFCommentOption {

    public $optionSlug = "wpdiscuz_fc";
    public $options;
    public $voteCount;
    public $flagCount;
    public $guestToFlag;
    public $sendFlagMessage;
    public $sendFlagMessageGuest;
    public $guestEmail;
    public $autoModerateComment;
    public $autoModerateCommentType;
    public $notifyAdmin;
    public $showFlag;
    public $votedMailSubject;
    public $votedMailMessage;
    public $flaggedMailTo;
    public $flagedMailMessage;
    public $reportedMailMessage;
    public $flagedMailSubject;
    public $reportPopupTitle;
    public $optionType;
    public $alreadyFlagged;
    public $emailNotSend;
    public $dataNotInserted;
    public $emailSend;
    public $sendBtn;
    public $messageField;
    public $flagTitleOn;
    public $flagTitleOff;
    public $reportOther;
    public $moderateEmailSubject;
    public $checkReportType;
    public $fillMsgField;
    public $notifyWhenFlagged;
    public $tabKey = "wrf";

    public function __construct() {
        add_action("wpdiscuz_save_options", [$this, "saveOptions"], 3);
        add_action("wpdiscuz_reset_options", [&$this, "resetOptions"], 3);
        add_filter("wpdiscuz_settings", [&$this, "settingsArray"], 3);
        $this->addOptions();
        $this->initOptions();
    }

    public function addOptions() {
        $fc_mail_subject = __("New comment report", "wpdiscuz_fc");
        $fc_flagged_message = __("<h2>Report details:</h2> \n<p>Name: [userInfo]</p>\n<p>Reason: [reason]</p>\n<p>Message: [message]</p>\n<p>Post: [postTitle]</p>\n<p>Comment URL: [commentInfo]</p>", "wpdiscuz_fc");
        $fc_voted_message = __("You have a new [status] comment on the post [postTitle].\n<p>[postName]</p>\n<p><b>Comment details:</b></p>\n<p>Author: [userLogin]</p>\n<p>Email: [userEmail]</p>\n<p>Comment:<p>[commentContent]</p></p>", "wpdiscuz_fc");
        $adminEmail = get_option("admin_email");
        $options = [
            "voteCount" => 10,
            "flagCount" => 5,
            "guestToFlag" => 1,
            "sendFlagMessage" => 1,
            "sendFlagMessageGuest" => 0,
            "guestEmail" => __("Your Email", "wpdiscuz_fc"),
            "autoModerateComment" => 1,
            "showFlag" => 1,
            "autoModerateCommentType" => "unapprove",
            "notifyAdmin" => 1,
            "notifyWhenFlagged" => 1,
            "flaggedMailTo" => $adminEmail,
            "flagedMailSubject" => $fc_mail_subject,
            "flagedMailMessage" => $fc_flagged_message,
            "reportedMailMessage" => $fc_voted_message,
            "sendBtn" => __("Send", "wpdiscuz_fc"),
            "reportPopupTitle" => __("Report this comment", "wpdiscuz_fc"),
            "alreadyFlagged" => __("Already flagged", "wpdiscuz_fc"),
            "emailNotSend" => __("Message sending problem", "wpdiscuz_fc"),
            "dataNotInserted" => __("Data are not inserted", "wpdiscuz_fc"),
            "emailSend" => __("Message sent", "wpdiscuz_fc"),
            "reportOther" => __("Other", "wpdiscuz_fc"),
            "messageField" => __("Enter message", "wpdiscuz_fc"),
            "moderateEmailSubject" => __("New comment has reached to the maximum number of %s", "wpdiscuz_fc"),
            "flagTitleOn" => __("Click to flag and open &laquo;Comment Reporting&raquo; form. You can choose reporting category and send message to website administrator. Admins may or may not choose to remove the comment or block the author. And please don't worry, your report will be anonymous.", "wpdiscuz_fc"),
            "flagTitleOff" => __("You can flag a comment by clicking its flag icon. Website admin will know that you reported it. Admins may or may not choose to remove the comment or block the author. And please don't worry, your report will be anonymous.", "wpdiscuz_fc"),
            "checkReportType" => __("Select bad comment category", "wpdiscuz_fc"),
            "fillMsgField" => __("Please Insert message", "wpdiscuz_fc"),
            "optionType" => [
                __("This comment is spam", "wpdiscuz_fc"),
                __("This comment should be marked mature", "wpdiscuz_fc"),
                __("This comment is abusive", "wpdiscuz_fc"),
                __("This comment promotes self-harm", "wpdiscuz_fc")
            ],
        ];
        add_option($this->optionSlug, $options, "", "no");
        $this->options = $options;
    }

    public function margeOption() {
        $old_options = get_option($this->optionSlug);
        $mix_opt = array_merge($this->options, $old_options);
        update_option($this->optionSlug, $mix_opt);
    }

    public function initOptions() {
        $options = get_option($this->optionSlug);
        $this->voteCount = $options["voteCount"];
        $this->flagCount = $options["flagCount"];
        $this->guestToFlag = $options["guestToFlag"];
        $this->sendFlagMessage = $options["sendFlagMessage"];
        $this->sendFlagMessageGuest = $options["sendFlagMessageGuest"];
        $this->guestEmail = $options["guestEmail"];
        $this->autoModerateComment = $options["autoModerateComment"];
        $this->autoModerateCommentType = $options["autoModerateCommentType"];
        $this->notifyAdmin = $options["notifyAdmin"];
        $this->notifyWhenFlagged = isset($options["notifyWhenFlagged"]) ? $options["notifyWhenFlagged"] : 1;
        $this->showFlag = $options["showFlag"];
        $this->flaggedMailTo = $options["flaggedMailTo"];
        $this->flagedMailMessage = wp_unslash($options["flagedMailMessage"]);
        $this->flagedMailSubject = wp_unslash($options["flagedMailSubject"]);
        $this->reportedMailMessage = wp_unslash($options["reportedMailMessage"]);
        $this->reportPopupTitle = wp_unslash($options["reportPopupTitle"]);
        $this->sendBtn = wp_unslash($options["sendBtn"]);
        $this->optionType = wp_unslash($options["optionType"]);
        $this->alreadyFlagged = wp_unslash($options["alreadyFlagged"]);
        $this->emailNotSend = wp_unslash($options["emailNotSend"]);
        $this->dataNotInserted = wp_unslash($options["dataNotInserted"]);
        $this->emailSend = wp_unslash($options["emailSend"]);
        $this->reportOther = wp_unslash($options["reportOther"]);
        $this->messageField = wp_unslash($options["messageField"]);
        $this->flagTitleOn = wp_unslash($options["flagTitleOn"]);
        $this->flagTitleOff = wp_unslash($options["flagTitleOff"]);
        $this->moderateEmailSubject = wp_unslash($options["moderateEmailSubject"]);
        $this->checkReportType = wp_unslash($options["checkReportType"]);
        $this->fillMsgField = wp_unslash($options["fillMsgField"]);
    }

    public function saveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->guestToFlag = isset($_POST[$this->tabKey]["guestToFlag"]) ? intval($_POST[$this->tabKey]["guestToFlag"]) : 0;
            $this->sendFlagMessage = isset($_POST[$this->tabKey]["sendFlagMessage"]) ? intval($_POST[$this->tabKey]["sendFlagMessage"]) : 0;
            $this->sendFlagMessageGuest = isset($_POST[$this->tabKey]["sendFlagMessageGuest"]) ? intval($_POST[$this->tabKey]["sendFlagMessageGuest"]) : 0;
            $this->autoModerateComment = isset($_POST[$this->tabKey]["wpdiscuz_allow_auto_moderate"]) ? intval($_POST[$this->tabKey]["wpdiscuz_allow_auto_moderate"]) : 0;
            $this->autoModerateCommentType = isset($_POST[$this->tabKey]["autoModerateCommentType"]) ? trim($_POST[$this->tabKey]["autoModerateCommentType"]) : "unapprove";
            $this->flagCount = isset($_POST[$this->tabKey]["flagCount"]) ? intval(absint($_POST[$this->tabKey]["flagCount"])) : 10;
            $this->voteCount = isset($_POST[$this->tabKey]["voteCount"]) ? intval(absint($_POST[$this->tabKey]["voteCount"])) : 10;
            $this->notifyAdmin = isset($_POST[$this->tabKey]["notifyAdmin"]) ? intval($_POST[$this->tabKey]["notifyAdmin"]) : 0;
            $this->notifyWhenFlagged = isset($_POST[$this->tabKey]["notifyWhenFlagged"]) ? intval($_POST[$this->tabKey]["notifyWhenFlagged"]) : 0;
            $this->showFlag = isset($_POST[$this->tabKey]["showFlag"]) ? intval($_POST[$this->tabKey]["showFlag"]) : 0;
            $this->flagedMailSubject = isset($_POST[$this->tabKey]["flagedMailSubject"]) ? wp_unslash($_POST[$this->tabKey]["flagedMailSubject"]) : __("New comment report", "wpdiscuz_fc");
            $this->flaggedMailTo = isset($_POST[$this->tabKey]["flaggedMailTo"]) ? ($_POST[$this->tabKey]["flaggedMailTo"]) : get_option("admin_email");
            $this->reportedMailMessage = isset($_POST[$this->tabKey]["wpdiscuz_reported_email_message"]) ? wp_unslash($_POST[$this->tabKey]["wpdiscuz_reported_email_message"]) : __("You have a new [status] comment on the post [postTitle].<br>\n[postName]<br>\n<b>Comment details:</b><br>\n Author: [userLogin]<br>\n Email: [userEmail]<br>\n URL:<br>\n Comment:\n [commentContent]", "wpdiscuz_fc");
            $this->flagedMailMessage = isset($_POST[$this->tabKey]["flagedMailMessage"]) ? wp_unslash($_POST[$this->tabKey]["flagedMailMessage"]) : __("<h2>Report details:</h2>\n<p>Name: [userInfo]</p>\n<p>Reason: [reason],</p>\n<p>Message: [message],</p>\n<p>Post: [postTitle],</p>\n<p>Comment URL | Text: [commentInfo]</p>", "wpdiscuz_fc");
            $this->optionType = isset($_POST[$this->tabKey]["optionType"]) ? wp_unslash($_POST[$this->tabKey]["optionType"]) : [__("This comment is spam", "wpdiscuz_fc"), __("This comment should be marked mature", "wpdiscuz_fc"), __("This comment is abusive", "wpdiscuz_fc"), __("This comment promotes self-harm", "wpdiscuz_fc")];
            $this->reportPopupTitle = isset($_POST[$this->tabKey]["reportPopupTitle"]) ? wp_unslash($_POST[$this->tabKey]["reportPopupTitle"]) : __("Report this comment", "wpdiscuz_fc");
            $this->sendBtn = isset($_POST[$this->tabKey]["sendBtn"]) ? wp_unslash($_POST[$this->tabKey]["sendBtn"]) : __("Send", "wpdiscuz_fc");
            $this->alreadyFlagged = isset($_POST[$this->tabKey]["alreadyFlagged"]) ? wp_unslash($_POST[$this->tabKey]["alreadyFlagged"]) : __("Already flagged", "wpdiscuz_fc");
            $this->emailNotSend = isset($_POST[$this->tabKey]["emailNotSend"]) ? wp_unslash($_POST[$this->tabKey]["emailNotSend"]) : __("Message sending problem", "wpdiscuz_fc");
            $this->dataNotInserted = isset($_POST[$this->tabKey]["dataNotInserted"]) ? wp_unslash($_POST[$this->tabKey]["dataNotInserted"]) : __("Data are not inserted", "wpdiscuz_fc");
            $this->emailSend = isset($_POST[$this->tabKey]["emailSend"]) ? wp_unslash($_POST[$this->tabKey]["emailSend"]) : __("Message sent", "wpdiscuz_fc");
            $this->checkReportType = isset($_POST[$this->tabKey]["checkReportType"]) ? wp_unslash($_POST[$this->tabKey]["checkReportType"]) : __("Select bad comment category", "wpdiscuz_fc");
            $this->fillMsgField = isset($_POST[$this->tabKey]["fillMsgField"]) ? wp_unslash($_POST[$this->tabKey]["fillMsgField"]) : __("Please Insert message", "wpdiscuz_fc");
            $this->reportOther = isset($_POST[$this->tabKey]["reportOther"]) ? wp_unslash($_POST[$this->tabKey]["reportOther"]) : __("Other", "wpdiscuz_fc");
            $this->messageField = isset($_POST[$this->tabKey]["messageField"]) ? wp_unslash($_POST[$this->tabKey]["messageField"]) : __("Enter message", "wpdiscuz_fc");
            $this->flagTitleOn = isset($_POST[$this->tabKey]["flagTitleOn"]) ? wp_unslash($_POST[$this->tabKey]["flagTitleOn"]) : __("Click to flag and open &laquo;Comment Reporting&raquo; form. You can choose reporting category and send message to website administrator. Admins may or may not choose to remove the comment or block the author. And please don't worry, your report will be anonymous.", "wpdiscuz_fc");
            $this->flagTitleOff = isset($_POST[$this->tabKey]["flagTitleOff"]) ? wp_unslash($_POST[$this->tabKey]["flagTitleOff"]) : __("You can flag a comment by clicking its flag icon. Website admin will know that you reported it. Admins may or may not choose to remove the comment or block the author. And please don't worry, your report will be anonymous.", "wpdiscuz_fc");
            $this->moderateEmailSubject = isset($_POST[$this->tabKey]["moderateEmailSubject"]) ? wp_unslash($_POST[$this->tabKey]["moderateEmailSubject"]) : __("New comment has reached to the maximum number of %s", "wpdiscuz_fc");

            update_option($this->optionSlug, ["guestToFlag" => $this->guestToFlag,
                "sendFlagMessage" => $this->sendFlagMessage,
                "sendFlagMessageGuest" => $this->sendFlagMessageGuest,
                "guestEmail" => $this->guestEmail,
                "autoModerateComment" => $this->autoModerateComment,
                "autoModerateCommentType" => $this->autoModerateCommentType,
                "flagCount" => $this->flagCount,
                "voteCount" => $this->voteCount,
                "showFlag" => $this->showFlag,
                "notifyAdmin" => $this->notifyAdmin,
                "notifyWhenFlagged" => $this->notifyWhenFlagged,
                "flagedMailMessage" => $this->flagedMailMessage,
                "reportedMailMessage" => $this->reportedMailMessage,
                "flagedMailSubject" => $this->flagedMailSubject,
                "flaggedMailTo" => $this->flaggedMailTo,
                "optionType" => $this->optionType,
                "sendBtn" => $this->sendBtn,
                "reportOther" => $this->reportOther,
                "messageField" => $this->messageField,
                "flagTitleOn" => $this->flagTitleOn,
                "flagTitleOff" => $this->flagTitleOff,
                "moderateEmailSubject" => $this->moderateEmailSubject,
                "reportPopupTitle" => $this->reportPopupTitle,
                "emailNotSend" => $this->emailNotSend,
                "alreadyFlagged" => $this->alreadyFlagged,
                "dataNotInserted" => $this->dataNotInserted,
                "emailSend" => $this->emailSend,
                "checkReportType" => $this->checkReportType,
                "fillMsgField" => $this->fillMsgField,
            ]);
        }
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
            "title" => __("Report &amp; Flagging", "wpdiscuz_fc"),
            "title_original" => "Report &amp; Flagging",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WPDISCUZ_FLAG_DIR_PATH . "/view/flag-view.php",
            "values" => $this,
            "options" => [
                "showFlag" => [
                    "label" => __("Show flag icon on comments", "wpdiscuz_fc"),
                    "label_original" => "Show flag icon on comments",
                    "description" => __("If this option is disabled, comment auto-moderation will only be based on down votes / dislikes.", "wpdiscuz_fc"),
                    "description_original" => "If this option is disabled, comment auto-moderation will only be based on down votes / dislikes.",
                    "docurl" => "#"
                ],
                "guestToFlag" => [
                    "label" => __("Allow guests to flag and report comments", "wpdiscuz_fc"),
                    "label_original" => "Allow guests to flag and report comments",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "sendFlagMessage" => [
                    "label" => __("Enable comment reporting pop-up form for registered users", "wpdiscuz_fc"),
                    "label_original" => "Allow guests to flag and report comments",
                    "description" => __("For security reasons comment reporting form is disabled for guests by default. Guests are still able to flag without sending message. However you can enable this for guests using the option below.", "wpdiscuz_fc"),
                    "description_original" => "For security reasons comment reporting form is disabled for guests by default. Guests are still able to flag without sending message. However you can enable this for guests using the option below.",
                    "docurl" => "#"
                ],
                "sendFlagMessageGuest" => [
                    "label" => __("Enable comment reporting pop-up form for guests", "wpdiscuz_fc"),
                    "label_original" => "Enable comment reporting pop-up form for guests",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "autoModerateCommentType" => [
                    "label" => __("Enable auto-moderation for flagged/disliked comments:", "wpdiscuz_fc"),
                    "label_original" => "Enable auto-moderation for flagged/disliked comments:",
                    "description" => __("This will automatically Unapprove or Trash comments which reached the maximum number of flags or dislikes set below", "wpdiscuz_fc"),
                    "description_original" => "This will automatically Unapprove or Trash comments which reached the maximum number of flags or dislikes set below",
                    "docurl" => "#"
                ],
                "flagCount" => [
                    "label" => __("Do auto-moderation if comment is flagged more than", "wpdiscuz_fc"),
                    "label_original" => "Do auto-moderation if comment is flagged more than",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "voteCount" => [
                    "label" => __("Do auto-moderation if comment is down voted more than", "wpdiscuz_fc"),
                    "label_original" => "Do auto-moderation if comment is down voted more than",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "notifyWhenFlagged" => [
                    "label" => sprintf(__("Notify admin when comment is flagged more than %d times.", "wpdiscuz_fc"), $this->flagCount),
                    "label_original" => "Notify admin when comment is flagged more than {$this->flagCount} times.",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "notifyAdmin" => [
                    "label" => __("Notify admin when comment is auto-moderated", "wpdiscuz_fc"),
                    "label_original" => "Notify admin when comment is auto-moderated",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "flaggedMailTo" => [
                    "label" => __("Admin Email", "wpdiscuz_fc"),
                    "label_original" => "Admin Email",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "flagedMailSubject" => [
                    "label" => __("Report message subject", "wpdiscuz_fc"),
                    "label_original" => "Report message subject",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "flagedMailMessage" => [
                    "label" => __("Report message body", "wpdiscuz_fc"),
                    "label_original" => "Report message body",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "moderateEmailSubject" => [
                    "label" => __("Auto-moderation message subject", "wpdiscuz_fc"),
                    "label_original" => "Auto-moderation message subject",
                    "description" => __('Please do not remove %s variable at end of this phrase. This variable will be changed to auto-moderation mode "flags" or "dislikes".', "wpdiscuz_fc"),
                    "description_original" => 'Please do not remove %s variable at end of this phrase. This variable will be changed to auto-moderation mode "flags" or "dislikes".',
                    "docurl" => "#"
                ],
                "reportedMailMessage" => [
                    "label" => __("Auto-moderation message body", "wpdiscuz_fc"),
                    "label_original" => "Auto-moderation message body",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "reportPopupTitle" => [
                    "label" => __("Comment reporting pop-up form title:", "wpdiscuz_fc"),
                    "label_original" => "Comment reporting pop-up form title:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "sendBtn" => [
                    "label" => __("Report button:", "wpdiscuz_fc"),
                    "label_original" => "Report button:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "alreadyFlagged" => [
                    "label" => __("Already flagged:", "wpdiscuz_fc"),
                    "label_original" => "Already flagged:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "emailNotSend" => [
                    "label" => __("Email not send:", "wpdiscuz_fc"),
                    "label_original" => "Email not send:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "dataNotInserted" => [
                    "label" => __("Data not inserted:", "wpdiscuz_fc"),
                    "label_original" => "Data not inserted:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "emailSend" => [
                    "label" => __("Message sent:", "wpdiscuz_fc"),
                    "label_original" => "Message sent:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "checkReportType" => [
                    "label" => __("Select report category:", "wpdiscuz_fc"),
                    "label_original" => "Select report category:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "fillMsgField" => [
                    "label" => __("Insert message:", "wpdiscuz_fc"),
                    "label_original" => "Insert message:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "reportOther" => [
                    "label" => __("Report type other:", "wpdiscuz_fc"),
                    "label_original" => "Report type other:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "messageField" => [
                    "label" => __("Report message placeholder:", "wpdiscuz_fc"),
                    "label_original" => "Report message placeholder:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "flagTitleOn" => [
                    "label" => __('Flag title when "Comment Reporting" pop-up form is enabled', "wpdiscuz_fc"),
                    "label_original" => 'Flag title when "Comment Reporting" pop-up form is enabled',
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "flagTitleOff" => [
                    "label" => __('Flag title when "Comment Reporting" pop-up form is disabled', "wpdiscuz_fc"),
                    "label_original" => 'Flag title when "Comment Reporting" pop-up form is disabled',
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "optionType" => [
                    "label" => __("Bad comment categories:", "wpdiscuz_fc"),
                    "label_original" => "Bad comment categories:",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}
