<?php


namespace MoOauthClient\GrantTypes;

if (function_exists("\143\x72\x79\x70\164\x5f\162\x61\156\x64\157\155\137\163\x74\162\x69\x6e\x67")) {
    goto b4I;
}
define("\x43\x52\x59\x50\x54\137\x52\101\x4e\x44\117\x4d\x5f\111\x53\137\x57\x49\x4e\104\x4f\x57\x53", strtoupper(substr(PHP_OS, 0, 3)) === "\x57\111\116");
function crypt_random_string($bw)
{
    if ($bw) {
        goto Sou;
    }
    return '';
    Sou:
    if (CRYPT_RANDOM_IS_WINDOWS) {
        goto HvF;
    }
    if (!(extension_loaded("\x6f\x70\x65\x6e\x73\x73\x6c") && version_compare(PHP_VERSION, "\x35\56\x33\56\60", "\x3e\75"))) {
        goto jsf;
    }
    return openssl_random_pseudo_bytes($bw);
    jsf:
    static $Cp = true;
    if (!($Cp === true)) {
        goto ZVZ;
    }
    $Cp = @fopen("\x2f\x64\x65\166\57\x75\162\141\x6e\x64\x6f\155", "\x72\142");
    ZVZ:
    if (!($Cp !== true && $Cp !== false)) {
        goto E2h;
    }
    return fread($Cp, $bw);
    E2h:
    if (!extension_loaded("\x6d\x63\x72\x79\x70\x74")) {
        goto XKO;
    }
    return @mcrypt_create_iv($bw, MCRYPT_DEV_URANDOM);
    XKO:
    goto M0A;
    HvF:
    if (!(extension_loaded("\155\x63\x72\171\160\164") && version_compare(PHP_VERSION, "\65\x2e\63\x2e\x30", "\x3e\75"))) {
        goto pR0;
    }
    return @mcrypt_create_iv($bw);
    pR0:
    if (!(extension_loaded("\x6f\x70\145\x6e\x73\x73\x6c") && version_compare(PHP_VERSION, "\x35\x2e\x33\56\64", "\76\75"))) {
        goto YY8;
    }
    return openssl_random_pseudo_bytes($bw);
    YY8:
    M0A:
    static $w1 = false, $Qe;
    if (!($w1 === false)) {
        goto f3O;
    }
    $cK = session_id();
    $ml = ini_get("\163\x65\163\x73\x69\x6f\156\56\165\x73\x65\137\x63\157\157\153\151\x65\163");
    $EL = session_cache_limiter();
    $Ii = isset($_SESSION) ? $_SESSION : false;
    if (!($cK != '')) {
        goto Mx9;
    }
    session_write_close();
    Mx9:
    session_id(1);
    ini_set("\x73\x65\x73\163\x69\x6f\156\x2e\x75\163\x65\137\x63\x6f\157\153\x69\x65\x73", 0);
    session_cache_limiter('');
    session_start(array("\162\x65\x61\144\137\141\156\x64\137\x63\x6c\x6f\x73\x65" => true));
    $Qe = $Ah = $_SESSION["\163\x65\x65\144"] = pack("\x48\52", sha1((isset($_SERVER) ? phpseclib_safe_serialize($_SERVER) : '') . (isset($_POST) ? phpseclib_safe_serialize($_POST) : '') . (isset($_GET) ? phpseclib_safe_serialize($_GET) : '') . (isset($_COOKIE) ? phpseclib_safe_serialize($_COOKIE) : '') . phpseclib_safe_serialize($GLOBALS) . phpseclib_safe_serialize($_SESSION) . phpseclib_safe_serialize($Ii)));
    if (isset($_SESSION["\x63\157\165\x6e\164"])) {
        goto c4P;
    }
    $_SESSION["\x63\x6f\165\156\164"] = 0;
    c4P:
    $_SESSION["\143\157\165\156\x74"]++;
    session_write_close();
    if ($cK != '') {
        goto Cv4;
    }
    if ($Ii !== false) {
        goto xlw;
    }
    unset($_SESSION);
    goto Q78;
    xlw:
    $_SESSION = $Ii;
    unset($Ii);
    Q78:
    goto Fue;
    Cv4:
    session_id($cK);
    session_start(array("\162\x65\x61\144\x5f\x61\x6e\144\137\x63\154\x6f\163\145" => true));
    ini_set("\163\145\x73\163\151\x6f\156\56\165\x73\145\x5f\143\x6f\x6f\153\x69\145\x73", $ml);
    session_cache_limiter($EL);
    Fue:
    $ZZ = pack("\x48\52", sha1($Ah . "\101"));
    $YK = pack("\110\x2a", sha1($Ah . "\x43"));
    switch (true) {
        case phpseclib_resolve_include_path("\x43\x72\171\x70\164\57\101\105\x53\x2e\160\150\x70"):
            if (class_exists("\x43\x72\x79\x70\x74\x5f\x41\105\x53")) {
                goto rXg;
            }
            include_once "\x41\105\x53\56\x70\150\x70";
            rXg:
            $w1 = new Crypt_AES(CRYPT_AES_MODE_CTR);
            goto cCD;
        case phpseclib_resolve_include_path("\103\162\x79\x70\x74\57\x54\x77\157\x66\151\163\x68\x2e\x70\150\x70"):
            if (class_exists("\x43\x72\x79\x70\164\137\x54\x77\x6f\x66\x69\163\x68")) {
                goto TnJ;
            }
            include_once "\x54\x77\157\x66\x69\163\x68\x2e\160\x68\160";
            TnJ:
            $w1 = new Crypt_Twofish(CRYPT_TWOFISH_MODE_CTR);
            goto cCD;
        case phpseclib_resolve_include_path("\103\162\171\x70\x74\57\x42\x6c\x6f\167\146\x69\x73\150\x2e\x70\150\x70"):
            if (class_exists("\103\x72\x79\160\164\x5f\102\x6c\157\x77\x66\x69\x73\x68")) {
                goto Hgp;
            }
            include_once "\102\154\157\x77\x66\x69\x73\x68\x2e\x70\150\160";
            Hgp:
            $w1 = new Crypt_Blowfish(CRYPT_BLOWFISH_MODE_CTR);
            goto cCD;
        case phpseclib_resolve_include_path("\103\x72\171\160\164\x2f\124\x72\x69\160\154\145\x44\x45\123\56\x70\x68\x70"):
            if (class_exists("\103\x72\x79\160\x74\137\124\162\x69\x70\154\x65\x44\105\123")) {
                goto mhk;
            }
            include_once "\124\x72\151\x70\154\145\104\x45\123\56\160\150\x70";
            mhk:
            $w1 = new Crypt_TripleDES(CRYPT_DES_MODE_CTR);
            goto cCD;
        case phpseclib_resolve_include_path("\103\162\x79\160\x74\x2f\x44\105\123\x2e\x70\x68\160"):
            if (class_exists("\103\162\171\x70\x74\x5f\104\105\x53")) {
                goto vCN;
            }
            include_once "\104\105\123\x2e\x70\x68\160";
            vCN:
            $w1 = new Crypt_DES(CRYPT_DES_MODE_CTR);
            goto cCD;
        case phpseclib_resolve_include_path("\103\162\171\160\x74\57\122\103\x34\x2e\x70\150\160"):
            if (class_exists("\x43\162\x79\160\164\137\122\x43\64")) {
                goto Juk;
            }
            include_once "\122\103\64\x2e\160\150\160";
            Juk:
            $w1 = new Crypt_RC4();
            goto cCD;
        default:
            user_error("\x63\162\x79\x70\x74\x5f\x72\141\156\144\157\155\x5f\x73\164\162\151\156\x67\x20\x72\x65\x71\x75\151\162\145\x73\40\x61\164\x20\x6c\x65\x61\x73\164\40\x6f\x6e\145\x20\x73\171\x6d\155\145\x74\x72\151\x63\x20\143\151\x70\150\x65\162\40\142\145\x20\154\157\x61\x64\145\x64");
            return false;
    }
    We2:
    cCD:
    $w1->setKey($ZZ);
    $w1->setIV($YK);
    $w1->enableContinuousBuffer();
    f3O:
    $xA = '';
    Qxe:
    if (!(strlen($xA) < $bw)) {
        goto iYb;
    }
    $zh = $w1->encrypt(microtime());
    $If = $w1->encrypt($zh ^ $Qe);
    $Qe = $w1->encrypt($If ^ $zh);
    $xA .= $If;
    goto Qxe;
    iYb:
    return substr($xA, 0, $bw);
}
b4I:
if (function_exists("\x70\150\160\x73\145\143\154\151\142\x5f\x73\x61\146\145\137\163\145\162\x69\x61\x6c\151\172\x65")) {
    goto rmP;
}
function phpseclib_safe_serialize(&$SP)
{
    if (!is_object($SP)) {
        goto XW4;
    }
    return '';
    XW4:
    if (is_array($SP)) {
        goto j_z;
    }
    return serialize($SP);
    j_z:
    if (!isset($SP["\137\137\160\150\160\163\145\143\x6c\151\142\137\x6d\141\162\x6b\x65\x72"])) {
        goto LzY;
    }
    return '';
    LzY:
    $fq = array();
    $SP["\137\137\160\x68\x70\x73\x65\143\x6c\x69\x62\137\155\141\x72\153\x65\x72"] = true;
    foreach (array_keys($SP) as $ZZ) {
        if (!($ZZ !== "\x5f\x5f\x70\x68\x70\x73\145\x63\154\x69\142\x5f\x6d\141\162\x6b\x65\x72")) {
            goto v7D;
        }
        $fq[$ZZ] = phpseclib_safe_serialize($SP[$ZZ]);
        v7D:
        sj7:
    }
    OWy:
    unset($SP["\137\137\160\x68\160\x73\145\x63\154\x69\x62\x5f\155\141\x72\x6b\x65\162"]);
    return serialize($fq);
}
rmP:
if (function_exists("\160\x68\x70\163\145\143\x6c\x69\x62\x5f\x72\x65\163\x6f\x6c\x76\145\x5f\x69\156\143\x6c\165\144\145\x5f\x70\x61\x74\x68")) {
    goto Bja;
}
function phpseclib_resolve_include_path($ZT)
{
    if (!function_exists("\x73\x74\162\145\141\155\137\x72\x65\163\x6f\x6c\x76\x65\137\151\156\143\154\x75\x64\145\x5f\x70\141\164\x68")) {
        goto ymL;
    }
    return stream_resolve_include_path($ZT);
    ymL:
    if (!file_exists($ZT)) {
        goto FjA;
    }
    return realpath($ZT);
    FjA:
    $st = PATH_SEPARATOR == "\72" ? preg_split("\x23\50\77\74\x21\160\150\x61\162\51\x3a\43", get_include_path()) : explode(PATH_SEPARATOR, get_include_path());
    foreach ($st as $NH) {
        $eF = substr($NH, -1) == DIRECTORY_SEPARATOR ? '' : DIRECTORY_SEPARATOR;
        $cd = $NH . $eF . $ZT;
        if (!file_exists($cd)) {
            goto Ucw;
        }
        return realpath($cd);
        Ucw:
        iw_:
    }
    oI7:
    return false;
}
Bja:
