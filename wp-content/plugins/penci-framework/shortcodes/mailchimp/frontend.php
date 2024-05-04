<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}
extract( $atts );

$unique_id    = 'penci-ad_box--' . rand( 1000, 100000 );
$class        = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class[]      = ! empty( $atts['mailchimp_style'] ) ? $atts['mailchimp_style'] : '';

if( in_array( $atts['mailchimp_style'], array( 'mailchimp_style-4','mailchimp_style-5' ) ) ) {
	$class[]      = 'mailchimp_style-2';
}

$style        = '';
$border_color = '';

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_mailchimp', $atts ) );

?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-mailchimp <?php echo esc_attr( trim( $class ) ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php
			if ( function_exists( 'mc4wp_show_form' ) ) {
				mc4wp_show_form();
			}
			?>
		</div>
	</div>
<?php
$id_mailchimp = '#' . $unique_id;
$markup_input = $id_mailchimp . ' .mc4wp-form input[type="text"],' . $id_mailchimp . ' .mc4wp-form input[type="email"],' . $id_mailchimp . ' .mc4wp-form input[type="number"],' . $id_mailchimp . ' .mc4wp-form input[type="date"]';


$css_custom = Penci_Helper_Shortcode::get_general_css_custom( $id_mailchimp, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_mailchimp . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'mc4wp_des',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_mailchimp . '.penci-mailchimp .mc4wp-form .mdes{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'mc4wp_input',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $markup_input . '{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'mc4wp_submit',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_mailchimp . '  .mc4wp-form input[type="submit"]{ %s }',
), $atts
);


if ( $atts['mc4wp_des_color'] ) {
	$css_custom .= $id_mailchimp . '.penci-mailchimp .mc4wp-form{ color:' . $atts['mc4wp_des_color'] . '; }';
}

$input_color = '';

if ( $atts['mc4wp_bg_input_color'] ) {
	$input_color .= 'background-color:' . $atts['mc4wp_bg_input_color'] . ';';
}

if ( $atts['mc4wp_border_input_color'] ) {
	$input_color .= 'border-color:' . $atts['mc4wp_border_input_color'] . ';';
}

if ( $atts['mc4wp_text_input'] ) {
	$input_color .= 'color:' . $atts['mc4wp_text_input'] . ';';
}

if ( $input_color ) {
	$css_custom .= $markup_input . '{ ' . $input_color . ' }';
}

if ( $atts['mc4wp_placeh_input'] ) {
	$css_custom .= $id_mailchimp . ' input::-webkit-input-placeholder{ color:' . $atts['mc4wp_placeh_input'] . '; }';
	$css_custom .= $id_mailchimp . ' input::-moz-placeholder { color:' . $atts['mc4wp_placeh_input'] . '; }';
	$css_custom .= $id_mailchimp . ' input:-ms-input-placeholder{ color:' . $atts['mc4wp_placeh_input'] . '; }';
	$css_custom .= $id_mailchimp . ' input:-moz-placeholder{ color:' . $atts['mc4wp_placeh_input'] . '; }';
}

$submit_color = $submit_hcolor = '';

if ( $atts['mc4wp_submit_color'] ) {
	$submit_color .= 'color:' . $atts['mc4wp_submit_color'] . ';';
}
if ( $atts['mc4wp_submit_bgcolor'] ) {
	$submit_color .= 'background-color:' . $atts['mc4wp_submit_bgcolor'] . ';';
}
if ( $atts['mc4wp_submit_border_color'] ) {
	$submit_color .= 'border-color:' . $atts['mc4wp_submit_border_color'] . ';';
}

if ( $submit_color ) {
	$css_custom .= $id_mailchimp . ' .mc4wp-form input[type="submit"]{ ' . $submit_color. ' }';
}

if ( $atts['mc4wp_submit_hcolor'] ) {
	$submit_hcolor .= 'color:' . $atts['mc4wp_submit_hcolor'] . ';';
}
if ( $atts['mc4wp_submit_hbgcolor'] ) {
	$submit_hcolor .= 'background-color:' . $atts['mc4wp_submit_hbgcolor'] . ';';
}
if ( $atts['mc4wp_submit_hborder_color'] ) {
	$submit_hcolor .= 'border-color:' . $atts['mc4wp_submit_hborder_color'] . ';';
}

if ( $submit_hcolor ) {
	$css_custom .= $id_mailchimp . ' .mc4wp-form input[type="submit"]:hover{' . $submit_hcolor . '}';
}

$des_css = '';
if( $atts['mc4wp_des_width'] ) {
	$des_css .= 'max-width:' . esc_attr( $atts['mc4wp_des_width'] ) . ';';
}

if( $atts['mc4wp_des_martop'] ) {
	$des_css .= 'margin-top:' . esc_attr( $atts['mc4wp_des_martop'] ) . ';';
}

if( $atts['mc4wp_des_marbottom'] ) {
	$des_css .= 'margin-bottom:' . esc_attr( $atts['mc4wp_des_marbottom'] ) . ';';
}

if ( $des_css ) {
	$css_custom .= $id_mailchimp . ' .mc4wp-form .mdes{' . $des_css . '}';
}


if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
