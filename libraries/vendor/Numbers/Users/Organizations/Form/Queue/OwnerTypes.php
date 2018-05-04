<?php

namespace Numbers\Users\Organizations\Form\Queue;
class OwnerTypes extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_owner_types';
	public $module_code = 'ON';
	public $title = 'O/N Owner Types Form';
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
	public $rows = [];
	public $elements = [
		'top' => [
			'on_ownertype_id' => [
				'on_ownertype_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type #', 'domain' => 'type_id_sequence', 'percent' => 50, 'navigation' => true],
				'on_ownertype_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'group_code', 'null' => true, 'percent' => 50, 'required' => true, 'navigation' => true],
				'on_ownertype_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_ownertype_name' => [
				'on_ownertype_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'required' => true],
			],
			'on_ownertype_multiple' => [
				'on_ownertype_multiple' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Multiple', 'type' => 'boolean', 'percent' => 15],
				'on_ownertype_can_delete' => ['order' => 2, 'label_name' => 'Can Delete', 'type' => 'boolean', 'percent' => 15],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Owner Types',
		'model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes'
	];
}