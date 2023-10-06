<?php
include_once GOCMBB_MODULE_DIR . 'modules/gocmbb-teams/gocmbb-teams.php';
/**
 * @class GOCMBB_Button_Module
 */
class GOCMBB_Button_Module extends FLBuilderModule {
	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {

        $classteam = new GOCMBB_Teams_Module();

		parent::__construct( array(
			'name'            => __( 'Button', 'bb-gocmbb' ),
			'description'     => __( 'A module for Button.', 'bb-gocmbb' ),
			'group'           => $classteam->gocmbb_get_modules_group(),
			'category'        => $classteam->gocmbb_get_modules_cat( 'content' ),
			'dir'             => GOCMBB_MODULE_DIR . 'modules/gocmbb-button/',
			'url'             => GOCMBB_MODULE_URL . 'modules/gocmbb-button/',
			'editor_export'   => true, // Defaults to true and can be omitted.
			'enabled'         => true, // Defaults to true and can be omitted.
			'partial_refresh' => true, // Set this to true to enable partial refresh.
			'icon'            => 'button.svg',
		) );
	}

	/**
	 *This Function used for button image icon
	 * @since 1.0.0
	 */
	public function gocmbb_ButtonIcon_Image() {
		if ( $this->settings->button_font_icon && $this->settings->buttton_icon_select === 'font_icon' ) { ?>
            <span class="font-icon-preview"><i class="<?php echo $this->settings->button_font_icon; ?>"></i></span>
		<?php } ?>
		<?php if ( $this->settings->button_custom_icon && $this->settings->buttton_icon_select === 'custom_icon' ) { ?>
            <span class="custom-icon-preview"><img src="<?php echo $this->settings->button_custom_icon_src; ?>"/></span>
		<?php }
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'GOCMBB_Button_Module', array(
	'button_tab'     => array( // Tab
		'title'    => __( 'Button', 'bb-gocmbb' ), // Tab title
		'sections' => array( // Tab Sections
			'button_section'      => array(
				'title'  => '',
				'fields' => array(
					'button_text' => array(
						'type'    => 'text',
						'label'   => 'Text',
						'default' => __( 'SUBMIT', 'bb-gocmbb' ),
						'preview' => array(
							'type'     => 'text',
							'selector' => '.gocmbb-button-text'
						)
					),
				)
			),
			'button_link_section' => array(
				'title'  => __( 'Link', 'bb-gocmbb' ), // Tab title',
				'fields' => array(
					'link'        => array(
						'type'        => 'link',
						'label'       => __( 'Link', 'bb-gocmbb' ),
						'default'     => __( '#', 'bb-gocmbb' ),
						'placeholder' => 'www.example.com',
						'preview'     => array(
							'type' => 'none'
						)
					),
					'link_target' => array(
						'type'        => 'select',
						'label'       => __( 'Link Target', 'bb-gocmbb' ),
						'default'     => __( '_self', 'bb-gocmbb' ),
						'placeholder' => 'www.example.com',
						'options'     => array(
							'_self'  => __( 'Same Window', 'bb-gocmbb' ),
							'_blank' => __( 'New Window', 'bb-gocmbb' ),
						),
						'preview'     => array(
							'type' => 'none'
						)
					)
				)
			),
			'button_icon_section' => array(
				'title'  => __( 'Icon', 'bb-gocmbb' ), // Tab title',
				'fields' => array(
					'buttton_icon_select'  => array(
						'type'    => 'select',
						'label'   => __( 'Icon Type', 'bb-gocmbb' ),
						'default' => 'none',
						'options' => array(
							'none'        => __( 'None', 'bb-gocmbb' ),
							'font_icon'   => __( 'Icon', 'bb-gocmbb' ),
							'custom_icon' => __( 'Image', 'bb-gocmbb' )
						),
						'toggle'  => array(
							'font_icon'   => array(
								'fields'   => array( 'button_font_icon', 'button_icon_aligment' ),
								'sections' => array( 'icon_section', 'icon_typography' ),
							),
							'custom_icon' => array(
								'fields'   => array( 'button_custom_icon', 'button_icon_aligment' ),
								'sections' => array( '' ),
							),
						),
					),
					'button_font_icon'     => array(
						'type'  => 'icon',
						'label' => __( 'Icon', 'bb-gocmbb' ),
					),
					'button_custom_icon'   => array(
						'type'  => 'photo',
						'label' => __( 'Custom Image', 'bb-gocmbb' ),
					),
					'button_icon_aligment' => array(
						'type'    => 'select',
						'label'   => __( 'Icon Position', 'bb-gocmbb' ),
						'default' => 'left',
						'options' => array(
							'left'  => __( 'Before Text', 'bb-gocmbb' ),
							'right' => __( 'After Text', 'bb-gocmbb' )
						),
					)
				)
			)
		)
	),
	'style_tab'      => array(
		'title'    => __( 'Style', 'bb-gocmbb' ),
		'sections' => array(
			'button_style_section' => array(
				'title'  => __( 'Button', 'bb-gocmbb' ),
				'fields' => array(
					'button_style'                  => array(
						'type'    => 'select',
						'label'   => __( 'Style', 'bb-gocmbb' ),
						'default' => 'flat',
						'class'   => 'creative_button_styles',
						'options' => array(
							'flat'        => __( 'Flat', 'bb-gocmbb' ),
							'gradient'    => __( 'Gradient', 'bb-gocmbb' ),
							'transparent' => __( 'Transparent', 'bb-gocmbb' ),
							'threed'      => __( '3D', 'bb-gocmbb' ),
						),
						'toggle'  => array(
							'flat'        => array(
								'fields'   => array( 'button_background_color', 'hover_button_style', 'button_box_shadow', 'button_box_shadow_color' ),
								'sections' => array( 'transition_section' )
							),
							'gradient'    => array(
								'fields' => array( 'button_background_color' )
							),
							'threed'      => array(
								'fields'   => array( 'button_background_color', 'hover_button_style' ),
								'sections' => array( 'transition_section' )
							),
							'transparent' => array(
								'fields'   => array( 'hover_button_style', 'button_box_shadow', 'button_box_shadow_color' ),
								'sections' => array( 'transition_section' )
							)
						),
					),
					'button_background_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Background Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'dfdfdf',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'background'
						)
					),
					'button_background_hover_color' => array(
						'type'       => 'color',
						'label'      => __( 'Background Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000',
						'preview'    => array(
							'type' => 'none'
						)
					),
					'button_text_color'             => array(
						'type'       => 'color',
						'label'      => __( 'Text Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '404040',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'color'
						)
					),
					'button_text_hover_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Text Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'ffffff',
						'preview'    => array(
							'type' => 'none'
						)
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
								'fields' => array( 'button_border_width', 'button_border_color', 'button_border_hover_color' )
							),
							'dotted' => array(
								'fields' => array( 'button_border_width', 'button_border_color', 'button_border_hover_color' )
							),
							'dashed' => array(
								'fields' => array( 'button_border_width', 'button_border_color', 'button_border_hover_color' )
							),
							'double' => array(
								'fields' => array( 'button_border_width', 'button_border_color', 'button_border_hover_color' )
							),
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'border-style'
						)
					),
					'button_border_width'           => array(
						'type'        => 'text',
						'label'       => __( 'Border Width', 'bb-gocmbb' ),
						'default'     => '1',
						'size'        => '5',
						'description' => _x( 'px', 'Value unit for spacer width. Such as: "10 px"', 'bb-gocmbb' ),
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'border-width'
						)
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
								'placeholder' => __( 'Top Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'border-top-left-radius',
									'unit'     => 'px'
								)
							),
							'top-right'    => array(
								'placeholder' => __( 'Top Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'border-top-right-radius',
									'unit'     => 'px'
								),
							),
							'bottom-left'  => array(
								'placeholder' => __( 'Bottom Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'border-bottom-left-radius',
									'unit'     => 'px'
								),
							),
							'bottom-right' => array(
								'placeholder' => __( 'Bottom Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'border-bottom-right-radius',
									'unit'     => 'px'
								),
							)
						)
					),
					'button_border_color'           => array(
						'type'       => 'color',
						'label'      => __( 'Border Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'border-color'
						)
					),
					'button_border_hover_color'     => array(
						'type'       => 'color',
						'label'      => __( 'Border Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000',
						'preview'    => array(
							'type' => 'none'
						)
					),
					'button_box_shadow'             => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Box Shadow', 'bb-gocmbb' ),
						'description' => 'px',
						'help'        => 'Apply when box shadow color is set',
						'default'     => array(
							'left_right' => 0,
							'top_bottom' => 0,
							'blur'       => 0,
							'spread'     => 0
						),
						'options'     => array(
							'left_right' => array(
								'placeholder' => __( 'Left-Right', 'bb-gocmbb' ),
								'icon'        => 'fa fa-arrows-h'
							),
							'top_bottom' => array(
								'placeholder' => __( 'Top-Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa fa-arrows-v'
							),
							'blur'       => array(
								'placeholder' => __( 'Blur', 'bb-gocmbb' ),
								'icon'        => 'fa fa-circle-thin'
							),
							'spread'     => array(
								'placeholder' => __( 'Spread', 'bb-gocmbb' ),
								'icon'        => 'fa fa-circle'
							)
						),
					),
					'button_box_shadow_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Box Shadow Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'ffffff',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'box-shadow'
						)
					),
					'button_padding'                => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Padding', 'bb-gocmbb' ),
						'description' => 'px',
						'default'     => array(
							'top'    => 20,
							'right'  => 40,
							'bottom' => 20,
							'left'   => 40
						),
						'options'     => array(
							'top'    => array(
								'placeholder' => __( 'Top', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-up',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'padding-top',
									'unit'     => 'px'
								)
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'padding-right',
									'unit'     => 'px'
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'padding-bottom',
									'unit'     => 'px'
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'padding-left',
									'unit'     => 'px'
								),
							)
						)
					),
					'button_margin'                 => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Button Margin', 'bb-gocmbb' ),
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
								'icon'        => 'fa-long-arrow-up',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'margin-top',
									'unit'     => 'px'
								)
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'margin-right',
									'unit'     => 'px'
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'margin-bottom',
									'unit'     => 'px'
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn',
									'property' => 'margin-left',
									'unit'     => 'px'
								),
							)
						)
					)
				)
			),
			'icon_section'         => array(
				'title'  => __( 'Icon', 'bb-gocmbb' ),
				'fields' => array(
					'icon_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Icon Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => '000000',
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
							'property' => 'color'
						)
					),
					'icon_hover_color' => array(
						'type'       => 'color',
						'label'      => __( 'Icon Hover Color', 'bb-gocmbb' ),
						'show_reset' => true,
						'default'    => 'ffffff'
					),
					'icon_padding'     => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Padding', 'bb-gocmbb' ),
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
								'icon'        => 'fa-long-arrow-up',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'padding-top',
									'unit'     => 'px'
								)
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'padding-right',
									'unit'     => 'px'
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'padding-bottom',
									'unit'     => 'px'
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'padding-left',
									'unit'     => 'px'
								),
							)
						)
					),
					'icon_margin'      => array(
						'type'        => 'gocmbb-multinumber',
						'label'       => __( 'Margin', 'bb-gocmbb' ),
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
								'icon'        => 'fa-long-arrow-up',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'margin-top',
									'unit'     => 'px'
								)
							),
							'right'  => array(
								'placeholder' => __( 'Right', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-right',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'margin-right',
									'unit'     => 'px'
								),
							),
							'bottom' => array(
								'placeholder' => __( 'Bottom', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-down',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'margin-bottom',
									'unit'     => 'px'
								),
							),
							'left'   => array(
								'placeholder' => __( 'Left', 'bb-gocmbb' ),
								'icon'        => 'fa-long-arrow-left',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
									'property' => 'margin-left',
									'unit'     => 'px'
								),
							)
						)
					)
				)
			),
			'transition_section'   => array(
				'title'  => __( 'Transition', 'bb-gocmbb' ),
				'fields' => array(
					'transition' => array(
						'type'        => 'text',
						'label'       => __( 'Transition delay', 'bb-gocmbb' ),
						'default'     => 0.3,
						'size'        => '5',
						'description' => 'sec',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn i',
							'property' => 'transition'
						)
					),
				)
			),
			'structure_section'    => array(
				'title'  => __( 'Structure', 'bb-gocmbb' ),
				'fields' => array(
					'width'         => array(
						'type'    => 'select',
						'label'   => __( 'Width', 'bb-gocmbb' ),
						'default' => 'auto',
						'options' => array(
							'auto'       => __( 'Auto', 'bb-gocmbb' ),
							'full_width' => __( 'Full Width', 'bb-gocmbb' ),
							'custom'     => __( 'Custom', 'bb-gocmbb' )
						),
						'toggle'  => array(
							'auto'       => array(
								'fields' => array( 'alignment' )
							),
							'full_width' => array(
								'fields' => array( '' )
							),
							'custom'     => array(
								'fields' => array( 'custom_width', 'custom_height', 'alignment' )
							)
						),
					),
					'custom_width'  => array(
						'type'        => 'text',
						'label'       => __( 'Custom Width', 'bb-gocmbb' ),
						'default'     => 200,
						'size'        => 10,
						'description' => 'px',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'width'
						)
					),
					'custom_height' => array(
						'type'        => 'text',
						'label'       => __( 'Custom Height', 'bb-gocmbb' ),
						'default'     => 45,
						'size'        => 10,
						'description' => 'px',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'min-height'
						)
					),
					'alignment'     => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'bb-gocmbb' ),
						'default' => 'left',
						'options' => array(
							'left'   => __( 'Left', 'bb-gocmbb' ),
							'center' => __( 'Center', 'bb-gocmbb' ),
							'right'  => __( 'Right', 'bb-gocmbb' )
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main',
							'property' => 'text-align'
						)
					)
				)
			)
		)
	),
	'typography_tab' => array(
		'title'    => __( 'Typography', 'bb-gocmbb' ),
		'sections' => array(
			'button_typography' => array(
				'title'  => __( 'Button', 'bb-gocmbb' ),
				'fields' => array(
					'button_font_family' => array(
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
					'button_font_size'   => array(
						'type'        => 'gocmbb-simplify',
						'size'        => '5',
						'label'       => __( 'Font Size', 'bb-gocmbb' ),
						'description' => 'Please enter value in pixel.',
						'default'     => array(
							'desktop' => '18',
							'medium'  => '16',
							'small'   => ''
						),
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.gocmbb-btn-main a.gocmbb-btn',
							'property' => 'font-size',
							'unit'     => 'px'
						),
					)
				)
			),
			'icon_typography'   => array(
				'title'  => __( 'Icon', 'bb-gocmbb' ),
				'fields' => array(
					'icon_font_size' => array(
						'type'        => 'gocmbb-simplify',
						'size'        => '5',
						'label'       => __( 'Font Size', 'bb-gocmbb' ),
						'description' => 'Please enter value in pixel.',
						'default'     => array(
							'desktop' => '18',
							'medium'  => '16',
							'small'   => ''
						),
					)
				)
			)
		)
	)
) );
