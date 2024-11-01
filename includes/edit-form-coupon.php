<?php
/**
 * Coupon Edit Form
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $post_type, $post_type_object, $post;
// Flag that we're loading the coupon editor.
$current_screen                   = get_current_screen(); // @codingStandardsIgnoreLine
$current_screen->is_coupon_editor = true;

// Preload common data.
$preload_paths = array(
	'/wp/v2/wpo-category?context=edit',
	'/wp/v2/wpo-store?context=edit',
	'/wp/v2/taxonomies/wpo-category?context=edit',
	'/wp/v2/taxonomies/wpo-store?context=edit',
	sprintf( '/wp/v2/wpo_coupon/%s?context=edit', $post->ID ),
	'/wp/v2/users/me?context=edit',
	array( '/wp/v2/media', 'OPTIONS' ),
	array( '/wp/v2/blocks', 'OPTIONS' ),
	sprintf( '/wp/v2/wpo_coupon/%d/autosaves?context=edit', $post->ID ),
);

$backup_global_post = $post;

$preload_data = array_reduce(
	$preload_paths,
	'rest_preload_api_request',
	array()
);

wp_add_inline_script(
	'wp-api-fetch',
	sprintf( 'wp.apiFetch.use( wp.apiFetch.createPreloadingMiddleware( %s ) );', wp_json_encode( $preload_data ) ),
	'after'
);

// Restore the global $post as it was before API preloading.
$post = $backup_global_post; // @codingStandardsIgnoreLine

require_once ABSPATH . 'wp-admin/admin-header.php';
?>
<div class="wp-offers-editor" id="wp-offers-editor">
	<div class="wpo-preloader">
		<svg xmlns="http://www.w3.org/2000/svg" width="127.999" height="64" viewBox="0 0 127.999 64">
			<path d="M128,64H39.878a11.2,11.2,0,0,0-17.157,0H0V0H22.773A11.192,11.192,0,0,0,31.3,3.938,11.189,11.189,0,0,0,39.826,0H128V64ZM29.759,52.08v3.2h2.56v-3.2Zm0-6v3.2h2.56v-3.2Zm59.28-13.44a6.08,6.08,0,1,0,6.08,6.08A6.087,6.087,0,0,0,89.04,32.639Zm4.839-12.495a1.6,1.6,0,0,0-1.027.374L67.357,41.911a1.6,1.6,0,0,0,1.029,2.826,1.608,1.608,0,0,0,1.029-.374L94.908,22.971a1.6,1.6,0,0,0-1.029-2.826ZM29.759,39.68v3.2h2.56v-3.2Zm0-6.4v3.2h2.56v-3.2ZM73.039,18.56a6.08,6.08,0,1,0,6.08,6.08A6.087,6.087,0,0,0,73.039,18.56Zm-43.28,8.32v3.2h2.56v-3.2Zm0-6.4v3.2h2.56v-3.2Zm0-6.4v3.2h2.56v-3.2Zm0-6.08v3.2h2.56V8ZM89.04,41.6a2.88,2.88,0,1,1,2.88-2.88A2.883,2.883,0,0,1,89.04,41.6Zm-16-14.08a2.88,2.88,0,1,1,2.88-2.88A2.883,2.883,0,0,1,73.039,27.52Z" fill="none"/>
		</svg>
	</div>
</div>
