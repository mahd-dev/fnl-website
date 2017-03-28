<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Upcoming Events
add_shortcode( 'eventum_counter', function($atts, $content = null){

	extract(shortcode_atts(array(
		'position'				=> 'left',
		'date'					=> '',
		"title"					=> '',
		"title_fontsize" 		=> '',
		"title_margin" 			=> '',
		"subtitle_fontsize" 	=> '',
		"title_fontweight" 		=> '',
		"subtitle_fontweight" 	=> '',
		"title_text_color" 		=> '',
		"sub_text_color" 		=> '',
		"subtitle"				=> '',
		"class" 				=>'',
		), $atts));

	global $post;
	
	$output = $align = '';
	if($position) $align .= 'text-align:'. esc_attr( $position ) .';';

    $output .= '<div class="shortcode-event-countdown '.esc_attr($class).'" style="'. $align .'">';
	    $countdate = str_replace('-', '-', $date);

		$output .= '<div class="counter-class" data-date="'.$countdate.'">';
			$output .= '<div id="countdown-timer">';
				$output .= '<div class="countdown-section"><span class="countdown-amount first-item countdown-days counter-days"></span> <span class="countdown-period">Days</span></div>';
				$output .= '<div class="countdown-section"><span class="countdown-amount countdown-hours counter-hours"></span> <span class="countdown-period">Hours</span></div>';
				$output .= '<div class="countdown-section"><span class="countdown-amount countdown-minutes counter-minutes"></span> <span class="countdown-period">Minutes</span></div>';
				$output .= '<div class="countdown-section"><span class="countdown-amount countdown-seconds counter-seconds"></span> <span class="countdown-period">Seconds</span></div>';
			$output .= '</div>';
		$output .= '</div>';

		// Title
		if($title) {
			$title_style = '';
			if($title_text_color) $title_style .= 'color:' . esc_attr( $title_text_color ) . ';';
			if($title_fontsize) $title_style .= 'font-size:'.esc_attr( $title_fontsize ).'px;line-height:'.esc_attr( $title_fontsize ).'px;';
			if($title_fontweight) $title_style .= 'font-weight:'.esc_attr( $title_fontweight ).';';
			if($title_margin) $title_style .= 'margin:'.esc_attr( $title_margin ).';';

			$output .= '<h2 class="countdown-timer-title" style="' . $title_style . '">' . esc_attr( $title ) . '</h2>';
		}

		if($subtitle) {
			$subtitle_style = '';
			if($sub_text_color) $subtitle_style .= 'color:' . esc_attr( $sub_text_color ) . ';';
			if($subtitle_fontsize) $subtitle_style .= 'font-size:'.esc_attr( $subtitle_fontsize ).'px;line-height:'.esc_attr( $subtitle_fontsize ).'px;';
			if($subtitle_fontweight) $subtitle_style .= 'font-weight:'.esc_attr( $subtitle_fontweight ).';';
			$output .= '<h3 class="countdown-timer-subtitle" style="' . $subtitle_style . '">' . esc_html( $subtitle ) . '</h3>';
		}
	$output .= '</div>';

	return $output;

});



//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => esc_html__("Eventum Events Counter", 'eventum'),
	"base" => "eventum_counter",
	"icon" => "icon-thm-event-counter",
	"class" => "",
	"description" => esc_html__("Eventum Events Counter addons", 'eventum'),
	"category" => __('Themeum', 'eventum'),
	"params" => array(

		array(
			"type" => "dropdown",
			"heading" => esc_html__("Position", 'eventum'),
			"param_name" => "position",
			"value" => array('Select'=>'','Left'=>'left','Center'=>'center','Right'=>'right'),
		),	
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title", 'eventum'),
			"param_name" => "title",
			"value" => "",
			"admin_label"=>true,
		),		

		array(
			"type" => "textfield",
			"heading" => esc_html__("Countdown Date", 'eventum'),
			"param_name" => "date",
			"value" => "2020-10-10 12:34:56",
			"description" => __("Date and time format (yyyy-mm-dd hh:mm:ss) Ex. 2020-10-10 12:34:56", 'eventum'),
		),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Font Size", 'eventum'),
			"param_name" => "title_fontsize",
			"value" => "",
			),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title Margin ex. 10px 0", 'eventum'),
			"param_name" => "title_margin",
			"value" => "",
			),	
		array(
			"type" => "textfield",
			"heading" => esc_html__("Font Weight", 'eventum'),
			"param_name" => "title_fontweight",
			"value" => "",
			),

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Font Color", 'eventum'),
			"param_name" => "title_text_color",
			"value" => "",
			),

		array(
			"type" => "textfield",
			"heading" => esc_html__("Sub Title", 'eventum'),
			"param_name" => "subtitle",
			"value" => "",
			),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Subtitle Font Size", 'eventum'),
			"param_name" => "subtitle_fontsize",
			"value" => "",
			),

		array(
			"type" => "colorpicker",
			"heading" => esc_html__("SubTitle Font Color", 'eventum'),
			"param_name" => "sub_text_color",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => esc_html__("Subtitle Font Weight", 'eventum'),
			"param_name" => "subtitle_fontweight",
			"value" => "",
			),				

		array(
			"type" => "textfield",
			"heading" => esc_html__("Extra CSS Class", 'eventum'),
			"param_name" => "class",
			"value" => "",
			"description" => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
			),

		)
	));
}