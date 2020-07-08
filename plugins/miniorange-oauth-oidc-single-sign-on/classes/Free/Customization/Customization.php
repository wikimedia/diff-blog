<?php


namespace MoOauthClient\Free;

use MoOauthClient\Free\CustomizationInterface;
class Customization implements CustomizationInterface
{
    private $versi;
    function __construct()
    {
        $this->versi = VERSION;
    }
    function render_free_ui()
    {
        global $NQ;
        $po = $NQ->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\x74\150\137\151\143\157\156\x5f\143\x6f\156\146\x69\x67\x75\x72\145\x5f\x63\163\x73");
        $po = str_replace("\175", '', $po);
        $po = str_replace("\56\x6f\x61\x75\x74\150\154\157\147\x69\x6e\142\165\x74\x74\157\x6e\173", '', $po);
        $po = str_replace("\56\x6f\x61\x75\x74\x68\x6c\x6f\147\x69\156\142\x75\164\x74\157\x6e\40\x7b", '', $po);
        $CM = $Jx = '';
        function format_custom_css_value($h3)
        {
            $L1 = explode("\73", $h3);
            $Sb = '';
            $zh = 0;
            Je:
            if (!($zh < count($L1))) {
                goto fo;
            }
            $Sb .= str_replace("\xd\xa", '', $L1[$zh]);
            $Sb .= empty($L1[$zh]) ? '' : "\73" . "\xd\12";
            KX:
            $zh++;
            goto Je;
            fo:
            return $Sb;
        }
        global $NQ;
        ?>

	<?php 
        if (!(($NQ->mo_oauth_hbca_xyake() || !$NQ->mo_oauth_is_customer_registered()) && $this->versi === "\x6d\157\137\x66\162\145\x65\x5f\166\145\x72\x73\x69\x6f\x6e")) {
            goto wg;
        }
        echo "\x3c\x64\151\166\40\x63\154\141\x73\163\x3d\x22\x6d\157\x5f\157\141\x75\x74\150\137\160\x72\145\155\x69\x75\155\137\x6f\x70\x74\x69\x6f\x6e\137\164\x65\170\x74\x22\x3e\x3c\163\160\x61\156\x20\x73\164\171\154\x65\75\42\143\x6f\x6c\157\x72\72\162\145\144\73\x22\x3e\52\x3c\57\163\x70\x61\156\x3e\x54\x68\x69\163\x20\x69\x73\x20\x61\40\x73\x74\x61\x6e\144\141\x72\x64\x20\x66\145\x61\x74\165\162\145\56\15\12\x9\74\x61\x20\150\162\x65\x66\x3d\42\141\x64\155\x69\156\x2e\x70\x68\160\77\160\141\x67\x65\x3d\155\157\x5f\x6f\141\165\164\150\x5f\x73\145\x74\164\x69\x6e\x67\163\x26\164\x61\x62\75\x6c\151\143\x65\x6e\x73\x69\x6e\x67\42\x3e\x43\154\x69\x63\x6b\40\110\x65\162\x65\74\57\x61\76\40\164\x6f\x20\x73\x65\145\40\x6f\165\162\x20\x66\165\154\x6c\40\x6c\x69\x73\164\x20\157\146\x20\123\x74\x61\x6e\144\141\162\144\40\x46\145\x61\164\165\162\145\163\56\74\57\144\151\166\76";
        $CM = "\155\x6f\x5f\x6f\141\165\x74\x68\x5f\x70\162\x65\155\x69\165\x6d\137\x6f\160\x74\151\157\156";
        $Jx = "\74\163\x63\162\151\x70\164\x3e\x6a\121\165\x65\162\171\50\x20\x64\157\x63\x75\x6d\x65\x6e\164\x20\51\x2e\162\145\x61\144\171\50\x66\x75\156\143\164\x69\x6f\156\x28\x29\x20\173\40\152\121\x75\x65\162\171\x28\x22\56\155\x6f\137\x6f\141\x75\x74\150\x5f\160\x72\145\155\x69\165\155\x5f\157\x70\x74\151\157\156\40\x3a\151\x6e\x70\x75\164\x22\51\x2e\160\x72\157\x70\50\x22\144\151\163\x61\142\x6c\145\x64\x22\x2c\x20\x74\162\165\145\51\73\175\x29\x3b\40\x3c\x2f\x73\x63\x72\x69\x70\x74\76";
        wg:
        ?>

	<div id="mo_oauth_customiztion" class="mo_table_layout mo_oauth_app_customization <?php 
        echo $CM;
        ?>
">
	<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings&tab=customization">
		<input type="hidden" name="option" value="mo_oauth_app_customization" />
		<?php 
        wp_nonce_field("\155\x6f\137\157\141\x75\164\x68\x5f\x61\x70\160\x5f\143\165\x73\x74\157\x6d\151\x7a\141\164\x69\157\156", "\155\x6f\x5f\x6f\141\165\164\150\137\x61\x70\160\x5f\x63\x75\x73\x74\157\x6d\151\x7a\x61\164\x69\157\x6e\x5f\x6e\x6f\x6e\x63\x65");
        ?>
		<h2>Customize Icons</h2>
		<table class="mo_settings_table">
			<tr>
				<td><strong>Icon Width:</strong></td>
				<td><input type="text" id="mo_oauth_icon_width" name="mo_oauth_icon_width" value="<?php 
        echo $NQ->mo_oauth_client_get_option("\x6d\157\137\x6f\141\165\x74\x68\x5f\x69\x63\157\x6e\137\x77\x69\x64\164\150");
        ?>
"> e.g. 200px or 100%</td>
			</tr>
			<tr>
				<td><strong>Icon Height:</strong></td>
				<td><input  type="text" id="mo_oauth_icon_height" name="mo_oauth_icon_height" value="<?php 
        echo $NQ->mo_oauth_client_get_option("\x6d\157\137\157\x61\x75\x74\x68\137\x69\x63\x6f\156\137\150\145\151\x67\150\164");
        ?>
"> e.g. 50px or auto</td>
			</tr>
			<tr>
				<td><strong>Icon Margins:</strong></td>
				<td><input  type="text" id="mo_oauth_icon_margin" name="mo_oauth_icon_margin" value="<?php 
        echo $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\141\x75\x74\150\137\x69\x63\157\156\137\155\141\x72\147\x69\156");
        ?>
"> e.g. 2px 0px or auto</td>
			</tr>
			<tr>
				<td><strong>Custom CSS:</strong></td>
				<td><textarea type="text" id="mo_oauth_icon_configure_css" style="resize: vertical; width:400px; height:180px;  margin:5% auto;" rows="6" name="mo_oauth_icon_configure_css"><?php 
        echo rtrim(trim(format_custom_css_value($po)), "\73");
        ?>
</textarea><br/><strong>Example CSS:</strong>
<pre>
	background: #7272dc;
	height:40px;
	padding:8px;
	text-align:center;
	color:#fff;
</pre>
			</td>
			</tr>
			<tr>
				<td><strong>Logout Button Text: </strong></td>
				<td><input  type="text" id="mo_oauth_custom_logout_text" name="mo_oauth_custom_logout_text" placeholder="Howdy, ##user##" value="<?php 
        echo $NQ->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\x75\x74\x68\x5f\x63\165\163\164\x6f\x6d\137\154\157\147\x6f\x75\x74\x5f\164\x65\x78\x74");
        ?>
"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Save settings"
					class="button button-primary button-large" /></td>
			</tr>
		</table>
	</form>
	</div>
	<?php 
        echo $Jx;
        ?>

	<?php 
    }
}
?>
