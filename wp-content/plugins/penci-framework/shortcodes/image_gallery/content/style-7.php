<?php
$gal_images = '';
$count_img = 0;
$i_imgs = 0;
$total_imgs = is_array( $images ) ? count( (array)$images ) : 0;
foreach ( $images as $image ) {
	$count_img ++;
	$i_imgs ++;

	if ( $count_img == 1 ) {
		echo '<div class="penci-gal-wrapper-item">';
	}
	$img_size = $count_img > 1 ? 'penci-thumb-480-320' : 'penci-thumb-760-570';
	$gal_images .= '<div class="penci-gal-item penci-gal-item-' . $count_img . '">' . Penci_Helper_Shortcode::get_image_holder_gal( $image, $img_size ) . '</div>';

	if ( $count_img == 5 || $i_imgs == $total_imgs ) {
		echo '</div><!--.item gal-->';
		$count_img = 0;
	}
}
return '<div id="' . $unique_id . '" data-id="' . $unique_id . '" class="popup-gallery penci-popup-gallery">' . $gal_images . '</div>';