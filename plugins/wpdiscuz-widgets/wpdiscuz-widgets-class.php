<?php

class wpDiscuzWidgetsClass extends WP_Widget {

    private $options;
    private $version;
    private $db_prefix;
    private $widget_date_format;
    private $all_comments_count;

    public function __construct() {
        parent::__construct("wpDiscuzWidgets", esc_html__("wpDiscuz Widgets", "wpdiscuz-widgets"), ["description" => esc_html__("A Widget displays tabs about comments statistic", "wpdiscuz-widgets")]);
        $this->getOptions();
        $this->all_comments_count = get_comments([
            "status" => "approve",
            "count" => true
        ]);
        add_filter("wp_enqueue_scripts", [&$this, "wpdiscuz_widgets_comment_vot_styles"], 150);
    }

    public function getOptions() {
        $this->version = get_option("widgetPluginVersion");
        $this->options = get_option("widget_options_array");
        $this->widget_date_format = get_option("date_format");
    }

    /**
     * 
     * @param type $instance
     * for creating settings fields
     */
    public function form($instance) {
        /**
         * variables for titles of the widget's tabs
         */
        $title_most_voted = isset($instance["title_most_voted"]) ? $instance["title_most_voted"] : "Most Voted Comments ";
        $title_popular_authors = isset($instance["title_popular_authors"]) ? $instance["title_popular_authors"] : "Most Active Commenters";
        $title_popular_posts = isset($instance["title_popular_posts"]) ? $instance["title_popular_posts"] : "Most Commented Posts";
        $title_active_threads = isset($instance["title_active_threads"]) ? $instance["title_active_threads"] : "Active Comment Threads";
        $title_recent_comments = isset($instance["title_recent_comments"]) ? $instance["title_recent_comments"] : "Recent Comments";

        /**
         * variables for counts of comments in the tabs 
         */
        $count_most_voted = isset($instance["count_most_voted"]) ? abs($instance["count_most_voted"]) : 5;
        $count_popular_authors = isset($instance["count_popular_authors"]) ? abs($instance["count_popular_authors"]) : 5;
        $count_popular_posts = isset($instance["count_popular_posts"]) ? abs($instance["count_popular_posts"]) : 5;
        $count_active_threads = isset($instance["count_active_threads"]) ? abs($instance["count_active_threads"]) : 5;
        $count_recent_comments = isset($instance["count_recent_comments"]) ? abs($instance["count_recent_comments"]) : 5;

        /**
         * variables for tabs ordering
         */
        $tab_order_most_voted = isset($instance["tab_order_most_voted"]) ? $instance["tab_order_most_voted"] : 1;
        $tab_order_active_threads = isset($instance["tab_order_active_threads"]) ? $instance["tab_order_active_threads"] : 2;
        $tab_order_popular_posts = isset($instance["tab_order_popular_posts"]) ? $instance["tab_order_popular_posts"] : 3;
        $tab_order_popular_authors = isset($instance["tab_order_popular_authors"]) ? $instance["tab_order_popular_authors"] : 4;
        $tab_order_recent_comments = isset($instance["tab_order_recent_comments"]) ? $instance["tab_order_recent_comments"] : 5;

        /**
         * variables for date interval (e.g. last week )
         */
        $most_voted_date_interval = isset($instance["most_voted_date_interval"]) ? $instance["most_voted_date_interval"] : "all_time";
        $popular_authors_date_interval = isset($instance["popular_authors_date_interval"]) ? $instance["popular_authors_date_interval"] : "all_time";
        $popular_posts_date_interval = isset($instance["popular_posts_date_interval"]) ? $instance["popular_posts_date_interval"] : "all_time";
        if (isset($instance["active_threads_date_interval"])) {
            $active_threads_date_interval = $instance["active_threads_date_interval"];
        } else {
            $active_threads_date_interval = $this->all_comments_count < 20000 ? "all_time" : 30;
        }

        /**
         * variables for custom date interval (e.g. 02-02-2016 - 05-05-2016 )
         */
        // @from
        $most_voted_from_date = isset($instance["most_voted_from_date"]) ? $instance["most_voted_from_date"] : "";
        $popular_authors_from_date = isset($instance["popular_authors_from_date"]) ? $instance["popular_authors_from_date"] : "";
        $popular_posts_from_date = isset($instance["popular_posts_from_date"]) ? $instance["popular_posts_from_date"] : "";
        $active_threads_from_date = isset($instance["active_threads_from_date"]) ? $instance["active_threads_from_date"] : "";

        // @to
        $most_voted_to_date = isset($instance["most_voted_to_date"]) ? $instance["most_voted_to_date"] : "";
        $popular_authors_to_date = isset($instance["popular_authors_to_date"]) ? $instance["popular_authors_to_date"] : "";
        $popular_posts_to_date = isset($instance["popular_posts_to_date"]) ? $instance["popular_posts_to_date"] : "";
        $active_threads_to_date = isset($instance["active_threads_to_date"]) ? $instance["active_threads_to_date"] : "";


        /**
         * variables for checkboxes
         */
        $most_voted_tab = isset($instance["most_voted_tab"]) ? $instance["most_voted_tab"] : "";
        $popular_posts_tab = isset($instance["popular_posts_tab"]) ? $instance["popular_posts_tab"] : "";
        $most_active_tab = isset($instance["most_active_tab"]) ? $instance["most_active_tab"] : "";
        $popular_authors_tab = isset($instance["popular_authors_tab"]) ? $instance["popular_authors_tab"] : "";
        $recent_comments_tab = isset($instance["recent_comments_tab"]) ? $instance["recent_comments_tab"] : "";

        /**
         * getting names and ids of the input fields using the functions get_field_id() and get_filed_name()
         */
        //       title most voted
        $title_most_votedId = $this->get_field_id("title_most_voted");
        $title_most_votedName = $this->get_field_name("title_most_voted");
        //       title popular authors
        $title_popular_authorsId = $this->get_field_id("title_popular_authors");
        $title_popular_authorsName = $this->get_field_name("title_popular_authors");
        //       title popular posts
        $title_popular_postsId = $this->get_field_id("title_popular_posts");
        $title_popular_postsName = $this->get_field_name("title_popular_posts");
        //       title active threads  
        $title_active_threadsId = $this->get_field_id("title_active_threads");
        $title_active_threadsName = $this->get_field_name("title_active_threads");
        //       title recent comments
        $title_recent_commentsID = $this->get_field_id("title_recent_comments");
        $title_recent_commentsName = $this->get_field_name("title_recent_comments");
        //       
        //       count most voted
        $count_most_votedId = $this->get_field_id("count_most_voted");
        $count_most_votedName = $this->get_field_name("count_most_voted");
        //       count popular authors
        $count_popular_authorsId = $this->get_field_id("count_popular_authors");
        $count_popular_authorsName = $this->get_field_name("count_popular_authors");
        //       count popular posts
        $count_popular_postsId = $this->get_field_id("count_popular_posts");
        $count_popular_postsName = $this->get_field_name("count_popular_posts");
        //       count active threads  
        $count_active_threadsId = $this->get_field_id("count_active_threads");
        $count_active_threadsName = $this->get_field_name("count_active_threads");
        //       count active threads  
        $count_recent_commentsId = $this->get_field_id("count_recent_comments");
        $count_recent_commentsName = $this->get_field_name("count_recent_comments");

        //      date interval type
        $most_voted_date_intervalId = $this->get_field_id("most_voted_date_interval");
        $most_voted_date_intervalName = $this->get_field_name("most_voted_date_interval");

        $popular_authors_date_intervalId = $this->get_field_id("popular_authors_date_interval");
        $popular_authors_date_intervalName = $this->get_field_name("popular_authors_date_interval");

        $popular_posts_date_intervalId = $this->get_field_id("popular_posts_date_interval");
        $popular_posts_date_intervalName = $this->get_field_name("popular_posts_date_interval");

        $active_threads_date_intervalId = $this->get_field_id("active_threads_date_interval");
        $active_threads_date_intervalName = $this->get_field_name("active_threads_date_interval");

        //       tab ordering most voted
        $tab_order_most_votedId = $this->get_field_id("tab_order_most_voted");
        $tab_order_most_votedName = $this->get_field_name("tab_order_most_voted");
        //       tab ordering popular authors
        $tab_order_popular_authorsId = $this->get_field_id("tab_order_popular_authors");
        $tab_order_popular_authorsName = $this->get_field_name("tab_order_popular_authors");
        //       tab ordering popular posts
        $tab_order_popular_postsId = $this->get_field_id("tab_order_popular_posts");
        $tab_order_popular_postsName = $this->get_field_name("tab_order_popular_posts");
        //       tab ordering active threads  
        $tab_order_active_threadsId = $this->get_field_id("tab_order_active_threads");
        $tab_order_active_threadsName = $this->get_field_name("tab_order_active_threads");
        //       tab ordering active threads  
        $tab_order_recent_commentsId = $this->get_field_id("tab_order_recent_comments");
        $tab_order_recent_commentsName = $this->get_field_name("tab_order_recent_comments");

        /**
         *  custom date interval
         */
        $most_voted_from_dateId = $this->get_field_id("most_voted_from_date");
        $most_voted_from_dateName = $this->get_field_name("most_voted_from_date");
        $most_voted_to_dateId = $this->get_field_id("most_voted_to_date");
        $most_voted_to_dateName = $this->get_field_name("most_voted_to_date");

        $popular_authors_from_dateId = $this->get_field_id("popular_authors_from_date");
        $popular_authors_from_dateName = $this->get_field_name("popular_authors_from_date");
        $popular_authors_to_dateId = $this->get_field_id("popular_authors_to_date");
        $popular_authors_to_dateName = $this->get_field_name("popular_authors_to_date");

        $popular_posts_from_dateId = $this->get_field_id("popular_posts_from_date");
        $popular_posts_from_dateName = $this->get_field_name("popular_posts_from_date");
        $popular_posts_to_dateId = $this->get_field_id("popular_posts_to_date");
        $popular_posts_to_dateName = $this->get_field_name("popular_posts_to_date");

        $active_threads_from_dateId = $this->get_field_id("active_threads_from_date");
        $active_threads_from_dateName = $this->get_field_name("active_threads_from_date");
        $active_threads_to_dateId = $this->get_field_id("active_threads_to_date");
        $active_threads_to_dateName = $this->get_field_name("active_threads_to_date");

        //      most voted tab checkbox
        $most_voted_tabId = $this->get_field_id("most_voted_tab");
        $most_voted_tabName = $this->get_field_name("most_voted_tab");
        //      most active tab checkbox
        $most_active_tabId = $this->get_field_id("most_active_tab");
        $most_active_tabName = $this->get_field_name("most_active_tab");
        //      popular posts tab checkbox
        $popular_posts_tabId = $this->get_field_id("popular_posts_tab");
        $popular_posts_tabName = $this->get_field_name("popular_posts_tab");
        //      popular authors tab checkbox
        $popular_authors_tabId = $this->get_field_id("popular_authors_tab");
        $popular_authors_tabName = $this->get_field_name("popular_authors_tab");
        //      recent comments tab checkbox
        $recent_commentsId = $this->get_field_id("recent_comments_tab");
        $recent_comments_tabName = $this->get_field_name("recent_comments_tab");

        include WIDG_DIR_PATH . "/options/widget-admin-panel-html.php";
    }

