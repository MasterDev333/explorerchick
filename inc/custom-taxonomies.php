<?php
/**
 * Custom taxonomies for use with this theme
 */

add_action( 'init', 'custom_taxonomies' );

/**
 * Adds custom taxonomies
 */
function custom_taxonomies() {
	// Trip category
	register_taxonomy(
		'trip_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'trip',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Trip Categories', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'trip-categories',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
	// Trip tag
	register_taxonomy(
		'trip_tag',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'trip',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Trip Tags', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'trip-tags',    // This controls the base slug that will display before each term
				'with_front' => false,  // Don't display the category base before
			),
			'show_in_rest' => true,
		)
	);
}
