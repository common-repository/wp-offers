<?php
/**
 * Options
 *
 * Options of the WP Offers plugin.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

/**
 * Options
 *
 * It will add options to Settings page of WP Offers.
 *
 * @since 1.0.0
 *
 * @param Options_Kit $options Instance of Options_Kit class.
 *
 * @return void
 */
function wp_offers_options( $options ) {
	$options->add_tab(
		'coupon',
		array(
			'title' => __( 'Display Settings', 'wp-offers' ),
		)
	);

	$options->add_tab(
		'style',
		array(
			'title' => __( 'Style Settings', 'wp-offers' ),
		)
	);

	$options->add_tab(
		'extra',
		array(
			'title' => __( 'Extra Settings', 'wp-offers' ),
		)
	);

	// Coupon Settings.
	$options->add_option(
		'coupon',
		'coupon_tooltip_text',
		array(
			'title' => __( 'Coupon Tooltip Text', 'wp-offers' ),
			'desc'  => __( 'Text to show on the tooltip when hovers on the coupon button.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Click to Copy This Coupon', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'deal_button_text',
		array(
			'title' => __( 'Deal Button Text', 'wp-offers' ),
			'desc'  => __( 'This text will show on the deal button. Also, the Deal button text can be overridden from the single coupon editor.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Get This Deal', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'deal_button_tooltip_text',
		array(
			'title' => __( 'Deal Button Tooltip Text', 'wp-offers' ),
			'desc'  => __( 'Text to show on the tooltip when hovers on the deal button.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Click Here To Get This Deal', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'printable_button_text',
		array(
			'title' => __( 'Print Button Text', 'wp-offers' ),
			'desc'  => __( 'This text will show on printable coupon button.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Print This Coupon', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'printable_button_tooltip_text',
		array(
			'title' => __( 'Print Button Tooltip Text', 'wp-offers' ),
			'desc'  => __( 'Text to show on the tooltip when hovers on the printable coupon button.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Click Here To Print This Coupon', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'hide_expiry_date',
		array(
			'title' => __( 'Hide Expiry date', 'wp-offers' ),
			'desc'  => __( 'Hide expiry date from the coupon in frontend.', 'wp-offers' ),
			'type'  => 'switch',
			'value' => false,
		)
	);

	$options->add_option(
		'coupon',
		'no_expiry_date',
		array(
			'title' => __( 'No Expiry Date', 'wp-offers' ),
			'desc'  => __( 'This text will show if there is no expiry date set for coupons or deals.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'On Going Offer', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'before_expiry_date',
		array(
			'title' => __( 'Before Expiry Date', 'wp-offers' ),
			'desc'  => __( 'This text will append before the date if coupon or deal is not expired.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Expires On', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'after_expiry_date',
		array(
			'title' => __( 'After Expiry Date', 'wp-offers' ),
			'desc'  => __( 'This text will append before the date if coupon or deal is already expired.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Expired On', 'wp-offers' ),
		)
	);

	$time = strtotime( '2020-05-31T22:31:00' );
	$options->add_option(
		'coupon',
		'expiry_date_format',
		array(
			'title'   => __( 'Expiry date format', 'wp-offers' ),
			'desc'    => __( 'Select a date format for the expiry date. It also has an example to understand better.', 'wp-offers' ),
			'type'    => 'select',
			'value'   => 'F j, Y',
			'options' => array(
				// translators: Date.
				'F j, Y' => sprintf( __( 'mm d, yyyy (%s)', 'wp-offers' ), gmdate( 'F j, Y', $time ) ),
				// translators: Date.
				'm/d/Y'  => sprintf( __( 'mm/dd/yyyy (%s)', 'wp-offers' ), gmdate( 'm/d/Y', $time ) ),
				// translators: Date.
				'd/m/Y'  => sprintf( __( 'dd/mm/yyyy (%s)', 'wp-offers' ), gmdate( 'd/m/Y', $time ) ),
				// translators: Date.
				'Y/m/d'  => sprintf( __( 'yyyy/mm/dd (%s)', 'wp-offers' ), gmdate( 'Y/m/d', $time ) ),
			),
		)
	);

	$options->add_option(
		'coupon',
		'coupon_label',
		array(
			'title' => __( 'Coupon Label', 'wp-offers' ),
			'desc'  => __( 'Coupon type offer label to show.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Coupon', 'wp-offers' ),
		)
	);
	$options->add_option(
		'coupon',
		'deal_label',
		array(
			'title' => __( 'Deal Label', 'wp-offers' ),
			'desc'  => __( 'Deal type offer label to show.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Deal', 'wp-offers' ),
		)
	);
	$options->add_option(
		'coupon',
		'printable_label',
		array(
			'title' => __( 'Printable Coupon Label', 'wp-offers' ),
			'desc'  => __( 'Printable Coupon type offer label to show.', 'wp-offers' ),
			'type'  => 'text',
			'value' => __( 'Coupon', 'wp-offers' ),
		)
	);

	$options->add_option(
		'coupon',
		'coupon_title_tag',
		array(
			'title'   => __( 'Title Tag', 'wp-offers' ),
			'desc'    => __( 'Select a tag for coupon title.', 'wp-offers' ),
			'type'    => 'select',
			'value'   => 'h2',
			'options' => array(
				'h1'   => __( 'H1', 'wp-offers' ),
				'h2'   => __( 'H2', 'wp-offers' ),
				'h3'   => __( 'H3', 'wp-offers' ),
				'h4'   => __( 'H4', 'wp-offers' ),
				'h5'   => __( 'H5', 'wp-offers' ),
				'div'  => __( 'Div', 'wp-offers' ),
				'span' => __( 'Span', 'wp-offers' ),
			),
		)
	);

	// Style Settings.
	$options->add_option(
		'style',
		'coupon_text_color',
		array(
			'title' => __( 'Coupon Text Color', 'wp-offers' ),
			'desc'  => __( 'Coupon text color for default template.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'coupon_text_border_color',
		array(
			'title' => __( 'Coupon Text Border Color', 'wp-offers' ),
			'desc'  => __( 'Coupon text border color for default template.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'coupon_text_bg_color',
		array(
			'title' => __( 'Coupon Text Background Color', 'wp-offers' ),
			'desc'  => __( 'Coupon text background color for default template.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#E7F5FF',
		)
	);

	$options->add_option(
		'style',
		'coupon_label_color',
		array(
			'title' => __( 'Coupon Label Color', 'wp-offers' ),
			'desc'  => __( 'Coupon label color for default template.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#fff',
		)
	);

	$options->add_option(
		'style',
		'coupon_label_bg_color',
		array(
			'title' => __( 'Coupon Label Background Color', 'wp-offers' ),
			'desc'  => __( 'Coupon label background color for default template.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'coupon_button',
		array(
			'title' => __( 'Coupon Button', 'wp-offers' ),
			'type'  => 'title',
		)
	);

	$options->add_option(
		'style',
		'coupon_button_color',
		array(
			'title' => __( 'Text Color', 'wp-offers' ),
			'desc'  => __( 'Change the button text color for the coupon type offer.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'coupon_button_bg_color',
		array(
			'title' => __( 'Background Color', 'wp-offers' ),
			'desc'  => __( 'Change the button background color for the coupon type offer.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#E7F5FF',
		)
	);

	$options->add_option(
		'style',
		'coupon_button_border_color',
		array(
			'title' => __( 'Border Color', 'wp-offers' ),
			'desc'  => __( 'Change the button border color for the coupon type offer.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'coupon_button_hover_color',
		array(
			'title' => __( 'Text Color (:hover)', 'wp-offers' ),
			'desc'  => __( 'Change the button border color for the coupon type offer when the user hovers on the button.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'coupon_button_hover_bg_color',
		array(
			'title' => __( 'Background Color (:hover)', 'wp-offers' ),
			'desc'  => __( 'Change the button background color for the coupon type offer when the user hovers on the button.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#fff',
		)
	);

	$options->add_option(
		'style',
		'coupon_button_border_hover_color',
		array(
			'title' => __( 'Border Color (:hover)', 'wp-offers' ),
			'desc'  => __( 'Change the button border color for the coupon type offer when the user hovers on the button.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'deal_button',
		array(
			'title' => __( 'Deal/Print Button', 'wp-offers' ),
			'type'  => 'title',
		)
	);
	$options->add_option(
		'style',
		'deal_button_color',
		array(
			'title' => __( 'Text Color', 'wp-offers' ),
			'desc'  => __( 'Change the button text color for the deal/print type offer.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#fff',
		)
	);

	$options->add_option(
		'style',
		'deal_button_bg_color',
		array(
			'title' => __( 'Background Color', 'wp-offers' ),
			'desc'  => __( 'Change the button background color for the deal/print type offer.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);

	$options->add_option(
		'style',
		'deal_button_border_color',
		array(
			'title' => __( 'Border Color', 'wp-offers' ),
			'desc'  => __( 'Change the button border color for the deal/print type offer.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#1D97F0',
		)
	);
	$options->add_option(
		'style',
		'deal_button_hover_color',
		array(
			'title' => __( 'Text Color (:hover)', 'wp-offers' ),
			'desc'  => __( 'Change the button border color for the deal/print type offer when the user hovers on the button.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#fff',
		)
	);

	$options->add_option(
		'style',
		'deal_button_bg_hover_color',
		array(
			'title' => __( 'Background Color (:hover)', 'wp-offers' ),
			'desc'  => __( 'Change the button background color for the deal/print type offer when the user hovers on the button.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#0f8ae4',
		)
	);

	$options->add_option(
		'style',
		'deal_button_border_hover_color',
		array(
			'title' => __( 'Border Color (:hover)', 'wp-offers' ),
			'desc'  => __( 'Change the button border color for the deal/print type offer when the user hovers on the button.', 'wp-offers' ),
			'type'  => 'color',
			'value' => '#0f8ae4',
		)
	);

	// Extra.
	$options->add_option(
		'extra',
		'open_link_target',
		array(
			'title'   => __( 'Open Link Target', 'wp-offers' ),
			'desc'    => __( 'Select coupon/deal link will be open in same tab or new tab. Default: New tab (_blank)', 'wp-offers' ),
			'type'    => 'select',
			'value'   => '_blank',
			'options' => array(
				'_self'  => __( 'Same tab (_self)', 'wp-offers' ),
				'_blank' => __( 'New tab (_blank)', 'wp-offers' ),
			),
		)
	);

	$options->add_option(
		'extra',
		'link_in_title_tag',
		array(
			'title' => __( 'Disable Link in Title Tag', 'wp-offers' ),
			'desc'  => __( 'Disable coupon/deal link in title tag. Default: Enabled', 'wp-offers' ),
			'type'  => 'switch',
			'value' => false,
		)
	);

	$options->add_option(
		'extra',
		'onclick_copy',
		array(
			'title' => __( 'Copy on click coupon code', 'wp-offers' ),
			'desc'  => __( 'Coupon code will copy at click on the coupon. Default: Enabled', 'wp-offers' ),
			'type'  => 'switch',
			'value' => true,
		)
	);

	$options->add_option(
		'extra',
		'onclick_print',
		array(
			'title' => __( 'Print on click Printable coupon', 'wp-offers' ),
			'desc'  => __( 'On click Printable Coupon button, the coupon will print. Default: Enabled', 'wp-offers' ),
			'type'  => 'switch',
			'value' => true,
		)
	);

	$options->add_option(
		'extra',
		'custom_css',
		array(
			'title' => __( 'Custom CSS', 'wp-offers' ),
			'desc'  => __( 'Add your custom CSS styles.', 'wp-offers' ),
			'type'  => 'textarea',
			'value' => '',
		)
	);
}

add_action( 'wp_offers_options_init', 'wp_offers_options' );
