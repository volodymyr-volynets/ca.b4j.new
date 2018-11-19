<?php

$object_override_blank_object = Object\Override\Blank::__set_state(array(
   'data' => 
  array (
    'text/dump' => 
    array (
      'no_form_content_type_name' => 'Table Dump (CSV)',
      'no_form_content_type_model' => '\\Numbers\\Backend\\IO\\Renderers\\List2\\Dump\\Base',
      'no_form_content_type_order' => 32000,
    ),
    'application/pdf' => 
    array (
      'no_form_content_type_name' => 'PDF Document',
      'no_form_content_type_model' => '\\Numbers\\Backend\\IO\\Renderers\\List2\\PDF\\Base',
      'no_form_content_type_order' => -30000,
    ),
    'text/csv' => 
    array (
      'no_form_content_type_name' => 'CSV (Comma Delimited)',
      'no_form_content_type_model' => '\\Numbers\\Backend\\IO\\Renderers\\List2\\CSV\\Base',
      'no_form_content_type_order' => -31000,
    ),
  ),
));