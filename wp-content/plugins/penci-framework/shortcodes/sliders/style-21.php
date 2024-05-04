<?php
$slider21_i = $count = 0;

$slider_title_length = '60';
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$slider21_i ++;
	$count ++;

	$slider_id_trim_title = 'post_standard_title_length';
	$slider21_class = 'penci-item-' . $count;
	$slider21_imgsize = 'penci-thumb-480-320';

	if ( $count == 1 ) {
		echo '<div class="penci-slider-wrapper-item">';
	}



	if ( $count == 4 || $count == 5 ) {
		$slider21_class .= ' item__big-thumb';
		$slider_id_trim_title = 'post_big_title_length';
		$slider21_imgsize = 'penci-thumb-760-570';
	}else {
		$slider21_class .= ' item__small-thumb';
	}
	?>

	<div class="penci-item-mag <?php echo $slider21_class; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<?php
		echo Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => $slider21_imgsize,
			'class'      => 'owl-lazy',
			'use_penci_lazy' => false
		) );
		?>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php
	if ( $count == 5 || $slider21_i == $query_slider->post_count ) {
		echo '</div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();