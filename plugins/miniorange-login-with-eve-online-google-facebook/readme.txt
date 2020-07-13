=== OAuth Single Sign On - SSO (OAuth Client) ===
Contributors: cyberlord92,oauth
Tags: oauth, oauth 2.0, Single sign on, sso, wordpress sso, openid, login, wordpress login
Requires at least: 3.0.1
Tested up to: 5.4
Stable tag: 6.16.0
License: MIT/Expat
License URI: https://docs.miniorange.com/mit-license

Allows SSO with Cognito, Azure, Okta, Onelogin, Keycloak, WHMCS, Google Apps, Salesforce & many OAuth / OpenID Servers[24/7 SUPPORT]. It also allows Single Sign On with WordPress as well as custom providers.

== Description ==

This plugin allows login (Single Sign On) into WordPress with your Office 365, Azure AD, Azure B2C, AWS Cognito, WSO2, Keycloak, WHMCS, Okta, LinkedIn, Invision Community, Slack, Amazon, Discord, Twitter, Google Apps or other custom OAuth 2.0 / OpenID Connect providers. WordPress OAuth Client plugin works with any Identity provider that conforms to the OAuth 2.0 Server and OpenID Connect (OIDC) 1.0 standard.
It also covers User Authentication with OAuth & OIDC protocol and allow authorized user to login into WordPress site.


