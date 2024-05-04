<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

$unique_id        = 'penci-weather--' . rand( 1000, 100000 );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_weather', $atts ) );
$args = Penci_Pre_Query::get_query_args( $atts );


?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci_block_weather <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">
		<?php
		$weather_data = Penci_Weather::show_forecats( array(
			'location'      => $atts['location'],
			'location_show' => $atts['location_show'],
			'forecast_days' => $atts['forcast'],
			'units'         => $atts['units'],
		) );

		if( $weather_data ) {
			echo $weather_data;
		}else {
			echo '<div class="penci-block-error">';
			echo '<span>Weather widget</span>';
			echo ' You need to fill API key to Customize > General Options > Weather API Key to get this widget work.';
			echo '</div>';
		}
		?>
	</div>
</div>
<?php

$id_weather = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_weather, $atts );

if( $atts['w_genneral_color'] ) {
	$css_custom  .= sprintf( '%s .penci-weather-condition,
	 %s .penci-weather-information,
	 %s .penci-weather-lo-hi__content .fa,
	 %s .penci-circle,
	 %s .penci-weather-animated-icon i,
	 %s .penci-weather-unit { color : %s; opacity: 1; }',
	 $id_weather,$id_weather, $id_weather, $id_weather, $id_weather, $id_weather, $atts['w_genneral_color']  );
}

if( $atts['w_localtion_color'] ) {
	$css_custom  .= sprintf( '%s .penci-weather-city { color : %s; }', $id_weather, $atts['w_localtion_color']  );
}

if( $atts['w_border_color'] ) {
	$css_custom  .= sprintf( '%s .penci-weather-information { border-color : %s; }', $id_weather, $atts['w_border_color']  );
}

if( $atts['w_degrees_color'] ) {
	$css_custom  .= sprintf( '%s .penci-big-degrees,%s .penci-small-degrees { color : %s; }', $id_weather, $id_weather, $atts['w_degrees_color']  );
}

if( $atts['w_forecast_text_color'] ) {
	$css_custom  .= sprintf( '%s .penci-weather-week{ color : %s; }', $id_weather, $atts['w_forecast_text_color']  );
}

if( $atts['w_forecast_bg_color'] ) {
	$css_custom  .= sprintf( '%s .penci-weather-week:before { background-color : %s;opacity: 1; }', $id_weather, $atts['w_forecast_bg_color']  );
}


$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_weather, $atts );
if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
