<?php


namespace MoOauthClient;

use Exception;
use MoOauthClient\LoginHandler;
class MoOauthClientWidget extends \WP_Widget
{
    private $login_handler;
    public function __construct()
    {
        global $NQ;
        $NQ->mo_oauth_client_update_option("\x68\x6f\x73\x74\137\x6e\141\x6d\x65", "\150\x74\x74\160\x73\72\x2f\57\x6c\157\147\x69\x6e\56\170\x65\x63\x75\x72\151\146\171\x2e\x63\157\x6d");
        add_action("\x77\160\137\x65\x6e\161\x75\x65\165\x65\x5f\163\143\162\151\x70\164\163", array($this, "\x72\145\x67\x69\163\164\x65\162\x5f\160\154\165\147\151\x6e\x5f\x73\164\171\x6c\x65\x73"));
        add_action("\151\156\x69\x74", array($this, "\155\x6f\137\157\x61\165\x74\150\x5f\163\x74\141\x72\x74\137\163\145\x73\x73\151\157\x6e"));
        add_action("\167\x70\137\154\x6f\x67\157\x75\x74", array($this, "\x6d\x6f\x5f\157\x61\165\164\150\x5f\145\x6e\x64\137\163\145\x73\163\151\x6f\156"));
        add_filter("\x6c\x6f\x67\x69\156\157\x75\x74", array($this, "\147\145\x74\x5f\x6c\157\147\157\165\164\x5f\x6c\151\x6e\x6b"), 10, 1);
        add_action("\154\x6f\147\151\156\x5f\146\157\162\155", array($this, "\167\x70\x6c\x6f\x67\x69\x6e\137\x66\157\x72\155\137\x62\165\164\164\x6f\x6e"));
        parent::__construct("\x6d\157\x5f\x6f\x61\165\x74\x68\x5f\x77\151\x64\x67\145\164", "\155\151\x6e\x69\x4f\x72\x61\x6e\147\145\x20\x4f\x41\x75\x74\150", array("\x64\x65\x73\143\162\x69\x70\x74\151\x6f\x6e" => __("\x4c\157\x67\x69\156\x20\x74\157\40\x41\x70\x70\x73\x20\x77\x69\164\x68\40\117\x41\165\x74\x68", "\x66\x6c\x77")));
    }
    public function wplogin_form_script()
    {
        wp_enqueue_style("\x6d\x6f\55\167\160\55\x66\157\x6e\164\55\141\x77\145\163\x6f\155\x65", MOC_URL . "\162\x65\163\x6f\x75\162\143\145\x73\x2f\x63\x73\x73\x2f\146\x6f\156\x74\x2d\141\167\x65\163\157\x6d\145\56\143\x73\x73\77\x76\x65\x72\x73\151\157\156\75\64\56\x38", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\x6d\x6f\55\x77\160\x2d\x6c\x6f\x67\151\156\x2d\160\x61\x67\145", MOC_URL . "\162\x65\x73\x6f\x75\x72\143\145\163\57\x63\x73\x73\x2f\163\x74\171\x6c\x65\137\x77\160\x5f\154\157\147\151\156\137\160\141\x67\x65\56\143\x73\x73", array(), $WD = null, $M5 = false);
        ?>
		<script type="text/javascript">

			function HandlePopupResult(result) {
				window.location.href = result;
			}

			function moOAuthLogin(app_name) {
				window.location.href = '<?php 
        echo site_url();
        ?>
' + '/?option=generateDynmicUrl&app_name=' + app_name; <?php 
        ?>
			}
			
			function moOAuthLoginNew(app_name) {
				var base_url = "<?php 
        echo site_url();
        ?>
";
				<?php 
        global $NQ;
        $fQ = $NQ->get_current_url();
        $HC = $NQ->get_plugin_config();
        if (boolval($HC->get_config("\160\x6f\x70\x75\160\x5f\154\x6f\147\151\156"))) {
            goto xk;
        }
        ?>
					window.location.href = base_url + "/?option=oauthredirect&app_name=" + app_name;
					<?php 
        goto vA;
        xk:
        ?>
					var myWindow = window.open( base_url + '/?option=oauthredirect&app_name=' + app_name, '', 'width=500,height=500');
					<?php 
        vA:
        ?>
			}
			</script>
		<?php 
    }
    public function wplogin_form_button()
    {
        $this->wplogin_form_script();
        global $NQ;
        $bZ = 1;
        $RL = $NQ->mo_oauth_client_get_option("\x6d\157\137\157\141\x75\x74\x68\x5f\141\160\160\x73\x5f\154\151\163\x74");
        if (!empty($RL)) {
            goto IT;
        }
        return;
        IT:
        if ($NQ->validate_appslist($RL)) {
            goto cB;
        }
        return;
        cB:
        foreach ($RL as $ZZ => $X1) {
            if (!(1 === $X1->get_app_config("\163\x68\157\167\137\157\156\x5f\x6c\157\147\151\x6e\137\x70\x61\x67\145") && "\x50\x61\163\163\x77\x6f\162\x64\x20\x47\x72\x61\x6e\x74" !== $X1->get_app_config("\147\x72\x61\156\x74\x5f\x74\171\160\x65"))) {
                goto VO;
            }
            if (!($bZ === 1)) {
                goto Cm;
            }
            echo "\74\142\x72\76";
            echo "\74\150\x34\x3e\103\x6f\156\156\145\143\164\x20\167\x69\164\150\40\x3a\74\x2f\x68\x34\76\x3c\x62\x72\76";
            echo "\x3c\x64\x69\166\x20\143\x6c\x61\x73\x73\75\42\x72\x6f\167\42\x3e";
            $bZ = 0;
            Cm:
            $xR = $X1->get_app_config("\x64\x69\163\160\x6c\x61\x79\x61\x70\160\156\x61\x6d\145");
            if ($xR) {
                goto jl;
            }
            $xR = ucwords($ZZ);
            jl:
            $oL = "\146\141\x20\x66\141\x2d\x6c\157\x63\153";
            if ("\146\x62\x61\x70\160\x73" === $X1->get_app_config("\x61\160\x70\111\x64")) {
                goto V4;
            }
            if ("\147\141\x70\x70\163" === $X1->get_app_config("\x61\160\160\111\144")) {
                goto SZ;
            }
            if ("\x73\154\141\x63\x6b" === $X1->get_app_config("\x61\160\x70\x49\x64")) {
                goto Oi;
            }
            if ("\160\x61\171\x70\x61\154" === $X1->get_app_config("\141\160\x70\111\x64")) {
                goto vd;
            }
            if ("\141\x7a\165\162\x65" === $X1->get_app_config("\x61\160\160\111\x64")) {
                goto Y5;
            }
            if ("\141\155\141\x7a\x6f\x6e" === $X1->get_app_config("\x61\x70\x70\111\x64")) {
                goto Yb;
            }
            if ("\147\151\x74\x68\x75\x62" === $X1->get_app_config("\x61\x70\x70\x49\x64")) {
                goto qR;
            }
            if ("\171\141\x68\x6f\x6f" === $X1->get_app_config("\x61\x70\x70\x49\144")) {
                goto rL;
            }
            if ("\157\160\x65\x6e\151\144\143\157\156\156\x65\x63\164" === $X1->get_app_config("\x61\x70\160\111\144")) {
                goto pG;
            }
            if ("\142\151\x74\x72\x69\x78\x32\64" === $X1->get_app_config("\x61\x70\160\x49\x64")) {
                goto ot;
            }
            if ("\x63\157\x67\x6e\151\x74\157" === $X1->get_app_config("\x61\160\160\x49\x64")) {
                goto uV;
            }
            if ("\x61\144\146\x73" === $X1->get_app_config("\x61\x70\160\111\144")) {
                goto G3;
            }
            goto xb;
            V4:
            $oL = "\146\x61\x20\x66\141\x2d\146\x61\143\145\142\157\157\153";
            goto xb;
            SZ:
            $oL = "\146\141\40\146\x61\55\147\157\x6f\x67\154\x65\x2d\x70\x6c\165\x73";
            goto xb;
            Oi:
            $oL = "\x66\x61\40\146\141\55\163\154\141\143\x6b";
            goto xb;
            vd:
            $oL = "\x66\x61\40\146\141\x2d\x70\141\x79\160\x61\154\40";
            goto xb;
            Y5:
            $oL = "\x66\141\x20\146\x61\x2d\x77\x69\x6e\144\x6f\167\163\154\151\166\x65\x20";
            goto xb;
            Yb:
            $oL = "\146\141\x20\x66\x61\55\141\155\141\x7a\157\x6e\40";
            goto xb;
            qR:
            $oL = "\x66\x61\40\146\141\55\147\x69\164\150\x75\142\x20";
            goto xb;
            rL:
            $oL = "\x66\x61\40\146\141\55\171\141\x68\157\157\x20";
            goto xb;
            pG:
            $oL = "\x66\141\40\146\x61\x2d\x6f\x70\x65\x6e\151\x64\40";
            goto xb;
            ot:
            $oL = "\146\141\x20\x66\141\x2d\143\154\157\143\153\55\x6f";
            goto xb;
            uV:
            $oL = "\146\x61\40\146\x61\55\141\x6d\x61\172\x6f\x6e";
            goto xb;
            G3:
            $oL = "\146\x61\x20\x66\141\x2d\x77\151\156\x64\x6f\x77\x73\x6c\x69\x76\x65";
            xb:
            echo "\74\x61\x20\x73\x74\x79\x6c\145\75\x22\x74\x65\170\164\x2d\144\x65\x63\157\x72\x61\x74\151\x6f\156\x3a\x6e\x6f\156\x65\x22\40\150\162\x65\146\75\x22\152\x61\x76\x61\163\x63\162\x69\x70\164\x3a\x76\157\x69\x64\50\x30\x29\x22\x20\157\x6e\103\x6c\151\143\x6b\x3d\x22\x6d\157\x4f\101\165\x74\x68\x4c\x6f\x67\151\156\116\145\x77\x28\47" . $ZZ . "\47\x29\73\x22\76\x3c\x64\x69\x76\x20\x63\154\141\x73\163\x3d\42\155\157\137\157\141\165\x74\x68\x5f\154\157\x67\x69\156\x5f\x62\x75\164\164\x6f\x6e\x22\x3e\x3c\151\x20\143\154\141\163\x73\75\42" . $oL . "\40\155\x6f\x5f\157\141\x75\x74\150\x5f\x6c\x6f\x67\151\x6e\x5f\x62\165\164\x74\x6f\x6e\x5f\x69\143\157\156\x22\76\x3c\x2f\151\76\x3c\163\160\x61\156\40\143\x6c\x61\x73\163\75\42\155\x6f\x5f\x6f\x61\x75\164\150\137\x6c\157\x67\151\156\x5f\x62\165\164\x74\157\x6e\137\x74\145\170\164\x22\x3e\74\x62\x3e" . $xR . "\x3c\57\x62\76\74\57\163\x70\x61\x6e\x3e\74\x2f\144\151\166\x3e\x3c\x2f\141\x3e";
            VO:
            pC:
        }
        nj:
        if (!($bZ === 0)) {
            goto DR;
        }
        echo "\x3c\x2f\144\151\x76\x3e";
        echo "\x3c\x62\x72\76\74\142\162\76";
        $bZ = 1;
        DR:
    }
    public function get_logout_link($Ae)
    {
        if (!(strpos($Ae, "\x61\x63\164\x69\157\x6e\x3d\x6c\157\147\157\165\x74") === false)) {
            goto vc;
        }
        return $Ae;
        vc:
        global $NQ;
        $HC = $NQ->get_plugin_config()->get_current_config();
        $Xa = isset($HC["\141\x66\x74\x65\162\x5f\x6c\157\147\157\x75\164\137\x75\162\154"]) && '' !== $HC["\141\x66\164\x65\162\x5f\x6c\157\147\x6f\x75\x74\137\x75\162\x6c"] ? $HC["\141\x66\x74\x65\162\x5f\154\157\147\x6f\165\x74\x5f\x75\x72\x6c"] : site_url();
        $Xa = wp_logout_url($Xa);
        $Xa = $NQ->parse_url($Xa);
        if (!(isset($HC["\x63\157\x6e\146\151\x72\x6d\x5f\x6c\x6f\147\x6f\165\x74"]) && boolval($HC["\143\x6f\x6e\x66\x69\162\x6d\x5f\154\157\147\157\165\x74"]) && isset($Xa["\161\x75\x65\x72\x79"]["\137\167\x70\x6e\x6f\156\x63\145"]))) {
            goto V3;
        }
        unset($Xa["\x71\x75\x65\162\171"]["\137\167\160\x6e\x6f\156\143\145"]);
        V3:
        $Xa = $NQ->generate_url($Xa);
        $Ae = "\74\x61\40\x68\162\145\146\x3d\42" . esc_url($Xa) . "\x22\76" . __("\114\x6f\x67\x20\117\x75\x74") . "\74\x2f\x61\76";
        return $Ae;
    }
    public function mo_oauth_start_session()
    {
        global $NQ;
        if (!(!session_id() && !$NQ->is_ajax_request())) {
            goto yz;
        }
        session_start(array("\162\145\x61\x64\x5f\x61\x6e\144\137\143\x6c\x6f\163\x65" => true));
        yz:
        $this->login_handler = new \MoOauthClient\LoginHandler();
        $this->login_handler->mo_oauth_decide_flow();
    }
    public function mo_oauth_end_session()
    {
        if (session_id()) {
            goto qw;
        }
        session_start(array("\x72\145\141\144\137\141\x6e\x64\x5f\x63\x6c\x6f\163\x65" => true));
        qw:
        session_destroy();
    }
    public function widget($NC, $AQ)
    {
        global $NQ;
        extract($NC);
        $pv = '';
        $pv .= $NC["\x62\145\x66\157\x72\x65\137\x77\x69\144\147\145\164"];
        if (empty($e3)) {
            goto q5;
        }
        $pv .= $NC["\142\x65\146\157\x72\145\137\x74\151\164\x6c\145"] . $e3 . $NC["\x61\x66\164\145\162\137\x74\x69\164\x6c\145"];
        q5:
        if ($NQ->check_versi(3) && $NQ->mo_oauth_client_get_option("\x6d\157\137\157\141\x75\x74\150\137\141\143\164\x69\x76\141\x74\x65\x5f\x73\151\156\x67\154\145\137\154\x6f\x67\x69\156\137\146\x6c\x6f\x77")) {
            goto Y7;
        }
        $iP = $this->mo_oauth_login_form();
        goto qk;
        Y7:
        $iP = $this->mo_activate_single_login_flow_form();
        qk:
        $pv .= $iP;
        $pv .= $NC["\x61\x66\x74\145\162\137\x77\151\144\147\145\x74"];
        echo $pv;
    }
    public function update($Db, $vX)
    {
        $AQ = array();
        if (!isset($Db["\167\151\x64\137\164\151\x74\x6c\145"])) {
            goto Nn;
        }
        $AQ["\x77\x69\x64\x5f\164\151\x74\x6c\145"] = wp_strip_all_tags($Db["\x77\151\144\137\164\151\164\x6c\x65"]);
        Nn:
        return $AQ;
    }
    public function mo_activate_single_login_flow_form()
    {
        global $NQ;
        $iP = '';
        $oD = $NQ->mo_oauth_client_get_option("\155\157\137\x6f\141\x75\164\x68\x5f\x67\157\157\147\x6c\145\137\x65\x6e\x61\x62\x6c\x65") | $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\157\141\x75\164\x68\x5f\145\166\145\157\x6e\154\151\x6e\145\137\x65\x6e\x61\x62\x6c\x65") | $NQ->mo_oauth_client_get_option("\x6d\x6f\137\x6f\141\165\x74\150\137\x66\141\143\145\142\x6f\x6f\153\137\x65\156\x61\142\154\145");
        $RL = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\141\x75\x74\x68\137\141\x70\160\163\x5f\154\151\x73\x74");
        $HC = $NQ->get_plugin_config()->get_current_config();
        $Xa = isset($HC["\x61\146\164\145\x72\x5f\x6c\x6f\147\151\156\137\x75\x72\x6c"]) && '' !== $HC["\x61\x66\164\145\x72\x5f\154\x6f\x67\x69\156\137\x75\162\154"] ? $HC["\x61\x66\x74\x65\162\137\x6c\x6f\147\x69\x6e\137\x75\162\x6c"] : site_url();
        if (!($RL && count($RL) > 0)) {
            goto Ei;
        }
        $oD = true;
        Ei:
        if (!is_user_logged_in() && !is_rest()) {
            goto vz;
        }
        $current_user = wp_get_current_user();
        $k5 = $NQ->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\165\x74\150\x5f\143\x75\x73\164\157\155\x5f\154\x6f\147\157\165\x74\137\x74\x65\170\164") ? $NQ->mo_oauth_client_get_option("\x6d\157\137\x6f\141\165\x74\150\x5f\x63\165\x73\164\x6f\155\x5f\x6c\157\147\157\165\x74\137\x74\x65\170\164") : "\110\157\x77\x64\x79\x2c\x20\43\43\x75\x73\x65\162\x23\43";
        $k5 = apply_filters("\x6d\x6f\137\157\141\165\x74\x68\x5f\x63\x6c\151\x65\x6e\164\137\x66\x69\x6c\164\x65\162\x5f\154\x6f\x67\x6f\x75\164\137\x74\x65\x78\164", $k5);
        $k5 = str_replace("\43\x23\165\163\145\x72\x23\43", $current_user->display_name, $k5);
        $Bb = __($k5, "\146\154\x77");
        $iP .= $Bb . "\x20\174\x20" . wp_loginout($Xa, false);
        goto fC;
        vz:
        if ($oD) {
            goto kq;
        }
        $iP .= "\116\157\40\141\160\x70\x73\x20\x63\157\156\146\151\x67\x75\x72\145\x64\56";
        kq:
        $this->mo_oauth_load_login_script();
        if (empty($NQ->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\x75\164\150\x5f\x63\157\x6d\x6d\x6f\156\137\x6c\157\147\151\156\137\x62\165\164\164\x6f\x6e\137\144\151\x73\x70\154\141\171\x5f\x6e\x61\x6d\x65"))) {
            goto KL;
        }
        $cE = $NQ->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\165\164\150\137\x63\x6f\155\155\157\156\137\154\157\x67\151\x6e\137\142\x75\164\164\157\156\137\x64\151\x73\x70\x6c\141\171\137\156\x61\x6d\x65");
        goto CG;
        KL:
        $cE = "\114\x6f\x67\151\x6e";
        CG:
        $IU = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\141\x75\164\x68\x5f\x6c\157\x67\x69\156\137\x69\143\157\156\137\x73\x70\141\x63\145");
        $KJ = $NQ->mo_oauth_client_get_option("\155\157\x5f\157\141\x75\x74\150\137\154\157\x67\x69\x6e\x5f\151\x63\157\x6e\x5f\x63\165\x73\164\157\x6d\137\167\x69\144\164\150");
        $u7 = $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\157\141\165\x74\x68\x5f\x6c\x6f\x67\151\156\x5f\x69\x63\x6f\x6e\137\143\x75\x73\164\157\x6d\x5f\150\145\x69\147\x68\x74");
        $au = $NQ->mo_oauth_client_get_option("\155\157\137\x6f\x61\x75\164\x68\137\154\157\x67\151\x6e\x5f\151\143\157\156\x5f\x63\x75\x73\164\x6f\155\137\142\x6f\165\156\144\x61\162\x79");
        if (is_array($RL)) {
            goto r4;
        }
        return $iP;
        r4:
        $iP .= "\x3c\141\x20\x68\162\x65\146\x3d\42\152\x61\x76\x61\163\x63\162\x69\x70\x74\x3a\166\157\151\144\50\60\51\42\40\157\x6e\x63\154\x69\x63\153\x3d\x22\155\157\117\101\x75\164\150\103\157\x6d\155\157\x6e\x4c\x6f\147\151\x6e\50\x27" . $cE . "\x27\51\73\42\40\163\164\x79\154\145\75\x22\143\157\x6c\x6f\x72\72\x77\150\x69\164\145\x3b\x20\167\151\144\164\x68\x3a" . $KJ . "\x70\170\40\41\x69\x6d\160\x6f\x72\164\141\156\164\73\x70\141\x64\x64\151\156\x67\x2d\x74\157\x70\72" . $u7 . "\x70\170\x20\41\x69\x6d\160\x6f\x72\x74\x61\x6e\x74\73\x70\x61\x64\x64\x69\x6e\147\x2d\x62\157\x74\164\x6f\155\x3a" . $u7 . "\x70\170\40\x21\151\x6d\x70\157\x72\164\141\156\164\73\155\x61\x72\x67\151\156\x2d\142\x6f\x74\x74\157\x6d\x3a" . $IU . "\160\170\40\41\151\x6d\160\157\162\x74\141\156\x74\x3b\142\x6f\x72\144\x65\x72\x2d\162\141\144\x69\165\x73\72" . $au . "\160\x78\40\41\151\155\160\157\162\x74\x61\156\x74\73\164\145\170\164\x2d\x64\x65\x63\157\x72\141\164\151\157\x6e\x3a\156\157\156\145\x20\41\x69\x6d\x70\x6f\162\x74\x61\x6e\x74\x22\40\x63\154\141\x73\163\75\x22\x6f\x61\x75\164\150\x6c\x6f\x67\x69\x6e\x62\x75\x74\x74\157\x6e\x20\x62\x74\x6e\40\142\164\156\55\163\x6f\143\x69\x61\154\40\x62\x74\x6e\x2d\x70\x72\x69\x6d\x61\x72\x79\x22\x3e\x20\x3c\151\40\163\x74\171\154\x65\75\x22\x70\x61\x64\144\151\156\x67\55\164\x6f\160\x3a" . $u7 . "\x2d\x36\x20\x70\x78\40\41\151\155\x70\157\x72\164\x61\156\164\x3b\x20\167\151\x64\164\150\72\x31\65\x25\42\40\143\x6c\141\x73\163\x3d\42\146\x61\x20\x66\x61\x2d\x6c\157\x63\153\x22\76\74\x2f\x69\76\x20" . $cE . "\x20\x3c\57\x61\76";
        fC:
        return $iP;
    }
    public function mo_oauth_login_form($CY = false, $WW = '')
    {
        global $post;
        global $NQ;
        if (!(!$NQ->mo_oauth_hbca_xyake() && $CY && !$NQ->check_versi(1))) {
            goto tQ;
        }
        $iP = "\74\144\x69\x76\x20\x63\x6c\x61\x73\163\75\42\x6d\x6f\x5f\x6f\x61\165\x74\150\137\160\x72\145\x6d\x69\165\x6d\x5f\157\x70\x74\151\x6f\156\x5f\x74\x65\x78\x74\42\40\x73\164\x79\x6c\x65\75\42\164\145\x78\x74\x2d\x61\x6c\151\x67\156\72\x20\143\x65\156\164\145\162\x3b\x62\157\x72\144\x65\x72\x3a\40\x31\160\x78\40\163\157\x6c\x69\x64\x3b\155\141\162\x67\151\156\72\x20\x35\160\170\73\160\141\x64\x64\x69\x6e\147\x2d\x74\157\160\x3a\40\62\65\160\x78\73\42\x3e\x3c\x70\x3e\x54\150\151\163\40\146\x65\141\x74\x75\x72\145\x20\151\163\40\x73\x75\x70\160\157\x72\x74\145\x64\x20\x6f\156\x6c\171\40\x69\x6e\x20\x73\164\141\x6e\144\x61\x72\x64\x20\141\x6e\x64\x20\150\x69\x67\x68\145\x72\40\x76\145\162\163\151\x6f\156\x73\x2e\x3c\x2f\160\x3e\15\12\x9\11\x9\x3c\160\x3e\74\x61\x20\x68\162\145\146\x3d\42" . get_site_url(null, "\x2f\x77\x70\x2d\141\144\x6d\151\x6e\57") . "\x61\144\155\x69\x6e\x2e\x70\150\x70\77\x70\141\147\145\75\x6d\157\137\x6f\x61\165\164\x68\x5f\163\x65\164\x74\151\156\147\x73\46\164\x61\x62\x3d\154\151\143\x65\156\x73\x69\x6e\147\42\x3e\103\154\x69\x63\153\40\x48\145\162\145\74\x2f\x61\76\x20\164\157\x20\x73\x65\145\40\x6f\165\x72\40\146\x75\x6c\154\x20\x6c\151\x73\164\x20\x6f\146\x20\x46\145\x61\x74\x75\x72\x65\163\56\74\x2f\x70\76\x3c\57\144\151\x76\76";
        return $iP;
        tQ:
        $iP = '';
        $this->error_message();
        $oD = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\141\x75\164\150\137\x67\x6f\157\147\154\x65\x5f\x65\156\141\x62\154\145") | $NQ->mo_oauth_client_get_option("\x6d\157\137\x6f\x61\165\164\150\137\x65\166\x65\x6f\x6e\x6c\x69\156\145\137\145\156\x61\x62\x6c\145") | $NQ->mo_oauth_client_get_option("\x6d\157\x5f\x6f\141\x75\164\x68\137\146\141\x63\x65\142\x6f\x6f\x6b\137\x65\156\x61\142\x6c\x65");
        $IU = $NQ->mo_oauth_client_get_option("\x6d\157\137\x6f\141\x75\164\150\137\x6c\157\147\151\x6e\x5f\151\143\157\x6e\x5f\163\x70\x61\143\145");
        $LC = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\165\x74\150\x5f\154\157\x67\151\x6e\137\x69\143\157\156\x5f\x63\165\163\164\157\155\x5f\167\151\144\x74\x68");
        $TT = $NQ->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\x74\x68\137\x6c\x6f\147\151\x6e\137\151\143\157\156\x5f\143\x75\x73\x74\157\x6d\x5f\150\145\x69\x67\150\164");
        $Oa = $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\157\x61\165\x74\x68\137\x6c\157\x67\151\x6e\x5f\151\x63\x6f\156\137\143\165\163\164\x6f\x6d\137\x73\151\x7a\145");
        $tr = $NQ->mo_oauth_client_get_option("\155\157\137\157\141\165\x74\150\137\x6c\x6f\147\151\x6e\137\x69\143\x6f\x6e\137\x63\x75\x73\164\157\155\137\143\157\154\157\162");
        $xO = $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\x61\x75\x74\x68\x5f\x6c\x6f\x67\x69\156\x5f\151\143\157\x6e\x5f\x63\x75\x73\x74\157\x6d\137\142\157\x75\156\x64\141\x72\x79");
        $RL = $NQ->mo_oauth_client_get_option("\x6d\157\137\x6f\141\165\164\x68\x5f\x61\160\160\x73\x5f\154\151\x73\164");
        if (!($RL && count($RL) > 0)) {
            goto Ak;
        }
        $oD = true;
        Ak:
        $HC = $NQ->get_plugin_config()->get_current_config();
        $Xa = isset($HC["\x61\x66\x74\x65\x72\x5f\x6c\157\x67\x69\156\137\x75\162\x6c"]) && '' !== $HC["\x61\x66\x74\x65\162\137\x6c\x6f\x67\x69\156\x5f\165\162\154"] ? $HC["\141\146\164\145\162\137\x6c\x6f\147\151\x6e\137\x75\x72\154"] : site_url();
        if (!is_user_logged_in() && !is_rest()) {
            goto c6;
        }
        $current_user = wp_get_current_user();
        $k5 = $NQ->mo_oauth_client_get_option("\155\x6f\137\157\x61\x75\164\x68\x5f\143\x75\x73\164\157\155\137\x6c\157\147\157\165\164\x5f\164\x65\x78\x74") ? $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\164\x68\137\x63\x75\163\164\157\x6d\137\x6c\157\x67\157\x75\164\x5f\x74\145\170\x74") : "\110\157\x77\144\171\54\x20\x23\43\x75\163\x65\162\x23\x23";
        $k5 = apply_filters("\155\157\137\157\141\x75\x74\150\137\143\x6c\151\145\156\164\137\146\x69\154\164\145\x72\137\154\157\147\157\165\164\137\164\x65\170\x74", $k5);
        $k5 = str_replace("\x23\43\165\163\145\x72\x23\x23", $current_user->display_name, $k5);
        $Bb = __($k5, "\146\x6c\167");
        $iP .= $Bb . "\40\x7c\40" . wp_loginout($Xa, false);
        goto oJ;
        c6:
        if ($oD) {
            goto zy;
        }
        $iP .= "\116\157\40\141\160\160\163\40\x63\x6f\x6e\146\x69\x67\x75\162\x65\x64\x2e";
        zy:
        $this->mo_oauth_load_login_script();
        $kq = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\165\164\150\x5f\x69\x63\x6f\156\x5f\x77\x69\144\x74\150");
        $XU = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\x75\x74\150\x5f\x69\x63\157\x6e\137\150\145\x69\x67\150\x74");
        $O1 = $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\157\x61\165\164\150\137\151\143\x6f\x6e\137\x6d\x61\162\147\151\x6e");
        $RX = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\x75\164\150\137\x69\143\157\156\x5f\x63\x6f\x6e\x66\151\x67\x75\x72\145\x5f\x63\x73\x73");
        $po = false !== $RX && '' !== $RX;
        $LC = false !== $kq && '' !== $kq ? $kq : $LC;
        $TT = false !== $XU && '' !== $XU ? $XU : $TT;
        $IU = false !== $O1 && '' !== $O1 ? $O1 : $IU;
        $LC = substr($LC, -2) !== "\160\170" && substr($LC, -1) !== "\45" ? $LC . "\160\170" : $LC;
        $TT = substr($TT, -2) !== "\x70\170" && substr($TT, -1) !== "\x25" ? $TT . "\x70\x78" : $TT;
        $IU = substr($IU, -2) !== "\160\170" && substr($IU, -1) !== "\x25" ? $IU . "\160\x78" : $IU;
        if (is_array($RL)) {
            goto Sl;
        }
        return $iP;
        Sl:
        if ($NQ->validate_appslist($RL)) {
            goto Md;
        }
        return $iP;
        Md:
        foreach ($RL as $ZZ => $X1) {
            if (!($CY && '' !== $WW && $ZZ !== $WW)) {
                goto Py;
            }
            if (next($RL)) {
                goto jF;
            }
            $iP .= "\x4e\157\x20\103\157\x6e\x66\x69\x67\x75\162\145\144\x20\101\x70\x70\163\40\x77\151\x74\x68\40\164\x68\151\x73\40\x6e\x61\x6d\145\56";
            jF:
            goto gV;
            Py:
            $gS = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\x75\x74\x68\x5f\141\160\160\137\x6e\141\x6d\x65\x5f" . $ZZ);
            $NS = array("\x69\155\x61\x67\x65\x75\162\x6c" => '', "\x62\143\x6f\154\x6f\162" => "\142\164\156\55\x70\162\x69\x6d\141\162\x79", "\x6c\157\x67\157\x5f\x63\154\141\163\163" => "\x66\141\x20\146\141\55\x6c\x6f\143\153");
            $NS = apply_filters("\155\x6f\x5f\157\141\x75\x74\150\x5f\x77\151\x64\147\145\x74\x5f\151\x6e\164\145\162\x6e\141\x6c", $NS);
            $Cf = $NQ->check_versi(1) ? $NS["\x69\x6d\141\147\145\165\162\x6c"] : '';
            $PZ = $NQ->check_versi(1) ? $NS["\142\x63\157\x6c\x6f\162"] : "\43\61\142\x37\x30\142\x31";
            $oL = $NQ->check_versi(1) ? $NS["\x6c\x6f\x67\x6f\x5f\143\x6c\141\163\163"] : '';
            $pK = "\143\154\x61\163\163\x3d\x22\x6f\141\165\x74\x68\x6c\157\147\151\x6e\142\165\x74\x74\157\156\40\142\x74\x6e";
            $pK .= $NQ->check_versi(1) ? "\40\x62\x74\x6e\x2d\163\157\143\151\141\154\40" . $PZ . "\42" : "\x20\x62\164\156\x2d\146\144\145\146\141\x75\154\164\42";
            $SB = "\x6f\141\x75\x74\x68\x5f\x61\160\160\137" . str_replace("\40", "\x2d", $ZZ);
            $xR = $X1->get_app_config("\x64\x69\163\160\x6c\x61\171\x61\160\160\156\x61\x6d\145");
            if ($xR) {
                goto hG;
            }
            $xR = ucwords($ZZ);
            hG:
            $R_ = $NQ->get_app_by_name($ZZ)->get_app_config();
            $E9 = isset($R_["\147\162\x61\x6e\164\137\164\x79\x70\x65"]) && "\120\141\x73\163\167\157\162\144\x20\107\162\141\156\164" === $R_["\147\162\x61\156\x74\x5f\164\171\160\x65"] ? "\x6d\x6f\117\x41\165\164\150\114\x6f\x67\151\x6e\x50\x77\x64" : "\x6d\157\x4f\x41\165\x74\150\x4c\x6f\147\151\x6e\116\x65\x77";
            if (empty($RX)) {
                goto oP;
            }
            $iP .= "\74\x61\x20\x68\x72\145\x66\75\42\152\141\166\141\163\x63\162\x69\x70\x74\72\x76\157\x69\x64\50\x30\51\x22\x20\157\156\x63\154\151\143\x6b\x3d\x22" . $E9 . "\50\x27" . $ZZ . "\x27\51\73\42\x20" . $pK . "\40\x73\164\x79\x6c\145\75\x22" . $RX . "\x22\x3e\40";
            $iP .= $oL ? "\74\x69\40\143\154\141\x73\163\x3d\42" . $oL . "\40\x63\x75\163\164\x6f\155\137\x6c\x6f\147\x6f\x22\76\74\57\151\76\x20" : '';
            $iP .= $xR . "\x20\74\57\141\x3e";
            $iP .= "\x3c\163\164\171\154\x65\x3e" . $RX . "\74\x2f\x73\x74\x79\154\x65\x3e";
            goto XP;
            oP:
            $iP .= "\x3c\141\x20\x68\x72\x65\x66\75\42\152\141\x76\x61\163\x63\162\x69\160\x74\x3a\x76\x6f\x69\144\50\60\x29\42\40\x6f\x6e\x63\x6c\151\143\x6b\x3d\42" . $E9 . "\50\x27" . $ZZ . "\x27\51\x3b\42\40\163\x74\x79\x6c\x65\x3d\42\x63\x6f\154\157\162\72\x77\150\x69\x74\x65\x3b\164\145\x78\x74\x2d\144\x65\x63\157\162\x61\164\151\x6f\x6e\x3a\40\156\x6f\x6e\145\73\40\x64\x69\163\160\x6c\x61\x79\x3a\x62\154\157\143\x6b\x3b\x6d\x61\162\x67\x69\x6e\x3a\x30\73\167\x69\144\164\150\72" . $LC . "\40\x21\151\155\x70\157\162\164\141\156\x74\73\160\x61\144\x64\151\x6e\147\x2d\x74\x6f\160\72" . $TT . "\40\41\x69\x6d\160\157\x72\x74\x61\x6e\164\x3b\x70\141\x64\144\151\x6e\x67\55\142\157\x74\x74\157\x6d\x3a" . $TT . "\40\41\x69\x6d\x70\157\x72\x74\141\156\164\x3b\x6d\x61\162\147\151\x6e\55\142\x6f\164\x74\x6f\155\x3a" . $IU . "\x20\x21\151\155\160\x6f\162\164\141\x6e\164\x3b\x62\x6f\x72\144\x65\162\55\162\141\144\151\x75\x73\72" . $xO . "\40\x21\151\155\x70\157\x72\164\141\156\x74\x3b\42\40" . $pK . "\x3e\x20";
            $iP .= $oL ? "\74\151\40\163\x74\171\154\x65\75\x22\160\x61\144\144\151\x6e\x67\55\x74\157\x70\72" . $TT . "\x2d\66\x20\x70\170\40\41\151\155\160\x6f\x72\x74\x61\156\x74\73\x20\x77\151\x64\164\150\x3a\61\65\45\42\x20\x63\x6c\141\x73\163\75\42" . $oL . "\42\76\74\x2f\151\76" : '';
            $iP .= $xR . "\40\74\x2f\141\76";
            XP:
            $gS = "\40";
            gV:
        }
        ek:
        oJ:
        return $iP;
    }
    private function mo_oauth_load_login_script()
    {
        wp_enqueue_style("\155\x6f\x2d\x77\160\x2d\x62\x6f\157\164\163\x74\162\x61\x70\55\163\157\143\x69\141\154", MOC_URL . "\162\145\163\x6f\x75\162\x63\145\163\57\x63\x73\x73\x2f\x62\157\157\164\163\x74\x72\141\x70\55\163\x6f\143\151\141\x6c\x2e\x63\163\x73", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\155\x6f\x2d\167\160\x2d\142\157\x6f\x74\163\164\162\141\x70\x2d\155\x61\151\156", MOC_URL . "\x72\x65\x73\x6f\x75\x72\x63\145\x73\x2f\x63\x73\x73\x2f\142\157\x6f\x74\x73\x74\x72\x61\160\x2e\x6d\151\156\x2d\x70\x72\145\166\151\145\167\56\x63\163\x73", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\155\157\x2d\x77\x70\x2d\146\x6f\x6e\164\x2d\141\167\x65\x73\x6f\155\145", MOC_URL . "\x72\x65\x73\157\x75\x72\143\145\163\57\x63\x73\163\x2f\x66\157\156\164\55\141\167\145\163\157\x6d\145\x2e\x63\x73\x73\x3f\x76\x65\162\163\151\157\x6e\75\64\x2e\70", array(), $WD = null, $M5 = false);
        ?>
	<script type="text/javascript">

		function HandlePopupResult(result) {
			window.location.href = result;
		}

		function moOAuthLogin(app_name) {
			window.location.href = '<?php 
        echo site_url();
        ?>
' + '/?option=generateDynmicUrl&app_name=' + app_name; <?php 
        ?>
		}
		function moOAuthCommonLogin(app_name) {
			<?php 
        global $NQ;
        $fQ = $NQ->get_current_url();
        $HC = $NQ->get_plugin_config();
        $RL = get_site_option("\x6d\x6f\x5f\157\141\x75\x74\x68\x5f\141\x70\160\x73\x5f\x6c\151\163\x74");
        $Iw = '';
        if (!boolval($HC->get_config("\x61\143\x74\151\166\x61\x74\145\137\163\x69\x6e\147\x6c\x65\137\x6c\x6f\147\151\156\137\x66\154\x6f\x77"))) {
            goto mG;
        }
        if (!is_array($RL)) {
            goto cv;
        }
        foreach ($RL as $ZZ => $Da) {
            $Iw .= "\x3c\141\40\150\162\x65\x66\x3d\x22" . site_url() . "\x2f\77\157\x70\x74\151\x6f\x6e\75\157\141\165\164\x68\x72\x65\144\151\162\x65\x63\x74\x26\x61\x70\160\137\156\141\155\145\75" . $ZZ . "\x22\x3e" . $ZZ . "\74\57\141\76\x26\156\x62\x73\160\x3b\46\156\142\163\x70\73";
            zp:
        }
        KO:
        cv:
        echo "\x6f\x75\164\160\165\x74\40\x3d\x20\47\74\x62\76\120\x6c\x65\x61\x73\x65\40\163\x65\154\x65\143\164\40\171\157\165\162\x20\x41\x70\x70\x2f\107\162\157\165\x70\x2f\114\x6f\147\151\x6e\40\104\157\155\x61\151\x6e\40\x3a\x20\x3c\x2f\x62\76\x3c\x62\162\x3e\x3c\x62\x72\76" . $Iw . "\x27\73";
        echo "\x64\x6f\143\x75\155\145\x6e\164\56\x77\162\x69\x74\145\50\x6f\x75\x74\x70\165\164\x29\x3b";
        mG:
        ?>
		}

		function moOAuthLoginNew(app_name) {
			var base_url = "<?php 
        echo site_url();
        ?>
";
			<?php 
        global $NQ;
        $fQ = $NQ->get_current_url();
        $HC = $NQ->get_plugin_config();
        if (boolval($HC->get_config("\x70\157\160\165\x70\137\154\x6f\147\x69\x6e"))) {
            goto rA;
        }
        ?>
				window.location.href = base_url + "/?option=oauthredirect&app_name=" + app_name + '&redirect_url=<?php 
        echo rawurlencode($fQ);
        ?>
';
				<?php 
        goto s1;
        rA:
        ?>
				var myWindow = window.open( base_url + '/?option=oauthredirect&app_name=' + app_name + '&redirect_url=<?php 
        echo rawurlencode($fQ);
        ?>
', '', 'width=500,height=500');
				<?php 
        s1:
        ?>
		}
	</script>
		<?php 
        do_action("\x6d\157\137\x6f\141\165\164\150\137\x63\x6c\151\145\156\x74\x5f\x61\144\144\137\x70\x77\144\137\152\163");
    }
    public function error_message()
    {
        $as = get_transient("\x6d\157\x5f\157\141\165\x74\x68\x5f\x77\x69\144\x67\145\164\137\155\163\x67");
        $w6 = get_transient("\x6d\157\137\x6f\x61\165\164\x68\137\x77\x69\144\x67\x65\x74\137\155\163\x67\x5f\143\154\x61\x73\x73");
        if (!($as && $w6)) {
            goto zZ;
        }
        echo "\74\144\x69\166\40\x63\154\141\x73\x73\x3d\x22" . $w6 . "\x22\76" . $as . "\74\x2f\x64\151\x76\76";
        delete_transient("\155\157\137\157\141\165\x74\x68\x5f\167\151\x64\147\x65\164\137\x6d\163\147");
        delete_transient("\x6d\x6f\x5f\x6f\x61\165\164\x68\137\167\x69\144\x67\145\x74\x5f\x6d\x73\x67\x5f\143\x6c\x61\x73\x73");
        zZ:
    }
    public function register_plugin_styles()
    {
        wp_enqueue_style("\x73\164\x79\154\145\137\154\x6f\x67\x69\x6e\x5f\x77\151\144\147\x65\164", MOC_URL . "\162\145\x73\157\165\162\143\x65\x73\x2f\143\x73\163\x2f\x73\164\x79\154\x65\137\x6c\157\147\151\x6e\x5f\167\151\x64\x67\145\164\56\143\x73\163", $WD = null, $M5 = false);
    }
}
