<?php
$gal_images = '';
foreach ( $images as $i => $image ) {

	if ( $image > 0 ) {
		$img           = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size ) );
		$thumbnail     = $img['thumbnail'];
		$large_img_src = $img['p_img_large'][0];
	} else {
		$large_img_src = $default_src;
		$thumbnail     = '<img src="' . $default_src . '" />';
	}

	$gal_images .= '<div class="item"><a  href="' . $large_img_src . '">' . $thumbnail .'</a></div>';

}
return '<div id="' . $unique_id . '" data-id="' . $unique_id . '" class="popup-gallery penci-popup-gallery">' . $gal_images . '</div>';