<?php
class Penci_Widget_Custom_HTML extends WP_Widget {
	protected $registered = false;
	protected $default_instance = array(
		'title' => '',
		'content' => '',
		'dis_padding'    => '',
		'dis_background' => '',
	);

	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_custom_html',
			'description' => __( 'Arbitrary HTML code.' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array(
			'width' => 400,
			'height' => 350,
		);
		parent::__construct( 'penci_custom_html', __( '.PenNews: Custom HTML' ), $widget_ops, $control_ops );
	}
	public function _register_one( $number = -1 ) {
		parent::_register_one( $number );
		if ( $this->registered ) {
			return;
		}
		$this->registered = true;
		wp_add_inline_script( 'custom-html-widgets', sprintf( 'wp.customHtmlWidgets.idBases.push( %s );', wp_json_encode( $this->id_base ) ) );
		add_action( 'admin_print_scripts-widgets.php', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( 'WP_Widget_Custom_HTML', 'render_control_template_scripts' ) );
		add_action( 'admin_head-widgets.php', array( 'WP_Widget_Custom_HTML', 'add_help_text' ) );
	}

	public function _filter_gallery_shortcode_attrs( $attrs ) {
		if ( ! is_singular() && empty( $attrs['id'] ) && empty( $attrs['include'] ) ) {
			$attrs['id'] = -1;
		}
		return $attrs;
	}

