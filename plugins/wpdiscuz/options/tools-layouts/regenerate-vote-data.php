<?php
if (!defined("ABSPATH")) {
    exit();
}
$showVoteDataMessage = intval(get_option(self::OPTION_SLUG_SHOW_VOTE_DATA_REG_MESSAGE));
$voteDataRegenerateCount = $showVoteDataMessage ? intval($this->dbManager->getVoteDataRegenerateCount()) : 0;
$disabled = $voteDataRegenerateCount ? "" : "disabled='disabled'";
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Regenerate Vote Data", "wpdiscuz"); ?></h2>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-regenerate-vote-data"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button <?php echo $disabled; ?> type="submit" class="button button-secondary regenerate-vote-data" title="<?php esc_attr_e("Start Regenerate", "wpdiscuz"); ?>">
                            <?php esc_html_e("Regenerate Vote Data", "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <input <?php echo $disabled; ?> type="number" name="regenerate-vote-data-limit" value="500" min="1" class="regenerate-vote-data-limit"/>
                        <span class="regenerate-vote-data-import-progress">&nbsp;</span>
                        <input type="hidden" name="regenerate-vote-data-start-id" value="0" class="regenerate-vote-data-start-id"/>
                        <input type="hidden" name="regenerate-vote-data-count" value="<?php echo esc_attr($voteDataRegenerateCount); ?>" class="regenerate-vote-data-count"/>
                        <input type="hidden" name="regenerate-vote-data-step" value="0" class="regenerate-vote-data-step"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>