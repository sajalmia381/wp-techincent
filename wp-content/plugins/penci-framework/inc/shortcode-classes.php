<?php
class WPBakeryShortCode_Penci_Shortcodes extends WPBakeryShortCode{
	function __construct( $settings ) {
		parent::__construct( $settings );
	}

	/**
	 * @param $param
	 * @param $value
	 *
	 * vc_filter: vc_wpbakeryshortcode_single_param_html_holder_value - hook to override param value (param type and etc is available in args)
	 *
	 * @return string
	 */
	public function singleParamHtmlHolder( $param, $value ) {
		$value = apply_filters( 'vc_wpbakeryshortcode_single_param_html_holder_value', $value, $param, $this->settings, $this->atts );
		$output = '';
		// Compatibility fixes
		$old_names = array(
			'yellow_message',
			'blue_message',
			'green_message',
			'button_green',
			'button_grey',
			'button_yellow',
			'button_blue',
			'button_red',
			'button_orange',
		);
		$new_names = array(
			'alert-block',
			'alert-info',
			'alert-success',
			'btn-success',
			'btn',
			'btn-info',
			'btn-primary',
			'btn-danger',
			'btn-warning',
		);
		$value = str_ireplace( $old_names, $new_names, $value );
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type = isset( $param['type'] ) ? $param['type'] : '';
		$class = isset( $param['class'] ) ? $param['class'] : '';

		if ( 'penci_image_select' === $param['type'] && 'style' === $param_name ) {
		} elseif ( ! empty( $param['holder'] ) ) {
			if ( 'input' === $param['holder'] ) {
				$output .= '<' . $param['holder'] . ' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';
			} elseif ( in_array( $param['holder'], array(
				'img',
				'iframe',
			) ) ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="' . $value . '">';
			} elseif ( 'hidden' !== $param['holder'] ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
			}
		}
		if ( ! empty( $param['admin_label'] ) && true === $param['admin_label'] ) {

			$pre_param_heading = $param['heading'];

			if( false !== strpos(  $pre_param_heading, 'Block title' ) ){
				$pre_param_heading = 'Title';
			}

			if( false !== strpos(  $pre_param_heading, 'Select Style' ) ){
				$pre_param_heading = 'Style';
			}


			if( false !== strpos(  $pre_param_heading, 'Slider Auto Time (at x seconds)' ) ){
				$pre_param_heading = 'Auto time';
			}

			if( false !== strpos(  $pre_param_heading, 'Slider Speed (at x seconds)' ) ){
				$pre_param_heading = 'Speed';
			}

			$output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . $pre_param_heading . '</label>: ' . $value . '</span>';
		}

		return $output;
	}
}

class WPBakeryShortCode_Penci_Block_1 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_2 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_3 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_4 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_5 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_6 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_7 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_8 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_9 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_10 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_11 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_12 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_13 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_14 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_15 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_16 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_17 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_18 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_19 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_20 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_21 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_22 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_23 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_24 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_25 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_26 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_27 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_28 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_29 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_30 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_31 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_32 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_33 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_34 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_35 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Block_36 extends WPBakeryShortCode_Penci_Shortcodes {

	function __construct( $settings ) {
		parent::__construct( $settings );

		add_filter( 'penci_review_piechart_border', array( $this, 'penci_block_36_review_piechart_border' ) );

	}

	public function penci_block_36_review_piechart_border( $color ){
		$atts = $this->getAtts();
		return ( isset( $atts['review_color'] ) && '#3f51b5' != $atts['review_color'] ) ? $atts['review_color'] : $color;
	}
}

class WPBakeryShortCode_Penci_Block_37 extends WPBakeryShortCode_Penci_Shortcodes {

	function __construct( $settings ) {
		parent::__construct( $settings );
	}

	public function get_price_html( $product, $deprecated = '' ) {

		if( empty( $product ) ) {
			return '';
		}
		if ( '' === $product->get_price() ) {
			$price = apply_filters( 'woocommerce_empty_price_html', '', $product );
		} elseif ( $product->is_on_sale() ) {
			$price = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
		} else {
			$price = wc_price( wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
		}

		return apply_filters( 'woocommerce_get_price_html', $price, $product );
	}
}

class WPBakeryShortCode_Penci_Block_38 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Blog_List extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Bos_Searchbox extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Vc_Button extends  WPBakeryShortCode  {
}

class WPBakeryShortCode_Penci_Grid_1 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_2 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_3 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_4 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_5 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_6 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_7 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_8 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_9 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_10 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_11 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_12 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_13 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Grid_14 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_News_Ticker extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Sliders extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Popular_Category extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Weather extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Authors_Box extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Authors_Box_2 extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Team_Members extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Instagram extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Image_Box extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Login_Form extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Register_Form extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Text_Block extends WPBakeryShortCode_Penci_Shortcodes {
	protected function outputTitle( $title ) {
		return '';
	}
}


class WPBakeryShortCode_Penci_Ad_Box extends WPBakeryShortCode {
	function __construct( $settings ) {
		parent::__construct( $settings );
	}


	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes
		$old_names = array();
		$new_names = array();
		$value = str_ireplace( $old_names, $new_names, $value );

		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type = isset( $param['type'] ) ? $param['type'] : '';
		$class = isset( $param['class'] ) ? $param['class'] : '';

		if ( 'attach_image' === $param['type'] && 'image' === $param_name ) {
			$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
			$element_icon = $this->settings( 'icon' );
			$img = wpb_getImageBySize( array(
				'attach_id' => (int) preg_replace( '/[^\d]/', '', $value ),
				'thumb_size' => 'thumbnail',
			) );
			$this->setSettings( 'logo', ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail vc_general vc_element-icon"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />' ) . '<span class="no_image_image vc_element-icon' . ( ! empty( $element_icon ) ? ' ' . $element_icon : '' ) . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '">' . __( 'Add image', 'penci-framework' ) . '</a>' );
			$output .= $this->outputTitleTrue( $this->settings['name'] );
		} elseif ( ! empty( $param['holder'] ) ) {
			if ( 'input' === $param['holder'] ) {
				$output .= '<' . $param['holder'] . ' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';
			} elseif ( in_array( $param['holder'], array( 'img', 'iframe' ) ) ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="' . $value . '">';
			} elseif ( 'hidden' !== $param['holder'] ) {
				$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
			}
		}

		if ( ! empty( $param['admin_label'] ) && true === $param['admin_label'] ) {
			$output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
		}

		return $output;
	}

