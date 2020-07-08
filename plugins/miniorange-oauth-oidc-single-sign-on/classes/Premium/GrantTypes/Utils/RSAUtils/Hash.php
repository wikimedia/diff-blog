<?php


namespace MoOauthClient\GrantTypes;

define("\x43\x52\x59\120\x54\137\x48\x41\123\x48\x5f\x4d\117\x44\105\137\x49\116\124\x45\122\x4e\x41\x4c", 1);
define("\x43\122\x59\x50\x54\137\110\101\x53\x48\137\x4d\x4f\x44\105\137\115\x48\x41\x53\110", 2);
define("\x43\122\131\120\x54\137\x48\x41\x53\x48\x5f\x4d\x4f\104\x45\137\110\101\123\110", 3);
class Crypt_Hash
{
    var $hashParam;
    var $b;
    var $l = false;
    var $hash;
    var $key = false;
    var $opad;
    var $ipad;
    function __construct($YT = "\163\150\141\61")
    {
        if (defined("\x43\x52\131\120\124\x5f\110\101\123\110\x5f\115\117\104\x45")) {
            goto YS;
        }
        switch (true) {
            case extension_loaded("\x68\x61\163\x68"):
                define("\103\122\131\120\x54\x5f\x48\101\x53\110\137\x4d\x4f\104\105", CRYPT_HASH_MODE_HASH);
                goto Yg;
            case extension_loaded("\155\x68\x61\x73\x68"):
                define("\103\122\131\120\124\x5f\110\101\123\x48\x5f\x4d\117\104\105", CRYPT_HASH_MODE_MHASH);
                goto Yg;
            default:
                define("\x43\122\x59\120\x54\137\110\x41\x53\110\x5f\x4d\x4f\x44\x45", CRYPT_HASH_MODE_INTERNAL);
        }
        sO:
        Yg:
        YS:
        $this->setHash($YT);
    }
    function Crypt_Hash($YT = "\x73\x68\141\61")
    {
        $this->__construct($YT);
    }
    function setKey($ZZ = false)
    {
        $this->key = $ZZ;
    }
    function getHash()
    {
        return $this->hashParam;
    }
    function setHash($YT)
    {
        $this->hashParam = $YT = strtolower($YT);
        switch ($YT) {
            case "\155\x64\65\55\71\66":
            case "\x73\x68\x61\61\55\71\x36":
            case "\x73\x68\x61\x32\x35\x36\x2d\x39\x36":
            case "\x73\x68\141\65\x31\x32\x2d\x39\x36":
                $YT = substr($YT, 0, -3);
                $this->l = 12;
                goto tS;
            case "\x6d\x64\x32":
            case "\x6d\x64\65":
                $this->l = 16;
                goto tS;
            case "\x73\x68\141\61":
                $this->l = 20;
                goto tS;
            case "\163\x68\141\62\65\66":
                $this->l = 32;
                goto tS;
            case "\x73\x68\x61\63\70\64":
                $this->l = 48;
                goto tS;
            case "\x73\150\x61\65\61\x32":
                $this->l = 64;
        }
        GN:
        tS:
        switch ($YT) {
            case "\155\144\x32":
                $A8 = CRYPT_HASH_MODE == CRYPT_HASH_MODE_HASH && in_array("\x6d\144\x32", hash_algos()) ? CRYPT_HASH_MODE_HASH : CRYPT_HASH_MODE_INTERNAL;
                goto Vg;
            case "\x73\150\x61\x33\x38\64":
            case "\x73\x68\x61\65\61\x32":
                $A8 = CRYPT_HASH_MODE == CRYPT_HASH_MODE_MHASH ? CRYPT_HASH_MODE_INTERNAL : CRYPT_HASH_MODE;
                goto Vg;
            default:
                $A8 = CRYPT_HASH_MODE;
        }
        kf:
        Vg:
        switch ($A8) {
            case CRYPT_HASH_MODE_MHASH:
                switch ($YT) {
                    case "\x6d\x64\x35":
                        $this->hash = MHASH_MD5;
                        goto iP;
                    case "\163\x68\141\x32\x35\x36":
                        $this->hash = MHASH_SHA256;
                        goto iP;
                    case "\163\150\x61\x31":
                    default:
                        $this->hash = MHASH_SHA1;
                }
                Cf:
                iP:
                return;
            case CRYPT_HASH_MODE_HASH:
                switch ($YT) {
                    case "\x6d\x64\x35":
                        $this->hash = "\155\144\x35";
                        return;
                    case "\x6d\x64\x32":
                    case "\163\x68\x61\62\x35\66":
                    case "\163\x68\141\x33\x38\x34":
                    case "\163\150\141\x35\x31\x32":
                        $this->hash = $YT;
                        return;
                    case "\x73\150\141\61":
                    default:
                        $this->hash = "\x73\150\x61\61";
                }
                qc:
                u_:
                return;
        }
        ij:
        BB:
        switch ($YT) {
            case "\x6d\x64\x32":
                $this->b = 16;
                $this->hash = array($this, "\137\x6d\x64\62");
                goto Tw;
            case "\155\144\x35":
                $this->b = 64;
                $this->hash = array($this, "\x5f\x6d\144\65");
                goto Tw;
            case "\x73\150\x61\62\x35\x36":
                $this->b = 64;
                $this->hash = array($this, "\137\x73\x68\141\62\65\x36");
                goto Tw;
            case "\x73\150\x61\x33\70\x34":
            case "\x73\x68\x61\65\x31\x32":
                $this->b = 128;
                $this->hash = array($this, "\137\163\150\x61\x35\x31\62");
                goto Tw;
            case "\163\x68\x61\x31":
            default:
                $this->b = 64;
                $this->hash = array($this, "\x5f\163\x68\x61\x31");
        }
        Sw:
        Tw:
        $this->ipad = str_repeat(chr(54), $this->b);
        $this->opad = str_repeat(chr(92), $this->b);
    }
    function hash($QX)
    {
        $A8 = is_array($this->hash) ? CRYPT_HASH_MODE_INTERNAL : CRYPT_HASH_MODE;
        if (!empty($this->key) || is_string($this->key)) {
            goto X3;
        }
        switch ($A8) {
            case CRYPT_HASH_MODE_MHASH:
                $Bs = mhash($this->hash, $QX);
                goto DA;
            case CRYPT_HASH_MODE_HASH:
                $Bs = hash($this->hash, $QX, true);
                goto DA;
            case CRYPT_HASH_MODE_INTERNAL:
                $Bs = call_user_func($this->hash, $QX);
        }
        bv:
        DA:
        goto Hm;
        X3:
        switch ($A8) {
            case CRYPT_HASH_MODE_MHASH:
                $Bs = mhash($this->hash, $QX, $this->key);
                goto JK;
            case CRYPT_HASH_MODE_HASH:
                $Bs = hash_hmac($this->hash, $QX, $this->key, true);
                goto JK;
            case CRYPT_HASH_MODE_INTERNAL:
                $ZZ = strlen($this->key) > $this->b ? call_user_func($this->hash, $this->key) : $this->key;
                $ZZ = str_pad($ZZ, $this->b, chr(0));
                $iP = $this->ipad ^ $ZZ;
                $iP .= $QX;
                $iP = call_user_func($this->hash, $iP);
                $Bs = $this->opad ^ $ZZ;
                $Bs .= $iP;
                $Bs = call_user_func($this->hash, $Bs);
        }
        iZ:
        JK:
        Hm:
        return substr($Bs, 0, $this->l);
    }
    function getLength()
    {
        return $this->l;
    }
    function _md5($fg)
    {
        return pack("\x48\x2a", md5($fg));
    }
    function _sha1($fg)
    {
        return pack("\x48\52", sha1($fg));
    }
    function _md2($fg)
    {
        static $kb = array(41, 46, 67, 201, 162, 216, 124, 1, 61, 54, 84, 161, 236, 240, 6, 19, 98, 167, 5, 243, 192, 199, 115, 140, 152, 147, 43, 217, 188, 76, 130, 202, 30, 155, 87, 60, 253, 212, 224, 22, 103, 66, 111, 24, 138, 23, 229, 18, 190, 78, 196, 214, 218, 158, 222, 73, 160, 251, 245, 142, 187, 47, 238, 122, 169, 104, 121, 145, 21, 178, 7, 63, 148, 194, 16, 137, 11, 34, 95, 33, 128, 127, 93, 154, 90, 144, 50, 39, 53, 62, 204, 231, 191, 247, 151, 3, 255, 25, 48, 179, 72, 165, 181, 209, 215, 94, 146, 42, 172, 86, 170, 198, 79, 184, 56, 210, 150, 164, 125, 182, 118, 252, 107, 226, 156, 116, 4, 241, 69, 157, 112, 89, 100, 113, 135, 32, 134, 91, 207, 101, 230, 45, 168, 2, 27, 96, 37, 173, 174, 176, 185, 246, 28, 70, 97, 105, 52, 64, 126, 15, 85, 71, 163, 35, 221, 81, 175, 58, 195, 92, 249, 206, 186, 197, 234, 38, 44, 83, 13, 110, 133, 40, 132, 9, 211, 223, 205, 244, 65, 129, 77, 82, 106, 220, 55, 200, 108, 193, 171, 250, 36, 225, 123, 8, 12, 189, 177, 74, 120, 136, 149, 139, 227, 99, 232, 109, 233, 203, 213, 254, 59, 0, 29, 57, 242, 239, 183, 14, 102, 88, 208, 228, 166, 119, 114, 248, 235, 117, 75, 10, 49, 68, 80, 180, 143, 237, 31, 26, 219, 153, 141, 51, 159, 17, 131, 20);
        $oC = 16 - (strlen($fg) & 15);
        $fg .= str_repeat(chr($oC), $oC);
        $bw = strlen($fg);
        $mp = str_repeat(chr(0), 16);
        $OB = chr(0);
        $zh = 0;
        Ey:
        if (!($zh < $bw)) {
            goto TX;
        }
        $Pf = 0;
        QM:
        if (!($Pf < 16)) {
            goto v0;
        }
        $mp[$Pf] = chr($kb[ord($fg[$zh + $Pf] ^ $OB)] ^ ord($mp[$Pf]));
        $OB = $mp[$Pf];
        xT:
        $Pf++;
        goto QM;
        v0:
        Nj:
        $zh += 16;
        goto Ey;
        TX:
        $fg .= $mp;
        $bw += 16;
        $D9 = str_repeat(chr(0), 48);
        $zh = 0;
        Ci:
        if (!($zh < $bw)) {
            goto f0;
        }
        $Pf = 0;
        QQ:
        if (!($Pf < 16)) {
            goto OQ;
        }
        $D9[$Pf + 16] = $fg[$zh + $Pf];
        $D9[$Pf + 32] = $D9[$Pf + 16] ^ $D9[$Pf];
        IF1:
        $Pf++;
        goto QQ;
        OQ:
        $hV = chr(0);
        $Pf = 0;
        iF1:
        if (!($Pf < 18)) {
            goto d5;
        }
        $it = 0;
        mF:
        if (!($it < 48)) {
            goto yu;
        }
        $D9[$it] = $hV = $D9[$it] ^ chr($kb[ord($hV)]);
        uU:
        $it++;
        goto mF;
        yu:
        $hV = chr(ord($hV) + $Pf);
        Xw:
        $Pf++;
        goto iF1;
        d5:
        h0:
        $zh += 16;
        goto Ci;
        f0:
        return substr($D9, 0, 16);
    }
    function _sha256($fg)
    {
        if (!extension_loaded("\x73\x75\150\x6f\163\x69\156")) {
            goto nh;
        }
        return pack("\110\52", sha256($fg));
        nh:
        $YT = array(1779033703, 3144134277, 1013904242, 2773480762, 1359893119, 2600822924, 528734635, 1541459225);
        static $it = array(1116352408, 1899447441, 3049323471, 3921009573, 961987163, 1508970993, 2453635748, 2870763221, 3624381080, 310598401, 607225278, 1426881987, 1925078388, 2162078206, 2614888103, 3248222580, 3835390401, 4022224774, 264347078, 604807628, 770255983, 1249150122, 1555081692, 1996064986, 2554220882, 2821834349, 2952996808, 3210313671, 3336571891, 3584528711, 113926993, 338241895, 666307205, 773529912, 1294757372, 1396182291, 1695183700, 1986661051, 2177026350, 2456956037, 2730485921, 2820302411, 3259730800, 3345764771, 3516065817, 3600352804, 4094571909, 275423344, 430227734, 506948616, 659060556, 883997877, 958139571, 1322822218, 1537002063, 1747873779, 1955562222, 2024104815, 2227730452, 2361852424, 2428436474, 2756734187, 3204031479, 3329325298);
        $bw = strlen($fg);
        $fg .= str_repeat(chr(0), 64 - ($bw + 8 & 63));
        $fg[$bw] = chr(128);
        $fg .= pack("\x4e\62", 0, $bw << 3);
        $C0 = str_split($fg, 64);
        foreach ($C0 as $h2) {
            $Kr = array();
            $zh = 0;
            db:
            if (!($zh < 16)) {
                goto R_;
            }
            extract(unpack("\116\x74\x65\x6d\160", $this->_string_shift($h2, 4)));
            $Kr[] = $iP;
            LY:
            $zh++;
            goto db;
            R_:
            $zh = 16;
            lH:
            if (!($zh < 64)) {
                goto bL;
            }
            $J6 = $this->_rightRotate($Kr[$zh - 15], 7) ^ $this->_rightRotate($Kr[$zh - 15], 18) ^ $this->_rightShift($Kr[$zh - 15], 3);
            $va = $this->_rightRotate($Kr[$zh - 2], 17) ^ $this->_rightRotate($Kr[$zh - 2], 19) ^ $this->_rightShift($Kr[$zh - 2], 10);
            $Kr[$zh] = $this->_add($Kr[$zh - 16], $J6, $Kr[$zh - 7], $va);
            mD:
            $zh++;
            goto lH;
            bL:
            list($ML, $Wj, $mp, $Xy, $hq, $e2, $Ws, $nV) = $YT;
            $zh = 0;
            nH:
            if (!($zh < 64)) {
                goto ND;
            }
            $J6 = $this->_rightRotate($ML, 2) ^ $this->_rightRotate($ML, 13) ^ $this->_rightRotate($ML, 22);
            $kY = $ML & $Wj ^ $ML & $mp ^ $Wj & $mp;
            $yc = $this->_add($J6, $kY);
            $va = $this->_rightRotate($hq, 6) ^ $this->_rightRotate($hq, 11) ^ $this->_rightRotate($hq, 25);
            $ZH = $hq & $e2 ^ $this->_not($hq) & $Ws;
            $lv = $this->_add($nV, $va, $ZH, $it[$zh], $Kr[$zh]);
            $nV = $Ws;
            $Ws = $e2;
            $e2 = $hq;
            $hq = $this->_add($Xy, $lv);
            $Xy = $mp;
            $mp = $Wj;
            $Wj = $ML;
            $ML = $this->_add($lv, $yc);
            w1:
            $zh++;
            goto nH;
            ND:
            $YT = array($this->_add($YT[0], $ML), $this->_add($YT[1], $Wj), $this->_add($YT[2], $mp), $this->_add($YT[3], $Xy), $this->_add($YT[4], $hq), $this->_add($YT[5], $e2), $this->_add($YT[6], $Ws), $this->_add($YT[7], $nV));
            xM:
        }
        jj:
        return pack("\116\70", $YT[0], $YT[1], $YT[2], $YT[3], $YT[4], $YT[5], $YT[6], $YT[7]);
    }
    function _sha512($fg)
    {
        if (class_exists("\115\x61\164\150\137\102\151\147\111\156\164\x65\x67\145\x72")) {
            goto mi;
        }
        include_once "\115\141\164\x68\57\x42\x69\147\111\156\164\145\147\x65\162\x2e\160\x68\160";
        mi:
        static $pw, $hS, $it;
        if (isset($it)) {
            goto OW;
        }
        $pw = array("\143\142\142\x62\71\x64\x35\x64\143\x31\x30\65\x39\145\x64\x38", "\x36\x32\71\x61\62\x39\62\141\x33\66\x37\143\x64\65\60\67", "\71\61\x35\71\x30\61\65\x61\63\x30\67\60\144\144\x31\67", "\61\x35\x32\x66\145\143\144\x38\146\67\60\145\x35\x39\63\71", "\66\67\63\63\62\66\x36\x37\146\x66\143\x30\60\x62\63\61", "\70\145\x62\64\x34\x61\70\x37\66\70\x35\70\61\65\61\x31", "\x64\x62\x30\x63\62\x65\x30\144\66\x34\x66\71\x38\x66\141\67", "\64\x37\x62\x35\x34\70\x31\x64\142\145\146\141\64\x66\x61\64");
        $hS = array("\66\141\x30\71\145\66\x36\67\x66\x33\142\x63\x63\x39\x30\x38", "\142\142\66\67\141\145\x38\65\70\x34\143\x61\141\x37\x33\142", "\x33\x63\66\145\x66\x33\x37\62\146\145\71\64\146\x38\x32\142", "\x61\65\64\146\x66\x35\x33\141\65\x66\x31\x64\63\66\146\x31", "\65\x31\60\x65\65\62\x37\x66\x61\144\145\x36\x38\62\x64\x31", "\x39\x62\60\65\66\70\x38\x63\62\142\x33\x65\66\x63\61\x66", "\61\x66\x38\63\x64\71\141\x62\x66\x62\x34\x31\142\x64\66\x62", "\x35\x62\145\60\x63\x64\x31\71\x31\63\x37\x65\x32\x31\x37\71");
        $zh = 0;
        wd:
        if (!($zh < 8)) {
            goto Bo;
        }
        $pw[$zh] = new Math_BigInteger($pw[$zh], 16);
        $pw[$zh]->setPrecision(64);
        $hS[$zh] = new Math_BigInteger($hS[$zh], 16);
        $hS[$zh]->setPrecision(64);
        nW:
        $zh++;
        goto wd;
        Bo:
        $it = array("\x34\x32\70\141\x32\x66\71\70\x64\x37\x32\70\141\145\x32\x32", "\67\61\63\x37\x34\64\71\x31\62\63\145\146\x36\65\x63\144", "\142\65\143\60\x66\142\x63\x66\x65\x63\64\144\63\x62\x32\146", "\145\x39\142\65\144\142\x61\x35\x38\x31\70\x39\144\142\x62\143", "\63\71\x35\x36\x63\62\x35\x62\146\63\64\x38\x62\65\63\x38", "\x35\x39\x66\x31\x31\x31\146\x31\x62\x36\60\x35\144\x30\61\x39", "\71\x32\63\146\x38\x32\141\64\141\146\x31\x39\x34\146\x39\142", "\141\x62\x31\x63\x35\145\x64\65\x64\x61\66\144\x38\61\61\70", "\x64\70\60\67\x61\x61\71\x38\141\63\60\x33\x30\62\64\x32", "\x31\x32\x38\63\65\x62\x30\61\64\65\x37\x30\x36\146\142\x65", "\x32\x34\x33\61\x38\x35\142\145\x34\145\145\64\142\62\x38\143", "\65\x35\60\143\67\144\x63\63\x64\x35\x66\x66\142\64\145\x32", "\67\x32\x62\145\x35\x64\x37\x34\x66\x32\67\x62\70\x39\66\x66", "\70\x30\x64\x65\142\x31\x66\145\x33\x62\x31\x36\x39\x36\x62\x31", "\x39\142\x64\x63\x30\x36\141\x37\x32\x35\143\67\61\62\x33\x35", "\x63\x31\71\142\x66\61\x37\64\143\146\66\x39\62\x36\71\x34", "\145\64\71\142\66\71\x63\x31\x39\x65\x66\61\x34\x61\x64\x32", "\145\146\142\145\x34\x37\70\66\63\x38\x34\x66\62\x35\145\63", "\x30\146\143\61\x39\144\143\x36\x38\142\70\x63\144\x35\142\x35", "\62\64\60\143\x61\61\143\143\x37\67\x61\x63\71\143\x36\65", "\62\x64\145\x39\x32\143\x36\x66\x35\x39\62\x62\60\62\x37\x35", "\x34\141\x37\x34\x38\x34\141\x61\x36\x65\141\x36\x65\x34\70\63", "\65\x63\x62\x30\x61\x39\x64\x63\x62\x64\64\61\146\x62\144\64", "\67\66\x66\x39\70\x38\144\x61\70\63\x31\x31\65\x33\x62\65", "\x39\x38\x33\x65\x35\x31\65\x32\x65\x65\66\x36\144\146\141\142", "\141\x38\63\61\143\x36\66\x64\x32\x64\142\64\63\x32\x31\60", "\142\60\x30\x33\x32\x37\x63\70\71\x38\x66\142\62\x31\63\146", "\142\146\x35\x39\x37\x66\143\x37\x62\145\145\146\60\x65\x65\x34", "\143\x36\145\60\60\x62\x66\x33\63\x64\x61\x38\x38\x66\143\62", "\x64\65\141\67\x39\61\64\67\71\63\60\x61\141\x37\x32\x35", "\60\66\x63\x61\x36\63\x35\x31\145\x30\60\x33\x38\x32\x36\x66", "\x31\64\x32\x39\x32\x39\x36\x37\60\141\60\145\66\x65\67\60", "\62\67\x62\67\60\141\70\65\x34\66\144\62\62\x66\146\143", "\x32\145\x31\x62\62\x31\x33\70\x35\143\62\x36\143\x39\62\66", "\64\144\62\x63\x36\144\146\143\65\x61\x63\64\x32\x61\x65\144", "\x35\63\63\70\60\x64\61\x33\71\x64\71\x35\x62\x33\144\x66", "\x36\65\60\141\x37\63\65\x34\x38\x62\x61\146\x36\63\x64\145", "\x37\66\66\x61\60\x61\142\142\63\143\x37\67\x62\x32\141\x38", "\x38\x31\x63\x32\x63\x39\x32\x65\x34\x37\145\144\x61\x65\x65\x36", "\71\x32\x37\62\x32\143\x38\65\x31\x34\70\62\x33\65\63\142", "\x61\62\x62\x66\x65\x38\x61\x31\x34\143\146\x31\x30\x33\x36\x34", "\141\70\x31\141\66\66\64\x62\142\143\64\62\63\x30\x30\61", "\x63\62\x34\142\70\142\x37\x30\144\60\146\70\71\x37\x39\x31", "\x63\67\66\143\x35\x31\141\x33\60\66\65\x34\x62\x65\x33\60", "\x64\61\71\x32\145\x38\61\x39\144\66\x65\146\65\62\x31\x38", "\x64\x36\71\71\60\66\62\x34\65\65\66\65\141\x39\x31\60", "\146\x34\60\x65\x33\x35\x38\x35\65\x37\67\x31\x32\60\x32\x61", "\61\x30\66\141\x61\x30\67\x30\63\x32\x62\142\x64\61\x62\70", "\61\x39\x61\x34\x63\x31\61\x36\142\x38\x64\62\x64\60\x63\x38", "\61\145\63\x37\66\x63\x30\70\65\61\64\x31\x61\x62\x35\x33", "\x32\67\64\70\67\x37\x34\143\x64\146\70\x65\x65\x62\x39\x39", "\63\64\x62\x30\x62\143\142\x35\x65\x31\x39\142\x34\70\141\70", "\x33\71\x31\143\60\143\142\x33\143\65\143\x39\x35\141\66\x33", "\64\x65\x64\x38\141\x61\64\x61\x65\63\x34\x31\70\141\143\x62", "\65\142\71\143\143\x61\x34\x66\67\x37\66\63\145\x33\x37\63", "\66\70\62\x65\66\x66\x66\63\x64\66\142\62\142\x38\141\x33", "\x37\64\70\146\70\62\x65\145\65\x64\x65\146\x62\62\x66\143", "\67\x38\141\65\x36\63\x36\146\64\x33\61\67\62\146\66\x30", "\x38\x34\x63\70\x37\x38\61\64\141\x31\x66\60\141\142\67\x32", "\70\143\x63\67\60\x32\60\x38\61\141\x36\64\63\x39\x65\143", "\x39\x30\x62\x65\146\x66\x66\141\62\x33\66\63\x31\145\x32\70", "\141\64\65\x30\x36\143\x65\142\144\x65\70\x32\142\x64\x65\71", "\x62\145\x66\71\141\x33\x66\x37\x62\x32\143\x36\67\x39\x31\x35", "\x63\x36\x37\61\x37\x38\146\62\x65\63\x37\x32\x35\x33\62\x62", "\x63\x61\62\x37\x33\x65\143\145\x65\x61\x32\66\66\x31\x39\143", "\144\61\x38\66\x62\70\143\x37\x32\61\x63\x30\x63\x32\60\x37", "\x65\141\144\141\67\x64\x64\x36\x63\x64\x65\60\145\142\x31\x65", "\x66\65\x37\x64\64\146\67\146\145\145\66\x65\x64\x31\x37\70", "\x30\x36\x66\60\x36\67\141\x61\67\x32\61\67\66\x66\142\141", "\x30\x61\x36\63\67\x64\143\x35\x61\x32\x63\x38\x39\x38\141\x36", "\61\x31\x33\146\71\70\60\x34\x62\x65\146\71\x30\144\141\x65", "\61\142\67\61\x30\x62\63\x35\61\63\61\143\64\67\61\x62", "\62\70\x64\x62\x37\67\x66\x35\62\63\60\x34\67\x64\70\64", "\63\x32\x63\x61\141\142\67\142\64\x30\x63\x37\62\x34\71\63", "\63\x63\71\x65\x62\145\x30\141\61\x35\143\71\142\x65\x62\143", "\x34\63\x31\x64\66\67\143\x34\x39\143\x31\60\60\x64\64\143", "\x34\143\x63\x35\x64\64\x62\145\x63\x62\63\145\x34\x32\142\x36", "\x35\71\x37\x66\62\71\71\x63\146\143\66\x35\x37\145\62\141", "\65\x66\143\142\x36\146\141\142\x33\141\x64\x36\x66\141\x65\x63", "\x36\x63\64\x34\61\x39\x38\x63\x34\141\x34\x37\65\x38\61\67");
        $zh = 0;
        j4:
        if (!($zh < 80)) {
            goto UX;
        }
        $it[$zh] = new Math_BigInteger($it[$zh], 16);
        Vs:
        $zh++;
        goto j4;
        UX:
        OW:
        $YT = $this->l == 48 ? $pw : $hS;
        $bw = strlen($fg);
        $fg .= str_repeat(chr(0), 128 - ($bw + 16 & 127));
        $fg[$bw] = chr(128);
        $fg .= pack("\116\x34", 0, 0, 0, $bw << 3);
        $C0 = str_split($fg, 128);
        foreach ($C0 as $h2) {
            $Kr = array();
            $zh = 0;
            fV:
            if (!($zh < 16)) {
                goto ej;
            }
            $iP = new Math_BigInteger($this->_string_shift($h2, 8), 256);
            $iP->setPrecision(64);
            $Kr[] = $iP;
            vS:
            $zh++;
            goto fV;
            ej:
            $zh = 16;
            V0:
            if (!($zh < 80)) {
                goto JV;
            }
            $iP = array($Kr[$zh - 15]->bitwise_rightRotate(1), $Kr[$zh - 15]->bitwise_rightRotate(8), $Kr[$zh - 15]->bitwise_rightShift(7));
            $J6 = $iP[0]->bitwise_xor($iP[1]);
            $J6 = $J6->bitwise_xor($iP[2]);
            $iP = array($Kr[$zh - 2]->bitwise_rightRotate(19), $Kr[$zh - 2]->bitwise_rightRotate(61), $Kr[$zh - 2]->bitwise_rightShift(6));
            $va = $iP[0]->bitwise_xor($iP[1]);
            $va = $va->bitwise_xor($iP[2]);
            $Kr[$zh] = $Kr[$zh - 16]->copy();
            $Kr[$zh] = $Kr[$zh]->add($J6);
            $Kr[$zh] = $Kr[$zh]->add($Kr[$zh - 7]);
            $Kr[$zh] = $Kr[$zh]->add($va);
            JG:
            $zh++;
            goto V0;
            JV:
            $ML = $YT[0]->copy();
            $Wj = $YT[1]->copy();
            $mp = $YT[2]->copy();
            $Xy = $YT[3]->copy();
            $hq = $YT[4]->copy();
            $e2 = $YT[5]->copy();
            $Ws = $YT[6]->copy();
            $nV = $YT[7]->copy();
            $zh = 0;
            Zk:
            if (!($zh < 80)) {
                goto eO;
            }
            $iP = array($ML->bitwise_rightRotate(28), $ML->bitwise_rightRotate(34), $ML->bitwise_rightRotate(39));
            $J6 = $iP[0]->bitwise_xor($iP[1]);
            $J6 = $J6->bitwise_xor($iP[2]);
            $iP = array($ML->bitwise_and($Wj), $ML->bitwise_and($mp), $Wj->bitwise_and($mp));
            $kY = $iP[0]->bitwise_xor($iP[1]);
            $kY = $kY->bitwise_xor($iP[2]);
            $yc = $J6->add($kY);
            $iP = array($hq->bitwise_rightRotate(14), $hq->bitwise_rightRotate(18), $hq->bitwise_rightRotate(41));
            $va = $iP[0]->bitwise_xor($iP[1]);
            $va = $va->bitwise_xor($iP[2]);
            $iP = array($hq->bitwise_and($e2), $Ws->bitwise_and($hq->bitwise_not()));
            $ZH = $iP[0]->bitwise_xor($iP[1]);
            $lv = $nV->add($va);
            $lv = $lv->add($ZH);
            $lv = $lv->add($it[$zh]);
            $lv = $lv->add($Kr[$zh]);
            $nV = $Ws->copy();
            $Ws = $e2->copy();
            $e2 = $hq->copy();
            $hq = $Xy->add($lv);
            $Xy = $mp->copy();
            $mp = $Wj->copy();
            $Wj = $ML->copy();
            $ML = $lv->add($yc);
            oU:
            $zh++;
            goto Zk;
            eO:
            $YT = array($YT[0]->add($ML), $YT[1]->add($Wj), $YT[2]->add($mp), $YT[3]->add($Xy), $YT[4]->add($hq), $YT[5]->add($e2), $YT[6]->add($Ws), $YT[7]->add($nV));
            AL:
        }
        QC:
        $iP = $YT[0]->toBytes() . $YT[1]->toBytes() . $YT[2]->toBytes() . $YT[3]->toBytes() . $YT[4]->toBytes() . $YT[5]->toBytes();
        if (!($this->l != 48)) {
            goto Cx;
        }
        $iP .= $YT[6]->toBytes() . $YT[7]->toBytes();
        Cx:
        return $iP;
    }
    function _rightRotate($s1, $Yg)
    {
        $eZ = 32 - $Yg;
        $mw = (1 << $eZ) - 1;
        return $s1 << $eZ & 4294967295 | $s1 >> $Yg & $mw;
    }
    function _rightShift($s1, $Yg)
    {
        $mw = (1 << 32 - $Yg) - 1;
        return $s1 >> $Yg & $mw;
    }
    function _not($s1)
    {
        return ~$s1 & 4294967295;
    }
    function _add()
    {
        static $P2;
        if (isset($P2)) {
            goto oC;
        }
        $P2 = pow(2, 32);
        oC:
        $xA = 0;
        $P4 = func_get_args();
        foreach ($P4 as $FM) {
            $xA += $FM < 0 ? ($FM & 2147483647) + 2147483648 : $FM;
            zF:
        }
        MZ:
        switch (true) {
            case is_int($xA):
            case version_compare(PHP_VERSION, "\x35\x2e\x33\56\x30") >= 0 && (php_uname("\155") & "\337\337\337") != "\101\122\x4d":
            case (PHP_OS & "\xdf\xdf\337") === "\x57\x49\116":
                return fmod($xA, $P2);
        }
        wI:
        CO:
        return fmod($xA, 2147483648) & 2147483647 | (fmod(floor($xA / 2147483648), 2) & 1) << 31;
    }
    function _string_shift(&$V3, $Gg = 1)
    {
        $Ao = substr($V3, 0, $Gg);
        $V3 = substr($V3, $Gg);
        return $Ao;
    }
}
