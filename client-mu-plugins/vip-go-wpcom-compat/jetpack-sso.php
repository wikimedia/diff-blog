<?php

/**
 * Jetpack SSO: Match WP.com accounts by email
 *
 * This ensures user accounts that have been imported from WordPress.com
 * are still associated with the same WP.com account for the purpose
 * of Jetpack SSO.
 */
add_filter( 'jetpack_sso_match_by_email', '__return_true', 9999 );

add_filter( 'jetpack_active_modules', 'vip_wpcom_compat_enable_jetpack_sso', 9999 );
function vip_wpcom_compat_enable_jetpack_sso( $modules ) {
	$modules[] = 'sso';
	return array_unique( $modules );
}
