<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<!-- Option start -->
<div class="wpd-opt-row">
    <div class="wpd-opt-intro">
        <img class="wpd-opt-img" src="<?php echo esc_url_raw(plugins_url(WPDISCUZ_DIR_NAME . "/assets/img/dashboard/" . $setting["icon"])); ?>" style="height: 90px; padding-top: 5px;"/>
        <?php esc_html_e("Here you can manage comment thread styles, custom colors and add custom CSS. By default wpDiscuz comes with &laquo;Light&raquo; style. If your theme style is dark, we recommend choose the &laquo;Dark&raquo; option for comments too. In case you want to totally customize comment style or create it from scratch, we recommend choose the &laquo;Minimal&raquo; option to stop loading wpDiscuz core CSS. In this case only basic CSS code will be loaded allowing you add your custom style easier.", "wpdiscuz"); ?>
    </div>
    <div class="wpd-opt-doc" style="padding-top: 10px;">
        <a href="https://wpdiscuz.com/docs/wpdiscuz-7/plugin-settings/styles-and-colors/" title="<?php esc_attr_e("Read the documentation", "wpdiscuz") ?>" target="_blank"><i class="far fa-question-circle"></i></a>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="theme">
    <div class="wpd-opt-name">
        <label for="theme"><?php echo esc_html($setting["options"]["theme"]["label"]) ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["theme"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switch-field">
            <input <?php checked($this->thread_styles["theme"] == "wpd-minimal"); ?> value="wpd-minimal" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[theme]" id="themeMinimal" type="radio"><label for="themeMinimal"><?php esc_html_e("Minimal", "wpdiscuz"); ?></label>
            <input <?php checked($this->thread_styles["theme"] == "wpd-default"); ?> value="wpd-default" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[theme]" id="themeDefault" type="radio"><label for="themeDefault"><?php esc_html_e("Default", "wpdiscuz"); ?></label>
            <input <?php checked($this->thread_styles["theme"] == "wpd-dark"); ?> value="wpd-dark" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[theme]" id="themeDark" type="radio"><label for="themeDark"><?php esc_html_e("Dark", "wpdiscuz"); ?></label>
        </div>
    </div>
    <div class="wpd-opt-doc">
        <a href="<?php echo esc_url_raw($setting["options"]["theme"]["docurl"]) ?>" title="<?php esc_attr_e("Read the documentation", "wpdiscuz") ?>" target="_blank"><i class="far fa-question-circle"></i></a>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="colors">
    <div class="wpd-opt-input" style="width: calc(100% - 40px);">
        <h2 style="margin-bottom: 0px;font-size: 15px; color: #555;"><?php echo esc_html($setting["options"]["colors"]["label"]) ?></h2>
        <p class="wpd-desc"><?php echo $setting["options"]["colors"]["description"] ?></p>
        <hr />
        <div class="wpd-color-wrap">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo esc_attr($this->thread_styles["primaryColor"]); ?>" id="primaryColor" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[primaryColor]" placeholder="<?php esc_attr_e("Example: #00FF00", "wpdiscuz"); ?>"/>
            <label><?php esc_html_e("Primary Color", "wpdiscuz"); ?></label>
        </div>
        <div class="wpd-color-wrap">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo esc_attr($this->thread_styles["newLoadedCommentBGColor"]); ?>" id="newLoadedCommentBGColor" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[newLoadedCommentBGColor]" placeholder="<?php esc_attr_e("Example: #00FF00", "wpdiscuz"); ?>"/>
            <label><?php esc_html_e("Unread comments background", "wpdiscuz"); ?></label>
        </div>
        <div class="wpd-color-wrap">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo esc_attr($this->thread_styles["primaryButtonColor"]); ?>" id="primaryButtonColor" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[primaryButtonColor]" placeholder="<?php esc_attr_e("Text Color", "wpdiscuz"); ?>"/>
            <label><?php esc_html_e("Primary buttons text", "wpdiscuz"); ?></label>
        </div>
        <div class="wpd-color-wrap">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo esc_attr($this->thread_styles["primaryButtonBG"]); ?>" id="primaryButtonBG" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[primaryButtonBG]" placeholder="<?php esc_attr_e("Background Color", "wpdiscuz"); ?>"/>
            <label><?php esc_html_e("Primary buttons background", "wpdiscuz"); ?></label>
        </div>
        <div class="wpd-color-wrap">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo esc_attr($this->thread_styles["bubbleColors"]); ?>" id="bubbleColors" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[bubbleColors]" placeholder="<?php esc_attr_e("Example: #00FF00", "wpdiscuz"); ?>"/>
            <label><?php esc_html_e("Comment Bubble Colors", "wpdiscuz"); ?></label>
        </div>
        <div class="wpd-color-wrap">
            <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo esc_attr($this->thread_styles["inlineFeedbackColors"]); ?>" id="inlineFeedbackColors" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[inlineFeedbackColors]" placeholder="<?php esc_attr_e("Example: #00FF00", "wpdiscuz"); ?>"/>
            <label><?php esc_html_e("Inline Feedback Icon Colors", "wpdiscuz"); ?></label>
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="wpd-opt-doc" style="padding-top: 36px;">
        <a href="<?php echo esc_url_raw($setting["options"]["colors"]["docurl"]) ?>" title="<?php esc_attr_e("Read the documentation", "wpdiscuz") ?>" target="_blank"><i class="far fa-question-circle"></i></a>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="commentTextSize">
    <div class="wpd-opt-name">
        <label for="commentTextSize"><?php echo esc_html($setting["options"]["commentTextSize"]["label"]) ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["commentTextSize"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <select id="commentTextSize" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[commentTextSize]" style="width: 80px;">
            <option value="12px" <?php selected($this->thread_styles["commentTextSize"], "12px"); ?>>12px</option>
            <option value="13px" <?php selected($this->thread_styles["commentTextSize"], "13px"); ?>>13px</option>
            <option value="14px" <?php selected($this->thread_styles["commentTextSize"], "14px"); ?>>14px</option>
            <option value="15px" <?php selected($this->thread_styles["commentTextSize"], "15px"); ?>>15px</option>
            <option value="16px" <?php selected($this->thread_styles["commentTextSize"], "16px"); ?>>16px</option>
            <option value="17px" <?php selected($this->thread_styles["commentTextSize"], "17px"); ?>>17px</option>
            <option value="18px" <?php selected($this->thread_styles["commentTextSize"], "18px"); ?>>18px</option>
            <option value="19px" <?php selected($this->thread_styles["commentTextSize"], "19px"); ?>>19px</option>
            <option value="20px" <?php selected($this->thread_styles["commentTextSize"], "20px"); ?>>20px</option>
        </select>
    </div>
    <div class="wpd-opt-doc"></div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="enableFontAwesome">
    <div class="wpd-opt-name">
        <label for="enableFontAwesome"><?php echo esc_html($setting["options"]["enableFontAwesome"]["label"]) ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["enableFontAwesome"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($this->thread_styles["enableFontAwesome"] == 1) ?> value="1" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[enableFontAwesome]" id="enableFontAwesome">
            <label for="enableFontAwesome"></label>
        </div>
    </div>
    <div class="wpd-opt-doc">
        <a href="<?php echo esc_url_raw($setting["options"]["enableFontAwesome"]["docurl"]) ?>" title="<?php esc_attr_e("Read the documentation", "wpdiscuz") ?>" target="_blank"><i class="far fa-question-circle"></i></a>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="customCss">
    <div class="wpd-opt-name" style="width: 28%;">
        <label for="customCss"><?php echo esc_html($setting["options"]["customCss"]["label"]) ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["customCss"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input" style="width: 69%; text-align: right;">
        <textarea class="regular-text" id="customCss" name="<?php echo esc_attr(WpdiscuzCore::TAB_THREAD_STYLES); ?>[customCss]" placeholder="" style="width: 90%; height: 100px; color: #333333; font-family: 'Courier New', Courier, monospace; background: #f5f5f5;direction:ltr;text-align:left;"><?php echo stripslashes($this->thread_styles["customCss"]); ?></textarea>
    </div>
    <div class="wpd-opt-doc">
        <a href="<?php echo esc_url_raw($setting["options"]["customCss"]["docurl"]) ?>" title="<?php esc_attr_e("Read the documentation", "wpdiscuz") ?>" target="_blank"><i class="far fa-question-circle"></i></a>
    </div>
</div>
<!-- Option end -->
