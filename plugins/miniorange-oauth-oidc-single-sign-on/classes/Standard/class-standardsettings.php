<?php


namespace MoOauthClient\Standard;

use MoOauthClient\Free\FreeSettings;
use MoOauthClient\Free\CustomizationSettings;
use MoOauthClient\Standard\AppSettings;
use MoOauthClient\Standard\SignInSettingsSettings;
use MoOauthClient\Standard\Customer;
class StandardSettings
{
    private $free_settings;
    public function __construct()
    {
        $this->free_settings = new FreeSettings();
        add_action("\x61\144\155\x69\156\137\x69\x6e\x69\x74", array($this, "\x6d\x6f\137\157\141\x75\164\150\137\143\154\x69\x65\156\x74\x5f\163\x74\141\x6e\144\141\162\x64\x5f\x73\x65\x74\164\151\x6e\x67\163"));
        add_action("\x64\157\x5f\x6d\141\x69\x6e\137\163\145\x74\164\151\156\147\x73\x5f\151\x6e\164\145\162\156\x61\154", array($this, "\x64\x6f\x5f\x69\x6e\x74\x65\x72\156\141\154\x5f\x73\145\164\x74\151\156\x67\x73"), 1, 10);
    }
    public function mo_oauth_client_standard_settings()
    {
        $MH = new CustomizationSettings();
        $w7 = new SignInSettingsSettings();
        $Mj = new AppSettings();
        $MH->save_customization_settings();
        $Mj->save_app_settings();
        $w7->mo_oauth_save_settings();
    }
    public function do_internal_settings($post)
    {
        global $NQ;
        if (!(isset($_POST["\155\x6f\137\157\x61\x75\164\150\137\x63\154\151\x65\x6e\x74\137\166\145\x72\151\146\x79\137\154\x69\x63\145\156\x73\x65\x5f\156\157\156\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\157\141\x75\x74\x68\137\x63\x6c\x69\x65\156\x74\137\x76\x65\x72\x69\146\171\137\x6c\x69\143\x65\x6e\x73\x65\137\156\x6f\x6e\x63\x65"])), "\x6d\x6f\x5f\157\x61\165\164\150\x5f\x63\x6c\x69\145\156\x74\137\166\x65\162\x69\x66\171\x5f\x6c\151\x63\145\x6e\163\145") && isset($post[\MoOAuthConstants::OPTION]) && "\155\x6f\137\x6f\141\x75\x74\150\137\x63\x6c\x69\145\156\164\x5f\x76\x65\162\x69\x66\x79\137\x6c\x69\143\145\x6e\x73\145" === $post[\MoOAuthConstants::OPTION])) {
            goto iXS;
        }
        if (!(!isset($post["\x6d\157\137\x6f\141\165\x74\150\x5f\143\154\x69\145\156\x74\137\x6c\151\143\145\156\163\145\x5f\153\x65\171"]) || empty($post["\155\157\137\157\141\165\164\x68\137\x63\154\x69\x65\x6e\164\x5f\x6c\x69\143\x65\156\163\x65\x5f\153\145\x79"]))) {
            goto ofs;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\x6c\145\141\163\145\x20\x65\x6e\164\x65\x72\x20\x76\141\x6c\151\144\40\154\151\143\145\x6e\163\x65\x20\153\145\171\56");
        $this->mo_oauth_show_error_message();
        return;
        ofs:
        $cu = trim($post["\x6d\157\137\157\141\165\x74\x68\137\143\154\x69\145\156\164\137\x6c\x69\143\145\x6e\x73\x65\137\153\145\171"]);
        $Aa = new Customer();
        $mg = json_decode($Aa->check_customer_ln(), true);
        $zF = false;
        if (!(isset($mg["\x69\x73\x4d\x75\x6c\164\x69\123\151\164\x65\120\154\x75\x67\x69\156\122\145\x71\x75\x65\163\x74\145\144"]) && boolval($mg["\151\163\115\165\154\164\151\123\151\164\145\x50\x6c\165\147\x69\x6e\x52\145\161\165\145\x73\x74\145\x64"]) && is_multisite())) {
            goto R3F;
        }
        $zF = boolval($mg["\151\x73\115\165\154\x74\151\x53\x69\164\145\x50\154\x75\147\151\x6e\122\x65\x71\165\x65\163\x74\145\144"]);
        $NQ->mo_oauth_client_update_option("\155\x6f\137\157\x61\165\x74\x68\137\x69\x73\x4d\165\154\164\151\x53\x69\x74\x65\120\x6c\165\x67\151\156\x52\145\161\x75\x65\163\164\x65\144", $zF);
        $NQ->mo_oauth_client_update_option("\156\x6f\x4f\x66\x53\x75\142\x53\151\x74\145\163", intval($mg["\156\x6f\117\146\123\165\x62\123\151\x74\145\x73"]));
        R3F:
        $cH = 0;
        if (!is_multisite()) {
            goto ixh;
        }
        if (!function_exists("\x67\145\164\137\x73\x69\164\x65\163")) {
            goto dra;
        }
        $cH = count(get_sites());
        dra:
        ixh:
        if (!(is_multisite() && !$zF || $zF && (!array_key_exists("\x6e\x6f\x4f\146\x53\x75\x62\x53\x69\x74\145\x73", $mg) || $cH > intval($mg["\x6e\x6f\117\x66\x53\x75\x62\123\151\164\x65\163"])))) {
            goto GAW;
        }
        $Ae = get_site_option("\150\157\163\164\137\156\141\155\145");
        $Ae .= "\x2f\155\157\x61\163\57\x6c\x6f\x67\151\x6e\x3f\x72\145\x64\151\162\x65\143\x74\125\162\x6c\x3d";
        $Ae .= get_site_option("\150\x6f\163\164\x5f\156\x61\x6d\x65");
        $Ae .= "\x2f\x6d\157\x61\163\x2f\151\x6e\151\x74\x69\141\x6c\x69\x7a\x65\160\141\x79\155\145\156\164\77\x72\x65\x71\x75\145\163\164\117\x72\x69\x67\151\x6e\x3d";
        $Ae .= "\167\160\x5f\x6f\141\165\x74\150\x5f\x63\154\x69\145\x6e\x74\137" . strtolower($NQ->get_versi_str()) . "\x5f\x70\x6c\141\x6e";
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\x75\x20\150\x61\166\145\x20\156\157\x74\x20\x75\x70\x67\x72\141\144\145\144\40\164\157\x20\x74\150\145\40\143\x6f\162\x72\145\x63\x74\40\x6c\x69\143\145\156\x73\x65\x20\x70\154\x61\x6e\56\x20\105\x69\164\150\145\x72\x20\171\x6f\x75\40\150\x61\x76\145\40\160\165\x72\x63\x68\141\x73\145\144\x20\x66\157\162\x20\x69\x6e\x63\x6f\162\x72\145\143\x74\x20\x6e\157\x2e\40\157\146\40\x73\x69\164\145\163\x20\x6f\162\x20\x79\157\165\x20\150\x61\x76\145\40\x6e\x6f\164\40\x73\145\x6c\x65\x63\x74\145\x64\40\x6d\x75\x6c\164\x69\163\151\x74\x65\40\157\x70\164\151\157\x6e\40\167\150\x69\154\145\x20\160\165\162\143\150\141\163\151\x6e\147\x2e\40\74\141\40\164\141\x72\x67\x65\x74\75\x22\137\x62\154\141\156\153\x22\40\x68\x72\145\x66\x3d\x22" . $Ae . "\x22\x20\76\103\x6c\x69\143\153\x20\150\145\162\x65\74\x2f\141\76\x20\164\157\40\x75\x70\x67\x72\141\x64\145\x20\164\x6f\40\160\162\145\155\151\x75\x6d\x20\x76\x65\x72\x73\x69\157\156\x2e");
        $NQ->mo_oauth_show_error_message();
        return;
        GAW:
        if (strcasecmp($mg["\163\x74\x61\x74\x75\x73"], "\123\x55\x43\103\105\x53\x53") === 0) {
            goto c3F;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\111\156\x76\x61\x6c\x69\144\40\x6c\151\x63\145\x6e\163\x65\56\x20\120\x6c\x65\141\163\145\x20\x74\162\x79\40\141\x67\141\151\156\x2e");
        $NQ->mo_oauth_show_error_message();
        goto B6E;
        c3F:
        $mg = json_decode($Aa->XfskodsfhHJ($cu), true);
        if (strcasecmp($mg["\163\164\141\x74\165\x73"], "\x53\125\x43\103\x45\x53\123") === 0) {
            goto pqb;
        }
        if (strcasecmp($mg["\x73\164\141\164\165\163"], "\x46\x41\111\x4c\105\104") === 0) {
            goto CFe;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x41\156\x20\145\162\x72\157\162\40\x6f\143\143\165\x72\x65\x64\x20\167\x68\151\x6c\145\40\160\x72\157\143\145\x73\163\151\156\147\40\171\x6f\165\162\x20\x72\145\161\165\x65\x73\164\56\40\120\154\x65\141\163\x65\40\124\162\171\40\x61\147\141\x69\156\56");
        $NQ->mo_oauth_show_error_message();
        goto Gl3;
        pqb:
        $NQ->mo_oauth_client_update_option("\x6d\x6f\137\x6f\x61\x75\164\150\x5f\x6c\153", $NQ->mooauthencrypt($cu));
        $NQ->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\x75\164\150\x5f\154\166", $NQ->mooauthencrypt("\164\162\x75\x65"));
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\x6f\x75\x72\40\154\x69\x63\145\x6e\163\x65\40\151\163\40\x76\x65\162\x69\146\151\145\x64\x2e\x20\x59\157\165\x20\143\141\156\40\x6e\x6f\167\40\x73\145\164\x75\x70\40\x74\x68\x65\40\x70\154\x75\x67\x69\156\x2e");
        $NQ->mo_oauth_show_success_message();
        goto Gl3;
        CFe:
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\x75\40\150\x61\166\145\x20\145\156\164\x65\x72\145\x64\x20\x61\156\40\151\x6e\166\141\154\151\144\40\154\151\x63\145\x6e\163\x65\40\153\x65\171\x2e\40\x50\x6c\x65\x61\163\145\x20\145\156\x74\145\x72\x20\x61\40\x76\x61\x6c\151\x64\x20\154\x69\x63\145\156\x73\x65\x20\153\x65\171\x2e");
        $NQ->mo_oauth_show_error_message();
        Gl3:
        B6E:
        iXS:
    }
}
