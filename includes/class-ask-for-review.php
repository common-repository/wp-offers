<?php
/**
 * Ask for review class file
 *
 * WP Offers ask for review class file.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.1.0
 */

namespace WPOffers;

/**
 * Ask For Review Class
 *
 * WP Offers ask for review class.
 *
 * @since 1.1.0
 */
class Ask_For_Review {
	/**
	 * Instance.
	 *
	 * Holds the ask for review class instance.
	 *
	 * @since 1.1.0
	 * @access public
	 * @static
	 *
	 * @var Ask_For_Review
	 */
	public static $instance = null;

	/**
	 * Args.
	 *
	 * Holds arguments for `Ask_For_Review` class.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * Clone.
	 *
	 * Disable class cloning and throw an error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object. Therefore, we don't want the object to be cloned.
	 *
	 * @access public
	 * @since 1.1.0
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'wp-offers' ), '1.0.0' );
	}

	/**
	 * Wakeup.
	 *
	 * Disable unserializing of the class.
	 *
	 * @access public
	 * @since 1.1.0
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'wp-offers' ), '1.0.0' );
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @since 1.1.0
	 * @access public
	 * @static
	 *
	 * @param array $args Arguments.
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance( $args ) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $args );
		}

		return self::$instance;
	}

	/**
	 * Constructor Method for `Ask_For_Review` class
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $args Arguments.
	 *
	 * @return void
	 */
	public function __construct( $args ) {
		$this->args = $args;
		if ( empty( $args['plugin_slug'] ) || empty( $args['review_link'] ) ) {
			return;
		}
		add_action( 'admin_notices', array( $this, 'admin_message' ) );
		add_action( 'admin_head', array( $this, 'status_update' ) );
	}

	/**
	 * Admin Message
	 *
	 * This function will show admin message.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return void
	 */
	public function admin_message() {
		if ( ! $this->can_show() ) {
			return;
		}
		?>
		<div class="notice notice-info is-dismissible">
			<?php if ( ! empty( $this->args['message'] ) ) : ?>
				<p style="font-size: 17px;"><?php echo wp_kses( $this->args['message'], array( 'strong' => array() ) ); ?></p>
			<?php endif; ?>
			<p>
				<a href="<?php echo esc_url_raw( $this->args['review_link'] ); ?>" class="button" target="_blank"><?php esc_html_e( 'Leave a review', 'wp-offers' ); ?></a>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $this->args['plugin_slug'] . '-review', 'later' ), $this->args['plugin_slug'] . '-status-' . get_current_user_id() ) ); ?>" class="button"><?php esc_html_e( 'Maybe later', 'wp-offers' ); ?></a>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $this->args['plugin_slug'] . '-review', 'done' ), $this->args['plugin_slug'] . '-status-' . get_current_user_id() ) ); ?>" class="button"><?php esc_html_e( 'I already did', 'wp-offers' ); ?></a>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $this->args['plugin_slug'] . '-review', 'never' ), $this->args['plugin_slug'] . '-status-' . get_current_user_id() ) ); ?>" class="button-link"><?php esc_html_e( 'Never', 'wp-offers' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Can Show?
	 *
	 * It will detect can show the admin message or not.
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @return bool
	 */
	private function can_show() {
		if ( $this->posts_check() ) {
			return false;
		}
		$status = get_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status', true );
		$status = intval( $status );
		if ( 1 === $status ) {
			return false;
		} elseif ( 2 === $status || 3 === $status ) {
			$time = get_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status-last', true );
			$time = intval( $time );

			if ( $time > time() ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Posts Check
	 *
	 * @since 1.1.0
	 * @access private
	 *
	 * @return bool
	 */
	public function posts_check() {
		$coupons = get_posts(
			array(
				'post_type'   => 'wpo_coupon',
				'numberposts' => 15,
				'post_status' => 'publish',
			)
		);

		if ( is_array( $coupons ) && count( $coupons ) > 10 ) {
			return false;
		}

		return true;
	}

	/**
	 * Staus Update
	 *
	 * Update message status
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return void
	 */
	public function status_update() {
		if ( isset( $_GET[ $this->args['plugin_slug'] . '-review' ] ) && check_admin_referer( $this->args['plugin_slug'] . '-status-' . get_current_user_id() ) ) {
			if ( 'done' === $_GET[ $this->args['plugin_slug'] . '-review' ] ) {
				update_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status', 1 );
			} elseif ( 'later' === $_GET[ $this->args['plugin_slug'] . '-review' ] ) {
				update_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status', 2 );
				update_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status-last', time() + ( 30 * 24 * 60 * 60 ) );
			} elseif ( 'never' === $_GET[ $this->args['plugin_slug'] . '-review' ] ) {
				update_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status', 3 );
				update_user_meta( get_current_user_id(), $this->args['plugin_slug'] . '-review-status-last', time() + ( 365 * 24 * 60 * 60 ) );
			}
		}
	}
}

Ask_For_Review::instance(
	array(
		'message'     => 'Hi, you have created 10+ coupons and deals with <strong>WP Offers</strong> – that’s awesome! If you have a moment, please help us spread the word by reviewing the plugin on WordPress.',
		'plugin_slug' => 'wp-offers',
		'review_link' => 'https://wordpress.org/support/plugin/wp-offers/reviews/#new-post',
	)
);
