<?php
$postTitleCutting = $setting["values"]->options["wpdiscuz_widget_post_title_cutting"] == 1;
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_post_title_cutting">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_post_title_cutting"><?php echo $setting["options"]["wpdiscuz_widget_post_title_cutting"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_post_title_cutting"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($postTitleCutting) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_post_title_cutting]" id="wpdiscuz_widget_post_title_cutting">
            <label for="wpdiscuz_widget_post_title_cutting"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widgets_post_title_word_count" <?php echo $postTitleCutting ? "" : "style='display:none;'"; ?>>
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widgets_post_title_word_count"><?php echo $setting["options"]["wpdiscuz_widgets_post_title_word_count"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widgets_post_title_word_count"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widgets_post_title_word_count" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widgets_post_title_word_count]" value="<?php echo $setting["values"]->options["wpdiscuz_widgets_post_title_word_count"]; ?>" style="width: 80px;"/>
    </div>
</div>
<!-- Option end -->
<?php
$contentCutting = $setting["values"]->options["wpdiscuz_widget_content_cutting"] == 1;
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_content_cutting">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_content_cutting"><?php echo $setting["options"]["wpdiscuz_widget_content_cutting"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_content_cutting"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($contentCutting) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_content_cutting]" id="wpdiscuz_widget_content_cutting">
            <label for="wpdiscuz_widget_content_cutting"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widgets_post_content_word_count" <?php echo $contentCutting ? "" : "style='display:none;'"; ?>>
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widgets_post_content_word_count"><?php echo $setting["options"]["wpdiscuz_widgets_post_content_word_count"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widgets_post_content_word_count"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widgets_post_content_word_count" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widgets_post_content_word_count]" value="<?php echo $setting["values"]->options["wpdiscuz_widgets_post_content_word_count"]; ?>" style="width: 80px;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="mvc_displaying_style">
    <div class="wpd-opt-name">
        <label for="mvc_displaying_style"><?php echo $setting["options"]["mvc_displaying_style"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["mvc_displaying_style"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <label class='wpdiscuz-widget-votes-style-label'><input type="radio" name="<?php echo $setting["values"]->tabKey; ?>[mvc_displaying_style]" value="votes_style" <?php checked($setting["values"]->options["mvc_displaying_style"], "votes_style", true); ?>> <img src="<?php echo plugins_url("../assets/images/votes-style.png", __FILE__); ?>"></label><br><br>
        <label class='wpdiscuz-widget-votes-style-label'><input type="radio" name="<?php echo $setting["values"]->tabKey; ?>[mvc_displaying_style]" value="avatar_style" <?php checked($setting["values"]->options["mvc_displaying_style"], "avatar_style", true); ?>> <img src="<?php echo plugins_url("../assets/images/avatar-style.png", __FILE__); ?>"></label><br><br>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wc_widget_background_color">
    <div class="wpd-opt-name">
        <label for="wc_widget_background_color"><?php echo $setting["options"]["wc_widget_background_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wc_widget_background_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpdiscuz-widget-options-votes-bgcolor-inputes-container">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->options["wc_widget_background_color"]; ?>" id="wc_widget_background_color" name="<?php echo $setting["values"]->tabKey; ?>[wc_widget_background_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->options["wc_widget_background_color"]; ?>"/>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wc_icons_background_color">
    <div class="wpd-opt-name">
        <label for="wc_icons_background_color"><?php echo $setting["options"]["wc_icons_background_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wc_icons_background_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpdiscuz-widget-options-votes-bgcolor-inputes-container">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->options["wc_icons_background_color"]; ?>" id="wc_icons_background_color" name="<?php echo $setting["values"]->tabKey; ?>[wc_icons_background_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->options["wc_icons_background_color"]; ?>"/>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wc_icons_color">
    <div class="wpd-opt-name">
        <label for="wc_icons_color"><?php echo $setting["options"]["wc_icons_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wc_icons_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpdiscuz-widget-options-votes-bgcolor-inputes-container">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->options["wc_icons_color"]; ?>" id="wc_icons_color" name="<?php echo $setting["values"]->tabKey; ?>[wc_icons_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->options["wc_icons_color"]; ?>"/>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_icon_circle">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_icon_circle"><?php echo $setting["options"]["wpdiscuz_widget_icon_circle"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_icon_circle"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["wpdiscuz_widget_icon_circle"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_icon_circle]" id="wpdiscuz_widget_icon_circle">
            <label for="wpdiscuz_widget_icon_circle"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_max_width">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_max_width"><?php echo $setting["options"]["wpdiscuz_widget_max_width"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_max_width"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widget_max_width" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_max_width]" value="<?php echo $setting["values"]->options["wpdiscuz_widget_max_width"]; ?>" style="width: 80px;"/>&nbsp; px
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_lmargin">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_lmargin"><?php echo $setting["options"]["wpdiscuz_widget_lmargin"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_lmargin"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widget_lmargin" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_lmargin]" value="<?php echo $setting["values"]->options["wpdiscuz_widget_lmargin"]; ?>" style="width: 80px;"/>&nbsp; px
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_rmargin">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_rmargin"><?php echo $setting["options"]["wpdiscuz_widget_rmargin"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_rmargin"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widget_rmargin" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_rmargin]" value="<?php echo $setting["values"]->options["wpdiscuz_widget_rmargin"]; ?>" style="width: 80px;"/>&nbsp; px
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_lpadding">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_lpadding"><?php echo $setting["options"]["wpdiscuz_widget_lpadding"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_lpadding"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widget_lpadding" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_lpadding]" value="<?php echo $setting["values"]->options["wpdiscuz_widget_lpadding"]; ?>" style="width: 80px;"/>&nbsp; px
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_rpadding">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_rpadding"><?php echo $setting["options"]["wpdiscuz_widget_rpadding"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_rpadding"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wpdiscuz_widget_rpadding" min="0" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_rpadding]" value="<?php echo $setting["values"]->options["wpdiscuz_widget_rpadding"]; ?>" style="width: 80px;"/>&nbsp; px
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="excluded_user_roles">
    <div class="wpd-opt-name">
        <label for="excluded_user_roles"><?php echo $setting["options"]["excluded_user_roles"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["excluded_user_roles"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <?php
        foreach (get_editable_roles() as $role => $values) {
            ?>
            <div class="wpd-mublock-inline" style="width: 200px; min-width: 33%;">
                <input type="checkbox" <?php checked(in_array($role, $setting["values"]->options["excluded_user_roles"])); ?> value="<?php echo $role; ?>" name="<?php echo $setting["values"]->tabKey; ?>[excluded_user_roles][]" id="wpdicuz_widgets_role_<?php echo $role; ?>" style="margin:0px; vertical-align: middle;" />
                <label for="wpdicuz_widgets_role_<?php echo $role; ?>" style="white-space:nowrap; font-size:13px;"><?php echo ucfirst($role); ?></label>
            </div>
            <?php
        }
        ?>
        <div class="wpd-clear"></div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_displaying_guests">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_displaying_guests"><?php echo $setting["options"]["wpdiscuz_widget_displaying_guests"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_displaying_guests"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["wpdiscuz_widget_displaying_guests"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_displaying_guests]" id="wpdiscuz_widget_displaying_guests">
            <label for="wpdiscuz_widget_displaying_guests"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_author_link">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_author_link"><?php echo $setting["options"]["wpdiscuz_widget_author_link"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_author_link"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["wpdiscuz_widget_author_link"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_author_link]" id="wpdiscuz_widget_author_link">
            <label for="wpdiscuz_widget_author_link"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_slider_enable">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_slider_enable"><?php echo $setting["options"]["wpdiscuz_widget_slider_enable"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_slider_enable"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["wpdiscuz_widget_slider_enable"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_slider_enable]" id="wpdiscuz_widget_slider_enable">
            <label for="wpdiscuz_widget_slider_enable"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_theme_title_struct">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_widget_theme_title_struct"><?php echo $setting["options"]["wpdiscuz_widget_theme_title_struct"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_theme_title_struct"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["wpdiscuz_widget_theme_title_struct"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_theme_title_struct]" id="wpdiscuz_widget_theme_title_struct">
            <label for="wpdiscuz_widget_theme_title_struct"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_widget_custom_css">
    <div class="wpd-opt-name" style="width: 28%;">
        <label for="wpdiscuz_widget_custom_css"><?php echo $setting["options"]["wpdiscuz_widget_custom_css"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_widget_custom_css"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input" style="width: 69%; text-align: right;">
        <textarea class="regular-text" id="wpdiscuz_widget_custom_css" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_widget_custom_css]" placeholder="" style="width: 90%; height: 100px; color: #333333; font-family: 'Courier New', Courier, monospace; background: #f5f5f5;direction:ltr;text-align:left;"><?php echo stripslashes($setting["values"]->options["wpdiscuz_widget_custom_css"]); ?></textarea>
    </div>
</div>
<!-- Option end -->