<?php


namespace MoOauthClient\Premium;

class MappingHandler
{
    private $user_id = 0;
    private $app_config = array();
    private $group_name = '';
    private $is_new_user = false;
    public function __construct($ZN = 0, $R_ = array(), $kv = '', $Pr = false)
    {
        if (!(!array($R_) || empty($R_))) {
            goto kgd;
        }
        return;
        kgd:
        if (!user_can($ZN, "\141\x64\x6d\x69\156\151\163\x74\162\141\164\x6f\x72")) {
            goto FOW;
        }
        return;
        FOW:
        $mC = is_array($kv) ? $kv : $this->get_group_array($kv);
        $this->group_name = $mC;
        $this->user_id = $ZN;
        $this->app_config = $R_;
        $this->is_new_user = $Pr;
    }
    private function get_group_array($Nm)
    {
        $F0 = json_decode($Nm, true);
        return is_array($F0) && json_last_error() === JSON_ERROR_NONE ? $F0 : explode("\73", $Nm);
    }
    public function apply_custom_attribute_mapping($DV)
    {
        if (!(!isset($this->app_config["\143\165\x73\x74\x6f\x6d\137\141\x74\164\x72\163\x5f\x6d\141\160\160\x69\156\x67"]) || empty($this->app_config["\x63\165\163\164\157\x6d\137\141\x74\x74\162\x73\137\155\x61\160\160\x69\156\x67"]))) {
            goto U9f;
        }
        return;
        U9f:
        global $NQ;
        $zh = -1;
        $SY = $this->app_config["\x63\165\x73\x74\157\x6d\x5f\x61\x74\x74\162\x73\x5f\155\x61\160\x70\151\156\147"];
        $De = array();
        foreach ($SY as $ZZ => $Da) {
            $L2 = $NQ->getnestedattribute($DV, $Da);
            $De[$ZZ] = $L2;
            update_user_meta($this->user_id, $ZZ, $L2);
            jkV:
        }
        J0y:
        update_user_meta($this->user_id, "\x6d\157\x5f\x6f\x61\165\x74\x68\137\x63\x75\x73\x74\x6f\155\x5f\x61\x74\x74\162\x69\142\x75\x74\x65\x73", $De);
    }
    public function apply_role_mapping()
    {
        if (!(!$this->is_new_user && isset($this->app_config["\x6b\x65\145\x70\137\145\170\151\x73\164\x69\x6e\x67\137\x75\x73\145\x72\137\x72\157\x6c\x65\x73"]) && 1 === intval($this->app_config["\153\x65\145\160\x5f\145\x78\151\163\x74\151\x6e\147\x5f\x75\163\x65\162\x5f\162\x6f\x6c\145\163"]))) {
            goto xB3;
        }
        return;
        xB3:
        $UW = new \WP_User($this->user_id);
        $Ze = 0;
        $HB = isset($this->app_config["\162\157\x6c\x65\137\x6d\x61\160\x70\x69\x6e\147\137\143\157\x75\x6e\164"]) ? intval($this->app_config["\162\157\x6c\x65\137\x6d\141\160\160\151\x6e\147\137\143\157\165\156\x74"]) : 0;
        $Tc = array();
        $zh = 1;
        Woa:
        if (!($zh <= $HB)) {
            goto A1T;
        }
        $vm = isset($this->app_config["\137\155\141\x70\x70\151\156\x67\x5f\x6b\145\171\137" . $zh]) ? $this->app_config["\x5f\x6d\141\160\160\151\156\x67\x5f\x6b\x65\171\x5f" . $zh] : '';
        array_push($Tc, $vm);
        foreach ($this->group_name as $v7) {
            if (!(strtolower($v7) === strtolower($vm))) {
                goto V5b;
            }
            $DW = isset($this->app_config["\x5f\155\141\160\160\x69\x6e\147\x5f\166\x61\x6c\x75\x65\137" . $zh]) ? $this->app_config["\137\x6d\x61\x70\x70\x69\156\x67\x5f\x76\141\154\x75\x65\137" . $zh] : '';
            if (!$DW) {
                goto Nr6;
            }
            if (!(0 === $Ze)) {
                goto e7m;
            }
            $UW->set_role('');
            e7m:
            $UW->add_role($DW);
            $Ze++;
            Nr6:
            V5b:
            FI8:
        }
        AgL:
        KN7:
        $zh++;
        goto Woa;
        A1T:
        if (!(0 === $Ze && isset($this->app_config["\137\x6d\x61\160\160\151\156\147\137\166\141\x6c\x75\x65\x5f\x64\145\146\141\165\154\164"]) && '' !== $this->app_config["\x5f\x6d\x61\160\160\x69\x6e\147\137\x76\x61\154\165\145\137\x64\x65\x66\141\x75\x6c\164"])) {
            goto YEl;
        }
        $UW->set_role($this->app_config["\137\x6d\x61\x70\160\x69\156\147\137\166\141\154\x75\145\137\x64\x65\146\x61\165\154\164"]);
        YEl:
        $bZ = 0;
        if (!(isset($this->app_config["\162\x65\x73\164\162\151\143\x74\137\x6c\x6f\x67\151\x6e\137\146\157\x72\137\x6d\x61\x70\160\x65\144\x5f\162\x6f\x6c\145\x73"]) && boolval($this->app_config["\x72\x65\163\x74\162\151\x63\x74\137\x6c\x6f\x67\151\x6e\137\146\157\x72\137\155\x61\160\160\x65\x64\137\162\x6f\x6c\145\163"]))) {
            goto X2z;
        }
        foreach ($this->group_name as $N3) {
            if (!in_array($N3, $Tc, true)) {
                goto BpO;
            }
            $bZ = 1;
            BpO:
            TxX:
        }
        aCd:
        if (!($bZ !== 1)) {
            goto NUP;
        }
        require_once ABSPATH . "\x77\x70\55\141\x64\x6d\151\156\x2f\x69\x6e\143\154\x75\144\145\163\57\x75\163\145\x72\56\x70\150\160";
        \wp_delete_user($this->user_id);
        wp_die("\x59\x6f\x75\40\144\x6f\x20\x6e\157\x74\40\150\141\x76\x65\x20\x70\x65\162\x6d\151\x73\163\151\x6f\x6e\163\x20\x74\x6f\40\x6c\157\147\x69\x6e\x20\x77\x69\x74\150\40\x79\x6f\x75\162\40\x63\165\x72\x72\x65\x6e\164\40\162\157\x6c\145\x73\x2e\x20\120\154\x65\141\163\145\40\143\x6f\156\164\141\x63\164\x20\x74\150\145\40\101\x64\155\151\x6e\x69\163\x74\162\141\164\157\162\x2e");
        NUP:
        X2z:
    }
}
