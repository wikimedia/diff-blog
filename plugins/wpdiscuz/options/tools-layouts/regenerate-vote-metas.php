<?php
if (!defined("ABSPATH")) {
    exit();
}
$showVoteMessage = intval(get_option(self::OPTION_SLUG_SHOW_VOTE_REG_MESSAGE));
$voteRegenerateDataCount = $showVoteMessage ? intval($this->dbManager->getVoteRegenerateCount()) : 0;
$disabled = $voteRegenerateDataCount ? "" : "disabled='disabled'";
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Regenerate Vote Metas", "wpdiscuz"); ?></h2>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-vote-regenerate"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button <?php echo $disabled; ?> type="submit" class="button button-secondary regenerate-vote-metas" title="<?php esc_attr_e("Start Regenerate", "wpdiscuz"); ?>">
                            <?php esc_html_e("Regenerate Vote Metas", "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <input <?php echo $disabled; ?> type="number" name="vote-regenerate-limit" value="500" min="1" class="vote-regenerate-limit"/>
                        <span class="vote-regenerate-import-progress">&nbsp;</span>
                        <input type="hidden" name="vote-regenerate-start-id" value="0" class="vote-regenerate-start-id"/>
                        <input type="hidden" name="vote-regenerate-count" value="<?php echo esc_attr($voteRegenerateDataCount); ?>" class="vote-regenerate-count"/>
                        <input type="hidden" name="vote-regenerate-step" value="0" class="vote-regenerate-step"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>