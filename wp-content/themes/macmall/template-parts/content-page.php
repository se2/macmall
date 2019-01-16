<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package    MacMall
 * @author     Maple Studio
 * @link       https://maplestudio.vn/
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'container' ); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( is_product_category() ) : ?>
	<div class="archive-description">
		<?php the_field( 'product_cat_description' ); ?>
	</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
