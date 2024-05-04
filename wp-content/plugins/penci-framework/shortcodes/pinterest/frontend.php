<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'pinterest_widget' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_pinterest', $atts ) );

?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci_pinterest_widget <?php echo esc_attr( $class ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php
			echo '<div class="penci-pinterest-widget-container">';

			// Render the pinboard from the widget settings.
			$username = $atts['username'];
			$numbers  = $atts['numbers'] ? $atts['numbers'] : 9;
			$follow   = $atts['follow'];
			$cache    = $atts['cache'];

			if (empty($atts['username'])) {
	            esc_html_e( 'pinterest data error: pinterest data is not set, please check the ID','penci-framework' );
	        }elseif (preg_match('/.+\/.+/', $atts['username']) === 0) {
	            esc_html_e( 'pinterest data error: Please add the board name','penci-framework' );
	        }

			$pinboard = new Penci_Pinterest();
			$pinboard->render_html( $username, $numbers, $cache, $follow );

			echo '</div>';
			?>
		</div>
	</div>
<?php

$id_pinterest = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_pinterest, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_pinterest, $atts );

if( $atts['pin_link_color'] ) {
	$css_custom .= sprintf( '%s .penci-pinterest-widget-container .pin_link a{ color: %s !important; }',$id_pinterest, $atts['pin_link_color']  );
}

if( $atts['pin_link_hcolor'] ) {
	$css_custom .= sprintf( '%s .penci-pinterest-widget-container .pin_link a:hover{ color: %s !important; }',$id_pinterest, $atts['pin_link_hcolor']  );
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
