<?php


namespace MoOauthClient\Premium;

use MoOauthClient\App;
use MoOauthClient\Standard\AppSettings as StandardAppSettings;
class AppSettings extends StandardAppSettings
{
    public function __construct()
    {
        parent::__construct();
        add_action("\x6d\157\137\157\x61\165\x74\x68\x5f\x63\x6c\151\145\156\164\137\163\141\x76\145\x5f\x61\x70\160\137\x73\x65\x74\164\151\x6e\147\x73\x5f\151\156\164\145\162\156\x61\x6c", array($this, "\163\x61\x76\x65\137\x72\157\154\145\x5f\155\x61\x70\160\151\156\147"));
    }
    public function change_app_settings($post, $En)
    {
        global $NQ;
        $En = parent::change_app_settings($post, $En);
        $En["\147\162\157\x75\x70\144\x65\x74\x61\x69\x6c\163\x75\162\x6c"] = isset($post["\x6d\x6f\x5f\x6f\141\165\x74\150\137\x67\162\x6f\x75\x70\144\145\164\x61\x69\x6c\163\165\162\x6c"]) ? trim(stripslashes($post["\155\x6f\x5f\x6f\141\x75\x74\x68\x5f\147\162\x6f\x75\160\x64\x65\164\141\151\x6c\163\165\x72\x6c"])) : '';
        $En["\152\x77\153\163\165\162\154"] = isset($post["\155\x6f\137\157\141\165\x74\x68\137\152\x77\x6b\163\x75\x72\x6c"]) ? trim(stripslashes($post["\155\157\x5f\157\x61\x75\x74\x68\137\152\167\x6b\163\x75\162\154"])) : '';
        $En["\147\x72\141\x6e\164\x5f\164\171\160\145"] = isset($post["\x67\x72\x61\x6e\164\x5f\x74\x79\160\145"]) ? stripslashes($post["\x67\x72\x61\156\x74\137\164\x79\x70\x65"]) : "\x41\165\164\150\157\162\151\x7a\x61\164\x69\x6f\x6e\40\x43\x6f\x64\x65\x20\107\x72\141\156\164";
        if (isset($post["\145\x6e\141\142\x6c\x65\x5f\157\141\165\164\x68\x5f\167\160\x5f\154\x6f\147\151\x6e"]) && "\157\x6e" === $post["\145\x6e\x61\x62\154\x65\x5f\157\x61\165\x74\150\137\167\160\137\154\x6f\x67\151\x6e"]) {
            goto bc;
        }
        $NQ->mo_oauth_client_delete_option("\155\157\137\157\141\165\x74\x68\137\145\x6e\141\142\154\x65\137\x6f\141\x75\164\x68\x5f\x77\x70\x5f\x6c\157\x67\x69\x6e");
        goto fv;
        bc:
        $NQ->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\141\x75\x74\x68\137\145\156\141\142\154\145\x5f\157\x61\165\164\150\x5f\167\160\x5f\154\157\147\151\x6e", $En["\x61\160\160\111\144"]);
        fv:
        return $En;
    }
    public function save_advanced_grant_settings()
    {
        if (!(!isset($_POST["\155\x6f\137\157\141\165\164\150\137\x67\x72\x61\156\164\137\x73\x65\x74\164\x69\x6e\147\x73\x5f\156\x6f\x6e\143\x65"]) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\157\141\165\x74\150\x5f\147\x72\141\x6e\164\137\163\x65\x74\164\151\x6e\147\x73\x5f\x6e\x6f\156\143\x65"])), "\155\157\137\157\141\165\164\x68\x5f\147\162\141\x6e\x74\x5f\x73\145\x74\164\x69\x6e\147\x73"))) {
            goto jq;
        }
        return;
        jq:
        $post = $_POST;
        if (!(!isset($post[\MoOAuthConstants::OPTION]) || "\x6d\x6f\x5f\x6f\141\165\164\x68\137\147\x72\x61\x6e\x74\137\163\145\x74\x74\151\156\147\163" !== $post[\MoOAuthConstants::OPTION])) {
            goto Hi;
        }
        return;
        Hi:
        if (!(!isset($post[\MoOAuthConstants::POST_APP_NAME]) || empty($post[\MoOAuthConstants::POST_APP_NAME]))) {
            goto hJ;
        }
        return;
        hJ:
        global $NQ;
        $UB = $post[\MoOAuthConstants::POST_APP_NAME];
        $En = $NQ->get_app_by_name($UB);
        $En = $En->get_app_config();
        $En = $this->save_grant_settings($post, $En);
        $NQ->set_app_by_name($UB, $En);
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\165\x72\40\x53\145\x74\x74\x69\x6e\147\163\40\x68\141\166\145\40\x62\145\x65\156\40\163\141\x76\145\x64\40\163\x75\143\x63\x65\x73\x73\x66\165\154\154\171\56");
        $NQ->mo_oauth_show_success_message();
        wp_safe_redirect("\141\x64\155\x69\x6e\56\160\x68\x70\77\x70\141\x67\x65\x3d\155\x6f\x5f\157\x61\x75\164\150\137\x73\145\x74\164\x69\x6e\147\x73\46\141\143\x74\151\157\156\75\165\x70\x64\141\164\x65\46\141\x70\x70\75" . rawurlencode($UB));
    }
    public function save_grant_settings($post, $En)
    {
        global $NQ;
        $En["\x6a\167\164\137\163\x75\160\160\x6f\x72\164"] = isset($post["\152\x77\164\137\x73\165\160\x70\157\x72\164"]) ? 1 : 0;
        $En["\152\167\164\137\141\154\x67\157"] = isset($post["\x6a\167\x74\137\141\154\147\157"]) ? stripslashes($post["\152\x77\x74\137\141\x6c\147\157"]) : "\x48\123\x41";
        if ("\x52\x53\x41" === $En["\152\x77\164\x5f\141\x6c\147\157"]) {
            goto Gy;
        }
        if (!isset($En["\170\65\60\x39\x5f\143\x65\162\164"])) {
            goto Z7;
        }
        unset($En["\170\x35\60\71\137\143\145\162\164"]);
        Z7:
        goto CL;
        Gy:
        $En["\x78\x35\x30\71\x5f\143\145\x72\x74"] = isset($post["\155\157\137\157\x61\165\x74\150\x5f\170\x35\60\x39\x5f\x63\145\162\x74"]) ? stripslashes($post["\155\157\137\157\141\x75\x74\x68\x5f\x78\65\x30\x39\x5f\x63\145\162\164"]) : '';
        CL:
        return $En;
    }
    public function change_attribute_mapping($post, $En)
    {
        $En = parent::change_attribute_mapping($post, $En);
        $En["\x67\162\157\x75\x70\156\x61\155\145\x5f\x61\164\164\162\x69\142\x75\x74\145"] = isset($post["\x6d\x61\160\x70\151\x6e\147\x5f\x67\162\157\165\160\x6e\x61\155\x65\137\x61\x74\164\162\151\142\165\164\145"]) ? trim(stripslashes($post["\x6d\x61\160\160\151\156\147\137\x67\162\157\165\160\156\141\x6d\x65\x5f\x61\x74\x74\162\x69\142\x75\164\x65"])) : '';
        $SY = array();
        $zh = 0;
        foreach ($post as $ZZ => $Da) {
            if (!(strpos($ZZ, "\155\157\x5f\157\141\x75\164\x68\137\143\154\x69\145\156\x74\x5f\x63\165\163\x74\x6f\155\x5f\141\x74\164\162\x69\x62\165\x74\145\x5f\x6b\145\171") !== false && !empty($post[$ZZ]))) {
                goto J3;
            }
            $zh++;
            $L2 = "\155\157\137\x6f\141\165\164\150\x5f\143\x6c\x69\x65\x6e\x74\x5f\143\x75\163\164\x6f\x6d\137\141\x74\164\162\151\x62\165\164\x65\137\166\141\154\165\145\x5f" . $zh;
            $SY[$Da] = $post[$L2];
            J3:
            UV:
        }
        Tg:
        $En["\143\x75\x73\164\157\x6d\137\x61\164\164\162\163\x5f\155\x61\x70\x70\x69\x6e\x67"] = $SY;
        return $En;
    }
    public function save_role_mapping()
    {
        global $NQ;
        if (!(isset($_POST["\155\x6f\x5f\157\141\x75\164\150\137\x63\x6c\151\145\x6e\164\x5f\163\141\166\x65\x5f\162\x6f\x6c\x65\137\x6d\141\160\x70\151\156\147\x5f\156\x6f\x6e\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\157\x61\165\x74\x68\137\143\x6c\x69\145\x6e\164\137\163\x61\166\145\x5f\162\x6f\x6c\145\x5f\155\141\160\160\x69\x6e\x67\137\x6e\157\156\143\145"])), "\155\157\x5f\x6f\141\x75\x74\x68\x5f\x63\x6c\x69\x65\156\164\137\163\141\x76\x65\137\x72\157\154\145\137\155\141\160\x70\x69\x6e\147") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\x6f\137\157\141\165\164\150\137\143\x6c\151\x65\156\164\x5f\163\x61\166\145\x5f\162\x6f\154\145\x5f\155\141\160\160\151\x6e\x67" === $_POST[\MoOAuthConstants::OPTION])) {
            goto r2;
        }
        $K_ = sanitize_text_field(wp_unslash(isset($_POST[\MoOAuthConstants::POST_APP_NAME]) ? $_POST[\MoOAuthConstants::POST_APP_NAME] : ''));
        $X1 = $NQ->get_app_by_name($K_);
        $R_ = $X1->get_app_config();
        $R_["\153\x65\x65\x70\x5f\145\170\151\163\x74\x69\156\x67\137\x75\x73\145\162\x5f\162\157\154\x65\163"] = isset($_POST["\x6b\x65\145\160\137\x65\x78\x69\163\164\x69\156\147\137\165\163\145\162\137\162\157\154\145\x73"]) ? sanitize_text_field(wp_unslash($_POST["\153\x65\x65\160\137\145\170\151\163\x74\x69\156\x67\137\165\163\x65\x72\137\x72\157\x6c\x65\163"])) : 0;
        $R_["\162\145\163\164\162\x69\143\x74\137\x6c\157\147\151\156\x5f\146\x6f\x72\137\155\141\x70\160\145\144\137\162\x6f\x6c\x65\163"] = isset($_POST["\162\x65\x73\x74\162\x69\143\x74\x5f\x6c\157\x67\x69\156\137\146\157\162\x5f\155\141\160\x70\145\x64\137\162\x6f\x6c\145\163"]) ? sanitize_text_field(wp_unslash($_POST["\162\x65\163\164\162\151\143\x74\137\x6c\157\x67\x69\x6e\x5f\146\157\162\x5f\x6d\141\160\160\145\144\137\162\x6f\154\145\x73"])) : false;
        $Mz = 100;
        $nO = 0;
        $zh = 1;
        Ph:
        if (!($zh <= $Mz)) {
            goto sG;
        }
        if (isset($_POST[\MoOAuthConstants::MAP_KEY . $zh])) {
            goto nD;
        }
        goto sG;
        goto wp;
        nD:
        if (!('' === $_POST[\MoOAuthConstants::MAP_KEY . $zh])) {
            goto YH;
        }
        goto Sr;
        YH:
        $R_["\x5f\x6d\x61\x70\160\x69\x6e\147\137\x6b\x65\x79\137" . $zh] = sanitize_text_field(wp_unslash(isset($_POST[\MoOAuthConstants::MAP_KEY . $zh]) ? $_POST[\MoOAuthConstants::MAP_KEY . $zh] : ''));
        $R_["\x5f\155\x61\x70\x70\151\156\147\x5f\x76\x61\154\x75\x65\x5f" . $zh] = sanitize_text_field(wp_unslash(isset($_POST["\155\141\160\x70\151\156\147\137\166\141\154\165\145\x5f" . $zh]) ? $_POST["\x6d\x61\x70\160\x69\156\147\137\166\x61\x6c\x75\x65\x5f" . $zh] : ''));
        $nO++;
        wp:
        Sr:
        $zh++;
        goto Ph;
        sG:
        $R_["\x72\x6f\154\145\x5f\x6d\x61\160\160\x69\x6e\147\x5f\x63\x6f\165\x6e\x74"] = $nO;
        $R_["\137\x6d\141\x70\x70\151\x6e\x67\137\166\x61\154\x75\x65\x5f\144\145\146\141\x75\154\x74"] = sanitize_text_field(wp_unslash(isset($_POST["\155\x61\x70\x70\x69\156\x67\x5f\166\x61\x6c\165\145\137\x64\145\x66\141\165\154\x74"]) ? $_POST["\x6d\141\x70\160\151\x6e\147\x5f\166\x61\154\x75\x65\137\x64\x65\x66\141\x75\x6c\x74"] : ''));
        $YG = $NQ->set_app_by_name($K_, $R_);
        if (!$YG) {
            goto tR;
        }
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\x75\x72\x20\163\145\x74\164\x69\156\147\163\x20\x61\x72\x65\40\x73\141\166\x65\x64\x20\x73\165\x63\x63\x65\x73\163\x66\165\154\154\x79\x2e");
        $NQ->mo_oauth_show_success_message();
        goto hh;
        tR:
        $NQ->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\150\145\x72\x65\40\167\x61\x73\x20\141\156\x20\x65\162\x72\x6f\x72\40\x73\141\166\151\156\147\40\163\x65\164\x74\x69\156\x67\x73\56");
        $NQ->mo_oauth_show_error_message();
        hh:
        wp_safe_redirect("\141\144\155\x69\156\x2e\160\150\x70\x3f\160\x61\x67\145\75\155\x6f\137\157\x61\165\x74\150\x5f\163\145\x74\164\x69\156\147\163\46\164\141\x62\75\143\157\x6e\x66\x69\x67\x26\141\x63\164\x69\157\156\75\x75\x70\x64\x61\164\145\x26\141\160\160\x3d" . rawurlencode($K_));
        r2:
    }
}
