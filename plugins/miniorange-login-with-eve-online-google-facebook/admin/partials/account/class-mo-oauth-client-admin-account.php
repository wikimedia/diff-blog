<?php


require('partials/register.php');
require('partials/verify-password.php');
require('partials/verify-otp.php');

class Mo_OAuth_Client_Admin_Account {
	
	public static function register() {
		if(!mo_oauth_is_customer_registered()){
			register_ui();
		} else {
			show_customer_info();
		}
	}
	
	public static function verify_password() {
		verify_password_ui();
	}
	
	public static function otp_verification() {
		otp_verification_ui();
	}

}

?>