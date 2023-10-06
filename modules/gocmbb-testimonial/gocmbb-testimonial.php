<?php
include_once GOCMBB_MODULE_DIR . 'modules/gocmbb-teams/gocmbb-teams.php';

class GOCMBB_Testimonial_Module extends FLBuilderModule {

    public function __construct()
    {
        $classteam = new GOCMBB_Teams_Module();
        parent::__construct(
            array(
            
                'name'            => __( 'Testimonial', 'gocm-bb' ),
                'description'     => __( 'Addon to display Testimonial.', 'gocm-bb' ),
                'group'           => $classteam->gocmbb_get_modules_group(),
                'category'        => $classteam->gocmbb_get_modules_cat( 'carousel' ),
                'dir'             => GOCMBB_MODULE_DIR . 'modules/gocmbb-testimonial/',
                'url'             => GOCMBB_MODULE_URL . 'modules/gocmbb-testimonial/',
                'icon'            => 'button.svg',
                'editor_export'   => true, // Defaults to true and can be omitted.
                'partial_refresh' => true, // Set this to true to enable partial refresh.
                'enabled'         => true, // Defaults to true and can be omitted.
        ));

    }
}
FLBuilder::register_module( 'GOCMBB_Testimonial_Module', array(
    'my-tab-1'      => array(
      'title'         => __( 'Tab 1', 'fl-builder' ),
      'sections'      => array(
        'my-section-1'  => array(
          'title'         => __( 'Section 1', 'fl-builder' ),
          'fields'        => array(
            'my-field-1'     => array(
              'type'          => 'text',
                'label'         => __('Text Field 1', 'fl-builder'),
                'default'       => '',
                'maxlength'     => '2',
                'size'          => '3',
                'placeholder'   => '10',
                'class'         => 'my-css-class',
                'description'   => 'px',
                'help'          => 'Cingebant haec pressa dei quisquis quia mentisque mutastis terris longo fixo ille tum sponte volucres ignea boreas origo satus.',
                'preview'         => array(
                    'type'             => 'css',
                    'selector'         => '.fl-example-text',
                    'property'         => 'font-size',
                    'unit'             => 'px'
                )
            ),
            'my-field-2'     => array(
              'type'          => 'text',
              'label'         => __('Text Field 2', 'fl-builder'),
              'default'       => '',
              'maxlength'     => '2',
              'size'          => '3',
              'placeholder'   => '10',
              'class'         => 'my-css-class',
              'description'   => 'px',
              'help'          => 'Cingebant haec pressa dei quisquis quia mentisque mutastis terris longo fixo ille tum sponte volucres ignea boreas origo satus.',
              'preview'         => array(
                  'type'             => 'css',
                  'selector'         => '.fl-example-text2',
                  'property'         => 'font-size',
                  'unit'             => 'px'
              )
              ),
              'color_field'    => array(
                'type'          => 'color',
                'label'         => __('Color Picker', 'fl-builder'),
                'default'       => '333333',
                'show_reset'    => true,
                'preview'         => array(
                    'type'            => 'css',
                    'selector'        => '.fl-example-text, fl-example-text2',
                    'property'        => 'color'
                )
            ),
            'my_text_field' => array(
              'type'          => 'text',
              'label'         => __( 'My Text Field', 'fl-builder' ),
              'limit'         => 5, // limit the number of repeaters
              'multiple'      => true,
            ),
          )
        )
      )
          )
  ) );
  