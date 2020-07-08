<?php
if (!defined("ABSPATH")) {
    exit();
}
$commentsCount = get_comments(
        [
            "count" => true,
            "meta_query" => [
                [
                    "key" => "comment_image_reloaded",
                    "value" => "",
                    "compare" => "!="
                ]
            ]
        ]
);
$curImagesCount = intval($commentsCount);
$disabled = $curImagesCount ? "" : "disabled='disabled'";
?>
<div class="wpdtool-accordion-item">

    <div class="fas wpdtool-accordion-title" data-wpdtool-selector="wpdtool-<?php echo $tool["selector"]; ?>">
        <p><?php esc_html_e("Import Comment Images", "wpdiscuz"); ?></p>
    </div>

    <div class="wpdtool-accordion-content">

        <div class="wpdtool wpdtool-import-cir-images">
            <p class="wpdtool-desc"><?php esc_html_e("Using this tool you can import comments' images from other plugins to wpDiscuz.", "wpdiscuz"); ?></p>
            <form action="" method="post" class="wc-tools-settings-form wc-form">
                <?php wp_nonce_field("wc_tools_form", "wpd-cir-images"); ?>
                <div class="wpdtool-block">
                    <button type="submit" class="button button-secondary import-cir" <?php echo $disabled; ?> title="<?php esc_attr_e('Import images from "Comment Images Reloaded"', "wpdiscuz"); ?>">
                        <?php esc_html_e('Import images from "Comment Images Reloaded" plugin', "wpdiscuz"); ?>&nbsp;
                        <i class="fas wc-hidden"></i>
                    </button>
                    <span class="import-progress">&nbsp;</span>
                    <input type="hidden" name="cir-images-count" value="<?php echo esc_attr($curImagesCount); ?>" class="cir-images-count" />
                    <input type="hidden" name="cir-step" value="0" class="cir-step"/>
                </div>
            </form>
        </div>

    </div>
</div>