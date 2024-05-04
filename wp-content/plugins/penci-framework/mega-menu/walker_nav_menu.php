<?php

/**
 * Class penci_menu_walker_nav_menu
 * This class will remove wrap </a> around mega menu
 * Callback on wp_nav_menu() in header.php file
 *
 * @since 1.0
 */
class Penci_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS classes applied to a menu items
		 *
		 * @since 1.0
		 *
		 * @param array $classes The CSS classes that are applied to the menu items
		 * @param object $item Current menu item
		 * @param array $args Array of arguments
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu items
		 *
		 * @since 1.0
		 *
		 * @param string       ID that is applied to the menu items
		 * @param object $item Current menu item.
		 * @param array $args Array of arguments
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';
		$atts['itemprop']   = 'url';

		/**
		 * Filter the HTML attributes applied to a menu items
		 *
		 * @since 1.0
		 *
		 * @param array $atts
		 * @param object $item The current menu item.
		 * @param array $args An array of arguments
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

	
		$item_output = $args->before;

		if ( $item->is_mega_menu == false ) {
			$item_output .= '<a' . $attributes . '>';
		}

		$item_title = apply_filters( 'penci_menu_item_title', $item->title, $item, $depth );

		$item_output .= $args->link_before . apply_filters( 'the_title', $item_title, $item->ID ) . $args->link_after;

		if ( $item->is_mega_menu == false ) {
			$item_output .= '</a>';
		}
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output
		 *
		 * @since 1.0
		 *
		 * @param string $item_output The menu items starting HTML output
		 * @param object $item Menu item data object
		 * @param int $depth Depth of menu item
		 * @param array $args Array of arguments
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}