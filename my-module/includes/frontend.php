<div class="fl-example-text">
  <h1>Hello from frontend</h1>
  <?php 
    $field1 = "my-field-1";
    $field2 = "my-field-2";
  echo $settings->$field1; 
  echo $settings->$field2; 
  foreach($settings->my_text_field as $v){
    echo "<p>".$v."</p>";
  }
  
  ?>
  <?php //$module->example_method(); ?>
</div>