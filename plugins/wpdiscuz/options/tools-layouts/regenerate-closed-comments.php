<?php
if (!defined("ABSPATH")) {
    exit();
}
$showClosedMessage = intval(get_option(self::OPTION_SLUG_SHOW_CLOSED_REG_MESSAGE));
$closedRegenerateDataCount = $showClosedMessage ? intval($this->dbManager->getClosedRegenerateCount()) : 0;
$disabled = $closedRegenerateDataCount ? "" : "disabled='disabled'";
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Regenerate Closed Comments", "wpdiscuz"); ?></h2>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-closed-regenerate"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button <?php echo $disabled; ?> type="submit" class="button button-secondary regenerate-closed-comments" title="<?php esc_attr_e("Start Regenerate", "wpdiscuz"); ?>">
                            <?php esc_html_e("Regenerate Closed Comments", "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <input <?php echo $disabled; ?> type="number" name="closed-regenerate-limit" value="500" min="1" class="closed-regenerate-limit"/>
                        <span class="closed-regenerate-import-progress">&nbsp;</span>
                        <input type="hidden" name="closed-regenerate-start-id" value="0" class="closed-regenerate-start-id"/>
                        <input type="hidden" name="closed-regenerate-count" value="<?php echo esc_attr($closedRegenerateDataCount); ?>" class="closed-regenerate-count"/>
                        <input type="hidden" name="closed-regenerate-step" value="0" class="closed-regenerate-step"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>