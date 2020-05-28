<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Fix Tables", "wpdiscuz"); ?></h2>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-fix-tables"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>                
                <tr>
                    <td>
                        <button type="submit" class="button button-secondary fix-tables" title="<?php esc_attr_e("Fix Tables", "wpdiscuz"); ?>">
                            <?php esc_html_e("Fix Tables", "wpdiscuz"); ?>&nbsp;
                            <i class="fas wc-hidden"></i>
                        </button>
                        <span class="fix-tables-import-progress"></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>