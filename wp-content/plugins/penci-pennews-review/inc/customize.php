<?php
/**
 * Customize for Penci review
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'penci_soledad_review_customizer' ) ) {
	function penci_soledad_review_customizer( $wp_customize ) {
		// Add Sections
		$wp_customize->add_section( 'penci_new_section_review', array(
			'title'       => 'Posts Review Options',
			'description' => '',
			'priority'    => 49,
		) );

		$list_checkbox1 = array(
			'penci_review_hide_average'      => esc_html__( 'Hide "Average Score" text', 'penci' ),
			'penci_review_hide_piechart'     => esc_html__( 'Hide Review Pie Chart on Featured Image', 'penci' ),
			'penci_review_repl_stars_circle' => esc_html__( 'Display stars replace with score circle on the layouts', 'penci' ),
			'penci_review_dis_anim_stars' => esc_html__( 'Disable animation of star rating', 'penci' ),
			'penci_review_hide_user_rating'  => esc_html__( 'Hide User Rating', 'penci' ),

			'penci_review_hide_address' => esc_html__( 'Hide Adress', 'penci' ),
			'penci_review_hide_phone'   => esc_html__( 'Hide Phone', 'penci' ),
			'penci_review_hide_website' => esc_html__( 'Hide Website', 'penci' ),
			'penci_review_hide_price'   => esc_html__( 'Hide Product Price', 'penci' ),
			'penci_review_hide_btnbuy'  => esc_html__( 'Hide Button Buy Now', 'penci' ),
			'penci_review_hide_schema'  => esc_html__( 'Hide Reviewed Schema Info', 'penci' ),

			'penci_rv_dis_point'              => esc_html__( 'Disable Author Review Points on [penci_review] shortcodes', 'penci' ),
			'penci_rv_dis_goodbad'            => esc_html__( 'Disable The goods & the bads & AVERAGE SCORE on [penci_review] shortcodes', 'penci' ),
			'penci_rv_dis_desc'               => esc_html__( 'Disable review descriptions', 'penci' ),
			'penci_rv_enable_sim_author'      => esc_html__( 'Enable Simple Author Review', 'penci' ),
		);

		foreach ( $list_checkbox1 as $id1 => $title1 ) {

			$wp_customize->add_setting( $id1, array(
				'default'           => '',
				'sanitize_callback' => 'penci_review_sanitize_checkbox_field'
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $id1, array(
				'label'    => $title1,
				'section'  => 'penci_new_section_review',
				'settings' => $id1,
				'type'     => 'checkbox',
				'priority' => 2
			) ) );
		}

		if ( class_exists( 'Penci_Review_Customize_Number_Control' ) ) {
			$wp_customize->add_setting( 'penci_review_img_width', array(
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( new Penci_Review_Customize_Number_Control( $wp_customize, 'penci_review_img_width', array(
				'label'    => esc_html__( 'Custom Width for Thumbnail', 'pennews' ),
				'section'  => 'penci_new_section_review',
				'settings' => 'penci_review_img_width',
				'type'     => 'number',
				'priority' => 2
			) ) );
		}

		$wp_customize->add_setting( 'penci_review_img_size', array(
			'default'           => 'thumbnail',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'penci_review_img_size', array(
			'label'    =>  esc_html__( 'Thumbnail size', 'pennews' ),
			'section'  => 'penci_new_section_review',
			'settings' => 'penci_review_img_size',
			'type'     => 'text',
			'priority' => 2,
			'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme).', 'pennews' ),
		) ) );

		$wp_customize->add_setting( 'penci_review_schema_markup', array(
			'default'           => 'thing',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'penci_review_schema_markup', array(
				'label'    => esc_html__( 'Review Schema', 'pennews' ),
				'type'     => 'select',
				'section'  => 'penci_new_section_review',
				'choices'  => Penci_Review_Schema_Markup::get_list_schema(),
				'settings' => 'penci_review_schema_markup',
				'priority' => 2
		) );

		if ( class_exists( 'Penci_Review_Customize_Heading_Control' ) ) {
			$wp_customize->add_setting( 'penci_review_opt_color_heading', array(
				'sanitize_callback' => 'esc_url_raw'
			) );
			$wp_customize->add_control( new Penci_Review_Customize_Heading_Control( $wp_customize, 'penci_review_opt_color_heading', array(
				'label'    => esc_html__( 'Colors', 'pennews' ),
				'section'  => 'penci_new_section_review',
				'settings' => 'penci_review_opt_color_heading',
				'type'     => 'heading',
				'priority' => 2
			) ) );

		}

		$colors = array(
			'penci_review_border_color'        => array( 'default' => '', 'label' => esc_html__( 'Review Box Border Color', 'penci' ) ),
			'penci_review_title_color'         => array( 'default' => '', 'label' => esc_html__( 'Review Title Color', 'penci' ) ),
			'penci_review_desc_color'          => array( 'default' => '', 'label' => esc_html__( 'Review Description Text Color', 'penci' ) ),
			'penci_review_point_title_color'   => array( 'default' => '', 'label' => esc_html__( 'Review Point Title & Score Color', 'penci' ) ),
			'penci_review_process_main_color'  => array( 'default' => '', 'label' => esc_html__( 'Review Process Main Background Color', 'penci' ) ),
			'penci_review_process_run_color'   => array( 'default' => '', 'label' => esc_html__( 'Review Process Running Background Color', 'penci' ) ),
			'penci_review_title_good_color'    => array( 'default' => '', 'label' => esc_html__( 'The Goods & The Bads Title Color', 'penci' ) ),
			'penci_review_good_icon'           => array( 'default' => '', 'label' => esc_html__( 'Review The Goods Icon Color', 'penci' ) ),
			'penci_review_bad_icon'            => array( 'default' => '', 'label' => esc_html__( 'Review The Bads Icon Color', 'penci' ) ),
			'penci_review_average_total_bg'    => array( 'default' => '', 'label' => esc_html__( 'Review Average Total Background', 'penci' ) ),
			'penci_review_process_total_color' => array( 'default' => '', 'label' => esc_html__( 'Review Average Total Process Main Background Color', 'penci' ) ),
			'review_process_total_run_color'   => array( 'default' => '', 'label' => esc_html__( 'Review Average Total Process Running Background Color', 'penci' ) ),
			'penci_review_average_total_color' => array( 'default' => '', 'label' => esc_html__( 'Review Average Total Score Color', 'penci' ) ),
			'penci_review_average_text_color'  => array( 'default' => '', 'label' => esc_html__( 'Review "Average Score" Text Color', 'penci' ) ),
			'penci_review_piechart_border'     => array( 'default' => '', 'label' => esc_html__( 'Review Pie Chart Border Color', 'penci' ) ),
			'penci_review_piechart_text'       => array( 'default' => '', 'label' => esc_html__( 'Review Pie Chart Score Text Color', 'penci' ) ),
			'penci_review_rating_normalFill'   => array( 'default' => '', 'label' => esc_html__( 'The Background Color For The Un-rated Part Of A Star', 'penci' ) ),
			'penci_review_rating_ratedFill'    => array( 'default' => '', 'label' => esc_html__( 'The Color For The Rated Part Of A Star', 'penci' ) ),
			'penci_review_badge_color'         => array( 'default' => '', 'label' => esc_html__( 'Verified Badge Color', 'penci' ) ),
			'penci_review_badge_bgcolor'       => array( 'default' => '', 'label' => esc_html__( 'Verified Badge Background Color', 'penci' ) ),
		);

		foreach ( $colors as $color_id => $color ) {
			$wp_customize->add_setting( $color_id, array(
				'default'           => $color['default'],
				'sanitize_callback' => 'sanitize_hex_color'
			) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color_id, array(
				'label'    => $color['label'],
				'section'  => 'penci_new_section_review',
				'settings' => $color_id,
			) ) );
		}

		$trans = array(
			'penci_review_price_text'         => esc_html__( 'Custom "Price" text', 'penci' ),
			'penci_review_voted_text'         => esc_html__( 'Custom "votes" text', 'penci' ),
			'penci_review_user_rating_text'   => esc_html__( 'Custom "User Rating:" text', 'penci' ),
			'penci_review_author_rating_text' => esc_html__( 'Custom "Author Review:" text', 'penci' ),
			'penci_review_no_rate_text'       => esc_html__( 'Custom "Be the first one !" text', 'penci' ),
			'penci_review_good_text'          => esc_html__( 'Custom "The Goods" text', 'penci' ),
			'penci_review_bad_text'           => esc_html__( 'Custom "The Bads" text', 'penci' ),
			'penci_review_average_text'       => esc_html__( 'Custom "Average Score" text', 'penci' ),
			'penci_rv_form_title_text'        => esc_html__( 'Custom "Leave a review" text', 'penci' ),
			'penci_review_zero'               => esc_html__( 'Custom "0 review" text', 'penci' ),
			'penci_review_one'                => esc_html__( 'Custom "1 review" text', 'penci' ),
			'penci_review_more'               => esc_html__( 'Custom "reviews" text', 'penci' ),
			'penci_review_verified_text'      => esc_html__( 'Custom "Verified" text', 'penci' ),
			'penci_review_ver_badges_text'    => esc_html__( 'Custom "verified badges" text', 'penci' ),
			'penci_review_received_jud_text'  => esc_html__( 'Custom "received judgements" text', 'penci' ),

			'penci_rv_form_namefield_text'     => esc_html__( 'Custom "Name" text', 'penci' ),
			'penci_rv_form_emailfield_text'    => esc_html__( 'Custom "Email" text', 'penci' ),
			'penci_rv_form_titlefield_text'    => esc_html__( 'Custom "Title" text', 'penci' ),
			'penci_urreview_awaiting_approval' => esc_html__( 'Custom "Your review awaiting approval." text', 'penci' ),

			'penci_review_thankyou_text' => esc_html__( 'Custom "Thank you for your rating" text', 'penci' ),
			'penci_review_error_text'    => esc_html__( 'Custom "Error during rate process" text', 'penci' ),

			'penci_review_namereq_text'    => esc_html__( 'Custom "Your name is required" text', 'penci' ),
			'penci_review_emailreq_text'   => esc_html__( 'Custom "Your email is required" text', 'penci' ),
			'penci_review_emailvaild_text' => esc_html__( 'Custom "Your email is not valid" text', 'penci' ),
			'penci_review_likeerror_text'  => esc_html__( 'Custom "Unable to judge this review" text', 'penci' ),
			'penci_review_duplicate'       => esc_html__( 'Custom "Duplicate review detected; it looks as though you&#8217;ve already review that!" text', 'penci' ),

			'penci_review_text_thing'         => esc_html__( 'Custom "Thing" text', 'penci' ),
			'penci_review_text_none'          => esc_html__( 'Custom "None" text', 'penci' ),
			'penci_review_text_book'          => esc_html__( 'Custom "Book" text', 'penci' ),
			'penci_review_text_game'          => esc_html__( 'Custom "Game" text', 'penci' ),
			'penci_review_text_movie'         => esc_html__( 'Custom "Movie" text', 'penci' ),
			'penci_review_text_musicreco'     => esc_html__( 'Custom "MusicRecording" text', 'penci' ),
			'penci_review_text_painting'      => esc_html__( 'Custom "Painting" text', 'penci' ),
			'penci_review_text_place'         => esc_html__( 'Custom "Place" text', 'penci' ),
			'penci_review_text_product'       => esc_html__( 'Custom "Product" text', 'penci' ),
			'penci_review_text_restaurant'    => esc_html__( 'Custom "Restaurant" text', 'penci' ),
			'penci_review_text_sfapp'         => esc_html__( 'Custom "SoftwareApplication" text', 'penci' ),
			'penci_review_text_store'         => esc_html__( 'Custom "Store" text', 'penci' ),
			'penci_review_text_tvseries'      => esc_html__( 'Custom "TVSeries" text', 'penci' ),
			'penci_review_text_webSite'       => esc_html__( 'Custom "WebSite" text', 'penci' ),


			// Booking
			'penci_reviewt_btitle'            => esc_html__( 'Custom "Book Title" text', 'penci' ),
			'penci_reviewt_burl'              => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_bauthor'           => esc_html__( 'Custom "Book Author" text', 'penci' ),
			'penci_reviewt_bedition'          => esc_html__( 'Custom "Book Edition" text', 'penci' ),
			'penci_reviewt_bformat'           => esc_html__( 'Custom "Book Format" text', 'penci' ),
			'penci_reviewt_bdate'             => esc_html__( 'Custom "Date published" text', 'penci' ),
			'penci_reviewt_billustrator'      => esc_html__( 'Custom "Illustrator" text', 'penci' ),
			'penci_reviewt_bISBN'             => esc_html__( 'Custom "ISBN" text', 'penci' ),
			'penci_reviewt_bnumberofpage'     => esc_html__( 'Custom "Number Of Pages" text', 'penci' ),
			'penci_reviewt_bdesc'             => esc_html__( 'Custom "Book Description" text', 'penci' ),

			// Game
			'penci_reviewt_game_title'        => esc_html__( 'Custom "Game title" text', 'penci' ),
			'penci_reviewt_game_url'          => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_game_desc'         => esc_html__( 'Custom "Game description" text', 'penci' ),

			// Movie
			'penci_reviewt_mv_title'          => esc_html__( 'Custom "Movie title" text', 'penci' ),
			'penci_reviewt_mv_url'            => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_mv_date'           => esc_html__( 'Custom "Date published" text', 'penci' ),
			'penci_reviewt_mv_desc'           => esc_html__( 'Custom "Movie description" text', 'penci' ),
			'penci_reviewt_mv_dir'            => esc_html__( 'Custom "Director(s)" text', 'penci' ),
			'penci_reviewt_mv_actor'          => esc_html__( 'Custom "Actor(s)" text', 'penci' ),
			'penci_reviewt_mv_genre'          => esc_html__( 'Custom "Genre" text', 'penci' ),

			// Music recording
			'penci_reviewt_music_name'        => esc_html__( 'Custom "Track name" text', 'penci' ),
			'penci_reviewt_music_url'         => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_music_author'      => esc_html__( 'Custom "Author" text', 'penci' ),
			'penci_reviewt_music_dur'         => esc_html__( 'Custom "Track Duration" text', 'penci' ),
			'penci_reviewt_music_album'       => esc_html__( 'Custom "Album name" text', 'penci' ),
			'penci_reviewt_music_genre'       => esc_html__( 'Custom "Genre" text', 'penci' ),

			// Painting
			'penci_reviewt_painting_name'     => esc_html__( 'Custom "Name" text', 'penci' ),
			'penci_reviewt_painting_author'   => esc_html__( 'Custom "Author" text', 'penci' ),
			'penci_reviewt_painting_url'      => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_painting_date_pub' => esc_html__( 'Custom "Date published" text', 'penci' ),
			'penci_reviewt_painting_genre'    => esc_html__( 'Custom "Genre" text', 'penci' ),

			// Place
			'penci_reviewt_place_name'        => esc_html__( 'Custom "Place Name" text', 'penci' ),
			'penci_reviewt_place_url'         => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_place_desc'        => esc_html__( 'Custom "Place Description" text', 'penci' ),

			// Product
			'penci_reviewt_prod_name'         => esc_html__( 'Custom "Product Name" text', 'penci' ),
			'penci_reviewt_prod_url'          => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_prod_price'        => esc_html__( 'Custom "Price" text', 'penci' ),
			'penci_reviewt_prod_currency'     => esc_html__( 'Custom "Currency" text', 'penci' ),
			'penci_reviewt_prod_avai'         => esc_html__( 'Custom "Availability" text', 'penci' ),
			'penci_reviewt_prod_band'         => esc_html__( 'Custom "Brand" text', 'penci' ),
			'penci_reviewt_prod_suk'          => esc_html__( 'Custom "SKU" text', 'penci' ),
			'penci_reviewt_prod_desc'         => esc_html__( 'Custom "Product Description', 'penci' ),

			// Restaurant
			'penci_reviewt_restau_name'       => esc_html__( 'Custom "Restaurant Name" text', 'penci' ),
			'penci_reviewt_restau_url'        => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_restau_address'    => esc_html__( 'Custom "Address" text', 'penci' ),
			'penci_reviewt_restau_price'      => esc_html__( 'Custom "Price range" text', 'penci' ),
			'penci_reviewt_restau_telephone'  => esc_html__( 'Custom "Telephone" text', 'penci' ),
			'penci_reviewt_restau_serves'     => esc_html__( 'Custom "Serves cuisine" text', 'penci' ),
			'penci_reviewt_restau_ophours'    => esc_html__( 'Custom "Opening hours" text', 'penci' ),
			'penci_reviewt_restau_desc'       => esc_html__( 'Custom "Restaurant Description" text', 'penci' ),

			// Software application
			'penci_reviewt_app_name'          => esc_html__( 'Custom "Name" text', 'penci' ),
			'penci_reviewt_app_url'           => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_app_price'         => esc_html__( 'Custom "Price" text', 'penci' ),
			'penci_reviewt_app_currency'      => esc_html__( 'Custom "Currency" text', 'penci' ),
			'penci_reviewt_app_opsystem'      => esc_html__( 'Custom "Operating System" text', 'penci' ),
			'penci_reviewt_app_app_cat'       => esc_html__( 'Custom "Application Category" text', 'penci' ),
			'penci_reviewt_app_desc'          => esc_html__( 'Custom "Description" text', 'penci' ),

			// Store
			'penci_reviewt_store_name'        => esc_html__( 'Custom "Store Name" text', 'penci' ),
			'penci_reviewt_store_url'         => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_store_address'     => esc_html__( 'Custom "Address" text', 'penci' ),
			'penci_reviewt_store_price'       => esc_html__( 'Custom "Price range" text', 'penci' ),
			'penci_reviewt_store_telephone'   => esc_html__( 'Custom "Telephone" text', 'penci' ),
			'penci_reviewt_store_desc'        => esc_html__( 'Custom "Store Description" text', 'penci' ),

			// TVSeries
			'penci_reviewt_tv_name'           => esc_html__( 'Custom "Name" text', 'penci' ),
			'penci_reviewt_tv_url'            => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_tv_desc'           => esc_html__( 'Custom "Description" text', 'penci' ),

			// WebSite
			'penci_reviewt_web_name'          => esc_html__( 'Custom "Name" text', 'penci' ),
			'penci_reviewt_web_url'           => esc_html__( 'Custom "URL" text', 'penci' ),
			'penci_reviewt_web_desc'          => esc_html__( 'Custom "Description" text', 'penci' ),
		);

		foreach ( $trans as $key => $tran ) {
			$wp_customize->add_setting( $key, array(
				'default'           => penci_review_tran_default_setting( $key ),
				'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $key, array(
				'label'    => $tran,
				'section'  => 'penci_new_section_review',
				'settings' => $key,
				'type'     => 'text'
			) ) );
		}

		if ( class_exists( 'Penci_Customize_Heading_Control' ) ) {
			$wp_customize->add_setting( 'penci_review_user_heading', array(
				'sanitize_callback' => 'esc_url_raw'
			) );
			$wp_customize->add_control( new Penci_Customize_Heading_Control( $wp_customize, 'penci_review_user_heading', array(
				'label'    => esc_html__( 'User Review', 'pennews' ),
				'section'  => 'penci_new_section_review',
				'settings' => 'penci_review_user_heading',
				'type'     => 'heading',
			) ) );
		}

		if ( class_exists( 'Penci_Review_Customize_Heading_Control' ) ) {
			$wp_customize->add_setting( 'penci_review_opt_heading', array(
				'sanitize_callback' => 'esc_url_raw'
			) );
			$wp_customize->add_control( new Penci_Review_Customize_Heading_Control( $wp_customize, 'penci_review_opt_heading', array(
				'label'    => esc_html__( 'Users Reviews Options', 'pennews' ),
				'section'  => 'penci_new_section_review',
				'settings' => 'penci_review_opt_heading',
				'type'     => 'heading',
			) ) );
		}

		$list_checkbox = array(
			'penci_user_review_enable'        => esc_html__( 'Enable Users review tab', 'penci' ),
			'penci_review_moderation'         => esc_html__( 'User review must be manually approved', 'penci' ),
			'penci_review_require_name_email' => esc_html__( 'User review must fill out name and email', 'penci' ),
			'penci_review_like_dislike'       => esc_html__( 'Hide User Review Like/Dislike Counter', 'penci' ),
			'penci_review_sharing'            => esc_html__( 'Hide User Review Sharing', 'penci' ),

			'penci_urv_verified'            => esc_html__( 'Hide User Review Verified', 'penci' ),
			'penci_urv_date'                => esc_html__( 'Hide User Review Date', 'penci' ),
			'penci_urv_review_count'        => esc_html__( 'Hide User Review Count', 'penci' ),
			'penci_urv_received_judgements' => esc_html__( 'Hide User Review Received Judgements', 'penci' ),
			'penci_urv_verified_badges'     => esc_html__( 'Hide User Review Verified Badges', 'penci' ),
		);

		foreach ( $list_checkbox as $id => $title ) {

			$default = false;
			if ( 'penci_review_require_name_email' == $id ) {
				$default = true;
			}

			$wp_customize->add_setting( $id, array(
				'default'           => $default,
				'sanitize_callback' => 'penci_review_sanitize_checkbox_field'
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $id, array(
				'label'    => $title,
				'section'  => 'penci_new_section_review',
				'settings' => $id,
				'type'     => 'checkbox',
			) ) );
		}

		if ( class_exists( 'Penci_Review_Customize_Heading_Control' ) ) {
			$wp_customize->add_setting( 'penci_review_sshare_heading', array(
				'sanitize_callback' => 'esc_url_raw'
			) );
			$wp_customize->add_control( new Penci_Review_Customize_Heading_Control( $wp_customize, 'penci_review_sshare_heading', array(
				'label'    => esc_html__( 'Options for show/hide social sharing on Users Reviews Sharing', 'pennews' ),
				'section'  => 'penci_new_section_review',
				'settings' => 'penci_review_sshare_heading',
				'type'     => 'heading',
			) ) );
		}

		$list_block_social = array(
			'facebook'    => esc_html__( 'Hide Facebook', 'pennews' ),
			'twitter'     => esc_html__( 'Hide Twitter', 'pennews' ),
			'google_plus' => esc_html__( 'Hide Google Plus', 'pennews' ),
			'email'       => esc_html__( 'Hide Email', 'pennews' ),
			'link'        => esc_html__( 'Hide Standard Link', 'pennews' ),
		);

		foreach ( $list_block_social as $social_id => $social_label ) {

			$default = '';

			$social_id = 'penci_hide_ur_share_' . $social_id;
			$wp_customize->add_setting( $social_id, array(
				'sanitize_callback' => 'penci_review_sanitize_checkbox_field',
				'default'           => $default
			) );
			$wp_customize->add_control( new WP_Customize_Control(
				$wp_customize,
				$social_id,
				array(
					'label'    => $social_label,
					'section'  => 'penci_new_section_review',
					'type'     => 'checkbox',
					'settings' => $social_id,
				)
			) );
		}
	}
}
add_action( 'customize_register', 'penci_soledad_review_customizer' );

if ( ! function_exists( 'penci_reivew_add_control_customize' ) ) {
	add_action( 'init', 'penci_reivew_add_control_customize' );
	function penci_reivew_add_control_customize() {
		if ( class_exists( 'WP_Customize_Control' ) ) {
			class Penci_Review_Customize_Heading_Control extends WP_Customize_Control {
				public $type = 'heading';

				public function render_content() {
					?>
					<label>
						<h2 class="customize-control-title" style="text-transform: uppercase; text-align: center;"><?php echo esc_html( $this->label ); ?></h2>
						<hr style="border-top:1px solid #111;"/>
					</label>
					<?php
				}
			}

			class Penci_Review_Customize_Number_Control extends WP_Customize_Control {
				public $type = 'number';

				public function render_content() {
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<input type="number" name="quantity" <?php esc_attr( $this->link() ); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;">px
					</label>
					<?php
				}
			}
		}
	}
}
/**
 * Callback function for sanitizing checkbox settings.
 * Use for PenciDesign
 *
 * @param $input
 *
 * @return string default value if type is not exists
 */
