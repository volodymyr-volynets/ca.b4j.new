<?php

namespace Numbers\Users\Organizations\DataSource;
class Organizations extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['on_organization_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $column_prefix = 'on_organization_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $options_map = [
		'on_organization_name' => 'name',
		'on_organization_icon' => 'icon_class',
		'on_organization_inactive' => 'inactive'
	];
	public $options_active = [
		'on_organization_inactive' => 0
	];

	public $primary_model = '\Numbers\Users\Organizations\Model\Organizations';
	public $parameters = [
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns(['a.*']);
		// acl for not super admins
		if (!\User::get('super_admin')) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.on_organization_id', '=', $parameters['existing_values']]);
				}
				// user can see roles he can assign
				$query->where('OR', function (& $query) {
					// user is assigned to organization
					$organizations = \User::get('organizations');
					if (!empty($organizations)) {
						$query->where('AND', ['a.on_organization_id', '=', $organizations]);
					} else {
						$query->where('AND', 'FALSE');
					}
				});
			});
		}
	}
}