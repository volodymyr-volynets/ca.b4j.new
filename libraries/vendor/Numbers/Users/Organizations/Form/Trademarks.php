<?php

namespace Numbers\Users\Organizations\Form;
class Trademarks extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_trademarks';
	public $module_code = 'ON';
	public $title = 'O/N Trademarks Form';
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
		'tabs' => ['default_row_type' => 'grid', 'order' => 500, 'type' => 'tabs'],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
		// child containers
		'general_container' => ['default_row_type' => 'grid', 'order' => 32000]
	];
	public $rows = [
		'top' => [
			'on_trademark_id' => ['order' => 100],
			'on_trademark_name' => ['order' => 200],
		],
		'tabs' => [
			'general' => ['order' => 100, 'label_name' => 'General'],
		]
	];
	public $elements = [
		'top' => [
			'on_trademark_id' => [
				'on_trademark_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Trademark #', 'domain' => 'trademark_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_trademark_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true]
			],
			'on_trademark_name' => [
				'on_trademark_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			]
		],
		'tabs' => [
			'general' => [
				'general' => ['container' => 'general_container', 'order' => 100],
			]
		],
		'general_container' => [
			'on_trademark_organization_id' => [
				'on_trademark_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization', 'domain' => 'organization_id', 'null' => true, 'required' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Organizations::optionsActive'],
				'on_trademark_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_trademark_effective_from' => [
				'on_trademark_effective_from' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Effective From', 'type' => 'date', 'required' => true, 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right'],
				'on_trademark_effective_to' => ['order' => 2, 'label_name' => 'Effective To', 'type' => 'date', 'null' => true, 'percent' => 50, 'method' => 'calendar', 'calendar_icon' => 'right'],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Trademarks',
		'model' => '\Numbers\Users\Organizations\Model\Trademarks'
	];
}