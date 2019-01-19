<?php
/**
 *
 * Custom Mega Menu
 * Credit: http://selfteach.me/mega-menu-wordpress-without-plugin/
 *
 * @package WRWC
 * @since WRWC 1.0.0
 */

$locations = get_nav_menu_locations();
$location  = 'primary';
if ( isset( $locations[ $location ] ) ) {
	$menu = get_term( $locations[ $location ], 'nav_menu' );
	// If there are items in the primary menu.
	if ( $items = wp_get_nav_menu_items( $menu->name ) ) { //phpcs:ignore
		// Loop through all menu items to display their content.
		foreach ( $items as $item ) {
			// If the current item is not a top level item, skip it.
			if ( '0' !== $item->menu_item_parent ) {
				continue;
			}
			// Get the ID of the current nav item.
			$cur_item_id = $item->ID;
			// Current submenu args.
			// REQUIRE 'wp_nav_menu Extended!' (https://wordpress.org/plugins/wp-nav-menu-extended/) plugin to work.
			$cur_submenu = array(
				'theme_location' => $location,
				'container'      => false,
				'menu_class'     => 'mega-menu__submenu list-reset',
				'level'          => 2,
				'child_of'       => $item->ID,
				'echo'           => false,
			);
			// Build the mega-menu.
			if ( wp_nav_menu( $cur_submenu ) ) :
			?>
			<div class="mega-menu mega-menu-<?php echo esc_attr( $cur_item_id ); ?> js-mega-menu">
				<div class="container animated fadeIn">
					<?php echo wp_nav_menu( $cur_submenu ); ?>
				</div>
			</div>
			<?php
			endif;
		}
	}
}
?>
