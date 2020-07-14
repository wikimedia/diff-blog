<?php


namespace MoOauthClient;

class StorageHandler
{
    private $storage;
    public function __construct($vl = '')
    {
        $yJ = empty($vl) || '' === $vl ? json_encode(array()) : sanitize_text_field(wp_unslash($vl));
        $this->storage = json_decode($yJ, true);
    }
    public function add_replace_entry($ZZ, $Da)
    {
        $this->storage[$ZZ]["\x56"] = $Da;
        $this->storage[$ZZ]["\x48"] = md5($Da);
    }
    public function get_value($ZZ)
    {
        if (isset($this->storage[$ZZ])) {
            goto Bk;
        }
        return false;
        Bk:
        $Da = $this->storage[$ZZ];
        if (!(!is_array($Da) || !isset($Da["\126"]) || !isset($Da["\110"]))) {
            goto F9;
        }
        return false;
        F9:
        if (!(md5($Da["\126"]) !== $Da["\x48"])) {
            goto jn;
        }
        return false;
        jn:
        return $Da["\x56"];
    }
    public function remove_key($ZZ)
    {
        if (!isset($this->storage[$ZZ])) {
            goto zM;
        }
        unset($this->storage[$ZZ]);
        zM:
    }
    public function stringify()
    {
        $HO = $this->storage;
        $HO[\bin2hex("\x75\x69\x64")]["\x56"] = bin2hex(MO_UID);
        $HO[\bin2hex("\165\x69\x64")]["\x48"] = md5($HO[\bin2hex("\x75\x69\144")]["\126"]);
        return base64_encode(wp_json_encode($HO));
    }
    public function get_storage()
    {
        return $this->storage;
    }
}
