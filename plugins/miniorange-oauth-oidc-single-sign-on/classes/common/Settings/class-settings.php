<?php


namespace MoOauthClient;

use MoOauthClient\Backup\BackupHandler;
use MoOauthClient\mc_utils;
use MoOauthClient\Customer;
use MoOauthClient\Config;
class Settings
{
    public $config;
    public $util;
    public function __construct()
    {
        global $NQ;
        $this->util = $NQ;
        add_action("\141\144\155\x69\x6e\137\x69\x6e\x69\164", array($this, "\155\151\x6e\151\x6f\x72\x61\x6e\147\x65\x5f\157\x61\165\x74\x68\137\x73\141\x76\x65\137\163\x65\164\x74\x69\x6e\x67\x73"));
        add_shortcode("\x6d\157\137\157\x61\165\164\x68\137\154\x6f\147\151\156", array($this, "\155\157\137\x6f\x61\165\x74\x68\x5f\163\150\x6f\x72\x74\x63\x6f\144\x65\x5f\154\x6f\147\x69\x6e"));
        $this->util->mo_oauth_client_update_option("\x6d\x6f\x5f\157\x61\165\x74\x68\x5f\x6c\157\147\x69\156\137\151\143\157\x6e\137\x73\160\141\x63\145", "\x35");
        $this->util->mo_oauth_client_update_option("\x6d\157\x5f\x6f\x61\165\164\150\137\x6c\157\x67\151\x6e\137\x69\143\x6f\x6e\137\x63\x75\163\x74\157\x6d\x5f\167\x69\144\x74\150", "\x33\62\65\x2e\x34\63");
        $this->util->mo_oauth_client_update_option("\x6d\157\137\157\141\165\164\150\x5f\x6c\x6f\147\151\x6e\137\151\143\x6f\156\x5f\143\x75\x73\x74\157\x6d\x5f\x68\145\x69\x67\x68\164", "\71\x2e\x36\63");
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\x6f\141\x75\x74\x68\137\154\x6f\x67\x69\x6e\137\151\143\157\156\x5f\143\165\x73\164\157\x6d\137\x73\151\172\145", "\63\x35");
        $this->util->mo_oauth_client_update_option("\155\157\x5f\157\141\x75\164\x68\137\154\x6f\147\x69\156\x5f\151\143\x6f\156\x5f\143\165\x73\164\x6f\x6d\x5f\143\157\x6c\x6f\162", "\x32\102\64\61\106\x46");
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\141\165\164\150\137\154\157\147\x69\x6e\x5f\x69\x63\x6f\x6e\137\143\x75\163\164\157\x6d\137\x62\157\x75\156\x64\141\x72\171", "\64");
        $this->config = $this->util->get_plugin_config();
    }
    public function miniorange_oauth_save_settings()
    {
        global $NQ;
        if (!(isset($_POST["\143\150\141\156\147\145\137\155\151\156\151\x6f\162\141\x6e\147\145\137\156\x6f\x6e\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\143\150\141\x6e\x67\145\137\x6d\x69\x6e\x69\x6f\162\x61\x6e\147\x65\137\156\157\156\143\145"])), "\143\x68\141\x6e\x67\145\x5f\x6d\x69\156\x69\x6f\x72\x61\156\147\x65") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x63\x68\141\x6e\x67\145\x5f\155\x69\x6e\151\157\x72\141\x6e\x67\145" === $_POST[\MoOAuthConstants::OPTION])) {
            goto Om;
        }
        mo_oauth_deactivate();
        return;
        Om:
        if (!(isset($_POST["\x6d\x6f\x5f\x6f\x61\x75\164\x68\x5f\x72\145\147\x69\163\x74\145\162\x5f\143\165\x73\164\x6f\x6d\x65\x72\137\156\157\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\157\141\x75\x74\150\137\162\145\x67\151\x73\164\145\x72\x5f\x63\165\163\164\x6f\155\x65\162\x5f\156\x6f\156\x63\x65"])), "\x6d\157\x5f\157\141\165\x74\x68\x5f\162\x65\x67\x69\163\164\x65\162\137\x63\x75\163\x74\157\x6d\x65\162") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\157\137\157\141\x75\x74\150\x5f\x72\145\x67\x69\x73\164\x65\x72\137\x63\x75\163\x74\157\155\x65\162" === $_POST[\MoOAuthConstants::OPTION])) {
            goto vF;
        }
        $yY = '';
        $d1 = '';
        $Ij = '';
        $uR = '';
        $Tg = '';
        $MD = '';
        $FV = '';
        if (!($this->util->mo_oauth_check_empty_or_null($_POST["\145\155\141\x69\154"]) || $this->util->mo_oauth_check_empty_or_null($_POST["\x70\x61\163\163\167\x6f\162\144"]) || $this->util->mo_oauth_check_empty_or_null($_POST["\143\x6f\156\146\151\x72\x6d\x50\141\x73\163\x77\x6f\162\x64"]))) {
            goto VZ;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x41\154\x6c\x20\x74\150\x65\x20\146\x69\x65\x6c\x64\x73\40\141\x72\x65\x20\162\145\x71\165\x69\x72\x65\x64\56\40\x50\x6c\145\141\x73\x65\40\x65\156\164\145\x72\40\166\141\154\151\144\x20\x65\x6e\164\162\x69\145\x73\56");
        $this->util->mo_oauth_show_error_message();
        return;
        VZ:
        if (strlen($_POST["\160\141\163\x73\x77\x6f\x72\x64"]) < 8 || strlen($_POST["\143\x6f\x6e\146\x69\x72\155\120\141\x73\x73\x77\157\162\144"]) < 8) {
            goto CS;
        }
        $yY = sanitize_email($_POST["\145\155\141\151\x6c"]);
        $d1 = stripslashes($_POST["\160\x68\x6f\156\145"]);
        $Ij = stripslashes($_POST["\x70\x61\x73\x73\167\x6f\162\x64"]);
        $uR = stripslashes($_POST["\x66\x6e\141\x6d\x65"]);
        $Tg = stripslashes($_POST["\x6c\x6e\x61\x6d\x65"]);
        $MD = stripslashes($_POST["\x63\x6f\155\160\141\x6e\x79"]);
        $FV = stripslashes($_POST["\143\157\156\146\x69\162\x6d\120\141\x73\x73\167\x6f\x72\x64"]);
        goto Z6;
        CS:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x43\x68\x6f\x6f\163\145\40\141\40\160\141\x73\x73\167\157\x72\144\x20\167\x69\164\150\x20\155\x69\x6e\x69\x6d\165\155\x20\154\x65\156\147\164\x68\40\x38\56");
        $this->util->mo_oauth_show_error_message();
        return;
        Z6:
        $this->util->mo_oauth_client_update_option("\x6d\157\137\x6f\x61\165\x74\x68\x5f\141\x64\x6d\x69\x6e\x5f\145\x6d\141\151\154", $yY);
        $this->util->mo_oauth_client_update_option("\x6d\157\137\x6f\141\165\164\x68\x5f\141\144\155\x69\156\137\x70\150\157\156\145", $d1);
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\x61\x75\164\150\137\x61\x64\x6d\151\x6e\137\146\156\x61\155\x65", $uR);
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\141\x75\164\x68\x5f\x61\x64\155\x69\156\137\x6c\156\141\x6d\x65", $Tg);
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\x61\165\x74\150\x5f\141\x64\155\x69\156\x5f\143\157\155\160\141\x6e\x79", $MD);
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto id;
        }
        return $this->util->mo_oauth_show_curl_error();
        id:
        if (strcmp($Ij, $FV) === 0) {
            goto g5;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\x61\163\x73\167\x6f\x72\x64\x73\40\144\x6f\40\x6e\x6f\164\40\155\141\x74\x63\150\x2e");
        $this->util->mo_oauth_client_delete_option("\x76\145\x72\x69\146\171\x5f\143\x75\163\164\157\x6d\145\x72");
        $this->util->mo_oauth_show_error_message();
        goto vQ;
        g5:
        $this->util->mo_oauth_client_update_option("\x70\x61\x73\x73\x77\x6f\162\144", $Ij);
        $Aa = new Customer();
        $yY = $this->util->mo_oauth_client_get_option("\155\157\x5f\157\141\x75\164\x68\137\x61\x64\155\x69\x6e\137\x65\155\141\x69\154");
        $mg = json_decode($Aa->check_customer(), true);
        if (strcasecmp($mg["\x73\164\141\164\x75\x73"], "\103\125\123\124\x4f\115\105\122\x5f\116\117\x54\137\x46\x4f\125\116\x44") === 0) {
            goto Um;
        }
        $this->mo_oauth_get_current_customer();
        goto EH;
        Um:
        $this->create_customer();
        EH:
        vQ:
        vF:
        if (!(isset($_POST["\155\x6f\x5f\157\141\165\x74\150\x5f\166\x65\162\x69\x66\171\137\x63\165\x73\x74\157\x6d\x65\x72\x5f\x6e\157\x6e\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\157\x61\165\x74\150\x5f\x76\145\162\x69\146\x79\x5f\143\165\x73\x74\157\x6d\x65\x72\137\x6e\157\156\x63\145"])), "\x6d\157\x5f\x6f\141\x75\x74\x68\137\x76\145\162\x69\146\171\137\143\x75\x73\x74\x6f\x6d\x65\x72") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\x5f\157\141\x75\x74\150\x5f\166\145\x72\x69\146\x79\137\143\x75\163\164\157\155\x65\x72" === $_POST[\MoOAuthConstants::OPTION])) {
            goto Hs;
        }
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto T4;
        }
        return $this->util->mo_oauth_show_curl_error();
        T4:
        $yY = isset($_POST["\145\155\141\x69\154"]) ? sanitize_email(wp_unslash($_POST["\x65\155\141\x69\x6c"])) : '';
        $Ij = isset($_POST["\x70\x61\163\x73\167\157\162\144"]) ? sanitize_text_field(wp_unslash($_POST["\x70\141\163\163\167\157\162\x64"])) : '';
        if (!($this->util->mo_oauth_check_empty_or_null($yY) || $this->util->mo_oauth_check_empty_or_null($Ij))) {
            goto Zv;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\101\x6c\x6c\x20\164\150\145\x20\146\x69\145\154\144\163\x20\141\162\145\40\162\145\x71\x75\151\x72\x65\x64\56\x20\x50\154\x65\x61\163\x65\x20\145\x6e\x74\145\x72\x20\x76\141\154\x69\144\40\145\156\164\162\x69\x65\x73\56");
        $this->util->mo_oauth_show_error_message();
        return;
        Zv:
        $this->util->mo_oauth_client_update_option("\155\157\137\157\141\165\164\x68\x5f\141\144\155\151\x6e\x5f\145\155\141\x69\154", $yY);
        $this->util->mo_oauth_client_update_option("\160\141\x73\x73\x77\157\x72\x64", $Ij);
        $Aa = new Customer();
        $mg = $Aa->get_customer_key();
        $u0 = json_decode($mg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            goto dC;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x49\x6e\166\141\x6c\151\x64\x20\165\x73\145\162\x6e\141\x6d\x65\x20\x6f\x72\x20\x70\141\x73\163\x77\x6f\162\x64\x2e\x20\x50\154\x65\141\163\145\x20\x74\x72\171\40\141\147\x61\151\x6e\x2e");
        $this->util->mo_oauth_show_error_message();
        goto H2;
        dC:
        $this->util->mo_oauth_client_update_option("\155\157\137\x6f\x61\165\164\150\137\x61\x64\x6d\x69\156\x5f\x63\165\x73\x74\157\x6d\145\x72\137\x6b\x65\x79", $u0["\151\x64"]);
        $this->util->mo_oauth_client_update_option("\155\157\137\157\x61\165\x74\x68\137\x61\144\x6d\x69\x6e\x5f\141\160\x69\x5f\153\x65\171", $u0["\141\x70\151\x4b\145\x79"]);
        $this->util->mo_oauth_client_update_option("\x63\x75\163\x74\157\x6d\x65\x72\137\x74\157\x6b\145\156", $u0["\164\x6f\153\x65\x6e"]);
        if (!isset($zn["\160\150\157\156\145"])) {
            goto R4;
        }
        $this->util->mo_oauth_client_update_option("\155\157\x5f\157\x61\165\164\x68\137\141\144\x6d\151\156\137\x70\150\x6f\156\145", $u0["\x70\150\x6f\156\145"]);
        R4:
        $this->util->mo_oauth_client_delete_option("\160\141\x73\x73\x77\157\x72\x64");
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x43\165\163\164\x6f\x6d\145\x72\x20\x72\x65\x74\x72\x69\x65\x76\145\x64\40\163\x75\x63\143\145\x73\x73\146\x75\154\154\x79");
        $this->util->mo_oauth_client_delete_option("\x76\145\x72\x69\146\171\137\x63\165\163\164\x6f\155\145\162");
        $this->util->mo_oauth_show_success_message();
        H2:
        Hs:
        if (!(isset($_POST["\155\x6f\137\x6f\141\x75\164\150\137\143\150\x61\156\147\145\137\145\155\141\x69\x6c\x5f\x6e\x6f\x6e\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\157\141\165\164\150\x5f\x63\150\141\x6e\147\x65\x5f\x65\x6d\x61\151\x6c\137\x6e\157\156\143\x65"])), "\155\157\137\x6f\141\x75\164\150\137\143\x68\x61\156\147\x65\x5f\x65\155\x61\x69\x6c") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\137\157\x61\165\x74\150\x5f\x63\150\x61\x6e\147\145\x5f\x65\155\x61\151\154" === $_POST[\MoOAuthConstants::OPTION])) {
            goto Cs;
        }
        $this->util->mo_oauth_client_update_option("\x76\x65\x72\151\146\x79\137\x63\165\163\x74\157\155\x65\162", '');
        $this->util->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\x75\x74\150\x5f\x72\x65\147\151\x73\x74\162\x61\164\x69\x6f\x6e\137\163\x74\x61\164\165\163", '');
        $this->util->mo_oauth_client_update_option("\156\145\167\x5f\x72\145\x67\151\x73\x74\x72\x61\x74\151\x6f\156", "\x74\x72\x75\145");
        Cs:
        if (!(isset($_POST["\155\x6f\137\157\141\x75\164\x68\137\143\157\156\164\x61\143\x74\x5f\165\x73\137\x71\165\x65\162\171\137\157\160\164\x69\x6f\156\x5f\x6e\x6f\x6e\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\x5f\x6f\x61\x75\x74\x68\137\x63\x6f\x6e\164\141\x63\x74\x5f\165\163\x5f\161\165\x65\162\171\137\157\x70\x74\151\x6f\156\137\x6e\157\156\x63\x65"])), "\155\x6f\137\x6f\x61\x75\x74\150\x5f\143\x6f\x6e\164\141\x63\164\x5f\x75\163\x5f\161\x75\x65\162\x79\x5f\x6f\160\x74\151\157\x6e") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\x6f\x61\x75\x74\x68\137\x63\x6f\x6e\x74\141\143\x74\x5f\165\163\x5f\x71\165\145\x72\x79\x5f\x6f\x70\164\151\x6f\156" === $_POST[\MoOAuthConstants::OPTION])) {
            goto QJ;
        }
        if (!($this->util->mo_oauth_is_curl_installed() === 0)) {
            goto n8;
        }
        return $this->util->mo_oauth_show_curl_error();
        n8:
        $yY = isset($_POST["\155\157\x5f\x6f\x61\165\x74\150\x5f\x63\x6f\156\164\141\x63\164\137\x75\163\x5f\145\155\141\x69\x6c"]) ? sanitize_text_field(wp_unslash($_POST["\155\157\137\157\x61\x75\x74\150\137\x63\x6f\x6e\164\x61\143\164\137\165\x73\137\145\155\x61\151\154"])) : '';
        $d1 = isset($_POST["\155\157\x5f\157\141\165\164\150\137\143\x6f\156\164\141\x63\164\137\x75\163\x5f\160\150\x6f\156\x65"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\137\157\141\165\x74\150\x5f\x63\157\156\164\x61\143\164\x5f\x75\163\x5f\x70\x68\157\x6e\x65"])) : '';
        $p7 = isset($_POST["\155\157\x5f\x6f\141\165\x74\150\137\143\x6f\156\164\141\143\164\137\x75\x73\137\x71\165\x65\162\x79"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\157\141\165\164\x68\137\143\157\156\164\141\x63\164\x5f\165\x73\137\161\x75\x65\x72\x79"])) : '';
        $wm = isset($_POST["\x6d\157\x5f\157\x61\x75\x74\150\x5f\x73\x65\156\x64\x5f\160\154\165\x67\151\x6e\x5f\x63\x6f\156\146\151\x67"]);
        $Aa = new Customer();
        if ($this->util->mo_oauth_check_empty_or_null($yY) || $this->util->mo_oauth_check_empty_or_null($p7)) {
            goto gW;
        }
        $pb = $Aa->submit_contact_us($yY, $d1, $p7, $wm);
        if (false === $pb) {
            goto rl;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\x68\x61\x6e\x6b\x73\40\x66\157\x72\x20\147\145\x74\x74\151\x6e\x67\x20\x69\x6e\40\x74\x6f\x75\143\150\41\x20\127\145\x20\163\x68\141\154\x6c\x20\147\x65\x74\40\142\141\x63\x6b\x20\x74\157\40\x79\157\x75\40\x73\150\x6f\162\x74\x6c\x79\x2e");
        $this->util->mo_oauth_show_success_message();
        goto Bc;
        rl:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\165\x72\x20\161\x75\x65\x72\171\40\x63\157\x75\154\x64\x20\x6e\x6f\164\40\x62\145\40\163\x75\x62\x6d\x69\x74\x74\x65\144\56\40\x50\154\x65\141\163\x65\x20\x74\162\171\x20\x61\147\141\151\156\56");
        $this->util->mo_oauth_show_error_message();
        Bc:
        goto CQ;
        gW:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\154\145\x61\163\145\x20\x66\x69\x6c\x6c\x20\x75\x70\40\105\155\141\151\x6c\40\141\x6e\144\x20\x51\165\145\162\x79\x20\146\151\x65\x6c\x64\x73\x20\164\x6f\40\x73\165\x62\155\151\x74\40\171\x6f\165\x72\40\161\x75\145\x72\x79\x2e");
        $this->util->mo_oauth_show_error_message();
        CQ:
        QJ:
        if (!(isset($_POST["\155\x6f\137\157\141\165\x74\x68\137\162\x65\163\x74\x6f\x72\145\137\142\141\x63\x6b\165\x70\137\x6e\157\156\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\157\141\165\164\150\x5f\162\145\x73\164\157\162\145\x5f\x62\141\x63\153\x75\x70\137\156\157\156\143\145"])), "\155\157\137\157\141\x75\x74\150\x5f\162\145\x73\164\x6f\x72\x65\137\142\x61\x63\153\165\x70") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\157\137\x6f\x61\x75\x74\x68\x5f\x72\x65\163\164\x6f\162\x65\x5f\x62\x61\143\153\x75\x70" === $_POST[\MoOAuthConstants::OPTION])) {
            goto yP;
        }
        $as = "\124\150\145\162\145\40\x77\141\x73\x20\x61\156\40\x65\x72\162\x6f\162\x20\165\160\154\157\x61\x64\151\x6e\x67\x20\x74\x68\145\x20\146\151\x6c\145";
        if (isset($_FILES["\x6d\157\x5f\x6f\x61\165\164\150\137\x63\x6c\x69\145\156\164\137\x62\141\x63\153\x75\x70"])) {
            goto Kp;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $as);
        $this->util->mo_oauth_show_error_message();
        return;
        Kp:
        if (function_exists("\x77\160\x5f\x68\141\x6e\x64\154\145\137\x75\160\154\157\x61\x64")) {
            goto A5;
        }
        require_once ABSPATH . "\x77\x70\55\141\144\x6d\x69\156\x2f\151\156\143\154\x75\x64\145\x73\57\146\151\x6c\x65\x2e\x70\x68\x70";
        A5:
        $fS = $_FILES["\155\157\137\157\141\165\164\x68\137\x63\x6c\151\x65\156\x74\x5f\142\141\x63\153\165\x70"];
        if (!(!isset($fS["\x65\x72\162\x6f\162"]) || is_array($fS["\145\162\x72\x6f\162"]) || UPLOAD_ERR_OK !== $fS["\x65\x72\x72\x6f\162"])) {
            goto Z0;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $as . "\72\x20" . json_encode($fS["\x65\x72\162\157\162"], JSON_UNESCAPED_SLASHES));
        $this->util->mo_oauth_show_error_message();
        return;
        Z0:
        $RB = new \finfo(FILEINFO_MIME_TYPE);
        $wp = array_search($RB->file($fS["\164\155\160\x5f\156\x61\155\x65"]), array("\x74\145\170\x74" => "\164\x65\170\164\57\160\154\x61\151\x6e"), true);
        $SJ = explode("\56", $fS["\156\141\x6d\x65"]);
        $SJ = $SJ[count($SJ) - 1];
        if (!(false === $wp || $SJ !== "\x6a\x73\157\156")) {
            goto TW;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $as . "\72\x20\111\x6e\x76\141\154\x69\144\40\106\151\154\145\40\x46\157\162\155\x61\164\56");
        $this->util->mo_oauth_show_error_message();
        return;
        TW:
        $JI = file_get_contents($fS["\164\x6d\x70\x5f\156\x61\155\145"]);
        $HC = json_decode($JI, true);
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto rT;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, $as . "\x3a\x20\111\x6e\x76\x61\x6c\151\144\x20\106\151\x6c\145\40\106\x6f\162\x6d\x61\x74\x2e");
        $this->util->mo_oauth_show_error_message();
        return;
        rT:
        $H5 = BackupHandler::restore_settings($HC);
        if (!$H5) {
            goto Qg;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x53\145\x74\x74\x69\156\147\x73\x20\x72\145\163\164\157\162\x65\x64\40\x73\165\x63\x63\145\x73\163\x66\x75\x6c\154\x79\56");
        $this->util->mo_oauth_show_success_message();
        return;
        Qg:
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\124\150\145\162\x65\40\167\x61\163\x20\x61\156\x20\x69\x73\163\x75\x65\40\x77\x68\x69\x6c\x65\x20\x72\145\x73\x74\x6f\x72\x69\x6e\x67\40\x74\150\x65\40\143\x6f\156\x66\151\147\165\162\141\x74\151\x6f\156\56");
        $this->util->mo_oauth_show_error_message();
        return;
        yP:
        if (!(isset($_POST["\x6d\x6f\137\157\141\x75\164\x68\137\144\157\x77\156\154\x6f\141\144\x5f\142\x61\x63\153\x75\160\137\x6e\157\x6e\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\137\x6f\x61\x75\164\x68\x5f\x64\x6f\167\156\x6c\x6f\x61\x64\137\142\141\x63\x6b\165\x70\x5f\x6e\157\x6e\x63\145"])), "\x6d\157\137\157\x61\x75\164\150\137\x64\x6f\167\x6e\x6c\157\141\x64\137\142\x61\x63\x6b\165\160") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\x5f\x6f\x61\165\x74\x68\x5f\144\x6f\x77\x6e\154\157\141\x64\137\142\x61\x63\x6b\165\160" === $_POST[\MoOAuthConstants::OPTION])) {
            goto MC;
        }
        $Yw = BackupHandler::get_backup_json();
        header("\103\x6f\156\x74\145\x6e\x74\55\x54\171\160\x65\72\x20\141\160\x70\x6c\x69\x63\141\x74\151\x6f\156\57\152\163\x6f\156");
        header("\x43\157\156\164\x65\156\164\55\104\x69\163\x70\157\x73\151\x74\151\157\156\x3a\40\141\x74\x74\x61\x63\x68\x6d\145\x6e\164\x3b\x20\x66\151\x6c\x65\x6e\x61\x6d\x65\75\x22\x70\154\165\147\x69\156\137\x62\141\x63\153\165\160\56\x6a\x73\x6f\x6e\42");
        header("\x43\157\x6e\x74\145\x6e\164\x2d\114\x65\156\147\x74\x68\72\40" . strlen($Yw));
        header("\x43\157\x6e\x6e\x65\143\x74\151\x6f\156\x3a\x20\x63\154\157\163\145");
        echo $Yw;
        die;
        MC:
        do_action("\144\157\137\x6d\x61\151\156\x5f\x73\145\x74\164\x69\x6e\147\163\137\151\156\164\145\x72\x6e\x61\x6c", $_POST);
    }
    public function mo_oauth_get_current_customer()
    {
        $Aa = new Customer();
        $mg = $Aa->get_customer_key();
        $u0 = json_decode($mg, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            goto vC;
        }
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x59\157\x75\x20\x61\x6c\162\145\141\144\171\40\x68\x61\166\145\x20\141\156\x20\x61\x63\143\157\165\156\164\40\x77\x69\x74\x68\40\x6d\x69\156\151\x4f\162\141\156\x67\x65\x2e\40\x50\x6c\x65\141\163\145\40\x65\x6e\164\145\162\x20\x61\x20\166\x61\x6c\151\x64\40\160\x61\x73\x73\x77\x6f\x72\144\x2e");
        $this->util->mo_oauth_client_update_option("\166\145\x72\x69\146\x79\137\143\165\163\164\157\x6d\x65\x72", "\164\x72\165\145");
        $this->util->mo_oauth_show_error_message();
        goto px;
        vC:
        $this->util->mo_oauth_client_update_option("\155\157\x5f\x6f\141\165\x74\150\x5f\141\144\x6d\x69\156\137\143\x75\163\x74\157\x6d\145\x72\x5f\153\x65\171", $u0["\x69\x64"]);
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\157\141\x75\164\x68\137\x61\x64\x6d\x69\x6e\137\141\x70\151\137\x6b\145\171", $u0["\x61\160\151\113\145\x79"]);
        $this->util->mo_oauth_client_update_option("\x63\165\x73\164\x6f\155\x65\x72\137\x74\157\x6b\x65\156", $u0["\164\157\153\145\156"]);
        $this->util->mo_oauth_client_update_option("\160\x61\163\x73\167\157\x72\144", '');
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x43\165\163\164\157\x6d\x65\x72\40\162\145\164\x72\x69\x65\x76\145\144\40\x73\x75\x63\143\145\163\x73\146\x75\154\x6c\x79");
        $this->util->mo_oauth_client_delete_option("\166\145\x72\x69\x66\171\137\143\x75\163\x74\157\155\x65\x72");
        $this->util->mo_oauth_client_delete_option("\x6e\145\167\137\x72\x65\147\151\163\164\x72\x61\164\x69\157\156");
        $this->util->mo_oauth_show_success_message();
        px:
    }
    public function create_customer()
    {
        global $NQ;
        $Aa = new Customer();
        $u0 = json_decode($Aa->create_customer(), true);
        if (strcasecmp($u0["\163\x74\141\x74\x75\163"], "\x43\x55\123\x54\117\x4d\x45\x52\x5f\125\123\x45\122\x4e\x41\115\105\137\101\x4c\x52\105\x41\104\131\137\105\130\x49\123\124\123") === 0) {
            goto ka;
        }
        if (strcasecmp($u0["\163\164\x61\x74\x75\163"], "\x53\x55\103\x43\x45\x53\123") === 0) {
            goto ct;
        }
        goto ip;
        ka:
        $this->mo_oauth_get_current_customer();
        $this->util->mo_oauth_client_delete_option("\155\x6f\x5f\157\x61\x75\164\150\137\156\145\x77\x5f\143\x75\163\x74\x6f\155\145\x72");
        goto ip;
        ct:
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\x6f\141\x75\164\x68\x5f\x61\x64\x6d\x69\156\137\143\x75\163\x74\x6f\x6d\145\x72\137\153\x65\171", $u0["\151\x64"]);
        $this->util->mo_oauth_client_update_option("\x6d\x6f\137\x6f\x61\165\164\150\137\x61\144\x6d\151\x6e\137\141\160\151\x5f\153\145\x79", $u0["\141\160\x69\x4b\x65\x79"]);
        $this->util->mo_oauth_client_update_option("\143\165\x73\x74\157\155\x65\162\137\x74\157\x6b\x65\x6e", $u0["\x74\157\153\x65\x6e"]);
        $this->util->mo_oauth_client_update_option("\x70\x61\x73\x73\167\157\162\x64", '');
        $this->util->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x52\x65\x67\x69\x73\x74\x65\162\145\144\40\163\x75\x63\x63\x65\163\x73\x66\165\154\154\171\56");
        $this->util->mo_oauth_client_update_option("\x6d\157\x5f\157\x61\x75\x74\x68\137\162\x65\x67\151\x73\164\x72\x61\164\151\157\156\137\x73\x74\141\164\165\x73", "\115\x4f\x5f\x4f\101\x55\x54\110\x5f\x52\x45\x47\x49\x53\x54\122\101\124\111\117\x4e\x5f\103\x4f\115\x50\114\105\124\x45");
        $this->util->mo_oauth_client_update_option("\x6d\157\x5f\x6f\x61\165\164\x68\x5f\x6e\x65\167\137\143\165\163\164\x6f\155\x65\162", 1);
        $this->util->mo_oauth_client_delete_option("\x76\x65\162\x69\x66\171\x5f\143\165\x73\164\157\155\x65\x72");
        $this->util->mo_oauth_client_delete_option("\156\x65\x77\137\x72\x65\147\151\x73\x74\x72\141\164\151\157\x6e");
        $this->util->mo_oauth_show_success_message();
        ip:
    }
}
