<?php

namespace Numbers\Users\Users\Form;
class TeamRoles extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_team_roles';
	public $module_code = 'UM';
	public $title = 'U/M Team Roles Form';
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
			'um_usrtmrol_id' => [
				'um_usrtmrol_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role #', 'domain' => 'role_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_usrtmrol_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_usrtmrol_name' => [
				'um_usrtmrol_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'um_usrtmrol_icon' => [
				'um_usrtmrol_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Team Roles',
		'model' => '\Numbers\Users\Users\Model\User\Team\Roles'
	];
}