	public function getImageSquareSize( $img_id, $img_size ) {
		if ( preg_match_all( '/(\d+)x(\d+)/', $img_size, $sizes ) ) {
			$exact_size = array(
				'width' => isset( $sizes[1][0] ) ? $sizes[1][0] : '0',
				'height' => isset( $sizes[2][0] ) ? $sizes[2][0] : '0',
			);
		} else {
			$image_downsize = image_downsize( $img_id, $img_size );
			$exact_size = array(
				'width' => $image_downsize[1],
				'height' => $image_downsize[2],
			);
		}
		$exact_size_int_w = (int) $exact_size['width'];
		$exact_size_int_h = (int) $exact_size['height'];
		if ( isset( $exact_size['width'] ) && $exact_size_int_w !== $exact_size_int_h ) {
			$img_size = $exact_size_int_w > $exact_size_int_h
				? $exact_size['height'] . 'x' . $exact_size['height']
				: $exact_size['width'] . 'x' . $exact_size['width'];
		}

		return $img_size;
	}

	protected function outputTitle( $title ) {
		return '';
	}

	protected function outputTitleTrue( $title ) {
		return '<h4 class="wpb_element_title">' . $title . ' ' . $this->settings( 'logo' ) . '</h4>';
	}
}

class WPBakeryShortCode_Penci_Social_Counter extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Recent_Review extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Mailchimp extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Image_Gallery extends WPBakeryShortCode {
	function __construct( $settings ) {
		parent::__construct( $settings );

		$this->shortcodeScripts();
	}

	public function shortcodeScripts() {
		wp_register_script( 'vc_grid-js-imagesloaded',
			vc_asset_url( 'lib/bower/imagesloaded/imagesloaded.pkgd.min.js' )
		);
	}

	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes
		$old_names  = array(
			'yellow_message',
			'blue_message',
			'green_message',
			'button_green',
			'button_grey',
			'button_yellow',
			'button_blue',
			'button_red',
			'button_orange',
		);
		$new_names  = array(
			'alert-block',
			'alert-info',
			'alert-success',
			'btn-success',
			'btn',
			'btn-info',
			'btn-primary',
			'btn-danger',
			'btn-warning',
		);
		$value      = str_ireplace( $old_names, $new_names, $value );
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type       = isset( $param['type'] ) ? $param['type'] : '';
		$class      = isset( $param['class'] ) ? $param['class'] : '';

		if ( isset( $param['holder'] ) && 'hidden' !== $param['holder'] ) {
			$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}
		if ( 'images' === $param_name ) {
			$images_ids = empty( $value ) ? array() : explode( ',', trim( $value ) );
			$output     .= '<ul class="attachment-thumbnails' . ( empty( $images_ids ) ? ' image-exists' : '' ) . '" data-name="' . $param_name . '">';
			foreach ( $images_ids as $image ) {
				$img    = wpb_getImageBySize( array( 'attach_id' => (int) $image, 'thumb_size' => 'thumbnail' ) );
				$output .= ( $img ? '<li>' . $img['thumbnail'] . '</li>' : '<li><img width="150" height="150" test="' . $image . '" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail" alt="" title="" /></li>' );
			}
			$output .= '</ul>';
			$output .= '<a href="#" class="column_edit_trigger' . ( ! empty( $images_ids ) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'penci-framework' ) . '</a>';

		}

		return $output;
	}
}

class WPBakeryShortCode_Penci_Block_Video extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Videos_Playlist extends WPBakeryShortCode_Penci_Shortcodes {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {
		wp_enqueue_style( 'mCustomScrollbar', get_template_directory_uri() . '/css/mCustomScrollbar.css', array(), PENCI_FW_VERSION );
	}

}
class WPBakeryShortCode_Penci_Pinterest extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Latest_Tweets extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Facebook_Page extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_About_Us extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Wp_Widget_Archives extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Wp_Widget_Calendar extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Wp_Widget_Custommenu extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Wp_Widget_Posts extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Wp_Widget_Recentcomments extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Wp_Widget_Search extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Wp_Widget_Tagcolud extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Fancy_Heading extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Info_Box extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Social_Media extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Advanced_Carousel extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Penci_Single_Video extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Opening_Hours extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Portfolio_Items extends WPBakeryShortCode_Penci_Shortcodes {}
class WPBakeryShortCode_Penci_Featured_Products extends WPBakeryShortCode_Penci_Shortcodes {
	/**
	 * Generate and return the transient name for this shortcode based on the query args.
	 *
	 * @since 3.3.0
	 * @return string
	 */
	protected function get_transient_name( $query_args ) {
		$transient_name = 'penci_product_loop' . substr( md5( wp_json_encode( $query_args ) .'featured_products' ), 28 );

		if ( 'rand' === $query_args['orderby'] ) {
			// When using rand, we'll cache a number of random queries and pull those to avoid querying rand on each page load.
			$rand_index      = rand( 0, max( 1, absint( apply_filters( 'woocommerce_product_query_max_rand_cache_count', 5 ) ) ) );
			$transient_name .= $rand_index;
		}

		$transient_name .= WC_Cache_Helper::get_transient_version( 'product_query' );

		return $transient_name;
	}

	/**
	 * Run the query and return an array of data, including queried ids and pagination information.
	 *
	 * @since  3.3.0
	 * @return object Object with the following props; ids, per_page, found_posts, max_num_pages, current_page
	 */
	protected function get_query_results( $query_args ) {
		$transient_name = $this->get_transient_name( $query_args );
		$cache          = get_transient( $transient_name );
		$results        = $cache ? $cache : false;

		if ( false === $results ) {
			$query = new WP_Query( $query_args );
			$results = wp_parse_id_list( $query->posts );

			if ( $cache ) {
				set_transient( $transient_name, $results, DAY_IN_SECONDS * 30 );
			}
		}
		// Remove ordering query arguments which may have been added by get_catalog_ordering_args.
		WC()->query->remove_ordering_args();

		wp_reset_postdata();

		return $results;
	}
}

class WPBakeryShortCode_Penci_Count_Down extends WPBakeryShortCode_Penci_Shortcodes {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {
		wp_enqueue_script( 'jquery.plugin', PENCI_ADDONS_URL . 'assets/js/jquery.plugin.min.js', array( 'jquery' ), '2.0.2', true );
		wp_enqueue_script( 'countdown', PENCI_ADDONS_URL . 'assets/js/jquery.countdown.min.js', array( 'jquery' ), '2.0.2', true );

	}
}

