<?php if (!defined("ABSPATH")) exit(); ?>

<div id="wpdiscuz-most-voted-comments-box" class="most-voted">
    <?php
    $get_date_mvdi = self::getDateIntervals($most_voted_date_interval);

    if ($most_voted_date_interval == "all_time") {
        $query_date = [];
    } elseif ($most_voted_date_interval == "custom_date") {
        $query_date = [
            "column" => "comment_date",
            [
                "after" => $most_voted_from_date,
                "before" => $most_voted_to_date,
                "inclusive" => true
            ]
        ];
    } else {
        $query_date = [
            "column" => "comment_date",
            [
                "after" => $get_date_mvdi["from"],
                "inclusive" => true
            ]
        ];
    }

    $all_comms_args = [
        "number" => $count_most_voted,
        "orderby" => "meta_value_num, comment_date",
        "order" => "DESC",
        "status" => "approve",
        "meta_key" => WpDiscuzConstants::META_KEY_VOTES,
        "date_query" => $query_date
    ];
    $coms = get_comments($all_comms_args);
    if ($this->options["wpdiscuz_widget_theme_title_struct"] === 1) {
        echo $before_title . $title_most_voted . $after_title;
    } else {
        echo "<h2 class='wpd_widgets_title'> $title_most_voted </h2>";
    }
    ?>
    <div class="wpd_widgets_items_wrapper">
        <?php
        foreach ($coms as $com) {
            if ($this->options["wpdiscuz_widget_post_title_cutting"]) {
                $get_post = get_post($com->comment_post_ID);
                $comment_post_title = apply_filters("the_title", $get_post->post_title);
                $comment_post_title = wp_trim_words($comment_post_title, $this->options["wpdiscuz_widgets_post_title_word_count"]);
            } else {
                $get_post = get_post($com->comment_post_ID);
                $comment_post_title = apply_filters("the_title", $get_post->post_title);
            }
            $comment_content = apply_filters("comment_text", $com->comment_content, $com, []);
            $replaced_comment = preg_replace("~\[spoiler.*?\[\/spoiler\]~", "", $comment_content);
            $replaced_comment = wp_trim_words($replaced_comment, $cont_w_count, $content_more);
            $user_link = get_author_posts_url($com->user_id);
            $p_link = get_the_permalink($com->comment_post_ID);
            $comm_date = date($this->widget_date_format, strtotime($com->comment_date));
            $comment_vote = get_comment_meta($com->comment_ID, WpDiscuzConstants::META_KEY_VOTES, true);
            $commentLink = get_comment_link($com);

            if ($this->options["mvc_displaying_style"] === "votes_style") {
                ?>    
                <div class="wpdiscuz-widget-comment most-voted like-count-first">
                    <div class="wpd-widget-comment-top">
                        <div class="wpdiscuz-widget-icon-show-box <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>">
                            <a href="<?php echo $commentLink; ?>">
                                <i class="far fa-thumbs-up" style="color: #fff;"></i>
                            </a>
                            <div class="wpd-widget-comp-count"><?php echo $comment_vote; ?></div>
                        </div>
                        <div class="wpdiscuz-widget-comment-content">
                            <a href="<?php echo $commentLink; ?>">
                                <p class="wpdiscuz-widget-comment-title"><?php echo $comment_post_title; ?></p>
                            </a>
                            <div class="wpdiscuz-widget-comment-exc"><?php echo $replaced_comment; ?></div>
                        </div>
                    </div>
                    <div class="wpd-widget-comment-bottom">
                        <ul class="wpdiscuz-widget-about-comment-right">
                            <li title="Comment Author: <?php echo $this->getCommentAuthor($com); ?>"><i class="fas fa-user"></i> <?php echo $this->getCommentAuthor($com); ?> </li>
                            <li title="Comment Date: <?php echo $comm_date; ?>"><i class="fas fa-calendar-alt"></i>&nbsp; <?php echo $comm_date; ?> </li>
                        </ul>
                    </div>
                    <hr class='delim'>
                </div>
                <?php
            } elseif ($this->options["mvc_displaying_style"] === "avatar_style") {
                if ($us_id = $com->user_id > 0) {
                    $user_post_count = count_user_posts($com->user_id);
                } else {
                    $user_post_count = -1;
                }
                ?>
                <div class="wpdiscuz-widget-comment most-voted avatar-first">
                    <div class="wpd-widget-comment-top">
                        <div class="wpdiscuz-widget-avatar-box">

                            <?php if ($user_post_count > 0) { ?>
                                <a href="<?php echo $user_link; ?>" class="avatar-blok <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>">
                                    <?php echo get_avatar($com->comment_author_email, 50, "", "", ["class" => ["user_avatar", "wpdiscuz-widget-author-avatar"]]); ?> 
                                </a>
                            <?php } else {
                                ?>
                                <div class="avatar-blok <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>">
                                    <?php echo get_avatar($com->comment_author_email, 50, "", "", ["class" => ["user_avatar", "wpdiscuz-widget-author-avatar"]]); ?> 
                                </div>
                            <?php }
                            ?>

                            <div class="wpdiscuz-widget-comment-votes" style="text-align:center;"><i class="far fa-thumbs-up"></i> <?php echo $comment_vote; ?></div>
                        </div>
                        <div class="wpdiscuz-widget-comment-content">
                            <a href="<?php echo $commentLink; ?>">
                                <p class="wpdiscuz-widget-comment-title"><?php echo $comment_post_title; ?></p>
                            </a>
                            <div class="wpdiscuz-widget-comment-exc"><?php echo $replaced_comment; ?></div>
                        </div>
                    </div>
                    <div class="wpd-widget-comment-bottom">
                        <ul class="wpdiscuz-widget-about-comment-right">
                            <li><i class="fas fa-calendar-alt"></i> <?php
                                echo $comm_date;
                                printf(__(" by %s", "wpdiscuz-widgets"), $this->getCommentAuthor($com));
                                ?>
                            </li>
                        </ul>
                    </div>
                    <hr class='delim'>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>