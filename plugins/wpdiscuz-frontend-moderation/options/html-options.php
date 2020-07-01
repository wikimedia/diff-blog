<?php
if (!defined("ABSPATH")) {
    exit();
}
?>

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="userCanDelete">
    <div class="wpd-opt-name">
        <label for="userCanDelete"><?php echo $setting["options"]["userCanDelete"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["userCanDelete"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["userCanDelete"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[userCanDelete]" id="userCanDelete">
            <label for="userCanDelete"></label>
        </div>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="displayFilterButton">
    <div class="wpd-opt-name">
        <label for="displayFilterButton"><?php echo $setting["options"]["displayFilterButton"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["displayFilterButton"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->options["displayFilterButton"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[displayFilterButton]" id="displayFilterButton">
            <label for="displayFilterButton"></label>
        </div>
    </div>
</div>
<!-- Option end -->

<div class="wpd-subtitle">
    <span class="dashicons dashicons-paperclip"></span> <?php _e("Front-end Phrases", "wpdiscuz-frontend-moderation") ?>
</div>

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="approve">
    <div class="wpd-opt-name">
        <label for="approve"><?php echo $setting["options"]["approve"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["approve"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[approve]" value="<?php echo $setting["values"]->phrases["approve"]; ?>" id="approve" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="unapprove">
    <div class="wpd-opt-name">
        <label for="unapprove"><?php echo $setting["options"]["unapprove"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["unapprove"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[unapprove]" value="<?php echo $setting["values"]->phrases["unapprove"]; ?>" id="unapprove" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="trash">
    <div class="wpd-opt-name">
        <label for="trash"><?php echo $setting["options"]["trash"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["trash"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[trash]" value="<?php echo $setting["values"]->phrases["trash"]; ?>" id="trash" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="spam">
    <div class="wpd-opt-name">
        <label for="spam"><?php echo $setting["options"]["spam"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["spam"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[spam]" value="<?php echo $setting["values"]->phrases["spam"]; ?>" id="spam" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="email">
    <div class="wpd-opt-name">
        <label for="email"><?php echo $setting["options"]["email"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["email"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[email]" value="<?php echo $setting["values"]->phrases["email"]; ?>" id="email" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="move">
    <div class="wpd-opt-name">
        <label for="move"><?php echo $setting["options"]["move"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["move"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[move]" value="<?php echo $setting["values"]->phrases["move"]; ?>" id="move" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="blacklist">
    <div class="wpd-opt-name">
        <label for="blacklist"><?php echo $setting["options"]["blacklist"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["blacklist"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[blacklist]" value="<?php echo $setting["values"]->phrases["blacklist"]; ?>" id="blacklist" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="delete">
    <div class="wpd-opt-name">
        <label for="delete"><?php echo $setting["options"]["delete"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["delete"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[delete]" value="<?php echo $setting["values"]->phrases["delete"]; ?>" id="delete" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="email_subject">
    <div class="wpd-opt-name">
        <label for="email_subject"><?php echo $setting["options"]["email_subject"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["email_subject"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[email_subject]" value="<?php echo $setting["values"]->phrases["email_subject"]; ?>" id="email_subject" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="email_message">
    <div class="wpd-opt-name">
        <label for="email_message"><?php echo $setting["options"]["email_message"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["email_message"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[email_message]" value="<?php echo $setting["values"]->phrases["email_message"]; ?>" id="email_message" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="going_to_mail">
    <div class="wpd-opt-name">
        <label for="going_to_mail"><?php echo $setting["options"]["going_to_mail"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["going_to_mail"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[going_to_mail]" value="<?php echo $setting["values"]->phrases["going_to_mail"]; ?>" id="going_to_mail" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="send">
    <div class="wpd-opt-name">
        <label for="send"><?php echo $setting["options"]["send"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["send"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[send]" value="<?php echo $setting["values"]->phrases["send"]; ?>" id="send" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="move_comment">
    <div class="wpd-opt-name">
        <label for="move_comment"><?php echo $setting["options"]["move_comment"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["move_comment"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[move_comment]" value="<?php echo $setting["values"]->phrases["move_comment"]; ?>" id="move_comment" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="post_title">
    <div class="wpd-opt-name">
        <label for="post_title"><?php echo $setting["options"]["post_title"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["post_title"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[post_title]" value="<?php echo $setting["values"]->phrases["post_title"]; ?>" id="post_title" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="unapproved_confirm">
    <div class="wpd-opt-name">
        <label for="unapproved_confirm"><?php echo $setting["options"]["unapproved_confirm"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["unapproved_confirm"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[unapproved_confirm]" value="<?php echo $setting["values"]->phrases["unapproved_confirm"]; ?>" id="unapproved_confirm" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="approved_confirm">
    <div class="wpd-opt-name">
        <label for="approved_confirm"><?php echo $setting["options"]["approved_confirm"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["approved_confirm"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[approved_confirm]" value="<?php echo $setting["values"]->phrases["approved_confirm"]; ?>" id="approved_confirm" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="trashed_confirm">
    <div class="wpd-opt-name">
        <label for="trashed_confirm"><?php echo $setting["options"]["trashed_confirm"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["trashed_confirm"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[trashed_confirm]" value="<?php echo $setting["values"]->phrases["trashed_confirm"]; ?>" id="trashed_confirm" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="spam_confirm">
    <div class="wpd-opt-name">
        <label for="spam_confirm"><?php echo $setting["options"]["spam_confirm"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["spam_confirm"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[spam_confirm]" value="<?php echo $setting["values"]->phrases["spam_confirm"]; ?>" id="spam_confirm" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="confirm_blacklist">
    <div class="wpd-opt-name">
        <label for="confirm_blacklist"><?php echo $setting["options"]["confirm_blacklist"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["confirm_blacklist"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[confirm_blacklist]" value="<?php echo $setting["values"]->phrases["confirm_blacklist"]; ?>" id="confirm_blacklist" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="confirm_delete">
    <div class="wpd-opt-name">
        <label for="confirm_delete"><?php echo $setting["options"]["confirm_delete"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["confirm_delete"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[confirm_delete]" value="<?php echo $setting["values"]->phrases["confirm_delete"]; ?>" id="confirm_delete" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="status_trashed">
    <div class="wpd-opt-name">
        <label for="status_trashed"><?php echo $setting["options"]["status_trashed"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["status_trashed"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[status_trashed]" value="<?php echo $setting["values"]->phrases["status_trashed"]; ?>" id="status_trashed" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="status_spam">
    <div class="wpd-opt-name">
        <label for="status_spam"><?php echo $setting["options"]["status_spam"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["status_spam"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[status_spam]" value="<?php echo $setting["values"]->phrases["status_spam"]; ?>" id="status_spam" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="ops_message">
    <div class="wpd-opt-name">
        <label for="ops_message"><?php echo $setting["options"]["ops_message"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["ops_message"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[ops_message]" value="<?php echo $setting["values"]->phrases["ops_message"]; ?>" id="ops_message" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="cant_moderate">
    <div class="wpd-opt-name">
        <label for="cant_moderate"><?php echo $setting["options"]["cant_moderate"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["cant_moderate"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[cant_moderate]" value="<?php echo $setting["values"]->phrases["cant_moderate"]; ?>" id="cant_moderate" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="blacklist_success">
    <div class="wpd-opt-name">
        <label for="blacklist_success"><?php echo $setting["options"]["blacklist_success"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["blacklist_success"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[blacklist_success]" value="<?php echo $setting["values"]->phrases["blacklist_success"]; ?>" id="blacklist_success" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="blacklist_ops_message">
    <div class="wpd-opt-name">
        <label for="blacklist_ops_message"><?php echo $setting["options"]["blacklist_ops_message"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["blacklist_ops_message"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[blacklist_ops_message]" value="<?php echo $setting["values"]->phrases["blacklist_ops_message"]; ?>" id="blacklist_ops_message" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="blacklist_cant_set">
    <div class="wpd-opt-name">
        <label for="blacklist_cant_set"><?php echo $setting["options"]["blacklist_cant_set"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["blacklist_cant_set"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[blacklist_cant_set]" value="<?php echo $setting["values"]->phrases["blacklist_cant_set"]; ?>" id="blacklist_cant_set" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="ok">
    <div class="wpd-opt-name">
        <label for="ok"><?php echo $setting["options"]["ok"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["ok"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[ok]" value="<?php echo $setting["values"]->phrases["ok"]; ?>" id="ok" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="move_response_success">
    <div class="wpd-opt-name">
        <label for="move_response_success"><?php echo $setting["options"]["move_response_success"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["move_response_success"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[move_response_success]" value="<?php echo $setting["values"]->phrases["move_response_success"]; ?>" id="move_response_success" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="fill_correct_data">
    <div class="wpd-opt-name">
        <label for="fill_correct_data"><?php echo $setting["options"]["fill_correct_data"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["fill_correct_data"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[fill_correct_data]" value="<?php echo $setting["values"]->phrases["fill_correct_data"]; ?>" id="fill_correct_data" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="delete_cant_delete">
    <div class="wpd-opt-name">
        <label for="delete_cant_delete"><?php echo $setting["options"]["delete_cant_delete"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["delete_cant_delete"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[delete_cant_delete]" value="<?php echo $setting["values"]->phrases["delete_cant_delete"]; ?>" id="delete_cant_delete" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="email_cant_mail">
    <div class="wpd-opt-name">
        <label for="email_cant_mail"><?php echo $setting["options"]["email_cant_mail"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["email_cant_mail"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[email_cant_mail]" value="<?php echo $setting["values"]->phrases["email_cant_mail"]; ?>" id="email_cant_mail" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="email_dont_sended">
    <div class="wpd-opt-name">
        <label for="email_dont_sended"><?php echo $setting["options"]["email_dont_sended"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["email_dont_sended"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[email_dont_sended]" value="<?php echo $setting["values"]->phrases["email_dont_sended"]; ?>" id="email_dont_sended" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="email_success">
    <div class="wpd-opt-name">
        <label for="email_success"><?php echo $setting["options"]["email_success"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["email_success"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[email_success]" value="<?php echo $setting["values"]->phrases["email_success"]; ?>" id="email_success" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="please_fill">
    <div class="wpd-opt-name">
        <label for="please_fill"><?php echo $setting["options"]["please_fill"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["please_fill"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[please_fill]" value="<?php echo $setting["values"]->phrases["please_fill"]; ?>" id="please_fill" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->

<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="choose_post">
    <div class="wpd-opt-name">
        <label for="choose_post"><?php echo $setting["options"]["choose_post"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["choose_post"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[choose_post]" value="<?php echo $setting["values"]->phrases["choose_post"]; ?>" id="choose_post" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->