<?php

class WPCOM_Compat_Command extends WPCOM_VIP_CLI_Command {

	/**
	 * Import protected embeds from WordPress.com
	 *
	 * # OPTIONS
	 *
	 * <file>
	 * : The CSV file to import
	 *
	 * @subcommand import-protected-embeds
	 */
	function import_protected_embeds( $args ) {
		list( $file ) = $args;

		if ( ! file_exists( $file ) ) {
			WP_CLI::error( 'Specified file does not exist' );
		}

		$fd = fopen( $file, 'r' );
		if ( ! $fd ) {
			WP_CLI::error( sprintf( 'Could not open file: %s', $file ) );
		}

		$header = fgetcsv( $fd );
		if ( ! is_array( $header ) || count( $header ) !== 6 ||
			! in_array( 'id', $header, true ) ||
			! in_array( 'embed_id', $header, true ) ||
			! in_array( 'src', $header, true ) ||
			! in_array( 'embed_group_id', $header, true ) ||
			! in_array( 'html', $header, true ) ||
			! in_array( 'time_added', $header, true ) ) {
			WP_CLI::error( 'Invalid CSV, missing required fields' );
		}

		$sql = 'CREATE TABLE `protected_embeds` ( ' .
			'`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, ' .
			'`embed_id` varchar(64) NOT NULL, ' .
			'`src` varchar(255) NOT NULL, ' .
			'`embed_group_id` varchar(64) NOT NULL, ' .
			'`html` mediumtext, ' .
			'`time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
			'PRIMARY KEY (`id`), ' .
			'UNIQUE KEY `embed_id` (`embed_id`) ' .
			') ENGINE=InnoDB AUTO_INCREMENT=0';

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$q = dbDelta( $sql );
		WP_CLI::line( $q['protected_embeds'] );

		global $wpdb;
		$success = 0;
		$errors  = 0;
		while ( $row = fgetcsv( $fd ) ) {
			$data = array_combine( $header, $row );
			if ( empty( $data ) || ! $data['id'] ) {
				continue;
			}

			$insert = $wpdb->insert( 'protected_embeds', $data );
			if ( ! $insert ) {
				WP_CLI::warning( "Could not insert embed: `{$data['id']}`" );
				WP_CLI::warning( $wpdb->last_error );
				$errors++;
			} else {
				$success++;
			}
		}

		if ( $errors < 1 ) {
			WP_CLI::success( 'Inserted all embeds without errors' );
		} else {
			WP_CLI::line( sprintf( 'Successfully inserted %d embeds', $success ) );
			WP_CLI::line( sprintf( 'Failed to insert %d embeds', $errors ) );
		}
	}
}

WP_CLI::add_command( 'wpcom-compat', new WPCOM_Compat_Command );
