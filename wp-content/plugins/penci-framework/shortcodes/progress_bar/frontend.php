<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$values = (array) vc_param_group_parse_atts( $atts['values'] );

if ( empty( $values ) ) {
	return;
}

wp_enqueue_script( 'waypoints' );

$unique_id = 'penci_progressbar__' . rand( 1000, 100000000 );

$class = 'penci-progress-bar';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], '' ) : '';
$class .= ' ' . $this->getExtraClass( $atts['class'] );
$class .= ' ' . $this->getCSSAnimation( $atts['css_animation'] );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_progress_bar', $atts ) );

$bar_options = array();
$options     = explode( ',', $atts['options'] );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated penci-probar__animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'penci-probar__striped';
}

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	<?php if ( $atts['title'] || $atts['description'] ): ?>
		<div class="penci-progress-bar-heading">
			<h3 class="penci-probar__title"><?php echo do_shortcode( $atts['title'] ); ?></h3>
			<div class="penci-probar__desc"><?php echo do_shortcode( $atts['description'] ); ?></div>
		</div>
	<?php endif; ?>
	<ul class="penci-probar__items">
		<?php
		$line_output = '';

		$max_value        = 0.0;
		$graph_lines_data = array();
		foreach ( $values as $data ) {
			$new_line             = $data;
			$new_line['value']    = isset( $data['value'] ) ? $data['value'] : 0;
			$new_line['label']    = isset( $data['label'] ) ? $data['label'] : '';
			$new_line['bgcolor']  = isset( $data['bgcolor'] ) ? ' style="background-color: ' . esc_attr( $data['bgcolor'] ) . ';"' : '';
			$new_line['txtcolor'] = isset( $data['textcolor'] ) ? ' style="color: ' . esc_attr( $data['textcolor'] ) . ';"' : '';

			if ( $max_value < (float) $new_line['value'] ) {
				$max_value = $new_line['value'];
			}
			$graph_lines_data[] = $new_line;
		}

		foreach ( $graph_lines_data as $line ) {

			if ( $max_value > 100.00 ) {
				$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
			} else {
				$percentage_value = $line['value'];
			}
			$percentage_value = number_format( intval( $percentage_value / 10 ), 1, '.', '' );

			$line_output .= '<li class="penci-probar__item">';
			$line_output .= '<div class="penci-probar__text"' . $line['txtcolor'] . '>';
			$line_output .= '<span class="penci-probar__point">' . do_shortcode( $line['label'] ) . '</span>';
			$line_output .= '<span class="penci-probar__score">' . $line['value'] . ( isset( $atts['units'] ) ? $atts['units'] : '' ) . '</span>';
			$line_output .= '</div>';
			$line_output .= '<div class="penci-review-process">';
			$line_output .= '<span class="penci-probar__run ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-width="' . $percentage_value . '"' . $line['bgcolor'] . '></span>';
			$line_output .= '</div>';
			$line_output .= '</li>';
		}

		echo $line_output;
		?>
	</ul>
<?php
$id_pro_bar = '#' . $unique_id;
$css_custom = '';


// Margin and width
if ( $atts['block_title_mar_bottom'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__title { margin-bottom: ' . $atts['block_title_mar_bottom'] . '; }';
}

if ( $atts['block_title_pad_bottom'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__title { padding-bottom: ' . $atts['block_title_pad_bottom'] . '; }';
}

if ( $atts['line_width'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__title:before { width: ' . $atts['line_width'] . '; }';
}

if ( $atts['desc_mar_bottom'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__desc { margin-bottom: ' . $atts['desc_mar_bottom'] . '; }';
}

if ( $atts['bar_mar_top'] ) {
	$css_custom .= $id_pro_bar . ' .penci-review-process { margin-top: ' . $atts['bar_mar_top'] . '; }';
}

if ( $atts['bar_height'] ) {
	$css_custom .= $id_pro_bar . ' .penci-review-process{ height: ' . $atts['bar_height'] . 'px; }';
}
if ( $atts['bar_mar_bottom'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__item{ margin-bottom: ' . $atts['bar_mar_bottom'] . '; }';
}

// color
if ( $atts['title_color'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__title{ color: ' . $atts['title_color'] . '; }';
}

if ( $atts['line_color'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__title:before{ border-color: ' . $atts['line_color'] . '; }';
}

if ( $atts['desc_color'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__desc{ color: ' . $atts['desc_color'] . '; }';
}
if ( $atts['bar_run_bgcolor'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__run{ background-color: ' . $atts['bar_run_bgcolor'] . '; }';
}
if ( $atts['bar_bgcolor'] ) {
	$css_custom .= $id_pro_bar . ' .penci-review-process{ background-color: ' . $atts['bar_bgcolor'] . '; }';
}
if ( $atts['bar_textcolor'] ) {
	$css_custom .= $id_pro_bar . ' .penci-probar__text{ color: ' . $atts['bar_textcolor'] . '; }';
}

// Typo
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'title',
	'font-size'    => '30px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_pro_bar . ' .penci-probar__title{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'desc',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_pro_bar . ' .penci-probar__desc{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'bar',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_pro_bar . ' .penci-probar__text{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
?>
</div>


