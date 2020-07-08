<?php


function show_extra_attributes($user)
{
    global $NQ;
    $SY = get_user_meta($user->ID, "\155\157\x5f\x6f\141\165\164\x68\x5f\143\x75\x73\x74\157\x6d\137\x61\x74\x74\162\151\142\165\x74\145\163");
    if (!$SY || !is_array($SY) || empty($SY)) {
        goto iu;
    }
    $SY = $SY[0];
    goto Tk;
    iu:
    return;
    Tk:
    ?>
	<h3>Extra profile information</h3>
	<table class="form-table" style="width:75%; border: 1px solid #aaa;">
		<tr>
			<td style="border: 1px solid #ccc;"><label for="user">User Name</label></td>
			<td style="border: 1px solid #ccc;"><strong><?php 
    echo esc_attr(get_the_author_meta("\144\x69\x73\x70\x6c\141\x79\137\x6e\141\155\x65", $user->ID));
    ?>
</strong></td>
		</tr>
		<?php 
    foreach ($SY as $ZZ => $Da) {
        ?>
			<tr>
				<td style="border: 1px solid #ccc;"><strong><?php 
        echo wp_kses($ZZ, get_valid_html());
        ?>
</strong></td>
				<td style="border: 1px solid #ccc;"><strong><?php 
        echo wp_kses($Da, get_valid_html());
        ?>
</strong></td>
			</tr>
		<?php 
        h9:
    }
    qi:
    ?>
	</table>
	<?php 
}
add_action("\x73\x68\157\x77\x5f\165\x73\145\x72\137\160\x72\157\x66\151\x6c\145", "\x73\150\x6f\167\x5f\145\x78\x74\x72\141\x5f\141\164\x74\162\151\142\x75\164\x65\x73");
add_action("\145\144\x69\x74\x5f\x75\x73\145\x72\x5f\x70\162\x6f\x66\151\x6c\x65", "\163\x68\x6f\167\137\x65\x78\x74\162\x61\137\141\164\164\x72\x69\x62\165\x74\x65\163");
function control_password_grant()
{
    global $NQ;
    $yZ = new MoOauthClient\GrantTypes\Password();
    $yZ->inject_ui();
    $yZ->inject_behaviour();
}
add_action("\x6d\x6f\137\x6f\141\x75\x74\x68\137\x63\x6c\151\x65\156\x74\x5f\141\144\144\137\160\x77\144\137\152\163", "\x63\157\156\x74\x72\x6f\x6c\x5f\x70\141\163\x73\167\x6f\162\x64\137\x67\x72\x61\x6e\x74");
function enqueue_pwd_essentials()
{
    ?>
	<link rel="stylesheet" href="<?php 
    echo MOC_URL . "\143\154\141\x73\163\145\163\57\120\162\145\x6d\151\x75\x6d\57\x72\x65\x73\x6f\x75\162\143\x65\163\57\x70\167\144\163\x74\x79\154\x65\56\143\x73\163";
    ?>
">
	<script src="<?php 
    echo MOC_URL . "\x63\154\141\163\163\145\x73\x2f\x50\162\145\155\151\x75\x6d\x2f\162\145\163\x6f\165\162\x63\x65\163\57\152\x71\x75\x65\x72\x79\56\155\151\x6e\56\x6a\x73";
    ?>
"></script>
	<script src="<?php 
    echo MOC_URL . "\x63\x6c\141\163\x73\x65\x73\57\x50\162\145\x6d\151\x75\155\57\162\x65\163\x6f\165\162\x63\145\163\x2f\x70\167\144\x2e\152\x73";
    ?>
"></script>
	<?php 
}
add_action("\160\x77\144\x5f\x65\x73\163\x65\x6e\x74\x69\x61\x6c\x73\137\151\x6e\164\x65\x72\x6e\x61\154", "\x65\x6e\161\165\145\x75\x65\x5f\x70\x77\144\x5f\145\x73\163\145\x6e\164\151\141\154\x73");
