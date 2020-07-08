<?php


global $NQ;
function mo_oauth_client_render_grant_settings($Rz, $zk)
{
    global $NQ;
    $WK = isset($Rz["\x6a\167\164\x5f\x73\165\160\x70\157\162\x74"]) ? $Rz["\152\x77\164\x5f\163\165\x70\x70\x6f\162\164"] : 0;
    $DJ = isset($Rz["\152\x77\x74\137\x61\154\x67\157"]) ? $Rz["\152\167\164\x5f\x61\154\x67\x6f"] : "\x48\123\101";
    $Dv = isset($Rz["\170\x35\60\71\137\x63\x65\x72\164"]) ? $Rz["\x78\65\60\x39\x5f\x63\145\x72\x74"] : '';
    $mh = isset($Rz["\x70\153\x63\145\137\x66\x6c\157\x77"]) ? $Rz["\160\153\x63\x65\x5f\146\154\x6f\x77"] : 0;
    $eG = "\163\145\154\x65\143\164\145\x64";
    $hZ = "\152\167\153\163\137\165\x72\x69";
    ?>
	<div class="mo_table_layout" id="grant_settings">
		<form name="form-common" id="multipurpose-form" method="post" action="admin.php?page=mo_oauth_settings">
			<input type="hidden" name="option" value="mo_oauth_grant_settings" />
			<?php 
    wp_nonce_field("\155\x6f\137\x6f\141\x75\164\x68\137\x67\162\x61\x6e\164\137\x73\x65\x74\164\x69\x6e\147\163", "\155\157\x5f\x6f\141\165\x74\x68\137\147\x72\x61\x6e\164\x5f\x73\145\x74\x74\151\x6e\x67\163\137\156\157\x6e\143\x65");
    ?>
			<input required="" type="hidden" id="mo_oauth_app_name2" name="mo_oauth_app_name" value="<?php 
    echo $zk;
    ?>
">
			<h3>Advanced Grant Type Configuration</h3>
				<div id="implicit-grant-settings">
					<table class="mo_settings_table" id="granttypetable">
						<tr>
							<td><strong>Enable JWT Verification:</strong></td>
							<td><input id="jwt_support" onclick="toggle_jwt(this)" type="checkbox" name="jwt_support" value="" <?php 
    echo 1 === $WK ? "\x63\150\145\x63\153\x65\144" : '';
    ?>
 /></td>
						</tr>
						<tr>
							<td><strong>JWT Signing Algorithm:</strong></td>
							<td><select onclick="selectAlgo(this)" id="jwt_algo" <?php 
    echo 1 === $WK ? '' : "\x64\x69\163\141\142\x6c\x65\x64";
    ?>
 name="jwt_algo">
									<option <?php 
    echo wp_kses("\110\x53\101" === $DJ ? $eG : '', get_valid_html());
    ?>
>HSA</option>
									<option <?php 
    echo wp_kses("\x52\x53\x41" === $DJ ? $eG : '', get_valid_html());
    ?>
>RSA</option>
								</select>
							</td>
						</tr>
						<tr <?php 
    echo "\x52\x53\x41" !== $DJ ? "\150\151\x64\x64\x65\x6e" : '';
    ?>
 id="x509_cert">
							<td>
								<strong>
									<span id='req-star' class="mo_premium_feature">
										<?php 
    echo "\x52\x53\x41" === $DJ && (isset($Rz[$hZ]) && '' === $Rz[$hZ]) ? "\x2a" : '';
    ?>
									</span>X509 Certificate:
								</strong>
							</td>
							<td>
								<textarea id="rsa_cert" style="resize:none;" <?php 
    echo "\x52\x53\x41" === $DJ && (isset($Rz[$hZ]) && '' === $Rz[$hZ]) ? "\x72\x65\161\x75\x69\162\145\144" : '';
    ?>
 rows="10" cols="50" name="mo_oauth_x509_cert"><?php 
    echo $Dv;
    ?>
</textarea>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><strong>PKCE (Proof Key for Code Exchange):</strong></td>
							<td><input <?php 
    echo !$NQ->check_versi(3) ? "\x64\151\x73\x61\142\154\x65\144" : '';
    ?>
 id="pkce_flow" type="checkbox" name="pkce_flow" value="0" <?php 
    echo 1 === $mh ? "\x63\x68\x65\143\x6b\145\144" : '';
    ?>
 /></td>
						</tr>
					</table>
					<p style="font-size:12px"><strong>Note: </strong>Select PKCE only when you are using Authorization Code Grant. You can enter any value in the client secret field.</p>
				</div>
			<br><br>
			<input type="submit" name="submit" value="Save settings" class="button button-primary button-large" style="margin: 10px;" />
		</form>
	</div>
		<script>
			function toggle_jwt(element) {
				if(element.checked) {
					document.getElementById("jwt_algo").disabled = false;
				} else {
					document.getElementById("jwt_algo").disabled = true;
				}
			}

			function selectAlgo(element) {
				var algo = element.options[element.selectedIndex].text;
				if(algo === "RSA") {
					document.getElementById("x509_cert").hidden = false;
					document.getElementById("req-star").innerHTML = "*";
					if(document.getElementById("mo_oauth_jwksurl").value === "") {
						document.getElementById("rsa_cert").required = true;
					} else {
						document.getElementById("req-star").hidden = true;
					}
					document.getElementById("rsa_cert").disabled = false;
					document.getElementById("rsa_cert").value = "";
					document.getElementById("jwt_algo").disabled = false;
				} else {
					document.getElementById("x509_cert").hidden = true;
					document.getElementById("rsa_cert").required = false;
					document.getElementById("rsa_cert").value = "";
					document.getElementById("req-star").innerHTML = "";
				}
			}

			jQuery(document).ready(function() {
				moAdjustFields();
			});

			function moAdjustFields() {
				var $mo = jQuery;
				var algo = $mo("#jwt_algo").val();
				if( "HSA" == algo && $mo("mo_oauth_jwksurl").value === "") {
					$mo("rsa_cert").required = true;
				} else {
					$mo("req-star").hidden = true;
					$mo("rsa_cert").required = false;
				}
			}
		</script>

		<?php 
}
add_action("\155\x6f\x5f\157\x61\165\164\150\x5f\x63\154\151\x65\156\164\x5f\147\162\x61\x6e\x74\x5f\x73\145\164\164\151\x6e\x67\163\137\151\x6e\164\145\162\x6e\141\x6c", "\x6d\157\137\x6f\141\x75\x74\x68\137\143\x6c\151\x65\156\x74\137\162\145\156\144\x65\x72\137\147\x72\141\x6e\x74\x5f\163\145\x74\164\151\x6e\x67\163", 10, 2);
function add_grant_type_dd($Rz)
{
    global $NQ;
    $Xx = isset($Rz["\147\x72\141\x6e\164\137\164\x79\160\x65"]) ? $Rz["\x67\162\141\156\164\137\164\x79\160\145"] : "\101\165\164\150\x6f\x72\151\x7a\141\164\x69\157\156\x20\103\157\x64\145\40\x47\162\x61\156\164";
    $eG = "\x73\x65\154\x65\143\x74\145\x64";
    ?>
	<tr>
		<td><strong>Grant Type:</strong><br></td>
		<td><select id="grant_type" name="grant_type">
				<option <?php 
    echo wp_kses("\x41\x75\164\x68\x6f\162\151\x7a\x61\164\151\x6f\x6e\x20\x43\157\144\145\x20\x47\x72\x61\156\164" === $Xx ? $eG : '', get_valid_html());
    ?>
>Authorization Code Grant</option>
				<option <?php 
    echo wp_kses("\x49\x6d\x70\154\x69\143\x69\164\40\x47\162\141\156\164" === $Xx ? $eG : '', get_valid_html());
    ?>
>Implicit Grant</option>
				<option <?php 
    echo wp_kses("\120\x61\163\163\x77\157\x72\144\x20\x47\162\141\x6e\164" === $Xx ? $eG : '', get_valid_html());
    ?>
>Password Grant</option>
			</select>
		</td>
	</tr>
	<?php 
    $Wx = $NQ->mo_oauth_client_get_option("\155\157\137\157\141\x75\164\x68\137\145\156\141\x62\x6c\x65\x5f\x6f\141\x75\164\x68\x5f\x77\x70\137\154\x6f\x67\151\156");
    $Wx = $Wx && $Rz["\141\160\160\x49\x64"] === $Wx;
    if (!("\120\141\x73\163\167\157\162\144\x20\107\x72\x61\x6e\x74" === $Xx)) {
        goto qQ;
    }
    ?>
		<tr>
			<td>&nbsp;</td>
			<td><input type="checkbox" <?php 
    echo $Wx ? "\x63\x68\145\143\153\x65\144" : '';
    ?>
 name="enable_oauth_wp_login" id="enable_oauth_wp_login">&nbsp;<strong>Check this if you want to allow users to login through default WordPress Login form.</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<?php 
    qQ:
}
add_action("\x6d\x6f\x5f\157\x61\165\x74\150\137\x63\x6c\x69\x65\156\164\137\x67\x72\141\156\x74\137\x64\144\x5f\151\156\164\x65\162\156\x61\x6c", "\x61\x64\144\x5f\147\162\x61\x6e\x74\137\164\171\x70\x65\137\144\144", 10, 1);
