<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'button' );

$class = 'penci-vc-btn-wapper';
$class .= $atts['align'] ? ' penci-vcbtn-align-' . $atts['align'] : '';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], '' ) : '';
$class .= $atts['class'] ? ' ' . $atts['class'] : '';
$class .= $atts['css_animation'] ? ' ' . $this->getCSSAnimation( $atts['css_animation'] ) : '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_vc_button', $atts ) );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<?php
	$tag      = 'div';
	$btn_link = vc_build_link( $atts['btn_link'] );
	$btn_attr = '';

	if ( isset( $btn_link['url'] ) ) {
		$tag      = 'a';
		$btn_attr = isset( $btn_link['url'] ) ? ' href="' . esc_url( $btn_link['url'] ) . '"' : '';
		$btn_attr .= isset( $btn_link['rel'] ) ? ' rel="' . esc_attr( $btn_link['rel'] ) . '"' : '';
		$btn_attr .= isset( $btn_link['target'] ) ? ' target="' . ( strlen( $btn_link['target'] ) > 0 ? esc_attr( $btn_link['target'] ) : '_self' ) . '"' : '';
	}

	$btn_class = 'penci-vc-btn';
	$btn_class .= 'simple' != $atts['btn_style'] ? ' button' : '';
	$btn_class .= $atts['btn_style'] ? ' penci-vcbtn-' . $atts['btn_style'] : '';
	$btn_class .= $atts['button_fullwidth'] ? ' penci-vcbtn-fullwidth' : '';
	$btn_class .= $atts['title_upper'] ? ' penci-vcbtn-uppearcase' : '';
	$btn_class .= $atts['icon_fontawesome'] && $atts['i_align'] ? ' penci-vcbtn-ialign' . $atts['i_align'] : '';

	printf( '<%s class="%s" %s>%s<span>%s</span>%s</%s>',
		$tag,
		$btn_class,
		$btn_attr,
		'left' == $atts['i_align'] ? '<i class="' . $atts['icon_fontawesome'] . '"></i>' : '',
		$atts['title'],
		'right' == $atts['i_align'] ? '<i class="' . $atts['icon_fontawesome'] . '"></i>' : '',
		$tag
	);
	?>
<?php
$id_vc_button = '#' . $unique_id;
$css_custom = '';

	
$css_custom_btn = '';
$css_custom_btn_hover = '';
if ( 'simple' !== $atts['btn_style'] ) {
	if ( ! empty( $atts['btn_plr'] ) ) {
		$css_custom_btn .= 'padding-left: ' . esc_attr(  $atts['btn_plr'] ) . 'px;';
		$css_custom_btn .= 'padding-right: ' . esc_attr(  $atts['btn_plr'] ) . 'px;';
	}

	if ( ! empty( $atts['btn_ptb'] ) ) {
		$css_custom_btn .= 'padding-top: ' . esc_attr( $atts['btn_ptb'] ) . 'px;';
		$css_custom_btn .= 'padding-bottom: ' . esc_attr( $atts['btn_ptb'] ) . 'px;';
	}

	if ( ! empty( $atts['btn_radius'] ) ) {
		$css_custom_btn .= 'border-radius: ' . esc_attr( $atts['btn_radius'] ) . 'px;';
	}

	if ( $atts['btn_width'] ) {
		$css_custom_btn .= 'border-width: ' . esc_attr( $atts['btn_width'] ) . 'px;';
	}

	if ( ! empty( $atts['btn_bcolor'] ) ) {
		$css_custom_btn .= 'border-color: ' . esc_attr( $atts['btn_bcolor'] ) . ';';
	}elseif( ! empty( $atts['btn_bg'] ) ) {
		$css_custom_btn .= 'border-color:' . $atts['btn_bg'] . ';';
	}

	if( ! empty( $atts['btn_bg'] ) && 'fill' == $atts['btn_style'] ) {
		$css_custom_btn .= 'background-color:' . esc_attr( $atts['btn_bg'] ) . ';';
	}

	if ( ! empty( $atts['btn_hoverbcolor'] ) ) {
		$css_custom_btn_hover .= 'border-color: ' . esc_attr( $atts['btn_hoverbcolor'] ) . ';';
	}elseif( ! empty( $atts['btn_hoverbg'] ) ) {
		$css_custom_btn_hover .= 'border-color:' . $atts['btn_hoverbg'] . ';';
	}

	if( ! empty( $atts['btn_hoverbg'] ) && 'simple' != $atts['btn_style'] ) {
		$css_custom_btn_hover .= 'background-color:' . esc_attr( $atts['btn_hoverbg'] ) . ';';
	}
}

$css_custom_btn .= ! empty( $atts['btn_text_color'] ) ? ' color:' . esc_attr( $atts['btn_text_color'] ) . ';' : '';
$css_custom_btn_hover .= ! empty( $atts['btn_text_hcolor'] ) ? ' color:' . esc_attr( $atts['btn_text_hcolor'] ) . ';' : '';

if( $css_custom_btn ){
	$css_custom .=  $id_vc_button . ' .penci-vc-btn{ ' . $css_custom_btn . ' }';
}

if( $css_custom_btn_hover ){
	$css_custom .=  $id_vc_button . ' .penci-vc-btn:hover{ ' . $css_custom_btn_hover . ' }';
}

// Icon

if( $atts['icon_fontawesome'] ) {
	$css_icon = '';

	if ( $atts['_i_pleft'] ) {
		$css_icon .= 'margin-left:' . esc_attr( $atts['_i_pleft'] ) . 'px;';
	}
	if ( $atts['_i_pright'] ) {
		$css_icon .= 'margin-right:' . esc_attr( $atts['_i_pright'] ) . 'px;';
	}

	if ( $atts['_i_fsize'] ) {
		$css_icon .= 'font-size:' . esc_attr( $atts['_i_fsize'] ) . 'px;';
	}

	if ( $atts['icon_color'] ) {
		$css_icon .= 'color:' . esc_attr( $atts['icon_color'] ) . ';';
	}

	if( $css_icon ){
		$css_custom .=  $id_vc_button . ' .penci-vc-btn i{ ' . $css_icon . ' }';
	}

	if( $atts['icon_hover_color']  ) {
		$css_custom .=  $id_vc_button . ' .penci-vc-btn:hover i{ color:' . $atts['icon_hover_color'] . '; }';
	}
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'btn',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_vc_button . ' .penci-vc-btn{ %s; }' ,
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
?>
</div>


