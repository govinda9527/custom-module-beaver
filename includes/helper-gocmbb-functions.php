<?php
/**
 * Define gocmbb module group
 * @return mixed|string
 * @since 1.0.0
 */
function gocmbb_get_modules_group() {
	$gocmbb               = array();
	$gocmbb_builder_label = '';
	if ( is_array( $gocmbb ) ) {
		$gocmbb_builder_label = ( array_key_exists( 'gocmbb-builder-label', $gocmbb ) ) ? $gocmbb['gocmbb-builder-label'] : esc_html__( 'GOCMBB Modules', 'bb-gocmbb' );
	}
	if ( $gocmbb_builder_label == '' ) {
		$gocmbb_builder_label = esc_html__( 'GOCMBB Modules', 'bb-gocmbb' );

		return $gocmbb_builder_label;
	}

	return $gocmbb_builder_label;
}

/**
 * Define gocmbb Module Categories
 *
 * @param string $category
 *
 * @return array|mixed|string
 * @since 1.0.0
 */
function gocmbb_get_modules_cat( $category = '' ) {
	$gocmbb             = array();
	$gocmbb_builder_cat = '';
	if ( is_array( $gocmbb ) ) {
		$gocmbb_builder_cat = ( array_key_exists( 'gocmbb-builder-category', $gocmbb ) ) ? $gocmbb['gocmbb-builder-category'] : esc_html__( 'GOCMBB', 'bb-gocmbb' );
	}
	if ( $gocmbb_builder_cat == '' ) {
		$gocmbb_builder_cat = esc_html__( 'GOCMBB', 'bb-gocmbb' );
	}
	$default = 'default';
	$new     = 'new';
	$cats    = array(
		'social'     => sprintf( __( 'Social Modules - %s', 'bb-gocmbb' ), $gocmbb_builder_cat ),
		'carousel'   => sprintf( __( 'Carousel Modules - %s', 'bb-gocmbb' ), $gocmbb_builder_cat ),
		'content'    => sprintf( __( 'Content Modules - %s', 'bb-gocmbb' ), $gocmbb_builder_cat ),
		'creative'   => sprintf( __( 'Creative Modules - %s', 'bb-gocmbb' ), $gocmbb_builder_cat ),
		'form_style' => sprintf( __( 'Form Style Modules - %s', 'bb-gocmbb' ), $gocmbb_builder_cat ),
		'separator'  => sprintf( __( 'Separator Modules - %s', 'bb-gocmbb' ), $gocmbb_builder_cat ),
	);
	if ( empty( $category ) ) {
		return $cats/*[$default]*/ ;
	}

	if ( isset( $cats[ $category ] ) ) {
		return $cats[ $category ];
	}

	return $category;
}

function gocmbbProModulesList() {
	return array(
		
		array(
			'module_name'           => 'Teams',
			'module_slug'           => 'gocmbb-teams',
			'module_license_key'    => 'gocmbb_teams_license_key',
			'module_license_status' => 'gocmbb_teams_license_status'
		),
		array(
			'module_name'           => 'Testimonials',
			'module_slug'           => 'gocmbb-testimonials',
			'module_license_key'    => 'gocmbb_testimonials_license_key',
			'module_license_status' => 'gocmbb_testimonials_license_status'
		)
	);
}
