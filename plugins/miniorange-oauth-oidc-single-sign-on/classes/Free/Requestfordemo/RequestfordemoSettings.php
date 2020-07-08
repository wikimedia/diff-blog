<?php


namespace MoOauthClient\Free;

use MoOauthClient\Customer;
class RequestfordemoSettings
{
    public function save_requestdemo_settings()
    {
        global $NQ;
        if (!(isset($_POST["\155\x6f\x5f\x6f\141\165\164\x68\137\x61\160\160\137\x72\x65\161\x75\x65\163\164\144\x65\155\x6f\x5f\156\x6f\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\157\x61\x75\x74\150\137\141\x70\x70\137\162\145\161\x75\145\163\164\144\145\x6d\157\137\156\x6f\156\x63\x65"])), "\x6d\157\137\157\x61\165\x74\x68\137\141\x70\160\x5f\x72\145\x71\x75\x65\163\164\x64\145\155\157") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\157\x61\165\x74\150\x5f\141\x70\x70\137\162\145\x71\165\x65\x73\x74\x64\x65\155\x6f" === $_POST[\MoOAuthConstants::OPTION])) {
            goto nP;
        }
        $yY = $_POST["\x6d\157\137\x6f\141\x75\x74\x68\x5f\x63\154\x69\145\x6e\164\137\144\x65\x6d\157\x5f\145\x6d\x61\x69\x6c"];
        $rL = $_POST["\x6d\x6f\x5f\x6f\141\165\x74\x68\x5f\x63\x6c\151\x65\156\164\x5f\144\x65\155\x6f\x5f\160\154\141\156"];
        $p7 = $_POST["\x6d\157\x5f\x6f\141\165\x74\150\x5f\x63\x6c\x69\x65\156\164\x5f\144\145\x6d\157\x5f\144\145\x73\143\162\x69\160\164\x69\x6f\x6e"];
        $Aa = new Customer();
        if ($NQ->mo_oauth_check_empty_or_null($yY) || $NQ->mo_oauth_check_empty_or_null($rL)) {
            goto GS;
        }
        $pb = json_decode($Aa->mo_oauth_send_demo_alert($yY, $rL, $p7, "\127\120\x20\117\101\x75\x74\150\40\123\x69\x6e\147\154\145\40\123\151\x67\156\40\117\x6e\40\104\x65\155\x6f\x20\122\145\161\x75\145\163\x74\x20\x2d\40" . $yY), true);
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\150\x61\156\x6b\163\x20\146\157\162\x20\x67\x65\164\x74\151\x6e\147\40\x69\156\x20\x74\x6f\165\143\x68\41\40\x57\x65\x20\163\150\x61\x6c\x6c\40\147\145\x74\x20\x62\x61\x63\153\x20\x74\157\40\171\157\165\40\x73\x68\157\162\164\154\x79\56");
        $NQ->mo_oauth_show_success_message();
        goto VU;
        GS:
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\154\145\x61\x73\x65\x20\x66\x69\154\154\40\165\160\x20\x45\x6d\141\151\154\x20\146\x69\x65\154\144\x20\164\x6f\40\163\x75\x62\155\x69\164\40\171\x6f\x75\x72\x20\x71\165\145\162\x79\x2e");
        $NQ->mo_oauth_show_success_message();
        VU:
        nP:
    }
}
