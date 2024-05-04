<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

if ( is_user_logged_in() ){
	return;
}

list( $atts, $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'register_form' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );

$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_register_form', $atts ) );

$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-login_form  <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">
		<div class="penci-register-container penci-login-container">
			<form name="form" class="penci-registration-form" action="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login_post' ) ); ?>" method="post" novalidate="novalidate">
				<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'register' ); ?>">

				<p class="register-input">
					<input class="penci_first_name" name="penci_first_name" type="text" placeholder="<?php echo penci_get_tran_setting( 'penci_pregister_first_name' ); ?>"/>
				</p>
				<p class="register-input">
					<input class="penci_last_name" name="penci_last_name" type="text" placeholder="<?php echo penci_get_tran_setting( 'penci_pregister_last_name' ); ?>"/>
				</p>
				<p class="register-input">
					<input class="penci_user_name" name="penci_user_name" type="text" placeholder="<?php echo penci_get_tran_setting( 'penci_pregister_user_name' ); ?>"/>
				</p>
				<p class="register-input">
					<input class="penci_user_email" name="penci_user_email" type="email" placeholder="<?php echo penci_get_tran_setting( 'penci_pregister_user_email' ); ?>"/>
				</p>
				<p class="register-input">
					<input class="penci_user_pass" name="penci_user_pass" type="password" placeholder="<?php echo penci_get_tran_setting( 'penci_pregister_user_pass' ); ?>"/>
				</p>
				<p class="register-input">
					<input class="penci_user_pass_confirm" name="penci_user_pass_confirm" type="password"  placeholder="<?php echo penci_get_tran_setting( 'penci_pregister_pass_confirm' ); ?>"/>
				</p>
				<?php do_action( 'register_form' ); ?>
				<p class="register-input">
					<input type="submit" name="penci_submit" class="button" value="<?php echo penci_get_tran_setting( 'penci_pregister_button_submit' ); ?>"/>
				</p>
				<?php echo Penci_Helper_Shortcode::get_html_animation_loading(); ?>
			</form>
		</div>

	</div>
	<?php

	$id_login_form = '#' . $unique_id;
	$css_custom    = Penci_Helper_Shortcode::get_general_css_custom( $id_login_form, $atts );
	$css_custom    .= Penci_Helper_Shortcode::get_typo_css_custom_block_heading( $id_login_form, $atts );

	if( $atts['form_text_color'] ) {
		$css_custom .=  sprintf( '%s .penci-login-container{ color :%s; }',$id_login_form, $atts['form_text_color'] );
	}

	if( $atts['form_input_color'] ) {
		$css_custom .= sprintf( '%s .penci-login-container .penci-login input[type="text"], 
		%s .penci-login-container .penci-login input[type=password], 
		%s .penci-login-container .penci-login input[type="submit"],
		%s .penci-login-container .penci-login input[type="email"]{ color:%s ; }',
			$id_login_form, $id_login_form, $id_login_form, $id_login_form, esc_attr( $atts['form_input_color'] ) );
	}
	if( $atts['form_place_color'] ) {
		$css_custom .= sprintf(
			$id_login_form . ' .penci-login-container .penci-login input[type="text"]::-webkit-input-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type=password]::-webkit-input-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="submit"]::-webkit-input-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="email"]::-webkit-input-placeholder{ color:%s !important; }' .
			$id_login_form . ' .penci-login-container .penci-login input[type="text"]::-moz-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type=password]::-moz-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="submit"]::-moz-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="email"]::-moz-placeholder{ color:%s !important; }' .

			$id_login_form . ' .penci-login-container .penci-login input[type="text"]:-ms-input-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type=password]:-ms-input-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="submit"]:-ms-input-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="email"]:-ms-input-placeholder{ color:%s !important; }' .

			$id_login_form . ' .penci-login-container .penci-login input[type="text"]:-moz-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type=password]:-moz-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="submit"]:-moz-placeholder,' .
			$id_login_form . ' .penci-login-container .penci-login input[type="email"]:-moz-placeholder { color:%s !important; }',
			esc_attr( $atts['form_place_color'] ),
			esc_attr( $atts['form_place_color'] ),
			esc_attr( $atts['form_place_color'] ),
			esc_attr( $atts['form_place_color'] )
		);
	}

	if( $atts['form_inputborder_color'] ) {
		$css_custom .= sprintf( '%s .penci-login-container .penci-login input[type="text"], 
		%s .penci-login-container .penci-login input[type=password], 
		%s .penci-login-container .penci-login input[type="submit"],
		%s .penci-login-container .penci-login input[type="email"]{ border-color:%s ; }',
			$id_login_form, $id_login_form, $id_login_form, $id_login_form, esc_attr( $atts['form_inputborder_color'] ) );

	}if( $atts['form_link_color'] ) {
		$css_custom .=  sprintf( '%s .penci-login-container a{ color:%s ; }',$id_login_form, $atts['form_link_color'] );
	}if( $atts['form_link_hcolor'] ) {
		$css_custom .=  sprintf( '%s .penci-login-container a:hover{ color:%s ; }',$id_login_form, $atts['form_link_hcolor'] );
	}
	if ( $atts['form_button_color'] ) {
		$css_custom .= sprintf( '%s .penci-login-container .penci-login input[type="submit"],%s .penci-user-action-links a{ color:%s ; }',
			$id_login_form, $id_login_form, $atts['form_button_color'] );
	}
	if ( $atts['form_button_bgcolor'] ) {
		$css_custom .= sprintf( '%s .penci-login-container .penci-login input[type="submit"], %s .penci-user-action-links a{ background-color:%s;border-color: %s ; }',
			$id_login_form, $id_login_form, $atts['form_button_bgcolor'], $atts['form_button_bgcolor'] );
	}
	if ( $atts['form_button_hcolor'] ) {
		$css_custom .= sprintf( '%s .penci-login-container .penci-login input[type="submit"]:hover, %s .penci-user-action-links a:hover{ color:%s ; }',
			$id_login_form, $id_login_form, $atts['form_button_hcolor'] );
	}
	if ( $atts['form_button_hbgcolor'] ) {
		$css_custom .= sprintf( '%s .penci-login-container .penci-login input[type="submit"]:hover, %s .penci-user-action-links a:hover{ background-color:%s ;border-color: %s ; }',
			$id_login_form, $id_login_form, $atts['form_button_hbgcolor'], $atts['form_button_hbgcolor'] );
	}

	if ( $atts['bg_logged'] ) {
		$bgimg_id = preg_replace( '/[^\d]/', '', $atts['bg_logged'] );

		$bgimg = Penci_Helper_Shortcode::getImageBySize( array(
			'attach_id'  => $img_id,
			'thumb_size' => 'full',
		) );
		$css_custom .= sprintf( '%s .penci-login_form.penci-user-logged{ background-image: url(%s); }', $id_login_form, $bgimg );
	}

	if ( $css_custom ) {
		echo '<style>';
		echo $css_custom;
		echo '</style>';
	}
	?>
</div>


