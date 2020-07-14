<?php


namespace MoOauthClient;

use MoOauthClient\Base\InstanceHelper;
use MoOauthClient\OauthHandler;
use MoOauthClient\StorageManager;
class LoginHandler
{
    public $oauth_handler;
    public function __construct()
    {
        $this->oauth_handler = new OauthHandler();
        add_action("\x69\x6e\151\164", array($this, "\155\x6f\137\157\141\165\x74\x68\x5f\x64\145\x63\x69\x64\x65\x5f\146\x6c\157\167"));
        add_action("\155\x6f\x5f\157\141\x75\x74\x68\137\x63\154\151\145\156\x74\x5f\x74\151\x67\x68\164\137\x6c\x6f\x67\151\156\137\151\x6e\x74\145\x72\x6e\x61\x6c", array($this, "\x68\141\x6e\x64\x6c\145\x5f\x73\163\157"), 10, 4);
    }
    public function mo_oauth_decide_flow()
    {
        global $NQ;
        if (!(isset($_REQUEST[\MoOAuthConstants::OPTION]) && "\164\x65\163\x74\x61\164\x74\162\x6d\x61\160\x70\x69\156\x67\x63\157\x6e\146\151\147" === $_REQUEST[\MoOAuthConstants::OPTION])) {
            goto MH;
        }
        $bL = $_REQUEST["\x61\x70\x70"];
        wp_safe_redirect(site_url() . "\x3f\x6f\x70\x74\x69\157\x6e\x3d\x6f\x61\165\x74\x68\x72\145\144\x69\x72\145\143\164\46\x61\160\x70\x5f\x6e\141\155\x65\x3d" . rawurlencode($bL) . "\x26\164\145\x73\x74\75\x74\x72\165\145");
        die;
        MH:
        $this->mo_oauth_login_validate();
    }
    public function mo_oauth_login_validate()
    {
        global $NQ;
        $Wf = new StorageManager();
        if (!(isset($_REQUEST[\MoOAuthConstants::OPTION]) and strpos($_REQUEST[\MoOAuthConstants::OPTION], "\157\x61\165\x74\150\x72\145\144\151\162\x65\143\x74") !== false)) {
            goto NV;
        }
        if (!(isset($_REQUEST["\x72\x65\163\x6f\165\162\x63\x65"]) && !empty($_REQUEST["\x72\x65\x73\x6f\165\x72\143\x65"]))) {
            goto cL;
        }
        if (!empty($_REQUEST["\162\145\x73\157\165\x72\x63\145"])) {
            goto EC;
        }
        wp_die(wp_kses("\124\150\x65\40\162\x65\163\x70\157\156\163\145\x20\x66\162\157\155\x20\x75\x73\145\x72\151\x6e\146\157\40\x77\x61\x73\x20\145\155\160\164\x79\56", \get_valid_html()));
        EC:
        $Wf = new StorageManager(urldecode($_REQUEST["\162\145\163\157\x75\x72\143\x65"]));
        $DV = $Wf->get_value("\162\x65\163\x6f\165\162\143\x65");
        $zk = $Wf->get_value("\x61\160\160\156\141\155\x65");
        $XS = $Wf->get_value("\162\x65\x64\151\162\145\143\164\137\x75\x72\151");
        $FA = $Wf->get_value("\141\x63\x63\x65\163\163\137\164\157\153\x65\x6e");
        $R_ = $NQ->get_app_by_name($zk)->get_app_config();
        $Xt = isset($_REQUEST["\164\x65\163\164"]) && !empty($_REQUEST["\164\x65\x73\164"]);
        if (!($Xt && '' !== $Xt)) {
            goto FZ;
        }
        $this->handle_group_test_conf($DV, $R_, $FA, false, $Xt);
        die;
        FZ:
        $Wf->remove_key("\162\x65\x73\157\165\162\x63\145");
        $Wf->add_replace_entry("\x70\x6f\x70\165\x70", "\151\x67\x6e\157\162\x65");
        $this->handle_sso($zk, $R_, $DV, $Wf->get_state(), array("\x61\x63\143\145\x73\163\x5f\164\x6f\x6b\x65\156" => $FA));
        cL:
        $K_ = $_REQUEST["\x61\160\x70\x5f\156\x61\x6d\145"];
        $RL = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\141\x75\x74\x68\x5f\141\x70\160\x73\x5f\x6c\x69\163\x74");
        $no = isset($_REQUEST["\162\145\x64\151\162\x65\143\x74\137\165\x72\154"]) ? urldecode($_REQUEST["\162\145\x64\151\162\x65\x63\164\137\165\x72\x6c"]) : site_url();
        $Xt = isset($_REQUEST["\164\145\163\164"]) ? urldecode($_REQUEST["\164\145\163\x74"]) : false;
        $Nq = isset($_REQUEST["\x72\145\163\164\162\x69\x63\164\162\x65\144\151\x72\x65\x63\164"]) ? urldecode($_REQUEST["\x72\145\x73\164\x72\x69\x63\x74\162\x65\x64\x69\x72\x65\143\164"]) : false;
        $X1 = $NQ->get_app_by_name($K_);
        $d_ = $X1->get_app_config("\x67\x72\141\156\164\137\x74\171\x70\145");
        if (!is_multisite()) {
            goto J1;
        }
        $blog_id = get_current_blog_id();
        $Wf->add_replace_entry("\x62\154\x6f\x67\x5f\x69\x64", $blog_id);
        J1:
        if (!($d_ && "\120\141\x73\163\x77\x6f\162\144\x20\107\162\141\156\x74" === $d_)) {
            goto U0;
        }
        do_action("\160\x77\x64\137\145\x73\163\145\156\x74\151\141\154\x73\137\x69\x6e\x74\145\x72\x6e\x61\x6c");
        do_action("\155\157\137\157\141\165\164\x68\137\x63\x6c\x69\145\x6e\164\x5f\141\x64\144\137\x70\167\x64\137\152\x73");
        ?>
				<script>
					var mo_oauth_app_name = "<?php 
        echo wp_kses($K_, \get_valid_html());
        ?>
";
					document.addEventListener('DOMContentLoaded', function() {
						<?php 
        if ($Xt) {
            goto zq;
        }
        ?>
							moOAuthLoginPwd(mo_oauth_app_name, false, '<?php 
        echo $no;
        ?>
');
						<?php 
        goto He;
        zq:
        ?>
							moOAuthLoginPwd(mo_oauth_app_name, true, '<?php 
        echo $no;
        ?>
');
						<?php 
        He:
        ?>
					}, false);
				</script>
				<?php 
        die;
        U0:
        $Wf->add_replace_entry("\x61\x70\160\156\141\155\x65", $K_);
        $Wf->add_replace_entry("\x72\x65\x64\151\162\145\x63\164\137\165\x72\x69", $no);
        $Wf->add_replace_entry("\x74\145\x73\x74\x5f\143\157\156\146\x69\147", $Xt);
        $Wf->add_replace_entry("\x72\x65\163\x74\162\x69\x63\x74\x72\x65\144\151\x72\145\x63\x74", $Nq);
        $G1 = $Wf->get_state();
        $G1 = apply_filters("\163\164\141\164\x65\x5f\151\x6e\164\145\x72\156\141\154", $G1);
        $Yh = $X1->get_app_config("\x61\165\164\150\157\162\x69\x7a\145\165\162\154");
        if (!(strpos($Yh, "\147\x6f\x6f\x67\x6c\145") !== false)) {
            goto hb;
        }
        $Yh = "\x68\164\x74\160\163\x3a\57\57\141\x63\x63\157\165\x6e\164\x73\x2e\147\x6f\x6f\147\x6c\x65\x2e\143\157\155\57\157\57\157\x61\165\x74\x68\62\57\141\x75\164\150";
        hb:
        $mh = $X1->get_app_config("\160\153\143\145\137\146\x6c\157\167");
        $XS = $X1->get_app_config("\x72\x65\144\151\162\x65\x63\164\137\165\x72\151");
        $XS = empty($XS) ? \site_url() : $XS;
        if ($mh && 1 === $mh) {
            goto N4;
        }
        if (strpos($Yh, "\x3f") !== false) {
            goto St;
        }
        $Yh = $Yh . "\77\143\154\151\x65\x6e\x74\137\151\144\x3d" . urlencode($X1->get_app_config("\143\154\x69\145\156\x74\137\151\x64")) . "\x26\x73\143\x6f\x70\145\75" . $X1->get_app_config("\x73\x63\x6f\160\145") . "\46\162\x65\x64\151\162\x65\x63\x74\x5f\x75\x72\151\x3d" . urlencode($XS) . "\x26\162\145\x73\160\x6f\x6e\163\145\x5f\x74\x79\160\x65\75\x63\157\x64\145\46\x73\164\141\x74\x65\x3d" . $G1;
        goto PW;
        St:
        $Yh = $Yh . "\46\x63\154\x69\145\x6e\164\x5f\151\x64\x3d" . urlencode($X1->get_app_config("\143\154\x69\x65\x6e\164\137\x69\x64")) . "\x26\x73\143\157\160\145\x3d" . $X1->get_app_config("\163\x63\x6f\x70\x65") . "\x26\x72\145\144\x69\x72\145\x63\x74\137\165\x72\x69\75" . urlencode($XS) . "\x26\x72\x65\163\160\x6f\156\x73\145\x5f\164\x79\x70\x65\x3d\x63\x6f\144\x65\46\x73\x74\141\164\x65\75" . $G1;
        PW:
        goto B3;
        N4:
        $cu = bin2hex(openssl_random_pseudo_bytes(32));
        $X0 = $NQ->base64url_encode(pack("\110\52", $cu));
        $kI = $NQ->base64url_encode(pack("\110\x2a", hash("\163\150\141\x32\65\x36", $X0)));
        $Wf->add_replace_entry("\x63\x6f\x64\x65\x5f\166\145\x72\151\146\151\x65\x72", $X0);
        $G1 = $Wf->get_state();
        if (strpos($Yh, "\77") !== false) {
            goto Bb;
        }
        $Yh = $Yh . "\77\x63\x6c\151\x65\156\164\x5f\x69\144\75" . urlencode($X1->get_app_config("\x63\154\151\145\156\x74\x5f\x69\x64")) . "\x26\x73\x63\x6f\x70\145\75" . $X1->get_app_config("\163\x63\x6f\160\x65") . "\46\x72\145\x64\151\x72\145\143\164\x5f\165\x72\x69\75" . urlencode($XS) . "\46\162\x65\163\160\x6f\156\163\x65\137\164\171\x70\145\75\x63\x6f\x64\x65\46\163\164\x61\164\x65\x3d" . $G1 . "\46\x63\x6f\x64\x65\137\143\x68\141\x6c\x6c\145\x6e\147\145\75" . $kI . "\x26\x63\157\144\145\x5f\x63\x68\141\x6c\154\145\x6e\x67\145\x5f\155\x65\164\x68\157\x64\75\123\x32\x35\66";
        goto mt;
        Bb:
        $Yh = $Yh . "\46\143\x6c\151\145\x6e\x74\x5f\x69\144\x3d" . urlencode($X1->get_app_config("\x63\x6c\x69\145\x6e\164\137\151\144")) . "\x26\163\143\x6f\160\x65\75" . $X1->get_app_config("\x73\143\157\160\145") . "\x26\x72\x65\144\x69\x72\x65\x63\164\x5f\165\x72\x69\75" . urlencode($XS) . "\x26\x72\x65\163\x70\x6f\156\x73\145\x5f\x74\171\x70\145\75\143\x6f\144\x65\x26\x73\x74\141\x74\145\75" . $G1 . "\46\x63\157\x64\x65\x5f\x63\x68\x61\154\154\145\156\147\x65\75" . $kI . "\46\x63\157\x64\145\137\143\150\x61\x6c\154\145\156\x67\x65\x5f\155\x65\x74\x68\x6f\x64\x3d\123\62\x35\66";
        mt:
        B3:
        if (!(session_id() === '' || !isset($_SESSION))) {
            goto aR;
        }
        session_start(array("\x72\x65\141\x64\x5f\x61\x6e\x64\x5f\x63\x6c\x6f\x73\x65" => true));
        aR:
        $Yh = apply_filters("\155\157\137\x61\x75\164\150\x5f\165\162\154\137\x69\x6e\x74\x65\x72\156\141\154", $Yh, $K_);
        header("\x4c\x6f\x63\x61\164\x69\157\x6e\x3a\x20" . $Yh);
        die;
        NV:
        if (!(strpos($_SERVER["\x52\x45\x51\x55\x45\x53\x54\137\x55\122\111"], "\x2f\x6f\141\x75\x74\150\143\x61\x6c\x6c\x62\x61\143\153") !== false || isset($_GET["\x63\157\144\x65"]))) {
            goto Gg;
        }
        try {
            $G1 = isset($_GET["\x73\164\141\164\x65"]) ? wp_unslash($_GET["\163\164\141\x74\x65"]) : false;
            if (!empty($G1)) {
                goto Gl;
            }
            wp_die(wp_kses("\x54\x68\145\40\x73\164\141\x74\145\40\160\141\x72\x61\x6d\x65\164\145\x72\40\151\163\40\145\155\160\164\171\x2e", \get_valid_html()));
            Gl:
            $Wf = new StorageManager($G1);
            $K_ = $Wf->get_value("\x61\x70\x70\x6e\x61\x6d\145");
            $Xt = $Wf->get_value("\x74\145\x73\164\137\143\x6f\156\x66\151\147");
            $zk = $K_ ? $K_ : '';
            $RL = $NQ->mo_oauth_client_get_option("\155\157\137\x6f\141\165\x74\x68\x5f\x61\160\x70\x73\x5f\154\x69\163\x74");
            $lo = '';
            $EB = '';
            $Rz = $NQ->get_app_by_name($zk);
            if ($Rz) {
                goto yx;
            }
            die("\x41\160\x70\x6c\x69\x63\x61\164\x69\x6f\156\40\156\157\164\40\143\x6f\156\x66\151\x67\165\162\x65\x64\56");
            yx:
            $R_ = $Rz->get_app_config();
            $mh = $Rz->get_app_config("\x70\153\143\145\x5f\146\154\157\x77");
            $NC = array("\147\162\141\x6e\164\137\x74\171\x70\x65" => "\141\165\x74\150\157\162\151\x7a\x61\164\x69\x6f\156\x5f\x63\157\144\145", "\143\154\x69\145\x6e\x74\x5f\151\144" => $R_["\x63\x6c\151\x65\x6e\164\137\151\x64"], "\x72\145\144\151\162\x65\x63\x74\137\x75\x72\151" => $R_["\x72\x65\x64\151\x72\145\x63\x74\137\165\x72\151"], "\x63\157\x64\145" => $_GET["\143\157\x64\145"], "\163\x63\x6f\x70\145" => $Rz->get_app_config("\x73\143\x6f\x70\x65"));
            if ($mh && 1 === $mh) {
                goto Eu;
            }
            $NC["\143\x6c\x69\145\x6e\x74\x5f\163\145\x63\x72\x65\164"] = $R_["\x63\154\x69\x65\156\164\x5f\163\x65\143\162\145\x74"];
            goto rQ;
            Eu:
            $NC["\143\157\x64\x65\x5f\166\145\162\x69\x66\x69\x65\x72"] = $Wf->get_value("\143\157\144\145\137\166\x65\162\151\146\151\x65\162");
            rQ:
            $gk = isset($R_["\x73\x65\x6e\x64\x5f\150\x65\x61\144\x65\162\x73"]) ? $R_["\x73\145\x6e\144\x5f\x68\145\x61\144\x65\x72\163"] : 0;
            $dP = isset($R_["\163\145\x6e\x64\137\x62\157\x64\x79"]) ? $R_["\x73\x65\156\144\x5f\x62\x6f\x64\x79"] : 0;
            if ("\157\160\145\156\151\144\x63\x6f\x6e\156\145\143\x74" === $Rz->get_app_config("\x61\160\x70\137\x74\171\160\x65")) {
                goto e3;
            }
            $y9 = $R_["\x61\x63\143\x65\163\163\x74\157\x6b\145\x6e\165\x72\x6c"];
            if (!(strpos($y9, "\x67\157\157\x67\154\x65") !== false)) {
                goto uB;
            }
            $y9 = "\x68\x74\x74\160\x73\72\57\x2f\x77\167\x77\x2e\x67\157\x6f\147\154\x65\141\x70\x69\x73\x2e\143\157\155\x2f\x6f\x61\x75\x74\x68\62\57\166\x34\x2f\x74\157\153\145\156";
            uB:
            $fk = json_decode($this->oauth_handler->get_token($y9, $NC, $gk, $dP), true);
            if (isset($fk["\x61\x63\143\x65\163\x73\137\x74\x6f\x6b\x65\x6e"])) {
                goto K7;
            }
            die("\111\156\x76\x61\x6c\x69\x64\40\x74\157\x6b\145\x6e\40\x72\x65\143\145\x69\x76\x65\x64\x2e");
            K7:
            $pl = $R_["\162\145\x73\157\x75\162\143\x65\x6f\x77\156\145\x72\x64\x65\164\x61\x69\154\163\x75\162\x6c"];
            if (!(substr($pl, -1) === "\75")) {
                goto KH;
            }
            $pl .= $fk["\141\143\x63\145\163\x73\x5f\x74\157\153\145\156"];
            KH:
            if (!(strpos($pl, "\147\x6f\x6f\x67\154\x65") !== false)) {
                goto I0;
            }
            $pl = "\x68\x74\x74\x70\163\72\57\x2f\167\x77\x77\56\x67\157\x6f\x67\154\x65\141\160\x69\x73\x2e\x63\x6f\155\x2f\x6f\x61\x75\164\150\62\x2f\x76\61\x2f\x75\163\145\x72\x69\x6e\x66\x6f";
            I0:
            $DV = $this->oauth_handler->get_resource_owner($pl, $fk["\x61\x63\143\145\x73\163\x5f\164\x6f\153\x65\156"]);
            $iP = array();
            $F_ = $this->dropdownattrmapping('', $DV, $iP);
            $NQ->mo_oauth_client_update_option("\155\157\137\x6f\141\x75\x74\150\x5f\141\x74\x74\162\x5f\156\x61\155\x65\x5f\154\x69\163\164" . $zk, $F_);
            if (!($Xt && '' !== $Xt)) {
                goto fg;
            }
            $this->handle_group_test_conf($DV, $R_, $fk["\141\143\x63\145\x73\163\x5f\164\157\153\145\x6e"], false, $Xt);
            die;
            fg:
            goto Ul;
            e3:
            $fk = json_decode($this->oauth_handler->get_token($R_["\x61\x63\x63\145\x73\x73\164\157\x6b\x65\156\x75\x72\154"], $NC, $gk, $dP), true);
            $U_ = array();
            try {
                $U_ = $this->resolve_and_get_oidc_response($fk);
            } catch (\Exception $hq) {
                wp_die("\x49\156\166\x61\x6c\151\x64\40\122\145\x73\160\157\x6e\163\145\x20\162\145\143\x65\151\x76\x65\x64\56");
                die;
            }
            $DV = $this->get_resource_owner_from_app($U_, $zk);
            $iP = array();
            $F_ = $this->dropdownattrmapping('', $DV, $iP);
            $NQ->mo_oauth_client_update_option("\155\x6f\x5f\x6f\141\165\164\150\137\x61\x74\x74\162\137\156\x61\155\x65\x5f\154\x69\x73\x74" . $zk, $F_);
            if (!($Xt && '' !== $Xt)) {
                goto xu;
            }
            $this->handle_group_test_conf($DV, $R_, $fk, false, $Xt);
            die;
            xu:
            Ul:
            $this->handle_sso($zk, $R_, $DV, $G1, $fk);
        } catch (Exception $hq) {
            die(esc_html($hq->getMessage()));
        }
        Gg:
    }
    public function dropdownattrmapping($NP, $dO, $iP)
    {
        global $NQ;
        foreach ($dO as $ZZ => $uN) {
            if (is_array($uN)) {
                goto ib;
            }
            if (!empty($NP)) {
                goto fX;
            }
            array_push($iP, $ZZ);
            goto X4;
            fX:
            array_push($iP, $NP . "\x2e" . $ZZ);
            X4:
            goto C4;
            ib:
            if (empty($NP)) {
                goto wn;
            }
            $NP .= "\56";
            wn:
            $iP = $this->dropdownattrmapping($NP . $ZZ, $uN, $iP);
            $NP = rtrim($NP, "\x2e");
            C4:
            xP:
        }
        kg:
        return $iP;
    }
    public function resolve_and_get_oidc_response($fk = array())
    {
        if (!empty($fk)) {
            goto Qe;
        }
        throw new \Exception("\x54\157\153\x65\x6e\x20\x72\145\x73\160\157\x6e\163\x65\40\151\x73\x20\x65\155\160\164\x79", "\x69\x6e\x76\x61\x6c\x69\x64\137\162\145\x73\160\157\x6e\x73\145");
        Qe:
        global $NQ;
        $j6 = isset($fk["\151\144\x5f\x74\x6f\x6b\145\156"]) ? $fk["\151\x64\x5f\164\x6f\x6b\145\x6e"] : false;
        $FA = isset($fk["\141\x63\x63\x65\163\163\137\x74\x6f\153\145\x6e"]) ? $fk["\141\x63\143\145\163\163\x5f\x74\x6f\x6b\x65\x6e"] : false;
        if (!$NQ->is_valid_jwt($j6)) {
            goto TU;
        }
        return $j6;
        TU:
        if (!$NQ->is_valid_jwt($FA)) {
            goto XF;
        }
        return $FA;
        XF:
        throw new \Exception("\x54\157\x6b\145\156\x20\x69\x73\40\156\x6f\x74\x20\141\x20\166\141\x6c\x69\144\40\112\x57\x54\x2e");
    }
    public function handle_group_test_conf($DV = array(), $R_ = array(), $FA = '', $Nm = false, $Xt = false)
    {
        $this->render_test_config_output($DV, false);
    }
    public function testattrmappingconfig($NP, $dO)
    {
        foreach ($dO as $ZZ => $uN) {
            if (is_array($uN) || is_object($uN)) {
                goto bD;
            }
            echo "\74\x74\162\76\74\164\144\x3e";
            if (empty($NP)) {
                goto J2;
            }
            echo $NP . "\56";
            J2:
            echo $ZZ . "\x3c\57\x74\144\76\74\x74\x64\76" . $uN . "\74\x2f\x74\144\76\74\57\164\162\76";
            goto M5;
            bD:
            if (empty($NP)) {
                goto F8;
            }
            $NP .= "\x2e";
            F8:
            $this->testattrmappingconfig($NP . $ZZ, $uN);
            $NP = rtrim($NP, "\56");
            M5:
            CC:
        }
        vv:
    }
    public function render_test_config_output($DV, $Nm = false)
    {
        echo "\74\x64\x69\x76\x20\x73\x74\x79\154\145\75\42\x66\157\156\x74\x2d\x66\141\x6d\151\154\x79\x3a\103\141\x6c\x69\x62\162\x69\73\160\x61\144\x64\151\x6e\x67\x3a\x30\40\63\45\73\42\76";
        echo "\x3c\x73\x74\x79\154\x65\76\x74\141\x62\154\145\173\x62\x6f\x72\144\x65\x72\55\143\157\154\154\x61\x70\x73\145\x3a\x63\157\154\154\141\160\x73\145\73\175\x74\150\40\173\142\141\x63\153\x67\x72\157\x75\x6e\x64\x2d\143\x6f\x6c\x6f\162\x3a\40\43\145\145\145\73\x20\x74\x65\x78\164\x2d\141\x6c\x69\x67\x6e\x3a\x20\143\145\156\x74\x65\162\73\x20\x70\x61\144\144\x69\156\147\72\x20\x38\160\170\x3b\40\142\157\162\144\145\162\55\x77\x69\144\x74\150\72\x31\160\x78\73\x20\x62\157\162\144\x65\x72\55\x73\x74\x79\x6c\x65\x3a\x73\157\154\151\x64\73\40\x62\x6f\162\144\145\162\x2d\x63\x6f\154\157\162\72\43\62\61\x32\x31\x32\x31\x3b\175\x74\162\72\156\x74\150\55\143\x68\151\x6c\144\50\157\x64\144\x29\40\173\142\x61\x63\153\x67\162\x6f\165\156\144\x2d\x63\x6f\x6c\157\x72\72\x20\43\x66\62\146\x32\x66\62\x3b\175\40\x74\x64\x7b\160\141\x64\x64\x69\x6e\x67\72\70\x70\170\73\x62\157\162\x64\145\x72\x2d\x77\151\x64\x74\x68\x3a\61\x70\x78\x3b\40\x62\x6f\162\144\145\x72\x2d\163\164\x79\x6c\145\72\163\157\154\x69\144\x3b\x20\x62\157\162\x64\x65\x72\55\x63\157\154\x6f\x72\72\x23\x32\x31\62\x31\x32\61\x3b\x7d\x3c\57\163\164\171\154\145\x3e";
        echo "\x3c\150\x32\x3e";
        echo $Nm ? "\107\162\x6f\x75\x70\40\111\x6e\x66\157" : "\124\145\x73\164\40\x43\157\156\x66\x69\x67\x75\x72\141\x74\x69\x6f\156";
        echo "\74\57\x68\62\76\x3c\164\141\x62\x6c\x65\x3e\74\x74\162\76\x3c\164\150\76\101\164\164\162\151\x62\165\164\x65\40\116\x61\155\x65\x3c\57\164\x68\76\74\164\150\76\x41\x74\x74\x72\151\x62\x75\164\145\40\x56\141\x6c\x75\145\x3c\57\164\150\x3e\74\57\164\162\76";
        $this->testattrmappingconfig('', $DV);
        echo "\74\57\164\x61\142\154\x65\x3e";
        if ($Nm) {
            goto k3;
        }
        echo "\74\x64\x69\x76\x20\163\164\171\x6c\145\x3d\x22\x70\141\x64\144\x69\x6e\147\72\40\x31\x30\160\170\73\42\x3e\74\57\x64\x69\x76\x3e\74\x69\x6e\x70\x75\x74\40\x73\x74\x79\154\145\x3d\x22\x70\x61\x64\x64\151\156\x67\72\61\x25\x3b\167\x69\x64\x74\x68\x3a\x31\x30\x30\x70\x78\x3b\142\x61\x63\153\x67\162\157\165\156\144\x3a\40\43\60\x30\71\x31\103\x44\x20\x6e\157\156\x65\40\162\145\160\145\141\164\40\x73\143\x72\x6f\x6c\x6c\x20\x30\x25\40\60\x25\x3b\143\165\162\163\157\x72\72\40\x70\157\151\x6e\x74\x65\x72\73\146\157\156\x74\x2d\163\x69\172\x65\72\x31\65\x70\x78\73\x62\157\x72\144\x65\x72\55\x77\x69\144\164\150\x3a\x20\x31\160\x78\x3b\x62\157\162\144\x65\x72\x2d\163\164\171\154\145\72\40\163\x6f\x6c\x69\x64\73\x62\157\162\x64\145\x72\55\x72\141\144\x69\165\x73\72\x20\x33\160\x78\x3b\x77\150\151\164\x65\x2d\x73\160\x61\x63\145\x3a\40\156\x6f\x77\x72\x61\x70\x3b\x62\157\170\55\x73\151\x7a\151\156\147\72\x20\x62\157\162\x64\145\162\x2d\x62\157\170\73\142\157\162\144\145\162\x2d\x63\x6f\x6c\157\x72\x3a\40\x23\60\x30\67\63\101\101\73\142\x6f\170\55\x73\150\x61\144\157\167\x3a\x20\60\x70\x78\40\61\160\170\40\60\x70\x78\x20\162\x67\x62\141\50\61\x32\60\54\x20\62\x30\x30\x2c\x20\x32\63\x30\x2c\40\x30\56\x36\x29\40\151\156\x73\x65\164\x3b\143\157\x6c\157\162\x3a\x20\x23\x46\x46\x46\x3b\x22\x74\x79\x70\145\75\x22\x62\x75\164\164\157\156\x22\x20\x76\x61\x6c\165\145\75\x22\x44\x6f\x6e\145\42\x20\x6f\156\103\x6c\x69\143\x6b\x3d\42\x73\145\154\146\x2e\x63\x6c\x6f\x73\x65\50\51\73\42\76\74\57\144\x69\x76\76";
        k3:
    }
    public function handle_sso($zk, $R_, $DV, $G1, $fk, $sf = false)
    {
        global $NQ;
        if (!(get_class($this) === "\x4d\157\117\x61\x75\164\x68\x43\x6c\x69\x65\156\164\134\x4c\x6f\x67\151\156\110\141\x6e\x64\x6c\145\162" && $NQ->check_versi(1))) {
            goto aU;
        }
        $s6 = new \MoOauthClient\Base\InstanceHelper();
        $xg = $s6->get_login_handler_instance();
        $xg->handle_sso($zk, $R_, $DV, $G1, $fk, $sf);
        aU:
        $lo = isset($R_["\156\x61\x6d\x65\137\x61\x74\164\x72"]) ? $R_["\156\x61\155\x65\137\x61\x74\x74\162"] : '';
        $EB = isset($R_["\145\155\x61\x69\154\x5f\141\164\164\162"]) ? $R_["\145\155\141\151\x6c\137\x61\164\164\x72"] : '';
        $yY = $NQ->getnestedattribute($DV, $EB);
        $jd = $NQ->getnestedattribute($DV, $lo);
        if (!empty($yY)) {
            goto z4;
        }
        wp_die("\105\155\141\x69\154\x20\x61\144\x64\x72\x65\x73\x73\40\x6e\x6f\164\40\x72\x65\143\x65\x69\166\x65\x64\x2e\x20\103\150\x65\143\153\40\171\x6f\x75\x72\x20\74\x73\x74\162\x6f\x6e\x67\x3e\101\164\x74\x72\x69\142\165\164\145\40\x4d\x61\x70\160\151\x6e\x67\74\x2f\163\x74\162\157\x6e\x67\x3e\x20\143\157\x6e\x66\151\x67\165\x72\141\x74\151\x6f\156\x2e");
        z4:
        if (!(false === strpos($yY, "\100"))) {
            goto U8;
        }
        wp_die("\115\141\160\160\x65\144\x20\x45\155\x61\151\x6c\40\141\x74\164\162\151\142\165\164\145\x20\x64\157\x65\x73\40\156\157\x74\40\143\x6f\156\x74\x61\151\156\x20\166\141\x6c\151\x64\x20\145\155\x61\151\x6c\56");
        U8:
        $user = get_user_by("\x6c\x6f\x67\151\156", $yY);
        if ($user) {
            goto Gp;
        }
        $user = get_user_by("\145\x6d\x61\x69\x6c", $yY);
        Gp:
        if ($user) {
            goto yk;
        }
        $ZN = 0;
        if ($NQ->mo_oauth_hbca_xyake()) {
            goto Q3;
        }
        $user = $NQ->mo_oauth_hjsguh_kiishuyauh878gs($yY, $jd);
        goto Rr;
        Q3:
        if ($NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\141\165\x74\x68\x5f\x66\x6c\141\x67") !== true) {
            goto jI;
        }
        wp_die(base64_decode("\120\107\122\x70\144\x69\x42\x7a\x64\x48\x6c\x73\x5a\124\60\x6e\144\x47\x56\64\x64\x43\x31\150\142\x47\x6c\x6e\x62\152\160\152\x5a\127\65\x30\132\130\x49\x37\112\x7a\x34\x38\x59\152\x35\126\143\x32\x56\171\111\105\x46\152\x59\62\71\61\142\x6e\x51\147\x5a\x47\x39\x6c\x63\171\x42\165\x62\63\121\147\132\130\150\160\143\63\121\x75\x50\103\71\x69\x50\x6a\167\166\132\x47\154\62\x50\152\170\151\143\x6a\x34\x38\143\62\x31\x68\x62\107\167\x2b\126\107\150\160\143\x79\x42\62\x5a\x58\x4a\172\x61\x57\x39\x75\x49\110\x4e\61\143\x48\102\166\x63\x6e\x52\x7a\111\105\x46\61\x64\x47\70\x67\121\63\x4a\154\x59\x58\x52\x6c\111\x46\126\172\x5a\130\111\147\x5a\155\126\x68\x64\110\126\171\132\x53\x42\61\143\110\x52\166\x49\104\x45\x77\111\106\126\x7a\132\130\112\x7a\x4c\x69\x42\x51\x62\x47\x56\x68\x63\x32\125\147\144\x58\102\x6e\143\x6d\106\x6b\x5a\123\x42\60\142\171\x42\60\x61\x47\x55\x67\141\107\x6c\156\141\x47\x56\171\x49\x48\x5a\x6c\x63\x6e\116\160\142\62\64\x67\142\x32\131\147\144\107\x68\154\111\x48\102\163\144\127\x64\160\x62\x69\102\x30\x62\x79\102\154\x62\x6d\106\151\142\x47\x55\147\131\x58\126\60\142\x79\102\x6a\143\155\x56\x68\144\x47\x55\x67\x64\x58\x4e\x6c\x63\x69\102\155\x62\x33\x49\x67\x64\127\65\163\141\x57\61\160\144\107\x56\153\x49\x48\126\172\132\130\x4a\172\111\x47\71\171\x49\107\x46\153\x5a\x43\102\x31\143\x32\x56\171\x49\x47\x31\x68\x62\x6e\126\x68\x62\107\x78\x35\114\x6a\x77\166\143\62\x31\150\x62\x47\167\53"));
        goto d7;
        jI:
        $user = $NQ->mo_oauth_jhuyn_jgsukaj($yY, $jd);
        d7:
        Rr:
        goto Hg;
        yk:
        $ZN = $user->ID;
        Hg:
        if (!$user) {
            goto VJ;
        }
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        $user = get_user_by("\x49\x44", $user->ID);
        do_action("\167\x70\x5f\x6c\157\147\151\156", $user->user_login, $user);
        wp_safe_redirect(home_url());
        die;
        VJ:
    }
    public function get_resource_owner_from_app($j6, $UB)
    {
        return $this->oauth_handler->get_resource_owner_from_id_token($j6);
    }
}
