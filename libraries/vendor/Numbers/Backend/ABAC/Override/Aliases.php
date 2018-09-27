<?php

namespace Numbers\Backend\ABAC\Override;
class Aliases {
	public $data = [
		'abacattr_id' => [
			'no_data_alias_name' => 'ABAC Attribute #',
			'no_data_alias_model' => '\Numbers\Backend\ABAC\Model\Attributes',
			'no_data_alias_column' => 'sm_abacattr_code'
		],
		'abacservice_id' => [
			'no_data_alias_name' => 'ABAC Service #',
			'no_data_alias_model' => '\Numbers\Backend\ABAC\Model\Services',
			'no_data_alias_column' => 'sm_abacservice_code'
		]
	];
}