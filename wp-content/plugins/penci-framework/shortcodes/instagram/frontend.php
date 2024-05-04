<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'instagram' );

$column_number = Penci_Global_Blocks::get_col_number();

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'], $atts['columns'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_instagram', $atts ) );
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-block-instagram  <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">
		<div class="penci-image-box__cotnent">
			<?php
			Penci_Instagram::display_images( $atts ); ?>
		</div>
	</div>
</div>
<?php

$id_instagram = '#' . $unique_id;
$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_instagram, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_instagram, $atts );

if( $atts['username_color'] ) {
	$css_custom .= sprintf( '%s .penci-insta-user a{ color: %s !important; }',$id_instagram, $atts['username_color']  );
}
if( $atts['username_hcolor'] ) {
	$css_custom .= sprintf( '%s .penci-insta-user a:hover{ color: %s !important; }',$id_instagram, $atts['username_hcolor']  );
}

if( $atts['followers_color'] ) {
	$css_custom .= sprintf( '%s .penci-insta-followers{ color: %s !important; }',$id_instagram, $atts['followers_color']  );
}

// Button follow
$css_button_follow = $css_button_follow_hover = '';

if( $atts['follow_color'] ) {
	$css_button_follow .= 'color: ' . $atts['follow_color'] . ' !important;';
}

if( $atts['follow_bgcolor'] ) {
	$css_button_follow .= 'background-color: ' . $atts['follow_bgcolor'] . ' !important;';
}

if( $css_button_follow ) {
	$css_custom .= sprintf( '%s .penci-insta-button{ %s }',$id_instagram, $css_button_follow  );
}

if( $atts['follow_hcolor'] ) {
	$css_button_follow_hover .= 'color: ' . $atts['follow_hcolor'] . ' !important;';
}

if( $atts['follow_bghcolor'] ) {
	$css_button_follow_hover .= 'background-color: ' . $atts['follow_bghcolor'] . ' !important;';
}

if( $css_button_follow_hover ) {
	$css_custom .= sprintf( '%s .penci-insta-button:hover{ %s }',$id_instagram, $css_button_follow_hover  );
}

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'username',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'muktavaani' ),
	'template'     => $id_instagram . ' .penci-insta-user h4{ %s }',
), $atts
);
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'followers',
	'font-size'    => '13px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto' ),
	'template'     => $id_instagram . ' .penci-insta-meta{ %s }',
), $atts
);

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
