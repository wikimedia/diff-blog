<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Import phrases", "wpdiscuz"); ?></h2>
    <p style="font-size:13px; color:#999999; width:90%; padding-left:0px; margin-left:10px;">
        <?php esc_html_e("Here you can import and restore wpDiscuz phrases. You just need to choose backup file and click import phrases.", "wpdiscuz"); ?> 
    </p>
    <form action="" method="post" class="wc-tools-settings-form wc-form" enctype="multipart/form-data">
        <?php wp_nonce_field("wc_tools_form", "wpd-phrases-import"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>
                <tr>
                    <td>
                        <input type="file" name="wpdiscuz-phrases-file" class=""/>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;">
                        <input type="submit" name="wpdiscuz-import-submit" class="button button-primary" value="<?php esc_attr_e("Import Phrases", "wpdiscuz"); ?>">
                        <input type="hidden" name="tools-action" value="import-phrases" />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>