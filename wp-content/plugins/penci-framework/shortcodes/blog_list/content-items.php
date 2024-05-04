<?php

$blog_list_i     = 1;
$blog_list_items = '';
while ( $query_slider->have_posts() ) {
	$query_slider->the_post();

	$post_meta = function_exists( 'penci_get_post_date' ) && empty( $atts['hide_post_date'] ) ? penci_get_post_date( false ) : '';

	if( function_exists( 'penci_get_comment_count' ) && empty( $atts['hide_comment'] ) ) {
		$post_meta .='<span class="entry-meta-item penci-comment-count">';
		$post_meta .='<a class="penci_pmeta-link" href="'. esc_url( get_comments_link() ) . '"><i class="la la-comments"></i>';

		if( function_exists( 'penci_get_tran_setting' ) ){
			$post_meta .= get_comments_number_text( penci_get_tran_setting( 'penci_comment_zero' ), penci_get_tran_setting( 'penci_comment_one' ), '% ' . penci_get_tran_setting( 'penci_comment_more' )  );
		}else{
			$post_meta .= get_comments_number_text( esc_html__( '0 comment', 'penci-framework' ), esc_html__( '1 comment', 'penci-framework' ), '% ' . esc_html__( 'comments', 'penci-framework' ) );
		}

		$post_meta .='</a></span>';
	}


	$blog_list_items .= '<article  class="' . join( ' ', penci_get_post_class( '', get_the_ID() ) ) . '">';
	$blog_list_items .= Penci_Framework_Helper::get_categories( );
	$blog_list_items .= Penci_Helper_Shortcode::get_markup_title_post(  $atts['post_title_length'] );
	$blog_list_items .= $post_meta ? '<div class="penci_post-meta">' . $post_meta . '</div>' : '';
	$blog_list_items .= '</article>';

	$blog_list_items .= Penci_Helper_Shortcode::get_markup_infeed_ad( array(
		'order_ad'   => $atts['infeed_ads__order'],
		'order_post' => $blog_list_i,
		'code'       => $content,
	) );

	$blog_list_i ++;
}

wp_reset_postdata();


return Penci_Helper_Shortcode::pre_output_content_items( $blog_list_items , $atts );