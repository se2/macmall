<?php
/**
 * Home Media section
 *
 * @category   Module
 * @package    MacMall
 * @author     Maple Studio
 * @link       https://maplestudio.vn/
 */

if ( have_rows( 'home_media' ) ) :
	while ( have_rows( 'home_media' ) ) :
		the_row();
		$link   = get_sub_field( 'media_link' );
		$tablet = get_sub_field( 'tablet_image' ) ? get_sub_field( 'tablet_image' ) : get_sub_field( 'desktop_image' );
		$mobile = get_sub_field( 'mobile_image' ) ? get_sub_field( 'mobile_image' ) : $tablet;
?>
	<section class="home-media flex flex-wrap overflow-x-hidden">
		<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="block w-full lg:<?php the_sub_field( 'layout' ); ?> <?php echo ( get_sub_field( 'layout' ) == 'w-1/2' ) ? 'lg:pr-6' : ''; ?> pb-12">
			<img src="<?php the_sub_field( 'desktop_image' ); ?>" alt="" class="h-full w-full hidden xl:block desktop-image">
			<img src="<?php echo esc_url( $tablet ); ?>" alt="" class="h-full w-full hidden md:block xl:hidden tablet-image">
			<img src="<?php echo esc_url( $mobile ); ?>" alt="" class="h-full w-full block md:hidden mobile-image">
		</a>
		<?php
		if ( ( get_sub_field( 'layout' ) == 'w-1/2' ) && ( get_sub_field( 'desktop_image_2' ) ) ) :
			$link_2 = get_sub_field( 'media_link_2' );
		?>
		<a href="<?php echo esc_url( $link_2['url'] ); ?>" target="<?php echo esc_attr( $link_2['target'] ); ?>" class="block w-full lg:<?php the_sub_field( 'layout' ); ?> lg:pl-6 pb-12">
			<img src="<?php the_sub_field( 'desktop_image_2' ); ?>" alt="" class="w-full h-full">
		</a>
		<?php endif; ?>
	</section>
<?php
	endwhile;
endif;