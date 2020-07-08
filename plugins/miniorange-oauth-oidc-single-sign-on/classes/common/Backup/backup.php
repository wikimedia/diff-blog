<?php


namespace MoOauthClient;

class Backup
{
    function backup()
    {
        global $NQ;
        $Da = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\141\x75\x74\150\137\x61\160\x70\163\137\x6c\x69\x73\164");
        echo "\74\x70\162\145\x3e";
        echo "\x3c\57\160\x72\145\x3e";
        ?>
		<div id="mo_oauth_backup_layout" class="mo_support_layout">
			<h3>Plugin Backup</h3>
			<div class="mo-oauth-client-backup">
                <h4>Current Settings</h4>
				<form id="mo_oauth_backup_form" method="post">
					<input type="hidden" name="option" value="mo_oauth_download_backup">
					<?php 
        wp_nonce_field("\155\157\x5f\157\141\x75\164\x68\137\144\157\x77\156\154\157\141\x64\137\x62\141\143\x6b\165\x70", "\155\157\137\157\x61\165\x74\150\137\144\157\x77\156\x6c\x6f\141\x64\x5f\x62\x61\x63\153\165\x70\137\156\x6f\x6e\143\145");
        ?>
					<input type="submit" name="submit" value="Backup Current Settings" class="button button-primary button-large">
				</form>
			</div>
			<div class="mo-oauth-client-backup">
                <h4>Restore Plugin Settings</h4>
				<form id="mo_oauth_backup_download_form" method="post" enctype="multipart/form-data">
					<input type="hidden" name="option" value="mo_oauth_restore_backup">
					<?php 
        wp_nonce_field("\155\157\137\157\141\165\164\150\137\162\x65\x73\164\157\x72\x65\x5f\142\141\x63\x6b\165\x70", "\x6d\157\x5f\x6f\x61\165\x74\x68\137\x72\x65\x73\164\157\x72\145\137\x62\141\x63\x6b\165\160\x5f\x6e\x6f\156\143\x65");
        ?>
                    Please choose a file: <input name="mo_oauth_client_backup" type="file" id="mo_oauth_client_backup"><br><br>
					<input type="submit" name="submit" value="Restore Existing Backup" class="button button-primary button-large">
				</form>
			</div>
		</div>
	<?php 
    }
}
