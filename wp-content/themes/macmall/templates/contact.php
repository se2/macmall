<?php
/**
 * Template Name: Contact
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

<main id="main-content" role="main" class="main-content contact-page relative">

	<div class="info-wrapper container w-full flex flex-wrap relative z-top">

		<div class="contact-info w-full">
			<h1 class="text-44px font-normal "><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<div class="flex flex-wrap info-box mt-40 justify-start">
				<div class="address w-full md:w-1/2 xl:w-auto">
					<label class="text-primary uppercase font-normal text-sm leading-normal tracking-x-wide">Địa chỉ</label>
					<p class="leading-xl text-black"><?php the_field( 'address', 'option' ); ?></p>
				</div>
				<div class="phone w-full md:w-1/2 xl:w-auto md:pl-30 mt-30 md:mt-0">
					<label class="text-primary uppercase font-normal text-sm leading-normal tracking-x-wide">Điện thoại</label>
					<?php if ( have_rows( 'phone', 'option' ) ) : ?>
						<p class="leading-xl text-black">
						<?php while ( have_rows( 'phone', 'option' ) ) : the_row(); ?>
						<a class="block text-black" href="tel:<?php the_sub_field( 'phone_number' ); ?>"><?php the_sub_field( 'phone_number' ); ?></a>
						<?php endwhile; ?>
						</p>
					<?php endif; ?>
				</div>
				<div class="email w-full md:w-1/2 xl:w-auto xl:pl-30 mt-30 md:mt-40 xl:mt-0">
					<label class="text-primary uppercase font-normal text-sm leading-normal tracking-x-wide">Email</label>
					<?php if ( have_rows( 'email_addresses', 'option' ) ) : ?>
						<p class="leading-xl text-black">
						<?php while ( have_rows( 'email_addresses', 'option' ) ) : the_row(); ?>
						<a class="block text-black" href="mailto:<?php the_sub_field( 'email_address' ); ?>"><?php the_sub_field( 'email_address' ); ?></a>
						<?php endwhile; ?>
						</p>
					<?php endif; ?>
				</div>
				<div class="website w-full md:w-1/2 xl:w-full md:pl-30 xl:pl-0 mt-30 md:mt-40">
					<label class="text-primary uppercase font-normal text-sm leading-normal tracking-x-wide">Website</label>
					<p class="leading-xl text-black">
						<a class="inline-block text-black" href="<?php the_field( 'website', 'option' ); ?>"><?php the_field( 'website', 'option' ); ?></a>
					</p>
				</div>
			</div>
		</div>

	</div>

	<div class="wrapper container w-full flex flex-wrap justify-end contact-sidebar__wrapper z-50 lg:absolute pb-40 lg:pb-0">
		<a id="gf_1" class="gform_anchor"></a>
		<div class="contact-sidebar w-full animated fadeIn mx-auto lg:mx-0" id="contact-sidebar">
			<div class="inner">
				<?php echo do_shortcode( get_field( 'gravity_form_shortcode' ) ); ?>
			</div>
		</div>

	</div>

	<div class="google-map">
		<div id="map" data-lat="<?php echo get_field( 'google_map' )['lat']; ?>" data-lng="<?php echo get_field( 'google_map' )['lng']; ?>"></div>
	</div>

	<script>

	var $map = jQuery('#map');

	function initMap() {
		// Create a map object, and include the MapTypeId to add
		// to the map type control.
		var map = new google.maps.Map(document.getElementById("map"), {
			center: { lat: $map.data("lat"), lng: $map.data("lng") },
			zoom: 16,
			mapTypeControlOptions: {
				mapTypeIds: ["roadmap", "satellite", "hybrid", "terrain"]
			}
		});

		var image = '/wp-content/themes/minhnguyen/images/marker.png';
		var marker = new google.maps.Marker({
			position: { lat: $map.data("lat"), lng: $map.data("lng") },
			map: map,
			icon: image
		});
	}

	</script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ6QXR6UlBS2h0i9vjjgiQ72RkYDD4UWs&callback=initMap&region=VN&language=VI"></script>

</main>

<?php
endwhile;

get_footer();
