<?php

namespace Numbers\Users\Organizations\Form;
class Departments extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_departments';
	public $module_code = 'ON';
	public $title = 'O/N Departments Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'new' => true,
			'back' => true,
			'import' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000]
	];
	public $rows = [
		'top' => [
			'on_department_id' => ['order' => 100],
			'on_department_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
			\Numbers\Countries\Widgets\Addresses\Base::ADDRESSES => \Numbers\Countries\Widgets\Addresses\Base::ADDRESSES_DATA,
			\Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES => \Numbers\Tenants\Widgets\Attributes\Base::ATTRIBUTES_DATA,
		]
	];
	public $elements = [
		'top' => [
			'on_department_id' => [
				'on_department_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Department #', 'domain' => 'department_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_department_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_department_name' => [
				'on_department_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			]
		],
		'general_container' => [
			'on_sbu_default_organization_id' => [
				'on_department_sbu_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'SBU', 'domain' => 'sbu_id', 'null' => true, 'required' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\StrategicBusinessUnits::optionsActive'],
				'on_department_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_department_primary_contact' => [
				'on_department_primary_contact' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Primary Contact', 'domain' => 'name', 'required' => true],
				'on_department_head' => ['order' => 2, 'label_name' => 'Department Head', 'domain' => 'name', 'required' => true],
			],
			'on_department_description' => [
				'on_department_description' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Description', 'domain' => 'description', 'method' => 'textarea'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Departments',
		'model' => '\Numbers\Users\Organizations\Model\Departments'
	];
}