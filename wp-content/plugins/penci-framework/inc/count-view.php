<?php
if( !function_exists( 'penci_get_post_countview' ) ) {
	function penci_get_post_countview( $post_id, $show = false ) {

		$count = (int) get_post_meta( $post_id, '_count-views_all', true );

		$output = '<span class="entry-meta-item penci-post-countview penci_post-meta_item">';
		$output .= '<i class="fa fa-eye"></i><span>' . $count . '</span>';
		$output .= '</span>';

		if ( $show ) {
			echo $output;
		}

		return $output;
	}
}