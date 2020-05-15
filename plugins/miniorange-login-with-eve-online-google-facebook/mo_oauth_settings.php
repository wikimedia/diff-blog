<?php
/**
* Plugin Name: OAuth Single Sign On - SSO (OAuth Client)
* Plugin URI: miniorange-login-with-eve-online-google-facebook
* Description: This plugin allows login (Single Sign On) into WordPress with your Azure AD, AWS Cognito, Centrify, Invision Community, Slack, Discord or other custom OAuth 2.0 / OpenID Connect providers. WordPress OAuth Client plugin works with any Identity provider that conforms to the OAuth 2.0 and OpenID Connect (OIDC) 1.0 standard.
* Version: 6.15.2
* Author: miniOrange
* Author URI: https://www.miniorange.com
* License: MIT/Expat
* License URI: https://docs.miniorange.com/mit-license
*/

require('handler/oauth_handler.php');
include_once dirname( __FILE__ ) . '/class-mo-oauth-widget.php';
require('class-customer.php');
require plugin_dir_path( __FILE__ ) . 'includes/class-mo-oauth-client.php';
require('views/feedback_form.php');
require_once 'views/VisualTour/class-mocvisualtour.php';
require('constants.php');

class mo_oauth {

	function __construct() {

		add_action( 'admin_init',  array( $this, 'miniorange_oauth_save_settings' ) );
		add_action( 'plugins_loaded',  array( $this, 'mo_login_widget_text_domain' ) );
		register_deactivation_hook(__FILE__, array( $this, 'mo_oauth_deactivate'));
		add_action( 'admin_init', array( $this, 'tutorial' ) );
		add_shortcode('mo_oauth_login', array( $this,'mo_oauth_shortcode_login'));
		add_action( 'admin_footer', array( $this, 'mo_oauth_client_feedback_request' ) );

	}

	function tutorial($page) {
		if ( class_exists( 'MOCVisualTour' ) ) {
			$tour = new MOCVisualTour();
		}
	}

	function mo_oauth_success_message() {
		$class = "error";
		$message = get_option('message');
		echo "<div class='" . $class . "'> <p>" . $message . "</p></div>";
	}

	function mo_oauth_client_feedback_request() {
		mo_oauth_client_display_feedback_form();
	}

	function mo_oauth_error_message() {
		$class = "updated";
		$message = get_option('message');
		echo "<div class='" . $class . "'><p>" . $message . "</p></div>";
	}

	public function mo_oauth_deactivate() {
		delete_option('host_name');
		delete_option('new_registration');
		delete_option('mo_oauth_admin_phone');
		delete_option('verify_customer');
		delete_option('mo_oauth_admin_customer_key');
		delete_option('mo_oauth_admin_api_key');
		delete_option('mo_oauth_new_customer');
		delete_option('customer_token');
		delete_option('message');
		delete_option('mo_oauth_registration_status');
		delete_option('mo_oauth_client_show_mo_server_message');
	}

