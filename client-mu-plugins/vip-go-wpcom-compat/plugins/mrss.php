<?php
/**
 * This is not a verbatim copy of WP.com's version.
 */
if ( ! function_exists( 'mrss_init' ) ) {
	add_action( 'template_redirect', 'mrss_init' );

	function mrss_init() {
		if ( ! is_feed() ) {
			return;
		}

		if ( isset( $_GET['mrss'] ) && $_GET['mrss'] == 'off' ) {
			return;
		}

		add_action( 'rss2_ns', 'mrss_ns' );
		add_action( 'rss2_item', 'mrss_item', 10, 0 );
	}

	function mrss_ns() {
		?>xmlns:media="http://search.yahoo.com/mrss/"
		<?php
	}

	function mrss_item( $content = null ) {

		global $shortcode_tags;

		$meds            = array();
		$_shortcode_tags = $shortcode_tags;
		$shortcode_tags  = array( 'gallery' => 'gallery_shortcode' );

		if ( ! isset( $content ) ) {
			$content = get_the_content();
		}

		$content        = apply_filters( 'the_content_rss', $content );
		$content        = do_shortcode( $content );
		$shortcode_tags = $_shortcode_tags;

		// img tags
		if ( preg_match_all( '/<img (.+?)>/', $content, $matches ) ) {
			foreach ( $matches[1] as $attrs ) {
				$media = $img = array();
				foreach ( wp_kses_hair( $attrs, array( 'http', 'https' ) ) as $attr ) {
					$img[ $attr['name'] ] = $attr['value'];
				}
				if ( ! isset( $img['src'] ) || 0 !== strpos( $img['src'], 'http' ) ) {
					continue;
				}
				$media['content']['attr']['url']    = esc_url( $img['src'] );
				$media['content']['attr']['medium'] = 'image';
				if ( ! empty( $img['title'] ) ) {
					$media['content']['children']['title']['attr']['type'] = 'html';
					$media['content']['children']['title']['children'][]   = $img['title'];
				} elseif ( ! empty( $img['alt'] ) ) {
					$media['content']['children']['title']['attr']['type'] = 'html';
					$media['content']['children']['title']['children'][]   = $img['alt'];
				}
				$meds[] = $media;
			}
		}

		// audio players
		if ( preg_match_all( '!\[audio (.+)\]!i', $content, $matches ) ) {
			foreach ( $matches[1] as $url ) {
				$media = array();

				// New-style media player puts the audio in a src or mp3 attribute.
				// If we see an attribute starting with a https? url use that instead of the compat stuff below
				if ( preg_match( '!\w+="(https?://[^"]+)"!', $url, $attribute_match ) ) {
					$url = $attribute_match[1];
				} else {
					// Remove the audio player config args that start with the pipe symbol (&#124;)
					$url = preg_replace( '/\&#124;.+/', '', $url );
					$url = html_entity_decode( $url );
					$url = preg_replace( '/[<>"\']/', '', $url );
				}

				$media['content']['attr']['url']    = esc_url( $url );
				$media['content']['attr']['medium'] = 'audio';
				$meds[]                             = $media;
			}
		}

		$meds = apply_filters( 'mrss_media', $meds );

		if ( ! empty( $meds ) ) {
			foreach ( $meds as $media ) {
				mrss_print( $media );
			}
		}
	}

	add_filter( 'mrss_media', 'mrss_featured_image' );

	/* Add featured image, as first item */
	function mrss_featured_image( $meds ) {

		if ( ! ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) ) {
			return $meds;
		}

		$media = array();

		$thumb_id  = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );
		$thumb_url = $thumb_url[0];

		if ( ! empty( $thumb_url ) ) {
			$media['thumbnail']['attr']['url']  = esc_url( $thumb_url );
			$media['content']['attr']['url']    = esc_url( $thumb_url );
			$media['content']['attr']['medium'] = 'image';
		}

		$thumbnail = & get_post( $thumb_id );
		$title     = trim( strip_tags( $thumbnail->post_title ) );

		if ( empty( $title ) ) {
			$title = trim( strip_tags( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) );
		}

		if ( ! empty( $title ) ) {
			$media['content']['children']['title']['attr']['type'] = 'html';
			$media['content']['children']['title']['children'][]   = $title;
		}

		// Remove from list if already there.
		foreach ( $meds as $key => $med ) {
			if ( $med['content']['attr']['url'] == $thumb_url ) {
				unset( $meds[ $key ] );
			}
		}

		// Add as first item
		array_unshift( $meds, $media );

		return $meds;
	}

	function mrss_news_item() {
		foreach ( get_post_custom() as $k => $v ) {
			if ( $k == $v[0] && strpos( $k, ':' ) ) {
				list( $blog_id, $post_id ) = explode( ':', $k );
				break;
			}
		}
		$post = get_blog_post( $blog_id, $post_id );

		mrss_item( $post->post_content );
	}

	function mrss_print( $element, $indent = 2 ) {

		echo "\n";

		foreach ( (array) $element as $name => $data ) {

			echo str_repeat( "\t", $indent ) . "<media:$name";
			if ( ! empty( $data['attr'] ) ) {
				foreach ( $data['attr'] as $attr => $value ) {
					echo " $attr=\"" . ent2ncr( esc_attr( $value ) ) . '"';
				}
			}
			if ( ! empty( $data['children'] ) ) {
				$nl = false;
				echo '>';
				foreach ( $data['children'] as $_name => $_data ) {

					if ( is_int( $_name ) ) {

						if ( ! is_array( $_data ) ) {
							echo ent2ncr( esc_html( $_data ) );
						} else {
							// allow nested same level elements
							$nl = true;
							mrss_print( $_data, $indent + 1 );
						}
					} else {
						$nl = true;
						mrss_print( array( $_name => $_data ), $indent + 1 );
					}
				}

				if ( $nl ) {
					echo str_repeat( "\t", $indent );
				}

				echo "</media:$name>\n";
			} else {
				echo " />\n";
			}
		}
	}
}
