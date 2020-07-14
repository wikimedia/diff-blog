<?php


namespace MoOauthClient\Free;

class Feedback
{
    public function show_form()
    {
        global $NQ;
        $QW = isset($_SERVER["\x50\110\120\137\x53\105\x4c\x46"]) ? sanitize_text_field(wp_unslash($_SERVER["\120\110\x50\137\x53\x45\x4c\x46"])) : '';
        if (!("\x70\x6c\165\x67\151\x6e\163\x2e\160\150\160" !== basename($QW))) {
            goto fE;
        }
        return;
        fE:
        $this->enqueue_styles();
        if ($NQ->check_versi(1)) {
            goto BO;
        }
        $this->render_feedback_form();
        BO:
    }
    private function enqueue_styles()
    {
        wp_enqueue_style("\167\160\x2d\x70\157\x69\x6e\164\x65\x72");
        wp_enqueue_script("\x77\160\x2d\160\x6f\x69\x6e\164\145\162");
        wp_enqueue_script("\x75\164\x69\x6c\x73");
        wp_enqueue_style("\155\157\x5f\157\x61\165\164\x68\x5f\146\145\145\144\142\x61\143\x6b\x5f\163\x74\171\154\x65", MOC_URL . "\143\x6c\141\x73\163\145\163\x2f\106\162\145\145\x2f\162\145\163\157\x75\x72\143\x65\x73\x2f\146\x65\145\144\142\x61\143\153\56\143\x73\x73", array(), $WD = null, $M5 = false);
    }
    private function render_feedback_form()
    {
        ?>
		<div id="oauth_client_feedback_modal" class="mo_modal">
			<div class="mo_modal-content">
				<span class="mo_close">&times;</span>
				<h3>Tell us what happened? </h3>
				<form name="f" method="post" action="" id="mo_oauth_client_feedback">
					<input type="hidden" name="option" value="mo_oauth_client_feedback"/>
					<?php 
        wp_nonce_field("\x6d\157\137\157\141\165\164\x68\137\x63\154\151\x65\x6e\164\x5f\x66\x65\145\x64\x62\x61\143\x6b", "\x6d\x6f\x5f\x6f\x61\165\164\150\x5f\143\154\x69\145\156\x74\x5f\146\145\145\x64\x62\x61\x63\153\137\x6e\x6f\x6e\143\x65");
        ?>
					<div>
						<p style="margin-left:2%">
						<?php 
        $this->render_radios();
        ?>
						<br>
						<textarea id="query_feedback" name="query_feedback" rows="4" style="margin-left:2%;width: 330px"
								placeholder="Write your query here"></textarea>
						<br><br>
						<div class="mo_modal-footer">
							<input type="submit" name="miniorange_feedback_submit"
								class="button button-primary button-large" style="float: left;" value="Submit"/>
							<input id="mo_skip" type="submit" name="miniorange_feedback_skip"
								class="button button-primary button-large" style="float: right;" value="Skip"/>
						</div>
					</div>
				</form>
				<form name="f" method="post" action="" id="mo_feedback_form_close">
					<input type="hidden" name="option" value="mo_oauth_client_skip_feedback"/>
					<?php 
        wp_nonce_field("\x6d\157\x5f\157\141\x75\x74\x68\137\x63\154\x69\x65\156\x74\137\x73\x6b\151\x70\x5f\146\x65\x65\x64\142\x61\143\153", "\x6d\157\x5f\x6f\141\165\x74\150\137\x63\154\x69\x65\156\164\137\x73\153\x69\160\137\x66\145\x65\x64\x62\141\x63\153\x5f\156\x6f\x6e\x63\x65");
        ?>
				</form>
			</div>
		</div>
		<?php 
        $this->emit_script();
    }
    private function emit_script()
    {
        ?>
		<script>
			jQuery('a[aria-label="Deactivate OAuth Single Sign On - SSO (OAuth client)"]').click(function () {
				var mo_modal = document.getElementById('oauth_client_feedback_modal');
				var mo_skip = document.getElementById('mo_skip');
				var span = document.getElementsByClassName("mo_close")[0];
				mo_modal.style.display = "block";
				jQuery('input:radio[name="deactivate_reason_radio"]').click(function () {
					var reason = jQuery(this).val();
					var query_feedback = jQuery('#query_feedback');
					query_feedback.removeAttr('required')
					if (reason === "Does not have the features I'm looking for") {
						query_feedback.attr("placeholder", "Let us know what feature are you looking for");
					} else if (reason === "Other Reasons:") {
						query_feedback.attr("placeholder", "Can you let us know the reason for deactivation");
						query_feedback.prop('required', true);
					} else if (reason === "Bugs in the plugin") {
						query_feedback.attr("placeholder", "Can you please let us know about the bug in detail?");
					} else if (reason === "Confusing Interface") {
						query_feedback.attr("placeholder", "Finding it confusing? let us know so that we can improve the interface");
					} else if (reason === "Endpoints not available") {
						query_feedback.attr("placeholder", "We will send you the Endpoints shortly, if you can tell us the name of your OAuth Server/App?");
					} else if (reason === "Unable to register") {
						query_feedback.attr("placeholder", "Error while receiving OTP? Can you please let us know the exact error?");
					}
				});
				span.onclick = function () {
					mo_modal.style.display = "none";
					jQuery('#mo_feedback_form_close').submit();
				}
				mo_skip.onclick = function() {
					mo_modal.style.display = "none";
					jQuery('#mo_feedback_form_close').submit();
				}
				window.onclick = function (event) {
					if (event.target == mo_modal) {
						mo_modal.style.display = "none";
					}
				}
				return false;
			});
		</script>
		<?php 
    }
    private function render_radios()
    {
        $vi = array("\104\x6f\x65\163\40\x6e\157\x74\40\150\x61\x76\x65\40\x74\x68\145\40\x66\x65\x61\164\165\162\145\163\40\111\x20\141\155\40\x6c\x6f\x6f\x6b\x69\156\147\40\146\x6f\162", "\104\x6f\40\156\157\x74\40\x77\x61\x6e\164\x20\x74\x6f\x20\165\160\x67\162\x61\144\145\x20\164\x6f\40\120\x72\x65\x6d\x69\165\x6d\40\x76\145\162\163\151\157\x6e", "\x43\x6f\x6e\146\165\x73\151\x6e\147\40\x49\x6e\x74\x65\x72\x66\141\143\x65", "\x42\x75\x67\163\x20\x69\x6e\x20\164\150\145\x20\x70\154\165\147\x69\x6e", "\x55\x6e\x61\142\x6c\145\40\x74\x6f\x20\162\145\x67\x69\x73\164\145\162", "\105\x6e\x64\x70\x6f\151\x6e\164\x73\x20\156\x6f\164\x20\141\166\x61\151\x6c\x61\x62\x6c\145", "\117\x74\x68\x65\162\x20\122\x65\141\163\157\156\163");
        foreach ($vi as $p0) {
            ?>
			<div class="radio" style="padding:1px;margin-left:2%">
				<label style="font-weight:normal;font-size:14.6px" for="<?php 
            echo wp_kses($p0, \get_valid_html());
            ?>
">
					<input type="radio" name="deactivate_reason_radio" value="<?php 
            echo wp_kses($p0, \get_valid_html());
            ?>
"
						required>
					<?php 
            echo wp_kses($p0, \get_valid_html());
            ?>
				</label>
			</div>
			<?php 
            O1:
        }
        vm:
    }
}
