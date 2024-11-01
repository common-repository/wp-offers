<?php
/**
 * Coupon Post Type File.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

namespace WPOffers;

/**
 * Coupon Post Type Class
 *
 * Register coupon post type for coupon and
 * all necessary taxonomies.
 *
 * @since 1.0.0
 */
class Coupon_Post_Type {
	/**
	 * Coupon.
	 *
	 * Coupon post type class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var Post_Type
	 */
	public $coupon = null;

	/**
	 * CPT Name.
	 *
	 * Post type key.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public $cpt_name = 'wpo_coupon';

	/**
	 * Constructor Method for Coupon Post Type
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		$this->register_post_type();
		$this->hooks();
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
		add_action( 'init', array( $this, 'register_meta' ), 20 );
		add_filter( 'gutenberg_can_edit_post_type', array( $this, 'disable_gutenberg' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'disable_gutenberg' ), 10, 2 );

		add_filter( 'manage_wpo_coupon_posts_columns', array( $this, 'post_table_columns' ) );

		add_filter( 'wpo-store_add_form_fields', array( $this, 'store_meta' ) );
		add_filter( 'wpo-store_edit_form_fields', array( $this, 'store_meta_edit' ) );

		add_action( 'edit_wpo-store', array( $this, 'save_store_meta' ) );
		add_action( 'create_wpo-store', array( $this, 'save_store_meta' ) );

		add_action( 'manage_wpo_coupon_posts_custom_column', array( $this, 'post_table_column_value' ), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_style' ) );
	}

	/**
	 * Register Post type
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_post_type() {
		$this->coupon = new Post_Type( $this->cpt_name, 'coupon', _x( 'Coupons', 'Post type general name', 'wp-offers' ), _x( 'Coupon', 'Post type singular name', 'wp-offers' ), _x( 'WP Offers', 'Admin Menu text of WP Offers', 'wp-offers' ) );
		$this->coupon->add_support( 'title' );
		$this->coupon->add_support( 'thumbnail' );
		$this->coupon->add_support( 'custom-fields' );
		$this->coupon->set_arg( 'menu_icon', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2My45OTkiIGhlaWdodD0iMzEuOTk5IiB2aWV3Qm94PSIwIDAgNjMuOTk5IDMxLjk5OSI+PHBhdGggZD0iTTExLjM2LDMySDBWMEgxMS4zODZhNS41OTIsNS41OTIsMCwwLDAsNC4yNjMsMS45NjlBNS42LDUuNiwwLDAsMCwxOS45MTMsMEg2NFYzMkgxOS45MzhhNS42LDUuNiwwLDAsMC04LjU3NywwWk0xNC44OCwyNi4wNHYxLjZoMS4yOHYtMS42Wm0wLTN2MS42aDEuMjh2LTEuNlpNNDQuNTE5LDE2LjMyYTMuMDQsMy4wNCwwLDEsMCwzLjA0LDMuMDRBMy4wNDMsMy4wNDMsMCwwLDAsNDQuNTE5LDE2LjMyWm0yLjQyLTYuMjQ3YS44LjgsMCwwLDAtLjUxNC4xODhsLTEyLjc0NywxMC43YS44LjgsMCwwLDAsMS4wMjgsMS4yMjZsMTIuNzQ3LTEwLjdhLjguOCwwLDAsMC0uNTE0LTEuNDEzWk0xNC44OCwxOS44NHYxLjZoMS4yOHYtMS42Wm0wLTMuMnYxLjZoMS4yOHYtMS42Wk0zNi41MTksOS4yOGEzLjA0LDMuMDQsMCwxLDAsMy4wNCwzLjA0QTMuMDQ0LDMuMDQ0LDAsMCwwLDM2LjUxOSw5LjI4Wk0xNC44OCwxMy40NHYxLjZoMS4yOHYtMS42Wm0wLTMuMnYxLjZoMS4yOHYtMS42Wm0wLTMuMnYxLjZoMS4yOFY3LjA0Wm0wLTMuMDRWNS42aDEuMjhWNFpNNDQuNTE5LDIwLjhhMS40NCwxLjQ0LDAsMSwxLDEuNDQtMS40NEExLjQ0MiwxLjQ0MiwwLDAsMSw0NC41MTksMjAuOFptLTgtNy4wNGExLjQ0LDEuNDQsMCwxLDEsMS40NC0xLjQ0QTEuNDQyLDEuNDQyLDAsMCwxLDM2LjUxOSwxMy43NloiIGZpbGw9IiM5ZWEzYTgiLz48L3N2Zz4=' );
		$this->coupon->set_args(
			array(
				'public'       => false,
				'show_ui'      => true,
				'show_in_rest' => true,
				'has_archive'  => true,
			)
		);

		$this->coupon->add_taxonomy(
			'wpo-category',
			_x( 'Categories', 'taxonomy general name', 'wp-offers' ),
			_x( 'Category', 'taxonomy singular name', 'wp-offers' ),
			array(
				'show_in_rest'       => true,
				'hierarchical'       => true,
				'show_admin_column'  => true,
				'publicly_queryable' => false,
				'rewrite'            => array(
					'slug' => 'coupon-category',
				),
			)
		);
		$this->coupon->add_taxonomy(
			'wpo-store',
			_x( 'Stores', 'taxonomy general name', 'wp-offers' ),
			_x( 'Store', 'taxonomy singular name', 'wp-offers' ),
			array(
				'show_in_rest'       => true,
				'hierarchical'       => false,
				'show_admin_column'  => true,
				'publicly_queryable' => false,
				'rewrite'            => array(
					'slug' => 'coupon-store',
				),
			)
		);

		$this->coupon->run();
	}

	/**
	 * Disable Gutenberg for coupon post type.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param bool   $can_edit  Can edit post type.
	 * @param string $post_type Post type key.
	 *
	 * @return bool
	 */
	public function disable_gutenberg( $can_edit, $post_type ) {
		return $this->cpt_name === $post_type ? false : $can_edit;
	}

