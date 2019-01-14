<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function macmall_widgets_init() {

	register_sidebar(
		array(
			'id'            => 'sidebar-1',
			'name'          => esc_html__( 'Sidebar', 'macmall' ),
			'description'   => esc_html__( 'Add widgets here.', 'macmall' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
	) );

	register_sidebar(
		array(
			'id'            => 'footer-widgets',
			'name'          => __( 'Footer widgets', 'macmall' ),
			'description'   => __( 'Drag widgets to this footer container.', 'macmall' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}

add_action( 'widgets_init', 'macmall_widgets_init' );