class WPBakeryShortCode_Penci_Counter_Up extends WPBakeryShortCode_Penci_Shortcodes {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {
		wp_enqueue_script( 'waypoints', PENCI_ADDONS_URL . 'assets/js/waypoints.min.js', array( 'jquery' ), '2.0.3', true );
		wp_enqueue_script( 'jquery.counterup', PENCI_ADDONS_URL . 'assets/js/jquery.counterup.min.js', array( 'jquery','waypoints' ), '1.0', true );
	}
}

class WPBakeryShortCode_Penci_Testimonails extends WPBakeryShortCode_Penci_Shortcodes {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {
		$font_family = 'Playfair+Display';
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( urlencode( $font_family ) ), '//fonts.googleapis.com/css?family=' . ( $font_family ) );

	}
}

class WPBakeryShortCode_Penci_Testimonail extends WPBakeryShortCode_Penci_Shortcodes {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {
		$font_family = 'Playfair+Display';
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( urlencode( $font_family ) ), '//fonts.googleapis.com/css?family=' . ( $font_family ) );

	}
}

class WPBakeryShortCode_Penci_Pricing_Item extends WPBakeryShortCode_Penci_Shortcodes {}

class WPBakeryShortCode_Penci_Progress_Bar extends WPBakeryShortCode_Penci_Shortcodes {
	public static function convertAttributesToNewProgressBar( $atts ) {
		if ( isset( $atts['values'] ) && strlen( $atts['values'] ) > 0 ) {
			$values = vc_param_group_parse_atts( $atts['values'] );
			if ( ! is_array( $values ) ) {
				$temp = explode( ',', $atts['values'] );
				$paramValues = array();
				foreach ( $temp as $value ) {
					$data = explode( '|', $value );
					$colorIndex = 2;
					$newLine = array();
					$newLine['value'] = isset( $data[0] ) ? $data[0] : 0;
					$newLine['label'] = isset( $data[1] ) ? $data[1] : '';
					if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
						$colorIndex += 1;
						$newLine['value'] = (float) str_replace( '%', '', $data[1] );
						$newLine['label'] = isset( $data[2] ) ? $data[2] : '';
					}
					if ( isset( $data[ $colorIndex ] ) ) {
						$newLine['customcolor'] = $data[ $colorIndex ];
					}
					$paramValues[] = $newLine;
				}
				$atts['values'] = urlencode( json_encode( $paramValues ) );
			}
		}

		return $atts;
	}
}

class WPBakeryShortCode_Penci_Map extends WPBakeryShortCode {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {

		$api = penci_get_theme_mod( 'penci_map_api_key' );

		if( ! $api ) {
			$api = 'AIzaSyBzbXkmI1iibQGKhyS_YbIDEyDEfBK5_bI';
		}

		$http = Penci_Framework_Helper::get_http();

		wp_register_script( 'google-map', esc_url( $http . 'maps.google.com/maps/api/js?key=' . esc_attr( $api ) ), array(), '', true );
		wp_enqueue_script( 'penci-map-js', PENCI_ADDONS_URL . 'assets/js/map.js', array( 'jquery','google-map' ), PENCI_FW_VERSION, true );
	}
}

class WPBakeryShortCode_Penci_Container extends WPBakeryShortCode {
	protected $predefined_atts = array(
		'el_class' => '',
	);

	public $nonDraggableClass = 'vc-non-draggable-row';

