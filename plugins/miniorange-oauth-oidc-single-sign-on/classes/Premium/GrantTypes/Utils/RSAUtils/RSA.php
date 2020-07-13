<?php


namespace MoOauthClient\GrantTypes;

if (function_exists("\143\162\x79\x70\164\x5f\162\x61\x6e\144\x6f\155\137\163\164\162\151\x6e\x67")) {
    goto Qq;
}
include_once "\122\141\x6e\x64\x6f\x6d\x2e\x70\150\160";
Qq:
if (class_exists("\x43\162\171\160\164\x5f\110\141\x73\150")) {
    goto Xz;
}
include_once "\x48\x61\163\150\x2e\160\x68\x70";
Xz:
define("\x43\122\131\x50\x54\137\x52\123\101\137\x45\x4e\103\x52\131\x50\124\111\117\x4e\137\x4f\101\x45\x50", 1);
define("\103\x52\131\120\124\137\x52\123\101\137\105\116\x43\x52\131\120\124\x49\x4f\116\x5f\x50\113\103\x53\61", 2);
define("\x43\122\x59\120\x54\137\122\123\x41\x5f\105\x4e\x43\x52\131\x50\124\111\117\116\x5f\x4e\117\x4e\x45", 3);
define("\x43\122\131\x50\124\x5f\122\123\101\137\123\111\x47\116\x41\124\125\x52\x45\x5f\x50\123\x53", 1);
define("\x43\122\131\x50\x54\137\122\x53\x41\x5f\123\111\x47\116\101\x54\x55\122\x45\137\120\x4b\103\123\61", 2);
define("\103\122\131\x50\x54\x5f\x52\123\101\x5f\x41\x53\x4e\61\137\x49\116\124\105\107\105\122", 2);
define("\x43\x52\131\120\x54\137\x52\x53\x41\x5f\x41\123\116\x31\x5f\x42\x49\124\x53\x54\x52\x49\x4e\107", 3);
define("\x43\x52\131\120\x54\x5f\122\x53\101\137\101\x53\116\61\137\x4f\103\124\105\124\123\124\122\111\x4e\107", 4);
define("\x43\x52\131\120\124\137\122\123\101\137\101\123\116\x31\x5f\x4f\102\112\105\103\x54", 6);
define("\103\x52\131\120\x54\137\122\x53\101\137\x41\123\116\61\x5f\123\x45\121\125\105\x4e\103\x45", 48);
define("\x43\x52\131\120\x54\x5f\122\x53\101\x5f\115\117\104\105\x5f\111\x4e\124\105\x52\x4e\x41\x4c", 1);
define("\103\122\131\120\124\137\x52\x53\x41\x5f\115\117\x44\x45\x5f\x4f\x50\105\116\x53\123\x4c", 2);
define("\103\122\131\120\x54\137\x52\123\x41\x5f\x4f\x50\x45\x4e\x53\123\114\137\103\x4f\x4e\x46\111\107", dirname(__FILE__) . "\x2f\x2e\x2e\57\157\160\x65\156\163\x73\154\x2e\x63\156\x66");
define("\x43\122\131\120\x54\x5f\x52\123\101\137\x50\122\x49\126\x41\x54\x45\137\x46\117\x52\x4d\101\124\x5f\x50\113\103\x53\x31", 0);
define("\x43\x52\131\120\124\137\122\x53\x41\x5f\x50\x52\x49\126\101\124\x45\x5f\106\x4f\122\115\101\124\x5f\120\125\x54\x54\131", 1);
define("\103\x52\131\x50\124\x5f\x52\123\x41\x5f\x50\122\111\126\101\x54\105\x5f\x46\x4f\x52\115\101\x54\137\x58\115\x4c", 2);
define("\x43\x52\131\120\x54\137\122\123\101\137\x50\122\111\126\x41\x54\105\x5f\106\x4f\122\x4d\101\124\137\120\x4b\103\123\x38", 8);
define("\103\x52\x59\120\124\137\122\123\101\137\x50\x55\x42\114\x49\103\137\106\x4f\122\x4d\101\x54\x5f\x52\x41\127", 3);
define("\103\x52\x59\120\124\137\x52\123\x41\x5f\120\x55\102\114\x49\103\x5f\x46\117\x52\115\x41\124\137\120\x4b\103\123\x31", 4);
define("\103\122\x59\x50\x54\137\x52\123\101\137\x50\125\102\x4c\111\x43\x5f\x46\117\x52\x4d\x41\x54\137\120\x4b\x43\x53\61\137\122\x41\x57", 4);
define("\x43\x52\x59\x50\x54\137\122\123\x41\x5f\120\x55\102\114\x49\x43\x5f\x46\x4f\x52\115\x41\124\137\130\115\114", 5);
define("\x43\122\x59\x50\x54\137\x52\123\101\x5f\120\x55\x42\114\111\x43\137\106\x4f\x52\x4d\101\x54\137\117\120\105\116\123\123\x48", 6);
define("\103\122\131\120\124\x5f\x52\x53\101\137\x50\x55\x42\114\111\x43\x5f\106\x4f\x52\x4d\x41\x54\x5f\x50\x4b\103\x53\x38", 7);
class Crypt_RSA
{
    var $zero;
    var $one;
    var $privateKeyFormat = CRYPT_RSA_PRIVATE_FORMAT_PKCS1;
    var $publicKeyFormat = CRYPT_RSA_PUBLIC_FORMAT_PKCS8;
    var $modulus;
    var $k;
    var $exponent;
    var $primes;
    var $exponents;
    var $coefficients;
    var $hashName;
    var $hash;
    var $hLen;
    var $sLen;
    var $mgfHash;
    var $mgfHLen;
    var $encryptionMode = CRYPT_RSA_ENCRYPTION_OAEP;
    var $signatureMode = CRYPT_RSA_SIGNATURE_PSS;
    var $publicExponent = false;
    var $password = false;
    var $components = array();
    var $current;
    var $configFile;
    var $comment = "\x70\150\x70\x73\145\x63\154\x69\x62\55\x67\x65\156\145\x72\x61\x74\x65\x64\55\x6b\x65\x79";
    function __construct()
    {
        if (class_exists("\x4d\141\164\x68\x5f\102\x69\x67\111\x6e\164\145\x67\145\162")) {
            goto qM;
        }
        include_once dirname(__FILE__) . "\x2f\x4d\141\x74\150\x2f\x42\151\147\x49\156\164\145\147\145\162\56\x70\x68\x70";
        qM:
        $this->configFile = CRYPT_RSA_OPENSSL_CONFIG;
        if (defined("\103\122\131\x50\124\137\122\x53\x41\137\x4d\x4f\x44\105")) {
            goto PC;
        }
        switch (true) {
            case defined("\115\x41\124\110\x5f\x42\x49\107\x49\116\x54\105\x47\x45\x52\x5f\x4f\x50\x45\116\x53\x53\x4c\137\x44\x49\x53\101\x42\x4c\x45"):
                define("\103\x52\x59\120\x54\137\x52\123\x41\137\x4d\117\104\105", CRYPT_RSA_MODE_INTERNAL);
                goto dq;
            case !function_exists("\x6f\x70\x65\x6e\163\x73\x6c\137\160\x6b\x65\x79\x5f\x67\x65\x74\137\x64\x65\x74\141\151\x6c\x73"):
                define("\103\x52\x59\120\x54\x5f\x52\123\101\137\x4d\117\x44\x45", CRYPT_RSA_MODE_INTERNAL);
                goto dq;
            case extension_loaded("\x6f\x70\145\156\x73\x73\x6c") && version_compare(PHP_VERSION, "\x34\56\62\56\60", "\x3e\x3d") && file_exists($this->configFile):
                ob_start();
                @phpinfo();
                $mg = ob_get_contents();
                ob_end_clean();
                preg_match_all("\x23\x4f\x70\x65\x6e\123\x53\x4c\40\50\x48\x65\141\144\145\x72\174\114\x69\142\x72\x61\162\171\51\x20\126\145\x72\x73\151\157\x6e\x28\56\52\51\43\151\155", $mg, $xE);
                $Cj = array();
                if (empty($xE[1])) {
                    goto Zl;
                }
                $zh = 0;
                iL:
                if (!($zh < count($xE[1]))) {
                    goto Iz;
                }
                $KV = trim(str_replace("\x3d\76", '', strip_tags($xE[2][$zh])));
                if (!preg_match("\x2f\x28\134\x64\53\x5c\x2e\x5c\x64\53\x5c\x2e\x5c\x64\53\51\57\x69", $KV, $fg)) {
                    goto QW;
                }
                $Cj[$xE[1][$zh]] = $fg[0];
                goto m1;
                QW:
                $Cj[$xE[1][$zh]] = $KV;
                m1:
                VY:
                $zh++;
                goto iL;
                Iz:
                Zl:
                switch (true) {
                    case !isset($Cj["\x48\145\141\x64\x65\x72"]):
                    case !isset($Cj["\x4c\x69\142\x72\141\162\171"]):
                    case $Cj["\x48\145\141\144\x65\x72"] == $Cj["\x4c\151\142\162\x61\162\171"]:
                    case version_compare($Cj["\x48\145\141\144\x65\162"], "\x31\56\x30\56\x30") >= 0 && version_compare($Cj["\x4c\151\142\162\141\162\171"], "\x31\56\x30\x2e\x30") >= 0:
                        define("\x43\x52\x59\x50\124\137\x52\x53\101\137\115\117\104\x45", CRYPT_RSA_MODE_OPENSSL);
                        goto ym;
                    default:
                        define("\x43\122\131\120\124\x5f\122\123\x41\137\x4d\x4f\104\105", CRYPT_RSA_MODE_INTERNAL);
                        define("\x4d\x41\x54\110\137\102\111\x47\111\x4e\x54\105\x47\x45\122\137\x4f\x50\x45\116\123\123\x4c\x5f\104\111\x53\x41\x42\114\x45", true);
                }
                E5:
                ym:
                goto dq;
            default:
                define("\103\122\x59\120\124\x5f\x52\x53\x41\137\115\117\104\x45", CRYPT_RSA_MODE_INTERNAL);
        }
        xC:
        dq:
        PC:
        $this->zero = new Math_BigInteger();
        $this->one = new Math_BigInteger(1);
        $this->hash = new Crypt_Hash("\x73\x68\x61\61");
        $this->hLen = $this->hash->getLength();
        $this->hashName = "\163\150\141\x31";
        $this->mgfHash = new Crypt_Hash("\x73\x68\141\x31");
        $this->mgfHLen = $this->mgfHash->getLength();
    }
    function Crypt_RSA()
    {
        $this->__construct();
    }
    function createKey($UH = 1024, $Rh = false, $a5 = array())
    {
        if (defined("\x43\122\x59\120\124\137\122\x53\101\137\x45\x58\120\117\116\x45\x4e\124")) {
            goto pu;
        }
        define("\x43\x52\131\x50\x54\x5f\x52\x53\101\137\x45\130\x50\117\x4e\105\116\124", "\x36\x35\x35\63\x37");
        pu:
        if (defined("\x43\122\x59\x50\124\137\x52\123\x41\x5f\x53\115\101\x4c\114\105\x53\124\x5f\120\x52\111\x4d\x45")) {
            goto BG;
        }
        define("\x43\122\131\120\124\x5f\x52\123\x41\x5f\123\115\101\x4c\x4c\105\x53\x54\137\x50\x52\111\115\x45", 4096);
        BG:
        if (!(CRYPT_RSA_MODE == CRYPT_RSA_MODE_OPENSSL && $UH >= 384 && CRYPT_RSA_EXPONENT == 65537)) {
            goto xR;
        }
        $HC = array();
        if (!isset($this->configFile)) {
            goto pW;
        }
        $HC["\x63\x6f\x6e\x66\x69\x67"] = $this->configFile;
        pW:
        $Nr = openssl_pkey_new(array("\160\162\151\166\141\164\x65\x5f\153\145\171\137\x62\x69\x74\x73" => $UH) + $HC);
        openssl_pkey_export($Nr, $Xd, null, $HC);
        $Z1 = openssl_pkey_get_details($Nr);
        $Z1 = $Z1["\153\x65\171"];
        $Xd = call_user_func_array(array($this, "\x5f\x63\x6f\x6e\x76\145\162\164\x50\x72\x69\x76\141\x74\x65\113\x65\x79"), array_values($this->_parseKey($Xd, CRYPT_RSA_PRIVATE_FORMAT_PKCS1)));
        $Z1 = call_user_func_array(array($this, "\x5f\143\157\x6e\166\145\x72\x74\120\x75\142\154\151\143\113\145\171"), array_values($this->_parseKey($Z1, CRYPT_RSA_PUBLIC_FORMAT_PKCS1)));
        Gd:
        if (!(openssl_error_string() !== false)) {
            goto cy;
        }
        goto Gd;
        cy:
        return array("\160\162\x69\166\x61\x74\x65\153\x65\x79" => $Xd, "\160\165\x62\x6c\x69\x63\153\x65\x79" => $Z1, "\160\x61\162\164\x69\x61\x6c\153\145\171" => false);
        xR:
        static $hq;
        if (isset($hq)) {
            goto Qa;
        }
        $hq = new Math_BigInteger(CRYPT_RSA_EXPONENT);
        Qa:
        extract($this->_generateMinMax($UH));
        $vT = $Ni;
        $iP = $UH >> 1;
        if ($iP > CRYPT_RSA_SMALLEST_PRIME) {
            goto GJ;
        }
        $Il = 2;
        goto u2;
        GJ:
        $Il = floor($UH / CRYPT_RSA_SMALLEST_PRIME);
        $iP = CRYPT_RSA_SMALLEST_PRIME;
        u2:
        extract($this->_generateMinMax($iP + $UH % $iP));
        $Dk = $z9;
        extract($this->_generateMinMax($iP));
        $bO = new Math_BigInteger();
        $LN = $this->one->copy();
        if (!empty($a5)) {
            goto Li;
        }
        $H3 = $WH = $zN = array();
        $Tt = array("\164\157\x70" => $this->one->copy(), "\142\157\x74\x74\x6f\x6d" => false);
        goto q9;
        Li:
        extract(unserialize($a5));
        q9:
        $KI = time();
        $Fp = count($zN) + 1;
        nQ:
        $zh = $Fp;
        Wh:
        if (!($zh <= $Il)) {
            goto we;
        }
        if (!($Rh !== false)) {
            goto z5;
        }
        $Rh -= time() - $KI;
        $KI = time();
        if (!($Rh <= 0)) {
            goto ug;
        }
        return array("\160\162\x69\166\x61\164\145\153\x65\x79" => '', "\160\165\x62\154\151\x63\153\x65\171" => '', "\x70\x61\162\x74\151\141\154\153\145\171" => serialize(array("\160\162\x69\155\x65\x73" => $zN, "\143\157\145\x66\146\151\x63\151\x65\156\x74\x73" => $WH, "\x6c\143\155" => $Tt, "\x65\170\160\x6f\156\145\156\x74\x73" => $H3)));
        ug:
        z5:
        if ($zh == $Il) {
            goto tD;
        }
        $zN[$zh] = $bO->randomPrime($Ni, $z9, $Rh);
        goto pj;
        tD:
        list($Ni, $iP) = $vT->divide($LN);
        if ($iP->equals($this->zero)) {
            goto kV;
        }
        $Ni = $Ni->add($this->one);
        kV:
        $zN[$zh] = $bO->randomPrime($Ni, $Dk, $Rh);
        pj:
        if (!($zN[$zh] === false)) {
            goto s3;
        }
        if (count($zN) > 1) {
            goto SR;
        }
        array_pop($zN);
        $xJ = serialize(array("\x70\162\x69\155\145\x73" => $zN, "\x63\157\x65\x66\146\151\x63\x69\x65\x6e\164\163" => $WH, "\x6c\143\x6d" => $Tt, "\145\170\x70\x6f\x6e\145\x6e\164\x73" => $H3));
        goto qf;
        SR:
        $xJ = '';
        qf:
        return array("\160\162\151\x76\141\x74\x65\153\x65\x79" => '', "\160\x75\x62\x6c\x69\x63\153\x65\x79" => '', "\160\x61\x72\164\x69\x61\154\153\x65\x79" => $xJ);
        s3:
        if (!($zh > 2)) {
            goto BD;
        }
        $WH[$zh] = $LN->modInverse($zN[$zh]);
        BD:
        $LN = $LN->multiply($zN[$zh]);
        $iP = $zN[$zh]->subtract($this->one);
        $Tt["\x74\157\160"] = $Tt["\164\157\x70"]->multiply($iP);
        $Tt["\x62\x6f\x74\164\x6f\x6d"] = $Tt["\142\x6f\164\x74\157\x6d"] === false ? $iP : $Tt["\x62\157\x74\164\157\x6d"]->gcd($iP);
        $H3[$zh] = $hq->modInverse($iP);
        Xf:
        $zh++;
        goto Wh;
        we:
        list($iP) = $Tt["\164\157\160"]->divide($Tt["\142\x6f\164\164\157\x6d"]);
        $qb = $iP->gcd($hq);
        $Fp = 1;
        if (!$qb->equals($this->one)) {
            goto nQ;
        }
        D2:
        $Xy = $hq->modInverse($iP);
        $WH[2] = $zN[2]->modInverse($zN[1]);
        return array("\x70\162\151\x76\x61\x74\145\x6b\145\x79" => $this->_convertPrivateKey($LN, $hq, $Xy, $zN, $H3, $WH), "\160\165\142\154\151\x63\153\x65\x79" => $this->_convertPublicKey($LN, $hq), "\160\x61\162\x74\151\x61\x6c\x6b\x65\x79" => false);
    }
    function _convertPrivateKey($LN, $hq, $Xy, $zN, $H3, $WH)
    {
        $cO = $this->privateKeyFormat != CRYPT_RSA_PRIVATE_FORMAT_XML;
        $Il = count($zN);
        $hb = array("\166\145\162\x73\x69\x6f\156" => $Il == 2 ? chr(0) : chr(1), "\155\x6f\144\165\154\x75\x73" => $LN->toBytes($cO), "\x70\x75\142\x6c\x69\x63\x45\x78\160\157\156\145\x6e\164" => $hq->toBytes($cO), "\x70\x72\151\x76\141\164\145\x45\x78\160\x6f\156\x65\x6e\x74" => $Xy->toBytes($cO), "\160\162\x69\155\x65\x31" => $zN[1]->toBytes($cO), "\x70\x72\x69\x6d\x65\x32" => $zN[2]->toBytes($cO), "\x65\170\160\x6f\x6e\145\x6e\x74\61" => $H3[1]->toBytes($cO), "\145\x78\160\x6f\x6e\145\x6e\164\62" => $H3[2]->toBytes($cO), "\x63\157\x65\x66\x66\x69\143\151\145\x6e\164" => $WH[2]->toBytes($cO));
        switch ($this->privateKeyFormat) {
            case CRYPT_RSA_PRIVATE_FORMAT_XML:
                if (!($Il != 2)) {
                    goto GK;
                }
                return false;
                GK:
                return "\74\x52\x53\x41\113\x65\171\126\141\x6c\165\x65\x3e\xd\12" . "\x20\x20\74\x4d\157\144\165\154\165\163\76" . base64_encode($hb["\155\157\144\165\154\165\x73"]) . "\x3c\57\115\x6f\144\x75\154\165\163\76\15\xa" . "\x20\x20\74\x45\x78\x70\x6f\156\145\x6e\x74\x3e" . base64_encode($hb["\x70\165\142\x6c\151\x63\x45\170\x70\x6f\156\x65\156\x74"]) . "\x3c\x2f\x45\170\160\157\x6e\x65\156\164\76\15\12" . "\x20\x20\x3c\120\76" . base64_encode($hb["\x70\162\151\155\145\x31"]) . "\74\x2f\120\76\15\xa" . "\x20\40\x3c\x51\x3e" . base64_encode($hb["\160\x72\151\x6d\x65\62"]) . "\74\57\121\x3e\xd\12" . "\x20\x20\74\x44\120\x3e" . base64_encode($hb["\x65\x78\x70\x6f\156\x65\156\x74\61"]) . "\x3c\x2f\104\120\x3e\15\12" . "\x20\x20\x3c\104\121\76" . base64_encode($hb["\145\170\x70\x6f\156\x65\156\x74\x32"]) . "\74\57\x44\x51\76\15\12" . "\40\x20\x3c\111\x6e\166\145\x72\x73\x65\121\x3e" . base64_encode($hb["\143\157\145\146\146\x69\x63\151\x65\156\x74"]) . "\x3c\x2f\111\156\166\145\162\163\x65\121\76\xd\xa" . "\x20\40\74\x44\x3e" . base64_encode($hb["\160\162\x69\166\x61\164\x65\105\x78\160\157\156\145\156\x74"]) . "\x3c\57\x44\76\15\xa" . "\74\x2f\x52\x53\x41\113\x65\171\126\141\154\x75\x65\x3e";
                goto Z8;
            case CRYPT_RSA_PRIVATE_FORMAT_PUTTY:
                if (!($Il != 2)) {
                    goto g6;
                }
                return false;
                g6:
                $ZZ = "\120\165\124\124\x59\55\125\163\145\162\x2d\113\145\x79\55\106\151\x6c\x65\55\x32\72\x20\163\163\150\55\162\x73\141\15\12\105\x6e\x63\162\x79\160\164\x69\157\156\72\40";
                $oh = !empty($this->password) || is_string($this->password) ? "\141\x65\163\62\65\x36\55\143\142\x63" : "\x6e\x6f\156\x65";
                $ZZ .= $oh;
                $ZZ .= "\15\xa\103\157\x6d\x6d\x65\156\164\x3a\40" . $this->comment . "\15\xa";
                $Fb = pack("\116\141\52\x4e\141\x2a\116\141\x2a", strlen("\163\x73\x68\x2d\162\163\141"), "\163\x73\x68\55\x72\163\141", strlen($hb["\160\x75\142\x6c\151\x63\105\x78\x70\x6f\x6e\x65\156\x74"]), $hb["\160\x75\142\x6c\151\143\105\x78\160\157\156\x65\x6e\164"], strlen($hb["\155\157\144\x75\x6c\x75\x73"]), $hb["\x6d\x6f\144\x75\x6c\x75\x73"]);
                $Y9 = pack("\x4e\x61\x2a\x4e\141\x2a\x4e\141\x2a\x4e\x61\52", strlen("\163\163\x68\x2d\162\163\x61"), "\x73\163\x68\x2d\162\163\141", strlen($oh), $oh, strlen($this->comment), $this->comment, strlen($Fb), $Fb);
                $Fb = base64_encode($Fb);
                $ZZ .= "\x50\x75\142\x6c\151\x63\55\114\151\x6e\145\163\72\x20" . (strlen($Fb) + 63 >> 6) . "\15\12";
                $ZZ .= chunk_split($Fb, 64);
                $GZ = pack("\116\x61\52\116\x61\52\116\141\52\x4e\141\x2a", strlen($hb["\160\162\x69\x76\141\164\x65\105\170\x70\x6f\156\x65\x6e\164"]), $hb["\160\162\x69\166\141\164\145\x45\170\160\157\156\x65\x6e\x74"], strlen($hb["\160\x72\151\x6d\x65\x31"]), $hb["\160\x72\x69\155\x65\61"], strlen($hb["\160\162\x69\155\x65\x32"]), $hb["\x70\162\x69\x6d\145\x32"], strlen($hb["\x63\157\x65\146\146\151\x63\151\x65\156\164"]), $hb["\x63\157\145\x66\x66\x69\143\151\x65\x6e\x74"]);
                if (empty($this->password) && !is_string($this->password)) {
                    goto wJ;
                }
                $GZ .= crypt_random_string(16 - (strlen($GZ) & 15));
                $Y9 .= pack("\x4e\x61\x2a", strlen($GZ), $GZ);
                if (class_exists("\x43\162\171\160\164\x5f\101\x45\x53")) {
                    goto Oh;
                }
                include_once "\x43\162\x79\x70\x74\x2f\101\x45\x53\56\x70\x68\160";
                Oh:
                $RW = 0;
                $Dn = '';
                E4:
                if (!(strlen($Dn) < 32)) {
                    goto iO;
                }
                $iP = pack("\x4e\141\x2a", $RW++, $this->password);
                $Dn .= pack("\110\x2a", sha1($iP));
                goto E4;
                iO:
                $Dn = substr($Dn, 0, 32);
                $w1 = new Crypt_AES();
                $w1->setKey($Dn);
                $w1->disablePadding();
                $GZ = $w1->encrypt($GZ);
                $ah = "\x70\165\x74\164\171\55\160\x72\x69\x76\x61\164\x65\x2d\x6b\x65\171\55\x66\x69\x6c\x65\55\155\141\143\x2d\153\145\171" . $this->password;
                goto Jd;
                wJ:
                $Y9 .= pack("\x4e\141\x2a", strlen($GZ), $GZ);
                $ah = "\x70\165\164\164\x79\x2d\160\x72\151\x76\141\164\x65\x2d\153\x65\x79\x2d\146\x69\154\145\x2d\x6d\x61\x63\x2d\x6b\x65\171";
                Jd:
                $GZ = base64_encode($GZ);
                $ZZ .= "\120\162\x69\x76\x61\x74\145\55\x4c\151\x6e\x65\163\x3a\x20" . (strlen($GZ) + 63 >> 6) . "\15\xa";
                $ZZ .= chunk_split($GZ, 64);
                if (class_exists("\103\162\171\160\164\137\110\x61\x73\x68")) {
                    goto vr;
                }
                include_once "\103\x72\171\160\164\x2f\110\x61\x73\x68\x2e\160\150\160";
                vr:
                $YT = new Crypt_Hash("\x73\x68\141\x31");
                $YT->setKey(pack("\x48\x2a", sha1($ah)));
                $ZZ .= "\120\162\x69\166\x61\x74\x65\x2d\x4d\x41\x43\72\40" . bin2hex($YT->hash($Y9)) . "\15\12";
                return $ZZ;
            default:
                $hz = array();
                foreach ($hb as $jd => $Da) {
                    $hz[$jd] = pack("\x43\x61\52\141\52", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($Da)), $Da);
                    oI:
                }
                Ew:
                $Xg = implode('', $hz);
                if (!($Il > 2)) {
                    goto i1;
                }
                $mt = '';
                $zh = 3;
                e8:
                if (!($zh <= $Il)) {
                    goto Wz;
                }
                $AB = pack("\103\141\52\141\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($zN[$zh]->toBytes(true))), $zN[$zh]->toBytes(true));
                $AB .= pack("\103\141\52\141\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($H3[$zh]->toBytes(true))), $H3[$zh]->toBytes(true));
                $AB .= pack("\103\x61\52\141\x2a", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($WH[$zh]->toBytes(true))), $WH[$zh]->toBytes(true));
                $mt .= pack("\103\x61\x2a\x61\x2a", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($AB)), $AB);
                E0:
                $zh++;
                goto e8;
                Wz:
                $Xg .= pack("\x43\x61\52\x61\x2a", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($mt)), $mt);
                i1:
                $Xg = pack("\x43\141\52\141\x2a", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($Xg)), $Xg);
                if (!($this->privateKeyFormat == CRYPT_RSA_PRIVATE_FORMAT_PKCS8)) {
                    goto pK;
                }
                $bN = pack("\x48\x2a", "\63\60\60\144\x30\x36\60\x39\x32\141\70\66\64\x38\x38\x36\146\67\x30\144\x30\x31\60\x31\60\61\x30\65\60\60");
                $Xg = pack("\103\141\52\141\52\103\x61\x2a\x61\x2a", CRYPT_RSA_ASN1_INTEGER, "\x1\x0", $bN, 4, $this->_encodeLength(strlen($Xg)), $Xg);
                $Xg = pack("\x43\x61\x2a\x61\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($Xg)), $Xg);
                if (!empty($this->password) || is_string($this->password)) {
                    goto Oy;
                }
                $Xg = "\55\55\55\55\x2d\x42\x45\x47\x49\116\x20\x50\x52\x49\126\101\124\105\40\x4b\x45\x59\x2d\55\x2d\55\x2d\15\12" . chunk_split(base64_encode($Xg), 64) . "\55\55\x2d\55\55\x45\116\x44\x20\120\x52\111\x56\101\124\x45\40\x4b\105\x59\x2d\55\x2d\x2d\55";
                goto Kg;
                Oy:
                $wO = crypt_random_string(8);
                $q6 = 2048;
                if (class_exists("\103\x72\171\x70\164\137\104\105\x53")) {
                    goto Jx;
                }
                include_once "\103\162\x79\x70\164\x2f\x44\x45\x53\x2e\160\x68\160";
                Jx:
                $w1 = new Crypt_DES();
                $w1->setPassword($this->password, "\160\142\x6b\144\x66\61", "\x6d\144\65", $wO, $q6);
                $Xg = $w1->encrypt($Xg);
                $Jj = pack("\103\x61\x2a\x61\x2a\103\141\52\x4e", CRYPT_RSA_ASN1_OCTETSTRING, $this->_encodeLength(strlen($wO)), $wO, CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(4), $q6);
                $EK = "\52\206\x48\x86\xf7\xd\x1\x5\3";
                $f7 = pack("\x43\141\x2a\x61\x2a\x43\x61\52\141\52", CRYPT_RSA_ASN1_OBJECT, $this->_encodeLength(strlen($EK)), $EK, CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($Jj)), $Jj);
                $Xg = pack("\103\x61\x2a\141\52\x43\141\x2a\141\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($f7)), $f7, CRYPT_RSA_ASN1_OCTETSTRING, $this->_encodeLength(strlen($Xg)), $Xg);
                $Xg = pack("\x43\x61\52\x61\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($Xg)), $Xg);
                $Xg = "\55\55\55\x2d\55\x42\105\x47\x49\x4e\x20\x45\x4e\103\122\x59\120\x54\105\x44\x20\120\122\x49\126\x41\124\105\40\113\x45\x59\x2d\x2d\x2d\x2d\x2d\xd\xa" . chunk_split(base64_encode($Xg), 64) . "\55\55\55\55\x2d\105\x4e\104\x20\x45\116\x43\x52\x59\x50\124\105\104\40\x50\x52\111\x56\101\124\105\x20\x4b\x45\x59\55\x2d\x2d\x2d\x2d";
                Kg:
                return $Xg;
                pK:
                if (!empty($this->password) || is_string($this->password)) {
                    goto uQ;
                }
                $Xg = "\55\x2d\x2d\x2d\55\102\x45\x47\111\x4e\40\122\123\101\x20\x50\122\111\126\101\x54\105\40\x4b\105\131\55\x2d\x2d\55\x2d\15\xa" . chunk_split(base64_encode($Xg), 64) . "\x2d\55\55\x2d\x2d\105\116\x44\x20\122\x53\101\40\x50\x52\x49\x56\101\x54\105\x20\113\105\x59\x2d\x2d\x2d\55\55";
                goto tn;
                uQ:
                $YK = crypt_random_string(8);
                $Dn = pack("\x48\52", md5($this->password . $YK));
                $Dn .= substr(pack("\x48\x2a", md5($Dn . $this->password . $YK)), 0, 8);
                if (class_exists("\x43\x72\171\x70\164\x5f\x54\162\151\x70\154\x65\x44\105\x53")) {
                    goto lq;
                }
                include_once "\x43\162\171\160\164\x2f\x54\162\151\x70\154\x65\104\105\x53\56\x70\x68\160";
                lq:
                $YJ = new Crypt_TripleDES();
                $YJ->setKey($Dn);
                $YJ->setIV($YK);
                $YK = strtoupper(bin2hex($YK));
                $Xg = "\x2d\x2d\55\x2d\x2d\x42\x45\107\x49\x4e\x20\x52\123\101\40\120\122\x49\x56\x41\x54\105\x20\113\105\131\x2d\55\x2d\55\55\15\12" . "\120\x72\x6f\143\55\x54\x79\160\x65\72\40\64\x2c\105\x4e\x43\122\131\120\124\x45\x44\xd\xa" . "\104\105\x4b\x2d\x49\x6e\x66\x6f\72\40\x44\x45\x53\55\x45\x44\x45\63\x2d\103\x42\103\54{$YK}\15\xa" . "\xd\12" . chunk_split(base64_encode($YJ->encrypt($Xg)), 64) . "\55\55\x2d\55\55\x45\116\104\x20\122\x53\x41\x20\x50\122\111\126\x41\x54\x45\40\113\105\x59\x2d\55\55\55\55";
                tn:
                return $Xg;
        }
        tx:
        Z8:
    }
    function _convertPublicKey($LN, $hq)
    {
        $cO = $this->publicKeyFormat != CRYPT_RSA_PUBLIC_FORMAT_XML;
        $oo = $LN->toBytes($cO);
        $pH = $hq->toBytes($cO);
        switch ($this->publicKeyFormat) {
            case CRYPT_RSA_PUBLIC_FORMAT_RAW:
                return array("\145" => $hq->copy(), "\156" => $LN->copy());
            case CRYPT_RSA_PUBLIC_FORMAT_XML:
                return "\74\x52\x53\x41\113\x65\171\126\141\154\x75\x65\76\15\12" . "\40\40\x3c\x4d\157\x64\165\154\x75\163\x3e" . base64_encode($oo) . "\74\57\x4d\x6f\x64\165\x6c\x75\x73\x3e\15\12" . "\40\x20\74\x45\170\x70\157\x6e\145\156\x74\x3e" . base64_encode($pH) . "\74\57\x45\x78\160\157\156\145\156\x74\76\xd\12" . "\x3c\57\x52\123\101\x4b\145\171\126\x61\x6c\165\145\76";
                goto Cp;
            case CRYPT_RSA_PUBLIC_FORMAT_OPENSSH:
                $ON = pack("\116\x61\52\x4e\141\52\116\141\52", strlen("\x73\163\150\55\162\163\141"), "\163\x73\150\x2d\x72\163\141", strlen($pH), $pH, strlen($oo), $oo);
                $ON = "\x73\x73\150\55\162\163\141\x20" . base64_encode($ON) . "\40" . $this->comment;
                return $ON;
            default:
                $hz = array("\155\157\144\165\x6c\x75\x73" => pack("\103\141\52\x61\52", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($oo)), $oo), "\x70\165\x62\154\x69\x63\x45\170\x70\x6f\156\x65\x6e\x74" => pack("\103\141\x2a\x61\52", CRYPT_RSA_ASN1_INTEGER, $this->_encodeLength(strlen($pH)), $pH));
                $ON = pack("\x43\141\52\141\52\x61\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($hz["\155\x6f\144\x75\x6c\165\163"]) + strlen($hz["\x70\x75\142\154\151\143\105\170\x70\157\x6e\x65\x6e\x74"])), $hz["\x6d\157\x64\x75\x6c\x75\x73"], $hz["\x70\165\142\154\x69\143\105\170\160\x6f\x6e\145\x6e\x74"]);
                if ($this->publicKeyFormat == CRYPT_RSA_PUBLIC_FORMAT_PKCS1_RAW) {
                    goto aT;
                }
                $bN = pack("\x48\52", "\63\60\60\x64\x30\x36\60\71\62\141\x38\66\64\x38\70\x36\146\67\60\144\x30\61\60\61\60\x31\x30\x35\x30\60");
                $ON = chr(0) . $ON;
                $ON = chr(3) . $this->_encodeLength(strlen($ON)) . $ON;
                $ON = pack("\x43\141\52\141\52", CRYPT_RSA_ASN1_SEQUENCE, $this->_encodeLength(strlen($bN . $ON)), $bN . $ON);
                $ON = "\x2d\x2d\x2d\x2d\x2d\102\x45\107\111\x4e\40\x50\x55\x42\x4c\x49\x43\40\x4b\x45\131\55\x2d\55\55\55\15\xa" . chunk_split(base64_encode($ON), 64) . "\55\55\55\55\x2d\105\116\104\40\120\125\x42\114\111\103\40\113\x45\x59\55\x2d\55\55\x2d";
                goto La;
                aT:
                $ON = "\x2d\55\x2d\x2d\x2d\x42\105\x47\111\x4e\40\122\x53\101\40\120\125\102\114\111\103\40\113\x45\131\x2d\55\55\x2d\55\xd\12" . chunk_split(base64_encode($ON), 64) . "\55\55\55\x2d\x2d\105\116\104\x20\122\123\101\x20\x50\x55\x42\x4c\111\103\x20\x4b\105\131\55\x2d\55\55\x2d";
                La:
                return $ON;
        }
        YR:
        Cp:
    }
    function _parseKey($ZZ, $lX)
    {
        if (!($lX != CRYPT_RSA_PUBLIC_FORMAT_RAW && !is_string($ZZ))) {
            goto pl;
        }
        return false;
        pl:
        switch ($lX) {
            case CRYPT_RSA_PUBLIC_FORMAT_RAW:
                if (is_array($ZZ)) {
                    goto UY;
                }
                return false;
                UY:
                $hz = array();
                switch (true) {
                    case isset($ZZ["\145"]):
                        $hz["\160\x75\142\154\151\143\105\170\x70\157\x6e\145\156\x74"] = $ZZ["\145"]->copy();
                        goto XU;
                    case isset($ZZ["\145\170\160\157\156\145\x6e\x74"]):
                        $hz["\x70\165\142\154\x69\143\x45\170\x70\157\156\145\x6e\x74"] = $ZZ["\145\x78\160\x6f\156\x65\156\x74"]->copy();
                        goto XU;
                    case isset($ZZ["\x70\x75\x62\154\151\x63\105\x78\x70\157\156\145\x6e\x74"]):
                        $hz["\x70\165\142\154\x69\x63\x45\x78\160\x6f\156\145\156\x74"] = $ZZ["\160\165\x62\154\151\x63\105\x78\160\x6f\156\x65\156\164"]->copy();
                        goto XU;
                    case isset($ZZ[0]):
                        $hz["\160\x75\x62\x6c\151\x63\105\170\x70\x6f\156\145\x6e\x74"] = $ZZ[0]->copy();
                }
                pe:
                XU:
                switch (true) {
                    case isset($ZZ["\x6e"]):
                        $hz["\x6d\157\x64\165\154\165\x73"] = $ZZ["\156"]->copy();
                        goto ax;
                    case isset($ZZ["\155\x6f\x64\x75\x6c\x6f"]):
                        $hz["\x6d\x6f\x64\165\x6c\165\x73"] = $ZZ["\155\157\144\x75\x6c\x6f"]->copy();
                        goto ax;
                    case isset($ZZ["\155\157\144\165\x6c\165\x73"]):
                        $hz["\x6d\x6f\144\x75\154\165\x73"] = $ZZ["\x6d\x6f\144\x75\x6c\x75\x73"]->copy();
                        goto ax;
                    case isset($ZZ[1]):
                        $hz["\155\157\x64\165\x6c\x75\x73"] = $ZZ[1]->copy();
                }
                qh:
                ax:
                return isset($hz["\x6d\157\x64\165\154\165\163"]) && isset($hz["\160\165\142\154\151\x63\x45\x78\160\157\156\145\156\x74"]) ? $hz : false;
            case CRYPT_RSA_PRIVATE_FORMAT_PKCS1:
            case CRYPT_RSA_PRIVATE_FORMAT_PKCS8:
            case CRYPT_RSA_PUBLIC_FORMAT_PKCS1:
                if (preg_match("\x23\104\105\x4b\55\111\156\x66\157\x3a\x20\50\56\53\x29\54\50\x2e\x2b\51\x23", $ZZ, $xE)) {
                    goto qz;
                }
                $F0 = $this->_extractBER($ZZ);
                goto Wg;
                qz:
                $YK = pack("\x48\x2a", trim($xE[2]));
                $Dn = pack("\110\52", md5($this->password . substr($YK, 0, 8)));
                $Dn .= pack("\110\x2a", md5($Dn . $this->password . substr($YK, 0, 8)));
                $ZZ = preg_replace("\x23\x5e\x28\77\72\x50\162\157\143\x2d\124\171\x70\x65\x7c\104\x45\x4b\x2d\111\156\146\157\x29\72\40\x2e\52\43\x6d", '', $ZZ);
                $Gr = $this->_extractBER($ZZ);
                if (!($Gr === false)) {
                    goto ZB;
                }
                $Gr = $ZZ;
                ZB:
                switch ($xE[1]) {
                    case "\x41\105\123\x2d\62\x35\x36\x2d\x43\102\103":
                        if (class_exists("\x43\162\171\x70\x74\x5f\x41\105\123")) {
                            goto Wb;
                        }
                        include_once "\103\x72\171\x70\164\57\101\105\123\x2e\x70\150\x70";
                        Wb:
                        $w1 = new Crypt_AES();
                        goto JI;
                    case "\101\105\123\55\61\62\x38\x2d\103\x42\x43":
                        if (class_exists("\x43\162\171\160\x74\x5f\x41\105\123")) {
                            goto iM;
                        }
                        include_once "\103\x72\x79\160\x74\x2f\x41\105\123\x2e\x70\x68\x70";
                        iM:
                        $Dn = substr($Dn, 0, 16);
                        $w1 = new Crypt_AES();
                        goto JI;
                    case "\x44\x45\123\x2d\105\x44\105\x33\55\x43\106\x42":
                        if (class_exists("\x43\162\171\x70\x74\x5f\x54\162\x69\x70\154\145\x44\105\x53")) {
                            goto UB;
                        }
                        include_once "\103\x72\171\160\164\x2f\x54\162\151\160\x6c\145\104\x45\x53\x2e\x70\x68\160";
                        UB:
                        $w1 = new Crypt_TripleDES(CRYPT_DES_MODE_CFB);
                        goto JI;
                    case "\104\105\x53\x2d\x45\x44\x45\x33\x2d\x43\x42\103":
                        if (class_exists("\103\x72\x79\160\x74\137\124\162\151\160\154\145\x44\105\x53")) {
                            goto q2;
                        }
                        include_once "\x43\x72\x79\x70\164\x2f\124\162\151\160\154\x65\104\105\x53\56\x70\x68\x70";
                        q2:
                        $Dn = substr($Dn, 0, 24);
                        $w1 = new Crypt_TripleDES();
                        goto JI;
                    case "\x44\x45\x53\55\103\x42\103":
                        if (class_exists("\x43\x72\x79\x70\164\x5f\104\105\123")) {
                            goto o1;
                        }
                        include_once "\103\x72\x79\x70\x74\x2f\104\x45\x53\x2e\160\150\x70";
                        o1:
                        $w1 = new Crypt_DES();
                        goto JI;
                    default:
                        return false;
                }
                dr:
                JI:
                $w1->setKey($Dn);
                $w1->setIV($YK);
                $F0 = $w1->decrypt($Gr);
                Wg:
                if (!($F0 !== false)) {
                    goto Ux;
                }
                $ZZ = $F0;
                Ux:
                $hz = array();
                if (!(ord($this->_string_shift($ZZ)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto Bl;
                }
                return false;
                Bl:
                if (!($this->_decodeLength($ZZ) != strlen($ZZ))) {
                    goto IU;
                }
                return false;
                IU:
                $Ar = ord($this->_string_shift($ZZ));
                if (!($Ar == CRYPT_RSA_ASN1_INTEGER && substr($ZZ, 0, 3) == "\x1\0\60")) {
                    goto y9;
                }
                $this->_string_shift($ZZ, 3);
                $Ar = CRYPT_RSA_ASN1_SEQUENCE;
                y9:
                if (!($Ar == CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto Qb;
                }
                $iP = $this->_string_shift($ZZ, $this->_decodeLength($ZZ));
                if (!(ord($this->_string_shift($iP)) != CRYPT_RSA_ASN1_OBJECT)) {
                    goto cs;
                }
                return false;
                cs:
                $bw = $this->_decodeLength($iP);
                switch ($this->_string_shift($iP, $bw)) {
                    case "\x2a\206\110\206\xf7\xd\x1\1\x1":
                        goto Dq;
                    case "\x2a\206\110\206\367\15\1\x5\x3":
                        if (!(ord($this->_string_shift($iP)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                            goto ni;
                        }
                        return false;
                        ni:
                        if (!($this->_decodeLength($iP) != strlen($iP))) {
                            goto Qf;
                        }
                        return false;
                        Qf:
                        $this->_string_shift($iP);
                        $wO = $this->_string_shift($iP, $this->_decodeLength($iP));
                        if (!(ord($this->_string_shift($iP)) != CRYPT_RSA_ASN1_INTEGER)) {
                            goto Xs;
                        }
                        return false;
                        Xs:
                        $this->_decodeLength($iP);
                        list(, $q6) = unpack("\116", str_pad($iP, 4, chr(0), STR_PAD_LEFT));
                        $this->_string_shift($ZZ);
                        $bw = $this->_decodeLength($ZZ);
                        if (!(strlen($ZZ) != $bw)) {
                            goto Wy;
                        }
                        return false;
                        Wy:
                        if (class_exists("\x43\162\171\160\164\137\104\105\123")) {
                            goto Nb;
                        }
                        include_once "\x43\162\x79\160\x74\x2f\104\x45\123\x2e\x70\x68\x70";
                        Nb:
                        $w1 = new Crypt_DES();
                        $w1->setPassword($this->password, "\x70\142\x6b\144\x66\61", "\x6d\x64\x35", $wO, $q6);
                        $ZZ = $w1->decrypt($ZZ);
                        if (!($ZZ === false)) {
                            goto AV;
                        }
                        return false;
                        AV:
                        return $this->_parseKey($ZZ, CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
                    default:
                        return false;
                }
                Is:
                Dq:
                $Ar = ord($this->_string_shift($ZZ));
                $this->_decodeLength($ZZ);
                if (!($Ar == CRYPT_RSA_ASN1_BITSTRING)) {
                    goto bx;
                }
                $this->_string_shift($ZZ);
                bx:
                if (!(ord($this->_string_shift($ZZ)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto WS;
                }
                return false;
                WS:
                if (!($this->_decodeLength($ZZ) != strlen($ZZ))) {
                    goto dH;
                }
                return false;
                dH:
                $Ar = ord($this->_string_shift($ZZ));
                Qb:
                if (!($Ar != CRYPT_RSA_ASN1_INTEGER)) {
                    goto p0;
                }
                return false;
                p0:
                $bw = $this->_decodeLength($ZZ);
                $iP = $this->_string_shift($ZZ, $bw);
                if (!(strlen($iP) != 1 || ord($iP) > 2)) {
                    goto di;
                }
                $hz["\155\157\144\x75\154\x75\163"] = new Math_BigInteger($iP, 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz[$lX == CRYPT_RSA_PUBLIC_FORMAT_PKCS1 ? "\160\x75\142\154\151\143\x45\x78\x70\157\156\145\156\x74" : "\x70\162\x69\x76\141\164\145\x45\x78\x70\x6f\156\x65\156\164"] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                return $hz;
                di:
                if (!(ord($this->_string_shift($ZZ)) != CRYPT_RSA_ASN1_INTEGER)) {
                    goto GI;
                }
                return false;
                GI:
                $bw = $this->_decodeLength($ZZ);
                $hz["\155\x6f\x64\x75\154\165\163"] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\160\165\142\154\x69\143\x45\x78\160\x6f\156\x65\x6e\x74"] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\x70\162\x69\x76\x61\x74\x65\x45\170\160\157\156\x65\x6e\x74"] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\x70\162\151\155\145\x73"] = array(1 => new Math_BigInteger($this->_string_shift($ZZ, $bw), 256));
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\x70\x72\x69\x6d\145\x73"][] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\x65\170\x70\x6f\156\145\x6e\x74\x73"] = array(1 => new Math_BigInteger($this->_string_shift($ZZ, $bw), 256));
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\x65\170\160\x6f\156\x65\156\x74\163"][] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\143\157\145\146\146\x69\x63\x69\145\156\x74\163"] = array(2 => new Math_BigInteger($this->_string_shift($ZZ, $bw), 256));
                if (empty($ZZ)) {
                    goto OF;
                }
                if (!(ord($this->_string_shift($ZZ)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto m6;
                }
                return false;
                m6:
                $this->_decodeLength($ZZ);
                gf:
                if (empty($ZZ)) {
                    goto Ya;
                }
                if (!(ord($this->_string_shift($ZZ)) != CRYPT_RSA_ASN1_SEQUENCE)) {
                    goto A_;
                }
                return false;
                A_:
                $this->_decodeLength($ZZ);
                $ZZ = substr($ZZ, 1);
                $bw = $this->_decodeLength($ZZ);
                $hz["\160\162\x69\155\x65\163"][] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\145\170\x70\x6f\156\145\156\164\163"][] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                $this->_string_shift($ZZ);
                $bw = $this->_decodeLength($ZZ);
                $hz["\143\157\x65\146\146\151\x63\x69\x65\x6e\164\163"][] = new Math_BigInteger($this->_string_shift($ZZ, $bw), 256);
                goto gf;
                Ya:
                OF:
                return $hz;
            case CRYPT_RSA_PUBLIC_FORMAT_OPENSSH:
                $D4 = explode("\x20", $ZZ, 3);
                $ZZ = isset($D4[1]) ? base64_decode($D4[1]) : false;
                if (!($ZZ === false)) {
                    goto rn;
                }
                return false;
                rn:
                $wB = isset($D4[2]) ? $D4[2] : false;
                $pg = substr($ZZ, 0, 11) == "\0\0\0\x7\x73\163\150\55\x72\x73\x61";
                if (!(strlen($ZZ) <= 4)) {
                    goto Jp;
                }
                return false;
                Jp:
                extract(unpack("\116\154\x65\156\147\x74\150", $this->_string_shift($ZZ, 4)));
                $pH = new Math_BigInteger($this->_string_shift($ZZ, $bw), -256);
                if (!(strlen($ZZ) <= 4)) {
                    goto im;
                }
                return false;
                im:
                extract(unpack("\x4e\x6c\x65\156\x67\164\150", $this->_string_shift($ZZ, 4)));
                $oo = new Math_BigInteger($this->_string_shift($ZZ, $bw), -256);
                if ($pg && strlen($ZZ)) {
                    goto Ao;
                }
                return strlen($ZZ) ? false : array("\x6d\157\144\165\154\165\x73" => $oo, "\160\x75\142\x6c\151\143\x45\x78\x70\x6f\156\145\x6e\164" => $pH, "\x63\157\155\155\x65\x6e\164" => $wB);
                goto r9;
                Ao:
                if (!(strlen($ZZ) <= 4)) {
                    goto E8;
                }
                return false;
                E8:
                extract(unpack("\116\x6c\x65\156\x67\164\x68", $this->_string_shift($ZZ, 4)));
                $re = new Math_BigInteger($this->_string_shift($ZZ, $bw), -256);
                return strlen($ZZ) ? false : array("\x6d\157\x64\165\154\165\x73" => $re, "\160\x75\142\x6c\x69\143\105\x78\x70\x6f\156\145\x6e\x74" => $oo, "\143\157\155\155\145\x6e\164" => $wB);
                r9:
            case CRYPT_RSA_PRIVATE_FORMAT_XML:
            case CRYPT_RSA_PUBLIC_FORMAT_XML:
                $this->components = array();
                $Xk = xml_parser_create("\125\x54\x46\x2d\70");
                xml_set_object($Xk, $this);
                xml_set_element_handler($Xk, "\137\163\164\141\162\x74\137\145\x6c\x65\155\x65\x6e\x74\137\x68\x61\156\144\154\145\x72", "\137\163\x74\157\x70\137\x65\154\x65\155\145\156\x74\x5f\150\x61\156\x64\x6c\x65\162");
                xml_set_character_data_handler($Xk, "\x5f\144\141\164\x61\137\150\x61\156\x64\x6c\145\x72");
                if (xml_parse($Xk, "\74\170\155\154\x3e" . $ZZ . "\74\x2f\170\155\x6c\x3e")) {
                    goto lw;
                }
                return false;
                lw:
                return isset($this->components["\155\x6f\144\165\154\165\x73"]) && isset($this->components["\160\165\142\154\x69\x63\x45\x78\x70\157\156\145\x6e\x74"]) ? $this->components : false;
            case CRYPT_RSA_PRIVATE_FORMAT_PUTTY:
                $hz = array();
                $ZZ = preg_split("\x23\134\162\134\156\x7c\x5c\x72\x7c\x5c\156\x23", $ZZ);
                $lX = trim(preg_replace("\x23\120\x75\x54\x54\x59\x2d\125\x73\x65\x72\x2d\x4b\145\x79\x2d\x46\x69\154\145\55\62\72\40\50\x2e\x2b\x29\43", "\44\61", $ZZ[0]));
                if (!($lX != "\163\x73\x68\x2d\x72\163\x61")) {
                    goto WD;
                }
                return false;
                WD:
                $oh = trim(preg_replace("\43\x45\x6e\143\162\171\160\x74\151\x6f\x6e\72\x20\x28\x2e\53\51\43", "\44\61", $ZZ[1]));
                $wB = trim(preg_replace("\43\103\x6f\155\x6d\145\x6e\x74\72\x20\x28\x2e\x2b\51\43", "\44\x31", $ZZ[2]));
                $hH = trim(preg_replace("\x23\120\x75\142\154\151\x63\x2d\x4c\x69\156\x65\x73\72\40\50\x5c\x64\x2b\51\43", "\x24\61", $ZZ[3]));
                $Fb = base64_decode(implode('', array_map("\x74\x72\151\x6d", array_slice($ZZ, 4, $hH))));
                $Fb = substr($Fb, 11);
                extract(unpack("\x4e\x6c\x65\x6e\147\164\150", $this->_string_shift($Fb, 4)));
                $hz["\x70\x75\x62\x6c\151\x63\105\x78\x70\157\156\x65\x6e\x74"] = new Math_BigInteger($this->_string_shift($Fb, $bw), -256);
                extract(unpack("\116\x6c\x65\156\x67\x74\x68", $this->_string_shift($Fb, 4)));
                $hz["\155\x6f\x64\x75\x6c\165\163"] = new Math_BigInteger($this->_string_shift($Fb, $bw), -256);
                $zs = trim(preg_replace("\x23\120\162\x69\166\141\x74\145\x2d\114\151\x6e\x65\163\x3a\x20\x28\134\x64\x2b\51\43", "\x24\x31", $ZZ[$hH + 4]));
                $GZ = base64_decode(implode('', array_map("\164\162\151\155", array_slice($ZZ, $hH + 5, $zs))));
                switch ($oh) {
                    case "\141\x65\163\62\65\x36\x2d\x63\142\143":
                        if (class_exists("\103\x72\171\160\x74\x5f\101\105\123")) {
                            goto A0;
                        }
                        include_once "\103\x72\171\x70\164\x2f\101\x45\x53\56\x70\150\x70";
                        A0:
                        $Dn = '';
                        $RW = 0;
                        Bt:
                        if (!(strlen($Dn) < 32)) {
                            goto rd;
                        }
                        $iP = pack("\116\141\x2a", $RW++, $this->password);
                        $Dn .= pack("\110\x2a", sha1($iP));
                        goto Bt;
                        rd:
                        $Dn = substr($Dn, 0, 32);
                        $w1 = new Crypt_AES();
                }
                YQ:
                i_:
                if (!($oh != "\156\x6f\x6e\145")) {
                    goto op;
                }
                $w1->setKey($Dn);
                $w1->disablePadding();
                $GZ = $w1->decrypt($GZ);
                if (!($GZ === false)) {
                    goto Vw;
                }
                return false;
                Vw:
                op:
                extract(unpack("\116\154\145\156\147\164\x68", $this->_string_shift($GZ, 4)));
                if (!(strlen($GZ) < $bw)) {
                    goto Ht;
                }
                return false;
                Ht:
                $hz["\x70\162\x69\166\x61\164\145\105\x78\x70\x6f\x6e\145\x6e\164"] = new Math_BigInteger($this->_string_shift($GZ, $bw), -256);
                extract(unpack("\116\x6c\x65\156\147\164\x68", $this->_string_shift($GZ, 4)));
                if (!(strlen($GZ) < $bw)) {
                    goto pR;
                }
                return false;
                pR:
                $hz["\160\162\151\x6d\x65\163"] = array(1 => new Math_BigInteger($this->_string_shift($GZ, $bw), -256));
                extract(unpack("\116\x6c\x65\156\x67\x74\x68", $this->_string_shift($GZ, 4)));
                if (!(strlen($GZ) < $bw)) {
                    goto PN;
                }
                return false;
                PN:
                $hz["\x70\x72\151\155\145\x73"][] = new Math_BigInteger($this->_string_shift($GZ, $bw), -256);
                $iP = $hz["\x70\x72\151\155\145\163"][1]->subtract($this->one);
                $hz["\x65\170\x70\157\156\145\156\x74\163"] = array(1 => $hz["\x70\165\142\x6c\151\x63\105\170\x70\x6f\x6e\145\156\164"]->modInverse($iP));
                $iP = $hz["\x70\x72\x69\x6d\x65\163"][2]->subtract($this->one);
                $hz["\x65\170\x70\x6f\156\145\x6e\164\x73"][] = $hz["\x70\165\142\154\151\x63\105\x78\x70\157\156\x65\x6e\x74"]->modInverse($iP);
                extract(unpack("\116\154\145\156\147\x74\150", $this->_string_shift($GZ, 4)));
                if (!(strlen($GZ) < $bw)) {
                    goto w9;
                }
                return false;
                w9:
                $hz["\143\x6f\145\x66\146\x69\x63\x69\145\156\164\x73"] = array(2 => new Math_BigInteger($this->_string_shift($GZ, $bw), -256));
                return $hz;
        }
        F7:
        tU:
    }
    function getSize()
    {
        return !isset($this->modulus) ? 0 : strlen($this->modulus->toBits());
    }
    function _start_element_handler($Ve, $jd, $tz)
    {
        switch ($jd) {
            case "\115\x4f\104\125\114\125\123":
                $this->current =& $this->components["\155\x6f\144\x75\x6c\165\x73"];
                goto lP;
            case "\x45\x58\120\117\x4e\105\116\124":
                $this->current =& $this->components["\160\165\x62\x6c\x69\x63\x45\x78\160\157\x6e\x65\156\164"];
                goto lP;
            case "\120":
                $this->current =& $this->components["\x70\x72\151\155\145\x73"][1];
                goto lP;
            case "\121":
                $this->current =& $this->components["\x70\x72\x69\155\x65\x73"][2];
                goto lP;
            case "\104\120":
                $this->current =& $this->components["\145\170\160\157\156\x65\x6e\164\x73"][1];
                goto lP;
            case "\104\121":
                $this->current =& $this->components["\145\x78\160\157\156\x65\156\x74\x73"][2];
                goto lP;
            case "\111\116\126\x45\122\123\105\121":
                $this->current =& $this->components["\143\x6f\x65\146\146\151\143\151\145\156\x74\163"][2];
                goto lP;
            case "\104":
                $this->current =& $this->components["\x70\x72\151\x76\x61\164\145\x45\x78\x70\157\156\x65\156\x74"];
        }
        O3:
        lP:
        $this->current = '';
    }
    function _stop_element_handler($Ve, $jd)
    {
        if (!isset($this->current)) {
            goto Bq;
        }
        $this->current = new Math_BigInteger(base64_decode($this->current), 256);
        unset($this->current);
        Bq:
    }
    function _data_handler($Ve, $S3)
    {
        if (!(!isset($this->current) || is_object($this->current))) {
            goto s9;
        }
        return;
        s9:
        $this->current .= trim($S3);
    }
    function loadKey($ZZ, $lX = false)
    {
        if (!(is_object($ZZ) && strtolower(get_class($ZZ)) == "\x63\x72\x79\160\x74\x5f\x72\x73\141")) {
            goto Qt;
        }
        $this->privateKeyFormat = $ZZ->privateKeyFormat;
        $this->publicKeyFormat = $ZZ->publicKeyFormat;
        $this->k = $ZZ->k;
        $this->hLen = $ZZ->hLen;
        $this->sLen = $ZZ->sLen;
        $this->mgfHLen = $ZZ->mgfHLen;
        $this->encryptionMode = $ZZ->encryptionMode;
        $this->signatureMode = $ZZ->signatureMode;
        $this->password = $ZZ->password;
        $this->configFile = $ZZ->configFile;
        $this->comment = $ZZ->comment;
        if (!is_object($ZZ->hash)) {
            goto Fv;
        }
        $this->hash = new Crypt_Hash($ZZ->hash->getHash());
        Fv:
        if (!is_object($ZZ->mgfHash)) {
            goto P5;
        }
        $this->mgfHash = new Crypt_Hash($ZZ->mgfHash->getHash());
        P5:
        if (!is_object($ZZ->modulus)) {
            goto ky;
        }
        $this->modulus = $ZZ->modulus->copy();
        ky:
        if (!is_object($ZZ->exponent)) {
            goto F3;
        }
        $this->exponent = $ZZ->exponent->copy();
        F3:
        if (!is_object($ZZ->publicExponent)) {
            goto Bw;
        }
        $this->publicExponent = $ZZ->publicExponent->copy();
        Bw:
        $this->primes = array();
        $this->exponents = array();
        $this->coefficients = array();
        foreach ($this->primes as $g1) {
            $this->primes[] = $g1->copy();
            ay:
        }
        k9:
        foreach ($this->exponents as $op) {
            $this->exponents[] = $op->copy();
            KV:
        }
        bC:
        foreach ($this->coefficients as $EW) {
            $this->coefficients[] = $EW->copy();
            M_:
        }
        nT:
        return true;
        Qt:
        if ($lX === false) {
            goto lD;
        }
        $hz = $this->_parseKey($ZZ, $lX);
        goto XX;
        lD:
        $o4 = array(CRYPT_RSA_PUBLIC_FORMAT_RAW, CRYPT_RSA_PRIVATE_FORMAT_PKCS1, CRYPT_RSA_PRIVATE_FORMAT_XML, CRYPT_RSA_PRIVATE_FORMAT_PUTTY, CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
        foreach ($o4 as $lX) {
            $hz = $this->_parseKey($ZZ, $lX);
            if (!($hz !== false)) {
                goto av;
            }
            goto jt;
            av:
            Y8:
        }
        jt:
        XX:
        if (!($hz === false)) {
            goto ab;
        }
        $this->comment = null;
        $this->modulus = null;
        $this->k = null;
        $this->exponent = null;
        $this->primes = null;
        $this->exponents = null;
        $this->coefficients = null;
        $this->publicExponent = null;
        return false;
        ab:
        if (!(isset($hz["\x63\x6f\x6d\155\x65\156\164"]) && $hz["\x63\157\155\155\145\156\164"] !== false)) {
            goto mR;
        }
        $this->comment = $hz["\x63\x6f\155\x6d\145\x6e\164"];
        mR:
        $this->modulus = $hz["\155\x6f\144\165\154\165\x73"];
        $this->k = strlen($this->modulus->toBytes());
        $this->exponent = isset($hz["\x70\162\151\166\x61\x74\x65\105\170\160\x6f\x6e\x65\x6e\164"]) ? $hz["\160\162\x69\166\x61\164\x65\105\x78\x70\157\x6e\x65\156\x74"] : $hz["\160\165\x62\154\x69\x63\105\170\x70\157\156\x65\156\164"];
        if (isset($hz["\160\162\151\x6d\x65\163"])) {
            goto hT;
        }
        $this->primes = array();
        $this->exponents = array();
        $this->coefficients = array();
        $this->publicExponent = false;
        goto fd;
        hT:
        $this->primes = $hz["\160\162\151\x6d\x65\163"];
        $this->exponents = $hz["\145\170\160\157\156\x65\x6e\x74\x73"];
        $this->coefficients = $hz["\x63\x6f\x65\x66\x66\151\143\x69\x65\156\164\x73"];
        $this->publicExponent = $hz["\x70\165\x62\x6c\151\x63\105\170\160\157\156\x65\156\164"];
        fd:
        switch ($lX) {
            case CRYPT_RSA_PUBLIC_FORMAT_OPENSSH:
            case CRYPT_RSA_PUBLIC_FORMAT_RAW:
                $this->setPublicKey();
                goto zh;
            case CRYPT_RSA_PRIVATE_FORMAT_PKCS1:
                switch (true) {
                    case strpos($ZZ, "\55\x42\105\x47\111\116\40\x50\125\102\114\x49\x43\x20\x4b\105\131\x2d") !== false:
                    case strpos($ZZ, "\x2d\x42\x45\107\x49\x4e\x20\122\x53\x41\40\120\x55\102\x4c\111\x43\x20\113\x45\x59\55") !== false:
                        $this->setPublicKey();
                }
                fL:
                Qy:
        }
        vj:
        zh:
        return true;
    }
    function setPassword($Ij = false)
    {
        $this->password = $Ij;
    }
    function setPublicKey($ZZ = false, $lX = false)
    {
        if (empty($this->publicExponent)) {
            goto Cv;
        }
        return false;
        Cv:
        if (!($ZZ === false && !empty($this->modulus))) {
            goto Le;
        }
        $this->publicExponent = $this->exponent;
        return true;
        Le:
        if ($lX === false) {
            goto Kl;
        }
        $hz = $this->_parseKey($ZZ, $lX);
        goto st;
        Kl:
        $o4 = array(CRYPT_RSA_PUBLIC_FORMAT_RAW, CRYPT_RSA_PUBLIC_FORMAT_PKCS1, CRYPT_RSA_PUBLIC_FORMAT_XML, CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
        foreach ($o4 as $lX) {
            $hz = $this->_parseKey($ZZ, $lX);
            if (!($hz !== false)) {
                goto ng;
            }
            goto FD;
            ng:
            J8:
        }
        FD:
        st:
        if (!($hz === false)) {
            goto u8;
        }
        return false;
        u8:
        if (!(empty($this->modulus) || !$this->modulus->equals($hz["\x6d\x6f\144\x75\x6c\165\x73"]))) {
            goto Ks;
        }
        $this->modulus = $hz["\155\157\144\165\154\x75\163"];
        $this->exponent = $this->publicExponent = $hz["\160\x75\x62\x6c\151\143\x45\170\x70\x6f\x6e\145\156\x74"];
        return true;
        Ks:
        $this->publicExponent = $hz["\x70\165\142\x6c\x69\x63\x45\x78\x70\157\156\x65\156\x74"];
        return true;
    }
    function setPrivateKey($ZZ = false, $lX = false)
    {
        if (!($ZZ === false && !empty($this->publicExponent))) {
            goto pa;
        }
        $this->publicExponent = false;
        return true;
        pa:
        $Nr = new Crypt_RSA();
        if ($Nr->loadKey($ZZ, $lX)) {
            goto QS;
        }
        return false;
        QS:
        $Nr->publicExponent = false;
        $this->loadKey($Nr);
        return true;
    }
    function getPublicKey($lX = CRYPT_RSA_PUBLIC_FORMAT_PKCS8)
    {
        if (!(empty($this->modulus) || empty($this->publicExponent))) {
            goto fx;
        }
        return false;
        fx:
        $Vo = $this->publicKeyFormat;
        $this->publicKeyFormat = $lX;
        $iP = $this->_convertPublicKey($this->modulus, $this->publicExponent);
        $this->publicKeyFormat = $Vo;
        return $iP;
    }
    function getPublicKeyFingerprint($A_ = "\x6d\x64\65")
    {
        if (!(empty($this->modulus) || empty($this->publicExponent))) {
            goto gr;
        }
        return false;
        gr:
        $oo = $this->modulus->toBytes(true);
        $pH = $this->publicExponent->toBytes(true);
        $ON = pack("\116\141\x2a\116\141\52\116\x61\52", strlen("\x73\x73\x68\x2d\162\x73\x61"), "\163\x73\x68\x2d\162\x73\x61", strlen($pH), $pH, strlen($oo), $oo);
        switch ($A_) {
            case "\163\x68\141\x32\x35\x36":
                $YT = new Crypt_Hash("\163\150\x61\x32\x35\66");
                $GJ = base64_encode($YT->hash($ON));
                return substr($GJ, 0, strlen($GJ) - 1);
            case "\155\144\x35":
                return substr(chunk_split(md5($ON), 2, "\x3a"), 0, -1);
            default:
                return false;
        }
        L1:
        lL:
    }
    function getPrivateKey($lX = CRYPT_RSA_PUBLIC_FORMAT_PKCS1)
    {
        if (!empty($this->primes)) {
            goto og;
        }
        return false;
        og:
        $Vo = $this->privateKeyFormat;
        $this->privateKeyFormat = $lX;
        $iP = $this->_convertPrivateKey($this->modulus, $this->publicExponent, $this->exponent, $this->primes, $this->exponents, $this->coefficients);
        $this->privateKeyFormat = $Vo;
        return $iP;
    }
    function _getPrivatePublicKey($A8 = CRYPT_RSA_PUBLIC_FORMAT_PKCS8)
    {
        if (!(empty($this->modulus) || empty($this->exponent))) {
            goto SQ;
        }
        return false;
        SQ:
        $Vo = $this->publicKeyFormat;
        $this->publicKeyFormat = $A8;
        $iP = $this->_convertPublicKey($this->modulus, $this->exponent);
        $this->publicKeyFormat = $Vo;
        return $iP;
    }
    function __toString()
    {
        $ZZ = $this->getPrivateKey($this->privateKeyFormat);
        if (!($ZZ !== false)) {
            goto uG;
        }
        return $ZZ;
        uG:
        $ZZ = $this->_getPrivatePublicKey($this->publicKeyFormat);
        return $ZZ !== false ? $ZZ : '';
    }
    function __clone()
    {
        $ZZ = new Crypt_RSA();
        $ZZ->loadKey($this);
        return $ZZ;
    }
    function _generateMinMax($UH)
    {
        $tV = $UH >> 3;
        $Ni = str_repeat(chr(0), $tV);
        $z9 = str_repeat(chr(255), $tV);
        $x1 = $UH & 7;
        if ($x1) {
            goto PB;
        }
        $Ni[0] = chr(128);
        goto rH;
        PB:
        $Ni = chr(1 << $x1 - 1) . $Ni;
        $z9 = chr((1 << $x1) - 1) . $z9;
        rH:
        return array("\x6d\151\156" => new Math_BigInteger($Ni, 256), "\155\141\x78" => new Math_BigInteger($z9, 256));
    }
    function _decodeLength(&$V3)
    {
        $bw = ord($this->_string_shift($V3));
        if (!($bw & 128)) {
            goto Cu;
        }
        $bw &= 127;
        $iP = $this->_string_shift($V3, $bw);
        list(, $bw) = unpack("\x4e", substr(str_pad($iP, 4, chr(0), STR_PAD_LEFT), -4));
        Cu:
        return $bw;
    }
    function _encodeLength($bw)
    {
        if (!($bw <= 127)) {
            goto lA;
        }
        return chr($bw);
        lA:
        $iP = ltrim(pack("\x4e", $bw), chr(0));
        return pack("\x43\141\x2a", 128 | strlen($iP), $iP);
    }
    function _string_shift(&$V3, $Gg = 1)
    {
        $Ao = substr($V3, 0, $Gg);
        $V3 = substr($V3, $Gg);
        return $Ao;
    }
    function setPrivateKeyFormat($GE)
    {
        $this->privateKeyFormat = $GE;
    }
    function setPublicKeyFormat($GE)
    {
        $this->publicKeyFormat = $GE;
    }
    function setHash($YT)
    {
        switch ($YT) {
            case "\x6d\x64\x32":
            case "\x6d\144\65":
            case "\x73\x68\x61\x31":
            case "\163\x68\x61\x32\x35\x36":
            case "\163\150\141\x33\70\64":
            case "\x73\150\141\x35\x31\62":
                $this->hash = new Crypt_Hash($YT);
                $this->hashName = $YT;
                goto bY;
            default:
                $this->hash = new Crypt_Hash("\163\x68\141\61");
                $this->hashName = "\163\x68\x61\61";
        }
        qI:
        bY:
        $this->hLen = $this->hash->getLength();
    }
    function setMGFHash($YT)
    {
        switch ($YT) {
            case "\x6d\x64\62":
            case "\155\144\65":
            case "\163\x68\x61\x31":
            case "\163\150\141\62\65\x36":
            case "\163\x68\x61\63\70\x34":
            case "\163\x68\141\65\61\62":
                $this->mgfHash = new Crypt_Hash($YT);
                goto HA;
            default:
                $this->mgfHash = new Crypt_Hash("\x73\150\x61\61");
        }
        ch:
        HA:
        $this->mgfHLen = $this->mgfHash->getLength();
    }
    function setSaltLength($Sn)
    {
        $this->sLen = $Sn;
    }
    function _i2osp($D9, $Nw)
    {
        $D9 = $D9->toBytes();
        if (!(strlen($D9) > $Nw)) {
            goto cx;
        }
        user_error("\x49\x6e\x74\145\147\x65\162\x20\x74\x6f\157\40\x6c\141\x72\147\x65");
        return false;
        cx:
        return str_pad($D9, $Nw, chr(0), STR_PAD_LEFT);
    }
    function _os2ip($D9)
    {
        return new Math_BigInteger($D9, 256);
    }
    function _exponentiate($D9)
    {
        switch (true) {
            case empty($this->primes):
            case $this->primes[1]->equals($this->zero):
            case empty($this->coefficients):
            case $this->coefficients[2]->equals($this->zero):
            case empty($this->exponents):
            case $this->exponents[1]->equals($this->zero):
                return $D9->modPow($this->exponent, $this->modulus);
        }
        Y0:
        l6:
        $Il = count($this->primes);
        if (defined("\x43\x52\131\120\x54\x5f\x52\x53\x41\x5f\104\x49\x53\x41\x42\114\105\137\102\114\111\116\104\111\x4e\107")) {
            goto iy;
        }
        $C1 = $this->primes[1];
        $zh = 2;
        jJ:
        if (!($zh <= $Il)) {
            goto GC;
        }
        if (!($C1->compare($this->primes[$zh]) > 0)) {
            goto eD;
        }
        $C1 = $this->primes[$zh];
        eD:
        aY:
        $zh++;
        goto jJ;
        GC:
        $M6 = new Math_BigInteger(1);
        $If = $M6->random($M6, $C1->subtract($M6));
        $eE = array(1 => $this->_blind($D9, $If, 1), 2 => $this->_blind($D9, $If, 2));
        $nV = $eE[1]->subtract($eE[2]);
        $nV = $nV->multiply($this->coefficients[2]);
        list(, $nV) = $nV->divide($this->primes[1]);
        $fg = $eE[2]->add($nV->multiply($this->primes[2]));
        $If = $this->primes[1];
        $zh = 3;
        fN1:
        if (!($zh <= $Il)) {
            goto Nd;
        }
        $eE = $this->_blind($D9, $If, $zh);
        $If = $If->multiply($this->primes[$zh - 1]);
        $nV = $eE->subtract($fg);
        $nV = $nV->multiply($this->coefficients[$zh]);
        list(, $nV) = $nV->divide($this->primes[$zh]);
        $fg = $fg->add($If->multiply($nV));
        od:
        $zh++;
        goto fN1;
        Nd:
        goto Uu;
        iy:
        $eE = array(1 => $D9->modPow($this->exponents[1], $this->primes[1]), 2 => $D9->modPow($this->exponents[2], $this->primes[2]));
        $nV = $eE[1]->subtract($eE[2]);
        $nV = $nV->multiply($this->coefficients[2]);
        list(, $nV) = $nV->divide($this->primes[1]);
        $fg = $eE[2]->add($nV->multiply($this->primes[2]));
        $If = $this->primes[1];
        $zh = 3;
        Ev:
        if (!($zh <= $Il)) {
            goto oc;
        }
        $eE = $D9->modPow($this->exponents[$zh], $this->primes[$zh]);
        $If = $If->multiply($this->primes[$zh - 1]);
        $nV = $eE->subtract($fg);
        $nV = $nV->multiply($this->coefficients[$zh]);
        list(, $nV) = $nV->divide($this->primes[$zh]);
        $fg = $fg->add($If->multiply($nV));
        yN:
        $zh++;
        goto Ev;
        oc:
        Uu:
        return $fg;
    }
    function _blind($D9, $If, $zh)
    {
        $D9 = $D9->multiply($If->modPow($this->publicExponent, $this->primes[$zh]));
        $D9 = $D9->modPow($this->exponents[$zh], $this->primes[$zh]);
        $If = $If->modInverse($this->primes[$zh]);
        $D9 = $D9->multiply($If);
        list(, $D9) = $D9->divide($this->primes[$zh]);
        return $D9;
    }
    function _equals($D9, $I3)
    {
        if (!(strlen($D9) != strlen($I3))) {
            goto FF;
        }
        return false;
        FF:
        $xA = 0;
        $zh = 0;
        l3:
        if (!($zh < strlen($D9))) {
            goto i6;
        }
        $xA |= ord($D9[$zh]) ^ ord($I3[$zh]);
        y2:
        $zh++;
        goto l3;
        i6:
        return $xA == 0;
    }
    function _rsaep($fg)
    {
        if (!($fg->compare($this->zero) < 0 || $fg->compare($this->modulus) > 0)) {
            goto p9;
        }
        user_error("\x4d\x65\x73\x73\141\147\x65\x20\x72\145\x70\x72\145\x73\145\156\164\x61\164\x69\166\145\x20\157\x75\x74\40\157\146\x20\x72\x61\x6e\147\x65");
        return false;
        p9:
        return $this->_exponentiate($fg);
    }
    function _rsadp($mp)
    {
        if (!($mp->compare($this->zero) < 0 || $mp->compare($this->modulus) > 0)) {
            goto mS;
        }
        user_error("\103\151\160\x68\x65\162\x74\x65\x78\x74\x20\162\x65\x70\162\x65\x73\145\x6e\164\x61\x74\x69\x76\x65\x20\157\165\164\40\157\x66\40\x72\x61\156\147\x65");
        return false;
        mS:
        return $this->_exponentiate($mp);
    }
    function _rsasp1($fg)
    {
        if (!($fg->compare($this->zero) < 0 || $fg->compare($this->modulus) > 0)) {
            goto qX;
        }
        user_error("\x4d\145\163\163\141\147\x65\x20\162\145\x70\x72\x65\x73\145\x6e\164\141\164\x69\x76\145\x20\x6f\x75\x74\x20\x6f\146\40\162\141\x6e\x67\145");
        return false;
        qX:
        return $this->_exponentiate($fg);
    }
    function _rsavp1($kb)
    {
        if (!($kb->compare($this->zero) < 0 || $kb->compare($this->modulus) > 0)) {
            goto jV;
        }
        user_error("\123\151\147\x6e\x61\164\165\162\x65\x20\x72\145\160\x72\x65\x73\145\156\164\x61\x74\x69\166\145\x20\157\165\x74\40\x6f\146\40\x72\141\x6e\147\x65");
        return false;
        jV:
        return $this->_exponentiate($kb);
    }
    function _mgf1($rU, $Ox)
    {
        $hV = '';
        $qq = ceil($Ox / $this->mgfHLen);
        $zh = 0;
        du:
        if (!($zh < $qq)) {
            goto tB;
        }
        $mp = pack("\116", $zh);
        $hV .= $this->mgfHash->hash($rU . $mp);
        gX:
        $zh++;
        goto du;
        tB:
        return substr($hV, 0, $Ox);
    }
    function _rsaes_oaep_encrypt($fg, $OB = '')
    {
        $Z9 = strlen($fg);
        if (!($Z9 > $this->k - 2 * $this->hLen - 2)) {
            goto XN;
        }
        user_error("\115\x65\x73\x73\141\x67\145\x20\x74\157\157\x20\x6c\157\156\147");
        return false;
        XN:
        $Hl = $this->hash->hash($OB);
        $Yb = str_repeat(chr(0), $this->k - $Z9 - 2 * $this->hLen - 2);
        $h9 = $Hl . $Yb . chr(1) . $fg;
        $Ah = crypt_random_string($this->hLen);
        $OR = $this->_mgf1($Ah, $this->k - $this->hLen - 1);
        $tI = $h9 ^ $OR;
        $t8 = $this->_mgf1($tI, $this->hLen);
        $oe = $Ah ^ $t8;
        $Rj = chr(0) . $oe . $tI;
        $fg = $this->_os2ip($Rj);
        $mp = $this->_rsaep($fg);
        $mp = $this->_i2osp($mp, $this->k);
        return $mp;
    }
    function _rsaes_oaep_decrypt($mp, $OB = '')
    {
        if (!(strlen($mp) != $this->k || $this->k < 2 * $this->hLen + 2)) {
            goto Zr;
        }
        user_error("\x44\x65\x63\162\x79\x70\x74\x69\x6f\156\40\x65\x72\x72\157\x72");
        return false;
        Zr:
        $mp = $this->_os2ip($mp);
        $fg = $this->_rsadp($mp);
        if (!($fg === false)) {
            goto ZE;
        }
        user_error("\104\145\x63\x72\171\x70\x74\x69\x6f\156\x20\x65\x72\162\x6f\x72");
        return false;
        ZE:
        $Rj = $this->_i2osp($fg, $this->k);
        $Hl = $this->hash->hash($OB);
        $I3 = ord($Rj[0]);
        $oe = substr($Rj, 1, $this->hLen);
        $tI = substr($Rj, $this->hLen + 1);
        $t8 = $this->_mgf1($tI, $this->hLen);
        $Ah = $oe ^ $t8;
        $OR = $this->_mgf1($Ah, $this->k - $this->hLen - 1);
        $h9 = $tI ^ $OR;
        $Do = substr($h9, 0, $this->hLen);
        $fg = substr($h9, $this->hLen);
        if ($this->_equals($Hl, $Do)) {
            goto L3;
        }
        user_error("\x44\x65\x63\162\171\x70\164\151\x6f\x6e\x20\x65\x72\x72\157\x72");
        return false;
        L3:
        $fg = ltrim($fg, chr(0));
        if (!(ord($fg[0]) != 1)) {
            goto B9;
        }
        user_error("\x44\145\x63\x72\x79\160\164\x69\x6f\156\40\x65\x72\x72\x6f\162");
        return false;
        B9:
        return substr($fg, 1);
    }
    function _raw_encrypt($fg)
    {
        $iP = $this->_os2ip($fg);
        $iP = $this->_rsaep($iP);
        return $this->_i2osp($iP, $this->k);
    }
    function _rsaes_pkcs1_v1_5_encrypt($fg)
    {
        $Z9 = strlen($fg);
        if (!($Z9 > $this->k - 11)) {
            goto Mi;
        }
        user_error("\115\145\163\163\141\147\x65\40\164\157\157\x20\x6c\157\x6e\147");
        return false;
        Mi:
        $uh = $this->k - $Z9 - 3;
        $Yb = '';
        OK:
        if (!(strlen($Yb) != $uh)) {
            goto g2;
        }
        $iP = crypt_random_string($uh - strlen($Yb));
        $iP = str_replace("\x0", '', $iP);
        $Yb .= $iP;
        goto OK;
        g2:
        $lX = 2;
        if (!(defined("\x43\x52\131\x50\124\137\122\123\x41\137\x50\x4b\103\x53\x31\65\137\103\117\115\120\x41\x54") && (!isset($this->publicExponent) || $this->exponent !== $this->publicExponent))) {
            goto rj;
        }
        $lX = 1;
        $Yb = str_repeat("\xff", $uh);
        rj:
        $Rj = chr(0) . chr($lX) . $Yb . chr(0) . $fg;
        $fg = $this->_os2ip($Rj);
        $mp = $this->_rsaep($fg);
        $mp = $this->_i2osp($mp, $this->k);
        return $mp;
    }
    function _rsaes_pkcs1_v1_5_decrypt($mp)
    {
        if (!(strlen($mp) != $this->k)) {
            goto Sg;
        }
        user_error("\x44\x65\x63\x72\171\x70\164\x69\x6f\x6e\x20\x65\x72\162\x6f\x72");
        return false;
        Sg:
        $mp = $this->_os2ip($mp);
        $fg = $this->_rsadp($mp);
        if (!($fg === false)) {
            goto l4;
        }
        user_error("\104\145\x63\x72\x79\160\164\151\157\x6e\40\x65\162\162\x6f\162");
        return false;
        l4:
        $Rj = $this->_i2osp($fg, $this->k);
        if (!(ord($Rj[0]) != 0 || ord($Rj[1]) > 2)) {
            goto Xr;
        }
        user_error("\x44\x65\x63\x72\171\160\x74\151\157\x6e\x20\145\x72\162\157\162");
        return false;
        Xr:
        $Yb = substr($Rj, 2, strpos($Rj, chr(0), 2) - 2);
        $fg = substr($Rj, strlen($Yb) + 3);
        if (!(strlen($Yb) < 8)) {
            goto vs;
        }
        user_error("\x44\145\x63\x72\x79\x70\164\x69\157\x6e\x20\145\x72\x72\157\x72");
        return false;
        vs:
        return $fg;
    }
    function _emsa_pss_encode($fg, $yx)
    {
        $ZL = $yx + 1 >> 3;
        $Sn = $this->sLen !== null ? $this->sLen : $this->hLen;
        $M_ = $this->hash->hash($fg);
        if (!($ZL < $this->hLen + $Sn + 2)) {
            goto XY;
        }
        user_error("\x45\156\x63\157\144\x69\x6e\x67\x20\x65\x72\x72\x6f\x72");
        return false;
        XY:
        $wO = crypt_random_string($Sn);
        $ac = "\0\0\x0\x0\x0\x0\x0\0" . $M_ . $wO;
        $nV = $this->hash->hash($ac);
        $Yb = str_repeat(chr(0), $ZL - $Sn - $this->hLen - 2);
        $h9 = $Yb . chr(1) . $wO;
        $OR = $this->_mgf1($nV, $ZL - $this->hLen - 1);
        $tI = $h9 ^ $OR;
        $tI[0] = ~chr(255 << ($yx & 7)) & $tI[0];
        $Rj = $tI . $nV . chr(188);
        return $Rj;
    }
    function _emsa_pss_verify($fg, $Rj, $yx)
    {
        $ZL = $yx + 1 >> 3;
        $Sn = $this->sLen !== null ? $this->sLen : $this->hLen;
        $M_ = $this->hash->hash($fg);
        if (!($ZL < $this->hLen + $Sn + 2)) {
            goto oQ;
        }
        return false;
        oQ:
        if (!($Rj[strlen($Rj) - 1] != chr(188))) {
            goto E6;
        }
        return false;
        E6:
        $tI = substr($Rj, 0, -$this->hLen - 1);
        $nV = substr($Rj, -$this->hLen - 1, $this->hLen);
        $iP = chr(255 << ($yx & 7));
        if (!((~$tI[0] & $iP) != $iP)) {
            goto Wp;
        }
        return false;
        Wp:
        $OR = $this->_mgf1($nV, $ZL - $this->hLen - 1);
        $h9 = $tI ^ $OR;
        $h9[0] = ~chr(255 << ($yx & 7)) & $h9[0];
        $iP = $ZL - $this->hLen - $Sn - 2;
        if (!(substr($h9, 0, $iP) != str_repeat(chr(0), $iP) || ord($h9[$iP]) != 1)) {
            goto wG;
        }
        return false;
        wG:
        $wO = substr($h9, $iP + 1);
        $ac = "\x0\x0\x0\0\x0\0\x0\0" . $M_ . $wO;
        $W2 = $this->hash->hash($ac);
        return $this->_equals($nV, $W2);
    }
    function _rsassa_pss_sign($fg)
    {
        $Rj = $this->_emsa_pss_encode($fg, 8 * $this->k - 1);
        $fg = $this->_os2ip($Rj);
        $kb = $this->_rsasp1($fg);
        $kb = $this->_i2osp($kb, $this->k);
        return $kb;
    }
    function _rsassa_pss_verify($fg, $kb)
    {
        if (!(strlen($kb) != $this->k)) {
            goto bb;
        }
        user_error("\x49\156\x76\141\154\x69\x64\x20\x73\x69\x67\156\141\x74\x75\162\x65");
        return false;
        bb:
        $fa = 8 * $this->k;
        $nU = $this->_os2ip($kb);
        $ac = $this->_rsavp1($nU);
        if (!($ac === false)) {
            goto oe;
        }
        user_error("\x49\x6e\166\141\x6c\x69\x64\x20\x73\x69\x67\x6e\141\x74\165\162\x65");
        return false;
        oe:
        $Rj = $this->_i2osp($ac, $fa >> 3);
        if (!($Rj === false)) {
            goto z3;
        }
        user_error("\x49\x6e\166\x61\x6c\151\144\x20\163\x69\147\x6e\141\x74\x75\162\145");
        return false;
        z3:
        return $this->_emsa_pss_verify($fg, $Rj, $fa - 1);
    }
    function _emsa_pkcs1_v1_5_encode($fg, $ZL)
    {
        $nV = $this->hash->hash($fg);
        if (!($nV === false)) {
            goto c4;
        }
        return false;
        c4:
        switch ($this->hashName) {
            case "\x6d\144\62":
                $hV = pack("\x48\x2a", "\x33\x30\62\x30\x33\x30\60\143\x30\66\x30\70\62\141\70\66\64\x38\x38\66\x66\x37\60\x64\x30\62\x30\x32\x30\65\60\x30\x30\64\61\60");
                goto Rn;
            case "\155\144\65":
                $hV = pack("\x48\52", "\63\60\x32\x30\63\60\x30\x63\x30\66\60\70\x32\141\x38\x36\x34\x38\x38\x36\146\x37\x30\144\60\62\60\x35\60\65\60\60\60\64\x31\60");
                goto Rn;
            case "\163\x68\141\x31":
                $hV = pack("\110\52", "\x33\60\x32\x31\63\60\60\x39\60\66\60\x35\62\x62\x30\145\x30\x33\x30\x32\x31\141\x30\65\x30\60\60\64\x31\x34");
                goto Rn;
            case "\163\x68\141\62\65\66":
                $hV = pack("\x48\52", "\x33\60\63\x31\x33\60\60\x64\60\66\x30\71\66\x30\70\x36\x34\x38\x30\x31\x36\65\x30\x33\x30\64\x30\62\x30\61\x30\x35\x30\x30\x30\64\62\60");
                goto Rn;
            case "\x73\x68\141\63\x38\64":
                $hV = pack("\x48\52", "\63\60\x34\x31\x33\60\x30\x64\x30\x36\60\71\x36\x30\70\66\64\x38\60\61\66\x35\60\63\60\64\x30\x32\60\x32\x30\x35\x30\60\x30\64\63\60");
                goto Rn;
            case "\163\150\x61\65\x31\x32":
                $hV = pack("\x48\x2a", "\x33\60\65\61\x33\x30\x30\x64\x30\x36\x30\x39\66\x30\70\x36\x34\x38\x30\x31\66\65\x30\63\60\64\60\62\x30\63\60\x35\60\60\60\x34\64\x30");
        }
        N3:
        Rn:
        $hV .= $nV;
        $Uu = strlen($hV);
        if (!($ZL < $Uu + 11)) {
            goto is;
        }
        user_error("\111\156\x74\x65\156\144\145\x64\x20\x65\156\x63\157\x64\145\x64\x20\x6d\x65\x73\x73\141\147\145\x20\154\145\x6e\147\164\150\x20\x74\x6f\x6f\40\x73\x68\157\162\164");
        return false;
        is:
        $Yb = str_repeat(chr(255), $ZL - $Uu - 3);
        $Rj = "\0\1{$Yb}\0{$hV}";
        return $Rj;
    }
    function _rsassa_pkcs1_v1_5_sign($fg)
    {
        $Rj = $this->_emsa_pkcs1_v1_5_encode($fg, $this->k);
        if (!($Rj === false)) {
            goto hq;
        }
        user_error("\122\x53\x41\40\155\157\144\165\x6c\165\x73\40\x74\x6f\x6f\40\x73\x68\x6f\162\x74");
        return false;
        hq:
        $fg = $this->_os2ip($Rj);
        $kb = $this->_rsasp1($fg);
        $kb = $this->_i2osp($kb, $this->k);
        return $kb;
    }
    function _rsassa_pkcs1_v1_5_verify($fg, $kb)
    {
        if (!(strlen($kb) != $this->k)) {
            goto aG;
        }
        user_error("\111\156\x76\x61\154\x69\x64\40\x73\x69\147\x6e\141\164\165\x72\145");
        return false;
        aG:
        $kb = $this->_os2ip($kb);
        $ac = $this->_rsavp1($kb);
        if (!($ac === false)) {
            goto Nl;
        }
        user_error("\x49\x6e\166\x61\x6c\151\144\40\x73\151\147\156\x61\x74\165\162\145");
        return false;
        Nl:
        $Rj = $this->_i2osp($ac, $this->k);
        if (!($Rj === false)) {
            goto a4;
        }
        user_error("\111\x6e\x76\141\154\x69\x64\x20\x73\x69\x67\x6e\x61\x74\x75\162\x65");
        return false;
        a4:
        $F8 = $this->_emsa_pkcs1_v1_5_encode($fg, $this->k);
        if (!($F8 === false)) {
            goto Km;
        }
        user_error("\x52\123\101\40\155\157\x64\x75\154\165\x73\40\164\x6f\x6f\40\x73\150\157\x72\164");
        return false;
        Km:
        return $this->_equals($Rj, $F8);
    }
    function setEncryptionMode($A8)
    {
        $this->encryptionMode = $A8;
    }
    function setSignatureMode($A8)
    {
        $this->signatureMode = $A8;
    }
    function setComment($wB)
    {
        $this->comment = $wB;
    }
    function getComment()
    {
        return $this->comment;
    }
    function encrypt($VX)
    {
        switch ($this->encryptionMode) {
            case CRYPT_RSA_ENCRYPTION_NONE:
                $VX = str_split($VX, $this->k);
                $Gr = '';
                foreach ($VX as $fg) {
                    $Gr .= $this->_raw_encrypt($fg);
                    lr:
                }
                gP:
                return $Gr;
            case CRYPT_RSA_ENCRYPTION_PKCS1:
                $bw = $this->k - 11;
                if (!($bw <= 0)) {
                    goto Tz;
                }
                return false;
                Tz:
                $VX = str_split($VX, $bw);
                $Gr = '';
                foreach ($VX as $fg) {
                    $Gr .= $this->_rsaes_pkcs1_v1_5_encrypt($fg);
                    y0:
                }
                sQ:
                return $Gr;
            default:
                $bw = $this->k - 2 * $this->hLen - 2;
                if (!($bw <= 0)) {
                    goto Nv;
                }
                return false;
                Nv:
                $VX = str_split($VX, $bw);
                $Gr = '';
                foreach ($VX as $fg) {
                    $Gr .= $this->_rsaes_oaep_encrypt($fg);
                    Ti:
                }
                kb:
                return $Gr;
        }
        M3:
        Xm:
    }
    function decrypt($Gr)
    {
        if (!($this->k <= 0)) {
            goto d_;
        }
        return false;
        d_:
        $Gr = str_split($Gr, $this->k);
        $Gr[count($Gr) - 1] = str_pad($Gr[count($Gr) - 1], $this->k, chr(0), STR_PAD_LEFT);
        $VX = '';
        switch ($this->encryptionMode) {
            case CRYPT_RSA_ENCRYPTION_NONE:
                $ho = "\137\x72\141\x77\137\x65\156\x63\162\x79\x70\164";
                goto ap;
            case CRYPT_RSA_ENCRYPTION_PKCS1:
                $ho = "\137\162\x73\x61\145\163\x5f\160\x6b\x63\x73\x31\x5f\166\61\137\65\137\x64\145\x63\x72\x79\160\x74";
                goto ap;
            default:
                $ho = "\137\x72\163\x61\x65\x73\137\157\x61\x65\160\137\x64\x65\x63\x72\171\x70\x74";
        }
        e_:
        ap:
        foreach ($Gr as $mp) {
            $iP = $this->{$ho}($mp);
            if (!($iP === false)) {
                goto i7;
            }
            return false;
            i7:
            $VX .= $iP;
            mH:
        }
        sW:
        return $VX;
    }
    function sign($n6)
    {
        if (!(empty($this->modulus) || empty($this->exponent))) {
            goto bz;
        }
        return false;
        bz:
        switch ($this->signatureMode) {
            case CRYPT_RSA_SIGNATURE_PKCS1:
                return $this->_rsassa_pkcs1_v1_5_sign($n6);
            default:
                return $this->_rsassa_pss_sign($n6);
        }
        dL:
        OV:
    }
    function verify($n6, $kO)
    {
        if (!(empty($this->modulus) || empty($this->exponent))) {
            goto zA;
        }
        return false;
        zA:
        switch ($this->signatureMode) {
            case CRYPT_RSA_SIGNATURE_PKCS1:
                return $this->_rsassa_pkcs1_v1_5_verify($n6, $kO);
            default:
                return $this->_rsassa_pss_verify($n6, $kO);
        }
        LS:
        ZU:
    }
    function _extractBER($sr)
    {
        $iP = preg_replace("\43\56\52\x3f\x5e\x2d\53\x5b\136\55\135\x2b\x2d\53\x5b\x5c\x72\134\x6e\40\135\x2a\44\x23\x6d\163", '', $sr, 1);
        $iP = preg_replace("\43\x2d\53\x5b\x5e\55\135\53\55\53\43", '', $iP);
        $iP = str_replace(array("\xd", "\12", "\x20"), '', $iP);
        $iP = preg_match("\43\136\133\141\55\172\101\55\132\134\144\57\53\135\52\x3d\x7b\60\54\62\175\44\x23", $iP) ? base64_decode($iP) : false;
        return $iP != false ? $iP : $sr;
    }
}
