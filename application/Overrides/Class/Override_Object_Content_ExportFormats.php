<?php

$object_override_blank_object = Object\Override\Blank::__set_state(array(
   'data' => 
  array (
    'csv' => 
    array (
      'name' => 'CSV (Comma Delimited)',
      'model' => '\\Numbers\\Backend\\IO\\CSV\\Exports',
      'delimiter' => ',',
      'enclosure' => '"',
      'extension' => 'csv',
      'content_type' => 'application/octet-stream',
    ),
    'txt' => 
    array (
      'name' => 'Text (Tab Delimited)',
      'model' => '\\Numbers\\Backend\\IO\\CSV\\Exports',
      'delimiter' => '	',
      'enclosure' => '"',
      'extension' => 'txt',
      'content_type' => 'application/octet-stream',
    ),
  ),
));