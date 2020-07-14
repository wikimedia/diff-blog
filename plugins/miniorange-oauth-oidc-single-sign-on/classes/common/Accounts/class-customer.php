<?php


namespace MoOauthClient;

class Customer
{
    public $email;
    public $phone;
    private $default_customer_key = "\x31\x36\65\65\x35";
    private $default_api_key = "\x66\x46\144\x32\x58\x63\x76\124\x47\x44\145\155\x5a\166\x62\167\x31\x62\x63\x55\145\163\x4e\112\127\105\161\x4b\x62\142\x55\x71";
    private $host_name = '';
    private $host_key = '';
    public function __construct()
    {
        global $NQ;
        $this->host_name = $NQ->mo_oauth_client_get_option("\x68\157\163\164\137\156\x61\x6d\x65");
        $this->email = $NQ->mo_oauth_client_get_option("\x6d\x6f\x5f\157\x61\165\x74\x68\137\x61\144\155\151\156\x5f\145\x6d\x61\x69\x6c");
        $this->phone = $NQ->mo_oauth_client_get_option("\155\157\x5f\157\141\165\164\150\x5f\141\144\155\151\x6e\137\x70\150\157\156\145");
        $this->host_key = $NQ->mo_oauth_client_get_option("\160\x61\163\163\167\x6f\162\x64");
    }
    public function create_customer()
    {
        global $NQ;
        $Ho = $this->host_name . "\57\x6d\x6f\x61\x73\57\162\x65\x73\164\x2f\143\x75\163\164\x6f\155\145\162\57\141\144\144";
        $Ij = $this->host_key;
        $nn = $NQ->mo_oauth_client_get_option("\155\157\x5f\x6f\x61\165\x74\x68\x5f\141\144\155\151\x6e\137\146\x6e\x61\x6d\x65");
        $yt = $NQ->mo_oauth_client_get_option("\x6d\157\137\157\141\x75\x74\150\x5f\x61\144\155\x69\x6e\137\x6c\x6e\141\x6d\x65");
        $MD = $NQ->mo_oauth_client_get_option("\x6d\157\137\x6f\x61\x75\164\x68\137\141\x64\155\x69\156\137\143\x6f\155\x70\x61\x6e\171");
        $cr = array("\x63\157\155\160\141\156\x79\116\141\155\145" => $MD, "\x61\x72\x65\141\x4f\146\111\156\164\x65\x72\145\163\x74" => "\x57\x50\40\x4f\101\165\164\150\40\103\x6c\151\145\x6e\x74", "\x66\151\162\x73\x74\x6e\141\x6d\145" => $nn, "\x6c\141\163\164\156\141\x6d\x65" => $yt, \MoOAuthConstants::EMAIL => $this->email, "\160\x68\x6f\156\145" => $this->phone, "\x70\x61\163\163\x77\x6f\162\x64" => $Ij);
        $p2 = wp_json_encode($cr);
        return $this->send_request(array(), false, $p2, array(), false, $Ho);
    }
    public function get_customer_key()
    {
        global $NQ;
        $Ho = $this->host_name . "\x2f\155\x6f\x61\163\57\x72\x65\163\x74\57\x63\x75\x73\x74\157\155\145\162\x2f\153\x65\171";
        $yY = $this->email;
        $Ij = $this->host_key;
        $cr = array(\MoOAuthConstants::EMAIL => $yY, "\160\141\163\163\x77\157\x72\x64" => $Ij);
        $p2 = wp_json_encode($cr);
        return $this->send_request(array(), false, $p2, array(), false, $Ho);
    }
    public function add_oauth_application($jd, $UB)
    {
        global $NQ;
        $Ho = $this->host_name . "\57\x6d\157\141\163\57\x72\x65\x73\x74\x2f\141\x70\x70\154\151\143\x61\164\151\x6f\x6e\x2f\141\144\144\157\x61\165\x74\x68";
        $u0 = $NQ->mo_oauth_client_get_option("\x6d\157\137\157\x61\165\164\150\137\141\x64\155\151\x6e\137\x63\x75\x73\x74\157\x6d\145\162\137\x6b\x65\171");
        $Ld = $NQ->mo_oauth_client_get_option("\155\x6f\137\x6f\141\x75\x74\150\137" . $jd . "\137\x73\x63\157\160\x65");
        $Wi = $NQ->mo_oauth_client_get_option("\155\157\x5f\x6f\141\165\164\x68\x5f" . $jd . "\137\x63\154\151\145\x6e\x74\137\x69\x64");
        $KO = $NQ->mo_oauth_client_get_option("\155\157\137\x6f\141\x75\x74\x68\x5f" . $jd . "\x5f\143\x6c\151\145\156\164\137\x73\x65\x63\162\x65\164");
        if (false !== $Ld) {
            goto Gv;
        }
        $cr = array("\141\160\160\154\151\x63\141\164\151\157\156\116\141\155\x65" => $UB, "\143\x75\x73\x74\157\155\x65\x72\x49\x64" => $u0, "\x63\154\151\x65\156\x74\x49\144" => $Wi, "\x63\x6c\x69\x65\156\164\123\x65\x63\162\145\x74" => $KO);
        goto Ud;
        Gv:
        $cr = array("\141\160\160\154\x69\143\x61\x74\151\157\156\x4e\x61\155\x65" => $UB, "\x73\143\157\x70\x65" => $Ld, "\x63\x75\x73\x74\x6f\x6d\145\162\111\144" => $u0, "\x63\154\151\145\x6e\x74\111\x64" => $Wi, "\143\154\151\x65\156\x74\123\145\143\x72\145\164" => $KO);
        Ud:
        $p2 = wp_json_encode($cr);
        return $this->send_request(array(), false, $p2, array(), false, $Ho);
    }
    public function submit_contact_us($yY, $d1, $p7, $wm = true)
    {
        global $current_user;
        global $NQ;
        wp_get_current_user();
        $Vn = $NQ->export_plugin_config(true);
        $HS = json_encode($Vn, JSON_UNESCAPED_SLASHES);
        $u0 = $this->default_customer_key;
        $om = $this->default_api_key;
        $sJ = time();
        $Ho = $this->host_name . "\x2f\x6d\x6f\141\x73\x2f\141\x70\x69\x2f\156\x6f\x74\151\146\171\x2f\163\145\156\144";
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\x73\x68\x61\x35\x31\x32", $N8);
        $TZ = $yY;
        $G_ = \ucwords(\strtolower($NQ->get_versi_str())) . "\x20\x2d\40" . \get_version_number();
        $MW = "\x51\165\145\162\x79\x3a\40\x57\157\x72\144\120\162\145\x73\163\x20\117\101\x75\164\150\x20" . $G_ . "\40\x50\154\165\147\x69\x6e";
        $p7 = "\x5b\127\120\x20\x4f\x41\165\x74\150\40\103\x6c\x69\x65\x6e\x74\40" . $G_ . "\x5d\40" . $p7;
        if (!$wm) {
            goto tu;
        }
        $p7 .= "\x3c\142\162\x3e\74\x62\x72\x3e\103\x6f\x6e\x66\x69\147\40\123\x74\162\x69\156\147\x3a\x3c\142\x72\76\x3c\160\162\x65\40\x73\164\171\x6c\145\75\42\142\157\162\x64\x65\x72\72\x31\160\x78\x20\x73\x6f\x6c\151\144\40\x23\64\64\64\73\160\x61\x64\x64\x69\x6e\x67\x3a\x31\60\160\x78\73\42\76\x3c\143\x6f\x64\145\76" . $HS . "\74\x2f\x63\157\x64\145\x3e\74\x2f\x70\162\145\76";
        tu:
        $W3 = isset($_SERVER["\x53\105\x52\126\105\x52\137\x4e\101\x4d\105"]) ? sanitize_text_field(wp_unslash($_SERVER["\123\105\x52\x56\105\122\x5f\116\x41\x4d\x45"])) : '';
        $mg = "\x3c\144\151\x76\40\x3e\110\x65\154\x6c\157\54\x20\x3c\142\162\76\74\142\162\x3e\106\x69\162\x73\164\x20\x4e\x61\x6d\145\x20\x3a" . $current_user->user_firstname . "\x3c\142\x72\x3e\x3c\142\x72\x3e\x4c\141\163\164\x20\40\x4e\x61\155\145\x20\x3a" . $current_user->user_lastname . "\x20\x20\40\x3c\142\162\x3e\x3c\x62\x72\x3e\x43\x6f\x6d\x70\x61\156\171\x20\72\74\x61\x20\x68\162\x65\x66\75\x22" . $W3 . "\x22\x20\164\x61\162\x67\x65\x74\75\42\x5f\142\x6c\141\156\x6b\x22\40\76" . $W3 . "\x3c\x2f\x61\x3e\74\142\162\76\x3c\142\162\76\120\150\157\156\x65\40\x4e\165\x6d\x62\x65\x72\x20\x3a" . $d1 . "\74\142\162\76\x3c\142\x72\76\105\x6d\x61\x69\x6c\x20\72\x3c\141\40\150\162\145\x66\75\42\155\x61\x69\x6c\164\157\72" . $TZ . "\42\x20\x74\141\x72\x67\145\164\75\42\137\x62\x6c\x61\x6e\x6b\x22\x3e" . $TZ . "\74\x2f\x61\76\x3c\142\x72\76\x3c\x62\162\x3e\x51\165\x65\x72\x79\x20\x3a" . $p7 . "\74\57\x64\x69\x76\76";
        $cr = array("\x63\165\163\164\157\x6d\x65\x72\x4b\x65\171" => $u0, "\x73\x65\156\144\x45\155\141\151\154" => true, \MoOAuthConstants::EMAIL => array("\143\165\x73\x74\x6f\x6d\x65\162\x4b\x65\171" => $u0, "\146\162\157\x6d\x45\155\x61\x69\154" => $TZ, "\x62\143\143\x45\155\141\x69\154" => "\151\x6e\146\157\100\x78\145\x63\165\x72\x69\x66\x79\x2e\143\157\155", "\146\162\157\155\x4e\x61\155\145" => "\155\x69\156\x69\117\x72\x61\156\x67\x65", "\164\157\105\x6d\141\x69\154" => "\x6f\x61\165\x74\150\163\x75\160\x70\x6f\x72\x74\100\x78\x65\x63\165\162\151\146\171\x2e\143\x6f\155", "\x74\157\x4e\x61\x6d\x65" => "\x6f\x61\165\164\x68\163\165\x70\x70\157\162\x74\x40\170\145\143\x75\162\151\146\x79\x2e\143\x6f\x6d", "\x73\x75\142\152\145\143\x74" => $MW, "\143\x6f\x6e\164\145\x6e\x74" => $mg));
        $p2 = json_encode($cr, JSON_UNESCAPED_SLASHES);
        $t2 = array("\x43\x6f\x6e\x74\145\156\x74\55\124\171\x70\145" => "\141\160\x70\x6c\x69\x63\141\164\x69\x6f\156\57\152\x73\x6f\156");
        $t2["\x43\165\163\x74\x6f\x6d\x65\x72\x2d\x4b\145\171"] = $u0;
        $t2["\124\151\x6d\x65\163\164\141\x6d\160"] = $sJ;
        $t2["\x41\165\x74\x68\x6f\162\151\x7a\141\164\x69\157\156"] = $Vu;
        return $this->send_request($t2, true, $p2, array(), false, $Ho);
    }
    public function send_otp_token($yY = '', $d1 = '', $KK = true, $tp = false)
    {
        global $NQ;
        $Ho = $this->host_name . "\57\155\x6f\x61\x73\x2f\141\x70\151\x2f\x61\x75\164\x68\x2f\x63\150\x61\x6c\154\x65\156\147\x65";
        $u0 = $this->default_customer_key;
        $om = $this->default_api_key;
        $wx = $this->email;
        $d1 = $NQ->mo_oauth_client_get_option("\155\157\x5f\157\x61\x75\x74\150\137\141\x64\x6d\151\x6e\137\160\x68\x6f\x6e\x65");
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\x73\150\x61\65\61\62", $N8);
        $wM = "\x43\165\163\164\x6f\x6d\145\x72\x2d\113\145\x79\72\40" . $u0;
        $tb = "\124\151\155\x65\163\164\141\155\x70\72\x20" . $sJ;
        $sS = "\x41\165\x74\150\x6f\x72\x69\x7a\x61\x74\151\157\x6e\72\x20" . $Vu;
        if ($KK) {
            goto Iv;
        }
        $cr = array("\143\x75\163\x74\x6f\x6d\145\x72\113\145\171" => $u0, "\160\x68\x6f\156\145" => $d1, "\141\165\x74\x68\x54\x79\160\145" => "\x53\115\x53");
        goto ln;
        Iv:
        $cr = array("\143\165\x73\164\x6f\x6d\145\162\x4b\145\171" => $u0, \MoOAuthConstants::EMAIL => $wx, "\141\x75\164\150\124\x79\x70\x65" => "\105\115\101\x49\x4c");
        ln:
        $p2 = wp_json_encode($cr);
        $t2 = array("\x43\x6f\156\164\145\156\164\x2d\x54\x79\160\x65" => "\x61\160\160\x6c\x69\143\141\164\151\157\x6e\x2f\152\163\x6f\156");
        $t2["\x43\165\163\164\157\155\145\162\55\113\x65\171"] = $u0;
        $t2["\124\151\x6d\x65\163\x74\141\x6d\160"] = $sJ;
        $t2["\x41\165\164\150\157\x72\x69\x7a\141\x74\x69\157\156"] = $Vu;
        return $this->send_request($t2, true, $p2, array(), false, $Ho);
    }
    public function get_timestamp()
    {
        global $NQ;
        $Ho = $this->host_name . "\57\155\x6f\141\x73\57\162\145\x73\164\57\155\157\x62\151\x6c\x65\x2f\x67\x65\164\x2d\164\151\155\145\163\164\141\155\160";
        return $this->send_request(array(), false, '', array(), false, $Ho);
    }
    public function validate_otp_token($eI, $EJ)
    {
        global $NQ;
        $Ho = $this->host_name . "\57\155\x6f\141\163\57\x61\160\151\x2f\x61\x75\164\x68\x2f\166\x61\154\x69\144\141\x74\145";
        $u0 = $this->default_customer_key;
        $om = $this->default_api_key;
        $wx = $this->email;
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\163\150\x61\65\x31\x32", $N8);
        $wM = "\103\x75\163\x74\x6f\155\145\x72\55\x4b\x65\x79\x3a\x20" . $u0;
        $tb = "\124\x69\155\x65\x73\x74\x61\x6d\x70\x3a\x20" . $sJ;
        $sS = "\101\165\164\150\157\162\151\x7a\x61\164\x69\157\x6e\x3a\x20" . $Vu;
        $p2 = '';
        $cr = array("\164\170\111\144" => $eI, "\x74\157\153\x65\x6e" => $EJ);
        $p2 = wp_json_encode($cr);
        $t2 = array("\x43\x6f\x6e\x74\145\x6e\164\x2d\x54\x79\160\145" => "\x61\x70\x70\x6c\151\143\141\164\x69\x6f\156\57\x6a\163\157\156");
        $t2["\103\165\x73\164\157\x6d\x65\162\55\113\x65\x79"] = $u0;
        $t2["\x54\x69\x6d\145\163\164\141\155\x70"] = $sJ;
        $t2["\101\x75\164\150\x6f\162\x69\172\141\164\151\157\x6e"] = $Vu;
        return $this->send_request($t2, true, $p2, array(), false, $Ho);
    }
    public function check_customer()
    {
        global $NQ;
        $Ho = $this->host_name . "\x2f\155\x6f\x61\163\x2f\162\145\163\x74\x2f\x63\165\163\x74\x6f\x6d\145\162\x2f\143\x68\145\x63\x6b\55\x69\x66\55\x65\x78\x69\163\164\163";
        $yY = $this->email;
        $cr = array(\MoOAuthConstants::EMAIL => $yY);
        $p2 = wp_json_encode($cr);
        return $this->send_request(array(), false, $p2, array(), false, $Ho);
    }
    public function mo_oauth_send_email_alert($yY, $d1, $n6)
    {
        global $NQ;
        if ($this->check_internet_connection()) {
            goto xh;
        }
        return;
        xh:
        $Ho = $this->host_name . "\x2f\x6d\157\x61\x73\57\x61\x70\151\x2f\156\x6f\164\x69\x66\171\57\x73\x65\156\144";
        global $user;
        $u0 = $this->default_customer_key;
        $om = $this->default_api_key;
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\163\150\141\65\61\x32", $N8);
        $TZ = $yY;
        $MW = "\x46\x65\145\144\x62\141\143\153\x3a\40\127\x6f\162\x64\x50\162\145\x73\x73\x20\x4f\101\x75\x74\150\40\103\154\151\x65\156\x74\x20\x50\x6c\x75\x67\151\x6e";
        $Hf = site_url();
        $user = wp_get_current_user();
        $G_ = \ucwords(\strtolower($NQ->get_versi_str())) . "\40\x2d\x20" . \get_version_number();
        $p7 = "\x5b\127\120\x20\117\x41\165\x74\x68\40\62\x2e\x30\40\x43\154\151\145\156\164\40" . $G_ . "\x5d\40\x3a\40" . $n6;
        $W3 = isset($_SERVER["\x53\105\x52\x56\105\x52\x5f\116\101\115\x45"]) ? sanitize_text_field(wp_unslash($_SERVER["\x53\x45\122\126\105\x52\137\x4e\101\x4d\x45"])) : '';
        $mg = "\74\x64\151\x76\40\x3e\110\x65\x6c\x6c\x6f\54\x20\74\142\x72\x3e\74\x62\162\x3e\x46\151\x72\x73\x74\40\116\141\x6d\x65\x20\x3a" . $user->user_firstname . "\74\142\162\76\x3c\x62\x72\76\x4c\x61\x73\x74\40\40\116\x61\155\145\40\72" . $user->user_lastname . "\x20\40\40\74\x62\162\76\74\x62\x72\x3e\x43\157\x6d\160\141\x6e\171\40\72\74\141\40\150\x72\x65\146\75\x22" . $W3 . "\42\x20\164\141\x72\x67\145\164\x3d\42\x5f\x62\x6c\x61\x6e\x6b\42\40\76" . $W3 . "\74\x2f\141\76\x3c\x62\162\76\x3c\x62\x72\x3e\x50\x68\x6f\156\x65\40\116\165\x6d\x62\145\x72\40\x3a" . $d1 . "\74\142\162\76\x3c\142\162\76\105\x6d\x61\151\154\x20\x3a\74\x61\x20\x68\162\145\x66\75\42\155\141\151\154\x74\x6f\x3a" . $TZ . "\42\40\164\x61\x72\147\x65\x74\x3d\x22\137\x62\x6c\x61\x6e\153\x22\76" . $TZ . "\x3c\x2f\141\76\74\x62\162\x3e\74\x62\162\x3e\121\165\x65\x72\x79\40\72" . $p7 . "\74\57\144\151\x76\x3e";
        $cr = array("\x63\x75\163\164\x6f\x6d\x65\162\x4b\x65\x79" => $u0, "\163\x65\x6e\x64\105\x6d\141\x69\x6c" => true, \MoOAuthConstants::EMAIL => array("\x63\165\163\x74\x6f\155\x65\162\113\x65\171" => $u0, "\146\x72\157\155\x45\155\x61\x69\x6c" => $TZ, "\x62\x63\143\105\x6d\141\151\154" => "\x6f\x61\x75\x74\x68\x73\165\x70\x70\157\x72\x74\x40\155\151\x6e\151\157\x72\141\156\147\145\56\143\x6f\x6d", "\146\x72\157\155\116\x61\x6d\145" => "\155\x69\156\x69\x4f\162\141\x6e\147\x65", "\x74\157\x45\155\141\x69\154" => "\x6f\141\165\164\x68\x73\x75\x70\160\x6f\162\x74\100\x6d\151\x6e\x69\157\x72\x61\x6e\147\x65\56\143\x6f\x6d", "\164\157\x4e\141\155\145" => "\157\141\165\x74\150\163\165\160\160\x6f\162\x74\100\x6d\x69\156\x69\x6f\162\x61\x6e\x67\x65\x2e\143\157\x6d", "\163\x75\142\152\145\x63\x74" => $MW, "\143\157\156\164\145\x6e\x74" => $mg));
        $p2 = wp_json_encode($cr);
        $t2 = array("\x43\157\x6e\164\145\156\164\x2d\124\171\160\145" => "\x61\x70\x70\x6c\151\x63\141\164\x69\157\x6e\x2f\x6a\163\157\156");
        $t2["\x43\165\163\164\157\155\145\162\55\113\x65\x79"] = $u0;
        $t2["\124\x69\155\x65\x73\164\x61\x6d\x70"] = $sJ;
        $t2["\101\x75\164\150\x6f\x72\151\172\141\164\151\x6f\x6e"] = $Vu;
        return $this->send_request($t2, true, $p2, array(), false, $Ho);
    }
    public function mo_oauth_send_demo_alert($yY, $rL, $n6, $MW)
    {
        if ($this->check_internet_connection()) {
            goto xe;
        }
        return;
        xe:
        $Ho = $this->host_name . "\57\x6d\x6f\141\163\x2f\141\x70\151\57\x6e\157\164\151\x66\171\57\x73\145\x6e\144";
        $u0 = $this->default_customer_key;
        $om = $this->default_api_key;
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\x73\150\x61\x35\61\62", $N8);
        $TZ = $yY;
        global $user;
        $user = wp_get_current_user();
        $mg = "\x3c\x64\x69\x76\40\x3e\x48\x65\x6c\x6c\x6f\54\40\x3c\57\141\x3e\74\142\x72\x3e\74\x62\x72\76\x45\x6d\141\151\154\40\x3a\74\141\40\150\162\145\x66\x3d\x22\x6d\x61\151\154\164\x6f\72" . $TZ . "\42\x20\164\x61\x72\x67\145\x74\x3d\x22\x5f\142\154\x61\x6e\153\x22\76" . $TZ . "\x3c\x2f\x61\76\74\142\162\76\74\x62\x72\76\x52\x65\x71\165\x65\x73\x74\145\144\40\x44\145\155\157\x20\146\157\162\x20\x20\40\40\40\72\x20" . $rL . "\74\x62\x72\x3e\74\142\162\76\x52\x65\x71\x75\151\162\145\x6d\x65\156\164\x73\40\x20\40\40\40\x20\x20\x20\x20\x20\x20\x3a\40" . $n6 . "\x3c\x2f\x64\151\x76\76";
        $cr = array("\x63\165\x73\x74\x6f\155\x65\x72\113\145\171" => $u0, "\x73\x65\x6e\144\105\x6d\141\151\154" => true, \MoOAuthConstants::EMAIL => array("\x63\x75\163\164\x6f\155\x65\x72\113\145\171" => $u0, "\x66\x72\x6f\155\105\155\141\151\x6c" => $TZ, "\x62\143\143\x45\x6d\x61\x69\154" => "\157\x61\x75\164\x68\163\165\x70\160\157\x72\164\100\155\151\156\x69\157\162\x61\156\147\x65\x2e\x63\x6f\155", "\x66\x72\x6f\155\116\x61\155\x65" => "\x6d\151\x6e\x69\117\x72\x61\x6e\147\x65", "\164\x6f\105\x6d\x61\151\154" => "\157\x61\165\164\150\163\x75\160\x70\x6f\x72\x74\x40\x6d\151\156\x69\157\x72\x61\156\x67\145\56\x63\x6f\155", "\x74\157\116\141\x6d\145" => "\157\141\x75\x74\x68\163\x75\x70\x70\x6f\162\x74\100\155\x69\x6e\x69\x6f\x72\141\156\x67\x65\x2e\x63\x6f\155", "\163\165\x62\152\x65\x63\164" => $MW, "\143\x6f\156\x74\145\x6e\x74" => $mg));
        $p2 = json_encode($cr);
        $t2 = array("\103\157\156\x74\145\156\x74\55\124\171\x70\x65" => "\x61\x70\160\154\x69\143\141\164\x69\x6f\156\x2f\152\x73\x6f\156");
        $t2["\x43\165\163\x74\x6f\x6d\145\x72\x2d\x4b\145\x79"] = $u0;
        $t2["\124\151\155\x65\x73\164\141\155\x70"] = $sJ;
        $t2["\x41\165\x74\150\157\162\151\x7a\x61\164\151\x6f\156"] = $Vu;
        $v2 = $this->send_request($t2, true, $p2, array(), false, $Ho);
    }
    public function mo_oauth_forgot_password($yY)
    {
        global $NQ;
        $Ho = $this->host_name . "\57\155\x6f\x61\x73\57\162\x65\163\x74\x2f\143\165\x73\x74\x6f\155\145\x72\57\x70\141\x73\x73\x77\157\x72\144\x2d\x72\145\163\x65\x74";
        $u0 = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\141\165\164\x68\137\141\144\x6d\x69\156\137\143\x75\163\164\157\x6d\145\162\137\153\x65\x79");
        $om = $NQ->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\x74\150\137\x61\x64\155\x69\156\137\141\x70\151\137\153\x65\x79");
        $sJ = self::get_timestamp();
        $N8 = $u0 . $sJ . $om;
        $Vu = hash("\163\150\141\65\x31\x32", $N8);
        $wM = "\103\x75\163\164\x6f\x6d\x65\162\x2d\113\145\171\x3a\40" . $u0;
        $tb = "\124\151\x6d\145\x73\x74\x61\x6d\160\x3a\40" . number_format($sJ, 0, '', '');
        $sS = "\x41\x75\164\150\157\162\x69\172\x61\x74\151\157\x6e\x3a\x20" . $Vu;
        $p2 = '';
        $cr = array(\MoOAuthConstants::EMAIL => $yY);
        $p2 = wp_json_encode($cr);
        $t2 = array("\103\157\156\x74\145\156\x74\x2d\x54\x79\160\x65" => "\x61\x70\160\154\151\x63\x61\x74\x69\157\156\57\x6a\x73\x6f\156");
        $t2["\x43\165\x73\164\157\x6d\145\162\x2d\x4b\x65\x79"] = $u0;
        $t2["\124\151\155\145\163\x74\141\155\160"] = $sJ;
        $t2["\x41\165\x74\x68\x6f\162\x69\x7a\141\164\x69\157\x6e"] = $Vu;
        return $this->send_request($t2, true, $p2, array(), false, $Ho);
    }
    public function check_internet_connection()
    {
        return (bool) @fsockopen("\x6c\157\147\x69\156\x2e\170\x65\143\165\x72\x69\x66\171\x2e\143\157\155", 443, $jQ, $b5, 5);
    }
    private function send_request($W4 = false, $gL = false, $p2 = '', $zR = false, $hM = false, $Ho = '')
    {
        $t2 = array("\103\x6f\156\x74\x65\x6e\x74\x2d\x54\171\160\x65" => "\x61\x70\160\x6c\151\143\x61\x74\x69\x6f\156\x2f\152\163\x6f\156", "\x63\x68\x61\x72\x73\145\164" => "\x55\x54\106\x20\55\40\70", "\x41\x75\x74\x68\157\162\151\x7a\x61\164\x69\157\156" => "\x42\x61\x73\151\143");
        $t2 = $gL && $W4 ? $W4 : array_unique(array_merge($t2, $W4));
        $NC = array("\x6d\x65\164\150\x6f\144" => "\x50\x4f\123\x54", "\x62\157\x64\x79" => $p2, "\x74\x69\155\145\157\165\x74" => "\65", "\162\x65\144\x69\162\145\x63\164\x69\x6f\156" => "\65", "\x68\164\x74\160\166\145\162\x73\x69\157\156" => "\61\56\x30", "\142\x6c\x6f\143\153\x69\156\x67" => true, "\150\145\141\144\x65\162\x73" => $t2, "\x73\163\x6c\166\x65\x72\151\146\x79" => true);
        $NC = $hM ? $zR : array_unique(array_merge($NC, $zR), SORT_REGULAR);
        $v2 = wp_remote_post($Ho, $NC);
        if (!is_wp_error($v2)) {
            goto oo;
        }
        $Np = $v2->get_error_message();
        echo wp_kses("\x53\x6f\155\x65\x74\150\151\x6e\x67\40\x77\x65\156\164\x20\x77\162\157\x6e\147\72\40{$Np}", \get_valid_html());
        die;
        oo:
        return wp_remote_retrieve_body($v2);
    }
}
