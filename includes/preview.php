<?php
/**
 * Preview
 *
 * Coupon preview canvas.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<style>
		html {
			margin-top: 0 !important;
			overflow: auto;
		}
		html,
		body,
		#wpo-preview {
			height: 100%;
		}

		#wpo-preview {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
		}

		.wpo-preview-wrap {
			width: 100%;
			max-width: 800px;
			margin: auto;
			padding: 30px;
			box-sizing: content-box;
		}
		.wpo-preview-placeholder {
			opacity: 0.5;
		}
		.wpo-preview-wrap .is-preview-loading {
			-webkit-animation: wpoPrevLoding 1.5s ease 0s infinite;
			-moz-animation: wpoPrevLoding 1.5s ease 0s infinite;
					animation: wpoPrevLoding 1.5s ease 0s infinite;
		}

		@-webkit-keyframes wpoPrevLoding{
			0% {
				opacity: 1;
			}
			50% {
				opacity: 0.5;
			}
			100% {
				opacity: 1;
			}
		}

		@-moz-keyframes wpoPrevLoding{
			0% {
				opacity: 1;
			}
			50% {
				opacity: 0.5;
			}
			100% {
				opacity: 1;
			}
		}

		@keyframes wpoPrevLoding{
			0% {
				opacity: 1;
			}
			50% {
				opacity: 0.5;
			}
			100% {
				opacity: 1;
			}
		}
	</style>
</head>
<body <?php body_class(); ?>>
	<div id="wpo-preview"></div>

	<?php wp_footer(); ?>
	<script>
	document.addEventListener( 'click', function( e ) {
		// loop parent nodes from the target to the delegation node
		for (var target = e.target; target && target != this; target = target.parentNode) {
			if (target.matches('a')) {
				e.preventDefault();
				break;
			}
		}
	}, false);
	</script>
</body>
</html>
