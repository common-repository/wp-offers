<?php
/**
 * Coupon class file.
 *
 * @package    WPOffers
 * @author     KitThemes (https://www.kitthemes.com/)
 * @copyright  Copyright (c) 2020, KitThemes
 * @since      1.0.0
 */

namespace WPOffers;

/**
 * Coupon.
 *
 * Get/Manage all information and render methods of Coupon.
 *
 * @since 1.0.0
 */
class Coupon {
	/**
	 * ID.
	 *
	 * Coupon post ID.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string|int
	 */
	public $id = 0;

	/**
	 * Data.
	 *
	 * Coupon data.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * Category Taxonomy.
	 *
	 * Category taxonomy name/key.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $tax_category = 'wpo-category';

	/**
	 * Store Taxonomy.
	 *
	 * Store taxonomy name/key.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $tax_store = 'wpo-store';

	/**
	 * Constructor Method for coupon
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string|int $post_id Coupon post ID.
	 *
	 * @return void
	 */
	public function __construct( $post_id ) {
		$this->id = $post_id;

		$stores = get_the_terms( $post_id, $this->tax_store );

		$data = array(
			'id'           => $post_id,
			'title'        => get_the_title( $post_id ),
			'url'          => get_the_permalink( $post_id ),
			'content'      => get_post_meta( $post_id, 'coupon_desc', true ),
			'type'         => get_post_meta( $post_id, 'coupon_type', true ),
			'code'         => get_post_meta( $post_id, 'coupon_code', true ),
			'btn_text'     => get_post_meta( $post_id, 'coupon_btn_text', true ),
			'image'        => get_post_meta( $post_id, 'coupon_image', true ),
			'link'         => get_post_meta( $post_id, 'coupon_link', true ),
			'text'         => get_post_meta( $post_id, 'coupon_text', true ),
			'expiration'   => get_post_meta( $post_id, 'coupon_expiration', true ),
			'template'     => get_post_meta( $post_id, 'coupon_tmpl', true ),
			'categories'   => get_the_terms( $post_id, $this->tax_category ),
			'store'        => ( false !== $stores && ! is_wp_error( $stores ) && \count( $stores ) ) ? $stores[0] : false,
			'thumbnail_id' => get_post_thumbnail_id( $post_id ),
		);

		/**
		 * Filters the data of coupon.
		 *
		 * @since 1.2.0
		 *
		 * @param array $data All data of coupon as array.
		 * @param integer $post_id Coupon id.
		 */
		$this->data = apply_filters( 'wp_offers_coupon_data', $data, $post_id );
	}

	/**
	 * Get title
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_title() {
		return isset( $this->data['title'] ) ? $this->data['title'] : '';
	}

	/**
	 * Get URL
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_url() {
		return isset( $this->data['url'] ) ? $this->data['url'] : '';
	}

	/**
	 * Get Link
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_link() {
		$link  = '#';
		$store = $this->get_store();
		if ( ! empty( $this->data['link'] ) ) {
			$link = $this->data['link'];
		} elseif ( $store ) {
			$store_url = get_term_meta( $store->term_id, 'store_url', true );

			if ( ! empty( $store_url ) ) {
				$link = $store_url;
			}
		}
		return $link;
	}

	/**
	 * Get title
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $class Coupon title class.
	 * @param string $tag   Coupon title tag.
	 *
	 * @return void
	 */
	public function title( $class = '', $tag = '' ) {
		$url = $this->get_link();

		if ( empty( $tag ) ) {
			$tag = get_option( 'wpo_coupon_title_tag', 'h2' );
		}
		$target        = get_option( 'wpo_open_link_target', '_blank' );
		$link_in_title = get_option( 'wpo_link_in_title_tag', false );
		?>
		<<?php echo esc_html( $tag ); ?> class="<?php echo esc_attr( $class ); ?>">
			<?php if ( ! empty( $url ) && '#' !== $url && ! $link_in_title ) : ?>
				<a href="<?php echo esc_url( $url ); ?>"  target="<?php echo esc_attr( $target ); ?>">
			<?php endif; ?>
				<?php echo esc_html( $this->get_title() ); ?>
			<?php if ( ! empty( $url ) && '#' !== $url && ! $link_in_title ) : ?>
				</a>
			<?php endif; ?>
		</<?php echo esc_html( $tag ); ?>>
		<?php
	}