if ( ! function_exists( 'penci_review_sanitize_checkbox_field' ) ) {
	function penci_review_sanitize_checkbox_field( $input ) {
		if ( $input == 1 ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Customize colors
 * @since 3.0
 */
if ( ! function_exists( 'penci_review_customizer_css' ) ) {
	function penci_review_customizer_css() {
		?>
		<style type="text/css">
			<?php if(get_theme_mod( 'penci_review_border_color' )) : ?>.wrapper-penci-review, .penci-review-container.penci-review-count {
				border-color: <?php echo get_theme_mod( 'penci_review_border_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_title_color' )) : ?>.penci-review-container.penci-review-count h4 {
				color: <?php echo get_theme_mod( 'penci_review_title_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_desc_color' )) : ?>.penci-review-container .penci-review-desc p {
				color: <?php echo get_theme_mod( 'penci_review_desc_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_point_title_color' )) : ?>.penci-review-text {
				color: <?php echo get_theme_mod( 'penci_review_point_title_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_process_main_color' )) : ?>.penci-review-process {
				background-color: <?php echo get_theme_mod( 'penci_review_process_main_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_process_run_color' )) : ?>.penci-review .penci-review-process span {
				background-color: <?php echo get_theme_mod( 'penci_review_process_run_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_title_good_color' )) : ?>.penci-review-stuff .penci-review-good h5 {
				color: <?php echo get_theme_mod( 'penci_review_title_good_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_good_icon' )) : ?>.penci-review .penci-review-good ul li:before {
				color: <?php echo get_theme_mod( 'penci_review_good_icon' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_bad_icon' )) : ?>.penci-review .penci-review-bad ul li:before {
				color: <?php echo get_theme_mod( 'penci_review_bad_icon' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_average_total_bg' )) : ?>.penci-review .penci-review-score-total {
				background-color: <?php echo get_theme_mod( 'penci_review_average_total_bg' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_average_total_color' )) : ?>.penci-review-score-num {
				color: <?php echo get_theme_mod( 'penci_review_average_total_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_average_text_color' )) : ?>.penci-review-score-total span {
				color: <?php echo get_theme_mod( 'penci_review_average_text_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_process_total_color' )) : ?>.penci-review-average .penci-review-process {
				background-color: <?php echo penci_convert_hex_rgb( get_theme_mod( 'penci_review_process_total_color' ), $opacity = 0.26 ) ; ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'review_process_total_run_color' )) : ?>.penci-review-average .penci-review-process span.penci-process-run {
				background-color: <?php echo get_theme_mod( 'review_process_total_run_color' ); ?>;
			}

			<?php endif; ?>
			<?php if(get_theme_mod( 'penci_review_piechart_text' )) : ?>.penci-chart-text {
				color: <?php echo get_theme_mod( 'penci_review_piechart_text' ); ?>;
			}
			<?php endif; ?>

			<?php
				if( get_theme_mod( 'penci_review_rating_normalFill' ) ){
					echo '.penci-preview-rating .penci-prvrate-bg{ color: ' . get_theme_mod( 'penci_review_rating_normalFill' ) . ' }';
				}
				if( get_theme_mod( 'penci_review_rating_ratedFill' ) ){
					echo '.penci-preview-rating .penci-prvrate-active{ color: ' . get_theme_mod( 'penci_review_rating_ratedFill' ) . ' }';
				}

				if( get_theme_mod( 'penci_review_badge_color' ) ){
					echo '.penci-userreview-badge{ color: ' . get_theme_mod( 'penci_review_badge_color' ) . ' }';
				}

				if( get_theme_mod( 'penci_review_badge_bgcolor' ) ){
					echo '.penci-userreview-badge{ background-color: ' . get_theme_mod( 'penci_review_badge_bgcolor' ) . ' }';
				}
				if( get_theme_mod( 'penci_review_img_width' ) ){
					echo '.penci-review-thumb, .penci-review-thumb img{ width: ' . get_theme_mod( 'penci_review_img_width' ) . 'px; }';
				}
			 ?>
		</style>
		<?php
	}
}

add_action( 'wp_head', 'penci_review_customizer_css' );