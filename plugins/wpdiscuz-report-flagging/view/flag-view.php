<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="showFlag">
    <div class="wpd-opt-name">
        <label for="showFlag"><?php echo $setting["options"]["showFlag"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["showFlag"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->showFlag == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[showFlag]" id="showFlag">
            <label for="showFlag"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="guestToFlag">
    <div class="wpd-opt-name">
        <label for="guestToFlag"><?php echo $setting["options"]["guestToFlag"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["guestToFlag"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->guestToFlag == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[guestToFlag]" id="guestToFlag">
            <label for="guestToFlag"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="sendFlagMessage">
    <div class="wpd-opt-name">
        <label for="sendFlagMessage"><?php echo $setting["options"]["sendFlagMessage"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["sendFlagMessage"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->sendFlagMessage == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[sendFlagMessage]" id="sendFlagMessage">
            <label for="sendFlagMessage"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="sendFlagMessageGuest">
    <div class="wpd-opt-name">
        <label for="sendFlagMessageGuest"><?php echo $setting["options"]["sendFlagMessageGuest"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["sendFlagMessageGuest"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->sendFlagMessageGuest == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[sendFlagMessageGuest]" id="sendFlagMessageGuest">
            <label for="sendFlagMessageGuest"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="autoModerateCommentType">
    <div class="wpd-opt-name">
        <label><?php echo $setting["options"]["autoModerateCommentType"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["autoModerateCommentType"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switch-field">
            <input type="radio" value="unapprove" <?php checked($setting["values"]->autoModerateCommentType == "unapprove"); ?> name="<?php echo $setting["values"]->tabKey; ?>[autoModerateCommentType]" id="wpdiscuz_unapprove" />
            <label for="wpdiscuz_unapprove" style="min-width:60px;"><?php _e("unapprove", "wpdiscuz_fc"); ?></label>
            <input type="radio" value="trash" <?php checked($setting["values"]->autoModerateCommentType == "trash"); ?> name="<?php echo $setting["values"]->tabKey; ?>[autoModerateCommentType]" id="wpdiscuz_trash" />
            <label for="wpdiscuz_trash" style="min-width:60px;"><?php _e("trash", "wpdiscuz_fc"); ?></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="flagCount">
    <div class="wpd-opt-name">
        <label for="flagCount"><?php echo $setting["options"]["flagCount"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["flagCount"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="flagCount" name="<?php echo $setting["values"]->tabKey; ?>[flagCount]" min="1" value="<?php echo $setting["values"]->flagCount ? $setting["values"]->flagCount : 10; ?>" style="width: 80px;"/>&nbsp; <?php _e("times", "wpdiscuz_fc"); ?>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="voteCount">
    <div class="wpd-opt-name">
        <label for="voteCount"><?php echo $setting["options"]["voteCount"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["voteCount"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="voteCount" name="<?php echo $setting["values"]->tabKey; ?>[voteCount]" min="1" value="<?php echo $setting["values"]->voteCount ? $setting["values"]->voteCount : 10; ?>" style="width: 80px;"/>&nbsp; <?php _e("times", "wpdiscuz_fc"); ?>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="notifyWhenFlagged">
    <div class="wpd-opt-name">
        <label for="notifyWhenFlagged"><?php echo $setting["options"]["notifyWhenFlagged"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["notifyWhenFlagged"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->notifyWhenFlagged == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[notifyWhenFlagged]" id="notifyWhenFlagged">
            <label for="notifyWhenFlagged"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="notifyAdmin">
    <div class="wpd-opt-name">
        <label for="notifyAdmin"><?php echo $setting["options"]["notifyAdmin"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["notifyAdmin"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->notifyAdmin == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[notifyAdmin]" id="notifyAdmin">
            <label for="notifyAdmin"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="flaggedMailTo">
    <div class="wpd-opt-name">
        <label for="flaggedMailTo"><?php echo $setting["options"]["flaggedMailTo"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["flaggedMailTo"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[flaggedMailTo]" value="<?php echo $setting["values"]->flaggedMailTo; ?>" id="flaggedMailTo" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Comment reporting message from reporter to admin", "wpdiscuz_fc"); ?>
    <p class="wpd-info"> <?php _e("This message comes from comment reporting pop-up form. It includes reporter message and bad comment category (reason).", "wpdiscuz_fc"); ?></p>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="flagedMailSubject">
    <div class="wpd-opt-name">
        <label for="flagedMailSubject"><?php echo $setting["options"]["flagedMailSubject"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["flagedMailSubject"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[flagedMailSubject]" value="<?php echo $setting["values"]->flagedMailSubject; ?>" id="flagedMailSubject" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="flagedMailMessage">
    <div class="wpd-opt-name">
        <label for="flagedMailMessage"><?php echo $setting["options"]["flagedMailMessage"]["label"] ?></label>
        <p class="wpd-desc">
            <?php echo $setting["options"]["flagedMailMessage"]["description"] ?>
            <i> [userInfo] - <?php _e("username", "wpdiscuz_fc"); ?></i><br/>
            <i> [reason] - <?php _e("bad comment category", "wpdiscuz_fc"); ?></i><br/>
            <i> [message] - <?php _e("report message", "wpdiscuz_fc"); ?></i><br/>
            <i> [postTitle] - <?php _e("post title", "wpdiscuz_fc"); ?></i><br/>
            <i> [commentInfo] - <?php _e("comment text or URL", "wpdiscuz_fc"); ?></i>
        </p>
    </div>
    <div class="wpd-opt-input">
        <textarea name="<?php echo $setting["values"]->tabKey; ?>[flagedMailMessage]" id="flagedMailMessage" style="width:90%;" rows="6"><?php echo $setting["values"]->flagedMailMessage; ?></textarea>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Auto-moderation notification to admin", "wpdiscuz_fc"); ?>
    <p class="wpd-info"> <?php _e("This message will be sent to admin once maximum number of flags or dislikes is reached for certain comment and this comment is auto-moderated (trashed or unapproved)", "wpdiscuz_fc"); ?></p>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="moderateEmailSubject">
    <div class="wpd-opt-name">
        <label for="moderateEmailSubject"><?php echo $setting["options"]["moderateEmailSubject"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["moderateEmailSubject"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[moderateEmailSubject]" value="<?php echo $setting["values"]->moderateEmailSubject; ?>" id="moderateEmailSubject" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="reportedMailMessage">
    <div class="wpd-opt-name">
        <label for="reportedMailMessage"><?php echo $setting["options"]["reportedMailMessage"]["label"] ?></label>
        <p class="wpd-desc">
            <?php echo $setting["options"]["reportedMailMessage"]["description"] ?>
            <i> [status] - comment status</i><br/>
            <i> [postName] - post URL</i><br/>
            <i> [postTitle] - post title</i><br/>
            <i> [userLogin] - user login</i><br/>
            <i> [userEmail] - user email</i><br/>
            <i> [commentContent] - reported comment content</i>
        </p>
    </div>
    <div class="wpd-opt-input">
        <textarea name="<?php echo $setting["values"]->tabKey; ?>[reportedMailMessage]" id="reportedMailMessage" style="width:90%;" rows="6"><?php echo $setting["values"]->reportedMailMessage; ?></textarea>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Front-end Phrases", "wpdiscuz_fc"); ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="reportPopupTitle">
    <div class="wpd-opt-name">
        <label for="reportPopupTitle"><?php echo $setting["options"]["reportPopupTitle"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["reportPopupTitle"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[reportPopupTitle]" value="<?php echo $setting["values"]->reportPopupTitle; ?>" id="reportPopupTitle" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="sendBtn">
    <div class="wpd-opt-name">
        <label for="sendBtn"><?php echo $setting["options"]["sendBtn"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["sendBtn"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[sendBtn]" value="<?php echo $setting["values"]->sendBtn; ?>" id="sendBtn" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="alreadyFlagged">
    <div class="wpd-opt-name">
        <label for="alreadyFlagged"><?php echo $setting["options"]["alreadyFlagged"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["alreadyFlagged"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[alreadyFlagged]" value="<?php echo $setting["values"]->alreadyFlagged; ?>" id="alreadyFlagged" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="emailNotSend">
    <div class="wpd-opt-name">
        <label for="emailNotSend"><?php echo $setting["options"]["emailNotSend"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["emailNotSend"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[emailNotSend]" value="<?php echo $setting["values"]->emailNotSend; ?>" id="emailNotSend" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="dataNotInserted">
    <div class="wpd-opt-name">
        <label for="dataNotInserted"><?php echo $setting["options"]["dataNotInserted"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["dataNotInserted"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[dataNotInserted]" value="<?php echo $setting["values"]->dataNotInserted; ?>" id="dataNotInserted" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="emailSend">
    <div class="wpd-opt-name">
        <label for="emailSend"><?php echo $setting["options"]["emailSend"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["emailSend"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[emailSend]" value="<?php echo $setting["values"]->emailSend; ?>" id="emailSend" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="checkReportType">
    <div class="wpd-opt-name">
        <label for="checkReportType"><?php echo $setting["options"]["checkReportType"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["checkReportType"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[checkReportType]" value="<?php echo $setting["values"]->checkReportType; ?>" id="checkReportType" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="fillMsgField">
    <div class="wpd-opt-name">
        <label for="fillMsgField"><?php echo $setting["options"]["fillMsgField"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["fillMsgField"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[fillMsgField]" value="<?php echo $setting["values"]->fillMsgField; ?>" id="fillMsgField" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="reportOther">
    <div class="wpd-opt-name">
        <label for="reportOther"><?php echo $setting["options"]["reportOther"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["reportOther"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[reportOther]" value="<?php echo $setting["values"]->reportOther; ?>" id="reportOther" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="messageField">
    <div class="wpd-opt-name">
        <label for="messageField"><?php echo $setting["options"]["messageField"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["messageField"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[messageField]" value="<?php echo $setting["values"]->messageField; ?>" id="messageField" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="flagTitleOn">
    <div class="wpd-opt-name">
        <label for="flagTitleOn"><?php echo $setting["options"]["flagTitleOn"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["flagTitleOn"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[flagTitleOn]" value="<?php echo $setting["values"]->flagTitleOn; ?>" id="flagTitleOn" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="flagTitleOff">
    <div class="wpd-opt-name">
        <label for="flagTitleOff"><?php echo $setting["options"]["flagTitleOff"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["flagTitleOff"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[flagTitleOff]" value="<?php echo $setting["values"]->flagTitleOff; ?>" id="flagTitleOff" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="optionType">
    <div class="wpd-opt-name">
        <label for="optionType"><?php echo $setting["options"]["optionType"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["optionType"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input wpdiscuz_report_types">
        <?php
        foreach ($setting["values"]->optionType as $key => $type) {
            ?>
            <span style="display:flex; margin-bottom: 10px;">
                <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[optionType][]" value="<?php echo $type; ?>" style="margin:1px;padding:3px 5px; width:90%;"/>
                <input type="button" class="report_remove" value="" />
            </span>
            <?php
        }
        ?>
        <input type="button" class="button" id="add_field" value="<?php _e('Add new', 'wpdiscuz_fc') ?>" />
    </div>
</div>
<!-- Option end -->