<?php
include_once WPDS_DIR_PATH . "/options/wpDiscuzCommentSearchOption.php";
include_once WPDS_DIR_PATH . "/includes/wcsDBManager.php";

class wpDiscuzCommentSearchWidget extends WP_Widget {

    private $options;
    private $dbManager;

    function __construct() {
        parent::__construct("wpdiscuz_search_widget", __("wpDiscuz Commet Search Widget", "wpdiscuz-search"), ["description" => __("This widget for wpDiscuz comments", "wpdiscuz-search"),]);
        $this->options = new wpDiscuzCommentSearchOption();
        $this->dbManager = new SearchDBManager();
    }

    public function widget($args, $instance) {
        $title = apply_filters("widget_title", $instance["title"]);
        echo $args["before_widget"];
        echo "<div class='wrapper' style='border: 1px solid #ccc; padding: 10px 20px; border-radius: 2px;'>";
        if (!empty($title)) {
            echo $args["before_title"] . "<center><h1 style='font-size: 15px; font-face: verdana; margin: 7px auto;'> $title </h1></center>" . $args["after_title"];
        }
        include WPDS_DIR_PATH . "/search-form-all-comments.php";
        echo "</div>";
        echo $args["after_widget"];
    }

    public function form($instance) {
        $title = isset($instance["title"]) ? $instance["title"] : __("Comment Search", "wpdiscuz-search");
        $post_count = isset($instance["widget_display_post_count"]) ? $instance["widget_display_post_count"] : 5;
        $display_avatar = isset($instance["widget_display_avatar"]) ? $instance["widget_display_avatar"] : "off";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title"); ?>"><?php _e("Title:"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("widget_display_post_count"); ?>"><?php _e("Number of comments to show:", "wpdiscuz-search"); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id("widget_display_post_count"); ?>" name="<?php echo $this->get_field_name("widget_display_post_count"); ?>" value="<?php echo esc_attr($post_count); ?>" step="1" min="1" size="4" type="number" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("widget_display_avatar"); ?>"><?php _e("Display comment author avatar?", "wpdiscuz-search"); ?></label>
            <input class="checkbox" id="<?php echo $this->get_field_id("widget_display_avatar"); ?>" name="<?php echo $this->get_field_name("widget_display_avatar"); ?>" <?php echo $display_avatar == "on" ? "checked='checked'" : ""; ?> type="checkbox" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance["title"] = (!empty($new_instance["title"]) ) ? strip_tags($new_instance["title"]) : __("Comment Search", "wpdiscuz-search");
        $instance["widget_display_post_count"] = isset($new_instance["widget_display_post_count"]) ? intval($new_instance["widget_display_post_count"]) : 5;
        $instance["widget_display_avatar"] = isset($new_instance["widget_display_avatar"]) ? $new_instance["widget_display_avatar"] : "off";
        $options = [
            "widget_title" => $instance["title"],
            "widget_display_post_count" => $instance["widget_display_post_count"],
            "widget_display_avatar" => $instance["widget_display_avatar"],
        ];
        update_option("widget_wpdiscuz_search_widget_options", $options);
        return $instance;
    }

}
