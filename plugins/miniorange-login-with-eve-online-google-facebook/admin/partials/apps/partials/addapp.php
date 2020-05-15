<?php

	require('defaultapps.php');
	require('grant-settings.php');

	function add_app_page(){
		$appslist = get_option('mo_oauth_apps_list');
		if(is_array($appslist) && sizeof($appslist)>0) {
			echo "<p style='color:#a94442;background-color:#f2dede;border-color:#ebccd1;border-radius:5px;padding:12px'>You can only add 1 application with free version. Upgrade to <a href='admin.php?page=mo_oauth_settings&tab=licensing'><b>enterprise</b></a> to add more.</p>";
			exit;
		}
	?>
	<div id="toggle2" class="mo_panel_toggle">
		<table class="mo_settings_table">
			<tr>
				<td><h3>Add Application</h3></td>
				<?php
					if(isset($_GET['appId'])) {
						$currentAppId = $_GET['appId'];
						if(isset($_GET['action']) && ($_GET['action'] == 'instructions')) {
							echo "
							<td align=\"right\"><a href=\"admin.php?page=mo_oauth_settings&tab=config&appId=".$currentAppId."\"><div id='mo_oauth_config_guide' style=\"display:inline;background-color:#0085ba;color:#fff;padding:4px 8px;border-radius:4px\">Hide instructions ^</div></a></td> ";
						} else {
							echo "
							<td align=\"right\"><a href=\"admin.php?page=mo_oauth_settings&tab=config&action=instructions&appId=".$currentAppId."\"><div id='mo_oauth_config_guide' style=\"display:inline;background-color:#0085ba;color:#fff;padding:4px 8px;border-radius:4px\">How to Configure?</div></a></td>
							";
						}
					} else { ?>
						<td align="right"><span style="position: relative; float: right;padding-left: 13px;padding-right:13px;background-color:white;border-radius:4px;">
							&nbsp;
						</span></td> <?php
					}

				?>
			</tr>
		</table>
		<form name="f" method="post" id="show_pointers">
			<?php wp_nonce_field('mo_oauth_clear_pointers_form','mo_oauth_clear_pointers_form_field'); ?>
        	<input type="hidden" name="option" value="clear_pointers"/>
		</form>
	</div>

	<?php
		// Select from default apps
		if(!isset($_GET['appId'])) {
			mo_oauth_client_show_default_apps();
		} else {

			$currentAppId = $_GET['appId'];
			$currentapp = mo_oauth_client_get_app($currentAppId);
	?>
		<div id="mo_oauth_add_app">
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings&tab=config&action=update&app=">
		<?php wp_nonce_field('mo_oauth_add_app_form','mo_oauth_add_app_form_field'); ?>	
		<input type="hidden" name="option" value="mo_oauth_add_app" />
		<table class="mo_settings_table">
			<tr>
			<td><strong><font color="#FF0000">*</font>Application:<br><br></strong></td>
			<td>
				<input type="hidden" name="mo_oauth_app_name" value="<?php echo $currentAppId;?>">
				<input type="hidden" name="mo_oauth_app_type" value="<?php echo $currentapp->type;?>">
				<?php echo $currentapp->label;?> &nbsp;&nbsp;&nbsp;&nbsp; <a style="text-decoration:none" href ="admin.php?page=mo_oauth_settings"><div style="display:inline;background-color:#0085ba;color:#fff;padding:4px 8px;border-radius:4px">Change Application</div></a><br><br>
			</td>
			</tr>
			<tr><td><strong>Redirect / Callback URL: </strong><br>&emsp;<font><small>Editable in <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></font></td>
			<td><input class="mo_table_textbox" id="callbackurl"  type="text" readonly="true" name="mo_oauth_callback_url" value='<?php echo site_url()."";?>'>
			&nbsp;&nbsp;
			<div class="tooltip" style="display: inline;"><span class="tooltiptext" id="moTooltip">Copy to clipboard</span><i class="fa fa-clipboard" style="font-size:20px; align-items: center;vertical-align: middle;" aria-hidden="true" onclick="copyUrl()" onmouseout="outFunc()"></i></div>
			</td>
			</tr>
			<tr id="mo_oauth_custom_app_name_div">
				<td><strong><font color="#FF0000">*</font>App Name (<?php echo $currentapp->type;?>):</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_custom_app_name" name="mo_oauth_custom_app_name" value="" pattern="[a-zA-Z0-9\s]+" required title="Please do not add any special characters." placeholder="Do not add any special characters"></td>
			</tr>
			<tr id="mo_oauth_display_app_name_div">
				<td><strong>Display App Name:</strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></font></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_display_app_name" name="mo_oauth_display_app_name" value="Login with <App Name>" pattern="[a-zA-Z0-9\s]+" disabled title="Please do not add any special characters."></td>
			</tr>
		</table>
		<table class="mo_settings_table" id="mo_oauth_client_creds">
			<tr>
				<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
				<td><input id="mo_oauth_client_id" class="mo_table_textbox" required="" type="text" name="mo_oauth_client_id" value=""></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
				<td><input id="mo_oauth_client_secret" class="mo_table_textbox" required="" type="text"  name="mo_oauth_client_secret" value=""></td>
			</tr>
		</table>
		<table class="mo_settings_table">
			<tr>
				<td><strong>Scope:</strong></td>
				<td><input class="mo_table_textbox" type="text" name="mo_oauth_scope" value="<?php if(isset($currentapp->scope)) echo $currentapp->scope;?>"></td>
			</tr>
		</table>
		<table class="mo_settings_table" id="mo_oauth_client_endpoints">
			<tr id="mo_oauth_authorizeurl_div">
				<td><strong><font color="#FF0000">*</font>Authorize Endpoint:</strong></td>
				<td><input class="mo_table_textbox" required type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value="<?php if(isset($currentapp->authorize)) echo $currentapp->authorize;?>"></td>
			</tr>
			<tr id="mo_oauth_accesstokenurl_div">
				<td><strong><font color="#FF0000">*</font>Access Token Endpoint:</strong></td>
				<td><input class="mo_table_textbox" required type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value="<?php if(isset($currentapp->token)) echo $currentapp->token;?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_authorization_header" value ="1" checked />Set client credentials in Header<span style="padding:0px 0px 0px 8px;"></span><input type="checkbox" name="mo_oauth_body" value ="0"/>Set client credentials in Body<div style="padding:5px;"></div></td>
			</tr>
			<?php if(!isset($currentapp->type) || $currentapp->type=='oauth') {?>
				<tr id="mo_oauth_resourceownerdetailsurl_div">
					<td><strong><font color="#FF0000">*</font>Get User Info Endpoint:</strong></td>
					<td><input class="mo_table_textbox" <?php if(!isset($currentapp->type) || $currentapp->type=='oauth') echo 'required';?> type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value="<?php if(isset($currentapp->userinfo)) echo $currentapp->userinfo;?>"></td>
				</tr>
			<?php } ?>
			<tr>
				<td><strong>login button:</strong></td>
				<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_show_on_login_page" value ="1" checked/>Show on login page</td>
			</tr>
			<tr>
				<td><br></td>
				<td><br></td>
			</tr>
			</table>
			<table class="mo_settings_table">
				<tr>
					<td>&nbsp;</td>
					<td><input id="mo_save_app" type="submit" name="submit_save_app" value="Save settings"
						class="button button-primary button-large" /></td>
				</tr>
			</table>
		</form>

		<div id="instructions">

		</div>
		</div>
		<script>
			jQuery("#mo_save_app").on("click", function(event) {
				event.preventDefault();
				var appName = jQuery("#mo_oauth_custom_app_name").val();
				var action = jQuery("#form-common").attr("action") + appName;
				jQuery("#form-common").attr("action", action);
				document.getElementById("form-common").submit();
			});
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
  				
				// document.getElementById("redirect_url_change_warning").style.display = "none";
			} 
		</script>
		<?php
		grant_type_settings();
	}


}