<?php
if (!class_exists("WP_List_Table")) {
    require_once( ABSPATH . "wp-admin/includes/class-wp-list-table.php" );
}

class wpdUserSubscriptionsList extends WP_List_Table {

    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = wp_get_current_user();
        parent::__construct([
            "singular" => "wpds_user_subscription",
            "plural" => "wpds_user_subscriptions",
            "ajax" => false
        ]);
    }

    public function get_columns() {
        $columns = [
            "cb" => "<input type='checkbox' />",
            "post_title" => __("Post Title", "wpdiscuz_sbm"),
            "actions" => __("Actions", "wpdiscuz_sbm"),
            "subscribtion_type" => __("Type", "wpdiscuz_sbm"),
            "subscription_date" => __("Date", "wpdiscuz_sbm"),
        ];
        return $columns;
    }

    public function column_cb($item) {
        return sprintf(
                '<input type="checkbox" name="%1$s[]" value="%2$s" />',
                /* $1%s */ $this->_args["singular"], //Let's simply repurpose the table's singular label ("movie")
                /* $2%s */ $item["id"]                //The value of the checkbox should be the record's id
        );
    }

    public function column_post_title($item) {
        $html = "";
        $htmlID = "bell-" . $item["id"];
        if ($item["confirm"] == 1) {
            $html .= "<i id='{$htmlID}' class='fas fa-bell wpds-confirmed' aria-hidden='true'  title='" . __("Confirmed", "wpdiscuz_sbm") . "'></i>";
        } else {
            $html .= "<i id='{$htmlID}' class='fas fa-bell-slash wpds-awaiting-confirmation' aria-hidden='true' title='" . __("Awaiting confirmation", "wpdiscuz_sbm") . "'></i>";
        }
        return $html .= $item["post_title"];
    }

    public function column_actions($item) {
        $html = "";
        $id = $item["id"];
        $actionUrl = wp_nonce_url(admin_url("admin-post.php?action=wpdiscuz_sbm_action&id=" . $id), "wpdiscuz-sbm", "wpdiscuz-sbm-nonce");
        if ($item["confirm"] == 1) {
            $html .= " <a href='" . $actionUrl . "&action-name=cancel'><i class='fas fa-bell-slash unconfirm wpds-awaiting-confirmation button' aria-hidden='true'  title='" . __("Cancel confirmation", "wpdiscuz_sbm") . "'></i></a>";
        } else {
            $html .= " <a href='" . $actionUrl . "&action-name=confirm'><i class='fas fa-bell confirm wpds-confirmed button' aria-hidden='true' title='" . __("Set as confirmed", "wpdiscuz_sbm") . "'></i></a>";
        }
        $html .= " <a href='" . $actionUrl . "&action-name=delete'><i class='fas fa-trash-alt delete wpds-delete button' aria-hidden='true'  title='" . __("Unsubscribe", "wpdiscuz_sbm") . "'></i></a>";
        return $html;
    }

    public function column_subscribtion_type($item) {
        $text = __("Post", "wpdiscuz_sbm");
        if ($item["subscribtion_type"] == "comment") {
            $text = __("Comment", "wpdiscuz_sbm");
        } elseif ($item["subscribtion_type"] == "all_comment") {
            $text = __("All Comments", "wpdiscuz_sbm");
        }
        return sprintf('<strong>%1$s</strong>', $text);
    }

    public function column_subscription_date($item) {
        return date_i18n(get_option("date_format"), strtotime($item["subscription_date"]));
    }

    public function column_default($item, $column_name) {
        return $item[$column_name];
    }

    public function extra_tablenav($which) {
        if ($which == "top") {
            $screen = get_current_screen();
            $dateArray = $this->db->getAllDate($this->user->user_email);
            $status = filter_input(INPUT_GET, "wpds_subscribe_confirm", FILTER_SANITIZE_NUMBER_INT);
            $type = filter_input(INPUT_GET, "wpds_subscribe_type", FILTER_SANITIZE_STRING);
            $_date = filter_input(INPUT_GET, "wpds_subscribe_date", FILTER_SANITIZE_STRING);
            ?>
            <select name="wpds_subscribe_confirm">
                <option value="" <?php selected($status, null); ?>><?php _e("All Status", "wpdiscuz_sbm"); ?></option>
                <option value="1" <?php selected($status, 1); ?>><?php _e("Confirmed", "wpdiscuz_sbm"); ?></option>
                <option value="0" <?php selected($status, 0); ?>><?php _e("Awaiting confirmation", "wpdiscuz_sbm"); ?></option>
            </select>
            <select name="wpds_subscribe_type">
                <option value="" <?php selected($type, null); ?>><?php _e("All Type", "wpdiscuz_sbm"); ?></option>
                <option value="post"  <?php selected($type, "post"); ?>><?php _e("Post", "wpdiscuz_sbm"); ?></option>
                <option value="all_comment"  <?php selected($type, "all_comment"); ?>><?php _e("All Comments", "wpdiscuz_sbm"); ?></option>
                <option value="comment" <?php selected($type, "comment"); ?>><?php _e("Comment", "wpdiscuz_sbm"); ?></option>
            </select>
            <select name="wpds_subscribe_date">
                <option value=""><?php _e("All Dates", "wpdiscuz_sbm") ?></option>
                <?php
                foreach ($dateArray as $date) {
                    ?>
                    <option value="<?php echo $date; ?>" <?php selected($_date, $date); ?>><?php echo date_i18n("F , Y", strtotime($date . "-01")); ?></option>
                    <?php
                }
                ?>
            </select>
            <input  class="button" name="filter_action" value="<?php _e("Filter", "wpdiscuz_sbm"); ?>" type="submit">
            <a  class="reset-button" href="<?php echo admin_url($screen->parent_file . "?page=" . wpdSubscribeManager::WPDS_USER_SLUG); ?>"><?php _e("Reset Filters", "wpdiscuz_sbm"); ?></a>
            <?php
        }
    }

    public function get_sortable_columns() {
        $sortable_columns = [
            "subscribtion_type" => ["subscribtion_type", false],
            "subscription_date" => ["subscription_date", false],
        ];
        return $sortable_columns;
    }

    public function get_bulk_actions() {
        $actions = [
            "confirm" => __("Set as confirmed", "wpdiscuz_sbm"),
            "cancel" => __("Cancel confirmation", "wpdiscuz_sbm"),
            "delete" => __("Unsubscribe ", "wpdiscuz_sbm")
        ];
        return $actions;
    }

    public function process_bulk_action() {
        $subscriptions = filter_input(INPUT_GET, "wpds_user_subscription", FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
        $nonce = filter_input(INPUT_GET, "_wpnonce", FILTER_SANITIZE_STRING);
        if ($this->user->user_email && wp_verify_nonce($nonce, "bulk-" . $this->_args["plural"]) && $subscriptions) {
            if ("confirm" === $this->current_action()) {
                $this->db->bulkChangeConfirmationStatus($subscriptions, 1, $this->user->user_email);
            }
            if ("cancel" === $this->current_action()) {
                $this->db->bulkChangeConfirmationStatus($subscriptions, 0, $this->user->user_email);
            }
            if ("delete" === $this->current_action()) {
                $this->db->bulkDeleteSubscription($subscriptions, $this->user->user_email);
            }
        }
    }

    public function prepare_items() {
        $per_page = $this->get_items_per_page("subscriptions_per_page");
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];

        $this->process_bulk_action();
        $total_items = $this->db->subscriptionsCount($this->user->user_email);
        $data = $this->_getSubscriptions($per_page, $total_items);
        $this->items = $data;

        $this->set_pagination_args([
            "total_items" => $total_items,
            "per_page" => $per_page,
            "total_pages" => ceil($total_items / $per_page)
        ]);
    }

    private function _getSubscriptions($per_page, $total_items) {
        $data = [];
        if ($this->user->user_email) {
            $current_page = $this->get_pagenum();
            $data = $this->db->getSubscriptions($per_page, $current_page, $this->user->user_email);
            if (!$data && $total_items) {
                $data = $this->db->getSubscriptions($per_page, $current_page - 1);
            }
            if ($data) {
                for ($i = 0; $i < count($data); $i ++) {
                    $row = $data[$i];
                    $data[$i] = $this->addPostname($row);
                }
            }
        }
        return $data;
    }

    private function addPostname($row) {
        if ($row["subscribtion_type"] == "comment") {
            $row["post_title"] = "<a target='_blank' class='subscribe-post-link' href='" . get_comment_link($row["subscribtion_id"]) . "'>" . get_the_title($row["post_id"]) . "</a>";
        } else {
            $row["post_title"] = "<a target='_blank' class='subscribe-post-link' href='" . get_the_permalink($row["subscribtion_id"]) . "'>" . get_the_title($row["post_id"]) . "</a>";
        }
        return $row;
    }

}
