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
 * @license     https://opensource.org/licenses/GPL-2.0 GPL2.0
 * @copyright   Wikimedia Foundation
 */

namespace MW\WPOAuth\Shortcodes;

use MW\Lib\Shortcodes\ShortcodeAbstract;
use MW\WPOAuth\Helpers;
use MW\WPOAuth\Factory;

/**
 * Contains Helpers
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     https://opensource.org/licenses/GPL-2.0 GPL2.0
 * @copyright   Wikimedia Foundation
 */
class MW_SSO_Login_Button extends ShortcodeAbstract {
	/**
	 * @var string
	 */
	protected $tag = 'mw_sso_login_button';

	/**
	 * @param array $atts
	 * @param mixed $content
	 * @return string
	 */
	public function render( $atts = array(), $content ): string {
		$url   = Helpers::get_login_action_url();
		$label = ! empty( $content ) ? wp_kses_post( $content ) : __( 'Login with MediaWiki' );

		if ( Factory::instance()->is_ready() ) {
			$button = sprintf( '<a class="button button-large" href="%s">%s</a>', esc_attr( $url ), $label );
		} else {
			$button = sprintf( '<strong>%s</strong>', esc_html__( 'MediaWiki SSO is currently not available.', 'mw-oauth' ) );
		}
		return apply_filters( 'mw_sso_login_button_html', $button, $url, $label );
	}
}
