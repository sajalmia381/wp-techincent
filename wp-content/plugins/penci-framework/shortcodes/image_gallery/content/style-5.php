<?php
$gal_images = '';
$gal_1_i = $count = 0;

$total_img = is_array( $images ) ? count( (array)$images ) : 0;
foreach ( $images as $image ) {

	$image_size = 'penci-thumb-280-186';
	$count ++;
	$gal_1_i ++;

	if ( $count == 1 ) {
		$gal_images .= '<div class="penci-gal-wrapper-item">';
		$image_size = 'penci-thumb-760-570';
	}

	if ( $image < 0 ) {
		continue;
	}
	$gal_images .= '<div class="penci-gal-item penci-gal-item-' . $count . '">' . Penci_Helper_Shortcode::get_image_holder_gal( $image, $image_size ) . '</div>';

	if ( $count == 5 || $gal_1_i == $total_img ) {
		$gal_images .= '</div><!--.item gal-->';
		$count      = 0;
	}
}

return '<div id="' . $unique_id . '" data-id="' . $unique_id . '" class="popup-gallery penci-popup-gallery">' . $gal_images . '</div>';