<?php
$slider_i = $count = 0;
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();
	$slider_i ++;
	$count ++;

	$slider24_class = 'penci-item-' . $count;
	$slider_id_trim_title = 'post_standard_title_length';
	if ( $count == 1 ) {
		echo '<div class="penci-slider-wrapper-item">';

	}
	if ( $count == 1 || $count == 4 ) {
		$slider24_class .= ' item__big-thumb';
		$slider_id_trim_title = 'post_big_title_length';
	}

	?>
	<div class="penci-item-mag <?php echo esc_attr( $slider24_class ); ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<?php
		echo Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => 'penci-thumb-960-auto',
			'class'      => 'owl-lazy',
			'use_penci_lazy' => false
		) );
		?>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php
	if ( $count == 4 || $slider_i == $query_slider->post_count ) {
		echo '</div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();