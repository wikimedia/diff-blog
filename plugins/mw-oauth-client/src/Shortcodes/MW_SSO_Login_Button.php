<?php // phpcs:disable Wordpress.Files.InvalidClassFileName

namespace MW\WPOAuth\Shortcodes;

use MW\Lib\Shortcodes\ShortcodeAbstract;
use MW\WPOAuth\Helpers;
use MW\WPOAuth\Factory;

/**
 * Contains Helpers
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
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
