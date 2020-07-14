<?php


namespace MoOauthClient\Standard;

use MoOauthClient\MOUtils as CommonUtils;
class MOUtils extends CommonUtils
{
    private function manage_deactivate_cache()
    {
        global $NQ;
        $We = $NQ->mo_oauth_client_get_option("\x6d\157\137\157\x61\165\164\150\x5f\154\153");
        if (!(!$NQ->mo_oauth_is_customer_registered() || false === $We || empty($We))) {
            goto SZY;
        }
        return;
        SZY:
        $Xp = $NQ->mo_oauth_client_get_option("\150\157\163\164\137\156\141\155\145");
        $Ho = $Xp . "\x2f\155\157\141\163\x2f\141\x70\x69\x2f\142\x61\143\x6b\165\x70\x63\157\144\x65\57\165\160\144\x61\x74\145\x73\164\141\x74\165\x73";
        $u0 = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\141\165\164\x68\x5f\x61\x64\x6d\151\x6e\x5f\143\165\163\164\157\x6d\145\162\137\x6b\145\x79");
        $om = $NQ->mo_oauth_client_get_option("\155\x6f\137\157\141\165\x74\150\x5f\141\x64\155\151\x6e\x5f\141\x70\x69\x5f\153\145\x79");
        $cu = $NQ->mooauthdecrypt($We);
        $sJ = round(microtime(true) * 1000);
        $sJ = number_format($sJ, 0, '', '');
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\x73\x68\x61\65\61\62", $N8);
        $wM = "\103\165\x73\164\157\155\x65\x72\55\x4b\145\171\72\x20" . $u0;
        $tb = "\x54\151\x6d\x65\x73\x74\x61\155\x70\x3a\40" . $sJ;
        $sS = "\101\165\164\150\x6f\x72\x69\x7a\141\x74\151\x6f\x6e\x3a\x20" . $Vu;
        $cr = '';
        $cr = array("\143\157\x64\x65" => $cu, "\x63\x75\163\x74\x6f\155\145\162\113\x65\x79" => $u0, "\x61\144\x64\151\164\x69\x6f\x6e\x61\154\106\x69\145\154\x64\x73" => array("\146\x69\145\x6c\x64\61" => home_url()));
        $p2 = wp_json_encode($cr);
        $t2 = array("\x43\x6f\x6e\x74\145\156\164\x2d\x54\171\160\x65" => "\141\160\160\154\x69\143\x61\x74\x69\x6f\156\x2f\x6a\x73\x6f\156");
        $t2["\x43\x75\163\x74\x6f\x6d\x65\x72\x2d\113\145\171"] = $u0;
        $t2["\124\151\x6d\145\x73\x74\x61\x6d\x70"] = $sJ;
        $t2["\101\165\164\150\157\162\151\x7a\141\164\151\157\x6e"] = $Vu;
        $NC = array("\x6d\145\x74\x68\x6f\x64" => "\120\x4f\123\124", "\x62\157\x64\x79" => $p2, "\x74\x69\x6d\145\157\165\164" => "\65", "\162\145\144\151\162\x65\x63\x74\x69\157\x6e" => "\x35", "\150\x74\x74\x70\x76\145\x72\x73\x69\x6f\156" => "\x31\56\60", "\x62\x6c\157\x63\153\x69\156\147" => true, "\x68\x65\141\144\145\x72\x73" => $t2);
        $v2 = wp_remote_post($Ho, $NC);
        if (!is_wp_error($v2)) {
            goto WAp;
        }
        $Np = $v2->get_error_message();
        echo "\x53\x6f\155\x65\164\x68\x69\x6e\147\40\x77\x65\x6e\164\40\167\x72\157\x6e\x67\72\x20{$Np}";
        die;
        WAp:
        return wp_remote_retrieve_body($v2);
    }
    public function deactivate_plugin()
    {
        $this->manage_deactivate_cache();
        parent::deactivate_plugin();
        $this->mo_oauth_client_delete_option("\155\x6f\x5f\157\141\x75\x74\x68\137\x6c\x6b");
        $this->mo_oauth_client_delete_option("\x6d\x6f\137\157\x61\165\x74\x68\137\x6c\x76");
    }
}
