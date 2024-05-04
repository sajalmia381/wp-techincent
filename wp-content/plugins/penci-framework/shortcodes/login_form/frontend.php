<?php
$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts, $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'login_form' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
if( is_user_logged_in() ) {
	$class[] = 'penci-user-logged';
}
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_login_form', $atts ) );

$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci-login_form  <?php echo esc_attr( $class ); ?>">
	<div class="penci-block-heading">
		<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
	</div>
	<div class="penci-block_content">

		<div class="penci-login-container">
			<?php if ( ! is_user_logged_in() ): ?>
				<div class="penci-login">
					<?php penci_pennews_login_form(); ?>
					<?php if ( function_exists( 'penci_get_setting' ) ): ?>
						<a class="penci-lostpassword" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php echo( penci_get_setting( 'penci_plogin_label_lostpassword' ) ); ?></a>
					<?php endif; ?>
				</div>
				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<div class="register register-popup">
						<?php if( function_exists( 'penci_get_setting' ) ): ?>
							<?php echo( penci_get_setting( 'penci_plogin_text_has_account' ) ); ?>
							<a href="<?php echo wp_registration_url(); ?>"><?php echo( penci_get_setting( 'penci_plogin_label_registration' ) ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<?php $current_user = wp_get_current_user(); ?>
				<div class="penci-user_logged_in">
					<div class="penci-login-header">
						<div class="penci-login-avatar">
							<?php echo get_avatar( $current_user->ID, 85 ); ?>
						</div>
						<p>
							<span class="penci-text-hello"><?php  echo penci_get_tran_setting( 'penci_login_hello' ) . ', ';  ?></span>
							<span class="penci-display_name"><?php  echo $current_user->display_name;  ?></span>
						</p>
					</div>
					<div class="penci-user-action-links">
						<?php
						if ( class_exists( 'bbpress' ) ) {
							$profile_url = bbp_get_user_profile_url( bbp_get_current_user_id() );
						} else {
							$profile_url = get_edit_user_link();
						}
						?>
						<a class="button penci-button-ptofile" href="<?php echo $profile_url; ?>"><i class="fa fa-user-circle-o"></i> <?php echo penci_get_tran_setting( 'penci_text_profile' ); ?></a>
						<a class="button penci-button-logout" href="<?php echo wp_logout_url($current_url ); ?>"><i class="fa fa-sign-out"></i> <?php echo penci_get_tran_setting( 'penci_text_logout' ); ?></a>
					</div>
				</div>
			<?php endif; ?>
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


