<?php

namespace Numbers\Users\Users\Form\Assignment;
class Types extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_assignment_types';
	public $module_code = 'UM';
	public $title = 'U/M Assignment Types Form';
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
			'um_assigntype_code' => [
				'um_assigntype_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'type_code', 'percent' => 95, 'required' => true, 'navigation' => true],
				'um_assigntype_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_assigntype_name' => [
				'um_assigntype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 95, 'required' => true],
				'um_assigntype_multiple' => ['order' => 2, 'label_name' => 'Multiple', 'type' => 'boolean', 'percent' => 5, 'persistent' => 'if_set']
			],
			'um_assigntype_parent_role_id' => [
				'um_assigntype_parent_role_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Parent Role', 'domain' => 'group_id', 'null' => true, 'required' => true, 'persistent' => 'if_set', 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Roles::optionsActive'],
				'um_assigntype_child_role_id' => ['order' => 2, 'label_name' => 'Child Role', 'domain' => 'group_id', 'null' => true, 'required' => true, 'persistent' => 'if_set', 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\Roles::optionsActive'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Assignment Types',
		'model' => '\Numbers\Users\Users\Model\User\Assignment\Types'
	];
}