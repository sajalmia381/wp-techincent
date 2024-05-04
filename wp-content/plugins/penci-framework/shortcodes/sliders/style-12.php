<?php
echo '<div class="penci-big_items  penci-owl-carousel-style">';
$slider_i = 0;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();
	?>
	<div class="penci-item-mag">
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
				<?php if ( ! $atts['hide_count_view'] || ! $atts['hide_comment'] || ( isset( $atts['show_author'] ) && $atts['show_author'] ) ): ?>
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
							<span class="entry-meta-item penci-slider__comments"><a href="<?php comments_link(); ?> "><i class="la la-comments"></i>
									<?php
									if( function_exists( 'penci_get_tran_setting' ) ){
										comments_number( penci_get_tran_setting( 'penci_comment_zero' ), penci_get_tran_setting( 'penci_comment_one' ), '% ' . penci_get_tran_setting( 'penci_comment_more' )  );
									}else{
										comments_number( esc_html__( '0 comment', 'penci-framework' ), esc_html__( '1 comments', 'penci-framework' ), '% ' . esc_html__( 'comments', 'penci-framework' ) );
									}
									?>
								</a></span>
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

	?>
	<div class="penci-item-mag">
		<div class="penci_media_object">
			<?php if( !$atts['hide_small_thumb'] ) : ?>
			<a class="penci-image-holder penci_post_thumb penci_mobj__img owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), 'thumbnail' ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>"></a>
			<?php endif; ?>
			<div class="penci_post_content penci_mobj__body">
				<?php if ( ! $atts['hide_cat'] ): ?>
					<div class="cat penci-slider__cat"><?php Penci_Framework_Helper::show_category( '' ); ?></div>
				<?php endif; ?>
				<h3><a title="<?php echo wp_strip_all_tags( get_the_title() ); ?>" href="<?php the_permalink() ?>"><?php echo penci_trim_post_title( get_the_ID(), $atts['post_standard_title_length'] ); ?></a></h3>
				<?php if ( ! $atts['hide_count_view'] || ! $atts['hide_comment'] || ( isset( $atts['show_author'] ) && $atts['show_author'] ) ): ?>
					<div class="penci-slider__meta">
						<?php
						if( function_exists( 'penci_get_post_author' ) && isset( $atts['show_author'] ) && $atts['show_author'] ){
							penci_get_post_author( true, false );
						}
						?>
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
	$slider_i ++;
endwhile;
wp_reset_postdata();

echo '</div></div>';