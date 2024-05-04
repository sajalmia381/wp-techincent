<?php
$slider_i = $count = 0;
$post_count = $query_slider->post_count;

while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$slider_i ++;
	$count ++;

	$image_size = 'penci-thumb-480-320';
	$class_item = 'item__medium-thumb';
	$slider_id_trim_title = 'post_standard_title_length';

	if ( $count == 1 ) {
		$class_item = 'item__big-thumb';
		$image_size = 'penci-thumb-760-570';
		$slider_id_trim_title = 'post_big_title_length';
		echo '<div class="penci-slider-wrapper-item">';
	}
	if( $count == 2 ){
		echo '<div class="penci-item-mag-item-2_3">';
	}
	?>
	<div class="penci-item-mag penci-item-<?php echo $count; ?> <?php echo $class_item; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<a class="penci-image-holder owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>">
		</a>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php

	if ( $count == 3 || ( $slider_i ==  $post_count &&  $count > 1 ) ) {
		echo '</div>';
	}

	if ( $count == 3 || $slider_i == $post_count ) {
		echo '</div>';
		$count = 0;
	}
endwhile;
wp_reset_postdata();