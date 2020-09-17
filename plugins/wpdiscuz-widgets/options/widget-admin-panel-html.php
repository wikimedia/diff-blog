<div class="wpdiscuz-widget-admin-panel" id="wpdiscuz-widget-admin-panel">
    <div class="tab_section_header">
        <h4 style=""><i class="far fa-thumbs-up" style="font-size: 16px;"></i> <span>|</span> <?php _e("Most Voted Comments", "wpdiscuz-widgets"); ?> </h4>
        <label>
            <?php _e("Enable", "wpdiscuz-widgets"); ?>
            <input class="enable-tab-displaying" type="checkbox" name="<?php echo $most_voted_tabName ?>" <?php checked($most_voted_tab, "on", true) ?>>
        </label>
    </div>
    <?php $tab_section_style = $most_voted_tab === "on" ? "" : "display: none;" ?>
    <div class="tab-section-details" style="<?php echo $tab_section_style; ?>">
        <p style="">
            <label for='<?php echo $title_most_votedId; ?>'>
                <?php _e("Header text: ", "wpdiscuz-widgets"); ?>
            </label>
            <br>
            <input type='text' class='widefat' name='<?php echo $title_most_votedName; ?>' value='<?php echo $title_most_voted; ?>' id='<?php echo $title_most_votedId; ?>'>
        </p>
        <p>
            <label for="<?php echo $count_most_votedId; ?>">
                <?php _e("Number of comments: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $count_most_votedName; ?>' value='<?php echo $count_most_voted; ?>' id='<?php echo $count_most_votedId; ?>'>
        </p>
        <p>
            <label for="<?php echo $tab_order_most_votedId; ?>">
                <?php _e("Tab order number: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $tab_order_most_votedName; ?>' value='<?php echo $tab_order_most_voted; ?>' id='<?php echo $tab_order_most_votedId; ?>'>
        </p>
        <div class='last_int_fields_box'>
            <?php _e("Time frame: ", "wpdiscuz-widgets"); ?>
            <select name="<?php echo $most_voted_date_intervalName; ?>" class="date_interval_select">
                <option value="1" <?php selected($most_voted_date_interval, "1", true); ?>>Last Day</option>
                <option value="7" <?php selected($most_voted_date_interval, "7", true); ?>>Last Week</option>
                <option value="30" <?php selected($most_voted_date_interval, "30", true); ?>>Last Month</option>
                <option value="all_time" <?php selected($most_voted_date_interval, "all_time", true); ?>>All Time</option>
                <option value="custom_date" <?php selected($most_voted_date_interval, "custom_date", true); ?>>Custom Date</option>
            </select>
            <?php $datepicker_wrapper_style = $most_voted_date_interval === "custom_date" ? "" : "display:none;" ?>
            <div style="<?php echo $datepicker_wrapper_style; ?>" class="wpd_datepicker_wrapper">
                <label>
                    <input placeholder="<?php _e("From: ", "wpdiscuz-widgets"); ?>" class="comments_date_from" type="text" name="<?php echo $most_voted_from_dateName; ?>" value="<?php echo $most_voted_from_date; ?>">
                </label>
                <label>
                    <input placeholder="<?php _e("To: ", "wpdiscuz-widgets"); ?>" class="comments_date_to" type="text" name="<?php echo $most_voted_to_dateName; ?>" value="<?php echo $most_voted_to_date; ?>"><i class="fas fa-info-circle" aria-hidden="true" title="Set empty for current date"></i>
                </label>
            </div>
        </div>
    </div>

    <div class="tab_section_header">
        <h4><i class="fas fa-fire" style="font-size: 16px;"></i> <span>|</span> <?php _e("Active Comment Threads", "wpdiscuz-widgets"); ?></h4>
        <label>
            <?php _e("Enable", "wpdiscuz-widgets"); ?>
            <input class="enable-tab-displaying" type="checkbox" name="<?php echo $most_active_tabName ?>" <?php checked($most_active_tab, "on", true) ?>>
        </label>
    </div>
    <?php $tab_section_style = $most_active_tab === "on" ? "" : "display: none;" ?>
    <div class="tab-section-details" style="<?php echo $tab_section_style; ?>">
        <p>
            <label for='<?php echo $title_active_threadsId; ?>'>
                <?php _e("Header text: ", "wpdiscuz-widgets"); ?>
            </label>
            <br>
            <input type='text' class='widefat' name='<?php echo $title_active_threadsName; ?>' value='<?php echo $title_active_threads; ?>' id='<?php echo $title_active_threadsId; ?>'>
        </p>
        <p>
            <label for='<?php echo $count_active_threadsId; ?>'>
                <?php _e("Number of comments: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $count_active_threadsName; ?>' value='<?php echo $count_active_threads; ?>' id='<?php echo $count_active_threadsId; ?>'>
        </p>
        <p>
            <label for="<?php echo $tab_order_active_threadsId; ?>">
                <?php _e("Tab order number: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $tab_order_active_threadsName; ?>' value='<?php echo $tab_order_active_threads; ?>' id='<?php echo $tab_order_active_threadsId; ?>'>
        </p>
        <div class='last_int_fields_box'>
            <p>
                <small style="color: #f00">
                    <?php if($this->all_comments_count > 20000) _e('Your comments count is big so using "All Time" can give you some problems with this tab. ', "wpdiscuz-widgets"); ?>
                </small>
            </p>
            <?php _e("Time frame: ", "wpdiscuz-widgets"); ?>
            <select name="<?php echo $active_threads_date_intervalName; ?>" class="date_interval_select">
                <option value="1" <?php selected($active_threads_date_interval, "1", true); ?>>Last Day</option>
                <option value="7" <?php selected($active_threads_date_interval, "7", true); ?>>Last Week</option>
                <option value="30" <?php selected($active_threads_date_interval, "30", true); ?>>Last Month</option>
                <option value="all_time" <?php selected($active_threads_date_interval, "all_time", true); ?>>All Time</option>
                <option value="custom_date" <?php selected($active_threads_date_interval, "custom_date", true); ?>>Custom Date</option>
            </select>
            <?php $datepicker_wrapper_style = $active_threads_date_interval === "custom_date" ? "" : "display:none;" ?>
                <div style="<?php echo $datepicker_wrapper_style; ?>" class="wpd_datepicker_wrapper">
                    <label>
                        <input placeholder="<?php _e("From: ", "wpdiscuz-widgets"); ?>" class="comments_date_from" type="text" name="<?php echo $active_threads_from_dateName; ?>" value="<?php echo $active_threads_from_date; ?>">
                    </label> &nbsp;
                    <label>
                        <input placeholder="<?php _e("To: ", "wpdiscuz-widgets"); ?>" class="comments_date_to" type="text" name="<?php echo $active_threads_to_dateName; ?>" value="<?php echo $active_threads_to_date; ?>"><i class="fas fa-info-circle" aria-hidden="true" title="Set empty for current date"></i>
                    </label>
                </div>
        </div>
    </div>

    <div class="tab_section_header">
        <h4><i class="fas fa-star" style="font-size: 16px;"></i> <span>|</span> <?php _e("Most Commented Posts", "wpdiscuz-widgets"); ?></h4>
        <label>
            <?php _e("Enable", "wpdiscuz-widgets"); ?>
            <input class="enable-tab-displaying" type="checkbox" name="<?php echo $popular_posts_tabName ?>" <?php checked($popular_posts_tab, "on", true) ?>>
        </label>
    </div>
    <?php $tab_section_style = $popular_posts_tab === "on" ? "" : "display: none;" ?>
    <div class="tab-section-details" style="<?php echo $tab_section_style; ?>">
        <p>
            <label for='<?php echo $title_popular_postsId; ?>'>
                <?php _e("Header text: ", "wpdiscuz-widgets"); ?>
            </label>
            <br>
            <input type='text' class='widefat' name='<?php echo $title_popular_postsName; ?>' value='<?php echo $title_popular_posts; ?>' id='<?php echo $title_popular_postsId; ?>'>
        </p>
        <p>
            <label for='<?php echo $count_popular_postsId; ?>'>
                <?php _e("Number of comments: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $count_popular_postsName; ?>' value='<?php echo $count_popular_posts; ?>' id='<?php echo $count_popular_postsId; ?>'>
        </p>
        <p>
            <label for="<?php echo $tab_order_popular_postsId; ?>">
                <?php _e("Tab order number: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $tab_order_popular_postsName; ?>' value='<?php echo $tab_order_popular_posts; ?>' id='<?php echo $tab_order_popular_postsId; ?>'>
        </p>
        <div class='last_int_fields_box'>
            <?php _e("Time frame: ", "wpdiscuz-widgets"); ?>
            <select name="<?php echo $popular_posts_date_intervalName; ?>" class="date_interval_select">
                <option value="1" <?php selected($popular_posts_date_interval, "1", true); ?>>Last Day</option>
                <option value="7" <?php selected($popular_posts_date_interval, "7", true); ?>>Last Week</option>
                <option value="30" <?php selected($popular_posts_date_interval, "30", true); ?>>Last Month</option>
                <option value="all_time" <?php selected($popular_posts_date_interval, "all_time", true); ?>>All Time</option>
                <option value="custom_date" <?php selected($popular_posts_date_interval, "custom_date", true); ?>>Custom Date</option>
            </select>
            <?php $datepicker_wrapper_style = $popular_posts_date_interval === "custom_date" ? "" : "display:none;" ?>
                <div style="<?php echo $datepicker_wrapper_style; ?>" class="wpd_datepicker_wrapper">
                    <label>
                        <input placeholder="<?php _e("From: ", "wpdiscuz-widgets"); ?>" class="comments_date_from" type="text" name="<?php echo $popular_posts_from_dateName; ?>" value="<?php echo $popular_posts_from_date; ?>">
                    </label> &nbsp;
                    <label>
                        <input placeholder="<?php _e("To: ", "wpdiscuz-widgets"); ?>" class="comments_date_to" type="text" name="<?php echo $popular_posts_to_dateName; ?>" value="<?php echo $popular_posts_to_date; ?>"><i class="fas fa-info-circle" aria-hidden="true" title="Set empty for current date"></i>
                    </label>
                </div>
        </div>
    </div>
    <div class="tab_section_header">
        <h4><i class="fas fa-users" style="font-size: 16px;"></i> <span>|</span> <?php _e("Active Commenters", "wpdiscuz-widgets"); ?></h4>
        <label>
            <?php _e("Enable", "wpdiscuz-widgets"); ?>
            <input class="enable-tab-displaying" type="checkbox" name="<?php echo $popular_authors_tabName ?>" <?php checked($popular_authors_tab, "on", true) ?>>
        </label>
    </div>
    <?php $tab_section_style = $popular_authors_tab === "on" ? "" : "display: none;" ?>
    <div class="tab-section-details" style="<?php echo $tab_section_style; ?>">
        <p>
            <label for='<?php echo $title_popular_authorsId; ?>'>
                <?php _e("Header text: ", "wpdiscuz-widgets"); ?>
            </label>
            <br>
            <input type='text' class='widefat' name='<?php echo $title_popular_authorsName; ?>' value='<?php echo $title_popular_authors; ?>' id='<?php echo $title_popular_authorsId; ?>'>
        </p>
        <p>
            <label for='<?php echo $count_popular_authorsId; ?>'>
                <?php _e("Number of commenters: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $count_popular_authorsName; ?>' value='<?php echo $count_popular_authors; ?>' id='<?php echo $count_popular_authorsId; ?>'>
        </p>
        <p>
            <label for="<?php echo $tab_order_popular_authorsId; ?>">
                <?php _e("Tab order number: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $tab_order_popular_authorsName; ?>' value='<?php echo $tab_order_popular_authors; ?>' id='<?php echo $tab_order_popular_authorsId; ?>'>
        </p>
        <div class='last_int_fields_box'>
            <?php _e("Time frame: ", "wpdiscuz-widgets"); ?>
            <select name="<?php echo $popular_authors_date_intervalName; ?>" class="date_interval_select">
                <option value="1" <?php selected($popular_authors_date_interval, "1", true); ?>>Last Day</option>
                <option value="7" <?php selected($popular_authors_date_interval, "7", true); ?>>Last Week</option>
                <option value="30" <?php selected($popular_authors_date_interval, "30", true); ?>>Last Month</option>
                <option value="all_time" <?php selected($popular_authors_date_interval, "all_time", true); ?>>All Time</option>
                <option value="custom_date" <?php selected($popular_authors_date_interval, "custom_date", true); ?>>Custom Date</option>
            </select>
            <?php $datepicker_wrapper_style = $popular_authors_date_interval === "custom_date" ? "" : "display:none;" ?>
                <div style="<?php echo $datepicker_wrapper_style; ?>" class="wpd_datepicker_wrapper">
                    <label>
                        <input placeholder="<?php _e("From: ", "wpdiscuz-widgets"); ?>" class="comments_date_from" type="text" name="<?php echo $popular_authors_from_dateName; ?>" value="<?php echo $popular_authors_from_date; ?>">
                    </label> &nbsp;
                    <label>
                        <input placeholder="<?php _e("To: ", "wpdiscuz-widgets"); ?>" class="comments_date_to" type="text" name="<?php echo $popular_authors_to_dateName; ?>" value="<?php echo $popular_authors_to_date; ?>"><i class="fas fa-info-circle" aria-hidden="true" title="Set empty for current date"></i>
                    </label>
                </div>
        </div>
    </div>
    <div class="tab_section_header">
        <h4><i class="fas fa-comments" style="font-size: 16px;"></i> <span>|</span> <?php _e("Recent Comments", "wpdiscuz-widgets"); ?></h4>
        <label>
            <?php _e("Enable", "wpdiscuz-widgets"); ?>
            <input class="enable-tab-displaying" type="checkbox" name="<?php echo $recent_comments_tabName ?>" <?php checked($recent_comments_tab, "on", true) ?>>
        </label>
    </div>
    <?php $tab_section_style = $recent_comments_tab === "on" ? "" : "display: none;" ?>
    <div class="tab-section-details" style="<?php echo $tab_section_style; ?>">
        <p>
            <label for='<?php echo $title_recent_commentsID; ?>'>
                <?php _e("Header text: ", "wpdiscuz-widgets"); ?>
            </label>
            <br>
            <input type='text' class='widefat' name='<?php echo $title_recent_commentsName; ?>' value='<?php echo $title_recent_comments; ?>' id='<?php echo $title_recent_commentsID; ?>'>
        </p>
        <p>
            <label for='<?php echo $count_recent_commentsId; ?>'>
                <?php _e("Number of comments: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $count_recent_commentsName; ?>' value='<?php echo $count_recent_comments; ?>' id='<?php echo $count_recent_commentsId; ?>'>
        </p>
        <p>
            <label for="<?php echo $tab_order_recent_commentsId; ?>">
                <?php _e("Tab order number: ", "wpdiscuz-widgets"); ?>
            </label>
            <input type='number' class="tiny-text" name='<?php echo $tab_order_recent_commentsName; ?>' value='<?php echo $tab_order_recent_comments; ?>' id='<?php echo $tab_order_recent_commentsId; ?>'>
        </p>
    </div>
    <br>
</div>
<br>


