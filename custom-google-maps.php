<?php

/**
 * Plugin Name:       Custom Google Maps
 * Plugin URI:        https://webkust.be/projects/custom-google-maps/
 * Description:       Embed a customized google map with a customized marker.
 * Version:           0.1
 * Author:            Christophe Hollebeke
 * Author URI:        https://webkust.be/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-google-maps
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load plugin textdomain.
 */
function cgm_load_textdomain() {
  load_plugin_textdomain( 'custom-google-maps', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'cgm_load_textdomain' );

/*THE MENU*/
function cgm_admin_menu() {
	/*Page title, Menu title, capabilities, url, function (settings page), icon, position*/
	add_menu_page( 'Custom Google Maps', 'Custom Google Maps', 'manage_options', 'custom_google_maps', 'cgm_style_settings', 'dashicons-admin-site' );
}
add_action( 'admin_menu', 'cgm_admin_menu' );

/*SETTINGS PAGE*/
require_once (dirname(__FILE__).'/admin/settings.php');


/* Shortcode [cgm] */
function cgm_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
      'lat'           => 51.218750,
      'lng'           => 2.914856,
			'width'         => '100%',
			'height'        => '400px',
			'scrollwheel' 	=> 'true',
			'zoom'          => 15,
			'controls'      => 'false',
		), $atts);

	// Load Google Maps API from the database
	// Load options array and store it in $cgm_options
	$cgm_options = get_option( 'cgm_options' );

	// Load Google Maps script with the Google Maps API key
	wp_enqueue_script( 'google-map-api-key', '//maps.googleapis.com/maps/api/js?key=' . $cgm_options[ 'google_map_api' ] . '&callback=initMap' );


    $map_id = uniqid( 'cgm_google_map_' ); // generate a unique ID

   ob_start(); ?>
    <div class="cgm_map" id="<?php echo esc_attr( $map_id ); ?>" style="width: <?php echo esc_attr( $atts['width'] ); ?>; height: <?php echo esc_attr( $atts['height'] ); ?>;"></div>

    	<script type="text/javascript">
      function initMap() {
       var logo = {url:'<?php echo $cgm_options['media_url']; ?>', scaledSize: new google.maps.Size(90, 90)};
       var locatie = {lat: <?php echo esc_attr( $atts['lat'] ); ?> , lng: <?php echo esc_attr( $atts['lng'] ); ?>}; // lat = y, lng = x
       var <?php echo esc_attr( $map_id ); ?> = new google.maps.Map(document.getElementById('<?php echo esc_attr( $map_id ); ?>'), {
          zoom: <?php echo $atts['zoom']; ?>,
          center: locatie,
          scrollwheel: false,
        });
        var marker = new google.maps.Marker({
          position: locatie,
          map: <?php echo esc_attr( $map_id ); ?>,
          icon: logo
        });
      }
    </script>
  <?php echo $cgm_options['media_url']; ?>
	<?php
	return ob_get_clean();
}

add_shortcode( 'cgm', 'cgm_shortcode' );
