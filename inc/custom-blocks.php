<?php
// Custom ACF Blocks
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        // Register Hero Block
        // acf_register_block_type(array(
        //     'name'              => 'home_hero',
        //     'title'             => __('Home Hero'),
        //     'description'       => __('Home Hero'),
        //     'render_template'   => 'template-parts/blocks/home-hero/home-hero.php',
        //     'category'          => 'theline-blocks',
        //     'icon'              => 'cover-image',
        //     'keywords'          => array( 'hero', 'image', 'video' ),
        // ));
    }
}


function custom_block_categories( $categories ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'theline-blocks',
				'title' => 'TheLine Blocks',
			],
		]
	);
}
add_action( 'block_categories', 'custom_block_categories', 10, 2 );