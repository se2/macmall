<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    MacMall
 * @author     Maple Studio
 * @link       https://maplestudio.vn/
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- FontAwesome 5.6.3 -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

	<!-- Roboto -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=latin-ext,vietnamese" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'macmall' ); ?></a>

	<header id="masthead" class="site-header bg-black fixed w-full z-top">

		<div class="wrapper container flex flex-wrap items-center justify-between">

			<button class="hamburger hamburger--collapse outline-none inline-block lg:hidden" type="button">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>

			<div class="site-branding">
				<?php $logo = get_field( 'white_logo', 'option' ); ?>
				<a href="<?php the_clean_url(); ?>">
					<?php if ( $logo ) : ?>
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
					<?php else : ?>
					<h1 class="text-white"><?php bloginfo(); ?></h1>
					<?php endif; ?>
				</a>
			</div><!-- .site-branding -->

			<form role="search" method="get" class="w-1/2 search-form flex-wrap hidden ipad:flex <?php echo is_search() ? '' : 'no-show'; ?>" action="/">
				<button type="submit" class="search-submit">
					<img width="16px" src="<?php echo get_template_directory_uri(); ?>/img/search.svg" alt="MacMall Search">
				</button>
				<input type="search" autofocus class="search-field" placeholder="Tìm kiếm" value="<?php echo ( is_search() ) ? $_REQUEST['s'] : ""; ?>" name="s" required>
			</form>

			<nav id="site-navigation" class="main-navigation hidden ipad:inline-block <?php echo is_search() ? 'no-show' : ''; ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
				) );
				?>
			</nav>

			<div class="search-bar">
				<a href="#!" class="search-toggle hidden ipad:inline-block">
					<img class="<?php echo is_search() ? 'hidden' : ''; ?>" src="<?php echo get_template_directory_uri(); ?>/img/search.svg" alt="MacMall Search">
					<img class="<?php echo is_search() ? '' : 'hidden'; ?>" src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="MacMall Search">
				</a>
				<a href="tel:0386666663" class="ipad:hidden">
					<img width="16px" src="<?php echo get_template_directory_uri(); ?>/img/phone.svg" alt="Call MacMall">
				</a>
			</div>

		</div>

		<!-- Mega menu -->
		<div class="mega-menu-wrapper w-full hidden ipad:block">
			<?php get_template_part( 'template-parts/mega-menu' ); ?>
		</div><!-- Mega menu -->

	</header><!-- #masthead -->

	<div class="mobile-dropdown ipad:hidden w-full h-screen bg-black fixed z-50">

		<form role="search" method="get" class="w-1/2 search-form flex-wrap flex " action="/">
			<button type="submit" class="search-submit">
				<img width="16px" src="<?php echo get_template_directory_uri(); ?>/img/search.svg" alt="MacMall Search">
			</button>
			<input type="search" autofocus class="search-field" placeholder="Tìm kiếm" value="<?php echo ( is_search() ) ? $_REQUEST['s'] : ""; ?>" name="s" required>
		</form>

		<hr>

		<nav id="site-navigation" class="mobile-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
			) );
			?>
		</nav>

	</div>

	<div id="content" class="site-content">
