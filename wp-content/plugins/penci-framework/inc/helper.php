<?php

/**
 * Helper class.
 */
class Penci_Framework_Helper {

	function __construct() {
		;
		add_filter( 'vc_google_fonts_get_fonts_filter', array( $this, 'add_google_fonts' ) );
		add_filter( 'vc_iconpicker_render_filter', array( $this, 'remove_seprated_line' ) );
		add_filter( 'vc_animation_style_render_filter', array( $this, 'remove_seprated_line' ) );
	}

	public static function get_http() {
		return is_ssl() ? 'https://' : 'http://';
	}

	/**
	 * Get Currency symbol.
	 *
	 * @param string $currency (default: '')
	 *
	 * @return string
	 */
	public static function get_currency_symbol( $currency = '' ) {
		$symbols = array(
			'AED' => '&#x62f;.&#x625;',
			'AFN' => '&#x60b;',
			'ALL' => 'L',
			'AMD' => 'AMD',
			'ANG' => '&fnof;',
			'AOA' => 'Kz',
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&fnof;',
			'AZN' => 'AZN',
			'BAM' => 'KM',
			'BBD' => '&#36;',
			'BDT' => '&#2547;&nbsp;',
			'BGN' => '&#1083;&#1074;.',
			'BHD' => '.&#x62f;.&#x628;',
			'BIF' => 'Fr',
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => 'Bs.',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTC' => '&#3647;',
			'BTN' => 'Nu.',
			'BWP' => 'P',
			'BYR' => 'Br',
			'BZD' => '&#36;',
			'CAD' => '&#36;',
			'CDF' => 'Fr',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&yen;',
			'COP' => '&#36;',
			'CRC' => '&#x20a1;',
			'CUC' => '&#36;',
			'CUP' => '&#36;',
			'CVE' => '&#36;',
			'CZK' => '&#75;&#269;',
			'DJF' => 'Fr',
			'DKK' => 'DKK',
			'DOP' => 'RD&#36;',
			'DZD' => '&#x62f;.&#x62c;',
			'EGP' => 'EGP',
			'ERN' => 'Nfk',
			'ETB' => 'Br',
			'EUR' => '&euro;',
			'FJD' => '&#36;',
			'FKP' => '&pound;',
			'GBP' => '&pound;',
			'GEL' => '&#x10da;',
			'GGP' => '&pound;',
			'GHS' => '&#x20b5;',
			'GIP' => '&pound;',
			'GMD' => 'D',
			'GNF' => 'Fr',
			'GTQ' => 'Q',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => 'L',
			'HRK' => 'Kn',
			'HTG' => 'G',
			'HUF' => '&#70;&#116;',
			'IDR' => 'Rp',
			'ILS' => '&#8362;',
			'IMP' => '&pound;',
			'INR' => '&#8377;',
			'IQD' => '&#x639;.&#x62f;',
			'IRR' => '&#xfdfc;',
			'ISK' => 'Kr.',
			'JEP' => '&pound;',
			'JMD' => '&#36;',
			'JOD' => '&#x62f;.&#x627;',
			'JPY' => '&yen;',
			'KES' => 'KSh',
			'KGS' => '&#x43b;&#x432;',
			'KHR' => '&#x17db;',
			'KMF' => 'Fr',
			'KPW' => '&#x20a9;',
			'KRW' => '&#8361;',
			'KWD' => '&#x62f;.&#x643;',
			'KYD' => '&#36;',
			'KZT' => 'KZT',
			'LAK' => '&#8365;',
			'LBP' => '&#x644;.&#x644;',
			'LKR' => '&#xdbb;&#xdd4;',
			'LRD' => '&#36;',
			'LSL' => 'L',
			'LYD' => '&#x644;.&#x62f;',
			'MAD' => '&#x62f;. &#x645;.',
			'MDL' => 'L',
			'MGA' => 'Ar',
			'MKD' => '&#x434;&#x435;&#x43d;',
			'MMK' => 'Ks',
			'MNT' => '&#x20ae;',
			'MOP' => 'P',
			'MRO' => 'UM',
			'MUR' => '&#x20a8;',
			'MVR' => '.&#x783;',
			'MWK' => 'MK',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => 'MT',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => 'C&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#x631;.&#x639;.',
			'PAB' => 'B/.',
			'PEN' => 'S/.',
			'PGK' => 'K',
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PRB' => '&#x440;.',
			'PYG' => '&#8370;',
			'QAR' => '&#x631;.&#x642;',
			'RMB' => '&yen;',
			'RON' => 'lei',
			'RSD' => '&#x434;&#x438;&#x43d;.',
			'RUB' => '&#8381;',
			'RWF' => 'Fr',
			'SAR' => '&#x631;.&#x633;',
			'SBD' => '&#36;',
			'SCR' => '&#x20a8;',
			'SDG' => '&#x62c;.&#x633;.',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&pound;',
			'SLL' => 'Le',
			'SOS' => 'Sh',
			'SRD' => '&#36;',
			'SSP' => '&pound;',
			'STD' => 'Db',
			'SYP' => '&#x644;.&#x633;',
			'SZL' => 'L',
			'THB' => '&#3647;',
			'TJS' => '&#x405;&#x41c;',
			'TMT' => 'm',
			'TND' => '&#x62f;.&#x62a;',
			'TOP' => 'T&#36;',
			'TRY' => '&#8378;',
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => 'Sh',
			'UAH' => '&#8372;',
			'UGX' => 'UGX',
			'USD' => '&#36;',
			'UYU' => '&#36;',
			'UZS' => 'UZS',
			'VEF' => 'Bs F',
			'VND' => '&#8363;',
			'VUV' => 'Vt',
			'WST' => 'T',
			'XAF' => 'Fr',
			'XCD' => '&#36;',
			'XOF' => 'Fr',
			'XPF' => 'Fr',
			'YER' => '&#xfdfc;',
			'ZAR' => '&#82;',
			'ZMW' => 'ZK',
		);

		return isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';
	}

