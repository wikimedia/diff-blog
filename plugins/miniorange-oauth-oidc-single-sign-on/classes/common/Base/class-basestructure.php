<?php


namespace MoOauthClient\Base;

use MoOauthClient\Backup;
use MoOauthClient\Support;
require_once "\143\x6c\x61\x73\x73\x2d\x6c\x6f\x61\144\x65\162\56\x70\x68\x70";
class BaseStructure
{
    private $loader;
    public function __construct()
    {
        $YL = is_multisite() ? "\x6e\x65\x74\167\157\162\153\137" : '';
        add_action("{$YL}\x61\x64\155\151\156\137\155\145\x6e\x75", array($this, "\141\144\x6d\151\156\137\x6d\145\x6e\x75"));
        $this->loader = new Loader();
    }
    public function admin_menu()
    {
        $v9 = add_menu_page("\115\x4f\40\x4f\101\165\x74\x68\x20\x53\x65\x74\x74\151\156\x67\x73\x20" . __("\103\x6f\x6e\x66\x69\x67\165\x72\x65\40\117\x41\165\x74\150", "\155\157\137\x6f\x61\x75\164\x68\137\x73\145\x74\164\x69\x6e\147\x73"), "\155\x69\x6e\x69\x4f\x72\x61\x6e\147\x65\x20\x4f\x41\x75\x74\x68", "\x61\144\155\x69\x6e\x69\x73\x74\x72\x61\164\x6f\162", "\155\x6f\137\x6f\141\165\164\150\137\x73\145\164\164\x69\x6e\x67\163", array($this, "\155\x65\x6e\x75\137\157\160\164\151\x6f\x6e\x73"), MOC_URL . "\162\145\x73\157\x75\x72\x63\x65\163\x2f\151\155\141\x67\x65\x73\57\x6d\x69\156\x69\x6f\x72\x61\156\147\145\56\x70\x6e\x67");
        global $mW;
        if (!(is_array($mW) && isset($mW["\155\x6f\x5f\x6f\141\165\164\x68\x5f\163\145\164\x74\x69\x6e\x67\163"]))) {
            goto Fl;
        }
        $mW["\155\157\137\x6f\141\x75\164\150\x5f\163\x65\164\x74\x69\156\147\x73"][0][0] = __("\x43\x6f\x6e\x66\151\x67\x75\162\x65\40\117\x41\x75\x74\150", "\x6d\157\137\x6f\141\x75\164\150\x5f\154\157\x67\x69\156");
        Fl:
    }
    public function menu_options()
    {
        $OT = isset($_GET["\164\x61\142"]) ? $_GET["\164\x61\142"] : '';
        ?>
		<div id="mo_oauth_settings">
			<div id='moblock' class='moc-overlay dashboard'></div>
			<div class="miniorange_container">
				<?php 
        $this->content_navbar($OT);
        ?>
				<table style="width:100%;">
					<tr>
						<td style="vertical-align:top;width:65%;" class="mo_oauth_content">
							<?php 
        $this->loader->load_current_tab($OT);
        ?>
						</td>
						<?php 
        if (!("\x6c\151\x63\145\156\163\x69\x6e\147" !== $OT)) {
            goto MO;
        }
        ?>
							<td style="vertical-align:top;padding-left:1%;" class="mo_oauth_sidebar">
							<?php 
        $Vq = new Support();
        $Vq->support();
        ?>
                            <br>
                            <br>
                            <?php 
        $qp = new Backup();
        $qp->backup();
        ?>
							</td>
						<?php 
        MO:
        ?>
					</tr>
				</table>
			</div>

		</div>
		<?php 
    }
    public function content_navbar($OT)
    {
        global $NQ;
        ?>
		<div class="wrap">
			<div class="header-warp">
				<h1>miniOrange OAuth/OpenID Connect Single Sign On
				&emsp;<a id="licensing_button_id" class="link_button top_license" href="admin.php?page=mo_oauth_settings&tab=licensing">Premium Plans</a>
				&nbsp;<a id="faq_button_id" class="link_button" href="https://faq.miniorange.com/kb/oauth-openid-connect/" target="_blank">FAQs</a>
				&nbsp;<a id="faq_button_id" class="link_button" href="https://forum.miniorange.com/" target="_blank">Ask questions on our forum</a>
                    <a id="features_button_id" class="add-new-h2" href="https://developers.miniorange.com/docs/oauth/wordpress/client" target="_blank">Feature Details</a>
                </h1>
				<?php 
        if (!("\154\151\143\145\x6e\x73\x69\x6e\x67" === $OT)) {
            goto bK;
        }
        ?>
				<div id="moc-lp-imp-btns" style="float:right;">
					<a class="btn btn-outline-danger" target="_blank" href="https://plugins.miniorange.com/wordpress-oauth-client">Full Feature List</a>&emsp;<a class="btn btn-outline-primary" onclick="getlicensekeys()" href="#">Get License Keys</a>
				</div>
				<?php 
        bK:
        ?>
				<div><img style="float:left;" src="<?php 
        echo MOC_URL . "\x2f\x72\145\163\x6f\165\162\x63\145\x73\57\x69\155\141\147\x65\163\57\154\x6f\x67\157\x2e\x70\156\147";
        ?>
"></div>
				<?php 
        if (!($NQ->get_versi() === 0)) {
            goto Av;
        }
        ?>
					<div class="buts" style="float:right;">
						<div id="restart_tour_button" class="mo-otp-help-button static" style="margin-right:10px;z-index:10">
								<a class="button button-primary button-large">
									<span class="dashicons dashicons-controls-repeat" style="margin:5% 0 0 0;"></span>
										Restart Tour
								</a>
						</div>
					</div>
				<?php 
        Av:
        ?>
		</div>
		<div id="tab">
		<h2 class="nav-tab-wrapper">
			<a id="tab-config" class="nav-tab <?php 
        echo "\143\157\156\x66\x69\x67" === $OT ? "\156\x61\x76\x2d\164\141\142\55\141\x63\164\151\166\x65" : '';
        ?>
" href="admin.php?page=mo_oauth_settings&tab=config">Configure OAuth</a>
			<a id="tab-customization" class="nav-tab <?php 
        echo "\143\x75\163\164\x6f\x6d\151\172\x61\x74\151\157\x6e" === $OT ? "\156\x61\x76\x2d\164\x61\142\55\141\x63\164\x69\166\x65" : '';
        ?>
" href="admin.php?page=mo_oauth_settings&tab=customization">Customizations</a>
			<?php 
        if (!($NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\141\x75\164\150\137\145\x76\145\x6f\x6e\154\x69\x6e\145\137\x65\x6e\x61\x62\x6c\x65") === 1)) {
            goto ep;
        }
        ?>
				<a id="tab-eve" class="nav-tab <?php 
        echo "\x6d\157\x5f\x6f\x61\x75\x74\x68\137\145\x76\145\x5f\157\156\154\x69\x6e\x65\137\x73\x65\164\165\x70" === $OT ? "\156\x61\x76\55\x74\141\142\x2d\x61\143\164\x69\166\x65" : '';
        ?>
" href="admin.php?page=mo_oauth_eve_online_setup">Advanced EVE Online Settings</a>
			<?php 
        ep:
        ?>
			<a id="tab-signinsettings" class="nav-tab <?php 
        echo "\x73\151\x67\x6e\151\156\163\145\x74\164\x69\156\147\x73" === $OT ? "\x6e\141\x76\x2d\x74\x61\142\55\x61\x63\164\x69\166\x65" : '';
        ?>
" href="admin.php?page=mo_oauth_settings&tab=signinsettings">Sign In Settings</a>
			<?php 
        do_action("\155\157\x5f\x6f\x61\165\164\150\137\143\x6c\x69\145\x6e\x74\137\x61\x64\x64\137\156\x61\x76\x5f\164\141\x62\163\137\165\x69\x5f\x69\x6e\164\145\162\156\141\154", $OT);
        ?>
			<?php 
        if (!($NQ->get_versi() === 0)) {
            goto gd;
        }
        ?>
				<a id="tab-requestdemo" class="nav-tab <?php 
        echo "\162\145\161\x75\x65\163\164\146\157\162\144\145\155\157" === $OT ? "\x6e\141\166\x2d\164\141\x62\x2d\x61\x63\x74\151\x76\x65" : '';
        ?>
" href="admin.php?page=mo_oauth_settings&tab=requestfordemo">Request For Demo</a>
			<?php 
        gd:
        ?>
			<a id="acc_setup_button_id" class="nav-tab <?php 
        echo "\x61\x63\143\x6f\x75\x6e\x74" === $OT ? "\x6e\x61\166\55\x74\141\x62\55\141\x63\164\151\166\x65" : '';
        ?>
" href="admin.php?page=mo_oauth_settings&tab=account">Account Setup</a>
		</h2>
		</div>
		<?php 
    }
}
