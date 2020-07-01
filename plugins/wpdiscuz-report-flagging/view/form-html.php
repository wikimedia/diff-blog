<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<div class="fc-email-form fc-popup" style="display: none">
    <span class="fc-author" >
        <i class="fas fa-exclamation-triangle"></i> &nbsp;<?php _e($this->options->reportPopupTitle, "wpdiscuz_fc"); ?><em></em>
    </span>
    <span class="fc-close"><i class="fas fa-times"></i></span>
    <div style="clear: both;"></div>
    <form method="post" id="wpdiscuz_fc_form">
        <div class="fc-checkbox">
            <table>
                <?php foreach ($this->options->optionType as $key => $types): ?>
                    <tr>
                        <td><input type="radio" name="wpdiscuz_report" value="<?php echo $types ?>" id="wpdiscuz_report_<?php echo $key ?>"/></td>
                        <td><label for="wpdiscuz_report_<?php echo $key ?>"><?php _e($types, "wpdiscuz_fc"); ?> </label></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><input type="radio" name="wpdiscuz_report" value="other" id="wpdiscuz_other"/></td>
                    <td><label for="wpdiscuz_other"><?php _e($this->options->reportOther, "wpdiscuz_fc"); ?> </label></td>
                <tr>
            </table>
        </div>
        <div>
            <textarea style="display:none;" class="fc-message-area" name="wpdiscuz_message" placeholder="<?php _e($this->options->messageField, "wpdiscuz_fc"); ?>" rows="2" cols="20"></textarea>
            <button type="button" class="fc-send"><?php _e($this->options->sendBtn, "wpdiscuz_fc"); ?></button>
            <span class="fc_msg"></span>
        </div>
        <input type="hidden" value="" id="wpdiscuz_fc_commentid" name="commentId"/>
    </form>

</div>
<div class="fc-email fc-popup" style="display: none"></div>