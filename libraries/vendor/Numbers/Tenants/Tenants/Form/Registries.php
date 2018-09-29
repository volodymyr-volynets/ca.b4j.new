<?php

namespace Numbers\Tenants\Tenants\Form;
class Registries extends \Object\Form\Wrapper\Base {
	public $form_link = 'tm_registries';
	public $module_code = 'TM';
	public $title = 'T/M Registries Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'tm_assignment_id' => [
				'tm_registry_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Registry Code', 'domain' => 'code', 'required' => true, 'percent' => 95, 'navigation' => true],
				'tm_registry_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'tm_registry_value' => [
				'tm_registry_value' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Value', 'type' => 'text', 'percent' => 100, 'maxlength' => 255],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Registries',
		'model' => '\Numbers\Tenants\Tenants\Model\Registries',
	];
}