[youtube https://youtu.be/rIe2yvree0g]


= Single Sign-On(SSO) =

In simple term, Single Sign On(SSO) means login into 1 site / application using the credentials of another app/site.
Example. If you have all your Users/Customers/Members/Employees stored on 1 site(ex. gmail, wordpress, etc.), lets say site A and you want all of them to register/login into your WordPress site say site B. In this scenario, you can register/login all your users of site A into Site B using the login credentials/account of Site A. This is call Single Sign-On or SSO.

= Single Sign On supported Third Party Application / OAuth-OIDC Provider =
* The other terms are: OAuth Provider, OAuth Server, OpenID Connect Server, OpenID Connect Provider, OIDC Provider, OIDC Server, OAuth Application, OpenID Connect Application, OIDC Application, OpenIDConnect Server, OpenIDCConnect Provider, OpenIDConnect Application
* This Third Party Application can be anything where User Accounts are stored or site/application where you want to store/migrate all the users. It can be your social app/site, wordpress, custom app or any database.

= Single Sign On USE-CASES =

* Single Sign-On between WordPress - Wordpress(Login with WordPress) :
	1. Single Sign-On to 1 WordPress site using User Credentials stored on Another WordPress site
	2. Single Sign-On to 1 / multiple WordPress sites (or subsites) using User Credentials stored on Another WordPress site
* Single Sign-On between WordPress and Any OAuth / OpenID Connect (OIDC) application(Login with Social Login Apps / Custom Providers) :
    1. Single Sign-On to 1 WordPress site using User Credentials stored on your third party application
	2. Single Sign-On to 1 / multiple WordPress sites (or subsites) using User Credentials stored on Another WordPress site
* Single Sign-On into WordPress Using existing User stores(Active Directory/Database)

= FREE VERSION FEATURES =

*	WordPress OAuth Login supports single sign-on / SSO with any 3rd party OAuth / OpenIDConnect server or custom OAuth / OpenIDConnect server like AWS Cognito, Azure, Office 365, Google Apps, etc.
*   	Single Sign On (SSO) Grant Support - Standard OAuth 2.0 Grant :  Authorization Code
*   	Auto Create Users (User Provisioing) : After SSO, new user automatically gets created in WordPress
*	Account Linking : After user SSO to WordPress, if user already exists in WordPress, then his profile gets updated or it will create a new WordPress User
*	Attribute Mapping : OAuth Login supports username Attribute Mapping feature to map WordPress user profile username attribute.
*	Login Widget : Use Widgets to easily integrate the login link with your WordPress site
*	OpenID Connect / OAuth Provider Support : OAuth Login (Single Sign On) supports only one OpenID Connect / OAuth Provider.
*	Redirect URL after Login : OAuth Login (Single Sign On) Automatically Redirects user after successful login.
*	Logging :  If you run into issues OAuth Login (Single Sign On) can be helpful to enable debug logging


= STANDARD VERSION FEATURES =

*	All the FREE Version Features included.
*   	Single Sign On (SSO) Grant Support - Standard OAuth 2.0 Grant :  Authorization Code
*	Optionally Auto Register Users : OAuth Login (Single Sign On) does automatic user registration after login if the user is not already registered with your site
*	Basic Role Mapping :  OAuth Login (Single Sign On) provides basic Attribute Mapping feature to map WordPress user profile attributes like username, firstname, lastname, email and profile picture. Manage username & email with data provided.
                          Also, Assign default role to user registering through OAuth Login based on rules you define.
*	Support for Shortcode : Use shortcode to place OAuth login button anywhere in your Theme or Plugin
*	Customize Login Buttons / Icons / Text : Wide range of OAuth Login (Single Sign On) Buttons/Icons and it allows you to customize Text shadow
*	Custom Redirect URL after Login : WordPress OAuth Single Sign On / SSO provides auto redirection and this is useful if you wanted to globally protect your whole site
*	Custom Redirect URL after logout : WordPress OAuth Single Sign On / SSO allows you to auto redirect Users to custom URL after he logs out from your WordPress site


= PREMIUM VERSION FEATURES =

*	All the STANDARD Version Features
*       Single Sign On (SSO) Grant Support - Standard OAuth2.0 Grants: Authorization Code, Implicit Grant, Password Grant, Refresh Token Grant (Customization Available)
*	Advanced Role Mapping : Assign roles to users registering through OAuth Login(Single Sign On) based on rules you define.
*	Force Authentication / Protect Complete Site : Allows user to restrict login(Single Sign On) / authorization for particular site
*	Multiple Userinfo Endpoints Support : OAuth Login(Single Sign On) supports multiple Userinfo Endpoints.
*	App domain specific Registration Restrictions : OAuth Login (Single Sign On) restricts registration on your site based on the person's email address domain
*	Multi-site Support : OAuth Login(Single Sign On) have unique ability to support multiple sites under one account

= ENTERPRISE VERSION FEATURES =

*	All the PREMIUM Version Features
*	Multiple OAuth / OpenID Connect Provider Support
*   	Single Sign On (SSO) Grant Support - Standard OAuth2.0 Grants : Authorization Code, Implicit Grant, Password Grant, Refresh Token Grant, Client Credential Grant (Customization Available)
*	Single Login button for Multiple Apps : It provides single login button for multiple providers
*	Extended OAuth API support : Extend OAuth API support to extend functionality to the existing OAuth client.
*	BuddyPress Attribute Mapping : OAuth Login allows BuddyPress Attribute Mapping.
*	Page Restriction according to roles : Limit Access to pages based on user status or roles. This WordPress OAuth Login plugin allows you to restrict access to the content of a page or post to which only certain group of users can access.
*	WP Hooks for Different Events : Provides support for different hooks for user defined functions
*	Single Sign On Login Reports : OAuth Login (Single Sign On) creates user login and registration reports based on application used.


= No SSL restriction =
*	Login to WordPress (WordPress SSO) using Google credentials (Google Apps Login) or any other app without having an SSL or HTTPS enabled site.

= List of popular OAuth Providers we support for Single Sign On (SSO) =
*	Azure AD
*	AWS Cognito
*   	WHMCS
*   	Zoho
*   	Ping Federate (Ping / Ping Identity)
*	Slack
*	Discord
*	HR Answerlink / Support center
*	WSO2
*	Wechat
*	Weibo
*   	LinkedIn
*	Gitlab
*	Shibboleth
*	Blizzard (Formerly Battle.net)
*	servicem8
*	Meetup
*	Eve Online
*	Gluu Server
*   	WSO2
*	NetIQ
* 	Centrify
*   	Shibboleth
*   	Azure B2C
*   	Egnyte
*   	Twitter
*   	OpenAM
*   	Azure B2C
*   	Basecamp
*   	Steam
*   	Webflow


= List of popular OpenID Connect (OIDC) Providers we support for Single Sign On (SSO) =
*	Amazon
*	Salesforce
*	PayPal
*	Google Apps
*	AWS Cognito
*	Okta
*	OneLogin
*	Yahoo
*	ADFS
*	Gigya
*   	Swiss-RX-Login (Swiss RX Login)
*   	Azure AD
*   	Azure B2C
*	PhantAuth
* 	XING
*   	OpenAM
*   	Centrify
*   	Egnyte
* 	DID
*	OpenAthens
*	Stripe

= List of grant types we support for Single Sign On (SSO) =
*   Authorization code grant
*   Implicit grant
*   Resource owner credentials grant (Password Grant)
*   Client credentials grant
*   Refresh token grant


= Other OAuth / OpenID Connect Providers we support for Single Sign On (SSO) =
*	Other oauth 2.0 servers oauth single sign-on plugin support includes Office 365, Egnyte, Autodesk, Zendesk, Foursquare, Harvest, Mailchimp, Bitrix24, Spotify, Vkontakte, Huddle, Reddit, Strava, Ustream, Yammer, RunKeeper, Instagram, SoundCloud, Pocket, PayPal, Pinterest, Vimeo, Nest, Heroku, DropBox, Buffer, Box, Hubic, Deezer, DeviantArt, Delicious, Dailymotion, Bitly, Mondo, Netatmo, Amazon, FitBit, Clever, Sqaure Connect, Windows, Dash 10, Github, Invision Community, Blizzard, authlete, Keycloak, Procore, Eve Online, Laravel Passport, Nextcloud, Renren, Soundcloud, OpenAM, IdentityServer, ORCID, Diaspora, Timezynk, Idaptive, Duo Security, Rippling, Crowd, Janrain, Numina Solutions, Ubuntu Single Sign On, Apple, Ipsilon, Zoho, Itthinx, Fellowshipone, Miro, Naver etc.


== Supported Add-ons with Single Sign On (SSO) ==

We have a variety of add-ons that can be integrated with the OAuth Single Sign On plugin to improve the OAuth SSO functionality of your WordPress site.

*	Page Restriction – This add-on is basically used to protect the pages/posts of your site with OAuth / OpenID Connect compliant IDP(Server) login page and also, restrict the access to pages/posts of the site based on the user roles.
*	BuddyPress Integration – This add-on maps the attributes fetched from the OAuth / OpenID Connect compliant IdP with BuddyPress attributes.
*	Login Form Add-On - This add-on provides Login form for OAuth/OpenID login instead of a only a button. It relies on OAuth/OpenID plugin to have Password Grant configured. It can be customized using custom CSS and JS.
*	Membership Level based Login Redirection - This add-on allows to redirect users to custom pages based on users' membership levels after Single Sign On. Checks for the user's membership level during every login, so any update on the membership level doesn't affect redirection.

= Real Time User Provisioning using SCIM =
Provides use-provisioning from your IDP to your WordPress using SCIM standard. You can refer our <a href="https://www.miniorange.com/wordpress-miniorange-scim-user-provisioner-with-onelogin/" target="_blank"> WordPress User Provisioning using SCIM </a> plugin.

= REST API Authentication =
Secures the unauthorized access to your WordPress sites/pages using our <a href="https://wordpress.org/plugins/wp-rest-api-authentication/" target="_blank">WordPress REST API Authentication</a> plugin.

== Installation ==

= From your WordPress dashboard =
1. Visit `Plugins > Add New`
2. Search for `oauth`. Find and Install `oauth` plugin by miniOrange
3. Activate the plugin

= From WordPress.org =
1. Download WordPress OAuth Single Sign On (OAuth Client).
2. Unzip and upload the `miniorange-oauth-login` directory to your `/wp-content/plugins/` directory.
3. Activate miniOrange OAuth from your Plugins page.

= Once Activated =
1. Go to `Settings-> miniOrange OAuth -> Configure OAuth`, and follow the instructions
2. Go to `Appearance->Widgets` ,in available widgets you will find `miniOrange OAuth` widget, drag it to chosen widget area where you want it to appear.
3. Now visit your site and you will see login with widget.

= For Viewing Corporation, Alliance, Character Name in user profile =
To view Corporation, Alliance and Character Name in edit user profile, copy the following code in the end of your theme's `Theme Functions(functions.php)`. You can find `Theme Functions(functions.php)` in `Appearance->Editor`.
<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>

== Frequently Asked Questions ==
= I need to customize the plugin or I need support and help? =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= How to configure the applications? =
On configure OAuth page, check if your app is already there in default app list, if not then select the custom OAuth 2.0 app or Custom OpenID Connect Provider app based on the protocol supported by your OAuth Server. Then click on How to Configure link to see configuration instructions.


<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>


= I need integration of this plugin with my other installed plugins like BuddyPress, etc.? =
We will help you in integrating this plugin with your other installed plugins. Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I verified the OTP received over my email and entering the same password that I registered with, but I am still getting the error message - "Invalid password." =
Please write to us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> and we will get back to you very soon.

=  I would like to change our license to support the Different Domain. How do we do this? =
Yes, You can now activate the license on your new domain. Write us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> we will help you set up.

= Is it possible to set a different redirect URL after login & logout =
Yes, With standard license you can set different redirect URL to redirect to after login as well as after logout.

= For any other query/problem/request =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.


== Screenshots ==

1. List of Apps
2. Login button customization
3. Advanced Feature
4. Troubleshooting
5. Attribute & Role Mapping
6. Login Button / Widget
7. WordPress Dashboard Login

== Changelog ==

= 6.16.0 =
* Automated the plugin OAuth & OIDC configuration
* Added Setup a Call button
* Added UI changes and minor bugfixes

= 6.15.3 =
* Minor fixes

= 6.15.2 =
* Added default apps for WordPress, Zoho, miniOrange Providers
* Updated WHMCS Endpoint

= 6.15.1 =
* Added Copy Callback feature
* Added option to map attributes(manual/automatic)
* Added fixes for Demo Request feature
* Fixed empty UserInfo Endpoint issue
* Added new Apps for Login with Azure - Azure AD, Azure B2C and end to end sso setup guides
* Updated Licensing Plan
* Advertised new features
* Other minor bugfixes and UI changes

= 6.15.0 =
* Updated Licensing plan

= 6.14.5 =
* Attribute mapping fix
* Some UI fixes and bug fixes
* Added new providers
* Added check for failed registration for blocked domains and displayed the message accordingly

= 6.14.4 =
* Dropdown fix
* Added new providers
* Minor compatibility fixes

= 6.14.3 =
* UI Updates

= 6.14.2 =
* Minor Fixes

= 6.14.1 =
* Added nonces and sanitized required parameters
* Updated all the 3rd party libraries
* Added constants
* Added fixes for account setup and attribute Mapping
* Added New Providers (ORCID, Diaspora, Timezynk)

= 6.14.0 =
* Updated widget logos
* Automated Attribute Mapping 
* Updated Visual Tour 
* Added New Providers (miniOrange, Identity Server, Nextcloud, Twitch, Wild Apricot, Connect2id )
* Updated Support Query / Contact Us form

= 6.13.0 =
* Fixed the SSO for Default Azure app
* Advertised SSO Setup Video
* Updated plugin licensing
* Added support for new providers (Centrify, NetIQ, OpenAM, IdentityServer )
* Minor compatibility fixes

= 6.12.12 =
* Added fixes for Widget / Login Button Logo
* Added fixes for common CSS conflicts
* Updated UI
* Added WordPress Theme Compatibility

= 6.12.11 =
* Removed unused libraries

= 6.12.0 =
* Added Login Button on WordPress Dashboard
* Updated Login Button UI
* Added checkboxes to send Client Credentials in Header/Body
* Fixed Attribute Mapping, backslash issue 
* Fixed CSS conflicts
* Automated Request for Demo 

= 6.11.4 =
* Added support for WSO2 & Swiss-Rx-Login (Swiss RX Login)
* UI updates

= 6.11.3 =
* Added Add-on tab
* Added UI Changes
* Added compability for WordPress version 5.2.2

= 6.11.2 =
* Attribute Mapping fixes
* minor UI Changes

= 6.11.1 =
* Minor bugfixes

= 6.11.0 =
* Bug fixes and Minor UI changes

= 6.10.6 =
* Added Compatibility for Wordpress version 5.2.1
* Updated API of support query
* Updated Regisatrtion form
* Added Request for Demo form
* Added Forum link
* Advertised New Features - 
* Updated Licensing Plan

= 6.10.5 =
* Added compatibility for WordPress version 5.2

= 6.10.4 =
* Added Authorization Headers 

= 6.10.3 =
* Added support for Meetup, Autodesk and Zendesk
* Updated Feedback form

= 6.10.2 =
* Added email validation on login
* Tested WP 5.1 compatibility

= 6.10.1 =
* Added WHMCS in default applist

= 6.10.0 =
* Updated Google APIs
* Fixed cURL issues

= 6.9.17 =
* Updated Licesning Plan

= 6.9.16 =
* Added Uninstall fixes

= 6.9.15 =
* Updated Licesning plan

= 6.9.14 =
* Added CSS fixes

= 6.9.1 =
* UI changes

= 6.9.0 =
* Delayed Registration
* Updated Password Validation

= 6.8.1 =
* Added Bug Fixes

= 6.8.0 =
* Added Visual Tour
* Updated UI
* Added Setup Guides Links

= 6.7.0 =
* Compatibility with WordPress 5.1 

= 6.6.5 =
* Added FAQ Tab

= 6.6.2 =
* Added Bug Fixes

= 6.6.1 =
* Added Bug Fixes

= 6.6.0 =
* Updated UI
* Added Auto Create User feature

= 6.5.0 =
* Added support for OpenID Connect (OIDC) Provider
* Added option to disable Authorization Header for Get User Info Endpoint

= 6.4.0 =
* Updated Licensing Plan

= 6.3.0 =
* Bug fixes for 'Vulnerable Link' issue

= 6.1.2 =
* Bug fix for Invalid OTP error

= 6.1.1 =
* CSS customizations

= 6.0.2 =
* Added premium features page.

= 6.0.1 =
* Updated list of OAuth Providers.

= 5.22 =
* Handled self signed SSL sites and slashes.

= 5.21 =
* Bug fixes fetching user resource

= 5.20 =
* Added shortcode option

= 5.12 =
* Added Windows Live app and bug fixes

= 5.10 =
* Changed callback url

= 5.9 =
* Added UI customizations.

= 5.8 =
* Bug fix for warnings showing up.

= 5.3 =
* Compatibility with WordPress 4.7.3
 
= 2.4 =
* Registration Fixes 

= 2.3 =
* Eve Online Changes
* Compatibility with WordPress 4.5.1

= 2.2 =
* Bug fixes
* Compatibility with WordPress 4.5

= 2.1 =
* Bug fixes

= 2.0 =
* Email after first login.
* Redirection after login - same page or custom.
* Shortcode
* Added option for alllowed faction.
* Denied access for character, alliance, corp, faction.

= 1.8 =
* Sets last_name as EVE Online Character Name when user logs in for the first time

= 1.7 =
* Bug fixes for some users facing problem after sign in

= 1.6 =
* Bug fixes.

= 1.5 =
* Fixed bug where user was not redirecting to EVE Online in some php versions.

= 1.4 =
* Bug fixes

= 1.3 =
* Bug fixes

= 1.2 =
* Bug fixes

= 1.1 =
* Added email ID verification during registration.

= 1.0.5 =
* Added Login with Facebook

= 1.0.4 =
* Updates user's profile picture with his EVE Online charcater image.
* Submit your query (Contact Us) from within the plugin.

= 1.0.3 =
* Bug fix

= 1.0.2 =
* Resolved EVE Online login flow bug in some cases

= 1.0.1 =
* Resolved some bug fixes.

= 1.0 =
* First version with supported applications as EVE Online and Google.