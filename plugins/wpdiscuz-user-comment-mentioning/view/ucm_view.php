<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="enableCommentMentioning">
    <div class="wpd-opt-name">
        <label for="enableCommentMentioning"><?php echo $setting["options"]["enableCommentMentioning"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["enableCommentMentioning"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->enableCommentMentioning == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[enableCommentMentioning]" id="enableCommentMentioning">
            <label for="enableCommentMentioning"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="guestMentioning">
    <div class="wpd-opt-name">
        <label for="guestMentioning"><?php echo $setting["options"]["guestMentioning"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["guestMentioning"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->guestMentioning == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[guestMentioning]" id="guestMentioning">
            <label for="guestMentioning"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="displayNicename">
    <div class="wpd-opt-name">
        <label for="displayNicename"><?php echo $setting["options"]["displayNicename"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["displayNicename"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->displayNicename == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[displayNicename]" id="displayNicename">
            <label for="displayNicename"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="viewAvatarInComment">
    <div class="wpd-opt-name">
        <label for="viewAvatarInComment"><?php echo $setting["options"]["viewAvatarInComment"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["viewAvatarInComment"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->viewAvatarInComment == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[viewAvatarInComment]" id="viewAvatarInComment">
            <label for="viewAvatarInComment"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="viewAvatarInTooltip">
    <div class="wpd-opt-name">
        <label for="viewAvatarInTooltip"><?php echo $setting["options"]["viewAvatarInTooltip"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["viewAvatarInTooltip"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->viewAvatarInTooltip == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[viewAvatarInTooltip]" id="viewAvatarInTooltip">
            <label for="viewAvatarInTooltip"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="viewID">
    <div class="wpd-opt-name">
        <label for="viewID"><?php echo $setting["options"]["viewID"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["viewID"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->viewID == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[viewID]" id="viewID">
            <label for="viewID"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="textLength">
    <div class="wpd-opt-name">
        <label for="textLength"><?php echo $setting["options"]["textLength"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["textLength"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="textLength" min="0" name="<?php echo $setting["values"]->tabKey; ?>[textLength]" value="<?php echo $setting["values"]->textLength ? $setting["values"]->textLength : 150; ?>" style="width: 80px;"/>&nbsp; <?php _e("characters", "wpdiscuz_ucm"); ?>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="userListCount">
    <div class="wpd-opt-name">
        <label for="userListCount"><?php echo $setting["options"]["userListCount"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["userListCount"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="userListCount" name="<?php echo $setting["values"]->tabKey; ?>[userListCount]" min="1" value="<?php echo $setting["values"]->userListCount ? $setting["values"]->userListCount : 8; ?>" style="width: 80px;"/>&nbsp; <?php _e("items", "wpdiscuz_ucm"); ?>
    </div>
</div>
<!-- Option end -->
<?php if ($setting["values"]->enableCommentMentioning) { ?>
    <div class="wpd-subtitle">
        <?php _e("Comment mentioning through #comment-id", "wpdiscuz_ucm"); ?>
        <strong><?php _e("Message to mentioned comment author", "wpdiscuz_ucm"); ?></strong>
    </div>
    <!-- Option start -->
    <div class="wpd-opt-row" data-wpd-opt="adminEmail">
        <div class="wpd-opt-name">
            <label for="adminEmail"><?php echo $setting["options"]["adminEmail"]["label"] ?></label>
            <p class="wpd-desc"><?php echo $setting["options"]["adminEmail"]["description"] ?></p>
        </div>
        <div class="wpd-opt-input">
            <div class="wpd-switcher">
                <input type="checkbox" <?php checked($setting["values"]->adminEmail == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[adminEmail]" id="adminEmail">
                <label for="adminEmail"></label>
            </div>
        </div>
    </div>
    <!-- Option end -->
    <!-- Option start -->
    <div class="wpd-opt-row" data-wpd-opt="authorMailSubject">
        <div class="wpd-opt-name">
            <label for="authorMailSubject"><?php echo $setting["options"]["authorMailSubject"]["label"] ?></label>
            <p class="wpd-desc"><?php echo $setting["options"]["authorMailSubject"]["description"] ?></p>
        </div>
        <div class="wpd-opt-input">
            <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[authorMailSubject]" value="<?php echo $setting["values"]->authorMailSubject; ?>" id="authorMailSubject" style="margin:1px;padding:3px 5px; width:90%;"/>
        </div>
    </div>
    <!-- Option end -->
    <!-- Option start -->
    <div class="wpd-opt-row" data-wpd-opt="authorMailMessage">
        <div class="wpd-opt-name">
            <label for="authorMailMessage"><?php echo $setting["options"]["authorMailMessage"]["label"] ?></label>
            <p class="wpd-desc">
                <?php echo $setting["options"]["authorMailMessage"]["description"] ?>
                <i> [mentionedUserName] - <?php _e("Mentioned comment author name", "wpdiscuz_ucm"); ?></i><br/>
                <i> [postTitle] - <?php _e("Post Title", "wpdiscuz_ucm"); ?></i><br/>
                <i> [authorUserName] - <?php _e("Comment author name", "wpdiscuz_ucm"); ?></i><br/>
                <i> [commentURL] - <?php _e("Comment URL", "wpdiscuz_ucm"); ?></i>
            </p>
        </div>
        <div class="wpd-opt-input">
            <textarea name="<?php echo $setting["values"]->tabKey; ?>[authorMailMessage]" id="authorMailMessage" style="width:90%;" rows="6"><?php echo $setting["values"]->authorMailMessage; ?></textarea>
        </div>
    </div>
    <!-- Option end -->
<?php } ?>
<div class="wpd-subtitle">
    <?php _e("User mentioning through @username", "wpdiscuz_ucm"); ?>
    <strong><?php _e("Message to mentioned user", "wpdiscuz_ucm"); ?></strong>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="userEmail">
    <div class="wpd-opt-name">
        <label for="userEmail"><?php echo $setting["options"]["userEmail"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["userEmail"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->userEmail == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[userEmail]" id="userEmail">
            <label for="userEmail"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="userMailSubject">
    <div class="wpd-opt-name">
        <label for="userMailSubject"><?php echo $setting["options"]["userMailSubject"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["userMailSubject"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[userMailSubject]" value="<?php echo $setting["values"]->userMailSubject; ?>" id="userMailSubject" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="userMailMessage">
    <div class="wpd-opt-name">
        <label for="userMailMessage"><?php echo $setting["options"]["userMailMessage"]["label"] ?></label>
        <p class="wpd-desc">
            <?php echo $setting["options"]["userMailMessage"]["description"] ?>
            <i> [mentionedUserName] - <?php _e("Mentioned user name", "wpdiscuz_ucm"); ?></i><br/>
            <i> [postTitle] - <?php _e("Post Title", "wpdiscuz_ucm"); ?></i><br/>
            <i> [authorUserName] - <?php _e("Comment author name", "wpdiscuz_ucm"); ?></i><br/>
            <i> [commentURL] - <?php _e("Comment URL", "wpdiscuz_ucm"); ?></i>
        </p>
    </div>
    <div class="wpd-opt-input">
        <textarea name="<?php echo $setting["values"]->tabKey; ?>[userMailMessage]" id="userMailMessage" style="width:90%;" rows="6"><?php echo $setting["values"]->userMailMessage; ?></textarea>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Front-end Phrases", "wpdiscuz_ucm"); ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="posts">
    <div class="wpd-opt-name">
        <label for="posts"><?php echo $setting["options"]["posts"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["posts"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[posts]" value="<?php echo $setting["values"]->posts; ?>" id="posts" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="comments">
    <div class="wpd-opt-name">
        <label for="comments"><?php echo $setting["options"]["comments"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["comments"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[comments]" value="<?php echo $setting["values"]->comments; ?>" id="comments" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->