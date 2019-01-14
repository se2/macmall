<?php
/**
 * ACF Options Page
 *
 * @category   ACF
 * @package    Lib
 * @author     Maple Studio
 * @link       http://maplestudio.vn/
 */

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(array(
		'page_title' => 'Theme Settings Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
	));

}
