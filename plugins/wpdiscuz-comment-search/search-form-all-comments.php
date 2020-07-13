<?php
if (!defined("ABSPATH")) {
    exit();
}

$fields = $this->options->getAvailableFields();
$savedFields = $this->options->savedOptions["search_available_fields"] ? $this->options->savedOptions["search_available_fields"] : $fields;
if ($customFieldsKey = array_search("custom_fields", $savedFields)) {
    unset($savedFields[$customFieldsKey]);
    array_values($savedFields);
}
$displaySearchSettings = $this->options->savedOptions["display_setting"];
$searchDefaultField = in_array($this->options->savedOptions["search_default_field"], $savedFields) ? $this->options->savedOptions["search_default_field"] : "all";
?>
<div class="wpdiscuz-search-widget">
    <div class="wpdiscuz-widget-search-form clearfix">
        <div class="wpdiscuz-search-box" style="border: 1px solid <?php echo $this->options->savedOptions["search_box_border_color"] ?>; background-color: <?php echo $this->options->savedOptions["search_bg_color"]; ?> ">
            <i class="fas fa-search wpdiscuz-all-search-img"></i>
            <input type="search" placeholder="<?php _e($this->options->savedOptions["search_placeholder"], "wpdiscuz-search") ?>" name="all-search-comment" class="wpdiscuz-all-comm-search" />
            <?php if ($displaySearchSettings && count($savedFields) > 1) { ?>
                <i class="fas fa-bars wpdiscuz-all-search-setting-img"></i>
                <?php
            }
            ?>
        </div>
        <?php if ($displaySearchSettings && count($savedFields) > 1) { ?>
            <div class="wpdiscuz-search-setting wpdiscuz-all-search-setting-wrap" style="border: 1px solid <?php echo $this->options->savedOptions["search_box_border_color"]; ?>">
                <span class="shearch-arrow"></span>
                <span class="shearch-arrow-no-border"></span>
                <?php
                foreach ($savedFields as $savedField) {
                    if ($searchDefaultField != $savedField) {
                        ?>
                        <p><input type="button" name="<?php echo $savedField; ?>" value="<?php _e($this->options->savedOptions["dialog_search_by_$savedField"], "wpdiscuz-search"); ?>" /></p>
                        <?php
                    }
                }
                ?>
                <input type="hidden" name="<?php echo $searchDefaultField; ?>" value="<?php _e($this->options->savedOptions["dialog_search_by_$searchDefaultField"], "wpdiscuz-search"); ?>" class="wpdiscuz-search-by" />
            </div>
        <?php } ?>
    </div>
    <div class="wc-thread-wrapper-search wpdiscuz-all-serch-cont"></div>
    <div class="wpdiscuz-comm-search-all">
        <?php
        $widget_options = get_option("widget_wpdiscuz_search_widget_options");
        $post_count = $widget_options["widget_display_post_count"];
        $display_avatar = $widget_options["widget_display_avatar"];
        $results = get_comments(["orderby" => "comment_ID", "order" => "DESC", "number" => $post_count, "post_id" => ""]);
        $listArgs = [
            "walker" => new wpDiscuzSearchWidgetWalker($this->options, "", $display_avatar),
            "reverse_top_level" => false,
            "style" => "div",
            "echo" => false,
        ];
        echo wp_list_comments($listArgs, $results);
        ?>
    </div>
</div>