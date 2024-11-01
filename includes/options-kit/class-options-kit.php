<?php
/**
 * Options Kit.
 *
 * Main class file of Options Kit. It will call to
 * create new Option instance.
 *
 * @package    OptionsKit
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2019, KitThemes
 * @since      1.0.0
 */

if ( ! class_exists( 'Options_Kit' ) ) :
	/**
	 * Options Kit Class.
	 *
	 * Main class of Options Kit. It will help to add
	 * options and handel option page.
	 *
	 * @since 1.0.0
	 */
	class Options_Kit {
		/**
		 * Option ID.
		 *
		 * This will hold option id. It needs to be unique.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var string
		 */
		private $option_id = '';

		/**
		 * Setting Page.
		 *
		 * Setting page object created with
		 * Options_Kit_Admin_Page class.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var Options_Kit_Admin_Page
		 */
		private $setting_page;

		/**
		 * Settings.
		 *
		 * Option page also have some settings.
		 * Those settingswill will use to config setting page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $settings = array();

		/**
		 * Tabs.
		 *
		 * It will hold all tabs of option page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $tabs = array();

		/**
		 * Options.
		 *
		 * It will hold all options of option page.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var array
		 */
		private $options = array();

		/**
		 * Options Kit constructor
		 *
		 * Initializing Options Kit with option ID and
		 * option page settings.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $option_id Unique option ID.
		 * @param array  $settings  Option page settings.
		 *
		 * @return void
		 */
		public function __construct( $option_id, $settings ) {
			$this->settings = $settings;

			$this->option_id = $option_id;

			$this->hooks();
		}

		/**
		 * Hooks
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @return void
		 */
		private function hooks() {
			add_action( 'admin_menu', array( $this, 'settings_page' ), 9999 );
			add_action( 'wp_ajax_options_kit_save', array( $this, 'save_options' ) );
			add_action( 'wp_ajax_options_kit_reset', array( $this, 'reset_options' ) );
		}

		/**
		 * Add Tab
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $id       Tab ID.
		 * @param array  $settings Tab settings.
		 *
		 * @return void
		 */
		public function add_tab( $id, $settings ) {
			$this->tabs[ $id ] = array(
				'parent'   => false,
				'settings' => $settings,
			);
		}

		/**
		 * Add Sub Tab
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $parent_id Parent Tab ID.
		 * @param string $id        Sub Tab ID.
		 * @param array  $settings  Sub Tab settings.
		 *
		 * @return void
		 */
		public function add_sub_tab( $parent_id, $id, $settings ) {
			$this->tabs[ $id ] = array(
				'parent'   => $parent_id,
				'settings' => $settings,
			);
		}

		/**
		 * Add Option
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $tab_id   Tab ID.
		 * @param string $id       Option ID.
		 * @param array  $settings Option settings.
		 *
		 * @return void
		 */
		public function add_option( $tab_id, $id, $settings ) {
			if ( ! isset( $settings['type'] ) ) {
				return;
			}

			$default_setting = $this->get_default_settings( $settings['type'] );

			$prefix = ! empty( $this->settings['prefix'] ) ? $this->settings['prefix'] : '';

			$id = $prefix . $id;

			$this->options[ $id ] = array(
				'tab'      => $tab_id,
				'settings' => array_merge( $default_setting, $settings ),
			);
		}

		/**
		 * Get Default Settings
		 *
		 * Get default settings for option.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param string $type Option type.
		 *
		 * @return array
		 */
		public function get_default_settings( $type ) {
			$default_settings = array(
				'switch'   => array(
					'sanitize'      => 'ok_sanitize_boolean',
					'sanitize_save' => 'ok_sanitize_option_boolean',
				),
				'textarea' => array(
					'sanitize'      => 'sanitize_textarea_field',
					'sanitize_save' => 'sanitize_textarea_field',
				),
			);

			if ( ! empty( $default_settings[ $type ] ) ) {
				return $default_settings[ $type ];
			}

			return array(
				'sanitize' => 'sanitize_text_field',
			);
		}

		/**
		 * Process
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @return array
		 */
		private function process() {
			$options  = array();
			$sub_tabs = array();

			foreach ( $this->tabs as $tab_id => $tab ) {
				if ( false !== $tab['parent'] ) {
					$the_tab = array_merge( $tab['settings'], array( 'id' => $tab_id ) );

					$tab_options = $this->get_option_by_tab( $tab_id );

					if ( ! empty( $tab_options ) ) {
						$the_tab['options'] = $tab_options;
					}

					if ( ! isset( $sub_tabs[ $tab['parent'] ] ) ) {
						$sub_tabs[ $tab['parent'] ] = array();
					}

					$sub_tabs[ $tab['parent'] ][] = $the_tab;
				}
			}

			foreach ( $this->tabs as $tab_id => $tab ) {
				if ( false === $tab['parent'] ) {
					$the_tab = array_merge( $tab['settings'], array( 'id' => $tab_id ) );

					$tab_options = $this->get_option_by_tab( $tab_id );

					if ( isset( $sub_tabs[ $tab_id ] ) ) {
						$the_tab['tabs'] = $sub_tabs[ $tab_id ];
					} elseif ( ! empty( $tab_options ) ) {
						$the_tab['options'] = $tab_options;
					}

					$options[] = $the_tab;
				}
			}

			return $options;
		}

		/**
		 * Get Option By Tab
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @param string $tab_id Tab ID.
		 *
		 * @return array
		 */
		private function get_option_by_tab( $tab_id ) {
			$tab_options = array_filter(
				$this->options,
				function ( $option ) use ( $tab_id ) {
					return $option['tab'] === $tab_id;
				}
			);

			$final_options = array();

			if ( ! empty( $tab_options ) ) {
				foreach ( $tab_options as $tab_option_id => $tab_option ) {
					$final_options[] = array_merge(
						$tab_option['settings'],
						array(
							'id' => $tab_option_id,
						)
					);
				}
			}

			return $final_options;
		}

		/**
		 * Settings Page
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function settings_page() {
			$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			$framework_script_assets = file_exists( plugin_dir_path( __FILE__ ) . 'assets/js/options-kit' . $min . '.asset.php' ) ? require plugin_dir_path( __FILE__ ) . 'assets/js/options-kit.asset.php' : array(
				'dependencies' => array(),
				'version'      => '1.0.0',
			);

			$this->setting_page = new Options_Kit_Admin_Page( $this->settings['slug'], $this->settings['title'], 'manage_options', plugin_dir_path( __FILE__ ) . 'view/options.php' );

			if ( ! empty( $this->settings['parent'] ) ) {
				$this->setting_page->set_menu_type( 'sub', $this->settings['parent'] );
			}

			if ( ! empty( $this->settings['sidebar'] ) ) {
				$this->setting_page->set_view_variables(
					array(
						'ok_sidebar' => $this->settings['sidebar'],
					)
				);
			}

			$this->setting_page->set_script(
				'options-kit',
				array(
					'src'       => plugin_dir_url( __FILE__ ) . 'assets/js/options-kit' . $min . '.js',
					'deps'      => $framework_script_assets['dependencies'],
					'ver'       => $framework_script_assets['version'],
					'in_footer' => true,
				)
			);
			$this->setting_page->set_style(
				'options-kit',
				array(
					'src'  => plugin_dir_url( __FILE__ ) . 'assets/css/options-kit' . $min . '.css',
					'deps' => array( 'wp-components' ),
				)
			);

			$options = $this->process();

			$inline_script  = '';
			$inline_script .= 'var optionKitId="' . $this->option_id . '";';
			$inline_script .= 'var kitOptions=' . wp_json_encode( $options ) . ';';
			$inline_script .= 'var kitInfo=' . wp_json_encode( $this->settings['info'] ) . ';';
			$inline_script .= 'var optionKitNonce="' . wp_create_nonce( 'kit_options_save' ) . '";';
			$inline_script .= 'var optionsKitAjaxUrl = "' . admin_url( 'admin-ajax.php' ) . '";';
			$inline_script .= 'var optionsKitValues = ' . wp_json_encode( $this->saved_options() ) . ';';

			$this->setting_page->add_inline_script( 'options-kit', $inline_script, 'before' );

			do_action( 'ok_before_page_render_' . $this->option_id, $this->setting_page );

			$this->setting_page->done();
		}

		/**
		 * Saved Options
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @return array
		 */
		private function saved_options() {
			$options_value = array();
			foreach ( $this->options as $option_id => $option ) {
				$option_value = get_option( $option_id, null );

				if ( ! is_null( $option_value ) ) {
					$options_value[ $option_id ] = call_user_func( $option['settings']['sanitize'], $option_value );
				}
			}

			return $options_value;
		}

		/**
		 * Save Options
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function save_options() {
			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'kit_options_save' ) ) {
				wp_send_json_error( __( 'Not authorized', 'wp-offers' ) );
			}

			if ( ! isset( $_POST['option_id'] ) || sanitize_key( $_POST['option_id'] ) !== $this->option_id ) {
				return;
			}

			// phpcs:ignore
			$options = isset( $_POST['options'] ) ? $_POST['options'] : array();

			if ( ! empty( $options ) ) {
				foreach ( $options as $option_id => $option_value ) {
					if ( isset( $this->options[ $option_id ] ) ) {
						$option = $this->options[ $option_id ];
						$cb     = isset( $option['settings']['sanitize_save'] ) && ! empty( $option['settings']['sanitize_save'] ) ? $option['settings']['sanitize_save'] : 'sanitize_text_field';
						update_option( $option_id, call_user_func( $cb, $option_value ) );
					}
				}
			}

			wp_send_json_success( $this->saved_options() );
		}

		/**
		 * Reset Options
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public function reset_options() {
			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'kit_options_save' ) ) {
				wp_send_json_error( __( 'Not authorized', 'wp-offers' ) );
			}

			if ( ! isset( $_POST['option_id'] ) || sanitize_key( $_POST['option_id'] ) !== $this->option_id ) {
				return;
			}

			$options = isset( $_POST['options'] ) && is_array( $_POST['options'] ) ? array_map( 'sanitize_key', $_POST['options'] ) : array();

			if ( ! empty( $options ) ) {
				foreach ( $options as $option ) {
					delete_option( $option );
				}
			}

			wp_send_json_success( $options );
		}

		/**
		 * Includes
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return void
		 */
		public static function includes() {
			require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
			require_once plugin_dir_path( __FILE__ ) . 'includes/class-options-kit-admin-page.php';
		}

	}

	Options_Kit::includes();

endif;
