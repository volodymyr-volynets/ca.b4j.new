<?php

namespace Numbers\Users\TimeTracking\Form;
class Projects extends \Object\Form\Wrapper\Base {
	public $form_link = 'tt_projects';
	public $module_code = 'TT';
	public $title = 'T/T Projects Form';
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
				'tt_project_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Project #', 'domain' => 'project_id_sequence', 'percent' => 95, 'navigation' => true],
				'tt_project_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'tt_project_name' => [
				'tt_project_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'tt_project_type_id' => [
				'tt_project_type_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'null' => true, 'percent' => 25, 'required' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Numbers\Users\TimeTracking\Model\Project\Types', 'onchange' => 'this.form.submit();'],
				'tt_project_parent_project_id' => ['order' => 2, 'label_name' => 'Parent Project/Task', 'domain' => 'project_id', 'null' => true, 'required' => 'c', 'percent' => 75, 'method' => 'select', 'options_model' => '\Numbers\Users\TimeTracking\Model\Projects::optionsActive'],
			],
			'tt_project_date_start' => [
				'tt_project_team_id' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Team', 'domain' => 'team_id', 'null' => true, 'required' => 'c', 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\Model\User\Teams::optionsActive'],
				'tt_project_date_start' => ['order' => 2, 'label_name' => 'Date Start', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'tt_project_date_finish' => ['order' => 3, 'label_name' => 'Date Finish', 'type' => 'date', 'null' => true, 'percent' => 25, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
			'tt_project_user_id' => [
				'tt_project_user_id' => ['order' => 1, 'row_order' => 500, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'required' => 'c', 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Users', 'options_params' => ['skip_acl' => true]],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Projects',
		'model' => '\Numbers\Users\TimeTracking\Model\Projects',
	];

	public function validate(& $form) {
		if ($form->values['tt_project_type_id'] == 10) {
			$form->values['tt_project_parent_project_id'] = null;
		}
		if (empty($form->values['tt_project_team_id']) && empty($form->values['tt_project_user_id'])) {
			$form->error(DANGER, 'Team or user is required!', 'tt_project_team_id');
			$form->error(DANGER, 'Team or user is required!', 'tt_project_user_id');
		}
		if (!empty($form->values['tt_project_team_id'])) {
			$form->values['tt_project_user_id'] = null;
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