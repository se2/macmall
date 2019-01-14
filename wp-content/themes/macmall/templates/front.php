<?php
/**
 * Template Name: Front
 *
 * @category   Template
 * @package    TTG
 * @author     Technology Therapy Group
 * @link       https://technologytherapy.com/
 */

get_header();

while ( have_posts() ) :
	the_post();
?>

<main id="main-content" role="main" class="main-content">

	<?php get_template_part( 'template-parts/page', 'blocks' ); ?>

</main>

<?php
endwhile;

get_footer();
