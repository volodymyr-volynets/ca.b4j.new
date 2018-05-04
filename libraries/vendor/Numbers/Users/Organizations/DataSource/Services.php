<?php

namespace Numbers\Users\Organizations\DataSource;
class Services extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['on_service_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $column_prefix = 'on_service_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $options_map = [
		'on_service_name' => 'name',
		'on_service_icon' => 'icon_class',
		'on_service_inactive' => 'inactive'
	];
	public $options_active = [
		'on_service_inactive' => 0
	];

	public $primary_model = '\Numbers\Users\Organizations\Model\Services';
	public $parameters = [
		'selected_organizations' => ['name' => 'Selected Organizations', 'domain' => 'organization_id', 'multiple_column' => true],
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
		'channel_code' => ['name' => 'Channel Code', 'domain' => 'group_code'],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns(['a.*']);
		if (!empty($parameters['channel_code'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.on_service_id', '=', $parameters['existing_values']]);
				}
				if (!empty($parameters['channel_code'])) {
					$query->where('OR', function (& $query) use ($parameters) {
						$query2 = \Numbers\Users\Organizations\Model\Service\Channels::queryBuilderStatic(['alias' => 'exists_b'])->select();
						$query2->columns(['exists_b.on_servchannel_id']);
						$query2->where('AND', ['exists_b.on_servchannel_code', '=', $parameters['channel_code'], false]);
						$query = \Numbers\Users\Organizations\Model\Service\Channel\Map::queryBuilderStatic(['alias' => 'exists_a'])->select();
						$query->columns(['exists_a.on_servmap_service_id']);
						$query->where('AND', ['exists_a.on_servmap_service_id', '=', 'a.on_service_id', true]);
						$query->where('AND', ['exists_a.on_servmap_channel_id', 'IN', '(' . $query2->sql() . ')', true]);
					}, 'EXISTS');
				}
			});
		}
		if (!empty($parameters['selected_organizations'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.on_service_id', '=', $parameters['existing_values']]);
				}
				$query->where('OR', ['a.on_service_organization_id', '=', $parameters['selected_organizations']]);
			});
		}
	}
}