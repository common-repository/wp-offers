<?php
/**
 * Functions
 *
 * All functions of the WP Offers plugin.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

/**
 * WP Offer Shortcode
 *
 * It will show single coupon.
 *
 * @since 1.0.0
 *
 * @param array $atts Attributes of WP Offer shortcode.
 *
 * @return string
 */
function wp_offer_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'id' => '',
		),
		$atts
	);

	$coupon_id = ! empty( $args['id'] ) ? intval( $args['id'] ) : 0;

	$html = '';

	if ( $coupon_id ) {
		ob_start();
		wp_offers_coupon( $coupon_id );
		$html = ob_get_clean();
	}

	return $html;
}
add_shortcode( 'wp_offer', 'wp_offer_shortcode' );

/**
 * WP Offer List Shortcode
 *
 * It will show list of coupons and deals.
 *
 * @since 1.2.0
 *
 * @param array $atts Attributes of WP Offers shortcode.
 *
 * @return string
 */
function wp_offers_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'per_page'   => 5,
			'template'   => 'default',
			'pagination' => 'off',
			'columns'    => 1,
		),
		$atts
	);

	$html = '';

	$paged           = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	$per_page        = $args['per_page'] ? absint( $args['per_page'] ) : 5;
	$columns         = $args['columns'] ? absint( $args['columns'] ) : 1;
	$pagination      = $args['pagination'] ? $args['pagination'] : 'off';
	$template        = $args['template'] ? $args['template'] : 'default';
	$show_pagination = 'on' === $args['pagination'];

	$coupon_query = new WP_Query(
		array(
			'post_type'      => 'wpo_coupon',
			'posts_per_page' => $per_page,
			'paged'          => $paged,
		)
	);

	ob_start();
	wp_offers_get_template(
		'coupons.php',
		array(
			'coupon_query'    => $coupon_query,
			'show_pagination' => $show_pagination,
			'template'        => $template,
			'columns'         => $columns,
		)
	);
	wp_reset_postdata();
	$html = ob_get_clean();

	return $html;
}
add_shortcode( 'wp_offers', 'wp_offers_shortcode' );

/**
 * Get Template
 *
 * Get template of WP Offers coupon and deals.
 *
 * @since 1.0.0
 *
 * @param string $template_name Template name.
 * @param array  $args          Accessable values inside of template.
 * @param string $template_path Template path.
 * @param string $default_path  Template default path.
 *
 * @return void
 */
function wp_offers_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	$cache_key = sanitize_key( implode( '-', array( 'template', $template_name, $template_path, $default_path, WP_OFFERS_VERSION ) ) );
	$template  = (string) wp_cache_get( $cache_key, 'wp-offers' );

	if ( ! $template ) {
		$template = wp_offers_locate_template( $template_name, $template_path, $default_path );
		wp_cache_set( $cache_key, $template, 'wp-offers' );
	}

	$action_args = array(
		'template_name' => $template_name,
		'template_path' => $template_path,
		'located'       => $template,
		'args'          => $args,
	);

	if ( ! empty( $args ) && is_array( $args ) ) {
		if ( isset( $args['action_args'] ) ) {
			_doing_it_wrong(
				__FUNCTION__,
				esc_html__( 'action_args should not be overwritten when calling wp_offers_get_template.', 'wp-offers' ),
				'1.0.0'
			);
			unset( $args['action_args'] );
		}
		extract( $args ); // @codingStandardsIgnoreLine
	}

	include $action_args['located'];
}

/**
 * Locate Template
 *
 * @since 1.0.0
 *
 * @param string $template_name Template name.
 * @param string $template_path Template path.
 * @param string $default_path  Template default path.
 *
 * @return string
 */
function wp_offers_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = wp_offers_template_path();
	}

	if ( ! $default_path ) {
		$default_path = WP_OFFERS_PATH . '/templates/';
	}

	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	return apply_filters( 'wp_offers_locate_template', $template, $template_name, $template_path );
}

/**
 * Is Theme Template
 *
 * @param string $tmpl_id Template ID.
 *
 * @return bool
 */
function wp_offers_is_theme_tmpl( $tmpl_id ) {
	$template_name = 'item/' . $tmpl_id . '.php';
	$template_file = locate_template(
		array(
			trailingslashit( wp_offers_template_path() ) . $template_name,
			$template_name,
		)
	);

	return ! empty( $template_file );
}

/**
 * Template Path
 *
 * @since 1.0.0
 *
 * @return string
 */
function wp_offers_template_path() {
	return apply_filters( 'wp_offers_template_path', 'wp-offers/' );
}

/**
 * Get Coupon
 *
 * @since 1.0.0
 *
 * @param string|int $coupon_id  Coupon ID.
 *
 * @return \WPOffers\Coupon
 */
function wp_offers_get_coupon( $coupon_id = '' ) {
	if ( empty( $coupon_id ) ) {
		$post_item = get_posts(
			array(
				'post_type'   => 'wpo_coupon',
				'numberposts' => 1,
			)
		);

		if ( is_array( $post_item ) && count( $post_item ) ) {
			$coupon_id = $post_item[0]->ID;
		}
	}

	$coupon = new \WPOffers\Coupon( $coupon_id );

	$coupon = apply_filters( 'wpo_coupon_object', $coupon, $coupon_id );

	return $coupon;
}

/**
 * Coupon
 *
 * @since 1.0.0
 *
 * @param string|int     $coupon_id  Coupon ID.
 * @param boolean|string $force_tmpl Force template for provided coupon.
 *
 * @return void
 */
function wp_offers_coupon( $coupon_id = '', $force_tmpl = false ) {
	$coupon = wp_offers_get_coupon( $coupon_id );

	wp_offers_print_coupon( $coupon, $force_tmpl );
}

