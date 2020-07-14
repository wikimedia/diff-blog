<?php


namespace MoOauthClient\Standard;

use MoOauthClient\App;
use MoOauthClient\Free\AppSettings as FreeAppSettings;
class AppSettings extends FreeAppSettings
{
    public function change_app_settings($post, $En)
    {
        $En = parent::change_app_settings($post, $En);
        $En["\x64\151\163\x70\x6c\x61\x79\141\160\160\156\141\155\x65"] = isset($post["\155\x6f\x5f\x6f\x61\x75\x74\x68\137\144\x69\x73\160\x6c\141\x79\x5f\x61\x70\160\137\x6e\x61\155\145"]) ? trim(stripslashes($post["\155\157\137\157\141\165\164\150\137\144\x69\x73\160\154\141\171\137\x61\160\x70\137\156\x61\x6d\x65"])) : '';
        return $En;
    }
    public function change_attribute_mapping($post, $En)
    {
        $En = parent::change_attribute_mapping($post, $En);
        $En["\x65\x6d\x61\151\x6c\x5f\x61\164\164\x72"] = isset($post["\x6d\x6f\x5f\157\141\x75\x74\x68\137\145\155\x61\151\x6c\137\x61\164\164\x72"]) ? stripslashes($post["\155\x6f\137\157\x61\x75\164\150\137\x65\x6d\x61\x69\x6c\137\x61\x74\x74\162"]) : '';
        $En["\x66\151\x72\163\x74\156\x61\155\145\137\141\164\164\162"] = isset($post["\x6d\x6f\137\x6f\141\x75\x74\x68\137\146\x69\162\x73\164\156\x61\155\x65\137\x61\x74\164\x72"]) ? trim(stripslashes($post["\x6d\x6f\x5f\157\x61\165\164\x68\x5f\x66\151\x72\x73\x74\x6e\141\155\145\137\141\164\164\x72"])) : '';
        $En["\x6c\141\x73\164\x6e\141\155\145\137\141\x74\164\x72"] = isset($post["\x6d\157\137\157\141\x75\164\x68\x5f\154\x61\x73\164\156\x61\x6d\x65\x5f\x61\164\164\162"]) ? trim(stripslashes($post["\x6d\157\137\157\141\165\164\x68\x5f\x6c\141\x73\164\x6e\x61\155\145\x5f\141\x74\x74\x72"])) : '';
        $En["\x64\x69\x73\x70\154\x61\x79\137\x61\x74\164\162"] = isset($post["\x6f\141\165\164\150\x5f\143\x6c\x69\145\x6e\164\x5f\141\x6d\x5f\144\x69\163\160\154\141\171\137\156\141\155\x65"]) ? trim(stripslashes($post["\x6f\141\x75\x74\x68\137\x63\x6c\x69\145\156\x74\137\141\155\137\144\x69\x73\x70\x6c\141\171\x5f\156\x61\155\x65"])) : '';
        return $En;
    }
}
