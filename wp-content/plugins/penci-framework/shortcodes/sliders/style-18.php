<?php
$slider_i = 0;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();


	?>
	<div class="penci-item-mag penci-item-<?php echo $slider_i; ?>">
		<a class="penci-image-holder" style="background-image:url('<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), 'penci-thumb-960-auto' ); ?>');" href="<?php the_permalink(); ?>" title="<?php echo wp_strip_all_tags( get_the_title() ); ?>"></a>
		<div class="penci-featured-content">
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
				<h3 class="entry-title">
					<a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ); ?></a>
				</h3>
				<?php if ( ! $atts['hide_count_view'] || ! $atts['hide_comment'] || ( isset( $atts['show_author'] ) && $atts['show_author'] ) ): ?>
					<div class="penci-slider__meta">
						<?php
						if( function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
							penci_get_post_author( true, false );
						}
						?>
						<?php if ( ! $atts['hide_post_date'] && function_exists( 'penci_get_post_date' ) ): ?>
							<span class="penci-slider__meta-item penci-slider_post-date"><?php penci_get_post_date( get_the_ID(), true ); ?></span>
						<?php endif; ?>
						<?php if ( ! $atts['hide_count_view'] && function_exists( 'penci_get_post_countview' ) ): ?>
							<span class="penci-slider__meta-item penci-slider__post-countview"><?php penci_get_post_countview( get_the_ID(), true ); ?></span>
						<?php endif; ?>
						<?php if ( ! $atts['hide_comment'] ): ?>
							<span class="penci-slider__meta-item penci-slider__comments"><a href="<?php comments_link(); ?> "><i class="la la-comments"></i><?php  comments_number( '0', '1', '%' ); ?></a></span>
						<?php endif; ?>

					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
	$slider_i ++;
endwhile;
wp_reset_postdata();