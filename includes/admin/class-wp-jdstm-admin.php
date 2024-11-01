<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Handles generic Admin functionality and AJAX requests.
 *
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
class Wp_Jdstm_Admin {

	public function __construct() {

	}

	/**
	 * Add meta boxes to jobs post type
	 *
	 * @package WP JDs Testimonials
	 * @since 1.0.0
	 */
	public function wp_jdstm_add_testimonial_metabox() {

		// Add metaboxes to jobs post type
		add_meta_box(
					'wp_jdstm_testimonial_meta',
					__( 'Testimonial Options', 'wpjdstm' ),
					array( $this, 'wpnw_tm_testimonial_metabox_form' ),
					WP_JDSTM_POST_TYPE,
					'normal','high'
				);
	}

	/**
	 * Jobs metabox form file
	 * 
	 * @package WP JDs Testimonials
	 * @since 1.0.0
	 */
	public function wpnw_tm_testimonial_metabox_form() {
		include_once( WP_JDSTM_ADMIN .'/forms/wp-jdstm-testimonials-metabox.php' );
	}

	/**
	 * Save Meta values
	 * 
	 * @package WP JDs Testimonials
	 * @since 1.0.0
	 */
	public function wp_jdstm_save_metabox_value( $post_id ) {

		global $post_type;

		// Get the meta prefix
		$prefix = WP_JDSTM_META_PREFIX;

		// Get post type object
		$post_type_object = get_post_type_object( $post_type );

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )						// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )		// Check Revision
		|| ( $post_type != WP_JDSTM_POST_TYPE )										// Check if current post type is supported.
		|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
		{
			return $post_id;
		};

		// Update designation
		if( isset($_POST[$prefix.'tag_line']) ) {
			update_post_meta( $post_id, $prefix . 'tag_line', trim($_POST[$prefix.'tag_line']) );
		}

		// Update designation
		if( isset($_POST[$prefix.'designation']) ) {
			update_post_meta( $post_id, $prefix . 'designation', trim($_POST[$prefix.'designation']) );
		}

		// Update other
		if( isset($_POST[$prefix.'other']) ) {
			update_post_meta( $post_id, $prefix . 'other', trim($_POST[$prefix.'other']) );
		}

		// Update comments
		if( isset($_POST[$prefix.'comments']) ) {
			update_post_meta( $post_id, $prefix . 'comments', trim($_POST[$prefix.'comments']) );
		}
	}

	/**
	 * Adding Hooks
	 *
	 * @package WP JDs Testimonials
	 * @since 1.0.0
	 */
	public function add_hooks() {

		// Add metabox for jobs post type
		add_action( 'add_meta_boxes', array($this, 'wp_jdstm_add_testimonial_metabox') );

		// Handles save metabox functionality
		add_action( 'save_post', array( $this, 'wp_jdstm_save_metabox_value' ) );
	}
}