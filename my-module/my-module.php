<?php
class MyModuleClass extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(
            array(
            'name'            => __( 'My Module', 'fl-builder' ),
            'description'     => __( 'A totally awesome module!', 'fl-builder' ),
            'group'           => __( 'My Group', 'fl-builder' ),
            'category'        => __( 'My Category', 'fl-builder' ),
            'dir'             => CMB_DIR . 'my-module/',
            'url'             => CMB_URL . 'my-module/',
            'icon'            => 'button.svg',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }
}
FLBuilder::register_module( 'MyModuleClass', array(
    'my-tab-1'      => array(
      'title'         => __( 'Tab 1', 'fl-builder' ),
      'sections'      => array(
        'my-section-1'  => array(
          'title'         => __( 'Section 1', 'fl-builder' ),
          'fields'        => array(
            'my-field-1'     => array(
              'type'          => 'text',
              'label'         => __( 'Text Field 1', 'fl-builder' ),
            ),
            'my-field-2'     => array(
              'type'          => 'text',
              'label'         => __( 'Text Field 2', 'fl-builder' ),
            )
          )
        )
      )
    )
  ) );