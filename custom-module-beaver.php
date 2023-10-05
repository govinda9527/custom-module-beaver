<?php
/**
 * Plugin Name: My Custom Modules
 * Plugin URI: http://www.govindahal.com.np
 * Description: Custom modules for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Govinda
 * Author URI: http://www.govindahal.com.np
 * Text Domain: gocm-bb
 * 
 */

if ( ! defined( 'ABSPATH' ) ) { // Exit if accessed directly.
	exit;
}

if ( class_exists( 'FLBuilder' ) ) {
	class GO_CMBB {
		/**
		 * Primary class constructor.
		 */
		public function __construct() {
			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			$this->goCMBDefineConstants();
			add_action( 'init', [ $this, 'gocmbbLoadModules' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'gocmbbLoadScriptsGloballyBasedOnSettings' ] );
			add_filter( 'body_class', [ $this, 'gocmbbBodyClasses' ] );

      add_action( 'init', function() {
        // register_block_type( GOCMBB_MODULE_DIR.'my-module/blocks/block.json' );
      } );

		}
    private function goCMBDefineConstants() {

			$gocmbb_cat = esc_html__( 'GOCMBB Module', 'gocm-bb' );
			$versions = '1.0.0';
			if ( ! defined( 'GOCMBB_MODULE_DIR' ) ) {
				define( 'GOCMBB_MODULE_DIR', plugin_dir_path( __FILE__ ) );
			}
			if ( ! defined( 'GOCMBB_MODULE_URL' ) ) {
				define( 'GOCMBB_MODULE_URL', plugins_url( '/', __FILE__ ) );
			}
			if ( ! defined( 'GOCMBB_MODULE_CAT' ) ) {
				define( 'GOCMBB_MODULE_CAT', $gocmbb_cat );
			}
			if ( ! defined( 'GOCMBB_MODULE_VERSION' ) ) {
				define( 'GOCMBB_MODULE_VERSION', $versions );
			}
			if ( ! defined( 'GOCMBB__MODULE_PLUGIN_FILE' ) ) {
				define( 'GOCMBB__MODULE_PLUGIN_FILE', __FILE__ );
			}

		}

		public function gocmbbLoadModules() {
			if ( class_exists( 'FLBuilder' ) ) {

        require_once 'my-module/my-module.php';
        require_once 'includes/modules.php';
				require_once GOCMBB_MODULE_DIR.'/includes/helper-gocmbb-functions.php'; 
        
				// require_once 'classes/class-admin-settings.php'; // admin settings
				// require_once 'classes/class-gocmbb-usage.php'; //Usage
				// require_once 'classes/class-module-fields.php'; //class fields
				// require_once 'includes/modules.php'; //include modules
				// require_once 'classes/class-wpml-compatibility.php'; //WPML 
			}
    }

		/**
		 * Load language files.
		 *
		 * @since 1.1.4
		 * @return void
		 */

		public function load_textdomain() {
			load_plugin_textdomain( 'gocm-bb', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Ninja modules Scripts
		 * @since 1.0.0
		 */
		public function gocmbbLoadScriptsGloballyBasedOnSettings() {
			if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
				wp_enqueue_style( 'gocmbb-fields-style', GOCMBB_MODULE_URL . 'assets/css/gocmbb-fields.css', array(), rand() );
				wp_enqueue_script( 'gocmbb-fields-script', GOCMBB_MODULE_URL . 'assets/js/fields.js', array( 'jquery' ), rand(), true );
			}
			wp_register_script( 'gocmbb-twitter-widgets', GOCMBB_MODULE_URL . 'assets/js/twitter-widgets.js', array( 'jquery' ), rand(), true );
		}

		/**
		 * gocmbb main Body Class
		 *
		 * @param $classes
		 *
		 * @return array
		 * @since 1.0.0
		 */
		public function gocmbbBodyClasses( $classes ) {
			$classes[] = 'gocm-bb';

			return $classes;
		}
	}

	new GO_CMBB();

} else { // Display admin notice for activating beaver builder
	add_action( 'admin_notices', 'gocmbb_admin_notices' );
	add_action( 'network_admin_notices', 'gocmbb_admin_notices' );
	function gocmbb_admin_notices() {
		$url = admin_url( 'plugins.php' );
		echo '<div class="notice notice-error"><p>';
		echo sprintf( __( 'Please install and activate Beaver Builder Lite or Beaver Builder Pro / Agency to use Custom Beaver Lite add-on and after continuing.',
			'gocm-bb' ), $url );
		echo '</p></div>';
		$lite_dirname   = 'ninja-beaver-lite-addons-for-beaver-builder';
		$lite_active    = is_plugin_active( $lite_dirname . '/gocm-bb-lite.php' );
		$plugin_dirname = basename( dirname( __DIR__ ) );
		if ( $lite_active && $plugin_dirname !== $lite_dirname ) {
			deactivate_plugins( array( $lite_dirname . '/gocm-bb-lite.php' ), false, is_network_admin() );

			return;
		}
	}
}

