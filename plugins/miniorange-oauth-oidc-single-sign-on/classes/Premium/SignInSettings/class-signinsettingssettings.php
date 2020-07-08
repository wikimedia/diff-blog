<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Config;
use MoOauthClient\Standard\SignInSettingsSettings as StandardSignInSettingsSettings;
class SignInSettingsSettings extends StandardSignInSettingsSettings
{
    public function change_current_config($post, $HC)
    {
        global $NQ;
        $HC = parent::change_current_config($post, $HC);
        $HC->add_config("\162\145\x73\164\x72\x69\143\164\145\x64\137\x64\x6f\x6d\141\x69\156\163", isset($post["\x72\145\x73\164\162\x69\x63\164\145\x64\x5f\144\157\x6d\141\x69\156\163"]) ? stripslashes(wp_unslash($post["\x72\145\x73\164\x72\x69\x63\164\x65\144\137\x64\x6f\x6d\x61\x69\156\x73"])) : '');
        $HC->add_config("\162\x65\x73\164\162\151\x63\x74\x5f\164\157\x5f\x6c\x6f\x67\147\x65\x64\x5f\151\156\x5f\165\163\x65\162\x73", isset($post["\x72\x65\x73\164\162\x69\143\x74\137\x74\157\137\154\157\x67\x67\145\144\137\151\156\137\165\163\x65\162\163"]) ? stripslashes(wp_unslash($post["\162\x65\163\x74\162\x69\143\x74\x5f\x74\x6f\x5f\x6c\157\147\x67\x65\x64\137\151\156\137\x75\x73\145\x72\x73"])) : '');
        $HC->add_config("\153\145\x65\x70\137\x65\x78\151\x73\x74\x69\156\x67\x5f\165\163\145\162\163", isset($post["\x6b\x65\145\x70\137\145\x78\x69\163\x74\151\x6e\x67\137\165\x73\145\x72\x73"]) ? stripslashes(wp_unslash($post["\x6b\x65\145\160\137\x65\170\151\x73\x74\151\x6e\147\x5f\x75\x73\x65\x72\x73"])) : '');
        $HC->add_config("\153\145\x65\x70\137\x65\x78\x69\x73\x74\151\156\x67\137\145\155\141\x69\x6c\137\141\164\x74\162", isset($post["\153\x65\145\x70\x5f\145\170\x69\x73\x74\151\156\x67\x5f\x65\155\141\x69\154\137\x61\164\164\x72"]) ? stripslashes(wp_unslash($post["\153\145\x65\160\x5f\145\170\x69\x73\x74\x69\x6e\x67\x5f\145\155\x61\151\x6c\137\x61\164\164\x72"])) : '');
        $HC->add_config("\x61\154\x6c\157\167\137\162\145\x73\164\x72\x69\143\x74\145\x64\x5f\x64\x6f\155\141\151\156\x73", isset($post["\x61\154\x6c\x6f\x77\x5f\x72\x65\163\x74\x72\151\x63\x74\x65\x64\137\144\157\x6d\141\151\x6e\x73"]) ? stripslashes(wp_unslash($post["\141\154\x6c\157\x77\x5f\162\x65\x73\164\162\151\x63\x74\x65\144\x5f\x64\x6f\155\141\x69\156\x73"])) : '');
        $HC->add_config("\x61\165\164\x6f\x5f\162\x65\x64\151\x72\145\143\x74\x5f\x65\x78\143\154\165\x64\x65\137\165\162\154\163", isset($post["\141\x75\164\x6f\137\162\x65\x64\x69\x72\x65\x63\x74\x5f\145\170\x63\154\165\144\145\137\x75\x72\154\163"]) ? stripslashes(wp_unslash($post["\x61\165\164\157\137\162\x65\x64\x69\162\145\143\164\x5f\x65\170\143\x6c\165\144\x65\x5f\x75\162\154\163"])) : '');
        return $HC;
    }
}
