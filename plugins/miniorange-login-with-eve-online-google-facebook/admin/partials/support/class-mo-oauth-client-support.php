<?php

class Mo_OAuth_Client_Admin_Support {
	
	public static function support() {
		self::support_page();
	}
	
	public static function support_page(){
	?>
		<div id="mo_support_layout" class="mo_support_layout">
			<div>
				<h3>Contact Us</h3>
				<p>Need any help? Couldn't find an answer in <a href="<?php echo add_query_arg( array('tab' => 'faq'), $_SERVER['REQUEST_URI'] ); ?>">FAQ</a>?<br>Just send us a query so we can help you.</p>
				<form method="post" action="">
					<?php wp_nonce_field('mo_oauth_support_form','mo_oauth_support_form_field'); ?>
					<input type="hidden" name="option" value="mo_oauth_contact_us_query_option" />
					<table class="mo_settings_table">
						<tr>
							<td><input type="email" class="mo_table_textbox" required name="mo_oauth_contact_us_email" placeholder="Enter email here"
							value="<?php echo get_option("mo_oauth_admin_email"); ?>"></td>
						</tr>
						<tr>
							<td><input type="tel" id="contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}|[\+]\d{1,4}[\s]" placeholder="Enter phone here" class="mo_table_textbox" name="mo_oauth_contact_us_phone" value="<?php echo get_option('mo_oauth_admin_phone');?>"></td>
						</tr>
						<tr>
							<td><textarea class="mo_table_textbox" onkeypress="mo_oauth_valid_query(this)" placeholder="Enter your query here" onkeyup="mo_oauth_valid_query(this)" onblur="mo_oauth_valid_query(this)" required name="mo_oauth_contact_us_query" rows="4" style="resize: vertical;"></textarea></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="mo_oauth_send_plugin_config" id="mo_oauth_send_plugin_config" checked>&nbsp;Send Plugin Configuration</td>
						</tr>
						<tr>
							<td><small style="color:#666">We will not be sending your Client IDs or Client Secrets.</small></td>
						</tr>
					</table>
					<div style="text-align:left;">
						<input type="submit" name="submit" style="margin:15px; width:100px;" class="button button-primary button-large" />
					</div>
					<p>If you want custom features in the plugin, just drop an email at <a href="mailto:oauthsupport@xecurify.com">oauthsupport@xecurify.com</a>.</p>
				</form>
			</div>
		</div>
		<script>
			jQuery("#contact_us_phone").intlTelInput();
			function mo_oauth_valid_query(f) {
				!(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
						/[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
			}
		</script>
		<br/>
		
	<?php
	}


}