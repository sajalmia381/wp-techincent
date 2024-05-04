<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$class = 'penci-counter-up';
$class .= !empty( $atts['class'] ) ? ' ' . $atts['class'] : '';
$class .= !empty( $atts['cup_style'] ) ? ' penci-counter-up-' . $atts['cup_style'] : 'penci-counter-up-s1';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_counter_up', $atts ) );

$unique_id = 'penci_counterup__' . rand( 1000, 100000000 );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<div class="penci-counter-up_inner">
		<?php
		if ( 'icon' == $atts['icon_type'] ) {
			vc_icon_element_fonts_enqueue( $atts['_icon_type'] );
			$icon_type = $atts['_icon_type'];
			$icon = '';
			if( isset( $atts[ 'icon_' . $icon_type ] ) && esc_attr( $atts[ 'icon_' . $icon_type ] ) ){
				$icon      = '<div class="penci-cup_icon penci-cup_icon--icon">';
				$icon      .= '<i class="penci-cup_iconn--i ' . $atts[ 'icon_' . $icon_type ] . '"></i>';
				$icon      .= '</div>';
			}
			
			echo $icon;
		} elseif ( $atts['image'] ) {
			$icon = '<div class="penci-cup_icon penci-cup_icon--image">';
			$icon .= '<img src="' . esc_url( wp_get_attachment_url( $atts['image'] ) ) . '">';
			$icon .= '</div>';

			echo $icon;
		}

		$data_delay  = $atts['delay'] ? $atts['delay'] : 0;
		$data_time   = $atts['time'] ? $atts['time'] : 2000;
		$data_number = $atts['number'] ? $atts['number'] : 0;
		?>
		<div class="penci-cup-info">
			<div class="penci-cup-number-wrapper">
				<?php if( $atts['prefix_number'] ): ?><span class="penci-cup-label penci-cup-prefix"><?php echo $atts['prefix_number']; ?></span><?php endif; ?>
				<span class="penci-counterup-number" data-delay="<?php echo $data_delay; ?>" data-time="<?php echo $data_time; ?>" data-count="<?php echo $data_number; ?>">0</span>
				<?php if( $atts['suffix_number'] ): ?><span class="penci-cup-label penci-cup-postfix"><?php echo $atts['suffix_number']; ?></span><?php endif; ?>
			</div>
			<div class="penci-cup-title"><?php echo $atts['title']; ?></div>
			<?php
			if ( $atts['use_button'] ) {

				$btn_type = 'background' == $atts['btn_type'] ? ' penci-cup-typebg button' : '';
				$a_before = '<span class="penci-cup-btn' . $btn_type . '">';
				$a_after  = '</span>';

				if ( $atts['button_link'] ) {
					$url = vc_build_link( $atts['button_link'] );
					if ( strlen( $url['url'] ) > 0 ) {
						$rel = '';
						if ( ! empty( $url['rel'] ) ) {
							$rel = ' rel="' . esc_attr( $url['rel'] ) . '"';
						}

						$a_before = '<a class="penci-cup-btn ' . $btn_type . '" href="' . esc_attr( $url['url'] ) . '" ' . $rel . ' title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">';
						$a_after  = '</a>';
					}
				}

				echo $a_before . do_shortcode( $atts['button_text'] ) . $a_after;
			}
			?>
		</div>
	</div>
</div>

<?php
$id_count_up = '#' . $unique_id;
$css_custom    = '';

