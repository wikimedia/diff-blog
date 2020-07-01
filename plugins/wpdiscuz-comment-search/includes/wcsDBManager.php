<?php

if (!defined("ABSPATH")) {
    exit();
}

class SearchDBManager {

    private $db;
    private $options;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function searchData($data, $searchBy, $post_id, $allComments = "") {
        $data = addslashes(trim($data));
        $result = [];
        if ($data !== "") {
            $condition = current_user_can("moderate_comments") ? "`comment_approved` IN('0','1')" : "`comment_approved` = '1'";
            $condition .= $allComments ? "" : " AND `comment_post_ID` = $post_id";

            $searchField = ($s = trim($searchBy)) ? strtolower($s) : "";
            if ($searchField == "content") {
                $commentIdsSql = "SELECT `comment_ID` FROM `{$this->db->comments}` WHERE `comment_content` LIKE '%$data%' AND $condition ORDER BY `comment_ID` DESC;";
                $result = $this->db->get_col($commentIdsSql);
            } else if ($searchField == "author") {
                $commentIdsSql = "SELECT `comment_ID` FROM `{$this->db->comments}` WHERE `comment_author` LIKE '%$data%' AND $condition ORDER BY `comment_ID` DESC;";
                $result = $this->db->get_col($commentIdsSql);
            } else if ($searchField == "email") {
                $commentIdsSql = "SELECT `comment_ID` FROM `{$this->db->comments}` WHERE `comment_author_email` LIKE '%$data%' AND $condition ORDER BY `comment_ID` DESC;";
                $result = $this->db->get_col($commentIdsSql);
            } else if ($searchField == "custom_fields") {
                $wpdiscuz = wpDiscuz();
                $form = $wpdiscuz->wpdiscuzForm->getForm($post_id);
                $form->initFormFields();
                $customFields = $form->getFormCustomFields();
                if ($customFields && is_array($customFields)) {
                    $searchCustomFields = "";
                    foreach ($customFields as $cfKey => $cfVal) {
                        $searchCustomFields .= "'$cfKey',";
                    }
                    $searchCustomFields = trim($searchCustomFields, ",");
                    if ($searchCustomFields) {
                        $sql = "SELECT `comment_id`, `meta_value` FROM `{$this->db->commentmeta}` WHERE `comment_id` IN (SELECT `comment_ID` FROM `{$this->db->comments}` WHERE $condition) AND `meta_key` IN ($searchCustomFields) AND `meta_value` LIKE '%$data%' ORDER BY `comment_ID` DESC;";
                        $searchResult = $this->db->get_results($sql, ARRAY_A);
                        if ($searchResult && is_array($searchResult)) {
                            foreach ($searchResult as $res) {
                                $commentId = $res["comment_id"];
                                $metaValue = $res["meta_value"];
                                if ($metaValue) {
                                    $value = maybe_unserialize($metaValue);
                                    $data = wp_unslash($data);
                                    if (is_array($value)) {
                                        foreach ($value as $v) {
                                            $exists = stripos($v, $data) !== false;
                                            if ($exists && !in_array($commentId, $result)) {
                                                $result[] = $commentId;
                                            }
                                        }
                                    } else {
                                        $exists = stripos($value, $data) !== false;
                                        if ($exists && !in_array($commentId, $result)) {
                                            $result[] = $commentId;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                return $result;
            } else {
                // search field is all
                $sql = "SELECT `comment_ID` FROM `{$this->db->comments}` WHERE (`comment_author` LIKE '%$data%' OR `comment_author_email` LIKE '%$data%' OR `comment_content` LIKE '%$data%') AND $condition;";
                $result = $this->db->get_col($sql);
                if (!$allComments) {
                    $wpdiscuz = wpDiscuz();
                    $form = $wpdiscuz->wpdiscuzForm->getForm($post_id);
                    $form->initFormFields();
                    $customFields = $form->getFormCustomFields();
                    if ($customFields && is_array($customFields)) {
                        $searchCustomFields = "";
                        foreach ($customFields as $cfKey => $cfVal) {
                            $searchCustomFields .= "'$cfKey',";
                        }
                        $searchCustomFields = trim($searchCustomFields, ",");
                        if ($searchCustomFields) {
                            $sql = "SELECT `comment_id`, `meta_value` FROM `{$this->db->commentmeta}` WHERE `comment_id` IN (SELECT `comment_ID` FROM `{$this->db->comments}` WHERE $condition) AND `meta_key` IN ($searchCustomFields) AND `meta_value` LIKE '%$data%' ORDER BY `comment_ID` DESC;";
                            $searchResult = $this->db->get_results($sql, ARRAY_A);
                            if ($searchResult && is_array($searchResult)) {
                                foreach ($searchResult as $res) {
                                    $commentId = $res["comment_id"];
                                    $metaValue = $res["meta_value"];
                                    if (strlen($metaValue)) {
                                        $value = maybe_unserialize($metaValue);
                                        $data = wp_unslash($data);
                                        if (is_array($value)) {
                                            foreach ($value as $v) {
                                                $exists = stripos($v, $data) !== false;
                                                if ($exists && !in_array($commentId, $result)) {
                                                    $result[] = $commentId;
                                                }
                                            }
                                        } else {
                                            $exists = stripos($value, $data) !== false;
                                            if ($exists && !in_array($commentId, $result)) {
                                                $result[] = $commentId;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                return $result;
            }
        }
        return $result;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

}
