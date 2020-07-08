<?php


namespace MoOauthClient\Standard;

use MoOauthClient\Customer as NormalCustomer;
class Customer extends NormalCustomer
{
    public $email;
    public $phone;
    private $default_customer_key = "\61\x36\x35\65\65";
    private $default_api_key = "\146\x46\x64\x32\x58\x63\166\124\x47\x44\x65\x6d\x5a\166\142\167\61\x62\143\x55\x65\163\116\112\127\x45\161\x4b\142\x62\x55\161";
    public function check_customer_ln()
    {
        global $NQ;
        $Ho = $NQ->mo_oauth_client_get_option("\150\x6f\x73\164\x5f\x6e\x61\155\145") . "\x2f\x6d\x6f\141\163\57\x72\x65\x73\x74\x2f\x63\x75\x73\x74\x6f\x6d\x65\x72\x2f\x6c\151\143\145\156\x73\x65";
        $u0 = $NQ->mo_oauth_client_get_option("\x6d\x6f\137\157\141\165\x74\150\x5f\141\144\155\x69\x6e\137\x63\165\163\x74\157\155\x65\x72\137\153\145\171");
        $om = $NQ->mo_oauth_client_get_option("\155\x6f\137\157\x61\x75\164\150\x5f\141\144\155\151\x6e\x5f\141\160\x69\x5f\153\145\171");
        $wx = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\141\165\164\150\137\141\144\x6d\x69\156\137\145\x6d\141\x69\x6c");
        $d1 = $NQ->mo_oauth_client_get_option("\155\157\137\157\x61\165\x74\150\x5f\141\x64\x6d\x69\156\137\x70\150\x6f\x6e\x65");
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\163\150\x61\x35\x31\x32", $N8);
        $wM = "\103\165\163\x74\157\155\x65\162\55\x4b\x65\x79\72\40" . $u0;
        $tb = "\x54\151\x6d\145\x73\164\141\155\160\72\x20" . $sJ;
        $sS = "\x41\x75\164\150\157\162\151\172\x61\164\x69\157\156\x3a\40" . $Vu;
        $cr = '';
        $cr = array("\x63\165\163\164\x6f\x6d\x65\x72\x49\144" => $u0, "\141\x70\x70\154\151\143\141\x74\x69\x6f\x6e\x4e\x61\155\x65" => "\x77\160\x5f\x6f\x61\x75\x74\x68\137\x63\154\x69\145\156\x74\x5f" . \strtolower($NQ->get_versi_str()) . "\x5f\x70\x6c\141\156");
        $p2 = wp_json_encode($cr);
        $t2 = array("\x43\157\x6e\x74\x65\x6e\x74\x2d\124\x79\x70\x65" => "\x61\x70\160\154\x69\x63\141\x74\x69\x6f\x6e\57\x6a\163\x6f\x6e");
        $t2["\x43\x75\163\x74\157\x6d\x65\x72\55\x4b\145\x79"] = $u0;
        $t2["\124\151\155\x65\163\164\141\155\160"] = $sJ;
        $t2["\x41\x75\x74\x68\157\162\x69\x7a\x61\x74\151\x6f\x6e"] = $Vu;
        $NC = array("\155\145\x74\x68\x6f\x64" => "\120\x4f\123\124", "\142\157\x64\x79" => $p2, "\164\151\155\145\x6f\165\164" => "\x35", "\162\145\x64\x69\162\145\143\x74\x69\157\x6e" => "\x35", "\x68\164\164\160\x76\x65\162\163\151\x6f\x6e" => "\61\56\x30", "\x62\154\x6f\143\153\x69\156\x67" => true, "\x68\x65\x61\144\145\162\163" => $t2);
        $v2 = wp_remote_post($Ho, $NC);
        if (!is_wp_error($v2)) {
            goto z4l;
        }
        $Np = $v2->get_error_message();
        echo "\x53\157\155\x65\164\150\x69\x6e\147\40\167\x65\x6e\x74\40\x77\x72\157\x6e\x67\x3a\40{$Np}";
        die;
        z4l:
        return wp_remote_retrieve_body($v2);
    }
    public function XfskodsfhHJ($cu)
    {
        global $NQ;
        $Ho = $NQ->mo_oauth_client_get_option("\150\157\x73\164\x5f\156\x61\x6d\x65") . "\57\x6d\x6f\141\163\57\141\x70\x69\57\142\141\143\x6b\165\160\143\x6f\x64\145\57\166\x65\162\151\146\x79";
        $u0 = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\x75\164\150\x5f\x61\144\155\151\156\x5f\143\x75\163\164\157\155\145\162\x5f\x6b\145\171");
        $om = $NQ->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\164\x68\x5f\141\144\x6d\x69\x6e\137\x61\x70\151\137\x6b\145\x79");
        $wx = $NQ->mo_oauth_client_get_option("\x6d\x6f\137\157\141\165\164\x68\137\x61\x64\155\151\x6e\137\x65\155\141\151\154");
        $d1 = $NQ->mo_oauth_client_get_option("\x6d\157\x5f\x6f\141\165\x74\150\137\141\x64\155\151\x6e\x5f\x70\150\157\x6e\x65");
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\x73\x68\141\x35\x31\x32", $N8);
        $wM = "\103\165\163\164\x6f\155\x65\x72\55\x4b\145\171\72\40" . $u0;
        $tb = "\x54\x69\x6d\x65\163\164\x61\155\160\72\40" . $sJ;
        $sS = "\x41\165\x74\x68\x6f\x72\x69\172\x61\164\x69\157\x6e\72\40" . $Vu;
        $cr = '';
        $cr = array("\x63\157\144\145" => $cu, "\x63\x75\x73\x74\157\155\x65\x72\113\x65\x79" => $u0, "\141\144\x64\151\164\x69\157\x6e\x61\x6c\106\x69\x65\154\144\x73" => array("\146\x69\x65\x6c\144\x31" => site_url()));
        $p2 = wp_json_encode($cr);
        $t2 = array("\x43\157\156\164\x65\x6e\164\55\x54\171\160\x65" => "\x61\x70\x70\x6c\151\143\141\x74\151\x6f\156\x2f\x6a\x73\x6f\156");
        $t2["\103\x75\163\x74\x6f\x6d\145\162\x2d\113\145\x79"] = $u0;
        $t2["\x54\x69\x6d\145\163\x74\x61\x6d\160"] = $sJ;
        $t2["\101\x75\x74\x68\157\x72\151\x7a\x61\164\x69\157\x6e"] = $Vu;
        $NC = array("\x6d\x65\164\150\157\x64" => "\120\x4f\x53\x54", "\x62\157\144\x79" => $p2, "\x74\151\155\x65\x6f\165\x74" => "\x35", "\162\x65\x64\151\x72\x65\143\164\151\157\156" => "\x35", "\x68\x74\164\160\x76\145\x72\163\151\x6f\x6e" => "\x31\56\60", "\142\154\x6f\143\153\151\156\147" => true, "\x68\x65\x61\144\145\x72\163" => $t2);
        $v2 = wp_remote_post($Ho, $NC);
        if (!is_wp_error($v2)) {
            goto UR7;
        }
        $Np = $v2->get_error_message();
        echo "\123\x6f\155\x65\x74\150\x69\156\147\40\167\145\156\164\40\167\162\x6f\x6e\x67\x3a\x20{$Np}";
        die;
        UR7:
        return wp_remote_retrieve_body($v2);
    }
}
