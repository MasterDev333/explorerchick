<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Hades_Theme
 */

if ( ! class_exists( 'Theme_Extra' ) ) {
	/**
	 * Custom theme extra class
	 */
	class Theme_Extra {
		/**
		 * Init everything here
		 */
		public function init() {
			$this->add_filters();

			$this->add_actions();

			$this->add_shortcodes();

			// Register options page for ACF field
			if ( function_exists( 'acf_add_options_page' ) ) {
				acf_add_options_page(
					array(
						'page_title' => 'Theme General Settings',
						'menu_title' => 'Theme Settings',
						'menu_slug'  => 'theme-general-settings',
						'capability' => 'edit_posts',
						'redirect'   => false,
					)
				);
			}

			// Disable WordPress Admin Bar for all users
			// add_filter( 'show_admin_bar', '__return_false' );

			// add_post_type_support( 'page', 'excerpt' );
		}

		/**
		 * Add Filters
		 */
		public function add_filters() {
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
		}

		/**
		 * Add actions
		 */
		public function add_actions() {
			add_action( 'wp_head', array( $this, 'add_ajax_url' ) );
			add_action( 'init', array( $this, 'add_categories_to_pages' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ) );
			add_action( 'widgets_init', array( $this, 'register_footer_widgets' ) );
			add_action( 'init', array( $this, 'my_remove_editor_from_post_type' ) );
			// If ACF is installed load acf fields from local json
			if ( class_exists( 'ACF' ) ) {
				add_action( 'acf/init', array( $this, 'acf_init' ) );
			}
		}

		/**
		 * Add Shortcodes
		 */
		public function add_shortcodes() {
			add_shortcode( 'cta_link', $this->cta_link );
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_class( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Add acf custom body class
			if ( class_exists( 'ACF' ) ) {
				$body_class = get_field( 'body_class', get_queried_object_id() );
				if ( $body_class ) {
					$body_class = esc_attr( trim( $body_class ) );
					$classes[]  = $body_class;
				}
			}
			return $classes;
		}

		/**
		 * Styling login form
		 */
		public function login_enqueue_scripts() {
			wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/style-login.css', array(), '1.0' );
			// wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
		}

		/**
		 * Add categories and tages for pages
		 */
		public function add_categories_to_pages() {
			register_taxonomy_for_object_type( 'category', 'page' );
		}

		/**
		 * Init ACF plugin settings
		 */
		public function acf_init() {
			acf_update_setting( 'show_updates', true );
			acf_update_setting( 'google_api_key', '' );
		}
		/**
		 * Add AJAX URL in <head></head>
		 */
		public function add_ajax_url() {
			$url = wp_parse_url( home_url() );
			if ( 'https' === $url['scheme'] ) {
				$protocol = 'https';
			} else {
				$protocol = 'http';
			}
			?>
			<script type="text/javascript">
				var ajaxurl = '<?php echo esc_url( admin_url( 'admin-ajax.php', $protocol ) ); ?>';
			</script>
			<?php
		}
		/**
		 * Button Shortcode
		 *
		 * @param mixed $atts shortcode attributes
		 * @return string|false button code
		 */
		public function cta_link_func( $atts ) {
			$a = shortcode_atts(
				array(
					'href'     => '#',
					'title'    => '',
					'class'    => '',
					'target'   => '',
					'download' => '',
				),
				$atts
			);
			if ( $a['download'] ) :
				$path_parts = pathinfo( $a['href'] );
				$download   = 'download="' . $path_parts['basename'] . '"';
			endif;
			ob_start();
			?>
			<a href="<?php echo esc_url( $a['href'] ); ?>" 
				class="<?php echo esc_attr( $a['class'] ); ?>"
				target="<?php echo esc_attr( $a['target'] ); ?>" 
				<?php echo esc_attr( $download ); ?>
				> 
				<?php echo esc_html( $a['title'] ); ?>
			</a>
			<?php
			return ob_get_clean();
		}
		/**
		 * Register Footer Widgets
		 */
		public function register_footer_widgets() {

			register_sidebar(
				array(
					'name'          => 'Footer area one',
					'id'            => 'footer_area_one',
					'description'   => 'This widget area discription',
					'before_widget' => '<div class="footer-col a-up a-delay-1">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6>',
					'after_title'   => '</h6>',
				)
			);

			register_sidebar(
				array(
					'name'          => 'Footer area two',
					'id'            => 'footer_area_two',
					'description'   => 'This widget area discription',
					'before_widget' => '<div class="footer-col a-up a-delay-2">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6>',
					'after_title'   => '</h6>',
				)
			);

		}

		// Disable for post types
		public function my_remove_editor_from_post_type() {
			remove_post_type_support( 'post', 'editor' );
		}
	}

	$extra = new Theme_Extra();
	$extra->init();
}


/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 *
 * @param string $file template file url
 * @param mixed  $template_args style argument list
 * @param mixed  $cache_args cache args
 *  https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
 */
function get_template_part_args( $file, $template_args = array(), $cache_args = array() ) {
	$template_args = wp_parse_args( $template_args );
	$cache_args    = wp_parse_args( $cache_args );
	if ( $cache_args ) {
		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[ $key ] = $value;
			} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[ $key ] = call_user_func( 'get_id', $value );
			}
		}
		// phpcs:disabled WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
		$cache = wp_cache_get( $file, serialize( $cache_args ) );
		if ( false !== $cache ) {
			if ( ! empty( $template_args['return'] ) ) {
				return $cache;
			}
			// phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $cache;
			return;
		}
	}
	$file_handle = $file;
	do_action( 'start_operation', 'hm_template_part::' . $file_handle );
	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) ) {
		$file = get_stylesheet_directory() . '/' . $file . '.php';
	} elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) ) {
		$file = get_template_directory() . '/' . $file . '.php';
	}
	ob_start();
	$return = require $file;
	$data   = ob_get_clean();
	do_action( 'end_operation', 'hm_template_part::' . $file_handle );
	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}
	if ( ! empty( $template_args['return'] ) ) {
		if ( false === $return ) {
			return false;
		} else {
			return $data;
		}
	}
	echo $data;
}



