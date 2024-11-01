<?php
/**
 * Template Manager class file.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.1.0
 */

namespace WPOffers;

/**
 * Template Manager.
 *
 * Manage templates for Coupons
 *
 * @since 1.1.0
 */
class Template_Manager {
	/**
	 * Templates.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @var array
	 */
	private $templates = array();

	/**
	 * Remove Template
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param string $id   Template ID.
	 * @param string $args Template arguments.
	 *
	 * @return void
	 */
	public function register( $id, $args ) {
		if ( ! empty( $id ) ) {
			$default_args = array(
				'name'  => '',
				'path'  => WP_OFFERS_PATH . '/templates/',
				'width' => 800,
			);

			$this->templates[ $id ] = wp_parse_args( $args, $default_args );
		}
	}

	/**
	 * Remove Template
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param string $id Template ID.
	 *
	 * @return void
	 */
	public function remove( $id ) {
		unset( $this->templates[ $id ] );
	}

	/**
	 * Get Template
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param string $id Template ID.
	 *
	 * @return array
	 */
	public function get( $id = '' ) {
		if ( ! empty( $id ) ) {
			if ( isset( $this->templates[ $id ] ) ) {
				return $this->templates[ $id ];
			} else {
				return false;
			}
		}

		return $this->templates;
	}
}
