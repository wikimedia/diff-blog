<?php


namespace MoOauthClient\GrantTypes;

use MoOauthClient\GrantTypes\Implicit;
use MoOauthClient\OauthHandler;
use MoOauthClient\StorageManager;
use MoOauthClient\Base\InstanceHelper;
class Password
{
    const CSS_URL = MOC_URL . "\x63\x6c\x61\163\163\x65\163\x2f\x50\162\x65\155\151\x75\x6d\x2f\x72\x65\163\x6f\x75\x72\x63\x65\x73\57\x70\x77\144\163\x74\171\x6c\x65\56\143\163\163";
    const JS_URL = MOC_URL . "\x63\x6c\x61\163\163\x65\x73\57\120\162\x65\155\x69\165\155\57\162\145\x73\x6f\165\162\143\x65\163\57\x70\x77\144\56\x6a\x73";
    public function __construct($sf = false)
    {
        if (!$sf) {
            goto QL;
        }
        return;
        QL:
        add_action("\x69\156\x69\x74", array($this, "\142\x65\150\x61\x76\x65"));
    }
    public function inject_ui()
    {
        global $NQ;
        wp_enqueue_style("\x77\x70\x2d\x6d\x6f\x2d\157\143\x2d\x70\x77\x64\x2d\x63\x73\163", self::CSS_URL, array(), $WD = null, $M5 = false);
        $Lh = $NQ->parse_url($NQ->get_current_url());
        $A6 = "\x62\165\x74\x74\157\156";
        if (!isset($Lh["\161\x75\145\x72\171"]["\154\x6f\x67\151\156"])) {
            goto f8;
        }
        return;
        f8:
        ?>
		<div id="password-grant-modal" class="password-modal mo_table_layout">
			<div class="password-modal-content">
				<div class="password-modal-header">
					<div class="password-modal-header-title">
						<span class="password-modal-close">&times;</span>
						<span id="password-modal-header-title-text"></span>
					</div>
				</div>
				<form id="pwdgrntfrm">
					<input type="hidden" name="login" value="pwdgrntfrm">
					<input type="text" class="mo_table_textbox" id="pwdgrntfrm-unmfld" name="caller" placeholder="Username">
					<input type="password" class="mo_table_textbox" id="pwdgrntfrm-pfld" name="tool" placeholder="Password">
					<input type="<?php 
        echo $A6;
        ?>
" class="button button-primary button-large" id="pwdgrntfrm-login" value="Login">
				</form>
			</div>
		</div>
		<?php 
    }
    public function inject_behaviour()
    {
        wp_enqueue_script("\x77\160\x2d\x6d\157\55\x6f\x63\x2d\160\x77\x64\x2d\x6a\163", self::JS_URL, array("\152\161\x75\x65\x72\x79"), $WD = null, $M5 = true);
    }
    public function behave($U9 = '', $lR = '', $UB = '', $cc = '', $KP = false, $sf = false)
    {
        global $NQ;
        $U9 = !empty($U9) ? hex2bin($U9) : false;
        $lR = !empty($lR) ? hex2bin($lR) : false;
        $UB = !empty($UB) ? $UB : false;
        $cc = !empty($cc) ? $cc : site_url();
        if (!(!$U9 || !$lR || !$UB)) {
            goto Gx;
        }
        $NQ->redirect_user(urldecode($cc));
        die;
        Gx:
        $X1 = $NQ->get_app_by_name($UB);
        if ($X1) {
            goto pt;
        }
        $al = $NQ->parse_url(urldecode(site_url()));
        $al["\x71\165\145\x72\171"]["\x65\162\162\x6f\x72"] = "\124\x68\145\162\x65\x20\x69\x73\40\x6e\157\40\141\x70\160\154\151\x63\141\164\151\x6f\156\x20\x63\157\x6e\x66\x69\x67\165\x72\145\144\x20\x66\x6f\162\40\x74\x68\x69\163\x20\x72\145\161\x75\145\163\164";
        $NQ->redirect_user($NQ->generate_url($al));
        pt:
        $R_ = $X1->get_app_config();
        $NC = array("\x67\162\x61\x6e\164\x5f\x74\x79\x70\145" => "\x70\141\x73\163\167\157\162\144", "\143\154\x69\x65\156\x74\137\x69\144" => $R_["\x63\154\151\x65\x6e\164\x5f\x69\x64"], "\143\154\151\145\x6e\164\x5f\x73\145\143\162\145\164" => $R_["\x63\154\151\145\x6e\x74\x5f\163\145\x63\162\x65\x74"], "\165\163\145\162\156\141\x6d\x65" => $U9, "\160\x61\x73\163\167\x6f\162\144" => $lR, "\163\x63\157\160\x65" => $X1->get_app_config("\x73\143\x6f\160\x65"), "\x72\145\144\151\162\145\x63\164\x5f\x75\162\x69" => $X1->get_app_config("\162\x65\x64\x69\162\145\143\x74\137\x75\x72\151"));
        $rM = new OauthHandler();
        $y9 = $R_["\141\x63\143\x65\x73\163\x74\x6f\153\145\x6e\165\162\x6c"];
        if (!(strpos($y9, "\x67\x6f\x6f\147\x6c\x65") !== false)) {
            goto LJ;
        }
        $y9 = "\x68\164\x74\160\x73\x3a\x2f\x2f\x77\x77\x77\56\x67\157\157\147\x6c\145\141\x70\151\163\x2e\143\157\155\57\157\x61\x75\164\x68\62\x2f\166\64\57\x74\157\153\x65\156";
        LJ:
        $gk = isset($R_["\163\x65\156\144\x5f\x68\145\x61\144\x65\162\163"]) ? $R_["\x73\x65\x6e\144\x5f\150\x65\141\x64\145\x72\163"] : 0;
        $dP = isset($R_["\163\145\156\x64\137\142\x6f\x64\x79"]) ? $R_["\163\145\x6e\x64\137\x62\x6f\x64\x79"] : 0;
        $fk = $rM->get_access_token($y9, $NC, $gk, $dP);
        $FA = isset($fk["\x61\x63\x63\x65\x73\163\137\x74\157\x6b\145\x6e"]) ? $fk["\x61\143\143\145\163\163\137\x74\x6f\153\x65\x6e"] : false;
        $j6 = isset($fk["\x69\x64\137\164\157\153\145\x6e"]) ? $fk["\151\144\137\164\x6f\x6b\x65\156"] : false;
        $U_ = isset($fk["\x74\x6f\153\x65\156"]) ? $fk["\164\157\x6b\x65\156"] : false;
        $DV = array();
        if (false !== $j6 || false !== $U_) {
            goto T7;
        }
        if ($FA) {
            goto Aa;
        }
        die("\x49\x6e\166\x61\154\x69\x64\40\164\157\x6b\145\x6e\40\x72\145\x63\x65\x69\x76\145\144\56");
        Aa:
        goto pV;
        T7:
        $zL = '';
        if (!(false !== $U_)) {
            goto JE;
        }
        $zL = "\164\x6f\x6b\145\156\x3d" . $U_;
        JE:
        if (!(false !== $j6)) {
            goto IC;
        }
        $zL = "\x69\x64\x5f\164\x6f\x6b\x65\x6e\x3d" . $j6;
        IC:
        $U7 = new Implicit($zL);
        if (!is_wp_error($U7)) {
            goto cK;
        }
        wp_die(wp_kses($U7->get_error_message(), \get_valid_html()));
        die("\x50\154\x65\x61\163\x65\40\x74\162\171\40\x4c\157\x67\x67\x69\x6e\x67\40\151\x6e\x20\x61\x67\141\x69\156\56");
        cK:
        $S8 = $U7->get_jwt_from_query_param();
        $DV = $S8->get_decoded_payload();
        pV:
        $pl = $R_["\162\x65\163\157\165\x72\x63\145\x6f\167\x6e\145\162\x64\145\164\141\151\x6c\x73\x75\162\x6c"];
        if (!(substr($pl, -1) === "\x3d")) {
            goto jG;
        }
        $pl .= $FA;
        jG:
        if (!(strpos($pl, "\x67\x6f\x6f\x67\x6c\145") !== false)) {
            goto w8;
        }
        $pl = "\150\x74\x74\160\x73\x3a\57\x2f\x77\167\167\x2e\147\157\x6f\147\x6c\145\141\160\151\x73\x2e\143\x6f\x6d\57\x6f\x61\x75\x74\150\62\57\x76\x31\x2f\x75\163\145\162\x69\x6e\146\x6f";
        w8:
        if (empty($pl)) {
            goto sg;
        }
        $DV = $rM->get_resource_owner($pl, $FA);
        sg:
        $s6 = new InstanceHelper();
        $xg = $s6->get_login_handler_instance();
        if (!$KP) {
            goto to;
        }
        $xg->handle_group_test_conf($DV, $R_, $FA, false, $KP);
        die;
        to:
        $Wf = new StorageManager();
        $Wf->add_replace_entry("\162\145\x64\151\x72\x65\143\x74\x5f\x75\x72\x69", $cc);
        $G1 = $Wf->get_state();
        $user = $xg->handle_sso($R_["\x61\160\x70\111\x64"], $R_, $DV, $G1, $fk, $sf);
        if (!$sf) {
            goto hX;
        }
        return $user;
        hX:
    }
    public function mo_oauth_wp_login($user, $wx, $Ij)
    {
        global $NQ;
        $zY = new \WP_Error();
        if (!(empty($wx) || empty($Ij))) {
            goto hW;
        }
        if (!empty($wx)) {
            goto fz;
        }
        $zY->add("\145\x6d\x70\164\171\137\x75\x73\x65\x72\x6e\x61\x6d\x65", __("\74\163\164\162\x6f\156\x67\76\x45\122\122\x4f\x52\x3c\57\x73\164\x72\x6f\x6e\x67\x3e\x3a\x20\x45\x6d\141\151\x6c\x20\x66\x69\145\x6c\x64\40\151\x73\x20\145\x6d\160\164\x79\56"));
        fz:
        if (!empty($Ij)) {
            goto DB;
        }
        $zY->add("\x65\x6d\160\164\171\137\x70\x61\163\x73\x77\157\x72\144", __("\x3c\x73\164\x72\x6f\x6e\x67\76\x45\x52\x52\117\x52\74\x2f\163\164\162\157\156\147\76\72\40\120\141\163\x73\x77\x6f\x72\144\x20\146\151\145\x6c\x64\40\x69\163\x20\x65\x6d\160\164\x79\56"));
        DB:
        return $zY;
        hW:
        $UB = $NQ->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\164\150\137\145\x6e\141\142\154\145\x5f\157\141\x75\x74\x68\137\x77\x70\137\154\x6f\x67\151\x6e");
        $user = false;
        if (\username_exists($wx)) {
            goto B5;
        }
        if (!email_exists($wx)) {
            goto Yz;
        }
        $user = get_user_by("\x65\155\141\151\x6c", $wx);
        Yz:
        goto SN;
        B5:
        $user = \get_user_by("\154\157\147\151\x6e", $wx);
        SN:
        if (!($user && wp_check_password($Ij, $user->data->user_pass, $user->ID))) {
            goto JC;
        }
        return $user;
        JC:
        if (!(false !== $UB)) {
            goto VW;
        }
        return $this->behave(\bin2hex($wx), \bin2hex($Ij), $UB, site_url(), false, true);
        VW:
        $zY->add("\151\156\x76\x61\154\x69\x64\x5f\160\x61\163\x73\x77\157\162\144", __("\x3c\163\164\162\x6f\156\x67\76\x45\x52\122\x4f\122\x3c\57\x73\x74\x72\157\x6e\147\x3e\72\x20\x55\x73\145\162\x6e\x61\x6d\145\40\x6f\162\x20\x50\141\163\163\167\x6f\162\144\40\151\163\x20\x69\x6e\x76\141\154\x69\x64\56"));
        return $zY;
    }
}
