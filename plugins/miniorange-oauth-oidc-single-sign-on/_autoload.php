<?php


if (defined("\101\x42\x53\120\101\x54\110")) {
    goto g72;
}
die;
g72:
define("\x4d\117\103\137\104\x49\122", plugin_dir_path(__FILE__));
define("\x4d\117\103\x5f\125\x52\x4c", plugin_dir_url(__FILE__));
define("\x4d\117\x5f\x55\111\x44", "\104\106\x38\x56\113\112\x4f\65\x46\x44\x48\132\101\x52\102\x52\x35\x5a\104\x53\x32\x56\x35\x4a\x36\x36\x55\x32\x4e\x44\122");
define("\126\105\122\x53\111\x4f\x4e", "\155\157\x5f\160\x72\x65\x6d\x69\x75\155\x5f\166\145\162\x73\x69\157\x6e");
include_file(MOC_DIR . "\x2f\143\154\141\163\x73\x65\163\57\x63\157\x6d\155\x6f\x6e");
include_file(MOC_DIR . "\x2f\143\x6c\x61\x73\163\145\163\x2f\106\x72\145\145");
include_file(MOC_DIR . "\x2f\x63\154\141\x73\x73\x65\163\x2f\123\164\x61\x6e\144\x61\162\144");
include_file(MOC_DIR . "\57\x63\154\141\x73\163\x65\x73\x2f\120\162\145\x6d\151\x75\155");
include_file(MOC_DIR . "\57\143\x6c\141\163\x73\x65\x73\x2f\x45\x6e\x74\145\x72\160\162\151\x73\x65");
function get_dir_contents($X6, &$xp = array())
{
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($X6, RecursiveDirectoryIterator::KEY_AS_PATHNAME), RecursiveIteratorIterator::CHILD_FIRST) as $cd => $BO) {
        if (!($BO->isFile() && $BO->isReadable())) {
            goto g2j;
        }
        $xp[$cd] = realpath($BO->getPathname());
        g2j:
        H1J:
    }
    sj1:
    return $xp;
}
function get_sorted_files($X6)
{
    $qv = get_dir_contents($X6);
    $KN = array();
    $TJ = array();
    foreach ($qv as $cd => $SZ) {
        if (!(strpos($SZ, "\x2e\160\x68\160") !== false)) {
            goto crO;
        }
        if (strpos($SZ, "\x49\x6e\164\145\162\x66\141\x63\x65") !== false) {
            goto nJr;
        }
        $TJ[$cd] = $SZ;
        goto o54;
        nJr:
        $KN[$cd] = $SZ;
        o54:
        crO:
        wS0:
    }
    ClA:
    return array("\151\156\164\x65\x72\x66\x61\143\145\x73" => $KN, "\x63\154\141\163\x73\145\x73" => $TJ);
}
function include_file($X6)
{
    if (is_dir($X6)) {
        goto iGs;
    }
    return;
    iGs:
    $X6 = sane_dir_path($X6);
    $lD = realpath($X6);
    if (!(false !== $lD && !is_dir($X6))) {
        goto dIp;
    }
    return;
    dIp:
    $jK = get_sorted_files($X6);
    require_all($jK["\x69\156\164\x65\162\146\141\x63\145\163"]);
    require_all($jK["\143\x6c\141\163\x73\x65\163"]);
}
function require_all($qv)
{
    foreach ($qv as $cd => $SZ) {
        require_once $SZ;
        m1T:
    }
    nh5:
}
function is_valid_file($ZT)
{
    return '' !== $ZT && "\56" !== $ZT && "\x2e\x2e" !== $ZT;
}
function get_valid_html($NC = array())
{
    $nf = array("\x73\164\x72\157\156\x67" => array(), "\145\x6d" => array(), "\142" => array(), "\151" => array(), "\x61" => array("\150\x72\145\x66" => array(), "\164\x61\162\x67\145\164" => array()));
    if (empty($NC)) {
        goto R02;
    }
    return array_merge($NC, $nf);
    R02:
    return $nf;
}
function get_version_number()
{
    $ou = get_file_data(MOC_DIR . "\x2f\155\157\137\x6f\x61\x75\164\x68\137\163\x65\x74\x74\x69\x6e\x67\163\x2e\160\150\x70", array("\x56\145\x72\163\151\157\x6e"), "\x70\x6c\x75\147\x69\156");
    $k3 = isset($ou[0]) ? $ou[0] : '';
    return $k3;
}
function sane_dir_path($X6)
{
    return str_replace("\x2f", DIRECTORY_SEPARATOR, $X6);
}
if (function_exists("\151\x73\137\x72\145\x73\x74")) {
    goto Vp9;
}
function is_rest()
{
    $NH = rest_get_url_prefix();
    if (!(defined("\122\x45\123\124\x5f\x52\x45\121\125\105\x53\x54") && REST_REQUEST || isset($_GET["\x72\145\163\164\137\x72\x6f\x75\164\x65"]) && strpos(trim($_GET["\x72\x65\x73\164\137\162\x6f\165\164\x65"], "\134\x2f"), $NH, 0) === 0)) {
        goto AVB;
    }
    return true;
    AVB:
    global $na;
    if (!($na === null)) {
        goto s01;
    }
    $na = new WP_Rewrite();
    s01:
    $Ch = wp_parse_url(trailingslashit(rest_url()));
    $Xb = wp_parse_url(add_query_arg(array()));
    return strpos($Xb["\x70\141\x74\150"], $Ch["\x70\141\164\x68"], 0) === 0;
}
Vp9:
