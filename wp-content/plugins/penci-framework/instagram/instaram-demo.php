<?php

if ( ! class_exists( 'Penci_Instagram' ) ) {
	class Penci_Instagram {
		public function __construct() {
		}

		public static function display_images( $args ) {

			if( is_admin() ){
				return;
			}

			$search_for    = isset( $args['search_for'] ) && ! empty( $args['search_for'] ) ? trim( $args['search_for'] ) : 'username';
			$insta_user_id = isset( $args['insta_user_id'] ) && ! empty( $args['insta_user_id'] ) ? trim( $args['insta_user_id'] ) : '';
			$hashtag       = isset( $args['hashtag'] ) && ! empty( $args['hashtag'] ) ? trim( $args['hashtag'] ) : '';
			$blocked_users = isset( $args['blocked_users'] ) && ! empty( $args['blocked_users'] ) ? trim( $args['blocked_users'] ) : '';

			$username           = isset( $args['username'] ) && ! empty( $args['username'] ) ? trim( $args['username'] ) : false;
			$access_token       = isset( $args['access_token'] ) && ! empty( $args['access_token'] ) ? trim( $args['access_token'] ) : '';
			$template           = isset( $args['template'] ) ? $args['template'] : 'slider';
			$images_number      = isset( $args['images_number'] ) ? absint( $args['images_number'] ) : 4;
			$image_type         = isset( $args['image_type'] ) ? $args['image_type'] : 'square';
			$image_size         = isset( $args['image_size'] ) ? $args['image_size'] : '480';
			$onclick            = isset( $args['onclick'] ) ? $args['onclick'] : 'link_image';
			$columns            = isset( $args['columns'] ) ? absint( $args['columns'] ) : 4;
			$refresh_hour       = isset( $args['refresh_hour'] ) ? absint( $args['refresh_hour'] ) : 5;
			$caption_words      = isset( $args['caption_words'] ) ? absint( $args['caption_words'] ) : 100;

			$hide_video_icon    = isset( $args['hide_video_icon'] ) ? $args['hide_video_icon'] : false;
			$hide_button_follow = isset( $args['hide_button_follow'] ) ? $args['hide_button_follow'] : false;
			$hide_avatar        = isset( $args['hide_avatar'] ) ? $args['hide_avatar'] : false;
			$hide_username      = isset( $args['hide_username'] ) ? $args['hide_username'] : false;
			$hide_followers     = isset( $args['hide_followers'] ) ? $args['hide_followers'] : false;

			if ( $refresh_hour == 0 ) {
				$refresh_hour = 5;
			}

			if ( 'username' == $search_for && ! $access_token ) {
				echo __( 'Please enter an Access Token', 'penci-framework' );

				return;
			} elseif ( 'hashtag' == $search_for && ! $hashtag ) {
				echo __( 'Please enter hashtag', 'penci-framework' );
			}

			$images_data = self::get_instagram_data( $username, $refresh_hour, $images_number );

			if( $access_token && ( ! is_array( $images_data ) || ! $images_data ) ) {
				$images_data = self::get_instagram_data_by_access_token( $username, $access_token, $refresh_hour );
			}
			if ( ! is_array( $images_data ) || ! $images_data ) {
				$images_data = self::get_instagram_data_ver2( array(
					'access_token'  => $access_token,
					'insta_user_id' => $insta_user_id,
					'search_for'    => $search_for,
					'username'      => $username,
					'hashtag'       => $hashtag,
					'blocked_users' => $blocked_users,
					'refresh_hour'  => $refresh_hour,
					'images_number' => $images_number,
				) );
			}

			$images_data = array(
				'user_info' => array(
					'follows'         => '10',
					'followed_by'     => '321999',
					'profile_pic_url' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/profile_pic_url.jpg'
				),
				0 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/CByVE1kHVyR/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram1.jpg'
				),
				1=> array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/CBQyz2HHWKj/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram2.jpg'
				),
				2 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/CAqIQJ8Hqbq/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram3.jpg'
				),
				3 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/CAasTYsnheD/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram4.jpg'
				),
				4 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/CAHx4VYn23p/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram5.jpg'
				),
				5 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/B_8AOw6n6Zx/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram6.jpg'
				),
				6 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/B_fhL3xHV45/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram7.jpg'
				),
				7 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/B-9-KfBH5Tz/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram8.jpg'
				),
				8 => array(
					'caption'           => '',
					'id'                => '',
					'link'              => 'https://www.instagram.com/p/B-45_Dsnema/',
					'timestamp'         => 1590520596,
					'url'               => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg',
					'url_thumbnail'     => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg',
					'is_video'          => '',
					'url_thumbnail_150' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg',
					'url_thumbnail_240' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg',
					'url_thumbnail_320' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg',
					'url_thumbnail_480' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg',
					'url_thumbnail_640' => 'http://pennews.pencidesign.com/wp-content/uploads/2018/01/instagram9.jpg'
				)
			);

			if( ! is_array( $images_data ) || ! $images_data ) {
				esc_html_e('No any image found. Please check it again or try with another instagram account.','penci-framework');
				return;
			}

			$images_div = '';
			if( isset($images_data['user_info']) && $images_data['user_info'] ) {

				$profile_pic_url = '';
				if (isset($images_data['user_info']['profile_pic_url'])) {
					$profile_pic_url = $images_data['user_info']['profile_pic_url'];
				}

				$followed_by = '';
				if (isset($images_data['user_info']['followed_by'])) {
					$followed_by = self::format_followers( $images_data['user_info']['followed_by'] );
				}

				if( ! $hide_avatar || ! $hide_username || ! $hide_followers ) {
					$images_div .= '<div class="penci-insta-profile penci_media_object">';
					if(  ! $hide_avatar ){
						$images_div .= '<div class="penci-insta-profile-image penci_mobj__img"><img class="penci-lazy" data-src="'. $profile_pic_url .'" alt="profile pic url" src="' . PENCI_ADDONS_URL . 'assets/img/penci-holder.png' . '"/></div>';
					}
					$images_div .= '<div class="penci-insta-meta penci_mobj__body">';
					if( ! $hide_username ) {
						$images_div .= '<div class="penci-insta-user"><a href="https://www.instagram.com/' . $username . '" target="_blank"><h4>@' . $username . '</h4></a></div>';
					}

					if( ! $hide_followers ) {
						$text_followers      = esc_html__( 'Followers', 'penci-framework' );
						$follow_followers    = esc_html__( 'Follow', 'penci-framework' );
						if( function_exists( 'penci_get_tran_setting' ) ) {
							$text_followers = penci_get_tran_setting( 'penci_social_followers_text' );
							$follow_followers    = penci_get_tran_setting( 'penci_social_follow_text' );
						}

						$images_div .= '<div class="penci-insta-followers"><span>' . $followed_by . '</span> ' . $text_followers . '</div>';
					}

					if( ! $hide_button_follow ) {
						$images_div .= '<a class="penci-insta-button button" href="https://www.instagram.com/' . $username . '" target="_blank">' . $follow_followers . '</a>';
					}
					$images_div .= '</div>';
					$images_div .= '</div>';
				}
			}

			$images_div_class = 'penci-insta-thumb';
			$images_div_class .= ' penci-insta-' . $image_type;
			$images_div_class .= 'lightbox' == $onclick ? ' penci-popup-gallery' : '';

			if( $template == 'thumbs-no-border' ) {
				$images_div_class .= ' penci-insta-no-border';
			}

			$slider_script = '';
			$unique_id = rand( 1000, 100000 );

			$images_div .= '<div id="penci-insta-thumb' . $unique_id . '" class="' . $images_div_class . '">';

			if ( 'slider' == $template ) {
				$data = ' data-items="1"';
				$data .= ' data-auto="' . ( empty( $atts['auto_play'] ) ? 1 : 0 ) . '"';
				$data .= ' data-autotime="' . ( ! empty( $atts['auto_time'] ) ? $atts['auto_time'] : 4000 ) . '"';
				$data .= ' data-speed="' . ( ! empty( $atts['speed'] ) ? $atts['speed'] : 800 ) . '"';
				$data .= ' data-loop="' . ( ! empty( $atts['disable_loop'] ) ? 1 : 0 ) . '"';
				$data .= ' data-dots="0"';
				$data .= ' data-nav="1"';

				$images_ul = '<div class="penci-owl-carousel-slider thumbnails" ' . $data . '>';
			} else {
				$ul_class  = ( $template == 'thumbs-no-border' ) ? 'thumbnails no-border penci_col_' . $columns : 'thumbnails penci_col_' . $columns;
				$images_ul = '<ul class="no-bullet ' . $ul_class . '">';
			}

			$output = '';

			if ( is_array( $images_data ) && ! empty( $images_data ) ) {

				$output = $slider_script . $images_div . $images_ul;

				$i = 0;
				foreach ( $images_data as $key => $image_data ) {

					if ( $i >= $images_number ) {
						continue;
					}

					$image_url = isset( $image_data[ 'url_thumbnail_' . $image_size ] ) ? $image_data[ 'url_thumbnail_' . $image_size ] : '';

					if( empty( $image_url ) ) {
						continue;
					}

					$is_video     = $image_data['is_video'];
					$short_caption = preg_replace( "/[^A-Za-z0-9?! ]/", "", $image_data['caption'] );
					$short_caption = wp_trim_words( sanitize_text_field( $short_caption ), 10, '...' );

					$icon_video = '';
					if( ! $hide_video_icon && $is_video ) {
						$icon_size_icon = isset( $args['icon_size'] ) ? ' penci-insta-video-' . $args['icon_size'] : '';
						$icon_video = '<span class="penci-insta-video-type' . $icon_size_icon .  '"><i class="fa fa-play"></i></span>';
					}

					if ( 'slider' == $template ) {
						$caption = wp_trim_words( $image_data['caption'], $caption_words );
						$caption = preg_replace( '/@([a-z0-9_]+)/i', '&nbsp;<a href="https://www.instagram.com/$1/" rel="nofollow" target="_blank">@$1</a>&nbsp;', $caption );
						$caption = preg_replace( '/\#([a-zA-Z0-9_-]+)/i', '&nbsp;<a href="https://www.instagram.com/explore/tags/$1/" rel="nofollow" target="_blank">$0</a>&nbsp;', $caption );

						$time = human_time_diff( $image_data['timestamp'] );

						$output .= '<a class="instagram-item-slider" href="' . $image_data['link'] . '" target="_blank">';
						$output .= '<span class="penci-image-holder penci-lazy instagram-square-lazy" data-src="' . $image_url . '"></span>';
						$output .= $icon_video;
						$output .= '<span class="penci-insta-datacontainer">';
						$output .= '<span class="penci-insta-time">' . $time . ' ago</span>';
						$output .= '<span class="penci-insta-username">by <span>' . $username . '</span></span>';
						$output .= '<span class="penci-insta-caption">' .  wp_trim_words( sanitize_text_field( $caption ), 25, '...' ) . '</span>';
						$output .= '</span>';
						$output .= '</a>';
					} else {

						$onclick_link = $image_data['link'];

						if( 'lightbox' == $onclick ) {
							$onclick_link = isset( $image_data[ 'url_thumbnail_640' ] ) ? $image_data[ 'url_thumbnail_640' ] : $image_url;
						}elseif( 'none' == $onclick ){
							$onclick_link = '';
						}

						$output .= '<li>';

						if( $onclick_link ) {
							$output .= '<a class="instagram-item-thumbs" href="' . $onclick_link . '" target="_blank">';
						}else{
							$output .= '<span class="instagram-item-thumbs">';
						}

						$output .= $icon_video;
						$output .= '<span class="penci-image-holder penci-lazy instagram-square-lazy" data-src="' . $image_url . '"></span>';
						$output .= $onclick_link ? '</a>' : '';
						$output .= '</li>';
					}

					$i ++;
				}

				if ( 'slider' == $template ) {
					$output .= '</div>';
				} else {
					$output .= '</ul>';
				}

				$output .= '</div>';

			}

			echo $output;

		}

		public static function get_instagram_data( $username, $cache_hours, $images_number ) {
			$opt_name   = 'penci_insta_' . md5( $username );
			$insta_data = get_transient( $opt_name );
			$old_opts   = (array) get_option( $opt_name );

			$new_opts = array(
				'username'    => $username,
				'cache_hours' => $cache_hours,
			);

			if ( true === self::trigger_refresh_data( $insta_data, $old_opts, $new_opts ) ) {
				$insta_data = array();

				$response = wp_remote_get( 'https://www.instagram.com/' . trim( $username ), array( 'sslverify' => false, 'timeout' => 60 ) );

				if ( is_wp_error( $response ) ) {
					return $response->get_error_message();
				}

				if ( $response['response']['code'] == 200 ) {
					$json = self::parse_instagram_html( $response );

					$results = json_decode( $json, true );

					if ( $results === null and json_last_error() !== JSON_ERROR_NONE ) {
						return 'Error decoding the instagram json';
					}

					if ( $results && is_array( $results ) ) {
						$entry_data = isset(  $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ?  $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] : array();
						if ( empty( $entry_data ) ) {
							return __( 'No images found', 'penci-framework' );
						}


						$follows = $followed_by = $profile_pic_url = 0;
						if( isset( $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_follow']['count'] ) ) {
							$follows = $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_follow']['count'];
						}

						if( isset( $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'] ) ) {
							$followed_by = $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'];
						}

						if( isset( $results['entry_data']['ProfilePage'][0]['graphql']['user']['profile_pic_url'] ) ) {
							$profile_pic_url = $results['entry_data']['ProfilePage'][0]['graphql']['user']['profile_pic_url'];
						}

						$insta_data['user_info'] = array(
							'follows'         => $follows,
							'followed_by'     => $followed_by,
							'profile_pic_url' => $profile_pic_url
						);

						foreach ( $entry_data as $current => $result ) {

							$image_data                  = array();
							$image_data['caption']       = isset( $result['node']['edge_media_to_caption']['edges']['0']['node']['text'] ) ? sanitize_textarea_field( $result['node']['edge_media_to_caption']['edges']['0']['node']['text'] ) : '';
							$image_data['id']            = isset( $result['node']['id'] ) ? $result['node']['id']  : '';
							$image_data['link']          = isset( $result['node']['shortcode'] ) ? 'https://www.instagram.com/p/'. $result['node']['shortcode'] . '/' : '';
							$image_data['timestamp']     = isset( $result['node']['taken_at_timestamp'] ) ?  (float) $result['node']['taken_at_timestamp'] : '';
							$image_data['url']           = isset( $result['node']['display_url'] ) ? $result['node']['display_url'] : '';
							$image_data['url_thumbnail'] = isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '';
							$image_data['is_video']      = isset( $result['node']['is_video'] ) ? $result['node']['is_video'] : '';

							$thumbnail_resources = isset( $result['node']['thumbnail_resources'] ) ? $result['node']['thumbnail_resources'] : array();

							foreach ( $thumbnail_resources as $thumbnail_resource ) {
								$config_width = isset( $thumbnail_resource['config_width'] ) ? $thumbnail_resource['config_width'] : '';
								$src          = isset( $thumbnail_resource['src'] ) ? $thumbnail_resource['src'] : '';

								if ( ! $src || ! $config_width ) {
									continue;
								}

								$image_data[ 'url_thumbnail_' . $config_width ] = $src;
							}

							$insta_data[] = $image_data;
						}
					}
				} else {

					return $response['response']['message'];

				} // end -> $response['response']['code'] === 200 )


				update_option( $opt_name, $new_opts );
				if ( is_array( $insta_data ) && ! empty( $insta_data ) ) {

					set_transient( $opt_name, $insta_data, $cache_hours * 60 * 60 );
				}

			}// end -> false === $insta_data

			return $insta_data;
		}
		public static function get_instagram_data_by_access_token( $username, $access_token, $cache_hours ) {
			$opt_name   = 'penci_insta_' . md5( $username );
			$insta_data = get_transient( $opt_name );
			$old_opts   = (array) get_option( $opt_name );

			$new_opts = array(
				'username'     => $username,
				'access_token' => $access_token,
				'cache_hours'  => $cache_hours,
			);

			if ( true === self::trigger_refresh_data( $insta_data, $old_opts, $new_opts ) ) {
				$insta_data = array();

				$access_token = self::clean_token( $access_token );
				$split_token  = explode( '.', $access_token );
				$id           = isset( $split_token[0] ) ? $split_token[0] : '';

				$response = wp_remote_get( 'https://api.instagram.com/v1/users/' . $id . '/media/recent?access_token=' . $access_token . '&count=30', array( 'timeout' => 60, 'sslverify' => false ) );

				if ( ! is_wp_error( $response ) ) {
					$results      = json_decode( str_replace( '%22', '&rdquo;', $response['body'] ), true );
					$data_results = isset( $results['data'] ) ? (array) $results['data'] : array();
					if ( $data_results ) {

						foreach ( $data_results as $data_item ) {

							$url_thumbnail = isset( $data_item['images']['standard_resolution']['url'] ) ? $data_item['images']['standard_resolution']['url'] : '';

							$insta_data[] = array(
								'caption'           => isset( $data_item['caption']['text'] ) ? $data_item['caption']['text'] : '',
								'id'                => isset( $data_item['id'] ) ? $data_item['id'] : '',
								'link'              => isset( $data_item['link'] ) ? $data_item['link'] : '',
								'timestamp'         => isset( $data_item['created_time'] ) ? $data_item['created_time'] : '',
								'url'               => $url_thumbnail,
								'url_thumbnail'     => $url_thumbnail,
								'is_video'          => '',
								'url_thumbnail_150' => $url_thumbnail,
								'url_thumbnail_240' => $url_thumbnail,
								'url_thumbnail_320' => $url_thumbnail,
								'url_thumbnail_480' => $url_thumbnail,
								'url_thumbnail_640' => $url_thumbnail,
							);
						}
					}
				}


				update_option( $opt_name, $new_opts );
				if ( is_array( $insta_data ) && ! empty( $insta_data ) ) {

					set_transient( $opt_name, $insta_data, $cache_hours * 60 * 60 );
				}

			}// end -> false === $insta_data

			return $insta_data;
		}
		public static function get_instagram_data_ver2( $args = null ){
			$defaults = array(
				'access_token'  => '',
				'insta_user_id' => '',
				'search_for'    => '',
				'username'      => '',
				'hashtag'       => '',
				'blocked_users' => '',
				'refresh_hour'  => '',
				'images_number' => '',
			);

			$args = wp_parse_args( (array) $args, $defaults );

			$blocked_users = $args['blocked_users'];
			if ( 'username' == $args['search_for'] ) {
				$search        = 'user';
				$search_string = $args['username'];
			} elseif ( $args['hashtag'] ) {
				$search              = 'hashtag';
				$search_string       = $args['hashtag'];
				$blocked_users_array = $blocked_users ? self::get_ids_from_usernames( $blocked_users ) : array();
			} elseif ( $args['hashtag'] ) {
				$search        = 'hashtag';
				$search_string = $args['hashtag'];
			} else {
				$search        = '';
				$search_string = '';
			}

			$opt_name   = 'penci_insta_' . md5( $search . '_' . $search_string );
			$insta_data = get_transient( $opt_name );
			$old_opts   = (array) get_option( $opt_name );

			$new_opts = array(
				'search'        => $search,
				'search_string' => $search_string,
				'blocked_users' => $blocked_users,
				'cache_hours'   => $args['refresh_hour'],
			);


			if ( true === self::trigger_refresh_data( $insta_data, $old_opts, $new_opts ) ) {
				if ( 'username' == $args['search_for'] ) {
					$insta_data = self::get_images_data_for_token_ver_2( $args['access_token'], $args['insta_user_id'] );
				} elseif ( $args['hashtag'] ) {
					$insta_data = self::get_images_data_for_hashtag( $search_string, $blocked_users_array );
				}
			}

			return $insta_data;

		}
		public static function get_images_data_for_token_ver_2( $access_token , $user_id ) {
			$access_token = self::clean_token_ver2( $access_token );

			$data_images = array();
			$response_url = 'https://graph.instagram.com/' . $user_id . '/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit=30&access_token=' . $access_token;

			$response = wp_remote_get( $response_url, array( 'timeout' => 60, 'sslverify' => false ) );

			if ( ! is_wp_error( $response ) ) {
				$results      = json_decode( str_replace( '%22', '&rdquo;', $response['body'] ), true );
				$data_results = isset( $results['data'] ) ? (array) $results['data'] : array();

				if ( $data_results ) {
					foreach ( $data_results as $data_item ) {

						$data_item_id = isset( $data_item['id'] ) ? $data_item['id'] : '';
						$data_media_type = isset( $data_item['media_type'] ) ? $data_item['media_type'] : '';

						$data_item_url_thumbnail = isset( $data_item['media_url'] ) ? $data_item['media_url'] : '';
						if( 'VIDEO' == $data_media_type || 'video' ==  $data_media_type ) {
							$data_item_url_thumbnail = isset( $data_item['thumbnail_url'] ) ? $data_item['thumbnail_url'] : '';
						}

						if( $data_item_id ){
							$data_images[$data_item_id] = array(
								'caption'           => '',
								'id'                => $data_item_id,
								'link'              => isset( $data_item['permalink'] ) ? $data_item['permalink'] : '',
								'timestamp'         => isset( $data_item['timestamp'] ) ? $data_item['timestamp'] : '',
								'url'               => $data_item_url_thumbnail,
								'url_thumbnail'     => $data_item_url_thumbnail,
								'is_video'          => ( 'VIDEO' == $data_media_type || 'video' ==  $data_media_type ) ?  1 : '',
								'url_thumbnail_150' => $data_item_url_thumbnail,
								'url_thumbnail_240' => $data_item_url_thumbnail,
								'url_thumbnail_320' => $data_item_url_thumbnail,
								'url_thumbnail_480' => $data_item_url_thumbnail,
								'url_thumbnail_640' => $data_item_url_thumbnail,
							);
						}
					}
				}
			}

			return $data_images;
		}

		public static function get_images_data_for_hashtag( $hashtag, $blocked_users_array ) {
			$response = wp_remote_get( 'https://www.instagram.com/explore/tags/' . trim( $hashtag ), array( 'sslverify' => false, 'timeout' => 60 ) );

			$data_images = array();

			if ( is_wp_error( $response ) ) {
				return $data_images;
			}

			if ( $response['response']['code'] == 200 ) {
				$json = self::parse_instagram_html( $response );

				$results = json_decode( $json, true );

				if ( $results && is_array( $results ) ) {
					$entry_data = isset( $results['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ? $results['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] : array();
					if ( $entry_data ) {

						$images_number = 0;
						foreach ( $entry_data as $current => $result ) {
							$owner_id = isset( $result['node']['owner']['id'] ) ? $result['node']['owner']['id'] : '';

							if ( in_array( $owner_id, $blocked_users_array ) ) {
								continue;
							}

							if ( $images_number > 12 ) {
								continue;
							}

							$comment_count = isset( $result['node']['edge_media_to_comment']['count'] ) ? (int) ( $result['node']['edge_media_to_comment']['count'] ) : 0;
							$liked_count   = isset( $result['node']['edge_liked_by']['count'] ) ? (int) ( $result['node']['edge_liked_by']['count'] ) : 0;

							$image_data['code']          = isset( $result['node']['shortcode'] ) ? $result['node']['shortcode'] : '';
							$image_data['username']      = '';
							$image_data['user_id']       = isset( $result['node']['owner']['id'] ) ? $result['node']['owner']['id'] : '';
							$image_data['caption']       = isset( $result['node']['edge_media_to_caption']['edges']['0']['node']['text'] ) ? self::sanitize( $result['node']['edge_media_to_caption']['edges']['0']['node']['text'] ) : '';
							$image_data['id']            = isset( $result['node']['id'] ) ? $result['node']['id'] : '';
							$image_data['link']          = isset( $result['node']['shortcode'] ) ? 'https://www.instagram.com/p/' . $result['node']['shortcode'] . '/' : '';
							$image_data['popularity']    = $comment_count + $liked_count;
							$image_data['timestamp']     = isset( $result['node']['taken_at_timestamp'] ) ? (float) $result['node']['taken_at_timestamp'] : '';
							$image_data['url']           = isset( $result['node']['display_url'] ) ? $result['node']['display_url'] : '';
							$image_data['url_thumbnail'] = isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '';

							$data_images[] = array(
								'caption'           => '',
								'is_video'          => '',
								'id'                => isset( $result['node']['id'] ) ? $result['node']['id'] : '',
								'link'              => isset( $result['node']['shortcode'] ) ? 'https://www.instagram.com/p/' . $result['node']['shortcode'] . '/' : '',
								'timestamp'         => isset( $result['node']['taken_at_timestamp'] ) ? (float) $result['node']['taken_at_timestamp'] : '',
								'url'               => isset( $result['node']['display_url'] ) ? $result['node']['display_url'] : '',
								'url_thumbnail'     => isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '',
								'url_thumbnail_150' => isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '',
								'url_thumbnail_240' => isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '',
								'url_thumbnail_320' => isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '',
								'url_thumbnail_480' => isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '',
								'url_thumbnail_640' => isset( $result['node']['thumbnail_src'] ) ? $result['node']['thumbnail_src'] : '',
							);

							$images_number ++;
						}
					}
				}
			}

			return $data_images;
		}

		private static function parse_instagram_html( $response ) {
			$json = str_replace( 'window._sharedData = ', '', strstr( $response['body'], 'window._sharedData = ' ) );

			// Compatibility for version of php where strstr() doesnt accept third parameter
			if ( version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
				$json = strstr( $json, '</script>', true );
			} else {
				$json = substr( $json, 0, strpos( $json, '</script>' ) );
			}

			$json = rtrim( $json, ';' );

			return $json;
		}

		public static function trigger_refresh_data( $insta_data, $old_opts, $new_opts ) {
			$trigger = 0;

			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return false;
			}

			if ( false === $insta_data ) {
				$trigger = 1;
			}

			if ( is_array( $old_opts ) && is_array( $old_opts ) && array_diff( $old_opts, $new_opts ) !== array_diff( $new_opts, $old_opts ) ) {
				$trigger = 1;
			}

			if ( $trigger == 1 ) {
				return true;
			}

			return false;
		}

		public static function format_followers( $followers ) {

			if ( $followers >= 1000000 ) {
				$followers = number_format_i18n( $followers / 1000000, 1 ) . 'm';
			} elseif ( $followers >= 10000 ) {
				$followers = number_format_i18n( $followers / 1000, 1 ) . 'k';
			} else {
				$followers = number_format_i18n( $followers );
			}

			return $followers;
		}

		public static function clean_token( $maybe_dirty ) {
			if ( substr_count( $maybe_dirty, '.' ) < 3 ) {
				return $maybe_dirty;
			}

			$parts     = explode( '.', trim( $maybe_dirty ) );
			$last_part = $parts[2] . $parts[3];
			$cleaned   = $parts[0] . '.' . base64_decode( $parts[1] ) . '.' . base64_decode( $last_part );

			$cleaned = preg_replace( "/[^a-zA-Z0-9\.]+/", "", $cleaned );

			return $cleaned;
		}

		public static function clean_token_ver2( $maybe_dirty ) {
			if ( substr_count( $maybe_dirty, '.' ) < 3 ) {
				return str_replace( '634hgdf83hjdj2', '', $maybe_dirty );
			}

			$parts     = explode( '.', trim( $maybe_dirty ) );
			$last_part = $parts[2] . $parts[3];
			$cleaned   = $parts[0] . '.' . base64_decode( $parts[1] ) . '.' . base64_decode( $last_part );

			$cleaned = preg_replace( "/[^a-zA-Z0-9\.]+/", "", $cleaned );

			return $cleaned;
		}


		private static function get_ids_from_usernames( $usernames ) {

			$users      = explode( ',', trim( $usernames ) );
			$user_ids   = (array) get_transient( 'penci_insta_user_ids' );
			$return_ids = array();

			if ( is_array( $users ) && ! empty( $users ) ) {

				foreach ( $users as $user ) {

					if ( isset( $user_ids[ $user ] ) ) {
						continue;
					}

					$response = wp_remote_get( 'https://www.instagram.com/' . trim( $user ), array( 'sslverify' => false, 'timeout' => 60 ) );

					if ( is_wp_error( $response ) ) {

						return $response->get_error_message();
					}

					if ( $response['response']['code'] == 200 ) {

						$json = str_replace( 'window._sharedData = ', '', strstr( $response['body'], 'window._sharedData = ' ) );
						if ( version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
							$json = strstr( $json, '</script>', true );
						} else {
							$json = substr( $json, 0, strpos( $json, '</script>' ) );
						}

						$json    = rtrim( $json, ';' );
						$results = json_decode( $json, true );

						if ( $results && is_array( $results ) ) {

							$user_id = isset( $results['entry_data']['ProfilePage'][0]['graphql']['user']['id'] ) ? $results['entry_data']['ProfilePage'][0]['graphql']['user']['id'] : false;
							if ( $user_id ) {

								$user_ids[ $user ] = $user_id;

								set_transient( 'penci_insta_user_ids', $user_ids );
							}
						}
					}
				}
			}

			foreach ( $users as $user ) {
				if ( isset( $user_ids[ $user ] ) ) {
					$return_ids[] = $user_ids[ $user ];
				}
			}

			return $return_ids;
		}

		private static function sanitize( $input ) {

			if ( ! empty( $input ) ) {
				$utf8_2byte       = 0xC0 /*1100 0000*/
				;
				$utf8_2byte_bmask = 0xE0 /*1110 0000*/
				;
				$utf8_3byte       = 0xE0 /*1110 0000*/
				;
				$utf8_3byte_bmask = 0XF0 /*1111 0000*/
				;
				$utf8_4byte       = 0xF0 /*1111 0000*/
				;
				$utf8_4byte_bmask = 0xF8 /*1111 1000*/
				;

				$sanitized = "";
				$len       = strlen( $input );
				for ( $i = 0; $i < $len; ++ $i ) {

					$mb_char = $input[ $i ]; // Potentially a multibyte sequence
					$byte    = ord( $mb_char );

					if ( ( $byte & $utf8_2byte_bmask ) == $utf8_2byte ) {
						$mb_char .= $input[ ++ $i ];
					} else if ( ( $byte & $utf8_3byte_bmask ) == $utf8_3byte ) {
						$mb_char .= $input[ ++ $i ];
						$mb_char .= $input[ ++ $i ];
					} else if ( ( $byte & $utf8_4byte_bmask ) == $utf8_4byte ) {
						// Replace with ? to avoid MySQL exception
						$mb_char = '';
						$i       += 3;
					}

					$sanitized .= $mb_char;
				}

				$input = $sanitized;
			}

			return $input;
		}
	}
}

new Penci_Instagram();

