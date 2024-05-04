<?php
$style         = isset( $style ) ? $style : '';
$image_type    = isset( $image_type ) ? $image_type : '';
$image_thumb   = isset( $image_thumb ) ? $image_thumb : '';
$item_classes  = array( 'portfolio-item' );
$portfolio_tax = isset( $portfolio_tax ) ? $portfolio_tax : 'portfolio-category';
$item_cats     = get_the_terms( get_the_ID(), $portfolio_tax );
$_animation    = isset( $_animation ) ? $_animation : 'fadeInPortfolio';
$_effect       = isset( $_effect ) ? $_effect : 'slidenfade-one';
$column        = isset( $column ) ? $column : 3;
$portfolio_i   = isset( $portfolio_i ) ? $portfolio_i : 1;

if( isset( $hide_cat ) ){
    if( 'false' == $hide_cat ){
        $hide_cat = false;
    }
}else{
    $hide_cat = false;
}

$_effect_type       = 'wow';
$_effect_delay      = 0.00;
$_effect_delay_wait = 0.15;
$item_classes[] = 'pfl-item-' . $_effect;

if( in_array( $_effect, array( 'fade-one', 'slidenfade-one','zoom-one' ) ) ) {
	$_effect_delay = intval( $portfolio_i % intval( $column * 3 ) ) * $_effect_delay_wait;
}

if ( $_effect_delay ) {
	$_effect_delay = str_replace( ',', '.', "{$_effect_delay}" );
}

$tfl_item_terms = array();
if ( $item_cats ) {
	foreach ( $item_cats as $item_cat ) {
		$item_classes[] = '' . $item_cat->slug;
		$tfl_item_terms[] = $item_cat->slug;
	}
}

if ( 'fade' == $_effect || 'fade-one' == $_effect ) {
	$_effect_type .= ' fadeIn';
} elseif ( 'slidenfade' == $_effect || 'slidenfade-one' == $_effect ) {
	$_effect_type .= ' fadeInPortfolio';
} elseif ( 'zoom' == $_effect || 'zoom-one' == $_effect ) {
	$_effect_type .= ' zoomIn';
} elseif ( 'none' == $_effect ) {
	$_effect_type = '';
} else {
	$_effect_type .= ' fadeInPortfolio';
}

if ( in_array( $portfolio_i, array( 1, 6, 11, 16, 21,26 ) ) ) {
	//$image_thumb    = 'penci-thumb-960-auto';
	$item_classes[] = 'penci-pfl-big-item';
}

$item_classes   = implode( ' ', $item_classes );
$tfl_item_terms = implode( ' ', $tfl_item_terms );
?>
<article class="<?php echo $item_classes; ?>" id="portfolio-<?php the_ID(); ?>" data-pflID="<?php the_ID(); ?>" data-terms="<?php echo $tfl_item_terms; ?>">
	<div class="inner-item-portfolio <?php echo esc_attr( $_effect_type ); ?>"<?php  if( $_effect_delay ) : echo ' data-wow-delay="' . esc_attr( $_effect_delay ) . 's"'; endif;; ?>>
		<div class="info-portfolio">
			<div class="penci-portfolio-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() && function_exists( 'wpb_getImageBySize' ) ) {
						$thumb_id = get_post_thumbnail_id( );
						$image = wpb_getImageBySize( array( 'attach_id' => $thumb_id, 'thumb_size' => $image_thumb, 'class' => 'img-responsive' ) );

						if ( ! empty( $image['thumbnail'] ) ) {

							$disable_lazyload = penci_get_theme_mod( 'penci_disable_lazyload' );

							if ( isset( $pfl_dis_lazyload_img ) ) {
								if ( 'yes' == $pfl_dis_lazyload_img ) {
									$disable_lazyload = true;
								} elseif ( 'no' == $pfl_dis_lazyload_img ) {
									$disable_lazyload = false;
								}
							}

							Pennew_Portfolio_Helper::get_image_ratio( $image['thumbnail'],$style, $image_type, true, $disable_lazyload  );
						}
					}else{

						$class_lazy = ' penci-lazyloaded';
						$data_src = '';
						$disable_lazyload = penci_get_theme_mod( 'penci_disable_lazyload' );

						if ( isset( $pfl_dis_lazyload_img ) ) {
							if ( 'yes' == $pfl_dis_lazyload_img ) {
								$disable_lazyload = true;
							} elseif ( 'no' == $pfl_dis_lazyload_img ) {
								$disable_lazyload = false;
							}
						}

						if ( ! $disable_lazyload ) {
							$class_lazy = '';
							$data_src   = 'data-src="' . PENCI_PORTFOLIO__URL . 'images/no-thumbnail.jpg"';
						}

						echo '<span class="penci-image-placeholder" style="padding-bottom:66.66666667%">';
						echo '<img width="585" height="878" src="' . PENCI_PORTFOLIO__URL . 'images/no-thumbnail.jpg" class="img-responsive attachment-penci-masonry-thumb penci-pfl-lazy' . $class_lazy . '" ' . $data_src . ' alt="' . __( "No Thumbnail", "pencidesign" ) . '" srcset="' . PENCI_PORTFOLIO__URL . 'images/no-thumbnail.jpg 585w">';
						echo '</span>';
					}
					?>
				</a>
			</div>
			<div class="portfolio-desc">
				<a href="<?php the_permalink(); ?>">
					<h3 class="portfolio-title"><?php the_title(); ?></h3>
					<?php
					if( 'product' != get_post_type() ) {
						$get_terms = wp_get_post_terms( get_the_ID(), $portfolio_tax, array("fields" => "names") );
						$get_terms = implode( ', ', $get_terms );
					}else{
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

						$get_terms = apply_filters( 'woocommerce_get_price_html', $price, $product );
					}

					if ( ! empty( $get_terms ) && ! $hide_cat ): ?>
						<span class="portfolio-cat"><?php echo $get_terms; ?></span>
					<?php endif; ?>
				</a>
			</div>
		</div>
	</div>
</article>