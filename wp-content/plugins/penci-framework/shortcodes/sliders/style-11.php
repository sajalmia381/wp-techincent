<?php
$slider_i = $count = 0;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$slider_i ++;
	$count ++;

	$image_size           = 'penci-thumb-480-320';
	$slider11_class       = 'penci-item-' . $count;
	$slider_id_trim_title = 'post_standard_title_length';

	if ( $count == 1 ) {
		echo '<div class="penci-slider-wrapper-item">';
		echo '<div class="penci-slider11-item penci-slider11-item-' . ( $slider_i % 5 ) . '">';
	}

	if ( $count == 3 ) {
		$image_size           = 'penci-thumb-760-570';
		$slider11_class       .= ' item__big-thumb';
		$slider_id_trim_title = 'post_big_title_length';
	}
	?>
	<div class="penci-item-mag <?php echo $slider11_class; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<a class="penci-image-holder owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>"></a>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php

	if ( $slider_i % 5 == 2 || $slider_i % 5 == 3 ) {
		echo '</div><div class="penci-slider11-item penci-slider11-item-' . ( $slider_i % 5 ) . '">';
	}
	if ( $count == 5 || $slider_i == $query_slider->post_count ) {
		echo '</div></div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();