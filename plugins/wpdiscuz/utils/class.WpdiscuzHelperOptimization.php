<?php

if (!defined("ABSPATH")) {
    exit();
}

class WpdiscuzHelperOptimization implements WpDiscuzConstants {

    private $options;
    private $dbManager;
    private $helperEmail;

    public function __construct($options, $dbManager, $helperEmail) {
        $this->options = $options;
        $this->dbManager = $dbManager;
        $this->helperEmail = $helperEmail;
        add_action("deleted_comment", [&$this, "cleanCommentRelatedRows"]);
        add_action("delete_user", [&$this, "deleteUserRelatedData"], 11, 2);
        add_action("profile_update", [&$this, "onProfileUpdate"], 10, 2);
        add_action("admin_post_removeVoteData", [&$this, "removeVoteData"]);
        add_action("admin_post_resetPhrases", [&$this, "resetPhrases"]);
        add_action("transition_comment_status", [&$this, "statusEventHandler"], 10, 3);
        add_action("deleted_post", [&$this->dbManager, "removeRatings"], 10);
    }

    /**
     * recursively get new comments tree
     * return array of comments' ids
     */
    public function getTreeByParentId($commentId, &$tree) {
        $children = $this->dbManager->getCommentsByParentId($commentId);
        if ($children && is_array($children)) {
            foreach ($children as $k => $child) {
                if (!in_array($child, $tree)) {
                    $tree[] = $child;
                    $this->getTreeByParentId($child, $tree);
                }
            }
        }
    }

    public function isReplyInAuthorTree($commentId, $authorComments) {
        $comment = get_comment($commentId);
        if (in_array($comment->comment_parent, $authorComments)) {
            return true;
        }
        if ($comment->comment_parent) {
            return $this->isReplyInAuthorTree($comment->comment_parent, $authorComments);
        } else {
            return false;
        }
    }

    /**
     * add new comment id in comment meta if status is approved
     * @param type $newStatus the comment new status
     * @param type $oldStatus the comment old status
     * @param type $comment current comment object
     */
    public function statusEventHandler($newStatus, $oldStatus, $comment) {
        if ($newStatus != $oldStatus && $newStatus == "approved") {
            $this->notifyOnApprove($comment);
            if ($this->options->subscription["isNotifyOnCommentApprove"]) {
                $this->helperEmail->notifyOnApproving($comment);
            }
        }
    }

    /**
     * get the current comment root comment
     * @param type $commentId the current comment id
     * @return type comment
     */
    public function getCommentRoot($commentId, $commentStatusIn, $includeUnapproved = null) {
        $comment = get_comment($commentId);
        $condition = false;
        if (!is_null($includeUnapproved)) {
            if (is_numeric($includeUnapproved)) {
                if ($comment->user_id == $includeUnapproved) {
                    $condition = true;
                }
            } else if ($comment->comment_author_email == $includeUnapproved) {
                $condition = true;
            }
        }
        if (in_array($comment->comment_approved, $commentStatusIn) || ($comment->comment_approved === "0" && $condition)) {
            if ($comment && $comment->comment_parent) {
                return $this->getCommentRoot($comment->comment_parent, $commentStatusIn, $includeUnapproved);
            } else {
                return $comment;
            }
        }
        return null;
    }

    public function getCommentDepth($commentId, &$depth = 1) {
        $comment = get_comment($commentId);
        if ($comment->comment_parent && ($depth < $this->options->wp["threadCommentsDepth"])) {
            $depth++;
            return $this->getCommentDepth($comment->comment_parent, $depth);
        } else {
            return $depth;
        }
    }

    private function notifyOnApprove($comment) {
        $postId = $comment->comment_post_ID;
        $commentId = $comment->comment_ID;
        $email = $comment->comment_author_email;
        $parentComment = get_comment($comment->comment_parent);
        $this->helperEmail->notifyPostSubscribers($postId, $commentId, $email);
        if ($parentComment) {
            $parentCommentEmail = $parentComment->comment_author_email;
            if ($parentCommentEmail != $email) {
                $this->helperEmail->notifyAllCommentSubscribers($postId, $commentId, $email);
                $this->helperEmail->notifyCommentSubscribers($parentComment->comment_ID, $commentId, $email);
            }
        }
    }

    public function removeVoteData() {
        if (isset($_GET["_wpnonce"]) && wp_verify_nonce($_GET["_wpnonce"], "removeVoteData") && current_user_can("manage_options")) {
            $this->dbManager->removeVotes();
            wp_redirect(admin_url("admin.php?page=" . self::PAGE_SETTINGS . "&wpd_tab=" . self::TAB_GENERAL));
        }
    }

    public function resetPhrases() {
        if (isset($_GET["_wpnonce"]) && wp_verify_nonce($_GET["_wpnonce"], "reset_phrases_nonce") && current_user_can("manage_options")) {
            $this->dbManager->deletePhrases();
            wp_redirect(admin_url("admin.php?page=" . self::PAGE_PHRASES));
        }
    }

    public function cleanCommentRelatedRows($commentId) {
        $this->dbManager->deleteSubscriptions($commentId);
        $this->dbManager->deleteVotes($commentId);
    }

    public function onProfileUpdate($userId, $oldUser) {
        $user = get_user_by("id", $userId);
        if ($user && $oldUser) {
            if (($user->user_email !== $oldUser->user_email || $user->display_name !== $oldUser->display_name || $user->user_url !== $oldUser->user_url) && $this->dbManager->userHasComments($userId)) {
                $this->dbManager->updateCommenterData($user->user_email, $user->display_name, $user->user_url, $userId);
            }
            $this->dbManager->updateUserInfo($user, $oldUser);
        }
    }

    public function deleteUserRelatedData($id, $reassign) {
        $user = get_user_by("id", $id);
        if ($user && $user->user_email) {
            $this->dbManager->deleteFollowsByEmail($user->user_email);
        }
        $this->dbManager->deleteUserVotes($id);
    }

}
