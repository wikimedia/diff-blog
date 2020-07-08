<?php


namespace MoOauthClient\Free;

use MoOauthClient\Settings;
use MoOauthClient\Free\CustomizationSettings;
use MoOauthClient\Free\RequestfordemoSettings;
use MoOauthClient\Free\AppSettings;
use MoOauthClient\Customer;
class FreeSettings
{
    private $common_settings;
    public function __construct()
    {
        $this->common_settings = new Settings();
        add_action("\141\x64\155\x69\x6e\137\151\156\151\164", array($this, "\x6d\x6f\137\157\x61\165\164\x68\137\x63\x6c\x69\x65\156\x74\137\x66\x72\x65\145\x5f\x73\x65\x74\x74\x69\x6e\x67\163"));
        add_action("\x61\x64\x6d\151\x6e\137\146\x6f\157\x74\x65\162", array($this, "\155\x6f\x5f\x6f\x61\x75\164\x68\137\143\154\x69\x65\x6e\x74\137\x66\145\x65\144\x62\x61\x63\153\137\x72\x65\161\165\x65\x73\164"));
    }
    public function mo_oauth_client_free_settings()
    {
        global $NQ;
        $MH = new CustomizationSettings();
        $BN = new RequestfordemoSettings();
        $MH->save_customization_settings();
        $BN->save_requestdemo_settings();
        $Mj = new AppSettings();
        $Mj->save_app_settings();
        if (!(isset($_POST["\x6d\157\x5f\157\141\x75\164\150\137\x63\x6c\151\145\156\x74\x5f\146\145\x65\144\142\x61\x63\x6b\x5f\156\x6f\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\x6f\141\x75\x74\x68\x5f\143\154\151\145\x6e\x74\137\146\145\x65\144\142\141\x63\153\137\x6e\x6f\156\143\145"])), "\x6d\x6f\137\x6f\x61\165\164\x68\x5f\143\154\x69\x65\156\164\x5f\x66\x65\145\x64\x62\141\143\153") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\157\141\x75\x74\x68\137\143\x6c\x69\145\x6e\x74\x5f\146\145\x65\144\x62\141\x63\153" === $_POST[\MoOAuthConstants::OPTION])) {
            goto lp;
        }
        $user = wp_get_current_user();
        $n6 = "\x50\154\165\147\x69\156\x20\104\x65\141\143\x74\x69\x76\x61\x74\145\144\x3a";
        $p0 = isset($_POST["\x64\x65\x61\143\x74\x69\166\x61\164\145\137\x72\x65\141\x73\x6f\156\x5f\x72\x61\x64\151\157"]) ? sanitize_text_field(wp_unslash($_POST["\144\145\141\143\x74\151\166\x61\x74\x65\x5f\x72\145\x61\x73\x6f\156\137\162\141\x64\x69\x6f"])) : false;
        $qa = isset($_POST["\x71\165\145\162\x79\137\x66\145\x65\x64\x62\x61\143\153"]) ? sanitize_text_field(wp_unslash($_POST["\161\x75\145\x72\171\x5f\146\x65\x65\144\x62\141\x63\153"])) : false;
        if ($p0) {
            goto yV;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\154\145\x61\x73\145\x20\123\x65\x6c\x65\143\x74\40\x6f\156\x65\x20\157\146\40\164\x68\x65\x20\162\x65\141\163\x6f\x6e\163\40\x2c\x69\x66\40\x79\157\165\162\x20\x72\x65\x61\x73\x6f\156\40\x69\163\x20\x6e\x6f\164\x20\155\145\156\164\151\x6f\156\x65\144\x20\x70\x6c\145\x61\x73\145\40\163\x65\x6c\145\143\x74\40\117\x74\x68\145\162\x20\122\145\141\163\x6f\156\x73");
        $NQ->mo_oauth_show_error_message();
        yV:
        $n6 .= $p0;
        if (!isset($qa)) {
            goto v8;
        }
        $n6 .= "\72" . $qa;
        v8:
        $yY = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\164\x68\x5f\x61\144\x6d\151\x6e\137\145\x6d\141\x69\154");
        if (!($yY == '')) {
            goto Yy;
        }
        $yY = $user->user_email;
        Yy:
        $d1 = $NQ->mo_oauth_client_get_option("\x6d\x6f\137\157\x61\165\164\x68\x5f\x61\x64\155\151\x6e\137\160\150\x6f\x6e\145");
        $Fa = new Customer();
        $pb = json_decode($Fa->mo_oauth_send_email_alert($yY, $d1, $n6), true);
        deactivate_plugins(MOC_DIR . "\155\157\137\157\x61\x75\164\x68\x5f\163\145\x74\x74\x69\156\147\163\x2e\x70\x68\x70");
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\x68\141\156\x6b\40\x79\157\x75\40\x66\157\x72\x20\164\150\x65\x20\146\145\145\144\x62\x61\x63\x6b\x2e");
        $NQ->mo_oauth_show_success_message();
        lp:
        if (!(isset($_POST["\x6d\157\137\157\x61\165\164\150\x5f\143\x6c\151\x65\156\164\x5f\163\153\151\x70\137\x66\145\x65\144\x62\x61\143\153\137\156\x6f\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\x6f\x61\x75\164\x68\x5f\143\x6c\x69\145\156\164\137\163\x6b\151\160\x5f\146\145\x65\144\x62\141\x63\x6b\x5f\156\x6f\156\143\x65"])), "\155\x6f\x5f\157\x61\165\x74\150\x5f\143\x6c\151\145\x6e\x74\x5f\163\x6b\151\160\x5f\146\145\x65\x64\x62\141\143\x6b") && isset($_POST["\157\x70\x74\x69\157\156"]) && "\155\x6f\x5f\157\x61\165\164\150\x5f\x63\154\151\145\x6e\164\137\163\153\x69\x70\137\x66\x65\145\x64\142\141\x63\153" === $_POST["\157\x70\164\x69\x6f\156"])) {
            goto J9;
        }
        deactivate_plugins(MOC_DIR . "\155\x6f\137\x6f\141\x75\x74\150\137\163\145\164\x74\x69\156\147\x73\56\x70\150\160");
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x50\154\165\147\151\x6e\40\x44\x65\x61\x63\164\151\x76\141\x74\145\144\56");
        $NQ->mo_oauth_show_success_message();
        J9:
    }
    public function mo_oauth_client_feedback_request()
    {
        $SU = new \MoOauthClient\Free\Feedback();
        $SU->show_form();
    }
}
