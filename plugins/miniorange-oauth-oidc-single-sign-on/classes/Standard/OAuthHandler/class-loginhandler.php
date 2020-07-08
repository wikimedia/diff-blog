<?php


namespace MoOauthClient\Standard;

use MoOauthClient\LoginHandler as FreeLoginHandler;
use MoOauthClient\Config;
use MoOauthClient\StorageManager;
class LoginHandler extends FreeLoginHandler
{
    public $config;
    public function handle_group_test_conf($DV = array(), $R_ = array(), $FA = '', $Nm = false, $Xt = false)
    {
        $this->render_test_config_output($DV, false);
        if (!(!isset($R_["\x67\162\x6f\x75\x70\144\145\164\141\151\154\163\x75\162\154"]) || '' === $R_["\147\x72\157\165\160\x64\145\x74\141\x69\x6c\163\165\x72\154"])) {
            goto eom;
        }
        return;
        eom:
        $cf = array();
        $TU = $R_["\147\x72\157\165\160\144\145\x74\x61\151\154\x73\x75\162\x6c"];
        if (!('' === $FA)) {
            goto Yi5;
        }
        return;
        Yi5:
        if (!('' !== $TU)) {
            goto b2D;
        }
        $cf = $this->oauth_handler->get_resource_owner($TU, $FA);
        if (!($Xt && '' !== $Xt)) {
            goto d8n;
        }
        if (!(is_array($cf) && !empty($cf))) {
            goto sUM;
        }
        $this->render_test_config_output($cf, true);
        sUM:
        return;
        d8n:
        b2D:
    }
    public function handle_sso($zk, $R_, $DV, $G1, $fk, $sf = false)
    {
        global $NQ;
        $Ys = isset($R_["\165\163\x65\162\156\x61\155\145\x5f\141\x74\164\162"]) ? $R_["\165\x73\x65\162\156\x61\x6d\x65\x5f\x61\164\x74\162"] : '';
        $EB = isset($R_["\145\x6d\x61\151\154\137\141\164\x74\x72"]) ? $R_["\145\x6d\x61\x69\154\137\141\x74\x74\x72"] : '';
        $a8 = isset($R_["\146\151\162\163\x74\156\x61\155\145\x5f\x61\164\x74\162"]) ? $R_["\146\x69\162\163\164\156\x61\155\145\x5f\141\x74\x74\x72"] : '';
        $rI = isset($R_["\154\x61\x73\x74\x6e\141\x6d\x65\x5f\141\x74\x74\162"]) ? $R_["\154\141\163\164\156\x61\x6d\145\x5f\x61\x74\x74\162"] : '';
        $lN = isset($R_["\144\x69\x73\x70\x6c\x61\x79\137\141\164\164\x72"]) ? $R_["\144\151\163\x70\x6c\141\171\137\141\164\x74\x72"] : '';
        $wx = $NQ->getnestedattribute($DV, $Ys);
        $yY = $NQ->getnestedattribute($DV, $EB);
        $nn = $NQ->getnestedattribute($DV, $a8);
        $yt = $NQ->getnestedattribute($DV, $rI);
        $ug = $nn . "\x20" . $yt;
        $this->config = $NQ->mo_oauth_client_get_option("\155\157\137\x6f\x61\x75\164\150\x5f\143\154\x69\145\156\x74\x5f\x63\157\156\x66\151\x67");
        $this->config = !$this->config || empty($this->config) ? array() : $this->config->get_current_config();
        if (!empty($G1)) {
            goto gzV;
        }
        wp_die(wp_kses("\x54\x68\145\x20\163\x74\x61\x74\145\x20\160\x61\x72\141\155\x65\x74\x65\162\40\x69\x73\40\x65\155\x70\164\x79\56", \get_valid_html()));
        gzV:
        $Wf = new StorageManager($G1);
        do_action("\155\x6f\x5f\157\x61\x75\164\150\137\147\145\x74\137\165\163\x65\x72\137\x61\x74\x74\x72\163", $DV);
        if (empty($lN)) {
            goto kdi;
        }
        switch ($lN) {
            case "\x46\116\101\x4d\105":
                $ug = $nn;
                goto tvF;
            case "\x4c\x4e\101\115\105":
                $ug = $yt;
                goto tvF;
            case "\125\x53\105\x52\116\101\x4d\105":
                $ug = $wx;
                goto tvF;
            case "\114\116\x41\x4d\x45\x5f\106\x4e\x41\115\105":
                $ug = $yt . "\x20" . $nn;
            default:
                goto tvF;
        }
        cU7:
        tvF:
        kdi:
        if (!empty($wx)) {
            goto TgX;
        }
        $this->check_status(array("\155\163\147" => "\125\x73\145\162\x6e\x61\155\145\40\x6e\x6f\164\x20\162\145\x63\145\151\x76\145\144\x2e\x20\x43\150\x65\x63\x6b\x20\171\157\x75\162\x20\74\163\x74\162\157\156\x67\76\101\164\x74\162\x69\x62\165\x74\145\40\115\x61\160\160\151\156\147\x3c\57\163\x74\162\157\x6e\x67\76\x20\143\x6f\156\146\x69\x67\165\162\141\164\151\x6f\156\56", "\x63\157\144\145" => "\x55\116\101\115\105", "\x73\x74\x61\164\165\x73" => false, "\x61\160\160\x6c\x69\143\x61\x74\151\x6f\x6e" => $zk, "\145\x6d\141\x69\154" => '', "\165\163\145\x72\156\141\x6d\x65" => ''));
        TgX:
        if (!(!empty($yY) && false === strpos($yY, "\100"))) {
            goto slj;
        }
        $this->check_status(array("\x6d\163\147" => "\115\141\160\160\145\144\x20\x45\x6d\141\x69\x6c\40\141\x74\x74\162\x69\x62\165\164\145\x20\144\157\x65\163\x20\156\x6f\164\40\143\x6f\156\164\x61\151\x6e\x20\x76\141\154\x69\x64\40\145\155\141\151\x6c\56", "\143\x6f\x64\x65" => "\105\x4d\x41\x49\x4c", "\x73\x74\x61\164\165\163" => false, "\x61\x70\160\x6c\x69\x63\x61\164\151\157\x6e" => $zk, "\x63\154\x69\145\156\164\x5f\151\160" => $NQ->get_client_ip(), "\145\x6d\x61\151\154" => $yY, "\165\x73\145\x72\156\x61\155\x65" => $wx));
        slj:
        do_action("\155\157\x5f\157\141\x75\164\150\x5f\162\x65\x73\164\162\151\143\x74\137\145\x6d\x61\x69\x6c\x73", $yY, $this->config);
        $user = get_user_by("\154\157\147\151\156", $wx);
        if ($user) {
            goto xkR;
        }
        $user = get_user_by("\145\155\141\151\154", $yY);
        xkR:
        $ZN = $user ? $user->ID : 0;
        $Pr = 0 === $ZN;
        if (!(!(isset($this->config["\141\165\164\x6f\137\162\145\x67\151\x73\x74\145\x72"]) && 1 === intval($this->config["\141\x75\x74\x6f\137\162\145\147\151\163\164\145\162"])) && $Pr)) {
            goto niQ;
        }
        $this->check_status(array("\155\163\x67" => "\x52\x65\x67\x69\163\x74\x72\x61\164\x69\157\156\x20\151\163\x20\144\x69\163\x61\x62\x6c\145\144\x20\x66\x6f\x72\x20\x74\x68\x69\x73\x20\x73\x69\x74\145\x2e\40\x50\x6c\x65\x61\x73\145\40\x63\x6f\156\164\141\143\x74\40\x79\x6f\165\162\40\x61\144\x6d\x69\x6e\x69\163\164\162\141\164\x6f\x72", "\x63\x6f\144\145" => "\x52\105\x47\x49\123\124\122\x41\124\x49\x4f\116\137\104\111\x53\x41\102\114\105\104", "\x73\x74\x61\164\165\163" => false, "\141\160\160\154\x69\x63\x61\x74\151\x6f\156" => $zk, "\x63\154\151\x65\x6e\164\x5f\x69\160" => $NQ->get_client_ip(), "\145\x6d\141\x69\154" => $yY, "\165\x73\145\162\156\x61\x6d\x65" => $wx));
        niQ:
        if (!$Pr) {
            goto j_0;
        }
        $L9 = wp_generate_password(10, false);
        $ZN = wp_create_user($wx, $L9, $yY);
        do_action("\165\163\145\162\x5f\162\145\x67\151\163\164\x65\x72", $ZN);
        j_0:
        if (!($Pr || (!isset($this->config["\153\145\x65\x70\137\x65\170\x69\x73\x74\151\x6e\x67\137\165\163\x65\x72\x73"]) || 1 !== intval($this->config["\153\x65\x65\x70\x5f\x65\x78\x69\x73\x74\151\156\x67\x5f\165\163\x65\x72\x73"])))) {
            goto ZXl;
        }
        if (!is_wp_error($ZN)) {
            goto n4J;
        }
        $ZN = get_user_by("\154\x6f\x67\151\156", $wx)->ID;
        n4J:
        $SD = array("\x49\104" => $ZN, "\x66\x69\162\163\x74\137\156\141\155\145" => $nn, "\x6c\141\163\x74\137\x6e\141\x6d\145" => $yt, "\x64\x69\x73\160\154\x61\x79\x5f\x6e\x61\x6d\145" => $ug, "\x75\163\x65\x72\137\154\157\x67\151\x6e" => $wx, "\165\163\x65\x72\x5f\156\x69\143\145\156\x61\155\x65" => $wx);
        if (isset($this->config["\153\145\x65\x70\x5f\145\170\x69\x73\164\x69\x6e\147\137\145\155\141\151\154\x5f\x61\x74\x74\162"]) && 1 === intval($this->config["\x6b\145\x65\x70\x5f\x65\x78\151\x73\x74\x69\x6e\x67\137\145\155\141\151\154\137\141\164\x74\162"])) {
            goto A_j;
        }
        $SD["\165\163\x65\162\137\145\x6d\x61\x69\x6c"] = $yY;
        wp_update_user($SD);
        goto wOt;
        A_j:
        wp_update_user($SD);
        wOt:
        update_user_meta($ZN, "\155\x6f\x5f\157\141\x75\x74\x68\137\x62\x75\x64\x64\x79\160\x72\145\x73\163\137\x61\x74\x74\162\151\x62\165\164\145\x73", $DV);
        ZXl:
        $user = get_user_by("\111\104", $ZN);
        if (!is_multisite()) {
            goto Wq2;
        }
        $blog_id = $Wf->get_value("\142\x6c\x6f\147\x5f\151\144");
        $s8 = intval($NQ->mo_oauth_client_get_option("\156\157\117\x66\123\165\142\x53\151\x74\x65\x73"));
        $JQ = get_sites();
        if (!(count($JQ) > $s8)) {
            goto DIl;
        }
        $B_ = array_slice($JQ, $s8);
        foreach ($B_ as $jW) {
            if (!(intval($jW->blog_id) === $blog_id)) {
                goto YLW;
            }
            wp_die("\x59\x6f\x75\x20\150\141\x76\x65\40\156\157\164\x20\x75\160\x67\162\x61\x64\145\144\x20\x74\x6f\40\164\150\145\x20\143\x6f\x72\162\145\143\x74\x20\154\151\x63\x65\x6e\x73\145\40\160\154\141\x6e\56\x20\x45\151\x74\x68\145\162\x20\x79\x6f\165\x20\x68\141\x76\x65\40\160\165\x72\x63\150\x61\163\x65\x64\40\x66\x6f\162\x20\151\156\143\x6f\x72\x72\145\143\x74\x20\x6e\x6f\56\40\x6f\x66\40\163\x69\x74\x65\x73\x20\x6f\162\x20\x79\157\x75\x20\x68\141\x76\145\x20\x63\x72\x65\141\x74\145\x64\x20\x61\x20\156\145\x77\40\163\165\x62\x73\x69\164\x65\x2e\x20\x43\x6f\x6e\x74\141\143\x74\x20\x74\x6f\x20\x79\x6f\165\x72\x20\141\x64\155\151\156\x69\x73\x74\x72\141\164\x6f\x72\40\164\x6f\40\165\x70\x67\162\141\x64\x65\x20\171\x6f\x75\162\40\x73\x75\142\x73\151\164\x65\x2e");
            YLW:
            C9u:
        }
        E5X:
        DIl:
        add_user_to_blog($blog_id, $ZN, $user->roles);
        switch_to_blog($blog_id);
        Wq2:
        if ($user) {
            goto wjR;
        }
        return;
        wjR:
        $fQ = '';
        if (isset($this->config["\x61\x66\164\145\x72\137\x6c\157\147\x69\156\137\165\x72\154"]) && '' !== $this->config["\141\146\164\145\162\137\154\157\147\x69\x6e\137\165\162\x6c"]) {
            goto BLO;
        }
        $hd = $Wf->get_value("\162\x65\x64\x69\x72\x65\143\164\x5f\x75\162\151");
        $fQ = rawurldecode($hd && '' !== $hd ? $hd : site_url());
        goto bBy;
        BLO:
        $fQ = $this->config["\141\146\x74\145\x72\x5f\x6c\x6f\147\151\x6e\137\x75\162\154"];
        bBy:
        do_action("\x6d\157\137\157\x61\x75\164\150\137\x63\x6c\x69\x65\156\164\137\x6d\141\160\137\162\x6f\x6c\145\163", array("\x75\163\145\x72\x5f\x69\x64" => $ZN, "\141\x70\x70\x5f\143\157\x6e\x66\x69\147" => $R_, "\x6e\145\x77\x5f\x75\x73\x65\x72" => $Pr, "\162\145\x73\157\165\x72\143\x65\x5f\157\167\x6e\x65\x72" => $DV));
        do_action("\155\157\x5f\x6f\x61\165\x74\x68\x5f\154\x6f\x67\x67\x65\144\x5f\x69\156\x5f\165\x73\145\162\137\x74\157\x6b\145\x6e", $user, $fk);
        $this->check_status(array("\x6d\163\x67" => "\x4c\157\147\x69\x6e\40\x53\165\x63\143\145\163\x73\x66\x75\154\x21", "\143\157\144\145" => "\114\117\107\111\116\137\123\125\103\103\105\x53\123", "\x73\x74\141\164\165\x73" => true, "\x61\160\x70\x6c\x69\143\141\x74\151\157\156" => $zk, "\x63\x6c\151\x65\156\164\137\x69\160" => $NQ->get_client_ip(), "\156\141\x76\x69\x67\x61\164\151\x6f\156\x75\162\154" => $fQ, "\x65\155\x61\151\x6c" => $yY, "\x75\163\145\162\156\x61\155\x65" => $wx));
        if (!$sf) {
            goto BQS;
        }
        return $user;
        BQS:
        update_user_meta($user->ID, "\155\x6f\x5f\157\141\165\164\x68\137\143\x6c\x69\145\x6e\x74\137\154\141\x73\164\137\x69\x64\137\164\157\x6b\x65\x6e", isset($fk["\151\x64\x5f\x74\157\153\x65\156"]) ? $fk["\x69\x64\x5f\164\x6f\x6b\x65\156"] : false);
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        do_action("\x77\x70\137\x6c\x6f\x67\151\156", $user->user_login, $user);
        $ng = $Wf->get_value("\x72\x65\163\x74\x72\151\x63\164\162\x65\x64\x69\x72\x65\143\x74") !== false;
        $qP = $Wf->get_value("\x70\x6f\x70\x75\x70") === "\x69\x67\156\x6f\x72\145";
        if (isset($this->config["\160\157\160\x75\160\x5f\154\157\x67\151\156"]) && 1 === intval($this->config["\x70\157\160\x75\160\x5f\154\157\x67\151\x6e"]) && !$qP && !boolval($ng)) {
            goto Ixo;
        }
        wp_redirect($fQ);
        goto ulR;
        Ixo:
        echo "\74\x73\x63\162\x69\x70\164\x3e\167\x69\156\x64\x6f\167\56\157\160\x65\x6e\x65\x72\56\x48\141\156\x64\x6c\x65\120\157\160\x75\x70\x52\x65\163\x75\154\x74\50\42" . $fQ . "\42\51\x3b\x77\x69\156\x64\157\x77\x2e\143\x6c\x6f\163\145\x28\51\73\x3c\x2f\163\x63\162\151\x70\x74\x3e";
        ulR:
        die;
    }
    public function check_status($NC)
    {
        if (isset($NC["\163\164\141\x74\x75\163"])) {
            goto m8R;
        }
        wp_die(wp_kses("\x53\157\x6d\x65\x74\x68\x69\x6e\147\x20\x77\x65\156\164\40\x77\x72\157\x6e\x67\56\x20\x50\x6c\145\x61\x73\145\x20\x74\x72\171\x20\114\157\147\147\x69\156\x67\40\x69\x6e\40\x61\x67\x61\151\156\56", \get_valid_html()));
        m8R:
        if (!(isset($NC["\x73\x74\x61\164\x75\x73"]) && true === $NC["\x73\x74\141\x74\x75\163"] && (isset($NC["\143\x6f\144\145"]) && "\114\x4f\x47\x49\116\137\x53\x55\x43\103\105\x53\x53" === $NC["\x63\157\x64\145"]))) {
            goto vrG;
        }
        return true;
        vrG:
        if (!(true !== $NC["\163\164\x61\x74\x75\x73"])) {
            goto AED;
        }
        $as = isset($NC["\x6d\x73\x67"]) && !empty($NC["\x6d\x73\147"]) ? $NC["\x6d\163\147"] : "\x53\x6f\x6d\145\164\150\151\156\147\x20\x77\x65\156\164\x20\x77\x72\x6f\156\147\56\40\x50\x6c\145\141\163\x65\40\164\x72\171\x20\114\157\147\x67\151\x6e\147\40\151\x6e\40\x61\147\141\x69\x6e\56";
        wp_die(wp_kses($as, \get_valid_html()));
        die;
        AED:
    }
}
