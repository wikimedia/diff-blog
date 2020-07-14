<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Standard\LoginHandler as StandardLoginHandler;
use MoOauthClient\GrantTypes\Implicit;
use MoOauthClient\GrantTypes\Password;
use MoOauthClient\GrantTypes\JWSVerify;
use MoOauthClient\GrantTypes\JWTUtils;
use MoOauthClient\Premium\MappingHandler;
use MoOauthClient\StorageManager;
class LoginHandler extends StandardLoginHandler
{
    private $implicit_handler;
    private $app_name = '';
    private $group_mapping_attr = false;
    private $resource_owner = false;
    public function __construct()
    {
        global $NQ;
        parent::__construct();
        add_filter("\x6d\x6f\137\x61\x75\164\x68\x5f\x75\x72\x6c\137\151\156\x74\145\162\x6e\141\154", array($this, "\155\x6f\137\157\141\x75\164\150\x5f\x63\154\x69\x65\156\164\x5f\x67\x65\156\145\x72\141\x74\x65\137\141\165\x74\150\157\162\x69\x7a\141\164\151\x6f\x6e\137\x75\162\x6c"), 5, 2);
        add_action("\167\160\x5f\146\x6f\157\x74\x65\x72", array($this, "\x6d\157\x5f\157\x61\x75\x74\x68\x5f\x63\154\151\x65\x6e\x74\137\x69\155\160\154\151\x63\x69\164\137\146\162\x61\x67\155\145\156\164\137\150\141\x6e\x64\x6c\x65\x72"));
        add_action("\x6d\157\x5f\157\141\165\x74\x68\137\x72\x65\x73\x74\x72\x69\x63\x74\x5f\x65\155\x61\151\x6c\x73", array($this, "\x6d\157\x5f\x6f\x61\165\x74\x68\x5f\143\154\x69\x65\x6e\164\137\162\145\163\164\162\151\143\x74\137\145\155\141\151\154\x73"), 10, 2);
        add_action("\x6d\x6f\x5f\x6f\141\x75\x74\x68\x5f\143\154\x69\145\156\x74\137\x6d\141\x70\137\x72\157\154\x65\163", array($this, "\x6d\157\137\x6f\x61\x75\164\x68\x5f\143\x6c\x69\145\x6e\x74\137\155\141\x70\x5f\x72\157\154\145\x73"), 10, 1);
        $CS = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\x74\x68\x5f\x65\156\141\142\x6c\145\x5f\157\x61\x75\164\150\x5f\167\x70\x5f\154\157\147\x69\156");
        if (!$CS) {
            goto kpd;
        }
        remove_filter("\x61\165\x74\150\145\156\x74\151\x63\x61\x74\x65", "\167\160\x5f\x61\165\x74\x68\x65\x6e\164\x69\x63\x61\164\145\137\165\x73\145\x72\x6e\x61\x6d\x65\137\x70\x61\163\163\x77\x6f\162\144", 20, 3);
        $yZ = new Password(true);
        add_filter("\x61\x75\164\x68\x65\156\x74\x69\143\x61\164\x65", array($yZ, "\155\157\x5f\x6f\141\x75\164\x68\x5f\x77\x70\x5f\154\157\x67\x69\x6e"), 20, 3);
        kpd:
    }
    public function mo_oauth_client_restrict_emails($yY, $HC)
    {
        $N1 = isset($HC["\162\145\x73\164\162\x69\143\164\145\x64\x5f\x64\157\x6d\141\151\x6e\x73"]) ? $HC["\x72\145\163\x74\x72\151\143\164\145\144\x5f\x64\x6f\155\x61\x69\156\x73"] : '';
        if (!empty($N1)) {
            goto YGu;
        }
        return;
        YGu:
        $Df = isset($HC["\141\154\154\x6f\167\x5f\162\145\x73\164\162\x69\x63\x74\145\x64\137\144\x6f\155\141\151\156\x73"]) ? $HC["\x61\x6c\154\157\167\x5f\x72\x65\163\x74\162\x69\x63\x74\x65\144\137\144\157\x6d\141\151\x6e\163"] : '';
        if (!empty($Df)) {
            goto jdg;
        }
        $Df = false;
        jdg:
        $Df = intval($Df);
        $N1 = explode("\54", $N1);
        $Vf = substr($yY, strpos($yY, "\100") + 1);
        $tL = in_array($Vf, $N1, false);
        $tL = $Df ? !$tL : $tL;
        $x3 = !empty($N1) && $tL;
        if (!$x3) {
            goto OOQ;
        }
        wp_die("\x59\x6f\x75\40\144\x6f\x20\156\157\164\40\150\x61\166\x65\x20\x72\x69\147\x68\x74\163\40\x74\x6f\x20\141\x63\143\145\163\x73\x20\164\x68\151\x73\40\160\141\147\145\x2e\40\120\x6c\x65\141\163\145\x20\143\x6f\156\164\141\143\x74\40\x74\150\x65\40\x61\144\155\x69\x6e\151\x73\x74\x72\x61\164\x6f\x72\x2e");
        OOQ:
    }
    public function mo_oauth_client_generate_authorization_url($Yh, $UB)
    {
        global $NQ;
        $ej = $NQ->parse_url($Yh);
        $HC = $NQ->get_app_by_name($UB)->get_app_config();
        if (!(isset($HC["\147\162\x61\156\164\137\164\171\160\x65"]) && "\111\155\x70\154\151\x63\151\164\x20\x47\162\x61\156\164" === $HC["\x67\x72\x61\156\x74\x5f\164\x79\160\145"])) {
            goto A9g;
        }
        $ej["\161\165\145\x72\171"]["\162\145\x73\x70\157\x6e\x73\x65\x5f\x74\x79\160\x65"] = "\164\157\x6b\x65\156";
        return $NQ->generate_url($ej);
        A9g:
        return $Yh;
    }
    public function mo_oauth_client_map_roles($NC)
    {
        $R_ = isset($NC["\x61\x70\160\x5f\143\x6f\156\x66\151\147"]) && !empty($NC["\141\160\160\x5f\143\157\x6e\146\151\x67"]) ? $NC["\141\x70\x70\137\143\x6f\156\146\151\x67"] : array();
        $fH = isset($R_["\147\162\x6f\x75\160\x6e\x61\x6d\x65\x5f\141\x74\164\x72\151\x62\x75\x74\x65"]) && '' !== $R_["\147\x72\157\165\x70\156\x61\x6d\145\x5f\141\164\x74\162\x69\x62\165\x74\145"] ? $R_["\x67\162\157\165\160\x6e\x61\x6d\145\137\141\x74\x74\x72\151\142\x75\x74\145"] : false;
        $this->resource_owner = isset($NC["\162\145\163\157\165\162\143\145\137\x6f\x77\x6e\145\162"]) && !empty($NC["\162\145\163\x6f\x75\162\x63\x65\x5f\157\167\156\x65\162"]) ? $NC["\x72\x65\163\157\x75\162\x63\145\x5f\157\167\x6e\145\162"] : array();
        $this->group_mapping_attr = $this->get_group_mapping_attribute($this->resource_owner, false, $fH);
        $Al = new MappingHandler(isset($NC["\165\x73\x65\162\137\x69\x64"]) && is_numeric($NC["\x75\x73\x65\x72\137\x69\144"]) ? intval($NC["\x75\x73\x65\x72\x5f\151\x64"]) : 0, $R_, $this->group_mapping_attr ? $this->group_mapping_attr : '', isset($NC["\156\145\x77\137\x75\x73\x65\x72"]) ? \boolval($NC["\156\x65\x77\x5f\x75\x73\145\162"]) : true);
        $Al->apply_custom_attribute_mapping(is_array($this->resource_owner) ? $this->resource_owner : array());
        $Al->apply_role_mapping();
    }
    public function mo_oauth_client_implicit_fragment_handler()
    {
        ?>
			<script>
				function convert_to_url(obj) {
					return Object
					.keys(obj)
					.map(k => `${encodeURIComponent(k)}=${encodeURIComponent(obj[k])}`)
					.join('&');
				}

				function pass_to_backend() {
					if(window.location.hash) {
						var hash = window.location.hash;
						var elements = {};
						hash.split("#")[1].split("&").forEach(element => {
							var vars = element.split("=");
							elements[vars[0]] = vars[1];
						});
						if(("access_token" in elements) || ("id_token" in elements) || ("token" in elements)) {
							if(window.location.href.indexOf("?") !== -1) {
								window.location = (window.location.href.split("?")[0] + window.location.hash).split('#')[0] + "?" + convert_to_url(elements);
							} else {
								window.location = window.location.href.split('#')[0] + "?" + convert_to_url(elements);
							}
						}
					}
				}

				pass_to_backend();
			</script>

		<?php 
    }
    private function check_state($U7)
    {
        $G1 = str_replace("\x25\x33\104", "\75", urldecode($U7->get_query_param("\x73\x74\x61\164\x65")));
        if (!empty($G1)) {
            goto k4J;
        }
        wp_die(wp_kses("\124\x68\145\40\163\x74\141\x74\145\x20\160\x61\x72\x61\155\145\164\x65\162\x20\151\163\40\145\155\160\x74\171\x2e", \get_valid_html()));
        k4J:
        $Wf = new StorageManager($G1);
        if (!is_wp_error($Wf)) {
            goto qvc;
        }
        wp_die(wp_kses($Wf->get_error_message(), \get_valid_html()));
        qvc:
        $fi = $Wf->get_value("\165\151\144");
        if (!($fi && MO_UID === $fi)) {
            goto x2H;
        }
        $this->appname = $Wf->get_value("\141\x70\x70\156\141\x6d\x65");
        return $Wf;
        x2H:
        return false;
    }
    public function mo_oauth_login_validate()
    {
        parent::mo_oauth_login_validate();
        global $NQ;
        if (!(isset($_REQUEST["\164\x6f\153\145\156"]) && !empty($_REQUEST["\x74\157\x6b\145\x6e"]) || isset($_REQUEST["\x69\x64\x5f\x74\157\x6b\x65\x6e"]) && !empty($_REQUEST["\x69\144\137\164\157\x6b\145\156"]))) {
            goto nwJ;
        }
        if (!(isset($_REQUEST["\x74\x6f\153\x65\x6e"]) && !empty($_REQUEST["\x74\157\153\145\x6e"]))) {
            goto Pm0;
        }
        $i1 = $NQ->is_valid_jwt(urldecode($_REQUEST["\164\x6f\153\x65\156"]));
        if ($i1) {
            goto gcE;
        }
        return;
        gcE:
        Pm0:
        $U7 = new Implicit(isset($_SERVER["\x51\125\105\122\131\137\123\x54\122\111\116\107"]) ? $_SERVER["\x51\x55\x45\x52\x59\x5f\x53\x54\x52\111\116\x47"] : '');
        if (!is_wp_error($U7)) {
            goto cgo;
        }
        wp_die(wp_kses($U7->get_error_message(), \get_valid_html()));
        die("\120\x6c\x65\x61\x73\145\40\x74\162\x79\x20\x4c\x6f\147\147\x69\156\x67\x20\x69\156\x20\141\x67\141\151\x6e\56");
        cgo:
        $S8 = $U7->get_jwt_from_query_param();
        if (!is_wp_error($S8)) {
            goto EKl;
        }
        wp_die(wp_kses($S8->get_error_message(), \get_valid_html()));
        EKl:
        $Wf = $this->check_state($U7);
        if ($Wf) {
            goto cmK;
        }
        wp_die("\x53\164\x61\x74\x65\x20\x50\x61\x72\x61\x6d\145\164\145\162\40\x64\x69\x64\x20\156\x6f\x74\x20\166\145\x72\x69\146\171\x2e\40\x50\x6c\145\141\x73\x65\40\x54\x72\x79\40\114\x6f\x67\147\x69\x6e\147\x20\x69\156\40\x61\x67\141\x69\156\56");
        cmK:
        $R_ = $NQ->get_app_by_name($this->app_name);
        $R_ = $R_ ? $R_->get_app_config() : false;
        $DV = $this->handle_jwt($S8);
        if (!is_wp_error($DV)) {
            goto H8q;
        }
        wp_die(wp_kses($DV->get_error_message(), \get_valid_html()));
        H8q:
        if ($R_) {
            goto kbV;
        }
        wp_die("\123\x74\141\164\x65\40\x50\141\162\141\x6d\145\x74\x65\162\x20\144\x69\144\40\156\x6f\x74\40\x76\x65\162\x69\x66\171\x2e\40\x50\154\x65\x61\163\x65\x20\x54\162\x79\40\114\157\x67\147\151\156\147\x20\x69\156\40\141\147\x61\151\x6e\x2e");
        kbV:
        if ($DV) {
            goto hPE;
        }
        wp_die("\x4a\127\124\40\123\151\x67\156\x61\164\165\162\x65\x20\144\x69\144\x20\x6e\x6f\164\40\166\145\x72\x69\x66\171\x2e\40\120\154\145\x61\163\145\x20\124\x72\171\40\x4c\157\x67\x67\x69\x6e\147\40\151\x6e\40\x61\x67\141\151\156\x2e");
        hPE:
        $Xt = $Wf->get_value("\164\x65\163\x74\x5f\x63\157\156\146\x69\147");
        $this->resource_owner = $DV;
        $this->handle_group_details($U7->get_query_param("\141\x63\x63\x65\x73\163\x5f\164\x6f\x6b\145\x6e"), isset($R_["\147\162\x6f\165\x70\x64\x65\x74\141\151\x6c\x73\x75\x72\x6c"]) ? $R_["\x67\162\157\165\x70\144\145\164\x61\151\x6c\x73\165\162\154"] : '', isset($R_["\x67\162\157\x75\x70\156\141\155\145\x5f\x61\164\164\162\x69\x62\165\164\145"]) ? $R_["\147\x72\x6f\165\x70\156\141\x6d\x65\x5f\141\164\164\x72\x69\142\x75\x74\x65"] : '', $Xt);
        $iP = array();
        $F_ = $this->dropdownattrmapping('', $DV, $iP);
        $NQ->mo_oauth_client_update_option("\155\157\137\x6f\141\x75\x74\x68\x5f\141\x74\164\162\137\156\x61\155\145\x5f\154\x69\x73\164" . $R_["\141\160\160\111\x64"], $F_);
        if (!($Xt && '' !== $Xt)) {
            goto cWc;
        }
        $this->render_test_config_output($DV);
        die;
        cWc:
        $this->handle_sso($this->app_name, $R_, $DV, $Wf->get_state(), $U7->get_query_param());
        nwJ:
        if (!(isset($_REQUEST["\141\x63\143\145\163\163\137\x74\157\x6b\x65\x6e"]) && '' !== $_REQUEST["\x61\x63\x63\x65\163\163\137\164\x6f\x6b\145\x6e"])) {
            goto C9T;
        }
        $U7 = new Implicit(isset($_SERVER["\x51\125\x45\x52\131\x5f\123\124\122\111\x4e\107"]) ? $_SERVER["\x51\125\x45\122\131\x5f\123\x54\x52\x49\x4e\x47"] : '');
        $Wf = $this->check_state($U7);
        if ($Wf) {
            goto IsV;
        }
        wp_die("\x53\x74\141\x74\145\x20\x50\x61\x72\x61\x6d\x65\x74\145\162\40\x64\151\144\40\156\157\x74\40\x76\145\x72\151\146\x79\56\40\x50\154\145\x61\x73\145\x20\124\162\x79\40\114\157\147\147\x69\156\147\40\151\156\40\141\x67\141\151\x6e\x2e");
        IsV:
        $R_ = $NQ->get_app_by_name($Wf->get_value("\x61\160\x70\x6e\141\155\x65"));
        $R_ = $R_->get_app_config();
        $DV = array();
        if (!(isset($R_["\x72\x65\163\157\x75\162\x63\145\157\x77\x6e\145\x72\144\x65\x74\141\151\x6c\163\165\x72\x6c"]) && !empty($R_["\x72\x65\x73\157\165\162\143\145\x6f\167\156\145\162\x64\x65\164\x61\x69\154\x73\x75\x72\154"]))) {
            goto A7g;
        }
        $DV = $this->oauth_handler->get_resource_owner($R_["\162\x65\x73\x6f\165\162\x63\145\x6f\x77\156\145\x72\144\145\164\141\x69\154\x73\x75\162\x6c"], $U7->get_query_param("\x61\143\x63\x65\163\x73\x5f\x74\x6f\x6b\145\x6e"));
        A7g:
        $Ln = array();
        if (!$NQ->is_valid_jwt($U7->get_query_param("\x61\143\143\145\163\163\x5f\x74\157\153\145\x6e"))) {
            goto XsS;
        }
        $S8 = $U7->get_jwt_from_query_param();
        $Ln = $this->handle_jwt($S8);
        XsS:
        if (empty($Ln)) {
            goto pZ0;
        }
        $DV = array_merge($DV, $Ln);
        pZ0:
        if (!(empty($DV) && !$NQ->is_valid_jwt($U7->get_query_param("\x61\143\x63\145\x73\x73\137\164\157\x6b\145\x6e")))) {
            goto ZBo;
        }
        wp_die("\x49\156\166\x61\154\x69\x64\40\x52\x65\163\x70\x6f\x6e\163\x65\x20\x52\x65\143\x65\151\166\x65\x64\x2e");
        die;
        ZBo:
        $this->resource_owner = $DV;
        $Xt = $Wf->get_value("\x74\145\x73\x74\137\143\x6f\x6e\x66\x69\x67");
        $this->handle_group_details($U7->get_query_param("\141\143\143\145\x73\163\x5f\164\157\153\145\156"), isset($R_["\147\x72\157\165\160\x64\x65\164\141\x69\x6c\163\165\162\x6c"]) ? $R_["\x67\x72\157\x75\160\144\145\164\x61\151\x6c\163\165\x72\x6c"] : '', isset($R_["\x67\x72\157\x75\160\156\141\155\x65\x5f\141\x74\x74\162\x69\142\x75\x74\145"]) ? $R_["\147\x72\157\x75\160\x6e\x61\x6d\x65\137\x61\164\x74\x72\x69\x62\165\164\145"] : '', $Xt);
        $iP = array();
        $F_ = $this->dropdownattrmapping('', $DV, $iP);
        $NQ->mo_oauth_client_update_option("\x6d\157\137\x6f\x61\x75\x74\150\x5f\x61\x74\164\162\137\x6e\x61\155\x65\137\x6c\151\163\x74" . $R_["\141\160\160\x49\x64"], $F_);
        if (!($Xt && '' !== $Xt)) {
            goto JhT;
        }
        $this->render_test_config_output($DV);
        die;
        JhT:
        $G1 = str_replace("\x25\63\104", "\75", rawurldecode($U7->get_query_param("\163\x74\x61\x74\x65")));
        $this->handle_sso($this->app_name, $R_, $DV, $G1, $U7->get_query_param());
        C9T:
        if (!(isset($_REQUEST["\x6c\x6f\x67\x69\x6e"]) && "\160\167\144\147\162\x6e\164\146\x72\x6d" === $_REQUEST["\x6c\157\147\x69\x6e"])) {
            goto SeO;
        }
        $yZ = new Password();
        $U9 = isset($_REQUEST["\x63\x61\x6c\x6c\x65\x72"]) && !empty($_REQUEST["\x63\x61\154\x6c\145\x72"]) ? $_REQUEST["\x63\x61\x6c\x6c\145\x72"] : false;
        $lR = isset($_REQUEST["\x74\x6f\157\154"]) && !empty($_REQUEST["\164\x6f\x6f\x6c"]) ? $_REQUEST["\x74\157\157\154"] : false;
        $UB = isset($_REQUEST["\141\160\160\x5f\x6e\141\155\x65"]) && !empty($_REQUEST["\x61\160\160\137\156\x61\x6d\145"]) ? $_REQUEST["\141\x70\x70\137\x6e\141\x6d\x65"] : false;
        $cc = isset($_REQUEST["\154\x6f\143\141\x74\x69\157\x6e"]) && !empty($_REQUEST["\x6c\x6f\143\141\x74\x69\x6f\x6e"]) ? $_REQUEST["\x6c\157\x63\x61\164\x69\157\x6e"] : site_url();
        $KP = isset($_REQUEST["\x74\145\163\x74"]) && !empty($_REQUEST["\164\x65\163\164"]);
        if (!(!$U9 || !$lR || !$UB)) {
            goto MaE;
        }
        $NQ->redirect_user(urldecode($cc));
        MaE:
        $yZ->behave($U9, $lR, $UB, $cc, $KP);
        SeO:
    }
    public function handle_group_details($FA = '', $TU = '', $kv = '', $Xt = false)
    {
        $cf = array();
        if (!('' === $FA || '' === $kv)) {
            goto rph;
        }
        return;
        rph:
        if (!('' !== $TU)) {
            goto aoc;
        }
        $cf = $this->oauth_handler->get_resource_owner($TU, $FA);
        if (!(isset($_COOKIE["\155\157\137\x6f\141\165\x74\x68\137\x74\x65\x73\164"]) && $_COOKIE["\155\x6f\x5f\x6f\141\x75\x74\150\x5f\x74\145\x73\164"])) {
            goto YVq;
        }
        if (!(is_array($cf) && !empty($cf))) {
            goto AIf;
        }
        $this->render_test_config_output($cf, true);
        AIf:
        return;
        YVq:
        aoc:
        $fH = $this->get_group_mapping_attribute($this->resource_owner, $cf, $kv);
        $this->group_mapping_attr = '' !== $fH ? false : $fH;
    }
    public function get_group_mapping_attribute($DV = array(), $cf = array(), $kv = '')
    {
        global $NQ;
        $k0 = '';
        if (!('' === $kv)) {
            goto KVa;
        }
        return '';
        KVa:
        if (isset($cf) && !empty($cf)) {
            goto Zgf;
        }
        if (isset($DV) && !empty($DV)) {
            goto CtC;
        }
        goto Oyk;
        Zgf:
        $k0 = $NQ->getnestedattribute($cf, $kv);
        goto Oyk;
        CtC:
        $k0 = $NQ->getnestedattribute($DV, $kv);
        Oyk:
        return !empty($k0) ? $k0 : '';
    }
    public function handle_jwt($S8)
    {
        global $NQ;
        $X1 = $NQ->get_app_by_name($this->app_name);
        $FY = $X1->get_app_config("\x6a\x77\164\137\163\x75\160\160\x6f\162\x74");
        if ($FY) {
            goto YCN;
        }
        return $S8->get_decoded_payload();
        YCN:
        $TF = $X1->get_app_config("\152\167\164\x5f\x61\x6c\147\x6f");
        if ($S8->check_algo($TF)) {
            goto O3M;
        }
        return new \WP_Error("\x69\156\166\x61\154\151\144\137\x73\x69\147\x6e", __("\x4a\127\124\x20\123\151\147\x6e\151\156\147\x20\x61\x6c\147\157\x72\151\164\150\155\x20\151\x73\40\156\157\164\x20\141\x6c\x6c\157\167\x65\x64\40\x6f\162\x20\x75\x6e\x73\x75\x70\160\157\x72\x74\145\x64\x2e"));
        O3M:
        $hB = "\122\x53\x41" === $TF ? $X1->get_app_config("\x78\x35\60\x39\x5f\143\145\162\x74") : $X1->get_app_config("\143\154\x69\145\x6e\164\137\x73\x65\x63\162\145\164");
        $hZ = $X1->get_app_config("\152\167\153\x73\x75\162\x6c");
        $hh = $hZ ? $S8->verify_from_jwks($hZ) : $S8->verify($hB);
        return !$hh ? $hh : $S8->get_decoded_payload();
    }
    public function get_resource_owner_from_app($j6, $X1)
    {
        $this->app_name = $X1;
        $S8 = new JWTUtils($j6);
        if (!is_wp_error($S8)) {
            goto d00;
        }
        wp_die($S8);
        d00:
        $DV = $this->handle_jwt($S8);
        if (!is_wp_error($DV)) {
            goto I1y;
        }
        wp_die($DV);
        I1y:
        if (!(false === $DV)) {
            goto BKF;
        }
        wp_die("\x46\x61\151\154\145\x64\x20\x74\x6f\40\x76\145\162\x69\x66\171\40\x4a\x57\x54\x20\124\157\153\145\156\56\40\x50\154\145\x61\163\145\x20\x63\x68\145\x63\x6b\40\171\x6f\165\x72\40\x63\157\x6e\146\x69\x67\x75\x72\x61\164\151\x6f\156\x20\x6f\x72\40\x63\157\156\x74\141\x63\x74\x20\x79\157\x75\162\x20\101\x64\x6d\151\156\151\163\x74\x72\x61\x74\x6f\162\x2e");
        BKF:
        return $DV;
    }
}
