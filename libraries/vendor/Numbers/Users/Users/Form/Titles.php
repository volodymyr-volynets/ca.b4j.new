<?php

namespace Numbers\Users\Users\Form;
class Titles extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_titles';
	public $module_code = 'UM';
	public $title = 'U/M Titles Form';
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
			'um_usrtitle_name' => [
				'um_usrtitle_name' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Name', 'domain' => 'personal_title', 'percent' => 100, 'required' => true, 'navigation' => true],
			],
			'um_usrtitle_order' => [
				'um_usrtitle_order' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Order', 'domain' => 'order', 'percent' => 95, 'default' => 0],
				'um_usrtitle_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Titles',
		'model' => '\Numbers\Users\Users\Model\User\Titles'
	];
}