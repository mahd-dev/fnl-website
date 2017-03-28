<?php
if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_google_map', function($atts, $content = null){
  	extract(shortcode_atts(array(
			'latitude'			=> '43.04446',
			'longitude'			=> '-76.130791',
			'minimum_height'	=> '300px',
			'map_color'			=> '#4bb463',
			'address'			=> ''
    	), $atts));




  	$output = '';

	$address = preg_replace('#^<\/p>|<p>$#', '', $address);
	$output .= '<div class="hidden" id="wplatitude">'.esc_attr($latitude).'</div>
				<div class="hidden" id="wplongitude">'.esc_attr($longitude).'</div>
				<div class="hidden" id="wpaddress">'.balanceTags($address).'</div>
				<div class="hidden" id="wpmap_color">'.esc_attr($map_color).'</div>';


	$output .= '<div id="map">';
	    $output .= '<div id="gmap-wrap">';
	        $output .= '<div id="gmap" style="height:'.esc_attr($minimum_height).';">'; 
	        $output .= '</div>';              
	    $output .= '</div>';
	$output .= '</div>';






	return $output;
     
}); 

//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => esc_html__("Google MAP", "themeum-eventum"),
    "base" => "themeum_google_map",
    'icon' => 'icon-thm-google-map',
    "class" => "",
    "description" => esc_html__("Google MAP", "themeum-eventum"),
    "category" => esc_html__('Themeum', "themeum-eventum"),
    "params" => array(        




	    array(
	        "type" => "textfield",
	        "heading" => esc_html__("Latitude", "themeum-eventum"),
	        "param_name" => "latitude",
	        "value" => "",
	    ),

	    array(
	        "type" => "textfield",
	        "heading" => esc_html__("Longitude", "themeum-eventum"),
	        "param_name" => "longitude",
	        "value" => "",
	    ),

	    array(
	        "type" => "textfield",
	        "heading" => esc_html__("Minimum Height", "themeum-eventum"),
	        "param_name" => "minimum_height",
	        "value" => "",
	    ),

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Color:", "themeum-eventum"),
			"param_name" => "map_color",
			"value" => ""							
		),

		array(
	        "type" => "textarea",
	        "heading" => esc_html__("Address", "themeum-eventum"),
	        "param_name" => "address",
	        "value" => "",
	    ),



      )

    ));
}