/**
 * Returns all child nav_menu_items under a specific parent
 *
 * @param int the parent nav_menu_item ID
 * @param array nav_menu_items
 * @param bool gives all children or direct children only
 * @return array returns filtered array of nav_menu_items
 */
function get_nav_menu_item_children( $parent_id, $nav_menu_items, $depth = true ) {
	$nav_menu_item_list = array();
	foreach ( (array) $nav_menu_items as $nav_menu_item ) {
		if ( $nav_menu_item->menu_item_parent == $parent_id ) {
			$nav_menu_item_list[] = $nav_menu_item;
			if ( $depth ) {
				$children = get_nav_menu_item_children( $nav_menu_item->ID, $nav_menu_items );
				if ( $children ) {
					$nav_menu_item_list = array_merge( $nav_menu_item_list, $children );
				}
			}
		}
	}
	return $nav_menu_item_list;
}


// Header Menu
if ( ! function_exists( 'header_mega_menu' ) ) {
	/**
	 * Create custom mega menu for header
	 *
	 * @param string theme_location
	 * @return string returns menu html
	 */
	function header_mega_menu( $theme_location ) {
		$locations = get_nav_menu_locations();
		if ( ( $theme_location ) && ( $locations ) && isset( $locations[ $theme_location ] ) ) {
			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );

			$menu_list = '';

			$count   = 0;
			$submenu = false;
			$post_id = get_the_ID();

			$last_menu_item = end( $menu_items );

			foreach ( $menu_items as $menu_item ) {
				$link  = $menu_item->url;
				$title = $menu_item->title;
				$id    = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );

				$class_names = '';

				$is_mega_menu = get_field( 'is_mega_menu', $id );
				$is_sub_menu  = get_field( 'is_sub_menu', $id );

				$classes = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item ) );
				// If parent menu
				if ( ! $menu_item->menu_item_parent ) {
					$parent_id = $menu_item->ID;
					if ( get_nav_menu_item_children( $parent_id, $menu_items ) ) {
						$menu_list .= '<li class="menu-item">' . "\n";
					} else {
						$menu_list .= '<li class="menu-item' . ( ( $id == $post_id ) ? 'current-menu-item' : '' ) . '">' . "\n";
					}
					$menu_list .= '<a href="' . $link . '">' . $title . '</a>' . "\n";

					if ( get_nav_menu_item_children( $parent_id, $menu_items ) ) {
						$menu_list .= '<ul class="dropdown"><li>' . "\n";
						if ( $is_mega_menu ) {
							$menu_list .= '<div class="submenu">';
						}
						$submenu = true;
					}
				}
				// is child menu
				if ( $parent_id == $menu_item->menu_item_parent ) {
					$level_2_menu_id = $menu_item->ID;
					if ( $is_sub_menu ) {
						$menu_list        .= '<div class="column">';
						$heading           = get_field( 'title', $id );
						$columns           = get_field( 'columns', $id );
						$level_2_childrens = get_nav_menu_item_children( $level_2_menu_id, $menu_items );
						$level_3_submenu   = false;
						$menu_list        .= '<h6>' . esc_html( $heading ) . '</h6>';
						if ( $level_2_childrens ) {
							$menu_list .= '<div class="submenu-links col-' . $columns . '">';
							foreach ( $level_2_childrens as $level_3_single_menu ) {
								if ( $level_2_menu_id == $level_3_single_menu->menu_item_parent ) {
									$menu_list .= '<div><a href="' . $level_3_single_menu->url . '" class="' . join( ' ', $level_3_single_menu->classes ) . '">';
									$menu_list .= $level_3_single_menu->title . '</a>';
									$menu_list .= '</div>';
								}
							}
							$menu_list .= '</div>';
						}
						$menu_list .= '</div>';
					} else {
						$menu_list .= '<li><a href="' . $link . '">' . $title . '</a></li>';
					}
				}

				if ( $last_menu_item->ID == $menu_items[ $count ]->ID ) {
					if ( $submenu ) {
						$menu_list .= '</ul>' . "\n";
					}
				}

				if ( isset( $menu_items[ $count + 1 ] ) && ( 0 == $menu_items[ $count + 1 ]->menu_item_parent ) ) {

					if ( $submenu ) {
						if ( $is_mega_menu ) {
							$menu_list .= '</div>';
						}
						$menu_list .= '</li></ul>' . "\n";
					}

					$menu_list .= '</li>' . "\n";

					$submenu = false;
				}

				$count++;
			}
		} else {
			$menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
		}
		echo $menu_list;
	}
}
