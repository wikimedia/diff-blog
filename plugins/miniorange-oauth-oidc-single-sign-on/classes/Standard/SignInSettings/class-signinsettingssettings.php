<?php


namespace MoOauthClient\Standard;

use MoOauthClient\Config;
class SignInSettingsSettings
{
    private $plugin_config;
    public function __construct()
    {
        $iP = $this->get_config_option();
        if ($iP && isset($iP)) {
            goto w1j;
        }
        $this->plugin_config = new Config();
        $this->save_config_option($this->plugin_config);
        goto b4D;
        w1j:
        $this->save_config_option($iP);
        $this->plugin_config = $iP;
        b4D:
    }
    public function save_config_option($HC = array())
    {
        global $NQ;
        if (!(isset($HC) && !empty($HC))) {
            goto XYX;
        }
        return $NQ->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\165\x74\x68\x5f\x63\x6c\151\145\156\x74\137\x63\x6f\156\146\x69\147", $HC);
        XYX:
        return false;
    }
    public function get_config_option()
    {
        global $NQ;
        return $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\x61\165\164\x68\137\x63\x6c\151\x65\156\x74\137\143\157\156\x66\151\147");
    }
    public function get_sane_config()
    {
        $HC = $this->plugin_config;
        if ($HC && isset($HC)) {
            goto clV;
        }
        $HC = $this->get_config_option();
        clV:
        if (!(!$HC || !isset($HC))) {
            goto PrM;
        }
        $HC = new Config();
        PrM:
        return $HC;
    }
    public function mo_oauth_save_settings()
    {
        global $NQ;
        $HC = $this->get_sane_config();
        if (!(isset($_POST["\x6d\157\137\x73\x69\147\156\x69\x6e\163\145\164\x74\x69\156\x67\x73\137\x6e\157\156\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x73\x69\x67\x6e\151\x6e\163\x65\x74\x74\x69\156\x67\163\x5f\156\x6f\x6e\x63\x65"])), "\155\x6f\x5f\157\x61\x75\164\x68\x5f\143\x6c\151\x65\156\x74\x5f\x73\151\147\156\x5f\x69\156\x5f\163\x65\x74\x74\x69\156\147\163") && (isset($_POST[\MoOAuthConstants::OPTION]) && "\155\157\x5f\x6f\141\165\164\150\x5f\143\154\151\x65\x6e\164\x5f\141\144\x76\x61\156\x63\x65\x64\x5f\x73\145\164\164\151\x6e\x67\x73" === $_POST[\MoOAuthConstants::OPTION]))) {
            goto V2z;
        }
        $HC = $this->change_current_config($_POST, $HC);
        $HC->save_settings($HC->get_current_config());
        $this->save_config_option($HC);
        V2z:
    }
    public function change_current_config($post, $HC)
    {
        $HC->add_config("\x61\146\164\145\x72\x5f\x6c\157\x67\x69\156\137\x75\x72\x6c", isset($post["\143\165\x73\164\x6f\155\x5f\x61\x66\x74\145\162\137\154\x6f\x67\151\x6e\137\165\x72\154"]) ? stripslashes(wp_unslash($post["\143\165\x73\x74\157\x6d\137\141\146\x74\x65\162\x5f\154\157\147\151\x6e\x5f\x75\162\x6c"])) : '');
        $HC->add_config("\x61\x66\x74\x65\x72\137\154\x6f\x67\x6f\x75\164\x5f\x75\162\x6c", isset($post["\143\x75\163\164\157\x6d\137\x61\146\x74\145\x72\137\154\157\x67\157\x75\x74\x5f\x75\x72\154"]) ? stripslashes(wp_unslash($post["\143\165\x73\x74\x6f\x6d\x5f\x61\146\x74\x65\162\137\x6c\157\x67\x6f\165\164\137\165\162\x6c"])) : '');
        $HC->add_config("\x70\157\160\x75\x70\x5f\x6c\157\147\151\156", isset($post["\160\x6f\160\165\160\x5f\154\x6f\x67\x69\x6e"]) ? stripslashes(wp_unslash($post["\160\x6f\x70\x75\160\137\154\157\147\x69\x6e"])) : 0);
        $HC->add_config("\141\x75\164\157\x5f\162\x65\x67\151\x73\164\x65\162", isset($post["\x61\x75\x74\x6f\x5f\x72\145\x67\151\x73\x74\145\x72"]) ? stripslashes(wp_unslash($post["\141\165\x74\157\137\x72\x65\147\151\x73\x74\x65\162"])) : 0);
        $HC->add_config("\143\x6f\x6e\146\151\x72\x6d\137\x6c\x6f\147\157\x75\164", isset($post["\x63\157\x6e\x66\151\x72\x6d\137\x6c\x6f\x67\157\165\x74"]) ? stripslashes(wp_unslash($post["\143\x6f\x6e\x66\x69\162\155\137\x6c\157\x67\157\x75\164"])) : 0);
        return $HC;
    }
}
