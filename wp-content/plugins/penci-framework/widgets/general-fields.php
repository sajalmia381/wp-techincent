<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'PenciFW_Widget_General_Fields' ) ):
	class PenciFW_Widget_General_Fields {
		function __construct() {
			if ( is_admin() ) {
				add_action( 'in_widget_form', array( $this, 'in_widget_form' ), 5, 3 );
				add_filter( 'widget_update_callback', array( $this, 'widget_update' ), 100, 2 );
			} else {
				add_filter( 'dynamic_sidebar_params', array( $this, 'dynamic_sidebar_params' ), 100, 2 );
			}


		}

		public function dynamic_sidebar_params( $params ) {
			global $wp_registered_widgets;

			$widget_id = isset( $params[0]['widget_id'] ) ? $params[0]['widget_id'] : '';

			if ( isset( $wp_registered_widgets[ $widget_id ]['callback'][0] ) && is_object( $wp_registered_widgets[ $widget_id ]['callback'][0] ) ) {
				$settings    = $wp_registered_widgets[ $widget_id ]['callback'][0]->get_settings();
				$setting_key = substr( $widget_id, strrpos( $widget_id, '-' ) + 1 );
				$instance    = isset( $settings[ $setting_key ] ) ? $settings[ $setting_key ] : array();

				$css_custom = $this->widget_custom_css( $instance, $widget_id );
				if ( $css_custom ) {
					$params[0]['after_widget'] .= '<style>' . $css_custom . '</style>';
				}
			}

			return $params;
		}

		public function widget_custom_css( $instance, $widget_id ) {

			$atts = wp_parse_args( $instance, array(
				'title_color'            => '',
				'title_hover_color'      => '',
				'background_title_color' => '',
				'bordertop_color'        => '',
				'borderbt_color'         => '',
				'borderleft_color'       => '',
				'borderright_color'      => '',
				'title_line_color'       => '',
				'penci_widget_id'        => '',
				'background_w_color'     => '',
			) );

			extract( $atts );

			$css = '';
			$id  = ! $widget_id ? '.' . $atts['penci_widget_id'] : '#' . $widget_id;


			if ( $atts['title_color'] ) {
				$title_temp = '%s .penci-block__title a, %s .penci-block__title span{ color:%s !important; } %s .penci-block-heading:after{ background-color:%s !important; }';
				$css        .= sprintf( $title_temp, $id, $id, $atts['title_color'], $id, $atts['title_color'] );
			}
			if ( $atts['title_hover_color'] ) {
				$css .= sprintf( '%s .penci-block__title a:hover{ color:%s !important; }', $id, $atts['title_hover_color'] );
			}

			if ( $atts['background_title_color'] ) {
				$css .= $id . '.style-title-13 .penci-block-heading,';
				$css .= $id . '.style-title-9 .penci-block-heading,';
				$css .= $id . '.style-title-4 .penci-block__title a,';
				$css .= $id . '.style-title-4 .penci-block__title span,';
				$css .= $id . '.style-title-2 .penci-block__title a,';
				$css .= $id . '.style-title-2 .penci-block__title span{';
				$css .= 'background-color:' . esc_attr( $atts['background_title_color'] ) . ' !important;';
				$css .= '}';

				$css .= $id . '.style-title-13 .penci-block__title:after{ border-color: ' . esc_attr( $atts['background_title_color'] ) . ' transparent transparent transparent  !important; }';
			}

			if ( $atts['bordertop_color'] ) {
				$css .= $id . '.style-title-10 .penci-block-heading,';
				$css .= $id . '.style-title-11:not(.footer-widget) .penci-block__title:before,';
				$css .= $id . '.style-title-8:not(.footer-widget) .penci-block__title:before,';
				$css .= $id . '.style-title-1:not(.footer-widget) .penci-block__title:before{';
				$css .= 'border-top-color: ' . esc_attr( $atts['bordertop_color'] ) . ' !important;';
				$css .= '}';
			}

			if ( $atts['borderbt_color'] ) {
				$css .= $id . '.style-title-12 .penci-block-heading,';
				$css .= $id . '.style-title-10 .penci-block-heading,';
				$css .= $id . '.style-title-4 .penci-block-heading,';
				$css .= $id . '.style-title-1 .penci-block-heading,';
				$css .= $id . '.style-title-3 .penci-block-heading{';
				$css .= 'border-bottom-color:' . esc_attr( $atts['borderbt_color'] ) . ';';
				$css .= '}';

				$css .= $id . '.style-title-5 .penci-block-heading:after{';
				$css .= 'background-color:' . esc_attr( $atts['borderbt_color'] ) . ' !important;';
				$css .= '}';
			}

			if ( $atts['borderleft_color'] ) {
				$css .= $id . '.style-title-10.penci-block-heading:after,';
				$css .= $id . '.style-title-10 .penci-block-heading,';
				$css .= $id . '.style-title-9 .penci-block-heading{';
				$css .= 'border-left-color:' . esc_attr( $atts['borderleft_color'] ) . ';';
				$css .= '}';
			}

			if ( $atts['borderright_color'] ) {
				$css .= $id . '.style-title-10.penci-block-heading:after,';
				$css .= $id . '.style-title-10 .penci-block-heading,';
				$css .= $id . '.style-title-9 .penci-block-heading{';
				$css .= 'border-right-color:' . esc_attr( $atts['borderright_color'] ) . ';';
				$css .= '}';
			}

			if ( $atts['title_line_color'] ) {

				$css .= $id . '.style-title-6 .penci-block__title a:before,';
				$css .= $id . '.style-title-6 .penci-block__title a:after,';
				$css .= $id . '.style-title-6 .penci-block__title span:before,';
				$css .= $id . '.style-title-6 .penci-block__title span:after {';
				$css .= 'border-top-color: ' . esc_attr( $atts['title_line_color'] ) . ' !important;';
				$css .= '}';

				$css .= $id . '.style-title-11 .penci-block__title:after{';
				$css .= 'background-color: ' . esc_attr( $atts['title_line_color'] ) . ' !important;';
				$css .= '}';
			}

			if ( $atts['background_w_color'] ) {
				$css .= $id . '.penci-widget-sidebar{';
				$css .= 'background-color:' . esc_attr( $atts['background_w_color'] ) . ';';
				$css .= '}';
			}

			return $css;
		}

		public function in_widget_form( $__this, $return, $instance ) {

			$id_base = isset( $__this->id_base ) ? $__this->id_base : '';

			$instance = wp_parse_args( (array) $instance, array(
				'title_color'            => '',
				'title_hover_color'      => '',
				'background_title_color' => '',
				'bordertop_color'        => '',
				'borderbt_color'         => '',
				'borderleft_color'       => '',
				'borderright_color'      => '',
				'title_line_color'       => '',
				'background_w_color'     => '',
			) );


			$list_options = array(
				'title_color'            => __( 'Title text color', 'pennews' ),
				'title_hover_color'      => __( 'Title text hover color', 'pennews' ),
				'background_title_color' => __( 'Background text block color for style 2,4,9,13', 'pennews' ),
				'bordertop_color'        => __( 'Border top color for style 1,8,10', 'pennews' ),
				'borderbt_color'         => __( 'Border bottom color for style 1,3,4,10,12', 'pennews' ),
				'borderleft_color'       => __( 'Border left color for style 9,10', 'pennews' ),
				'borderright_color'      => __( 'Border right color for style 9,10', 'pennews' ),
				'title_line_color'       => __( 'Custom Line Color For Style 6,11', 'pennews' ),
			);
			?>
			<div class="penci-metabox-wrap">
				<div class="penci-metabox-fields">
					<div class="penci-accordion-name">
						<h3><?php esc_html_e( 'Widget General Color Options', 'PENCI_SNORLAX_FW' ); ?></h3><span class="handle-repeater"></span>
					</div>
					<div class="penci-panel-accordion" style="min-height: 0px;">
						<p class="penci-field-item">
							<label style="font-weight: normal;"><?php esc_html_e( 'Widget background color', 'pennews' ); ?></label>
							<span class="penci-picker-container">
							<input id="<?php echo esc_attr( $__this->get_field_id( 'background_w_color' ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $__this->get_field_name( 'background_w_color' ) ); ?>" value="<?php echo $instance['background_w_color']; ?>" / >
							</span>
						</p>
						<p class="penci-field-item penci-param-heading-wrapper no-top-margin vc_column vc_col-sm-12">
							<label>Title widget</label>
						</p>
						<?php foreach ( $list_options as $option_id => $option_label ): ?>
							<p class="penci-field-item">
								<label for="widget-penci-widget-block7-2-ptitle_color" style="font-weight: normal;"><?php echo ( $option_label ); ?></label>
								<span class="penci-picker-container">
							<input id="<?php echo esc_attr( $__this->get_field_id( $option_id ) ); ?>" class="widefat penci-color-picker" type="text" name="<?php echo esc_attr( $__this->get_field_name( $option_id ) ); ?>" value="<?php echo $instance[ $option_id ]; ?>" / >
							</span>
							</p>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php
		}

		public function widget_update( $instance, $new_instance ) {
			$list_options = array(
				'title_color'            => '',
				'title_hover_color'      => '',
				'background_title_color' => '',
				'bordertop_color'        => '',
				'borderbt_color'         => '',
				'borderleft_color'       => '',
				'borderright_color'      => '',
				'title_line_color'       => '',
				'background_w_color'     => '',
			);

			foreach ( $list_options as $param_name => $param_value ) {
				$instance[ $param_name ] = isset( $new_instance[ $param_name ] ) ? $new_instance[ $param_name ] : '';
			}

			return $instance;
		}
	}

	new PenciFW_Widget_General_Fields;
endif;