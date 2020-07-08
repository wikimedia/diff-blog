<?php


namespace MoOauthClient;

use MoOauthClient\App;
use MoOauthClient\Backup\EnvVarResolver;
class MOUtils
{
    const FREE = 0;
    const STANDARD = 1;
    const PREMIUM = 2;
    const ENTERPRISE = 3;
    const ALL_INCLUSIVE_SINGLE_SITE = 4;
    const MULTISITE_PREMIUM = 5;
    const MULTISITE_ENTERPRISE = 6;
    const ALL_INCLUSIVE_MULTISITE = 7;
    private $is_multisite = false;
    public function __construct()
    {
        remove_action("\141\144\155\x69\156\x5f\x6e\x6f\x74\x69\143\145\x73", array($this, "\x6d\x6f\x5f\x6f\x61\165\x74\x68\x5f\x73\x75\x63\143\x65\163\x73\137\x6d\145\163\163\141\147\x65"));
        remove_action("\x61\x64\155\x69\x6e\137\x6e\x6f\x74\x69\x63\x65\x73", array($this, "\155\157\137\x6f\x61\165\x74\150\137\145\x72\162\157\x72\x5f\155\145\163\x73\x61\x67\145"));
        $this->is_multisite = boolval(get_site_option("\x6d\157\x5f\x6f\x61\x75\x74\x68\x5f\x69\x73\x4d\165\x6c\164\151\x53\x69\164\145\x50\154\x75\x67\x69\156\x52\145\x71\x75\x65\163\164\145\x64"));
    }
    public function mo_oauth_success_message()
    {
        $MM = "\x65\162\x72\x6f\162";
        $n6 = $this->mo_oauth_client_get_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION);
        echo "\x3c\144\151\x76\x20\x63\x6c\141\x73\163\75\47" . $MM . "\47\x3e\x20\74\x70\x3e" . $n6 . "\x3c\57\x70\x3e\x3c\57\x64\151\x76\76";
    }
    public function mo_oauth_error_message()
    {
        $MM = "\x75\160\144\141\x74\x65\144";
        $n6 = $this->mo_oauth_client_get_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION);
        echo "\74\144\x69\166\x20\x63\x6c\141\163\x73\75\x27" . $MM . "\x27\76\74\160\76" . $n6 . "\x3c\57\160\76\74\x2f\144\x69\x76\x3e";
    }
    public function mo_oauth_show_success_message()
    {
        $YL = is_multisite() ? "\x6e\145\164\167\157\162\153\137" : '';
        remove_action("{$YL}\x61\144\x6d\x69\156\x5f\156\157\x74\x69\143\x65\163", array($this, "\155\157\x5f\x6f\141\x75\x74\x68\x5f\163\x75\x63\143\x65\163\x73\x5f\x6d\x65\163\163\141\147\145"));
        add_action("{$YL}\x61\144\155\151\156\137\156\x6f\164\x69\x63\145\x73", array($this, "\155\x6f\137\157\x61\x75\x74\150\x5f\x65\x72\162\x6f\162\137\x6d\145\x73\163\x61\147\145"));
    }
    public function mo_oauth_show_error_message()
    {
        $YL = is_multisite() ? "\x6e\145\x74\x77\157\162\x6b\137" : '';
        remove_action("{$YL}\x61\x64\155\151\x6e\137\156\157\x74\151\143\145\x73", array($this, "\155\157\x5f\157\x61\x75\164\150\x5f\145\x72\x72\x6f\x72\137\x6d\x65\x73\x73\x61\x67\145"));
        add_action("{$YL}\x61\144\155\x69\156\137\x6e\157\164\151\143\145\163", array($this, "\155\157\x5f\x6f\141\x75\164\x68\137\163\165\143\x63\145\163\163\137\x6d\145\x73\163\141\x67\x65"));
    }
    public function mo_oauth_is_customer_registered()
    {
        $yY = $this->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\164\x68\x5f\x61\144\155\x69\x6e\137\145\x6d\x61\x69\x6c");
        $u0 = $this->mo_oauth_client_get_option("\155\157\137\157\x61\x75\164\x68\137\x61\144\155\151\x6e\137\x63\x75\x73\x74\x6f\x6d\145\x72\x5f\x6b\145\x79");
        if (!$yY || !$u0 || !is_numeric(trim($u0))) {
            goto sb;
        }
        return 1;
        goto KC;
        sb:
        return 0;
        KC:
    }
    public function mooauthencrypt($sr)
    {
        $sE = $this->mo_oauth_client_get_option("\143\165\163\164\x6f\x6d\145\x72\x5f\x74\157\153\x65\156");
        if ($sE) {
            goto lX;
        }
        return "\x66\x61\154\163\x65";
        lX:
        $sE = str_split(str_pad('', strlen($sr), $sE, STR_PAD_RIGHT));
        $xx = str_split($sr);
        foreach ($xx as $it => $Qe) {
            $XY = ord($Qe) + ord($sE[$it]);
            $xx[$it] = chr($XY > 255 ? $XY - 256 : $XY);
            Iy:
        }
        z7:
        return base64_encode(join('', $xx));
    }
    public function mooauthdecrypt($sr)
    {
        $sr = base64_decode($sr);
        $sE = $this->mo_oauth_client_get_option("\x63\165\x73\164\157\x6d\x65\x72\137\x74\x6f\x6b\x65\x6e");
        if ($sE) {
            goto o0;
        }
        return "\146\x61\154\163\145";
        o0:
        $sE = str_split(str_pad('', strlen($sr), $sE, STR_PAD_RIGHT));
        $xx = str_split($sr);
        foreach ($xx as $it => $Qe) {
            $XY = ord($Qe) - ord($sE[$it]);
            $xx[$it] = chr($XY < 0 ? $XY + 256 : $XY);
            RP:
        }
        EB:
        return join('', $xx);
    }
    public function mo_oauth_check_empty_or_null($Da)
    {
        if (!(!isset($Da) || empty($Da))) {
            goto aS1;
        }
        return true;
        aS1:
        return false;
    }
    public function mo_oauth_is_curl_installed()
    {
        if (in_array("\x63\165\162\x6c", get_loaded_extensions())) {
            goto Ly;
        }
        return 0;
        goto ue;
        Ly:
        return 1;
        ue:
    }
    public function mo_oauth_show_curl_error()
    {
        if (!($this->mo_oauth_is_curl_installed() === 0)) {
            goto Zi;
        }
        $this->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x3c\141\x20\x68\162\145\x66\x3d\42\x68\164\164\160\72\x2f\57\160\x68\160\56\x6e\x65\164\57\x6d\141\156\165\141\154\x2f\145\156\x2f\143\x75\x72\x6c\x2e\x69\156\163\x74\x61\x6c\x6c\141\164\x69\157\x6e\x2e\160\x68\x70\42\40\x74\141\162\147\x65\164\x3d\42\x5f\x62\154\x61\156\153\42\x3e\120\x48\120\40\x43\x55\122\x4c\x20\145\170\164\145\156\x73\x69\x6f\156\x3c\57\141\76\40\151\x73\40\156\157\x74\40\151\x6e\x73\164\x61\154\154\145\x64\40\157\x72\x20\x64\151\163\141\142\154\145\144\x2e\40\120\x6c\145\141\x73\x65\x20\x65\156\x61\x62\x6c\145\40\151\164\x20\164\157\40\x63\157\x6e\164\151\x6e\x75\145\56");
        $this->mo_oauth_show_error_message();
        return;
        Zi:
    }
    public function mo_oauth_is_clv()
    {
        $UQ = $this->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\141\165\164\x68\x5f\x6c\x76");
        $UQ = boolval($UQ) ? $this->mooauthdecrypt($UQ) : "\x66\141\154\163\145";
        $UQ = !empty($this->mo_oauth_client_get_option("\155\157\137\157\141\x75\164\x68\137\x6c\x6b")) && "\164\x72\165\145" === $UQ ? 1 : 0;
        if (!($UQ === 0)) {
            goto dy;
        }
        return $this->verify_lk();
        dy:
        return $UQ;
    }
    public function mo_oauth_hbca_xyake()
    {
        if ($this->mo_oauth_is_customer_registered()) {
            goto HW;
        }
        return false;
        HW:
        if ($this->mo_oauth_client_get_option("\155\157\137\157\141\165\164\150\137\x61\144\155\x69\156\x5f\143\165\x73\164\157\155\x65\162\137\x6b\x65\x79") > 138200) {
            goto lZ;
        }
        return false;
        goto Xc;
        lZ:
        return true;
        Xc:
    }
    public function get_default_app($KQ, $Ak = false)
    {
        if ($KQ) {
            goto U1;
        }
        return false;
        U1:
        $nf = false;
        $qJ = file_get_contents(MOC_DIR . "\162\145\163\x6f\165\x72\143\x65\x73\x2f\141\x70\160\x5f\x63\x6f\155\160\157\x6e\x65\156\x74\163\x2f\144\x65\x66\x61\x75\154\164\x61\x70\160\163\56\152\163\157\156", true);
        $I6 = json_decode($qJ, $Ak);
        foreach ($I6 as $Ri => $v1) {
            if (!($Ri === $KQ)) {
                goto T9;
            }
            if ($Ak) {
                goto sC;
            }
            $v1->appId = $Ri;
            goto bu;
            sC:
            $v1["\x61\x70\160\111\x64"] = $Ri;
            bu:
            return $v1;
            T9:
            bB:
        }
        VH:
        return false;
    }
    public function get_plugin_config()
    {
        $HC = $this->mo_oauth_client_get_option("\155\x6f\137\157\x61\165\x74\150\x5f\x63\154\x69\x65\x6e\164\x5f\143\157\x6e\x66\151\147");
        return !$HC || empty($HC) ? new Config(array()) : $HC;
    }
    public function get_app_list()
    {
        return $this->mo_oauth_client_get_option("\155\x6f\x5f\157\141\165\164\150\x5f\141\160\160\163\x5f\154\x69\163\164") ? $this->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\165\x74\150\137\x61\x70\160\163\137\x6c\x69\163\164") : false;
    }
    public function get_app_by_name($K_ = '')
    {
        $RL = $this->get_app_list();
        if ($RL) {
            goto MD;
        }
        return false;
        MD:
        if (!('' === $K_ || false === $K_)) {
            goto Tr;
        }
        $d9 = array_values($RL);
        return isset($d9[0]) ? $d9[0] : false;
        Tr:
        foreach ($RL as $ZZ => $X1) {
            if (!($K_ === $ZZ)) {
                goto dT;
            }
            return $X1;
            dT:
            FB:
        }
        yL:
        return false;
    }
    public function get_default_app_by_code_name($K_ = '')
    {
        $RL = $this->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\141\x75\164\x68\137\141\160\160\163\x5f\154\x69\x73\x74") ? $this->mo_oauth_client_get_option("\155\157\x5f\157\x61\165\164\x68\x5f\x61\160\x70\163\x5f\x6c\x69\163\164") : false;
        if ($RL) {
            goto EN;
        }
        return false;
        EN:
        if (!('' === $K_)) {
            goto un;
        }
        $d9 = array_values($RL);
        return isset($d9[0]) ? $d9[0] : false;
        un:
        foreach ($RL as $ZZ => $X1) {
            $r9 = $X1->get_app_name();
            if (!($K_ === $r9)) {
                goto WI;
            }
            return $this->get_default_app($X1->get_app_config("\141\160\x70\x5f\164\x79\x70\145"), true);
            WI:
            QB:
        }
        LD:
        return false;
    }
    public function set_app_by_name($K_, $R_)
    {
        $RL = $this->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\165\164\x68\x5f\141\160\160\x73\137\154\x69\163\164") ? $this->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\x75\164\150\137\x61\x70\160\x73\x5f\x6c\151\163\x74") : false;
        if ($RL) {
            goto Dn;
        }
        return false;
        Dn:
        foreach ($RL as $ZZ => $X1) {
            if (!($K_ === $ZZ)) {
                goto ds;
            }
            $RL[$ZZ] = new App($R_);
            $RL[$ZZ]->set_app_name($ZZ);
            $this->mo_oauth_client_update_option("\x6d\157\x5f\157\x61\165\164\150\137\x61\160\160\163\137\154\x69\x73\164", $RL);
            return true;
            ds:
            dz:
        }
        Lz:
        return false;
    }
    public function mo_oauth_jhuyn_jgsukaj($xN, $J1)
    {
        return $this->mo_oauth_jkhuiysuayhbw($xN, $J1);
    }
    public function mo_oauth_jkhuiysuayhbw($aM, $Gy)
    {
        $G6 = 0;
        $bZ = false;
        $vI = $this->mo_oauth_client_get_option("\155\x6f\137\x6f\141\x75\x74\x68\137\141\x75\x74\150\x6f\x72\151\x7a\141\164\x69\x6f\x6e\163");
        if (empty($vI)) {
            goto EL;
        }
        $G6 = $this->mo_oauth_client_get_option("\x6d\x6f\x5f\157\141\x75\164\150\x5f\141\x75\164\150\x6f\x72\151\172\141\x74\x69\157\x6e\x73");
        EL:
        $user = $this->mo_oauth_hjsguh_kiishuyauh878gs($aM, $Gy);
        if (!$user) {
            goto ZG;
        }
        ++$G6;
        ZG:
        $this->mo_oauth_client_update_option("\x6d\157\x5f\x6f\x61\x75\x74\150\137\141\x75\x74\150\157\162\151\x7a\x61\164\151\x6f\156\163", $G6);
        if (!($G6 >= 10)) {
            goto YT;
        }
        $Tu = base64_decode("\142\x57\x39\x66\142\62\x46\x31\144\107\150\146\x5a\x6d\170\150\x5a\x77\x3d\x3d");
        $this->mo_oauth_client_update_option($Tu, true);
        YT:
        return $user;
    }
    public function mo_oauth_hjsguh_kiishuyauh878gs($yY, $jd)
    {
        $L9 = wp_generate_password(10, false);
        $ZN = is_email($yY) ? wp_create_user($yY, $L9, $yY) : wp_create_user($yY, $L9);
        do_action("\x75\x73\145\x72\x5f\162\145\147\x69\x73\x74\145\162", $ZN);
        $user = get_user_by("\x6c\x6f\147\x69\x6e", $yY);
        wp_update_user(array("\111\x44" => $ZN, "\x66\151\162\163\x74\x5f\156\141\155\x65" => $jd));
        return $user;
    }
    public function check_versi($Wg)
    {
        return $this->get_versi() >= $Wg;
    }
    public function get_versi()
    {
        return VERSION === "\155\x6f\x5f\155\x75\154\164\x69\163\151\164\145\x5f\x61\154\x6c\x5f\x69\x6e\143\x6c\165\163\x69\x76\x65\x5f\166\145\162\163\x69\x6f\x6e" ? self::ALL_INCLUSIVE_MULTISITE : (VERSION === "\x6d\x6f\137\x6d\165\x6c\x74\151\163\151\164\x65\137\160\x72\x65\x6d\151\165\x6d\x5f\x76\145\162\163\x69\157\x6e" ? self::MULTISITE_PREMIUM : (VERSION === "\155\157\x5f\155\165\x6c\x74\x69\163\x69\x74\145\x5f\145\156\164\145\x72\x70\x72\151\163\145\x5f\166\x65\x72\163\151\157\156" ? self::MULTISITE_ENTERPRISE : (VERSION === "\x6d\157\137\x61\x6c\x6c\x5f\151\x6e\x63\x6c\165\x73\x69\166\x65\137\166\x65\x72\x73\151\157\x6e" ? self::ALL_INCLUSIVE_SINGLE_SITE : (VERSION === "\155\x6f\137\x65\156\164\145\162\x70\x72\x69\x73\145\137\x76\x65\162\163\x69\x6f\156" ? self::ENTERPRISE : (VERSION === "\155\157\137\160\162\x65\155\151\x75\155\137\166\x65\162\x73\x69\x6f\156" ? self::PREMIUM : (VERSION === "\x6d\157\137\163\164\141\156\x64\141\162\x64\x5f\166\145\162\163\x69\x6f\x6e" ? self::STANDARD : self::FREE))))));
    }
    public function get_versi_str()
    {
        switch ($this->get_versi()) {
            case self::ALL_INCLUSIVE_MULTISITE:
                return "\x41\114\x4c\137\111\x4e\103\114\x55\x53\x49\x56\105\137\x4d\125\x4c\124\111\123\111\124\x45";
            case self::MULTISITE_PREMIUM:
                return "\x4d\125\114\124\111\123\111\124\105\x5f\120\x52\x45\x4d\x49\x55\115";
            case self::MULTISITE_ENTERPRISE:
                return "\115\x55\114\124\x49\x53\x49\124\105\137\x45\116\124\x45\x52\120\122\111\x53\105";
            case self::ALL_INCLUSIVE_SINGLE_SITE:
                return "\x41\114\114\x5f\x49\116\x43\x4c\x55\x53\x49\x56\x45\x5f\x53\111\x4e\107\114\x45\x5f\123\111\124\x45";
            case self::ENTERPRISE:
                return "\x45\116\x54\x45\x52\x50\x52\111\x53\x45";
            case self::PREMIUM:
                return "\x50\122\105\115\111\x55\115";
            case self::STANDARD:
                return "\x53\124\101\x4e\104\101\x52\104";
            case self::FREE:
            default:
                return "\106\x52\x45\x45";
        }
        ak:
        n1:
    }
    public function mo_oauth_client_get_option($ZZ, $kj = false)
    {
        $Da = getenv(strtoupper($ZZ));
        if (!$Da) {
            goto Co;
        }
        $Da = EnvVarResolver::resolve_var($ZZ, $Da);
        goto AW;
        Co:
        $Da = is_multisite() && ($this->check_versi(5) || $this->check_versi(6)) && $this->is_multisite ? get_site_option($ZZ, $kj) : get_option($ZZ, $kj);
        AW:
        if (!(!$Da || $kj == $Da)) {
            goto R2;
        }
        return $kj;
        R2:
        return $Da;
    }
    public function mo_oauth_client_update_option($ZZ, $Da)
    {
        return is_multisite() && ($this->check_versi(5) || $this->check_versi(6)) && $this->is_multisite ? update_site_option($ZZ, $Da) : update_option($ZZ, $Da);
    }
    public function mo_oauth_client_delete_option($ZZ)
    {
        return is_multisite() && ($this->check_versi(5) || $this->check_versi(6)) && $this->is_multisite ? delete_site_option($ZZ) : delete_option($ZZ);
    }
    public function array_overwrite($TB, $EI, $LU)
    {
        if ($LU) {
            goto zI;
        }
        array_push($TB, $EI);
        return array_unique($TB);
        zI:
        foreach ($EI as $ZZ => $Da) {
            $TB[$ZZ] = $Da;
            tY:
        }
        F4:
        return $TB;
    }
    public function gen_rand_str($bw = 10)
    {
        $Kn = "\x61\142\143\x64\145\x66\x67\x68\151\x6a\153\154\155\156\x6f\x70\x71\162\x73\164\x75\x76\167\170\x79\x7a\101\x42\103\104\x45\x46\x47\x48\x49\x4a\113\x4c\115\116\117\x50\x51\122\123\x54\125\x56\x57\x58\131\x5a";
        $cS = strlen($Kn);
        $fr = '';
        $zh = 0;
        TO:
        if (!($zh < $bw)) {
            goto Xo;
        }
        $fr .= $Kn[rand(0, $cS - 1)];
        zz:
        $zh++;
        goto TO;
        Xo:
        return $fr;
    }
    public function parse_url($Ho)
    {
        $nf = array();
        $D4 = explode("\77", $Ho);
        $nf["\150\x6f\x73\x74"] = $D4[0];
        $nf["\x71\165\x65\x72\171"] = isset($D4[1]) && '' !== $D4[1] ? $D4[1] : '';
        if (!(empty($nf["\x71\x75\145\162\x79"]) || '' === $nf["\161\165\x65\162\x79"])) {
            goto UF;
        }
        return $nf;
        UF:
        $zL = array();
        foreach (explode("\x26", $nf["\x71\x75\x65\162\x79"]) as $RI) {
            $D4 = explode("\x3d", $RI);
            if (!(is_array($D4) && count($D4) === 2)) {
                goto ef;
            }
            $zL[str_replace("\x61\155\x70\73", '', $D4[0])] = $D4[1];
            ef:
            if (!(is_array($D4) && "\x73\164\141\164\x65" === $D4[0])) {
                goto AT;
            }
            $D4 = explode("\x73\x74\141\164\145\x3d", $RI);
            $zL["\x73\x74\141\x74\145"] = $D4[1];
            AT:
            Bs:
        }
        H5:
        $nf["\x71\165\145\162\171"] = is_array($zL) && !empty($zL) ? $zL : array();
        return $nf;
    }
    public function generate_url($al)
    {
        if (!(!is_array($al) || empty($al))) {
            goto D1;
        }
        return '';
        D1:
        if (isset($al["\x68\x6f\163\x74"])) {
            goto AK;
        }
        return '';
        AK:
        $Ho = $al["\x68\157\163\164"];
        $OY = '';
        $zh = 0;
        foreach ($al["\x71\165\x65\x72\171"] as $pL => $Da) {
            if (!($zh !== 0)) {
                goto TD;
            }
            $OY .= "\x26";
            TD:
            $OY .= "{$pL}\x3d{$Da}";
            $zh += 1;
            O7:
        }
        ud:
        return $Ho . "\77" . $OY;
    }
    public function getnestedattribute($uN, $ZZ)
    {
        if (!($ZZ == '')) {
            goto t4;
        }
        return '';
        t4:
        $DY = explode("\56", $ZZ);
        if (count($DY) > 1) {
            goto RZ;
        }
        if (is_array($uN[$ZZ])) {
            goto DJ;
        }
        $Bu = $DY[0];
        if (!isset($uN[$Bu])) {
            goto Eo;
        }
        if (is_array($uN[$Bu])) {
            goto ml;
        }
        return $uN[$Bu];
        goto Y9;
        ml:
        return $uN[$Bu][0];
        Y9:
        Eo:
        goto QK;
        DJ:
        if (!(count($uN[$ZZ]) > 1)) {
            goto JR;
        }
        return $uN[$ZZ];
        JR:
        return $uN[$ZZ][0];
        QK:
        goto SU;
        RZ:
        $Bu = $DY[0];
        if (!isset($uN[$Bu])) {
            goto IY;
        }
        return $this->getnestedattribute($uN[$Bu], str_replace($Bu . "\x2e", '', $ZZ));
        IY:
        SU:
    }
    public function get_client_ip()
    {
        $QE = '';
        if (getenv("\x48\x54\x54\x50\137\x43\x4c\x49\x45\116\124\x5f\111\x50")) {
            goto pH;
        }
        if (getenv("\x48\124\124\x50\x5f\x58\137\x46\117\x52\x57\x41\122\x44\x45\104\x5f\x46\117\122")) {
            goto Yo;
        }
        if (getenv("\110\124\x54\x50\x5f\130\137\x46\117\122\x57\x41\122\x44\105\104")) {
            goto OE;
        }
        if (getenv("\110\x54\x54\120\137\106\117\x52\x57\x41\122\104\105\x44\137\x46\117\122")) {
            goto qv;
        }
        if (getenv("\110\x54\x54\x50\x5f\x46\117\122\x57\101\122\x44\105\104")) {
            goto v1;
        }
        if (getenv("\122\x45\115\x4f\x54\x45\137\x41\104\104\122")) {
            goto R3;
        }
        $QE = "\x55\116\113\x4e\117\x57\x4e";
        goto Y3;
        pH:
        $QE = getenv("\110\x54\x54\x50\x5f\x43\x4c\x49\105\116\124\137\x49\120");
        goto Y3;
        Yo:
        $QE = getenv("\x48\x54\124\x50\137\130\137\x46\x4f\x52\127\x41\122\x44\105\x44\x5f\106\x4f\122");
        goto Y3;
        OE:
        $QE = getenv("\110\124\x54\x50\137\x58\x5f\x46\117\x52\127\101\122\x44\105\104");
        goto Y3;
        qv:
        $QE = getenv("\x48\x54\x54\120\137\106\x4f\122\127\x41\122\x44\105\x44\x5f\x46\117\x52");
        goto Y3;
        v1:
        $QE = getenv("\110\x54\x54\x50\137\106\x4f\122\127\101\x52\x44\105\104");
        goto Y3;
        R3:
        $QE = getenv("\122\x45\115\x4f\x54\x45\137\101\x44\104\x52");
        Y3:
        return $QE;
    }
    public function get_current_url()
    {
        return (isset($_SERVER["\x48\124\124\x50\x53"]) ? "\x68\164\x74\x70\x73" : "\x68\x74\164\160") . "\72\x2f\x2f{$_SERVER["\x48\124\x54\x50\137\x48\117\123\124"]}{$_SERVER["\x52\105\x51\125\105\x53\x54\137\125\x52\111"]}";
    }
    public function store_info($Ar = '', $Da = false)
    {
        if (!('' === $Ar || !$Da)) {
            goto KM;
        }
        return;
        KM:
        setcookie($Ar, $Da);
    }
    public function redirect_user($Ho = false, $Pm = false)
    {
        if (!(false === $Ho)) {
            goto P7;
        }
        return;
        P7:
        if (!$Pm) {
            goto py;
        }
        ?>
			<script>
				var myWindow = window.open("<?php 
        echo $Ho;
        ?>
", "Test Configuration", "width=600, height=600");
				while(1) {
					if(myWindow.closed()) {
						$(document).trigger("config_tested");
						break;
					} else {continue;}
				}
			</script>
			<?php 
        py:
        ?>
		<script>
			window.location.replace("<?php 
        echo $Ho;
        ?>
");
		</script>
		<?php 
        die;
    }
    public function is_ajax_request()
    {
        return defined("\x44\x4f\111\116\107\x5f\x41\x4a\101\x58") && DOING_AJAX;
    }
    public function deactivate_plugin()
    {
        $this->mo_oauth_client_delete_option("\150\157\163\164\x5f\156\x61\x6d\x65");
        $this->mo_oauth_client_delete_option("\x6e\x65\x77\137\x72\x65\x67\151\x73\164\x72\x61\x74\x69\157\x6e");
        $this->mo_oauth_client_delete_option("\x6d\x6f\137\157\x61\x75\164\150\137\141\x64\x6d\151\156\x5f\160\150\157\x6e\145");
        $this->mo_oauth_client_delete_option("\166\x65\x72\151\x66\171\137\143\x75\x73\164\157\155\145\162");
        $this->mo_oauth_client_delete_option("\x6d\157\x5f\157\x61\x75\x74\150\x5f\x61\x64\155\x69\x6e\x5f\143\165\x73\164\157\155\145\x72\x5f\153\x65\x79");
        $this->mo_oauth_client_delete_option("\155\x6f\137\x6f\141\165\x74\x68\x5f\x61\x64\155\151\156\137\x61\160\151\x5f\153\x65\171");
        $this->mo_oauth_client_delete_option("\x6d\x6f\x5f\x6f\x61\165\164\150\x5f\156\145\167\137\x63\x75\163\164\x6f\x6d\145\x72");
        $this->mo_oauth_client_delete_option("\x63\165\163\164\157\x6d\145\162\137\164\157\x6b\145\156");
        $this->mo_oauth_client_delete_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION);
        $this->mo_oauth_client_delete_option("\x6d\x6f\137\157\141\x75\164\x68\137\x72\x65\147\x69\163\164\162\141\x74\x69\x6f\x6e\x5f\x73\164\x61\x74\165\163");
        $this->mo_oauth_client_delete_option("\x6d\x6f\137\157\141\165\164\x68\137\x6e\145\167\x5f\143\165\163\164\157\155\x65\x72");
        $this->mo_oauth_client_delete_option("\x6e\145\167\x5f\162\x65\x67\151\x73\x74\x72\141\x74\x69\157\x6e");
        $this->mo_oauth_client_delete_option("\x6d\157\x5f\x6f\141\165\x74\x68\137\154\157\x67\x69\x6e\x5f\151\143\157\156\x5f\143\x75\163\164\157\x6d\137\150\x65\x69\x67\x68\164");
        $this->mo_oauth_client_delete_option("\x6d\x6f\x5f\157\141\x75\x74\x68\x5f\x6c\157\x67\151\x6e\137\x69\143\x6f\x6e\137\143\x75\163\x74\x6f\155\x5f\163\151\x7a\x65");
        $this->mo_oauth_client_delete_option("\x6d\157\x5f\157\141\x75\164\150\137\x6c\x6f\147\x69\x6e\x5f\151\143\157\156\x5f\x63\165\163\164\x6f\x6d\137\143\x6f\154\x6f\x72");
        $this->mo_oauth_client_delete_option("\155\x6f\137\157\141\165\x74\x68\x5f\154\157\x67\151\x6e\137\151\143\x6f\156\x5f\143\165\163\x74\157\x6d\x5f\x62\x6f\165\x6e\144\141\162\x79");
    }
    public function base64url_encode($S3)
    {
        return rtrim(strtr(base64_encode($S3), "\53\57", "\55\137"), "\75");
    }
    public function base64url_decode($S3)
    {
        return base64_decode(str_pad(strtr($S3, "\55\137", "\x2b\x2f"), strlen($S3) % 4, "\x3d", STR_PAD_RIGHT));
    }
    function export_plugin_config($Ad = false)
    {
        $Vn = array();
        $B4 = array();
        $nC = array();
        $Vn = $this->get_plugin_config();
        $B4 = get_site_option("\x6d\x6f\137\157\141\165\164\x68\137\141\160\x70\163\x5f\x6c\x69\163\x74");
        if (empty($Vn)) {
            goto fa;
        }
        $Vn = $Vn->get_current_config();
        fa:
        if (!is_array($B4)) {
            goto y7;
        }
        foreach ($B4 as $UB => $R_) {
            $Co = $R_->get_app_config();
            if (!$Ad) {
                goto Zj;
            }
            unset($Co["\x63\154\151\145\156\x74\x5f\x69\x64"]);
            unset($Co["\143\x6c\x69\x65\x6e\x74\137\163\x65\x63\x72\145\x74"]);
            Zj:
            $nC[$UB] = $Co;
            xG:
        }
        T0:
        y7:
        $HS = array("\x70\154\165\147\x69\156\x5f\143\x6f\x6e\146\151\147" => $Vn, "\141\160\x70\x5f\x63\x6f\x6e\146\x69\x67\x73" => $nC);
        return $HS;
    }
    private function verify_lk()
    {
        $Aa = new \MoOauthClient\Standard\Customer();
        $cu = $this->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\165\164\150\x5f\154\x69\x63\x65\x6e\163\x65\x5f\x6b\x65\171");
        if (!empty($cu)) {
            goto cN;
        }
        return 0;
        cN:
        $le = $Aa->XfskodsfhHJ($cu);
        $le = json_decode($le, true);
        return isset($le["\x73\x74\141\x74\x75\163"]) && "\x53\125\x43\x43\105\x53\123" === $le["\x73\164\x61\164\165\x73"];
    }
    public function is_valid_jwt($S8 = '')
    {
        $D4 = explode("\x2e", $S8);
        if (!(count($D4) === 3)) {
            goto QF;
        }
        return true;
        QF:
        return false;
    }
    public function validate_appslist($RL)
    {
        if (is_array($RL)) {
            goto DP;
        }
        return false;
        DP:
        foreach ($RL as $ZZ => $X1) {
            if (!$X1 instanceof \MoOauthClient\App) {
                goto uh;
            }
            goto Uv;
            uh:
            return false;
            Uv:
        }
        Fq:
        return true;
    }
}
