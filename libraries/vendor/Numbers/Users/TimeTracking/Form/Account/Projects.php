<?php

namespace Numbers\Users\TimeTracking\Form\Account;
class Projects extends \Object\Form\Wrapper\Base {
	public $form_link = 'tt_account_projects';
	public $module_code = 'TT';
	public $title = 'T/T Projects (Account) Form';
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
			'tt_project_id' => [
				'tt_project_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Project #', 'domain' => 'project_id_sequence', 'percent' => 95, 'navigation' => ['depends' => 'tt_project_user_id']],
				'tt_project_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'tt_project_name' => [
				'tt_project_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
				'tt_project_date_start' => ['order' => 2, 'label_name' => 'Date Start', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'tt_project_date_finish' => ['order' => 3, 'label_name' => 'Date Finish', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'tt_project_type_id' => [
				'tt_project_type_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'null' => true, 'percent' => 25, 'required' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Numbers\Users\TimeTracking\Model\Project\Types', 'onchange' => 'this.form.submit();'],
				'tt_project_parent_project_id' => ['order' => 2, 'label_name' => 'Parent Project/Task', 'domain' => 'project_id', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'select', 'options_model' => '\Numbers\Users\TimeTracking\Model\Projects::optionsActive', 'options_depends' => ['tt_project_user_id' => 'parent::tt_project_user_id']],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		],
		self::HIDDEN => [
			'tt_project_user_id' => [
				'tt_project_user_id' => ['order_for_defaults' => PHP_INT_MIN, 'label_name' => 'User #', 'domain' => 'user_id', 'method' => 'hidden'],
			]
		],
	];
	public $collection = [
		'name' => 'Projects',
		'model' => '\Numbers\Users\TimeTracking\Model\Projects',
		'acl_datasource' => '\Numbers\Users\TimeTracking\DataSource\Projects',
		'acl_parameters' => [],
	];

	public function validate(& $form) {
		$form->values['tt_project_user_id'] = \User::id();
		if ($form->values['tt_project_type_id'] == 10) {
			$form->values['tt_project_parent_project_id'] = null;
		}
	}

	public function overrideFieldValue(& $form, & $options, & $value, & $neighbouring_values) {
		if ($options['options']['field_name'] == 'tt_project_parent_project_id') {
			if ($neighbouring_values['tt_project_type_id'] == 10 || empty($neighbouring_values['tt_project_type_id'])) {
				$options['options']['readonly'] = true;
			}
		}
	}
}