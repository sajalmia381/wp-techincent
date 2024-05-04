<?php
$slider_i = $count = 0;

while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$slider_i ++;
	$count ++;

	$image_size = 'penci-thumb-480-320';
	$class_item = 'penci-slider__medium-item';
	$class_icon = 'medium-size-icon icon_pos_right';

	if ( $count == 1 ) {
		$image_size = 'penci-thumb-760-570';
		$class_item = 'penci-slider__big-item';
		$class_icon = 'lager-size-icon';
		echo '<div class="penci-slider-wrapper-item">';
	}
	?>

	<div class="penci-item-mag penci-item-<?php echo $count; ?> <?php echo $class_item; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $slider_i ); ?>">
		<a class="penci-image-holder owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>"></a>
		<div class="penci-featured-content">
			<a class="featured-slider-overlay penci-gradient" href="<?php the_permalink(); ?>"></a>
			<?php
			if( function_exists( 'penci_icon_post_format' ) ) {
				penci_icon_post_format( true,$class_icon );
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
				<h3 class="entry-title"><a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), $atts['post_big_title_length'] ); ?></a></h3>
				<?php if ( ! $atts['hide_count_view'] || ! $atts['hide_comment'] || ( isset( $atts['show_author'] ) && $atts['show_author'] ) ): ?>
					<div class="penci-slider__meta">
						<?php
						if( function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
							penci_get_post_author( true, false );
						}
						?>
						<?php if ( ! $atts['hide_post_date'] && function_exists( 'penci_get_post_date' ) ): ?>
							<?php penci_get_post_date( get_the_ID(), true ); ?>
						<?php endif; ?>
						<?php if ( ! $atts['hide_count_view'] && function_exists( 'penci_get_post_countview' ) ): ?>
							<?php penci_get_post_countview( get_the_ID(), true ); ?>
						<?php endif; ?>
						<?php if ( ! $atts['hide_comment'] ): ?>
							<span class="entry-meta-item penci-slider__comments"><a href="<?php comments_link(); ?> "><i class="la la-comments"></i>
									<?php comments_number( '0', '1', '%' ); ?>
								</a></span>
						<?php endif; ?>

					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
	if ( $count == 3 || $slider_i == $query_slider->post_count ) {
		echo '</div>';
		$count = 0;
	}
endwhile;
wp_reset_postdata();