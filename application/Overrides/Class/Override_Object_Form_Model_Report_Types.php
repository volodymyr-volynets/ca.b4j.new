<?php

$object_override_blank_object = Object\Override\Blank::__set_state(array(
   'data' => 
  array (
    'application/pdf' => 
    array (
      'no_report_content_type_name' => 'PDF Document',
      'no_report_content_type_model' => '\\Numbers\\Backend\\IO\\Renderers\\Report\\PDF\\Base',
      'no_report_content_type_order' => -30000,
    ),
    'text/csv' => 
    array (
      'no_report_content_type_name' => 'CSV (Comma Delimited)',
      'no_report_content_type_model' => '\\Numbers\\Backend\\IO\\Renderers\\Report\\CSV\\Base',
      'no_report_content_type_order' => -31000,
    ),
  ),
));