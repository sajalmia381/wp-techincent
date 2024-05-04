<?php
$slider_i = 0;
$slider_title_length = '55';
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$class_item = 'item__medium-thumb';
	$image_size = 'penci-thumb-480-645';
	?>
	<div class="penci-item-mag <?php echo esc_attr( $class_item ); ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $slider_i ); ?>">
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
	$slider_i ++;
endwhile;
wp_reset_postdata();