	/**
	 * Get list of terms.
	 *
	 * @param string $taxonomy
	 *
	 * @return array
	 */
	public static function get_terms( $taxonomy = 'category' ) {

		$terms = Penci_Cache::get_cache_terms( $taxonomy );

		$options = array(
			esc_html__( '-- All categories --', 'penci-framework' ) => '',
		);
		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->name ] = $term->slug;
			}
		}

		return $options;
	}

	/**
	 * Get list post type
	 */
	public static function get_post_types() {

		return array(
			esc_html__( 'Post', 'penci-framework' ) => 'post',
			esc_html__( 'Page', 'penci-framework' ) => 'page',
		);

		$post_types = get_post_types();

		if ( empty( $post_types ) ) {
			return array();
		}

		unset( $post_types['attachment'] );
		unset( $post_types['revision'] );
		unset( $post_types['nav_menu_item'] );
		unset( $post_types['customize_changeset'] );
		unset( $post_types['custom_css'] );

		return $post_types;
	}

	/**
	 * Get list post type
	 */
	public static function get_all_post_types() {
		$post_types = get_post_types();

		if ( empty( $post_types ) ) {
			return array();
		}

		unset( $post_types['attachment'] );
		unset( $post_types['revision'] );
		unset( $post_types['nav_menu_item'] );
		unset( $post_types['customize_changeset'] );
		unset( $post_types['custom_css'] );

		return $post_types;
	}


	/**
	 * Display limited post content
	 *
	 * Strips out tags and shortcodes, limits the content to `$num_words` words and appends more link to the end.
	 *
	 * @param integer $num_words The maximum number of words
	 * @param string $more More link. Default is "...". Optional.
	 * @param bool $echo Echo or return output
	 *
	 * @return string Limited content.
	 */
	public static function content_limit( $num_words, $more = '...', $echo = true ) {
		// Strip tags and shortcodes so the content truncation count is done correctly
		$content = wp_strip_all_tags( strip_shortcodes( get_the_content() ) );

		// Truncate $content to $max_char
		$content = wp_trim_words( $content, $num_words );

		$output = '<p>' . $content . '</p>';
		if ( $more ) {
			$output .= sprintf(
				'<p><a href="%s" class="more-link">%s</a></p>',
				esc_url( get_permalink() ),
				$more
			);
		}

		if ( $echo ) {
			echo $output;
		}

		return $output;
	}


	public function add_google_fonts( $fonts_list ) {

		if ( ! get_option( 'pennews_enable_all_fontgoogle' ) ) {

			$fonts = array(
				'Roboto, 100:100italic:300:300italic:regular:italic:500:500italic:700:700italic:900:900italic, sans-serif'                                               => 'Roboto',
				'Mukta Vaani, 200:300:400:regular:500:600:700:800, sans-serif'                                                                                           => 'Mukta Vaani',
				'Oswald, 200:300:regular:500:600:700, sans-serif'                                                                                                        => 'Oswald',
				'Oswald, 300:regular:700'                                                                                                                                => 'Oswald VC',
				'Roboto Slab, 100:300:regular:700, serif'                                                                                                                => 'Roboto Slab',
				'Playfair Display, regular:italic:700:700italic:900:900italic, serif'                                                                                    => 'Playfair Display',
				'Lato, 100:100italic:300:300italic:regular:italic:700:700italic:900:900italic, sans-serif'                                                               => 'Lato',
				'Open Sans, 300:300italic:regular:italic:600:600italic:700:700italic:800:800italic, sans-serif'                                                          => 'Open Sans',
				'Bitter, regular:italic:700, serif'                                                                                                                      => 'Bitter',
				'PT Sans, regular:italic:700:700italic, sans-serif'                                                                                                      => 'PT Sans',
				'Manuale, regular:italic:500:500italic:600:600italic:700:700italic, serif'                                                                               => 'Manuale',
				'Source Sans Pro, 200:200italic:300:300italic:regular:italic:600:600italic:700:700italic:900:900italic, sans-serif'                                      => 'Source Sans Pro',
				'Libre Baskerville, regular:italic:700, serif'                                                                                                           => 'Libre Baskerville',
				'Cardo, regular:italic:700, serif'                                                                                                                       => 'Cardo',
				'Poppins, 100:100italic:200:200italic:300:300italic:regular:italic:500:500italic:600:600italic:700:700italic:800:800italic:900:900italic, sans-serif'    => 'Poppins',
				'Nunito Sans, 200:200italic:300:300italic:regular:italic:600:600italic:700:700italic:800:800italic:900:900italic, sans-serif'                            => 'Nunito Sans',
				'Muli, 200:200italic:300:300italic:regular:italic:600:600italic:700:700italic:800:800italic:900:900italic, sans-serif'                                   => 'Muli',
				'Catamaran, 100:200:300:regular:500:600:700:800:900, sans-serif'                                                                                         => 'Catamaran',
				'Droid Sans, regular:700, sans-serif'                                                                                                                    => 'Droid Sans',
				'Archivo, regular:italic:500:500italic:600:600italic:700:700italic, sans-serif'                                                                          => 'Archivo',
				'Monda, regular:700, sans-serif'                                                                                                                         => 'Monda',
				'Noto Sans, regular:italic:700:700italic, sans-serif'                                                                                                    => 'Noto Sans',
				'Saira Semi Condensed, 100:200:300:regular:500:600:700:800:900, sans-serif'                                                                              => 'Saira Semi Condensed',
				'Zilla Slab, 300:300italic:regular:italic:500:500italic:600:600italic:700:700italic, serif'                                                              => 'Zilla Slab',
				'Karla, regular:italic:700:700italic, sans-serif'                                                                                                        => 'Karla',
				'Fira Sans, 100:100italic:200:200italic:300:300italic:regular:italic:500:500italic:600:600italic:700:700italic:800:800italic:900:900italic, sans-serif'  => 'Fira Sans',
				'Montserrat, 100:100italic:200:200italic:300:300italic:regular:italic:500:500italic:600:600italic:700:700italic:800:800italic:900:900italic, sans-serif' => 'Montserrat',
				'Old Standard TT, regular:italic:700, serif'                                                                                                             => 'Old Standard TT',
				'Overpass Mono, 300:regular:600:700, monospace'                                                                                                          => 'Overpass Mono',
				'Roboto Mono, 100:100italic:300:300italic:regular:italic:500:500italic:700:700italic, monospace'                                                         => 'Roboto Mono',
				'Vollkorn, regular:italic:600:600italic:700:700italic:900:900italic, serif'                                                                              => 'Vollkorn',
				'Georgia, serif'                                                                                                                                         => 'Georgia, serif',
				'Encode Sans, 100:200:300:regular:500:600:700:800:900, sans-serif'                                                                                       => 'Encode Sans',
				'Titillium Web, 200:200italic:300:300italic:regular:italic:600:600italic:700:700italic:900, sans-serif'                                                  => 'Titillium Web',
				'Work Sans, 100:200:300:regular:500:600:700:800:900, sans-serif'                                                                                         => 'Work Sans',
				'Exo 2, 100:100italic:200:200italic:300:300italic:regular:italic:500:500italic:600:600italic:700:700italic:800:800italic:900:900italic, sans-serif'      => 'Exo 2',
				'Merriweather Sans, 300:300italic:regular:italic:700:700italic:800:800italic, sans-serif'                                                                => 'Merriweather Sans',
				'Roboto Condensed, 300:300italic:regular:italic:700:700italic, sans-serif'                                                                               => 'Roboto Condensed',
				'Gudea, regular:italic:700, sans-serif'                                                                                                                  => 'Gudea',
			);

			$custom_fontgoogle = get_option( 'pennews_custom_fontgoogle' );

			if ( $custom_fontgoogle ) {

				$explode_custom_fontgoogles = explode( '|', $custom_fontgoogle . '|' );
				$custom_fontgoogles         = array_filter( $explode_custom_fontgoogles );

				foreach ( (array) $custom_fontgoogles as $custom_fontgoogle ) {
					$fonts[ $custom_fontgoogle ] = $custom_fontgoogle;
				}
			}

			if ( function_exists( 'penci_get_custom_fonts' ) && penci_get_custom_fonts() ) {
				$fonts = array_merge( penci_get_custom_fonts(), $fonts );
			}

			array_walk( $fonts, array( $this, 'parse_google_font' ) );

			return array_values( $fonts );

		} elseif ( function_exists( 'penci_get_custom_fonts' ) && function_exists( 'penci_font_browser' ) && function_exists( 'penci_list_google_fonts_array' ) ) {
			$fonts = array_merge(
				penci_get_custom_fonts(),
				penci_font_browser(),
				penci_list_google_fonts_array()
			);
			array_walk( $fonts, array( $this, 'parse_google_font' ) );
			$fonts_list = array_merge( array_values( $fonts ), $fonts_list );

			return $fonts_list;
		}
	}

	protected function parse_google_font( &$font, $font_data ) {
		list( $name, $styles ) = explode( ',', $font_data . ',' );
		$styles = str_replace( ':', ',', trim( $styles ) );

		$font_class              = new stdClass();
		$font_class->font_family = $name;
		$font_class->font_types  = implode( ',', $this->parse_font_types( $styles ) );
		$font_class->font_styles = $styles;

		$font = $font_class;
	}

	protected function parse_font_types( $styles ) {
		$styles = array_filter( explode( ',', $styles . ',' ) );
		array_walk( $styles, array( $this, 'parse_font_type' ) );

		return $styles;
	}

	protected function parse_font_type( &$style ) {
		$types = array(
			'100'       => '100 thin:100:normal',
			'100i'      => '100 thin italic:100:italic',
			'100italic' => '100 thin italic:100:italic',
			'200'       => '200 thin:200:normal',
			'200i'      => '200 thin italic:200:italic',
			'200italic' => '200 thin italic:200:italic',
			'300'       => '300 light:300:normal',
			'300i'      => '300 light italic:300:italic',
			'300italic' => '300 light italic:300:italic',
			'400'       => '400 regular:400:normal',
			'regular'   => '400 regular:400:normal',
			'400i'      => '400 regular italic:400:italic',
			'400italic' => '400 regular italic:400:italic',
			'italic'    => '400 regular italic:400:italic',
			'500'       => '500 medium:500:normal',
			'500i'      => '500 medium italic:500:italic',
			'500italic' => '500 medium italic:500:italic',
			'600'       => '600 medium:600:normal',
			'600i'      => '600 medium italic:600:italic',
			'600italic' => '600 medium italic:600:italic',
			'700'       => '700 bold:700:normal',
			'bold'      => '700 bold:700:normal',
			'700i'      => '700 bold italic:700:italic',
			'700italic' => '700 bold italic:700:italic',
			'800'       => '800 bolder:800:normal',
			'800i'      => '800 bolder italic:800:italic',
			'800italic' => '800 bolder italic:800:italic',
			'900'       => '900 black:900:normal',
			'900i'      => '900 black italic:900:italic',
			'900italic' => '900 black italic:900:italic',
		);
		$style = isset( $types[ $style ] ) ? $types[ $style ] : '400 regular:400:normal';
	}

	public static function get_query_args( $atts ) {

		$default = array(
			'post_ids'          => '',
			'category_ids'      => '',
			'tag_slugs'         => '',
			'sort'              => '',
			'limit'             => '',
			'autors_id'         => '',
			'post_types'        => 'post',
			'paged'             => 1,
			'shortcode_id'      => '',
			'limit_loadmore'    => '',
			'styleAction'       => '',
			'enable_stiky_post' => 0,
			'exclude_cat_id'    => '',
			'offset'            => 0
		);

		$atts = wp_parse_args( $atts, $default );

		extract( $atts );

		$penci_query_args = array(
			'post_type'           => $atts['post_types'],
			'ignore_sticky_posts' => ! $atts['enable_stiky_post'] ? 1 : 0,
			'post_status'         => 'publish',
		);

		if ( 'block_video' == $atts['shortcode_id'] ) {
			$penci_query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-video' ),
			);
		}

		if ( 'block_36' == $atts['shortcode_id'] ) {
			$penci_query_args['meta_query'][] = array(
				'key'     => 'penci_review',
				'compare' => 'EXISTS',
			);
		}


		if ( isset( $atts['category_ids'] ) && ! empty( $atts['category_ids'] ) ) {
			$penci_query_args['category_name'] = $atts['category_ids'];
		}

		if ( ! empty( $atts['exclude_cat_id'] ) ) {

			$exclude_cat_ids = explode( ',', $atts['exclude_cat_id'] );
			$cat_not_in      = array();
			foreach ( $exclude_cat_ids as $exclude_cat_id ) {
				$exclude_cat_id = trim( $exclude_cat_id );
				if ( is_numeric( $exclude_cat_id ) ) {
					$cat_not_in[] = $exclude_cat_id;
				}
			}

			if ( ! empty( $cat_not_in ) ) {
				$penci_query_args['category__not_in'] = $cat_not_in;
			}
		}

		if ( ! empty( $atts['tag_slug'] ) ) {
			$penci_query_args['tag'] = str_replace( ' ', '-', $atts['tag_slug'] );
		}

		if ( ! empty( $atts['autors_id'] ) ) {
			$penci_query_args['author'] = $atts['autors_id'];
		}
		$sort = $atts['sort'];

		switch ( $sort ) {
			case 'featured':
				if ( ! empty( $atts['category_ids'] ) ) {
					$pre_cat_ids = explode( ',', $atts['category_ids'] );

					if ( ! empty( $pre_cat_ids ) ) {
						foreach ( ( array ) $pre_cat_ids as $cat_id ) {
							$cat_obj  = get_category( trim( $cat_id ) );
							$cat_slug = isset( $cat_obj->slug ) ? $cat_obj->slug : '';

							if ( empty( $penci_query_args['category_name'] ) ) {
								$penci_query_args['category_name'] = $cat_slug;
							} else {
								$penci_query_args['category_name'] .= ',' . $cat_slug;
							}
							unset( $cat_obj );
						}
					}
				}

				$penci_query_args['cat'] = get_cat_ID( 'Featured' );
				break;
			case 'popular':
				$penci_query_args['meta_key'] = '_count-views_all';
				$penci_query_args['orderby']  = 'meta_value_num';
				$penci_query_args['order']    = 'DESC';
				break;
			case 'popular7':
				$penci_query_args['meta_key'] = '_count-views_week-' . date( 'YW' );
				$penci_query_args['orderby']  = 'meta_value_num';
				$penci_query_args['order']    = 'DESC';
				break;
			case 'review':
				$penci_query_args['meta_key'] = 'penci_total_review';
				$penci_query_args['orderby']  = 'meta_value_num';
				$penci_query_args['order']    = 'DESC';
				break;
			case 'random_posts':
				$penci_query_args['orderby'] = 'rand';
				break;
			case 'alphabetical_order':
				$penci_query_args['orderby'] = 'title';
				$penci_query_args['order']   = 'ASC';
				break;
			case 'comment_count':
				$penci_query_args['orderby'] = 'comment_count';
				$penci_query_args['order']   = 'DESC';
				break;
			case 'random_today':
				$penci_query_args['orderby']  = 'rand';
				$penci_query_args['year']     = date( 'Y' );
				$penci_query_args['monthnum'] = date( 'n' );
				$penci_query_args['day']      = date( 'j' );
				break;
			case 'random_7_day':
				$penci_query_args['orderby']    = 'rand';
				$penci_query_args['date_query'] = array(
					'column' => 'post_date_gmt',
					'after'  => '1 week ago'
				);
				break;
		}

		if ( ! empty( $atts['post_ids'] ) ) {

			$post_id_arr = explode( ',', $atts['post_ids'] );

			$post_in = $post_not_in = array();

			foreach ( $post_id_arr as $p_id ) {
				$pre_post_id = trim( $p_id );
				if ( ! is_numeric( $pre_post_id ) ) {
					continue;
				}

				$pre_post_id = intval( $pre_post_id );

				if ( $pre_post_id < 0 ) {
					$post_not_in [] = str_replace( '-', '', $pre_post_id );
				} else {
					$post_in [] = $pre_post_id;
				}
			}

			if ( ! empty( $post_not_in ) ) {
				if ( ! empty( $penci_query_args['post__not_in'] ) ) {
					$penci_query_args['post__not_in'] = array_merge( $penci_query_args['post__not_in'], $post_not_in );
				} else {
					$penci_query_args['post__not_in'] = $post_not_in;
				}
			}

			if ( ! empty( $post_in ) ) {
				$penci_query_args['post__in'] = $post_in;
				$penci_query_args['orderby']  = 'post__in';
			}

		}

		if ( empty( $limit ) ) {
			$limit = get_option( 'posts_per_page' );
		}

		if ( ! empty( $limit_loadmore ) && in_array( $styleAction, array( 'load_more', 'infinite' ) ) ) {
			$offset = $offset ? $offset : 0;

			if ( intval( $paged ) > 1 ) {
				$offset = intval( $limit + ( intval( $paged - 2 ) * $limit_loadmore ) );
			}

			$penci_query_args['offset'] = $offset;

			$limit = $limit_loadmore;
		}


		$penci_query_args['posts_per_page'] = $limit;
		$penci_query_args['paged']          = ! empty( $paged ) ? $paged : 1;

		return $penci_query_args;
	}

	/**
	 * SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
	 *
	 * @since 1.0
	 *
	 * @param string $separator
	 *
	 * @return void
	 */
	public static function show_category( $separator, $cat_only = '', $show = true, $id = false ) {

		$output    = '';
		$post_type = get_post_type();

		if ( ! $post_type ) {
			return '';
		}

		$taxonomy = 'category';
		if( 'product' == $post_type ){
			$taxonomy = 'product_cat';
		}elseif( 'product' == $post_type ){
			$taxonomy = 'portfolio-category';
		}elseif( 'post' != $post_type ){
			$taxonomy_objects = get_object_taxonomies( $post_type, 'names' );
			if( $taxonomy_objects ){
				$taxonomy_objects = array_values( $taxonomy_objects );

				if( in_array( 'post_tag', $taxonomy_objects ) ){
					foreach ($taxonomy_objects as $taxonomy_objects_key => $taxonomy_objects_value ) {
						if( 'post_tag' == $taxonomy_objects_value ){
							unset($taxonomy_objects[$taxonomy_objects_key]);	
						}
					}
				}
				
				$count_taxonomy_objects = count( $taxonomy_objects );
				if( $count_taxonomy_objects > 1 ){
					$taxonomy = array_shift( $taxonomy_objects );
				}else{
					$taxonomy = isset( $taxonomy_objects[0] ) ? $taxonomy_objects[0] : '';
				}
			}
		}

		if ( ! $taxonomy ) {
			return '';
		}

		$category = get_the_terms( $id, $taxonomy );

		if ( ! $category || is_wp_error( $category ) ) {
			$category = array();
		}

		$category = array_values( $category );

		foreach ( array_keys( $category ) as $key ) {
			_make_cat_compat( $category[ $key ] );
		}

		if ( ! $category ) {
			return $output;
		}


		if( 'category' == $taxonomy  ){
			$penci_primary_cats = get_post_meta( get_the_ID(),'penci_primary_cat', true );

			$penci_primary_output = '';
			if( $penci_primary_cats ){
				$penci_primary_cats = explode( ',', $penci_primary_cats . ',' );
				foreach ( ( array ) $penci_primary_cats as $penci_primary_cat ) {

					if( ! $penci_primary_cat ){
						continue;
					}
					$term = get_term( $penci_primary_cat );
					if ( is_wp_error( $term ) ) {
						continue;
					}

					$category_display     = $term->name;
					$category_link        = get_category_link( $term->term_id );
					$penci_primary_output .= '<a class="penci-cat-name" href="' . $category_link . '" title="' . sprintf( esc_html__( "View all posts in %s", 'penci-framework' ), $category_display ) . '" ' . '>' . $category_display . '</a>';
				}
			}

			if( $penci_primary_output ){
				if ( ! $show ) {
					return $penci_primary_output;
				}

				echo $penci_primary_output;
				return;
			}
		}

		$category_display = '';
		$category_link    = '';
		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );
			if ( is_wp_error( $term ) ) {
				// Default to first category (not Yoast) if an error is returned
				$category_display = $category[0]->name;
				$category_link    = get_category_link( $category[0]->term_id );
			} else {
				// Yoast Primary category
				$category_display = $term->name;
				$category_link    = get_category_link( $term->term_id );
			}
		} else {
			// Default, display the first category in WP's list of assigned categories
			$category_display = $category[0]->name;
			$category_link    = get_category_link( $category[0]->term_id );
		}

		$output = '<a class="penci-cat-name" href="' . $category_link . '" title="' . sprintf( esc_html__( "View all posts in %s", 'penci-framework' ), $category_display ) . '" ' . '>' . $category_display . '</a>';

		if ( ! $show ) {
			return $output;
		}

		echo $output;
	}

	/**
	 * Prints HTML with meta information for the categories.
	 */
	public static function get_categories( $show_pri_cat = false ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'pennews' ) );

		if ( $show_pri_cat && class_exists( 'WPSEO_Primary_Term' ) ) {
			$category = get_the_category();
			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );
			if ( is_wp_error( $term ) ) {
				// Default to first category (not Yoast) if an error is returned
				$category_display = $category[0]->name;
				$category_link    = get_category_link( $category[0]->term_id );
			} else {
				// Yoast Primary category
				$category_display = $term->name;
				$category_link    = get_category_link( $term->term_id );
			}

			return ( '<div class="entry-meta-item penci-post-cat"><a class="penci-cat-name" href="' . $category_link . '" title="' . sprintf( esc_html__( "View all posts in %s", 'pennews' ), $category_display ) . '" ' . '>' . $category_display . '</a></div>' );
		} elseif ( $categories_list ) {
			return sprintf( '<div class="entry-meta-item penci-post-cat">' . esc_html__( '%1$s', 'pennews' ) . '</div>', $categories_list ); // WPCS: XSS OK.
		}
	}

	public static function get_the_category_list( $separator = '', $parents = '', $post_id = false ) {
		global $wp_rewrite;
		if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
			return apply_filters( 'the_category', '', $separator, $parents );
		}

		$categories = apply_filters( 'the_category_list', get_the_category( $post_id ), $post_id );

		if ( empty( $categories ) ) {
			return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );
		}

		$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

		$thelist = '';
		if ( '' == $separator ) {
			$thelist .= '<ul class="post-categories">';
			foreach ( $categories as $category ) {
				$thelist .= "\n\t<li>";
				switch ( strtolower( $parents ) ) {
					case 'multiple':
						if ( $category->parent )
							$thelist .= get_category_parents( $category->parent, true, $separator );
						$thelist .= '<a class="penci-cat-name" href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
						break;
					case 'single':
						$thelist .= '<a class="penci-cat-name" href="' . esc_url( get_category_link( $category->term_id ) ) . '"  ' . $rel . '>';
						if ( $category->parent )
							$thelist .= get_category_parents( $category->parent, false, $separator );
						$thelist .= $category->name.'</a></li>';
						break;
					case '':
					default:
						$thelist .= '<a class="penci-cat-name" href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
				}
			}
			$thelist .= '</ul>';
		} else {
			$i = 0;
			foreach ( $categories as $category ) {
				if ( 0 < $i )
					$thelist .= $separator;
				switch ( strtolower( $parents ) ) {
					case 'multiple':
						if ( $category->parent )
							$thelist .= get_category_parents( $category->parent, true, $separator );
						$thelist .= '<a class="penci-cat-name" href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a>';
						break;
					case 'single':
						$thelist .= '<a class="penci-cat-name" href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>';
						if ( $category->parent )
							$thelist .= get_category_parents( $category->parent, false, $separator );
						$thelist .= "$category->name</a>";
						break;
					case '':
					default:
						$thelist .= '<a class="penci-cat-name" href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a>';
				}
				++$i;
			}
		}
		return apply_filters( 'the_category', $thelist, $separator, $parents );
	}

	/**
	 * Get the featured image size url from post
	 *
	 * @since 1.0
	 */
	public static function get_featured_image_size( $id, $size = 'full' ) {
		$src = '';
		if ( function_exists( 'penci_get_featured_image_size' ) ) {
			$src = penci_get_featured_image_size( $id, $size );
		}

		return $src;
	}

	/**
	 * Display post thumbnail. Use featured image first and fallback to first image in the post content
	 *
	 * @param array $args
	 *
	 * @return bool
	 */
	public static function post_thumbnail( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'post'   => null,
			'size'   => 'thumbnail',
			'before' => '',
			'after'  => '',
			'echo'   => true,
		) );

		$url               = '';
		$image_size_info   = self::get_image_sizes( $args['size'] );
		$placeholder_image = PENCI_ADDONS_URL . 'assets/img/no-thumb.jpg';

		// Get post thumbnail
		if ( has_post_thumbnail( $args['post'] ) ) {
			$url = get_the_post_thumbnail_url( $args['post'], $args['size'] );
		}

		if ( empty( $url ) ) {
			$url = $placeholder_image;
		}

		$class_lazy = $data_src = '';
		if ( function_exists( 'penci_check_lazyload_type' ) ) {
			$class_lazy = penci_check_lazyload_type( 'class', null, false );
			$data_src   = penci_check_lazyload_type( 'src', $url, false );
		}

		$image = '<img class="' . $class_lazy . '" src="' . $placeholder_image . '"  ' . $data_src . ' width="' . $image_size_info['width'] . '" height="' . $image_size_info['height'] . '" alt="Image mega menu"/>';

		if ( ! $args['echo'] ) {
			return $url;
		}

		return $args['before'] . $image . $args['after'];
	}


	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @param $_size
	 *
	 * @return array
	 */
	public static function get_image_sizes( $_size ) {
		global $_wp_additional_image_sizes;

		$info = array(
			'width'  => '',
			'height' => '',
		);
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
			$info['width']  = get_option( "{$_size}_size_w" );
			$info['height'] = get_option( "{$_size}_size_h" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$info = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
			);
		}

		return $info;
	}

	/**
	 * Get post meta
	 *
	 * @param        $post_meta
	 * @param string $hide
	 *
	 * @return string
	 */
	public static function get_post_meta( $post_meta, $hide = '' ) {

		$output = '';
		if ( 'author' == $post_meta ) {
			$output = ( function_exists( 'penci_get_post_author' ) && ! $hide ? penci_get_post_author( false, false ) : '' );
		} elseif ( 'date' == $post_meta ) {
			$output = ( function_exists( 'penci_get_post_date' ) && ! $hide ? penci_get_post_date( false, false ) : '' );
		} elseif ( 'comment_count' == $post_meta ) {
			$output = ( function_exists( 'penci_get_comment_count' ) && ! $hide ? penci_get_comment_count( false, false ) : '' );
		}

		return $output;

	}

	/**
	 * @param string $hide
	 *
	 * @return string
	 */
	public static function icon_post_format( $hide = '', $class = '' ) {
		return ( function_exists( 'penci_icon_post_format' ) && ! $hide ? penci_icon_post_format( false, $class ) : '' );
	}

	/**
	 * @param $class
	 * @param $atts
	 *
	 * @return array
	 */
	public static function get_class_block( $class, $atts ) {


		foreach ( $class as $k => $v ) {
			if ( empty( $v ) ) {
				unset( $class[ $k ] );
			}
		}

		if ( ! empty( $atts['class'] ) ) {
			$class [] = $atts['class'];
		}

		if ( ! empty( $atts['style_block_title'] ) ) {
			$class [] = $atts['style_block_title'];
		}
		if ( ! empty( $atts['block_title_align'] ) ) {
			$class [] = $atts['block_title_align'];
		}

		if ( ! empty( $atts['style_pag'] ) ) {
			$class [] = 'penci-block-' . $atts['style_pag'];
		}

		if ( ! empty( $atts['image_type'] ) ) {
			$class [] = 'penci-imgtype-' . $atts['image_type'];
		}

		if ( empty( $atts['ajax_filter_type'] ) && empty( $atts['ajax_filter_ids'] ) ) {
			$class [] = 'penci-link-filter-hidden';
		} else {
			$class [] = 'penci-link-filter-show';
		}

		if ( empty( $atts['title'] ) && empty( $atts['ajax_filter_type'] ) && ( empty( $atts['style_pag'] ) || 'next_prev' != $atts['style_pag'] ) ) {
			$class [] = 'penci-empty-block-title';
		}

		$column_number = Penci_Global_Blocks::get_col_number();

		$is_widget = Penci_Helper_Shortcode::check_blockvc_is_widget( $atts );
		if ( $is_widget ) {
			$column_number = 1;
		}

		if ( $column_number ) {
			$class ['penci-vc-column'] = 'penci-vc-column-' . $column_number;
		}

		if ( isset( $atts['css'] ) && $atts['css'] ) {
			$class [] = vc_shortcode_custom_css_class( $atts['css'], '' );
		}

		return $class;
	}

	/**
	 * @param $atts
	 *
	 * @return array
	 */
	public static function get_ajax_filter_item( $atts ) {
		$atts = shortcode_atts(
			array(
				'ajax_filter_type'        => '',
				'ajax_filter_ids'         => '',
				'filter_default_txt'      => function_exists( 'penci_get_tran_setting' ) ? penci_get_tran_setting( 'penci_tran_text_all' ) : esc_html__( 'All', 'penci-framework' ),
				'ajax_preloading'         => '',
				'ajax_filter_number_item' => '5',
				'category_ids'            => '',
				'build_query'             => '',
				'tax_filter_slug'         => '',
				'ajax_filter_selected'    => '',
				'ajax_filter_childselected'    => ''
			), $atts );

		$items = array();

		if ( empty( $atts['ajax_filter_type'] ) ) {
			return $items;
		}

		$post_type = 'post';
		$id_text_all = '';
		$data_bquery_cats = $data_bquery_tags = $data_bquery_taxs = array();
		if ( isset( $atts['build_query'] ) ) {

			$build_query = $atts['build_query'];
			$data_bquery = PenciLoopSettings::parseData( $build_query );

			// Get post type current by setting build query
			if ( isset( $data_bquery['post_type'] ) && $data_bquery['post_type'] ) {
				$post_type = $data_bquery['post_type'];
			}

			// Get array categories by setting build query and  replace text all default to title category selected
			if ( isset( $data_bquery['categories'] ) && $data_bquery['categories'] ) {
				$data_bquery_cats = self::stringToArray( $data_bquery['categories'] );
				$count_data_cat = count( (array)$data_bquery_cats );

				if ( $count_data_cat == 1 ) {
					$category = get_category( $data_bquery['categories'] );
					if( isset( $category->slug ) ){
						$id_text_all = $category->slug;
					}
				}
			}

			// Get array tag by setting build query
			if ( isset( $data_bquery['tags'] ) && $data_bquery['tags'] ) {
				$data_bquery_tags = self::stringToArray( $data_bquery['tags'] );
			}

			if ( isset( $data_bquery['tax_query'] ) && $data_bquery['tax_query'] ) {
				$data_bquery_taxs = self::stringToArray( $data_bquery['tax_query'] );
				$count_data_taxs = count( (array)$data_bquery_taxs );

				if ( $count_data_taxs == 1 ) {
					$first_taxonomy = self::get_taxonomy( $data_bquery['tax_query'] );
					if ( isset( $first_taxonomy->slug ) ) {
						$id_text_all = $first_taxonomy->slug;
					}
				}
			}
		}

		$items[0] = array(
			'name' => $atts['filter_default_txt'],
			'id'   => $id_text_all
		);

		// Display selected categories or tags on the filter
		if ( $atts['ajax_filter_selected'] ) {
			if ( $data_bquery_cats && 'category_ids_filter' == $atts['ajax_filter_type'] ) {

				foreach ( $data_bquery_cats as $af_selected_cat ) {
					$afs_cat = get_category( $af_selected_cat );
					if ( isset( $afs_cat->slug ) ) {
						$items [] = array(
							'name'     => $afs_cat->name,
							'id'       => $afs_cat->slug,
							'taxonomy' => $afs_cat->taxonomy
						);
					}
				}
			} elseif ( $data_bquery_tags && 'tag_slug_filter' == $atts['ajax_filter_type'] ) {
				foreach ( $data_bquery_tags as $af_selected_tag ) {
					$afs_tag = get_tag( $af_selected_tag );
					if ( isset( $afs_tag->slug ) ) {
						$items [] = array(
							'name'     => $afs_tag->name,
							'id'       => $afs_tag->slug,
							'taxonomy' => $afs_tag->taxonomy
						);
					}
				}
			}elseif ( 'taxonomies_filter' == $atts['ajax_filter_type'] && $data_bquery_taxs ) {
				$parse_tax_query = self::parse_tax_query( $data_bquery_taxs );

				foreach ( $parse_tax_query as $taxonomy => $terms ) {
					foreach ( $terms as $term_id ) {
						$afs_tax = self::get_taxonomy( $term_id, $taxonomy );

						if ( isset( $afs_tax->slug ) ) {
							$items [] = array(
								'name'     => $afs_tax->name,
								'id'       => $afs_tax->slug,
								'taxonomy' => $afs_tax->taxonomy
							);
						}
					}
				}
			}

			return $items;
		}


		if( 'category_ids_filter' == $atts['ajax_filter_type'] ) {
			$args_cats = array(
				'exclude' => '1',
				'include' => $atts['ajax_filter_ids'],
				'number'  => $atts['ajax_filter_number_item']
			);

			$child_selected = isset( $atts['ajax_filter_childselected'] ) ? $atts['ajax_filter_childselected'] : false;
			$cats= array();
			if( $data_bquery_cats && $child_selected ) {
				foreach ( $data_bquery_cats as $data_bquery_cat ) {
					$args_cats['parent'] = $data_bquery_cat;
					$cats = array_merge( $cats, get_categories( $args_cats ) );
				}
			}else{
				$cats = get_categories( $args_cats );
			}

			if ( $atts['ajax_filter_ids'] ) {
				$ajax_filter_ids = explode( ',', $atts['ajax_filter_ids'] . ',' );
				$ajax_filter_ids = array_filter( $ajax_filter_ids );

				foreach ( $ajax_filter_ids as $cat_id ) {
					$cat_id = trim( $cat_id );
					foreach ( $cats as $cat ) {
						if ( $cat_id == $cat->term_id ) {
							$items [] = array(
								'name' => $cat->name,
								'id'   => $cat->slug,
								'taxonomy' => $cat->taxonomy
							);
						}
					}
				}
			} else {
				foreach ( $cats as $cat ) {
					$items[] = array(
						'name'     => $cat->name,
						'id'       => $cat->slug,
						'taxonomy' => $cat->taxonomy
					);
				}
			}
		}elseif( 'tag_slug_filter' == $atts['ajax_filter_type'] ) {

			$ajax_filter_ids = trim( $atts['ajax_filter_ids'] );
			$ajax_filter_ids = explode( ',', $ajax_filter_ids . ',' );
			$ajax_filter_ids = array_filter( $ajax_filter_ids );

			$args_tags = array(
				'include' =>  $ajax_filter_ids,
				'number'  => $atts['ajax_filter_number_item'],
				'orderby' => 'include'
			);

			$tags = get_tags( $args_tags );

			foreach ( $tags as $tag ) {
				$items[] = array(
					'name'     => $tag->name,
					'id'       => $tag->slug,
					'taxonomy' => $tag->taxonomy
				);
			}
		} elseif ( 'taxonomies_filter' == $atts['ajax_filter_type'] ) {

			$filter_taxs = array();
			if( $data_bquery_taxs ){
				$parse_tax_query = self::parse_tax_query( $data_bquery_taxs );
				$ajax_filter_ids = self::stringToArray( $atts['ajax_filter_ids'] );

				$args_taxs = array(
					'exclude'    => '1',
					'post_types' => $post_type,
					'include'    => $ajax_filter_ids,
					'number'     => $atts['ajax_filter_number_item']
				);

				foreach ( $parse_tax_query as $taxomomy => $terms ) {
					foreach ( $terms as $term_id ) {
						$args_taxs['parent']   = $term_id;
						$args_taxs['taxonomy'] = $taxomomy;
						$filter_taxs = array_merge( $filter_taxs, get_categories( $args_taxs ) );
					}
				}
			}else{

				$__taxonomy = '';
				if( 'product' == $post_type ){
					$__taxonomy = 'product_cat';
				}elseif( 'product' == $post_type ){
					$__taxonomy = 'portfolio-category';
				}else{
					$taxonomy_objects = get_object_taxonomies( $post_type, 'names' );
					if( $taxonomy_objects ){
						$__taxonomy = array_shift( array_values( $taxonomy_objects ) );
					}
				}

				$filter_taxs =  get_categories( array(
					'exclude'  => '1',
					'include'  => $atts['ajax_filter_ids'],
					'number'   => $atts['ajax_filter_number_item'],
					'taxonomy' => $__taxonomy
				) );
			}

			if ( $atts['ajax_filter_ids'] ) {

				if ( $ajax_filter_ids ) {
					foreach ( $ajax_filter_ids as $tax_id ) {
						$tax_id = trim( $tax_id );
						foreach ( $filter_taxs as $tax ) {
							if ( $tax_id == $tax->term_id ) {
								$items [] = array(
									'name'     => $tax->name,
									'id'       => $tax->slug,
									'taxonomy' => $tax->taxonomy
								);
							}
						}
					}
				}
			} elseif ( $filter_taxs ) {
				foreach ( $filter_taxs as $tax ) {
					$items[] = array(
						'name'     => $tax->name,
						'id'       => $tax->slug,
						'taxonomy' => $tax->taxonomy
					);
				}
			}
		}

		return $items;
	}

	/**
	 * Get widget args
	 * Note: please see function penci_widgets_init in theme.
	 *
	 * @param $atts
	 * @param $unique_id
	 * @param $class
	 *
	 * @return array
	 */
	public static function penci_get_widget_args( $atts, $unique_id, $class ) {

		$atts = shortcode_atts(
			array(
				'block_title_align' => 'style-title-left',
				'style_block_title' => 'style-title-1',
				'add_title_icon'    => '',
				'title_i_align'     => 'left',
				'title_icon'        => ''
			), $atts );

		$class_before_widget = ' penci-block-vc penci-widget-sidebar';

		$class_before_widget .= ' ' . $atts['style_block_title'];
		$class_before_widget .= ' ' . $atts['block_title_align'];
		$class_before_widget .= $class ? ' ' . $class : '';

		$before_widget = '<div id="' . $unique_id . '" class="widget ' . $class_before_widget . ' %s">';
		$before_title  = '<div class="penci-block-heading"><h4 class="widget-title penci-block__title"><span>';
		$before_title  .= $atts['add_title_icon'] && $atts['title_icon'] && 'left' == $atts['title_i_align'] ? '<i class="fa-pos-left ' . $atts['title_icon'] . '"></i>' : '';

		$after_title = $atts['add_title_icon'] && $atts['title_icon'] && 'right' == $atts['title_i_align'] ? '<i class="fa-pos-right ' . $atts['title_icon'] . '"></i>' : '';
		$after_title .= '</span></h4></div>';

		return array(
			'before_widget' => $before_widget,
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title
		);
	}

	public function is_inline() {
		$is_inline = ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && ( isset( $_GET['vc_editable'] ) && 'true' === $_GET['vc_editable'] ) );

		return $is_inline;
	}

	public static function get_roles( $get_title = false ) {
		$pre_roles   = array();
		$roles_title = '';

		$all_roles      = wp_roles()->roles;
		$editable_roles = apply_filters( 'editable_roles', $all_roles );

		foreach ( $editable_roles as $key => $role ) {
			$pre_roles[] = array( 'label' => $role['name'], 'value' => $key );

			$roles_title .= '<li style="list-style:square;width: 30%;float: left;margin-left: 2%" >' . $key . '</li>';
		}

		if ( $get_title ) {
			return $roles_title ? '<ul style="margin-left: 10px;">' . $roles_title . '</ul><hr style="clear: both;margin-top:10px;">' : '';
		}

		return $pre_roles;
	}

	function remove_seprated_line( $html ) {
		return str_replace( "\n", '', $html );
	}

	public function get_cat_autocomplete_suggester( $query, $slug = false ) {
		global $wpdb;
		$cat_id          = (int) $query;
		$query           = trim( $query );
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
						FROM {$wpdb->term_taxonomy} AS a
						INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
						WHERE a.taxonomy = 'product_cat' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )", $cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$result = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $slug ? $value['slug'] : $value['id'];
				$data['label'] = __( 'Id', 'penci-framework' ) . ': ' . $value['id'] . ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . __( 'Name', 'penci-framework' ) . ': ' . $value['name'] : '' ) . ( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . __( 'Slug', 'penci-framework' ) . ': ' . $value['slug'] : '' );
				$result[]      = $data;
			}
		}

		return $result;
	}

	public static function stringToArray( $value ) {
		$valid_values = array();
		$list         = preg_split( '/\,[\s]*/', $value );
		foreach ( $list as $v ) {
			if ( strlen( $v ) > 0 ) {
				$valid_values[] = $v;
			}
		}

		return $valid_values;
	}

	public static function get_taxonomy( $term, $taxonomy, $output = OBJECT, $filter = 'raw' ) {
		$tax = get_term( $term, $taxonomy, $output, $filter );

		if ( is_wp_error( $tax ) )
			return $tax;

		_make_cat_compat( $tax );

		return $tax;
	}

	public static function parse_tax_query( $terms ) {
		$negative_term_list = array();
		foreach ( $terms as $term ) {
			if ( (int) $term < 0 ) {
				$negative_term_list[] = abs( $term );
			}
		}

		$in     = array();
		$terms = get_terms( PenciLoopSettings::getTaxonomies(), array( 'include' => array_map( 'abs', $terms ) ) );
		foreach ( $terms as $t ) {
			if ( ! in_array( (int) $t->term_id, $negative_term_list ) ) {
				$in[ $t->taxonomy ][] = $t->term_id;
			}
		}


		return $in;
	}

}