	/**
	 * @param $settings
	 */
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->shortcodeScripts();
	}

	protected function shortcodeScripts() {
		wp_register_script( 'vc_jquery_skrollr_js', vc_asset_url( 'lib/bower/skrollr/dist/skrollr.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		wp_register_script( 'vc_youtube_iframe_api_js', '//www.youtube.com/iframe_api', array(), WPB_VC_VERSION, true );
	}

	public function template( $content = '' ) {
		return $this->contentAdmin( $this->atts );
	}

	/**
	 * This returs block controls
	 */
	public function getLayoutsControl() {
		$vc_row_layouts = array(
			array(
				'cells' => '11',
				'mask' => '12',
				'title' => 'Full width',
				'icon_class' => '1-1',
			),
			array(
				'cells' => '14_12_14',
				'mask' => '313',
				'title' => 'Sidebar + Content + Sidebar',
				'icon_class' => '1-4_1-2_1-4',
			),
			array(
				'cells' => '23_13',
				'mask' => '29',
				'title' => 'Content + Sidebar',
				'icon_class' => '2-3_1-3',
			),
			array(
				'cells' => '13_23',
				'mask' => '29',
				'title' => 'Sidebar + Content',
				'icon_class' => '2-3_1-3',
			),
			array(
				'cells' => '12_12',
				'mask' => '26',
				'title' => '1/2 + 1/2',
				'icon_class' => '1-2_1-2',
			),
			array(
				'cells' => '13_13_13',
				'mask' => '312',
				'title' => '1/3 + 1/3 + 1/3',
				'icon_class' => '1-3_1-3_1-3',
			),
			array(
				'cells' => '12_14_14',
				'mask' => '313',
				'title' => 'Content + Sidebar + Sidebar',
				'icon_class' => '1-2_1-4_1-4',
			),
			array(
				'cells' => '14_14_12',
				'mask' => '313',
				'title' => 'Sidebar + Sidebar + Content',
				'icon_class' => '1-4_1-4_1-2',
			),
			array(
				'cells' => '14_14_14_14',
				'mask' => '420',
				'title' => '1/4 + 1/4 + 1/4 + 1/4',
				'icon_class' => '1-4_1-4_1-4_1-4',
			),
		);
		$controls_layout = '<span class="vc_row_layouts vc_control">';
		foreach ( $vc_row_layouts as $layout ) {
			$controls_layout .= '<a class="vc_control-set-column penci_set_layout cell-' .  $layout['cells'] . ' " data-cells="' . $layout['cells'] . '" data-cells-mask="' . $layout['mask'] . '" data-hint="' . $layout['title'] . '"><i class="vc-composer-icon vc-c-icon-' . $layout['icon_class'] . '"></i></a> ';
		}
		$controls_layout .= '</span>';

		return $controls_layout;
	}


	public function getColumnControls( $controls, $extended_css = '' ) {
		$output       = '<div class="penci_container_controls vc_controls vc_controls-row controls_row vc_clearfix">';
		$controls_end = '</div>';

		$icon = $this->settings( 'icon' );
		$img_icon = $icon ? '<img  src="' . $icon . '" alt="icon"/>' : '';

		$controls_layout = $this->getLayoutsControl();
		$controls_add = '';
		$controls_title  = '<span class="wpb_element_title"> '.$img_icon . '</span>';
		$controls_move   = '<a class="vc_control column_move vc_column-move" href="#" title="' . __( 'Drag row to reorder', 'penci-framework' ) . '" data-vc-control="move"><i class="vc-composer-icon vc-c-icon-dragndrop"></i>' . $controls_title . '</a>';
		$controls_delete = '<a class="vc_control column_delete vc_column-delete" href="#" title="' . __( 'Delete this row', 'penci-framework' ) . '" data-vc-control="delete"><i class="vc-composer-icon vc-c-icon-delete_empty"></i></a>';
		$controls_edit   = ' <a class="vc_control column_edit vc_column-edit" href="#" title="' . __( 'Edit this row', 'penci-framework' ) . '" data-vc-control="edit"><i class="vc-composer-icon vc-c-icon-mode_edit"></i></a>';
		$controls_clone  = ' <a class="vc_control column_clone vc_column-clone" href="#" title="' . __( 'Clone this row', 'penci-framework' ) . '" data-vc-control="clone"><i class="vc-composer-icon vc-c-icon-content_copy"></i></a>';
		$controls_toggle = ' <a class="vc_control column_toggle vc_column-toggle" href="#" title="' . __( 'Toggle row', 'penci-framework' ) . '" data-vc-control="toggle"><i class="vc-composer-icon vc-c-icon-arrow_drop_down"></i></a>';
		$editAccess      = vc_user_access_check_shortcode_edit( $this->shortcode );
		$allAccess       = vc_user_access_check_shortcode_all( $this->shortcode );


		if ( is_array( $controls ) && ! empty( $controls ) ) {

			foreach ( $controls as $control ) {
				$control_var = 'controls_' . $control;
				if ( ( $editAccess && 'edit' == $control ) || $allAccess ) {
					if ( isset( ${$control_var} ) ) {
						$output .= ${$control_var};
					}
				}
			}
			$output .= $controls_end;
		} elseif ( is_string( $controls ) ) {
			$control_var = 'controls_' . $controls;
			if ( ( $editAccess && 'edit' === $controls ) || $allAccess ) {
				if ( isset( ${$control_var} ) ) {
					$output .= ${$control_var} . $controls_end;
				}
			}
		} else {
			$row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
			if ( $allAccess ) {
				$row_edit_clone_delete .= $controls_delete . $controls_clone . $controls_edit;
			} elseif ( $editAccess ) {
				$row_edit_clone_delete .= $controls_edit;
			}
			$row_edit_clone_delete .= $controls_toggle;
			$row_edit_clone_delete .= '</span>';

			if ( $allAccess ) {
				$output .=  $controls_move . $controls_layout . $controls_add . $row_edit_clone_delete . $controls_end;
			} elseif ( $editAccess ) {
				$output .= $row_edit_clone_delete . $controls_end;
			} else {
				$output .= $row_edit_clone_delete . $controls_end;
			}
		}

		return $output;
	}

	public function contentAdmin( $atts, $content = null ) {
		$width = $el_class = '';
		$atts  = shortcode_atts( $this->predefined_atts, $atts );

		extract( $atts );

		$output = '';
		$count_width = $width && is_array( $width )  ? count( $width ) : 1;
		$column_controls = $this->getColumnControls( $this->settings( 'controls' ) );

		for ( $i = 0; $i < $count_width; $i ++ ) {
			$output .= '<div data-manh="" data-element_type="' . $this->settings['base'] . '" class="' . $this->cssAdminClass() . '">';
			$output .= str_replace( '%column_size%', 1, $column_controls );
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div class="vc_row vc_row-fluid wpb_row_container vc_container_for_children">';
			if ( '' === $content && ! empty( $this->settings['default_content_in_template'] ) ) {
				$output .= do_shortcode( shortcode_unautop( $this->settings['default_content_in_template'] ) );
			} else {
				$output .= do_shortcode( shortcode_unautop( $content ) );

			}
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					if ( ! isset( $param['param_name'] ) ) {
						continue;
					}
					$param_value = isset( $atts[ $param['param_name'] ] ) ? $atts[ $param['param_name'] ] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key   = key( $param_value );
						$param_value = $param_value[ $first_key ];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	public function cssAdminClass() {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? ' wpb_sortable' : ' ' . $this->nonDraggableClass );

		return 'wpb_' . $this->settings['base'] . $sortable . '' . ( ! empty( $this->settings['class'] ) ? ' ' . $this->settings['class'] : '' );
	}

	/**
	 * @deprecated - due to it is not used anywhere? 4.5
	 * @typo Bock - Block
	 * @return string
	 */
	public function customAdminBockParams() {
		// _deprecated_function( 'WPBakeryShortCode_VC_Row::customAdminBockParams', '4.5 (will be removed in 4.10)' );

		return '';
	}

	/**
	 * @deprecated 4.5
	 *
	 * @param string $bg_image
	 * @param string $bg_color
	 * @param string $bg_image_repeat
	 * @param string $font_color
	 * @param string $padding
	 * @param string $margin_bottom
	 *
	 * @return string
	 */
	public function buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
		// _deprecated_function( 'WPBakeryShortCode_VC_Row::buildStyle', '4.5 (will be removed in 4.10)' );

		$has_image = false;
		$style     = '';
		if ( (int) $bg_image > 0 && false !== ( $image_url = wp_get_attachment_url( $bg_image ) ) ) {
			$has_image = true;
			$style .= 'background-image: url(' . $image_url . ');';
		}
		if ( ! empty( $bg_color ) ) {
			$style .= vc_get_css_color( 'background-color', $bg_color );
		}
		if ( ! empty( $bg_image_repeat ) && $has_image ) {
			if ( 'cover' === $bg_image_repeat ) {
				$style .= 'background-repeat:no-repeat;background-size: cover;';
			} elseif ( 'contain' === $bg_image_repeat ) {
				$style .= 'background-repeat:no-repeat;background-size: contain;';
			} elseif ( 'no-repeat' === $bg_image_repeat ) {
				$style .= 'background-repeat: no-repeat;';
			}
		}
		if ( ! empty( $font_color ) ) {
			$style .= vc_get_css_color( 'color', $font_color );
		}
		if ( '' !== $padding ) {
			$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
		}
		if ( '' !== $margin_bottom ) {
			$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
		}

		return empty( $style ) ? '' : ' style="' . esc_attr( $style ) . '"';
	}
}

class WPBakeryShortCode_Penci_Container_Inner extends WPBakeryShortCode {
	protected $predefined_atts = array(
		'el_class' => '',
	);

	public $nonDraggableClass = 'vc-non-draggable-row';

	/**
	 * @param $settings
	 */
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->shortcodeScripts();
	}

	protected function shortcodeScripts() {
		wp_register_script( 'vc_jquery_skrollr_js', vc_asset_url( 'lib/bower/skrollr/dist/skrollr.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		wp_register_script( 'vc_youtube_iframe_api_js', '//www.youtube.com/iframe_api', array(), WPB_VC_VERSION, true );
	}

	public function template( $content = '' ) {
		return $this->contentAdmin( $this->atts );
	}

	/**
	 * This returs block controls
	 */
	public function getLayoutsControl() {
		$vc_row_layouts = array(
			array(
				'cells' => '12_12',
				'mask' => '26',
				'title' => '1/2 + 1/2',
				'icon_class' => '1-2_1-2',
			),
			array(
				'cells' => '23_13',
				'mask' => '29',
				'title' => 'Content + Sidebar',
				'icon_class' => '2-3_1-3',
			),
			array(
				'cells' => '13_23',
				'mask' => '29',
				'title' => 'Sidebar + Content',
				'icon_class' => '2-3_1-3',
			),
		);
		$controls_layout = '<span class="vc_row_layouts vc_control">';
		foreach ( $vc_row_layouts as $layout ) {
			$controls_layout .= '<a class="vc_control-set-column penci_set_layout cell-' .  $layout['cells'] . ' " data-cells="' . $layout['cells'] . '" data-cells-mask="' . $layout['mask'] . '" data-hint="' . $layout['title'] . '"><i class="vc-composer-icon vc-c-icon-' . $layout['icon_class'] . '"></i></a> ';
		}
		$controls_layout .= '</span>';

		return $controls_layout;
	}


	public function getColumnControls( $controls, $extended_css = '' ) {
		$output       = '<div class="penci_container_controls vc_controls vc_controls-row controls_row vc_clearfix">';
		$controls_end = '</div>';

		$icon = $this->settings( 'icon' );
		$img_icon = $icon ? '<img src="' . $icon . '" alt="icon"/>' : '';

		$controls_layout = $this->getLayoutsControl();
		$controls_add = '';
		$controls_title  = '<span class="wpb_element_title"> '.$img_icon . '</span>';
		$controls_move   = '<a class="vc_control column_move vc_column-move" href="#" title="' . __( 'Drag row to reorder', 'penci-framework' ) . '" data-vc-control="move"><i class="vc-composer-icon vc-c-icon-dragndrop"></i>' . $controls_title . '</a>';
		$controls_delete = '<a class="vc_control column_delete vc_column-delete" href="#" title="' . __( 'Delete this row', 'penci-framework' ) . '" data-vc-control="delete"><i class="vc-composer-icon vc-c-icon-delete_empty"></i></a>';
		$controls_edit   = ' <a class="vc_control column_edit vc_column-edit" href="#" title="' . __( 'Edit this row', 'penci-framework' ) . '" data-vc-control="edit"><i class="vc-composer-icon vc-c-icon-mode_edit"></i></a>';
		$controls_clone  = ' <a class="vc_control column_clone vc_column-clone" href="#" title="' . __( 'Clone this row', 'penci-framework' ) . '" data-vc-control="clone"><i class="vc-composer-icon vc-c-icon-content_copy"></i></a>';
		$controls_toggle = ' <a class="vc_control column_toggle vc_column-toggle" href="#" title="' . __( 'Toggle row', 'penci-framework' ) . '" data-vc-control="toggle"><i class="vc-composer-icon vc-c-icon-arrow_drop_down"></i></a>';
		$editAccess      = vc_user_access_check_shortcode_edit( $this->shortcode );
		$allAccess       = vc_user_access_check_shortcode_all( $this->shortcode );


		if ( is_array( $controls ) && ! empty( $controls ) ) {

			foreach ( $controls as $control ) {
				$control_var = 'controls_' . $control;
				if ( ( $editAccess && 'edit' == $control ) || $allAccess ) {
					if ( isset( ${$control_var} ) ) {
						$output .= ${$control_var};
					}
				}
			}
			$output .= $controls_end;
		} elseif ( is_string( $controls ) ) {
			$control_var = 'controls_' . $controls;
			if ( ( $editAccess && 'edit' === $controls ) || $allAccess ) {
				if ( isset( ${$control_var} ) ) {
					$output .= ${$control_var} . $controls_end;
				}
			}
		} else {
			$row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
			if ( $allAccess ) {
				$row_edit_clone_delete .= $controls_delete . $controls_clone . $controls_edit;
			} elseif ( $editAccess ) {
				$row_edit_clone_delete .= $controls_edit;
			}
			$row_edit_clone_delete .= $controls_toggle;
			$row_edit_clone_delete .= '</span>';

			if ( $allAccess ) {
				$output .=  $controls_move . $controls_layout . $controls_add . $row_edit_clone_delete . $controls_end;
			} elseif ( $editAccess ) {
				$output .= $row_edit_clone_delete . $controls_end;
			} else {
				$output .= $row_edit_clone_delete . $controls_end;
			}
		}

		return $output;
	}

	public function contentAdmin( $atts, $content = null ) {
		$width = $el_class = '';
		$atts  = shortcode_atts( $this->predefined_atts, $atts );

		extract( $atts );

		$output = '';
		$count_width = $width && is_array( $width )  ? count( $width ) : 1;
		$column_controls = $this->getColumnControls( $this->settings( 'controls' ) );

		for ( $i = 0; $i < $count_width; $i ++ ) {
			$output .= '<div data-manh="" data-element_type="' . $this->settings['base'] . '" class="' . $this->cssAdminClass() . '">';
			$output .= str_replace( '%column_size%', 1, $column_controls );
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div class="vc_row vc_row-fluid wpb_row_container vc_container_for_children">';
			if ( '' === $content && ! empty( $this->settings['default_content_in_template'] ) ) {
				$output .= do_shortcode( shortcode_unautop( $this->settings['default_content_in_template'] ) );
			} else {
				$output .= do_shortcode( shortcode_unautop( $content ) );

			}
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					if ( ! isset( $param['param_name'] ) ) {
						continue;
					}
					$param_value = isset( $atts[ $param['param_name'] ] ) ? $atts[ $param['param_name'] ] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key   = key( $param_value );
						$param_value = $param_value[ $first_key ];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	public function cssAdminClass() {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? ' wpb_sortable' : ' ' . $this->nonDraggableClass );

		return 'wpb_' . $this->settings['base'] . $sortable . '' . ( ! empty( $this->settings['class'] ) ? ' ' . $this->settings['class'] : '' );
	}

	/**
	 * @deprecated - due to it is not used anywhere? 4.5
	 * @typo Bock - Block
	 * @return string
	 */
	public function customAdminBockParams() {
		// _deprecated_function( 'WPBakeryShortCode_VC_Row::customAdminBockParams', '4.5 (will be removed in 4.10)' );

		return '';
	}

	/**
	 * @deprecated 4.5
	 *
	 * @param string $bg_image
	 * @param string $bg_color
	 * @param string $bg_image_repeat
	 * @param string $font_color
	 * @param string $padding
	 * @param string $margin_bottom
	 *
	 * @return string
	 */
	public function buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
		// _deprecated_function( 'WPBakeryShortCode_VC_Row::buildStyle', '4.5 (will be removed in 4.10)' );

		$has_image = false;
		$style     = '';
		if ( (int) $bg_image > 0 && false !== ( $image_url = wp_get_attachment_url( $bg_image ) ) ) {
			$has_image = true;
			$style .= 'background-image: url(' . $image_url . ');';
		}
		if ( ! empty( $bg_color ) ) {
			$style .= vc_get_css_color( 'background-color', $bg_color );
		}
		if ( ! empty( $bg_image_repeat ) && $has_image ) {
			if ( 'cover' === $bg_image_repeat ) {
				$style .= 'background-repeat:no-repeat;background-size: cover;';
			} elseif ( 'contain' === $bg_image_repeat ) {
				$style .= 'background-repeat:no-repeat;background-size: contain;';
			} elseif ( 'no-repeat' === $bg_image_repeat ) {
				$style .= 'background-repeat: no-repeat;';
			}
		}
		if ( ! empty( $font_color ) ) {
			$style .= vc_get_css_color( 'color', $font_color );
		}
		if ( '' !== $padding ) {
			$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
		}
		if ( '' !== $margin_bottom ) {
			$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
		}

		return empty( $style ) ? '' : ' style="' . esc_attr( $style ) . '"';
	}
}

class WPBakeryShortCode_Penci_Column extends WPBakeryShortCode {
	/**
	 * @var array
	 */
	protected $predefined_atts = array(
		'font_color'  => '',
		'el_class'    => '',
		'el_position' => '',
		'width'       => '1/2',
	);

	public $nonDraggableClass = 'vc-non-draggable-column';

	/**
	 * @param $controls
	 * @param string $extended_css
	 *
	 * @return string
	 */
	public function getColumnControls( $controls, $extended_css = '' ) {
		$output       = '<div class="vc_controls vc_control-column vc_controls-visible' . ( ! empty( $extended_css ) ? " {$extended_css}" : '' ) . '">';
		$controls_end = '</div>';

		if ( ' bottom-controls' === $extended_css ) {
			$control_title = __( 'Append to this column', 'penci-framework' );
		} else {
			$control_title = __( 'Prepend to this column', 'penci-framework' );
		}
		if ( vc_user_access()->part( 'shortcodes' )->checkStateAny( true, 'custom', null )->get() ) {
			$controls_add = '<a class="vc_control column_add vc_column-add" data-vc-control="add" href="#" title="' . $control_title . '"><i class="vc-composer-icon vc-c-icon-add"></i></a>';
		} else {
			$controls_add = '';
		}
		$controls_edit = '<a class="vc_control column_edit vc_column-edit"  data-vc-control="edit" href="#" title="' . __( 'Edit this column', 'penci-framework' ) . '"><i class="vc-composer-icon vc-c-icon-mode_edit"></i></a>';
		//$controls_delete = '<a class="vc_control column_delete vc_column-delete" data-vc-control="delete"  href="#" title="' . __( 'Delete this column', 'penci-framework' ) . '"><i class="vc-composer-icon vc-c-icon-delete_empty"></i></a>';
		$controls_delete = '';
		$editAccess      = vc_user_access_check_shortcode_edit( $this->shortcode );
		$allAccess       = vc_user_access_check_shortcode_all( $this->shortcode );
		if ( is_array( $controls ) && ! empty( $controls ) ) {
			foreach ( $controls as $control ) {
				if ( 'add' === $control || ( $editAccess && 'edit' === $control ) || $allAccess ) {
					$method_name = vc_camel_case( 'output-editor-control-' . $control );
					if ( method_exists( $this, $method_name ) ) {
						$output .= $this->$method_name();
					} else {
						$control_var = 'controls_' . $control;
						if ( isset( ${$control_var} ) ) {
							$output .= ${$control_var};
						}
					}
				}
			}

			return $output . $controls_end;
		} elseif ( is_string( $controls ) && 'full' === $controls ) {
			if ( $allAccess ) {
				return $output . $controls_add . $controls_edit . $controls_delete . $controls_end;
			} elseif ( $editAccess ) {
				return $output . $controls_add . $controls_edit . $controls_end;
			}

			return $output . $controls_add . $controls_end;
		} elseif ( is_string( $controls ) ) {
			$control_var = 'controls_' . $controls;
			if ( 'add' === $controls || ( $editAccess && 'edit' == $controls || $allAccess ) && isset( ${$control_var} ) ) {
				return $output . ${$control_var} . $controls_end;
			}

			return $output . $controls_end;
		}
		if ( $allAccess ) {
			return $output . $controls_add . $controls_edit . $controls_delete . $controls_end;
		} elseif ( $editAccess ) {
			return $output . $controls_add . $controls_edit . $controls_end;
		}

		return $output . $controls_add . $controls_end;
	}

	/**
	 * @param $param
	 * @param $value
	 *
	 * @return string
	 */
	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes.
		$old_names  = array(
			'yellow_message',
			'blue_message',
			'green_message',
			'button_green',
			'button_grey',
			'button_yellow',
			'button_blue',
			'button_red',
			'button_orange',
		);
		$new_names  = array(
			'alert-block',
			'alert-info',
			'alert-success',
			'btn-success',
			'btn',
			'btn-info',
			'btn-primary',
			'btn-danger',
			'btn-warning',
		);
		$value      = str_ireplace( $old_names, $new_names, $value );
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type       = isset( $param['type'] ) ? $param['type'] : '';
		$class      = isset( $param['class'] ) ? $param['class'] : '';

		if ( isset( $param['holder'] ) && 'hidden' !== $param['holder'] ) {
			$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}

		return $output;
	}

	/**
	 * @param $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function contentAdmin( $atts, $content = null ) {
		$width = $el_class = '';

		extract( shortcode_atts( $this->predefined_atts, $atts ) );
		$output = '';

		$column_controls        = $this->getColumnControls( $this->settings( 'controls' ) );
		$column_controls_bottom = $this->getColumnControls( 'add', 'bottom-controls' );

		if ( ' column_14' === $width || ' 1/4' === $width ) {
			$width = array( 'vc_col-sm-3' );
		} elseif ( ' column_14===$width-14-14-14' ) {
			$width = array(
				'vc_col-sm-3',
				'vc_col-sm-3',
				'vc_col-sm-3',
				'vc_col-sm-3',
			);
		} elseif ( ' column_13' === $width || ' 1/3' === $width ) {
			$width = array( 'vc_col-sm-4' );
		} elseif ( ' column_13===$width-23' ) {
			$width = array(
				'vc_col-sm-4',
				'vc_col-sm-8',
			);
		} elseif ( ' column_13===$width-13-13' ) {
			$width = array(
				'vc_col-sm-4',
				'vc_col-sm-4',
				'vc_col-sm-4',
			);
		} elseif ( ' column_12' === $width || ' 1/2' === $width ) {
			$width = array( 'vc_col-sm-6' );
		} elseif ( ' column_12===$width-12' ) {
			$width = array(
				'vc_col-sm-6',
				'vc_col-sm-6',
			);
		} elseif ( ' column_23' === $width || ' 2/3' === $width ) {
			$width = array( 'vc_col-sm-8' );
		} elseif ( ' column_34' === $width || ' 3/4' === $width ) {
			$width = array( 'vc_col-sm-9' );
		} elseif ( ' column_16' === $width || ' 1/6' === $width ) {
			$width = array( 'vc_col-sm-2' );
		} elseif ( ' column_56' === $width || ' 5/6' === $width ) {
			$width = array( 'vc_col-sm-10' );
		} else {
			$width = array( '' );
		}
		$_count_width = count( (array)$width );
		for ( $i = 0; $i < $_count_width; $i ++ ) {
			$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';
			$output .= str_replace( '%column_size%', wpb_translateColumnWidthToFractional( $width[ $i ] ), $column_controls );
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';
			$output .= do_shortcode( shortcode_unautop( $content ) );
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					$param_value = isset( ${$param['param_name']} ) ? ${$param['param_name']} : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key   = key( $param_value );
						$param_value = $param_value[ $first_key ];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= str_replace( '%column_size%', wpb_translateColumnWidthToFractional( $width[ $i ] ), $column_controls_bottom );
			$output .= '</div>';
		}

		return $output;
	}

	/**
	 * @return string
	 */
	public function customAdminBlockParams() {
		return '';
	}

	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type_sdsds="' . $this->settings['base'] . '" data-vc-column-width="' . wpb_vc_get_column_width_indent( $width[ $i ] ) . '" class="wpb_' . $this->settings['base'] . ' ' . $sortable . '' . ( ! empty( $this->settings['class'] ) ? ' ' . $this->settings['class'] : '' ) . ' ' . $this->templateWidth() . ' wpb_content_holder"' . $this->customAdminBlockParams();
	}

	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function containerHtmlBlockParams( $width, $i ) {
		return 'class="wpb_column_container vc_container_for_children"';
	}

	/**
	 * @param string $content
	 *
	 * @return string
	 */
	public function template( $content = '' ) {
		return $this->contentAdmin( $this->atts );
	}

	/**
	 * @return string
	 */
	protected function templateWidth() {
		return '<%= window.vc_convert_column_size(params.width) %>';
	}

	/**
	 * @param string $font_color
	 *
	 * @return string
	 */
	public function buildStyle( $font_color = '' ) {
		$style = '';
		if ( ! empty( $font_color ) ) {
			$style .= vc_get_css_color( 'color', $font_color );
		}

		return empty( $style ) ? $style : ' style="' . esc_attr( $style ) . '"';
	}
}

