<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ttg-wp-theme
 */

?>

	</div><!-- #content -->


	<footer id="colophon" class="site-footer">

		<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
		<div class="footer-widgets">
			<div class="container flex flex-wrap justify-center items-center">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="container flex flex-wrap items-center justify-center">
			<div class="site-info h-auto overflow-auto text-center">
				<nav id="footer-navigation" class="footer-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
					) );
					?>
				</nav><!-- #site-navigation -->
				<div class="site-socials">
					<?php
					$socials = get_field( 'social_accounts', 'option' );
					if ( $socials ) :
					?>
					<ul class="socials-list list-reset">
						<?php foreach ( $socials as $key => $social ) : ?>
						<li class="social inline-block">
							<a target="_blank" href="<?php echo esc_url( $social['social_url'] ); ?>" class="block rounded-full flex items-center justify-center">
								<i class="<?php echo esc_attr( $social['social_service'] ); ?>"></i>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
			</div><!-- .site-info -->
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
