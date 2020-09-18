<?php if (!defined("ABSPATH")) exit(); ?>

<div class="popular-authors" id="popular-comment-authors">
    <?php
    $get_date_padi = self::getDateIntervals($popular_authors_date_interval);
    $exclude_condition = "";
    $excluded_users = "";
    if (!empty($this->options["excluded_user_roles"])) {
        $excluded_users_assoc = get_users([
            "role__in" => $this->options["excluded_user_roles"],
            "fields" => ["ID"]
        ]);
        foreach ($excluded_users_assoc as $user_id) {
            $excluded_users .= $user_id->ID . ",";
        }
        if ($excluded_users != "") {
            $exclude_condition = " AND `user_id` NOT IN (" . trim($excluded_users, ",") . ")";
        }
    }
    if ($this->options["wpdiscuz_widget_theme_title_struct"] === 1)
        echo $before_title . $title_popular_authors . $after_title;
    else
        echo "<h2 class='wpd_widgets_title'> $title_popular_authors </h2>";
    $group_condition = "";
    $disp_guests = $this->options["wpdiscuz_widget_displaying_guests"];
    $wpdiscuz_widget_author_link = $this->options["wpdiscuz_widget_author_link"];
    if ($disp_guests === 1) {
        $query_condition = "com.`comment_approved`=1";
        $group_condition = "com.`comment_author_email`";
    } else {
        $query_condition = "`user_id`<>0 AND com.`comment_approved`=1";
        $group_condition = "`user_id`";
    }

    if ($popular_authors_date_interval == "all_time") {
        $select_query = "SELECT 
                                    com.comment_author_email,
                                    COUNT(com.comment_author_email) AS `count`,
                                    us.`ID`,
                                    us.`display_name`,
                                    MAX(com.`user_id`) AS `user_id`,
                                    com.`comment_author`  
                                  FROM
                                    `" . $this->db_prefix . "comments` com 
                                    LEFT JOIN `" . $this->db_prefix . "users` us ON us.`ID`=`user_id`
                                    WHERE " . $query_condition . $exclude_condition . "
                                  GROUP BY  " . $group_condition .
                " ORDER BY `count` DESC, `comment_author_email` DESC LIMIT " . $count_popular_authors;
    } elseif ($popular_authors_date_interval == "custom_date") {
        $select_query = "SELECT 
                                    com.comment_author_email,
                                    COUNT(com.comment_author_email) AS `count`,
                                    us.`ID`,
                                    us.`display_name`,
                                    MAX(com.`user_id`) AS `user_id`,
                                    com.`comment_author`  
                                  FROM
                                    `" . $this->db_prefix . "comments` com 
                                    LEFT JOIN `" . $this->db_prefix . "users` us ON us.`ID`=`user_id`
                                    WHERE  " . $query_condition . $exclude_condition . " AND `comment_date`  BETWEEN '" . $popular_authors_from_date . "' AND '" . $popular_authors_to_date . "'
                                  GROUP BY  " . $group_condition .
                " ORDER BY `count` DESC, `comment_author_email` DESC LIMIT " . $count_popular_authors;
    } else {
        $select_query = "SELECT 
                                    com.comment_author_email,
                                    COUNT(com.comment_author_email) AS `count`,
                                    us.`ID`,
                                    us.`display_name`,
                                    MAX(com.`user_id`) AS `user_id`,
                                    com.`comment_author`  
                                  FROM
                                    `" . $this->db_prefix . "comments` com 
                                    LEFT JOIN `" . $this->db_prefix . "users` us ON us.`ID`=`user_id`
                                    WHERE  " . $query_condition . $exclude_condition . " AND `comment_date` > '" . $get_date_padi["from"] . "'
                                  GROUP BY " . $group_condition .
                " ORDER BY `count` DESC, `comment_author_email` DESC LIMIT " . $count_popular_authors;
    }
    $results = $wpdb->get_results($select_query);
    ?>
    <div class="wpd_widgets_items_wrapper">
        <?php
        foreach ($results as $result) {
            if ($result->ID) {
                $get__user = get_user_by("id", $result->ID);
                $user_name = $get__user->display_name;
            } else {
                $user_name = $result->comment_author;
            }

            $user_data = get_userdata($result->user_id);
            if ($user_data) {
                $user_role = $user_data->roles;
                $intersect_roles = array_intersect($user_role, $this->options["excluded_user_roles"]);
                if (!empty($intersect_roles)) {
                    continue;
                }
            }

            $user_link = get_author_posts_url($result->ID);
            $user_posts_count = $result->user_id > 0 ? count_user_posts($result->user_id) : -1;

            if ($result->count == 1) {
                $comment_phrase = __(" comment", "wpdiscuz-widgets");
            } else if ($result->count > 1) {
                $comment_phrase = __(" comments", "wpdiscuz-widgets");
            }
            $user_avatar = get_avatar($result->comment_author_email, "", "", "", ["class" => "popular-comment-author-avatar"]);
            ?>
            <div>
                <div class="wpdiscuz-widget-popular-comment-author" style="">
                    <div class='popular-comment-author-avatar-box'>
                        <?php
                        if ($wpdiscuz_widget_author_link) {
                            if ($user_posts_count > 0) {
                                ?>
                                <a href="<?php echo $user_link; ?>" class="commenter-avatar-box <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>"><?php echo $user_avatar; ?></a>
                            <?php } else { ?>                                
                                <div class="commenter-avatar-box <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>" ><?php echo $user_avatar; ?></div>
                                <?php
                            }
                        } else {
                            if ($user_posts_count > 0) {
                                ?>
                                <a href="<?php echo $user_link; ?>" class="commenter-avatar-box <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>"><?php echo $user_avatar; ?></a>
                                <?php
                            } else {
                                ?>
                                <div class="commenter-avatar-box <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>"><?php echo $user_avatar; ?></div>
                                <?php
                            }
                        }
                        ?>    
                    </div>
                    <div class="popular-comment-author-body">
                        <div class='popular-comment-author-disp-name' style=''>
                            <?php
                            if ($wpdiscuz_widget_author_link) {
                                if ($user_posts_count > 0) {
                                    ?>
                                    <a href="<?php echo $user_link; ?>" class='commenter-name-box'> <?php echo $user_name; ?> </a>
                                    <?php
                                } else {
                                    echo "<div class='commenter-name-box'>{$user_name}</div>";
                                }
                            } else {
                                if ($user_posts_count > 0) {
                                    ?>
                                    <a href="<?php echo $user_link; ?>" class='commenter-name-box'> <?php echo $user_name; ?> </a>
                                    <?php
                                } else {
                                    echo "<div class='commenter-name-box'>{$user_name}</div>";
                                }
                            }
                            ?>
                        </div>
                        <div style="font-size:100%" class="popular-comment-count-box">
                            <span style='' class="">
                                <i class="far fa-comments"></i> <?php echo $result->count; ?>
                            </span>
                            <span class="com-phraze"><?php echo $comment_phrase; ?></span>
                        </div>
                    </div>
                </div>
                <hr class="delim">
            </div>
            <?php
        }
        ?>
    </div>
</div>