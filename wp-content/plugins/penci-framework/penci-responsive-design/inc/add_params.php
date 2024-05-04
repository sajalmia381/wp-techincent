<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if( ! class_exists( 'Penci_Responsive_VC_Add_Params' ) ) {
	class Penci_Responsive_VC_Add_Params{
		function __construct() {

			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				return;
			}
			add_action( 'init', array( $this, 'init' ) );

			WpbakeryShortcodeParams::addField('penci_css_editor_tabs' , array( $this, 'penci_css_editor_form_field'), PENCI_RESPONSIVE_URL . 'js/tab-design.js');
		}

		public function penci_css_editor_form_field( $settings, $value ) {
			$output = '';
			$devices = $settings['tabs'];
			if ( $devices ) {
				$output .= '<div class="penci-css-editor-tabs nav-tab-wrapper">';
				$i      = 0;
				foreach ( (array) $devices as $device_id => $device_name ) {
					$output .= sprintf( '<a class="penci-css-editor-tab nav-tab%s" href="#" data-tabtarget="%s">%s</a>',
						$i < 1 ? ' nav-tab-active' : '',
						$device_id,
						$device_name
					);

					$i ++;
				}
				$output .= '</div>';
			}

			$output .= sprintf(
				'<input type="hidden" class="wpb_vc_param_value" name="%s" value="%s">',
				esc_attr( $settings['param_name'] ),
				esc_attr( $value )
			);

			return $output;
		}

		public function init() {
			$shortcodes = Penci_Responsive_Design_Helper::get_shortcodes();

			if ( ! $shortcodes ) {
				return;
			}

			$group_name = 'Responsive';



			$params = array(
				array(
					'type'             => 'penci_css_editor_tabs',
					'param_name'       => 'penci_css_tabs',
					'tabs'             => array(
						'penci_css'    => esc_html__( 'Desktop', PENCI_RESPONSIVE_DESIGN ),
						'penci_md_css' => esc_html__( 'Tablet', PENCI_RESPONSIVE_DESIGN ),
						'penci_sm_css' => esc_html__( 'Tablet Small', PENCI_RESPONSIVE_DESIGN ),
						'penci_xs_css' => esc_html__( 'Mobile', PENCI_RESPONSIVE_DESIGN ),
					),
					'group'            => $group_name,
					'edit_field_class' => 'penci_css_editor_tabs no-top-margin vc_column vc_col-sm-12',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_css active',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_md_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_md_css',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_sm_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_sm_css',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_xs_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_xs_css',
				)
			);

			$params_fancy = array(
				array(
					'type'             => 'penci_css_editor_tabs',
					'param_name'       => 'penci_css_tabs',
					'tabs'             => array(
						'penci_css'    => esc_html__( 'Desktop', PENCI_RESPONSIVE_DESIGN ),
						'penci_md_css' => esc_html__( 'Tablet', PENCI_RESPONSIVE_DESIGN ),
						'penci_sm_css' => esc_html__( 'Tablet Small', PENCI_RESPONSIVE_DESIGN ),
						'penci_xs_css' => esc_html__( 'Mobile', PENCI_RESPONSIVE_DESIGN ),
					),
					'group'            => $group_name,
					'edit_field_class' => 'penci_css_editor_tabs no-top-margin vc_column vc_col-sm-12',
				),
				array(
					'type'             => 'penci_number',
					'param_name'       => 'title_dektop_fsize',
					'heading'          => __( 'Custom font size for title', 'penci-framework' ),
					'value'            => '',
					'std'              => '',
					'suffix'           => 'px',
					'min'              => 1,
					'group'            => 'Responsive',
					'edit_field_class' => 'penci-css-editor-device penci_css penci_fancy_heading_fsize active',
				),
				array(
					'type'             => 'penci_number',
					'param_name'       => 'title_md_fsize',
					'heading'          => __( 'Custom font size for title', 'penci-framework' ),
					'value'            => '',
					'std'              => '',
					'suffix'           => 'px',
					'min'              => 1,
					'group'            => 'Responsive',
					'edit_field_class' => 'penci-css-editor-device penci_md_css penci_fancy_heading_fsize',
				),
				array(
					'type'             => 'penci_number',
					'param_name'       => 'title_sm_fsize',
					'heading'          => __( 'Custom font size for title', 'penci-framework' ),
					'value'            => '',
					'std'              => '',
					'suffix'           => 'px',
					'min'              => 1,
					'group'            => 'Responsive',
					'edit_field_class' => 'penci-css-editor-device penci_sm_css penci_fancy_heading_fsize',
				),
				array(
					'type'             => 'penci_number',
					'param_name'       => 'title_xs_fsize',
					'heading'          => __( 'Custom font size for title', 'penci-framework' ),
					'value'            => '',
					'std'              => '',
					'suffix'           => 'px',
					'min'              => 1,
					'group'            => 'Responsive',
					'edit_field_class' => 'penci-css-editor-device penci_xs_css penci_fancy_heading_fsize',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_css active',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_md_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_md_css',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_sm_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_sm_css',
				),
				array(
					'type'             => 'css_editor',
					'heading'          => '',
					'param_name'       => 'penci_xs_css',
					'group'            => $group_name,
					'edit_field_class' => 'penci-css-editor-device penci_xs_css',
				)
			);

			foreach ( $shortcodes as $key => $shortcode ) {
				if( 'penci_fancy_heading' == $shortcode ){
					continue;
				}
				vc_add_params( $shortcode, $params );
			}

			vc_add_params( 'penci_fancy_heading', $params_fancy );
		}
	}
}