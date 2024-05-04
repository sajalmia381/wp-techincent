<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts, $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'icon_box' );

$class = 'penci-block-vc penci-icon-box';
$class .= $atts['icon_position'] ? ' penci-ibox-' . $atts['icon_position'] : 'penci-ibox-float-left';
$class .= $atts['background_style'] ? ' penci-ibox-' . $atts['background_style'] : ' penci-ibox-nobgstyle';
$class .= $atts['icon_size'] ? ' penci-ibox-size-' . $atts['icon_size'] : 'penci-ibox-size-md';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], '' ) : '';
$class .= $atts['class'] ? ' ' . $atts['class'] : '';


if ( in_array( $atts['background_style'], array( 'rounded', 'boxed', 'rounded-less' ) ) ) {
	$class .= ' penci-ibox-background';
} elseif ( in_array( $atts['background_style'], array( 'rounded-outline', 'boxed-outline', 'rounded-less-outline' ) ) ) {
	$class .= ' penci-ibox-outline';
}

$class .= $atts['icon_effects'] ? ' penci-ibox-effect-' . $atts['icon_effects'] : '';
$class .= $atts['css_animation'] ? ' ' . $this->getCSSAnimation( $atts['css_animation'] ) : '';

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_info_box', $atts ) );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<div class="penci-ibox-inner">
		<?php
		$a_before = '<span class="penci-ibox-icon-fa">';
		$a_after  = '</span>';
		$url = vc_build_link( $atts['link'] );
		if ( isset( $atts['link'] ) && isset( $url['url'] ) ) {

			$rel = '';
			if ( ! empty( $url['rel'] ) ) {
				$rel = ' rel="' . esc_attr( $url['rel'] ) . '"';
			}

			$a_before = '<a class="penci-ibox-icon-fa" href="' . esc_attr( $url['url'] ) . '" ' . $rel . ' title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">';
			$a_after  = '</a>';
		}

		if ( 'icon' == $atts['icon_type'] ) {
			vc_icon_element_fonts_enqueue( $atts['_icon_type'] );
			$icon_type = $atts['_icon_type'];
			$iconClass = isset( $atts[ 'icon_' . $icon_type ] ) ? esc_attr( $atts[ 'icon_' . $icon_type ] ) : 'fa fa-adjust';
			$icon      = '<div class="penci-ibox-icon penci-ibox-icon--icon">';
			$icon      .= $a_before;
			$icon      .= '<i class="penci-ibox-icon--i ' . $iconClass . '"></i>';
			$icon      .= $a_after;
			$icon      .= '</div>';

			echo $icon;
		} elseif ( $atts['image'] ) {
			$icon = '<div class="penci-ibox-icon penci-ibox-icon--image">';
			$icon .= $a_before;
			$icon .= '<img ' . ( $atts['image_hover'] ? 'class="penci-ibox-img_active"' : '' ) . ' src="' . esc_url( wp_get_attachment_url( $atts['image'] ) ) . '">';
			$icon .= $atts['image_hover'] ? '<img class="penci-ibox-img_hover" src="' . esc_url( wp_get_attachment_url( $atts['image_hover'] ) ) . '">' : '';
			$icon .= $a_after;
			$icon .= '</div>';

			echo $icon;
		}
		if ( $atts['_title'] ) {
			printf( '<h3 class="penci-ibox-title">%s</h3>', esc_attr( $atts['_title'] ) );
		}

		if( $atts['_use_line'] ) {
		echo '<span class="penci-ibox-line"></span>';
		}

		if ( $atts['_text'] ) {
			printf( '<p class="penci-ibox-content">%s</p>', do_shortcode( $atts['_text'] ) );
		}
		?>
	</div>
	<?php
	$id_iconbox = '#' . $unique_id;
	$css_custom = '';
	if ( $atts['_use_line'] ) {

		$css_line = '';
		if ( $atts['line_width'] ) {
			$css_line .= 'width:' . $atts['line_width'] . ';';
		}

		if ( $atts['line_height'] ) {
			$css_line .= 'height:' . $atts['line_height'] . ';';
		}

		if ( $atts['line_margin_top'] ) {
			$css_line .= 'margin-top:' . $atts['line_margin_top'] . ';';
		}

		if ( $atts['line_margin_bottom'] ) {
			$css_line .= 'margin-bottom:' . $atts['line_margin_bottom'] . ';';
		}

		$css_custom .= $id_iconbox . ' .penci-ibox-line { ' . $css_line . ' }';
	}

	if ( 'image' == $atts['icon_type'] && $atts['_image_width_height'] ) {
		$css_custom .= $id_iconbox . ' .penci-ibox-icon--image { width: ' . $atts['_image_width_height'] . '; height: ' . $atts['_image_width_height'] . ' }';
	}

	if ( $atts['icon_mar_top_bottom'] ) {
		$css_custom .= $id_iconbox . ' .penci-ibox-icon { bottom: ' . $atts['icon_mar_top_bottom'] . '; }';
		$css_custom .= $id_iconbox . '.penci-ibox-top-left .penci-ibox-icon,';
		$css_custom .= $id_iconbox . '.penci-ibox-top-center .penci-ibox-icon,';
		$css_custom .= $id_iconbox . '.penci-ibox-top-right .penci-ibox-icon{ margin-bottom: ' . $atts['icon_mar_top_bottom'] . '; }';
	}

	if ( 'custom' == $atts['icon_size'] && 'icon' == $atts['icon_type'] ) {
		if ( $atts['icon_fsize'] ) {
			$css_custom .= $id_iconbox . ' .penci-ibox-icon--icon .penci-ibox-icon--i{ font-size: ' . $atts['icon_fsize'] . '; }';
		}
		if ( $atts['icon_padding'] ) {
			$css_custom .= $id_iconbox . ' .penci-ibox-icon--icon .penci-ibox-icon--i{ padding: ' . $atts['icon_padding'] . '; }';
		}
	}

	// Title color
	if ( $atts['title_color'] ) {
		$css_custom .= $id_iconbox . '.penci-icon-box .penci-ibox-title{ color: ' . $atts['title_color'] . '; }';
	}
	if ( $atts['_content_color'] ) {
		$css_custom .= $id_iconbox . '.penci-icon-box .penci-ibox-content{ color: ' . $atts['_content_color'] . '; }';
	}
	if ( $atts['line_color'] ) {
		$css_custom .= $id_iconbox . '.penci-icon-box .penci-ibox-line{ background-color: ' . $atts['line_color'] . '; }';
	}

	// Icon
	$icon_css = '';
	if ( $atts['icon_color'] ) {
		$icon_css .= ' color: ' . $atts['icon_color'] . ';';
	}
	if ( $atts['icon_bgcolor'] ) {
		$icon_css .= ' background-color: ' . $atts['icon_bgcolor'] . ';';

		if( 's2' != $atts['icon_effects'] ){
			$css_custom .=  $id_iconbox . '.penci-ibox-background.penci-ibox-effect-' .  $atts['icon_effects'] . ' i:after{ background-color: ' . $atts['icon_bgcolor'] . '; }';
		}

	}
	if ( $atts['icon_border_color'] ) {
		$icon_css .= ' border-color: ' . $atts['icon_border_color'] . ';';
		$css_custom .=   $id_iconbox . '.penci-ibox-background.penci-ibox-effect-s2 .penci-ibox-icon--i:after{ box-shadow: 0 0 0 2px ' . $atts['icon_border_color'] . ';}';
		$css_custom .=   $id_iconbox . '.penci-ibox-outline.penci-ibox-effect-s2 .penci-ibox-icon--i:after{ border-color: ' . $atts['icon_border_color'] . ';}';
		$css_custom .=   $id_iconbox . '.penci-ibox-outline.penci-ibox-effect-s2 .penci-ibox-icon--i{ box-shadow: 0 0 0 2px ' . $atts['icon_border_color'] . ';}';
		$css_custom .=   $id_iconbox . '.penci-ibox-outline.penci-ibox-effect-s2 .penci-ibox-icon-fa:hover .penci-ibox-icon--i{box-shadow: 0 0 0 0 rgba(255,255,255,0); }';

	}

	if ( $icon_css ) {
		$css_custom .= $id_iconbox . '.penci-icon-box .penci-ibox-icon-fa i{' . ( $icon_css ) . '; }';
	}

	$icon_hover_css = '';
	if ( $atts['icon_hcolor'] ) {
		$icon_hover_css .= ' color: ' . $atts['icon_hcolor'] . ';';
	}
	if ( $atts['icon_hbgcolor'] ) {
		$icon_hover_css .= ' background-color: ' . $atts['icon_hbgcolor'] . ';';

		$css_custom .= $id_iconbox . '.penci-icon-box.penci-ibox-outline.penci-ibox-effect-s1 .penci-ibox-icon--i::after{ background-color: ' . ( $atts['icon_hbgcolor'] ) . '; }';
	}
	if ( $atts['icon_hborder_color'] ) {
		$icon_hover_css .= ' border-color: ' . $atts['icon_hborder_color'] . ';';
		$css_custom .= $id_iconbox . '.penci-ibox-outline.penci-ibox-effect-s5 .penci-ibox-icon--i:after{  box-shadow: 0 0 0 0 ' . ( $atts['icon_hborder_color'] ) . '; }';
		$css_custom .= $id_iconbox . '.penci-ibox-outline.penci-ibox-effect-s5 .penci-ibox-icon-fa:hover .penci-ibox-icon--i:after{ box-shadow: 3px 3px 0 ' . ( $atts['icon_hborder_color'] ) . '; }';
		$css_custom .= $id_iconbox . '.penci-ibox-background.penci-ibox-effect-s4 i:after{ border-color: ' . ( $atts['icon_hborder_color'] ) . '; }';
	}

	if ( $icon_hover_css && $atts['icon_effects'] ) {
		$css_custom .= $id_iconbox . '.penci-icon-box .penci-ibox-icon-fa:hover i{' . ( $icon_hover_css ) . '; }';
	}

	// Typo
	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'title',
		'font-size'    => '20px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
		'template'     => $id_iconbox . '.penci-icon-box .penci-ibox-title{ %s }',
	), $atts
	);

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'content',
		'font-size'    => '14px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_iconbox . '.penci-icon-box .penci-ibox-content{ %s }',
	), $atts
	);

	if ( $css_custom ) {
		echo '<style>';
		echo $css_custom;
		echo '</style>';
	}
	?>
</div>