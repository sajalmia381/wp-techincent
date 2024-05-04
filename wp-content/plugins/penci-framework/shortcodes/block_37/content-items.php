<?php
$i             = 1;
$block37_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$block37_items .= '<article  class="' . join( ' ', penci_get_post_class( 'penci-post-item__' . $i, get_the_ID() ) ) . '">';
	$block37_items .= '<div class="penci_post_thumb">';
	$block37_items .= Penci_Helper_Shortcode::get_image_holder( array(
		'image_size' => ! empty( $atts['image_size'] ) ? $atts['image_size'] : 'penci-thumb-480-320',
		'show_icon'  => ! $atts['hide_icon_post_format'],
		'image_type' => $atts['image_type']
	) );
	$block37_items .= Penci_Helper_Shortcode::get_post_meta( array( 'cat', 'review' ), $atts, false );
	$block37_items .= '</div>';
	$block37_items .= '<div class="penci_post_content">';
	$block37_items .= Penci_Helper_Shortcode::get_markup_title_post( $atts['post_standard_title_length'] );

	$block37_items .= Penci_Helper_Shortcode::get_excrept( $atts['post_excrept_length'], ! $atts['show_excrept'] );

	if ( get_post_type( get_the_ID() ) == 'product' ) {
		$GLOBALS['post'] = get_post( get_the_ID() );
		setup_postdata( $GLOBALS['post'] );
		global $product;

		$price_html = penci_pennews_get_price_html( $product );
		if ( $price_html ) {
			$block37_items .= '<span class="penci-price">' . $price_html . '</span>';
		}
	}else{

		$post_meta = '';
		if(  function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
			$post_meta .= penci_get_post_author( false, false );
		}
		$post_meta .= function_exists( 'penci_get_post_date' ) && empty( $atts['hide_post_date'] ) ? penci_get_post_date( false ) : '';

		if( function_exists( 'penci_get_comment_count' ) && empty( $atts['hide_comment'] ) ) {
			$post_meta .='<span class="entry-meta-item penci-comment-count">';
			$post_meta .='<a class="penci_pmeta-link" href="'. esc_url( get_comments_link() ) . '"><i class="la la-comments"></i>';

			if( function_exists( 'penci_get_tran_setting' ) ) {
				$post_meta .= get_comments_number_text( penci_get_tran_setting( 'penci_comment_zero' ), penci_get_tran_setting( 'penci_comment_one' ), '% ' . penci_get_tran_setting( 'penci_comment_more' ) );
			}else{
				$post_meta .= get_comments_number_text( esc_html__( '0 comment', 'penci-framework' ), esc_html__( '1 comment', 'penci-framework' ), '% ' . esc_html__( 'comments', 'penci-framework' ) );
			}

			$post_meta .='</a></span>';
		}

		$block37_items .= $post_meta ? '<div class="penci_post-meta">' . $post_meta . '</div>' : '';
	}

	$block37_items .= '</div>';
	$block37_items .= '</article>';

	$block37_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $i,
		'code'       => $content,
	) );

	$i ++;
}
wp_reset_postdata();

return Penci_Helper_Shortcode::pre_output_content_items( $block37_items, $atts );