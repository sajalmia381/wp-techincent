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

$unique_id    = 'penci-bos_searchbox--' . rand( 1000, 100000 );
$class        = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class[]      = 'penci-bos_searchbox--' . $atts['booking_pos'];
$border_color = '';
$style        = '';
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_bos_searchbox', $atts ) );

?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc bos_searchbox_widget_class <?php echo $class; ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php
			if ( function_exists( 'bos_create_searchbox' ) && function_exists( 'bos_searchbox_retrieve_all_user_options' ) ) {
				$options = bos_searchbox_retrieve_all_user_options();
				bos_create_searchbox( $options, false );
			}
			?>
		</div>
	</div>
<?php
$id_searchbox = '#' . $unique_id;
$css_custom = '';
$css_custom  .= Penci_Helper_Shortcode::get_general_css_custom( $id_searchbox, $atts );

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald' ),
	'template'     => $id_searchbox . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'default_title',
	'font-size'    => '24px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_searchbox .' #b_searchboxInc>h3{ %s }' ,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'destination_text',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani600' ),
	'template' => $id_searchbox .' #flexi_searchbox h1,
	 ' . $id_searchbox . ' #flexi_searchbox h2,
	 ' . $id_searchbox . ' #flexi_searchbox h3,
	 ' . $id_searchbox . ' #flexi_searchbox h4{ %s }' ,
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'submit_button',
	'font-size'    => '14px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template' => $id_searchbox .' #flexi_searchbox #b_searchboxInc .b_submitButton_wrapper .b_submitButton{ %s }' ,
), $atts
);

if( $atts['hide_dftitle'] ) {
	$css_custom .= $id_searchbox .' #b_searchboxInc>h3{ display: none !important; }';
}

if( $atts['hide_logo'] ) {
	$css_custom .= $id_searchbox .' #flexi_searchbox #b_logo{ display: none !important; }';
}

if( $atts['padding_booking'] ) {
	$css_custom .= $id_searchbox .' #flexi_searchbox #b_searchboxInc{ padding: ' . esc_attr( $atts['padding_booking'] ) . '; }';
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
