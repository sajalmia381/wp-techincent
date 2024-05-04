<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'fancy_heading' );

$class = 'penci-block-vc penci-fancy-heading';
$class .= ' penci-heading-text-' . $atts['_text_align'];
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], '' ) : '';
$class .= $atts['class'] ? ' ' . $atts['class'] : '';
$class .= $atts['css_animation'] ? ' ' . $this->getCSSAnimation( $atts['css_animation'] ) : '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_fancy_heading', $atts ) );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
<div class="penci-fancy-heading-inner">
	<?php

	$subtitle = '';
	if( $atts['subtitle'] ) {
		$subtitle = sprintf( '<%s class="penci-heading-subtitle">%s</%s>', esc_attr( $atts['subtitle_tag'] ), $atts['subtitle'], esc_attr( $atts['subtitle_tag'] ) );
	}

	if( $subtitle && 'above' == $atts['subtitle_pos'] ) {
		echo $subtitle;
	}

	if( $atts['title'] ) {
		printf( '<%s class="penci-heading-title">%s</%s>', esc_attr( $atts['title_tag'] ), $atts['title'], esc_attr( $atts['title_tag'] ) );
	}

	if( $subtitle && 'below' == $atts['subtitle_pos'] ) {
		echo $subtitle;
	}

	if ( $atts['_use_separator'] ) {

		$icon = '';

		if ( $atts['add_separator_icon'] ) {
			$icon_type = $atts['_icon_type'];
			vc_icon_element_fonts_enqueue( $atts['_icon_type'] );
			$iconClass = isset( $atts[ 'icon_' . $icon_type ] ) ? esc_attr( $atts[ 'icon_' . $icon_type ] ) : 'fa fa-adjust';
			$icon = '<span class="penci-heading-icon ' . $iconClass . '"></span>';
		}

		echo '<div class="penci-separator penci-separator-' . esc_attr( $atts['separator_style'] ) . ' penci-separator-align-' . $atts['_text_align'] . '">';
		echo '<span class="penci-sep_holder penci-sep_holder_l"><span class="penci-sep_line"></span></span>';
		echo $icon;
		echo '<span class="penci-sep_holder penci-sep_holder_r"><span class="penci-sep_line"></span></span>';
		echo '</div>';
	}

	if( $subtitle && 'belowline' == $atts['subtitle_pos'] ) {
		echo $subtitle;
	}

	echo '<div class="penci-heading-content entry-content">' . wpb_js_remove_wpautop( $content, true ) . '</div>';
	?>
</div>
<?php
$id_fancy_heading = '#' . $unique_id;
$css_custom       = '';

