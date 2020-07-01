<?php

class wpdSubscribersDBManager {

    private $db;
    private $subscrubersTable;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->subscrubersTable = $wpdb->prefix . "wc_comments_subscription";
    }

    public function subscriptionsCount($email = "") {
        $sql = $this->prepareSQL("SELECT COUNT(*) FROM `{$this->subscrubersTable}`", $email);
        return $this->db->get_var($sql);
    }

    public function getConfirmedSubscriptionsCount() {
        $sql = "SELECT COUNT(*) FROM `{$this->subscrubersTable}` WHERE `confirm` = 1";
        return $this->db->get_var($sql);
    }

    public function getSubscribersCount() {
        $sql = "SELECT COUNT(DISTINCT `email`) FROM `{$this->subscrubersTable}`";
        return $this->db->get_var($sql);
    }

    public function getSubscriptions($per_page = 20, $page_number = 1, $email = "") {
        $sql = $this->prepareSQL("SELECT * FROM {$this->subscrubersTable}", $email);
        $sql .= " LIMIT $per_page";
        $sql .= " OFFSET " . ( $page_number - 1 ) * $per_page;
        return $this->db->get_results($sql, "ARRAY_A");
    }

    public function getSubscription($id) {
        $sql = $this->db->prepare("SELECT * FROM `{$this->subscrubersTable}` WHERE `id` = %d", $id);
        return $this->db->get_row($sql, ARRAY_A);
    }

    public function getEmailBySubscribeID($id) {
        $sql = $this->db->prepare("SELECT `email` FROM `{$this->subscrubersTable}` WHERE `id` = %d", $id);
        return $this->db->get_var($sql);
    }

    public function changeConfirmationStatus($id, $status, $email = "") {
        $sql = $this->db->prepare("UPDATE `{$this->subscrubersTable}` SET `confirm` = %d WHERE `id` = %d", $status, $id);
        if ($email) {
            $sql .= " AND `email`='" . esc_sql($email) . "'";
        }
        return $this->db->query($sql);
    }

    public function bulkChangeConfirmationStatus($ids, $status, $email = "") {
        $sql = $this->db->prepare("UPDATE `{$this->subscrubersTable}` SET `confirm` = %d WHERE `id` IN(" . esc_sql(implode(",", $ids)) . ")", $status);
        if ($email) {
            $sql .= " AND `email`='" . esc_sql($email) . "'";
        }
        return $this->db->query($sql);
    }

    public function deleteSubscription($id, $email = "") {
        $sql = $this->db->prepare("DELETE FROM `{$this->subscrubersTable}` WHERE `id` =  %d", $id);
        if ($email) {
            $sql .= " AND `email`='" . esc_sql($email) . "'";
        }
        return $this->db->query($sql);
    }

    public function bulkDeleteSubscription($ids, $email = "") {
        $sql = "DELETE FROM `{$this->subscrubersTable}` WHERE `id` IN(" . esc_sql(implode(",", $ids)) . ")";
        if ($email) {
            $sql .= " AND `email`='" . esc_sql($email) . "'";
        }
        return $this->db->query($sql);
    }

    public function getAllDate($email = "") {
        if ($email) {
            $sql = $this->db->prepare("SELECT DATE_FORMAT(`subscription_date`, %s) `date`  FROM `{$this->subscrubersTable}` WHERE `email` LIKE %s GROUP BY DATE_FORMAT(`subscription_date`,%s)", "%Y-%m", $email, "%Y-%m");
        } else {
            $sql = "SELECT DATE_FORMAT(`subscription_date`,'%Y-%m') `date`  FROM `{$this->subscrubersTable}` GROUP BY DATE_FORMAT(`subscription_date`,'%Y-%m')";
        }
        return $this->db->get_col($sql);
    }

    private function prepareSQL($sql, $email) {
        $status = filter_input(INPUT_GET, "wpds_subscribe_confirm", FILTER_SANITIZE_NUMBER_INT);
        $type = filter_input(INPUT_GET, "wpds_subscribe_type", FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_GET, "wpds_subscribe_date", FILTER_SANITIZE_STRING);
        $order = filter_input(INPUT_GET, "order", FILTER_SANITIZE_STRING);
        $orderBy = filter_input(INPUT_GET, "orderby", FILTER_SANITIZE_STRING);
        $search = filter_input(INPUT_GET, "wpds_search", FILTER_SANITIZE_STRING);
        $user_type = filter_input(INPUT_GET, "wpds_subscribe_user_type", FILTER_SANITIZE_STRING);
        $sql .= " WHERE `confirm` < 2";
        if ($user_type) {
            if ("registered" == $user_type) {
                $sql .= " AND `email` IN(SELECT `user_email` FROM `{$this->db->users}`)";
            } else {
                $sql .= " AND `email` NOT IN(SELECT `user_email` FROM `{$this->db->users}`)";
            }
        }
        if ($email) {
            $sql .= " AND `email` LIKE '" . esc_sql($email) . "'";
        }
        if ($status == "0" || $status == "1") {
            $sql .= " AND `confirm` = " . esc_sql($status);
        }
        if ($type) {
            $sql .= " AND `subscribtion_type` LIKE '" . esc_sql($type) . "'";
        }
        if ($date) {
            $sql .= " AND `subscription_date` LIKE '" . esc_sql($date) . "%'";
        }
        if ($search) {
            $postIDs = $this->getPostsIdByName($search);
            if (!$email && $postIDs) {
                $sql .= " AND (`email` LIKE '%" . esc_sql($search) . "%' OR `post_id` IN(" . esc_sql(implode(",", $postIDs)) . "))";
            } elseif ($email && $postIDs) {
                $sql .= " AND  `post_id` IN(" . esc_sql(implode(",", $postIDs)) . ")";
            } else {
                $sql .= " AND `email` LIKE '%" . esc_sql($search) . "%'";
            }
        }
        if ($orderBy) {
            $sql .= " ORDER BY " . esc_sql($orderBy);
            $sql .= $order ? " " . esc_sql($order) : " ASC";
        } else {
            $sql .= " ORDER BY `subscription_date` DESC";
        }
        return $sql;
    }

    private function getPostsIdByName($text) {
        $sql = $this->db->prepare("SELECT `ID` FROM `{$this->db->posts}` WHERE `post_title` LIKE %s", "%" . $text . "%");
        return $this->db->get_col($sql);
    }

    public function getCommentAuthorByCommentID($commentID) {
        $sql = $this->db->prepare("SELECT `comment_author` FROM `{$this->db->comments}` WHERE `comment_ID` =  %d", $commentID);
        return $this->db->get_var($sql);
    }

    public function getCommentAuthorByEmile($email) {
        $sql = $this->db->prepare("SELECT `comment_author` FROM `{$this->db->comments}` WHERE `comment_author_email` LIKE %s LIMIT 1", $email);
        return $this->db->get_var($sql);
    }

    public function updateUserEmail($newEmail, $oldEmail) {
        $sql = $this->db->prepare("UPDATE `{$this->subscrubersTable}` SET `email` = %s WHERE `email` LIKE %s", $newEmail, $oldEmail);
        return $this->db->query($sql);
    }

    public function deletSubscriptionsByPostID($postID) {
        $sql = $this->db->prepare("DELETE FROM `{$this->subscrubersTable}` WHERE `post_id` =  %d", $postID);
        return $this->db->query($sql);
    }

    public function deletSubscriptionsByCommentID($commentID) {
        $sql = $this->db->prepare("DELETE FROM `{$this->subscrubersTable}` WHERE   `subscribtion_type` = 'comment'  AND  `subscribtion_id` =   %d", $commentID);
        return $this->db->query($sql);
    }

}
