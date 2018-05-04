<?php

namespace Numbers\Users\News\Form;
class Categories extends \Object\Form\Wrapper\Base {
	public $form_link = 'ns_categories';
	public $module_code = 'NS';
	public $title = 'N/S Categories Form';
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
			'ns_category_id' => [
				'ns_category_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Category #', 'domain' => 'group_id_sequence', 'percent' => 100, 'navigation' => true],
			],
			'ns_category_name' => [
				'ns_category_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'ns_category_order' => [
				'ns_category_order' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Order', 'domain' => 'order', 'percent' => 95, 'required' => true],
				'ns_category_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Categories',
		'model' => '\Numbers\Users\News\Model\Categories'
	];
}