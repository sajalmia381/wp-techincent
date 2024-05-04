<?php

/**
 * Class Penci_Transition_Text
 */
class Penci_Transition_Text {

	/**
	 * Penci_Transition_Text constructor.
	 */
	public function __construct() {
		add_shortcode( 'pencilang', array( $this, 'penci_language' ) );
	}

	/**
	 * Shortcode language
	 *
	 * @param $langs
	 *
	 * @return mixed
	 */
	public function penci_language( $langs ) {
		$current_lang = get_locale();
		$current_lang = strtolower( $current_lang );

		$output = '';
		if ( isset( $langs[ $current_lang ] ) ) {
			$output = $langs[ $current_lang ];
		} elseif ( isset( $langs['default'] ) ) {
			$output = $langs['default'];
		}

		return $output;
	}

}

new Penci_Transition_Text;