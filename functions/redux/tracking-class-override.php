<?php
/**
 * Overrides the default Redux Tracking Class
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( class_exists( 'ReduxFramework' ) ) {
	return;
}

	/**
	 * Class Redux_Tracking
	 */
	class Redux_Tracking {
		public $options = array();
		public $parent;
		/** Refers to a single instance of this class. */
		private static $instance = null;

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @return  Foo A single instance of this class.
		 */
		public static function get_instance() {
	 
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
	 
			return self::$instance;
	 
		} // end get_instance;
		
		/**
		 * Class constructor
		 * @param ReduxFramework $parent
		 */
		function __construct() {

		}
		public function load( $parent ) {
			// Do nothing          
		}

		function _enqueue_tracking() {
			// Do nothing
		}

		function _enqueue_newsletter() {
			// Do nothing
		}

		/**
		 * Shows a popup that asks for permission to allow tracking.
		 */
		function tracking_request() {
			// Do nothing
		}

		/**
		 * Shows a popup that asks for permission to allow tracking.
		 */
		function newsletter_request() {
			// do nothing
		}

		/**
		 * Prints the pointer script
		 *
		 * @param string      $selector         The CSS selector the pointer is attached to.
		 * @param array       $options          The options for the pointer.
		 * @param string      $button1          Text for button 1
		 * @param string|bool $button2          Text for button 2 (or false to not show it, defaults to false)
		 * @param string      $button2_function The JavaScript function to attach to button 2
		 * @param string      $button1_function The JavaScript function to attach to button 1
		 */
		function print_scripts( $selector, $options, $button1, $button2 = false, $button2_function = '', $button1_function = '' ) { ?>
		<?php
		}

		/**
		 * Main tracking function.
		 */
		function tracking() { }
	}
Redux_Tracking::get_instance();