<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$portfolio_id = get_the_ID();
$prefix       = 'penci_';
$is_use_option = Pennew_Portfolio_Helper::is_use_option( get_the_ID() );

$list_social = array( 'facebook', 'twitter', 'google_plus', 'pinterest', 'linkedin', 'tumblr', 'reddit', 'stumbleupon','whatsapp','telegram','email' );

$option_prefix = 'penci_hide_single_share_';

foreach ( $list_social as $k => $item ) {
	if ( penci_get_setting( $option_prefix . $item ) ) {
		unset( $list_social[ $k ] );
	}
}

// Hide text share
$pfl_hide_text_share = false;

if ( ! $is_use_option ) {
	$pfl_hide_text_share = get_theme_mod( 'penci_hide_portfolio_socail_share' );
} else {
	$pfl_hide_text_share = get_post_meta( $portfolio_id, $prefix . 'pfl_hide_text_share', true );
}

echo '<div class="penci-pfl-info-item penci-pfl-social_share">';

if ( function_exists( 'penci_get_tran_setting' ) && empty( $pfl_hide_text_share ) ) {
	echo '<span class="penci-pfl-info-label">' . penci_get_tran_setting( 'penci-social-share-text' ) . '</span>';
}
echo '<span class="penci-pfl-info-value">';
Penci_Social_Share::get_social_share( $list_social, true, false );
echo '</span>';
echo '</div>';