<?php
$slider22_i = $count = 0;

$slider_title_length = '60';
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$slider22_i ++;
	$count ++;

	$slider_id_trim_title = 'post_standard_title_length';
	$slider22_class = 'penci-item-' . $count;

	if ( $count == 1 ) {
		echo '<div class="penci-slider-wrapper-item">';
	}

	$image_size = 'penci-thumb-480-320';


	if( $count < 3 ) {
		$image_size = 'ppenci-thumb-760-570';
		$slider22_class .= ' item__big-thumb';
		$slider_id_trim_title = 'post_big_title_length';
	}else{
		$slider22_class .= ' item__small-thumb';
	}

	?>

	<div class="penci-item-mag <?php echo $slider22_class; ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<?php
		echo Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => $image_size,
			'class'      => 'owl-lazy',
			'use_penci_lazy' => false
		) );
		?>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php
	if ( $count == 5 || $slider22_i == $query_slider->post_count ) {
		echo '</div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();