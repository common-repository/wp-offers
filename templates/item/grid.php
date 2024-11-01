<?php
/**
 * Coupon Default Template.
 *
 * It will show coupons single item.
 * But this is not single page.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

?>
<div id="wpo-coupon-<?php echo esc_attr( $coupon->id ); ?>" class="wpo-coupon is-grid">
	<div class="wpo-coupon-header">
		<div class="wpo-coupon__text">
			<?php $coupon->offer_text(); ?>
		</div>
		<div class="wpo-coupon__label">
			<?php $coupon->label(); ?>
		</div>
		<?php $coupon->thumbnail(); ?>
	</div>
	<div class="wpo-coupon-body">
		<?php $coupon->categories(); ?>
		<?php $coupon->title( 'wpo-coupon__title' ); ?>
		<div class="wpo-coupon__content">
			<?php $coupon->content(); ?>
		</div>
		<div class="wpo-coupon__button">
			<?php $coupon->button(); ?>
			<?php if ( $coupon->show_expiration_date() ) : ?>
				<div class="wpo-coupon__expiration">
					<?php $coupon->expiration(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
