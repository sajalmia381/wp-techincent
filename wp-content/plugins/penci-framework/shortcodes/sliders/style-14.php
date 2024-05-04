<?php
echo '<div class="penci-big_items  penci-owl-carousel-style">';
$slider_i = 0;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();
	?>
	<div class="penci-item-mag penci-gradient">
		<a class="penci-image-holder owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), 'penci-thumb-1920-auto' ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>"></a>
		<?php
		if( function_exists( 'penci_icon_post_format' ) ) {
			penci_icon_post_format( true,'lager-size-icon' );
		}
		?>
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
					<a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), $atts['post_big_title_length'] ); ?></a>
				</h3>
				<?php if ( ! $atts['hide_count_view'] || ! $atts['hide_comment'] || ! $atts['hide_post_date'] || ( isset( $atts['show_author'] ) && $atts['show_author'] ) ): ?>
					<div class="penci-slider__meta">
						<?php
						if( function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
							penci_get_post_author( true, false );
						}
						?>
						<?php if ( ! $atts['hide_post_date'] && function_exists( 'penci_get_post_date' ) ): ?>
							<?php penci_get_post_date( ); ?>
						<?php endif; ?>
						<?php if ( ! $atts['hide_count_view'] && function_exists( 'penci_get_post_countview' ) ): ?>
							<?php penci_get_post_countview( get_the_ID(), true ); ?>
						<?php endif; ?>
						<?php if ( ! $atts['hide_comment'] ): ?>
							<span class="entry-meta-item penci-slider__comments"><a href="<?php comments_link(); ?> "><i class="la la-comments"></i><?php  comments_number( '0', '1', '%' ); ?></a></span>
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
echo '</div>';
echo '<div class="penci-small_items-wrapper"><div class="penci-small_items  penci-owl-carousel-style">';
$slider_i = 0;



while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$src_thmb   = Penci_Framework_Helper::get_featured_image_size( get_the_ID(), 'penci-thumb-280-186' );
	$class_lazy = $data_src = '';
	if ( function_exists( 'penci_check_lazyload_type' ) ) {
		$class_lazy = penci_check_lazyload_type( 'class', null, false );
		$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
	}
	?>
	<div class="penci-item-mag">
		<a class="penci-image-holder <?php echo $class_lazy; ?>" <?php echo $data_src; ?> href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>"></a>
		<h3 class="entry-title">
			<a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ); ?></a>
		</h3>
		<?php if (  ! $atts['hide_count_view'] || ! $atts['hide_comment'] || ( isset( $atts['show_author'] ) && $atts['show_author'] ) ): ?>
			<div class="penci-slider__meta">
				<?php
				if( function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
					penci_get_post_author( true, false );
				}
				?>
				<?php if ( ! $atts['hide_post_date'] ): ?>
					<?php penci_get_post_date( get_the_ID(), true ); ?>
				<?php endif; ?>
				<?php if ( ! $atts['hide_comment'] ): ?>
					<span class="entry-meta-item penci-slider__comments"><a href="<?php comments_link(); ?> "><i class="la la-comments"></i><?php  comments_number( '0', '1', '%' ); ?></a></span>
				<?php endif; ?>

			</div>
		<?php endif; ?>
	</div>
	<?php
	$slider_i ++;
endwhile;
wp_reset_postdata();

echo '</div></div>';