    /**
     * 
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     * update values 
     */
    public function update($new_instance, $old_instance) {
        $values = [];
        $values["title_most_voted"] = htmlentities($new_instance["title_most_voted"]);
        $values["title_popular_authors"] = htmlentities($new_instance["title_popular_authors"]);
        $values["title_popular_posts"] = htmlentities($new_instance["title_popular_posts"]);
        $values["title_active_threads"] = htmlentities($new_instance["title_active_threads"]);
        $values["title_recent_comments"] = htmlentities($new_instance["title_recent_comments"]);
        $values["count_most_voted"] = abs($new_instance["count_most_voted"]);
        $values["count_popular_authors"] = abs($new_instance["count_popular_authors"]);
        $values["count_popular_posts"] = abs($new_instance["count_popular_posts"]);
        $values["count_active_threads"] = abs($new_instance["count_active_threads"]);
        $values["count_recent_comments"] = abs($new_instance["count_recent_comments"]);

        $values["tab_order_most_voted"] = abs($new_instance["tab_order_most_voted"]);
        $values["tab_order_popular_authors"] = abs($new_instance["tab_order_popular_authors"]);
        $values["tab_order_popular_posts"] = abs($new_instance["tab_order_popular_posts"]);
        $values["tab_order_active_threads"] = abs($new_instance["tab_order_active_threads"]);
        $values["tab_order_recent_comments"] = abs($new_instance["tab_order_recent_comments"]);


        $values["most_voted_date_interval"] = $new_instance["most_voted_date_interval"];
        $values["popular_authors_date_interval"] = $new_instance["popular_authors_date_interval"];
        $values["popular_posts_date_interval"] = $new_instance["popular_posts_date_interval"];
        $values["active_threads_date_interval"] = $new_instance["active_threads_date_interval"];


        $values["most_voted_from_date"] = $new_instance["most_voted_from_date"];
        $values["most_voted_to_date"] = $new_instance["most_voted_to_date"];
        $values["popular_authors_from_date"] = $new_instance["popular_authors_from_date"];
        $values["popular_authors_to_date"] = $new_instance["popular_authors_to_date"];
        $values["popular_posts_from_date"] = $new_instance["popular_posts_from_date"];
        $values["popular_posts_to_date"] = $new_instance["popular_posts_to_date"];
        $values["active_threads_from_date"] = $new_instance["active_threads_from_date"];
        $values["active_threads_to_date"] = $new_instance["active_threads_to_date"];



        $values["most_voted_tab"] = isset($new_instance["most_voted_tab"]) ? $new_instance["most_voted_tab"] : "off";
        $values["popular_posts_tab"] = isset($new_instance["popular_posts_tab"]) ? $new_instance["popular_posts_tab"] : "off";
        $values["most_active_tab"] = isset($new_instance["most_active_tab"]) ? $new_instance["most_active_tab"] : "off";
        $values["popular_authors_tab"] = isset($new_instance["popular_authors_tab"]) ? $new_instance["popular_authors_tab"] : "off";
        $values["recent_comments_tab"] = isset($new_instance["recent_comments_tab"]) ? $new_instance["recent_comments_tab"] : "off";

        return $values;
    }

