<?php


namespace MoOauthClient\GrantTypes;

use MoOauthClient\GrantTypes\JWSVerify;
use MoOauthClient\GrantTypes\Crypt_RSA;
use MoOauthClient\GrantTypes\Math_BigInteger;
class JWTUtils
{
    const HEADER = "\x48\105\x41\x44\105\122";
    const PAYLOAD = "\120\101\131\114\x4f\101\x44";
    const SIGN = "\x53\x49\x47\x4e";
    private $jwt;
    private $decoded_jwt;
    public function __construct($S8)
    {
        $S8 = \explode("\56", $S8);
        if (!(3 > count($S8))) {
            goto pGr;
        }
        return new \WP_Error("\151\x6e\x76\x61\x6c\151\144\x5f\152\x77\164", __("\x4a\x57\x54\40\x52\145\143\x65\151\x76\145\144\40\x69\x73\40\x6e\x6f\164\40\x61\x20\x76\141\154\x69\144\40\112\127\124"));
        pGr:
        $this->jwt = $S8;
        $vj = $this->get_jwt_claim('', self::HEADER);
        $WB = $this->get_jwt_claim('', self::PAYLOAD);
        $this->decoded_jwt = array("\150\x65\141\144\x65\x72" => $vj, "\160\x61\171\x6c\157\x61\x64" => $WB);
    }
    private function get_jwt_claim($jV = '', $ni = '')
    {
        $ok = '';
        switch ($ni) {
            case self::HEADER:
                $ok = $this->jwt[0];
                goto gMr;
            case self::PAYLOAD:
                $ok = $this->jwt[1];
                goto gMr;
            case self::SIGN:
                return $this->jwt[2];
            default:
                wp_die(wp_kses("\103\141\156\156\157\x74\x20\x46\151\156\144\x20" . $ni . "\40\x69\156\40\164\150\145\40\x4a\x57\x54", \get_valid_html()));
        }
        WKQ:
        gMr:
        $ok = json_decode(base64_decode($ok), true);
        if (!(!$ok || empty($ok))) {
            goto T3u;
        }
        return null;
        T3u:
        return empty($jV) ? $ok : (isset($ok[$jV]) ? $ok[$jV] : null);
    }
    public function check_algo($TF = '')
    {
        $Nh = $this->get_jwt_claim("\x61\154\147", self::HEADER);
        $Nh = explode("\x53", $Nh);
        if (isset($Nh[0])) {
            goto Pzf;
        }
        wp_die(wp_kses("\111\x6e\x76\141\x6c\x69\x64\x20\x52\145\x73\x70\x6f\x6e\163\145\x20\122\x65\x63\145\151\x76\145\x64\x20\x66\162\157\155\40\x4f\x41\165\164\150\57\x4f\160\145\x6e\111\x44\x20\120\162\157\x76\x69\144\x65\162\56", \get_valid_html()));
        Pzf:
        switch ($Nh[0]) {
            case "\110":
                return "\x48\x53\101" === $TF;
            case "\122":
                return "\122\x53\x41" === $TF;
            default:
                return false;
        }
        Y5y:
        l13:
    }
    public function verify($hB = '')
    {
        if (!empty($hB)) {
            goto YdI;
        }
        return false;
        YdI:
        $V5 = $this->get_jwt_claim("\x65\x78\x70", self::PAYLOAD);
        if (!(is_null($V5) || time() > $V5)) {
            goto lgB;
        }
        wp_die(wp_kses("\112\127\124\40\x68\141\x73\40\142\145\x65\x6e\40\x65\170\160\151\x72\x65\x64\x2e\x20\x50\x6c\145\141\x73\x65\40\164\x72\x79\x20\114\x6f\147\x67\x69\156\147\40\x69\x6e\40\x61\x67\141\151\x6e\56", \get_valid_html()));
        lgB:
        $DE = $this->get_jwt_claim("\x6e\x62\146", self::PAYLOAD);
        if (!(!is_null($DE) || time() < $DE)) {
            goto tBw;
        }
        wp_die(wp_kses("\x49\x74\40\x69\163\40\x74\157\x6f\40\x65\x61\x72\154\171\40\164\157\x20\165\163\x65\40\x74\150\151\x73\40\x4a\127\124\x2e\x20\x50\x6c\145\x61\163\145\40\164\162\x79\x20\114\157\147\147\x69\156\x67\40\x69\x6e\x20\141\147\141\151\156\56", \get_valid_html()));
        tBw:
        $sm = new JWSVerify($this->get_jwt_claim("\141\x6c\147", self::HEADER));
        $uW = $this->get_header() . "\56" . $this->get_payload();
        return $sm->verify(\utf8_decode($uW), $hB, base64_decode(strtr($this->get_jwt_claim(false, self::SIGN), "\55\x5f", "\x2b\57")));
    }
    public function verify_from_jwks($hZ = '', $Nh = "\122\123\x32\65\66")
    {
        global $NQ;
        $ZI = wp_remote_get($hZ);
        if (!is_wp_error($ZI)) {
            goto dVi;
        }
        return false;
        dVi:
        $ZI = json_decode($ZI["\142\157\144\x79"], true);
        $hh = false;
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto rkn;
        }
        return $hh;
        rkn:
        if (isset($ZI["\x6b\145\171\163"])) {
            goto E3q;
        }
        return $hh;
        E3q:
        foreach ($ZI["\153\145\x79\163"] as $ZZ => $Da) {
            if (!(!isset($Da["\x6b\x74\171"]) || "\x52\x53\x41" !== $Da["\153\x74\x79"] || !isset($Da["\145"]) || !isset($Da["\156"]))) {
                goto w3P;
            }
            goto yZ4;
            w3P:
            $hh = $hh || $this->verify($this->jwks_to_pem(array("\156" => new Math_BigInteger($NQ->base64url_decode($Da["\x6e"]), 256), "\145" => new Math_BigInteger($NQ->base64url_decode($Da["\x65"]), 256))));
            if (!(true === $hh)) {
                goto Sb2;
            }
            goto dd0;
            Sb2:
            yZ4:
        }
        dd0:
        return $hh;
    }
    private function jwks_to_pem($u1 = array())
    {
        $Nr = new Crypt_RSA();
        $Nr->loadKey($u1);
        return $Nr->getPublicKey();
    }
    public function get_decoded_header()
    {
        return $this->decoded_jwt["\x68\145\x61\x64\x65\162"];
    }
    public function get_decoded_payload()
    {
        return $this->decoded_jwt["\x70\x61\171\x6c\x6f\141\144"];
    }
    public function get_header()
    {
        return $this->jwt[0];
    }
    public function get_payload()
    {
        return $this->jwt[1];
    }
}
