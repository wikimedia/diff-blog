<?php // phpcs:ignore

namespace MW\Lib\Shortcodes;

/**
 * Contains Helpers
 *
 * @package     mediawiki\wp-oauth-client
 * @author      Brad Morris <hello@bradleymorris.co.uk>
 * @license     Proprietary
 * @copyright   Radfunds
 */
abstract class ShortcodeAbstract {

	/**
	 * @var string
	 */
	protected $tag;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		add_shortcode( $this->tag, array( $this, 'render' ) );
	}

	/**
	 * @param array $atts
	 * @param mixed $content
	 * @return string
	 */
	abstract public function render( $atts = array(), $content ): string;
}
