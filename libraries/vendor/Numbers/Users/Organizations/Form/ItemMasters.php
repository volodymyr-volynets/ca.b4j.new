<?php

namespace Numbers\Users\Organizations\Form;
class ItemMasters extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_item_masters';
	public $module_code = 'ON';
	public $title = 'O/N Item Masters Form';
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
	public $rows = [
		'top' => [
			'on_itemmaster_id' => ['order' => 100],
			'on_itemmaster_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_itemmaster_id' => [
				'on_itemmaster_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Region #', 'domain' => 'region_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_itemmaster_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 45, 'required' => true, 'navigation' => true],
				'on_itemmaster_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_itemmaster_name' => [
				'on_itemmaster_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Item Masters',
		'model' => '\Numbers\Users\Organizations\Model\ItemMasters'
	];
}