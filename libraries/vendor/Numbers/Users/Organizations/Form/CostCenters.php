<?php

namespace Numbers\Users\Organizations\Form;
class CostCenters extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_cost_centers';
	public $module_code = 'ON';
	public $title = 'O/N Cost Centers Form';
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
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'on_costcenter_id' => [
				'on_costcenter_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Cost Center #', 'domain' => 'cost_center_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_costcenter_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_costcenter_name' => [
				'on_costcenter_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'on_costcenter_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_costcenter_department_id' => [
				'on_costcenter_department_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Department', 'domain' => 'department_id', 'null' => true, 'percent' => 100, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Departments::optionsActive'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Cost Centers',
		'model' => '\Numbers\Users\Organizations\Model\CostCenters'
	];
}