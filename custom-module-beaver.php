<?php
/**
 * Plugin Name: My Custom Modules
 * Plugin URI: http://www.govindahal.com.np
 * Description: Custom modules for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Govinda
 * Author URI: http://www.govindahal.com.np
 */
define( 'MY_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'MY_MODULES_URL', plugins_url( '/', __FILE__ ) );

function my_load_module_examples() {
  if ( class_exists( 'FLBuilder' ) ) {
      // Include your custom modules here.
  }
}
add_action( 'init', 'my_load_module_examples' );