	function mo_login_widget_text_domain(){
		load_plugin_textdomain( 'flw', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	private function mo_oauth_show_success_message() {
		remove_action( 'admin_notices', array( $this, 'mo_oauth_success_message') );
		add_action( 'admin_notices', array( $this, 'mo_oauth_error_message') );
	}

	private function mo_oauth_show_error_message() {
		remove_action( 'admin_notices', array( $this, 'mo_oauth_error_message') );
		add_action( 'admin_notices', array( $this, 'mo_oauth_success_message') );
	}

	public function mo_oauth_check_empty_or_null( $value ) {
		if( ! isset( $value ) || empty( $value ) ) {
			return true;
		}
		return false;
	}

	function miniorange_oauth_save_settings(){

		if ( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_client_mo_server_message" && isset( $_REQUEST['mo_oauth_mo_server_message_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_mo_server_message_form_field'] ) ), 'mo_oauth_mo_server_message_form' )) {
			update_option( 'mo_oauth_client_show_mo_server_message', 1 );
			return;
		}

		if ( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "clear_pointers" && isset( $_REQUEST['mo_oauth_clear_pointers_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_clear_pointers_form_field'] ) ), 'mo_oauth_clear_pointers_form' )) {
			update_user_meta(get_current_user_id(),'dismissed_wp_pointers','');
			return;
		}

		if ( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "change_miniorange" && isset( $_REQUEST['mo_oauth_goto_login_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_goto_login_form_field'] ) ), 'mo_oauth_goto_login_form' )) {
			if( current_user_can( 'administrator' ) ) {
				$this->mo_oauth_deactivate();
				return;
			}
		}

		if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_register_customer" && isset( $_REQUEST['mo_oauth_register_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_register_form_field'] ) ), 'mo_oauth_register_form' )) {
			if( current_user_can( 'administrator' ) ) {
				$email = '';
				$phone = '';
				$password = '';
				$confirmPassword = '';
				$fname = '';
				$lname = '';
				$company = '';
				if( $this->mo_oauth_check_empty_or_null( $_POST['email'] ) || $this->mo_oauth_check_empty_or_null( $_POST['password'] ) || $this->mo_oauth_check_empty_or_null( $_POST['confirmPassword'] ) ) {
					update_option( 'message', 'All the fields are required. Please enter valid entries.');
					$this->mo_oauth_show_error_message();
					return;
				} else if( strlen( $_POST['password'] ) < 8 || strlen( $_POST['confirmPassword'] ) < 8){
					update_option( 'message', 'Choose a password with minimum length 8.');
					$this->mo_oauth_show_error_message();
					return;
				} else{
					$email = sanitize_email( $_POST['email'] );
					$phone = stripslashes( $_POST['phone'] );
					$password = stripslashes( $_POST['password'] );
					$confirmPassword = stripslashes( $_POST['confirmPassword'] );
					$fname = stripslashes( $_POST['fname'] );
					$lname = stripslashes( $_POST['lname'] );
					$company = stripslashes( $_POST['company'] );
				}

				update_option( 'mo_oauth_admin_email', $email );
				update_option( 'mo_oauth_admin_phone', $phone );
				update_option( 'mo_oauth_admin_fname', $fname );
				update_option( 'mo_oauth_admin_lname', $lname );
				update_option( 'mo_oauth_admin_company', $company );

				if( mo_oauth_is_curl_installed() == 0 ) {
					return $this->mo_oauth_show_curl_error();
				}

				if( strcmp( $password, $confirmPassword) == 0 ) {
					update_option( 'password', $password );
					$customer = new Customer();
					$email=get_option('mo_oauth_admin_email');
					$content = json_decode($customer->check_customer(), true);
					if( strcasecmp( $content['status'], 'CUSTOMER_NOT_FOUND') == 0 ){
						$response = json_decode($customer->create_customer(), true);
						if(strcasecmp($response['status'], 'SUCCESS') == 0) {
							$this->mo_oauth_get_current_customer();
							wp_redirect( admin_url( '/admin.php?page=mo_oauth_settings&tab=licensing' ), 301 );
							exit;
						} if( strcasecmp($response['status'], 'FAILED') == 0 && strcasecmp($response['message'], 'Email is not enterprise email.') == 0 ) {
                            update_option( 'message', 'Please use your Enterprise email for registration.');
                        } else {
							update_option( 'message', 'Failed to create customer. Try again.');
						}
						$this->mo_oauth_show_success_message();
					} else {
						$this->mo_oauth_get_current_customer();
					}
				} else {
					update_option( 'message', 'Passwords do not match.');
					delete_option('verify_customer');
					$this->mo_oauth_show_error_message();
				}
			}
		}

		if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_client_goto_login" && isset( $_REQUEST['mo_oauth_goto_login_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_goto_login_form_field'] ) ), 'mo_oauth_goto_login_form' )) {
			delete_option( 'new_registration' );
			update_option( 'verify_customer', 'true' );
		}

		 if(isset($_POST['option']) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_validate_otp" && isset( $_REQUEST['mo_oauth_verify_otp_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_verify_otp_form_field'] ) ), 'mo_oauth_verify_otp_form' )){
		 	if ( current_user_can( 'administrator' ) ) {
		 		if( mo_oauth_is_curl_installed() == 0 ) {
					return $this->mo_oauth_show_curl_error();
				}
				//validation and sanitization
				$otp_token = '';
				if( $this->mo_oauth_check_empty_or_null( $_POST['mo_oauth_otp_token'] ) ) {
					update_option( 'message', 'Please enter a value in OTP field.');
					update_option('mo_oauth_registration_status','MO_OTP_VALIDATION_FAILURE');
					$this->mo_oauth_show_error_message();
					return;
				} else{
					$otp_token = stripslashes( $_POST['mo_oauth_otp_token'] );
				}

				$customer = new Customer();
				$content = json_decode($customer->validate_otp_token($_SESSION['mo_oauth_transactionId'], $otp_token ),true);
				if(strcasecmp($content['status'], 'SUCCESS') == 0) {
					$this->create_customer();
				}else{
					update_option( 'message','Invalid one time passcode. Please enter a valid OTP.');
					update_option('mo_oauth_registration_status','MO_OTP_VALIDATION_FAILURE');
					$this->mo_oauth_show_error_message();
				}
		 	}
		}

		if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_verify_customer" && isset( $_REQUEST['mo_oauth_verify_password_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_verify_password_form_field'] ) ), 'mo_oauth_verify_password_form' )) {	//register the admin to miniOrange
			if( current_user_can( 'administrator' ) ) {
				if( mo_oauth_is_curl_installed() == 0 ) {
					return $this->mo_oauth_show_curl_error();
				}
				//validation and sanitization
				$email = '';
				$password = '';
				if( $this->mo_oauth_check_empty_or_null( $_POST['email'] ) || $this->mo_oauth_check_empty_or_null( $_POST['password'] ) ) {
					update_option( 'message', 'All the fields are required. Please enter valid entries.');
					$this->mo_oauth_show_error_message();
					return;
				} else{
					$email = sanitize_email( $_POST['email'] );
					$password = stripslashes( $_POST['password'] );
				}

				update_option( 'mo_oauth_admin_email', $email );
				update_option( 'password', $password );
				$customer = new Customer();
				$content = $customer->get_customer_key();
				$customerKey = json_decode( $content, true );
				if( json_last_error() == JSON_ERROR_NONE ) {
					update_option( 'mo_oauth_admin_customer_key', $customerKey['id'] );
					update_option( 'mo_oauth_admin_api_key', $customerKey['apiKey'] );
					update_option( 'customer_token', $customerKey['token'] );
					if( isset( $customerKey['phone'] ) )
						update_option( 'mo_oauth_admin_phone', $customerKey['phone'] );
					delete_option('password');
					update_option( 'message', 'Customer retrieved successfully');
					delete_option('verify_customer');
					delete_option('new_registration');
					$this->mo_oauth_show_success_message();
				} else {
					update_option( 'message', 'Invalid username or password. Please try again.');
					$this->mo_oauth_show_error_message();
				}
			}
		} 
		else if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_add_app" && isset( $_REQUEST['mo_oauth_add_app_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_add_app_form_field'] ) ), 'mo_oauth_add_app_form' )) {
			if( current_user_can( 'administrator' ) ) {
				$scope = '';
				$clientid = '';
				$clientsecret = '';
				if($this->mo_oauth_check_empty_or_null($_POST['mo_oauth_client_id']) || $this->mo_oauth_check_empty_or_null($_POST['mo_oauth_client_secret'])) {
					update_option( 'message', 'Please enter valid Client ID and Client Secret.');
					$this->mo_oauth_show_error_message();
					return;
				} else{
					$callback_url = stripslashes( $_POST['mo_oauth_callback_url'] );
					$scope = stripslashes( $_POST['mo_oauth_scope'] );
					$clientid = stripslashes( trim( $_POST['mo_oauth_client_id'] ) );
					$clientsecret = stripslashes( trim( $_POST['mo_oauth_client_secret'] ) );
					$appname = stripslashes( $_POST['mo_oauth_custom_app_name'] );
					$ssoprotocol = stripslashes( $_POST['mo_oauth_app_type'] );
					$selectedapp = stripslashes( $_POST['mo_oauth_app_name'] );
					$send_headers = isset($_POST['mo_oauth_authorization_header']) ? sanitize_post($_POST['mo_oauth_authorization_header']) : "0";
					$send_body = isset($_POST['mo_oauth_body']) ? sanitize_post($_POST['mo_oauth_body']) : "0";
					$show_on_login_page = isset($_POST['mo_oauth_show_on_login_page']) ? (int)filter_var( $_POST['mo_oauth_show_on_login_page'], FILTER_SANITIZE_NUMBER_INT) : 0;

					if( $selectedapp == 'wso2' ) {
						update_option( 'mo_oauth_client_custom_token_endpoint_no_csecret', true );
					}

					if(get_option('mo_oauth_apps_list'))
						$appslist = get_option('mo_oauth_apps_list');
					else
						$appslist = array();

					$email_attr = "";
					$name_attr = "";
					$newapp = array();

					$isupdate = false;
					foreach($appslist as $key => $currentapp){
						if($appname == $key){
							$newapp = $currentapp;
							$isupdate = true;
							break;
						}
					}

					if(!$isupdate && sizeof($appslist)>0){
						update_option( 'message', 'You can only add 1 application with free version. Upgrade to enterprise version if you want to add more applications.');
						$this->mo_oauth_show_error_message();
						return;
					}


					$newapp['clientid'] = $clientid;
					$newapp['clientsecret'] = $clientsecret;
					$newapp['scope'] = $scope;
					$newapp['redirecturi'] = $callback_url;
					$newapp['ssoprotocol'] = $ssoprotocol;
					$newapp['send_headers'] = $send_headers;
					$newapp['send_body'] = $send_body;
					$newapp['show_on_login_page'] = $show_on_login_page;

					$authorizeurl = stripslashes($_POST['mo_oauth_authorizeurl']);
					$accesstokenurl = stripslashes($_POST['mo_oauth_accesstokenurl']);
					$appname = stripslashes( $_POST['mo_oauth_custom_app_name'] );
					//$email_attr = stripslashes( $_POST['mo_oauth_email_attr'] );
					//$name_attr = stripslashes( $_POST['mo_oauth_name_attr'] );

					$newapp['authorizeurl'] = $authorizeurl;
					$newapp['accesstokenurl'] = $accesstokenurl;
					if(isset($_POST['mo_oauth_app_type'])) {
						$newapp['apptype'] = stripslashes( $_POST['mo_oauth_app_type'] );
					} else {
						$newapp['apptype'] = stripslashes( 'oauth' );
					}

					if($newapp['apptype'] == 'oauth' || isset($_POST['mo_oauth_resourceownerdetailsurl'])) {
						$resourceownerdetailsurl = stripslashes($_POST['mo_oauth_resourceownerdetailsurl']);
						$newapp['resourceownerdetailsurl'] = $resourceownerdetailsurl;
					}
					if(isset($_POST['mo_oauth_app_name'])) {
						$newapp['appId'] = stripslashes( $_POST['mo_oauth_app_name'] );
					}
					$appslist[$appname] = $newapp;
					update_option('mo_oauth_apps_list', $appslist);
					update_option( 'message', 'Your settings are saved successfully.' );
					$this->mo_oauth_show_success_message();
					if( ! isset( $newapp['username_attr'] ) || empty( $newapp['username_attr'] ) ) {
						$notices = get_option( 'mo_oauth_client_notice_messages' );
						$notices['attr_mapp_notice'] = 'Please map the attributes by going to the <a href="' . admin_url( 'admin.php?page=mo_oauth_settings&tab=attributemapping' ) .'">Attribute/Role Mapping</a> Tab.';
						update_option( 'mo_oauth_client_notice_messages', $notices );
					}
				}
			}
		}
		else if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_app_customization" && isset( $_REQUEST['mo_oauth_app_customization_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_app_customization_form_field'] ) ), 'mo_oauth_app_customization_form' )) {

			if( current_user_can( 'administrator' ) ) {
				update_option( 'mo_oauth_icon_width', stripslashes($_POST['mo_oauth_icon_width']));
				update_option( 'mo_oauth_icon_height', stripslashes($_POST['mo_oauth_icon_height']));
				update_option( 'mo_oauth_icon_margin', stripslashes($_POST['mo_oauth_icon_margin']));
				update_option('mo_oauth_icon_configure_css', stripcslashes(stripslashes($_POST['mo_oauth_icon_configure_css'])));
				update_option( 'message', 'Your settings were saved' );
				$this->mo_oauth_show_success_message();
			}
		}
		else if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_attribute_mapping"  && isset( $_REQUEST['mo_oauth_attr_role_mapping_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_attr_role_mapping_form_field'] ) ), 'mo_oauth_attr_role_mapping_form' )) {

			if( current_user_can( 'administrator' ) ) {
				$appname = stripslashes( $_POST['mo_oauth_app_name'] );
				$username_attr = stripslashes( $_POST['mo_oauth_username_attr'] );
				$attr_option = stripslashes( $_POST['mo_attr_option'] );
				if ( empty( $appname ) ) {
					update_option( 'message', 'You MUST configure an application before you map attributes.' );
					$this->mo_oauth_show_error_message();
					return;
				}
				$appslist = get_option('mo_oauth_apps_list');
				foreach($appslist as $key => $currentapp){
					if($appname == $key){
						$currentapp['username_attr'] = $username_attr;
						$appslist[$key] = $currentapp;
						break;
					}
				}

				update_option('mo_oauth_apps_list', $appslist);
				update_option( 'message', 'Your settings are saved successfully.' );
				update_option('mo_attr_option', $attr_option);
				$this->mo_oauth_show_success_message();
				$notices = get_option( 'mo_oauth_client_notice_messages' );
				if( isset( $notices['attr_mapp_notice'] ) ) {
					unset( $notices['attr_mapp_notice'] );
					update_option( 'mo_oauth_client_notice_messages', $notices );
				}
			}
		}
		
		elseif( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_contact_us_query_option" && isset( $_REQUEST['mo_oauth_support_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_support_form_field'] ) ), 'mo_oauth_support_form' )) {

			if( current_user_can( 'administrator' ) ) {
				if( mo_oauth_is_curl_installed() == 0 ) {
					return $this->mo_oauth_show_curl_error();
				}
				// Contact Us query
				$email = sanitize_email( $_POST['mo_oauth_contact_us_email'] );
				$phone = stripslashes( $_POST['mo_oauth_contact_us_phone'] );
				$query = stripslashes( $_POST['mo_oauth_contact_us_query'] );
				$send_config = isset( $_POST['mo_oauth_send_plugin_config'] );
				$customer = new Customer();
				if ( $this->mo_oauth_check_empty_or_null( $email ) || $this->mo_oauth_check_empty_or_null( $query ) ) {
					update_option('message', 'Please fill up Email and Query fields to submit your query.');
					$this->mo_oauth_show_error_message();
				} else {
					// $submited = json_decode( $customer->mo_oauth_send_email_alert( $email, $phone, $query, "Query for WP OAuth Single Sign On - ".$email ), true );
					// update_option('message', 'Thanks for getting in touch! We shall get back to you shortly.');
					// $this->mo_oauth_show_success_message();
					$submited = $customer->submit_contact_us( $email, $phone, $query, $send_config );
					if ( $submited == false ) {
						update_option('message', 'Your query could not be submitted. Please try again.');
						$this->mo_oauth_show_error_message();
					} else {
						update_option('message', 'Thanks for getting in touch! We shall get back to you shortly.');
						$this->mo_oauth_show_success_message();
					}
				}
			}	
		} 
		elseif( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_client_demo_request_form" && isset($_REQUEST['mo_oauth_client_demo_request_field']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['mo_oauth_client_demo_request_field'])), 'mo_oauth_client_demo_request_form') ) {

			if( current_user_can( 'administrator' ) ) {
				if( mo_oauth_is_curl_installed() == 0 ) {
					return $this->mo_oauth_show_curl_error();
				}
				// Demo Request
				$email = sanitize_email( $_POST['mo_auto_create_demosite_email'] );
				$demo_plan = stripslashes( $_POST['mo_auto_create_demosite_demo_plan'] );
				$query = stripslashes( $_POST['mo_auto_create_demosite_usecase'] );

				if ( $this->mo_oauth_check_empty_or_null( $email ) || $this->mo_oauth_check_empty_or_null( $demo_plan ) || $this->mo_oauth_check_empty_or_null($query) ) {
					update_option('message', 'Please fill up Usecase, Email field and Requested demo plan to submit your query.');
					$this->mo_oauth_show_error_message();
				} else {

					$demosite_status = (bool) @fsockopen('demo.miniorange.com', 443, $iErrno, $sErrStr, 5);

					if ( $demosite_status && "Not Sure" !==  $demo_plan ) {
						$url = 'http://demo.miniorange.com/wordpress-oauth/';
	
						$headers = array( 'Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'UTF - 8');
						$args = array(
							'method' =>'POST',
							'body' => array(
								'option' => 'mo_auto_create_demosite',
								'mo_auto_create_demosite_email' => $email,
								'mo_auto_create_demosite_usecase' => $query,
								'mo_auto_create_demosite_demo_plan' => $demo_plan,
								'mo_auto_create_demosite_plugin_name' => MO_OAUTH_PLUGIN_SLUG
							),
							'timeout' => '20',
							'redirection' => '5',
							'httpversion' => '1.0',
							'blocking' => true,
							'headers' => $headers,
	
						);
	
						$response = wp_remote_post( $url, $args );
	
						if ( is_wp_error( $response ) ) {
							$error_message = $response->get_error_message();
							echo "Something went wrong: $error_message";
							exit();
						}
						$output = wp_remote_retrieve_body($response);
						$output = json_decode($output);
	
						if(is_null($output)){
							$customer = new Customer();
							$customer->mo_oauth_send_demo_alert( $email, $demo_plan, $query, "WP OAuth Client On Demo Request - ".$email );
							update_option('message', "Thanks Thanks for getting in touch! We shall get back to you shortly.");
							$this->mo_oauth_show_success_message();
						} else {
							if($output->status == 'SUCCESS'){
								update_option('message', $output->message);
								$this->mo_oauth_show_success_message();
							}else{
								update_option('message', $output->message);
								$this->mo_oauth_show_error_message();
							}
						}
					} else {
						$customer = new Customer();
						$customer->mo_oauth_send_demo_alert( $email, $demo_plan, $query, "WP OAuth Client On Demo Request - ".$email );
						update_option('message', "Thanks Thanks for getting in touch! We shall get back to you shortly.");
						$this->mo_oauth_show_success_message();
					}
				}
			}
		}

		else if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_resend_otp_email" && isset( $_REQUEST['mo_oauth_resend_otp_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_resend_otp_form_field'] ) ), 'mo_oauth_resend_otp_form' )) {
			if( mo_oauth_is_curl_installed() == 0 ) {
				return $this->mo_oauth_show_curl_error();
			}

			$customer = new Customer();
			$email=get_option('mo_oauth_admin_email');
			$content = json_decode($customer->send_otp_token($email, ''), true);
			if(strcasecmp($content['status'], 'SUCCESS') == 0) {
					update_option( 'message', ' A one time passcode is sent to ' . get_option('mo_oauth_admin_email') . ' again. Please check if you got the otp and enter it here.');
					$_SESSION['mo_oauth_transactionId'] = $content['txId'];
					update_option('mo_oauth_registration_status','MO_OTP_DELIVERED_SUCCESS');
					$this->mo_oauth_show_success_message();
			}else{
					update_option('message','There was an error in sending email. Please click on Resend OTP to try again.');
					update_option('mo_oauth_registration_status','MO_OTP_DELIVERED_FAILURE');
					$this->mo_oauth_show_error_message();
			}
		} else if (isset($_POST ['option']) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_resend_otp_phone" && isset( $_REQUEST['mo_oauth_resend_otp_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_resend_otp_form_field'] ) ), 'mo_oauth_resend_otp_form' )) {

				if( mo_oauth_is_curl_installed() == 0 ) {
					return $this->mo_oauth_show_curl_error();
				}
				$phone = get_option('mo_oauth_admin_phone');
				$customer = new Customer();
				$content = json_decode($customer->send_otp_token('', $phone, FALSE, TRUE), true);
				if (strcasecmp($content ['status'], 'SUCCESS') == 0) {
					update_option('message', ' A one time passcode is sent to ' . $phone . ' again. Please check if you got the otp and enter it here.');
					update_option('mo_oauth_transactionId', $content ['txId']);
					update_option('mo_oauth_registration_status', 'MO_OTP_DELIVERED_SUCCESS_PHONE');
					$this->mo_oauth_show_success_message();
				} else {
					update_option('message', 'There was an error in sending email. Please click on Resend OTP to try again.');
					update_option('mo_oauth_registration_status', 'MO_OTP_DELIVERED_FAILURE_PHONE');
					$this->mo_oauth_show_error_message();
				}
			}else if (isset($_POST ['option']) && sanitize_text_field( wp_unslash( $_POST['option'] ) ) == 'mo_oauth_forgot_password_form_option' && isset( $_REQUEST['mo_oauth_forgotpassword_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_forgotpassword_form_field'] ) ), 'mo_oauth_forgotpassword_form' )) {

				if( current_user_can( 'administrator' ) ) {
					if (! mo_oauth_is_curl_installed()) {
						update_option('mo_oauth_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Resend OTP failed.');
						$this->mo_oauth_show_error_message();
						return;
					}

					$email = get_option('mo_oauth_admin_email');

					$customer = new Customer();
					$content = json_decode($customer->mo_oauth_forgot_password($email), true);

					if (strcasecmp($content ['status'], 'SUCCESS') == 0) {
						update_option('message', 'Your password has been reset successfully. Please enter the new password sent to ' . $email . '.');
						$this->mo_oauth_show_success_message();
					}
				}
		} else if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_change_email"  && isset( $_REQUEST['mo_oauth_change_email_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_change_email_form_field'] ) ), 'mo_oauth_change_email_form')) {
			//Adding back button
			update_option('verify_customer', '');
			update_option('mo_oauth_registration_status','');
			update_option('new_registration','true');
		} else if( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_oauth_register_with_phone_option" && isset( $_REQUEST['mo_oauth_register_with_phone_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_register_with_phone_form_field'] ) ), 'mo_oauth_register_with_phone_form')) {

			if( current_user_can( 'administrator' ) ) {
				if(!mo_oauth_is_curl_installed()) {
					return $this->mo_oauth_show_curl_error();
				}
				$phone = stripslashes($_POST['phone']);
				$phone = str_replace(' ', '', $phone);
				$phone = str_replace('-', '', $phone);
				update_option('mo_oauth_admin_phone', $phone);
				$customer = new Customer();
				$content=json_decode( $customer->send_otp_token('', $phone, FALSE, TRUE),true);
				if($content) {
					update_option( 'message', ' A one time passcode is sent to ' . get_site_option('mo_oauth_admin_phone') . '. Please enter the otp here to verify your email.');
					$_SESSION['mo_oauth_transactionId'] = $content['txId'];
					update_option('mo_oauth_registration_status','MO_OTP_DELIVERED_SUCCESS_PHONE');
					$this->mo_oauth_show_success_message();
				}else{
					update_option('message','There was an error in sending SMS. Please click on Resend OTP to try again.');
					update_option('mo_oauth_registration_status','MO_OTP_DELIVERED_FAILURE_PHONE');
					$this->mo_oauth_show_error_message();
				}
			}
		}

		else if ( isset( $_POST['option'] ) and sanitize_text_field( wp_unslash( $_POST['option'] ) ) == 'mo_oauth_client_skip_feedback' && isset( $_REQUEST['mo_oauth_skip_feedback_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_skip_feedback_form_field'] ) ), 'mo_oauth_skip_feedback_form')) {
			deactivate_plugins( __FILE__ );
			update_option( 'message', 'Plugin deactivated successfully' );
			$this->mo_oauth_show_success_message();
		}
		else if ( isset( $_POST['mo_oauth_client_feedback'] ) and sanitize_text_field( wp_unslash( $_POST['mo_oauth_client_feedback'] ) ) == 'true' && isset( $_REQUEST['mo_oauth_feedback_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_oauth_feedback_form_field'] ) ), 'mo_oauth_feedback_form')) {
			
			if( current_user_can( 'administrator' ) ) {
				$user = wp_get_current_user();
				$message = 'Plugin Deactivated:';
				$deactivate_reason         = array_key_exists( 'deactivate_reason_radio', $_POST ) ? sanitize_text_field( wp_unslash( $_POST['deactivate_reason_radio'] ) ) : false;
				$deactivate_reason_message = array_key_exists( 'query_feedback', $_POST ) ? sanitize_text_field( wp_unslash( $_POST['query_feedback'] ) ) : false;
				if ( $deactivate_reason ) {
					$message .= $deactivate_reason;
					if ( isset( $deactivate_reason_message ) ) {
						$message .= ':' . $deactivate_reason_message;
					}
					$email = get_option( "mo_oauth_admin_email" );
					if ( $email == '' ) {
						$email = $user->user_email;
					}
					$phone = get_option( 'mo_oauth_admin_phone' );
					//only reason
					$feedback_reasons = new Customer();
					$submited = json_decode( $feedback_reasons->mo_oauth_send_email_alert( $email, $phone, $message, "Feedback: WordPress ".MO_OAUTH_PLUGIN_NAME ), true );
					deactivate_plugins( __FILE__ );
					update_option( 'message', 'Thank you for the feedback.' );
					$this->mo_oauth_show_success_message();
				} else {
					update_option( 'message', 'Please Select one of the reasons ,if your reason is not mentioned please select Other Reasons' );
					$this->mo_oauth_show_error_message();
				}
			}
		}


	}

	function mo_oauth_get_current_customer(){
		$customer = new Customer();
		$content = $customer->get_customer_key();
		$customerKey = json_decode( $content, true );
		if( json_last_error() == JSON_ERROR_NONE ) {
			update_option( 'mo_oauth_admin_customer_key', $customerKey['id'] );
			update_option( 'mo_oauth_admin_api_key', $customerKey['apiKey'] );
			update_option( 'customer_token', $customerKey['token'] );
			update_option('password', '' );
			update_option( 'message', 'Customer retrieved successfully' );
			delete_option('verify_customer');
			delete_option('new_registration');
			$this->mo_oauth_show_success_message();
		} else {
			update_option( 'message', 'You already have an account with miniOrange. Please enter a valid password.');
			update_option('verify_customer', 'true');
			$this->mo_oauth_show_error_message();

		}
	}

	function create_customer(){
		$customer = new Customer();
		$customerKey = json_decode( $customer->create_customer(), true );
		if( strcasecmp( $customerKey['status'], 'CUSTOMER_USERNAME_ALREADY_EXISTS') == 0 ) {
			$this->mo_oauth_get_current_customer();
			delete_option('mo_oauth_new_customer');
		} else if( strcasecmp( $customerKey['status'], 'SUCCESS' ) == 0 ) {
			update_option( 'mo_oauth_admin_customer_key', $customerKey['id'] );
			update_option( 'mo_oauth_admin_api_key', $customerKey['apiKey'] );
			update_option( 'customer_token', $customerKey['token'] );
			update_option( 'password', '');
			update_option( 'message', 'Registered successfully.');
			update_option('mo_oauth_registration_status','MO_OAUTH_REGISTRATION_COMPLETE');
			update_option('mo_oauth_new_customer',1);
			delete_option('verify_customer');
			delete_option('new_registration');
			$this->mo_oauth_show_success_message();
		}
	}

	function mo_oauth_show_curl_error() {
		if( mo_oauth_is_curl_installed() == 0 ) {
			update_option( 'message', '<a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP CURL extension</a> is not installed or disabled. Please enable it to continue.');
			$this->mo_oauth_show_error_message();
			return;
		}
	}

	function mo_oauth_shortcode_login(){
		if(mo_oauth_hbca_xyake() || !mo_oauth_is_customer_registered()) {
			return '<div class="mo_oauth_premium_option_text" style="text-align: center;border: 1px solid;margin: 5px;padding-top: 25px;"><p>This feature is supported only in standard and higher versions.</p>
				<p><a href="'.get_site_url(null, '/wp-admin/').'admin.php?page=mo_oauth_settings&tab=licensing">Click Here</a> to see our full list of Features.</p></div>';
		}
		$mowidget = new Mo_Oauth_Widget;
		return $mowidget->mo_oauth_login_form();
	}

	function export_plugin_config( $share_with = false ) {
		$appslist = get_option('mo_oauth_apps_list');
		$currentapp_config = null;
		if ( is_array( $appslist ) ) {
			foreach( $appslist as $key => $value ) {
				$currentapp_config = $value;
				break;
			}
		}
		if ( $share_with ) {
			unset( $currentapp_config['clientid'] );
			unset( $currentapp_config['clientsecret'] );
		}
		return $currentapp_config;
	}

}

	function mo_oauth_is_customer_registered() {
		$email 			= get_option('mo_oauth_admin_email');
		$customerKey 	= get_option('mo_oauth_admin_customer_key');
		if( ! $email || ! $customerKey || ! is_numeric( trim( $customerKey ) ) ) {
			return 0;
		} else {
			return 1;
		}
	}

	function mo_oauth_is_curl_installed() {
		if  (in_array  ('curl', get_loaded_extensions())) {
			return 1;
		} else {
			return 0;
		}
	}

new mo_oauth;
function run_mo_oauth_client() { $plugin = new Mo_OAuth_Client();$plugin->run();}
run_mo_oauth_client();
