<?php


namespace MoOauthClient\Base;

use MoOauthClient\Licensing;
use MoOauthClient\Base\InstanceHelper;
class Loader
{
    private $instance_helper;
    public function __construct()
    {
        add_action("\x61\x64\155\151\x6e\x5f\145\156\x71\x75\145\x75\x65\x5f\163\x63\162\x69\x70\x74\163", array($this, "\160\x6c\x75\147\x69\156\137\x73\145\164\164\x69\x6e\147\x73\137\x73\164\171\x6c\145"));
        add_action("\141\x64\155\x69\x6e\x5f\145\156\x71\x75\x65\165\145\137\163\143\x72\151\160\x74\x73", array($this, "\x70\x6c\165\x67\x69\156\x5f\x73\145\164\x74\151\156\147\163\137\x73\x63\x72\151\x70\x74"));
        $this->instance_helper = new InstanceHelper();
    }
    public function plugin_settings_style()
    {
        wp_enqueue_style("\x6d\x6f\x5f\x6f\141\x75\164\150\x5f\141\144\155\151\156\x5f\163\145\x74\164\151\x6e\x67\163\x5f\163\164\x79\x6c\x65", MOC_URL . "\162\145\163\157\165\x72\143\145\x73\57\x63\x73\x73\57\163\164\171\154\145\137\x73\145\x74\164\x69\156\x67\x73\x2e\x63\x73\163", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\x6d\157\137\157\141\x75\164\x68\137\x61\x64\155\x69\156\137\163\x65\164\x74\x69\156\x67\x73\137\x70\150\x6f\156\145\137\x73\x74\171\x6c\x65", MOC_URL . "\162\x65\x73\157\165\x72\x63\x65\163\57\143\163\x73\57\160\150\x6f\x6e\145\x2e\143\x73\163", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\x6d\x6f\137\157\141\165\164\x68\137\x61\144\155\151\x6e\x5f\x73\145\x74\x74\x69\156\147\x73\137\144\141\164\141\x74\141\x62\154\x65", MOC_URL . "\x72\x65\x73\157\165\162\143\145\x73\57\x63\x73\163\x2f\x6a\161\165\145\x72\171\x2e\x64\x61\x74\x61\124\x61\x62\x6c\145\163\56\155\x69\x6e\56\x63\x73\163", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\x6d\157\x2d\167\x70\x2d\142\x6f\157\164\x73\164\162\141\x70\55\x73\157\143\151\x61\x6c", MOC_URL . "\x72\145\x73\157\x75\x72\x63\x65\x73\57\x63\x73\163\x2f\142\x6f\x6f\x74\x73\164\162\x61\x70\55\x73\157\x63\x69\x61\x6c\x2e\143\163\x73", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\x6d\157\x2d\x77\x70\x2d\x62\157\157\164\163\x74\x72\x61\160\x2d\x6d\x61\151\156", MOC_URL . "\x72\x65\163\x6f\x75\x72\143\x65\x73\57\143\x73\x73\x2f\142\x6f\157\x74\163\x74\x72\141\160\56\155\151\156\x2d\x70\x72\145\166\151\x65\167\x2e\x63\x73\163", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\155\157\x2d\167\x70\55\146\157\x6e\x74\55\141\x77\x65\x73\x6f\x6d\145", MOC_URL . "\162\x65\163\157\165\162\x63\x65\163\57\143\163\163\57\146\157\x6e\x74\55\141\x77\x65\163\157\x6d\x65\56\155\151\156\x2e\x63\x73\x73\x3f\166\145\162\x73\151\x6f\x6e\x3d\x34\x2e\70", array(), $WD = null, $M5 = false);
        wp_enqueue_style("\x6d\x6f\55\167\x70\x2d\x66\157\156\164\55\x61\167\x65\x73\157\x6d\145", MOC_URL . "\162\145\x73\157\165\x72\x63\x65\x73\x2f\x63\x73\163\57\146\x6f\x6e\164\55\141\x77\145\163\157\155\145\56\143\x73\x73\77\x76\145\162\x73\151\x6f\x6e\75\x34\56\x38", array(), $WD = null, $M5 = false);
        if (!(isset($_REQUEST["\x74\x61\x62"]) && "\x6c\x69\143\x65\x6e\x73\151\156\x67" === $_REQUEST["\164\141\x62"])) {
            goto MI;
        }
        wp_enqueue_style("\155\157\137\x6f\x61\165\x74\x68\137\142\157\157\164\x73\x74\x72\141\160\x5f\143\163\x73", MOC_URL . "\162\145\x73\x6f\x75\162\143\x65\x73\57\x63\x73\163\x2f\142\157\x6f\x74\163\x74\x72\141\x70\x2f\x62\157\157\x74\x73\164\x72\141\160\56\155\151\x6e\56\143\x73\163", array(), $WD = null, $M5 = false);
        MI:
    }
    public function plugin_settings_script()
    {
        wp_enqueue_script("\x6d\157\137\157\141\x75\x74\150\x5f\x61\144\155\151\156\x5f\163\145\x74\x74\151\156\x67\x73\x5f\x73\x63\162\151\x70\164", MOC_URL . "\x72\145\x73\157\x75\162\143\145\163\57\x6a\163\57\163\145\x74\x74\151\156\147\163\x2e\152\163", array(), $WD = null, $M5 = false);
        wp_enqueue_script("\x6d\157\137\157\x61\x75\164\x68\x5f\141\144\x6d\x69\x6e\137\163\145\164\164\x69\x6e\147\x73\x5f\160\150\157\156\145\137\x73\x63\x72\151\x70\x74", MOC_URL . "\162\145\x73\x6f\165\x72\143\145\x73\57\152\163\57\160\x68\x6f\156\145\x2e\x6a\x73", array(), $WD = null, $M5 = false);
        wp_enqueue_script("\155\x6f\137\157\x61\165\x74\x68\137\141\144\x6d\151\156\137\163\x65\x74\x74\151\x6e\147\163\137\144\141\164\141\x74\141\142\154\145", MOC_URL . "\162\x65\163\157\x75\x72\x63\145\163\57\x6a\x73\x2f\x6a\161\x75\x65\162\171\56\x64\x61\164\x61\124\141\142\x6c\x65\163\56\155\x69\156\x2e\152\x73", array(), $WD = null, $M5 = false);
        if (!(isset($_REQUEST["\x74\141\x62"]) && "\x6c\151\143\x65\156\x73\151\x6e\x67" === $_REQUEST["\164\141\142"])) {
            goto ld;
        }
        wp_enqueue_script("\155\157\137\x6f\x61\x75\164\150\x5f\x6d\157\x64\x65\x72\156\x69\x7a\162\x5f\163\x63\x72\151\160\x74", MOC_URL . "\x72\x65\x73\x6f\165\x72\143\x65\163\x2f\152\x73\x2f\155\157\144\145\162\x6e\x69\172\x72\x2e\152\x73", array(), $WD = null, $M5 = true);
        wp_enqueue_script("\x6d\x6f\137\x6f\x61\x75\x74\150\137\x70\157\160\157\x76\145\162\x5f\163\x63\x72\x69\160\x74", MOC_URL . "\162\x65\163\x6f\165\x72\143\x65\x73\x2f\x6a\163\x2f\x62\157\x6f\164\x73\x74\162\141\x70\x2f\x70\157\x70\x70\x65\162\x2e\155\x69\x6e\56\x6a\163", array(), $WD = null, $M5 = true);
        wp_enqueue_script("\155\157\137\x6f\x61\x75\164\150\137\x62\157\x6f\x74\163\164\x72\141\160\137\163\143\162\151\160\x74", MOC_URL . "\162\x65\x73\x6f\x75\x72\x63\x65\x73\x2f\152\163\x2f\142\157\x6f\x74\163\164\162\x61\160\57\x62\x6f\x6f\164\x73\164\162\141\x70\x2e\x6d\x69\156\56\x6a\163", array(), $WD = null, $M5 = true);
        ld:
    }
    public function load_current_tab($OT)
    {
        global $NQ;
        $T_ = 0 === $NQ->get_versi();
        $p1 = false;
        if ($T_) {
            goto Ds;
        }
        $p1 = $NQ->mo_oauth_client_get_option("\155\x6f\137\157\141\x75\164\x68\x5f\x63\154\x69\x65\156\x74\x5f\x6c\157\x61\144\x5f\141\x6e\141\154\x79\164\151\x63\x73");
        $p1 = boolval($p1) ? boolval($p1) : false;
        $T_ = $NQ->check_versi(1) && $NQ->mo_oauth_is_clv();
        Ds:
        if ("\141\x63\143\157\x75\156\164" === $OT || !$T_) {
            goto Qc;
        }
        if ("\143\x75\x73\164\157\x6d\151\x7a\141\x74\151\x6f\156" === $OT && $T_) {
            goto Pm;
        }
        if ("\163\151\147\156\151\156\x73\145\x74\x74\151\x6e\147\163" === $OT && $T_) {
            goto Cq;
        }
        if ($p1 && "\141\x6e\x61\154\x79\x74\x69\143\x73" === $OT && $T_) {
            goto w7;
        }
        if ("\154\x69\143\145\x6e\163\x69\x6e\147" === $OT) {
            goto Fc;
        }
        if ("\x72\145\x71\x75\145\163\x74\146\157\x72\x64\x65\x6d\157" === $OT && $T_) {
            goto Jv;
        }
        if (empty($OT) && $T_) {
            goto IB;
        }
        $this->instance_helper->get_clientappui_instance()->render_free_ui();
        goto L0;
        Qc:
        $gn = $this->instance_helper->get_accounts_instance();
        if ($NQ->mo_oauth_client_get_option("\x76\x65\162\151\x66\x79\137\x63\165\163\164\x6f\x6d\x65\x72") === "\x74\x72\165\145") {
            goto jz;
        }
        if (trim($NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\141\x75\x74\x68\x5f\141\144\x6d\x69\x6e\x5f\145\x6d\x61\x69\x6c")) !== '' && trim($NQ->mo_oauth_client_get_option("\x6d\157\x5f\x6f\141\x75\x74\x68\x5f\141\144\155\x69\156\x5f\141\x70\x69\x5f\153\145\x79")) === '' && $NQ->mo_oauth_client_get_option("\156\x65\167\x5f\x72\145\x67\x69\x73\164\x72\x61\x74\x69\x6f\156") !== "\164\x72\x75\145") {
            goto Of;
        }
        if (!$NQ->mo_oauth_is_clv() && $NQ->check_versi(1) && $NQ->mo_oauth_is_customer_registered()) {
            goto sH;
        }
        $gn->register();
        goto Rj;
        jz:
        $gn->verify_password_ui();
        goto Rj;
        Of:
        $gn->verify_password_ui();
        goto Rj;
        sH:
        $gn->mo_oauth_lp();
        Rj:
        goto L0;
        Pm:
        $this->instance_helper->get_customization_instance()->render_free_ui();
        goto L0;
        Cq:
        $this->instance_helper->get_sign_in_settings_instance()->render_free_ui();
        goto L0;
        w7:
        $this->instance_helper->get_user_analytics()->render_ui();
        goto L0;
        Fc:
        (new Licensing())->show_licensing_page();
        goto L0;
        Jv:
        $this->instance_helper->get_requestdemo_instance()->render_free_ui();
        goto L0;
        IB:
        ?>
					<a id="goregister" style="display:none;" href="<?php 
        echo add_query_arg(array("\164\141\x62" => "\x63\157\x6e\x66\x69\147"), htmlentities($_SERVER["\x52\x45\x51\x55\105\123\x54\137\x55\122\111"]));
        ?>
">

					<script>
						location.href = jQuery('#goregister').attr('href');
					</script>
				<?php 
        L0:
    }
}
