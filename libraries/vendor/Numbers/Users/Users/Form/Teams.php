<?php

namespace Numbers\Users\Users\Form;
class Teams extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_teams';
	public $module_code = 'UM';
	public $title = 'U/M Teams Form';
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
			'um_team_id' => [
				'um_team_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Team #', 'domain' => 'team_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_team_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_team_name' => [
				'um_team_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'um_team_icon' => [
				'um_team_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Teams',
		'model' => '\Numbers\Users\Users\Model\User\Teams'
	];
}