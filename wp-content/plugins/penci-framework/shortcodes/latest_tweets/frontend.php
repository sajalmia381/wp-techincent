<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts              = vc_map_get_attributes( $this->getShortcode(), $atts );
$show_on_shortcode = Penci_Helper_Shortcode::show_on_shortcode( $atts );
if ( ! $show_on_shortcode ) {
	return;
}

list( $atts , $block_content_id, $unique_id ) = Penci_Helper_Shortcode::get_general_param_frontend_shortcode( $atts, 'pinterest_widget' );

$class = Penci_Framework_Helper::get_class_block( array( $this->getCSSAnimation( $atts['css_animation'] ) ), $atts );
$class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', implode( ' ', array_filter( array_unique( $class ) ) ), 'penci_latest_tweets', $atts ) );

?>
	<div id="<?php echo esc_attr( $unique_id ); ?>" class="penci-block-vc penci_latest_tweets_widget <?php echo esc_attr( $class ); ?>">
		<div class="penci-block-heading">
			<?php Penci_Helper_Shortcode::get_block_title( $atts ); ?>
		</div>
		<div class="penci-block_content">
			<?php

			$transient_key = 'pennews_tweets_' . md5( serialize( $atts ) );

			if ( false === ( $tweets = get_transient( $transient_key ) ) )
			{
				require_once PENCI_ADDONS_DIR . 'inc/twitter-api-php.php';

				$settings = array(
					'oauth_access_token'        => $atts['access_token'],
					'oauth_access_token_secret' => $atts['access_token_secret'],
					'consumer_key'              => $atts['consumer_key'],
					'consumer_secret'           => $atts['consumer_secret'],
				);

				$url    = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
				$fields = "?screen_name={$atts['username']}&count={$atts['number']}";
				$method = 'GET';

				$twitter = new TwitterAPIExchange( $settings );
				$tweets  = $twitter->setGetfield( $fields )->buildOauth( $url, $method )->performRequest();
				$tweets  = @json_decode( $tweets );

				if ( empty( $tweets ) )
				{
					esc_html_e( 'Cannot retrieve tweets.', 'penci-framework' );
					return;
				}

				// Save our new transient.
				set_transient( $transient_key, $tweets, $atts['cache_time'] );
			}

			echo '<div class="penci-tweets-widget-content ' . $atts['align'] . '">';
			echo '<span class="icon-tweets"><i class="fa fa-twitter"></i></span>';
			echo '<div class="penci-owl-carousel-slider penci-tweets-slider" data-items="1" data-autotime="4000" data-speed="800" data-loop="0" data-dots="1" data-nav="0" data-auto="' . ( $atts['auto'] ? 0 : 1 ) . '">';
			foreach ( $tweets as $tweet )
			{
				$time              = ! empty( $tweet->created_at ) ? strtotime( $tweet->created_at ) : '';
				$created_time      = $time ?  sprintf( '%s', date( 'd-m-Y', $time ) ) : '';

				$action_links =sprintf('<div class="tweet-intents-inner">
								<span><a href="http://twitter.com/intent/tweet?in_reply_to=%s" class="reply" target="_blank">%s</a></span>
								<span><a href="http://twitter.com/intent/retweet?tweet_id=%s" class="retweet" target="_blank">%s</a></span>
								<span><a href="http://twitter.com/intent/favorite?tweet_id=%s" class="favorite" target="_blank">%s</a></span>
							</div>',
				! empty( $tweet -> id_str ) ? $tweet -> id_str : '',
				$atts['reply'],
				!empty( $tweet -> id_str ) ? $tweet -> id_str : '',
				$atts['retweet'],
				! empty( $tweet -> id_str ) ? $tweet -> id_str : '',
				$atts['favorite']
				);

				printf(
					'<div class="penci-tweet">
						<div class="tweet-text">%s</div>
						<p class="tweet-date">%s</p>
						<div class="tweet-intents">%s</div>
					</div>',
					Penci_Helper_Shortcode::tweets_convert_links( isset( $tweet->text ) ? $tweet->text : '' ),
					$created_time ,
					$action_links
				);
			}
			echo '</div></div>';
			?>
		</div>
	</div>
<?php

$id_twiter = '#' . $unique_id;
$is_widget = Penci_Helper_Shortcode::check_blockvc_is_widget( $atts );



$css_custom  = Penci_Helper_Shortcode::get_general_css_custom( $id_twiter, $atts );
$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'block_title',
	'font-size'    => '18px',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'oswald',$is_widget ),
	'template'     => $id_twiter . ( $atts['style_block_title'] ? '.' . $atts['style_block_title'] : '' ) . ' .penci-block__title{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'tweets_text',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto',$is_widget ),
	'template'     => $id_twiter . ' .penci-tweets-widget-content .tweet-text{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'tweets_date',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto',$is_widget ),
	'template'     => $id_twiter . ' .penci-tweets-widget-content .tweet-date{ %s }',
), $atts
);

$css_custom .= Penci_Helper_Shortcode::get_typo_css_custom( array(
	'e_admin'      => 'tweets_link',
	'font-size'    => '',
	'google_fonts' => Penci_Helper_Shortcode::get_font_family( 'roboto',$is_widget ),
	'template'     => $id_twiter . ' .penci-tweets-widget-content .tweet-intents a, ' . $id_twiter . ' .penci-tweets-widget-content .tweet-text a{ %s }',
), $atts
);

if( $atts['tweets_text_color'] ) {
	$css_custom .= sprintf( '%s .penci-tweets-widget-content .tweet-text{ color: %s; }',$id_twiter,$atts['tweets_text_color']  );
	$css_custom .= sprintf( '%s .penci-tweets-widget-content .tweet-intents span:after{ color: %s; }',$id_twiter,$atts['tweets_text_color']  );
}

if( $atts['tweets_date_color'] ) {
	$css_custom .= sprintf( '%s .penci-tweets-widget-content .tweet-date{ color: %s; }',$id_twiter,$atts['tweets_date_color']  );
}

if( $atts['tweets_link_color'] ) {
	$css_custom .= sprintf( '%s .penci-tweets-widget-content .icon-tweets,%s .penci-tweets-widget-content .tweet-intents a ,%s .tweet-text a{ color: %s; }',
		$id_twiter,$id_twiter, $id_twiter, $atts['tweets_link_color']  );
}

$css_dot = '';

if( $atts['tweets_dot_bordercolor'] ) {
	$css_dot .= 'border-color:' . $atts['tweets_dot_bordercolor'] . ';';
}
if( $atts['tweets_dot_color'] ) {
	$css_dot .= 'background-color:' . $atts['tweets_dot_color'] . ';';
}

if( $css_dot ) {
	$css_custom .= sprintf( '%s .penci-owl-carousel-slider.penci-tweets-slider .owl-dots .owl-dot span{ %s; }', $id_twiter, $css_dot  );
}


if( $atts['tweets_dot_hcolor'] ) {
	$css_custom .= sprintf( '%s .penci-owl-carousel-slider.penci-tweets-slider .owl-dots .owl-dot.active span,
	 %s .penci-owl-carousel-slider.penci-tweets-slider .owl-dots .owl-dot:hover span{ border-color: %s;background-color : %s; }',
		$id_twiter, $id_twiter, $atts['tweets_dot_hcolor'], $atts['tweets_dot_hcolor']  );
}

if ( $css_custom ) {
	echo '<style>';
	echo $css_custom;
	echo '</style>';
}
