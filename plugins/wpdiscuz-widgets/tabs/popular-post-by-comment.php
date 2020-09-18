<?php if (!defined("ABSPATH")) exit(); ?>

<div id="wpdiscuz-popular-posts-bycomment" class="popular-posts">

    <?php
    $get_date_ppdi = self::getDateIntervals($popular_posts_date_interval);
    if($this->options["wpdiscuz_widget_theme_title_struct"] === 1) echo $before_title . $title_popular_posts . $after_title;
    else echo  "<h2 class='wpd_widgets_title'> $title_popular_posts </h2>";
    $post_date_condition = "";
    if ($popular_posts_date_interval == "all_time") {
        $post_date_condition = "p.`post_date` > '0000-00-00 00:00:00'";
    } elseif ($popular_posts_date_interval == "custom_date") {
        $post_date_condition = "p.`post_date` BETWEEN '" . $popular_posts_from_date . "' AND '" . $popular_posts_to_date . "'";
    }else {
        $post_date_condition = "p.`post_date` > '" . $get_date_ppdi["from"] . "'";
    }
    $posttypes = "";
    if (!empty($this->options["enable_for_post_types"])) {
	    $posttypes = "AND p.`post_type` IN('" . implode("', '", $this->options["enable_for_post_types"]) . "')";
    } else {
	    $posttypes = "AND 0";
    }
    $post_query = "SELECT 
                            p.ID,
                            p.`post_author`,
                            p.`post_date`,
                            p.`post_title`,
                            p.`post_content`,
                            p.`comment_count`,
                            u.`display_name`,
                            u.`user_email` 
                          FROM
                            `" . $this->db_prefix . "posts` p 
                            INNER JOIN `" . $this->db_prefix . "users` u 
                              ON p.`post_author` = u.`ID` 
                              WHERE p.`post_status` = 'publish'
                              " . $posttypes . "
                              AND " . $post_date_condition . " ORDER BY p.`comment_count` DESC LIMIT " . $count_popular_posts;

    $posts = $wpdb->get_results($post_query); 
    ?>
    <div class="wpd_widgets_items_wrapper">
        <?php
        foreach ($posts as $post) {
            $popular_post_datetime = $post->post_date;
            $popular_post_id = $post->ID;
            $popular_post_permalink = get_the_permalink($popular_post_id);
            if($this->options["wpdiscuz_widget_post_title_cutting"]){
                $popular_post_title = apply_filters("the_title", $post->post_title);
                $popular_post_title = wp_trim_words($popular_post_title, $this->options["wpdiscuz_widgets_post_title_word_count"]);
            }else{
                $popular_post_title = apply_filters("the_title", $post->post_title);
            }
            $popular_post_comment_count = $post->comment_count;

            $the_content = preg_replace("~\[[^\]]+\]~s", "", $post->post_content);

            $post_content = wp_trim_words($the_content, $cont_w_count, $content_more);
            $post_date = date($this->widget_date_format, strtotime($popular_post_datetime));
            $post_author = $post->display_name;

            ?>
            <div class="wpdiscuz-widget-comment most-voted like-count-first">
                <div class="wpd-widget-comment-top">
                    <div class="wpdiscuz-widget-icon-show-box <?php if($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>">
                        <a href="<?php echo $popular_post_permalink . "#comments"; ?>">
                            <i class="far fa-comments" style="color: #fff;"></i>
                        </a>
                        <div class="wpd-widget-comp-count"><?php echo $popular_post_comment_count; ?></div>
                    </div>
                    <div class="wpdiscuz-widget-comment-content">
                        <a href="<?php echo $popular_post_permalink; ?>" title="<?php echo $popular_post_title; ?>">
                            <p class="wpdiscuz-widget-comment-title"><?php echo $popular_post_title; ?></p>
                        </a>
                        <div class="wpdiscuz-widget-comment-exc"><?php echo $post_content; ?></div>
                    </div>
                </div>
                <div class="wpd-widget-comment-bottom">
                    <ul class="wpdiscuz-widget-about-comment-right">
                        <li title="Post Author: <?php echo $post_author; ?>"><i class="fas fa-user"></i> <?php echo $post_author; ?> </li>
                        <li title="Post Creation Date:  <?php echo $post_date; ?>"><i class="fas fa-calendar-alt"></i> <?php echo $post_date; ?> </li>
                    </ul>
                </div>
                <hr class='delim'>
            </div>

            <?php
        } //end foreach
        ?>
    </div> 
</div> 