    /**
     * 
     * @global object $wpdb
     * @param array $args
     * @param array $instance
     * 
     */
    public function widget($args, $instance) {

        $dateIntervalCurrent = self::getDateIntervals(0);

        $title_most_voted = isset($instance["title_most_voted"]) ? $instance["title_most_voted"] : "";
        $title_active_threads = isset($instance["title_active_threads"]) ? $instance["title_active_threads"] : "";
        $title_popular_posts = isset($instance["title_popular_posts"]) ? $instance["title_popular_posts"] : "";
        $title_popular_authors = isset($instance["title_popular_authors"]) ? $instance["title_popular_authors"] : "";
        $title_recent_comments = isset($instance["title_recent_comments"]) ? $instance["title_recent_comments"] : "";

        $count_most_voted = isset($instance["count_most_voted"]) && ($c_m_v = $instance["count_most_voted"] > 0) ? intval($instance["count_most_voted"]) : 0;
        $count_popular_authors = isset($instance["count_popular_authors"]) && ($c_p_a = $instance["count_popular_authors"] > 0) ? intval($instance["count_popular_authors"]) : 0;
        $count_popular_posts = isset($instance["count_popular_posts"]) && ($c_p_p = $instance["count_popular_posts"] > 0) ? intval($instance["count_popular_posts"]) : 0;
        $count_active_threads = isset($instance["count_active_threads"]) && ($c_a_t = $instance["count_active_threads"] > 0) ? intval($instance["count_active_threads"]) : 0;
        $count_recent_comments = isset($instance["count_recent_comments"]) && ($c_a_t = $instance["count_recent_comments"] > 0) ? intval($instance["count_recent_comments"]) : 0;

        $tab_order_most_voted = isset($instance["tab_order_most_voted"]) ? intval($instance["tab_order_most_voted"]) : 1;
        $tab_order_active_threads = isset($instance["tab_order_active_threads"]) ? intval($instance["tab_order_active_threads"]) : 2;
        $tab_order_popular_posts = isset($instance["tab_order_popular_posts"]) ? intval($instance["tab_order_popular_posts"]) : 3;
        $tab_order_popular_authors = isset($instance["tab_order_popular_authors"]) ? intval($instance["tab_order_popular_authors"]) : 4;
        $tab_order_recent_comments = isset($instance["tab_order_recent_comments"]) ? intval($instance["tab_order_recent_comments"]) : 5;

        $most_voted_tab = isset($instance["most_voted_tab"]) ? $instance["most_voted_tab"] : "off";
        $popular_posts_tab = isset($instance["popular_posts_tab"]) ? $instance["popular_posts_tab"] : "off";
        $most_active_tab = isset($instance["most_active_tab"]) ? $instance["most_active_tab"] : "off";
        $popular_authors_tab = isset($instance["popular_authors_tab"]) ? $instance["popular_authors_tab"] : "off";
        $recent_comments_tab = isset($instance["recent_comments_tab"]) ? $instance["recent_comments_tab"] : "off";

        $most_voted_date_interval = isset($instance["most_voted_date_interval"]) ? $instance["most_voted_date_interval"] : "all_time";
        $popular_posts_date_interval = isset($instance["popular_posts_date_interval"]) ? $instance["popular_posts_date_interval"] : "all_time";
        if (isset($instance["active_threads_date_interval"])) {
            $active_threads_date_interval = $instance["active_threads_date_interval"];
        } else {
            $active_threads_date_interval = $this->all_comments_count < 20000 ? "all_time" : 30;
        }
        $popular_authors_date_interval = isset($instance["popular_authors_date_interval"]) ? $instance["popular_authors_date_interval"] : "all_time";

        $most_voted_from_date = (isset($instance["most_voted_from_date"]) && $instance["most_voted_from_date"] != "") ? $instance["most_voted_from_date"] : $dateIntervalCurrent["to"];
        $popular_posts_from_date = (isset($instance["popular_posts_from_date"]) && $instance["popular_posts_from_date"] != "") ? $instance["popular_posts_from_date"] : $dateIntervalCurrent["to"];
        $active_threads_from_date = (isset($instance["active_threads_from_date"]) && $instance["active_threads_from_date"] != "") ? $instance["active_threads_from_date"] : $dateIntervalCurrent["to"];
        $popular_authors_from_date = (isset($instance["popular_authors_from_date"]) && $instance["popular_authors_from_date"] != "") ? $instance["popular_authors_from_date"] : $dateIntervalCurrent["to"];

        $most_voted_to_date = (isset($instance["most_voted_to_date"]) && $instance["most_voted_to_date"] != "") ? $instance["most_voted_to_date"] : $dateIntervalCurrent["to"];
        $popular_posts_to_date = (isset($instance["popular_posts_to_date"]) && $instance["popular_posts_to_date"] != "") ? $instance["popular_posts_to_date"] : $dateIntervalCurrent["to"];
        $active_threads_to_date = (isset($instance["active_threads_to_date"]) && $instance["active_threads_to_date"] != "") ? $instance["active_threads_to_date"] : $dateIntervalCurrent["to"];
        $popular_authors_to_date = (isset($instance["popular_authors_to_date"]) && $instance["popular_authors_to_date"] != "") ? $instance["popular_authors_to_date"] : $dateIntervalCurrent["to"];

        extract($args);
        global $wpdb;
        $this->db_prefix = $wpdb->prefix;
        $is_slider = "";
        $checked_tabs_array = [];
        if ($most_voted_tab == "on")
            $checked_tabs_array[] = 1;
        if ($popular_posts_tab == "on")
            $checked_tabs_array[] = 1;
        if ($most_active_tab == "on")
            $checked_tabs_array[] = 1;
        if ($popular_authors_tab == "on")
            $checked_tabs_array[] = 1;
        if ($recent_comments_tab == "on")
            $checked_tabs_array[] = 1;


        if (count($checked_tabs_array) > 0) {
            echo $before_widget;
            ?>
            <div class="widget-comments-container" id="widget-comments-container">
                <?php if (count($checked_tabs_array) <= 1) { ?>
                    <hr style="margin:0">
                    <?php
                    if ($this->options["wpdiscuz_widget_slider_enable"] === 1) {
                        $is_slider = "wpd_widgets_slider_wrapper";
                    }
                } else {
                    ?>
                    <ul class="wpdiscuz-widgets-tab-title-list">
                        <?php if ($most_voted_tab === "on") { ?>                        
                            <li style="order: <?php echo $tab_order_most_voted; ?>" data-tab-order="<?php echo $tab_order_most_voted; ?>" class="most-voted" title="<?php _e("Most voted comments", "wpdiscuz-widgets"); ?>">
                                <a  href="#wpdiscuz-most-voted-comments-box" id=""><i class="fas fa-thumbs-up"></i></a>
                            </li>
                            <?php
                        }
                        if ($most_active_tab === "on") {
                            ?>
                            <li style="order: <?php echo $tab_order_active_threads; ?>" data-tab-order="<?php echo $tab_order_active_threads; ?>" class="most-active" title="<?php _e("Most active comment threads", "wpdiscuz-widgets"); ?>">
                                <a href="#most-active-comment-threads" id=""><i class="fas fa-fire"></i></a>
                            </li>
                            <?php
                        }
                        if ($popular_posts_tab === "on") {
                            ?>
                            <li style="order: <?php echo $tab_order_popular_posts; ?>" data-tab-order="<?php echo $tab_order_popular_posts; ?>" class="popular-posts" title="<?php _e("Most commented posts", "wpdiscuz-widgets"); ?>">
                                <a href="#wpdiscuz-popular-posts-bycomment" id=""><i class="fas fa-star"></i></a>
                            </li>
                            <?php
                        }
                        if ($popular_authors_tab === "on") {
                            ?>
                            <li style="order: <?php echo $tab_order_popular_authors; ?>" data-tab-order="<?php echo $tab_order_popular_authors; ?>" class="popular-authors" title="<?php _e("Most active commenters", "wpdiscuz-widgets"); ?>">
                                <a href="#popular-comment-authors" id=""><i class="fas fa-users"></i></a>
                            </li>
                            <?php
                        }
                        if ($recent_comments_tab === "on") {
                            ?>
                            <li style="order: <?php echo $tab_order_recent_comments; ?>" data-tab-order="<?php echo $tab_order_recent_comments; ?>" class="wpd-wid-recent-comments" title="<?php _e("Recent comments", "wpdiscuz-widgets"); ?>">
                                <a href="#wpdiscuz-recent-comments-box" id=""><i class="fas fa-comments"></i></a>
                            </li>
                        <?php } ?>
                    </ul>

                <?php } ?>

                <div class="wpdiscuz-widgets-content <?php echo $is_slider; ?>">
                    <?php
                    /**
                     * 
                     */
                    if ($this->options["wpdiscuz_widget_content_cutting"]) {
                        $cont_w_count = $this->options["wpdiscuz_widgets_post_content_word_count"];
                    } else {
                        $cont_w_count = 10;
                    }
                    $content_more = $cont_w_count > 0 ? " ..." : "";
                    /**
                     * including tabs html-s
                     */
                    if ($most_voted_tab === "on") {
                        include WIDG_DIR_PATH . "/tabs/most-voted.php";
                    }

                    if ($most_active_tab === "on") {
                        include WIDG_DIR_PATH . "/tabs/most-active-comment-threads.php";
                    }

                    if ($popular_posts_tab === "on") {
                        include WIDG_DIR_PATH . "/tabs/popular-post-by-comment.php";
                    }

                    if ($popular_authors_tab === "on") {
                        include WIDG_DIR_PATH . "/tabs/popular-comment-authors.php";
                    }

                    if ($recent_comments_tab === "on") {
                        include WIDG_DIR_PATH . "/tabs/recent-comments.php";
                    }
                    ?>  
                </div>
            </div>
            <?php
            echo $after_widget;
        }
    }

