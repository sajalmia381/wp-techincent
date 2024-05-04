<?php
class Penci_Framework_Ajax_Filter{

	function __construct() {
		add_action( 'wp_ajax_nopriv_penci_ajax_block', array( __CLASS__,'ajax_block' ) );
		add_action( 'wp_ajax_penci_ajax_block', array( __CLASS__,'ajax_block' ) );
	}

	public static function ajax_block() {

		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Nope!' );
		}


		$atts          = isset( $_POST['datafilter'] ) ? $_POST['datafilter'] : '';
		$styleAction   = isset( $_POST['styleAction'] ) ? $_POST['styleAction'] : '';
		$content       = isset( $_POST['datacontent'] ) ? $_POST['datacontent'] : '';
		$column_number = isset( $atts['column_number'] ) ? $atts['column_number'] : 1;

		if( ! is_array( $atts ) ){
			$atts = json_decode(stripslashes($atts), true );
		}

		$atts['paged'] = isset( $_POST['paged'] ) ? $_POST['paged'] : 1;
		$atts['styleAction'] = $styleAction;

		$items = '';
		if ( empty( $atts['shortcode_id'] )  ) {
			wp_send_json_success( $items ) ;
		}

		if ( isset( $atts['turn_on_loop_item'] ) && $atts['turn_on_loop_item'] && 'load_more' == $styleAction && 'block_33' == $atts['shortcode_id'] ) {
			$atts['limit_loadmore'] = 5;
		}

		$args = Penci_Pre_Query::switch_query_args( $atts );

		if ( isset( $atts['category_ids'] ) && ! empty( $atts['category_ids'] ) ) {
			if ( isset( $atts['ajax_filter_type'] ) && 'tag_slug_filter' == $atts['ajax_filter_type'] ) {
				$args['tag'] = array( $atts['category_ids'] );

				if ( isset( $args['tag__in'] ) ) {
					unset( $args['tag__in'] );
				}

				if ( isset( $args['tag__not_in'] ) ) {
					unset( $args['tag__not_in'] );
				}
			}else if( isset( $atts['ajax_filter_type'] ) && 'taxonomies_filter' == $atts['ajax_filter_type'] && $atts['taxonomy'] ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $atts['taxonomy'],
						'field'    => 'slug',
						'terms'    => array( $atts['category_ids'] ),
					)
				);

				if ( isset( $args['cat'] ) ) {
					unset( $args['cat'] );
				}
			} else {
				$args['category_name'] = $atts['category_ids'];
				if ( isset( $args['cat'] ) ) {
					unset( $args['cat'] );
				}
			}
		}

		$query_slider = new WP_Query( $args );

		if ( ! $query_slider->have_posts() ) {
			wp_send_json_success( array( 'items' => '', 'hidePagNext' => 1, 'hidePagPrev' => 1 , 'args' => $args ) );
		}

		$hide_pag_next = $hide_pag_prev = '';

		if ( 1 == $atts['paged'] ) {
			$hide_pag_prev = 1;
		}

		if ( $query_slider->max_num_pages == $atts['paged'] ) {
			$hide_pag_next = 1;
		}

		$content_items = include( PENCI_ADDONS_DIR . "shortcodes/{$atts['shortcode_id']}/content-items.php" );

		wp_send_json_success( array( 'items' => $content_items, 'hidePagNext' => $hide_pag_next, 'hidePagPrev' => $hide_pag_prev , 'args' => $args ) );
	}


}