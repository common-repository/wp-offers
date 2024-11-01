<?php
/**
 * Options View.
 *
 * It will render HTML of option page.
 *
 * @package    OptionsKit
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2019, KitThemes
 * @since      1.0.0
 */

?>
<div class="wrap">
	<div id="settings-view">
		<div class="options-kit-wrapper">
			<div class="options-kit-header"></div>
			<div class="kf-panel">
				<div class="ok-notice-items">
					<h1 class="hidden"></h1>
				</div>
				<div class="kf-options"></div>
				<div class="kf-info">
					<?php
					if ( ! empty( $ok_sidebar ) ) {
						call_user_func( $ok_sidebar );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
