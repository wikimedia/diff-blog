<?php


namespace MoOauthClient\Free;

use MoOauthClient\AppUI;
use MoOauthClient\App\UpdateAppUI;
use MoOauthClient\AppGuider;
class ClientAppUI
{
    private $common_app_ui;
    public function __construct()
    {
        $this->common_app_ui = new AppUI();
    }
    public function render_free_ui()
    {
        $cb = $this->common_app_ui->get_apps_list();
        if (!(isset($_GET["\141\143\x74\x69\157\156"]) && "\144\145\x6c\x65\x74\x65" === $_GET["\141\x63\164\x69\157\156"])) {
            goto Ca;
        }
        if (!isset($_GET["\x61\x70\160"])) {
            goto qy;
        }
        $this->common_app_ui->delete_app($_GET["\141\160\160"]);
        return;
        qy:
        Ca:
        if (!(isset($_GET["\x61\x63\164\x69\x6f\156"]) && "\151\x6e\163\164\x72\x75\143\164\151\157\156\x73" === $_GET["\141\143\164\x69\x6f\x6e"] || isset($_GET["\163\150\157\x77"]) && "\x69\x6e\163\164\162\165\143\164\x69\157\156\163" === $_GET["\x73\x68\x6f\x77"])) {
            goto KD;
        }
        if (!(isset($_GET["\141\160\x70\x49\144"]) && isset($_GET["\146\x6f\162"]))) {
            goto Wj;
        }
        $qC = new AppGuider($_GET["\x61\x70\160\111\144"], $_GET["\x66\157\x72"]);
        $qC->show_guide();
        Wj:
        if (!(isset($_GET["\x73\x68\x6f\x77"]) && "\x69\156\163\x74\162\x75\x63\164\151\x6f\156\x73" === $_GET["\x73\x68\x6f\167"])) {
            goto ro;
        }
        $qC = new AppGuider($_GET["\141\160\x70\111\144"]);
        $qC->show_guide();
        $this->common_app_ui->add_app_ui();
        return;
        ro:
        KD:
        if (!(isset($_GET["\141\x63\164\x69\x6f\156"]) && "\141\x64\x64" === $_GET["\141\x63\x74\151\x6f\156"])) {
            goto nB;
        }
        $this->common_app_ui->add_app_ui();
        return;
        nB:
        if (!(isset($_GET["\x61\x63\x74\151\157\x6e"]) && "\165\x70\x64\141\x74\145" === $_GET["\x61\x63\164\151\157\x6e"])) {
            goto pf;
        }
        if (!isset($_GET["\x61\x70\x70"])) {
            goto mC;
        }
        $X1 = $this->common_app_ui->get_app_by_name($_GET["\x61\x70\160"]);
        new UpdateAppUI($_GET["\141\x70\x70"], $X1);
        return;
        mC:
        pf:
        if (!(isset($_GET["\x61\x63\x74\151\157\x6e"]) && "\x61\x64\144\x5f\156\x65\167" === $_GET["\141\143\164\151\x6f\156"])) {
            goto Yu;
        }
        $this->common_app_ui->add_app_ui();
        return;
        Yu:
        if (!(is_array($cb) && count($cb) > 0)) {
            goto CZ;
        }
        $this->common_app_ui->show_apps_list_page();
        return;
        CZ:
        $this->common_app_ui->add_app_ui();
    }
}
