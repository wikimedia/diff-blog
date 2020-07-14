<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<div>
    <h2 style="padding:5px 10px 10px 10px; margin:0px;"><?php esc_html_e("Export options", "wpdiscuz"); ?></h2>
    <p style="font-size:13px; color:#999999; width:90%; padding-left:0px; margin-left:10px;">
        <?php esc_html_e("Using this tool you can migrate or backup/restore wpDiscuz options from one WordPress to another.", "wpdiscuz"); ?> 
    </p>
    <form action="" method="post" class="wc-tools-settings-form wc-form">
        <?php wp_nonce_field("wc_tools_form", "wpd-options-export"); ?>
        <table class="wp-list-table widefat plugins"  style="margin-top:10px; border:none;">
            <tbody>
                <?php if (file_exists($wpdiscuzOptionsDir . self::OPTIONS_FILENAME . ".txt")) { ?>
                    <tr>
                        <td>                    
                            <div class="wpdiscuz-option-download">
                                <a href="<?php echo esc_url_raw($wpdiscuzOptionsUrl . self::OPTIONS_FILENAME . ".txt"); ?>" download="<?php echo esc_attr(self::OPTIONS_FILENAME . ".txt"); ?>" class="button button-secondary">
                                    <?php esc_html_e("Download Options", "wpdiscuz"); ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="text-align:right;">
                        <input type="submit" name="wpdiscuz-export-submit" class="button button-primary" value="<?php esc_attr_e("Backup Options", "wpdiscuz"); ?>">                        
                        <input type="hidden" name="tools-action" value="export-options" />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>