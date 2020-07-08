<?php


namespace MoOauthClient\GrantTypes;

define("\115\101\124\x48\x5f\102\x49\107\111\x4e\x54\105\107\x45\x52\137\115\117\x4e\124\107\117\115\x45\x52\x59", 0);
define("\115\101\x54\110\x5f\x42\x49\x47\x49\116\x54\x45\x47\x45\122\x5f\x42\101\122\122\x45\124\x54", 1);
define("\x4d\x41\124\x48\137\x42\x49\x47\x49\x4e\x54\105\x47\105\x52\137\120\x4f\127\105\122\x4f\x46\x32", 2);
define("\115\101\124\x48\x5f\x42\x49\x47\111\116\124\105\x47\x45\x52\137\x43\114\101\123\123\111\103", 3);
define("\x4d\101\124\110\x5f\102\111\107\x49\116\x54\105\x47\105\x52\x5f\x4e\117\x4e\x45", 4);
define("\x4d\101\x54\110\137\x42\111\107\x49\116\124\105\107\x45\x52\137\126\101\x4c\125\x45", 0);
define("\115\101\124\110\x5f\x42\111\x47\111\x4e\x54\105\x47\105\122\x5f\x53\x49\x47\116", 1);
define("\115\101\124\x48\137\102\x49\x47\111\x4e\x54\x45\x47\105\122\x5f\126\101\122\x49\x41\x42\x4c\x45", 0);
define("\115\101\124\x48\137\x42\x49\x47\x49\116\124\105\107\x45\x52\x5f\104\101\x54\x41", 1);
define("\115\101\124\x48\x5f\102\111\x47\111\116\x54\x45\x47\x45\122\x5f\x4d\x4f\104\x45\137\x49\116\x54\x45\122\116\x41\x4c", 1);
define("\115\101\124\x48\x5f\102\x49\x47\x49\x4e\x54\x45\107\x45\x52\137\115\117\x44\105\x5f\x42\x43\115\x41\124\110", 2);
define("\115\101\x54\110\137\102\111\107\x49\116\x54\105\107\105\x52\x5f\x4d\117\104\105\137\x47\x4d\x50", 3);
define("\x4d\101\124\110\x5f\x42\111\107\111\116\x54\105\x47\x45\x52\137\113\x41\122\101\x54\x53\125\x42\101\137\x43\x55\x54\x4f\x46\x46", 25);
class Math_BigInteger
{
    var $value;
    var $is_negative = false;
    var $precision = -1;
    var $bitmask = false;
    var $hex;
    function __construct($D9 = 0, $GJ = 10)
    {
        if (defined("\115\x41\124\110\137\102\111\x47\x49\x4e\124\x45\x47\105\x52\137\x4d\117\x44\x45")) {
            goto qs;
        }
        switch (true) {
            case extension_loaded("\x67\x6d\160"):
                define("\115\x41\124\x48\137\102\111\x47\111\116\124\105\x47\x45\x52\137\115\x4f\104\x45", MATH_BIGINTEGER_MODE_GMP);
                goto ZC;
            case extension_loaded("\142\x63\x6d\x61\x74\x68"):
                define("\x4d\101\124\x48\137\x42\111\107\x49\x4e\124\105\x47\x45\x52\137\115\x4f\104\105", MATH_BIGINTEGER_MODE_BCMATH);
                goto ZC;
            default:
                define("\x4d\101\x54\110\x5f\x42\x49\x47\x49\116\x54\x45\x47\x45\122\x5f\115\117\104\105", MATH_BIGINTEGER_MODE_INTERNAL);
        }
        gR:
        ZC:
        qs:
        if (!(extension_loaded("\x6f\x70\145\x6e\x73\x73\x6c") && !defined("\115\101\124\110\x5f\102\111\107\x49\x4e\x54\x45\107\105\122\137\117\x50\x45\116\123\x53\114\137\x44\111\123\x41\x42\114\x45") && !defined("\x4d\x41\x54\x48\x5f\x42\x49\107\111\116\x54\x45\107\105\122\137\117\x50\105\x4e\123\123\x4c\x5f\105\116\101\x42\x4c\105\x44"))) {
            goto Ym;
        }
        ob_start();
        @phpinfo();
        $mg = ob_get_contents();
        ob_end_clean();
        preg_match_all("\43\117\160\x65\x6e\x53\x53\114\x20\x28\110\145\x61\x64\145\162\x7c\x4c\x69\142\162\141\162\171\51\40\126\x65\162\163\151\157\156\50\56\x2a\x29\x23\x69\x6d", $mg, $xE);
        $Cj = array();
        if (empty($xE[1])) {
            goto Nr;
        }
        $zh = 0;
        iV:
        if (!($zh < count($xE[1]))) {
            goto y8;
        }
        $KV = trim(str_replace("\x3d\76", '', strip_tags($xE[2][$zh])));
        if (!preg_match("\57\50\134\x64\x2b\x5c\x2e\x5c\144\x2b\x5c\x2e\134\x64\x2b\x29\57\x69", $KV, $fg)) {
            goto eb;
        }
        $Cj[$xE[1][$zh]] = $fg[0];
        goto Po;
        eb:
        $Cj[$xE[1][$zh]] = $KV;
        Po:
        BA:
        $zh++;
        goto iV;
        y8:
        Nr:
        switch (true) {
            case !isset($Cj["\x48\x65\141\144\x65\x72"]):
            case !isset($Cj["\114\151\x62\x72\141\x72\171"]):
            case $Cj["\x48\145\x61\144\145\x72"] == $Cj["\114\x69\x62\162\141\162\x79"]:
            case version_compare($Cj["\110\x65\x61\144\145\x72"], "\x31\56\60\56\60") >= 0 && version_compare($Cj["\x4c\151\142\x72\x61\x72\x79"], "\61\56\60\56\60") >= 0:
                define("\x4d\101\124\110\137\102\x49\107\x49\116\124\105\107\105\122\x5f\117\x50\x45\x4e\x53\x53\114\x5f\105\x4e\x41\102\x4c\105\x44", true);
                goto R8;
            default:
                define("\x4d\101\124\x48\x5f\102\111\107\111\x4e\124\105\107\105\122\137\x4f\x50\105\x4e\123\x53\x4c\137\104\x49\123\101\x42\114\x45", true);
        }
        xz:
        R8:
        Ym:
        if (defined("\x50\x48\x50\x5f\111\x4e\124\137\x53\111\132\x45")) {
            goto tv;
        }
        define("\x50\x48\x50\x5f\x49\x4e\x54\x5f\123\x49\x5a\x45", 4);
        tv:
        if (!(!defined("\x4d\101\124\110\x5f\x42\111\x47\x49\116\x54\x45\107\x45\x52\137\102\101\123\105") && MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_INTERNAL)) {
            goto TS;
        }
        switch (PHP_INT_SIZE) {
            case 8:
                define("\115\101\124\110\x5f\102\111\x47\111\x4e\124\105\x47\105\122\x5f\102\x41\123\105", 31);
                define("\115\101\124\110\137\x42\x49\107\x49\116\x54\105\x47\x45\122\137\x42\101\123\105\137\x46\125\114\114", 2147483648);
                define("\x4d\x41\124\110\x5f\102\x49\107\111\x4e\124\105\107\x45\122\x5f\115\x41\130\137\x44\x49\107\x49\124", 2147483647);
                define("\115\101\x54\x48\137\102\x49\x47\111\116\124\105\107\105\122\137\115\123\102", 1073741824);
                define("\x4d\x41\124\110\137\x42\x49\x47\111\x4e\124\105\107\105\x52\x5f\x4d\101\x58\x31\60", 1000000000);
                define("\x4d\101\x54\x48\137\102\111\107\x49\116\x54\105\107\105\122\x5f\x4d\101\130\x31\60\x5f\114\105\x4e", 9);
                define("\x4d\101\124\x48\x5f\102\111\107\x49\x4e\x54\x45\x47\105\x52\x5f\115\101\130\x5f\104\111\107\x49\x54\x32", pow(2, 62));
                goto eN;
            default:
                define("\x4d\101\124\x48\137\102\x49\x47\x49\116\x54\105\x47\105\x52\137\x42\x41\x53\x45", 26);
                define("\x4d\101\x54\x48\x5f\102\111\107\111\116\124\105\107\x45\122\137\x42\101\x53\x45\x5f\x46\125\114\114", 67108864);
                define("\115\101\124\x48\x5f\102\111\x47\x49\116\x54\105\x47\x45\122\x5f\115\101\x58\137\104\x49\107\111\124", 67108863);
                define("\x4d\x41\x54\x48\x5f\102\x49\x47\x49\x4e\x54\x45\x47\x45\x52\137\115\x53\102", 33554432);
                define("\115\x41\x54\110\x5f\102\x49\x47\x49\116\x54\x45\107\x45\x52\x5f\x4d\x41\130\x31\60", 10000000);
                define("\x4d\x41\x54\x48\137\102\x49\x47\x49\x4e\124\x45\107\x45\x52\137\x4d\x41\130\61\60\x5f\114\x45\x4e", 7);
                define("\115\x41\124\110\137\102\x49\x47\111\116\x54\105\x47\105\x52\x5f\x4d\101\x58\x5f\x44\111\x47\111\x54\62", pow(2, 52));
        }
        hB:
        eN:
        TS:
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                switch (true) {
                    case is_resource($D9) && get_resource_type($D9) == "\107\115\120\x20\151\156\x74\145\x67\145\162":
                    case is_object($D9) && get_class($D9) == "\107\x4d\x50":
                        $this->value = $D9;
                        return;
                }
                Hw:
                YA:
                $this->value = gmp_init(0);
                goto fi;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $this->value = "\x30";
                goto fi;
            default:
                $this->value = array();
        }
        Tq:
        fi:
        if (!(empty($D9) && (abs($GJ) != 256 || $D9 !== "\x30"))) {
            goto pk;
        }
        return;
        pk:
        switch ($GJ) {
            case -256:
                if (!(ord($D9[0]) & 128)) {
                    goto pM;
                }
                $D9 = ~$D9;
                $this->is_negative = true;
                pM:
            case 256:
                switch (MATH_BIGINTEGER_MODE) {
                    case MATH_BIGINTEGER_MODE_GMP:
                        $this->value = function_exists("\x67\155\x70\137\x69\155\x70\157\162\164") ? gmp_import($D9) : gmp_init("\60\x78" . bin2hex($D9));
                        if (!$this->is_negative) {
                            goto US;
                        }
                        $this->value = gmp_neg($this->value);
                        US:
                        goto bF;
                    case MATH_BIGINTEGER_MODE_BCMATH:
                        $Cg = strlen($D9) + 3 & 4294967292;
                        $D9 = str_pad($D9, $Cg, chr(0), STR_PAD_LEFT);
                        $zh = 0;
                        fB:
                        if (!($zh < $Cg)) {
                            goto jf;
                        }
                        $this->value = bcmul($this->value, "\64\x32\x39\x34\x39\66\x37\x32\x39\66", 0);
                        $this->value = bcadd($this->value, 16777216 * ord($D9[$zh]) + (ord($D9[$zh + 1]) << 16 | ord($D9[$zh + 2]) << 8 | ord($D9[$zh + 3])), 0);
                        YN:
                        $zh += 4;
                        goto fB;
                        jf:
                        if (!$this->is_negative) {
                            goto c7;
                        }
                        $this->value = "\55" . $this->value;
                        c7:
                        goto bF;
                    default:
                        SD:
                        if (!strlen($D9)) {
                            goto a3;
                        }
                        $this->value[] = $this->_bytes2int($this->_base256_rshift($D9, MATH_BIGINTEGER_BASE));
                        goto SD;
                        a3:
                }
                p5:
                bF:
                if (!$this->is_negative) {
                    goto vy;
                }
                if (!(MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL)) {
                    goto Nh;
                }
                $this->is_negative = false;
                Nh:
                $iP = $this->add(new Math_BigInteger("\55\61"));
                $this->value = $iP->value;
                vy:
                goto LV;
            case 16:
            case -16:
                if (!($GJ > 0 && $D9[0] == "\x2d")) {
                    goto Jb;
                }
                $this->is_negative = true;
                $D9 = substr($D9, 1);
                Jb:
                $D9 = preg_replace("\43\136\50\77\x3a\x30\x78\x29\x3f\50\133\x41\55\x46\x61\55\146\x30\55\x39\x5d\x2a\51\x2e\x2a\x23", "\44\61", $D9);
                $zj = false;
                if (!($GJ < 0 && hexdec($D9[0]) >= 8)) {
                    goto X8;
                }
                $this->is_negative = $zj = true;
                $D9 = bin2hex(~pack("\110\x2a", $D9));
                X8:
                switch (MATH_BIGINTEGER_MODE) {
                    case MATH_BIGINTEGER_MODE_GMP:
                        $iP = $this->is_negative ? "\55\60\x78" . $D9 : "\x30\170" . $D9;
                        $this->value = gmp_init($iP);
                        $this->is_negative = false;
                        goto Wv;
                    case MATH_BIGINTEGER_MODE_BCMATH:
                        $D9 = strlen($D9) & 1 ? "\x30" . $D9 : $D9;
                        $iP = new Math_BigInteger(pack("\x48\x2a", $D9), 256);
                        $this->value = $this->is_negative ? "\x2d" . $iP->value : $iP->value;
                        $this->is_negative = false;
                        goto Wv;
                    default:
                        $D9 = strlen($D9) & 1 ? "\x30" . $D9 : $D9;
                        $iP = new Math_BigInteger(pack("\x48\52", $D9), 256);
                        $this->value = $iP->value;
                }
                E1:
                Wv:
                if (!$zj) {
                    goto kW;
                }
                $iP = $this->add(new Math_BigInteger("\x2d\61"));
                $this->value = $iP->value;
                kW:
                goto LV;
            case 10:
            case -10:
                $D9 = preg_replace("\43\x28\77\74\x21\136\51\50\x3f\x3a\x2d\51\56\52\174\x28\x3f\74\x3d\x5e\x7c\55\x29\60\x2a\174\133\136\x2d\60\55\x39\x5d\x2e\x2a\x23", '', $D9);
                switch (MATH_BIGINTEGER_MODE) {
                    case MATH_BIGINTEGER_MODE_GMP:
                        $this->value = gmp_init($D9);
                        goto qL;
                    case MATH_BIGINTEGER_MODE_BCMATH:
                        $this->value = $D9 === "\55" ? "\60" : (string) $D9;
                        goto qL;
                    default:
                        $iP = new Math_BigInteger();
                        $oA = new Math_BigInteger();
                        $oA->value = array(MATH_BIGINTEGER_MAX10);
                        if (!($D9[0] == "\55")) {
                            goto Kq;
                        }
                        $this->is_negative = true;
                        $D9 = substr($D9, 1);
                        Kq:
                        $D9 = str_pad($D9, strlen($D9) + (MATH_BIGINTEGER_MAX10_LEN - 1) * strlen($D9) % MATH_BIGINTEGER_MAX10_LEN, 0, STR_PAD_LEFT);
                        IV:
                        if (!strlen($D9)) {
                            goto wB;
                        }
                        $iP = $iP->multiply($oA);
                        $iP = $iP->add(new Math_BigInteger($this->_int2bytes(substr($D9, 0, MATH_BIGINTEGER_MAX10_LEN)), 256));
                        $D9 = substr($D9, MATH_BIGINTEGER_MAX10_LEN);
                        goto IV;
                        wB:
                        $this->value = $iP->value;
                }
                Ck:
                qL:
                goto LV;
            case 2:
            case -2:
                if (!($GJ > 0 && $D9[0] == "\x2d")) {
                    goto IZ;
                }
                $this->is_negative = true;
                $D9 = substr($D9, 1);
                IZ:
                $D9 = preg_replace("\x23\136\50\x5b\x30\61\135\52\51\56\52\x23", "\x24\x31", $D9);
                $D9 = str_pad($D9, strlen($D9) + 3 * strlen($D9) % 4, 0, STR_PAD_LEFT);
                $sr = "\x30\170";
                z_:
                if (!strlen($D9)) {
                    goto u3;
                }
                $ni = substr($D9, 0, 4);
                $sr .= dechex(bindec($ni));
                $D9 = substr($D9, 4);
                goto z_;
                u3:
                if (!$this->is_negative) {
                    goto KS;
                }
                $sr = "\55" . $sr;
                KS:
                $iP = new Math_BigInteger($sr, 8 * $GJ);
                $this->value = $iP->value;
                $this->is_negative = $iP->is_negative;
                goto LV;
            default:
        }
        IQ:
        LV:
    }
    function Math_BigInteger($D9 = 0, $GJ = 10)
    {
        $this->__construct($D9, $GJ);
    }
    function toBytes($dh = false)
    {
        if (!$dh) {
            goto Ua;
        }
        $k9 = $this->compare(new Math_BigInteger());
        if (!($k9 == 0)) {
            goto ci;
        }
        return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
        ci:
        $iP = $k9 < 0 ? $this->add(new Math_BigInteger(1)) : $this->copy();
        $tV = $iP->toBytes();
        if (!empty($tV)) {
            goto ic;
        }
        $tV = chr(0);
        ic:
        if (!(ord($tV[0]) & 128)) {
            goto LC;
        }
        $tV = chr(0) . $tV;
        LC:
        return $k9 < 0 ? ~$tV : $tV;
        Ua:
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                if (!(gmp_cmp($this->value, gmp_init(0)) == 0)) {
                    goto Np;
                }
                return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
                Np:
                if (function_exists("\x67\x6d\x70\137\145\170\160\157\x72\x74")) {
                    goto HH;
                }
                $iP = gmp_strval(gmp_abs($this->value), 16);
                $iP = strlen($iP) & 1 ? "\60" . $iP : $iP;
                $iP = pack("\x48\x2a", $iP);
                goto U6;
                HH:
                $iP = gmp_export($this->value);
                U6:
                return $this->precision > 0 ? substr(str_pad($iP, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($iP, chr(0));
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value === "\60")) {
                    goto hI;
                }
                return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
                hI:
                $Da = '';
                $BV = $this->value;
                if (!($BV[0] == "\55")) {
                    goto N7;
                }
                $BV = substr($BV, 1);
                N7:
                IN:
                if (!(bccomp($BV, "\60", 0) > 0)) {
                    goto p7;
                }
                $iP = bcmod($BV, "\61\66\67\67\67\x32\61\66");
                $Da = chr($iP >> 16) . chr($iP >> 8) . chr($iP) . $Da;
                $BV = bcdiv($BV, "\61\66\x37\x37\67\x32\x31\x36", 0);
                goto IN;
                p7:
                return $this->precision > 0 ? substr(str_pad($Da, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($Da, chr(0));
        }
        sX:
        ri:
        if (count($this->value)) {
            goto K2;
        }
        return $this->precision > 0 ? str_repeat(chr(0), $this->precision + 1 >> 3) : '';
        K2:
        $xA = $this->_int2bytes($this->value[count($this->value) - 1]);
        $iP = $this->copy();
        $zh = count($iP->value) - 2;
        pi:
        if (!($zh >= 0)) {
            goto wW;
        }
        $iP->_base256_lshift($xA, MATH_BIGINTEGER_BASE);
        $xA = $xA | str_pad($iP->_int2bytes($iP->value[$zh]), strlen($xA), chr(0), STR_PAD_LEFT);
        LF:
        --$zh;
        goto pi;
        wW:
        return $this->precision > 0 ? str_pad(substr($xA, -($this->precision + 7 >> 3)), $this->precision + 7 >> 3, chr(0), STR_PAD_LEFT) : $xA;
    }
    function toHex($dh = false)
    {
        return bin2hex($this->toBytes($dh));
    }
    function toBits($dh = false)
    {
        $aB = $this->toHex($dh);
        $UH = '';
        $zh = strlen($aB) - 8;
        $KI = strlen($aB) & 7;
        r7:
        if (!($zh >= $KI)) {
            goto iC;
        }
        $UH = str_pad(decbin(hexdec(substr($aB, $zh, 8))), 32, "\x30", STR_PAD_LEFT) . $UH;
        q0:
        $zh -= 8;
        goto r7;
        iC:
        if (!$KI) {
            goto rY;
        }
        $UH = str_pad(decbin(hexdec(substr($aB, 0, $KI))), 8, "\x30", STR_PAD_LEFT) . $UH;
        rY:
        $xA = $this->precision > 0 ? substr($UH, -$this->precision) : ltrim($UH, "\x30");
        if (!($dh && $this->compare(new Math_BigInteger()) > 0 && $this->precision <= 0)) {
            goto CB;
        }
        return "\60" . $xA;
        CB:
        return $xA;
    }
    function toString()
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_strval($this->value);
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value === "\x30")) {
                    goto sR;
                }
                return "\60";
                sR:
                return ltrim($this->value, "\60");
        }
        k2:
        ZH:
        if (count($this->value)) {
            goto ko;
        }
        return "\60";
        ko:
        $iP = $this->copy();
        $iP->is_negative = false;
        $qx = new Math_BigInteger();
        $qx->value = array(MATH_BIGINTEGER_MAX10);
        $xA = '';
        yh:
        if (!count($iP->value)) {
            goto Rd;
        }
        list($iP, $P2) = $iP->divide($qx);
        $xA = str_pad(isset($P2->value[0]) ? $P2->value[0] : '', MATH_BIGINTEGER_MAX10_LEN, "\60", STR_PAD_LEFT) . $xA;
        goto yh;
        Rd:
        $xA = ltrim($xA, "\60");
        if (!empty($xA)) {
            goto eE;
        }
        $xA = "\60";
        eE:
        if (!$this->is_negative) {
            goto fF;
        }
        $xA = "\x2d" . $xA;
        fF:
        return $xA;
    }
    function copy()
    {
        $iP = new Math_BigInteger();
        $iP->value = $this->value;
        $iP->is_negative = $this->is_negative;
        $iP->precision = $this->precision;
        $iP->bitmask = $this->bitmask;
        return $iP;
    }
    function __toString()
    {
        return $this->toString();
    }
    function __clone()
    {
        return $this->copy();
    }
    function __sleep()
    {
        $this->hex = $this->toHex(true);
        $bA = array("\150\x65\170");
        if (!($this->precision > 0)) {
            goto Og;
        }
        $bA[] = "\160\x72\145\143\151\x73\x69\157\156";
        Og:
        return $bA;
    }
    function __wakeup()
    {
        $iP = new Math_BigInteger($this->hex, -16);
        $this->value = $iP->value;
        $this->is_negative = $iP->is_negative;
        if (!($this->precision > 0)) {
            goto c9;
        }
        $this->setPrecision($this->precision);
        c9:
    }
    function __debugInfo()
    {
        $Jd = array();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $et = "\147\x6d\160";
                goto m2;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $et = "\x62\x63\155\141\x74\x68";
                goto m2;
            case MATH_BIGINTEGER_MODE_INTERNAL:
                $et = "\151\156\164\145\162\156\x61\x6c";
                $Jd[] = PHP_INT_SIZE == 8 ? "\x36\x34\55\142\151\x74" : "\63\62\x2d\142\151\x74";
        }
        Er:
        m2:
        if (!(MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_GMP && defined("\x4d\101\124\x48\137\102\111\107\111\x4e\x54\105\x47\x45\x52\137\x4f\x50\105\116\123\x53\114\x5f\x45\x4e\101\102\x4c\x45\x44"))) {
            goto Na;
        }
        $Jd[] = "\117\160\145\156\123\x53\x4c";
        Na:
        if (empty($Jd)) {
            goto eK;
        }
        $et .= "\x20\x28" . implode($Jd, "\x2c\x20") . "\51";
        eK:
        return array("\166\x61\x6c\165\145" => "\60\170" . $this->toHex(true), "\145\x6e\147\151\156\145" => $et);
    }
    function add($I3)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_add($this->value, $I3->value);
                return $this->_normalize($iP);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $iP = new Math_BigInteger();
                $iP->value = bcadd($this->value, $I3->value, 0);
                return $this->_normalize($iP);
        }
        oH:
        Dv:
        $iP = $this->_add($this->value, $this->is_negative, $I3->value, $I3->is_negative);
        $xA = new Math_BigInteger();
        $xA->value = $iP[MATH_BIGINTEGER_VALUE];
        $xA->is_negative = $iP[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($xA);
    }
    function _add($ow, $pD, $Ty, $PE)
    {
        $GC = count($ow);
        $Bq = count($Ty);
        if ($GC == 0) {
            goto lU;
        }
        if ($Bq == 0) {
            goto pv;
        }
        goto JO;
        lU:
        return array(MATH_BIGINTEGER_VALUE => $Ty, MATH_BIGINTEGER_SIGN => $PE);
        goto JO;
        pv:
        return array(MATH_BIGINTEGER_VALUE => $ow, MATH_BIGINTEGER_SIGN => $pD);
        JO:
        if (!($pD != $PE)) {
            goto yG;
        }
        if (!($ow == $Ty)) {
            goto xI;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        xI:
        $iP = $this->_subtract($ow, false, $Ty, false);
        $iP[MATH_BIGINTEGER_SIGN] = $this->_compare($ow, false, $Ty, false) > 0 ? $pD : $PE;
        return $iP;
        yG:
        if ($GC < $Bq) {
            goto D3;
        }
        $wF = $Bq;
        $Da = $ow;
        goto nb;
        D3:
        $wF = $GC;
        $Da = $Ty;
        nb:
        $Da[count($Da)] = 0;
        $ae = 0;
        $zh = 0;
        $Pf = 1;
        YB:
        if (!($Pf < $wF)) {
            goto dB;
        }
        $wb = $ow[$Pf] * MATH_BIGINTEGER_BASE_FULL + $ow[$zh] + $Ty[$Pf] * MATH_BIGINTEGER_BASE_FULL + $Ty[$zh] + $ae;
        $ae = $wb >= MATH_BIGINTEGER_MAX_DIGIT2;
        $wb = $ae ? $wb - MATH_BIGINTEGER_MAX_DIGIT2 : $wb;
        $iP = MATH_BIGINTEGER_BASE === 26 ? intval($wb / 67108864) : $wb >> 31;
        $Da[$zh] = (int) ($wb - MATH_BIGINTEGER_BASE_FULL * $iP);
        $Da[$Pf] = $iP;
        HU:
        $zh += 2;
        $Pf += 2;
        goto YB;
        dB:
        if (!($Pf == $wF)) {
            goto M8;
        }
        $wb = $ow[$zh] + $Ty[$zh] + $ae;
        $ae = $wb >= MATH_BIGINTEGER_BASE_FULL;
        $Da[$zh] = $ae ? $wb - MATH_BIGINTEGER_BASE_FULL : $wb;
        ++$zh;
        M8:
        if (!$ae) {
            goto j3;
        }
        II:
        if (!($Da[$zh] == MATH_BIGINTEGER_MAX_DIGIT)) {
            goto Wf;
        }
        $Da[$zh] = 0;
        WT:
        ++$zh;
        goto II;
        Wf:
        ++$Da[$zh];
        j3:
        return array(MATH_BIGINTEGER_VALUE => $this->_trim($Da), MATH_BIGINTEGER_SIGN => $pD);
    }
    function subtract($I3)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_sub($this->value, $I3->value);
                return $this->_normalize($iP);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $iP = new Math_BigInteger();
                $iP->value = bcsub($this->value, $I3->value, 0);
                return $this->_normalize($iP);
        }
        G_:
        OL:
        $iP = $this->_subtract($this->value, $this->is_negative, $I3->value, $I3->is_negative);
        $xA = new Math_BigInteger();
        $xA->value = $iP[MATH_BIGINTEGER_VALUE];
        $xA->is_negative = $iP[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($xA);
    }
    function _subtract($ow, $pD, $Ty, $PE)
    {
        $GC = count($ow);
        $Bq = count($Ty);
        if ($GC == 0) {
            goto Qz;
        }
        if ($Bq == 0) {
            goto fs;
        }
        goto h3;
        Qz:
        return array(MATH_BIGINTEGER_VALUE => $Ty, MATH_BIGINTEGER_SIGN => !$PE);
        goto h3;
        fs:
        return array(MATH_BIGINTEGER_VALUE => $ow, MATH_BIGINTEGER_SIGN => $pD);
        h3:
        if (!($pD != $PE)) {
            goto Go;
        }
        $iP = $this->_add($ow, false, $Ty, false);
        $iP[MATH_BIGINTEGER_SIGN] = $pD;
        return $iP;
        Go:
        $Ud = $this->_compare($ow, $pD, $Ty, $PE);
        if ($Ud) {
            goto gk;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        gk:
        if (!(!$pD && $Ud < 0 || $pD && $Ud > 0)) {
            goto oO;
        }
        $iP = $ow;
        $ow = $Ty;
        $Ty = $iP;
        $pD = !$pD;
        $GC = count($ow);
        $Bq = count($Ty);
        oO:
        $ae = 0;
        $zh = 0;
        $Pf = 1;
        P8:
        if (!($Pf < $Bq)) {
            goto LB;
        }
        $wb = $ow[$Pf] * MATH_BIGINTEGER_BASE_FULL + $ow[$zh] - $Ty[$Pf] * MATH_BIGINTEGER_BASE_FULL - $Ty[$zh] - $ae;
        $ae = $wb < 0;
        $wb = $ae ? $wb + MATH_BIGINTEGER_MAX_DIGIT2 : $wb;
        $iP = MATH_BIGINTEGER_BASE === 26 ? intval($wb / 67108864) : $wb >> 31;
        $ow[$zh] = (int) ($wb - MATH_BIGINTEGER_BASE_FULL * $iP);
        $ow[$Pf] = $iP;
        Dt:
        $zh += 2;
        $Pf += 2;
        goto P8;
        LB:
        if (!($Pf == $Bq)) {
            goto nU;
        }
        $wb = $ow[$zh] - $Ty[$zh] - $ae;
        $ae = $wb < 0;
        $ow[$zh] = $ae ? $wb + MATH_BIGINTEGER_BASE_FULL : $wb;
        ++$zh;
        nU:
        if (!$ae) {
            goto JD;
        }
        xB:
        if ($ow[$zh]) {
            goto T_;
        }
        $ow[$zh] = MATH_BIGINTEGER_MAX_DIGIT;
        Ky:
        ++$zh;
        goto xB;
        T_:
        --$ow[$zh];
        JD:
        return array(MATH_BIGINTEGER_VALUE => $this->_trim($ow), MATH_BIGINTEGER_SIGN => $pD);
    }
    function multiply($D9)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_mul($this->value, $D9->value);
                return $this->_normalize($iP);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $iP = new Math_BigInteger();
                $iP->value = bcmul($this->value, $D9->value, 0);
                return $this->_normalize($iP);
        }
        Q9:
        Qu:
        $iP = $this->_multiply($this->value, $this->is_negative, $D9->value, $D9->is_negative);
        $Oi = new Math_BigInteger();
        $Oi->value = $iP[MATH_BIGINTEGER_VALUE];
        $Oi->is_negative = $iP[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($Oi);
    }
    function _multiply($ow, $pD, $Ty, $PE)
    {
        $vB = count($ow);
        $sQ = count($Ty);
        if (!(!$vB || !$sQ)) {
            goto W4;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        W4:
        return array(MATH_BIGINTEGER_VALUE => min($vB, $sQ) < 2 * MATH_BIGINTEGER_KARATSUBA_CUTOFF ? $this->_trim($this->_regularMultiply($ow, $Ty)) : $this->_trim($this->_karatsuba($ow, $Ty)), MATH_BIGINTEGER_SIGN => $pD != $PE);
    }
    function _regularMultiply($ow, $Ty)
    {
        $vB = count($ow);
        $sQ = count($Ty);
        if (!(!$vB || !$sQ)) {
            goto FW;
        }
        return array();
        FW:
        if (!($vB < $sQ)) {
            goto FE;
        }
        $iP = $ow;
        $ow = $Ty;
        $Ty = $iP;
        $vB = count($ow);
        $sQ = count($Ty);
        FE:
        $l6 = $this->_array_repeat(0, $vB + $sQ);
        $ae = 0;
        $Pf = 0;
        x2:
        if (!($Pf < $vB)) {
            goto kK;
        }
        $iP = $ow[$Pf] * $Ty[0] + $ae;
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $l6[$Pf] = (int) ($iP - MATH_BIGINTEGER_BASE_FULL * $ae);
        aA:
        ++$Pf;
        goto x2;
        kK:
        $l6[$Pf] = $ae;
        $zh = 1;
        RF:
        if (!($zh < $sQ)) {
            goto uO;
        }
        $ae = 0;
        $Pf = 0;
        $it = $zh;
        Nk:
        if (!($Pf < $vB)) {
            goto CJ;
        }
        $iP = $l6[$it] + $ow[$Pf] * $Ty[$zh] + $ae;
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $l6[$it] = (int) ($iP - MATH_BIGINTEGER_BASE_FULL * $ae);
        Kz:
        ++$Pf;
        ++$it;
        goto Nk;
        CJ:
        $l6[$it] = $ae;
        cW:
        ++$zh;
        goto RF;
        uO:
        return $l6;
    }
    function _karatsuba($ow, $Ty)
    {
        $fg = min(count($ow) >> 1, count($Ty) >> 1);
        if (!($fg < MATH_BIGINTEGER_KARATSUBA_CUTOFF)) {
            goto nJ;
        }
        return $this->_regularMultiply($ow, $Ty);
        nJ:
        $fn = array_slice($ow, $fg);
        $Gq = array_slice($ow, 0, $fg);
        $Dc = array_slice($Ty, $fg);
        $Zw = array_slice($Ty, 0, $fg);
        $BH = $this->_karatsuba($fn, $Dc);
        $Ny = $this->_karatsuba($Gq, $Zw);
        $bq = $this->_add($fn, false, $Gq, false);
        $iP = $this->_add($Dc, false, $Zw, false);
        $bq = $this->_karatsuba($bq[MATH_BIGINTEGER_VALUE], $iP[MATH_BIGINTEGER_VALUE]);
        $iP = $this->_add($BH, false, $Ny, false);
        $bq = $this->_subtract($bq, false, $iP[MATH_BIGINTEGER_VALUE], false);
        $BH = array_merge(array_fill(0, 2 * $fg, 0), $BH);
        $bq[MATH_BIGINTEGER_VALUE] = array_merge(array_fill(0, $fg, 0), $bq[MATH_BIGINTEGER_VALUE]);
        $M0 = $this->_add($BH, false, $bq[MATH_BIGINTEGER_VALUE], $bq[MATH_BIGINTEGER_SIGN]);
        $M0 = $this->_add($M0[MATH_BIGINTEGER_VALUE], $M0[MATH_BIGINTEGER_SIGN], $Ny, false);
        return $M0[MATH_BIGINTEGER_VALUE];
    }
    function _square($D9 = false)
    {
        return count($D9) < 2 * MATH_BIGINTEGER_KARATSUBA_CUTOFF ? $this->_trim($this->_baseSquare($D9)) : $this->_trim($this->_karatsubaSquare($D9));
    }
    function _baseSquare($Da)
    {
        if (!empty($Da)) {
            goto gs;
        }
        return array();
        gs:
        $pq = $this->_array_repeat(0, 2 * count($Da));
        $zh = 0;
        $nH = count($Da) - 1;
        mb:
        if (!($zh <= $nH)) {
            goto zS;
        }
        $sn = $zh << 1;
        $iP = $pq[$sn] + $Da[$zh] * $Da[$zh];
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $pq[$sn] = (int) ($iP - MATH_BIGINTEGER_BASE_FULL * $ae);
        $Pf = $zh + 1;
        $it = $sn + 1;
        qA:
        if (!($Pf <= $nH)) {
            goto RT;
        }
        $iP = $pq[$it] + 2 * $Da[$Pf] * $Da[$zh] + $ae;
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $pq[$it] = (int) ($iP - MATH_BIGINTEGER_BASE_FULL * $ae);
        RY:
        ++$Pf;
        ++$it;
        goto qA;
        RT:
        $pq[$zh + $nH + 1] = $ae;
        YP:
        ++$zh;
        goto mb;
        zS:
        return $pq;
    }
    function _karatsubaSquare($Da)
    {
        $fg = count($Da) >> 1;
        if (!($fg < MATH_BIGINTEGER_KARATSUBA_CUTOFF)) {
            goto PF;
        }
        return $this->_baseSquare($Da);
        PF:
        $fn = array_slice($Da, $fg);
        $Gq = array_slice($Da, 0, $fg);
        $BH = $this->_karatsubaSquare($fn);
        $Ny = $this->_karatsubaSquare($Gq);
        $bq = $this->_add($fn, false, $Gq, false);
        $bq = $this->_karatsubaSquare($bq[MATH_BIGINTEGER_VALUE]);
        $iP = $this->_add($BH, false, $Ny, false);
        $bq = $this->_subtract($bq, false, $iP[MATH_BIGINTEGER_VALUE], false);
        $BH = array_merge(array_fill(0, 2 * $fg, 0), $BH);
        $bq[MATH_BIGINTEGER_VALUE] = array_merge(array_fill(0, $fg, 0), $bq[MATH_BIGINTEGER_VALUE]);
        $DN = $this->_add($BH, false, $bq[MATH_BIGINTEGER_VALUE], $bq[MATH_BIGINTEGER_SIGN]);
        $DN = $this->_add($DN[MATH_BIGINTEGER_VALUE], $DN[MATH_BIGINTEGER_SIGN], $Ny, false);
        return $DN[MATH_BIGINTEGER_VALUE];
    }
    function divide($I3)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $pp = new Math_BigInteger();
                $xf = new Math_BigInteger();
                list($pp->value, $xf->value) = gmp_div_qr($this->value, $I3->value);
                if (!(gmp_sign($xf->value) < 0)) {
                    goto nl;
                }
                $xf->value = gmp_add($xf->value, gmp_abs($I3->value));
                nl:
                return array($this->_normalize($pp), $this->_normalize($xf));
            case MATH_BIGINTEGER_MODE_BCMATH:
                $pp = new Math_BigInteger();
                $xf = new Math_BigInteger();
                $pp->value = bcdiv($this->value, $I3->value, 0);
                $xf->value = bcmod($this->value, $I3->value);
                if (!($xf->value[0] == "\x2d")) {
                    goto jO;
                }
                $xf->value = bcadd($xf->value, $I3->value[0] == "\x2d" ? substr($I3->value, 1) : $I3->value, 0);
                jO:
                return array($this->_normalize($pp), $this->_normalize($xf));
        }
        f2:
        tO:
        if (!(count($I3->value) == 1)) {
            goto dx;
        }
        list($dG, $If) = $this->_divide_digit($this->value, $I3->value[0]);
        $pp = new Math_BigInteger();
        $xf = new Math_BigInteger();
        $pp->value = $dG;
        $xf->value = array($If);
        $pp->is_negative = $this->is_negative != $I3->is_negative;
        return array($this->_normalize($pp), $this->_normalize($xf));
        dx:
        static $dg;
        if (isset($dg)) {
            goto An;
        }
        $dg = new Math_BigInteger();
        An:
        $D9 = $this->copy();
        $I3 = $I3->copy();
        $VS = $D9->is_negative;
        $nB = $I3->is_negative;
        $D9->is_negative = $I3->is_negative = false;
        $Ud = $D9->compare($I3);
        if ($Ud) {
            goto FL;
        }
        $iP = new Math_BigInteger();
        $iP->value = array(1);
        $iP->is_negative = $VS != $nB;
        return array($this->_normalize($iP), $this->_normalize(new Math_BigInteger()));
        FL:
        if (!($Ud < 0)) {
            goto B6;
        }
        if (!$VS) {
            goto wS;
        }
        $D9 = $I3->subtract($D9);
        wS:
        return array($this->_normalize(new Math_BigInteger()), $this->_normalize($D9));
        B6:
        $x1 = $I3->value[count($I3->value) - 1];
        $Fk = 0;
        ha:
        if ($x1 & MATH_BIGINTEGER_MSB) {
            goto ok;
        }
        $x1 <<= 1;
        Dh:
        ++$Fk;
        goto ha;
        ok:
        $D9->_lshift($Fk);
        $I3->_lshift($Fk);
        $Ty =& $I3->value;
        $gO = count($D9->value) - 1;
        $qF = count($I3->value) - 1;
        $pp = new Math_BigInteger();
        $H7 =& $pp->value;
        $H7 = $this->_array_repeat(0, $gO - $qF + 1);
        static $iP, $il, $Jp;
        if (isset($iP)) {
            goto Tu;
        }
        $iP = new Math_BigInteger();
        $il = new Math_BigInteger();
        $Jp = new Math_BigInteger();
        Tu:
        $uA =& $iP->value;
        $JD =& $Jp->value;
        $uA = array_merge($this->_array_repeat(0, $gO - $qF), $Ty);
        I5:
        if (!($D9->compare($iP) >= 0)) {
            goto Ok;
        }
        ++$H7[$gO - $qF];
        $D9 = $D9->subtract($iP);
        $gO = count($D9->value) - 1;
        goto I5;
        Ok:
        $zh = $gO;
        LE:
        if (!($zh >= $qF + 1)) {
            goto Op;
        }
        $ow =& $D9->value;
        $A7 = array(isset($ow[$zh]) ? $ow[$zh] : 0, isset($ow[$zh - 1]) ? $ow[$zh - 1] : 0, isset($ow[$zh - 2]) ? $ow[$zh - 2] : 0);
        $Hz = array($Ty[$qF], $qF > 0 ? $Ty[$qF - 1] : 0);
        $u6 = $zh - $qF - 1;
        if ($A7[0] == $Hz[0]) {
            goto xd;
        }
        $H7[$u6] = $this->_safe_divide($A7[0] * MATH_BIGINTEGER_BASE_FULL + $A7[1], $Hz[0]);
        goto cm;
        xd:
        $H7[$u6] = MATH_BIGINTEGER_MAX_DIGIT;
        cm:
        $uA = array($Hz[1], $Hz[0]);
        $il->value = array($H7[$u6]);
        $il = $il->multiply($iP);
        $JD = array($A7[2], $A7[1], $A7[0]);
        jW:
        if (!($il->compare($Jp) > 0)) {
            goto rq;
        }
        --$H7[$u6];
        $il->value = array($H7[$u6]);
        $il = $il->multiply($iP);
        goto jW;
        rq:
        $iv = $this->_array_repeat(0, $u6);
        $uA = array($H7[$u6]);
        $iP = $iP->multiply($I3);
        $uA =& $iP->value;
        $uA = array_merge($iv, $uA);
        $D9 = $D9->subtract($iP);
        if (!($D9->compare($dg) < 0)) {
            goto GT;
        }
        $uA = array_merge($iv, $Ty);
        $D9 = $D9->add($iP);
        --$H7[$u6];
        GT:
        $gO = count($ow) - 1;
        Vz:
        --$zh;
        goto LE;
        Op:
        $D9->_rshift($Fk);
        $pp->is_negative = $VS != $nB;
        if (!$VS) {
            goto x_;
        }
        $I3->_rshift($Fk);
        $D9 = $I3->subtract($D9);
        x_:
        return array($this->_normalize($pp), $this->_normalize($D9));
    }
    function _divide_digit($jo, $qx)
    {
        $ae = 0;
        $xA = array();
        $zh = count($jo) - 1;
        hf:
        if (!($zh >= 0)) {
            goto H1;
        }
        $iP = MATH_BIGINTEGER_BASE_FULL * $ae + $jo[$zh];
        $xA[$zh] = $this->_safe_divide($iP, $qx);
        $ae = (int) ($iP - $qx * $xA[$zh]);
        RC:
        --$zh;
        goto hf;
        H1:
        return array($xA, $ae);
    }
    function modPow($hq, $LN)
    {
        $LN = $this->bitmask !== false && $this->bitmask->compare($LN) < 0 ? $this->bitmask : $LN->abs();
        if (!($hq->compare(new Math_BigInteger()) < 0)) {
            goto Tl;
        }
        $hq = $hq->abs();
        $iP = $this->modInverse($LN);
        if (!($iP === false)) {
            goto xg;
        }
        return false;
        xg:
        return $this->_normalize($iP->modPow($hq, $LN));
        Tl:
        if (!(MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_GMP)) {
            goto I7;
        }
        $iP = new Math_BigInteger();
        $iP->value = gmp_powm($this->value, $hq->value, $LN->value);
        return $this->_normalize($iP);
        I7:
        if (!($this->compare(new Math_BigInteger()) < 0 || $this->compare($LN) > 0)) {
            goto al;
        }
        list(, $iP) = $this->divide($LN);
        return $iP->modPow($hq, $LN);
        al:
        if (!defined("\x4d\101\124\x48\137\x42\111\x47\x49\116\x54\x45\x47\105\x52\x5f\x4f\x50\x45\116\123\x53\114\x5f\105\116\x41\x42\x4c\x45\104")) {
            goto uP;
        }
        $hz = array("\x6d\157\144\x75\x6c\165\x73" => $LN->toBytes(true), "\160\x75\x62\154\151\143\105\x78\160\157\156\x65\x6e\164" => $hq->toBytes(true));
        $hz = array("\155\x6f\144\x75\154\165\163" => pack("\103\x61\x2a\141\x2a", 2, $this->_encodeASN1Length(strlen($hz["\x6d\x6f\x64\165\154\x75\163"])), $hz["\155\x6f\x64\165\x6c\x75\x73"]), "\x70\165\142\154\151\143\x45\x78\160\x6f\x6e\145\x6e\164" => pack("\103\141\52\141\x2a", 2, $this->_encodeASN1Length(strlen($hz["\x70\x75\142\154\x69\x63\x45\x78\160\157\x6e\x65\x6e\x74"])), $hz["\x70\x75\142\x6c\151\x63\x45\170\160\x6f\156\x65\156\x74"]));
        $ON = pack("\103\141\52\x61\x2a\141\x2a", 48, $this->_encodeASN1Length(strlen($hz["\155\157\144\165\x6c\165\163"]) + strlen($hz["\x70\x75\x62\x6c\x69\x63\x45\x78\x70\x6f\156\x65\x6e\x74"])), $hz["\x6d\157\144\x75\x6c\165\x73"], $hz["\160\x75\142\154\151\143\105\x78\x70\x6f\156\145\x6e\x74"]);
        $bN = pack("\x48\x2a", "\63\x30\x30\144\60\x36\x30\x39\x32\x61\70\x36\64\x38\70\66\x66\x37\60\x64\x30\61\x30\61\60\61\60\65\x30\x30");
        $ON = chr(0) . $ON;
        $ON = chr(3) . $this->_encodeASN1Length(strlen($ON)) . $ON;
        $mf = pack("\x43\x61\x2a\x61\52", 48, $this->_encodeASN1Length(strlen($bN . $ON)), $bN . $ON);
        $ON = "\x2d\x2d\55\55\55\x42\x45\107\x49\x4e\x20\120\125\102\x4c\111\x43\40\x4b\x45\x59\x2d\55\55\55\55\xd\xa" . chunk_split(base64_encode($mf)) . "\55\55\x2d\x2d\x2d\x45\116\x44\40\120\x55\102\114\111\103\x20\113\105\x59\55\55\55\x2d\55";
        $VX = str_pad($this->toBytes(), strlen($LN->toBytes(true)) - 1, "\x0", STR_PAD_LEFT);
        if (!openssl_public_encrypt($VX, $xA, $ON, OPENSSL_NO_PADDING)) {
            goto IM;
        }
        return new Math_BigInteger($xA, 256);
        IM:
        uP:
        if (!(MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH)) {
            goto f7;
        }
        $iP = new Math_BigInteger();
        $iP->value = bcpowmod($this->value, $hq->value, $LN->value, 0);
        return $this->_normalize($iP);
        f7:
        if (!empty($hq->value)) {
            goto q1;
        }
        $iP = new Math_BigInteger();
        $iP->value = array(1);
        return $this->_normalize($iP);
        q1:
        if (!($hq->value == array(1))) {
            goto m0;
        }
        list(, $iP) = $this->divide($LN);
        return $this->_normalize($iP);
        m0:
        if (!($hq->value == array(2))) {
            goto Be;
        }
        $iP = new Math_BigInteger();
        $iP->value = $this->_square($this->value);
        list(, $iP) = $iP->divide($LN);
        return $this->_normalize($iP);
        Be:
        return $this->_normalize($this->_slidingWindow($hq, $LN, MATH_BIGINTEGER_BARRETT));
        if (!($LN->value[0] & 1)) {
            goto Lq;
        }
        return $this->_normalize($this->_slidingWindow($hq, $LN, MATH_BIGINTEGER_MONTGOMERY));
        Lq:
        $zh = 0;
        Kw:
        if (!($zh < count($LN->value))) {
            goto V9;
        }
        if (!$LN->value[$zh]) {
            goto Z2;
        }
        $iP = decbin($LN->value[$zh]);
        $Pf = strlen($iP) - strrpos($iP, "\61") - 1;
        $Pf += 26 * $zh;
        goto V9;
        Z2:
        o5:
        ++$zh;
        goto Kw;
        V9:
        $Zz = $LN->copy();
        $Zz->_rshift($Pf);
        $vu = new Math_BigInteger();
        $vu->value = array(1);
        $vu->_lshift($Pf);
        $qn = $Zz->value != array(1) ? $this->_slidingWindow($hq, $Zz, MATH_BIGINTEGER_MONTGOMERY) : new Math_BigInteger();
        $pf = $this->_slidingWindow($hq, $vu, MATH_BIGINTEGER_POWEROF2);
        $Dc = $vu->modInverse($Zz);
        $Q9 = $Zz->modInverse($vu);
        $xA = $qn->multiply($vu);
        $xA = $xA->multiply($Dc);
        $iP = $pf->multiply($Zz);
        $iP = $iP->multiply($Q9);
        $xA = $xA->add($iP);
        list(, $xA) = $xA->divide($LN);
        return $this->_normalize($xA);
    }
    function powMod($hq, $LN)
    {
        return $this->modPow($hq, $LN);
    }
    function _slidingWindow($hq, $LN, $A8)
    {
        static $qX = array(7, 25, 81, 241, 673, 1793);
        $KD = $hq->value;
        $r5 = count($KD) - 1;
        $sh = decbin($KD[$r5]);
        $zh = $r5 - 1;
        nG:
        if (!($zh >= 0)) {
            goto d9;
        }
        $sh .= str_pad(decbin($KD[$zh]), MATH_BIGINTEGER_BASE, "\60", STR_PAD_LEFT);
        k1:
        --$zh;
        goto nG;
        d9:
        $r5 = strlen($sh);
        $zh = 0;
        $Cq = 1;
        aI:
        if (!($zh < count($qX) && $r5 > $qX[$zh])) {
            goto Bg;
        }
        ES:
        ++$Cq;
        ++$zh;
        goto aI;
        Bg:
        $sY = $LN->value;
        $NU = array();
        $NU[1] = $this->_prepareReduce($this->value, $sY, $A8);
        $NU[2] = $this->_squareReduce($NU[1], $sY, $A8);
        $iP = 1 << $Cq - 1;
        $zh = 1;
        hH:
        if (!($zh < $iP)) {
            goto nq;
        }
        $sn = $zh << 1;
        $NU[$sn + 1] = $this->_multiplyReduce($NU[$sn - 1], $NU[2], $sY, $A8);
        PG:
        ++$zh;
        goto hH;
        nq:
        $xA = array(1);
        $xA = $this->_prepareReduce($xA, $sY, $A8);
        $zh = 0;
        L09:
        if (!($zh < $r5)) {
            goto ew;
        }
        if (!$sh[$zh]) {
            goto Ikn;
        }
        $Pf = $Cq - 1;
        EkS:
        if (!($Pf > 0)) {
            goto hqI;
        }
        if (empty($sh[$zh + $Pf])) {
            goto MEq;
        }
        goto hqI;
        MEq:
        LMY:
        --$Pf;
        goto EkS;
        hqI:
        $it = 0;
        Fxh:
        if (!($it <= $Pf)) {
            goto I3T;
        }
        $xA = $this->_squareReduce($xA, $sY, $A8);
        orI:
        ++$it;
        goto Fxh;
        I3T:
        $xA = $this->_multiplyReduce($xA, $NU[bindec(substr($sh, $zh, $Pf + 1))], $sY, $A8);
        $zh += $Pf + 1;
        goto dI5;
        Ikn:
        $xA = $this->_squareReduce($xA, $sY, $A8);
        ++$zh;
        dI5:
        pFY:
        goto L09;
        ew:
        $iP = new Math_BigInteger();
        $iP->value = $this->_reduce($xA, $sY, $A8);
        return $iP;
    }
    function _reduce($D9, $LN, $A8)
    {
        switch ($A8) {
            case MATH_BIGINTEGER_MONTGOMERY:
                return $this->_montgomery($D9, $LN);
            case MATH_BIGINTEGER_BARRETT:
                return $this->_barrett($D9, $LN);
            case MATH_BIGINTEGER_POWEROF2:
                $il = new Math_BigInteger();
                $il->value = $D9;
                $Jp = new Math_BigInteger();
                $Jp->value = $LN;
                return $D9->_mod2($LN);
            case MATH_BIGINTEGER_CLASSIC:
                $il = new Math_BigInteger();
                $il->value = $D9;
                $Jp = new Math_BigInteger();
                $Jp->value = $LN;
                list(, $iP) = $il->divide($Jp);
                return $iP->value;
            case MATH_BIGINTEGER_NONE:
                return $D9;
            default:
        }
        CzM:
        CfK:
    }
    function _prepareReduce($D9, $LN, $A8)
    {
        if (!($A8 == MATH_BIGINTEGER_MONTGOMERY)) {
            goto LZl;
        }
        return $this->_prepMontgomery($D9, $LN);
        LZl:
        return $this->_reduce($D9, $LN, $A8);
    }
    function _multiplyReduce($D9, $I3, $LN, $A8)
    {
        if (!($A8 == MATH_BIGINTEGER_MONTGOMERY)) {
            goto IvW;
        }
        return $this->_montgomeryMultiply($D9, $I3, $LN);
        IvW:
        $iP = $this->_multiply($D9, false, $I3, false);
        return $this->_reduce($iP[MATH_BIGINTEGER_VALUE], $LN, $A8);
    }
    function _squareReduce($D9, $LN, $A8)
    {
        if (!($A8 == MATH_BIGINTEGER_MONTGOMERY)) {
            goto Dct;
        }
        return $this->_montgomeryMultiply($D9, $D9, $LN);
        Dct:
        return $this->_reduce($this->_square($D9), $LN, $A8);
    }
    function _mod2($LN)
    {
        $iP = new Math_BigInteger();
        $iP->value = array(1);
        return $this->bitwise_and($LN->subtract($iP));
    }
    function _barrett($LN, $fg)
    {
        static $aV = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        $w8 = count($fg);
        if (!(count($LN) > 2 * $w8)) {
            goto Vhx;
        }
        $il = new Math_BigInteger();
        $Jp = new Math_BigInteger();
        $il->value = $LN;
        $Jp->value = $fg;
        list(, $iP) = $il->divide($Jp);
        return $iP->value;
        Vhx:
        if (!($w8 < 5)) {
            goto k51;
        }
        return $this->_regularBarrett($LN, $fg);
        k51:
        if (($ZZ = array_search($fg, $aV[MATH_BIGINTEGER_VARIABLE])) === false) {
            goto vqO;
        }
        extract($aV[MATH_BIGINTEGER_DATA][$ZZ]);
        goto oO3;
        vqO:
        $ZZ = count($aV[MATH_BIGINTEGER_VARIABLE]);
        $aV[MATH_BIGINTEGER_VARIABLE][] = $fg;
        $il = new Math_BigInteger();
        $X_ =& $il->value;
        $X_ = $this->_array_repeat(0, $w8 + ($w8 >> 1));
        $X_[] = 1;
        $Jp = new Math_BigInteger();
        $Jp->value = $fg;
        list($EN, $PW) = $il->divide($Jp);
        $EN = $EN->value;
        $PW = $PW->value;
        $aV[MATH_BIGINTEGER_DATA][] = array("\x75" => $EN, "\x6d\61" => $PW);
        oO3:
        $pc = $w8 + ($w8 >> 1);
        $QD = array_slice($LN, 0, $pc);
        $Mu = array_slice($LN, $pc);
        $QD = $this->_trim($QD);
        $iP = $this->_multiply($Mu, false, $PW, false);
        $LN = $this->_add($QD, false, $iP[MATH_BIGINTEGER_VALUE], false);
        if (!($w8 & 1)) {
            goto BdY;
        }
        return $this->_regularBarrett($LN[MATH_BIGINTEGER_VALUE], $fg);
        BdY:
        $iP = array_slice($LN[MATH_BIGINTEGER_VALUE], $w8 - 1);
        $iP = $this->_multiply($iP, false, $EN, false);
        $iP = array_slice($iP[MATH_BIGINTEGER_VALUE], ($w8 >> 1) + 1);
        $iP = $this->_multiply($iP, false, $fg, false);
        $xA = $this->_subtract($LN[MATH_BIGINTEGER_VALUE], false, $iP[MATH_BIGINTEGER_VALUE], false);
        cAa:
        if (!($this->_compare($xA[MATH_BIGINTEGER_VALUE], $xA[MATH_BIGINTEGER_SIGN], $fg, false) >= 0)) {
            goto qEG;
        }
        $xA = $this->_subtract($xA[MATH_BIGINTEGER_VALUE], $xA[MATH_BIGINTEGER_SIGN], $fg, false);
        goto cAa;
        qEG:
        return $xA[MATH_BIGINTEGER_VALUE];
    }
    function _regularBarrett($D9, $LN)
    {
        static $aV = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        $KX = count($LN);
        if (!(count($D9) > 2 * $KX)) {
            goto E4b;
        }
        $il = new Math_BigInteger();
        $Jp = new Math_BigInteger();
        $il->value = $D9;
        $Jp->value = $LN;
        list(, $iP) = $il->divide($Jp);
        return $iP->value;
        E4b:
        if (!(($ZZ = array_search($LN, $aV[MATH_BIGINTEGER_VARIABLE])) === false)) {
            goto FM4;
        }
        $ZZ = count($aV[MATH_BIGINTEGER_VARIABLE]);
        $aV[MATH_BIGINTEGER_VARIABLE][] = $LN;
        $il = new Math_BigInteger();
        $X_ =& $il->value;
        $X_ = $this->_array_repeat(0, 2 * $KX);
        $X_[] = 1;
        $Jp = new Math_BigInteger();
        $Jp->value = $LN;
        list($iP, ) = $il->divide($Jp);
        $aV[MATH_BIGINTEGER_DATA][] = $iP->value;
        FM4:
        $iP = array_slice($D9, $KX - 1);
        $iP = $this->_multiply($iP, false, $aV[MATH_BIGINTEGER_DATA][$ZZ], false);
        $iP = array_slice($iP[MATH_BIGINTEGER_VALUE], $KX + 1);
        $xA = array_slice($D9, 0, $KX + 1);
        $iP = $this->_multiplyLower($iP, false, $LN, false, $KX + 1);
        if (!($this->_compare($xA, false, $iP[MATH_BIGINTEGER_VALUE], $iP[MATH_BIGINTEGER_SIGN]) < 0)) {
            goto CdM;
        }
        $AW = $this->_array_repeat(0, $KX + 1);
        $AW[count($AW)] = 1;
        $xA = $this->_add($xA, false, $AW, false);
        $xA = $xA[MATH_BIGINTEGER_VALUE];
        CdM:
        $xA = $this->_subtract($xA, false, $iP[MATH_BIGINTEGER_VALUE], $iP[MATH_BIGINTEGER_SIGN]);
        MeI:
        if (!($this->_compare($xA[MATH_BIGINTEGER_VALUE], $xA[MATH_BIGINTEGER_SIGN], $LN, false) > 0)) {
            goto GtJ;
        }
        $xA = $this->_subtract($xA[MATH_BIGINTEGER_VALUE], $xA[MATH_BIGINTEGER_SIGN], $LN, false);
        goto MeI;
        GtJ:
        return $xA[MATH_BIGINTEGER_VALUE];
    }
    function _multiplyLower($ow, $pD, $Ty, $PE, $pk)
    {
        $vB = count($ow);
        $sQ = count($Ty);
        if (!(!$vB || !$sQ)) {
            goto m5s;
        }
        return array(MATH_BIGINTEGER_VALUE => array(), MATH_BIGINTEGER_SIGN => false);
        m5s:
        if (!($vB < $sQ)) {
            goto T5J;
        }
        $iP = $ow;
        $ow = $Ty;
        $Ty = $iP;
        $vB = count($ow);
        $sQ = count($Ty);
        T5J:
        $l6 = $this->_array_repeat(0, $vB + $sQ);
        $ae = 0;
        $Pf = 0;
        o1X:
        if (!($Pf < $vB)) {
            goto x5b;
        }
        $iP = $ow[$Pf] * $Ty[0] + $ae;
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $l6[$Pf] = (int) ($iP - MATH_BIGINTEGER_BASE_FULL * $ae);
        frL:
        ++$Pf;
        goto o1X;
        x5b:
        if (!($Pf < $pk)) {
            goto gxK;
        }
        $l6[$Pf] = $ae;
        gxK:
        $zh = 1;
        cDz:
        if (!($zh < $sQ)) {
            goto wCJ;
        }
        $ae = 0;
        $Pf = 0;
        $it = $zh;
        mu1:
        if (!($Pf < $vB && $it < $pk)) {
            goto oKc;
        }
        $iP = $l6[$it] + $ow[$Pf] * $Ty[$zh] + $ae;
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $l6[$it] = (int) ($iP - MATH_BIGINTEGER_BASE_FULL * $ae);
        gW4:
        ++$Pf;
        ++$it;
        goto mu1;
        oKc:
        if (!($it < $pk)) {
            goto omK;
        }
        $l6[$it] = $ae;
        omK:
        fZY:
        ++$zh;
        goto cDz;
        wCJ:
        return array(MATH_BIGINTEGER_VALUE => $this->_trim($l6), MATH_BIGINTEGER_SIGN => $pD != $PE);
    }
    function _montgomery($D9, $LN)
    {
        static $aV = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        if (!(($ZZ = array_search($LN, $aV[MATH_BIGINTEGER_VARIABLE])) === false)) {
            goto aeC;
        }
        $ZZ = count($aV[MATH_BIGINTEGER_VARIABLE]);
        $aV[MATH_BIGINTEGER_VARIABLE][] = $D9;
        $aV[MATH_BIGINTEGER_DATA][] = $this->_modInverse67108864($LN);
        aeC:
        $it = count($LN);
        $xA = array(MATH_BIGINTEGER_VALUE => $D9);
        $zh = 0;
        o0u:
        if (!($zh < $it)) {
            goto n7K;
        }
        $iP = $xA[MATH_BIGINTEGER_VALUE][$zh] * $aV[MATH_BIGINTEGER_DATA][$ZZ];
        $iP = $iP - MATH_BIGINTEGER_BASE_FULL * (MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31);
        $iP = $this->_regularMultiply(array($iP), $LN);
        $iP = array_merge($this->_array_repeat(0, $zh), $iP);
        $xA = $this->_add($xA[MATH_BIGINTEGER_VALUE], false, $iP, false);
        Ppm:
        ++$zh;
        goto o0u;
        n7K:
        $xA[MATH_BIGINTEGER_VALUE] = array_slice($xA[MATH_BIGINTEGER_VALUE], $it);
        if (!($this->_compare($xA, false, $LN, false) >= 0)) {
            goto dmR;
        }
        $xA = $this->_subtract($xA[MATH_BIGINTEGER_VALUE], false, $LN, false);
        dmR:
        return $xA[MATH_BIGINTEGER_VALUE];
    }
    function _montgomeryMultiply($D9, $I3, $fg)
    {
        $iP = $this->_multiply($D9, false, $I3, false);
        return $this->_montgomery($iP[MATH_BIGINTEGER_VALUE], $fg);
        static $aV = array(MATH_BIGINTEGER_VARIABLE => array(), MATH_BIGINTEGER_DATA => array());
        if (!(($ZZ = array_search($fg, $aV[MATH_BIGINTEGER_VARIABLE])) === false)) {
            goto bI3;
        }
        $ZZ = count($aV[MATH_BIGINTEGER_VARIABLE]);
        $aV[MATH_BIGINTEGER_VARIABLE][] = $fg;
        $aV[MATH_BIGINTEGER_DATA][] = $this->_modInverse67108864($fg);
        bI3:
        $LN = max(count($D9), count($I3), count($fg));
        $D9 = array_pad($D9, $LN, 0);
        $I3 = array_pad($I3, $LN, 0);
        $fg = array_pad($fg, $LN, 0);
        $ML = array(MATH_BIGINTEGER_VALUE => $this->_array_repeat(0, $LN + 1));
        $zh = 0;
        BCB:
        if (!($zh < $LN)) {
            goto lw1;
        }
        $iP = $ML[MATH_BIGINTEGER_VALUE][0] + $D9[$zh] * $I3[0];
        $iP = $iP - MATH_BIGINTEGER_BASE_FULL * (MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31);
        $iP = $iP * $aV[MATH_BIGINTEGER_DATA][$ZZ];
        $iP = $iP - MATH_BIGINTEGER_BASE_FULL * (MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31);
        $iP = $this->_add($this->_regularMultiply(array($D9[$zh]), $I3), false, $this->_regularMultiply(array($iP), $fg), false);
        $ML = $this->_add($ML[MATH_BIGINTEGER_VALUE], false, $iP[MATH_BIGINTEGER_VALUE], false);
        $ML[MATH_BIGINTEGER_VALUE] = array_slice($ML[MATH_BIGINTEGER_VALUE], 1);
        OrP:
        ++$zh;
        goto BCB;
        lw1:
        if (!($this->_compare($ML[MATH_BIGINTEGER_VALUE], false, $fg, false) >= 0)) {
            goto J27;
        }
        $ML = $this->_subtract($ML[MATH_BIGINTEGER_VALUE], false, $fg, false);
        J27:
        return $ML[MATH_BIGINTEGER_VALUE];
    }
    function _prepMontgomery($D9, $LN)
    {
        $il = new Math_BigInteger();
        $il->value = array_merge($this->_array_repeat(0, count($LN)), $D9);
        $Jp = new Math_BigInteger();
        $Jp->value = $LN;
        list(, $iP) = $il->divide($Jp);
        return $iP->value;
    }
    function _modInverse67108864($D9)
    {
        $D9 = -$D9[0];
        $xA = $D9 & 3;
        $xA = $xA * (2 - $D9 * $xA) & 15;
        $xA = $xA * (2 - ($D9 & 255) * $xA) & 255;
        $xA = $xA * (2 - ($D9 & 65535) * $xA & 65535) & 65535;
        $xA = fmod($xA * (2 - fmod($D9 * $xA, MATH_BIGINTEGER_BASE_FULL)), MATH_BIGINTEGER_BASE_FULL);
        return $xA & MATH_BIGINTEGER_MAX_DIGIT;
    }
    function modInverse($LN)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_invert($this->value, $LN->value);
                return $iP->value === false ? false : $this->_normalize($iP);
        }
        m1X:
        YCu:
        static $dg, $M6;
        if (isset($dg)) {
            goto bsF;
        }
        $dg = new Math_BigInteger();
        $M6 = new Math_BigInteger(1);
        bsF:
        $LN = $LN->abs();
        if (!($this->compare($dg) < 0)) {
            goto gae;
        }
        $iP = $this->abs();
        $iP = $iP->modInverse($LN);
        return $this->_normalize($LN->subtract($iP));
        gae:
        extract($this->extendedGCD($LN));
        if ($qb->equals($M6)) {
            goto LTM;
        }
        return false;
        LTM:
        $D9 = $D9->compare($dg) < 0 ? $D9->add($LN) : $D9;
        return $this->compare($dg) < 0 ? $this->_normalize($LN->subtract($D9)) : $this->_normalize($D9);
    }
    function extendedGCD($LN)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                extract(gmp_gcdext($this->value, $LN->value));
                return array("\x67\x63\144" => $this->_normalize(new Math_BigInteger($Ws)), "\170" => $this->_normalize(new Math_BigInteger($kb)), "\171" => $this->_normalize(new Math_BigInteger($hV)));
            case MATH_BIGINTEGER_MODE_BCMATH:
                $EN = $this->value;
                $Qe = $LN->value;
                $ML = "\61";
                $Wj = "\60";
                $mp = "\x30";
                $Xy = "\x31";
                gf1:
                if (!(bccomp($Qe, "\x30", 0) != 0)) {
                    goto mYJ;
                }
                $dG = bcdiv($EN, $Qe, 0);
                $iP = $EN;
                $EN = $Qe;
                $Qe = bcsub($iP, bcmul($Qe, $dG, 0), 0);
                $iP = $ML;
                $ML = $mp;
                $mp = bcsub($iP, bcmul($ML, $dG, 0), 0);
                $iP = $Wj;
                $Wj = $Xy;
                $Xy = bcsub($iP, bcmul($Wj, $dG, 0), 0);
                goto gf1;
                mYJ:
                return array("\147\x63\144" => $this->_normalize(new Math_BigInteger($EN)), "\x78" => $this->_normalize(new Math_BigInteger($ML)), "\171" => $this->_normalize(new Math_BigInteger($Wj)));
        }
        ADz:
        S9M:
        $I3 = $LN->copy();
        $D9 = $this->copy();
        $Ws = new Math_BigInteger();
        $Ws->value = array(1);
        wBf:
        if ($D9->value[0] & 1 || $I3->value[0] & 1) {
            goto fX1;
        }
        $D9->_rshift(1);
        $I3->_rshift(1);
        $Ws->_lshift(1);
        goto wBf;
        fX1:
        $EN = $D9->copy();
        $Qe = $I3->copy();
        $ML = new Math_BigInteger();
        $Wj = new Math_BigInteger();
        $mp = new Math_BigInteger();
        $Xy = new Math_BigInteger();
        $ML->value = $Xy->value = $Ws->value = array(1);
        $Wj->value = $mp->value = array();
        kro:
        if (empty($EN->value)) {
            goto mYZ;
        }
        sAB:
        if ($EN->value[0] & 1) {
            goto ZJd;
        }
        $EN->_rshift(1);
        if (!(!empty($ML->value) && $ML->value[0] & 1 || !empty($Wj->value) && $Wj->value[0] & 1)) {
            goto cpW;
        }
        $ML = $ML->add($I3);
        $Wj = $Wj->subtract($D9);
        cpW:
        $ML->_rshift(1);
        $Wj->_rshift(1);
        goto sAB;
        ZJd:
        clR:
        if ($Qe->value[0] & 1) {
            goto SJE;
        }
        $Qe->_rshift(1);
        if (!(!empty($Xy->value) && $Xy->value[0] & 1 || !empty($mp->value) && $mp->value[0] & 1)) {
            goto HE7;
        }
        $mp = $mp->add($I3);
        $Xy = $Xy->subtract($D9);
        HE7:
        $mp->_rshift(1);
        $Xy->_rshift(1);
        goto clR;
        SJE:
        if ($EN->compare($Qe) >= 0) {
            goto mNu;
        }
        $Qe = $Qe->subtract($EN);
        $mp = $mp->subtract($ML);
        $Xy = $Xy->subtract($Wj);
        goto BhM;
        mNu:
        $EN = $EN->subtract($Qe);
        $ML = $ML->subtract($mp);
        $Wj = $Wj->subtract($Xy);
        BhM:
        goto kro;
        mYZ:
        return array("\147\x63\144" => $this->_normalize($Ws->multiply($Qe)), "\x78" => $this->_normalize($mp), "\171" => $this->_normalize($Xy));
    }
    function gcd($LN)
    {
        extract($this->extendedGCD($LN));
        return $qb;
    }
    function abs()
    {
        $iP = new Math_BigInteger();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP->value = gmp_abs($this->value);
                goto ydu;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $iP->value = bccomp($this->value, "\60", 0) < 0 ? substr($this->value, 1) : $this->value;
                goto ydu;
            default:
                $iP->value = $this->value;
        }
        Kn5:
        ydu:
        return $iP;
    }
    function compare($I3)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_cmp($this->value, $I3->value);
            case MATH_BIGINTEGER_MODE_BCMATH:
                return bccomp($this->value, $I3->value, 0);
        }
        h1I:
        BxS:
        return $this->_compare($this->value, $this->is_negative, $I3->value, $I3->is_negative);
    }
    function _compare($ow, $pD, $Ty, $PE)
    {
        if (!($pD != $PE)) {
            goto y8L;
        }
        return !$pD && $PE ? 1 : -1;
        y8L:
        $xA = $pD ? -1 : 1;
        if (!(count($ow) != count($Ty))) {
            goto SYO;
        }
        return count($ow) > count($Ty) ? $xA : -$xA;
        SYO:
        $wF = max(count($ow), count($Ty));
        $ow = array_pad($ow, $wF, 0);
        $Ty = array_pad($Ty, $wF, 0);
        $zh = count($ow) - 1;
        qSE:
        if (!($zh >= 0)) {
            goto VHk;
        }
        if (!($ow[$zh] != $Ty[$zh])) {
            goto ulz;
        }
        return $ow[$zh] > $Ty[$zh] ? $xA : -$xA;
        ulz:
        gR6:
        --$zh;
        goto qSE;
        VHk:
        return 0;
    }
    function equals($D9)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_cmp($this->value, $D9->value) == 0;
            default:
                return $this->value === $D9->value && $this->is_negative == $D9->is_negative;
        }
        jue:
        NHk:
    }
    function setPrecision($UH)
    {
        $this->precision = $UH;
        if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_BCMATH) {
            goto g85;
        }
        $this->bitmask = new Math_BigInteger(bcpow("\x32", $UH, 0));
        goto Qxk;
        g85:
        $this->bitmask = new Math_BigInteger(chr((1 << ($UH & 7)) - 1) . str_repeat(chr(255), $UH >> 3), 256);
        Qxk:
        $iP = $this->_normalize($this);
        $this->value = $iP->value;
    }
    function bitwise_and($D9)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_and($this->value, $D9->value);
                return $this->_normalize($iP);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $ZJ = $this->toBytes();
                $PK = $D9->toBytes();
                $bw = max(strlen($ZJ), strlen($PK));
                $ZJ = str_pad($ZJ, $bw, chr(0), STR_PAD_LEFT);
                $PK = str_pad($PK, $bw, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new Math_BigInteger($ZJ & $PK, 256));
        }
        KlH:
        Ybl:
        $xA = $this->copy();
        $bw = min(count($D9->value), count($this->value));
        $xA->value = array_slice($xA->value, 0, $bw);
        $zh = 0;
        yp1:
        if (!($zh < $bw)) {
            goto Mg2;
        }
        $xA->value[$zh] &= $D9->value[$zh];
        C4a:
        ++$zh;
        goto yp1;
        Mg2:
        return $this->_normalize($xA);
    }
    function bitwise_or($D9)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_or($this->value, $D9->value);
                return $this->_normalize($iP);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $ZJ = $this->toBytes();
                $PK = $D9->toBytes();
                $bw = max(strlen($ZJ), strlen($PK));
                $ZJ = str_pad($ZJ, $bw, chr(0), STR_PAD_LEFT);
                $PK = str_pad($PK, $bw, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new Math_BigInteger($ZJ | $PK, 256));
        }
        xrJ:
        FCM:
        $bw = max(count($this->value), count($D9->value));
        $xA = $this->copy();
        $xA->value = array_pad($xA->value, $bw, 0);
        $D9->value = array_pad($D9->value, $bw, 0);
        $zh = 0;
        X_t:
        if (!($zh < $bw)) {
            goto LBz;
        }
        $xA->value[$zh] |= $D9->value[$zh];
        ykY:
        ++$zh;
        goto X_t;
        LBz:
        return $this->_normalize($xA);
    }
    function bitwise_xor($D9)
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $iP = new Math_BigInteger();
                $iP->value = gmp_xor(gmp_abs($this->value), gmp_abs($D9->value));
                return $this->_normalize($iP);
            case MATH_BIGINTEGER_MODE_BCMATH:
                $ZJ = $this->toBytes();
                $PK = $D9->toBytes();
                $bw = max(strlen($ZJ), strlen($PK));
                $ZJ = str_pad($ZJ, $bw, chr(0), STR_PAD_LEFT);
                $PK = str_pad($PK, $bw, chr(0), STR_PAD_LEFT);
                return $this->_normalize(new Math_BigInteger($ZJ ^ $PK, 256));
        }
        wGb:
        sI0:
        $bw = max(count($this->value), count($D9->value));
        $xA = $this->copy();
        $xA->is_negative = false;
        $xA->value = array_pad($xA->value, $bw, 0);
        $D9->value = array_pad($D9->value, $bw, 0);
        $zh = 0;
        mmw:
        if (!($zh < $bw)) {
            goto UB6;
        }
        $xA->value[$zh] ^= $D9->value[$zh];
        czp:
        ++$zh;
        goto mmw;
        UB6:
        return $this->_normalize($xA);
    }
    function bitwise_not()
    {
        $iP = $this->toBytes();
        if (!($iP == '')) {
            goto FrL;
        }
        return $this->_normalize(new Math_BigInteger());
        FrL:
        $rh = decbin(ord($iP[0]));
        $iP = ~$iP;
        $x1 = decbin(ord($iP[0]));
        if (!(strlen($x1) == 8)) {
            goto YAN;
        }
        $x1 = substr($x1, strpos($x1, "\x30"));
        YAN:
        $iP[0] = chr(bindec($x1));
        $a3 = strlen($rh) + 8 * strlen($iP) - 8;
        $bb = $this->precision - $a3;
        if (!($bb <= 0)) {
            goto qU9;
        }
        return $this->_normalize(new Math_BigInteger($iP, 256));
        qU9:
        $ax = chr((1 << ($bb & 7)) - 1) . str_repeat(chr(255), $bb >> 3);
        $this->_base256_lshift($ax, $a3);
        $iP = str_pad($iP, strlen($ax), chr(0), STR_PAD_LEFT);
        return $this->_normalize(new Math_BigInteger($ax | $iP, 256));
    }
    function bitwise_rightShift($Fk)
    {
        $iP = new Math_BigInteger();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                static $Ne;
                if (isset($Ne)) {
                    goto PDh;
                }
                $Ne = gmp_init("\62");
                PDh:
                $iP->value = gmp_div_q($this->value, gmp_pow($Ne, $Fk));
                goto AZ1;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $iP->value = bcdiv($this->value, bcpow("\x32", $Fk, 0), 0);
                goto AZ1;
            default:
                $iP->value = $this->value;
                $iP->_rshift($Fk);
        }
        o0M:
        AZ1:
        return $this->_normalize($iP);
    }
    function bitwise_leftShift($Fk)
    {
        $iP = new Math_BigInteger();
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                static $Ne;
                if (isset($Ne)) {
                    goto tD_;
                }
                $Ne = gmp_init("\x32");
                tD_:
                $iP->value = gmp_mul($this->value, gmp_pow($Ne, $Fk));
                goto z3y;
            case MATH_BIGINTEGER_MODE_BCMATH:
                $iP->value = bcmul($this->value, bcpow("\62", $Fk, 0), 0);
                goto z3y;
            default:
                $iP->value = $this->value;
                $iP->_lshift($Fk);
        }
        ztP:
        z3y:
        return $this->_normalize($iP);
    }
    function bitwise_leftRotate($Fk)
    {
        $UH = $this->toBytes();
        if ($this->precision > 0) {
            goto XOP;
        }
        $iP = ord($UH[0]);
        $zh = 0;
        GNy:
        if (!($iP >> $zh)) {
            goto riD;
        }
        EVh:
        ++$zh;
        goto GNy;
        riD:
        $UA = 8 * strlen($UH) - 8 + $zh;
        $mw = chr((1 << ($UA & 7)) - 1) . str_repeat(chr(255), $UA >> 3);
        goto xWc;
        XOP:
        $UA = $this->precision;
        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
            goto BT6;
        }
        $mw = $this->bitmask->toBytes();
        goto ddc;
        BT6:
        $mw = $this->bitmask->subtract(new Math_BigInteger(1));
        $mw = $mw->toBytes();
        ddc:
        xWc:
        if (!($Fk < 0)) {
            goto eVY;
        }
        $Fk += $UA;
        eVY:
        $Fk %= $UA;
        if ($Fk) {
            goto KR_;
        }
        return $this->copy();
        KR_:
        $ZJ = $this->bitwise_leftShift($Fk);
        $ZJ = $ZJ->bitwise_and(new Math_BigInteger($mw, 256));
        $PK = $this->bitwise_rightShift($UA - $Fk);
        $xA = MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_BCMATH ? $ZJ->bitwise_or($PK) : $ZJ->add($PK);
        return $this->_normalize($xA);
    }
    function bitwise_rightRotate($Fk)
    {
        return $this->bitwise_leftRotate(-$Fk);
    }
    function setRandomGenerator($bO)
    {
    }
    function _random_number_helper($wF)
    {
        if (function_exists("\x63\162\171\160\x74\x5f\162\x61\x6e\x64\157\155\x5f\x73\x74\162\151\156\x67")) {
            goto exd;
        }
        $Dx = '';
        if (!($wF & 1)) {
            goto v0Z;
        }
        $Dx .= chr(mt_rand(0, 255));
        v0Z:
        $HP = $wF >> 1;
        $zh = 0;
        QQM:
        if (!($zh < $HP)) {
            goto PtZ;
        }
        $Dx .= pack("\156", mt_rand(0, 65535));
        GTn:
        ++$zh;
        goto QQM;
        PtZ:
        goto t_8;
        exd:
        $Dx = crypt_random_string($wF);
        t_8:
        return new Math_BigInteger($Dx, 256);
    }
    function random($nI, $ix = false)
    {
        if (!($nI === false)) {
            goto it3;
        }
        return false;
        it3:
        if ($ix === false) {
            goto OpP;
        }
        $Ni = $nI;
        $z9 = $ix;
        goto Hlw;
        OpP:
        $z9 = $nI;
        $Ni = $this;
        Hlw:
        $p3 = $z9->compare($Ni);
        if (!$p3) {
            goto oBW;
        }
        if ($p3 < 0) {
            goto ZcV;
        }
        goto p49;
        oBW:
        return $this->_normalize($Ni);
        goto p49;
        ZcV:
        $iP = $z9;
        $z9 = $Ni;
        $Ni = $iP;
        p49:
        static $M6;
        if (isset($M6)) {
            goto K9d;
        }
        $M6 = new Math_BigInteger(1);
        K9d:
        $z9 = $z9->subtract($Ni->subtract($M6));
        $wF = strlen(ltrim($z9->toBytes(), chr(0)));
        $Pj = new Math_BigInteger(chr(1) . str_repeat("\x0", $wF), 256);
        $Dx = $this->_random_number_helper($wF);
        list($zP) = $Pj->divide($z9);
        $zP = $zP->multiply($z9);
        aFQ:
        if (!($Dx->compare($zP) >= 0)) {
            goto NFl;
        }
        $Dx = $Dx->subtract($zP);
        $Pj = $Pj->subtract($zP);
        $Dx = $Dx->bitwise_leftShift(8);
        $Dx = $Dx->add($this->_random_number_helper(1));
        $Pj = $Pj->bitwise_leftShift(8);
        list($zP) = $Pj->divide($z9);
        $zP = $zP->multiply($z9);
        goto aFQ;
        NFl:
        list(, $Dx) = $Dx->divide($z9);
        return $this->_normalize($Dx->add($Ni));
    }
    function randomPrime($nI, $ix = false, $Rh = false)
    {
        if (!($nI === false)) {
            goto Qpv;
        }
        return false;
        Qpv:
        if ($ix === false) {
            goto H5M;
        }
        $Ni = $nI;
        $z9 = $ix;
        goto Dlx;
        H5M:
        $z9 = $nI;
        $Ni = $this;
        Dlx:
        $p3 = $z9->compare($Ni);
        if (!$p3) {
            goto wB4;
        }
        if ($p3 < 0) {
            goto FbM;
        }
        goto aBW;
        wB4:
        return $Ni->isPrime() ? $Ni : false;
        goto aBW;
        FbM:
        $iP = $z9;
        $z9 = $Ni;
        $Ni = $iP;
        aBW:
        static $M6, $Ne;
        if (isset($M6)) {
            goto myK;
        }
        $M6 = new Math_BigInteger(1);
        $Ne = new Math_BigInteger(2);
        myK:
        $KI = time();
        $D9 = $this->random($Ni, $z9);
        if (!(MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_GMP && extension_loaded("\x67\x6d\x70") && version_compare(PHP_VERSION, "\x35\56\x32\x2e\x30", "\76\75"))) {
            goto jWV;
        }
        $mK = new Math_BigInteger();
        $mK->value = gmp_nextprime($D9->value);
        if (!($mK->compare($z9) <= 0)) {
            goto ZLT;
        }
        return $mK;
        ZLT:
        if ($Ni->equals($D9)) {
            goto i5J;
        }
        $D9 = $D9->subtract($M6);
        i5J:
        return $D9->randomPrime($Ni, $D9);
        jWV:
        if (!$D9->equals($Ne)) {
            goto K2X;
        }
        return $D9;
        K2X:
        $D9->_make_odd();
        if (!($D9->compare($z9) > 0)) {
            goto R7u;
        }
        if (!$Ni->equals($z9)) {
            goto PsW;
        }
        return false;
        PsW:
        $D9 = $Ni->copy();
        $D9->_make_odd();
        R7u:
        $vp = $D9->copy();
        i3i:
        if (!true) {
            goto gKi;
        }
        if (!($Rh !== false && time() - $KI > $Rh)) {
            goto STC;
        }
        return false;
        STC:
        if (!$D9->isPrime()) {
            goto fyQ;
        }
        return $D9;
        fyQ:
        $D9 = $D9->add($Ne);
        if (!($D9->compare($z9) > 0)) {
            goto VjQ;
        }
        $D9 = $Ni->copy();
        if (!$D9->equals($Ne)) {
            goto jII;
        }
        return $D9;
        jII:
        $D9->_make_odd();
        VjQ:
        if (!$D9->equals($vp)) {
            goto lDe;
        }
        return false;
        lDe:
        goto i3i;
        gKi:
    }
    function _make_odd()
    {
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                gmp_setbit($this->value, 0);
                goto qOq;
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value[strlen($this->value) - 1] % 2 == 0)) {
                    goto GLL;
                }
                $this->value = bcadd($this->value, "\61");
                GLL:
                goto qOq;
            default:
                $this->value[0] |= 1;
        }
        OYj:
        qOq:
    }
    function isPrime($hV = false)
    {
        $bw = strlen($this->toBytes());
        if ($hV) {
            goto skF;
        }
        if ($bw >= 163) {
            goto F0J;
        }
        if ($bw >= 106) {
            goto G1d;
        }
        if ($bw >= 81) {
            goto RKA;
        }
        if ($bw >= 68) {
            goto IW7;
        }
        if ($bw >= 56) {
            goto Vrx;
        }
        if ($bw >= 50) {
            goto BSn;
        }
        if ($bw >= 43) {
            goto EX5;
        }
        if ($bw >= 37) {
            goto eMl;
        }
        if ($bw >= 31) {
            goto T0J;
        }
        if ($bw >= 25) {
            goto kLd;
        }
        if ($bw >= 18) {
            goto Dig;
        }
        $hV = 27;
        goto I6k;
        Dig:
        $hV = 18;
        I6k:
        goto f8L;
        kLd:
        $hV = 15;
        f8L:
        goto jCO;
        T0J:
        $hV = 12;
        jCO:
        goto dpq;
        eMl:
        $hV = 9;
        dpq:
        goto Ifw;
        EX5:
        $hV = 8;
        Ifw:
        goto WmU;
        BSn:
        $hV = 7;
        WmU:
        goto FDf;
        Vrx:
        $hV = 6;
        FDf:
        goto i9w;
        IW7:
        $hV = 5;
        i9w:
        goto v32;
        RKA:
        $hV = 4;
        v32:
        goto rm4;
        G1d:
        $hV = 3;
        rm4:
        goto Se5;
        F0J:
        $hV = 2;
        Se5:
        skF:
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                return gmp_prob_prime($this->value, $hV) != 0;
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (!($this->value === "\x32")) {
                    goto YC6;
                }
                return true;
                YC6:
                if (!($this->value[strlen($this->value) - 1] % 2 == 0)) {
                    goto mC0;
                }
                return false;
                mC0:
                goto mK1;
            default:
                if (!($this->value == array(2))) {
                    goto w9z;
                }
                return true;
                w9z:
                if (!(~$this->value[0] & 1)) {
                    goto ewt;
                }
                return false;
                ewt:
        }
        EK6:
        mK1:
        static $zN, $dg, $M6, $Ne;
        if (isset($zN)) {
            goto EKN;
        }
        $zN = array(3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499, 503, 509, 521, 523, 541, 547, 557, 563, 569, 571, 577, 587, 593, 599, 601, 607, 613, 617, 619, 631, 641, 643, 647, 653, 659, 661, 673, 677, 683, 691, 701, 709, 719, 727, 733, 739, 743, 751, 757, 761, 769, 773, 787, 797, 809, 811, 821, 823, 827, 829, 839, 853, 857, 859, 863, 877, 881, 883, 887, 907, 911, 919, 929, 937, 941, 947, 953, 967, 971, 977, 983, 991, 997);
        if (!(MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL)) {
            goto GG8;
        }
        $zh = 0;
        kSz:
        if (!($zh < count($zN))) {
            goto eo4;
        }
        $zN[$zh] = new Math_BigInteger($zN[$zh]);
        wCY:
        ++$zh;
        goto kSz;
        eo4:
        GG8:
        $dg = new Math_BigInteger();
        $M6 = new Math_BigInteger(1);
        $Ne = new Math_BigInteger(2);
        EKN:
        if (!$this->equals($M6)) {
            goto JCX;
        }
        return false;
        JCX:
        if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL) {
            goto OE0;
        }
        $Da = $this->value;
        foreach ($zN as $g1) {
            list(, $If) = $this->_divide_digit($Da, $g1);
            if ($If) {
                goto kCC;
            }
            return count($Da) == 1 && $Da[0] == $g1;
            kCC:
            yOV:
        }
        bhl:
        goto B9z;
        OE0:
        foreach ($zN as $g1) {
            list(, $If) = $this->divide($g1);
            if (!$If->equals($dg)) {
                goto m70;
            }
            return $this->equals($g1);
            m70:
            DzK:
        }
        wLD:
        B9z:
        $LN = $this->copy();
        $aW = $LN->subtract($M6);
        $Lm = $LN->subtract($Ne);
        $If = $aW->copy();
        $vz = $If->value;
        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
            goto rk0;
        }
        $zh = 0;
        $W1 = count($vz);
        Yzf:
        if (!($zh < $W1)) {
            goto bLY;
        }
        $iP = ~$vz[$zh] & 16777215;
        $Pf = 1;
        WuS:
        if (!($iP >> $Pf & 1)) {
            goto t2s;
        }
        vOB:
        ++$Pf;
        goto WuS;
        t2s:
        if (!($Pf != 25)) {
            goto Sy7;
        }
        goto bLY;
        Sy7:
        fOH:
        ++$zh;
        goto Yzf;
        bLY:
        $kb = 26 * $zh + $Pf;
        $If->_rshift($kb);
        goto zEI;
        rk0:
        $kb = 0;
        UVW:
        if (!($If->value[strlen($If->value) - 1] % 2 == 0)) {
            goto V9U;
        }
        $If->value = bcdiv($If->value, "\x32", 0);
        ++$kb;
        goto UVW;
        V9U:
        zEI:
        $zh = 0;
        OiJ:
        if (!($zh < $hV)) {
            goto WdJ;
        }
        $ML = $this->random($Ne, $Lm);
        $I3 = $ML->modPow($If, $LN);
        if (!(!$I3->equals($M6) && !$I3->equals($aW))) {
            goto MbX;
        }
        $Pf = 1;
        zRs:
        if (!($Pf < $kb && !$I3->equals($aW))) {
            goto OzS;
        }
        $I3 = $I3->modPow($Ne, $LN);
        if (!$I3->equals($M6)) {
            goto y81;
        }
        return false;
        y81:
        DYO:
        ++$Pf;
        goto zRs;
        OzS:
        if ($I3->equals($aW)) {
            goto QyL;
        }
        return false;
        QyL:
        MbX:
        FSv:
        ++$zh;
        goto OiJ;
        WdJ:
        return true;
    }
    function _lshift($Fk)
    {
        if (!($Fk == 0)) {
            goto EA7;
        }
        return;
        EA7:
        $sU = (int) ($Fk / MATH_BIGINTEGER_BASE);
        $Fk %= MATH_BIGINTEGER_BASE;
        $Fk = 1 << $Fk;
        $ae = 0;
        $zh = 0;
        Xvq:
        if (!($zh < count($this->value))) {
            goto ov2;
        }
        $iP = $this->value[$zh] * $Fk + $ae;
        $ae = MATH_BIGINTEGER_BASE === 26 ? intval($iP / 67108864) : $iP >> 31;
        $this->value[$zh] = (int) ($iP - $ae * MATH_BIGINTEGER_BASE_FULL);
        S6z:
        ++$zh;
        goto Xvq;
        ov2:
        if (!$ae) {
            goto qW9;
        }
        $this->value[count($this->value)] = $ae;
        qW9:
        CY7:
        if (!$sU--) {
            goto oLU;
        }
        array_unshift($this->value, 0);
        goto CY7;
        oLU:
    }
    function _rshift($Fk)
    {
        if (!($Fk == 0)) {
            goto ff4;
        }
        return;
        ff4:
        $sU = (int) ($Fk / MATH_BIGINTEGER_BASE);
        $Fk %= MATH_BIGINTEGER_BASE;
        $lU = MATH_BIGINTEGER_BASE - $Fk;
        $wr = (1 << $Fk) - 1;
        if (!$sU) {
            goto Cm2;
        }
        $this->value = array_slice($this->value, $sU);
        Cm2:
        $ae = 0;
        $zh = count($this->value) - 1;
        aMu:
        if (!($zh >= 0)) {
            goto GU0;
        }
        $iP = $this->value[$zh] >> $Fk | $ae;
        $ae = ($this->value[$zh] & $wr) << $lU;
        $this->value[$zh] = $iP;
        A55:
        --$zh;
        goto aMu;
        GU0:
        $this->value = $this->_trim($this->value);
    }
    function _normalize($xA)
    {
        $xA->precision = $this->precision;
        $xA->bitmask = $this->bitmask;
        switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                if (!($this->bitmask !== false)) {
                    goto dOt;
                }
                $xA->value = gmp_and($xA->value, $xA->bitmask->value);
                dOt:
                return $xA;
            case MATH_BIGINTEGER_MODE_BCMATH:
                if (empty($xA->bitmask->value)) {
                    goto iPM;
                }
                $xA->value = bcmod($xA->value, $xA->bitmask->value);
                iPM:
                return $xA;
        }
        t86:
        xlT:
        $Da =& $xA->value;
        if (count($Da)) {
            goto s_9;
        }
        return $xA;
        s_9:
        $Da = $this->_trim($Da);
        if (empty($xA->bitmask->value)) {
            goto BIf;
        }
        $bw = min(count($Da), count($this->bitmask->value));
        $Da = array_slice($Da, 0, $bw);
        $zh = 0;
        mGM:
        if (!($zh < $bw)) {
            goto aGT;
        }
        $Da[$zh] = $Da[$zh] & $this->bitmask->value[$zh];
        vYh:
        ++$zh;
        goto mGM;
        aGT:
        BIf:
        return $xA;
    }
    function _trim($Da)
    {
        $zh = count($Da) - 1;
        UG2:
        if (!($zh >= 0)) {
            goto bIK;
        }
        if (!$Da[$zh]) {
            goto p0g;
        }
        goto bIK;
        p0g:
        unset($Da[$zh]);
        jwm:
        --$zh;
        goto UG2;
        bIK:
        return $Da;
    }
    function _array_repeat($DB, $oA)
    {
        return $oA ? array_fill(0, $oA, $DB) : array();
    }
    function _base256_lshift(&$D9, $Fk)
    {
        if (!($Fk == 0)) {
            goto Fy6;
        }
        return;
        Fy6:
        $Ok = $Fk >> 3;
        $Fk &= 7;
        $ae = 0;
        $zh = strlen($D9) - 1;
        nxU:
        if (!($zh >= 0)) {
            goto oXD;
        }
        $iP = ord($D9[$zh]) << $Fk | $ae;
        $D9[$zh] = chr($iP);
        $ae = $iP >> 8;
        ey4:
        --$zh;
        goto nxU;
        oXD:
        $ae = $ae != 0 ? chr($ae) : '';
        $D9 = $ae . $D9 . str_repeat(chr(0), $Ok);
    }
    function _base256_rshift(&$D9, $Fk)
    {
        if (!($Fk == 0)) {
            goto HQV;
        }
        $D9 = ltrim($D9, chr(0));
        return '';
        HQV:
        $Ok = $Fk >> 3;
        $Fk &= 7;
        $xf = '';
        if (!$Ok) {
            goto BGq;
        }
        $KI = $Ok > strlen($D9) ? -strlen($D9) : -$Ok;
        $xf = substr($D9, $KI);
        $D9 = substr($D9, 0, -$Ok);
        BGq:
        $ae = 0;
        $lU = 8 - $Fk;
        $zh = 0;
        La1:
        if (!($zh < strlen($D9))) {
            goto uvv;
        }
        $iP = ord($D9[$zh]) >> $Fk | $ae;
        $ae = ord($D9[$zh]) << $lU & 255;
        $D9[$zh] = chr($iP);
        CKz:
        ++$zh;
        goto La1;
        uvv:
        $D9 = ltrim($D9, chr(0));
        $xf = chr($ae >> $lU) . $xf;
        return ltrim($xf, chr(0));
    }
    function _int2bytes($D9)
    {
        return ltrim(pack("\x4e", $D9), chr(0));
    }
    function _bytes2int($D9)
    {
        $iP = unpack("\x4e\151\x6e\164", str_pad($D9, 4, chr(0), STR_PAD_LEFT));
        return $iP["\151\156\164"];
    }
    function _encodeASN1Length($bw)
    {
        if (!($bw <= 127)) {
            goto chh;
        }
        return chr($bw);
        chh:
        $iP = ltrim(pack("\x4e", $bw), chr(0));
        return pack("\x43\141\52", 128 | strlen($iP), $iP);
    }
    function _safe_divide($D9, $I3)
    {
        if (!(MATH_BIGINTEGER_BASE === 26)) {
            goto vTq;
        }
        return (int) ($D9 / $I3);
        vTq:
        return ($D9 - $D9 % $I3) / $I3;
    }
}
