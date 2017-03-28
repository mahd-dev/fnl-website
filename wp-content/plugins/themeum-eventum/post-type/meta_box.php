<?php
/**
 * Admin feature for Custom Meta Box
 *
 * @author 		Themeum
 * @category 	Admin Core
 * @package 	Eventum
 *-------------------------------------------------------------*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Registering meta boxes
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'themeum_lms_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */

function themeum_lms_register_meta_boxes( $meta_boxes ){



	function themeum_list_speakers(){
		$speakers_data = get_posts( array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'speaker',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		) );
		$speakers = array();
		foreach ( $speakers_data as $post ) {
			$speakers[$post->ID] = $post->post_title;
		}
		return $speakers;
	}
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'themeum_';

	/**
	 * Register Post Meta for Speaker Post Type
	 *
	 * @return array
	 */



	$meta_boxes[] = array(
		'id' => 'speaker-meta-setting',
		'title' => esc_html__( 'Speaker Infomation', 'themeum-eventum' ),
		'pages' => array( 'speaker'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => esc_html__( 'Designation', 'themeum-eventum' ),
				'id'    => "{$prefix}designation",
				'type'  => 'textarea',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Facebook URL', 'themeum-eventum' ),
				'id'    => "{$prefix}facebook_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Soundcloud URL', 'themeum-eventum' ),
				'id'    => "{$prefix}soundcloud_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Twitter URL', 'themeum-eventum' ),
				'id'    => "{$prefix}twitter_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Google Plus  URL', 'themeum-eventum' ),
				'id'    => "{$prefix}google_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Pinterest URL', 'themeum-eventum' ),
				'id'    => "{$prefix}pinterest_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Youtube URL', 'themeum-eventum' ),
				'id'    => "{$prefix}youtube_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Linkedin URL', 'themeum-eventum' ),
				'id'    => "{$prefix}linkedin_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Dribbble URL', 'themeum-eventum' ),
				'id'    => "{$prefix}dribbble_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Behance URL', 'themeum-eventum' ),
				'id'    => "{$prefix}behance_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Flickr URL', 'themeum-eventum' ),
				'id'    => "{$prefix}flickr_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'VK URL', 'themeum-eventum' ),
				'id'    => "{$prefix}vk_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Skype URL', 'themeum-eventum' ),
				'id'    => "{$prefix}skype_url",
				'type'  => 'text',
				'std'   => ''
			),
			array(
				'name'  => esc_html__( 'Instagram URL', 'themeum-eventum' ),
				'id'    => "{$prefix}instagram_url",
				'type'  => 'text',
				'std'   => ''
			),
	

		)
	);


	$meta_boxes[] = array(
		'id' 		=> 'gallery-meta',
		'title' 	=> __( 'Gallery Items', 'themeum-eventum' ),
		'pages' 	=> array( 'gallery'),
		'context' 	=> 'normal',
		'priority' 	=> 'high',
		'autosave' 	=> true,

		'fields' 	=> array(
			array(
				'name'  		=> __( 'Gallery Items', 'themeum-eventum' ),
				'id'    		=> "{$prefix}event_gallery",
				'type'  		=> 'image_advanced',
				'std'   		=> ''
				),		
			)
	);




	$meta_boxes[] = array(
		'id' => 'schedule-meta-setting',
		'title' => esc_html__( 'Schedule Infomation', 'themeum-eventum' ),
		'pages' => array( 'schedule'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'  => esc_html__( 'Date of Event', 'themeum-eventum' ),
				'id'    => "{$prefix}date_of_event",
				'type'  => 'textarea',
				'std'   => ''
			),

			array(
				'name'   => esc_html__( 'Event Information', 'themeum-eventum' ),
				'id'     => 'event_info_group',
				'type'   => 'group',
				'fields' => array(		


						array(
							'name'          => esc_html__( 'Session', 'themeum-eventum' ),
							'id'            => "{$prefix}session",
							'type'          => 'text',
							'std'           => '',
						),

						array(
							'name'          => esc_html__( 'Custom Session Link', 'themeum-eventum' ),
							'id'            => "{$prefix}session_link",
							'type'          => 'text',
							'std'           => '',
						),

						array(
							'name'  		=> esc_html__( 'Speaker(s)', 'themeum-eventum' ),
							'id'    		=> "{$prefix}_speaker",
							'desc'  		=> '',
							'type'     		=> 'select_advanced',
							'options'  		=> themeum_list_speakers(), 
							'multiple'    	=> true,
							'placeholder' 	=> esc_html__( 'Select Speaker', 'themeum-eventum' ),
						),

						array(
							'name'          => esc_html__( 'Time', 'themeum-eventum' ),
							'id'            => "{$prefix}_time",
							'type'          => 'text',
							'std'           => '',
						),
						array(
							'name'          => esc_html__( 'Venue', 'themeum-eventum' ),
							'id'            => "{$prefix}venue",
							'type'          => 'text',
							'std'           => '',
						),



				),
				'clone'  => true,
			),

		)
	);




	return $meta_boxes;
}


