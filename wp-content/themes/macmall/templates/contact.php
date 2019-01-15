<?php
/**
 * Template Name: Contact
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

<main id="main-content" role="main" class="main-content contact-page relative">

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

		var image = '/wp-content/themes/macmall/img/marker.png';
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
