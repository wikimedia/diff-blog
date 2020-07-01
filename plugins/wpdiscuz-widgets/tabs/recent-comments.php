<?php if (!defined("ABSPATH")) exit(); ?>

<div id="wpdiscuz-recent-comments-box" class="wpd-wid-recent-comments">
    <?php
    if($this->options["wpdiscuz_widget_theme_title_struct"] === 1) echo $before_title . $title_recent_comments . $after_title;
    else echo  "<h2 class='wpd_widgets_title'> $title_recent_comments </h2>";
    $wpdiscuz_widget_author_link = $this->options["wpdiscuz_widget_author_link"];

    $args = [
        "number" => $count_recent_comments,
        "status" => "approve",
        "orderby" => "comment_date"
    ];
    $wpd_comments = get_comments($args);
    ?>
    <div class="wpd_widgets_items_wrapper">
        <?php    
        foreach ($wpd_comments as $wpd_comment) {
                $comm_date = date($this->widget_date_format, strtotime($wpd_comment->comment_date));

                $user_link = get_author_posts_url($wpd_comment->user_id);
                $user_posts_count = $wpd_comment->user_id ? count_user_posts($wpd_comment->user_id) : -1;
                $user_avatar = get_avatar($wpd_comment->comment_author_email, "", "", "", ["class" => "recent-comment-author-avatar"]);

                if($this->options["wpdiscuz_widget_post_title_cutting"]){
                    $comment_post_title = apply_filters("the_title", get_the_title($wpd_comment->comment_post_ID));
                    $comment_post_title = wp_trim_words($comment_post_title, $this->options["wpdiscuz_widgets_post_title_word_count"]);
                }else{
                    $comment_post_title = apply_filters("the_title", get_the_title($wpd_comment->comment_post_ID));
                }
                $comment_content = apply_filters("comment_text", $wpd_comment->comment_content, $wpd_comment, []);
                $replaced_comment = preg_replace("~\[spoiler.*?\[\/spoiler\]~", "", $comment_content);

                $replaced_comment = wp_trim_words($replaced_comment, $cont_w_count, $content_more);

                $rc_comment_link = get_the_permalink($wpd_comment->comment_post_ID);
                ?>
                <div>
                    <div class="wpdiscuz-widget-popular-comment-author" style="">
                        <div class='popular-comment-author-avatar-box'>
                            <div class='commenter-avatar-box <?php if($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>'><?php echo $user_avatar; ?></div>
                        </div>
                        <div class="popular-comment-author-body">
                            <a href="<?php echo get_permalink($wpd_comment->comment_post_ID); ?>"><?php echo $comment_post_title; ?></a>
                            <div>
                                <?php echo $comm_date; printf(__(" by %s", "wpdiscuz-widgets"), $wpd_comment->comment_author); ?>
                            </div>
                            <div class="wpdwd-recent-comment-content"><a href="<?php echo $rc_comment_link . "#comment-" . $wpd_comment->comment_ID; ?>"><?php echo $replaced_comment; ?></a></div>
                    
                        </div>
                    </div>
                    <hr class="delim">
                </div>
            <?php
        }
        ?>
    </div>
</div>