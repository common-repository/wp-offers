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
<div id="wpo-coupon-<?php echo esc_attr( $coupon->id ); ?>" class="wpo-coupon is-deafult">
	<div class="wpo-row">
		<div class="wpo-col-2">
			<div class="wpo-coupon__text">
				<?php $coupon->offer_text(); ?>
			</div>
			<div class="wpo-coupon__label">
				<?php $coupon->label(); ?>
			</div>
		</div>
		<div class="wpo-col-5 wpo-coupon__content-col">
			<?php $coupon->categories(); ?>
			<?php $coupon->title( 'wpo-coupon__title' ); ?>
			<div class="wpo-coupon__content">
				<?php $coupon->content(); ?>
			</div>
		</div>
		<div class="wpo-col-3 wpo-coupon__button-col">
			<?php $coupon->button(); ?>
			<?php if ( $coupon->show_expiration_date() ) : ?>
				<div class="wpo-coupon__expiration">
					<?php $coupon->expiration(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
