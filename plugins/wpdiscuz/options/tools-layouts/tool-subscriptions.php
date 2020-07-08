<?php
if (!defined("ABSPATH")) {
    exit();
}
$stcrSubscriptionsCount = intval($this->dbManager->getStcrAllSubscriptions());
$disabledSubscriptions = $stcrSubscriptionsCount ? "" : "disabled='disabled'";
?>
<div class="wpdtool-accordion-item">

    <div class="fas wpdtool-accordion-title" data-wpdtool-selector="wpdtool-<?php echo $tool["selector"]; ?>">
        <p><?php esc_html_e("Import Subscriptions", "wpdiscuz"); ?></p>        
    </div>

    <div class="wpdtool-accordion-content">

        <div class="wpdtool wpdtool-import-subscriptions">
            <p class="wpdtool-desc"><?php esc_html_e("Using this tool you can import subscriptions from other plugins to wpDiscuz.", "wpdiscuz"); ?></p>
            <form action="" method="post" class="wc-tools-settings-form wc-form">
                <?php wp_nonce_field("wc_tools_form", "wpd-stcr-subscriptions"); ?>
                <div class="wpdtool-block">
                    <button type="submit" class="button button-secondary import-stcr" <?php echo $disabledSubscriptions; ?> title="<?php esc_attr_e("Import subscriptions from Subscribe To Comments Reloaded", "wpdiscuz"); ?>">
                        <?php esc_html_e('Import subscriptions from "Subscribe To Comments Reloaded" plugin', "wpdiscuz"); ?>&nbsp;
                        <i class="fas wc-hidden"></i>
                    </button>
                    <span class="import-progress">&nbsp;</span>
                    <input type="hidden" name="stcr-subscriptions-count" value="<?php echo esc_attr($stcrSubscriptionsCount); ?>" class="stcr-subscriptions-count" />
                    <input type="hidden" name="stcr-step" value="0" class="stcr-step"/>
                </div>
            </form>
        </div>

    </div>
</div>