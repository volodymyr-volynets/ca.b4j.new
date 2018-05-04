<?php

namespace Numbers\Users\Organizations\Form\Organization;
class Types extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_types';
	public $module_code = 'ON';
	public $title = 'O/N Organization Types Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
			'new' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'on_orgtype_code' => [
				'on_orgtype_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type Code', 'domain' => 'type_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'on_orgtype_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_orgtype_name' => [
				'on_orgtype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
				'on_orgtype_parent_type_code' => ['order' => 2, 'label_name' => 'Parent Type', 'domain' => 'type_code', 'null' => true]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Types',
		'model' => '\Numbers\Users\Organizations\Model\Organization\Types'
	];
}