class WPBakeryShortCode_Penci_Column_Inner extends WPBakeryShortCode {
	/**
	 * @var array
	 */
	protected $predefined_atts = array(
		'font_color'  => '',
		'el_class'    => '',
		'el_position' => '',
		'width'       => '1/2',
	);

	public $nonDraggableClass = 'vc-non-draggable-column';

	/**
	 * @param $controls
	 * @param string $extended_css
	 *
	 * @return string
	 */
	public function getColumnControls( $controls, $extended_css = '' ) {
		$output       = '<div class="vc_controls vc_control-column vc_controls-visible' . ( ! empty( $extended_css ) ? " {$extended_css}" : '' ) . '">';
		$controls_end = '</div>';

		if ( ' bottom-controls' === $extended_css ) {
			$control_title = __( 'Append to this column', 'penci-framework' );
		} else {
			$control_title = __( 'Prepend to this column', 'penci-framework' );
		}
		if ( vc_user_access()->part( 'shortcodes' )->checkStateAny( true, 'custom', null )->get() ) {
			$controls_add = '<a class="vc_control column_add vc_column-add" data-vc-control="add" href="#" title="' . $control_title . '"><i class="vc-composer-icon vc-c-icon-add"></i></a>';
		} else {
			$controls_add = '';
		}
		$controls_edit = '<a class="vc_control column_edit vc_column-edit"  data-vc-control="edit" href="#" title="' . __( 'Edit this column', 'penci-framework' ) . '"><i class="vc-composer-icon vc-c-icon-mode_edit"></i></a>';
		//$controls_delete = '<a class="vc_control column_delete vc_column-delete" data-vc-control="delete"  href="#" title="' . __( 'Delete this column', 'penci-framework' ) . '"><i class="vc-composer-icon vc-c-icon-delete_empty"></i></a>';
		$controls_delete = '';
		$editAccess      = vc_user_access_check_shortcode_edit( $this->shortcode );
		$allAccess       = vc_user_access_check_shortcode_all( $this->shortcode );
		if ( is_array( $controls ) && ! empty( $controls ) ) {
			foreach ( $controls as $control ) {
				if ( 'add' === $control || ( $editAccess && 'edit' === $control ) || $allAccess ) {
					$method_name = vc_camel_case( 'output-editor-control-' . $control );
					if ( method_exists( $this, $method_name ) ) {
						$output .= $this->$method_name();
					} else {
						$control_var = 'controls_' . $control;
						if ( isset( ${$control_var} ) ) {
							$output .= ${$control_var};
						}
					}
				}
			}

			return $output . $controls_end;
		} elseif ( is_string( $controls ) && 'full' === $controls ) {
			if ( $allAccess ) {
				return $output . $controls_add . $controls_edit . $controls_delete . $controls_end;
			} elseif ( $editAccess ) {
				return $output . $controls_add . $controls_edit . $controls_end;
			}

			return $output . $controls_add . $controls_end;
		} elseif ( is_string( $controls ) ) {
			$control_var = 'controls_' . $controls;
			if ( 'add' === $controls || ( $editAccess && 'edit' == $controls || $allAccess ) && isset( ${$control_var} ) ) {
				return $output . ${$control_var} . $controls_end;
			}

			return $output . $controls_end;
		}
		if ( $allAccess ) {
			return $output . $controls_add . $controls_edit . $controls_delete . $controls_end;
		} elseif ( $editAccess ) {
			return $output . $controls_add . $controls_edit . $controls_end;
		}

		return $output . $controls_add . $controls_end;
	}

