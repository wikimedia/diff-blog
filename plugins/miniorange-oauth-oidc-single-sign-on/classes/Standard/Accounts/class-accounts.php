<?php


namespace MoOauthClient\Paid;

use MoOauthClient\Accounts as CommonAccounts;
class Accounts extends CommonAccounts
{
    public function mo_oauth_lp()
    {
        $cu = isset($_POST["\x6d\157\x5f\157\141\165\164\x68\137\x63\x6c\151\145\x6e\164\137\154\151\143\x65\x6e\x73\x65\x5f\153\145\171"]) ? $_POST["\x6d\157\x5f\157\x61\x75\164\x68\x5f\143\154\151\x65\156\164\x5f\x6c\151\x63\145\156\x73\x65\137\x6b\145\x79"] : '';
        ?>
		<div class="mo_table_layout">
		<br>
			<h3>Verify your license [ <span style="font-size:13px;font-style:normal;"><a style="cursor:pointer;" href="https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/admin/customer/viewlicensekeys" target="_blank" onclick="getlicensekeys()" >Click here to view your license key</a></span> ]</h3>
            <hr>
			<form name="f" method="post" action="">
				<input type="hidden" name="option" value="mo_oauth_client_verify_license" />
				<?php 
        wp_nonce_field("\155\x6f\x5f\x6f\141\165\x74\x68\x5f\143\x6c\151\x65\156\164\x5f\x76\145\162\x69\146\x79\137\154\x69\x63\x65\156\163\x65", "\155\157\x5f\x6f\141\165\164\150\137\x63\x6c\151\145\156\x74\x5f\166\145\x72\151\146\171\x5f\154\x69\x63\145\156\163\145\x5f\x6e\157\156\x63\x65");
        ?>
				<table class="mo_settings_table">
					<tr>
                        <p><b><font color="#FF0000">*</font>Enter your license key to activate the plugin:</b><br><br>
                            <input class="mo_table_textbox" required type="text" style="margin-left:40px;width:300px;border-style:solid;border-color:lightgray" name="mo_oauth_client_license_key" placeholder="Enter your license key to activate the plugin" value="<?php 
        echo $cu;
        ?>
" /></td>
					</tr>
                        </p>

                        <ol>
                            <li>License key you have entered here is associated with this site instance. In future, if you are re-installing the plugin or your site for any reason, you should deactivate the plugin from the current wordpress domain. It would free your License Key and allow you to activate this plugin on other domain/site.</li><br>
                            <li><b>This is not a developer's license.</b> You may not modify the content or any part thereof, except as explicitly permitted under this plugin. Making any kind of change to the plugin's code may make the plugin unusable.</li>
                        </ol>
                        <p><b>&nbsp;<input style="margin-left:20px;" required type="checkbox" name="license_conditions" ';
                        echo '/>&nbsp;&nbsp;I accept the above Terms and Conditions.</p>
                        <br>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" name="submit" value="Activate License" class="button button-primary button-large" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</form>
							
							<input type="button" name="change-account-button" id="mo_oauth_change_account_button" onclick="document.getElementById('mo_oauth_goto_login_form').submit();" value="Back" class="button button-primary button-large" />

							<form name="f1" method="post" action="" id="mo_oauth_goto_login_form">
								<input type="hidden" value="change_miniorange" name="option"/>
								<?php 
        wp_nonce_field("\x63\x68\141\x6e\147\x65\x5f\155\x69\156\x69\157\162\x61\156\x67\x65", "\143\x68\141\156\x67\145\x5f\155\151\x6e\x69\157\x72\141\156\x67\x65\x5f\x6e\157\156\143\x65");
        ?>
							</form>
						</td>
					</tr>
					<tr><td>&nbsp;</td><td></td></tr>
					<tr><td>&nbsp;</td><td></td></tr>
				</table>
		</div>
		<?php 
    }
}
