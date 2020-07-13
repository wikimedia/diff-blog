<?php
if (!defined("ABSPATH")) {
    exit();
}
$stcrSubscriptionsCount = intval($this->dbManager->getStcrAllSubscriptions());
$disabled = $stcrSubscriptionsCount ? "" : "disabled='disabled'";
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Import subscriptions", "wpdiscuz"); ?></h2>
    <p style="font-size:13px; color:#999999; width:90%; padding-left:0px; margin-left:10px;">
        <?php esc_html_e("Using this tool you can import subscriptions from other plugins to wpDiscuz.", "wpdiscuz"); ?> 
    </p>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-stcr-subscriptions"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button type="submit" class="button button-secondary import-stcr" <?php echo $disabled; ?> title="<?php esc_attr_e("Import subscriptions from Subscribe To Comments Reloaded", "wpdiscuz"); ?>">
                            <?php esc_html_e('Import subscriptions from "Subscribe To Comments Reloaded" plugin', "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <span class="import-progress">&nbsp;</span>
                        <input type="hidden" name="stcr-subscriptions-count" value="<?php echo esc_attr($stcrSubscriptionsCount); ?>" class="stcr-subscriptions-count" />
                        <input type="hidden" name="stcr-step" value="0" class="stcr-step"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>