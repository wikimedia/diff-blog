<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzFlagHelperAjax {

    private $dbManager;
    private $options;

    public function __construct($dbManager, $options) {
        $this->dbManager = $dbManager;
        $this->options = $options;

        add_action("wp_ajax_nopriv_fcReport", [$this, "fcReport"]);
        add_action("wp_ajax_fcReport", [$this, "fcReport"]);
        add_action("wp_ajax_nopriv_fcReportEmail", [$this, "fcReportEmail"]);
        add_action("wp_ajax_fcReportEmail", [$this, "fcReportEmail"]);
    }

    public function fcReport() {
        $response = ["code" => 0];
        $commentId = isset($_POST["commentId"]) && ($cId = intval($_POST["commentId"])) ? $cId : false;
        if ($commentId) {
            $wpdiscuz = wpDiscuz();
            $userIp = $wpdiscuz->helper->getRealIPAddr();
            if ($commentId && $userIp) {
                $currentUser = wp_get_current_user();
                $userId = (isset($currentUser->ID) && $currentUser->ID) ? $currentUser->ID : 0;
                $isFlagged = $this->dbManager->isFlagged($commentId, $userId, $userIp);
                if ($isFlagged) {
                    $response["message"] = __($this->options->alreadyFlagged, "wpdiscuz_fc");
                } else {
                    $result = $this->dbManager->insertFlaggedData($commentId, $userId, $userIp);
                    if ($result) {
                        $response["code"] = 1;
                        $response["message"] = __("Flagged", "wpdiscuz_fc");
                        do_action("wpdiscuz_comment_flagged", $commentId);
                    } else {
                        $response["message"] = $this->options->dataNotInserted;
                    }
                }
            }
        }
        wp_die(json_encode($response));
    }

    public function fcReportEmail() {
        $response = ["code" => 0, "commentId" => 0];
        if (isset($_POST["form"])) {
            $wpdiscuz = wpDiscuz();
            parse_str($_POST["form"], $data);
            $commentId = isset($data["commentId"]) && ($cId = intval($data["commentId"])) ? $cId : false;
            $report = isset($data["wpdiscuz_report"]) && ($r = trim($data["wpdiscuz_report"])) ? $r : "";
            $message = isset($data["wpdiscuz_message"]) && ($m = trim($data["wpdiscuz_message"])) ? $m : "";
            $userIp = $wpdiscuz->helper->getRealIPAddr();
            if ($commentId && $userIp) {
                $response["commentId"] = $commentId;
                $currentUser = wp_get_current_user();
                $userId = (isset($currentUser->ID) && $currentUser->ID) ? $currentUser->ID : 0;
                $isFlagged = $this->dbManager->isFlagged($commentId, $userId, $userIp);
                if ($isFlagged) {
                    $response["message"] = __($this->options->alreadyFlagged, "wpdiscuz_fc");
                } else {
                    if (!$report) {
                        $response["message"] = __($this->options->checkReportType, "wpdiscuz_fc");
                        wp_die(json_encode($response));
                    } else if ($report == "other" && !$message) {
                        $response["message"] = __($this->options->fillMsgField, "wpdiscuz_fc");
                        wp_die(json_encode($response));
                    } else {
                        $result = $this->dbManager->insertFlaggedData($commentId, $userId, $userIp);
                        if ($result) {
                            $response["code"] = 1;
                            $response["message"] = __("Flagged", "wpdiscuz_fc");
                            do_action("wpdiscuz_comment_flagged_email", $commentId, $report, $message);
                        } else {
                            $response["message"] = $this->options->dataNotInserted;
                        }
                    }
                }
            }
        }
        wp_die(json_encode($response));
    }

}
