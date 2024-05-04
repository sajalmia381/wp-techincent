<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if( ! $show_on_shortcode ) {
	return;
}

if ( empty( $content ) ) {
	return;
}

list( $atts, $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'advanced_carousel' );

$class = 'penci-block-vc penci-advanced_carousel';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], '' ) : '';
$class .= $atts['content_placement'] ? ' penci-placement-' . esc_attr( $atts['content_placement'] )  : '';
$class .= $atts['class'] ? ' ' . $atts['class'] : '';

// Data slider
$data = 'data-style="advanced_carousel"';
$data .= ' data-items="' . ( ! empty( $atts['limit_desk'] ) ? $atts['limit_desk'] : 5 ) . '"';
$data .= ' data-autowidth="' . ( ! empty( $atts['autowidth'] ) ? 1 : 0 ) . '"';
$data .= ' data-auto="' . ( empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 800 ) . '"';
$data .= ' data-loop="' . ( ! empty( $atts['disable_loop'] ) ? 1 : 0 ) . '"';
$data .= ' data-dots="' . ( ! empty( $atts['enable_dots'] ) ? 1 : 0 ) . '"';
$data .= ' data-nav="' . ( empty( $atts['dis_arrows'] ) ? 1 : 0 ) . '"';
$data .= ' data-magrin="' . ( ! empty( $atts['margin_right'] ) ? $atts['margin_right'] : 0 ) . '"';
$data .= ' data-center="0"';

if ( $atts['limit_desk'] ) {
	$data .= ' data-desktop="' . intval( $atts['limit_desk'] ) . '"';
}

if ( $atts['limit_tab'] ) {
	$data .= ' data-tablet="' . intval( $atts['limit_tab'] ) . '"';
}

if ( $atts['limit_mobile'] ) {
	$data .= ' data-tabsmall="' . intval( $atts['limit_mobile'] ) . '"';
}

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_advanced_carousel', $atts ) );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<div class="penci-advanced_carousel-inner penci-owl-carousel-slider penci-owl-featured-area" <?php echo $data; ?>>
		<?php echo do_shortcode( $content ); ?>
	<?php
	$css_custom = '';
	if ( $css_custom ) {
		echo '<style>';
		echo $css_custom;
		echo '</style>';
	}
	?>
	</div>
</div>


