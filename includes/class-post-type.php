<?php
/**
 * Post Type class file.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

namespace WPOffers;

/**
 * Post Type.
 *
 * Register new post type with less info.
 *
 * @since 1.0.0
 */
class Post_Type {
	/**
	 * Type.
	 *
	 * Post type key.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $type = '';

	/**
	 * Slug.
	 *
	 * Post type slug.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $slug = '';

	/**
	 * Name.
	 *
	 * Post type name.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $name = '';

	/**
	 * Singular Name.
	 *
	 * Post type singular name.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $singular_name = '';

	/**
	 * Menu Title.
	 *
	 * Post type menu title.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $menu_title = '';

	/**
	 * Labels.
	 *
	 * Post type labels.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var array
	 */
	private $labels = array();

	/**
	 * Arguments.
	 *
	 * Post type register arguments.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * Supports.
	 *
	 * Post type supports.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var array
	 */
	private $supports = array();

	/**
	 * Taxonomies.
	 *
	 * Post type taxonomies.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var array
	 */
	private $taxonomies = array();

	/**
	 * Constructor Method for post type
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $type          Post type key.
	 * @param string $slug          Post type slug.
	 * @param string $name          Post type name.
	 * @param string $singular_name Post type singular name.
	 * @param string $menu_title    Post type menu title.
	 *
	 * @return void
	 */
	public function __construct( $type, $slug, $name, $singular_name, $menu_title = '' ) {
		$this->type          = $type;
		$this->slug          = $slug;
		$this->name          = $name;
		$this->singular_name = $singular_name;

		if ( ! empty( $menu_title ) ) {
			$this->menu_title = $menu_title;
		} else {
			$this->menu_title = $name;
		}

		$this->setup_labels();
	}

	/**
	 * Run
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->register_post_type();
		$this->register_tax();
	}

	/**
	 * Register Post Type
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_post_type() {
		$args = $this->args;

		$args['labels']   = $this->labels;
		$args['supports'] = $this->supports;
		$args['rewrite']  = array(
			'slug' => $this->slug,
		);

		register_post_type( $this->type, $args );
	}

	/**
	 * Register Post Taxonomies
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_tax() {
		if ( ! empty( $this->taxonomies ) ) {
			foreach ( $this->taxonomies as $tax => $tax_args ) {
				register_taxonomy( $tax, $this->type, $tax_args );
			}
		}
	}

	/**
	 * Setup custom post type lables.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	private function setup_labels() {
		$labels = array(
			'name'                  => $this->name,
			'singular_name'         => $this->singular_name,
			'menu_name'             => $this->menu_title,
			'name_admin_bar'        => $this->singular_name,
			'add_new'               => __( 'Add New', 'wp-offers' ),
			// translators: singular name.
			'add_new_item'          => sprintf( __( 'Add New %s', 'wp-offers' ), $this->singular_name ),
			// translators: singular name.
			'new_item'              => sprintf( __( 'New %s', 'wp-offers' ), $this->singular_name ),
			// translators: singular name.
			'edit_item'             => sprintf( __( 'Edit %s', 'wp-offers' ), $this->singular_name ),
			// translators: singular name.
			'view_item'             => sprintf( __( 'View %s', 'wp-offers' ), $this->singular_name ),
			// translators: name.
			'all_items'             => sprintf( __( 'All %s', 'wp-offers' ), $this->name ),
			// translators: name.
			'search_items'          => sprintf( __( 'Search %s', 'wp-offers' ), $this->name ),
			// translators: name.
			'parent_item_colon'     => sprintf( __( 'Parent %s:', 'wp-offers' ), $this->name ),
			// translators: name.
			'not_found'             => sprintf( __( 'No %s found.', 'wp-offers' ), $this->name ),
			// translators: name.
			'not_found_in_trash'    => sprintf( __( 'No %s found in Trash.', 'wp-offers' ), $this->name ),
			// translators: singular name.
			'featured_image'        => sprintf( _x( '%s Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'wp-offers' ), $this->singular_name ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'wp-offers' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'wp-offers' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'wp-offers' ),
			// translators: singular name.
			'archives'              => sprintf( _x( '%s archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'wp-offers' ), $this->singular_name ),
			// translators: singular name.
			'insert_into_item'      => sprintf( _x( 'Insert into %s', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'wp-offers' ), $this->singular_name ),
			// translators: singular name.
			'uploaded_to_this_item' => sprintf( _x( 'Uploaded to this %s', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'wp-offers' ), $this->singular_name ),
			// translators: name.
			'filter_items_list'     => sprintf( _x( 'Filter %s list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'wp-offers' ), $this->name ),
			// translators: name.
			'items_list_navigation' => sprintf( _x( '%s list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'wp-offers' ), $this->name ),
			// translators: name.
			'items_list'            => sprintf( _x( '%s list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'wp-offers' ), $this->name ),
		);

		$this->labels = $labels;
	}

	/**
	 * Is valid? Argument checking.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $arg_name Argument name/key.
	 *
	 * @return bool
	 */
	private function is_valid_arg( $arg_name ) {
		$valid_args = array(
			'description',
			'public',
			'hierarchical',
			'exclude_from_search',
			'publicly_queryable',
			'show_ui',
			'show_in_menu',
			'show_in_nav_menus',
			'show_in_admin_bar',
			'show_in_rest',
			'rest_base',
			'rest_controller_class',
			'menu_position',
			'menu_icon',
			'capability_type',
			'capabilities',
			'map_meta_cap',
			'has_archive',
			'query_var',
			'can_export',
			'delete_with_user',
		);

		return in_array( $arg_name, $valid_args, true );
	}

