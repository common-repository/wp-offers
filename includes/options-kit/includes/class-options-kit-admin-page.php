<?php
/**
 * Admin Page.
 *
 * It will make simple to create admin page for addons.
 *
 * @package    OptionsKit
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2019, KitThemes
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Options_Kit_Admin_Page' ) ) :
	/**
	 * Admin Page Class.
	 *
	 * This class will make simple to create Admin Page.
	 *
	 * @since 1.0.0
	 */
	class Options_Kit_Admin_Page {
		/**
		 * Page Title.
		 *
		 * Page title will be used for admin page title
		 * and menu title if menu title is not set.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $page_title;

		/**
		 * Menu Title.
		 *
		 * Menu title will be shown at WordPress admin menu.
		 * If menu title is not set, page title will be as default.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $menu_title;

		/**
		 * Capability
		 *
		 * This option will set page page access controll.
		 * Capability option is required to create a page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $capability;

		/**
		 * Menu Slug
		 *
		 * This will be slug of your admin page URL.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $menu_slug;

		/**
		 * Icon URL
		 *
		 * It will hold admin page icon url or SVG base64 code.
		 * Only available at parent menu type.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $icon_url = '';

		/**
		 * Position
		 *
		 * Position of the admin page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var int
		 */
		private $position = null;

		/**
		 * View
		 *
		 * It will hold view file name.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var function
		 */
		private $view;

		/**
		 * View Variables
		 *
		 * It will hold view variables.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $view_variables;

		/**
		 * Menu Type
		 *
		 * It will hold menu type.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $menu_type = 'parent';

		/**
		 * Parent Slug
		 *
		 * It will hold parent menu slug for sub menu.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $parent_slug = '';

		/**
		 * Show View
		 *
		 * View will be rendered or not.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var bool
		 */
		private $show_view = true;

		/**
		 * Scripts
		 *
		 * It will hold all scripts of this admin page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $scripts = array();

		/**
		 * Inline Scripts
		 *
		 * It will hold all inline scripts of this admin page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $inline_scripts = array();

		/**
		 * Localize Scripts
		 *
		 * It will hold all localize scripts of this admin page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $localize_scripts = array();

		/**
		 * Styles
		 *
		 * It will hold all styles of this admin page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $styles = array();

		/**
		 * Script Default
		 *
		 * Default parameters of wp_enqueue_script
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $script_default = array();

		/**
		 * Style Default
		 *
		 * Default parameters of wp_enqueue_style
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $style_default = array();

		/**
		 * Enqueue media
		 *
		 * If set true, wp_enqueue_media() will be called.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $enqueue_media = false;

		/**
		 * Admin Page constructor
		 *
		 * Initializing Admin Page with title, slug and capability.
		 * It will start building admin page.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $slug         Admin Page slug.
		 * @param string $title        Admin Page title.
		 * @param string $capability   Admin Page capability.
		 * @param string $view         Admin Page view file path.
		 *
		 * @return void
		 */
		public function __construct( $slug, $title, $capability, $view ) {
			$this->menu_slug  = $slug;
			$this->view       = $view;
			$this->page_title = $title;
			$this->menu_title = $title;
			$this->capability = $capability;

			$this->script_default = array(
				'src'       => '',
				'deps'      => array(),
				'ver'       => false,
				'in_footer' => false,
			);
			$this->style_default  = array(
				'src'   => '',
				'deps'  => array(),
				'ver'   => false,
				'media' => 'all',
			);
		}

		/**
		 * Set Menu Title
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $title   Menu title.
		 *
		 * @return Admin_Page
		 */
		public function set_menu_title( $title ) {
			$this->menu_title = $title;

			return $this;
		}

		/**
		 * Set Icon
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $icon   Menu icon.
		 *
		 * @return Admin_Page
		 */
		public function set_icon( $icon ) {
			$this->icon_url = $icon;

			return $this;
		}

		/**
		 * Set Position
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param int $position   Menu position.
		 *
		 * @return Admin_Page
		 */
		public function set_position( $position ) {
			$this->position = $position;

			return $this;
		}

		/**
		 * Set View
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $view   View file path.
		 *
		 * @return Admin_Page
		 */
		public function set_view( $view ) {
			$this->view = $view;

			return $this;
		}

		/**
		 * Set Menu Type
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $type          menu typw `sub` or `parent`.
		 * @param string $parent_slug   Parent slug of subpage.
		 *
		 * @return Admin_Page
		 */
		public function set_menu_type( $type, $parent_slug = '' ) {
			$this->menu_type   = $type;
			$this->parent_slug = $parent_slug;

			return $this;
		}

		/**
		 * Set Show View
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param bool $show_view   Page view will be show or not.
		 *
		 * @return Admin_Page
		 */
		public function set_show_view( $show_view ) {
			$this->show_view = $show_view;

			return $this;
		}

		/**
		 * Set Script
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $handle  Script handle.
		 * @param array  $args    Arguments for scripts.
		 *
		 * @return Admin_Page
		 */
		public function set_script( $handle, $args = array() ) {
			if ( is_array( $args ) && count( $args ) ) {
				$this->scripts[ $handle ] = $args;
			} else {
				$this->scripts[] = $handle;
			}

			return $this;
		}

		/**
		 * Add Inline Script.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $handle      Script handle.
		 * @param string $script      Script as string.
		 * @param string $position    Script position. Default: after.
		 *
		 * @return Admin_Page
		 */
		public function add_inline_script( $handle, $script, $position = 'after' ) {
			$this->inline_scripts[ $handle ] = array(
				'script'   => $script,
				'position' => $position,
			);

			return $this;
		}

		/**
		 * Add Localize Script.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $handle   Script handle.
		 * @param string $name     Variable name to use for JS.
		 * @param array  $data     Localize data/strings as array.
		 *
		 * @return Admin_Page
		 */
		public function add_localize_script( $handle, $name, $data = array() ) {
			$this->localize_scripts[ $handle ] = array(
				'name' => $name,
				'data' => $data,
			);

			return $this;
		}

		/**
		 * Set Style.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $handle   Style handle.
		 * @param array  $args     Arguments for styles.
		 *
		 * @return Admin_Page
		 */
		public function set_style( $handle, $args = array() ) {
			if ( is_array( $args ) && count( $args ) ) {
				$this->styles[ $handle ] = $args;
			} else {
				$this->styles[] = $handle;
			}

			return $this;
		}

		/**
		 * Enqueue Media
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param bool $enqueue Media script and style will enqueue or not.
		 *
		 * @return Admin_Page
		 */
		public function enqueue_media( $enqueue = true ) {
			$this->enqueue_media = $enqueue;

			return $this;
		}

		/**
		 * Set View Variables
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param array $view_variables Accessable variables array in template.
		 *
		 * @return void
		 */
		public function set_view_variables( $view_variables ) {
			$this->view_variables = $view_variables;
		}

		/**
		 * Include View.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function include_view() {
			if ( ! empty( $this->view_variables ) ) {
				extract( $this->view_variables ); // @codingStandardsIgnoreLine
			}
			include $this->view;
		}

		/**
		 * Done.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function done() {
			$callback = '';

			if ( $this->show_view ) {
				$callback = array( $this, 'include_view' );
			}

			if ( 'sub' === $this->menu_type ) {
				$hook = add_submenu_page( $this->parent_slug, $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, $callback );
			} else {
				$hook = add_menu_page( $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, $callback, $this->icon_url, $this->position );
			}

			add_action( 'load-' . $hook, array( $this, 'load_assets' ), 99 );
		}

		/**
		 * Add Admin Color as JS Variables
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function add_admin_color_js_var() {
			global $_wp_admin_css_colors;

			$current_color = get_user_option( 'admin_color' );

			$colors = $_wp_admin_css_colors[ $current_color ]->colors;

			?>
		<script>var _cmlyAdminColor=<?php echo wp_json_encode( $colors ); ?>;</script>
			<?php
		}

		/**
		 * Load Assets.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function load_assets() {

			if ( $this->enqueue_media ) {
				wp_enqueue_media();
			}

			// Load all scripts.
			if ( is_array( $this->scripts ) && count( $this->scripts ) ) {
				foreach ( $this->scripts as $handle => $script_info ) {
					if ( is_string( $script_info ) ) {
						wp_enqueue_script( $script_info );
					} else {
						$script = array_merge( $this->script_default, $script_info );

						wp_enqueue_script( $handle, $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
					}
				}
			}

			// Load all inline scripts.
			if ( is_array( $this->inline_scripts ) && count( $this->inline_scripts ) ) {
				foreach ( $this->inline_scripts as $handle => $inline_script ) {
					wp_add_inline_script( $handle, $inline_script['script'], $inline_script['position'] );
				}
			}

			// Load all localize scripts.
			if ( is_array( $this->localize_scripts ) && count( $this->localize_scripts ) ) {
				foreach ( $this->localize_scripts as $handle => $localize_script ) {
					wp_localize_script( $handle, $localize_script['name'], $localize_script['data'] );
				}
			}

			// Load all styles.
			if ( is_array( $this->styles ) && count( $this->styles ) ) {
				foreach ( $this->styles as $handle => $style_info ) {
					if ( is_string( $style_info ) ) {
						wp_enqueue_style( $style_info );
					} else {
						$style = array_merge( $this->style_default, $style_info );

						wp_enqueue_style( $handle, $style['src'], $style['deps'], $style['ver'], $style['media'] );
					}
				}
			}
		}

	}
endif;
