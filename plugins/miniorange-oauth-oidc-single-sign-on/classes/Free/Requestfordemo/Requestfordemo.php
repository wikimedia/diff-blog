<?php


namespace MoOauthClient\Free;

use MoOauthClient\Free\RequestForDemoInterface;
class Requestfordemo implements RequestForDemoInterface
{
    private $versi;
    public function __construct()
    {
        $this->versi = VERSION;
    }
    public function render_free_ui()
    {
        global $NQ;
        ?>
		<div id="mo_oauth_requestdemo" class="mo_table_layout mo_oauth_app_requestdemo <?php 
        echo $CM;
        ?>
">
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings&tab=requestfordemo">
			<input type="hidden" name="option" value="mo_oauth_app_requestdemo" />
			<?php 
        wp_nonce_field("\x6d\157\x5f\x6f\141\165\164\150\x5f\x61\x70\x70\x5f\x72\145\x71\x75\x65\x73\164\144\x65\x6d\157", "\x6d\157\x5f\157\141\x75\164\150\137\141\160\160\137\x72\x65\x71\x75\x65\163\x74\x64\x65\155\x6f\x5f\156\x6f\156\x63\145");
        ?>
			<table class="mo_settings_table" cellpadding="4" cellspacing="4">
				<tr>
					<td><strong>Email : </strong></td>
					<td><input required type="text" style="<?php 
        echo $fB;
        ?>
" name="mo_oauth_client_demo_email" placeholder="Email for demo setup" value="<?php 
        echo get_option("\155\157\137\157\141\165\164\150\x5f\x61\x64\155\x69\156\x5f\145\x6d\x61\151\x6c");
        ?>
" /></td>
				</tr>
				<tr>
					<td><strong>Request a demo for : </strong></td>
					<td>
						<select required style="<?php 
        echo $fB;
        ?>
" name="mo_oauth_client_demo_plan" id="mo_oauth_client_demo_plan_id" onclick="moOauthClientAddDescriptionjs()">
							<option disabled selected>------------------ Select ------------------</option>
							<option value="WP OAuth Client Standard Plugin">WP OAuth Client Standard Plugin</option>
							<option value="WP OAuth Client Premium Plugin">WP OAuth Client Premium Plugin</option>
							<option value="WP OAuth Client Enterprise Plugin">WP OAuth Client Enterprise Plugin</option>
							<option value="Not Sure">Not Sure</option>
						</select>
					</td>
				</tr>
				<tr id="demoDescription" style="display:none;">
					<td><strong>Description : </strong></td>
					<td>
						<textarea type="text" name="mo_oauth_client_demo_description" style="resize: vertical; width:350px; height:100px;" rows="4" placeholder="Need assistance? Write us about your requirement and we will suggest the relevant plan for you." value="<?php 
        isset($lp);
        ?>
" /></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="submit" value="Submit Demo Request" class="button button-primary button-large" /></td>
				</tr>
			</table>
		</form>
		</div>
		<script type="text/javascript">
			function moOauthClientAddDescriptionjs() {
				// alert("working");
				var x = document.getElementById("mo_oauth_client_demo_plan_id").selectedIndex;
				var otherOption = document.getElementById("mo_oauth_client_demo_plan_id").options;
				if (otherOption[x].index == 4){
					demoDescription.style.display = "";
				} else {
					demoDescription.style.display = "none";
				}
			}
		</script>
		<?php 
    }
}
