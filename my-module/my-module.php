<?php
class MyModuleClass extends FLBuilderModule {

public function __construct()
{
  parent::__construct(array(
    'name'            => __( 'My Module', 'fl-builder' ),
    'description'     => __( 'A totally awesome module!', 'fl-builder' ),
    'group'           => __( 'My Group', 'fl-builder' ),
    'category'        => __( 'My Category', 'fl-builder' ),
    'dir'             => MY_MODULES_DIR . 'my-module/',
    'url'             => MY_MODULES_URL . 'my-module/',
    'icon'            => 'button.svg',
    'editor_export'   => true, // Defaults to true and can be omitted.
    'enabled'         => true, // Defaults to true and can be omitted.
    'partial_refresh' => false, // Defaults to false and can be omitted.
  ));
}
}