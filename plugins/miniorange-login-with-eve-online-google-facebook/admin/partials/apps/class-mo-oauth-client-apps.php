<?php


require('partials/sign-in-settings.php');
require('partials/customization.php');
require('partials/addapp.php');
require('partials/updateapp.php');
require('partials/app-list.php');
require('partials/attr-role-mapping.php');

class Mo_OAuth_Client_Admin_Apps {
	
	public static function sign_in_settings() {
		sign_in_settings_ui();
	}
	
	public static function customization() {
		customization_ui();
	}
	
	public static function applist() {
		applist_page();
	}
	
	public static function add_app() {
		add_app_page();
	}
	
	public static function update_app($appname) {
		update_app_page($appname);
	}

	public static function attribute_role_mapping() {
		attribite_role_mapping_ui();
	}
}

?>