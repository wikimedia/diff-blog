<?php defined("ABSPATH") or exit; ?>
<div class="translate">
    <h3 style="padding:5px 10px 15px 10px; margin:0px; text-align:right; border-bottom:1px solid #ddd; margin:0px 0px 20px auto; font-weight:normal;"><?php _e("Comment Translation", "wpdiscuz-translate"); ?></h3>
    <div class="api-type">
        <?php
        $google_check = $setting["values"]->apiType == "google" ? " checked='checked'" : "";
        $yandex_check = $setting["values"]->apiType == "yandex" ? " checked='checked'" : "";
        ?>
        <label class="check-api yan-api-checked">
            <input id="is-yandex" type="radio" name="ayi-type" value="yandex"  style="display: none"  <?php echo $yandex_check; ?> >
            <div>
                <p><img src="<?php echo plugins_url("../assets/images/yandex.png", __FILE__) ?>" style="height:70px;"></p>
                <p style="padding:5px; margin:0px; font-size:16px; color:#389207; font-weight:bold;"><?php _e("Free &amp; Paid", "wpdiscuz-translate"); ?></p>
                <p style="padding: 10px;">Yandex.Translate API can be used for free in websites, which do not exceed 10,000,000 characters a month (and no more than 1,000,000 in 24 hours). <a href="https://translate.yandex.com/developers" target="_blank">More information &raquo;</a></p>
            </div>
        </label>
        <label class="check-api google-api-checked">
            <input id="is-google" type="radio" name="ayi-type" value="google" style="display: none"  <?php echo $google_check; ?> >
            <div>
                <p><img src="<?php echo plugins_url("../assets/images/google.png", __FILE__) ?>" style="height:60px;"></p>
                <p style="padding:5px; margin:0px; font-size:16px; color:#389207; font-weight:bold;"><?php _e("Only Paid", "wpdiscuz-translate"); ?></p>
                <p style="padding: 10px;">The Google Translate API is provided to you without any free usage quota at all. You will be charged for each successful request you make through the Translate API. <a href="https://cloud.google.com/translate/v2/terms" target="_blank">More information &raquo; </a></p>
            </div>
        </label>
    </div>
    <?php
    $googleApiKey = $setting["values"]->apiType == "google" ? $setting["values"]->apiKey : "";
    $yandexApiKey = $setting["values"]->apiType == "yandex" ? $setting["values"]->apiKey : "";
    ?>
    <!-- google API-->
    <div class="google-api" style="display: none;">
        <h2 class="api-key-title" id="title-google"><span style="color:#637BF7;">G</span><span style="color:#EC4D3B;">o</span><span style="color:#FAC009;">o</span><span style="color:#637BF7;">g</span><span style="color:#68AA50;">l</span><span style="color:#EC4D3B;">e</span>.Translate</h2>
        <div class="yan-tr-cont" style="display:table; width:100%; margin:0px auto 0px auto; padding:10px;">
            <div style="display:table-cell; font-size:16px; white-space:nowrap; width:10%;  padding-top: 4px; vertical-align: top;"><?php _e("API key: ", "wpdiscuz-translate"); ?></div>
            <div style="display:flex; vertical-align:bottom;">
                <div class="input-container"> 
                    <input type="text" class="set-api google-api-input" value="<?php echo $googleApiKey; ?>">
                </div>
                <div class="set-trns-api"><?php _e("Set", "wpdiscuz-translate") ?></div>
                <div class="valid-logo"></div>
            </div>
        </div>
        <!-- instruction-->
        <div class="google-instruction" style="border-bottom:1px solid #dddddd; padding-bottom:15px; margin-bottom:15px;">
            <p style="font-weight:bold; font-size:15px; padding-bottom:10px; padding-top:5px;"> <?php _e("Instruction to get", "wpdiscuz-translate"); ?> <span style="color:#637BF7;">G</span><span style="color:#EC4D3B;">o</span><span style="color:#FAC009;">o</span><span style="color:#637BF7;">g</span><span style="color:#68AA50;">l</span><span style="color:#EC4D3B;">e</span>.Translate <?php _e("API key:", "wpdiscuz-translate"); ?></p>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 1", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/1.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/1.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;"><a href="https://accounts.google.com/Login" target="_blank">Login</a> or <a href="https://accounts.google.com/SignUp" target="_blank">create Google account &raquo;</a></p>
            </div>
            <div style="width:28%; display:inline-block; vertical-align: top;">
                <p style="font-size:16px; text-align:center;"><?php _e("Step 2", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/2.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/2.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;"><a href="https://console.cloud.google.com/iam-admin/projects" target="_blank">Go to the Projects page &raquo;</a></p>
            </div>
            <div style="width:28%; display:inline-block;  vertical-align: top;">
                <p style="font-size:16px; text-align:center;"><?php _e("Step 3", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/3.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/3.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;">Create a Cloud Platform project</p>
            </div>
            <p>&nbsp;</p>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 4", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/4.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/4.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;"><a href="https://console.cloud.google.com/billing" target="_blank">Enable billing for your project</a></p>
            </div>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 5", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/5.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/5.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;">Register billing account</p>
            </div>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 6", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/6.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/6.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;"><a href="https://console.cloud.google.com/apis/credentials" target="_blank">Create API Key on Credentials</a></p>
            </div>

            <p>&nbsp;</p>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 7", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/7.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/7.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;">Select Browser key when prompted</p>
            </div>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 8", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/8.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/8.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;">Insert API Name and Web Site</p>
            </div>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 9", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/google/9.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/google/9.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;">Get API key</p>
            </div>

        </div>
    </div>

    <!-- yandex API-->
    <div class="yandex-api" style="display: none;">
        <h2 class="api-key-title" id="title-yandex"><span style="color:#FF0000;">Y</span>andex.Translate</h2>
        <div class="yan-tr-cont" style="display:table; width:100%; margin:0px auto 0px auto; padding:10px;">
            <div style="display:table-cell; font-size:16px; white-space:nowrap; width:10%;  padding-top: 4px; vertical-align: top;"><?php _e("API key: ", "wpdiscuz-translate"); ?></div>
            <div style="display:flex; vertical-align:bottom;">
                <div class="input-container">
                    <input type="text" class="set-api yandex-api-input" value="<?php echo $yandexApiKey; ?>">
                </div>
                <div class="set-trns-api"><?php _e("Set", "wpdiscuz-translate") ?></div>

                <div class="valid-logo"></div>
            </div>
        </div>
        <!-- instruction-->
        <div class="yan-instruction" style="border-bottom:1px solid #dddddd; padding-bottom:15px; margin-bottom:15px;">
            <p style="font-weight:bold; font-size:15px; padding-bottom:10px; padding-top:5px;">  <?php _e("Instruction to get", "wpdiscuz-translate"); ?> <span style="color:#FF0000;">Y</span>andex.Translate <?php _e("API key:", "wpdiscuz-translate"); ?></p>
            <div style="width:28%; display:inline-block;">
                <p style="font-size:16px; text-align:center;  vertical-align: top;"><?php _e("Step 1", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/yandex/step-1.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/yandex/step-1.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;"><a href="https://tech.yandex.com/keys/get/?service=trnsl" target="_blank">Login or create Yandex account &raquo;</a></p>
            </div>
            <div style="width:28%; display:inline-block; vertical-align: top;">
                <p style="font-size:16px; text-align:center;"><?php _e("Step 2", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/yandex/step-2.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/yandex/step-2.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;"><a href="https://tech.yandex.com/keys/get/?service=trnsl" target="_blank">API Key generation form</a></p>
            </div>
            <div style="width:28%; display:inline-block;  vertical-align: top;">
                <p style="font-size:16px; text-align:center;"><?php _e("Step 3", "wpdiscuz-translate") ?></p>
                <p style="text-align:center;"><a href="<?php echo plugins_url("../assets/images/yandex/step-3.png", __FILE__) ?>" target="_blank"><img src="<?php echo plugins_url("../assets/images/yandex/step-3.png", __FILE__) ?>" style="height:100px;padding:2px; border:2px solid #dddddd;"></a></p>
                <p style="text-align:center;">Get API key</p>
            </div>
        </div>
    </div>
</div>

<div class="wpd-subtitle">
    <?php _e("Background and Colors", "wpdiscuz-translate") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="trns_form_bg_color">
    <div class="wpd-opt-name">
        <label for="trns_form_bg_color"><?php echo $setting["options"]["trns_form_bg_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["trns_form_bg_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->bgColor; ?>" id="trns_form_bg_color" name="<?php echo $setting["values"]->tabKey; ?>[trns_form_bg_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->bgColor; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="trns_form_border_color">
    <div class="wpd-opt-name">
        <label for="trns_form_border_color"><?php echo $setting["options"]["trns_form_border_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["trns_form_border_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->borderColor; ?>" id="trns_form_border_color" name="<?php echo $setting["values"]->tabKey; ?>[trns_form_border_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->borderColor; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="trns_text_bottom_line_color">
    <div class="wpd-opt-name">
        <label for="trns_text_bottom_line_color"><?php echo $setting["options"]["trns_text_bottom_line_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["trns_text_bottom_line_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->lineColor; ?>" id="trns_text_bottom_line_color" name="<?php echo $setting["values"]->tabKey; ?>[trns_text_bottom_line_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->lineColor; ?>"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Front-end Phrases", "wpdiscuz-translate") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_translate">
    <div class="wpd-opt-name">
        <label for="tr_translate"><?php echo $setting["options"]["tr_translate"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_translate"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_translate]" value="<?php echo wpd_trns_phrases("Translate"); ?>" id="tr_translate" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_show_all">
    <div class="wpd-opt-name">
        <label for="tr_show_all"><?php echo $setting["options"]["tr_show_all"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_show_all"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_show_all]" value="<?php echo wpd_trns_phrases("Show all"); ?>" id="tr_show_all" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_show_all_languages">
    <div class="wpd-opt-name">
        <label for="tr_show_all_languages"><?php echo $setting["options"]["tr_show_all_languages"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_show_all_languages"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_show_all_languages]" value="<?php echo wpd_trns_phrases("Show all languages"); ?>" id="tr_show_all_languages" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_original">
    <div class="wpd-opt-name">
        <label for="tr_original"><?php echo $setting["options"]["tr_original"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_original"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_original]" value="<?php echo wpd_trns_phrases("Original"); ?>" id="tr_original" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_translate_into">
    <div class="wpd-opt-name">
        <label for="tr_translate_into"><?php echo $setting["options"]["tr_translate_into"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_translate_into"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_translate_into]" value="<?php echo wpd_trns_phrases("Translate into"); ?>" id="tr_translate_into" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_cant_translate">
    <div class="wpd-opt-name">
        <label for="tr_cant_translate"><?php echo $setting["options"]["tr_cant_translate"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_cant_translate"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_cant_translate]" value="<?php echo wpd_trns_phrases("Can't translate"); ?>" id="tr_cant_translate" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_cant_translate_the_comment">
    <div class="wpd-opt-name">
        <label for="tr_cant_translate_the_comment"><?php echo $setting["options"]["tr_cant_translate_the_comment"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_cant_translate_the_comment"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_cant_translate_the_comment]" value="<?php echo wpd_trns_phrases("Can't translate this comment"); ?>" id="tr_cant_translate_the_comment" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="tr_the_original_comment_in">
    <div class="wpd-opt-name">
        <label for="tr_the_original_comment_in"><?php echo $setting["options"]["tr_the_original_comment_in"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["tr_the_original_comment_in"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[tr_the_original_comment_in]" value="<?php echo wpd_trns_phrases("The original comment in"); ?>" id="tr_the_original_comment_in" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Maintenance", "wpdiscuz") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="empty_database">
    <div class="wpd-opt-name">
        <label for="empty_database"><?php echo $setting["options"]["empty_database"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["empty_database"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <a style="float: left;text-decoration:none;" class="button button-secondary" href="<?php echo admin_url(); ?>admin.php?page=<?php echo WpdiscuzCore::PAGE_SETTINGS; ?>&wpd_tab=<?php echo $setting["values"]->tabKey; ?>&trns_options=empty_database&_trns_nonce=<?php echo wp_create_nonce("trns-nonce"); ?>"><?php _e("Remove All Translated Comments", "wpdiscuz-translate"); ?></a> 
    </div>
</div>
<!-- Option end -->