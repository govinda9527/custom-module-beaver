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
		if ( ! is_wp_error( $teams_image ) && $teams_image ) {
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
	
	public function gocmbb_get_modules_group() {
		$gocmbb = array();
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

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'GOCMBB_Teams_Module', array(
	'general' => array( // Tab
		'title'    => __( 'General', 'bb-gocmbb' ), // Tab title
		'sections' => array( // Tab Sections
			'heading'          => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'teams_layout_view' => array(
						'type'    => 'select',
						'label'   => __( 'Layout', 'bb-gocmbb' ),
						'default' => 'box',
						'options' => array(
							'box'    => __( 'Grid', 'bb-gocmbb' ),
							'slider' => __( 'Carousel', 'bb-gocmbb' )
						),
						'toggle'  => array(
							'slider' => array(
								'sections' => array( 'slider', 'carousel_section', 'arrow_nav', 'dot_nav' ),
							),
							'box'    => array(
								'sections' => array( 'box' ),
							)
						),
					),
				)
			),
			'box'              => array( // Section
				'title'  => __( 'Grid Settings', 'bb-gocmbb' ), // Section Title
				'fields' => array( // Section Fields
					'show_col' => array(
						'type'    => 'select',
						'label'   => __( 'Show Columns', 'bb-gocmbb' ),
						'default' => 3,
						'options' => array(
							'12' => '1',
							'6'  => '2',
							'4'  => '3',
							'3'  => '4',
						),
						'toggle'  => array(
							'12' => array(
								'sections' => array( 'content_border' )
							),
						)
					),

				)
			),
			'slider'           => array( // Section
				'title'  => __( 'Carousel Settings', 'bb-gocmbb' ), // Section Title
				'fields' => array( // Section Fields
					'autoplay'        => array(
						'type'    => 'select',
						'label'   => __( 'Autoplay', 'bb-gocmbb' ),
						'default' => '1',
						'options' => array(
							'1' => __( 'Yes', 'bb-gocmbb' ),
							'0' => __( 'No', 'bb-gocmbb' )
						),
					),
					'hover_pause'     => array(
						'type'    => 'select',
						'label'   => __( 'Pause on hover', 'bb-gocmbb' ),
						'default' => '1',
						'help'    => __( 'Pause when mouse hovers over slider' ),
						'options' => array(
							'1' => __( 'Yes', 'bb-gocmbb' ),
							'0' => __( 'No', 'bb-gocmbb' ),
						),
					),
					'transition'      => array(
						'type'    => 'select',
						'label'   => __( 'Mode', 'bb-gocmbb' ),
						'default' => 'horizontal',
						'options' => array(
							'horizontal' => _x( 'Horizontal', 'Transition type.', 'bb-gocmbb' ),
							'vertical'   => _x( 'Vertical', 'Transition type.', 'bb-gocmbb' ),
							'fade'       => __( 'Fade', 'bb-gocmbb' )
						),
					),
					'pause'           => array(
						'type'        => 'text',
						'label'       => __( 'Delay', 'bb-gocmbb' ),
						'default'     => '4',
						'maxlength'   => '4',
						'size'        => '5',
						'description' => _x( 'sec', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'bb-gocmbb' )
					),
					'speed'           => array(
						'type'        => 'text',
						'label'       => __( 'Transition Speed', 'bb-gocmbb' ),
						'default'     => '0.5',
						'maxlength'   => '4',
						'size'        => '5',
						'description' => _x( 'sec', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'bb-gocmbb' )
					),
					'loop'            => array(
						'type'    => 'select',
						'label'   => __( 'Loop', 'bb-gocmbb' ),
						'default' => '1',
						'options' => array(
							'1' => __( 'Yes', 'bb-gocmbb' ),
							'0' => __( 'No', 'bb-gocmbb' ),
						),
					),
					'adaptive_height' => array(
						'type'    => 'select',
						'label'   => __( 'Fixed Height', 'bb-gocmbb' ),
						'default' => 'yes',
						'options' => array(
							'yes' => __( 'Yes', 'bb-gocmbb' ),
							'no'  => __( 'No', 'bb-gocmbb' )
						),
						'help'    => __( 'Fix height to the tallest item.', 'bb-gocmbb' )
					)
				)
			),
			'carousel_section' => array( // Section
				'title'  => '',
				'fields' => array( // Section Fields
					'max_slides'   => array(
						'type'    => 'gocmbb-simplify',
						'label'   => __( 'Slides Per Row' ),
						'default' => array(
							'desktop' => '3',
							'medium'  => '2',
							'small'   => '1',
						),
						'size'    => '5',
					),
					'slide_margin' => array(
						'type'    => 'gocmbb-simplify',
						'label'   => __( 'Margin Between Slides', 'bb-gocmbb' ),
						'default' => array(
							'desktop' => '0',
							'medium'  => '0',
							'small'   => '0',
						),
						'size'    => '5',
					),

				)
			),
			'arrow_nav'        => array( // Section
				'title'  => '',
				'fields' => array( // Section Fields
					'arrows'              => array(
						'type'    => 'select',
						'label'   => __( 'Show Arrows', 'bb-gocmbb' ),
						'default' => '1',
						'options' => array(
							'1' => __( 'Yes', 'bb-gocmbb' ),
							'0' => __( 'No', 'bb-gocmbb' )
						),
						'toggle'  => array(
							'1' => array(
								'fields' => array(
									'arrows_size',
									'arrow_background',
									'arrow_color',
									'arrow_border_width',
									'arrow_border_style',
									'arrow_border_color',
									'arrow_border_color',
									'arrow_border_radius'
								)
							)
						)
					),
					'arrows_size'         => array(
						'type'        => 'text',
						'label'       => __( 'Font Size', 'bb-gocmbb' ),
						'default'     => '20',
						'maxlength'   => '3',
						'size'        => '5',
						'description' => 'px',
						'help'        => __( 'Arrow Size.', 'bb-gocmbb' ),
					),
					'arrow_background'    => array(
						'type'       => 'color',
						'label'      => __( 'Arrow Background', 'bb-gocmbb' ),
						'default'    => 'dddddd',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-teams-main .gocmbb-slider-nav a i',
							'property' => 'background'
						)
					),
					'arrow_color'         => array(
						'type'       => 'color',
						'label'      => __( 'Arrow Color', 'bb-gocmbb' ),
						'default'    => '000000',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-teams-main .gocmbb-slider-nav a i',
							'property' => 'color'
						)
					),
					'arrow_border_radius' => array(
						'type'        => 'text',
						'default'     => '0',
						'maxlength'   => '3',
						'size'        => '5',
						'label'       => __( 'Arrow Border Radius', 'bb-gocmbb' ),
						'description' => _x( 'px', 'Value unit for border radius. Such as: "5 px"', 'bb-gocmbb' ),
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-teams-main .gocmbb-slider-nav a i',
							'property' => 'border-radius'
						)
					),
				)
			),
			'dot_nav'          => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'dots'             => array(
						'type'    => 'select',
						'label'   => __( 'Show Dots', 'bb-gocmbb' ),
						'default' => '1',
						'options' => array(
							'1' => __( 'Yes', 'bb-gocmbb' ),
							'0' => __( 'No', 'bb-gocmbb' ),
						),
						'toggle'  => array(
							'1' => array(
								'fields' => array( 'dot_color', 'active_dot_color' )
							)
						)
					),
					'dot_color'        => array(
						'type'       => 'color',
						'label'      => __( 'Dots Color', 'bb-gocmbb' ),
						'default'    => '999999',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-testimonials-wrap .bx-wragocmbber .bx-pager a',
							'property' => 'background'
						)
					),
					'active_dot_color' => array(
						'type'       => 'color',
						'label'      => __( 'Active Dot Color', 'bb-gocmbb' ),
						'default'    => '999999',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-testimonials-wrap .bx-wragocmbber .bx-pager a.active',
							'property' => 'background'
						)
					),
				)
			)
		)
	),

	'layouts'    => array(
		'title'    => __( 'Layout', 'bb-gocmbb' ),
		'sections' => array(
			'layout' => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'team_layout' => array(
						'type'    => 'gocmbb-radio',
						'label'   => __( 'Layout', 'bb-gocmbb' ),
						'default' => 1,
						'options' => array(
							'1' => 'layout_1',
							'2' => 'layout_2',
							'3' => 'layout_3',
							'4' => 'layout_4',
							'5' => 'layout_5',
						),
						'toggle'  => array(
							'1' => array(
								'fields'   => array( 'effect_selection' ),
								'sections' => array( 'button' ),
								'tabs'     => array( 'styles' ),
							),
							'3' => array(
								'sections' => array( 'button' ),
								'tabs'     => array( 'styles' ),
							),
							'4' => array(
								'sections' => array( 'button' ),
								'tabs'     => array( 'styles' ),
							),
							'5' => array(
								'fields' => array( 'effect_selection' ),
								'tabs'   => array( 'styles' ),
							),

						),
					),
				)
			),
		),
	),
	'teams'      => array( // Tab
		'title'    => __( 'Teams', 'bb-gocmbb' ), // Tab title
		'sections' => array( // Tab Sections
			'general' => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'teams' => array(
						'type'         => 'form',
						'label'        => __( 'Teams', 'bb-gocmbb' ),
						'form'         => 'gocmbb_teampanel_form', // ID from registered form below
						'preview_text' => 'name', // Name of a field to use for the preview text
						'multiple'     => true
					),
				)
			)
		)
	),
	'styles'     => array(
		'title'    => __( 'Styles', 'bb-gocmbb' ),
		'sections' => array(
			'title_fonts' => array(
				'title'  => __( 'Column Settings', 'bb-gocmbb' ),
				'fields' => array(

					'col_bg_color'           => array(
						'type'       => 'color',
						'label'      => __( 'Background Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'ffffff',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-section',
							'property' => 'background-color',
						)
					),
					'col_border_style'       => array(
						'type'    => 'select',
						'label'   => __( 'Border Style', 'bb-gocmbb' ),
						'default' => 'none',
						'options' => array(
							'none'   => __( 'None', 'bb-gocmbb' ),
							'solid'  => __( 'Solid', 'bb-gocmbb' ),
							'dotted' => __( 'Dotted', 'bb-gocmbb' ),
							'dashed' => __( 'Dashed', 'bb-gocmbb' ),
							'double' => __( 'Double', 'bb-gocmbb' ),
						),
						'toggle'  => array(
							'solid'  => array(
								'fields' => array(
									'col_border_width',
									'col_border_color',
									'col_border_hover_color',
									'col_border_radius',
									'col_box_shadow',
									'col_box_shadow_color'
								)
							),
							'dotted' => array(
								'fields' => array(
									'col_border_width',
									'col_border_color',
									'col_border_hover_color',
									'col_border_radius',
									'col_box_shadow',
									'col_box_shadow_color'
								)
							),
							'dashed' => array(
								'fields' => array(
									'col_border_width',
									'col_border_color',
									'col_border_hover_color',
									'col_border_radius',
									'col_box_shadow',
									'col_box_shadow_color'
								)
							),
							'double' => array(
								'fields' => array(
									'col_border_width',
									'col_border_color',
									'col_border_hover_color',
									'col_border_radius',
									'col_box_shadow',
									'col_box_shadow_color'
								)
							),
						)
					),
					'col_border_width'       => array(
						'type'        => 'text',
						'label'       => __( 'Border Width', 'bb-gocmbb' ),
						'default'     => '1',
						'size'        => '5',
						'description' => _x( 'px', 'Value unit for spacer width. Such as: "10 px"', 'bb-gocmbb' )
					),
					'col_border_radius'      => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Border Radius', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'top'    => 0,
							'right'  => 0,
							'bottom' => 0,
							'left'   => 0
						),
						'options'     => array(
							'top'    => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up'
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right'
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down'
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left'
							)

						)
					),
					'col_border_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Border Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000'
					),
					'col_border_hover_color' => array(
						'type'       => 'color',
						'label'      => __( 'Border Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000'
					),
					'col_box_shadow'         => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Box Shadow', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'left_right' => 0,
							'top_bottom' => 0,
							'blur'       => 0,
							'spread'     => 0
						),
						'options'     => array(
							'left_right' => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa fa-arrows-h'
							),
							'top_bottom' => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa fa-arrows-v'
							),
							'blur'       => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa fa-circle-thin'
							),
							'spread'     => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa fa-circle'
							)

						)
					),
					'col_box_shadow_color'   => array(
						'type'       => 'color',
						'label'      => __( 'Box Shadow Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'ffffff'
					),
					'effect_selection'       => array(
						'type'    => 'select',
						'label'   => __( 'Social Icon Effect', 'bb-gocmbb' ),
						'default' => 'effect-1',
						'options' => array(
							'effect-1' => __( 'Effect 1', 'bb-gocmbb' ),
							'effect-2' => __( 'Effect 2', 'bb-gocmbb' ),

						),

					),
					'overly_color'           => array(
						'type'       => 'color',
						'label'      => __( 'Hover Background', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'dddddd',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-overlay',
							'property' => 'background-color',
						)
					),
					'overly_color_opacity'   => array(
						'type'        => 'text',
						'label'       => __( 'Hover Background Color Opacity', 'bb-gocmbb' ),
						'default'     => '100',
						'maxlength'   => '3',
						'size'        => '5',
						'description' => '%',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-overlay',
							'property' => 'background-color',
						)
					),
				),
			),
		),
	),
	'typography' => array(
		'title'    => __( 'Typography', 'bb-gocmbb' ),
		'sections' => array(
			'content_border'    => array(
				'title'  => __( 'Content Border', 'bb-gocmbb' ),
				'fields' => array(
					'content_border_style'  => array(
						'type'    => 'select',
						'label'   => __( 'Border Style', 'bb-gocmbb' ),
						'default' => 'solid',
						'options' => array(
							'none'   => __( 'None', 'bb-gocmbb' ),
							'solid'  => __( 'Solid', 'bb-gocmbb' ),
							'dotted' => __( 'Dotted', 'bb-gocmbb' ),
							'dashed' => __( 'Dashed', 'bb-gocmbb' ),
							'double' => __( 'Double', 'bb-gocmbb' ),
						),
						'toggle'  => array(
							'solid'  => array(
								'fields' => array( 'content_border_width', 'content_border_radius', 'content_border_color' )
							),
							'dotted' => array(
								'fields' => array( 'content_border_width', 'content_border_radius', 'content_border_color' )
							),
							'dashed' => array(
								'fields' => array( 'content_border_width', 'content_border_radius', 'content_border_color' )
							),
							'double' => array(
								'fields' => array( 'content_border_width', 'content_border_radius', 'content_border_color' )
							),
						)
					),
					'content_border_width'  => array(
						'type'        => 'text',
						'label'       => __( 'Border Width', 'bb-gocmbb' ),
						'default'     => '1',
						'size'        => '5',
						'description' => _x( 'px', 'Value unit for spacer width. Such as: "10 px"', 'bb-gocmbb' )
					),
					'content_border_radius' => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Border Radius', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'top-left'     => 0,
							'top-right'    => 0,
							'bottom-left'  => 0,
							'bottom-right' => 0
						),
						'options'     => array(
							'top-left'     => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up'
							),
							'top-right'    => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right'
							),
							'bottom-left'  => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down'
							),
							'bottom-right' => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left'
							)
						)
					),
					'content_border_color'  => array(
						'type'       => 'color',
						'label'      => __( 'Border Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'e0e0e0'
					),
					'content_padding'      => array(
						'type'    => 'gocmbb-multinumber',
						'label'   => __( 'Padding', 'bb-gocmbb' ),
						'default' => array(
							'top'    => 20,
							'bottom' => 20,
							'left'   => 20,
							'right'  => 20,
						),
						'options' => array(
							'top'    => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content',
									'property' => 'padding-top',
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content',
									'property' => 'padding-bottom',
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content',
									'property' => 'padding-left',
								),
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content',
									'property' => 'padding-right',
								),
							)
						)
					),
				),
			),
			'title_fonts'       => array(
				'title'  => __( 'Member Name', 'bb-gocmbb' ),
				'fields' => array(

					'name_alignment'   => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'bb-gocmbb' ),
						'options' => array(
							'left'   => __( 'Left', 'bb-gocmbb' ),
							'right'  => __( 'Right', 'bb-gocmbb' ),
							'center' => __( 'Center', 'bb-gocmbb' ),
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content h4',
							'property' => 'text-align'
						)
					),
					'name_font'        => array(
						'type'    => 'font',
						'default' => array(
							'family' => 'Default',
							'weight' => 300
						),
						'label'   => __( 'Font', 'bb-gocmbb' ),
						'preview' => array(
							'type'     => 'font',
							'selector' => '.gocmbb-team-content h4'
						)
					),
					'name_font_size'   => array(
						'type'        => 'gocmbb-simplify',
						'label'       => __( 'Font Size' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => '',
						),
						'size'        => '5',
						'maxlength'   => '2',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content h4',
							'property' => 'font-size',
							'unit'     => 'px'
						)
					),
					'name_line_height' => array(
						'type'        => 'gocmbb-simplify',
						'label'       => __( 'Line Height' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => '',
						),
						'size'        => '5',
						'maxlength'   => '2',

					),
					'name_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Color', 'bb-gocmbb' ),
						'default'    => '000000',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content h4',
							'property' => 'color',
						)
					),
					'name_margin'      => array(
						'type'    => 'gocmbb-multinumber',
						'label'   => __( 'Margin', 'bb-gocmbb' ),
						'default' => array(
							'top'    => '',
							'bottom' => '',
							'left'   => '',
							'right'  => '',
						),
						'options' => array(
							'top'    => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h4',
									'property' => 'margin-top',
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h4',
									'property' => 'margin-bottom',
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h4',
									'property' => 'margin-left',
								),
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h4',
									'property' => 'margin-right',
								),
							)
						)
					),

				)
			),
			'designation_fonts' => array(
				'title'  => __( 'Designation', 'bb-gocmbb' ),
				'fields' => array(
					'designation_alignment'   => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'bb-gocmbb' ),
						'options' => array(
							'left'   => __( 'Left', 'bb-gocmbb' ),
							'right'  => __( 'Right', 'bb-gocmbb' ),
							'center' => __( 'Center', 'bb-gocmbb' ),
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content h5',
							'property' => 'text-align'
						)
					),
					'designation_font'        => array(
						'type'    => 'font',
						'default' => array(
							'family' => 'Default',
							'weight' => 300
						),
						'label'   => __( 'Font', 'bb-gocmbb' ),
						'preview' => array(
							'type'     => 'font',
							'selector' => '.gocmbb-team-content h5'
						)
					),
					'designation_font_size'   => array(
						'type'        => 'gocmbb-simplify',
						'label'       => __( 'Font Size' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => '',
						),
						'size'        => '5',
						'maxlength'   => '2',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content h5',
							'property' => 'font-size',
							'unit'     => 'px'
						)
					),
					'designation_line_height' => array(
						'type'        => 'gocmbb-simplify',
						'label'       => __( 'Line Height' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => '',
						),
						'size'        => '5',
						'maxlength'   => '2',
					),
					'designation_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Color', 'bb-gocmbb' ),
						'default'    => '7f7f7f',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content h5',
							'property' => 'color',
						)
					),
					'designation_margin'      => array(
						'type'    => 'gocmbb-multinumber',
						'label'   => __( 'Margin', 'bb-gocmbb' ),
						'default' => array(
							'top'    => '',
							'bottom' => '',
							'left'   => '',
							'right'  => '',
						),
						'options' => array(
							'top'    => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h5',
									'property' => 'margin-top',
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h5',
									'property' => 'margin-bottom',
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h5',
									'property' => 'margin-left',
								),
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'description' => 'px',
								'preview'     => array(
									'selector' => '.gocmbb-team-content h5',
									'property' => 'margin-right',
								),
							)
						)
					),
				)
			),
			'content_fonts'     => array(
				'title'  => __( 'Short Bio', 'bb-gocmbb' ),
				'fields' => array(
					'content_alignment' => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'bb-gocmbb' ),
						'options' => array(
							'left'   => __( 'Left', 'bb-gocmbb' ),
							'right'  => __( 'Right', 'bb-gocmbb' ),
							'center' => __( 'Center', 'bb-gocmbb' ),
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content p',
							'property' => 'text-align'
						)
					),
					'text_font'         => array(
						'type'    => 'font',
						'default' => array(
							'family' => 'Default',
							'weight' => 300
						),
						'label'   => __( 'Font', 'bb-gocmbb' ),
						'preview' => array(
							'type'     => 'font',
							'selector' => '.gocmbb-team-content p'
						)
					),
					'text_font_size'    => array(
						'type'        => 'gocmbb-simplify',
						'label'       => __( 'Font Size' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => '',
						),
						'size'        => '5',
						'maxlength'   => '2',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content p',
							'property' => 'font-size',
							'unit'     => 'px'
						)
					),
					'text_line_height'  => array(
						'type'        => 'gocmbb-simplify',
						'label'       => __( 'Line Height' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => '',
						),
						'size'        => '5',
						'maxlength'   => '2',

					),
					'text_color'        => array(
						'type'       => 'color',
						'label'      => __( 'Color', 'bb-gocmbb' ),
						'default'    => '000000',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-content p',
							'property' => 'color',
						)
					),

				),
			),

			'button'       => array( // Section
				'title'  => __( 'View More Button', 'bb-gocmbb' ), // Section Title
				'fields' => array( // Section Fields
					'alignment'                     => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'bb-gocmbb' ),
						'default' => 'center',
						'options' => array(
							'left'   => __( 'Left', 'bb-gocmbb' ),
							'center' => __( 'Center', 'bb-gocmbb' ),
							'right'  => __( 'Right', 'bb-gocmbb' )
						)
					),
					'button_font_family'            => array(
						'type'    => 'font',
						'label'   => __( 'Font Family', 'bb-gocmbb' ),
						'default' => array(
							'family' => 'Default',
							'weight' => 'Default'
						),
						'preview' => array(
							'type'     => 'font',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn'
						)
					),
					'button_font_size'              => array(
						'type'        => 'gocmbb-simplify',
						'size'        => '5',
						'label'       => __( 'Font Size', 'bb-gocmbb' ),
						'description' => __( 'Pleas enter value in pixels.', 'bb-gocmbb' ),
						'default'     => array(
							'desktop' => '',
							'medium'  => '',
							'small'   => ''
						)
					),
					'button_background_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Background Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'cccccc'
					),
					'button_background_hover_color' => array(
						'type'       => 'color',
						'label'      => __( 'Background Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => ''
					),
					'button_text_color'             => array(
						'type'       => 'color',
						'label'      => __( 'Text Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => ''
					),
					'button_text_hover_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Text Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => ''
					),
					'button_border_style'           => array(
						'type'    => 'select',
						'label'   => __( 'Border Style', 'bb-gocmbb' ),
						'default' => 'none',
						'options' => array(
							'none'   => __( 'None', 'bb-gocmbb' ),
							'solid'  => __( 'Solid', 'bb-gocmbb' ),
							'dotted' => __( 'Dotted', 'bb-gocmbb' ),
							'dashed' => __( 'Dashed', 'bb-gocmbb' ),
							'double' => __( 'Double', 'bb-gocmbb' ),
						),
						'toggle'  => array(
							'solid'  => array(
								'fields' => array( 'button_border_width', 'button_border_radius', 'button_border_color', 'button_border_hover_color' )
							),
							'dotted' => array(
								'fields' => array( 'button_border_width', 'button_border_radius', 'button_border_color', 'button_border_hover_color' )
							),
							'dashed' => array(
								'fields' => array( 'button_border_width', 'button_border_radius', 'button_border_color', 'button_border_hover_color' )
							),
							'double' => array(
								'fields' => array( 'button_border_width', 'button_border_radius', 'button_border_color', 'button_border_hover_color' )
							),
						)
					),
					'button_border_width'           => array(
						'type'        => 'text',
						'label'       => __( 'Border Width', 'bb-gocmbb' ),
						'default'     => '1',
						'size'        => '5',
						'description' => _x( 'px', 'Value unit for spacer width. Such as: "10 px"', 'bb-gocmbb' )
					),
					'button_border_radius'          => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Border Radius', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'top-left'     => 0,
							'top-right'    => 0,
							'bottom-left'  => 0,
							'bottom-right' => 0
						),
						'options'     => array(
							'top-left'     => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up'
							),
							'top-right'    => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right'
							),
							'bottom-left'  => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down'
							),
							'bottom-right' => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left'
							)

						)
					),
					'button_border_color'           => array(
						'type'       => 'color',
						'label'      => __( 'Border Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000'
					),
					'button_border_hover_color'     => array(
						'type'       => 'color',
						'label'      => __( 'Border Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000'
					),
					'button_box_shadow'             => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Box Shadow', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'left_right' => 0,
							'top_bottom' => 0,
							'blur'       => 0,
							'spread'     => 0
						),
						'options'     => array(
							'left_right' => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa fa-arrows-h'
							),
							'top_bottom' => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa fa-arrows-v'
							),
							'blur'       => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa fa-circle-thin'
							),
							'spread'     => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa fa-circle'
							)

						)
					),
					'button_box_shadow_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Box Shadow Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'ffffff'
					),
					'button_padding'                => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Padding', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'top'    => 10,
							'right'  => 12,
							'bottom' => 10,
							'left'   => 12
						),
						'options'     => array(
							'top'    => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up'
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right'
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down'
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left'
							)

						),
					),

				)
			), // Section
			'social_fonts' => array(
				'title'  => __( 'Social Media ', 'bb-gocmbb' ),
				'fields' => array(
					'social_alignment' => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'bb-gocmbb' ),
						'default' => 'center',
						'options' => array(
							'left'   => __( 'Left', 'bb-gocmbb' ),
							'right'  => __( 'Right', 'bb-gocmbb' ),
							'center' => __( 'Center', 'bb-gocmbb' ),
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-social',
							'property' => 'text-align'
						)
					),

					'border_radius'                 => array(
						'type'        => 'text',
						'default'     => '',
						'maxlength'   => '3',
						'size'        => '5',
						'label'       => __( 'Border Radius', 'bb-gocmbb' ),
						'description' => '%',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-section li a',
							'property' => 'border-radius',

						)
					),
					'social_background_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Background Color', 'bb-gocmbb' ),
						'default'    => 'dddddd',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-social i',

						)
					),
					'hover_social_background_color' => array(
						'type'       => 'color',
						'label'      => __( 'Hover Background Color', 'bb-gocmbb' ),
						'default'    => 'dddddd',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-social i',

						)
					),
					'social_color'                  => array(
						'type'       => 'color',
						'label'      => __( 'Color', 'bb-gocmbb' ),
						'default'    => '000000',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-social i',
							'property' => 'color',
						)
					),
					'hover_social_color'            => array(
						'type'       => 'color',
						'label'      => __( 'Hover Color', 'bb-gocmbb' ),
						'default'    => '000000',
						'show_reset' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-team-social i',
							'property' => 'color',
						)
					),

				),
			),
		)
	)
	
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

