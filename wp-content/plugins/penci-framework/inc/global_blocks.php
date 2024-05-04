<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Penci_Global_Blocks' ) ):
	class Penci_Global_Blocks {

		private static $is_row = false;
		private static $is_inner_row = false;

		private static $is_container = false;
		private static $is_inner_container = false;

		private static $col_number = 1;
		private static $inner_col_number = 1;
		private static $col_width = '1/1';
		private static $inner_col_width = '1/1';

		private static $col_number_container = 1;
		private static $inner_col_number_container = 1;
		private static $col_width_container = '1/1';
		private static $inner_col_width_container = '1/1';

		private static $container_params = '';
		private static $class_columns = '';


		// Is Row
		public static function set_is_row( $is_row ) {
			self::$is_row = $is_row;
		}

		public static function is_row() {
			return self::$is_row;
		}

		// Is Inner Row
		public static function set_is_inner_row( $is_inner_row ) {
			self::$is_inner_row = $is_inner_row;
		}

		public static function is_inner_row() {
			return self::$is_inner_row;
		}

		// Is container
		public static function set_is_container( $is_container ) {
			self::$is_container = $is_container;
		}

		public static function is_container() {
			return self::$is_container;
		}

		// Is_inner_container
		public static function set_is_inner_container( $is_inner_container ) {
			self::$is_inner_container = $is_inner_container;
		}

		public static function is_inner_container() {
			return self::$is_inner_container;
		}

		// Column width
		public static function set_col_width( $col_width ) {
			self::$col_width = $col_width;

			$cols = 1;

			switch ( $col_width ) {
				case '1/1':
				case '11':
					$cols = 3;
					break;
				case '1/2':
				case '2/3':
				case '3/4':
				case '12':
				case '23':
				case '34':
					$cols = 2;
					break;
			}

			self::$col_number = $cols;
		}

		public static function get_column_width() {
			return self::$col_width;
		}

		// Inner column width
		public static function set_inner_column_width( $inner_col_width ) {
			self::$inner_col_width = $inner_col_width;

			$cols = 1;

			$col_number_current = self::$col_number;


			if ( '1/1' == $inner_col_width ) {
				if ( '2' == $col_number_current || '3' == $col_number_current ) {
					$cols = $col_number_current;
				}
			} elseif ( '2/3' == $inner_col_width ) {
				if ( '2' == $col_number_current || '3' == $col_number_current ) {
					$cols = 2;
				}
			}

			self::$col_number = $cols;
		}

		public static function get_inner_col_width() {
			return self::$inner_col_width;
		}

		// Column width container
		public static function set_col_width_container( $col_width ) {
			self::$col_width_container = $col_width;

			$cols = 1;

			switch ( $col_width ) {
				case '1/1':
				case '11':
					$cols = 3;
					break;
				case '1/2':
				case '2/3':
				case '3/4':
				case '12':
				case '23':
				case '34':
					$cols = 2;
					break;
			}

			self::$col_number_container = $cols;
		}

		public static function get_column_width_container() {
			return self::$col_width_container;
		}

		// Inner column width container
		public static function set_inner_column_width_container( $inner_col_width ) {
			self::$inner_col_width_container = $inner_col_width;

			$cols = 1;

			$col_number_current = self::$col_number_container;

			if ( '1/1' == $inner_col_width || '2/3' == $inner_col_width ) {
				if ( '2' == $col_number_current ) {
					$cols = 2;
				}
			}

			self::$inner_col_number_container = $cols;
		}

		public static function get_inner_col_width_container() {
			return self::$inner_col_width_container;
		}

		/**
		 * Get column
		 *
		 * @return int
		 */
		static function get_col_number() {
			$col = 1;

			// Footer is false
			if ( self::$is_row ) {
				$col = self::$col_number;
				if ( self::$is_inner_row ) {
					$col = self::$inner_col_number;
				} elseif ( self::$is_container ) {
					$col = self::$col_number_container;

					if ( self::$is_inner_container ) {
						$col = self::$inner_col_number_container;
					}
				}
			}

			return $col;
		}

		// Class container
		public static function set_container_params( $container_params ) {
			self::$container_params = $container_params;
		}

		public static function get_container_params() {
			return self::$container_params;
		}

		// Class Columns
		public static function set_class_columns( $class_columns ) {
			self::$class_columns = $class_columns;
		}

		public static function get_class_columns() {
			return self::$class_columns;
		}
	}
endif;