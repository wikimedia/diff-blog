<?php
if (!defined("ABSPATH")) {
    exit();
}
$rebuildRatingsCount = intval($this->dbManager->getRebuildRatingsCount());
$disabled = $rebuildRatingsCount ? "" : "disabled='disabled'";
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Rebuid Ratings", "wpdiscuz"); ?></h2>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-rebuild-ratings"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button <?php echo $disabled; ?> type="submit" class="button button-secondary rebuild-ratings" title="<?php esc_attr_e("Start Rebuild", "wpdiscuz"); ?>">
                            <?php esc_html_e("Rebuild Ratings", "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <span class="rebuild-ratings-import-progress">&nbsp;</span>
                        <input type="hidden" name="rebuild-ratings-start-id" value="0" class="rebuild-ratings-start-id"/>
                        <input type="hidden" name="rebuild-ratings-count" value="<?php echo esc_attr($rebuildRatingsCount); ?>" class="rebuild-ratings-count"/>
                        <input type="hidden" name="rebuild-ratings-step" value="0" class="rebuild-ratings-step"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>