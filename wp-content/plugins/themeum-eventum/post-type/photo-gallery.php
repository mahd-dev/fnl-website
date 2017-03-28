<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Admin functions for the Event post type
 *
 * @author 		Themeum
 * @category 	Admin
 * @package 	eventum
 *-------------------------------------------------------------*/

/*--------------------------------------------------------------
*			Register Gallery Post Type
*-------------------------------------------------------------*/

function themeum_post_type_gallery()
{
	$labels = array(
		'name'                	=> _x( 'Gallery', 'Gallery', 'themeum-eventum' ),
		'singular_name'       	=> _x( 'Gallery', 'Gallery', 'themeum-eventum' ),
		'menu_name'           	=> __( 'Photo Gallery', 'themeum-eventum' ),
		'parent_item_colon'   	=> __( 'Parent Gallery:', 'themeum-eventum' ),
		'all_items'           	=> __( 'All Gallery', 'themeum-eventum' ),
		'view_item'           	=> __( 'View Gallery', 'themeum-eventum' ),
		'add_new_item'        	=> __( 'Add New Gallery', 'themeum-eventum' ),
		'add_new'             	=> __( 'New Gallery', 'themeum-eventum' ),
		'edit_item'           	=> __( 'Edit Gallery', 'themeum-eventum' ),
		'update_item'         	=> __( 'Update Gallery', 'themeum-eventum' ),
		'search_items'        	=> __( 'Search Gallery', 'themeum-eventum' ),
		'not_found'           	=> __( 'No article found', 'themeum-eventum' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-eventum' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> true,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> 'dashicons-format-image',
		'supports'           	=> array( 'title')
		);

	register_post_type('gallery', $args);

}

add_action('init','themeum_post_type_gallery');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_update_message_gallery( $messages )
{
	global $post, $post_ID;

	$message['gallery'] = array(
		0 => '',
		1 => sprintf( __('gallery updated. <a href="%s">View gallery</a>', 'themeum-eventum' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-eventum' ),
		3 => __('Custom field deleted.', 'themeum-eventum' ),
		4 => __('gallery updated.', 'themeum-eventum' ),
		5 => isset($_GET['revision']) ? sprintf( __('gallery restored to revision from %s', 'themeum-eventum' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('gallery published. <a href="%s">View gallery</a>', 'themeum-eventum' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('gallery saved.', 'themeum-eventum' ),
		8 => sprintf( __('gallery submitted. <a target="_blank" href="%s">Preview gallery</a>', 'themeum-eventum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>', 'themeum-eventum' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('gallery draft updated. <a target="_blank" href="%s">Preview gallery</a>', 'themeum-eventum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_update_message_gallery' );