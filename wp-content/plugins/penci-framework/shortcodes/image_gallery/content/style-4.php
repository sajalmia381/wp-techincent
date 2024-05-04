<?php
$gal_images = '';
foreach ( $images as $i => $image ) {
	$gal_images .= '<div class="item">';
	$gal_images .= Penci_Helper_Shortcode::get_image_holder_gal( $image, 'penci-thumb-760-570' );
	$gal_images .='</div>';
}

return '<div id="' . $unique_id . '" data-id="' . $unique_id . '" class="popup-gallery penci-popup-gallery">' . $gal_images . '</div>';
