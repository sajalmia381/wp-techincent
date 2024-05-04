<?php
/**
 * All functions for Penci Review Plugin
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Get review average score for a posts
 *
 * @param $post_id
 *
 * @return string
 */
if( ! function_exists( 'penci_get_review_average_score' ) ) {
	function penci_get_review_average_score( $post_id ) {
		// Get review data
		$total_review = get_post_meta( $post_id, 'penci_total_review', true );
		if( $total_review ){
			$total_review = apply_filters( "penci_total_review", $total_review, $post_id );
			return $total_review;
		}

		$penci_review = get_post_meta( $post_id, 'penci_review', true );

		$review_1     = isset( $penci_review['penci_review_1'] ) ? $penci_review['penci_review_1'] : '';
		$review_1num  = isset( $penci_review['penci_review_1_num'] ) ? $penci_review['penci_review_1_num'] : '';
		$review_2     = isset( $penci_review['penci_review_2'] ) ? $penci_review['penci_review_2'] : '';
		$review_2num  = isset( $penci_review['penci_review_2_num'] ) ? $penci_review['penci_review_2_num'] : '';
		$review_3     = isset( $penci_review['penci_review_3'] ) ? $penci_review['penci_review_3'] : '';
		$review_3num  = isset( $penci_review['penci_review_3_num'] ) ? $penci_review['penci_review_3_num'] : '';
		$review_4     = isset( $penci_review['penci_review_4'] ) ? $penci_review['penci_review_4'] : '';
		$review_4num  = isset( $penci_review['penci_review_4_num'] ) ? $penci_review['penci_review_4_num'] : '';
		$review_5     = isset( $penci_review['penci_review_5'] ) ? $penci_review['penci_review_5'] : '';
		$review_5num  = isset( $penci_review['penci_review_5_num'] ) ? $penci_review['penci_review_5_num'] : '';


		$total_score = 0;
		$total_num   = 0;

		if ( $review_1 && $review_1num ):
			$total_score = $total_score + $review_1num;
			$total_num   = $total_num + 1;
		endif;
		if ( $review_2 && $review_2num ):
			$total_score = $total_score + $review_2num;
			$total_num   = $total_num + 1;
		endif;
		if ( $review_3 && $review_3num ):
			$total_score = $total_score + $review_3num;
			$total_num   = $total_num + 1;
		endif;
		if ( $review_4 && $review_4num ):
			$total_score = $total_score + $review_4num;
			$total_num   = $total_num + 1;
		endif;
		if ( $review_5 && $review_5num ):
			$total_score = $total_score + $review_5num;
			$total_num   = $total_num + 1;
		endif;

		$total_review = 0;
		if ( $total_score && $total_num ) {
			$total_review = $total_score / $total_num;
		}

		$total_review = apply_filters( "penci_total_review", $total_review, $post_id );

		return $total_review;


	}
}


/**
 * Format review average score for a posts
 *
 * @param $total_review
 *
 * @return string
 */
if( ! function_exists( 'penci_get_review_average_score_format' ) ) {
	function penci_get_review_average_score_format( $post_id,$total_review ) {

		$penci_review = get_post_meta( $post_id, 'penci_review', true );
		$review_style = isset( $penci_review['penci_review_style'] ) ? $penci_review['penci_review_style'] : 'style_1';

		if ( 'style_2' == $review_style ) {
			return number_format( $total_review * 10, 1, '.', '' ) . '%';
		} elseif ( 'style_3' == $review_style ) {
			$total_review = $total_review / 2;
		}

		return number_format( $total_review, 1, '.', '' );
	}
}


/**
 * Format review average score for a posts with block vc
 *
 * @param $total_review
 *
 * @return string
 */
if ( ! function_exists( 'penci_get_review_format_block_vc' ) ) {
	function penci_get_review_format_block_vc( $post_id, $total_review ) {

		$penci_review = get_post_meta( $post_id, 'penci_review', true );
		$review_style = isset( $penci_review['penci_review_style'] ) ? $penci_review['penci_review_style'] : 'style_1';

		if ( 'style_2' == $review_style ) {
			return number_format( $total_review * 10, 1, '.', '' );
		} elseif ( 'style_3' == $review_style ) {
			$total_review = $total_review / 2;
		}

		return number_format( $total_review, 1, '.', '' );
	}
}


/**
 * Get review markup piechart for a posts
 * Use this function in a loop
 *
 * @param $post_id
 *
 * @return string
 */
