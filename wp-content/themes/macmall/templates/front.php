<?php
/**
 * Template Name: Front
 *
 * @category   Template
 * @package    MacMall
 * @author     Maple Studio
 * @link       https://maplestudio.vn/
 */

get_header();

while ( have_posts() ) :
	the_post();
?>

<main id="main-content" role="main" class="main-content">

	<?php get_template_part( 'template-parts/home', 'media' ); ?>

</main>

<?php
endwhile;

get_footer();
