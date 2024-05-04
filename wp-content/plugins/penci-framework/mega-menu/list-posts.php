<?php

$hide_icon_postformat = $hide_icon_cat = $hide_post_date = $image_type = '';
if( function_exists( 'penci_get_setting' ) ) {
	$hide_icon_postformat = penci_get_setting( 'penci_hide_icon_postformat_mega_menu' );
	$hide_icon_cat        = penci_get_setting( 'penci_hide_icon_cat_mega_menu' );
	$hide_post_date       = penci_get_setting( 'penci_hide_post_date_mega_menu' );
	$image_type           = penci_get_setting( 'penci_archive_image_type' );
}

$mega_image_type = get_theme_mod( 'penci_megamenu_image_type' );
if( $mega_image_type ){
	$image_type = $mega_image_type;
}

$post_mega_numbers = isset( $post_mega_numbers ) ? $post_mega_numbers : 1;
$tax = isset( $tax ) ? $tax : 'category';
$output = '';

if ( $latest_mega->have_posts() ):
	$latest_mega_i = 1;
	while ( $latest_mega->have_posts() ): $latest_mega->the_post();
	if( $post_mega_numbers >= $latest_mega_i ):
		$output .= '<div class="penci-mega-post penci-mega-post-' . esc_attr( $latest_mega_i ) . ' ' . esc_attr( 'penci-imgtype-' . $image_type ) . '">';
			$output .= '<div class="penci-mega-thumbnail">';

				if ( ! $hide_icon_postformat ){
					if ( has_post_format( 'video' ) ) {
						$output .= '<div class="icon-post-format"><i class="fa fa-play"></i></div>';
					}
					if ( has_post_format( 'audio' ) ) {
						$output .= '<div class="icon-post-format"><i class="fa fa-music"></i></div>';
					}
					if ( has_post_format( 'gallery' ) ) {
						$output .= '<div class="icon-post-format"><i class="fa fa-picture-o"></i></div>';
					}
				}

				if ( ! $hide_icon_cat ) {
					$output .= '<a class="mega-cat-name" href="' . get_term_link( intval( $cat_id ), $tax ) . '">' . esc_attr( Penci_FrameWork_Main_Menu::get_taxonomy_name( $cat_id, $tax ) ) . '</a>';
				}

				$output .= Penci_Helper_Shortcode::get_image_holder( array(
					'image_size' => 'penci-thumb-280-186',
					'show_icon'  => false,
					'item_order' => 'mega_menu',
					'image_type' => $image_type
				) );

			$output .= '</div>';

			$post_title_length = penci_get_theme_mod( 'penci_length_ptitle_cat_mega' ) ? penci_get_theme_mod( 'penci_length_ptitle_cat_mega' ) : 8;

			$output .= '<div class="penci-mega-meta ' . ( $hide_post_date ? 'penci-mega-hide-date' : '' ) . '">';
				$output .= '<h3 class="post-mega-title entry-title">';
				$output .= ' <a href="' . get_the_permalink() . '">' . penci_trim_post_title( get_the_ID(), $post_title_length ) . '</a>';
				$output .= '</h3>';

				if ( ! $hide_post_date ) {
					$output .= '<p class="penci-mega-date">';

					if( 'product_cat' == $tax || 'product_tag' == $tax ) {
						$GLOBALS['post'] = get_post( get_the_ID() );
						setup_postdata( $GLOBALS['post'] );
						global $product;

						if ( '' === $product->get_price() ) {
							$price = apply_filters( 'woocommerce_empty_price_html', '', $product );
						} elseif ( $product->is_on_sale() ) {
							$price = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
						} else {
							$price = wc_price( wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
						}

						$output .= apply_filters( 'woocommerce_get_price_html', $price, $product );

					}else{
						$output .= '<i class="fa fa-clock-o"></i>';
						$output .= get_the_time( get_option( 'date_format' ) );
					}

					$output .= '</p>';
				}

			$output .= '</div>';
		$output .= '</div>';
		$latest_mega_i ++;
		endif;
	endwhile;
	wp_reset_postdata();
endif;

$output .= apply_filters( 'penci_after_block_items', '', '' );

echo $output;
