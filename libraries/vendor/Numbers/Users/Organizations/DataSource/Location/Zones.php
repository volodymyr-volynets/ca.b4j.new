<?php

namespace Numbers\Users\Organizations\DataSource\Location;
class Zones extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['on_loczone_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $column_prefix = 'on_loczone_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $options_map = [
		'on_loczone_code' => 'name',
		'on_loczone_name' => 'name',
		'on_loczone_inactive' => 'inactive'
	];
	public $options_active = [
		'on_loczone_inactive' => 0
	];

	public $primary_model = '\Numbers\Users\Organizations\Model\Location\Zones';
	public $parameters = [
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
		'location_id' => ['name' => 'Location #', 'domain' => 'location_id', 'required' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'on_loczone_id' => 'a.on_loczone_id',
			'on_loczone_code' => 'concat_ws(\'-\', a.on_loczone_zone_code, a.on_loczone_aisle_code, a.on_loczone_bay_code, a.on_loczone_level_code, a.on_loczone_slot_code)',
			'on_loczone_name' => 'a.on_loczone_name',
			'on_loczone_inactive' => 'a.on_loczone_inactive'
		]);
		// allow existing values
		if (!empty($parameters['existing_values'])) {
			$this->query->where('OR', ['a.on_loczone_id', '=', $parameters['existing_values']]);
		}
		$this->query->where('OR', ['a.on_loczone_location_id', '=', $parameters['location_id']]);
	}
}