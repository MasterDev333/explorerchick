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

			// Disable for post types
			// add_filter('use_block_editor_for_post_type', '__return_false', 10);
			// add_action('init', 'my_remove_editor_from_post_type');
			// function my_remove_editor_from_post_type() {
			// remove_post_type_support( 'page', 'editor' );
			// }

			// Disable WordPress Admin Bar for all users
			// add_filter( 'show_admin_bar', '__return_false' );

			add_post_type_support( 'page', 'excerpt' );
		}

		/**
		 * Add Filters
		 */
		public function add_filters() {
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'mime_types', array( $this, 'mime_types' ) );
			// If ACF is installed load acf fields from local json
			if ( ! class_exists( 'ACF' ) ) {
				add_filter( 'acf/settings/save_json', array( $this, 'acf_save_json' ) );
				add_filter( 'acf/settings/load_json', array( $this, 'acf_load_json' ) );
			}
		}

		/**
		 * Add actions
		 */
		public function add_actions() {
			add_action( 'wp_head', array( $this, 'add_ajax_url' ) );
			add_action( 'init', array( $this, 'add_categories_to_pages' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ) );
			// If ACF is installed load acf fields from local json
			if ( ! class_exists( 'ACF' ) ) {
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
			if ( ! class_exists( 'ACF' ) ) {
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
		 * Save acf field groups to json
		 *
		 * @param string $path default json saving directory
		 * @return string updated path
		 */
		public function my_acf_json_save_point( $path ) {

			// update path
			$path = get_stylesheet_directory() . '/acf-json';

			// return
			return $path;

		}

		/**
		 * Load acf field groups from local json
		 *
		 * @param string $paths where json strings are located
		 * @return string path
		 */
		public function acf_load_json( $paths ) {

			// remove original path (optional)
			unset( $paths[0] );

			// append path
			$paths[] = get_stylesheet_directory() . '/acf-json';

			// return
			return $paths;

		}
		/**
		 * Enable upload for webp image files
		 *
		 * @param array $existing_mimes Existing MIMEs
		 * @return array updated MIMEs
		 */
		public function mime_types( $existing_mimes ) {
			$existing_mimes['webp'] = 'image/webp';
			return $existing_mimes;
		}

		/**
		 * Add AJAX URL in <head></head>
		 */
		public function add_ajax_url() {
			$url = parse_url( home_url() );
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
		 * Like get_template_part() put lets you pass args to the template file
		 * Args are available in the tempalte as $template_args array
		 *
		 * @param string $file template file url
		 * @param mixed  $template_args style argument list
		 * @param mixed  $cache_args cache args
		 *  https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
		 */
		public function get_template_part_args( $file, $template_args = array(), $cache_args = array() ) {
			$template_args = wp_parse_args( $template_args );
			$cache_args    = wp_parse_args( $cache_args );
			if ( $cache_args ) {
				foreach ( $template_args as $key => $value ) {
					if ( is_scalar( $value ) || is_array( $value ) ) {
						$cache_args[ $key ] = $value;
					} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
						$cache_args[ $key ] = call_user_method( 'get_id', $value );
					}
				}
				$cache = wp_cache_get( $file, serialize( $cache_args ) );
				if ( false !== $cache ) {
					if ( ! empty( $template_args['return'] ) ) {
						return $cache;
					}
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

	}

	$extra = new Theme_Extra();
	$extra->init();
}
