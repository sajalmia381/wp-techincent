<?php
$output = include dirname( __FILE__ ) . "/content/{$atts['style']}.php";

return Penci_Helper_Shortcode::pre_output_content_items( $output , $atts );