// Margin
if( $atts['subtitle_margin_top'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-subtitle{ margin-top: ' . esc_attr( $atts['subtitle_margin_top'] ) . '; }';
}
if( $atts['subtitle_margin_bottom'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-subtitle{ margin-bottom: ' . esc_attr( $atts['subtitle_margin_bottom'] ) . '; }';
}

if( $atts['subtitle_width'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-subtitle{ max-width: ' . esc_attr( $atts['subtitle_width'] ) . '; }';
}

if( $atts['separator_margin_top'] ) {
	$css_custom .= $id_fancy_heading . ' .penci-separator{ margin-top: ' . esc_attr( $atts['separator_margin_top'] ) . '; }';
}

if( $atts['content_margin_top'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-content{ margin-top: ' . esc_attr( $atts['content_margin_top'] ) . '; }';
}
$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-content{ margin-bottom: 0; }';

if( $atts['content_width'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-content{ max-width: ' . esc_attr( $atts['content_width'] ) . '; }';
}

// Separator
if ( $atts['separator_width'] ) {
	$css_custom .= $id_fancy_heading . ' .penci-separator{ width: ' . esc_attr( $atts['separator_width'] ) . '; }';
}


if ( $atts['separator_border_width'] && $atts['separator_border_width'] > 1 ) {
	$css_custom .= $id_fancy_heading . ' .penci-separator .penci-sep_line{ border-width: ' . esc_attr( $atts['separator_border_width'] ) . 'px; top: -' . ( intval( $atts['separator_border_width'] ) / 2 ) . 'px; }';

	if ( 'double' == $atts['separator_style'] ) {
		$height_separator_pre = ( intval( $atts['separator_border_width'] ) * 2 ) + 4;
		$css_custom           .= $id_fancy_heading . ' .penci-separator.penci-separator-double{ height: ' . $height_separator_pre . 'px;}';
		$css_custom           .= $id_fancy_heading . ' .penci-separator.penci-separator-double:before,' . $id_fancy_heading . ' .penci-separator.penci-separator-double:after{ border-top-width: ' . esc_attr( $atts['separator_border_width'] ) . 'px;}';
	}
}

if ( $atts['separator_style'] ) {
	$css_custom .= $id_fancy_heading . ' .penci-separator .penci-sep_line{ border-top-style: ' . esc_attr( $atts['separator_style'] ) . '; }';
}

// Color
if ( $atts['turn_on_title'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ text-transform: uppercase; }';
}

if ( $atts['title_color'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ color: ' . esc_attr( $atts['title_color'] ) . '; }';
}

if ( $atts['subtitle_color'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-subtitle{ color: ' . esc_attr( $atts['subtitle_color'] ) . '; }';
}
if ( $atts['_content_color'] ) {
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-content{ color: ' . esc_attr( $atts['_content_color'] ) . '; }';
}
if ( $atts['_separator_border_color'] ) {
	$css_custom .= $id_fancy_heading . ' .penci-separator .penci-sep_line{ border-color: ' . esc_attr( $atts['_separator_border_color'] ) . '; }';
	$css_custom .= $id_fancy_heading . ' .penci-separator.penci-separator-double:before,' . $id_fancy_heading . ' .penci-separator.penci-separator-double:after{ border-color: ' . esc_attr( $atts['_separator_border_color'] ) . '; }';
}

// typo
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'title',
	'font-size'    => '36px',
	'font_style'   => 'normal',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'subtitle',
	'font-size'    => '16px',
	'font_style'   => 'normal',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_fancy_heading . '.penci-fancy-heading .penci-heading-subtitle{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'content',
	'font-size'    => '16px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_fancy_heading . '.penci-fancy-heading .penci-heading-content{ %s }',
), $atts
);

// Icon
$css_custom_icon = '';
if ( $atts['icon_size'] && '20px' != $atts['icon_size'] ) {
	$css_custom_icon .= 'font-size: ' . esc_attr( $atts['icon_size'] ) . ';';
}

if ( $atts['icon_mar_top_bottom'] && '10px' != $atts['icon_mar_top_bottom'] ) {
	$css_custom_icon .= 'margin-top: ' . esc_attr( $atts['icon_mar_top_bottom'] ) . '; margin-bottom: ' . esc_attr( $atts['icon_mar_top_bottom'] ) . ';';
}

if ( $atts['icon_mar_left_right'] && '20px' != $atts['icon_mar_left_right'] ) {
	$css_custom_icon .= 'margin-left: ' . esc_attr( $atts['icon_mar_left_right'] ) . '; margin-right: ' . esc_attr( $atts['icon_mar_left_right'] ) . ';';
}

if ( $atts['_separator_icon_color'] ) {
	$css_custom_icon .= 'color: ' . esc_attr( $atts['_separator_icon_color'] ) . ';';
}

if ( $css_custom_icon ) {
	$css_custom .= $id_fancy_heading . ' .penci-separator .penci-heading-icon{ ' . ( $css_custom_icon ) . ' }';
}

if ( $atts['title_dektop_fsize'] ) {
	$css_custom .=  '@media screen and (min-width: 1025px){' ;
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ font-size: ' . esc_attr( $atts['title_dektop_fsize'] ) . '; } }';
}

if ( $atts['title_md_fsize'] ) {
	$css_custom .=  '@media screen and (min-width: 769px) and (max-width: 1024px){';
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ font-size: ' . esc_attr( $atts['title_md_fsize'] ) . '; } }';
}

if ( $atts['title_sm_fsize'] ) {
	$css_custom .=  '@media screen and (min-width: 481px) and (max-width: 768px){';
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ font-size: ' . esc_attr( $atts['title_sm_fsize'] ) . '; } }';
}

if ( $atts['title_xs_fsize'] ) {
	$css_custom .=  '@media screen and (max-width: 480px){';
	$css_custom .= $id_fancy_heading . '.penci-fancy-heading .penci-heading-title{ font-size: ' . esc_attr( $atts['title_xs_fsize'] ) . '; } }';
}


if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
?>
</div>


