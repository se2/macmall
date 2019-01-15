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
		$link = get_sub_field( 'media_link' );
?>
	<section class="home-media">
		<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
			<img src="<?php the_sub_field( 'desktop_image' ); ?>" alt="" class="w-full hidden xl:block desktop-image">
			<img src="<?php the_sub_field( 'tablet_image' ); ?>" alt="" class="w-full hidden md:block xl:hidden tablet-image">
			<img src="<?php the_sub_field( 'mobile_image' ); ?>" alt="" class="w-full block md:hidden mobile-image">
		</a>
		<?php if ( get_sub_field( 'bottom_divider' ) ) : ?>
		<div class="bottom-divider w-full h-12 block md:hidden" style="background-color:<?php the_sub_field( 'bottom_divider_color' ); ?>;"></div>
		<?php endif; ?>
	</section>
<?php
	endwhile;
endif;