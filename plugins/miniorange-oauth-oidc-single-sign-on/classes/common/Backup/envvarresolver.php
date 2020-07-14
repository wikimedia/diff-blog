<?php


namespace MoOauthClient\Backup;

use MoOauthClient\App;
class EnvVarResolver
{
    public static function resolve_var($ZZ, $Da)
    {
        switch ($ZZ) {
            case "\155\x6f\137\x6f\141\165\164\150\137\x61\x70\x70\163\137\x6c\151\163\x74":
                $Da = self::resolve_apps_list($Da);
                goto Xq;
            default:
                goto Xq;
        }
        Uc:
        Xq:
        return $Da;
    }
    private static function resolve_apps_list($Da)
    {
        if (!is_array($Da)) {
            goto MF;
        }
        return $Da;
        MF:
        $Da = json_decode($Da, true);
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto f6;
        }
        return array();
        f6:
        $p4 = array();
        foreach ($Da as $UB => $R_) {
            if (!$R_ instanceof App) {
                goto x7;
            }
            $p4[$UB] = $R_;
            goto QZ;
            x7:
            if (!(!isset($R_["\x63\154\151\x65\156\x74\137\x69\x64"]) || empty($R_["\x63\154\x69\145\156\164\137\151\144"]))) {
                goto yv;
            }
            $R_["\143\154\x69\x65\156\164\x5f\x69\x64"] = isset($R_["\x63\x6c\151\x65\156\x74\x69\x64"]) ? $R_["\x63\x6c\x69\145\x6e\x74\151\x64"] : '';
            yv:
            if (!(!isset($R_["\143\154\x69\145\x6e\164\137\x73\145\143\x72\145\164"]) || empty($R_["\143\x6c\x69\145\x6e\164\137\x73\145\143\x72\x65\x74"]))) {
                goto Ta;
            }
            $R_["\x63\x6c\151\145\156\x74\x5f\163\145\143\162\x65\x74"] = isset($R_["\x63\154\151\145\156\x74\x73\145\x63\x72\x65\164"]) ? $R_["\x63\154\151\145\x6e\x74\163\145\x63\x72\145\x74"] : '';
            Ta:
            unset($R_["\x63\154\151\145\156\164\151\144"]);
            unset($R_["\143\154\x69\145\156\164\163\145\143\162\145\x74"]);
            $X1 = new App();
            $X1->migrate_app($R_, $UB);
            $p4[$UB] = $X1;
            QZ:
        }
        Pl:
        return $p4;
    }
}
