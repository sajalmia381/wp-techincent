<?php
$slider26_i = $count = 0;
$post_count = $query_slider->post_count;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();
	$slider26_i ++;
	$count ++;

	$slider26_class       = 'penci-item-' . $count;
	$slider26_imgsize     = 'penci-thumb-760-570';
	$slider_id_trim_title = 'post_standard_title_length';


	if ( $count == 3 || $count == 4 ) {
		$slider_id_trim_title = 'post_small_title_length';
		$slider26_class .= ' item__small_thumb';
		$slider26_imgsize     = 'penci-thumb-480-320';
	}


	if ( $count == 1 ) {
		$slider26_class       .= ' item__big-thumb';

		$slider_id_trim_title = 'post_big_title_length';
		echo '<div class="penci-slider-wrapper-item">';
	}

	if ( $count == 2 ) {
		echo '<div class="penci-item-row">';

	}

	if ( $count == 5 ) {
		$slider26_imgsize = 'penci-thumb-480-645';
	}

	?>
	<div class="penci-item-mag <?php echo esc_attr( $slider26_class ); ?>  <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<?php
		echo Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => $slider26_imgsize,
			'class'      => 'owl-lazy',
			'use_penci_lazy' => false
		) );
		?>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php

	if ( 4 == $count || ( $count > 1 && $count < 4 && $slider26_i == $post_count ) ) {
		echo '</div>';
	}


	if ( $count == 5 || $slider26_i == $post_count ) {
		echo '</div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();