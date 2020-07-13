<?php


namespace MoOauthClient\GrantTypes;

class JWSVerify
{
    public $algo;
    public function __construct($Vb = '')
    {
        if (!empty($Vb)) {
            goto xoi;
        }
        return;
        xoi:
        $Vb = explode("\x53", $Vb);
        if (!(!is_array($Vb) || 2 !== count($Vb))) {
            goto zKS;
        }
        return WP_Error("\x69\156\x76\x61\x6c\151\144\x5f\x73\x69\147\156\141\164\x75\x72\x65", __("\124\x68\145\x20\123\151\x67\x6e\x61\164\165\162\145\x20\163\x65\145\155\x73\x20\x74\x6f\x20\142\145\40\151\156\x76\x61\154\x69\x64\40\x6f\162\x20\x75\156\x73\165\160\x70\x6f\x72\164\145\144\56"));
        zKS:
        if ("\110" === $Vb[0]) {
            goto pc0;
        }
        if ("\x52" === $Vb[0]) {
            goto bmn;
        }
        return WP_Error("\x69\x6e\x76\141\154\151\144\x5f\x73\x69\x67\156\141\x74\x75\x72\145", __("\124\x68\145\x20\x73\151\x67\x6e\141\x74\165\162\x65\x20\141\x6c\x67\157\x72\x69\x74\150\155\40\x73\145\x65\x6d\x73\40\x74\x6f\40\142\x65\40\x75\x6e\163\165\x70\x70\x6f\x72\x74\145\x64\x20\x6f\x72\x20\151\156\166\141\154\x69\144\56"));
        goto MFJ;
        pc0:
        $this->algo["\141\154\147"] = "\x48\123\101";
        goto MFJ;
        bmn:
        $this->algo["\x61\154\147"] = "\122\x53\101";
        MFJ:
        $this->algo["\163\x68\x61"] = $Vb[1];
    }
    private function validate_hmac($uW = '', $hB = '', $CW = '')
    {
        if (!(empty($uW) || empty($CW))) {
            goto pIj;
        }
        return false;
        pIj:
        $c0 = $this->algo["\x73\150\x61"];
        $c0 = "\163\x68\141" . $c0;
        $rN = \hash_hmac($c0, $uW, $hB, true);
        return hash_equals($rN, $CW);
    }
    private function validate_rsa($uW = '', $bo = '', $CW = '')
    {
        if (!(empty($uW) || empty($CW))) {
            goto I3u;
        }
        return false;
        I3u:
        $c0 = $this->algo["\163\150\141"];
        $ui = '';
        $D4 = explode("\55\55\x2d\55\55", $bo);
        if (preg_match("\x2f\134\x72\134\x6e\x7c\134\162\174\134\156\57", $D4[2])) {
            goto aV6;
        }
        $PS = "\x2d\55\55\x2d\x2d" . $D4[1] . "\x2d\55\x2d\x2d\55\12";
        $rl = 0;
        Z7o:
        if (!($su = substr($D4[2], $rl, 64))) {
            goto ziK;
        }
        $PS .= $su . "\12";
        $rl += 64;
        goto Z7o;
        ziK:
        $PS .= "\x2d\55\55\x2d\55" . $D4[3] . "\x2d\55\55\55\55\12";
        $ui = $PS;
        goto iGm;
        aV6:
        $ui = $bo;
        iGm:
        $hh = false;
        switch ($c0) {
            case "\x32\65\66":
                $hh = openssl_verify($uW, $CW, $ui, OPENSSL_ALGO_SHA256);
                goto pgb;
            case "\63\x38\64":
                $hh = openssl_verify($uW, $CW, $ui, OPENSSL_ALGO_SHA384);
                goto pgb;
            case "\x35\61\x32":
                $hh = openssl_verify($uW, $CW, $ui, OPENSSL_ALGO_SHA512);
                goto pgb;
            default:
                $hh = false;
                goto pgb;
        }
        OKa:
        pgb:
        return $hh;
    }
    public function verify($uW = '', $hB = '', $CW = '')
    {
        if (!(empty($uW) || empty($CW))) {
            goto O33;
        }
        return false;
        O33:
        $Vb = $this->algo["\141\154\147"];
        switch ($Vb) {
            case "\x48\123\x41":
                return $this->validate_hmac($uW, $hB, $CW);
            case "\122\x53\101":
                return @$this->validate_rsa($uW, $hB, $CW);
            default:
                return false;
        }
        e95:
        dbu:
    }
}
