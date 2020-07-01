<?php

class WFEMSettings {

    public $settingsOptionName = "wpdiscuz_fem_settings";
    public $phrasesOptionName = "wpdiscuz_fem_phrases";
    public $tabKey = "fem";
    public $options;
    public $phrases;

    public function __construct() {
        add_action("wpdiscuz_save_options", [&$this, "saveOptionsAndPhrases"], 13);
        add_action("wpdiscuz_reset_options", [&$this, "resetOptionsAndPhrases"], 13);
        add_filter("wpdiscuz_settings", [&$this, "settingsArray"], 13);
        $this->addOptionsAndPhrases();
        $this->initOptions(get_option($this->settingsOptionName));
        $this->initPhrases(get_option($this->phrasesOptionName));
    }

    public function addOptionsAndPhrases() {
        add_option($this->settingsOptionName, $this->defaultOptions(), "", "no");
        add_option($this->phrasesOptionName, $this->defaultPhrases(), "", "no");
    }

    public function initOptions($options) {
        $defaults = $this->defaultOptions();
        $this->options["userCanDelete"] = isset($options["userCanDelete"]) ? $options["userCanDelete"] : $defaults["userCanDelete"];
        $this->options["displayFilterButton"] = isset($options["displayFilterButton"]) ? $options["displayFilterButton"] : $defaults["displayFilterButton"];
    }

    public function initPhrases($phrases) {
        $defaults = $this->defaultPhrases();
        $this->phrases["approve"] = isset($phrases["approve"]) ? $phrases["approve"] : $defaults["approve"];
        $this->phrases["unapprove"] = isset($phrases["unapprove"]) ? $phrases["unapprove"] : $defaults["unapprove"];
        $this->phrases["trash"] = isset($phrases["trash"]) ? $phrases["trash"] : $defaults["trash"];
        $this->phrases["spam"] = isset($phrases["spam"]) ? $phrases["spam"] : $defaults["spam"];
        $this->phrases["email"] = isset($phrases["email"]) ? $phrases["email"] : $defaults["email"];
        $this->phrases["move"] = isset($phrases["move"]) ? $phrases["move"] : $defaults["move"];
        $this->phrases["blacklist"] = isset($phrases["blacklist"]) ? $phrases["blacklist"] : $defaults["blacklist"];
        $this->phrases["delete"] = isset($phrases["delete"]) ? $phrases["delete"] : $defaults["delete"];
        $this->phrases["email_subject"] = isset($phrases["email_subject"]) ? $phrases["email_subject"] : $defaults["email_subject"];
        $this->phrases["email_message"] = isset($phrases["email_message"]) ? $phrases["email_message"] : $defaults["email_message"];
        $this->phrases["going_to_mail"] = isset($phrases["going_to_mail"]) ? $phrases["going_to_mail"] : $defaults["going_to_mail"];
        $this->phrases["send"] = isset($phrases["send"]) ? $phrases["send"] : $defaults["send"];
        $this->phrases["move_comment"] = isset($phrases["move_comment"]) ? $phrases["move_comment"] : $defaults["move_comment"];
        $this->phrases["post_title"] = isset($phrases["post_title"]) ? $phrases["post_title"] : $defaults["post_title"];
        $this->phrases["unapproved_confirm"] = isset($phrases["unapproved_confirm"]) ? $phrases["unapproved_confirm"] : $defaults["unapproved_confirm"];
        $this->phrases["approved_confirm"] = isset($phrases["approved_confirm"]) ? $phrases["approved_confirm"] : $defaults["approved_confirm"];
        $this->phrases["trashed_confirm"] = isset($phrases["trashed_confirm"]) ? $phrases["trashed_confirm"] : $defaults["trashed_confirm"];
        $this->phrases["spam_confirm"] = isset($phrases["spam_confirm"]) ? $phrases["spam_confirm"] : $defaults["spam_confirm"];
        $this->phrases["confirm_blacklist"] = isset($phrases["confirm_blacklist"]) ? $phrases["confirm_blacklist"] : $defaults["confirm_blacklist"];
        $this->phrases["confirm_delete"] = isset($phrases["confirm_delete"]) ? $phrases["confirm_delete"] : $defaults["confirm_delete"];
        $this->phrases["status_trashed"] = isset($phrases["status_trashed"]) ? $phrases["status_trashed"] : $defaults["status_trashed"];
        $this->phrases["status_spam"] = isset($phrases["status_spam"]) ? $phrases["status_spam"] : $defaults["status_spam"];
        $this->phrases["ops_message"] = isset($phrases["ops_message"]) ? $phrases["ops_message"] : $defaults["ops_message"];
        $this->phrases["cant_moderate"] = isset($phrases["cant_moderate"]) ? $phrases["cant_moderate"] : $defaults["cant_moderate"];
        $this->phrases["blacklist_success"] = isset($phrases["blacklist_success"]) ? $phrases["blacklist_success"] : $defaults["blacklist_success"];
        $this->phrases["blacklist_ops_message"] = isset($phrases["blacklist_ops_message"]) ? $phrases["blacklist_ops_message"] : $defaults["blacklist_ops_message"];
        $this->phrases["blacklist_cant_set"] = isset($phrases["blacklist_cant_set"]) ? $phrases["blacklist_cant_set"] : $defaults["blacklist_cant_set"];
        $this->phrases["ok"] = isset($phrases["ok"]) ? $phrases["ok"] : $defaults["ok"];
        $this->phrases["move_response_success"] = isset($phrases["move_response_success"]) ? $phrases["move_response_success"] : $defaults["move_response_success"];
        $this->phrases["fill_correct_data"] = isset($phrases["fill_correct_data"]) ? $phrases["fill_correct_data"] : $defaults["fill_correct_data"];
        $this->phrases["delete_cant_delete"] = isset($phrases["delete_cant_delete"]) ? $phrases["delete_cant_delete"] : $defaults["delete_cant_delete"];
        $this->phrases["email_cant_mail"] = isset($phrases["email_cant_mail"]) ? $phrases["email_cant_mail"] : $defaults["email_cant_mail"];
        $this->phrases["email_dont_sended"] = isset($phrases["email_dont_sended"]) ? $phrases["email_dont_sended"] : $defaults["email_dont_sended"];
        $this->phrases["email_success"] = isset($phrases["email_success"]) ? $phrases["email_success"] : $defaults["email_success"];
        $this->phrases["please_fill"] = isset($phrases["please_fill"]) ? $phrases["please_fill"] : $defaults["please_fill"];
        $this->phrases["choose_post"] = isset($phrases["choose_post"]) ? $phrases["choose_post"] : $defaults["choose_post"];
    }

