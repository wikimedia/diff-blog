<?php
if (!defined("ABSPATH")) {
    exit();
}
$showSyncMessage = intval(get_option(self::OPTION_SLUG_SHOW_SYNC_COMMENTERS_MESSAGE));
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Synchronize Commenters Data", "wpdiscuz"); ?></h2>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-sync-commenters"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button <?php echo $showSyncMessage ? "" : "disabled='disabled'"; ?> type="submit" class="button button-secondary sync-commenter-data" title="<?php esc_attr_e("Start Sync", "wpdiscuz"); ?>">
                            <?php esc_html_e("Synchronize Commenters Data", "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <span class="sync-commenter-import-progress"></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>