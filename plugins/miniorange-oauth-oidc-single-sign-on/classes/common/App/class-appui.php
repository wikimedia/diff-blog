<?php


namespace MoOauthClient;

use MoOauthClient\App;
use MoOauthClient\App\UpdateAppUI;
class AppUI
{
    private $app_config;
    private $apps_list;
    public function __construct()
    {
        $this->app_config = array("\143\154\151\x65\156\164\137\151\x64", "\143\154\151\145\156\x74\x5f\163\x65\x63\162\x65\x74", "\163\x63\x6f\160\145", "\x72\145\x64\x69\162\x65\x63\x74\137\x75\x72\151", "\x61\x70\x70\x5f\164\171\x70\145", "\141\165\x74\150\x6f\162\151\x7a\x65\165\162\x6c", "\x61\143\143\145\x73\x73\x74\157\x6b\x65\156\165\x72\154", "\x72\145\163\x6f\165\162\x63\x65\x6f\167\156\x65\162\x64\145\x74\x61\x69\154\x73\x75\x72\x6c", "\147\x72\x6f\x75\160\x64\x65\164\141\x69\x6c\163\165\x72\x6c", "\x6a\167\x6b\x73\x5f\x75\x72\x69", "\144\x69\163\160\x6c\x61\171\x61\160\160\x6e\x61\155\x65", "\141\160\160\111\144");
        self::populate_appslist();
    }
    public function get_apps_list()
    {
        return $this->apps_list;
    }
    public function set_apps_list($RL)
    {
        global $NQ;
        $this->apps_list = $RL;
        $NQ->mo_oauth_client_update_option("\155\157\137\157\x61\165\x74\150\x5f\141\160\x70\163\x5f\x6c\151\163\x74", $RL);
    }
    public function delete_app($K_)
    {
        global $NQ;
        $RL = $this->apps_list;
        $no = admin_url("\141\x64\155\x69\156\56\x70\x68\x70\77\x70\x61\x67\145\75\155\x6f\137\x6f\x61\165\164\x68\137\x73\x65\164\164\151\156\x67\x73");
        if (!($RL && count($RL) > 0)) {
            goto cz;
        }
        foreach ($RL as $ZZ => $X1) {
            if (!($K_ === $ZZ)) {
                goto jA;
            }
            unset($RL[$ZZ]);
            if (!("\x65\x76\x65\x6f\x6e\x6c\151\156\x65" === $K_)) {
                goto Uk;
            }
            $NQ->mo_oauth_client_update_option("\155\157\x5f\157\141\165\164\150\137\145\x76\x65\157\x6e\x6c\151\156\145\x5f\145\x6e\x61\142\154\x65", 0);
            Uk:
            jA:
            uu:
        }
        kD:
        $this->set_apps_list($RL);
        cz:
        echo "\x3c\x73\x74\162\x6f\156\147\x3e\x50\x6c\x65\x61\x73\x65\x20\x57\141\151\164\x2e\x2e\56\x3c\x2f\163\164\162\x6f\x6e\x67\x3e";
        ?>
		<script>
			window.onload = function() {
				window.location.href = "<?php 
        echo $no;
        ?>
";
			}
		</script>
		<?php 
        die;
    }
    public function get_app_by_name($K_)
    {
        global $NQ;
        $RL = $NQ->mo_oauth_client_get_option("\155\157\137\x6f\x61\x75\164\x68\x5f\141\x70\x70\163\x5f\x6c\151\x73\164") ? $NQ->mo_oauth_client_get_option("\x6d\x6f\137\157\141\165\x74\150\x5f\141\160\x70\163\x5f\x6c\151\163\x74") : false;
        if ($RL) {
            goto Lj;
        }
        return false;
        Lj:
        foreach ($RL as $ZZ => $X1) {
            if (!($K_ === $ZZ)) {
                goto a0;
            }
            return $X1;
            a0:
            yF:
        }
        fq:
        return false;
    }
    private function populate_appslist()
    {
        global $NQ;
        $RL = $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\157\141\165\x74\150\137\141\x70\160\x73\137\x6c\x69\x73\164") ? $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\165\164\x68\x5f\141\x70\x70\163\137\154\x69\163\x74") : array();
        if (!(is_array($RL) && 0 < count($RL))) {
            goto WU;
        }
        foreach ($RL as $ZZ => $Da) {
            if (is_array($Da) && !empty($Da)) {
                goto hA;
            }
            $this->apps_list[$ZZ] = $Da;
            goto b6;
            hA:
            if (!(!isset($Da["\143\x6c\151\145\156\164\137\151\x64"]) || empty($Da["\x63\154\x69\145\x6e\164\137\151\144"]))) {
                goto mq;
            }
            $Da["\x63\x6c\x69\145\x6e\164\x5f\151\144"] = isset($Da["\x63\154\151\145\x6e\164\x69\144"]) ? $Da["\x63\154\x69\145\x6e\164\151\144"] : '';
            mq:
            if (!(!isset($Da["\143\x6c\x69\x65\x6e\x74\137\163\145\x63\x72\x65\164"]) || empty($Da["\x63\x6c\151\x65\156\x74\x5f\163\145\x63\x72\x65\x74"]))) {
                goto aF;
            }
            $Da["\x63\x6c\151\145\156\164\x5f\163\x65\x63\x72\x65\164"] = isset($Da["\x63\154\x69\145\x6e\x74\163\x65\143\x72\145\x74"]) ? $Da["\143\154\151\x65\156\164\163\145\x63\162\x65\x74"] : '';
            aF:
            unset($Da["\x63\x6c\151\x65\x6e\164\151\x64"]);
            unset($Da["\x63\154\151\145\x6e\164\x73\145\x63\x72\145\x74"]);
            $X1 = new App();
            $X1->migrate_app($Da, $ZZ);
            $this->apps_list[$ZZ] = $X1;
            b6:
            AM:
        }
        xy:
        WU:
        $NQ->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\x75\164\150\137\141\x70\160\x73\137\154\151\x73\164", $this->apps_list);
    }
    private function show_default_apps()
    {
        wp_enqueue_script("\155\157\x5f\157\x61\165\x74\150\137\141\144\155\x69\x6e\137\x61\160\x70\137\x73\x65\x61\x72\x63\x68\x5f\x73\143\x72\151\x70\164", MOC_URL . "\x72\145\x73\157\x75\162\x63\x65\x73\57\141\160\x70\137\x63\x6f\155\160\x6f\156\x65\x6e\x74\x73\x2f\163\x65\x61\x72\x63\x68\137\141\x70\160\x73\56\x6a\163", array(), $WD = null, $M5 = true);
        ?>
	<input type="text" id="mo_oauth_client_default_apps_input" onkeyup="mo_oauth_client_default_apps_input_filter()" placeholder="Select application" title="Type in a Application Name">
	<h3>OAuth Providers</h3>
	<hr />
	<ul id="mo_oauth_client_default_apps">
		<?php 
        $qJ = file_get_contents(MOC_DIR . "\x72\145\163\x6f\165\162\143\145\163\57\141\x70\160\x5f\x63\157\155\160\x6f\x6e\145\156\x74\163\57\144\x65\146\141\x75\x6c\x74\141\160\160\163\x2e\x6a\163\x6f\x6e", true);
        $I6 = json_decode($qJ);
        foreach ($I6 as $Ri => $v1) {
            echo "\x3c\x6c\x69\40\144\x61\164\x61\55\x61\x70\160\151\144\75\x22" . $Ri . "\42\76\x3c\x61\40\x68\x72\x65\146\x3d\x22\x23\42\76\74\151\x6d\x67\40\143\x6c\x61\163\x73\x3d\x22\x6d\157\137\x6f\x61\x75\x74\x68\137\x63\x6c\151\x65\156\x74\x5f\x64\145\146\x61\x75\x6c\x74\x5f\x61\160\x70\x5f\151\x63\157\156\42\40\x73\162\143\75\42" . MOC_URL . "\x72\x65\x73\157\x75\162\143\145\163\x2f\141\x70\160\137\143\x6f\x6d\160\157\x6e\145\156\164\163\x2f\151\x6d\x61\x67\x65\x73\57" . $v1->image . "\42\76\x3c\142\162\76" . $v1->label . "\x3c\x2f\x61\x3e\74\x2f\x6c\x69\x3e";
            M2:
        }
        Do1:
        ?>
	</ul>
	<div id="mo_oauth_client_search_res"></div>
	<script>
		jQuery("#mo_oauth_client_default_apps li").click(function(){
			var appId = jQuery(this).data("appid");
				window.location.href += "&appId="+appId;
		});
	</script>
		<?php 
    }
    public function add_app_ui()
    {
        ?>
		<div id="mo_oauth_client_default_apps_container" class="mo_table_layout">
			<div id="toggle2" class="mo_panel_toggle">
				<table class="mo_settings_table">
					<tr>
						<td><h3>Add Application</h3></td>
						<?php 
        if (isset($_GET["\141\x70\x70\x49\x64"])) {
            goto hy;
        }
        ?>
							<td align="right"><span style="position: relative; float: right;padding-left: 13px;padding-right:13px;background-color:white;border-radius:4px;">
								<!-- <button type="button" id="restart_tour_id" class="button button-primary button-large" onclick="jQuery('#show_pointers').submit();"><em class="fa fa-refresh"></em>Restart Tour</button> -->
							</span></td>
							<?php 
        goto EQ;
        hy:
        $KQ = $_GET["\141\x70\160\111\x64"];
        if (isset($_GET["\x61\143\x74\x69\x6f\156"]) && "\151\156\163\x74\162\x75\x63\x74\151\x6f\156\163" === $_GET["\141\x63\164\151\157\x6e"] || isset($_GET["\x73\150\x6f\x77"]) && "\x69\x6e\163\x74\x72\165\143\164\151\157\x6e\x73" === $_GET["\x73\x68\157\167"]) {
            goto g0;
        }
        echo "\xd\12\x9\x9\x9\x9\x9\x9\11\x9\x3c\x74\144\40\x61\x6c\151\x67\156\x3d\x22\x72\151\x67\x68\164\x22\x3e\x3c\141\40\150\x72\145\146\75\x22\x61\x64\155\151\x6e\56\160\x68\x70\x3f\160\141\147\145\75\x6d\157\137\x6f\141\x75\164\150\137\163\145\x74\x74\x69\x6e\x67\163\46\x61\x63\164\x69\x6f\156\75\x61\144\144\46\x73\x68\157\167\75\x69\156\x73\x74\162\x75\143\164\151\157\156\x73\x26\141\160\160\111\x64\x3d" . $KQ . "\x22\76\x3c\x64\x69\166\40\x69\144\75\x22\155\x6f\137\157\141\165\x74\150\137\x63\x6f\x6e\x66\151\147\137\147\165\x69\144\x65\42\x20\163\x74\x79\x6c\x65\75\42\144\151\x73\160\154\141\x79\72\151\156\x6c\151\156\145\x3b\x62\141\143\x6b\147\162\x6f\x75\156\144\x2d\143\x6f\x6c\x6f\x72\72\x23\x30\x30\x38\65\142\x61\x3b\143\x6f\x6c\x6f\x72\x3a\43\x66\x66\x66\x3b\160\x61\144\x64\151\156\147\72\64\x70\x78\x20\70\160\170\73\x62\157\162\x64\145\x72\55\x72\141\x64\151\x75\163\72\64\x70\x78\73\42\x3e\x48\x6f\x77\x20\164\x6f\x20\x43\x6f\x6e\146\x69\147\165\162\x65\x3f\x3c\57\144\151\166\x3e\x3c\57\141\x3e\x3c\x2f\x74\x64\x3e";
        goto bT;
        g0:
        echo "\15\xa\x9\x9\x9\11\11\11\11\11\x3c\x74\x64\40\x61\x6c\x69\147\156\x3d\42\x72\151\x67\150\x74\42\x3e\74\141\40\150\162\145\x66\75\42\x61\144\155\x69\x6e\x2e\x70\150\160\77\x70\141\x67\145\x3d\x6d\x6f\137\x6f\141\165\x74\x68\x5f\x73\x65\x74\x74\x69\156\147\x73\x26\141\x63\x74\x69\157\156\75\x61\144\144\x26\x61\x70\x70\x49\x64\x3d" . $KQ . "\x22\x3e\74\x64\x69\166\40\151\144\75\x22\155\x6f\x5f\x6f\141\x75\x74\x68\137\x63\157\x6e\x66\151\147\x5f\x67\165\151\x64\145\42\x20\163\164\171\154\145\x3d\x22\x64\x69\163\160\154\x61\171\72\x69\156\154\151\x6e\145\x3b\x62\141\x63\153\x67\162\157\x75\x6e\144\55\x63\157\154\157\x72\72\43\60\x30\70\x35\x62\x61\73\x63\x6f\x6c\x6f\x72\x3a\43\146\x66\x66\x3b\160\141\144\x64\x69\x6e\147\72\x34\x70\170\x20\70\160\x78\x3b\x62\157\162\x64\x65\x72\55\162\x61\x64\151\165\163\72\x34\160\170\73\42\x3e\110\151\144\x65\x20\x69\x6e\x73\x74\162\165\x63\x74\x69\157\x6e\163\x20\136\x3c\57\144\x69\x76\76\x3c\57\x61\x3e\74\x2f\164\144\x3e\x20";
        bT:
        EQ:
        ?>
					</tr>
				</table>
				<form name="f" method="post" id="show_pointers">
					<input type="hidden" name="option" value="clear_pointers"/>
					<?php 
        wp_nonce_field("\143\x6c\145\x61\162\x5f\x70\157\151\x6e\164\x65\162\x73", "\x63\154\x65\141\162\x5f\x70\x6f\x69\156\164\x65\x72\163\x5f\x6e\157\x6e\x63\145");
        ?>
				</form>
			</div>
				<?php 
        if (!isset($_GET["\141\160\x70\111\144"])) {
            goto QX;
        }
        self::show_add_app_page();
        goto BF;
        QX:
        self::show_default_apps();
        BF:
        ?>
		</div>
		<?php 
    }
    public function show_add_app_page()
    {
        global $NQ;
        wp_enqueue_style("\x6d\x6f\55\x77\160\x2d\146\157\156\x74\x2d\x61\x77\145\163\x6f\x6d\145\55\x6d", MOC_URL . "\x72\145\163\x6f\x75\x72\143\145\163\57\x63\x73\x73\x2f\146\x6f\x6e\x74\55\141\x77\145\163\157\x6d\x65\x2e\x6d\x69\156\56\143\x73\x73\x3f\x76\x65\162\x73\x69\157\x6e\x3d\x34\x2e\x37\56\x30", array(), $WD = null, $M5 = false);
        $KQ = isset($_GET["\141\x70\x70\x49\144"]) ? $_GET["\x61\160\x70\x49\x64"] : false;
        $Rz = $NQ->get_default_app($KQ);
        if (!(false === $Rz)) {
            goto DI;
        }
        $no = admin_url() . "\x2f\x61\144\x6d\151\x6e\x2e\x70\150\x70\77\x70\141\147\x65\75\155\x6f\137\157\141\x75\x74\150\x5f\x73\145\164\164\x69\156\147\163\x26\164\141\x62\75\x63\157\x6e\146\151\x67";
        echo "\117\157\160\163\41\x20\123\x6f\x6d\x65\x74\x68\x69\156\147\x20\x77\145\156\164\40\167\162\157\156\147\56\x20\120\x6c\145\x61\163\145\x20\x77\141\151\164\x2e\x2e\x2e";
        ?>
			<script>
				window.location.replace("<?php 
        echo $no;
        ?>
");
			</script>
			<?php 
        DI:
        ?>
	<div id="mo_oauth_add_app">
	<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
	<input type="hidden" name="option" value="mo_oauth_add_app" />
		<?php 
        wp_nonce_field("\155\x6f\x5f\157\141\165\164\x68\137\141\x64\144\137\141\160\160", "\155\x6f\x5f\157\141\x75\164\150\137\141\144\x64\x5f\x61\160\x70\x5f\156\157\x6e\143\145");
        ?>
	<table class="mo_settings_table">
		<tr>
		<td><strong><span class="mo_premium_feature">*</span>Application:<br><br></strong></td>
		<td>
			<input type="hidden" name="mo_oauth_app_name" value="<?php 
        echo esc_html($KQ);
        ?>
">
			<input type="hidden" name="mo_oauth_app_type" value="<?php 
        echo esc_html($Rz->type);
        ?>
">
			<?php 
        echo $Rz->label;
        ?>
 &nbsp;&nbsp;&nbsp;&nbsp; <a style="text-decoration:none" href ="admin.php?page=mo_oauth_settings&action=add"><div style="display:inline;background-color:#0085ba;color:#fff;padding:4px 8px;border-radius:4px">Change Application</div></a><br><br>
		</td>
		</tr>
		<tr><td><strong>Redirect / Callback URL</strong></td>
		

		<td><input class="mo_table_textbox" required="true" id="callbackurl" type="text" name="mo_update_url" value='<?php 
        echo site_url();
        ?>
'>

		&nbsp;&nbsp;<div class="tooltip"><span class="tooltiptext" id="moTooltip">Copy to clipboard</span><i class="fa fa-clipboard" style="font-size:20px; align-items: center;vertical-align: middle;" aria-hidden="true" onclick="copyUrl()" onmouseout="outFunc()"></i></div></td>
		
		<script>
			function outFunc() {
  					var tooltip = document.getElementById("moTooltip");
  					tooltip.innerHTML = "Copy to clipboard";
			}
			function copyUrl() {
  				var copyText = document.getElementById("callbackurl");
  				outFunc();
  				copyText.select();
  				copyText.setSelectionRange(0, 99999); 
  				document.execCommand("copy");
  				var tooltip = document.getElementById("moTooltip");
  				tooltip.innerHTML = "Copied";
  				
				document.getElementById("redirect_url_change_warning").style.display = "none";
			} 

			jQuery("#callbackurl").on('focus',function(){
					document.getElementById("redirect_url_change_warning").style.display = "table-row";
				});
			jQuery("#callbackurl").on('click',function(){
					document.getElementById("redirect_url_change_warning").style.display = "table-row";
			});
			jQuery("#callbackurl").on('focusout',function(){
				document.getElementById("redirect_url_change_warning").style.display = "none";
			});
		</script>
			</tr>
		<tr style="display:none;" id="redirect_url_change_warning">
			<td colspan="2"><strong><span id="mo_redirect_url_warning" style="color:red;">Note: Editing redirect URL will break your SSO. Only change if you are moving from staging to production.</span></strong></td>
		</tr>

		<tr id="mo_oauth_custom_app_name_div">
			<td><strong><span class="mo_premium_feature">*</span>App Name:</strong></td>
			<td><input class="mo_table_textbox" type="text" id="mo_oauth_custom_app_name" name="mo_oauth_custom_app_name" value="" pattern="[a-zA-Z0-9]+" required title="Please do not add any special characters."></td>
		</tr>
		<tr id="mo_oauth_display_app_name_div">
			<td><strong>Display App Name:<?php 
        echo !$NQ->check_versi(1) ? "\x3c\142\x72\x3e\46\145\x6d\163\160\73\x3c\163\x70\141\156\x20\x63\154\x61\x73\163\x3d\x22\x6d\x6f\137\160\162\x65\155\x69\x75\x6d\137\x66\145\x61\164\x75\162\145\42\x3e\133\123\x54\101\116\104\101\122\104\x5d\74\57\x73\x70\x61\x6e\76" : '';
        ?>
</strong></td>
			<td><input <?php 
        echo !$NQ->check_versi(1) ? "\x64\151\x73\141\x62\x6c\x65\x64" : '';
        ?>
 class="mo_table_textbox" type="text" id="mo_oauth_display_app_name" name="mo_oauth_display_app_name" value="" pattern="[a-zA-Z0-9\s]+" title="Please do not add any special characters."></td>
		</tr>
		<tr>
			<td><strong><span class="mo_premium_feature">*</span>Client ID:</strong></td>
			<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_id" value=""></td>
		</tr>
		<tr>
			<td><strong><span class="mo_premium_feature">*</span>Client Secret:</strong></td>
			<td><input class="mo_table_textbox" required="" type="text"  name="mo_oauth_client_secret" value=""></td>
		</tr>
		<tr>
			<td><strong>Scope:</strong></td>
			<td><input class="mo_table_textbox" type="text" name="mo_oauth_scope" value="<?php 
        echo isset($Rz->scope) ? esc_html(trim($Rz->scope)) : '';
        ?>
"></td>
		</tr>
		<tr id="mo_oauth_authorizeurl_div">
			<td><strong><span class="mo_premium_feature">*</span>Authorize Endpoint:</strong></td>
			<td><input class="mo_table_textbox" required type="url" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value="<?php 
        echo isset($Rz->authorize) ? esc_url(trim($Rz->authorize)) : '';
        ?>
"></td>
		</tr>
		<tr id="mo_oauth_accesstokenurl_div">
			<td><strong><span class="mo_premium_feature">*</span>Access Token Endpoint:</strong></td>
			<td><input class="mo_table_textbox" required type="url" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value="<?php 
        echo isset($Rz->token) ? esc_url($Rz->token) : '';
        ?>
 "></td>
		</tr>
		<tr>
			<td></td>
			<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_authorization_header" value ="1" checked />Set client credentials in Header<span style="padding:0px 0px 0px 8px;"></span><input type="checkbox" name="mo_oauth_body" value ="1"/>Set client credentials in Body<div style="padding:5px;"></div></td>
		</tr>
		<?php 
        if (!(!isset($Rz->type) || "\157\141\165\164\150" === $Rz->type)) {
            goto gj;
        }
        ?>
			<tr id="mo_oauth_resourceownerdetailsurl_div">
				<td><strong><span class="mo_premium_feature">*</span>Get User Info Endpoint:</strong></td>
				<td><input class="mo_table_textbox" <?php 
        echo !isset($Rz->type) || "\x6f\141\x75\x74\150" === $Rz->type ? "\x72\x65\161\165\151\x72\x65\144\x20" : '';
        ?>
 type="url" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value="<?php 
        echo isset($Rz->userinfo) ? esc_url($Rz->userinfo) : '';
        ?>
"></td>
			</tr>
		<?php 
        gj:
        ?>
		<tr>
			<td><strong>login button:</strong></td>
			<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_show_on_login_page" value ="1" checked/>Show on login page</td>
		</tr>
		<tr>
			<td><br></td>
			<td><br></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Save settings"
				class="button button-primary button-large" /></td>
		</tr>
		</table>
	</form>
	<div id="instructions">

	</div>
	</div>
		<?php 
    }
    public function show_apps_list_page()
    {
        global $NQ;
        ?>
	<style>
		.tableborder {
			border-collapse: collapse;
			width: 100%;
			border-color:#eee;
		}

		.tableborder th, .tableborder td {
			text-align: left;
			padding: 8px;
			border-color:#eee;
		}

		.tableborder tr:nth-child(even){background-color: #f2f2f2}
	</style>
	<div id="mo_oauth_app_list" class="mo_table_layout">
		<?php 
        if ($NQ->mo_oauth_client_get_option("\155\157\137\157\x61\x75\164\x68\137\141\x70\x70\163\x5f\154\151\x73\164")) {
            goto Ze;
        }
        self::show_add_app_page();
        goto si;
        Ze:
        $RL = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\x75\x74\x68\x5f\141\160\160\163\137\154\x69\163\164");
        if (count($RL) > 0 && !$NQ->check_versi(3)) {
            goto yy;
        }
        echo "\x3c\142\162\x3e\x3c\x61\x20\150\162\x65\146\x3d\47\141\144\x6d\151\156\56\160\x68\x70\x3f\x70\141\147\145\x3d\155\x6f\x5f\x6f\141\x75\164\150\137\163\x65\164\x74\x69\156\147\x73\46\x61\x63\x74\151\157\x6e\75\141\144\x64\x5f\x6e\145\167\47\76\74\x62\x75\x74\164\157\x6e\40\x63\x6c\141\x73\163\75\x27\x62\x75\x74\x74\x6f\156\40\142\165\x74\164\x6f\x6e\x2d\160\x72\x69\155\141\162\x79\40\x62\165\x74\164\x6f\156\55\154\141\x72\147\145\47\40\x73\164\x79\154\x65\x3d\47\x66\154\157\x61\x74\72\162\151\x67\150\x74\x27\x3e\101\x64\144\x20\x41\x70\160\154\x69\x63\141\x74\151\x6f\156\74\x2f\x62\165\164\164\157\x6e\76\74\x2f\x61\76";
        goto zf;
        yy:
        echo "\x3c\142\162\x3e\x3c\x61\x20\150\x72\145\x66\75\x27\x23\47\76\x3c\x62\x75\164\x74\157\x6e\40\144\x69\x73\x61\142\x6c\x65\144\x20\143\x6c\141\x73\x73\x3d\47\x62\x75\x74\164\157\x6e\40\x62\165\x74\x74\157\x6e\55\160\x72\151\155\141\162\x79\40\142\165\164\x74\157\156\x2d\154\x61\162\x67\145\x27\x20\x73\164\x79\x6c\145\x3d\47\x66\154\157\x61\164\x3a\162\151\x67\x68\164\47\x3e\x41\x64\144\x20\x41\160\x70\154\151\x63\x61\164\x69\157\156\74\x2f\142\165\164\x74\157\x6e\76\x3c\57\x61\76";
        zf:
        echo "\x3c\x68\x33\x3e\x41\160\160\154\x69\143\x61\x74\151\x6f\x6e\x73\x20\x4c\151\x73\x74\74\x2f\150\x33\x3e";
        if (!(is_array($RL) && count($RL) > 0 && !$NQ->check_versi(3))) {
            goto TZ;
        }
        echo "\74\160\40\163\164\171\154\x65\x3d\x27\x63\x6f\x6c\157\x72\72\x23\x61\71\x34\64\x34\x32\73\x62\x61\143\x6b\x67\x72\157\x75\156\144\55\x63\x6f\x6c\157\162\x3a\43\x66\x32\x64\x65\144\x65\73\142\x6f\162\144\x65\162\x2d\x63\x6f\154\157\x72\72\x23\145\142\143\143\144\61\x3b\142\x6f\162\x64\145\162\x2d\162\x61\144\x69\165\x73\72\x35\160\170\73\x70\x61\x64\x64\151\156\147\x3a\61\x32\x70\170\x27\x3e\131\x6f\165\40\143\141\x6e\x20\157\x6e\154\x79\40\x61\144\144\40\x31\40\x61\x70\x70\x6c\x69\143\141\x74\x69\x6f\156\x20\x77\x69\x74\x68\40" . esc_html(strtolower($NQ->get_versi_str())) . "\x20\166\x65\162\x73\x69\x6f\156\56\40\x55\x70\147\162\x61\x64\x65\40\x74\x6f\40\74\141\x20\x68\x72\x65\x66\75\x27\141\x64\x6d\151\x6e\x2e\x70\x68\x70\77\x70\141\147\145\75\155\x6f\x5f\x6f\141\165\164\x68\x5f\163\145\x74\164\x69\x6e\147\163\46\x74\x61\142\x3d\154\151\x63\x65\x6e\163\x69\x6e\147\47\76\74\x73\x74\162\x6f\x6e\x67\x3e\145\156\x74\145\162\160\162\151\x73\x65\74\57\x73\x74\162\157\156\x67\76\x3c\x2f\x61\x3e\40\164\x6f\40\x61\144\x64\x20\x6d\157\162\x65\x2e\74\x2f\x70\76";
        TZ:
        echo "\x3c\x74\141\142\154\x65\40\x63\154\141\x73\163\75\47\164\x61\x62\x6c\x65\x62\157\162\144\145\x72\47\76";
        echo "\74\x74\162\76\74\x74\x68\x3e\x3c\163\164\x72\x6f\x6e\147\76\x4e\x61\x6d\145\74\x2f\x73\164\162\x6f\156\147\76\x3c\x2f\x74\150\76\x3c\x74\150\x3e\x41\x63\x74\151\x6f\156\x3c\57\x74\150\x3e\74\x2f\164\162\x3e";
        $pv = '';
        foreach ($RL as $ZZ => $X1) {
            $pv .= "\74\x74\x72\76\x3c\164\144\x3e" . $ZZ . "\74\x2f\164\144\76\74\164\x64\x3e\x3c\141\40\150\162\145\146\x3d\x27\141\144\x6d\x69\x6e\x2e\x70\x68\x70\77\160\141\147\145\75\x6d\157\137\x6f\141\x75\164\x68\x5f\163\145\x74\164\151\x6e\x67\163\46\x74\141\142\x3d\x63\157\156\146\x69\147\x26\x61\x63\x74\x69\157\x6e\x3d\165\x70\x64\141\164\145\x26\141\x70\x70\75" . rawurlencode($ZZ) . "\x27\x3e\105\144\151\x74\40\x41\160\160\x6c\x69\x63\x61\164\x69\x6f\156\74\x2f\x61\x3e\x20\x7c\40\74\141\40\150\x72\145\x66\75\47\x61\144\155\x69\156\x2e\160\150\x70\77\160\141\147\145\75\x6d\157\137\157\x61\165\164\x68\137\163\145\x74\164\151\x6e\147\x73\46\x74\x61\142\75\x63\x6f\156\x66\151\x67\46\141\143\164\151\x6f\156\75\x75\x70\144\141\164\x65\x26\141\160\x70\x3d" . rawurlencode($ZZ) . "\43\141\164\x74\162\x6d\x61\x70\x70\x69\x6e\147\x27\x3e\x41\164\x74\162\151\142\165\x74\145\40\x4d\x61\x70\x70\151\156\147\x3c\x2f\x61\x3e\x20\x7c\40\x3c\141\x20\x68\162\x65\x66\75\47\141\144\155\151\x6e\56\x70\x68\160\77\x70\141\147\145\75\x6d\x6f\137\157\141\x75\x74\x68\137\x73\145\x74\164\151\x6e\147\x73\x26\164\141\142\x3d\143\x6f\x6e\x66\151\x67\x26\x61\143\x74\x69\157\156\75\x75\x70\x64\x61\164\145\x26\x61\160\160\x3d" . rawurlencode($ZZ) . "\43\x72\x6f\x6c\145\x6d\x61\x70\x70\x69\x6e\147\x27\76\122\157\154\x65\x20\x4d\x61\160\160\x69\x6e\x67\x3c\x2f\141\x3e\x20\174\x20\x3c\141\x20\157\156\143\154\151\143\153\x3d\x27\x72\x65\x74\x75\162\156\40\143\x6f\x6e\146\151\162\155\50\x22\101\x72\x65\40\x79\157\x75\40\163\x75\x72\x65\40\171\157\x75\40\x77\x61\156\164\x20\164\157\40\144\x65\x6c\145\164\145\x20\164\x68\151\x73\x20\x69\164\145\155\x3f\x22\51\47\x20\x68\x72\145\146\x3d\47\141\x64\x6d\151\x6e\x2e\160\150\x70\x3f\160\141\x67\145\75\155\x6f\137\x6f\141\165\164\150\137\163\145\x74\x74\151\x6e\x67\163\x26\164\141\x62\75\x63\x6f\156\x66\151\147\46\141\x63\x74\x69\157\156\x3d\x64\145\154\145\x74\x65\x26\141\x70\x70\x3d" . rawurlencode($ZZ) . "\x27\x3e\104\145\154\145\x74\x65\74\57\x61\x3e\x20\x7c\40";
            if (isset($_GET["\x61\x63\164\x69\157\x6e"]) && "\151\156\163\164\162\165\x63\164\151\157\x6e\x73" === $_GET["\x61\x63\164\151\157\x6e"] && isset($_GET["\x66\157\162"]) && rawurlencode($ZZ) === $_GET["\x66\157\162"]) {
                goto k6;
            }
            $pv .= "\x3c\141\40\150\162\145\146\75\x27\x61\144\x6d\151\x6e\x2e\x70\150\160\77\160\141\147\145\x3d\x6d\x6f\137\157\141\165\x74\150\137\163\145\164\164\151\156\x67\163\x26\164\x61\x62\x3d\143\157\156\146\151\147\x26\141\143\164\151\x6f\156\x3d\x69\x6e\163\x74\162\165\x63\164\x69\x6f\156\163\46\141\x70\x70\111\x64\x3d" . ($X1->get_app_config("\x61\x70\160\111\144") ? $X1->get_app_config("\x61\160\160\x49\144") : '') . "\46\146\157\162\75" . rawurlencode($ZZ) . "\47\x3e\x48\157\x77\40\x74\157\x20\x43\x6f\156\x66\x69\147\x75\x72\x65\77\x3c\x2f\x61\x3e\74\x2f\x74\144\76\74\57\164\x72\x3e";
            goto WY;
            k6:
            $pv .= "\74\x61\40\150\162\145\x66\75\47\x61\x64\155\x69\156\x2e\x70\150\160\77\160\141\147\x65\x3d\x6d\x6f\x5f\x6f\141\165\164\x68\x5f\x73\145\x74\x74\x69\x6e\x67\x73\x26\164\x61\x62\75\x63\x6f\156\x66\x69\x67\x27\x3e\x48\151\x64\x65\40\111\156\163\x74\162\165\143\164\x69\x6f\x6e\163\74\x2f\x61\76\74\57\164\144\x3e\74\x2f\164\x72\x3e";
            WY:
            Xb:
        }
        UU:
        $pv .= "\74\x2f\x74\141\142\x6c\x65\76";
        $pv .= "\x3c\x62\x72\x3e\74\x62\162\x3e";
        echo $pv;
        si:
        ?>
		</div>
		<?php 
    }
}
