<?php


namespace MoOauthClient\Backup;

use MoOauthClient\App;
use MoOauthClient\Config;
class BackupHandler
{
    private $plugin_config;
    private $apps_list;
    public static function restore_settings($wP = '')
    {
        if (!(!is_array($wP) || empty($wP))) {
            goto a8;
        }
        return false;
        a8:
        $YG = false;
        $Vn = isset($wP["\x70\154\x75\x67\151\156\137\143\157\156\x66\x69\x67"]) ? $wP["\x70\x6c\x75\147\x69\x6e\x5f\143\157\x6e\146\x69\147"] : false;
        $B4 = isset($wP["\141\160\x70\x5f\143\157\156\146\x69\x67\163"]) ? $wP["\141\x70\160\x5f\x63\157\156\146\x69\147\x73"] : false;
        if (!$Vn) {
            goto wi;
        }
        $YG = self::restore_plugin_config($Vn);
        wi:
        if (!$B4) {
            goto Gj;
        }
        return $YG && self::restore_apps_config($B4);
        Gj:
        return false;
    }
    private static function restore_plugin_config($Vn)
    {
        global $NQ;
        if (!empty($Vn)) {
            goto BC;
        }
        return false;
        BC:
        $HC = new Config($Vn);
        if (empty($HC)) {
            goto bQ;
        }
        $NQ->mo_oauth_client_update_option("\x6d\x6f\x5f\157\x61\x75\164\x68\x5f\x63\154\x69\x65\156\164\x5f\143\x6f\156\146\x69\147", $HC);
        return true;
        bQ:
        return false;
    }
    private static function restore_apps_config($B4)
    {
        global $NQ;
        if (!(!is_array($B4) && empty($B4))) {
            goto p2;
        }
        return false;
        p2:
        $Pk = array();
        foreach ($B4 as $UB => $R_) {
            $X1 = new App($R_);
            $Pk[$UB] = $X1;
            n9:
        }
        W7:
        $NQ->mo_oauth_client_update_option("\x6d\157\137\x6f\141\x75\164\150\x5f\x61\160\x70\x73\137\x6c\151\163\x74", $Pk);
        return true;
    }
    public static function get_backup_json()
    {
        global $NQ;
        $qp = $NQ->export_plugin_config();
        return json_encode($qp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
