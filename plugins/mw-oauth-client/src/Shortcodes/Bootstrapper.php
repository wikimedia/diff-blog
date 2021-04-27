<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName
/*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     https://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (or later)
 * @copyright   Wikimedia Foundation
 */

namespace MW\WPOAuth\Shortcodes;

/**
 * Loads and contains all the shortcodes registered for this
 * plugin
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 */
class Bootstrapper {
	/**
	 * @var array(string)
	 */
	protected $shortcodes = array(
		'MW_SSO_Login_Button',
	);

	/**
	 * @var array(ShortcodeAbstract)
	 */
	protected $instances = array();

	public function __construct() {
		if ( ! empty( $this->shortcodes ) ) {
			foreach ( $this->shortcodes as $shortcode ) {
				$class = sprintf( '%s\%s', __NAMESPACE__, $shortcode );

				if ( class_exists( $class ) ) {
					$this->instances[] = new $class();
				}
			}
		}
	}
}