if ( 'icon' == $atts['icon_type'] ) {
	$css_icon = '';

	if( $atts['icon_fsize'] ) {
		$css_icon .= 'font-size: ' . $atts['icon_fsize'] . ';';
	}

	if( $atts['icon_border_style'] ) {
		$css_icon .= 'border-style: ' . $atts['icon_border_style'] . ';';
	}

	if( $atts['icon_border_width'] ) {
		$css_icon .= 'border-width: ' . $atts['icon_border_width'] . ';';
	}

	if( $atts['icon_border_radius'] ) {
		$css_icon .= 'border-radius: ' . $atts['icon_border_radius'] . ';';
	}
	if( $atts['icon_padding'] ) {
		$css_icon .= 'padding: ' . $atts['icon_padding'] . ';';
	}

	if( $atts['icon_margin_bottom'] ) {
		$css_icon .= 'margin-bottom: ' . $atts['icon_margin_bottom'] . ';';
	}

	if( $css_icon ) {
		$css_custom .= $id_count_up . ' .penci-cup_icon--icon{ ' . $css_icon . ' }';
	}
}else{
	$css_img = '';

	if ( $atts['_image_width_height'] ) {
		$css_img .= 'width: ' . $atts['_image_width_height'] . '; height: ' . $atts['_image_width_height'] . ';';
	}

	if ( $atts['icon_margin_bottom'] ) {
		$css_img .= 'margin-button: ' . $atts['icon_margin_bottom'] . ';';
	}

	if( $css_img ) {
		$css_custom .= $id_count_up . ' .penci-cup_icon--image{ ' . $css_img . ' }';
	}
}

if ( 's1' == $atts['cup_style'] && $atts['cup_align'] ) {
	if ( 'left' == $atts['cup_align'] ) {
		$css_custom .= $id_count_up . '.penci-counter-up-s1 { text-align: left; }';
	} elseif ( 'right' == $atts['cup_align'] ) {
		$css_custom .= $id_count_up . '.penci-counter-up-s1 { text-align: right; }';
	}
}

if( $atts['number_margin_top'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-number-wrapper{ margin-top: ' . $atts['number_margin_top'] . '; }';
}

if( $atts['title_margin_top'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-title{ margin-top: ' . $atts['title_margin_top'] . '; }';
}

if( $atts['button_margin_top'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-btn{ margin-top: ' . $atts['button_margin_top'] . '; }';
}

if( $atts['button_margin_bottom'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-btn{ margin-bottom: ' . $atts['button_margin_bottom'] . '; }';
}

//  Color
if( $atts['icon_color'] ) {
	$css_custom .= $id_count_up . ' .penci-cup_iconn--i{ color: ' . $atts['icon_color'] . '; }';
}

if( $atts['icon_border_color'] ) {
	$css_custom .= $id_count_up . ' .penci-cup_icon--icon{ border-color: ' . $atts['icon_border_color'] . '; }';
}
if( $atts['icon_bgcolor'] ) {
	$css_custom .= $id_count_up . ' .penci-cup_icon--icon{ background-color: ' . $atts['icon_bgcolor'] . '; }';
}
if( $atts['number_color'] ) {
	$css_custom .= $id_count_up . ' .penci-counterup-number{ color: ' . $atts['number_color'] . '; }';
}
if( $atts['frefix_color'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-label{ color:' . $atts['frefix_color'] . '; }';
}

if( $atts['title_color'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-title{ color:' . $atts['title_color'] . '; }';
}

if( $atts['btn_color'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-btn { color: ' . $atts['btn_color'] . '; }';
}
if( $atts['btn_bgcolor'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-btn{  background-color:' . $atts['btn_bgcolor'] . '; }';
}
if( $atts['btn_hcolor'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-btn:hover{ color:' . $atts['btn_hcolor'] . '; }';
}
if( $atts['btn_hbgcolor'] ) {
	$css_custom .= $id_count_up . ' .penci-cup-btn:hover{ background-color: ' . $atts['btn_hbgcolor'] . '; }';
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'number',
	'font-size'    => '50px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_count_up . ' .penci-counterup-number{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'pre_postfix',
	'font-size'    => '50px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_count_up . ' .penci-cup-label{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'title',
	'font-size'    => '24px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_count_up . ' .penci-cup-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'btn',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_count_up . ' .penci-cup-btn{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
?>