    /**
     * function for getting $from and $to dates
     */
    public static function getMysqlDate() {
        return current_time("mysql");
    }

    public static function getTimeStamp() {
        return current_time("timestamp");
    }

    public static function getDateIntervals($last, $dateFormat = "Y-m-d") {
        $interval = [];
        $mysqlDate = self::getMysqlDate();
        $timestamp = self::getTimeStamp();
        if ($last !== "" && intval($last) === 0) { // today
            $interval["from"] = date($dateFormat, $timestamp);
            $datetime = new DateTime($interval["from"]);
            $datetime->modify("+1 day");
            $interval["to"] = $datetime->format($dateFormat);
        } else if ($last !== "" && intval($last) === 1) { // yesterday
            $modify = "-1 day";
            $datetime = new DateTime($mysqlDate);
            $datetime->modify($modify);
            $datetime2 = new DateTime($mysqlDate);
            $datetime2->modify($modify);
            $interval["from"] = $datetime->format($dateFormat);
            $interval["to"] = $datetime2->format($dateFormat);
        } else if ($last !== "" && intval($last) > 0) { // last X days 
            $datetime = new DateTime($mysqlDate);
            $modify = "-" . $last . " day";
            $datetime->modify($modify);
            $interval["from"] = $datetime->format($dateFormat);
            $interval["to"] = date($dateFormat, $timestamp);
        } else { // all time
            $interval["from"] = date($dateFormat, 1);
            $interval["to"] = date($dateFormat, $timestamp);
        }
        return $interval;
    }

