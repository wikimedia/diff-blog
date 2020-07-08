<?php


namespace MoOauthClient\Free;

class CustomizationSettings
{
    public function save_customization_settings()
    {
        global $NQ;
        if (!(isset($_POST["\x6d\157\137\x6f\x61\165\x74\x68\137\x61\160\160\x5f\x63\165\163\164\157\x6d\151\x7a\x61\x74\x69\x6f\x6e\137\x6e\157\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\x6f\x61\x75\164\x68\137\141\x70\160\x5f\x63\x75\163\164\x6f\155\151\x7a\141\164\151\157\x6e\137\156\157\x6e\143\x65"])), "\x6d\157\137\x6f\x61\x75\x74\x68\x5f\x61\160\x70\137\x63\x75\x73\x74\x6f\x6d\x69\172\x61\164\151\x6f\x6e") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\x5f\x6f\x61\165\164\150\x5f\x61\x70\x70\137\143\x75\163\x74\157\155\x69\172\x61\x74\151\x6f\156" === $_POST[\MoOAuthConstants::OPTION])) {
            goto u0;
        }
        $NQ->mo_oauth_client_update_option("\x6d\x6f\x5f\157\141\165\164\x68\137\151\143\x6f\156\137\x77\x69\144\x74\150", stripslashes($_POST["\155\x6f\137\x6f\141\165\x74\150\x5f\151\x63\157\x6e\137\167\151\144\x74\x68"]));
        $NQ->mo_oauth_client_update_option("\x6d\x6f\137\157\141\165\164\x68\x5f\151\143\157\x6e\137\150\145\151\x67\150\x74", stripslashes($_POST["\x6d\x6f\x5f\x6f\141\x75\x74\x68\137\151\143\157\156\137\x68\145\x69\147\x68\164"]));
        $NQ->mo_oauth_client_update_option("\x6d\157\137\157\141\165\x74\x68\137\x69\143\x6f\156\137\155\x61\162\147\151\156", stripslashes($_POST["\155\x6f\137\x6f\141\x75\164\150\137\151\x63\157\x6e\x5f\155\x61\162\147\151\156"]));
        $NQ->mo_oauth_client_update_option("\x6d\157\x5f\x6f\141\x75\164\150\x5f\151\x63\x6f\x6e\x5f\x63\x6f\156\146\x69\x67\165\x72\x65\137\143\x73\163", stripcslashes(stripslashes($_POST["\x6d\157\x5f\157\x61\165\164\x68\137\151\143\157\156\137\x63\x6f\156\146\x69\x67\165\x72\x65\137\143\163\163"])));
        $NQ->mo_oauth_client_update_option("\155\157\x5f\157\141\165\x74\x68\137\x63\165\163\164\x6f\155\x5f\154\x6f\147\157\x75\x74\137\164\145\x78\164", stripslashes($_POST["\x6d\157\137\x6f\141\165\164\x68\x5f\143\165\163\164\157\x6d\137\x6c\x6f\147\157\x75\164\137\x74\145\170\x74"]));
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\157\x75\162\40\x73\x65\164\164\151\156\147\163\40\167\x65\x72\x65\x20\163\x61\x76\145\144");
        $NQ->mo_oauth_show_success_message();
        u0:
    }
}
?>
