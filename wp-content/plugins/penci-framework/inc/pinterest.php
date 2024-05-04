<?php
if ( ! class_exists( 'Penci_Pinterest' ) ):

	class Penci_Pinterest {

		// Pinterest url
		var $pinterest_feed = 'https://pinterest.com/%s/feed.rss';

		var $start_time;

		function __construct() {
			$this->start_time = microtime( true );
		}

		// Render the pinboard and output
		function render_html( $username, $numbers, $cache_time = 1200, $follow = true ) {

			$user_display_html = $username;
			$user_display = explode( "/", trim( $username ) );
			if( is_array( $user_display ) && isset( $user_display[0] ) ) {
				$user_display_html = $user_display[0];
			}

			$pins = $this->get_board_name_pins( $username, $cache_time );

			if( ! empty( $pins ) ) {
				echo '<div class="penci-images-pin-widget">';

				$i = 1;
				foreach ( $pins as $pin ) {

					if ( $numbers < $i ) {
						continue;
					}

					$image = isset( $pin['images']['orig']['url'] ) ? $pin['images']['orig']['url'] : '';
					if ( ! $image ) {
						continue;
					}

					$pin_id = isset( $pin['id'] ) ? $pin['id'] : '';
					$url    = 'https://www.pinterest.com/pin/' . $pin_id;

					echo '<a href="' . esc_url( $url ) . '" target="_blank"><span class="penci-image-holder rectangle-fix-size penci-lazy" data-src="' . esc_url( $image ) . '"></span></a>';

					$i ++;
				}

				echo '</div>';
			}else{
				$user_board =  $user_display_html = '';
				$user_display = explode( "/", trim( $username ) );
				if( is_array( $user_display ) ) {
					$user_display_html = $user_display[0];
					if( isset($user_display[1]) && $user_display[1] ){
						$user_board =  $user_display[1];
					}
				}

				if( $user_display_html && $user_board ){
					$feedurl = 'http://pinterest.com/'.$user_display_html.'/'.$user_board.'.rss';
				}
				else{
					$feedurl = 'http://pinterest.com/'.$user_display_html.'/feed.rss';
				}

				$cache_key = 'penci_pinterest_feed_' . strtolower( $username ) . esc_attr( $numbers );
				$item_foreach_cache = get_transient( $cache_key );

				$remove_item_foreach_cache = isset( $_GET['penci_cache_feed'] ) ? true : false;

				$item_foreach_pre = array();
				if ( ! $item_foreach_cache || $remove_item_foreach_cache ) {
					$rss = fetch_feed($feedurl);
					$item_foreach = ! empty( $rss->get_items() ) ? $rss->get_items() : array();


					$i = 1;
					foreach ( $item_foreach as $item ) {
						if ( $numbers < $i ) {
							continue;
						}
						$imagedata = $item->get_content();

						preg_match( '/src="([^\"]*)"/i', $imagedata, $matchessrc ) ;
						preg_match( '/href="([^\"]*)"/i', $imagedata, $matcheshref ) ;

						$item_foreach_pre[] = array(
							'image_url' => isset( $matchessrc[1] ) ? $matchessrc[1] : '',
							'url' => isset( $matcheshref[1] ) ? $matcheshref[1] : ''
						);

						$i++;
					}
					if( ! empty( $item_foreach_pre ) ){
						set_transient( $cache_key,$item_foreach_pre,  $cache_time );
					}
				}else {

					$item_foreach_pre = $item_foreach_cache;
				}

				if( ! empty( $item_foreach_pre ) ){

					echo '<div class="penci-images-pin-widget">';
					$i = 1;
					foreach ($item_foreach_pre as $item ) {
						if ( $numbers < $i ) {
							continue;
						}

						$image_url = isset( $item['image_url'] ) ? $item['image_url'] : '';
						$url =isset( $item['url'] ) ? $item['url'] : '';

						$lazyhtml = '<span class="penci-image-holder rectangle-fix-size penci-lazy" data-src="' . esc_url( $image_url ) . '"></span>';
						if( get_theme_mod( 'penci_disable_lazyload_layout' ) ) {
							$lazyhtml = '<span class="penci-image-holder rectangle-fix-size" style="background-image: url(' . esc_url( $image_url ) . ');"></span>';
						}

						echo '<a href="' . esc_url( $url ) . '" target="_blank">'. $lazyhtml .'</a>';
						$i++;
					}
					echo '</div>';
				}else{
					echo( "Render failed - no data is received, please check the input" );
				}
			}
			?>

			<?php if ( $follow ): ?>
				<div class="pin_link">
					<a href="https://www.pinterest.com/<?php echo sanitize_text_field( $username ); ?>" target="_blank">@<?php echo sanitize_text_field( $user_display_html ); ?></a>
				</div>
			<?php endif; ?>
			<?php
		}

		/**
		 * Retrieve RSS feed for username, and parse the data needed.
		 * Returns null if error, otherwise a has of pins.
		 * Callback it on render_html functions
		 *
		 * @since 1.0
		 */
		function get_pins( $username, $numbers, $cache_time = 1200 ) {

			if ( ! is_numeric( $cache_time ) && $cache_time < 1 ): $cache_time = 1200; endif;
			// Set caching.
			add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return ' . $cache_time . ';' ) );

			// Get the RSS feed.
			$url = sprintf( $this->pinterest_feed, $username );
			$rss = fetch_feed( $url );

			if ( is_wp_error( $rss ) ) {
				return null;
			}

			$maxitems  = $rss->get_item_quantity( $numbers );
			$rss_items = $rss->get_items( 0, $maxitems );

			$pins;
			if ( is_null( $rss_items ) ) {
				$pins = null;
			} else {

				// Build patterns to search/replace in the image urls
				$search  = array( '_b.jpg' );
				$replace = array( '_t.jpg' );

				// Make url protocol relative
				array_push( $search, 'https://' );
				array_push( $replace, '//' );

				$pins = array();
				foreach ( $rss_items as $item ) {
					$title       = $item->get_title();
					$description = $item->get_description();
					$url         = $item->get_permalink();
					if ( preg_match_all( '/<img src="([^"]*)".*>/i', $description, $matches ) ) {
						$image = str_replace( $search, $replace, $matches[1][0] );
					}
					array_push( $pins, array(
						'title' => $title,
						'image' => $image,
						'url'   => $url
					) );
				}
			}

			return $pins;
		}

		public function get_board_name_pins( $username, $cache_time = 1200 ) {

			$output = array();

			$cache_key = 'penci_pinterest_' . strtolower( $username );

			$pinterest_cache = get_transient( $cache_key );

			if ( ! $pinterest_cache ) {

				$params = array(
					'timeout'    => 60,
					'sslverify'  => false,
					'headers'    => array( 'Accept-language' => 'en' ),
					'user-agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0'
				);

				$response = wp_remote_get( 'https://www.pinterest.com/' . $username, $params );

				if ( ! is_wp_error( $response ) ) {
					$request_result = wp_remote_retrieve_body( $response );

					preg_match_all( '/jsInit1\'>(.*)<\/script>/', $request_result, $matches );

					if ( ! empty( $matches[1] ) && count( $matches[1] ) ) {
						$pinterest_json = json_decode( $matches[1][0], true );

						if ( ! isset( $pinterest_json['resourceDataCache'][1]['data']['board_feed'] ) ) {
							$output['error'] = esc_html__( 'The pinterest data is not set, please check the ID', 'penci-framework' );
						} elseif ( isset( $pinterest_json["resourceDataCache"][0]['data']['type'] ) && $pinterest_json["resourceDataCache"][0]['data']['type'] !== 'board' ) {
							$output['error'] = __( 'Invalid pinterest data for  <strong>' . $username . '</strong> please check the <em>user/board_id</em>', 'penci-framework' );
						} else {
							$output = (array) $pinterest_json['resourceDataCache'][1]['data']['board_feed'];
						}
					}
				}
			} else {
				$output = $pinterest_cache;
			}

			return $output;
		}
	}

endif; /* End check if class exists */