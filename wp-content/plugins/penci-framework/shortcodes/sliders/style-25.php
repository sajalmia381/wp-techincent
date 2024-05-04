<?php
$slider25_i = $count = 0;
$post_count = $query_slider->post_count;

while ( $query_slider->have_posts() ) :
	$query_slider->the_post();
	$slider25_i ++;
	$count ++;

	$slider25_class = 'penci-item-' . $count;
	$slider25_imgsize = 'penci-thumb-480-320';
	$slider_id_trim_title = 'post_standard_title_length';

	if( 1 == $count || 7 == $count ){
		$slider25_class .= ' penci-big-thumb item__big-thumb';
		$slider25_imgsize = 'penci-thumb-760-570';
		$slider_id_trim_title = 'post_big_title_length';
	}else{
		$slider25_class .= ' penci-small-thumb';
	}

	if ( $count == 1 ) {
		echo '<div class="penci-slider-wrapper-item">';
		echo '<div class="penci-item-row penci-item-row1">';

	}

	if ( $count == 3 ) {
		echo '<div class="penci-item-row penci-item-row2">';

	}

	if ( $count == 6 ) {
		echo '<div class="penci-item-row penci-item-row3">';

	}

	?>
	<div class="penci-item-mag <?php echo esc_attr( $slider25_class ); ?> <?php Penci_Helper_Shortcode::get_class_item_scolours( $count ); ?>">
		<?php
		echo Penci_Helper_Shortcode::get_image_holder(  array(
			'image_size' => $slider25_imgsize,
			'class'      => 'owl-lazy',
			'use_penci_lazy' => false
		) );
		?>
		<?php include dirname( __FILE__ ) . "/content-items.php"; ?>
	</div>
	<?php
	if( 2 == $count || ( $count < 2 && $slider25_i == $post_count ) ){
		echo '</div>';
	}

	if( 5 == $count || ( $count > 2 && $count < 5  && $slider25_i == $post_count ) ){
		echo '</div>';
	}

	if( 7 == $count || ( $count > 5 && $count < 7 && $slider25_i == $post_count ) ){
		echo '</div>';
	}

	if ( $count == 7 || $slider25_i == $post_count ) {
		echo '</div><!--.item slider-->';
		$count = 0;
	}
endwhile;
wp_reset_postdata();