    /**
     * getting comment author display-name
     */
    public function getCommentAuthor($comment_arg) {
        if ($comment_arg->user_id == 0) {
            $get_guest_email = $comment_arg->comment_author_email;
            $comment_auth = $comment_arg->comment_author;
        } else {
            $get_author = get_user_by("ID", $comment_arg->user_id);
            $comment_auth = $get_author->data->display_name;
        }
        return $comment_auth;
    }

    /**
     * Connecting css and js files to front page
     */
    public function wpdiscuz_widgets_comment_vot_styles() {
        $wpdiscuz = wpDiscuz();
        $suf = $wpdiscuz->options->general["loadMinVersion"] ? ".min" : "";
        if ($wpdiscuz->options->thread_styles["enableFontAwesome"]) {
            wp_enqueue_style("wpdiscuz-font-awesome");
        }
        wp_register_style("wpdiscuz_widgets_comm_vot_style", plugins_url("/assets/css/style$suf.css", __FILE__), null, $this->version);
        wp_enqueue_style("wpdiscuz_widgets_comm_vot_style");
        wp_register_script("wpdiscuz_widgets_comm_vot_script", plugins_url("/assets/js/script$suf.js", __FILE__), ["jquery"], $this->version, true);
        wp_enqueue_script("wpdiscuz_widgets_comm_vot_script");
        if ($this->options["wpdiscuz_widget_slider_enable"] === 1) {
            wp_register_style("wpdiscuz_widgets_slick_style", plugins_url("/assets/third-party/slick/slick.min.css", __FILE__), null, $this->version);
            wp_enqueue_style("wpdiscuz_widgets_slick_style");
            wp_register_script("wpdiscuz_widgets_slick_script", plugins_url("/assets/third-party/slick/slick.min.js", __FILE__), ["jquery"], $this->version, true);
            wp_enqueue_script("wpdiscuz_widgets_slick_script");
        }
    }

}
?>