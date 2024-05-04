<?php
/**
 * Class Penci_FrameWork_Main_Menu
 * Hook to create options mega menu on Appearance > Menu
 * Render content mega menu if mega menu is selected
 * We hook only for categories
 *
 * @since     1.0
 * @construct hook
 *            - action wp_update_nav_menu_item
 *            - filter wp_edit_nav_menu_walker
 *            - filter wp_nav_menu_objects
 */

if( ! class_exists( 'Penci_FrameWork_Main_Menu' ) ):
class Penci_FrameWork_Main_Menu {

	function __construct() {
		if ( is_admin() ) {
			add_action( 'wp_update_nav_menu_item', array( $this, 'penci_wp_update_nav_menu_item' ), 10, 3 );
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'penci_wp_edit_nav_menu_walker' ) );
		}else{
			add_filter( 'wp_nav_menu_objects', array( $this, 'hook_wp_nav_menu_objects' ), 10, 2 );
		}
	}

	function penci_wp_edit_nav_menu_walker() {
		require_once dirname( __FILE__ ) . '/menu-callback.php';

		return 'Penci_Nav_Menu_Edit_Walker';
	}

	function penci_wp_update_nav_menu_item( $menu_id, $menu_item_id, $args ) {

		update_post_meta( $menu_item_id, 'penci_megamenu_enabled', ( isset( $_POST['penci_megamenu_enabled'][ $menu_item_id ] ) ? 'on' : 'off' ) );
		update_post_meta( $menu_item_id, 'penci_megamenu_dis_ajax_filter', ( isset( $_POST['penci_megamenu_dis_ajax_filter'][ $menu_item_id ] ) ? 'on' : 'off' ) );

		if ( isset( $_POST['penci_number_mega_menu'][ $menu_item_id ] ) ) {
			update_post_meta( $menu_item_id, 'penci_number_mega_menu', $_POST['penci_number_mega_menu'][ $menu_item_id ] );
		}

		if ( isset( $_POST['penci_width_mega_menu'][ $menu_item_id ] ) ) {
			update_post_meta( $menu_item_id, 'penci_width_mega_menu', $_POST['penci_width_mega_menu'][ $menu_item_id ] );
		}

	}

	function get_data( $items ){
		$menu_items_on_mega = $menu_items_on_mega2 = array();
		foreach ( (array) $items as $menu_item ) {
			$penci_megamenu_enabled = get_post_meta( $menu_item->ID, 'penci_megamenu_enabled', true );
			if( ! $menu_item->menu_item_parent && 'on' == $penci_megamenu_enabled ){
				$menu_items_on_mega[ $menu_item->ID ] = true;
			}
		}

		foreach ( (array) $items as $menu_item ) {

			$penci_megamenu_enabled_3 = get_post_meta( $menu_item->ID, 'penci_megamenu_enabled', true );

			$sub_cat = 0;
			if( in_array( $menu_item->menu_item_parent, $menu_items_on_mega )  ) {
				if ( in_array( $menu_item->object,  penci_mega_get_tax_support() ) ) {
					$menu_items_on_mega2[ $menu_item->menu_item_parent ][] = array(
						'id'        => $menu_item->ID,
						'title'     => isset( $menu_item->title ) ? $menu_item->title : '',
						'object'    => isset( $menu_item->object ) ? $menu_item->object : '',
						'object_id' => isset( $menu_item->object_id ) ? $menu_item->object_id : ''
					);
				}
				$menu_items_on_mega2[ $menu_item->menu_item_parent ]['sub_cat'] = 1;


			} elseif( ! $menu_item->menu_item_parent && 'on' == $penci_megamenu_enabled_3 && ! in_array( 'menu-item-has-children', $menu_item->classes ) ) {
				if ( in_array( $menu_item->object,  penci_mega_get_tax_support() ) ) {
					$menu_items_on_mega2[ $menu_item->ID ][] = array(
						'id'        => $menu_item->ID,
						'title'     => isset( $menu_item->title ) ? $menu_item->title : '',
						'object'    => isset( $menu_item->object ) ? $menu_item->object : '',
						'object_id' => isset( $menu_item->object_id ) ? $menu_item->object_id : ''
					);

					$menu_items_on_mega2[ $menu_item->ID ]['sub_cat'] = 0;
				}
			}
		}

		 return $menu_items_on_mega2;
	}

	function hook_wp_nav_menu_objects( $items, $args = '' ) {

		$menu_id = isset( $args->menu_id ) ? $args->menu_id : '';
		if( 'primary-menu-mobile' ==  $menu_id ) {
			return $items;
		}

		$menu_items  = array();

		$menu_items_on_mega = array();
		foreach ( (array) $items as $menu_item ) {
			$penci_megamenu_enabled = get_post_meta( $menu_item->ID, 'penci_megamenu_enabled', true );
			if( ! $menu_item->menu_item_parent && 'on' == $penci_megamenu_enabled ){
				$menu_items_on_mega[ $menu_item->ID ] = true;
			}
		}

		$item_childs = $this->get_data( $items );

		foreach ( $items as &$item ) {
			$item->is_mega_menu = false;
			if( ! isset( $args->theme_location ) ||
			    ( isset( $args->theme_location ) && 'menu-1' != $args->theme_location  ) ||
			    ( isset( $args->menu_id ) && 'primary-menu-mobile' == $args->menu_id  )
			) {
				$menu_items[] = $item;
				continue;
			}

			$max_megamenu      = get_post_meta( $item->menu_item_parent, '_megamenu', true );
			$max_megamenu_type = isset( $max_megamenu['type'] ) ? $max_megamenu['type'] : '';

			$penci_megamenu_enabled = get_post_meta( $item->menu_item_parent, 'penci_megamenu_enabled', true );
			if ( 'on' == $penci_megamenu_enabled && $item->menu_item_parent && 'megamenu' != $max_megamenu_type ) {
				continue;
			}

			// if menu is mega menu, render mega menu
			$penci_megamenu_enabled = get_post_meta( $item->ID, 'penci_megamenu_enabled', true );
			if ( 'on' != $penci_megamenu_enabled ) {
				$menu_items[] = $item;
				continue;
			}

			$penci_number_mega_menu = get_post_meta( $item->ID, 'penci_number_mega_menu', true );
			$penci_width_megamenu   = get_post_meta( $item->ID, 'penci_width_mega_menu', true );
			$dis_ajax_filter        = get_post_meta( $item->ID, 'penci_megamenu_dis_ajax_filter', true );

			if ( ! isset( $penci_number_mega_menu ) || empty ( $penci_number_mega_menu ) ): $penci_number_mega_menu = '1'; endif;

			if ( isset( $item_childs[ $item->ID ] ) ) {

				$arr_has_mega    =  penci_mega_get_tax_support();

				$has_mega = false;
				foreach ( $item_childs[ $item->ID ] as $list_cat ) {
					$tax   = isset( $list_cat['object'] ) ? $list_cat['object'] : '';

					if ( in_array( $tax, $arr_has_mega ) ) {
						$has_mega = true;
					}
				}

				if( empty( $has_mega ) ) {
					$menu_items[] = $item;

					continue;
				}

				$item->classes[] = 'penci-mega-menu ' . ( $penci_width_megamenu ? 'penci-megamenu-' . $penci_width_megamenu : 'penci-megamenu-container' );

				// add the parent menu
				$menu_items[] = $item;

				// create mega menu item
				$post                 = new stdClass;
				$post->ID             = 0;
				$post->post_author    = '';
				$post->post_date      = '';
				$post->post_date_gmt  = '';
				$post->post_password  = '';
				$post->post_type      = 'menu_penci';
				$post->post_status    = 'draft';
				$post->to_ping        = '';
				$post->pinged         = '';
				$post->comment_status = get_option( 'default_comment_status' );
				$post->ping_status    = get_option( 'default_ping_status' );
				$post->post_pingback  = get_option( 'default_pingback_flag' );
				$post->post_category  = get_option( 'default_category' );
				$post->page_template  = 'default';
				$post->post_parent    = 0;
				$post->menu_order     = 0;
				$new_item             = new WP_Post( $post );

				$new_item->is_mega_menu = true; // sent to the menu walkers

				$new_item->menu_item_parent = $item->ID;

				$new_item->url   = '';
				$new_item->title = '';
				$new_item->title .= '<div class="penci-megamenu">';

				$new_item->title .= penci_return_html_mega_menu( $penci_number_mega_menu,  $penci_width_megamenu,$dis_ajax_filter, $item_childs[ $item->ID ],$item_childs[ $item->ID ]['sub_cat'] );
				$new_item->title .= '</div>';

				$new_item->classes = array();

				$menu_items[] = $new_item;

			} else {
				$menu_items[] = $item;
			}

		} //end foreach

		unset( $item_childs, $menu_items_on_mega );

		return $menu_items;
	}

	public static function get_taxonomy_name( $cat_id, $tax = 'category' ) {
		$cat_id = (int) $cat_id;
		$category = get_term( $cat_id, $tax );
		if ( ! $category || is_wp_error( $category ) )
			return '';
		return $category->name;
	}
}
endif;

new Penci_FrameWork_Main_Menu();