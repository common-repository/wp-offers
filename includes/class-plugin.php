<?php
/**
 * Plugin Class File
 *
 * WP Offers main plugin class file.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

namespace WPOffers;

/**
 * Plugin Class
 *
 * WP Offers main plugin class.
 *
 * @since 1.0.0
 */
class Plugin {
	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	/**
	 * Post Type.
	 *
	 * Holds instance of Coupon_Post_Type class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var Coupon_Post_Type
	 */
	public $post_type = null;

	/**
	 * Options.
	 *
	 * Holds instance of Options_Kit class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var Options_Kit
	 */
	public $options = null;

	/**
	 * Templates.
	 *
	 * Holds instance of Template_Manager class.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @var Template_Manager
	 */
	public $templates = null;

	/**
	 * Clone.
	 *
	 * Disable class cloning and throw an error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object. Therefore, we don't want the object to be cloned.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'wp-offers' ), '1.0.0' );
	}

	/**
	 * Wakeup.
	 *
	 * Disable unserializing of the class.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'wp-offers' ), '1.0.0' );
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();

			/**
			 * WP Offers loaded.
			 *
			 * Fires when WP Offers was fully loaded and instantiated.
			 *
			 * @since 1.0.0
			 */
			do_action( 'wp_offers_loaded' );
		}

		return self::$instance;
	}

	/**
	 * Constructor Method for plugin
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		$this->includes();
		$this->init();
		$this->hooks();
		$this->register_builtin_templates();
	}

	/**
	 * Include files and classes
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function includes() {
		require_once WP_OFFERS_PATH . 'includes/class-coupon.php';
		require_once WP_OFFERS_PATH . 'includes/class-coupon-preview.php';
		require_once WP_OFFERS_PATH . 'includes/class-post-type.php';
		require_once WP_OFFERS_PATH . 'includes/class-coupon-post-type.php';
		require_once WP_OFFERS_PATH . 'includes/class-template-manager.php';
		require_once WP_OFFERS_PATH . 'includes/functions.php';
		require_once WP_OFFERS_PATH . 'includes/options.php';
		require_once WP_OFFERS_PATH . 'includes/class-ask-for-review.php';
	}

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		$this->post_type = new Coupon_Post_Type();
		$this->templates = new Template_Manager();
		$this->options   = new \Options_Kit(
			'wp_offers_settings',
			array(
				'slug'   => 'wp_offers_settings',
				'title'  => __( 'Settings', 'wp-offers' ),
				'parent' => 'edit.php?post_type=wpo_coupon',
				'prefix' => 'wpo_',
				'info'   => array(
					'title'   => __( 'WP Offers', 'wp-offers' ),
					'version' => WP_OFFERS_VERSION,
					'links'   => array(
						array(
							'title' => __( 'Documentations', 'wp-offers' ),
							'link'  => 'https://www.kitthemes.com/docs/wp-offers/',
						),
					),
				),
			)
		);

		do_action( 'wp_offers_options_init', $this->options );
	}

	/**
	 * Hooks
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function hooks() {
		add_filter( 'replace_editor', array( $this, 'coupon_editor' ), 10, 2 );
		add_filter( 'admin_body_class', array( $this, 'coupon_editor_class' ) );
		add_filter( 'template_include', array( $this, 'preview_template' ) );

		add_action( 'admin_head', array( $this, 'coupon_editor_assets' ) );
		add_action( 'init', array( $this, 'set_script_translations' ) );
		add_action( 'init', array( $this, 'register_scripts' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_assets' ) );
		add_action( 'ok_before_page_render_wp_offers_settings', array( $this, 'options_kit' ) );

	}

	/**
	 * Set Script Translations
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function set_script_translations() {
		wp_set_script_translations( 'coupon-editor', 'wp-offers' );
		wp_set_script_translations( 'options-kit', 'wp-offers' );
	}

	/**
	 * Options Kit
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param Options_Kit_Admin_Page $setting_page Options kit setting page instance.
	 *
	 * @return void
	 */
	public function options_kit( $setting_page ) {
		$setting_page->set_style(
			'wpo-options-kit',
			array(
				'src'  => WP_OFFERS_URL . 'assets/css/wpo-options-kit.css',
				'deps' => array( 'options-kit' ),
			)
		);
	}

	/**
	 * Frontend assets
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function frontend_assets() {
		$suffix = \defined( 'WP_OFFERS_DEBUG' ) && WP_OFFERS_DEBUG ? '' : '.min';

		wp_enqueue_style( 'tippy', WP_OFFERS_URL . 'assets/css/tippy' . $suffix . '.css', array(), WP_OFFERS_VERSION );
		wp_enqueue_style( 'wp-offers-frontend', WP_OFFERS_URL . 'build/css/wp-offers-frontend' . $suffix . '.css', array( 'tippy' ), WP_OFFERS_VERSION );

		wp_add_inline_style( 'wp-offers-frontend', $this->inline_css() );

		wp_enqueue_script( 'clipboardjs', WP_OFFERS_URL . 'assets/js/clipboard' . $suffix . '.js', array(), WP_OFFERS_VERSION, true );
		wp_enqueue_script( 'popper', WP_OFFERS_URL . 'assets/js/popper' . $suffix . '.js', array(), WP_OFFERS_VERSION, true );
		wp_enqueue_script( 'tippy', WP_OFFERS_URL . 'assets/js/tippy.umd' . $suffix . '.js', array(), WP_OFFERS_VERSION, true );
		wp_enqueue_script( 'wp-offers-frontend', WP_OFFERS_URL . 'build/js/wp-offers-frontend' . $suffix . '.js', array( 'clipboardjs', 'popper', 'tippy' ), WP_OFFERS_VERSION, true );
	}

	/**
	 * Frontend inline CSS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	private function inline_css() {
		$css = '';

		$coupon_text_color        = get_option( 'wpo_coupon_text_color' );
		$coupon_text_border_color = get_option( 'wpo_coupon_text_border_color' );
		$coupon_text_bg_color     = get_option( 'wpo_coupon_text_bg_color' );

		$coupon_text_css  = '';
		$coupon_text_css .= ! empty( $coupon_text_color ) ? 'color: ' . $coupon_text_color . ';' : '';
		$coupon_text_css .= ! empty( $coupon_text_border_color ) ? 'border-color: ' . $coupon_text_border_color . ';' : '';
		$coupon_text_css .= ! empty( $coupon_text_bg_color ) ? 'background-color: ' . $coupon_text_bg_color . ';' : '';

		$css .= ! empty( $coupon_text_css ) ? '.wpo-coupon.is-deafult .wpo-coupon__text, .wpo-coupon.is-grid .wpo-coupon-header .wpo-coupon__text{' . $coupon_text_css . '}' : '';

		$coupon_label_color    = get_option( 'wpo_coupon_label_color' );
		$coupon_label_bg_color = get_option( 'wpo_coupon_label_bg_color' );

		$coupon_label_css  = '';
		$coupon_label_css .= ! empty( $coupon_label_color ) ? 'color: ' . $coupon_label_color . ';' : '';
		$coupon_label_css .= ! empty( $coupon_label_bg_color ) ? 'background-color: ' . $coupon_label_bg_color . ';' : '';

		$css .= ! empty( $coupon_label_css ) ? '.wpo-coupon.is-deafult .wpo-coupon__label, .wpo-coupon.is-grid .wpo-coupon-header .wpo-coupon__label{' . $coupon_label_css . '}' : '';

		$wpo_coupon_button_color              = get_option( 'wpo_coupon_button_color' );
		$wpo_coupon_button_bg_color           = get_option( 'wpo_coupon_button_bg_color' );
		$wpo_coupon_button_border_color       = get_option( 'wpo_coupon_button_border_color' );
		$wpo_coupon_button_hover_color        = get_option( 'wpo_coupon_button_hover_color' );
		$wpo_coupon_button_hover_bg_color     = get_option( 'wpo_coupon_button_hover_bg_color' );
		$wpo_coupon_button_border_hover_color = get_option( 'wpo_coupon_button_border_hover_color' );

		$coupon_button_css  = '';
		$coupon_button_css .= ! empty( $wpo_coupon_button_color ) ? 'color: ' . $wpo_coupon_button_color . ';' : '';
		$coupon_button_css .= ! empty( $wpo_coupon_button_bg_color ) ? 'background-color: ' . $wpo_coupon_button_bg_color . ';' : '';
		$coupon_button_css .= ! empty( $wpo_coupon_button_border_color ) ? 'border-color: ' . $wpo_coupon_button_border_color . ';' : '';

		$css .= ! empty( $coupon_button_css ) ? '.wpo-coupon .wpo-btn-coupon{' . $coupon_button_css . '}' : '';

		$coupon_button_hover_css  = '';
		$coupon_button_hover_css .= ! empty( $wpo_coupon_button_hover_color ) ? 'color: ' . $wpo_coupon_button_hover_color . ';' : '';
		$coupon_button_hover_css .= ! empty( $wpo_coupon_button_hover_bg_color ) ? 'background-color: ' . $wpo_coupon_button_hover_bg_color . ';' : '';
		$coupon_button_hover_css .= ! empty( $wpo_coupon_button_border_hover_color ) ? 'border-color: ' . $wpo_coupon_button_border_hover_color . ';' : '';

		$css .= ! empty( $coupon_button_hover_css ) ? '.wpo-coupon .wpo-btn-coupon:hover{' . $coupon_button_hover_css . '}' : '';

		$wpo_deal_button_color              = get_option( 'wpo_deal_button_color' );
		$wpo_deal_button_bg_color           = get_option( 'wpo_deal_button_bg_color' );
		$wpo_deal_button_border_color       = get_option( 'wpo_deal_button_border_color' );
		$wpo_deal_button_hover_color        = get_option( 'wpo_deal_button_hover_color' );
		$wpo_deal_button_bg_hover_color     = get_option( 'wpo_deal_button_bg_hover_color' );
		$wpo_deal_button_border_hover_color = get_option( 'wpo_deal_button_border_hover_color' );

		$deal_button_css  = '';
		$deal_button_css .= ! empty( $wpo_deal_button_color ) ? 'color: ' . $wpo_deal_button_color . ';' : '';
		$deal_button_css .= ! empty( $wpo_deal_button_bg_color ) ? 'background-color: ' . $wpo_deal_button_bg_color . ';' : '';
		$deal_button_css .= ! empty( $wpo_deal_button_border_color ) ? 'border-color: ' . $wpo_deal_button_border_color . ';' : '';

		$css .= ! empty( $deal_button_css ) ? '.wpo-coupon .wpo-btn-deal{' . $deal_button_css . '}' : '';

		$deal_button_hover_css  = '';
		$deal_button_hover_css .= ! empty( $wpo_deal_button_hover_color ) ? 'color: ' . $wpo_deal_button_hover_color . ';' : '';
		$deal_button_hover_css .= ! empty( $wpo_deal_button_bg_hover_color ) ? 'background-color: ' . $wpo_deal_button_bg_hover_color . ';' : '';
		$deal_button_hover_css .= ! empty( $wpo_deal_button_border_hover_color ) ? 'border-color: ' . $wpo_deal_button_border_hover_color . ';' : '';

		$css .= ! empty( $deal_button_hover_css ) ? '.wpo-coupon .wpo-btn-deal:hover{' . $deal_button_hover_css . '}' : '';

		$custom_css = get_option( 'wpo_custom_css' );

		if ( ! empty( $custom_css ) ) {
			$css .= $custom_css;
		}

		return $css;
	}

	/**
	 * Coupon Editor
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param bool    $replace_editor Replace editor.
	 * @param WP_Post $post           WP_Post class instance.
	 *
	 * @return bool
	 */
	public function coupon_editor( $replace_editor, $post ) {
		$current_screen = get_current_screen();
		if ( 'wpo_coupon' === $post->post_type ) {
			$replace_editor = true;
			if ( ! is_null( $current_screen ) ) {
				include WP_OFFERS_PATH . 'includes/edit-form-coupon.php';
			}
		}

		return $replace_editor;
	}

	/**
	 * Coupon Editor CSS class
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $classes Coupon editor body class.
	 *
	 * @return string
	 */
	public function coupon_editor_class( $classes ) {
		$current_screen = get_current_screen();
		if ( isset( $current_screen->is_coupon_editor ) && $current_screen->is_coupon_editor ) {
			$classes = 'coupon-editor';
		}

		return $classes;
	}

	/**
	 * Coupon Editor Assets
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function coupon_editor_assets() {
		$suffix         = \defined( 'WP_OFFERS_DEBUG' ) && WP_OFFERS_DEBUG ? '' : '.min';
		$current_screen = get_current_screen();
		if ( isset( $current_screen->is_coupon_editor ) && $current_screen->is_coupon_editor ) {
			wp_enqueue_style( 'wp-offers-core' );
			wp_enqueue_style( 'wp-offers-editor' );

			wp_enqueue_media();

			wp_enqueue_script( 'wp-offers-store' );
			wp_enqueue_script( 'wp-offers-core' );
			wp_enqueue_script( 'wp-offers-config' );
			wp_enqueue_script( 'wp-offers-editor' );

			wp_set_script_translations( 'wp-offers-editor', 'wp-offers' );

			$meta_keys = get_registered_meta_keys( 'post', $this->post_type->cpt_name );
			$version   = 'ver=' . get_bloginfo( 'version' );
			$user_id   = wp_check_post_lock( get_the_ID() );

			if ( $user_id ) {
				$locked = true;

				$user         = get_userdata( $user_id );
				$user_details = array(
					'name' => $user->display_name,
				);

				$lock_details = array(
					'isLocked' => $locked,
					'user'     => $user_details,
				);
			} else {
				// Lock the post.
				$active_post_lock = wp_set_post_lock( get_the_ID() );
				if ( $active_post_lock ) {
					$active_post_lock = esc_attr( implode( ':', $active_post_lock ) );
				}

				$lock_details = array(
					'isLocked'       => false,
					'activePostLock' => $active_post_lock,
				);
			}

			$templates = $this->templates->get();

			if ( ! empty( $templates ) ) {
				foreach ( $templates as $template_id => $template ) {
					$templates[ $template_id ] = \array_merge(
						$template,
						array(
							'from_theme' => wp_offers_is_theme_tmpl( $template_id ),
						)
					);
				}
			}

			$configs = array(
				'url'                 => home_url( '/' ),
				'pluginUrl'           => WP_OFFERS_URL,
				'prvNonce'            => \wp_create_nonce( 'wp_offers_preview' ),
				'prvAjaxNonce'        => \wp_create_nonce( 'wp_offers_ajax_preview' ),
				'ajaxUrl'             => \admin_url( 'admin-ajax.php' ),
				'metaKeys'            => array_keys( $meta_keys ),
				'postId'              => get_the_ID(),
				'tmcContentCss'       => \implode(
					',',
					array(
						includes_url( "css/dashicons$suffix.css?$version" ),
						includes_url( "js/tinymce/skins/wordpress/wp-content.css?$version" ),
					)
				),
				'postLock'            => $lock_details,
				'postUnlockNonce'     => \wp_create_nonce( 'update-post_' . get_the_ID() ),
				'postLockNonce'       => \wp_create_nonce( 'lock-post_' . get_the_ID() ),
				'templates'           => $templates,
				'labels'              => array(
					'coupon' => get_option( 'wpo_coupon_label', esc_html__( 'Coupon', 'wp-offers' ) ),
					'deal'   => get_option( 'wpo_coupon_label', esc_html__( 'Deal', 'wp-offers' ) ),
					'print'  => get_option( 'wpo_coupon_label', esc_html__( 'Coupon', 'wp-offers' ) ),
				),
				'isThemeTmpl'         => \wp_offers_is_theme_tmpl( 'default' ),
				'showExpiry'          => ! get_option( 'wpo_hide_expiry_date', false ),
				'linkInTitle'         => ! get_option( 'wpo_link_in_title_tag', false ),
				'titleTag'            => \get_option( 'wpo_coupon_title_tag', 'h2' ),
				'expiryDateFormat'    => \get_option( 'wpo_expiry_date_format', 'F j, Y' ),
				'beforeExpiryDate'    => \get_option( 'wpo_before_expiry_date', esc_html__( 'Expires On', 'wp-offers' ) ),
				'afterExpiryDate'     => \get_option( 'wpo_after_expiry_date', esc_html__( 'Expired On', 'wp-offers' ) ),
				'noExpiryDate'        => \get_option( 'wpo_no_expiry_date', esc_html__( 'On Going Offer', 'wp-offers' ) ),
				'dealButtonText'      => \get_option( 'wpo_deal_button_text', esc_html__( 'Get This Deal', 'wp-offers' ) ),
				'printableButtonText' => \get_option( 'wpo_printable_button_text', esc_html__( 'Print This Coupon', 'wp-offers' ) ),
			);

			$inline_script = 'wp.wpo.config.setConfig(' . \wp_json_encode( $configs ) . ');';

			wp_add_inline_script(
				'wp-offers-config',
				$inline_script,
				'after'
			);
		}
	}

	/**
	 * Register Script
	 *
	 * Register script for admin.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_scripts() {
		$suffix = \defined( 'WP_OFFERS_DEBUG' ) && WP_OFFERS_DEBUG ? '' : '.min';

		wp_register_style(
			'wp-offers-core',
			WP_OFFERS_URL . 'build/css/wp-offers-core' . $suffix . '.css',
			array(
				'wp-components',
				'editor-buttons',
			),
			WP_OFFERS_VERSION
		);

		wp_register_style(
			'wp-offers-editor',
			WP_OFFERS_URL . 'build/css/wp-offers-editor' . $suffix . '.css',
			array(
				'wp-components',
				'editor-buttons',
				'wp-offers-core',
			),
			WP_OFFERS_VERSION
		);

		$this->register_script( 'wp-offers-store' );
		$this->register_script( 'wp-offers-core' );
		$this->register_script( 'wp-offers-config' );
		$this->register_script(
			'wp-offers-editor',
			array(
				'wp-tinymce',
				'wp-offers-store',
				'wp-offers-core',
				'wp-offers-config',
			)
		);
	}

	/**
	 * Register Script
	 *
	 * Register build script with WordPress dependency.
	 *
	 * @since 1.2.0
	 * @access private
	 *
	 * @param string $name          Name of the script.
	 * @param array  $dependencies  Extra dependencies.
	 *
	 * @return void
	 */
	private function register_script( $name, $dependencies = array() ) {
		$suffix        = \defined( 'WP_OFFERS_DEBUG' ) && WP_OFFERS_DEBUG ? '' : '.min';
		$script_name   = $name . $suffix;
		$script_assets = file_exists( WP_OFFERS_PATH . 'build/js/' . $script_name . '.asset.php' ) ? require WP_OFFERS_PATH . 'build/js/' . $script_name . '.asset.php' : array(
			'dependencies' => array(),
			'version'      => '1.0',
		);
		wp_register_script(
			$name,
			WP_OFFERS_URL . 'build/js/' . $script_name . '.js',
			\array_merge( $dependencies, $script_assets['dependencies'] ),
			$script_assets['version'],
			true
		);
	}

	/**
	 * Register Builtin Templates
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	private function register_builtin_templates() {
		$this->templates->register(
			'grid',
			array(
				'name'  => __( 'Grid', 'wp-offers' ),
				'width' => 400,
			)
		);
	}

	/**
	 * Preview Template
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param string $template Template path.
	 *
	 * @return string
	 */
	public function preview_template( $template ) {
		$preview = isset( $_GET['wpo-preview'] ) ? sanitize_key( $_GET['wpo-preview'] ) : '';
		$nonce   = isset( $_GET['nonce'] ) ? sanitize_key( $_GET['nonce'] ) : '';
		if ( 'wpo' === $preview && wp_verify_nonce( $nonce, 'wp_offers_preview' ) ) {
			add_filter( 'show_admin_bar', '__return_false' );
			$template = WP_OFFERS_PATH . 'includes/preview.php';
		}
		return $template;
	}
}