	/**
	 * Get Content
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_content() {
		return isset( $this->data['content'] ) ? $this->data['content'] : '';
	}

	/**
	 * Render Content
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function content() {
		echo wp_kses_post( wpautop( $this->get_content() ) );
	}

	/**
	 * Get Type
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_type() {
		return isset( $this->data['type'] ) ? $this->data['type'] : 'coupon';
	}

	/**
	 * Get Code
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_code() {
		return isset( $this->data['code'] ) ? $this->data['code'] : '';
	}

	/**
	 * Get Button Text
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_btn_text() {
		return ! empty( $this->data['btn_text'] ) ? $this->data['btn_text'] : get_option( 'wpo_deal_button_text', esc_html__( 'Get This Deal', 'wp-offers' ) );
	}

	/**
	 * Get Button
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_button() {
		$button_text = $this->get_btn_text();
		$coupon_type = $this->get_type();
		$button_url  = $this->get_link();
		$classes     = array( 'wpo-btn', 'wpo-btn-block' );
		$clipboard   = '';
		$data_url    = '';

		$onclick_copy  = ok_sanitize_boolean( get_option( 'wpo_onclick_copy', '1' ) );
		$onclick_print = ok_sanitize_boolean( get_option( 'wpo_onclick_print', '1' ) );

		if ( 'coupon' === $coupon_type ) {
			$button_text = $this->get_code();
			$classes[]   = 'wpo-btn-coupon';
			if ( $onclick_copy ) {
				$classes[] = 'wpo-clipboard';
				$clipboard = 'data-clipboard-text=' . $this->get_code() . '';
			}
		} elseif ( 'print' === $coupon_type ) {
			$button_text = get_option( 'wpo_printable_button_text', esc_html__( 'Print This Coupon', 'wp-offers' ) );
			$button_url  = '#';
			$classes[]   = 'wpo-btn-deal';
			if ( $onclick_print ) {
				$classes[] = 'wpo-print';
				$data_url  = 'data-url="' . $this->get_image() . '"';
			}
		} else {
			$classes[] = 'wpo-btn-deal';
		}

		$classes = apply_filters( 'wp_offers_coupon_button_classes', $classes, $this->id, $coupon_type );

		$classes_string = \implode( ' ', $classes );

		$tooltip = $this->get_tooltip();

		$button_text = apply_filters( 'wp_offers_coupon_button_text', $button_text, $this->id, $coupon_type );
		$button_url  = apply_filters( 'wp_offers_coupon_button_url', $button_url, $this->id, $coupon_type );

		$target = 'print' === $coupon_type || '#' === $button_url ? '' : get_option( 'wpo_open_link_target', '_blank' );

		$target = apply_filters( 'wp_offers_coupon_button_target', $target, $this->id, $coupon_type );

		$button_html = '<a class="' . esc_attr( $classes_string ) . '" href="' . esc_url( $button_url ) . '" target="' . esc_attr( $target ) . '" ' . esc_attr( $clipboard ) . ' ' . esc_attr( $data_url ) . ' data-tippy-content="' . esc_attr( $tooltip ) . '">' . esc_html( $button_text ) . '</a>';

		$button_html = apply_filters(
			'wp_offers_coupon_button',
			$button_html,
			$this->id,
			array(
				'classes'     => $classes,
				'button_url'  => $button_url,
				'coupon_type' => $coupon_type,
				'target'      => $target,
				'clipboard'   => $clipboard,
				'data_url'    => $data_url,
				'tooltip'     => $tooltip,
				'button_text' => $button_text,
				'link'        => $this->get_link(),
			)
		);

		return $button_html;
	}

	/**
	 * Render Button
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function button() {
		$allowed_html = apply_filters(
			'wp_offers_button_kses',
			array(
				'a' => array(
					'class'               => array(),
					'href'                => array(),
					'target'              => array(),
					'data-clipboard-text' => array(),
					'data-url'            => array(),
					'data-tippy-content'  => array(),
				),
			)
		);
		echo wp_kses( $this->get_button(), $allowed_html );
	}

	/**
	 * Get Date Format
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_date_format() {
		return get_option( 'wpo_expiry_date_format', 'F j, Y' );
	}

	/**
	 * Get Expiration
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_expiration() {
		return ! empty( $this->data['expiration'] ) ? $this->data['expiration'] : '';
	}

	/**
	 * Render Expiration
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function expiration() {
		$expiration  = $this->get_expiration();
		$date_format = $this->get_date_format();

		if ( ! empty( $expiration ) ) {
			if ( \time() < \strtotime( $expiration ) ) {
				$text = get_option( 'wpo_before_expiry_date', esc_html__( 'Expires On', 'wp-offers' ) );
			} else {
				$text = get_option( 'wpo_after_expiry_date', esc_html__( 'Expired On', 'wp-offers' ) );
			}
			// translators: Expiration text, Expiration date.
			$expiration_date = sprintf( esc_html__( '%1$s %2$s', 'wp-offers' ), $text, \gmdate( $date_format, \strtotime( $expiration ) ) );
		} else {
			$expiration_date = get_option( 'wpo_no_expiry_date', esc_html__( 'On Going Offer', 'wp-offers' ) );
		}
		echo esc_html( $expiration_date );
	}

	/**
	 * Hide Expiration Date
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function show_expiration_date() {
		return ! get_option( 'wpo_hide_expiry_date', false );
	}

	/**
	 * Get Offer Text
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_offer_text() {
		return ! empty( $this->data['text'] ) ? $this->data['text'] : '';
	}

	/**
	 * Render Offer Text
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function offer_text() {
		echo esc_html( $this->get_offer_text() );
	}

	/**
	 * Get Image
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_image() {
		return ! empty( $this->data['image'] ) ? $this->data['image'] : '';
	}

	/**
	 * Get Label
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_label() {
		$coupon_type = $this->get_type();
		$label       = get_option( 'wpo_coupon_label', esc_html__( 'Coupon', 'wp-offers' ) );

		if ( 'print' === $coupon_type ) {
			$label = get_option( 'wpo_printable_label', esc_html__( 'Coupon', 'wp-offers' ) );
		} elseif ( 'deal' === $coupon_type ) {
			$label = get_option( 'wpo_deal_label', esc_html__( 'Deal', 'wp-offers' ) );
		}

		return $label;
	}

	/**
	 * Render Label
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function label() {
		$label = $this->get_label();
		echo esc_html( $label );
	}

	/**
	 * Get Categories
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_categories() {
		return isset( $this->data['categories'] ) ? $this->data['categories'] : array();
	}

	/**
	 * Get Store
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool|WP_Term
	 */
	public function get_store() {
		return isset( $this->data['store'] ) ? $this->data['store'] : false;
	}

