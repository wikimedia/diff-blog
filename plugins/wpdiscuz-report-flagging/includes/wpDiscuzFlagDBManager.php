<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzFlagDBManager {

    private $db;
    private $users_flaged;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->users_flaged = $wpdb->prefix . "wc_flagged";
    }

    /**
     * creates table for censored words
     */
    public function createTablesMultisite($networkWide) {
        if (is_multisite() && $networkWide) {
            $blogIds = $this->db->get_col("SELECT `blog_id` FROM {$this->db->blogs}");
            foreach ($blogIds as $blogId) {
                switch_to_blog($blogId);
                $this->createTables();
                restore_current_blog();
            }
        } else {
            $this->createTables();
        }
    }

    public function createTables() {
        require_once ABSPATH . "wp-admin/includes/upgrade.php";
        $sql = "CREATE TABLE `{$this->users_flaged}`(`comment_ID` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`user_ip` varchar(32) DEFAULT NULL, KEY `comment_ID` (`comment_ID`), KEY `user_id` (`user_id`), KEY `user_ip` (`user_ip`)) DEFAULT CHARACTER SET {$this->db->charset} COLLATE {$this->db->collate};";
        maybe_create_table($this->users_flaged, $sql);
    }

    public function onNewBlog($blogId, $userId, $domain, $path, $siteId, $meta) {
        if (is_plugin_active_for_network(WPDISCUZ_FLAG_DIR_NAME . "/wpDiscuzFlagComment.php")) {
            switch_to_blog($blogId);
            $this->createTables();
            restore_current_blog();
        }
    }

    function onDeleteBlog($tables) {
        $tables[] = $this->users_flaged;
        return $tables;
    }

    public function isTableExists($tableName) {
        return $this->db->get_var("SHOW TABLES LIKE '$tableName'") == $tableName;
    }

    public function insertFlaggedData($commentId, $userId, $userIp) {
        $flaggedData = ["comment_ID" => $commentId, "user_id" => $userId, "user_ip" => md5($userIp)];
        $res = $this->db->insert($this->users_flaged, $flaggedData);
        return $res;
    }

    function deleteFlaggedData($commentId, $userId, $userIp) {
        $flaggedDataToDelet = ["comment_ID" => $commentId, "user_id" => $userId, "user_ip" => md5($userIp)];
        $delete = $this->db->delete($this->users_flaged, $flaggedDataToDelet);
        return $delete;
    }

    public function isFlagged($commentId, $userId, $userIp) {
        $sql = $this->db->prepare("SELECT `comment_ID` FROM `{$this->users_flaged}` WHERE `comment_ID` = %d AND `user_id` = %d AND `user_ip` = %s", $commentId, $userId, md5($userIp));
        return $this->db->get_var($sql);
    }

    /**
     * @param type $commentId the flagged comment id
     * @return type integer how many times the comment was flagged
     */
    public function getFlaggedCount($commentId) {
        $sql = $this->db->prepare("SELECT COUNT(*) as count FROM `{$this->users_flaged}` WHERE `comment_ID` = %d", $commentId);
        $data = intval($this->db->get_var($sql));
        return $data;
    }

    public function moveVotedComments($commentId, $status) {
        if ($status == "unapprove") {
            $status = 0;
        }
        $vote = wp_set_comment_status($commentId, $status);
        return $vote;
    }

    public function moveFlaggedComments($commentId, $status) {
        if ($status == "unapprove") {
            $status = 0;
        }
        $result = wp_set_comment_status($commentId, $status);
        return $result;
    }

    public function updateCommentType($commentId) {
        $commentArr = [];
        $commentArr["comment_ID"] = $commentId;
        $commentArr["comment_type"] = "wpdiscuz_reported";
        $report = wp_update_comment($commentArr);
        return $report;
    }

    public function reUpdateCommentType($commentId) {
        $commentArr = [];
        $commentArr["comment_ID"] = $commentId;
        $commentArr["comment_type"] = "";
        $report = wp_update_comment($commentArr);
        return $report;
    }

    public function deleteReportedData($commentId) {
        $flaggedDataToDelet = ["comment_ID" => $commentId];
        $this->db->delete($this->users_flaged, $flaggedDataToDelet);
    }

    function updateReportedData($comment_id) {
        $commentArr["comment_ID"] = $comment_id;
        $commentArr["comment_type"] = "";
        $commentArr["comment_approved"] = 1;
        wp_update_comment($commentArr);
    }

    public function deleteEmptyData() {
        $flaggedDataToDelet = ["comment_ID" => null, "user_id" => null];
        $this->db->delete($this->users_flaged, $flaggedDataToDelet);
    }

    public function getFlaggedComments($postId, $userId, $userIp) {
        $sql = $this->db->prepare("SELECT `f`.`comment_ID` FROM `{$this->users_flaged}` AS `f` INNER JOIN `{$this->db->comments}` AS `c` ON `f`.`comment_ID` = `c`.`comment_ID` WHERE `c`.`comment_post_ID` = %d AND `f`.`user_id` = %d AND `f`.`user_ip` = %s;", $postId, $userId, md5($userIp));
        return $this->db->get_col($sql);
    }

    public function dropUserHashColumn() {
        $column = "user_hash";
        $sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME = '{$this->users_flaged}' AND COLUMN_NAME = '$column'";
        if ($this->db->get_results($sql)) {
            $sql = "ALTER TABLE `{$this->users_flaged}` DROP COLUMN `$column`";
            $this->db->query($sql);
        }
    }

    public function addIndexes() {
        $flgIndexes = $this->getIndexes();
        if (!$flgIndexes) {
            $sql = "ALTER TABLE `{$this->users_flaged}` ADD INDEX `comment_ID` (`comment_ID`), ADD INDEX `user_id` (`user_id`), ADD INDEX `user_ip` (`user_ip`);";
            $this->db->query($sql);
        }
    }

    public function getIndexes() {
        $indexes = $this->db->get_results("SHOW INDEX FROM `{$this->users_flaged}`", ARRAY_A);
        return $indexes;
    }

    public function updateUserIps() {
        $sql = "UPDATE `{$this->users_flaged}` SET `user_ip` = MD5(`user_ip`);";
        $this->db->query($sql);
    }

}
