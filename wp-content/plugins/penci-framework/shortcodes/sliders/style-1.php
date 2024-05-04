<?php
$slider_i = 0;

while ( $query_slider->have_posts() ) :
	$query_slider->the_post();

	?>
	<div class="penci-item-mag item__medium-thumb <?php Penci_Helper_Shortcode::get_class_item_scolours( $slider_i ); echo esc_attr( ! wp_is_mobile() ? ' penci-item-mag-desk' : '' ); ?>">
		<div class="owl-lazy">
		<?php
		if( ! wp_is_mobile() ) {
			if( has_post_thumbnail( ) ) {
				the_post_thumbnail( 'penci-thumb-auto-400' );
			} else{
				echo '<img height="400" src="' . PENCI_ADDONS_URL . 'assets/img/no-image-slider1.jpg' . '"/>';
			}
		} else{
			echo Penci_Helper_Shortcode::get_image_holder(  array(
				'image_size' => 'penci-thumb-480-320',
				'class'      => 'owl-lazy',
			) );
		}

		?>
		</div>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php
	$slider_i ++;
endwhile;
wp_reset_postdata();