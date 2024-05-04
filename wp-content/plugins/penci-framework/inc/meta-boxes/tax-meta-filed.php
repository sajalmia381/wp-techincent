<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Penci_Taxonomy_Meta_Field' ) ){
	class Penci_Taxonomy_Meta_Field{

		public $taxonomies = array( 'category', 'tag' );

		function __construct(){

			$taxonomies = $this->taxonomies;
			foreach ( $taxonomies as $taxonomy ) {
				add_action( "{$taxonomy}_add_form_fields", array( $this, '_add_fields' ), 10, 2 );
				add_action("{$taxonomy}_edit_form", array( $this, '_add_fields' ), 10, 2 );

				add_action( "create_{$taxonomy}", array( $this, '_save_fields' ) );
				add_action( "edited_{$taxonomy}", array( $this, '_save_fields' ) );
			}
		}

		public function _add_fields( $tag, $taxonomy  ){

			$sidebar_layout = array(
				'no-sidebar-wide' => get_template_directory_uri() . '/images/layout/wide-content.png',
				'no-sidebar'      => get_template_directory_uri() . '/images/layout/no-sidebar.png',
				'sidebar-left'    => get_template_directory_uri() . '/images/layout/sidebar-left.png',
				'sidebar-right'   => get_template_directory_uri() . '/images/layout/sidebar-right.png',
				'two-sidebar'     => get_template_directory_uri() . '/images/layout/3cm.png',
			);

			$style_layout = function_exists( 'penci_get_option_blog_layout' ) ? penci_get_option_blog_layout() : array();
			?>
			<div id="poststuff">
			<div id="postimagediv" class="postbox">
				<h2 class="hndle ui-sortable-handle"><span><?php $this->get_name_tax( $taxonomy );  ?></span></h2>
				<div class="inside">
					<div class="penci-tax-meta-fields">
						<div class="penci-tab-widget nav-tab-wrapper">
							<a class="nav-tab nav-tab-active" href="#general"><?php esc_html_e( 'General options','penci-framework' ); ?></a>
							<a class="nav-tab" href="#header"><?php esc_html_e( 'Header options','penci-framework' ); ?></a>
							<a class="nav-tab" href="#pagination"><?php esc_html_e( 'Pagination options','penci-framework' ); ?></a>
						</div>
						<div class="penci-tab-content-widget">
							<div id="general" class="tab-content" style="display: block">
								<p class="penci-field-item ">
									<input class="penci-checkbox" name="_use_op_current" type="checkbox" value="1">
									<label><?php esc_html_e( 'Use the option of the current ' . $taxonomy,'penci-framework' ) ?></label>
								</p>
								<p class="penci-field-item">
									<span><label class="penci-input-label"><?php esc_html_e( 'Sidebar position:','penci-framework' ) ?></label></span>
									<span class="penci-input penci_layout_style">
										<?php foreach ( $sidebar_layout as $sidebar_layout_id => $sidebar_layout_img ):?>
											<label class="penci-image-select">
											<img src="<?php echo $sidebar_layout_img; ?>">
											<input type="radio" class="rwmb-image_select hidden" name="_sidebar_layout" value="<?php $sidebar_layout_id; ?>">
										</label>
										<?php endforeach; ?>
									</span>
									<span class="penci-widget-desc"><?php esc_html_e( 'Select layout display view, this how your layout style will be display. By default, sidebar position will follow customizer','penci-framework' ) ?></span>
								</p>
								<p class="penci-field-item">
									<span><label class="penci-input-label"><?php esc_html_e( 'Layout Style:','penci-framework' ) ?></label></span>
									<span class="penci-input">
										<?php foreach ( $style_layout as $style_layout_id => $style_layout_img ):?>
											<label class="penci-image-select">
											<img src="<?php printf( $style_layout_img['url'],get_template_directory_uri()  ); ?>">
											<input type="radio" class="rwmb-image_select hidden" name="_layout_style" value="<?php $style_layout_id; ?>">
										</label>
										<?php endforeach; ?>
									</span>
									<span class="penci-widget-desc"><?php esc_html_e( 'Select post display view, this how your post layout will be display.','penci-framework' ) ?></span>
								</p>
							</div>
							<div id="header"  class="tab-content" style="display: none;">
								<p class="penci-field-item">
									<label for="" class="penci-input-label">Title url:</label>
									<input  class="widefat" type="text" name="" value="">
									<span class="penci-widget-desc">A custom url when the block title is clicked</span>
								</p>
							</div>
							<div id="pagination"  class="tab-content" style="display: none;">
								<p class="penci-field-item">
									<label for="" class="penci-input-label">Title url:</label>
									<input  class="widefat" type="text" name="" value="">
									<span class="penci-widget-desc">A custom url when the block title is clicked</span>
								</p>
								<p class="penci-field-item">
									<label for="" class="penci-input-label">Title url:</label>
									<input  class="widefat" type="text" name="" value="">
									<span class="penci-widget-desc">A custom url when the block title is clicked</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<script>
				jQuery( 'body' ).on( 'click', '.penci-tab-widget a', function ( e ) {
					var $this = jQuery( this ),
						tab = $this.attr( 'href' ),
						$widgetContent = $( this ).closest( '.penci-tax-meta-fields' ),
						$tabContent = $widgetContent.find( '.tab-content' );

					jQuery( '.penci-tab-widget a' ).removeClass( 'nav-tab-active' );
					jQuery( this ).addClass( 'nav-tab-active' );

					$tabContent.not( tab ).css( 'display', 'none' );
					$widgetContent.find( tab ).fadeIn();

					return false;
				} );
			</script>
			<?php
		}

		public function _save_fields( $term_id ) {

		}

		public function get_name_tax( $taxonomy ){
			$output = '';

			$wel_page_title = penci_get_theme_mod( 'admin_wel_page_title' );
			$output = $wel_page_title ? $wel_page_title : 'PenNews';

			if( 'category' == $taxonomy ) {
				$output .= esc_html__( ' Category Options' );
			}elseif( 'tag' == $taxonomy ) {
				$output .= esc_html__( ' Tag Options' );
			}
			echo $output;
		}
	}
}

