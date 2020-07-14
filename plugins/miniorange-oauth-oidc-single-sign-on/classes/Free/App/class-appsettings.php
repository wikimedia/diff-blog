<?php


namespace MoOauthClient\Free;

use MoOauthClient\App;
class AppSettings
{
    private $app_config;
    public function __construct()
    {
        $this->app_config = array("\x63\x6c\x69\145\156\164\x5f\x69\x64", "\x63\x6c\x69\145\x6e\x74\137\x73\x65\x63\162\x65\164", "\x73\143\157\160\x65", "\162\145\144\151\162\145\143\164\x5f\165\162\x69", "\x61\160\x70\x5f\x74\171\x70\x65", "\x61\165\x74\150\157\x72\x69\x7a\x65\165\162\x6c", "\x61\x63\x63\x65\x73\x73\164\x6f\x6b\145\x6e\x75\162\x6c", "\162\x65\x73\x6f\x75\x72\143\x65\x6f\167\156\x65\162\144\145\164\141\x69\154\163\165\x72\x6c", "\x67\x72\x6f\x75\x70\x64\145\164\x61\151\x6c\163\x75\162\x6c", "\152\167\x6b\163\x5f\x75\162\151", "\x64\x69\x73\x70\x6c\x61\171\x61\160\160\x6e\x61\155\145", "\x61\160\x70\x49\x64");
    }
    public function save_app_settings()
    {
        global $NQ;
        if (!(isset($_POST["\x6d\x6f\137\157\x61\165\x74\x68\137\141\x64\x64\x5f\141\x70\x70\x5f\156\157\x6e\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\x6f\141\165\x74\150\137\x61\x64\144\x5f\x61\x70\x70\x5f\x6e\157\156\143\x65"])), "\155\157\137\157\141\x75\164\150\x5f\141\x64\144\x5f\141\x70\160") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\157\141\x75\x74\x68\137\x61\x64\x64\x5f\141\x70\x70" === $_POST[\MoOAuthConstants::OPTION])) {
            goto Mx;
        }
        if (!($NQ->mo_oauth_check_empty_or_null($_POST["\155\x6f\x5f\x6f\x61\x75\164\x68\x5f\143\154\151\x65\156\164\x5f\151\x64"]) || $NQ->mo_oauth_check_empty_or_null($_POST["\155\x6f\137\x6f\141\165\x74\150\137\143\154\x69\x65\156\x74\137\x73\145\x63\162\x65\164"]))) {
            goto sh;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\154\145\x61\163\145\x20\145\x6e\164\145\x72\x20\x76\141\154\x69\144\x20\103\x6c\151\145\156\x74\x20\x49\x44\x20\x61\156\x64\x20\103\154\x69\145\156\x74\40\x53\145\143\x72\145\164\x2e");
        $NQ->mo_oauth_show_error_message();
        return;
        sh:
        $K_ = isset($_POST["\155\x6f\x5f\x6f\141\x75\x74\x68\x5f\x63\x75\163\164\x6f\x6d\137\141\x70\x70\x5f\156\141\155\145"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\157\x61\x75\164\150\x5f\x63\165\x73\164\x6f\x6d\137\x61\x70\x70\137\156\x61\x6d\145"])) : false;
        $En = $NQ->get_app_by_name($K_);
        $En = false !== $En ? $En->get_app_config() : array();
        $J9 = false !== $En;
        $RL = $NQ->get_app_list();
        if (!(!$J9 && is_array($RL) && count($RL) > 0 && !$NQ->check_versi(3))) {
            goto yM;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\x75\40\143\141\156\x20\157\156\x6c\x79\40\141\x64\144\x20\x31\x20\x61\x70\160\x6c\151\143\141\x74\151\x6f\x6e\40\167\151\164\x68\40\146\162\145\145\x20\x76\145\162\163\x69\157\x6e\56\x20\x55\160\x67\162\141\144\145\x20\x74\x6f\40\x65\x6e\164\145\x72\x70\162\x69\x73\x65\40\166\145\162\x73\151\157\156\40\151\146\40\x79\157\165\40\167\141\x6e\x74\40\x74\157\x20\141\x64\144\40\155\x6f\162\145\40\141\x70\x70\154\151\x63\x61\x74\x69\x6f\156\x73\56");
        $NQ->mo_oauth_show_error_message();
        return;
        yM:
        $En = !is_array($En) || empty($En) ? array() : $En;
        $En = $this->change_app_settings($_POST, $En);
        $RL[$K_] = new App($En);
        $RL[$K_]->set_app_name($K_);
        $NQ->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\165\164\x68\x5f\141\x70\160\x73\x5f\x6c\x69\x73\x74", $RL);
        wp_redirect("\141\x64\155\151\x6e\x2e\160\x68\x70\x3f\x70\141\x67\145\75\155\x6f\x5f\x6f\x61\165\164\x68\x5f\163\x65\x74\x74\151\156\x67\163\x26\x74\x61\142\75\143\157\x6e\146\x69\x67\x26\x61\x63\x74\151\157\x6e\x3d\165\x70\144\x61\x74\x65\46\141\160\160\x3d" . urlencode($K_));
        Mx:
        if (!(isset($_POST["\x6d\157\x5f\x6f\x61\165\x74\x68\x5f\x61\x74\x74\x72\151\x62\x75\x74\x65\x5f\155\x61\160\160\x69\x6e\x67\x5f\156\x6f\156\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\157\141\x75\164\x68\137\x61\x74\164\x72\x69\142\x75\x74\145\x5f\x6d\141\160\x70\151\x6e\147\x5f\156\x6f\156\x63\x65"])), "\x6d\157\137\x6f\141\x75\164\150\x5f\x61\164\x74\162\151\142\165\164\145\137\155\x61\160\160\x69\156\147") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\157\141\x75\x74\150\x5f\141\x74\164\x72\x69\x62\165\164\145\137\x6d\141\x70\x70\x69\156\147" === $_POST[\MoOAuthConstants::OPTION])) {
            goto kw;
        }
        global $NQ;
        $K_ = sanitize_text_field(wp_unslash(isset($_POST[\MoOAuthConstants::POST_APP_NAME]) ? $_POST[\MoOAuthConstants::POST_APP_NAME] : ''));
        $X1 = $NQ->get_app_by_name($K_);
        $R_ = $X1->get_app_config();
        $R_ = $this->change_attribute_mapping($_POST, $R_);
        $YG = $NQ->set_app_by_name($K_, $R_);
        if (!$YG) {
            goto cV;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\165\x72\40\x73\145\164\x74\x69\156\x67\163\40\x61\x72\x65\x20\163\141\166\x65\144\40\x73\165\143\x63\x65\x73\x73\x66\165\154\154\171\56");
        $NQ->mo_oauth_show_success_message();
        goto vG;
        cV:
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\x68\145\x72\x65\40\167\x61\163\x20\x61\x6e\40\145\x72\x72\x6f\x72\40\x73\x61\166\x69\156\x67\40\163\x65\x74\164\x69\156\x67\x73\x2e");
        $NQ->mo_oauth_show_error_message();
        vG:
        wp_safe_redirect("\141\x64\x6d\x69\156\x2e\160\150\160\x3f\x70\x61\147\x65\x3d\x6d\157\137\157\141\165\x74\150\137\163\x65\x74\164\151\156\x67\x73\46\x74\x61\142\75\x63\157\156\146\x69\x67\x26\141\x63\164\x69\157\156\75\x75\160\144\141\164\145\x26\141\160\160\x3d" . rawurlencode($K_));
        kw:
        do_action("\x6d\x6f\137\x6f\x61\x75\x74\x68\x5f\143\x6c\x69\x65\156\164\x5f\163\141\166\145\137\x61\x70\160\137\x73\x65\164\164\151\156\147\163\x5f\151\x6e\x74\x65\162\x6e\x61\154");
    }
    public function change_app_settings($post, $En)
    {
        global $NQ;
        $K_ = sanitize_text_field(wp_unslash(isset($post[\MoOAuthConstants::POST_APP_NAME]) ? $post[\MoOAuthConstants::POST_APP_NAME] : ''));
        $En["\x73\x63\x6f\x70\145"] = sanitize_text_field(wp_unslash(isset($post["\x6d\157\137\x6f\141\165\164\150\x5f\x73\143\x6f\x70\x65"]) ? $post["\155\x6f\137\157\141\165\164\x68\137\163\x63\x6f\x70\x65"] : ''));
        $En["\143\154\x69\145\x6e\164\137\x69\x64"] = sanitize_text_field(wp_unslash(isset($post["\x6d\157\137\x6f\x61\165\x74\150\137\143\x6c\x69\145\156\164\x5f\x69\x64"]) ? $post["\155\x6f\137\157\x61\x75\x74\x68\137\143\x6c\151\x65\x6e\x74\x5f\x69\x64"] : ''));
        $En["\143\x6c\151\x65\x6e\x74\x5f\163\x65\143\162\x65\164"] = sanitize_text_field(wp_unslash(isset($post["\155\157\137\x6f\x61\165\x74\x68\x5f\143\x6c\151\145\156\164\x5f\163\x65\x63\162\x65\x74"]) ? $post["\x6d\x6f\x5f\157\141\x75\x74\150\x5f\x63\x6c\x69\x65\156\x74\137\x73\145\x63\162\145\x74"] : ''));
        $En["\163\145\156\144\x5f\150\x65\x61\144\x65\x72\x73"] = isset($post["\155\x6f\137\x6f\x61\165\x74\150\137\x61\165\x74\150\157\162\151\x7a\x61\x74\151\157\x6e\x5f\150\145\141\x64\145\x72"]) ? (int) filter_var($post["\155\x6f\137\x6f\141\x75\164\x68\x5f\141\x75\x74\x68\x6f\x72\151\172\x61\164\x69\x6f\156\x5f\x68\145\141\144\x65\162"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $En["\x73\145\x6e\x64\x5f\x62\x6f\x64\171"] = isset($post["\x6d\x6f\x5f\157\141\x75\x74\150\x5f\x62\157\144\x79"]) ? (int) filter_var($post["\x6d\x6f\137\157\141\165\164\x68\x5f\x62\x6f\144\x79"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $En["\x73\150\x6f\x77\137\x6f\x6e\137\154\x6f\x67\x69\156\x5f\x70\141\147\x65"] = isset($post["\x6d\157\137\x6f\141\165\164\x68\137\163\150\x6f\x77\137\157\x6e\x5f\x6c\x6f\x67\x69\156\137\x70\x61\147\145"]) ? (int) filter_var($post["\x6d\x6f\137\157\x61\165\x74\150\x5f\x73\x68\157\x77\137\x6f\156\x5f\x6c\157\x67\x69\x6e\x5f\160\141\147\145"], FILTER_SANITIZE_NUMBER_INT) : 0;
        $En["\x61\160\x70\111\144"] = $K_;
        $En["\162\145\x64\151\x72\x65\x63\164\x5f\x75\162\151"] = sanitize_text_field(wp_unslash(isset($post["\x6d\157\137\x75\160\144\141\164\145\x5f\x75\x72\x6c"]) ? $post["\155\x6f\137\x75\x70\x64\x61\x74\x65\x5f\x75\162\x6c"] : site_url()));
        $NQ->mo_oauth_client_update_option("\x6d\x6f\137\x6f\141\165\164\x68\x5f\x63\154\151\x65\x6e\x74\x5f\144\x69\163\141\x62\x6c\x65\137\x61\165\164\150\157\162\151\x7a\x61\x74\x69\x6f\156\x5f\150\x65\141\144\x65\162", isset($post["\144\151\x73\141\142\x6c\x65\137\141\x75\164\150\x6f\162\151\172\x61\x74\151\x6f\156\137\150\145\x61\x64\x65\x72"]) ? boolval($post["\x64\x69\x73\141\142\x6c\145\137\141\165\x74\x68\x6f\162\151\172\141\x74\151\x6f\x6e\x5f\150\x65\x61\x64\x65\x72"]) : false);
        if ("\145\x76\145\157\156\x6c\151\x6e\145" === $K_) {
            goto vY;
        }
        $Is = stripslashes($post["\155\x6f\x5f\x6f\x61\165\164\x68\x5f\x61\x75\x74\150\157\x72\x69\172\x65\x75\x72\154"]);
        $y9 = stripslashes($post["\155\157\137\x6f\x61\x75\x74\x68\137\141\x63\143\145\x73\163\164\157\x6b\x65\156\x75\x72\x6c"]);
        $K_ = stripslashes($post["\x6d\157\137\x6f\x61\165\x74\150\137\x63\x75\163\164\157\155\137\141\x70\160\137\x6e\141\x6d\145"]);
        goto jQ;
        vY:
        $NQ->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\165\x74\150\x5f\x65\x76\x65\157\x6e\x6c\x69\156\145\x5f\145\156\141\x62\154\x65", 1);
        $NQ->mo_oauth_client_update_option("\x6d\157\x5f\157\x61\165\x74\150\x5f\145\x76\x65\157\x6e\x6c\x69\x6e\145\137\143\154\x69\x65\156\164\137\151\144", $j2);
        $NQ->mo_oauth_client_update_option("\x6d\157\137\x6f\141\165\164\150\x5f\x65\x76\x65\x6f\x6e\154\x69\x6e\145\137\x63\154\x69\x65\156\164\137\x73\145\143\162\x65\164", $a4);
        if (!($NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\141\x75\164\x68\137\x65\x76\145\x6f\156\x6c\151\156\x65\x5f\143\x6c\x69\145\156\x74\x5f\x69\144") && $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\x75\164\150\137\x65\x76\145\157\156\x6c\x69\156\145\x5f\143\154\151\145\x6e\x74\137\x73\x65\x63\x72\x65\164"))) {
            goto aO;
        }
        $Aa = new Customer();
        $n6 = $Aa->add_oauth_application("\x65\166\145\157\156\154\151\156\145", "\x45\126\x45\x20\x4f\x6e\154\x69\x6e\145\x20\117\101\165\164\x68");
        if ("\x41\160\160\154\x69\143\141\x74\151\157\156\x20\103\162\x65\x61\x74\x65\144" === $n6) {
            goto sd;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $n6);
        $this->mo_oauth_show_error_message();
        goto HN;
        sd:
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\165\x72\x20\x73\145\x74\x74\151\156\x67\163\40\167\145\x72\x65\40\163\141\166\x65\144\56\40\107\x6f\40\164\157\x20\101\144\166\x61\x6e\143\145\144\40\105\126\105\x20\117\x6e\x6c\x69\156\145\x20\123\145\x74\164\x69\156\147\x73\40\x66\x6f\162\40\143\157\x6e\x66\151\x67\x75\x72\x69\156\x67\x20\x72\x65\163\x74\x72\x69\143\164\x69\157\x6e\163\x20\x6f\156\x20\x75\x73\x65\x72\40\x73\151\147\156\40\151\x6e\56");
        $this->mo_oauth_show_success_message();
        HN:
        aO:
        $Is = '';
        $y9 = '';
        $pl = '';
        jQ:
        $En["\x61\x75\x74\150\157\162\151\x7a\145\x75\x72\154"] = $Is;
        $En["\x61\143\143\x65\x73\163\x74\x6f\x6b\x65\x6e\x75\x72\x6c"] = $y9;
        $En["\141\160\x70\x5f\x74\171\x70\145"] = isset($post["\155\157\x5f\157\141\165\x74\150\137\x61\160\160\x5f\164\171\160\x65"]) ? stripslashes($post["\x6d\157\137\157\141\165\164\x68\x5f\141\160\x70\x5f\x74\x79\x70\145"]) : stripslashes("\157\141\x75\164\x68");
        if (!($En["\141\x70\x70\137\164\171\x70\x65"] == "\x6f\x61\x75\164\x68" || isset($post["\155\x6f\x5f\x6f\141\x75\x74\x68\x5f\162\145\163\157\x75\162\143\145\157\167\156\145\162\x64\x65\164\141\151\154\x73\x75\162\x6c"]) && '' !== $post["\155\157\137\x6f\141\x75\164\150\x5f\162\145\x73\157\x75\x72\x63\145\x6f\x77\156\x65\x72\144\145\164\x61\x69\x6c\163\165\162\x6c"])) {
            goto A2;
        }
        $pl = stripslashes($post["\x6d\x6f\137\157\x61\165\164\x68\x5f\x72\x65\x73\x6f\x75\162\x63\x65\157\x77\156\145\x72\144\145\x74\x61\x69\x6c\x73\165\162\x6c"]);
        $En["\162\x65\163\x6f\x75\x72\143\145\x6f\167\156\x65\162\144\x65\x74\x61\151\x6c\x73\165\x72\154"] = $pl;
        A2:
        return $En;
    }
    public function change_attribute_mapping($post, $En)
    {
        $Ys = stripslashes($post["\155\x6f\x5f\157\141\165\x74\150\137\x75\x73\145\x72\x6e\141\x6d\145\x5f\141\x74\164\162"]);
        $En["\165\163\x65\x72\x6e\x61\155\x65\137\141\x74\164\162"] = $Ys;
        return $En;
    }
}
