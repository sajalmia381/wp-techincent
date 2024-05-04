<?php
$slider_i   = $count = 0;
$post_count = $query_slider->post_count;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$image_size = 'penci-thumb-960-auto';
	$slider_i ++;
	$count ++;

	if ( $count == 1 ) {
		echo '<div class="penci-slider-wrapper-item">';
		$slider_id_trim_title = 'post_big_title_length';

	}
	if ( $count == 2 || $count == 3 ) {
		$image_size           = 'penci-thumb-480-320';
		$slider_id_trim_title = 'post_standard_title_length';
	}

	if ( $count == 4 ) {
		$image_size           = 'penci-thumb-480-645';
		$slider_id_trim_title = 'post_small_title_length';
	}


	if ( $count == 2 ) {
		echo '<div class="penci-item-2-3">';
	}
	?>
	<div class="penci-item-mag penci-item-<?php echo $count; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<a class="penci-image-holder owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>"></a>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php

	if ( $count == 3 || ( $count == 2 && $slider_i == $post_count ) ) {
		echo '</div>';
	}
	if ( $count == 4 || $slider_i == $post_count ) {
		echo '</div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();