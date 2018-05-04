<?php

namespace Numbers\Users\Organizations\Form\Service;
class Categories extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_service_categories';
	public $module_code = 'ON';
	public $title = 'O/N Service Categories Form';
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
			'on_servcategory_id' => ['order' => 100],
			'on_servcategory_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_servcategory_id' => [
				'on_servcategory_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Channel #', 'domain' => 'category_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_servcategory_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true],
				'on_servcategory_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_servcategory_name' => [
				'on_servcategory_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_servcategory_organization_id' => [
				'on_servcategory_organization_id' => ['order' => 1, 'row_order' => 250, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
			],
			'on_servcategory_icon' => [
				'on_servcategory_icon' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 100, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Categories',
		'model' => '\Numbers\Users\Organizations\Model\Service\Categories'
	];
}