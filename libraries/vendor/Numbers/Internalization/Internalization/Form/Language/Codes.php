<?php

namespace Numbers\Internalization\Internalization\Form\Language;
class Codes extends \Object\Form\Wrapper\Base {
	public $form_link = 'in_language_codes';
	public $module_code = 'IN';
	public $title = 'I/N Language Codes Form';
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
			'in_language_code' => [
				'in_language_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Code', 'domain' => 'language_code', 'percent' => 50, 'required' => true, 'navigation' => true],
				'in_language_code2' => ['order' => 2, 'label_name' => 'Code (2)', 'type' => 'char', 'length' => 2, 'null' => true],
				'in_locale_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'in_language_name' => [
				'in_language_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 50, 'required' => true],
				'in_language_native_name' => ['order' => 2, 'label_name' => 'Native Name', 'domain' => 'name', 'percent' => 50],
			],
			'in_language_parent_language_code' => [
				'in_language_family_name' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Family Name', 'domain' => 'name', 'null' => true, 'percent' => 50],
				'in_language_rtl' => ['order' => 2, 'label_name' => 'Right to Left', 'type' => 'boolean', 'percent' => 50],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Language Codes',
		'model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'
	];
}