	/**
	 * Render Categories
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $sep Separator of categories. Default ', '.
	 *
	 * @return void
	 */
	public function categories( $sep = ', ' ) {
		$categories = $this->get_categories();

		$category_object = get_taxonomy( $this->tax_category );

		$categories_html = array();

		if ( \is_array( $categories ) && \count( $categories ) ) {
			foreach ( $categories as $category ) {
				if ( $category_object->publicly_queryable ) {
					$categories_html[] = sprintf( '<a href="%s">%s</a>', get_term_link( $category, $this->tax_category ), $category->name );
				} else {
					$categories_html[] = $category->name;
				}
			}
		}

		echo wp_kses(
			\implode( $sep, $categories_html ),
			array(
				'a' => array(
					'href' => array(),
				),
			)
		);
	}

	/**
	 * Render Store
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function store() {
		$store = $this->get_store();

		$store_object = get_taxonomy( $this->tax_store );

		$store_html = $store_object->publicly_queryable ? sprintf( '<a href="%s">%s</a>', get_term_link( $store, $this->tax_store ), $store->name ) : $store->name;

		echo wp_kses(
			$store_html,
			array(
				'a' => array(
					'href' => array(),
				),
			)
		);
	}

	/**
	 * Get Tooltip
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_tooltip() {
		$coupon_type = $this->get_type();
		$tooltip     = get_option( 'wpo_coupon_tooltip_text', __( 'Click to Copy This Coupon', 'wp-offers' ) );

		if ( 'print' === $coupon_type ) {
			$tooltip = get_option( 'wpo_printable_button_tooltip_text', esc_html__( 'Click Here To Print This Coupon', 'wp-offers' ) );
		} elseif ( 'deal' === $coupon_type ) {
			$tooltip = get_option( 'wpo_deal_button_tooltip_text', esc_html__( 'Click Here To Get This Deal', 'wp-offers' ) );
		}

		return $tooltip;
	}

	/**
	 * Can show this coupon?
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function can_show() {
		$status = get_post_status( $this->id );

		if ( 'publish' === $status ) {
			return true;
		}

		return false;
	}

	/**
	 * Thumbnail.
	 *
	 * Print coupon thumbnail image HTML.
	 *
	 * @param string $size Thumbnail size.
	 *
	 * @return void
	 */
	public function thumbnail( $size = 'wpo_thumbnail' ) {
		$thumbnail_id = isset( $this->data['thumbnail_id'] ) ? $this->data['thumbnail_id'] : '';
		$alt_text     = '';

		if ( ! empty( $thumbnail_id ) ) {
			$thumbnail = wp_get_attachment_image_url( $thumbnail_id, $size );
			$alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		}

		if ( empty( $thumbnail ) ) {
			$thumbnail = WP_OFFERS_URL . 'assets/images/wp-offers.svg';
		}

		echo '<img src="' . esc_url( $thumbnail ) . '" alt="' . esc_url( $alt_text ) . '" />';
	}

	/**
	 * Get Template ID.
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_template_id() {
		return ! empty( $this->data['template'] ) ? $this->data['template'] : 'default';
	}
}
