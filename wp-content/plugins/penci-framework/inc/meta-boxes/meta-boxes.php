<?php
add_filter( 'rwmb_meta_boxes', 'penci_register_meta_boxes' );

/**
 * Add custom meta boxes for courses.
 *
 * @param array $meta_boxes
 *
 * @return array
 */
function penci_register_meta_boxes( $meta_boxes ) {


	$all_sidebar = array( '' => esc_html__( 'Default Sidebar', 'penc-framework' ) );

	if ( class_exists( 'Penci_Custom_Sidebar' ) ) {
		$all_sidebar = array_merge(
			array( '' => esc_html__( 'Default Sidebar( on Customize )', 'penc-framework' ) ),
			Penci_Custom_Sidebar::get_list_sidebar()
		);
	}

	$field_page_default = array(
		array(
			'id'                => 'penci_use_option_current_page',
			'name'              => esc_html__( 'Use the options below for this page:', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'label_description' => '',
			'tab'             => 'defaulttp'
		),
		array(
			'name'    => esc_html__( 'Sidebar position:', 'penci-framework' ),
			'id'      => 'page_sidebar_pos',
			'type'    => 'image_select',
			'options' => array(
				'no-sidebar-wide' => get_template_directory_uri() . '/images/layout/wide-content.png',
				'no-sidebar-1080' => get_template_directory_uri() . '/images/layout/wide-content-1080.png',
				'no-sidebar'      => get_template_directory_uri() . '/images/layout/no-sidebar.png',
				'sidebar-left'    => get_template_directory_uri() . '/images/layout/sidebar-left.png',
				'sidebar-right'   => get_template_directory_uri() . '/images/layout/sidebar-right.png',
				'two-sidebar'     => get_template_directory_uri() . '/images/layout/3cm.png',
			),
			'std'     => 'sidebar-right',
			'tab'             => 'defaulttp'
		),
		array(
			'name'    => esc_html__( 'Custom sidebar left:', 'penci-framework' ),
			'id'      => 'page_sidebar_left',
			'type'    => 'select',
			'options' => $all_sidebar,
			'tab'             => 'defaulttp'
		),
		array(
			'name'    => esc_html__( 'Custom sidebar right:', 'penci-framework' ),
			'id'      => 'page_sidebar_right',
			'type'    => 'select',
			'options' => $all_sidebar,
			'tab'             => 'defaulttp'
		),
		array(
			'name'    => esc_html__( 'Page template layout:', 'penci-framework' ),
			'id'      => 'page_template_layout',
			'type'    => 'image_select',
			'options' => array(
				'style-1' => get_template_directory_uri() . '/images/single/style_1.png',
				'style-2' => get_template_directory_uri() . '/images/single/style_2.png',
				'style-3' => get_template_directory_uri() . '/images/single/style_3.png',
				'style-4' => get_template_directory_uri() . '/images/single/style_4.png',
			),
			'std'     => 'style-1',
			'tab'             => 'defaulttp'
		),

		array(
			'name'     => esc_html__( 'Page Title Align', 'pennews' ),
			'id'       => "penci_page_align_post_title",
			'type'     => 'select',
			'options'  => array(
				'left'   => esc_html__( 'Left', 'pennews' ),
				'center' => esc_html__( 'Center', 'pennews' ),
				'right'  => esc_html__( 'Right', 'pennews' )
			),
			'multiple' => false,
			'std'      => 'left',
			'tab'             => 'defaulttp'
		),
		array(
			'name' => esc_html__( 'Custom Font Size for Page Title ', 'pennews' ),
			'id'   => 'penci_page_size_post_title',
			'type' => 'text',
			'std'  => function_exists( 'penci_page_size_post_title' ) ? penci_default_setting( 'penci_page_size_post_title' ) : '',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'             => 'defaulttp'
		),
		array(
			'name'     => esc_html__( 'Hide Google Adsense Code to Display Before Content Post', 'pennews' ),
			'id'       => "penci_hide_ad_before_content",
			'type'     => 'select',
			'options'  => array(
				''   => esc_html__( 'No', 'pennews' ),
				'yes' => esc_html__( 'Yes', 'pennews' )
			),
			'multiple' => false,
			'std'      => '',
			'tab'      => 'defaulttp'
		),
		array(
			'name'     => esc_html__( 'Google Adsense Code to Display In the End of Content Post', 'pennews' ),
			'id'       => "penci_hide_ad_end_content",
			'type'     => 'select',
			'options'  => array(
				''   => esc_html__( 'No', 'pennews' ),
				'yes' => esc_html__( 'Yes', 'pennews' )
			),
			'multiple' => false,
			'std'      => '',
			'tab'      => 'defaulttp'
		),
	);


	$page_list_check = array(
		'penci_enable_header_tran'            => esc_html__( 'Enable Header Transparent', 'pennews' ),
		'penci_hide_page_title'               => esc_html__( 'Hide Page Title:', 'penci-framework' ),
		'penci_hide_page_breadcrumb'          => esc_html__( 'Hide Breadcrumbs:', 'penci-framework' ),
		'penci_hide_page_socail_share_top'    => esc_html__( 'Hide Social Share Icons on Top:', 'pennews' ),
		'penci_hide_page_socail_share_bottom' => esc_html__( 'Hide Social Share Icons on Bottom:', 'pennews' ),
		'penci_show_page_featured_img'        => esc_html__( 'Make Featured Image Auto Appears on Pages:', 'penci-framework' ),
		'penci_page_caption_above_img'        => esc_html__( 'Show Caption On The Images:', 'penci-framework' ),
		'penci_show_page_comments'            => esc_html__( 'Show Comments:', 'penci-framework' ),
	);

	foreach ( $page_list_check as $id_option => $label_option ) {
		$field_page_default[] = array(
			'id'   => $id_option,
			'name' => $label_option,
			'type' => 'checkbox',
			'tab'  => 'defaulttp'
		);
	}

	// Hide Header and Hide Footer
	$field_header_footer = array(
		array(
			'id'   => 'penci_hide_page_header',
			'name' => esc_html__( 'Hide Header', 'penci-framework' ),
			'type' => 'checkbox',
			'tab'  => 'hideheaderfooter'
		),
		array(
			'id'   => 'penci_hide_page_footer',
			'name' => esc_html__( 'Hide Footer', 'penci-framework' ),
			'type' => 'checkbox',
			'tab'  => 'hideheaderfooter'
		)
	);

	$field_page_title = array(
		array(
			'name'     => esc_html__( 'Enable/Disable Page title', 'pennews' ),
			'id'       => "penci_pheader_show",
			'type'     => 'select',
			'options'  => array(
				''        => esc_html__( 'Default', 'pennews' ),
				'enable'  => esc_html__( 'Enable', 'pennews' ),
				'disable' => esc_html__( 'Disable', 'pennews' )
			),
			'multiple' => false,
			'tab'  => 'pagetitle',
		),
		array(
			'name'     => esc_html__( 'Hide/Show Line Below Title', 'pennews' ),
			'id'       => "penci_pheader_hideline",
			'type'     => 'select',
			'options'  => array(
				''   => esc_html__( 'Default', 'pennews' ),
				'hide' => esc_html__( 'Hide', 'pennews' ),
				'show' => esc_html__( 'Show', 'pennews' ),
			),
			'multiple' => false,
			'tab'  => 'pagetitle',
		),
		array(
			'name'     => esc_html__( 'Hide/Show Breadcrumbs', 'pennews' ),
			'id'       => "penci_pheader_hidebead",
			'type'     => 'select',
			'options'  => array(
				''   => esc_html__( 'Default', 'pennews' ),
				'hide' => esc_html__( 'Hide', 'pennews' ),
				'show' => esc_html__( 'Show', 'pennews' ),
			),
			'multiple' => false,
			'tab'  => 'pagetitle',
		),
		array(
			'name'     => esc_html__( 'Text Align', 'pennews' ),
			'id'       => "penci_pheader_align",
			'type'     => 'select',
			'options'  => array(
				''       => esc_html__( 'Default', 'pennews' ),
				'left'   => esc_html__( 'Left', 'pennews' ),
				'center' => esc_html__( 'Center', 'pennews' ),
				'right'  => esc_html__( 'Right', 'pennews' )
			),
			'multiple' => false,
			'tab'  => 'pagetitle',
		),
		array(
			'name' => esc_html__( 'Padding top', 'pennews' ),
			'id'   => 'penci_pheader_ptop',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'pagetitle',
		),
		array(
			'name' => esc_html__( 'Padding bottom', 'pennews' ),
			'id'   => 'penci_pheader_pbottom',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'pagetitle',
		),
		array(
			'name'     => esc_html__( 'On/Off Uppercase for Title', 'pennews' ),
			'id'       => "penci_pheader_turn_offup",
			'type'     => 'select',
			'options'  => array(
				''   => esc_html__( 'Default', 'pennews' ),
				'on' => esc_html__( 'On', 'pennews' ),
				'off' => esc_html__( 'Off', 'pennews' ),
			),
			'multiple' => false,
			'tab'  => 'pagetitle',
		),
		array(
			'name'     => esc_html__( 'Font Weight For Title', 'pennews' ),
			'id'       => "penci_pheader_fwtitle",
			'type'     => 'select',
			'options'  => array(
				''        => esc_html__( 'Default', 'pennews' ),
				'normal'  => 'Normal',
				'bold'    => 'Bold',
				'bolder'  => 'Bolder',
				'lighter' => 'Lighter',
				'100'     => '100',
				'200'     => '200',
				'300'     => '300',
				'400'     => '400',
				'500'     => '500',
				'600'     => '600',
				'700'     => '700',
				'800'     => '800',
				'900'     => '900'
			),
			'multiple' => false,
			'tab'  => 'pagetitle',
		),
		array(
			'name' => esc_html__( 'Custom Padding Bottom for Title', 'pennews' ),
			'id'   => 'penci_pheader_title_pbottom',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'pagetitle',
		),
		array(
			'name' => esc_html__( 'Custom Margin Bottom for Title', 'pennews' ),
			'id'   => 'penci_pheader_title_mbottom',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'pagetitle',
		),
		array(
			'name' => esc_html__( 'Custom size for Title', 'pennews' ),
			'id'   => 'penci_pheader_title_fsize',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'pagetitle',
		),
		array(
			'name' => esc_html__( 'Custom size for Breadcrumb', 'pennews' ),
			'id'   => 'penci_pheader_bread_fsize',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'pagetitle',
		),
		array(
			'type' => 'heading',
			'name' => 'Colors',
			'tab'  => 'pagetitle',
		),
		array(
			'type'             => 'image_advanced',
			'max_file_uploads' => 1,
			'name' => 'Background Image',
			'id'   => 'penci_pheader_bgimg',
			'tab'  => 'pagetitle',
		),
		array(
			'name'          => 'Background Color',
			'id'            => 'penci_pheader_bgcolor',
			'type'          => 'color',
			'alpha_channel' => true,
			'tab'  => 'pagetitle',
		),
		array(
			'name'          => 'Title Color',
			'id'            => 'penci_pheader_title_color',
			'type'          => 'color',
			'alpha_channel' => true,
			'tab'  => 'pagetitle',
		),
		array(
			'name'          => 'Breadcrumbs Text Color',
			'id'            => 'penci_pheader_bread_color',
			'type'          => 'color',
			'alpha_channel' => true,
			'tab'  => 'pagetitle',
		),
		array(
			'name'          => 'Breadcrumbs Hover Text Color',
			'id'            => 'penci_pheader_bread_hcolor',
			'type'          => 'color',
			'alpha_channel' => true,
			'tab'  => 'pagetitle',
		),

		array(
			'name'     => esc_html__( 'Enable\Disable Subtitle', 'pennews' ),
			'id'       => "penci_post_enable_subtitle",
			'type'     => 'select',
			'options'  => array(
				''        => esc_html__( 'Default', 'pennews' ),
				'enable'  => esc_html__( 'Enable', 'pennews' ),
				'disable' => esc_html__( 'Disable', 'pennews' ),
			),
			'multiple' => false,
			'tab'      => 'pagesubtitle',
		),
		array(
			'name' => esc_html__( 'Subtitle', 'pennews' ),
			'id'   => 'penci_post_subtitle',
			'type' => 'text',
			'size' => 100,
			'desc' => esc_html__( 'Enter subtitle here...', 'pennews' ),
			'tab'  => 'pagesubtitle',
		),
	);

	$field_boxed = array(
		array(
			'id'    => 'boxed_width',
			'name'  => esc_html__( 'Container Width','penci-framework' ),
			'type'  => 'select',
			'options' => array(
				'1400'      => esc_html__( 'Width: 1400px', 'pennews' ),
				'1170'      => esc_html__( 'Width: 1170px', 'pennews' ),
				'1080'      => esc_html__( 'Width: 1080px', 'pennews' ),
				'custom'      => esc_html__( 'Custom width', 'pennews' ),
			),
			'tab'  => 'boxed'
		),
		array(
			'name' => esc_html__( 'Custom Container Width for Layout Boxed Template', 'pennews' ),
			'id'   => 'boxed_custom_width',
			'type' => 'text',
			'size' => 10,
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'boxed',
			'hidden' => array( 'boxed_width', '!=', 'custom' )
		),
		array(
			'type' => 'heading',
			'name' => 'Body Colors',
			'tab'  => 'boxed',
		),
		array(
			'type'             => 'image_advanced',
			'max_file_uploads' => 1,
			'name'             => esc_html__( 'Background Image','pennews' ),
			'id'               => 'boxed_body_bgimg',
			'tab'              => 'boxed',
		),
		array(
			'name'          => esc_html__( 'Background Color','pennews' ),
			'id'            => 'boxed_body_bgcolor',
			'type'          => 'color',
			'alpha_channel' => true,
			'tab'           => 'boxed',
		),
		array(
			'id'      => 'boxed_body_repeat',
			'name'    => esc_html__( 'Background Body Boxed Repeat', 'penci-framework' ),
			'type'    => 'select',
			'options' => array(
				'no-repeat' => esc_html__( 'No repeat', 'pennews' ),
				'repeat'    => esc_html__( 'Repeat', 'pennews' ),
			),
			'tab'     => 'boxed'
		),
		array(
			'id'      => 'boxed_body_attachment',
			'name'    => esc_html__( 'Background Body Boxed Attachment', 'penci-framework' ),
			'type'    => 'select',
			'std'     => 'fixed',
			'options' => array(
				'fixed'  => esc_html__( 'Fixed', 'pennews' ),
				'local'  => esc_html__( 'Local', 'pennews' ),
				'scroll' => esc_html__( 'Scroll', 'pennews' ),
			),
			'tab'     => 'boxed'
		),
		array(
			'id'      => 'boxed_body_size',
			'name'    => esc_html__( 'Background Body Boxed Size', 'penci-framework' ),
			'type'    => 'select',
			'options' => array(
				'cover'   => esc_html__( 'Cover', 'pennews' ),
				'auto'    => esc_html__( 'Auto', 'pennews' ),
				'contain' => esc_html__( 'Contain', 'pennews' ),
			),
			'tab'     => 'boxed'
		),
		array(
			'type' => 'heading',
			'name' => 'Container Boxed Colors',
			'tab'  => 'boxed',
		),
		array(
			'type'             => 'image_advanced',
			'max_file_uploads' => 1,
			'name'             => esc_html__( 'Background Image for Container Boxed','pennews' ),
			'id'               => 'boxed_container_bgimg',
			'tab'              => 'boxed',
		),
		array(
			'name'          => esc_html__( 'Background Container Boxed Color','pennews' ),
			'id'            => 'boxed_container_bgcolor',
			'type'          => 'color',
			'alpha_channel' => true,
			'tab'           => 'boxed',
		),
		array(
			'id'      => 'boxed_container_repeat',
			'name'    => esc_html__( 'Background Container Boxed Repeat', 'penci-framework' ),
			'type'    => 'select',
			'options' => array(
				'repeat'    => esc_html__( 'Repeat', 'pennews' ),
				'no-repeat' => esc_html__( 'No repeat', 'pennews' ),
			),
			'tab'     => 'boxed'
		),
		array(
			'id'      => 'boxed_container_attachment',
			'name'    => esc_html__( 'Background Container Boxed Attachment', 'penci-framework' ),
			'type'    => 'select',
			'std'     => 'fixed',
			'options' => array(
				'fixed' => esc_html__( 'Fixed', 'pennews' ),
				'local' => esc_html__( 'Local', 'pennews' ),
				'scroll'    => esc_html__( 'Scroll', 'pennews' ),
			),
			'tab'     => 'boxed'
		),
		array(
			'id'      => 'boxed_container_size',
			'name'    => esc_html__( 'Background Container Boxed Size', 'penci-framework' ),
			'type'    => 'select',
			'options' => array(
				'cover'   => esc_html__( 'Cover', 'pennews' ),
				'auto'    => esc_html__( 'Auto', 'pennews' ),
				'contain' => esc_html__( 'Contain', 'pennews' ),
			),
			'tab'     => 'boxed'
		),
	);

	$fileds_content_typo = array(
		array(
			'name' => esc_html__( 'Custom size of h1 on content', 'pennews' ),
			'id'   => 'penci_pp_h1_fsize',
			'type' => 'text',
			'size' => '',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'typo',
		),
		array(
			'name' => esc_html__( 'Custom size of h2 on content', 'pennews' ),
			'id'   => 'penci_pp_h2_fsize',
			'type' => 'text',
			'size' => '',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'typo',
		),
		array(
			'name' => esc_html__( 'Custom size of h3 on content', 'pennews' ),
			'id'   => 'penci_pp_h3_fsize',
			'type' => 'text',
			'size' => '',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'typo',
		),
		array(
			'name' => esc_html__( 'Custom size of h4 on content', 'pennews' ),
			'id'   => 'penci_pp_h4_fsize',
			'type' => 'text',
			'size' => '',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'typo',
		),
		array(
			'name' => esc_html__( 'Custom size of h5 on content', 'pennews' ),
			'id'   => 'penci_pp_h5_fsize',
			'type' => 'text',
			'size' => '',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'typo',
		),
		array(
			'name' => esc_html__( 'Custom size of h6 on content', 'pennews' ),
			'id'   => 'penci_pp_h6_fsize',
			'type' => 'text',
			'size' => '',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'typo',
		),




	);

	$sourcevia_fileds = array(
		array(
			'name'     => esc_html__( 'Hide Source', 'pennews' ),
			'id'       => "penci_single_hide_source",
			'type'     => 'select',
			'options'  => array(
				''     => esc_html__( 'Default', 'pennews' ),
				'no' => esc_html__( 'No', 'pennews' ),
				'yes' => esc_html__( 'Yes', 'pennews' ),
			),
			'multiple' => false,
			'tab'      => 'sourcevia',
		),
		array(
			'name' => esc_html__( 'Source name', 'pennews' ),
			'id'   => 'penci_single_source',
			'type' => 'text',
			'size' => 100,
			'tab'  => 'sourcevia',
			'desc' => esc_html__( 'Source name will appear at the end of the post in the "source" spot on single posts', 'pennews' ),
		),
		array(
			'name' => esc_html__( 'Source url', 'pennews' ),
			'id'   => 'penci_single_source_url',
			'type' => 'text',
			'size' => 100,
			'tab'  => 'sourcevia',
			'desc' => esc_html__( 'Enter full url to the source', 'pennews' ),
		),
		array(
			'name'     => esc_html__( 'Hide Via', 'pennews' ),
			'id'       => "penci_single_hide_via",
			'type'     => 'select',
			'options'  => array(
				''     => esc_html__( 'Default', 'pennews' ),
				'no' => esc_html__( 'No', 'pennews' ),
				'yes' => esc_html__( 'Yes', 'pennews' ),
			),
			'multiple' => false,
			'tab'      => 'sourcevia',
		),
		array(
			'name' => esc_html__( 'Via name', 'pennews' ),
			'id'   => 'penci_single_vianame',
			'type' => 'text',
			'size' => 100,
			'tab'  => 'sourcevia',
			'desc' => esc_html__( 'Via name will appear at the end of the article in the "via" spot', 'pennews' ),
		),
		array(
			'name' => esc_html__( 'Via Url', 'pennews' ),
			'id'   => 'penci_single_viaurl',
			'type' => 'text',
			'size' => 100,
			'tab'  => 'sourcevia',
			'desc' => esc_html__( 'Enter full url for via', 'pennews' ),
		),
	);

	$meta_boxes[] = array(
		'post_types' => array( 'page' ),
		'title'     => esc_html__( 'Page Options', 'pennews' ),
		'tabs'      => array(
			'defaulttp'        => esc_html__( 'Page Options for Default Template', 'pennews' ),
			'boxed'            => esc_html__( 'Page Options for Layout Boxed Template', 'pennews' ),
			'hideheaderfooter' => esc_html__( 'Hide Header and Hide Footer', 'pennews' ),
			'pagetitle'        => esc_html__( 'Page Title', 'pennews' ),
			'typo'             => esc_html__( 'Typograhpy', 'pennews' ),
		),
		'fields'    => array_merge( $field_page_default,$field_boxed, $field_header_footer, $field_page_title, $fileds_content_typo ),
	);

	$fileds_single = array(
		array(
			'id'                => 'penci_use_option_current_single',
			'name'              => esc_html__( 'Use the options below for this post:', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'label_description' => '',
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Sidebar position:', 'penci-framework' ),
			'id'      => 'single_sidebar_pos',
			'type'    => 'image_select',
			'options' => array(
				'no-sidebar-wide' => get_template_directory_uri() . '/images/layout/wide-content.png',
				'no-sidebar-1080' => get_template_directory_uri() . '/images/layout/wide-content-1080.png',
				'no-sidebar'      => get_template_directory_uri() . '/images/layout/no-sidebar.png',
				'sidebar-left'    => get_template_directory_uri() . '/images/layout/sidebar-left.png',
				'sidebar-right'   => get_template_directory_uri() . '/images/layout/sidebar-right.png',
				'two-sidebar'     => get_template_directory_uri() . '/images/layout/3cm.png',
			),
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Custom sidebar left:', 'penci-framework' ),
			'id'      => 'single_sidebar_left',
			'type'    => 'select',
			'options' => $all_sidebar,
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Custom sidebar right:', 'penci-framework' ),
			'id'      => 'single_sidebar_right',
			'type'    => 'select',
			'options' => $all_sidebar,
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Post template layout:', 'penci-framework' ),
			'id'      => 'single_template_layout',
			'type'    => 'image_select',
			'options' => array(
				'style-1'  => get_template_directory_uri() . '/images/single/style_1.png',
				'style-2'  => get_template_directory_uri() . '/images/single/style_2.png',
				'style-3'  => get_template_directory_uri() . '/images/single/style_3.png',
				'style-4'  => get_template_directory_uri() . '/images/single/style_4.png',
				'style-5'  => get_template_directory_uri() . '/images/single/style_5.png',
				'style-6'  => get_template_directory_uri() . '/images/single/style_6.png',
				'style-7'  => get_template_directory_uri() . '/images/single/style_7.png',
				'style-8'  => get_template_directory_uri() . '/images/single/style_8.png',
				'style-9'  => get_template_directory_uri() . '/images/single/style_9.png',
				'style-10' => get_template_directory_uri() . '/images/single/style_10.png',
			),
			'tab'     => 'general'
		),
		array(
			'name' => esc_html__( 'AD Code For Post Template Style 10', 'penci-framework' ),
			'id'   => 'pre_ad_code_s10',
			'type' => 'textarea',
			'rows' => 5,
			'cols' => 5,
			'tab'     => 'general'
		),
		array(
			'id'                => 'penci_dis_auto_load_prev',
			'name'              => esc_html__( 'Disable Auto Load Previous Post', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'tab'               => 'general'
		),
		array(
			'id'                => 'penci_hide_featured_img',
			'name'              => esc_html__( 'Hide featured image for this post', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'label_description' => esc_html__( 'This option just apply for styles 1, 2 & 9. And It does not apply for Video & Gallery Format', 'penci-framework' ),
			'tab'               => 'general'
		),
		array(
			'id'                => 'dis_jarallax_fea_img',
			'name'              => esc_html__( 'Disable parallax featured image for this post', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'tab'               => 'general'
		),
		array(
			'id'   => 'penci_pfeatured_image_ratio',
			'name' => esc_html__( 'Custom Aspect Ratio for Featured Image', 'penci-framework' ),
			'type' => 'text',
			'std'  => '',
			'label_description' => __( 'The aspect ratio of an element describes the proportional relationship between its width and its height. E.g: <strong>3:2</strong>. Default is 3:2 . This option not apply when enable parallax images. This feature does not apply for Single Style 1 & 2', 'pennews' ),
			'tab'  => 'general'
		),
	);

	$meta_boxes[] = array(
		'post_types' => array( 'post' ),
		'title'     => esc_html__( 'Single Options', 'pennews' ),
		'tabs'      => array(
			'general'      => esc_html__( 'General options', 'pennews' ),
			'pagetitle'    => esc_html__( 'Post Title', 'pennews' ),
			'pagesubtitle' => esc_html__( 'Post SubTitle', 'pennews' ),
			'typo'         => esc_html__( 'Typograhpy', 'pennews' ),
			'sourcevia'    => esc_html__( 'Source & Via', 'pennews' ),
		),
		'fields'    => array_merge( $fileds_single, $field_page_title, $fileds_content_typo, $sourcevia_fileds ),
	);

	// Taxomony
	$wel_page_title = penci_get_theme_mod( 'admin_wel_page_title' );
	$taxonomy_title = $wel_page_title ? $wel_page_title : 'PenNews';

	$taxonomy_fileds = array(
		array(
			'id'                => 'penci_use_opt_current',
			'name'              => esc_html__( 'Use the option of the current page:', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'label_description' => '',
			'tab'               => 'general'
		),
		array(
			'name'    => esc_html__( 'Sidebar position:', 'penci-framework' ),
			'id'      => 'penci_sidebar_layout',
			'type'    => 'image_select',
			'options' => array(
				'no-sidebar-wide' => get_template_directory_uri() . '/images/layout/wide-content.png',
				'no-sidebar'      => get_template_directory_uri() . '/images/layout/no-sidebar.png',
				'sidebar-left'    => get_template_directory_uri() . '/images/layout/sidebar-left.png',
				'sidebar-right'   => get_template_directory_uri() . '/images/layout/sidebar-right.png',
				'two-sidebar'     => get_template_directory_uri() . '/images/layout/3cm.png',
			),
			'std'     => 'sidebar-right',
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Layout Style:', 'penci-framework' ),
			'id'      => 'penci_layout_style',
			'type'    => 'image_select',
			'options' => array(
				'blog-default'  => get_template_directory_uri() . '/images/layout/thumb-text.png',
				'blog-grid'     => get_template_directory_uri() . '/images/layout/2-columns.png',
				'blog-boxed'    => get_template_directory_uri() . '/images/layout/thumb-text-2.png',
				'blog-standard' => get_template_directory_uri() . '/images/layout/blog-standard.png',
				'blog-classic'  => get_template_directory_uri() . '/images/layout/blog-classic.png',
				'blog-overlay'  => get_template_directory_uri() . '/images/layout/blog-overlay.png',
			),
			'std'     => 'blog-default',
			'tab'     => 'general'
		),
		array(
			'name' => esc_html__( 'Custom Width Container', 'pennews' ),
			'id'   => 'penci__w_container',
			'type' => 'text',
			'desc' => esc_html__( 'Numeric value only, unit is pixel', 'pennews' ),
			'tab'  => 'general',
		),
		array(
			'name'    => esc_html__( 'Custom sidebar left:', 'penci-framework' ),
			'id'      => 'penci_ct_sidebar_left',
			'type'    => 'select',
			'options' => $all_sidebar,
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Custom sidebar right:', 'penci-framework' ),
			'id'      => 'penci_ct_sidebar_right',
			'type'    => 'select',
			'options' => $all_sidebar,
			'tab'     => 'general'
		),
		array(
			'name'    => esc_html__( 'Content Display', 'penci-framework' ),
			'id'      => 'penci_blog_display',
			'type'    => 'select',
			'options' => array(
				''        => esc_html__( 'Default', 'penci-framework' ),
				'excerpt' => esc_html__( 'Post excerpt', 'penci-framework' ),
				'content' => esc_html__( 'Post content', 'penci-framework' ),
				'more'    => esc_html__( 'Post content before more tag', 'penci-framework' ),
			),
			'tab'     => 'general'
		),
		array(
			'name' => esc_html__( 'Post Content Limit (words)', 'pennews' ),
			'id'   => 'penci_content_limit',
			'type' => 'number',
			'min'  => 0,
			'step' => 1,
			'tab'     => 'general',
		),
		array(
			'id'                => 'penci_show_rmorep',
			'name'              => esc_html__( 'Show Read More Button', 'penci-framework' ),
			'type'              => 'checkbox',
			'std'               => '',
			'label_description' => '',
			'tab'               => 'general'
		),
		// Pagination
		array(
			'name'    => esc_html__( 'Pagination Style:', 'penci-framework' ),
			'id'      => 'penci_pag',
			'type'    => 'select',
			'options' => array(
				'default'         => esc_html__( 'Default', 'penci-framework' ),
				'load_more'       => esc_html__( 'Load more button', 'penci-framework' ),
				'infinite_scroll' => esc_html__( 'Infinite scroll', 'penci-framework' ),
			),
			'tab'     => 'pagination'
		),
		array(
			'name'    => esc_html__( 'Navigation Alignment', 'penci-framework' ),
			'id'      => 'penci__pag_pos',
			'type'    => 'select',
			'options' => array(
				'left'   => esc_html__( 'left', 'penci-framework' ),
				'center' => esc_html__( 'Center', 'penci-framework' ),
				'right'  => esc_html__( 'Right', 'penci-framework' ),
			),
			'tab'     => 'pagination'
		),
		array(
			'id'   => 'penci_number_lmore',
			'name' => esc_html__( 'Custom Number Posts for Each Time Load More Posts', 'penci-framework' ),
			'type' => 'number',
			'min'  => 0,
			'step' => 1,
			'tab'  => 'pagination'
		)
	);

	$meta_boxes[] = array(
		'title'      => $taxonomy_title . esc_html__( ' Category Options','penci-framework' ),
		'taxonomies' => array( 'category' ),
		'tabs' => array(
			'general'    => esc_html__( 'General options', 'pennews' ),
			'pagination' => esc_html__( 'Pagination options', 'pennews' ),
			//'extra'      => esc_html__( 'Extra options', 'pennews' ),
		),
		'fields' => $taxonomy_fileds
	);

	$meta_boxes[] = array(
		'title'      => $taxonomy_title . esc_html__( ' Tag Options','penci-framework' ),
		'taxonomies' => array( 'post_tag' ),
		'tabs' => array(
			'general'    => esc_html__( 'General options', 'pennews' ),
			'pagination' => esc_html__( 'Pagination options', 'pennews' ),
			//'extra'      => esc_html__( 'Extra options', 'pennews' ),
		),
		'fields' => $taxonomy_fileds
	);

	return $meta_boxes;
}