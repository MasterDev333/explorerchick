<?php
/**
 * Custom posts for use with this theme
 */

add_action( 'init', 'custom_post_type', 0 );
/**
 * Register Custom Post Type
 */
function custom_post_type() {
	// Register Trip Custom Post Type
	$labels = array(
		'name'                  => _x( 'Trips', 'trips', 'am' ),
		'singular_name'         => _x( 'Trip', 'trip', 'am' ),
		'menu_name'             => __( 'Trips', 'am' ),
		'name_admin_bar'        => __( 'Trips', 'am' ),
		'archives'              => __( 'Trips Archives', 'am' ),
		'attributes'            => __( 'Trips Attributes', 'am' ),
		'parent_item_colon'     => __( 'Parent Trips:', 'am' ),
		'all_items'             => __( 'All Trips', 'am' ),
		'add_new_item'          => __( 'Add Trip', 'am' ),
		'add_new'               => __( 'Add Trip', 'am' ),
		'new_item'              => __( 'New Trip', 'am' ),
		'edit_item'             => __( 'Edit Trip', 'am' ),
		'update_item'           => __( 'Update Trip', 'am' ),
		'view_item'             => __( 'View Trip', 'am' ),
		'view_items'            => __( 'View Trips', 'am' ),
		'search_items'          => __( 'Search Trips', 'am' ),
		'not_found'             => __( 'Not found', 'am' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'am' ),
		'featured_image'        => __( 'Featured Image', 'am' ),
		'set_featured_image'    => __( 'Set featured image', 'am' ),
		'remove_featured_image' => __( 'Remove featured image', 'am' ),
		'use_featured_image'    => __( 'Use as featured image', 'am' ),
		'insert_into_item'      => __( 'Insert into Trip', 'am' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Trip', 'am' ),
		'items_list'            => __( 'Trips list', 'am' ),
		'items_list_navigation' => __( 'Trips list navigation', 'am' ),
		'filter_items_list'     => __( 'Filter Trips list', 'am' ),
	);
	$args   = array(
		'label'               => __( 'Trips', 'am' ),
		'description'         => __( 'Trips post type', 'am' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'custom-fields', 'page-attributes', 'thumbnail', 'excerpt', 'editor' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-airplane',
	);
	register_post_type( 'trip', $args );
}
