<?php
/**
 * Functions.
 *
 * It will contain all necessary functions.
 *
 * @package    OptionsKit
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2019, KitThemes
 * @since      1.0.0
 */

/**
 * Sanitize given value to boolean.
 *
 * @param mix $value Value to sanitize.
 *
 * @return bool Sanitized boolean value
 */
function ok_sanitize_boolean( $value ) {
	if ( is_string( $value ) ) {
		$value = strtolower( $value );
		if ( in_array( $value, array( 'false', '0' ), true ) ) {
			$value = false;
		}
	}

	return (bool) $value;
}

/**
 * Sanitize given value to '0' or '1'.
 *
 * @param mix $value Value to sanitize.
 *
 * @return string
 */
function ok_sanitize_option_boolean( $value ) {
	if ( is_string( $value ) ) {
		$value = strtolower( $value );
		if ( in_array( $value, array( 'false', '0' ), true ) ) {
			$value = '0';
		}
	}

	return ( (bool) $value ) ? '1' : '0';
}
