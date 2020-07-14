<?php
/**
 * Plugin Name: OAuth Single Sign On - SSO (OAuth client)
 * Plugin URI: http://miniorange.com
 * Description: This plugin enables login to your WordPress site using OAuth apps like Google, Facebook, EVE Online and other.
 * Version: 28.2.1
 * Author: miniOrange
 * Author URI: https://www.miniorange.com
 * License: GPL2
 */


require "\x5f\x61\165\x74\157\154\157\x61\144\x2e\160\150\x70";
require_once "\x6d\157\55\157\x61\x75\164\150\x2d\x63\x6c\x69\x65\156\x74\55\160\154\x75\147\x69\x6e\x2d\x76\145\x72\x73\151\157\156\x2d\165\x70\144\x61\x74\145\56\x70\150\160";
use MoOauthClient\Base\BaseStructure;
use MoOauthClient\MOUtils;
use MoOauthClient\Base\InstanceHelper;
use MoOauthClient\MoOauthClientWidget;
use MoOauthClient\Free\MOCVisualTour;
global $NQ;
$s6 = new InstanceHelper();
$GJ = new BaseStructure();
$NQ = $s6->get_utils_instance();
$wP = $s6->get_settings_instance();
$xg = $s6->get_login_handler_instance();
function register_mo_oauth_widget()
{
    register_widget("\x5c\x4d\x6f\117\141\x75\164\150\103\x6c\x69\145\x6e\164\134\115\x6f\x4f\x61\x75\x74\150\x43\154\x69\145\156\x74\x57\151\x64\147\x65\164");
}
function mo_oauth_shortcode_login($ey)
{
    global $NQ;
    $TG = new MoOauthClientWidget();
    if ($NQ->check_versi(3) && $NQ->mo_oauth_client_get_option("\155\157\137\x6f\x61\165\x74\150\x5f\141\143\164\x69\x76\x61\x74\x65\137\163\x69\x6e\147\x6c\145\x5f\x6c\157\x67\151\156\x5f\x66\x6c\157\167")) {
        goto Nqn;
    }
    return $ey ? $TG->mo_oauth_login_form($CY = true, $WW = $ey[0]) : $TG->mo_oauth_login_form(false);
    goto hlX;
    Nqn:
    return $TG->mo_activate_single_login_flow_form();
    hlX:
}
add_action("\x77\x69\x64\x67\x65\x74\163\137\151\x6e\x69\164", "\162\x65\147\x69\163\164\145\x72\x5f\x6d\157\x5f\157\141\165\x74\150\137\x77\x69\144\147\145\x74");
add_shortcode("\155\157\137\157\x61\x75\164\x68\x5f\x6c\x6f\x67\151\156", "\x6d\x6f\137\157\141\165\x74\x68\x5f\163\x68\157\x72\x74\143\157\x64\145\137\154\157\x67\151\x6e");
function miniorange_oauth_visual_tour()
{
    $ua = new MOCVisualTour();
}
if (!($NQ->get_versi() === 0)) {
    goto GNf;
}
add_action("\x61\x64\x6d\151\156\137\x69\156\151\164", "\155\151\156\x69\x6f\x72\141\156\147\145\137\157\141\x75\x74\150\137\x76\x69\x73\165\x61\x6c\x5f\x74\x6f\x75\162");
GNf:
function mo_oauth_deactivate()
{
    global $NQ;
    do_action("\155\x6f\x5f\143\x6c\145\x61\162\x5f\160\x6c\x75\x67\x5f\143\141\x63\x68\145");
    $NQ->deactivate_plugin();
}
register_deactivation_hook(__FILE__, "\155\157\x5f\x6f\x61\165\164\x68\x5f\x64\145\141\143\164\x69\x76\141\164\x65");
