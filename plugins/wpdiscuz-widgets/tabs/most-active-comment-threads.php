<?php if (!defined("ABSPATH")) exit(); ?>

<!--Active Comment Threads-->

<div class="most-active" id="most-active-comment-threads">
    <?php
    $get_date_atdi = self::getDateIntervals($active_threads_date_interval);
    if ($active_threads_date_interval == "all_time") {
        $query_date = [];
    } elseif ($active_threads_date_interval == "custom_date") {
        $query_date = [
            "column" => "comment_date",
            [
                "after" => $active_threads_from_date,
                "before" => $active_threads_to_date,
                "inclusive" => true
            ]
        ];
    } else {
        $query_date = [
            "column" => "comment_date",
            [
                "after" => $get_date_atdi["from"],
                "inclusive" => true
            ]
        ];
    }
    $all_comms_args = [
        "status" => "approve",
        "date_query" => $query_date
    ];

    $coms = get_comments($all_comms_args);
    $parent_comment = [];
    foreach ($coms as $com) {
        $com_children = $com->get_children([]);
        if (!empty($com_children)) {
            $parent_comment[$com->comment_ID] = count($com_children);
        }
    }
    arsort($parent_comment);
    if ($this->options["wpdiscuz_widget_theme_title_struct"] === 1) {
        echo $before_title . $title_active_threads . $after_title;
    } else {
        echo "<h2 class='wpd_widgets_title'> $title_active_threads </h2>";
    }
    $par_comment_ct = 0;
    ?>
    <div class="wpd_widgets_items_wrapper">
        <?php
        foreach ($parent_comment as $comment_id => $thread_comment_count) {
            if ($par_comment_ct >= $count_active_threads) {
                break;
            }
            $get_thread = get_comment($comment_id);
            $thread_content = apply_filters("comment_text", $get_thread->comment_content, $get_thread, []);
            $replaced_comment = preg_replace("~\[spoiler.*?\[\/spoiler\]~", "", $thread_content);
            $replaced_comment = wp_trim_words($replaced_comment, $cont_w_count, $content_more);
            $thread_post_id = $get_thread->comment_post_ID;
            $post_permalink = get_permalink($thread_post_id);
            $commentLink = get_comment_link($get_thread);
            $thread_date = date($this->widget_date_format, strtotime($get_thread->comment_date));
            if ($get_thread->user_id != 0) {
                $get_user = get_user_by("ID", $get_thread->user_id);
                $thread_author = $get_user->data->user_nicename;
            } else {
                $thread_author = $get_thread->comment_author;
            }
            ?>
            <div class="wpdiscuz-widget-comment active-threads like-count-first">
                <div class="wpd-widget-comment-top">
                    <div class="wpdiscuz-widget-icon-show-box <?php if ($this->options["wpdiscuz_widget_icon_circle"] === 1) echo "icon-circle"; ?>">
                        <a href="<?php echo $commentLink; ?>">
                            <i class="fas fa-reply" style="color: #fff;"></i>
                        </a>
                        <div class="wpd-widget-comp-count"> <?php echo $thread_comment_count; ?></div>
                    </div>
                    <div class="wpdiscuz-widget-comment-content">
                        <div class="wpdiscuz-widget-comment-exc">
                            <a href='<?php echo $commentLink; ?>'>
                                <?php echo $replaced_comment; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="wpd-widget-comment-bottom">
                    <ul class="wpdiscuz-widget-about-comment-right">
                        <li title="Comment Author: <?php echo $this->getCommentAuthor($get_thread); ?>"><i class="fas fa-user"></i> <?php echo $this->getCommentAuthor($get_thread); ?></li>
                        <li title="Comment Date: <?php echo $thread_date; ?>"><i class="fas fa-calendar-alt"></i> <?php echo $thread_date; ?> </li>
                    </ul>
                </div>
                <hr class='delim'>
            </div> 
            <?php
            $par_comment_ct++;
        }
        ?>
    </div>
</div>