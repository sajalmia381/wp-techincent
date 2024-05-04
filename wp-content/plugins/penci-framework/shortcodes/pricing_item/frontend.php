<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$unique_id = 'penci_pricing__' . rand( 1000, 100000000 );

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$class = 'penci-pricing-item';
$class .= $atts['_featured'] ? ' penci-pricing_featured' : '';
$class .= $atts['_design_style'] ? ' penci-pricing-' . esc_attr( $atts['_design_style'] ) : '';
$class .= $this->getExtraClass( $atts['class'] );
$class .= $this->getCSSAnimation( $atts['css_animation'] );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_pricing_item', $atts ) );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( trim( $class ) ); ?>">
	<div class="penci-pricing-inner">
		<?php
		$output_pricing = '<div class="penci-pricing-header">';
		if ( $atts['_image'] && $atts['_use_img'] ) {
			$output_pricing .= '<div class="penci-pricing__image"><img src="' . esc_url( wp_get_attachment_url( $atts['_image'] ) ) . '"></div>';
		}
		if ( $atts['_heading'] ) {
			$output_pricing .= '<div class="penci-pricing__title">' . do_shortcode( $atts['_heading'] ) . '</div>';
		}

		if ( $atts['_subheading'] ) {
			$output_pricing .= '<div class="penci-pricing__subtitle">' . do_shortcode( $atts['_subheading'] ) . '</div>';
		}

		$output_pricing .= '</div>';

		if ( $atts['_price'] || $atts['_unit'] ) {
			$output_pricing .= '<div class="penci-price-unit">';

			if ( $atts['_price'] ) {
				$output_pricing .= '<span class="penci-pricing__price">' . do_shortcode( $atts['_price'] ) . '</span>';
			}

			if ( $atts['_unit'] ) {
				$output_pricing .= '<span class="penci-pricing__unit">' . do_shortcode( $atts['_unit'] ) . '</span>';
			}

			$output_pricing .= '</div>';
		}

		if ( $content ) {
			$output_pricing .= '<div class="penci-pricing__featured">' . wpb_js_remove_wpautop( do_shortcode( $content ), true ) . '</div>';
		}

		$output_pricing .= '<div class="penci-pricing-footer">';

		if ( $atts['_btn_text'] ) {
			$a_before = '<span class="penci-pricing__btn button">';
			$a_after  = '</span>';

			if ( $atts['_btn_link'] ) {
				$url = vc_build_link( $atts['_btn_link'] );
				if ( strlen( $url['url'] ) > 0 ) {
					$rel = '';
					if ( ! empty( $url['rel'] ) ) {
						$rel = ' rel="' . esc_attr( $url['rel'] ) . '"';
					}

					$a_before = '<a class="penci-pricing__btn button" href="' . esc_attr( $url['url'] ) . '" ' . $rel . ' title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">';
					$a_after  = '</a>';
				}
			}

			$output_pricing .= $a_before . do_shortcode( $atts['_btn_text'] ) . $a_after;
		}

		$output_pricing .= '</div>';

		echo $output_pricing;
		?>
	</div>
	<?php
	$id_pricing = '#' . $unique_id;
	$css_custom = '';


	if ( $atts['_use_img'] ) {

		$css_image = '';
		if ( $atts['image_width'] ) {
			$css_image .= 'max-width: ' . esc_attr( $atts['image_width'] ) . ';';
		}
		if ( $atts['image_height'] ) {
			$css_image .= 'height: ' . esc_attr( $atts['image_height'] ) . ';';
		}
		if ( $atts['image_mar_top'] ) {
			$css_image .= 'margin-top: ' . esc_attr( $atts['image_mar_top'] ) . ';';
		}
		if ( $atts['image_mar_bottom'] ) {
			$css_image .= 'margin-bottom: ' . esc_attr( $atts['image_mar_bottom'] ) . ';';
		}

		if ( $css_image ) {
			$css_custom .= $id_pricing . ' .penci-pricing__image{ ' . $css_image . ' }';
		}
	}

	// Color
	if( $atts['bg_color'] ) {
		$css_custom .=  $id_pricing . '{ background-color: ' . esc_attr( $atts['bg_color'] ) . '; }';
	}

	if( $atts['border_color'] ) {
		$css_custom .=  $id_pricing . '{ border-color: ' . esc_attr( $atts['border_color'] ) . '; }';
	}

	if( $atts['_heading_color'] ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__title{ color: ' . esc_attr( $atts['_heading_color'] ) . '; }';
	}

	if( $atts['_subheading_color'] ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__subtitle{ color: ' . esc_attr( $atts['_subheading_color'] ) . '; }';
	}

	if( $atts['_price_color'] ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__price{ color: ' . esc_attr( $atts['_price_color'] ) . '; }';
	}

	if( $atts['_unit_color'] ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__unit{ color: ' . esc_attr( $atts['_unit_color'] ) . '; }';
	}

	if( $atts['features_color'] ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__featured{ color: ' . esc_attr( $atts['features_color'] ) . '; }';
	}

	$btn_css = '';
	if( $atts['btn_bgcolor'] ) {
		$btn_css .= 'background-color:' . esc_attr( $atts['btn_bgcolor'] ) . ';';
	}
	if( $atts['btn_borcolor'] ) {
		$btn_css .= 'border-color:' . esc_attr( $atts['btn_borcolor'] ) . ';';
	}
	if( $atts['btn_borcolor'] ) {
		$btn_css .= 'color:' . esc_attr( $atts['btn_text_color'] ) . ';';
	}

	$btn_hcss = '';
	if( $atts['btn_hbgcolor'] ) {
		$btn_hcss .= 'background-color:' . esc_attr( $atts['btn_hbgcolor'] ) . ';';
	}
	if( $atts['btn_hborcolor'] ) {
		$btn_hcss .= 'border-color:' . esc_attr( $atts['btn_hborcolor'] ) . ';';
	}
	if( $atts['btn_text_hcolor'] ) {
		$btn_hcss .= 'color:' . esc_attr( $atts['btn_text_hcolor'] ) . ';';
	}

	if( $btn_css ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__btn{' . $btn_css . '}';
	}

	if( $btn_hcss ) {
		$css_custom .=  $id_pricing . ' .penci-pricing__btn:hover{' . $btn_hcss . '}';
	}

	// Margin
	if ( $atts['min_height'] ) {
		$css_custom .= $id_pricing . '{ min-height: ' . esc_attr( $atts['min_height'] ) . 'px; }';
	}

	if ( $atts['_heading_mar_bottom'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__title{ margin-bottom: ' . esc_attr( $atts['_heading_mar_bottom'] ) . '; }';
	}

	if ( $atts['_subheading_mar_b'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__subtitle{ margin-bottom: ' . esc_attr( $atts['_subheading_mar_b'] ) . '; }';
	}

	if ( $atts['_price_mar_bottom'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__price{ margin-bottom: ' . esc_attr( $atts['_price_mar_bottom'] ) . '; }';
	}

	if ( $atts['_unit_mar_bottom'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__unit{ margin-bottom: ' . esc_attr( $atts['_unit_mar_bottom'] ) . '; }';
	}
	if ( $atts['_features_martop'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__featured{ margin-bottom: ' . esc_attr( $atts['_features_martop'] ) . '; }';
	}

	if ( $atts['_features_bottom'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__featured{ margin-bottom: ' . esc_attr( $atts['_features_martop'] ) . '; }';
	}

	if ( $atts['item_fea_bottom'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__featured li{ margin-bottom: ' . esc_attr( $atts['item_fea_bottom'] ) . '; }';
	}

	if ( $atts['btn_mar_top'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__btn{ margin-bottom: ' . esc_attr( $atts['btn_mar_top'] ) . '; }';
	}

	if ( $atts['btn_width'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__btn{ max-width: ' . esc_attr( $atts['btn_width'] ) . '; }';
	}

	if ( $atts['btn_height'] ) {
		$css_custom .= $id_pricing . ' .penci-pricing__btn{ height: ' . esc_attr( $atts['btn_height'] ) . '; line-height: ' . esc_attr( $atts['btn_height'] ) . '; }';
	}

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'title',
		'font-size'    => '36px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_pricing . ' .penci-pricing__title{ %s }',
	), $atts
	);

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'subtitle',
		'font-size'    => '14px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_pricing . ' .penci-pricing__subtitle{ %s }',
	), $atts
	);

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'price',
		'font-size'    => '48px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_pricing . ' .penci-pricing__price{ %s }',
	), $atts
	);

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => '_unit',
		'font-size'    => '14px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_pricing . ' .penci-pricing__unit{ %s }',
	), $atts
	);

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'features',
		'font-size'    => '14px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_pricing . ' .penci-pricing__featured,' . $id_pricing . ' .penci-pricing__featured{ %s }',
	), $atts
	);

	$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
		'e_admin'      => 'btn',
		'font-size'    => '14px',
		'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
		'template'     => $id_pricing . ' .penci-pricing__btn{ %s }',
	), $atts
	);

	if ( $css_custom ) {
		echo '<style>';
		echo $css_custom;
		echo '</style>';
	}
	?>
</div>


