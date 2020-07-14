<?php


namespace MoOauthClient;

interface OauthHandlerInterface
{
    public function get_token($bn, $NC, $gk, $dP);
    public function get_access_token($bn, $NC, $gk, $dP);
    public function get_id_token($bn, $NC, $gk, $dP);
    public function get_resource_owner_from_id_token($j6);
    public function get_resource_owner($pl, $FA);
    public function get_response($Ho);
}
