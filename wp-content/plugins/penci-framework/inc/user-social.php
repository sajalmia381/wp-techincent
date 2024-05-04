<?php

add_filter( 'user_contactmethods', 'user_social_networks_add' );

/**
 * Add social networks to user profile
 *
 * @param array $methods Currently set contact methods.
 *
 * @return array
 */
function user_social_networks_add( $methods ) {
	$methods['googleplus'] = esc_html__( 'Google+', 'penci-framework' );
	$methods['twitter']    = esc_html__( 'Twitter screen name (without @)', 'penci-framework' );
	$methods['facebook']   = esc_html__( 'Facebook profile URL', 'penci-framework' );
	$methods['linkedin']   = esc_html__( 'Linkedin', 'penci-framework' );
	$methods['instagram']  = esc_html__( 'Instagram', 'penci-framework' );
	$methods['dribbble']   = esc_html__( 'Dribbble', 'penci-framework' );

	return $methods;
}

