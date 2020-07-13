<?php


namespace MoOauthClient\Base;

class InstanceHelper
{
    private $current_version = "\106\122\105\x45";
    private $utils;
    public function __construct()
    {
        $this->utils = new \MoOauthClient\MOUtils();
        $this->current_version = $this->utils->get_versi_str();
    }
    public function get_sign_in_settings_instance()
    {
        if (class_exists("\x4d\x6f\117\141\165\x74\150\103\x6c\x69\145\156\x74\134\105\156\x74\145\162\x70\162\x69\x73\x65\134\123\x69\x67\156\111\x6e\123\x65\164\x74\151\156\x67\163") && $this->utils->check_versi(3)) {
            goto pA;
        }
        if (class_exists("\x4d\x6f\117\x61\165\x74\x68\103\x6c\x69\x65\x6e\x74\134\120\x72\x65\155\151\165\x6d\134\123\x69\x67\156\111\x6e\x53\x65\164\164\151\x6e\147\x73") && $this->utils->check_versi(2)) {
            goto az;
        }
        if (class_exists("\x4d\x6f\x4f\141\165\164\x68\103\154\x69\145\x6e\164\x5c\123\164\141\156\x64\141\x72\x64\134\123\151\x67\x6e\x49\x6e\123\x65\x74\164\x69\x6e\x67\163") && $this->utils->check_versi(1)) {
            goto h_;
        }
        if (class_exists("\x5c\115\x6f\117\141\x75\164\150\103\154\151\145\x6e\164\134\106\x72\145\x65\x5c\x53\x69\147\x6e\111\x6e\x53\x65\x74\164\x69\x6e\147\x73") && $this->utils->check_versi(0)) {
            goto LR;
        }
        wp_die("\120\154\145\x61\x73\x65\x20\103\x68\141\156\147\x65\x20\124\x68\145\x20\166\x65\x72\163\151\x6f\156\40\x62\141\143\153\x20\164\157\40\167\150\141\164\x20\151\164\x20\x72\x65\x61\154\x6c\171\x20\x77\x61\x73");
        die;
        goto UD;
        pA:
        return new \MoOauthClient\Enterprise\SignInSettings();
        goto UD;
        az:
        return new \MoOauthClient\Premium\SignInSettings();
        goto UD;
        h_:
        return new \MoOauthClient\Standard\SignInSettings();
        goto UD;
        LR:
        return new \MoOauthClient\Free\SignInSettings();
        UD:
    }
    public function get_requestdemo_instance()
    {
        if (!class_exists("\x5c\115\157\x4f\141\x75\164\150\x43\154\151\x65\156\164\134\x46\162\x65\145\134\122\145\x71\165\145\x73\164\x66\x6f\162\144\145\155\x6f")) {
            goto kB;
        }
        return new \MoOauthClient\Free\Requestfordemo();
        kB:
    }
    public function get_customization_instance()
    {
        if (class_exists("\x4d\x6f\117\x61\x75\x74\150\103\154\x69\x65\156\164\134\105\156\x74\x65\162\x70\162\151\x73\145\134\x43\x75\163\x74\157\x6d\151\172\141\x74\x69\x6f\156") && $this->utils->check_versi(3)) {
            goto BX;
        }
        if (class_exists("\115\157\117\141\165\x74\150\x43\x6c\x69\145\x6e\x74\x5c\x50\x72\x65\x6d\x69\x75\x6d\134\x43\165\x73\164\157\x6d\x69\172\x61\x74\151\157\x6e") && $this->utils->check_versi(2)) {
            goto BL;
        }
        if (class_exists("\x4d\157\x4f\141\x75\x74\150\x43\x6c\151\x65\x6e\x74\134\x53\164\x61\x6e\x64\x61\x72\x64\134\103\x75\x73\164\x6f\x6d\x69\172\x61\164\x69\157\x6e") && $this->utils->check_versi(1)) {
            goto vL;
        }
        if (class_exists("\134\115\x6f\x4f\141\x75\x74\150\103\154\x69\145\156\164\134\x46\162\145\145\x5c\x43\x75\x73\164\157\155\151\172\x61\164\151\157\156") && $this->utils->check_versi(0)) {
            goto BR;
        }
        wp_die("\120\x6c\145\141\x73\145\x20\103\x68\141\156\147\145\40\x54\x68\x65\x20\x76\x65\x72\163\151\x6f\156\40\142\x61\143\153\40\164\x6f\40\x77\x68\x61\x74\x20\x69\x74\x20\162\x65\x61\154\154\171\40\x77\x61\x73");
        die;
        goto Ra;
        BX:
        return new \MoOauthClient\Enterprise\Customization();
        goto Ra;
        BL:
        return new \MoOauthClient\Premium\Customization();
        goto Ra;
        vL:
        return new \MoOauthClient\Standard\Customization();
        goto Ra;
        BR:
        return new \MoOauthClient\Free\Customization();
        Ra:
    }
    public function get_clientappui_instance()
    {
        if (class_exists("\x4d\157\x4f\141\165\x74\150\103\154\x69\x65\x6e\164\134\x45\x6e\164\145\x72\x70\162\x69\x73\145\x5c\103\154\151\145\x6e\164\x41\x70\160\125\x49") && $this->utils->check_versi(3)) {
            goto CV;
        }
        if (class_exists("\115\x6f\x4f\141\165\164\150\x43\154\x69\x65\156\164\134\120\x72\x65\155\x69\165\155\134\103\154\x69\145\156\164\x41\160\160\x55\x49") && $this->utils->check_versi(2)) {
            goto DW;
        }
        if (class_exists("\x4d\157\117\141\x75\x74\150\x43\154\x69\145\x6e\164\x5c\x53\164\x61\x6e\x64\x61\x72\144\134\x43\154\151\x65\x6e\x74\101\160\x70\x55\111") && $this->utils->check_versi(1)) {
            goto gD;
        }
        if (class_exists("\x5c\x4d\x6f\117\141\165\164\x68\103\x6c\151\x65\x6e\x74\134\106\162\145\x65\134\103\x6c\151\x65\x6e\164\x41\160\160\x55\111") && $this->utils->check_versi(0)) {
            goto ie;
        }
        wp_die("\x50\x6c\145\x61\163\145\x20\103\x68\x61\x6e\x67\145\x20\x54\150\145\40\166\x65\x72\x73\x69\x6f\156\40\x62\141\143\x6b\40\164\157\40\x77\150\x61\164\x20\x69\x74\40\x72\145\141\154\x6c\x79\x20\x77\141\x73");
        die;
        goto ed;
        CV:
        return new \MoOauthClient\Enterprise\ClientAppUI();
        goto ed;
        DW:
        return new \MoOauthClient\Premium\ClientAppUI();
        goto ed;
        gD:
        return new \MoOauthClient\Standard\ClientAppUI();
        goto ed;
        ie:
        return new \MoOauthClient\Free\ClientAppUI();
        ed:
    }
    public function get_login_handler_instance()
    {
        if (class_exists("\x4d\x6f\117\141\165\164\x68\103\x6c\x69\145\x6e\x74\134\x45\156\164\x65\162\x70\x72\x69\x73\x65\134\114\157\147\151\x6e\110\x61\156\144\154\x65\162") && $this->utils->check_versi(3)) {
            goto i2;
        }
        if (class_exists("\115\157\117\141\x75\x74\150\103\154\151\145\156\x74\134\120\x72\x65\x6d\x69\165\155\134\x4c\157\x67\151\x6e\110\x61\156\x64\x6c\x65\x72") && $this->utils->check_versi(2)) {
            goto CX;
        }
        if (class_exists("\x4d\157\x4f\x61\x75\x74\150\x43\x6c\151\x65\156\x74\134\x53\x74\141\156\144\141\x72\144\x5c\x4c\157\147\x69\x6e\x48\141\x6e\x64\x6c\145\x72") && $this->utils->check_versi(1)) {
            goto Ws;
        }
        if (class_exists("\134\115\157\117\141\x75\x74\x68\103\154\151\x65\x6e\x74\134\x4c\157\147\x69\x6e\x48\x61\x6e\x64\x6c\145\162") && $this->utils->check_versi(0)) {
            goto uq;
        }
        wp_die("\120\x6c\x65\141\x73\145\x20\x43\150\x61\x6e\x67\145\x20\x54\150\145\40\166\x65\x72\x73\x69\x6f\156\40\x62\x61\x63\x6b\x20\x74\157\x20\167\x68\141\164\x20\x69\x74\x20\x72\x65\141\154\x6c\x79\x20\x77\141\163");
        die;
        goto BI;
        i2:
        return new \MoOauthClient\Enterprise\LoginHandler();
        goto BI;
        CX:
        return new \MoOauthClient\Premium\LoginHandler();
        goto BI;
        Ws:
        return new \MoOauthClient\Standard\LoginHandler();
        goto BI;
        uq:
        return new \MoOauthClient\LoginHandler();
        BI:
    }
    public function get_settings_instance()
    {
        if (class_exists("\x4d\x6f\117\x61\165\164\150\103\154\x69\x65\156\164\x5c\x45\156\164\145\x72\160\162\x69\163\145\134\105\156\x74\145\162\x70\x72\151\x73\145\123\145\164\x74\151\x6e\147\x73") && $this->utils->check_versi(3)) {
            goto Ue;
        }
        if (class_exists("\x4d\157\117\141\x75\164\150\103\x6c\x69\145\x6e\164\134\120\162\145\155\151\165\155\134\x50\162\145\x6d\x69\165\x6d\x53\x65\164\x74\x69\x6e\147\x73") && $this->utils->check_versi(2)) {
            goto JA;
        }
        if (class_exists("\115\x6f\x4f\141\x75\x74\x68\103\x6c\151\x65\156\164\x5c\x53\164\x61\156\x64\x61\x72\x64\134\123\164\141\156\x64\141\162\x64\x53\x65\x74\x74\151\x6e\x67\163") && $this->utils->check_versi(1)) {
            goto RL;
        }
        if (class_exists("\x4d\x6f\x4f\x61\165\164\x68\103\154\x69\x65\156\164\134\106\162\145\145\134\x46\162\145\x65\x53\x65\x74\x74\x69\x6e\147\163") && $this->utils->check_versi(0)) {
            goto Rp;
        }
        wp_die("\x50\x6c\x65\141\x73\145\40\x43\x68\x61\156\147\145\x20\124\150\x65\40\166\x65\x72\163\151\x6f\156\40\x62\141\143\x6b\40\x74\157\x20\167\150\141\164\x20\x69\x74\x20\x72\x65\141\154\154\x79\40\x77\x61\x73");
        die;
        goto rv;
        Ue:
        return new \MoOauthClient\Enterprise\EnterpriseSettings();
        goto rv;
        JA:
        return new \MoOauthClient\Premium\PremiumSettings();
        goto rv;
        RL:
        return new \MoOauthClient\Standard\StandardSettings();
        goto rv;
        Rp:
        return new \MoOauthClient\Free\FreeSettings();
        rv:
    }
    public function get_accounts_instance()
    {
        if (class_exists("\115\x6f\x4f\x61\165\164\x68\103\154\151\145\x6e\x74\134\x50\x61\151\144\134\x41\143\143\x6f\165\x6e\x74\163") && $this->utils->check_versi(1)) {
            goto n_;
        }
        return new \MoOauthClient\Accounts();
        goto C1;
        n_:
        return new \MoOauthClient\Paid\Accounts();
        C1:
    }
    public function get_user_analytics()
    {
        if (class_exists("\115\x6f\x4f\141\x75\164\x68\103\x6c\x69\x65\156\164\134\x45\156\164\145\x72\160\x72\151\163\x65\x5c\x55\163\145\162\x41\x6e\141\x6c\171\x74\x69\x63\x73") && $this->utils->check_versi(3)) {
            goto zV;
        }
        wp_die("\x50\x6c\145\141\163\145\x20\x43\x68\141\156\147\x65\40\x54\150\145\40\x76\x65\x72\163\x69\x6f\156\40\142\141\x63\153\x20\x74\x6f\40\x77\150\141\x74\x20\x69\164\x20\x72\x65\x61\x6c\154\x79\40\x77\x61\163");
        die;
        goto UK;
        zV:
        return new \MoOauthClient\Enterprise\UserAnalytics();
        UK:
    }
    public function get_utils_instance()
    {
        if (!(class_exists("\115\x6f\x4f\141\x75\x74\x68\x43\154\151\x65\156\164\134\x53\164\141\156\x64\x61\x72\144\134\x4d\117\125\164\151\154\x73") && $this->utils->check_versi(1))) {
            goto AD;
        }
        return new \MoOauthClient\Standard\MOUtils();
        AD:
        return $this->utils;
    }
}
