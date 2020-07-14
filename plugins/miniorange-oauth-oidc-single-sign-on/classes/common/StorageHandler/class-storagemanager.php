<?php


namespace MoOauthClient;

use MoOauthClient\StorageHandler;
class StorageManager
{
    private $storage_handler;
    const PRETTY = "\x70\162\145\x74\x74\x79";
    const JSON = "\152\163\x6f\x6e";
    const RAW = "\x72\141\x77";
    public function __construct($vl = '')
    {
        $this->storage_handler = new StorageHandler(empty($vl) ? $vl : base64_decode($vl));
    }
    private function decrypt($V3)
    {
        return empty($V3) || '' === $V3 ? $V3 : strtolower(hex2bin($V3));
    }
    private function encrypt($V3)
    {
        return empty($V3) || '' === $V3 ? $V3 : strtoupper(bin2hex($V3));
    }
    public function get_state()
    {
        return $this->storage_handler->stringify();
    }
    public function add_replace_entry($ZZ, $Da)
    {
        if ($Da) {
            goto NN;
        }
        return;
        NN:
        $Da = is_string($Da) ? $Da : wp_json_encode($Da);
        $this->storage_handler->add_replace_entry(bin2hex($ZZ), bin2hex($Da));
    }
    public function get_value($ZZ)
    {
        $Da = $this->storage_handler->get_value(bin2hex($ZZ));
        if ($Da) {
            goto om;
        }
        return false;
        om:
        $OE = json_decode(hex2bin($Da), true);
        return json_last_error() === JSON_ERROR_NONE ? $OE : hex2bin($Da);
    }
    public function remove_key($ZZ)
    {
        $Da = $this->storage_handler->remove_key(bin2hex($ZZ));
    }
    public function validate()
    {
        return $this->storage_handler->validate();
    }
    public function dump_all_storage($GE = self::RAW)
    {
        $HO = $this->storage_handler->get_storage();
        $wK = array();
        foreach ($HO as $ZZ => $Da) {
            $Ja = \hex2bin($ZZ);
            if ($Ja) {
                goto e9;
            }
            goto sf;
            e9:
            $wK[$Ja] = $this->get_value($Ja);
            sf:
        }
        b8:
        switch ($GE) {
            case self::PRETTY:
                echo "\74\160\162\145\76";
                print_r($wK);
                echo "\x3c\x2f\x70\x72\x65\76";
                goto Tm;
            case self::JSON:
                echo \json_encode($wK);
                goto Tm;
            default:
            case self::RAW:
                print_r($wK);
                goto Tm;
        }
        fD:
        Tm:
    }
}
