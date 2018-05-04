<?php

namespace Numbers\Users\Users\Form;
class Groups extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_groups';
	public $module_code = 'UM';
	public $title = 'U/M Groups Form';
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
			'um_usrgrp_id' => [
				'um_usrgrp_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Group #', 'domain' => 'group_id_sequence', 'percent' => 95, 'navigation' => true],
				'um_usrgrp_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'um_usrgrp_name' => [
				'um_usrgrp_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Groups',
		'model' => '\Numbers\Users\Users\Model\User\Groups'
	];
}