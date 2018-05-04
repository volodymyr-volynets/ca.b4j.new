<?php

namespace Numbers\Users\Organizations\Form\Queue;
class Types extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_queue_types';
	public $module_code = 'ON';
	public $title = 'O/N Queue Types Form';
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
			'on_quetype_id' => ['order' => 100],
			'on_quetype_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_quetype_id' => [
				'on_quetype_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type #', 'domain' => 'type_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_quetype_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true],
				'on_quetype_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_quetype_name' => [
				'on_quetype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_quetype_method_id' => [
				'on_quetype_method_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Method', 'domain' => 'type_id', 'null' => true, 'required' => true, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Methods'],
				'on_quetype_icon' => ['order' => 2, 'label_name' => 'Icon', 'domain' => 'icon', 'null' => true, 'percent' => 50, 'method' => 'select', 'options_model' => '\Numbers\Frontend\HTML\FontAwesome\Model\Icons::options', 'searchable' => true],
			],
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Queue Types',
		'model' => '\Numbers\Users\Organizations\Model\Queue\Types'
	];
}