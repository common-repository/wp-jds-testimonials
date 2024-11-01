<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Post Type Functions
 *
 * Handles all custom post types
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0 
 */
function wp_jdstm_register_post_types() {

	// Register Testimonials post type
	$tstmnl_labels = array(
							'name' 				=> __('Testimonials','wpjdstm'),
							'singular_name' 	=> __('Testimonials','wpjdstm'),
							'add_new' 			=> __('Add New', 'wpjdstm'),
							'add_new_item' 		=> __('Add New Testimonial', 'wpjdstm'),
							'edit_item' 		=> __('Edit Testimonial', 'wpjdstm'),
							'new_item' 			=> __('New Testimonial', 'wpjdstm'),
							'all_items' 		=> __('All Testimonials', 'wpjdstm'),
							'view_item' 		=> __('View Testimonial', 'wpjdstm'),
							'search_items' 		=> __('Search Testimonial', 'wpjdstm'),
							'not_found' 		=> __('No testimonials found', 'wpjdstm'),
							'not_found_in_trash'=> __('No testimonial found in Trash', 'wpjdstm'), 
							'parent_item_colon' => '',
							'menu_name' 		=> __('Testimonials', 'wpjdstm')
						);

	//array for all required labels
	$tstmnl_args 	= array(
							'labels' 			=> $tstmnl_labels,
							'public' 			=> false,
							'publicly_queryable'=> false,
							'show_ui' 			=> true,
							'map_meta_cap'      => true,
							'show_in_menu' 		=> true, 
							'query_var' 		=> true,
							'rewrite' 			=> array( 'slug' => WP_JDSTM_POST_TYPE ),
							'capability_type' 	=> 'post',
							'has_archive' 		=> true,
							'supports' 			=> apply_filters('wp_jdstm_testimonials_post_type_supports', array( 'title', 'editor', 'thumbnail' )),
							//'menu_icon'			=> ''
						);

	// Add filter to modify deals register post type arguments
	$tstmnl_args	= apply_filters( 'wp_jdstm_register_post_type_testimonials', $tstmnl_args );
	
	// Register jobs post type
	register_post_type( WP_JDSTM_POST_TYPE, $tstmnl_args );

}

// Adding action for register post types
add_action( 'init', 'wp_jdstm_register_post_types' );