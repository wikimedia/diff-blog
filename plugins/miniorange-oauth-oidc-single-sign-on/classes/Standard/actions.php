<?php


function mo_oauth_client_auto_redirect_external_after_logout()
{
    $NQ = new \MoOauthClient\Standard\MOUtils();
    $HC = $NQ->get_plugin_config();
    if (empty($HC->get_config("\x61\146\164\x65\162\137\x6c\x6f\147\x6f\x75\x74\137\165\x72\154"))) {
        goto YNg;
    }
    $o2 = $HC->get_config("\x61\146\x74\145\162\x5f\x6c\157\147\157\165\164\x5f\x75\x72\x6c");
    $ZN = get_current_user_id();
    $j6 = get_user_meta($ZN, "\x6d\x6f\137\157\x61\x75\x74\x68\x5f\x63\154\x69\145\156\x74\x5f\154\x61\163\164\x5f\x69\144\x5f\x74\x6f\x6b\x65\156", true);
    $o2 = str_replace("\43\x23\151\x64\137\164\x6f\153\x65\x6e\43\43", $j6, $o2);
    wp_redirect($o2);
    die;
    YNg:
}
add_action("\167\x70\137\x6c\x6f\147\x6f\165\164", "\x6d\x6f\x5f\x6f\141\x75\x74\x68\x5f\143\x6c\151\x65\x6e\x74\x5f\x61\165\x74\x6f\x5f\162\145\x64\151\162\145\x63\x74\x5f\145\170\164\145\162\x6e\x61\x6c\137\x61\x66\164\145\162\137\154\x6f\147\157\x75\x74");