    public function saveOptionsAndPhrases() {
        $this->saveOptions();
        $this->savePhrases();
    }

    public function saveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->options["userCanDelete"] = isset($_POST[$this->tabKey]["userCanDelete"]) ? absint($_POST[$this->tabKey]["userCanDelete"]) : 0;
            $this->options["displayFilterButton"] = isset($_POST[$this->tabKey]["displayFilterButton"]) ? absint($_POST[$this->tabKey]["displayFilterButton"]) : 0;
            update_option($this->settingsOptionName, $this->options);
        }
    }

    public function savePhrases() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->phrases["approve"] = isset($_POST[$this->tabKey]["approve"]) ? stripslashes($_POST[$this->tabKey]["approve"]) : "";
            $this->phrases["unapprove"] = isset($_POST[$this->tabKey]["unapprove"]) ? stripslashes($_POST[$this->tabKey]["unapprove"]) : "";
            $this->phrases["trash"] = isset($_POST[$this->tabKey]["trash"]) ? stripslashes($_POST[$this->tabKey]["trash"]) : "";
            $this->phrases["spam"] = isset($_POST[$this->tabKey]["spam"]) ? stripslashes($_POST[$this->tabKey]["spam"]) : "";
            $this->phrases["email"] = isset($_POST[$this->tabKey]["email"]) ? stripslashes($_POST[$this->tabKey]["email"]) : "";
            $this->phrases["move"] = isset($_POST[$this->tabKey]["move"]) ? stripslashes($_POST[$this->tabKey]["move"]) : "";
            $this->phrases["blacklist"] = isset($_POST[$this->tabKey]["blacklist"]) ? stripslashes($_POST[$this->tabKey]["blacklist"]) : "";
            $this->phrases["delete"] = isset($_POST[$this->tabKey]["delete"]) ? stripslashes($_POST[$this->tabKey]["delete"]) : "";
            $this->phrases["email_subject"] = isset($_POST[$this->tabKey]["email_subject"]) ? stripslashes($_POST[$this->tabKey]["email_subject"]) : "";
            $this->phrases["email_message"] = isset($_POST[$this->tabKey]["email_message"]) ? stripslashes($_POST[$this->tabKey]["email_message"]) : "";
            $this->phrases["going_to_mail"] = isset($_POST[$this->tabKey]["going_to_mail"]) ? stripslashes($_POST[$this->tabKey]["going_to_mail"]) : "";
            $this->phrases["send"] = isset($_POST[$this->tabKey]["send"]) ? stripslashes($_POST[$this->tabKey]["send"]) : "";
            $this->phrases["move_comment"] = isset($_POST[$this->tabKey]["move_comment"]) ? stripslashes($_POST[$this->tabKey]["move_comment"]) : "";
            $this->phrases["post_title"] = isset($_POST[$this->tabKey]["post_title"]) ? stripslashes($_POST[$this->tabKey]["post_title"]) : "";
            $this->phrases["unapproved_confirm"] = isset($_POST[$this->tabKey]["unapproved_confirm"]) ? stripslashes($_POST[$this->tabKey]["unapproved_confirm"]) : "";
            $this->phrases["approved_confirm"] = isset($_POST[$this->tabKey]["approved_confirm"]) ? stripslashes($_POST[$this->tabKey]["approved_confirm"]) : "";
            $this->phrases["trashed_confirm"] = isset($_POST[$this->tabKey]["trashed_confirm"]) ? stripslashes($_POST[$this->tabKey]["trashed_confirm"]) : "";
            $this->phrases["spam_confirm"] = isset($_POST[$this->tabKey]["spam_confirm"]) ? stripslashes($_POST[$this->tabKey]["spam_confirm"]) : "";
            $this->phrases["confirm_blacklist"] = isset($_POST[$this->tabKey]["confirm_blacklist"]) ? stripslashes($_POST[$this->tabKey]["confirm_blacklist"]) : "";
            $this->phrases["confirm_delete"] = isset($_POST[$this->tabKey]["confirm_delete"]) ? stripslashes($_POST[$this->tabKey]["confirm_delete"]) : "";
            $this->phrases["status_trashed"] = isset($_POST[$this->tabKey]["status_trashed"]) ? stripslashes($_POST[$this->tabKey]["status_trashed"]) : "";
            $this->phrases["status_spam"] = isset($_POST[$this->tabKey]["status_spam"]) ? stripslashes($_POST[$this->tabKey]["status_spam"]) : "";
            $this->phrases["ops_message"] = isset($_POST[$this->tabKey]["ops_message"]) ? stripslashes($_POST[$this->tabKey]["ops_message"]) : "";
            $this->phrases["cant_moderate"] = isset($_POST[$this->tabKey]["cant_moderate"]) ? stripslashes($_POST[$this->tabKey]["cant_moderate"]) : "";
            $this->phrases["blacklist_success"] = isset($_POST[$this->tabKey]["blacklist_success"]) ? stripslashes($_POST[$this->tabKey]["blacklist_success"]) : "";
            $this->phrases["blacklist_ops_message"] = isset($_POST[$this->tabKey]["blacklist_ops_message"]) ? stripslashes($_POST[$this->tabKey]["blacklist_ops_message"]) : "";
            $this->phrases["blacklist_cant_set"] = isset($_POST[$this->tabKey]["blacklist_cant_set"]) ? stripslashes($_POST[$this->tabKey]["blacklist_cant_set"]) : "";
            $this->phrases["ok"] = isset($_POST[$this->tabKey]["ok"]) ? stripslashes($_POST[$this->tabKey]["ok"]) : "";
            $this->phrases["move_response_success"] = isset($_POST[$this->tabKey]["move_response_success"]) ? stripslashes($_POST[$this->tabKey]["move_response_success"]) : "";
            $this->phrases["fill_correct_data"] = isset($_POST[$this->tabKey]["fill_correct_data"]) ? stripslashes($_POST[$this->tabKey]["fill_correct_data"]) : "";
            $this->phrases["delete_cant_delete"] = isset($_POST[$this->tabKey]["delete_cant_delete"]) ? stripslashes($_POST[$this->tabKey]["delete_cant_delete"]) : "";
            $this->phrases["email_cant_mail"] = isset($_POST[$this->tabKey]["email_cant_mail"]) ? stripslashes($_POST[$this->tabKey]["email_cant_mail"]) : "";
            $this->phrases["email_dont_sended"] = isset($_POST[$this->tabKey]["email_dont_sended"]) ? stripslashes($_POST[$this->tabKey]["email_dont_sended"]) : "";
            $this->phrases["email_success"] = isset($_POST[$this->tabKey]["email_success"]) ? stripslashes($_POST[$this->tabKey]["email_success"]) : "";
            $this->phrases["please_fill"] = isset($_POST[$this->tabKey]["please_fill"]) ? stripslashes($_POST[$this->tabKey]["please_fill"]) : "";
            $this->phrases["choose_post"] = isset($_POST[$this->tabKey]["choose_post"]) ? stripslashes($_POST[$this->tabKey]["choose_post"]) : "";
            update_option($this->phrasesOptionName, $this->phrases);
        }
    }
    
    public function resetOptionsAndPhrases($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            $this->options = $this->defaultOptions();
            $this->phrases = $this->defaultPhrases();
            update_option($this->settingsOptionName, $this->options);
            update_option($this->phrasesOptionName, $this->phrases);
        }
    }

    public function defaultOptions() {
        return [
            "userCanDelete" => 1,
            "displayFilterButton" => 1,
        ];
    }

    public function defaultPhrases() {
        return [
            "approve" => __("Approve", "wpdiscuz-frontend-moderation"),
            "unapprove" => __("Unapprove", "wpdiscuz-frontend-moderation"),
            "trash" => __("Trash", "wpdiscuz-frontend-moderation"),
            "spam" => __("Spam", "wpdiscuz-frontend-moderation"),
            "email" => __("Email", "wpdiscuz-frontend-moderation"),
            "move" => __("Move", "wpdiscuz-frontend-moderation"),
            "blacklist" => __("Blacklist", "wpdiscuz-frontend-moderation"),
            "delete" => __("Delete", "wpdiscuz-frontend-moderation"),
            "email_subject" => __("Email Subject", "wpdiscuz-frontend-moderation"),
            "email_message" => __("Enter your message here", "wpdiscuz-frontend-moderation"),
            "going_to_mail" => __("You are going to send email to", "wpdiscuz-frontend-moderation"),
            "send" => __("Send", "wpdiscuz-frontend-moderation"),
            "move_comment" => __("Move Comment", "wpdiscuz-frontend-moderation"),
            "post_title" => __("Enter post title...", "wpdiscuz-frontend-moderation"),
            "unapproved_confirm" => __("Are you sure you want to set this comment as unapproved", "wpdiscuz-frontend-moderation"),
            "approved_confirm" => __("Are you sure you want to set this comment as approved", "wpdiscuz-frontend-moderation"),
            "trashed_confirm" => __("Are you sure you want to set this comment as trashed", "wpdiscuz-frontend-moderation"),
            "spam_confirm" => __("Are you sure you want to set this comment as spam", "wpdiscuz-frontend-moderation"),
            "confirm_blacklist" => __("Are you sure you want to move this user into blacklist", "wpdiscuz-frontend-moderation"),
            "confirm_delete" => __("Are you sure you want to delete this comment", "wpdiscuz-frontend-moderation"),
            "status_trashed" => __("Comment successfully trashed", "wpdiscuz-frontend-moderation"),
            "status_spam" => __("Comment set as spam successfully", "wpdiscuz-frontend-moderation"),
            "ops_message" => __("Ops!!! Something is wrong", "wpdiscuz-frontend-moderation"),
            "cant_moderate" => __("You can't moderate this comment", "wpdiscuz-frontend-moderation"),
            "blacklist_success" => __("User is added to the blacklist successfully", "wpdiscuz-frontend-moderation"),
            "blacklist_ops_message" => __("Ops!!! Something is wrong. Maybe this user already exist in the blacklist", "wpdiscuz-frontend-moderation"),
            "blacklist_cant_set" => __("The user cannot be added in blacklist", "wpdiscuz-frontend-moderation"),
            "ok" => __("OK", "wpdiscuz-frontend-moderation"),
            "move_response_success" => __("Comment successfully moved", "wpdiscuz-frontend-moderation"),
            "fill_correct_data" => __("Please fill correct data", "wpdiscuz-frontend-moderation"),
            "delete_cant_delete" => __("You can't delete this comment", "wpdiscuz-frontend-moderation"),
            "email_cant_mail" => __("You can't send mail to this user", "wpdiscuz-frontend-moderation"),
            "email_dont_sended" => __("Message has not been sent", "wpdiscuz-frontend-moderation"),
            "email_success" => __("Your message has been sent successfully", "wpdiscuz-frontend-moderation"),
            "please_fill" => __("Please fill out the field", "wpdiscuz-frontend-moderation"),
            "choose_post" => __("Please choose post", "wpdiscuz-frontend-moderation"),
        ];
    }

    public function settingsArray($settings) {
        $settings["addons"][$this->tabKey] = [
            "title" => __("Front-end Moderation", "wpdiscuz-frontend-moderation"),
            "title_original" => "Front-end Moderation",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WPDISCUZ_FEM_DIR_PATH . "/options/html-options.php",
            "values" => $this,
            "options" => [
                "userCanDelete" => [
                    "label" => __("Allow Users Delete Comment", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Allow Users Delete Comment",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "displayFilterButton" => [
                    "label" => __("Display Unapproved Comments Filtering Button", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Display Unapproved Comments Filtering Button",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "approve" => [
                    "label" => __("Approve", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Approve",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "unapprove" => [
                    "label" => __("Unapprove", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Unapprove",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "trash" => [
                    "label" => __("Trash", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Trash",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "spam" => [
                    "label" => __("Spam", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Spam",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "email" => [
                    "label" => __("Email", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Email",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "move" => [
                    "label" => __("Move", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Move",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "blacklist" => [
                    "label" => __("Blacklist", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Blacklist",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "delete" => [
                    "label" => __("Delete", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Delete",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "email_subject" => [
                    "label" => __("Email Subject", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Email Subject",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "email_message" => [
                    "label" => __("Enter your message here", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Enter your message here",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "going_to_mail" => [
                    "label" => __("You are going to send email to", "wpdiscuz-frontend-moderation"),
                    "label_original" => "You are going to send email to",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "send" => [
                    "label" => __("Send", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Send",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "move_comment" => [
                    "label" => __("Move Comment", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Move Comment",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "post_title" => [
                    "label" => __("Enter post title...", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Enter post title...",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "unapproved_confirm" => [
                    "label" => __("Are you sure you want to set this comment as unapproved", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Are you sure you want to set this comment as unapproved",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "approved_confirm" => [
                    "label" => __("Are you sure you want to set this comment as approved", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Are you sure you want to set this comment as approved",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "trashed_confirm" => [
                    "label" => __("Are you sure you want to set this comment as trashed", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Are you sure you want to set this comment as trashed",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "spam_confirm" => [
                    "label" => __("Are you sure you want to set this comment as spam", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Are you sure you want to set this comment as spam",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "confirm_blacklist" => [
                    "label" => __("Are you sure you want to move this user into blacklist", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Are you sure you want to move this user into blacklist",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "confirm_delete" => [
                    "label" => __("Are you sure you want to delete this comment", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Are you sure you want to delete this comment",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "status_trashed" => [
                    "label" => __("Comment successfully trashed", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Comment successfully trashed",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "status_spam" => [
                    "label" => __("Comment set as spam successfully", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Comment set as spam successfully",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "ops_message" => [
                    "label" => __("Ops!!! Something is wrong", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Ops!!! Something is wrong",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "cant_moderate" => [
                    "label" => __("You can't moderate this comment", "wpdiscuz-frontend-moderation"),
                    "label_original" => "You can't moderate this comment",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "blacklist_success" => [
                    "label" => __("User is added to the blacklist successfully", "wpdiscuz-frontend-moderation"),
                    "label_original" => "User is added to the blacklist successfully",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "blacklist_ops_message" => [
                    "label" => __("Ops!!! Something is wrong. Maybe this user already exist in the blacklist", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Ops!!! Something is wrong. Maybe this user already exist in the blacklist",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "blacklist_cant_set" => [
                    "label" => __("The user cannot be added in blacklist", "wpdiscuz-frontend-moderation"),
                    "label_original" => "The user cannot be added in blacklist",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "ok" => [
                    "label" => __("OK", "wpdiscuz-frontend-moderation"),
                    "label_original" => "OK",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "move_response_success" => [
                    "label" => __("Comment successfully moved", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Comment successfully moved",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "fill_correct_data" => [
                    "label" => __("Please fill correct data", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Please fill correct data",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "delete_cant_delete" => [
                    "label" => __("You can't delete this comment", "wpdiscuz-frontend-moderation"),
                    "label_original" => "You can't delete this comment",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "email_cant_mail" => [
                    "label" => __("You can't send mail to this user", "wpdiscuz-frontend-moderation"),
                    "label_original" => "You can't send mail to this user",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "email_dont_sended" => [
                    "label" => __("Message has not been sent", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Message has not been sent",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "email_success" => [
                    "label" => __("Your message has been sent successfully", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Your message has been sent successfully",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "please_fill" => [
                    "label" => __("Please fill out the field", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Please fill out the field",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "choose_post" => [
                    "label" => __("Please choose post", "wpdiscuz-frontend-moderation"),
                    "label_original" => "Please choose post",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}
