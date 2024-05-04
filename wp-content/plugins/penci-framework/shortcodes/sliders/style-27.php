<div class="item">
		<div class="wrapper-item wrapper-item-classess">
			<?php $slider_i = 1; $num_posts = $query_slider->post_count;
			while ( $query_slider->have_posts() ) : $query_slider->the_post();
			
			$image_size = 'penci-thumb-480-320';
			$class_item = 'item__medium-thumb';

			$slider_id_trim_title = 'post_standard_title_length';

			if ( $slider_i%7 == 1 ) {
				$class_item = 'item__big-thumb';
				$image_size = 'penci-thumb-760-570';
				$slider_id_trim_title = 'post_big_title_length';
			}
			?>
			<div class="penci-item-mag penci-item-mag-<?php echo ( $slider_i%7 ); ?> <?php echo $class_item; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $slider_i%7 ); ?>">
				<a class="penci-image-holder" style="background-image:url('<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size ); ?>');" href="<?php the_permalink(); ?>" title="<?php echo wp_strip_all_tags( get_the_title() ); ?>">
				</a>
				<div class="penci-featured-content penci-slider-ani-delay-06 penci__general-meta">
					<a class="featured-slider-overlay penci-gradient" href="<?php the_permalink(); ?>"></a>
					<?php
					if ( function_exists( 'penci_icon_post_format' ) && $slider_i%7 == 1 ) {

						$style_slider = isset( $atts['style_slider'] ) ? $atts['style_slider'] : '';
						$size         = penci_get_class_post_format( $style_slider, $slider_i%7 );
						penci_icon_post_format( true, $size );
					}
					?>
					<div class="penci-slider__text">
						<?php if ( ! $atts['hide_cat'] && $slider_i%7 == 1 ): ?>
							<?php
							if( isset( $atts['show_allcat'] ) && $atts['show_allcat'] ){
								$categories_list =  Penci_Framework_Helper::get_the_category_list( ' ' );
								if( $categories_list ){
									echo'<div class="cat penci-slider__cat">' . $categories_list . '</div>';
								}
							}else{
								echo '<div class="cat penci-slider__cat">' . Penci_Framework_Helper::show_category( '', '', false ) . '</div>';
							}
							?>
						<?php endif; ?>
						<h3 class="penci_slider__title entry-title">
							<a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), ( isset( $atts[ $slider_id_trim_title ] ) ? $atts[ $slider_id_trim_title ] : 10 ) ); ?></a>
						</h3>
						<?php
						if ( $slider_i%7 == 1 ) {
						 	echo Penci_Helper_Shortcode::get_post_meta( array( 'date', 'view', 'comment' ), $atts, true, array( 'author' ) );
						}
						?>
					</div>
				</div>
			</div>

			<?php if( ( $slider_i%7 == 0 || $slider_i%7 == 1 || $slider_i%7 == 3 || $slider_i%7 == 5 ) && $slider_i < $num_posts ):  echo '</div></div><div class="item"><div class="wrapper-item wrapper-item-classess">';  endif;?>

			<?php $slider_i++; endwhile; wp_reset_postdata(); ?>
		</div>
	</div>