<?php
/**
 * Helper Functions
 *
 * @category   Function
 * @package    Maple Studio
 * @author     Technology Therapy Group
 * @link       http://maplestudio.vn/
 */


 /**
 * Print clean current site's URL.
 */
function the_clean_url() {
	echo esc_attr( get_site_url() );
}

/**
 * Print CTA Button.
 *
 * @param array  $link Link ACF Array.
 * @param String $class CTA button's classes.
 */
function the_cta( $link, $class = 'button' ) {
	if ( $link ) {
		$link_str = '<a class="' . $class . '" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';
	}
	echo $link_str;
}

/**
 * Print socials sharing icons.
 *
 * @param array $services Social sharing services.
 */
function the_socials_share( $services = array( 'email', 'facebook', 'twitter', 'google-plus', 'linkedin' ) ) {

	$urls = array(
		'email'        => array( 'fas fa-envelope', 'mailto:?subject=' . urlencode(get_the_title()) . '&amp;body=' . urlencode(get_permalink()) ),
		'google-plus'  => array( 'fab fa-google-plus-g', 'https://plus.google.com/share?url=' . urlencode(get_permalink()) ),
		'facebook'     => array( 'fab fa-facebook-f', 'https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) ),
		'twitter'      => array( 'fab fa-twitter', 'https://twitter.com/intent/tweet?url=' . urlencode(get_permalink()) ),
		'linkedin'     => array( 'fab fa-linkedin', 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(get_permalink()) . '&title=' . urlencode(get_the_title()) ),
		'pinterest'    => array( 'fab fa-pinterest', 'http://pinterest.com/pin/create/link/?url=' . urlencode(get_permalink()) ),
		'tumblr'       => array( 'fab fa-tumblr', 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . urlencode(get_permalink()) . '&title={title}' . urlencode(get_the_title()) ),
	);

	$socials = '<div class="social-buttons">';

	foreach ( $services as $key => $service ) {
		if ( isset( $urls[ $service ] ) ) {
			$socials .= '<a class="social-button ' . $service . '" href="' . $urls[ $service ][1] . '" target="_blank"><i class="' . $urls[ $service ][0] . '"></i></a>';
		}
	}

	$socials .= '</div>';

	echo $socials; //phpcs:ignore

}

/**
 * Multiple delimiters explode.
 */
function multiexplode( $delimiters, $string ) {
	$ready  = str_replace( $delimiters, $delimiters[0], $string );
	$launch = explode( $delimiters[0], $ready );
	return $launch;
}

/**
 * Custom Pagination.
 */
if ( ! function_exists( 'custom_pagination' ) ) :
	function custom_pagination( $user_query = NULL ) {

		global $wp_query;
		global $user_limit;

		$big = 999999999; // This needs to be an unlikely integer

		$max_num_pages = $wp_query->max_num_pages;

		if ( $user_query ) {
			$max_num_pages = ceil( count( $user_query->get_results() ) / $user_limit );
		}

		// For more options and info view the docs for paginate_links()
		// http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $max_num_pages,
				'mid_size'  => 5,
				'prev_next' => false,
				'prev_prev' => false,
				'prev_text' => __( '&laquo;', 'ttg-wp' ),
				'next_text' => __( '&raquo;', 'ttg-wp' ),
				'type'      => 'list',
			)
		);

		$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination text-center list-reset' role='navigation' aria-label='Pagination'>", $paginate_links );
		$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
		$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
		$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'>", $paginate_links );
		$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
		$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );

		// Display the pagination if more than one page is found.
		if ( $paginate_links ) {
			echo $paginate_links;
		}
	}
endif;

/**
 * Convert Hex to RGBA
 *
 * @param String  $color
 * @param Boolean $opacity
 *
 */
function hex_to_rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	// Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}

  // Sanitize $color if "#" is provided
  if ( $color[0] == '#' ) {
    $color = substr( $color, 1 );
	}
	// Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif (strlen($color) == 3) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	// Convert hexadec to rgb
	$rgb = array_map( 'hexdec', $hex );

  // Check if opacity is set(rgba or rgb)
	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba('.implode( ",", $rgb ).','.$opacity.')';
	} else {
		$output = 'rgb('.implode( ",", $rgb ).')';
	}

	// Return rgb(a) color string
	return $output;
}

/**
 * Retrieves the attachment ID from the file URL
 *
 * @param String $link
 *
 */
function get_image_id( $link ) {
	global $wpdb;
	$link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);
	return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE BINARY guid='$link'");
}

/**
 * Sanitize textarea
 *
 * @param String $text
 *
 */
function sanitize_textarea( $text ) {
	return esc_textarea( $text );
}

/**
 * Color luminance
 *
 * @param String $hex
 * @param Float  $percent
 */
function color_luminance( $hex, $percent ) {

	// validate hex string
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';

	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}

	// convert to decimal and change luminosity
	for ( $i = 0; $i < 3; $i++ ) {
		$dec = hexdec( substr( $hex, $i * 2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 );
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}

	return $new_hex;
}

/**
 * Truncate string
 *
 * @param String  $text
 * @param Integer $numb
 * @param String  $after_text
 */
function truncate( $text, $numb, $after_text = "" ) {
	if ( strlen( $text ) > $numb ) {
		$text = substr( $text, 0, $numb );
		$text = substr( $text, 0, strrpos( $text, " " ) );
		$etc  = "...";
		$text = $text . $etc . $after_text;
	}
	return $text;
}

/**
 * Use underscore for sanitizing string
 *
 * @param String $title Title to be sanitized.
 */
function sanitize_title_with_underscore( $title ) {
	$text_to_transform = sanitize_title_with_dashes( $title );
	return str_replace( '-', '_', $text_to_transform );
}

/**
 * Retrieves the thumbnail from a youtube or vimeo video
 * @param - $src: the url of the "player"
 * @return - string
 * @todo - do some real world testing.
 *
**/
function get_video_thumbnail( $src ) {
	// If Vimeo
	if ( strpos( $src, 'vimeo' ) !== false ) {
		$url_pieces = explode( '/', $src );
		$ch = curl_init( 'https://vimeo.com/api/v2/video/' . $url_pieces[ count( $url_pieces ) - 1 ] . '.php' );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		$a         = curl_exec( $ch );
		$hash      = unserialize( $a );
		$thumbnail = $hash[0]["thumbnail_large"];
	} elseif ( strpos( $src, 'youtube' ) !== false ) {
		// If Youtube
		$extract_id = explode( '=', $src );
		$id         = $extract_id[1];
		$thumbnail  = 'http://img.youtube.com/vi/' . $id . '/hqdefault.jpg';
	}
	return $thumbnail;
}