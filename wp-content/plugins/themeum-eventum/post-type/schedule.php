<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Admin functions for the Event post type
 *
 * @author 		Themeum
 * @category 	Admin
 * @package 	Varsity
 * @version     1.0
 *-------------------------------------------------------------*/

/**
 * Register post type Schedule
 *
 * @return void
 */

function themeum_eventum_post_type_schedule(){

	$labels = array( 
		'name'                	=> esc_html__( 'Schedule', 'Schedule', 'themeum-eventum' ),
		'singular_name'       	=> esc_html__( 'Schedule', 'Schedule', 'themeum-eventum' ),
		'menu_name'           	=> esc_html__( 'Schedules', 'themeum-eventum' ),
		'parent_item_colon'   	=> esc_html__( 'Parent Schedule:', 'themeum-eventum' ),
		'all_items'           	=> esc_html__( 'All Schedule', 'themeum-eventum' ),
		'view_item'           	=> esc_html__( 'View Schedule', 'themeum-eventum' ),
		'add_new_item'        	=> esc_html__( 'Add New Schedule', 'themeum-eventum' ),
		'add_new'             	=> esc_html__( 'New Schedule', 'themeum-eventum' ),
		'edit_item'           	=> esc_html__( 'Edit Schedule', 'themeum-eventum' ),
		'update_item'         	=> esc_html__( 'Update Schedule', 'themeum-eventum' ),
		'search_items'        	=> esc_html__( 'Search Schedule', 'themeum-eventum' ),
		'not_found'           	=> esc_html__( 'No article found', 'themeum-eventum' ),
		'not_found_in_trash'  	=> esc_html__( 'No article found in Trash', 'themeum-eventum' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','thumbnail','comments')
		);

	register_post_type( 'schedule',$args );

}

add_action('init','themeum_eventum_post_type_schedule');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_eventum_update_message_schedule( $messages ){
	global $post, $post_ID;

	$message['schedule'] = array(
		0 => '',
		1 => sprintf( esc_html__('Schedule updated. <a href="%s">View Schedule</a>', 'themeum-eventum' ), esc_url( get_permalink($post_ID) ) ),
		2 => esc_html__('Custom field updated.', 'themeum-eventum' ),
		3 => esc_html__('Custom field deleted.', 'themeum-eventum' ),
		4 => esc_html__('Schedule updated.', 'themeum-eventum' ),
		5 => isset($_GET['revision']) ? sprintf( esc_html__('Schedule restored to revision from %s', 'themeum-eventum' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( esc_html__('Schedule published. <a href="%s">View Schedule</a>', 'themeum-eventum' ), esc_url( get_permalink($post_ID) ) ),
		7 => esc_html__('Schedule saved.', 'themeum-eventum' ),
		8 => sprintf( esc_html__('Schedule submitted. <a target="_blank" href="%s">Preview Schedule</a>', 'themeum-eventum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( esc_html__('Schedule scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Schedule</a>', 'themeum-eventum' ), date_i18n( esc_html__( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( esc_html__('Schedule draft updated. <a target="_blank" href="%s">Preview Schedule</a>', 'themeum-eventum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_eventum_update_message_schedule' );