	public function widget( $args, $instance ) {
		global $post;

		$original_post = $post;
		if ( is_singular() ) {
			$post = get_queried_object();
		} else {
			$post = null;
		}

		add_filter( 'shortcode_atts_gallery', array( $this, '_filter_gallery_shortcode_attrs' ) );

		$instance = array_merge( $this->default_instance, $instance );
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$simulated_text_widget_instance = array_merge( $instance, array(
			'text' => isset( $instance['content'] ) ? $instance['content'] : '',
			'filter' => false,
			'visual' => false,
		) );
		unset( $simulated_text_widget_instance['content'] );

		$content = apply_filters( 'widget_text', $instance['content'], $simulated_text_widget_instance, $this );

		$content = apply_filters( 'widget_custom_html_content', $content, $instance, $this );

		// Restore post global.
		$post = $original_post;
		remove_filter( 'shortcode_atts_gallery', array( $this, '_filter_gallery_shortcode_attrs' ) );

		// Inject the Text widget's container class name alongside this widget's class name for theme styling compatibility.
		$args['before_widget'] = preg_replace( '/(?<=\sclass=["\'])/', 'widget_text ', $args['before_widget'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<div class="textwidget custom-html-widget">'; // The textwidget class is for theme styling compatibility.
		echo $content;
		echo '</div>';
		echo $args['after_widget'];

		$dis_padding = isset( $instance['dis_padding'] ) ? (bool) $instance['dis_padding'] : false;
		$dis_background = isset( $instance['dis_background'] ) ? (bool) $instance['dis_background'] : false;


		$widget_id = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
		if( $widget_id && ( $dis_padding || $dis_background )  ){


			echo '<style>';
			echo '#' . $widget_id . '.widget{';
			if( $dis_padding ){
				echo 'padding: 0 !important;';
			}
			if( $dis_background ){
				echo 'background-color: transparent !important;';
			}
			echo '}';
			if( $dis_padding ){
				echo '#' . $widget_id . '.style-title-8:not(.footer-widget) .penci-block__title:before,';
				echo '#' . $widget_id . '.style-title-1:not(.footer-widget) .penci-block__title:before{ right: 0; left: 0; }';
			}

			echo '</style>';
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array_merge( $this->default_instance, $old_instance );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['content'] = $new_instance['content'];
		} else {
			$instance['content'] = wp_kses_post( $new_instance['content'] );
		}

		$instance['dis_background'] = isset( $new_instance['dis_background'] ) ? (bool) $new_instance['dis_background'] : false;
		$instance['dis_padding'] = isset( $new_instance['dis_padding'] ) ? (bool) $new_instance['dis_padding'] : false;
		return $instance;
	}

	public function enqueue_admin_scripts() {
		$settings = wp_enqueue_code_editor( array(
			'type' => 'text/html',
			'codemirror' => array(
				'indentUnit' => 2,
				'tabSize' => 2,
			),
		) );

		wp_enqueue_script( 'custom-html-widgets' );
		if ( empty( $settings ) ) {
			$settings = array(
				'disabled' => true,
			);
		}
		wp_add_inline_script( 'custom-html-widgets', sprintf( 'wp.customHtmlWidgets.init( %s );', wp_json_encode( $settings ) ), 'after' );

		$l10n = array(
			'errorNotice' => array(
				'singular' => _n( 'There is %d error which must be fixed before you can save.', 'There are %d errors which must be fixed before you can save.', 1 ),
				'plural' => _n( 'There is %d error which must be fixed before you can save.', 'There are %d errors which must be fixed before you can save.', 2 ), // @todo This is lacking, as some languages have a dedicated dual form. For proper handling of plurals in JS, see #20491.
			),
		);
		wp_add_inline_script( 'custom-html-widgets', sprintf( 'jQuery.extend( wp.customHtmlWidgets.l10n, %s );', wp_json_encode( $l10n ) ), 'after' );
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->default_instance );

		$dis_padding = isset( $instance['dis_padding'] ) ? (bool) $instance['dis_padding'] : false;
		$dis_background = isset( $instance['dis_background'] ) ? (bool) $instance['dis_background'] : false;

		?>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" class="title sync-input" type="hidden" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		<textarea id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" class="content sync-input" hidden><?php echo esc_textarea( $instance['content'] ); ?></textarea>
		<p><input class="checkbox" type="checkbox"<?php checked( $dis_background ); ?> id="<?php echo $this->get_field_id( 'dis_background' ); ?>" name="<?php echo $this->get_field_name( 'dis_background' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dis_background' ); ?>"><?php _e( 'Disable background?' ); ?></label></p>
		<p><input class="checkbox" type="checkbox"<?php checked( $dis_padding ); ?> id="<?php echo $this->get_field_id( 'dis_padding' ); ?>" name="<?php echo $this->get_field_name( 'dis_padding' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dis_padding' ); ?>"><?php _e( 'Disable padding?' ); ?></label></p>
		<?php
	}

	public static function render_control_template_scripts() {
		?>
		<script type="text/html" id="tmpl-widget-custom-html-control-fields">
			<# var elementIdPrefix = 'el' + String( Math.random() ).replace( /\D/g, '' ) + '_' #>
			<p>
				<label for="{{ elementIdPrefix }}title"><?php esc_html_e( 'Title:' ); ?></label>
				<input id="{{ elementIdPrefix }}title" type="text" class="widefat title">
			</p>

			<p>
				<label for="{{ elementIdPrefix }}content" id="{{ elementIdPrefix }}content-label"><?php esc_html_e( 'Content:' ); ?></label>
				<textarea id="{{ elementIdPrefix }}content" class="widefat code content" rows="16" cols="20"></textarea>
			</p>

			<?php if ( ! current_user_can( 'unfiltered_html' ) ) : ?>
				<?php
				$probably_unsafe_html = array( 'script', 'iframe', 'form', 'input', 'style' );
				$allowed_html = wp_kses_allowed_html( 'post' );
				$disallowed_html = array_diff( $probably_unsafe_html, array_keys( $allowed_html ) );
				?>
				<?php if ( ! empty( $disallowed_html ) ) : ?>
					<# if ( data.codeEditorDisabled ) { #>
						<p>
							<?php _e( 'Some HTML tags are not permitted, including:' ); ?>
							<code><?php echo join( '</code>, <code>', $disallowed_html ); ?></code>
						</p>
					<# } #>
				<?php endif; ?>
			<?php endif; ?>

			<div class="code-editor-error-container"></div>
		</script>
		<?php
	}

	public static function add_help_text() {
		$screen = get_current_screen();

		$content = '<p>';
		$content .= __( 'Use the Custom HTML widget to add arbitrary HTML code to your widget areas.' );
		$content .= '</p>';

		if ( 'false' !== wp_get_current_user()->syntax_highlighting ) {
			$content .= '<p>';
			$content .= sprintf(
				/* translators: 1: link to user profile, 2: additional link attributes, 3: accessibility text */
				__( 'The edit field automatically highlights code syntax. You can disable this in your <a href="%1$s" %2$s>user profile%3$s</a> to work in plain text mode.' ),
				esc_url( get_edit_profile_url() ),
				'class="external-link" target="_blank"',
				sprintf( '<span class="screen-reader-text"> %s</span>',
					/* translators: accessibility text */
					__( '(opens in a new window)' )
				)
			);
			$content .= '</p>';

			$content .= '<p id="editor-keyboard-trap-help-1">' . __( 'When using a keyboard to navigate:' ) . '</p>';
			$content .= '<ul>';
			$content .= '<li id="editor-keyboard-trap-help-2">' . __( 'In the editing area, the Tab key enters a tab character.' ) . '</li>';
			$content .= '<li id="editor-keyboard-trap-help-3">' . __( 'To move away from this area, press the Esc key followed by the Tab key.' ) . '</li>';
			$content .= '<li id="editor-keyboard-trap-help-4">' . __( 'Screen reader users: when in forms mode, you may need to press the Esc key twice.' ) . '</li>';
			$content .= '</ul>';
		}

		$screen->add_help_tab( array(
			'id' => 'custom_html_widget',
			'title' => __( 'Custom HTML Widget' ),
			'content' => $content,
		) );
	}
}