/**
 * Print Coupon
 *
 * @since 1.0.0
 *
 * @param \WPOffers\Coupon $coupon Coupon class instance.
 * @param boolean|string   $force_tmpl Force template for provided coupon.
 *
 * @return void
 */
function wp_offers_print_coupon( $coupon, $force_tmpl = false ) {
	global $wp_offers;
	if ( $coupon->can_show() ) {
		$tmpl_id     = $coupon->get_template_id();
		$tmpl_config = $wp_offers->templates->get( $tmpl_id );

		// If template is not found, set default template.
		if ( false === $tmpl_config ) {
			$tmpl_id = 'default';
		}

		// If force template is set, set force template.
		if ( $force_tmpl ) {
			$tmpl_id = $force_tmpl;
		}
		wp_offers_get_template(
			'item/' . $tmpl_id . '.php',
			array(
				'coupon' => $coupon,
			),
			false === $tmpl_config ? '' : $tmpl_config['path']
		);
	}
}

/**
 * Pagination
 *
 * Print pagination of coupon list.
 *
 * @since 1.2.0
 *
 * @param WP_Query $query WordPress post query instance.
 *
 * @return void
 */
function wp_offers_pagination( $query ) {
	echo wp_kses_post( wp_offers_get_pagination( $query ) );
}

/**
 * Get Pagination
 *
 * Get pagination of coupon list.
 *
 * @since 1.2.0
 *
 * @param WP_Query $query WordPress post query instance.
 *
 * @return string
 */
function wp_offers_get_pagination( $query ) {
	$big = 999999999;

	$base = esc_url( get_pagenum_link( $big ) );
	$base = remove_query_arg( 'wpo-id', $base );
	$base = str_replace( $big, '%#%', $base );

	return paginate_links(
		array(
			'base'    => $base,
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $query->max_num_pages,
			'type'    => 'list',
		)
	);
}

/**
 * Remove Pagination Args
 *
 * Remove args from pagination link.
 *
 * @since 1.2.0
 *
 * @param string $link Paginate link.
 *
 * @return string
 */
function wp_offers_remove_paginate_args( $link ) {
	return remove_query_arg( 'wpo-id', $link );
}
add_filter( 'paginate_links', 'wp_offers_remove_paginate_args' );

/**
 * ID to Category
 *
 * @since 1.1.0
 *
 * @param sting|int $term_id Term ID.
 *
 * @return WP_Term
 */
function wp_offers_id_to_category( $term_id ) {
	return get_term( intval( $term_id ), 'wpo-category' );
}

/**
 * Ajax Preview
 *
 * @since 1.1.0
 *
 * @return void
 */
function wp_offers_ajax_preview() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'wp_offers_ajax_preview' ) ) {
		wp_send_json_error( __( 'Not authorized', 'wp-offers' ) );
	}

	$post_id         = ! empty( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0; // phpcs:ignore
	$title           = ! empty( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : ''; // phpcs:ignore
	$url             = ! empty( $_POST['url'] ) ? esc_url( $_POST['url'] ) : ''; // phpcs:ignore
	$content         = ! empty( $_POST['content'] ) ? wp_kses_post( $_POST['content'] ) : ''; // phpcs:ignore
	$type            = ! empty( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : ''; // phpcs:ignore
	$code            = ! empty( $_POST['code'] ) ? sanitize_text_field( $_POST['code'] ) : ''; // phpcs:ignore
	$btn_text        = ! empty( $_POST['btn_text'] ) ? sanitize_text_field( $_POST['btn_text'] ) : ''; // phpcs:ignore
	$image           = ! empty( $_POST['image'] ) ? esc_url( $_POST['image'] ) : ''; // phpcs:ignore
	$link            = ! empty( $_POST['link'] ) ? esc_url( $_POST['link'] ) : ''; // phpcs:ignore
	$text            = ! empty( $_POST['text'] ) ? sanitize_text_field( $_POST['text'] ) : ''; // phpcs:ignore
	$expiration      = ! empty( $_POST['expiration'] ) ? sanitize_text_field( $_POST['expiration'] ) : ''; // phpcs:ignore
	$show_expiration =  ! empty( $_POST['show_expiration'] ) ? boolval( $_POST['show_expiration'] ) : false ; // phpcs:ignore
	$template        = ! empty( $_POST['template'] ) ? sanitize_text_field( $_POST['template'] ) : 'default'; // phpcs:ignore
	$thumbnail_id    = ! empty( $_POST['thumbnail_id'] ) ? intval( $_POST['thumbnail_id'] ) : ''; // phpcs:ignore
	$store           = ! empty( $_POST['store'] ) ? get_term( intval( $_POST['store'] ), 'wpo-store' ) : false; // phpcs:ignore
	$categories      = ! empty( $_POST['categories'] ) && is_array( $_POST['categories'] ) ? array_map( 'wp_offers_id_to_category', $_POST['categories'] ) : array(); // phpcs:ignore

	$data   = array(
		'id'              => $post_id,
		'title'           => $title,
		'url'             => $url,
		'content'         => $content,
		'type'            => $type,
		'code'            => $code,
		'btn_text'        => $btn_text,
		'image'           => $image,
		'link'            => $link,
		'text'            => $text,
		'expiration'      => $expiration,
		'show_expiration' => $show_expiration,
		'template'        => $template,
		'thumbnail_id'    => $thumbnail_id,
		'categories'      => $categories,
		'store'           => $store,
	);
	$coupon = new \WPOffers\Coupon_Preview( $data );

	ob_start();
	wp_offers_print_coupon( $coupon );
	$html = ob_get_clean();

	wp_send_json_success( $html );
}

add_action( 'wp_ajax_wpo_ajax_preview', 'wp_offers_ajax_preview' );
