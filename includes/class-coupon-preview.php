<?php
/**
 * Coupon Preview
 *
 * WP Offers coupon preview class file.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.1.0
 */

namespace WPOffers;

/**
 * Coupon Preview
 *
 * WP Offers coupon preview class.
 *
 * @since 1.1.0
 */
class Coupon_Preview extends Coupon {
	/**
	 * Constructor Method for Coupon Preview
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $data Coupon data.
	 *
	 * @return void
	 */
	public function __construct( $data = array() ) {
		$this->data = $data;
	}

	/**
	 * Can show this coupon preview?
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return bool
	 */
	public function can_show() {
		return true;
	}
}
