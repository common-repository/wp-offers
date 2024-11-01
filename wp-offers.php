<?php
/**
 * Plugin Name: WP Offers
 * Plugin URI: https://www.kitthemes.com/wp-offers
 * Version: 1.2.1
 * Requires at least: 5.5
 * Requires PHP: 5.6
 * Description: Best Coupon and Deal WordPress Plugin for Affiliate Marketers and Bloggers. Our plugin helps you to boost CTR and sales through Coupons And Deals.
 * Author: KitThemes
 * Author URI: https://www.kitthemes.com/
 * Text Domain: wp-offers
 * License: GPLv2 or later
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

// If accessed directly, exit.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'WP_OFFERS_VERSION', '1.2.1' );
define( 'WP_OFFERS_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_OFFERS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load WP Offers textdomain.
 *
 * Load gettext translate for WP Offers text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wp_offers_load_languages() {
	load_plugin_textdomain( 'wp-offers' );
}

add_action( 'plugins_loaded', 'wp_offers_load_languages' );

if ( ! function_exists( 'wpo_fs' ) ) {
	/**
	 * Create a helper function for easy SDK access.
	 *
	 * @since 1.1.0
	 *
	 * @return Freemius
	 */
	function wpo_fs() {
		global $wpo_fs;

		if ( ! isset( $wpo_fs ) ) {
			// Include Freemius SDK.
			require_once WP_OFFERS_PATH . 'includes/freemius/start.php';

			$wpo_fs = fs_dynamic_init(
				array(
					'id'                  => '6338',
					'slug'                => 'wp-offers',
					'premium_slug'        => 'wp-offers-pro',
					'type'                => 'plugin',
					'public_key'          => 'pk_2a1c0538d669ea27e5f2b1662f3d5',
					'is_premium'          => false,
					'premium_suffix'      => 'Pro',
					// If your plugin is a serviceware, set this option to false.
					'has_premium_version' => true,
					'has_addons'          => false,
					'has_paid_plans'      => true,
					'menu'                => array(
						'slug'    => 'edit.php?post_type=wpo_coupon',
						'account' => false,
					),
				)
			);
		}

		return $wpo_fs;
	}

	// Init Freemius.
	wpo_fs();
	// Signal that SDK was initiated.
	do_action( 'wpo_fs_loaded' );
}

require WP_OFFERS_PATH . 'includes/options-kit/class-options-kit.php';
require WP_OFFERS_PATH . 'includes/class-plugin.php';

/**
 * WP Offers
 *
 * Initialize WP Offers plugin.
 *
 * @since 1.0.0
 *
 * @return \WPOffers\Plugin
 */
function wp_offers() {
	$wp_offers = \WPOffers\Plugin::instance();

	/**
	 * Fire after the plugin is loaded.
	 *
	 * @since 1.2.0
	 */
	do_action( 'wp_offers_loaded' );

	return $wp_offers;
}

$GLOBALS['wp_offers'] = wp_offers();
