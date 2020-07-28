<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzFlagHelper {

    private $dbManager;
    private $options;
    private $flaggedComments;

    public function __construct($dbManager, $options) {
        $this->dbManager = $dbManager;
        $this->options = $options;
        add_action("wpdiscuz_before_getcomments", [&$this, "initUserFlaggedComments"], 10, 2);
        add_filter("wpdiscuz_after_comment_link", [$this, "addReportFlag"], 10, 4);
        add_action("wp_footer", [$this, "showEmailDialog"], 10);
        add_action("wpdiscuz_comment_flagged", [&$this, "flaggedActions"]);
        add_action("wpdiscuz_comment_flagged_email", [&$this, "flaggedActionsEmail"], 10, 3);
        add_action("wpdiscuz_add_vote", [$this, "addVoteActions"], 10, 2);
        add_action("wpdiscuz_update_vote", [$this, "updateVoteActions"], 10, 3);
        add_filter("admin_comment_types_dropdown", [&$this, "addReportedComment"]);
    }

    public function initUserFlaggedComments($commentsArgs, $currentUser) {
        $wpdiscuz = wpDiscuz();
        $postId = $commentsArgs && isset($commentsArgs["post_id"]) ? intval($commentsArgs["post_id"]) : 0;
        $userId = $currentUser && isset($currentUser->ID) ? intval($currentUser->ID) : 0;
        $userIp = $wpdiscuz->helper->getRealIPAddr();
        $this->flaggedComments = $this->dbManager->getFlaggedComments($postId, $userId, $userIp);
    }

    public function addReportFlag($output, $comment, $user, $currentUser) {
        $notAllowedCommentTypes = apply_filters("wpdiscuz_rf_exclude_comment_types", [WpdiscuzCore::WPDISCUZ_STICKY_COMMENT]);
        if ($this->options->showFlag && !in_array($comment->comment_type, $notAllowedCommentTypes) && !intval(get_comment_meta($comment->comment_ID, WpdiscuzCore::META_KEY_CLOSED, true))) {
            if ($currentUser && isset($currentUser->ID) && $currentUser->ID) {
                if ($this->options->sendFlagMessage) {
                    $title = __($this->options->flagTitleOn, "wpdiscuz_fc");
                    $class = "comment_flag_modal";
                } else {
                    $title = __($this->options->flagTitleOff, "wpdiscuz_fc");
                    $class = "";
                }

                $style = "";
                if ($this->flaggedComments && is_array($this->flaggedComments) && in_array($comment->comment_ID, $this->flaggedComments)) {
                    $wpdiscuz = wpDiscuz();
                    $style = "color:{$wpdiscuz->options->thread_styles["primaryColor"]};";
                    $class .= " fc_flagged";
                }

                $output .= "<div style='$style' class='comment_flag $class wc_flag_tooltipster wpf-cta wpd-field-desc' id='fc_{$comment->comment_ID}' wpd-tooltip-position='left' wpd-tooltip-size='long' wpd-tooltip='" . esc_attr($title) . "'>";
                $output .= "<i class='fas fa-flag'></i>";
                $output .= "</div>";
            } else if ($this->options->guestToFlag) {
                if ($this->options->sendFlagMessageGuest) {
                    $title = __($this->options->flagTitleOn, "wpdiscuz_fc");
                    $class = "comment_flag_modal";
                } else {
                    $title = __($this->options->flagTitleOff, "wpdiscuz_fc");
                    $class = "";
                }

                $style = "";
                if ($this->flaggedComments && is_array($this->flaggedComments) && in_array($comment->comment_ID, $this->flaggedComments)) {
                    $wpdiscuz = wpDiscuz();
                    $style = "color:{$wpdiscuz->options->thread_styles["primaryColor"]};";
                    $class .= " fc_flagged";
                }

                $output .= "<div style='$style' class='comment_flag $class wc_flag_tooltipster wpf-cta wpd-field-desc'  wpd-tooltip-position='left' id='fc_{$comment->comment_ID}' wpd-tooltip='$title'>";
                $output .= "<i class='fas fa-flag'></i>";
                $output .= "</div>";
            }
        }
        return $output;
    }

    public function showEmailDialog() {
        global $post;
        $wpdiscuz = wpDiscuz();
        if ($wpdiscuz->helper->isLoadWpdiscuz($post)) {
            $isUserLoggedIn = is_user_logged_in();
            if (($this->options->sendFlagMessage && $isUserLoggedIn) || ($this->options->sendFlagMessageGuest && !$isUserLoggedIn)) {
                $currentUser = wp_get_current_user();
                $userEmail = $currentUser && isset($currentUser->ID) && $currentUser->ID ? $currentUser->user_email : "anonymous_" . uniqid() . "@example.com";
                include_once WPDISCUZ_FLAG_DIR_PATH . "/view/form-html.php";
            }
        }
    }

    public function addReportedComment($args) {
        $args["wpdiscuz_reported"] = __("Reported", "wpdiscuz_fc");
        return $args;
    }

    public function flaggedActions($commentId) {
        $count = $this->dbManager->getFlaggedCount($commentId);
        $type = "flaggings";
        if ($count >= $this->options->flagCount) {
            if ($this->dbManager->moveFlaggedComments($commentId, $this->options->autoModerateCommentType)) {
                if ($this->options->notifyAdmin == 1) {
                    if ($this->dbManager->updateCommentType($commentId)) {
                        $comment = get_comment($commentId);
                        $this->getEmailData($comment, $type);
                    }
                } else {
                    $this->dbManager->updateCommentType($commentId);
                }
            }
        }
    }

    public function flaggedActionsEmail($commentId, $report, $message) {
        $comment = get_comment($commentId);
        $currentUser = wp_get_current_user();

        if ($currentUser && isset($currentUser->ID) && $currentUser->ID) {
            $userLogin = $currentUser->user_login;
            $userEmail = $currentUser->user_email;
        } else {
            $userLogin = __("Guest", "wpdiscuz_fc");
            $userEmail = apply_filters("wpdiscuz_flagged_guest_email", "guest@example.com");
        }

        $postTitle = get_the_title($comment->comment_post_ID);
        $postName = get_the_permalink($comment->comment_post_ID);
        $commentInfo = $comment->comment_approved === "1" ? "<a href='" . get_comment_link($comment) . "'  target='_blank'>" . get_comment_link($commentId) . "</a>" : $comment->comment_content;
        $subject = $this->options->flagedMailSubject;
        $to = $this->options->flaggedMailTo;
        $body = str_replace(["[userInfo]", "[reason]", "[message]", "[postTitle]", "[commentInfo]",], [$userLogin, $report, $message, "<a href='" . $postName . "' target='_blank'>" . $postTitle . "</a>", $commentInfo,], $this->options->flagedMailMessage);
        $headers[] = "From: " . $userLogin . " <" . $userEmail . ">";
        $sent = $this->sendEmail($to, $subject, $body, $headers);
    }

    public function addVoteActions($voteType, $comment) {
        $wpdiscuz = wpDiscuz();
        $voteCount = intval(get_comment_meta($comment->comment_ID, $wpdiscuz::META_KEY_VOTES, true));
        $temp = ($t = intval(get_comment_meta($comment->comment_ID, FC_KEY, true))) ? $t : 1;
        $type = "down votes";
        $count = intval($this->options->voteCount) * -1;
        if ($voteCount / $temp <= $count) {
            if ($this->dbManager->moveVotedComments($comment->comment_ID, $this->options->autoModerateCommentType)) {
                if ($this->options->notifyAdmin == 1) {
                    if ($this->dbManager->updateCommentType($comment->comment_ID)) {
                        $this->getEmailData($comment, $type);
                    }
                } else {
                    $this->dbManager->updateCommentType($comment->comment_ID);
                }
            }
        }
    }

    public function updateVoteActions($voteType, $isUserVoted, $comment) {
        $wpdiscuz = wpDiscuz();
        $voteCount = intval(get_comment_meta($comment->comment_ID, $wpdiscuz::META_KEY_VOTES, true));
        $temp = ($t = intval(get_comment_meta($comment->comment_ID, FC_KEY, true))) ? $t : 1;
        $type = "down votes";
        $count = intval($this->options->voteCount) * -1;
        if ($voteCount / $temp <= $count) {
            if ($this->dbManager->moveVotedComments($comment->comment_ID, $this->options->autoModerateCommentType)) {
                if ($this->options->notifyAdmin == 1) {
                    if ($this->dbManager->updateCommentType($comment->comment_ID)) {
                        $this->getEmailData($comment, $type);
                    }
                } else {
                    $this->dbManager->updateCommentType($comment->comment_ID);
                }
            }
        }
    }

    public function getEmailData($comment, $type) {
        $subject = sprintf(__($this->options->moderateEmailSubject, "wpdiscuz_fc"), $type);
        $status = $this->options->autoModerateCommentType;
        $postTitle = get_the_title($comment->comment_post_ID);
        $postName = get_the_permalink($comment->comment_post_ID);
        $userLogin = get_comment_author($comment->comment_ID);
        $userEmail = get_comment_author_email($comment->comment_ID);
        $commentContent = get_comment_text($comment->comment_ID);
        $headers[] = "From: " . get_option("blogname") . " <" . $this->getFromEmail(get_site_url()) . "> ";
        $body = str_replace(["[status]", "[postTitle]", "[postName]", "[userLogin]", "[commentContent]", "[userEmail]",], [$status, '"' . $postTitle . '"', "<a href='" . $postName . " target='_blank'>" . $postName . "</a>", $userLogin, $commentContent, $userEmail,], $this->options->reportedMailMessage);
        if ($this->sendEmail($this->options->flaggedMailTo, $subject, $body, $headers)) {
            return true;
        }
    }

    public function sendEmail($to, $subject, $body, $headers) {
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        return wp_mail($to, $subject, $body, $headers);
    }

    private function getFromEmail($siteUrl) {
        $parsedUrl = parse_url($siteUrl);
        $domain = isset($parsedUrl["host"]) ? $parsedUrl["host"] : "";
        $fromEmail = "no-reply@" . $domain;
        return $fromEmail;
    }

}
