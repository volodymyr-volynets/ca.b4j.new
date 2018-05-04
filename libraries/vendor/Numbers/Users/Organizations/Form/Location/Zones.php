<?php

namespace Numbers\Users\Organizations\Form\Location;
class Zones extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_location_zones';
	public $module_code = 'ON';
	public $title = 'O/N Location Zones / Slots Form';
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
			'on_loczone_id' => ['order' => 100],
			'on_loczone_name' => ['order' => 200],
		]
	];
	public $elements = [
		'top' => [
			'on_loczone_id' => [
				'on_loczone_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Zone / Slot #', 'domain' => 'group_id_sequence', 'percent' => 95, 'navigation' => true],
				'on_loczone_inactive' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'on_loczone_name' => [
				'on_loczone_name' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 100, 'null' => true],
			],
			'on_loczone_location_id' => [
				'on_loczone_location_id' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'required' => true, 'percent' => 95, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Locations::optionsActive'],
			],
			'on_loczone_zone_code' => [
				'on_loczone_zone_code' => ['order' => 1, 'row_order' => 400, 'label_name' => 'Zone', 'domain' => 'type_code', 'required' => true, 'percent' => 20],
				'on_loczone_aisle_code' => ['order' => 2, 'label_name' => 'Aisle', 'domain' => 'type_code', 'required' => true, 'percent' => 20],
				'on_loczone_bay_code' => ['order' => 3, 'label_name' => 'Bay', 'domain' => 'type_code', 'required' => true, 'percent' => 20],
				'on_loczone_level_code' => ['order' => 4, 'label_name' => 'Level', 'domain' => 'type_code', 'required' => true, 'percent' => 20],
				'on_loczone_slot_code' => ['order' => 5, 'label_name' => 'Slot', 'domain' => 'type_code', 'required' => true, 'percent' => 20],
			]
		],
		'buttons' => [
			self::BUTTONS => self::BUTTONS_DATA_GROUP
		]
	];
	public $collection = [
		'name' => 'Zones Slots',
		'model' => '\Numbers\Users\Organizations\Model\Location\Zones'
	];
}