	/**
	 * Register meta
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_meta() {
		register_post_meta(
			$this->cpt_name,
			'coupon_desc',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'wp_kses_post',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_type',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_key',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_code',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_btn_text',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_image',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'esc_url_raw',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_link',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'esc_url_raw',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_text',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
		register_post_meta(
			$this->cpt_name,
			'coupon_expiration',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$this->cpt_name,
			'coupon_tmpl',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		// Store taxonomy meta.
		register_term_meta(
			'wpo-store',
			'store_url',
			array(
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'esc_url_raw',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * Fire after all the core meta registered.
		 *
		 * @since 1.2.0
		 */
		do_action( 'wp_offers_register_meta', $this->cpt_name );
	}

	/**
	 * Store meta
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $columns Coupon post table columns.
	 *
	 * @return array
	 */
	public function post_table_columns( $columns ) {
		$new_cols                = array_slice( $columns, 0, 1, true );
		$new_cols                = $new_cols + array_slice( $columns, 1, 1, true );
		$new_cols['ID']          = __( 'ID', 'wp-offers' );
		$new_cols['coupon_type'] = __( 'Coupon Type', 'wp-offers' );
		$new_cols                = $new_cols + array_slice( $columns, 2, 2, true );
		$new_cols['expires']     = __( 'Expires', 'wp-offers' );
		$new_cols['shortcode']   = __( 'Shortcode', 'wp-offers' );
		$new_cols                = $new_cols + array_slice( $columns, 4, count( $columns ) - 1, true );

		return $new_cols;
	}

	/**
	 * Post table column value
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string     $column  Column key.
	 * @param string|int $post_id Post ID.
	 *
	 * @return void
	 */
	public function post_table_column_value( $column, $post_id ) {
		if ( 'ID' === $column ) {
			echo esc_html( $post_id );
		} elseif ( 'coupon_type' === $column ) {
			$coupon_type = get_post_meta( $post_id, 'coupon_type', true );
			$types       = array(
				'coupon' => __( 'Coupon', 'wp-offers' ),
				'deal'   => __( 'Deal', 'wp-offers' ),
				'print'  => __( 'Printable Coupon', 'wp-offers' ),
			);
			echo esc_html( $types[ $coupon_type ] );
		} elseif ( 'expires' === $column ) {
			$coupon_expiration = get_post_meta( $post_id, 'coupon_expiration', true );
			$the_time          = \strtotime( $coupon_expiration );

			if ( ! empty( $coupon_expiration ) ) {
				if ( \time() < $the_time ) {
					echo esc_html( gmdate( 'F d, Y', $the_time ) );
				} else {
					echo esc_html__( 'Expired', 'wp-offers' );
				}
			} else {
				echo esc_html__( 'On Going Offer', 'wp-offers' );
			}
		} elseif ( 'shortcode' === $column ) {
			echo '<input type="text" value="' . esc_attr( '[wp_offer id="' . $post_id . '"]' ) . '" readOnly onClick="this.select();" />';
		}
	}

	/**
	 * Load Admin Style
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function load_admin_style() {
		wp_enqueue_style( 'wp-offers-list-table', WP_OFFERS_URL . 'assets/css/wp-offers-list-table.css', array(), WP_OFFERS_VERSION );
	}

	/**
	 * Save store meta
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string|int $term_id Term ID.
	 *
	 * @return void
	 */
	public function save_store_meta( $term_id ) {
		if ( ! isset( $_POST['store_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['store_meta_nonce'] ), 'store_meta' ) ) {
			return;
		}

		$store_url = isset( $_POST['store_url'] ) ? esc_url_raw( wp_unslash( $_POST['store_url'] ) ) : '';

		update_term_meta( $term_id, 'store_url', $store_url );

		/**
		 * Fire after all the core meta for store taxonomy is saved.
		 *
		 * @since 1.2.0
		 */
		do_action( 'wp_offers_save_store_meta', $term_id );
	}

	/**
	 * Store meta
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function store_meta() {
		?>
		<?php $this->store_meta_nonce(); ?>
		<div class="form-field">
			<label><?php esc_html_e( 'URL', 'wp-offers' ); ?></label>
			<?php $this->store_url_meta_render( false ); ?>
		</div>
		<?php

		/**
		 * Fire after all the core meta for store taxonomy is rendered at add new taxonomy view.
		 *
		 * @since 1.2.0
		 */
		do_action( 'wp_offers_store_meta' );
	}

	/**
	 * Store meta edit
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param WP_Term $term Term object.
	 *
	 * @return void
	 */
	public function store_meta_edit( $term ) {
		?>
		<?php $this->store_meta_nonce(); ?>
		<tr class="form-field store-logo-wrap">
			<th scope="row">
				<label><?php esc_html_e( 'URL', 'wp-offers' ); ?></label>
			</th>
			<td>
				<?php $this->store_url_meta_render( $term->term_id ); ?>
			</td>
		</tr>
		<?php

		/**
		 * Fire after all the core meta for store taxonomy is rendered at edit taxonomy view.
		 *
		 * @since 1.2.0
		 */
		do_action( 'wp_offers_store_meta_edit', $term->term_id );
	}

	/**
	 * Store meta nonce render
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return void
	 */
	public function store_meta_nonce() {
		?>
		<input name="store_meta_nonce" type="hidden" value="<?php echo esc_attr( wp_create_nonce( 'store_meta' ) ); ?>">
		<?php
	}

	/**
	 * Store URL meta render
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string|int $term_id Term ID.
	 *
	 * @return void
	 */
	public function store_url_meta_render( $term_id ) {
		$store_url = $term_id ? get_term_meta( $term_id, 'store_url', true ) : '';
		?>
			<input name="store_url" type="text" value="<?php echo esc_attr( $store_url ); ?>">
		<?php
	}
}