	/**
	 * Set Argument.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $arg   Argument key.
	 * @param mix    $value Argument value.
	 *
	 * @throws \Exception If argument is not valid.
	 *
	 * @return void
	 */
	public function set_arg( $arg, $value ) {
		if ( ! $this->is_valid_arg( $arg ) ) {
			// translators: Argument key.
			throw new \Exception( sprintf( __( 'Invalid argument "%s".', 'wp-offers' ), $arg ), 1 );
		}

		$this->args[ $arg ] = $value;
	}

	/**
	 * Set Arguments.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args Arguments.
	 *
	 * @return void
	 */
	public function set_args( $args = array() ) {
		if ( ! empty( $args ) && \is_array( $args ) ) {
			foreach ( $args as $arg => $arg_value ) {
				$this->set_arg( $arg, $arg_value );
			}
		}
	}

	/**
	 * Add support.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $support Support key/name.
	 *
	 * @return void
	 */
	public function add_support( $support ) {
		if ( ! isset( $this->supports[ $support ] ) ) {
			$this->supports[] = $support;
		}
	}

	/**
	 * Add Taxonomy.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $tax           Taxonomy key.
	 * @param string $name          Taxonomy name.
	 * @param string $singular_name Taxonomy singular name.
	 * @param array  $args          Taxonomy arguments.
	 *
	 * @return void
	 */
	public function add_taxonomy( $tax, $name, $singular_name, $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'labels' => $this->get_taxonomy_labels( $name, $singular_name ),
				'public' => true,
			)
		);

		$this->taxonomies[ $tax ] = $args;
	}

	/**
	 * Get Taxonomy Labels.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $name          Taxonomy name.
	 * @param string $singular_name Taxonomy singular name.
	 *
	 * @return array
	 */
	public function get_taxonomy_labels( $name, $singular_name ) {
		$labels = array(
			'name'                       => $name,
			'singular_name'              => $singular_name,
			// translators: name.
			'search_items'               => sprintf( __( 'Search %s', 'wp-offers' ), $name ),
			// translators: name.
			'popular_items'              => sprintf( __( 'Popular %s', 'wp-offers' ), $name ),
			// translators: name.
			'all_items'                  => sprintf( __( 'All %s', 'wp-offers' ), $name ),
			// translators: singular name.
			'parent_item'                => sprintf( __( 'Parent %s', 'wp-offers' ), $singular_name ),
			// translators: singular name.
			'parent_item_colon'          => sprintf( __( 'Parent %s:', 'wp-offers' ), $singular_name ),
			// translators: singular name.
			'edit_item'                  => sprintf( __( 'Edit %s', 'wp-offers' ), $singular_name ),
			// translators: singular name.
			'view_item'                  => sprintf( __( 'View %s', 'wp-offers' ), $singular_name ),
			// translators: singular name.
			'update_item'                => sprintf( __( 'Update %s', 'wp-offers' ), $singular_name ),
			// translators: singular name.
			'add_new_item'               => sprintf( __( 'Add New %s', 'wp-offers' ), $singular_name ),
			// translators: singular name.
			'new_item_name'              => sprintf( __( 'New %s Name', 'wp-offers' ), $singular_name ),
			// translators: name.
			'separate_items_with_commas' => sprintf( __( 'Separate %s with commas', 'wp-offers' ), strtolower( $name ) ),
			// translators: name.
			'add_or_remove_items'        => sprintf( __( 'Add or remove %s', 'wp-offers' ), strtolower( $name ) ),
			// translators: name.
			'choose_from_most_used'      => sprintf( __( 'Choose from the most used %s', 'wp-offers' ), strtolower( $name ) ),
			// translators: name.
			'not_found'                  => sprintf( __( 'No %s found.', 'wp-offers' ), strtolower( $name ) ),
			// translators: name.
			'no_terms'                   => sprintf( __( 'No %s', 'wp-offers' ), strtolower( $name ) ),
			// translators: name.
			'items_list_navigation'      => sprintf( __( '%s list navigation', 'wp-offers' ), $name ),
			// translators: name.
			'items_list'                 => sprintf( __( '%s list', 'wp-offers' ), $name ),
			/* translators: Tab heading when selecting from the most used terms. */
			'most_used'                  => _x( 'Most Used', 'Terms', 'wp-offers' ),
			// translators: name.
			'back_to_items'              => sprintf( __( '&larr; Back to %s', 'wp-offers' ), $name ),
		);

		return $labels;
	}
}
