<?php

/**
 * @class GOCMBB_Teams_Module
 */
class GOCMBB_Teams_Module extends FLBuilderModule {
	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct( array(
			'name'            => __( 'Teams', 'gocm-bb' ),
			'description'     => __( 'Addon to display Teams.', 'gocm-bb' ),
			'group'           => $this->gocmbb_get_modules_group(),
			'category'        => $this->gocmbb_get_modules_cat( 'carousel' ),
			'dir'             => GOCMBB_MODULE_DIR . 'modules/gocmbb-teams/',
			'url'             => GOCMBB_MODULE_URL . 'modules/gocmbb-teams/',
			'editor_export'   => true, // Defaults to true and can be omitted.
			'partial_refresh' => true, // Set this to true to enable partial refresh.
			'enabled'         => true, // Defaults to true and can be omitted.
		) );
	
		/**
		 * Use these methods to enqueue css and js already
		 * registered or to register and enqueue your own.
		 */
		// Already registered
		$this->add_css( 'jquery-bxslider' );
		$this->add_css( 'font-awesome' );
		$this->add_js( 'jquery-bxslider' );
		$this->add_css( 'gocmbb-teams-fields', GOCMBB_MODULE_URL . 'modules/gocmbb-teams/css/fields.css' );
		$this->add_css( 'gocmbb-teams-frontend', GOCMBB_MODULE_URL . 'modules/gocmbb-teams/css/frontend.css' );
	}

	public function gocmbb_get_modules_group() {
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

	public function gocmbb_get_modules_cat( $category = '' ) {
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

	/**
	 * Get Teams Images
	 *
	 * @param $i
	 *
	 * @since 1.0.2
	 */
	public function gocmbb_image_render( $i ) {
		$photo       = $this->settings->teams[ $i ]->photo;
		$teams_image = wp_get_attachment_image_src( $photo );
		if ( ! is_wp_error( $teams_image ) ) {
			$photo_src    = $teams_image[0];
			$photo_width  = $teams_image[1];
			$photo_height = $teams_image[2];
		}
		if ( $photo !== '' ) {
			echo '<img src="' . $this->settings->teams[ $i ]->photo_src . '" width="' . $photo_width . '" height="' . $photo_height . '" class="gocmbb-img-responsive">';
		} else {
			echo '<img src="' . GOCMBB_MODULE_URL . 'modules/gocmbb-teams/images/placeholder.jpg" class="gocmbb-image-responsive" />';
		}
	}

	/**
	 * For Name,Designation,Bio
	 *
	 * @param $i
	 *
	 * @since 1.0.2
	 */
	public function gocmbb_short_bio( $i ) {
		$teams       = $this->settings->teams[ $i ];
		$team_layout = $this->settings->team_layout;
		if ( $teams->name ) {
			if ( $teams->url !== '' && $team_layout != 1 && $team_layout != 3 && $team_layout != 4 ) {
				echo '<a href="' . $teams->url . '"  target="' . $teams->link_target . '">';
			}
			echo '<h4 class="gocmbb-team-name-selector">' . $teams->name . '</h4>';

			if ( $teams->url !== '' && $team_layout != 1 && $team_layout != 3 && $team_layout != 4 ) {
				echo '</a>';
			}
		}
		if ( $teams->designation ) {
			echo '<h5 class="gocmbb-team-designation-selector">' . $teams->designation . '</h5>';
		}
		if ( $teams->member_description !== '' && $team_layout != 3 && $team_layout != 4 && $team_layout != 5 ) {
			echo $teams->member_description;
		}
	}


	/**
	 * For Social Media
	 *
	 * @param $i
	 *
	 * @since 1.0.2
	 */
	public function gocmbb_social_media( $i ) {
		$teams       = $this->settings->teams[ $i ];
		$team_layout = $this->settings->team_layout;
		$effect      = array();
		$effect_1    = array( 'left', 'left', 'right', 'right' );
		$effect_2    = array( 'left', 'top', 'bottom', 'right' );
		if ( $this->settings->effect_selection === 'effect-1' ) {
			$effect[] = $effect_1;
		}
		if ( $this->settings->effect_selection === 'effect-2' ) {
			$effect[] = $effect_2;
		}
		$social_array = array();

		if ( $teams->facebook_url !== '' ) {
			$social_array[] = '1';
		}
		if ( $teams->twitter_url !== '' ) {
			$social_array[] = '2';
		}
		if ( $teams->googleplus_url !== '' ) {
			$social_array[] = '3';
		}
		if ( $teams->linkedin_url !== '' ) {
			$social_array[] = '4';
		}
		echo '<ul>';
		if ( $team_layout != 2 && $team_layout != 3 ) {
			for ( $j = 0, $jMax = count( $social_array ); $j <= $jMax; $j ++ ) {
				$k = $j;
				if ( $teams->facebook_url !== '' ) {
					echo '<li class="' . $effect[0][ $k ] . '"><a href="' . $teams->facebook_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-facebook"></i></a></li>';
					$k ++;
				}
				if ( $teams->twitter_url !== '' ) {
					echo '<li class="' . $effect[0][ $k ] . '"><a href="' . $teams->twitter_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-twitter"></i></a></li>';
					$k ++;
				}
				if ( $teams->googleplus_url !== '' ) {
					echo '<li class="' . $effect[0][ $k ] . '"><a href="' . $teams->googleplus_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-google-plus"></i></a></li>';
					$k ++;
				}
				if ( $teams->linkedin_url !== '' ) {
					echo '<li class="' . $effect[0][ $k ] . '"><a href="' . $teams->linkedin_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-linkedin"></i></a></li>';
					$k ++;
				}
				$j = $k;
			}
		} else {
			if ( $teams->facebook_url !== '' ) {
				echo '<li><a href="' . $teams->facebook_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-facebook"></i></a></li>';
			}
			if ( $teams->twitter_url !== '' ) {
				echo '<li><a href="' . $teams->twitter_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-twitter"></i></a></li>';
			}
			if ( $teams->googleplus_url !== '' ) {
				echo '<li><a href="' . $teams->googleplus_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-google-plus"></i></a></li>';
			}
			if ( $teams->linkedin_url !== '' ) {
				echo '<li><a href="' . $teams->linkedin_url . '" target="' . $teams->social_link_target . '" ><i class="fa fa-linkedin"></i></a></li>';
			}
		}
		echo '</ul>';
	}

	/**
	 * for Button Render
	 *
	 * @param $i
	 *
	 * @since 1.0.2
	 */
	public function gocmbb_button_render( $i ) {
		$teams = $this->settings->teams[ $i ];

		if ( $teams->url_text !== '' && $teams->url !== '' ) {
			$btn_settings = array(
				'button_text' => $this->settings->teams[ $i ]->url_text, //Button text
				'link'        => $teams->url, //Button Link
			);
			FLBuilder::render_module_html( 'gocmbb-button', $btn_settings );
		}
	}

	/**
	 * Use this method to work with settings data before
	 * it is saved. You must return the settings object.
	 *
	 * @method update
	 * @param $settings {object}
	 *
	 * @return object
	 */
	public function update( $settings ) {
		return $settings;
	}

	/**
	 * This method will be called by the builder
	 * right before the module is deleted.
	 *
	 * @method delete
	 */
	public function delete() {
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'GOCMBB_Teams_Module', array(
	
) );
/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form( 'gocmbb_teampanel_form', array(
	'title' => __( 'Add Team Member', 'gocm-bb' ),
	'tabs'  => array(
		'general' => array( // Tab
			'title'    => __( 'General', 'gocm-bb' ), // Tab title
			'sections' => array( // Tab Sections
				'member_details' => array(
					'title'  => 'Member Details',
					'fields' => array(
						'name'        => array(
							'type'    => 'text',
							'label'   => __( 'Name', 'gocm-bb' ),
							'default' => 'Name',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.gocmbb-team-name-selector'
							)
						),
						'designation' => array(
							'type'    => 'text',
							'label'   => __( 'Designation', 'gocm-bb' ),
							'default' => 'Designation',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.gocmbb-team-designation-selector'
							)
						),
						'photo'       => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'gocm-bb' ),
							'show_remove' => true
						),
						'url'         => array(
							'type'        => 'link',
							'label'       => __( 'Link', 'fl-builder' ),
							'default'     => '#',
							'placeholder' => 'http://www.example.com',
							'preview'     => array(
								'type' => 'none'
							)
						),
						'url_text'    => array(
							'type'    => 'text',
							'label'   => __( 'Link Text', 'fl-builder' ),
							'default' => 'Read More',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.gocmbb-read-more',
							)
						),
						'link_target' => array(
							'type'    => 'select',
							'label'   => __( 'Link Target', 'gocm-bb' ),
							'default' => '_blank',
							'options' => array(
								'_self'  => __( 'Same Window', 'gocm-bb' ),
								'_blank' => __( 'New Window', 'gocm-bb' )
							)
						),
					),
				),
				'short_bio'      => array(
					'title'  => 'Short Bio',
					'fields' => array(
						'member_description' => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'default'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s. ',
							'rows'          => 8,
							'preview'       => array(
								'type'     => 'text',
								'selector' => '.gocmbb-member-description'
							)
						),
					),
				),
				'social_details' => array(
					'title'  => 'Social Links',
					'fields' => array(
						'facebook_url'       => array(
							'type'    => 'text',
							'label'   => __( 'Facebook URL', 'gocm-bb' ),
							'default' => '#',
						),
						'twitter_url'        => array(
							'type'    => 'text',
							'label'   => __( 'Twitter URL', 'gocm-bb' ),
							'default' => '#',
						),
						'googleplus_url'     => array(
							'type'    => 'text',
							'label'   => __( 'Google Plus URL', 'gocm-bb' ),
							'default' => '#',
						),
						'linkedin_url'       => array(
							'type'    => 'text',
							'label'   => __( 'Linkedin URL', 'gocm-bb' ),
							'default' => '#',
						),
						'social_link_target' => array(
							'type'    => 'select',
							'label'   => __( 'Link Target', 'gocm-bb' ),
							'default' => '_blank',
							'options' => array(
								'_self'  => __( 'Same Window', 'gocm-bb' ),
								'_blank' => __( 'New Window', 'gocm-bb' )
							)
						)
					),
				),

			)
		)
	)
) );
