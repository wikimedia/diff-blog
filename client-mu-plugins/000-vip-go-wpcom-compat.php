<?php
/**
 * WordPress.com -> VIP Go compatibility. You can work to remove this as a dependency over time.
 *
 * It's important that this is loaded before any calls to wpcom_vip_legacy_load_plugin().
 */
if ( file_exists( __DIR__ . '/vip-go-wpcom-compat/vip-go-wpcom-compat.php' ) ) {
	require_once __DIR__ . '/vip-go-wpcom-compat/vip-go-wpcom-compat.php';
} else {
	trigger_error( 'Looks like the site was migrated from WordPress.com, however, "vip-go-wpcom-compat" is missing from the repository. If this is intentional, please remove this file.', E_USER_WARNING );
}
