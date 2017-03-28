<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Admin functions for the Event post type
 *
 * @author 		Themeum
 * @category 	Admin
 * @package 	Eventum
 * @version     1.0
 *-------------------------------------------------------------*/

/**
 * Register post type Speaker
 *
 * @return void
 */

function themeum_eventum_post_type_speaker(){

	$labels = array( 
		'name'                	=> esc_html__( 'Speakers', 'Speakers', 'themeum-eventum' ),
		'singular_name'       	=> esc_html__( 'Speaker', 'Speaker', 'themeum-eventum' ),
		'menu_name'           	=> esc_html__( 'Speakers', 'themeum-eventum' ),
		'parent_item_colon'   	=> esc_html__( 'Parent Speaker:', 'themeum-eventum' ),
		'all_items'           	=> esc_html__( 'All Speaker', 'themeum-eventum' ),
		'view_item'           	=> esc_html__( 'View Speaker', 'themeum-eventum' ),
		'add_new_item'        	=> esc_html__( 'Add New Speaker', 'themeum-eventum' ),
		'add_new'             	=> esc_html__( 'New Speaker', 'themeum-eventum' ),
		'edit_item'           	=> esc_html__( 'Edit Speaker', 'themeum-eventum' ),
		'update_item'         	=> esc_html__( 'Update Speaker', 'themeum-eventum' ),
		'search_items'        	=> esc_html__( 'Search Speaker', 'themeum-eventum' ),
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
		'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type( 'speaker',$args );

}

add_action('init','themeum_eventum_post_type_speaker');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_eventum_update_message_speaker( $messages ){
	global $post, $post_ID;

	$message['speaker'] = array(
		0 => '',
		1 => sprintf( esc_html__('Speaker updated. <a href="%s">View Speaker</a>', 'themeum-eventum' ), esc_url( get_permalink($post_ID) ) ),
		2 => esc_html__('Custom field updated.', 'themeum-eventum' ),
		3 => esc_html__('Custom field deleted.', 'themeum-eventum' ),
		4 => esc_html__('Speaker updated.', 'themeum-eventum' ),
		5 => isset($_GET['revision']) ? sprintf( esc_html__('Speaker restored to revision from %s', 'themeum-eventum' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( esc_html__('Speaker published. <a href="%s">View Speaker</a>', 'themeum-eventum' ), esc_url( get_permalink($post_ID) ) ),
		7 => esc_html__('Speaker saved.', 'themeum-eventum' ),
		8 => sprintf( esc_html__('Speaker submitted. <a target="_blank" href="%s">Preview Speaker</a>', 'themeum-eventum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( esc_html__('Speaker scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Speaker</a>', 'themeum-eventum' ), date_i18n( esc_html__( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( esc_html__('Speaker draft updated. <a target="_blank" href="%s">Preview Speaker</a>', 'themeum-eventum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_eventum_update_message_speaker' );




/**
 * Register Speaker Category Taxonomies
 *
 * @return void
 */

function themeum_register_speaker_cat_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Speaker Categories', 'taxonomy general name', 'themeum-eventum' ),
		'singular_name'     	=> _x( 'Speaker Category', 'taxonomy singular name', 'themeum-eventum' ),
		'search_items'      	=> __( 'Search Category', 'themeum-eventum' ),
		'all_items'         	=> __( 'All Category', 'themeum-eventum' ),
		'parent_item'       	=> __( 'Parent Category', 'themeum-eventum' ),
		'parent_item_colon' 	=> __( 'Parent Category:', 'themeum-eventum' ),
		'edit_item'         	=> __( 'Edit Category', 'themeum-eventum' ),
		'update_item'       	=> __( 'Update Category', 'themeum-eventum' ),
		'add_new_item'      	=> __( 'Add New Category', 'themeum-eventum' ),
		'new_item_name'     	=> __( 'New Category Name', 'themeum-eventum' ),
		'menu_name'         	=> __( 'Speaker Category', 'themeum-eventum' )
		);

	$args = array(	'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('speaker_cat',array( 'speaker' ),$args);
}

add_action('init','themeum_register_speaker_cat_taxonomy');

