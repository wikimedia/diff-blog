<?php


function mo_oauth_client_page_restriction()
{
    global $NQ;
    $HC = $NQ->get_plugin_config();
    $ng = $HC->get_config("\162\145\163\164\x72\151\x63\x74\x5f\x74\x6f\137\x6c\157\147\147\x65\x64\137\x69\156\x5f\x75\x73\145\x72\163");
    $ng = '' !== $ng ? $ng : false;
    $F1 = $HC->get_config("\141\165\x74\x6f\137\162\145\x64\151\162\x65\143\164\137\x65\170\143\x6c\x75\144\145\x5f\x75\162\154\x73");
    if (!(!is_user_logged_in() && boolval($ng))) {
        goto vw8;
    }
    if (!("\x50\x4f\x53\124" === $_SERVER["\x52\x45\x51\x55\105\x53\x54\x5f\x4d\105\x54\x48\117\x44"])) {
        goto s08;
    }
    return;
    s08:
    if (!(isset($_REQUEST["\157\x61\x75\164\150\x6c\157\147\151\x6e"]) && "\x66\x61\x6c\x73\x65" === $_REQUEST["\x6f\x61\165\x74\150\x6c\x6f\x67\x69\x6e"])) {
        goto fDf;
    }
    return;
    fDf:
    if (!(isset($_REQUEST[\MoOAuthConstants::OPTION]) && "\x6f\x61\165\x74\150\x72\145\144\151\162\145\143\164" === $_REQUEST[\MoOAuthConstants::OPTION])) {
        goto YSr;
    }
    return;
    YSr:
    if (!(isset($_REQUEST["\143\x6f\x64\145"]) && '' !== $_REQUEST["\143\x6f\x64\x65"])) {
        goto Abm;
    }
    return;
    Abm:
    if (!(isset($_REQUEST["\141\x63\x63\145\x73\163\137\164\157\x6b\145\x6e"]) && '' !== $_REQUEST["\x61\x63\143\x65\163\x73\137\x74\x6f\x6b\145\x6e"])) {
        goto QpW;
    }
    return;
    QpW:
    if (!(isset($_REQUEST["\154\157\x67\151\x6e"]) && "\160\167\x64\x67\x72\156\x74\146\x72\155" === $_REQUEST["\x6c\x6f\x67\151\156"])) {
        goto o7j;
    }
    return;
    o7j:
    if (empty($F1)) {
        goto k8M;
    }
    $fQ = $NQ->get_current_url();
    $fQ = trim($fQ, "\57");
    $F1 = explode("\12", $F1);
    foreach ($F1 as $Fu) {
        $Fu = trim($Fu, "\x2f");
        if (empty($Fu)) {
            goto Ykc;
        }
        if (!($fQ === $Fu)) {
            goto g1O;
        }
        return;
        g1O:
        Ykc:
        FRe:
    }
    pPY:
    k8M:
    $CG = $NQ->get_app_by_name();
    if ($CG) {
        goto OrQ;
    }
    return;
    OrQ:
    $Zg = $CG->get_app_config("\141\x66\164\x65\162\137\x6c\x6f\147\151\156\x5f\x75\x72\154");
    $fQ = $Zg ? $Zg : $NQ->get_current_url();
    echo "\x52\145\144\x69\162\145\143\x74\x69\156\x67\x20\164\157\40\144\145\x66\x61\165\154\x74\x20\154\x6f\147\x69\156\x2e\56\x2e";
    ?>
		<script>
			var url = "<?php 
    echo site_url();
    ?>
";
			url = url + '/?option=oauthredirect&app_name=' + "<?php 
    echo wp_kses($CG->get_app_name(), \get_valid_html());
    ?>
" + '&redirect_url=' + "<?php 
    echo rawurlencode($fQ);
    ?>
" + '&restrictredirect=true';
			window.location.replace( url );
		</script>
		<?php 
    vw8:
}
add_action("\x69\156\x69\164", "\x6d\x6f\x5f\x6f\141\165\x74\x68\137\x63\154\151\145\156\164\x5f\x70\141\147\145\x5f\x72\x65\x73\164\162\x69\143\164\151\x6f\x6e");
