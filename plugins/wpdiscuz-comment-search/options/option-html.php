<?php
if (!defined("ABSPATH")) {
    exit();
}
$fields = $setting["values"]->getAvailableFields();
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="display_form_for_guests">
    <div class="wpd-opt-name">
        <label for="display_form_for_guests"><?php echo $setting["options"]["display_form_for_guests"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["display_form_for_guests"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->savedOptions["display_form_for_guests"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[display_form_for_guests]" id="display_form_for_guests">
            <label for="display_form_for_guests"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="display_setting">
    <div class="wpd-opt-name">
        <label for="display_setting"><?php echo $setting["options"]["display_setting"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["display_setting"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->savedOptions["display_setting"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[display_setting]" id="display_setting">
            <label for="display_setting"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_available_fields">
    <div class="wpd-opt-name">
        <label for="search_available_fields"><?php echo $setting["options"]["search_available_fields"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_available_fields"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <?php
        $savedFields = is_array($setting["values"]->savedOptions["search_available_fields"]) ? $setting["values"]->savedOptions["search_available_fields"] : $fields;
        foreach ($fields as $field) {
            ?>
            <div style="display:block;padding:5px 0;overflow:hidden;line-height:20px">
                <input type="checkbox" <?php checked(in_array($field, $savedFields)); ?> value="<?php echo $field; ?>" name="<?php echo $setting["values"]->tabKey; ?>[search_available_fields][]" id="available-field-<?php echo $field; ?>" style="vertical-align:middle"/>
                <label for="available-field-<?php echo $field; ?>"><?php echo ucfirst(str_replace("_", " ", $field)); ?></label>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_default_field">
    <div class="wpd-opt-name">
        <label for="search_default_field"><?php echo $setting["options"]["search_default_field"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_default_field"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <select name="<?php echo $setting["values"]->tabKey; ?>[search_default_field]" id="search_default_field">
            <?php
            foreach ($fields as $field) {
                ?>
                <option value="<?php echo $field; ?>" <?php selected($setting["values"]->savedOptions["search_default_field"] == $field); ?>><?php echo ucfirst(str_replace("_", " ", $field)); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_text_min_length">
    <div class="wpd-opt-name">
        <label for="search_text_min_length"><?php echo $setting["options"]["search_text_min_length"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_text_min_length"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="search_text_min_length" min="0" name="<?php echo $setting["values"]->tabKey; ?>[search_text_min_length]" value="<?php echo $setting["values"]->savedOptions["search_text_min_length"]; ?>" style="width: 80px;"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Search form style", "wpdiscuz-search") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="searched_data_bg">
    <div class="wpd-opt-name">
        <label for="searched_data_bg"><?php echo $setting["options"]["searched_data_bg"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["searched_data_bg"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["searched_data_bg"]; ?>" id="searched_data_bg" name="<?php echo $setting["values"]->tabKey; ?>[searched_data_bg]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["searched_data_bg"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_icons_color">
    <div class="wpd-opt-name">
        <label for="search_icons_color"><?php echo $setting["options"]["search_icons_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_icons_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["search_icons_color"]; ?>" id="search_icons_color" name="<?php echo $setting["values"]->tabKey; ?>[search_icons_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["search_icons_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_text_color">
    <div class="wpd-opt-name">
        <label for="search_text_color"><?php echo $setting["options"]["search_text_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_text_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["search_text_color"]; ?>" id="search_text_color" name="<?php echo $setting["values"]->tabKey; ?>[search_text_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["search_text_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_bg_color">
    <div class="wpd-opt-name">
        <label for="search_bg_color"><?php echo $setting["options"]["search_bg_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_bg_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["search_bg_color"]; ?>" id="search_bg_color" name="<?php echo $setting["values"]->tabKey; ?>[search_bg_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["search_bg_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_box_border_color">
    <div class="wpd-opt-name">
        <label for="search_box_border_color"><?php echo $setting["options"]["search_box_border_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_box_border_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["search_box_border_color"]; ?>" id="search_box_border_color" name="<?php echo $setting["values"]->tabKey; ?>[search_box_border_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["search_box_border_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Dialog style", "wpdiscuz-search") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_text_color">
    <div class="wpd-opt-name">
        <label for="dialog_text_color"><?php echo $setting["options"]["dialog_text_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_text_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["dialog_text_color"]; ?>" id="dialog_text_color" name="<?php echo $setting["values"]->tabKey; ?>[dialog_text_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["dialog_text_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_bg_color">
    <div class="wpd-opt-name">
        <label for="dialog_bg_color"><?php echo $setting["options"]["dialog_bg_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_bg_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["dialog_bg_color"]; ?>" id="dialog_bg_color" name="<?php echo $setting["values"]->tabKey; ?>[dialog_bg_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["dialog_bg_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_hover_color">
    <div class="wpd-opt-name">
        <label for="dialog_hover_color"><?php echo $setting["options"]["dialog_hover_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_hover_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["dialog_hover_color"]; ?>" id="dialog_hover_color" name="<?php echo $setting["values"]->tabKey; ?>[dialog_hover_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["dialog_hover_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Pagination style", "wpdiscuz-search") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="pagination_text_color">
    <div class="wpd-opt-name">
        <label for="pagination_text_color"><?php echo $setting["options"]["pagination_text_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["pagination_text_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["pagination_text_color"]; ?>" id="pagination_text_color" name="<?php echo $setting["values"]->tabKey; ?>[pagination_text_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["pagination_text_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="pagination_item_bg_color">
    <div class="wpd-opt-name">
        <label for="pagination_item_bg_color"><?php echo $setting["options"]["pagination_item_bg_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["pagination_item_bg_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["pagination_item_bg_color"]; ?>" id="pagination_item_bg_color" name="<?php echo $setting["values"]->tabKey; ?>[pagination_item_bg_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["pagination_item_bg_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Widget and Shortcode Styles", "wpdiscuz-search") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpdiscuz_search_shortcode">
    <div class="wpd-opt-name">
        <label for="wpdiscuz_search_shortcode"><?php echo $setting["options"]["wpdiscuz_search_shortcode"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpdiscuz_search_shortcode"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" value="[commSearch]" id="wpdiscuz_search_shortcode" name="<?php echo $setting["values"]->tabKey; ?>[wpdiscuz_search_shortcode]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_post_letters_count">
    <div class="wpd-opt-name">
        <label for="widget_post_letters_count"><?php echo $setting["options"]["widget_post_letters_count"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_post_letters_count"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="widget_post_letters_count" min="0" name="<?php echo $setting["values"]->tabKey; ?>[widget_post_letters_count]" value="<?php echo $setting["values"]->savedOptions["widget_post_letters_count"]; ?>" style="width: 80px;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_post_content_color">
    <div class="wpd-opt-name">
        <label for="widget_post_content_color"><?php echo $setting["options"]["widget_post_content_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_post_content_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["widget_post_content_color"]; ?>" id="widget_post_content_color" name="<?php echo $setting["values"]->tabKey; ?>[widget_post_content_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["widget_post_content_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_post_title_color">
    <div class="wpd-opt-name">
        <label for="widget_post_title_color"><?php echo $setting["options"]["widget_post_title_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_post_title_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["widget_post_title_color"]; ?>" id="widget_post_title_color" name="<?php echo $setting["values"]->tabKey; ?>[widget_post_title_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["widget_post_title_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_post_author_date_color">
    <div class="wpd-opt-name">
        <label for="widget_post_author_date_color"><?php echo $setting["options"]["widget_post_author_date_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_post_author_date_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["widget_post_author_date_color"]; ?>" id="widget_post_author_date_color" name="<?php echo $setting["values"]->tabKey; ?>[widget_post_author_date_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["widget_post_author_date_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_loadmore_bg">
    <div class="wpd-opt-name">
        <label for="widget_loadmore_bg"><?php echo $setting["options"]["widget_loadmore_bg"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_loadmore_bg"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["widget_loadmore_bg"]; ?>" id="widget_loadmore_bg" name="<?php echo $setting["values"]->tabKey; ?>[widget_loadmore_bg]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["widget_loadmore_bg"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_loadmore_text">
    <div class="wpd-opt-name">
        <label for="widget_loadmore_text"><?php echo $setting["options"]["widget_loadmore_text"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_loadmore_text"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["widget_loadmore_text"]; ?>" id="widget_loadmore_text" name="<?php echo $setting["values"]->tabKey; ?>[widget_loadmore_text]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["widget_loadmore_text"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="widget_loadmore_border">
    <div class="wpd-opt-name">
        <label for="widget_loadmore_border"><?php echo $setting["options"]["widget_loadmore_border"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["widget_loadmore_border"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->savedOptions["widget_loadmore_border"]; ?>" id="widget_loadmore_border" name="<?php echo $setting["values"]->tabKey; ?>[widget_loadmore_border]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->savedOptions["widget_loadmore_border"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Search Phrases", "wpdiscuz-search") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_result_phrase">
    <div class="wpd-opt-name">
        <label for="search_result_phrase"><?php echo $setting["options"]["search_result_phrase"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_result_phrase"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[search_result_phrase]" value="<?php echo $setting["values"]->savedOptions["search_result_phrase"]; ?>" id="search_result_phrase" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_no_result_phrase">
    <div class="wpd-opt-name">
        <label for="search_no_result_phrase"><?php echo $setting["options"]["search_no_result_phrase"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_no_result_phrase"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[search_no_result_phrase]" value="<?php echo $setting["values"]->savedOptions["search_no_result_phrase"]; ?>" id="search_no_result_phrase" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="search_placeholder">
    <div class="wpd-opt-name">
        <label for="search_placeholder"><?php echo $setting["options"]["search_placeholder"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["search_placeholder"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[search_placeholder]" value="<?php echo $setting["values"]->savedOptions["search_placeholder"]; ?>" id="search_placeholder" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_search_by_all">
    <div class="wpd-opt-name">
        <label for="dialog_search_by_all"><?php echo $setting["options"]["dialog_search_by_all"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_search_by_all"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[dialog_search_by_all]" value="<?php echo $setting["values"]->savedOptions["dialog_search_by_all"]; ?>" id="dialog_search_by_all" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_search_by_content">
    <div class="wpd-opt-name">
        <label for="dialog_search_by_content"><?php echo $setting["options"]["dialog_search_by_content"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_search_by_content"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[dialog_search_by_content]" value="<?php echo $setting["values"]->savedOptions["dialog_search_by_content"]; ?>" id="dialog_search_by_content" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_search_by_author">
    <div class="wpd-opt-name">
        <label for="dialog_search_by_author"><?php echo $setting["options"]["dialog_search_by_author"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_search_by_author"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[dialog_search_by_author]" value="<?php echo $setting["values"]->savedOptions["dialog_search_by_author"]; ?>" id="dialog_search_by_author" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_search_by_email">
    <div class="wpd-opt-name">
        <label for="dialog_search_by_email"><?php echo $setting["options"]["dialog_search_by_email"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_search_by_email"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[dialog_search_by_email]" value="<?php echo $setting["values"]->savedOptions["dialog_search_by_email"]; ?>" id="dialog_search_by_email" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dialog_search_by_custom_fields">
    <div class="wpd-opt-name">
        <label for="dialog_search_by_custom_fields"><?php echo $setting["options"]["dialog_search_by_custom_fields"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dialog_search_by_custom_fields"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[dialog_search_by_custom_fields]" value="<?php echo $setting["values"]->savedOptions["dialog_search_by_custom_fields"]; ?>" id="dialog_search_by_custom_fields" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->