if( ! function_exists( 'penci_display_piechart_review_html' ) ) {
	function penci_display_piechart_review_html( $post_id, $size = 'normal', $show = true, $color_arr = array(),$show_piechart = false ) {
		$total_score = penci_get_review_average_score( $post_id );

		if ( empty( $total_score ) || '0.0' == $total_score || get_theme_mod( 'penci_review_hide_piechart' ) ) {
			return;
		}

		$percent  = $total_score * 10;

		if( get_theme_mod( 'penci_review_repl_stars_circle' ) && ! $show_piechart ) {
			$output = penci_get_preview_rating_markup(array(
				'rate'     => $percent,
				'format'   => false,
			) );

		}else{


			$pie_size = 40;

			if ( 'small' == $size ) {
				$pie_size = 34;
			} elseif ( 'big' == $size ) {
				$pie_size = 60;
			}

			if ( isset( $color_arr['color_running'] ) && ! empty( $color_arr['color_running'] ) ) {
				$color = $color_arr['color_running'];
			} else {
				$color = '#3f51b5';
				if ( get_theme_mod( 'penci_color_accent' ) ):
					$color = get_theme_mod( 'penci_color_accent' );
				endif;
				if ( get_theme_mod( 'penci_review_piechart_border' ) ):
					$color = get_theme_mod( 'penci_review_piechart_border' );
				endif;
			}

			$trackcolor = 'rgba(0, 0, 0, .2)';
			if ( isset( $color_arr['trackcolor'] ) && ! empty( $color_arr['trackcolor'] ) ) {
				$trackcolor = $color_arr['trackcolor'];
			}


			$output = sprintf( '<span class="penci-piechart penci-piechart-%s" data-percent="%s" data-color="%s" data-trackcolor="%s" data-size="%s" data-thickness="%s">
		<span class="penci-chart-text">%s</span></span>',
				$size,
				$percent,
				$color,
				$trackcolor,
				$pie_size,
				$size == 'small' ? '2' : '3',
				penci_get_review_format_block_vc( $post_id, $total_score )
			);
		}

		if ( ! $show ) {
			return $output;
		}

		echo $output;

	}
}

if( ! function_exists( 'penci_get_preview_rating_markup' ) ) {
	function penci_get_preview_rating_markup( $args ){

		$rate = $size = $format = $show = $position = $style = '';

		$args = wp_parse_args( $args, array(
			'rate'     => 0,
			'size'     => 'normal',
			'format'   => false,
			'show'     => false,
			'position' => 'absolute',
		) );

		extract( $args );

		if( $format ){
			$rate = $rate * 2 *  10;
		}

		$rate = $rate . '%';

		if( get_theme_mod( 'penci_review_dis_anim_stars' ) ){
			$style = ' style="width: ' . $rate .';"';
			$rate = 0;
		}

		$class = 'penci-preview-rating penci-preview-rating-' . $size ;
		$class .= ' penci-preview-rating-' . $position;

		$output = '<div class="' . $class . '" data-rating="' . $rate . '">';
		$output .= '<div class="penci-prvrate-bg"></div>';
		$output .= '<div class="penci-prvrate-active"' . $style . '>';
		$output .= '<div class="penci-prvrate-active-inner"> </div>';
		$output .= '</div>';
		$output .= '</div>';

		if( ! $show ){
			return $output;
		}

		echo $output;
	}
}


/**
 * Convert hex color to RGB
 *
 * @param $color
 * @param int $opacity
 *
 * @return string
 */

if( ! function_exists( 'penci_convert_hex_rgb' ) ) {
	function penci_convert_hex_rgb( $color, $opacity = 1 ) {

		if ( empty( $color ) ) {
			$color = '#000000';
		}

		list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );

		return sprintf( 'rgba(%s, %s, %s, %s)', $r, $g, $b, $opacity );
	}
}


if( ! function_exists( 'penci_predata_customize_pmeta' ) ){
	function penci_predata_customize_pmeta( $penci_review, $id_customize, $id_pmeta ){
		$data_customize     = get_theme_mod( $id_customize );
		$data_pmeta = isset( $penci_review[$id_pmeta] ) ? $penci_review[$id_pmeta] : '';

		if( 'enable' == $data_pmeta ){
			$data_customize = false;
		}elseif( 'disable' == $data_pmeta ){
			$data_customize = true;
		}

		return $data_customize;
	}
}