	/**
	 * @param $param
	 * @param $value
	 *
	 * @return string
	 */
	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes.
		$old_names  = array(
			'yellow_message',
			'blue_message',
			'green_message',
			'button_green',
			'button_grey',
			'button_yellow',
			'button_blue',
			'button_red',
			'button_orange',
		);
		$new_names  = array(
			'alert-block',
			'alert-info',
			'alert-success',
			'btn-success',
			'btn',
			'btn-info',
			'btn-primary',
			'btn-danger',
			'btn-warning',
		);
		$value      = str_ireplace( $old_names, $new_names, $value );
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type       = isset( $param['type'] ) ? $param['type'] : '';
		$class      = isset( $param['class'] ) ? $param['class'] : '';

		if ( isset( $param['holder'] ) && 'hidden' !== $param['holder'] ) {
			$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}

		return $output;
	}

	/**
	 * @param $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function contentAdmin( $atts, $content = null ) {
		$width = $el_class = '';

		extract( shortcode_atts( $this->predefined_atts, $atts ) );
		$output = '';

		$column_controls        = $this->getColumnControls( $this->settings( 'controls' ) );
		$column_controls_bottom = $this->getColumnControls( 'add', 'bottom-controls' );

		if ( ' column_14' === $width || ' 1/4' === $width ) {
			$width = array( 'vc_col-sm-3' );
		} elseif ( ' column_14===$width-14-14-14' ) {
			$width = array(
				'vc_col-sm-3',
				'vc_col-sm-3',
				'vc_col-sm-3',
				'vc_col-sm-3',
			);
		} elseif ( ' column_13' === $width || ' 1/3' === $width ) {
			$width = array( 'vc_col-sm-4' );
		} elseif ( ' column_13===$width-23' ) {
			$width = array(
				'vc_col-sm-4',
				'vc_col-sm-8',
			);
		} elseif ( ' column_13===$width-13-13' ) {
			$width = array(
				'vc_col-sm-4',
				'vc_col-sm-4',
				'vc_col-sm-4',
			);
		} elseif ( ' column_12' === $width || ' 1/2' === $width ) {
			$width = array( 'vc_col-sm-6' );
		} elseif ( ' column_12===$width-12' ) {
			$width = array(
				'vc_col-sm-6',
				'vc_col-sm-6',
			);
		} elseif ( ' column_23' === $width || ' 2/3' === $width ) {
			$width = array( 'vc_col-sm-8' );
		} elseif ( ' column_34' === $width || ' 3/4' === $width ) {
			$width = array( 'vc_col-sm-9' );
		} elseif ( ' column_16' === $width || ' 1/6' === $width ) {
			$width = array( 'vc_col-sm-2' );
		} elseif ( ' column_56' === $width || ' 5/6' === $width ) {
			$width = array( 'vc_col-sm-10' );
		} else {
			$width = array( '' );
		}
		$__count_width = count( (array)$width );
		for ( $i = 0; $i < $__count_width; $i ++ ) {
			$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';
			$output .= str_replace( '%column_size%', wpb_translateColumnWidthToFractional( $width[ $i ] ), $column_controls );
			$output .= '<div class="wpb_element_wrapper">';
			$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';
			$output .= do_shortcode( shortcode_unautop( $content ) );
			$output .= '</div>';
			if ( isset( $this->settings['params'] ) ) {
				$inner = '';
				foreach ( $this->settings['params'] as $param ) {
					$param_value = isset( ${$param['param_name']} ) ? ${$param['param_name']} : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key   = key( $param_value );
						$param_value = $param_value[ $first_key ];
					}
					$inner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				$output .= $inner;
			}
			$output .= '</div>';
			$output .= str_replace( '%column_size%', wpb_translateColumnWidthToFractional( $width[ $i ] ), $column_controls_bottom );
			$output .= '</div>';
		}

		return $output;
	}

	/**
	 * @return string
	 */
	public function customAdminBlockParams() {
		return '';
	}

	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type_sdsds="' . $this->settings['base'] . '" data-vc-column-width="' . wpb_vc_get_column_width_indent( $width[ $i ] ) . '" class="wpb_' . $this->settings['base'] . ' ' . $sortable . '' . ( ! empty( $this->settings['class'] ) ? ' ' . $this->settings['class'] : '' ) . ' ' . $this->templateWidth() . ' wpb_content_holder"' . $this->customAdminBlockParams();
	}

	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function containerHtmlBlockParams( $width, $i ) {
		return 'class="wpb_column_container vc_container_for_children"';
	}

	/**
	 * @param string $content
	 *
	 * @return string
	 */
	public function template( $content = '' ) {
		return $this->contentAdmin( $this->atts );
	}

	/**
	 * @return string
	 */
	protected function templateWidth() {
		return '<%= window.vc_convert_column_size(params.width) %>';
	}

	/**
	 * @param string $font_color
	 *
	 * @return string
	 */
	public function buildStyle( $font_color = '' ) {
		$style = '';
		if ( ! empty( $font_color ) ) {
			$style .= vc_get_css_color( 'color', $font_color );
		}

		return empty( $style ) ? $style : ' style="' . esc_attr( $style ) . '"';
	}
}

