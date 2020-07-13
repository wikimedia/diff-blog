<?php
if (!defined("ABSPATH")) {
    exit();
}

$fields = $this->options->getAvailableFields();
$savedFields = $this->options->savedOptions["search_available_fields"] ? $this->options->savedOptions["search_available_fields"] : $fields;
$displaySearchSettings = $this->options->savedOptions["display_setting"];
$searchDefaultField = $this->options->savedOptions["search_default_field"];
?>
<div id="wpdiscuz-search-form">
    <div class="wpdiscuz-search-box">
        <i class="fas fa-search" id="wpdiscuz-search-img"></i>
        <input type="text" placeholder="<?php _e($this->options->savedOptions["search_placeholder"], "wpdiscuz-search") ?>" name="search-comment" class="wpdiscuz-comm-search" />
        <?php if ($displaySearchSettings && count($savedFields) > 1) { ?>
            <i class="fas fa-bars" id="wpdiscuz-search-setting-img"></i>
        <?php } ?>
    </div>
    <?php if ($displaySearchSettings && count($savedFields) > 1) { ?>
        <div class="wpdiscuz-search-setting" id="wpdiscuz-search-setting-wrap">
            <span class="shearch-arrow"></span>
            <span class="shearch-arrow-no-border"></span>
            <?php
            foreach ($savedFields as $savedField) {
                if ($searchDefaultField != $savedField) {
                    ?>
                    <p><input type="button" name="<?php echo $savedField; ?>" value="<?php  _e($this->options->savedOptions["dialog_search_by_$savedField"], "wpdiscuz-search"); ?>" /></p>
                    <?php
                }
            }
            ?>
            <input type="hidden" name="<?php echo $searchDefaultField; ?>" value="<?php _e($this->options->savedOptions["dialog_search_by_$searchDefaultField"], "wpdiscuz-search"); ?>" class="search-by" />
        </div>
    <?php } ?>
</div>
<div id="wpdiscuz-search-container" class="wc-thread-wrapper-search"></div>