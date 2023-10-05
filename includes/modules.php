<?php
$modules = [
	'modules/gocmbb-team/gocmbb-teams.php',
	// 'modules/gocmbb-testimonial/gocmbb-testimonial.php',
];

$theme_dir = is_child_theme() ? get_stylesheet_directory() : get_template_directory();

foreach ( $modules as $module ) {
	$module_file_path = $theme_dir . '/custom-module-beaver/' . $module;
	if ( file_exists( $module_file_path ) ) {
		require_once $module_file_path;
	}
	require_once GOCMBB_MODULE_DIR . $module;
}
