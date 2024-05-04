<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts, $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'single_video' );

$class = 'penci-single-video';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
$class .= ' ' . $atts['class'];

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_single_video', $atts ) );
if ( empty( $atts['link'] ) ) {
	return;
}
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<a href="<?php echo esc_url( $atts['link'] ); ?>" class="penci-popup-video">
		<?php if ( ! empty( $atts['cover'] ) ) : ?><img src="<?php echo esc_url( wp_get_attachment_url( $atts['cover'] ) ); ?>" alt=""> <?php endif; ?>
		<div class="penci-popup-video-inner">
			<div class="penci-popup-video-desc"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
			<span class="penci-pvideo-icon"><i class="fa fa-play"></i></span>
		</div>
	</a>
	<?php
	$id_single_video = '#' . $unique_id;
	$css_custom      = '';


	if ( $atts['width_desc'] ) {
		$css_custom .= sprintf( '%s .penci-popup-video-inner{ max-width:%s; }', $id_single_video, $atts['width_desc'] );
	}
	if ( $atts['mar_bottom'] ) {
		$css_custom .= sprintf( '%s .penci-popup-video-desc{ margin-bottom:%s; }', $id_single_video, $atts['mar_bottom'] );
	}

	if ( $atts['desc_color'] ) {
		$css_custom .= sprintf( '%s .penci-popup-video-desc{ color:%s; }', $id_single_video, $atts['desc_color'] );
	}

	if ( $atts['font_size_play'] ) {
		$css_custom .= sprintf( '%s.penci-single-video i{ font-size:%s; }', $id_single_video, $atts['font_size_play'] );
	}

	if ( $atts['color_play_bgcolor'] ) {
		$css_custom .= sprintf( '%s.penci-single-video i{ background-color:%s; }', $id_single_video, $atts['color_play_bgcolor'] );
	}
	if ( $atts['color_play_color'] ) {
		$css_custom .= sprintf( '%s.penci-single-video i{ color:%s; }', $id_single_video, $atts['color_play_color'] );
	}
	if ( $atts['wh_iconplay'] ) {
		$css_custom .= sprintf( '%s.penci-single-video i{ width:%s;height:%s;line-height:%s; }', $id_single_video, $atts['wh_iconplay'], $atts['wh_iconplay'],  $atts['wh_iconplay'] );
	}
	if ( $atts['hover_color_play_color'] ) {
		$css_custom .= sprintf( '%s.penci-single-video i:hover{ color:%s; }', $id_single_video, $atts['hover_color_play_color'] );
	}
	if ( $atts['hover_color_play_hbgcolor'] ) {
		$css_custom .= sprintf( '%s.penci-single-video i:hover{ background-color:%s; }', $id_single_video, $atts['hover_color_play_hbgcolor'] );
	}

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'desc',
		'font-size'    => '',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_single_video . ' .penci-popup-video-desc{ %s }',
	), $atts
	);

	$css_custom .= '@media screen and (max-width: 600px) { .penci-single-video .penci-popup-video-desc { display: none; } }';


	if ( $css_custom ) {
		echo '<style>';
		echo $css_custom;
		echo '</style>';
	}
	?>
</div>