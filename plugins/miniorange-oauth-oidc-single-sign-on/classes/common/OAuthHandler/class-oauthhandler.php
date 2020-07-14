<?php


namespace MoOauthClient;

use MoOauthClient\OauthHandlerInterface;
class OauthHandler implements OauthHandlerInterface
{
    public function get_token($bn, $NC, $gk = true, $dP = false)
    {
        global $NQ;
        foreach ($NC as $ZZ => $Da) {
            $NC[$ZZ] = html_entity_decode($Da);
            V2:
        }
        P6:
        $KO = '';
        if (!isset($NC["\143\154\151\x65\x6e\164\x5f\x73\145\x63\162\x65\x74"])) {
            goto hU;
        }
        $KO = $NC["\x63\154\x69\145\156\164\137\163\x65\x63\x72\145\164"];
        hU:
        $t2 = array("\x41\x63\x63\x65\160\164" => "\x61\160\x70\154\151\x63\141\164\x69\157\x6e\57\152\x73\x6f\156", "\x63\150\141\x72\x73\145\164" => "\x55\x54\106\x20\x2d\x20\70", "\x43\157\156\x74\145\156\164\x2d\124\x79\160\x65" => "\x61\160\x70\154\151\x63\x61\x74\151\157\x6e\57\x78\55\x77\x77\167\x2d\146\157\162\x6d\x2d\x75\162\x6c\145\156\x63\157\144\x65\x64", "\101\x75\164\150\157\162\x69\x7a\141\164\151\x6f\156" => "\102\141\x73\151\143\x20" . base64_encode($NC["\143\x6c\151\145\x6e\x74\x5f\151\144"] . "\72" . $KO));
        if (!isset($NC["\x63\157\x64\x65\x5f\166\x65\x72\151\146\151\145\x72"])) {
            goto Nq;
        }
        unset($t2["\101\165\x74\150\x6f\x72\151\x7a\x61\164\x69\x6f\x6e"]);
        Nq:
        if (1 === $gk && 0 === $dP) {
            goto Fy;
        }
        if (0 === $gk && 1 === $dP) {
            goto ED;
        }
        goto UP;
        Fy:
        unset($NC["\143\154\x69\x65\x6e\164\x5f\x69\x64"]);
        if (!isset($NC["\x63\x6c\x69\145\156\164\x5f\163\x65\143\162\x65\164"])) {
            goto Rt;
        }
        unset($NC["\x63\x6c\151\x65\156\x74\137\x73\x65\x63\x72\x65\164"]);
        Rt:
        goto UP;
        ED:
        if (!isset($t2["\101\165\x74\x68\157\x72\x69\x7a\141\x74\151\157\x6e"])) {
            goto M7;
        }
        unset($t2["\101\x75\164\x68\x6f\x72\x69\x7a\141\164\x69\x6f\156"]);
        M7:
        UP:
        $v2 = wp_remote_post($bn, array("\155\145\x74\150\157\x64" => "\x50\117\x53\124", "\x74\x69\x6d\x65\x6f\165\164" => 45, "\x72\x65\x64\151\x72\145\x63\x74\x69\x6f\x6e" => 5, "\x68\x74\164\160\166\x65\x72\163\151\157\156" => "\x31\x2e\x30", "\x62\x6c\157\143\153\x69\x6e\147" => true, "\150\x65\x61\x64\x65\x72\163" => $t2, "\x62\157\144\171" => $NC, "\143\157\157\x6b\151\145\163" => array(), "\163\x73\154\166\x65\x72\x69\x66\171" => false));
        if (!is_wp_error($v2)) {
            goto G1;
        }
        wp_die(wp_kses($v2->get_error_message(), \get_valid_html()));
        die;
        G1:
        $v2 = $v2["\142\157\144\x79"];
        if (is_array(json_decode($v2, true))) {
            goto I9;
        }
        echo "\74\163\164\x72\x6f\156\147\76\x52\x65\163\x70\x6f\x6e\x73\145\x20\72\40\x3c\x2f\163\164\162\x6f\x6e\x67\76\74\142\162\x3e";
        print_r($v2);
        echo "\74\142\x72\76\x3c\142\x72\x3e";
        die("\x49\156\166\x61\x6c\151\144\x20\162\145\163\160\x6f\156\x73\x65\x20\x72\145\143\145\x69\166\x65\144\56");
        I9:
        $mg = json_decode($v2, true);
        if (isset($mg["\x65\x72\162\x6f\x72\137\144\x65\x73\143\x72\151\160\164\x69\157\x6e"])) {
            goto Dc;
        }
        if (isset($mg["\145\x72\162\x6f\162"])) {
            goto hl;
        }
        goto dN;
        Dc:
        $this->handle_error(json_encode($mg["\145\162\162\x6f\x72\x5f\x64\x65\x73\143\162\x69\160\x74\151\157\x6e"]), $NC);
        return;
        goto dN;
        hl:
        $this->handle_error(json_encode($mg["\x65\162\x72\x6f\162"]), $NC);
        return;
        dN:
        return $v2;
    }
    public function get_access_token($bn, $NC, $gk, $dP)
    {
        $v2 = $this->get_token($bn, $NC, $gk, $dP);
        $mg = json_decode($v2, true);
        if (!("\160\x61\163\x73\x77\157\x72\144" === $NC["\x67\162\x61\x6e\x74\x5f\x74\171\160\145"])) {
            goto x8;
        }
        return $mg;
        x8:
        if (isset($mg["\141\x63\143\x65\163\163\x5f\164\157\153\145\156"])) {
            goto hm;
        }
        echo "\111\x6e\x76\141\154\151\144\x20\x72\145\163\x70\x6f\x6e\163\145\x20\162\145\143\x65\x69\166\x65\x64\x20\x66\162\157\155\40\x4f\101\x75\x74\x68\40\x50\162\x6f\166\151\x64\x65\162\x2e\40\103\157\156\164\x61\x63\164\x20\171\x6f\165\162\x20\141\144\155\151\156\151\x73\164\x72\141\x74\157\x72\x20\x66\157\162\x20\x6d\x6f\162\x65\40\x64\x65\x74\x61\151\154\163\x2e\74\142\162\76\x3c\x62\162\x3e\x3c\163\x74\x72\x6f\156\147\76\x52\x65\163\160\x6f\156\163\145\x20\x3a\x20\74\57\x73\164\162\157\156\x67\76\x3c\142\x72\x3e" . $v2;
        die;
        goto xF;
        hm:
        return $mg["\x61\143\143\x65\x73\x73\137\x74\157\x6b\145\x6e"];
        xF:
    }
    public function get_id_token($bn, $NC, $gk, $dP)
    {
        $v2 = $this->get_token($bn, $NC, $gk, $dP);
        $mg = json_decode($v2, true);
        if (isset($mg["\151\x64\137\x74\x6f\153\145\x6e"])) {
            goto kE;
        }
        echo "\x49\156\x76\141\x6c\x69\x64\x20\x72\145\x73\160\x6f\x6e\163\145\x20\x72\145\x63\145\151\166\x65\144\40\146\x72\157\155\40\117\160\145\x6e\111\x64\40\120\x72\x6f\x76\151\x64\x65\x72\56\x20\103\x6f\x6e\x74\141\x63\x74\40\x79\157\x75\x72\x20\x61\144\x6d\x69\156\x69\x73\164\x72\x61\x74\x6f\162\40\146\x6f\x72\x20\155\157\x72\x65\40\x64\x65\x74\x61\x69\x6c\x73\56\x3c\142\x72\76\x3c\x62\x72\x3e\x3c\x73\x74\162\x6f\156\147\x3e\122\145\163\x70\x6f\156\x73\145\40\72\40\x3c\x2f\x73\164\x72\x6f\156\147\76\x3c\142\162\x3e" . $v2;
        die;
        goto mB;
        kE:
        return $mg;
        mB:
    }
    public function get_resource_owner_from_id_token($j6)
    {
        $Yk = explode("\56", $j6);
        if (!isset($Yk[1])) {
            goto kI;
        }
        $Fs = base64_decode($Yk[1]);
        if (!is_array(json_decode($Fs, true))) {
            goto TY;
        }
        return json_decode($Fs, true);
        TY:
        kI:
        echo "\111\156\x76\x61\154\151\x64\x20\x72\x65\x73\160\157\x6e\x73\x65\40\x72\145\x63\145\x69\x76\145\x64\x2e\74\x62\x72\76\74\163\x74\x72\157\156\x67\76\151\x64\137\x74\157\153\145\156\40\72\x20\x3c\x2f\x73\164\x72\x6f\156\147\x3e" . $j6;
        die;
    }
    public function get_resource_owner($pl, $FA)
    {
        global $NQ;
        $t2 = array();
        $t2["\101\165\164\150\x6f\x72\x69\x7a\141\164\151\x6f\x6e"] = "\x42\x65\x61\162\145\162\x20" . $FA;
        if (!(strpos($pl, "\x61\x63\143\145\x73\163\137\x74\157\153\145\x6e") !== false && strpos($pl, "\75") !== false)) {
            goto Tn;
        }
        $pl .= $FA;
        Tn:
        $v2 = wp_remote_post($pl, array("\155\145\164\150\x6f\x64" => "\x47\x45\x54", "\x74\x69\x6d\145\x6f\165\164" => 45, "\x72\145\x64\151\162\145\x63\164\151\157\156" => 5, "\150\x74\164\x70\x76\x65\162\x73\151\x6f\156" => "\61\x2e\x30", "\142\154\x6f\143\153\151\156\147" => true, "\150\x65\141\x64\x65\x72\x73" => $t2, "\x63\x6f\x6f\x6b\x69\x65\x73" => array(), "\x73\163\154\166\x65\162\x69\146\171" => false));
        if (!is_wp_error($v2)) {
            goto lO;
        }
        wp_die(wp_kses($v2->get_error_message(), \get_valid_html()));
        die;
        lO:
        $v2 = $v2["\x62\x6f\x64\x79"];
        if (is_array(json_decode($v2, true))) {
            goto gp;
        }
        echo "\x3c\x73\x74\x72\157\156\147\76\122\x65\x73\160\x6f\x6e\x73\145\40\72\x20\x3c\x2f\163\x74\x72\157\156\x67\x3e\74\142\x72\x3e";
        print_r($v2);
        echo "\x3c\x62\162\x3e\74\142\162\76";
        die("\x49\x6e\x76\141\x6c\x69\144\40\x72\145\x73\160\x6f\156\163\x65\40\162\145\143\x65\151\166\x65\x64\56");
        gp:
        $mg = json_decode($v2, true);
        if (isset($mg["\x65\162\162\x6f\x72\x5f\144\x65\x73\143\162\151\x70\x74\151\157\x6e"])) {
            goto Ha;
        }
        if (isset($mg["\145\162\162\x6f\x72"])) {
            goto kP;
        }
        goto t_;
        Ha:
        die(json_encode($mg["\x65\162\162\157\162\x5f\144\145\x73\143\162\151\160\164\151\x6f\156"]));
        goto t_;
        kP:
        die(json_encode($mg["\145\162\x72\157\x72"]));
        t_:
        return $mg;
    }
    public function get_response($Ho)
    {
        $v2 = wp_remote_get($Ho, array("\x6d\145\164\150\157\144" => "\x47\x45\124", "\164\151\x6d\x65\157\165\164" => 45, "\x72\145\x64\x69\x72\x65\143\x74\151\x6f\156" => 5, "\x68\x74\x74\160\x76\x65\x72\163\151\x6f\x6e" => 1.0, "\x62\x6c\157\143\x6b\151\x6e\147" => true, "\x68\x65\141\144\145\162\163" => array(), "\143\157\x6f\x6b\151\x65\x73" => array(), "\163\x73\154\166\x65\162\151\x66\x79" => false));
        if (!is_wp_error($v2)) {
            goto mj;
        }
        wp_die(wp_kses($v2->get_error_message(), \get_valid_html()));
        die;
        mj:
        $v2 = $v2["\142\x6f\x64\171"];
        $mg = json_decode($v2, true);
        if (isset($mg["\x65\162\x72\157\162\137\144\145\163\143\162\151\x70\x74\x69\157\x6e"])) {
            goto zc;
        }
        if (isset($mg["\145\x72\162\x6f\162"])) {
            goto Kn;
        }
        goto vU;
        zc:
        die($mg["\x65\x72\162\x6f\162\137\144\145\x73\x63\x72\151\x70\x74\151\x6f\x6e"]);
        goto vU;
        Kn:
        die($mg["\145\162\162\157\x72"]);
        vU:
        return $mg;
    }
    private function handle_error($zY, $NC)
    {
        global $NQ;
        if (!($NC["\147\x72\141\x6e\x74\x5f\x74\171\160\x65"] === "\x70\141\x73\163\167\x6f\x72\x64")) {
            goto kF;
        }
        $no = site_url();
        $no = "\77\157\x70\x74\x69\157\x6e\x3d\x65\x72\x72\x6f\x72\x6d\141\x6e\x61\147\x65\x72\46\145\162\x72\x6f\162\x3d" . \base64_encode($zY);
        $NQ->redirect_user($no);
        die;
        kF:
        die($zY);
    }
}
