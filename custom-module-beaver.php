<?php
/**
 * Plugin Name: My Custom Modules
 * Plugin URI: http://www.govindahal.com.np
 * Description: Custom modules for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Govinda
 * Author URI: http://www.govindahal.com.np
 */
define( 'CMB_DIR', plugin_dir_path( __FILE__ ) );
define( 'CMB_URL', plugins_url( '/', __FILE__ ) );

function my_load_module_one() {
  if ( class_exists( 'FLBuilder' ) ) {
      // Include your custom modules here.
      require_once 'my-module/my-module.php';
  }
}
add_action( 'init', 'my_load_module_one' );

add_action( 'init', function() {
  register_block_type( CMB_DIR.'my-module/blocks/block.json' );
} );

