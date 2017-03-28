<?php
/**
 * Plugins Settings List
 *
 * @author 		Themeum
 * @category 	Admin Settings
 * @package 	Eventum
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


function themeum_eventum_speaker_template($single_template) {
	global $post;
	if ($post->post_type == 'speaker') {
		$single_template = plugin_dir_path( __FILE__ ) . 'templates/template-speaker.php';
	}	
	return $single_template;
}
add_filter( "single_template", "themeum_eventum_speaker_template" ) ;
