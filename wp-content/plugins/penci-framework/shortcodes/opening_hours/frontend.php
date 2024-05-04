<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$working_hours = (array) vc_param_group_parse_atts( $atts['working_hours'] );

if( empty( $working_hours ) ) {
	return;
}

$class = 'penci-working-hours';
$class .= !empty( $atts['image_pos'] ) ? ' penci-workingh-img-' . $atts['image_pos'] : '';
$class .= !empty( $atts['content_placement'] ) ? ' penci-workingh-content-' . $atts['content_placement'] : '';
$class .= !empty( $atts['class'] ) ? ' ' . $atts['class'] : '';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_opening_hours', $atts ) );

$unique_id = 'penci_openhours__' . rand( 1000, 100000000 );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<div class="penci-workingh-inner">
		<div class="penci-workingh-info">
			<?php if( $atts['title'] ): ?>
				<h3 class="penci-workingh-title"><?php echo $atts['title']; ?></h3>
			<?php endif; ?>

			<?php if( $atts['subtitle'] ): ?>
				<div class="penci-workingh-subtitle"><?php echo $atts['subtitle']; ?></div>
			<?php endif; ?>
			<div class="penci-workingh-lists penci-workingh-<?php echo esc_attr( $atts['columns'] ? $atts['columns'] : 'col1' ); ?>">
				<ul>
					<?php
					foreach ( $working_hours as $working_item ) {
						$working_icon     = isset( $working_item['icon'] ) ? $working_item['icon'] : '';
						$working_title    = isset( $working_item['title'] ) ? $working_item['title'] : '';
						$working_subtitle = isset( $working_item['subtitle'] ) ? $working_item['subtitle'] : '';
						$working_hours    = isset( $working_item['hours'] ) ? $working_item['hours'] : '';

						if ( $working_icon || $working_title || $working_hours || $working_subtitle ) {
							echo '<li class="penci-workingh-item"><div class="penci-workingh-item-inner">';

							if( $working_icon || $working_title || $working_hours ){
								echo '<div class="penci-workingh-line1">';
									echo '<div class="penci-icontitle">';
									echo $working_icon ? '<i class="penci-listitem-icon ' . $working_icon . '"></i>' : '';
									echo $working_title ? '<span class="penci-listitem-title">' . $working_title . '</span>' : '';
									echo '</div>';
									echo $working_hours ? '<span class="penci-listitem-hours">' . $working_hours . '</span>' : '';
								echo '</div>';
							}

							echo $working_subtitle ? '<span class="penci-listitem-subtitle">' . $working_subtitle . '</span>' : '';
							echo '</div></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
		<?php
		if( $atts['image'] ) {

			$class_lazy = $data_src = '';
			$src_thmb   = esc_url( wp_get_attachment_url( $atts['image'] ) );
			if ( function_exists( 'penci_check_lazyload_type' ) ) {
				$class_lazy = penci_check_lazyload_type( 'class', null, false );
				$data_src   = penci_check_lazyload_type( 'src', $src_thmb, false );
			}

			if( $atts['url_img'] ){
				echo '<a class="penci-workingh-img penci-image-holder' . $class_lazy . '" ' . $data_src . ' href="' . esc_attr( $atts['url_img'] ) . '"></a>';
			}else{
				echo '<div class="penci-workingh-img penci-image-holder' . $class_lazy . '" ' . $data_src . '></div>';
			}
		}
		?>
	</div>

</div>

<?php
$id_workings_hours = '#' . $unique_id;
$css_custom  = '';

// Img
if( $atts['image'] ) {

	$img_css = '';
	if ( $atts['image_width'] ) {
		$css_custom .= $id_workings_hours . ' .penci-workingh-img { width: ' . $atts['image_width'] . '%; }';
		$css_custom .= $id_workings_hours . ' .penci-workingh-info { width: ' . intval( 100 - intval( $atts['image_width'] ) ) . '%; }';
	}
	if ( $atts['image_wh_radio'] ) {
		$css_custom .= $id_workings_hours . ' .penci-workingh-img:before { padding-top: ' . $atts['image_wh_radio'] . '%; }';
	}
}

// Color
if ( $atts['title_color'] ) {
	$css_custom .= $id_workings_hours . ' .penci-workingh-title { color: ' . $atts['title_color'] . '; }';
}
if ( $atts['subtitle_color'] ) {
	$css_custom .= $id_workings_hours . ' .penci-workingh-subtitle { color: ' . $atts['subtitle_color'] . '; }';
}

if ( $atts['icon_color'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-icon { color: ' . $atts['icon_color'] . '; }';
}

if ( $atts['item_title_color'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-title { color: ' . $atts['item_title_color'] . '; }';
}
if ( $atts['item_subtitle_color'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-subtitle { color: ' . $atts['item_subtitle_color'] . '; }';
}

if ( $atts['item_hours_color'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-hours { color: ' . $atts['item_hours_color'] . '; }';
}

if ( $atts['item_hours_bgcolor'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-hours{ background-color: ' . $atts['item_hours_bgcolor'] . '; }';
}

// Typo
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'title',
	'font-size'    => '42px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_workings_hours . ' .penci-workingh-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'subtitle',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_workings_hours . ' .penci-workingh-subtitle{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'menu_title',
	'font-size'    => '15px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_workings_hours . ' .penci-listitem-title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'menu_subtitle',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_workings_hours . ' .penci-listitem-subtitle{ %s }',
), $atts
);


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'item_hours',
	'font-size'    => '15px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_workings_hours . ' .penci-listitem-hours{ %s }',
), $atts
);

if ( $atts['icon_fsize'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-icon { font-size: ' . $atts['icon_fsize'] . '; }';
}
if ( $atts['title_margin_bottom'] ) {
	$css_custom .= $id_workings_hours . ' .penci-workingh-title { margin-bottom: ' . $atts['title_margin_bottom'] . '; }';
}
if ( $atts['subtitle_margin_bottom'] ) {
	$css_custom .= $id_workings_hours . ' .penci-workingh-subtitle { margin-bottom: ' . $atts['subtitle_margin_bottom'] . '; }';
}

if ( $atts['menu_item_margin_b'] ) {
	$css_custom .= $id_workings_hours . ' .penci-workingh-item { margin-bottom: ' . $atts['menu_item_margin_b'] . '; }';
}

if ( $atts['menu_item_padding_b'] ) {
	$css_custom .= $id_workings_hours . ' .penci-workingh-item { padding-bottom: ' . $atts['menu_item_padding_b'] . '; }';
}

if ( $atts['menu_item_sub_mar_t'] ) {
	$css_custom .= $id_workings_hours . ' .penci-listitem-subtitle { padding-top: ' . $atts['menu_item_sub_mar_t'] . '; }';
}

// Gap
if ( $atts['gap'] ) {
	$gap_half = intval( $atts['gap'] ) / 2;

	if ( 'col2' == $atts['columns'] ) {
		$css_custom .= sprintf( '%s .penci-workingh-col2 ul{ margin-left: -%spx; margin-right: -%spx; }',
			$id_workings_hours, $gap_half, $gap_half
		);

		$css_custom .= sprintf( '%s .penci-workingh-col2 li{ padding-left: %spx; padding-right: %spx; }',
			$id_workings_hours, $gap_half, $gap_half
		);
	} elseif ( 'col3' == $atts['columns'] ) {
		$css_custom .= sprintf( '%s .penci-workingh-col3 ul{ margin-left: -%spx; margin-right: -%spx; }',
			$id_workings_hours, $gap_half, $gap_half
		);

		$css_custom .= sprintf( '%s .penci-workingh-col3 li{ padding-left: %spx; padding-right: %spx; }',
			$id_workings_hours, $gap_half, $gap_half
		);
	}
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
?>