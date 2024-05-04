<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$class = 'penci_countdown ';
$class .= isset( $atts['css'] ) && $atts['css'] ? ' ' . vc_shortcode_custom_css_class( $atts['css'], '' ) : '';
$class .= $atts['class'] ? ' ' . $atts['class'] : '';

$class .= ! empty( $atts['count_down_style']  ) ? 'penci-' . $atts['count_down_style']  . ' ' : '';
$class .= ! empty( $atts['count_down_posttion'] ) ? 'penci-' . $atts['count_down_posttion'] . ' ' : '';
$class .= ! empty( $atts['digit_border'] ) ? 'penci-border-' . $atts['digit_border'] . ' ' : '';
$class .= !empty( $atts['class'] ) ? $atts['class'] : '';

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $class, 'penci_count_down', $atts ) );


$unique_id = 'penci_countdown_' . rand( 100, 9999 );

// Data Until
$data_time = '';
$data_time .= ! empty( $atts['count_year'] ) ? $atts['count_year'] : 0;
$data_time .= ',';
$data_time .= ! empty( $atts['count_month'] ) ? intval( $atts['count_month'] ) - 1 : 0;
$data_time .= ',';
$data_time .= ! empty( $atts['count_day'] ) ? $atts['count_day'] : 0;
$data_time .= ',';
$data_time .= ! empty( $atts['count_hour'] ) ? $atts['count_hour'] : 0;
$data_time .= ',';
$data_time .= ! empty( $atts['count_minus'] ) ? $atts['count_minus'] : 0;
$data_time .= ',';
$data_time .= ! empty( $atts['count_sec'] ) ? $atts['count_sec'] : 0;

$labels = sprintf( "['%s', '%s', '%s', '%s', '%s', '%s', '%s']",
	$atts['str_years2'], $atts['str_weeks2'], $atts['str_months2'], $atts['str_days2'], $atts['str_hours2'], $atts['str_minutes2'], $atts['str_seconds2'] );

$labels1 = sprintf( "['%s', '%s', '%s', '%s', '%s', '%s', '%s']",
	$atts['str_years'], $atts['str_weeks'], $atts['str_months'], $atts['str_days'] , $atts['str_hours'], $atts['str_minutes'], $atts['str_seconds'] );


// Data format YOWDHMS
$data_format = 'DHMS';

$countdown_opts = $atts['countdown_opts'];

if( $atts['countdown_opts'] ) {
	$data_format = str_replace( ',','', $atts['countdown_opts'] );
}
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $class ); ?>"></div>
<script type="text/javascript">
	jQuery( function ( $ ) {
		if ( $.fn.countdown ) {
			var <?php echo esc_attr( $unique_id ); ?>newDateTime = new Date(<?php echo $data_time; ?> );

			$( '#<?php echo esc_attr( $unique_id ); ?>' ).countdown( {
				until: <?php echo esc_attr( $unique_id ); ?>newDateTime,
				labels: <?php echo $labels; ?>,
				labels1: <?php echo $labels; ?>,
				timezone: <?php echo get_option('gmt_offset'); ?>,
				format: '<?php echo $data_format; ?>',
				<?php echo ( is_rtl() ? 'isRTL: true' : '' ); ?>
			} );
		}
	} );
</script>
<?php
$id_count_down = '#' . $unique_id;
$css_custom    = '';

$css_digit = '';
if( $atts['digit_border_width'] ) {
	$css_digit    .= 'border-width: ' . esc_attr( $atts['digit_border_width'] ) . ';';
}
if( $atts['digit_border_radius'] ) {
	$css_digit    .= 'border-radius: ' . esc_attr( $atts['digit_border_radius'] ) . ';';
}
if( $atts['digit_padding'] ) {
	$css_digit    .= 'padding: ' . esc_attr( $atts['digit_padding'] ) . ';';
}

if( $atts['time_digit_color'] ) {
	$css_digit    .= 'color: ' . esc_attr( $atts['time_digit_color'] ) . ';';
}
if( $atts['time_digit_bordercolor'] ) {
	$css_digit    .= 'border-color: ' . esc_attr( $atts['time_digit_bordercolor'] ) . ';';
}
if( $atts['time_digit_bgcolor'] ) {
	$css_digit    .= 'background-color: ' . esc_attr( $atts['time_digit_bgcolor'] ) . ';';
}

if( $atts['time_digit_bordercolor'] || $atts['time_digit_bgcolor'] ) {
	$css_digit    .= 'text-align:center;';
}

if( $css_digit ) {
	$css_custom    .= $id_count_down . ' .penci-countdown-amount{ ' . $css_digit . '; }';
}

if( $atts['unit_margin_top'] ) {
	$css_custom    .= $id_count_down . ' .penci-countdown-period { margin-top: ' . esc_attr( $atts['unit_margin_top'] ) . '; }';
}if( $atts['unit_color'] ) {
	$css_custom    .= $id_count_down . ' .penci-countdown-period { color: ' . esc_attr( $atts['unit_color'] ) . '; }';
}

if( $atts['cdtitle_upper'] ) {
	$css_custom    .= $id_count_down . ' .penci-countdown-period { text-transform: uppercase; }';
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'time_digit',
	'font-size'    => '90px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_count_down . ' .penci-countdown-amount{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'time_unit',
	'font-size'    => '24px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_count_down . ' .penci-countdown-period{ %s }',
), $atts
);

if ( $atts['time_digit_fsize_mobile'] ) {
	$css_custom .= '@media screen and (max-width: 768px ){ ' . $id_count_down . ' .penci-countdown-amount { font-size: ' . esc_attr( $atts['time_digit_fsize_mobile'] ) . ' !important; } }';
}

if ( $atts['time_unit_fsize_mobile'] ) {
	$css_custom .= '@media screen and (max-width: 768px ){ ' . $id_count_down . ' .penci-countdown-period { font-size: ' . esc_attr( $atts['time_unit_fsize_mobile'] ) . ' !important; } }';
}


if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
?>