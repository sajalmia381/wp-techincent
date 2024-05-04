<?php
if( ! class_exists( 'Walker_Nav_Menu_Edit' ) ) {
	return;
}
class Penci_Nav_Menu_Edit_Walker extends Walker_Nav_Menu_Edit {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$menu_return  = '';
		$menu_control = '';
		$style = "font-family: 'Open Sans', sans-serif;";

		// Menu setting
		$penci_megamenu_enabled = get_post_meta( $item->ID, 'penci_megamenu_enabled', true );
		$penci_number_mega_menu = get_post_meta( $item->ID, 'penci_number_mega_menu', true );
		$penci_width_mega_menu  = get_post_meta( $item->ID, 'penci_width_mega_menu', true );
		$dis_ajax_filter        = get_post_meta( $item->ID, 'penci_megamenu_dis_ajax_filter', true );

		$menu_control .= '<p class="description description-wide">';
		$menu_control .= '<label>';
		$menu_control .= '<input type="checkbox" class="megamenu_enabled" name="penci_megamenu_enabled[' . $item->ID . ']"' . checked( $penci_megamenu_enabled, 'on', false ) . ' />';
		$menu_control .= esc_html__( 'Enable category mega menu (make sure category has posts & menu item you selected need is level 1)', 'penci-framework' );
		$menu_control .= '</label>';
		$menu_control .= '</p>';
		$menu_control .= '<p class="description description-wide">';
		$menu_control .= '<label>';
		$menu_control .= esc_html__( 'Select rows when display posts in this category mega menu', 'penci-framework' );
		$menu_control .= '</label>';

		$menu_control .= '<select style="' . $style . '" name="penci_number_mega_menu[' . $item->ID . ']" id="" class="widefat code edit-menu-item-url">';
		$menu_control .= '<option value="1"' . selected( $penci_number_mega_menu, '1', false ) . '>' . esc_html__( '1 row', 'penci-framework' ) . '</option>';
		$menu_control .= '<option value="2"' . selected( $penci_number_mega_menu, '2', false ) . '>' . esc_html__( '2 rows', 'penci-framework' ) . '</option>';
		$menu_control .= ' </select>';
		$menu_control .= '</p>';

		$menu_control .= '<p class="description description-wide">';
		$menu_control .= '<label>';
		$menu_control .= esc_html__( 'Select width when display posts in this category mega menu', 'penci-framework' );
		$menu_control .= '</label>';

		$menu_control .= '<select style="' . $style . '" name="penci_width_mega_menu[' . $item->ID . ']" id="" class="widefat code edit-menu-item-url">';
		$menu_control .= '<option value="width1080"' . selected( $penci_width_mega_menu, 'width1080', false ) . '>' . esc_html__( 'Container ( width: 1080px )', 'penci-framework' ) . '</option>';
		$menu_control .= '<option value="width1170"' . selected( $penci_width_mega_menu, 'width1170', false ) . '>' . esc_html__( 'Container ( width: 1170px )', 'penci-framework' ) . '</option>';
		$menu_control .= '<option value="container"' . selected( $penci_width_mega_menu, 'container', false ) . '>' . esc_html__( 'Container ( width: 1400px )', 'penci-framework' ) . '</option>';
		$menu_control .= '<option value="fullwidth"' . selected( $penci_width_mega_menu, 'fullwidth', false ) . '>' . esc_html__( 'Full width', 'penci-framework' ) . '</option>';
		$menu_control .= ' </select>';
		$menu_control .= '</p>';
		$menu_control .= '<p class="description description-wide">';
		$menu_control .= '<label>';
		$menu_control .= '<input type="checkbox" class="megamenu_enabled" name="penci_megamenu_dis_ajax_filter[' . $item->ID . ']"' . checked( $dis_ajax_filter, 'on', false ) . ' />';
		$menu_control .= esc_html__( 'Disable button next/prev posts', 'penci-framework' );
		$menu_control .= '</label>';
		$menu_control .= '</p>';


		parent::start_el( $menu_return, $item, $depth, $args, $id );

		$menu_return = preg_replace( '/(?=<div.*submitbox)/', $menu_control, $menu_return );

		$output .= $menu_return;
	}
}