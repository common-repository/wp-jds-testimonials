<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Manage Testimonials post type meta fields
 *
 * @package WP JDs Testimonials
 * @since 1.0.0
 */

// Get the prefix
$prefix = WP_JDSTM_META_PREFIX;

global $post;
$post_id = isset( $post->ID ) ? $post->ID : '';

// Get job data
$tag_line		= get_post_meta( $post_id, $prefix . 'tag_line', true );
$designation	= get_post_meta( $post_id, $prefix . 'designation', true );
$other			= get_post_meta( $post_id, $prefix . 'other', true );
$comments		= get_post_meta( $post_id, $prefix . 'comments', true ); ?>

<div class="wp-jdstm-testimonials-metabox">
	<table class="form-table">
		<tbody>

			<tr>
				<th>
					<label for="wp_jdstm_tag_line"><?php echo __( 'Tag Line', 'wpjdstm' ); ?></label>
				</th>
				<td>
					<input id="wp_jdstm_tag_line" name="<?php echo $prefix; ?>tag_line" class="regular-text" value="<?php echo $tag_line; ?>" />
				</td>
			</tr>

			<tr>
				<th>
					<label for="wp_jdstm_designation"><?php echo __( 'Designation', 'wpjdstm' ); ?></label>
				</th>
				<td>
					<input id="wp_jdstm_designation" name="<?php echo $prefix; ?>designation" class="regular-text" value="<?php echo $designation; ?>" />
				</td>
			</tr>

			<tr>
				<th>
					<label for="wp_jdstm_other"><?php echo __( 'Other', 'wpjdstm' ); ?></label>
				</th>
				<td>
					<input id="wp_jdstm_other" name="<?php echo $prefix; ?>other" class="regular-text" value="<?php echo $other; ?>" />
				</td>
			</tr>

			<tr>
				<th>
					<label for="wp_jdstm_comments"><?php echo __( 'Comments', 'wpjdstm' ); ?></label>
				</th>
				<td>
					<textarea id="wp_jdstm_comments" name="<?php echo $prefix; ?>comments" cols="40" rows="5"><?php echo $comments; ?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
</div>