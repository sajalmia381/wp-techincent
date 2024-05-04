<?php $slider_id_trim_title = isset( $slider_id_trim_title ) ? $slider_id_trim_title : 'post_standard_title_length'; ?>
<div class="penci-featured-content penci-slider-ani-delay-06 penci__general-meta">
	<a class="featured-slider-overlay penci-gradient" href="<?php the_permalink(); ?>"></a>
	<?php
	if ( function_exists( 'penci_icon_post_format' ) ) {

		$style_slider = isset( $atts['style_slider'] ) ? $atts['style_slider'] : '';
		$count = isset( $count ) ? $count : '';
		$size         = penci_get_class_post_format( $style_slider, $count );

		penci_icon_post_format( true, $size );
	}
	?>
	<div class="penci-slider__text">
		<?php
		if( empty( $atts['hide_cat'] ) ){
			if( isset( $atts['show_allcat'] ) && $atts['show_allcat'] ){
				$categories_list =  Penci_Framework_Helper::get_the_category_list( ' ' );
				if( $categories_list ){
					echo'<div class="cat penci-slider__cat">' . $categories_list . '</div>';
				}
			}else{
				echo '<div class="cat penci-slider__cat">' . Penci_Framework_Helper::show_category( '', '', false ) . '</div>';
			}
		}
		?>
		<h3 class="penci_slider__title entry-title">
			<a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), ( isset( $atts[ $slider_id_trim_title ] ) ? $atts[ $slider_id_trim_title ] : 10 ) ); ?></a>
		</h3>
		<?php echo apply_filters( 'penci_framework/markup_title_post_block','', get_the_ID() ); ?>
		<?php echo Penci_Helper_Shortcode::get_post_meta( array( 'date', 'view', 'comment' ), $atts, true, array( 'author' ) ); ?>
	</div>
</div>