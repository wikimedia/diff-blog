<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Standard\StandardSettings;
use MoOauthClient\Premium\AppSettings;
use MoOauthClient\Premium\SignInSettingsSettings;
class PremiumSettings
{
    private $standard_settings;
    public function __construct()
    {
        $this->standard_settings = new StandardSettings();
        add_action("\141\x64\155\151\x6e\x5f\151\x6e\151\164", array($this, "\x6d\157\x5f\x6f\141\x75\164\x68\x5f\x63\154\151\x65\x6e\x74\137\x70\x72\145\x6d\151\x75\x6d\x5f\163\x65\x74\164\x69\x6e\x67\163"));
    }
    public function mo_oauth_client_premium_settings()
    {
        $w7 = new SignInSettingsSettings();
        $Mj = new AppSettings();
        $Mj->save_app_settings();
        $Mj->save_advanced_grant_settings();
        $w7->mo_oauth_save_settings();
    }
}
