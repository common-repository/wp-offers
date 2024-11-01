<?php
/**
 * Coupons Template.
 *
 * List of coupons will show by this template.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

?>

<?php if ( $coupon_query->have_posts() ) : ?>
<div class="wpo-coupons-container">
	<div class="wpo-coupons wpo-coupons--cols-<?php echo esc_attr( $columns ); ?>">
		<?php
		while ( $coupon_query->have_posts() ) {
			$coupon_query->the_post();
			wp_offers_coupon( get_the_ID(), $template );
		}
		?>
	</div>
	<?php if ( $show_pagination ) : ?>
		<div class="wpo-coupons__pagination">
			<?php wp_offers_pagination( $coupon_query ); ?>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>
