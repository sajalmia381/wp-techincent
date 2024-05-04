<?php
/**
 * Get list social media
 * @return array
 */
function penci_get_list_social_media() {
	return array(
		'facebook'   => esc_html__( 'Facebook', 'pennews' ),
		'twitter'    => esc_html__( 'Twitter', 'pennews' ),
		'instagram'  => esc_html__( 'Instagram', 'pennews' ),
		'pinterest'  => esc_html__( 'Pinterest', 'pennews' ),
		'linkedin'   => esc_html__( 'Linkedin', 'pennews' ),
		'flickr'     => esc_html__( 'Flickr', 'pennews' ),
		'behance'    => esc_html__( 'Behance', 'pennews' ),
		'tumblr'     => esc_html__( 'Tumblr', 'pennews' ),
		'youtube'    => esc_html__( 'Youtube', 'pennews' ),
		'email_me'   => esc_html__( 'Email', 'pennews' ),
		'bloglovin'  => esc_html__( 'Bloglovin', 'pennews' ),
		'vk'         => esc_html__( 'Vk', 'pennews' ),
		'vine'       => esc_html__( 'Vine', 'pennews' ),
		'soundcloud' => esc_html__( 'Soundcloud', 'pennews' ),
		'vimeo'      => esc_html__( 'Vimeo', 'pennews' ),
		'rss'        => esc_html__( 'Rss', 'pennews' ),

		'snapchat'       => esc_html__( 'Snapchat', 'pennews' ),
		'spotify'        => esc_html__( 'Spotify', 'pennews' ),
		'github'         => esc_html__( 'Github', 'pennews' ),
		'stack-overflow' => esc_html__( 'Stack Overflow', 'pennews' ),
		'twitch'         => esc_html__( 'Twitch', 'pennews' ),
		'steam'          => esc_html__( 'Steam', 'pennews' ),
		'xing'           => esc_html__( 'Xing', 'pennews' ),
		'telegram'       => esc_html__( 'Telegram', 'pennews' ),
		'whatsapp'       => esc_html__( 'Whatsapp', 'pennews' ),
		'odnoklassniki'  => esc_html__( 'OK', 'pennews' ),
		'500px'          => esc_html__( '500px', 'pennews' ),
		'line'           => esc_html__( 'Line', 'pennews' ),
		'patreon'        => esc_html__( 'Patreon', 'pennews' ),
		'discord'        => esc_html__( 'Discord', 'pennews' ),
		'slack'          => esc_html__( 'Slack Link', 'pennews' ),
		'mixcloud'       => esc_html__( 'Mixcloud Link', 'pennews' ),
		'goodreads'      => esc_html__( 'Goodreads Link', 'pennews' ),
		'tripadvisor'    => esc_html__( 'Trip advisor Link', 'pennews' ),
		'tiktok'         => esc_html__( 'Tik tok link', 'pennews' ),
	);
}



/**
 * List social media
 *
 * @param bool $show
 *
 * @return string
 */
function penci_list_socail_media( $show = true ) {
	$socials = penci_get_list_social_media();

	$output = '';
	foreach ( $socials as $id => $social ) {
		$url = penci_get_setting( 'penci_' . $id );
		if ( empty( $url ) ) {
			continue;
		}

		$icon = $id;

		$fontawesome_ver5 = get_theme_mod( 'penci_fontawesome_ver5' );
		if ( $fontawesome_ver5 ) {
			$icon = penci_convert_icon_ver5( $icon );
			$icon = penci_icon_by_ver( $icon );

			$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content">%s<span class="social_title screen-reader-text">%s</span></span></a>',
				$id, $url,$social, penci_get_rel_noopener(), $icon, $social );
		}else{

			if ( 'email_me' == $id ) {
				$icon = 'envelope';
			} elseif ( 'bloglovin' == $id ) {
				$icon = 'heart';
			} elseif ( 'youtube' == $id ) {
				$icon = 'youtube-play';
			} elseif ( 'google' == $id ) {
				$icon = 'google-plus';
			}
			$icon = '<i class="fa fa-' . $icon . '"></i>';

			if( 'line' == $id ) {
				$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fab fa-line"></i></a>',
					$id, $url,$social, penci_get_rel_noopener() );
			}elseif( 'discord' == $id ) {
				$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fab fa-discord"></i></a>',
					$id, $url,$social, penci_get_rel_noopener() );
			}elseif( 'patreon' == $id ) {
				$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fab fa-patreon"></i></a>',
					$id, $url,$social, penci_get_rel_noopener() );
			}elseif( 'tiktok' == $id ) {
				$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fab fa-tiktok"></i></a>',
					$id, $url,$social, penci_get_rel_noopener() );
			}elseif( 'goodreads' == $id ) {
				$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content"><i class="fa fab fa-goodreads"></i></a>',
					$id, $url,$social, penci_get_rel_noopener() );
			}else{
				$output .= sprintf( '<a class="social-media-item socail_media__%s" target="_blank" href="%s" title="%s"%s><span class="socail-media-item__content">%s<span class="social_title screen-reader-text">%s</span></span></a>',
					$id, $url,$social, penci_get_rel_noopener(), $icon, $social );
			}
		}
	}

	if ( ! $show ) {
		return $output;
	}

	echo ( $output );
}

if( ! function_exists( 'penci_convert_icon_ver5' ) ):
function penci_convert_icon_ver5( $name ){
	$options =  array(
		'facebook'       => 'fab fa-facebook-f',
		'twitter'        => 'fab fa-twitter',
		'youtube'        => 'fab fa-youtube',
		'instagram'      => 'fab fa-instagram',
		'pinterest'      => 'fab fa-pinterest',
		'linkedin'       => 'fab fa-linkedin-in',
		'flickr'         => 'fab fa-flickr',
		'behance'        => 'fab fa-behance',
		'tumblr'         => 'fab fa-tumblr',
		'email_me'       => 'fas fa-envelope',
		'vk'             => 'fab fa-vk',
		'vine'           => 'fab fa-vine',
		'soundcloud'     => 'fab fa-soundcloud',
		'vimeo'          => 'fab fa-vimeo',
		'rss'            => 'fas fa-rss',
		'snapchat'       => 'fab fa-snapchat',
		'spotify'        => 'fab fa-spotify',
		'github'         => 'fab fa-github',
		'stack-overflow' => 'fab fa-stack-overflow',
		'twitch'         => 'fab fa-twitch',
		'steam'          => 'fab fa-steam',
		'xing'           => 'fab fa-xing',
		'telegram'       => 'fab fa-telegram',
		'whatsapp'       => 'fab fa-whatsapp',
		'odnoklassniki'  => 'fab fa-odnoklassniki',
		'500px'          => 'fab fa-500px',
		'line'           => 'fab fa-line',
		'ebay'           => 'fab fa-ebay',
		'delicious'      => 'fab fa-delicious',
		'deviantart'     => 'fab fa-deviantart',
		'digg'           => 'fab fa-digg',
		'slack'          => 'fab fa-slack',
		'mixcloud'       => 'fab fa-slack',
		'goodreads'      => 'fab fa-slack',
		'tripadvisor'    => 'fab fa-slack',
		'tiktok'         => 'fab fa-slack',
		'bloglovin'      => 'far fa-heart',
		'patreon'        => 'fab fa-patreon',
		'discord'        => 'fab fa-discord',
		'reddit'         => 'fab fa-reddit',
	);

	if ( isset( $options[ $name ] ) ) {
		return $options[ $name ];
	}

	return '';
}
endif;