<?php
$slider_i = 0;
$slider_title_length ='70';
while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	$class_item = 'item__medium-thumb';
	$image_size = 'penci-thumb-480-320';
	?>
	<div class="penci-item-mag <?php echo esc_attr( $class_item ); ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $slider_i ); ?>">
		<a class="penci-image-holder owl-lazy" data-src="<?php echo Penci_Framework_Helper::get_featured_image_size( get_the_ID(), $image_size ); ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>">
		</a>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php
	$slider_i ++;
endwhile;
wp_reset_postdata();