/**
 * Trims post title.
 *
 * @param $id
 * @param int $length
 * @param null $more
 *
 * @return string
 */
if ( ! function_exists( 'penci_trim_post_title' ) ) {
	function penci_trim_post_title( $id = '', $length = 10, $more = '...' ) {

		if ( empty( $id ) ) {
			$id = get_the_ID();
		}

		return wp_trim_words( wp_strip_all_tags( get_the_title( $id ) ), $length, $more );
	}
}


if ( ! function_exists( 'penci_get_theme_mod' ) ) {
	function penci_get_theme_mod( $name, $default = false ) {
		static $mods;

		$mods = empty( $mods ) ? get_theme_mods() : $mods;

		if ( isset( $mods[ $name ] ) ) {
			return apply_filters( "theme_mod_{$name}", $mods[ $name ] );
		}

		if ( is_string( $default ) ) {
			$default = sprintf( $default, get_template_directory_uri(), get_stylesheet_directory_uri() );
		}

		return apply_filters( "theme_mod_{$name}", $default );
	}
}
if ( ! function_exists( 'penci_pennews_get_price_html' ) ) {
	function penci_pennews_get_price_html( $product, $deprecated = '' ) {

		if ( empty( $product ) ) {
			return '';
		}
		if ( '' === $product->get_price() ) {
			$price = apply_filters( 'woocommerce_empty_price_html', '', $product );
		} elseif ( $product->is_on_sale() ) {
			$price = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
		} else {
			$price = wc_price( wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
		}

		return apply_filters( 'woocommerce_get_price_html', $price, $product );
	}
}

/**
 * Get image sizes.
 *
 * Retrieve available image sizes after filtering `include` and `exclude` arguments.
 */
if ( ! function_exists( 'penci_pennews_get_list_image_sizes' ) ) {
	function penci_pennews_get_list_image_sizes( $default = false ) {
		$wp_image_sizes = penci_pennews_get_all_image_sizes();

		$image_sizes = array();

		if ( $default ) {
			$image_sizes[esc_html__( 'Default', 'penci-framework' ) ] = '';
		}

		foreach ( $wp_image_sizes as $size_key => $size_attributes ) {
			$control_title = ucwords( str_replace( '_', ' ', $size_key ) );
			if ( is_array( $size_attributes ) ) {
				$control_title .= sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
			}

			$image_sizes[ $control_title ] = $size_key;
		}

		$image_sizes[ _x( 'Full', 'Image Size Control', 'penci-framework' ) ] = 'full';

		return $image_sizes;
	}
}

if ( ! function_exists( 'penci_pennews_get_all_image_sizes' ) ):
	function penci_pennews_get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = [ 'thumbnail', 'medium', 'medium_large', 'large' ];

		$image_sizes = [];

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ] = [
				'width'  => (int) get_option( $size . '_size_w' ),
				'height' => (int) get_option( $size . '_size_h' ),
				'crop'   => (bool) get_option( $size . '_crop' ),
			];
		}

		if ( $_wp_additional_image_sizes ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return $image_sizes;
	}
endif;