<?php

namespace Numbers\Users\Organizations\Model\Organization;
class BusinessHours extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Organization Business Hours';
	public $name = 'on_organization_business_hours';
	public $pk = ['on_orgbhour_tenant_id', 'on_orgbhour_organization_id', 'on_orgbhour_day_id'];
	public $tenant = true;
	public $orderby = [
		'on_orgbhour_day_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_orgbhour_';
	public $columns = [
		'on_orgbhour_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_orgbhour_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_orgbhour_day_id' => ['name' => 'Day #', 'domain' => 'day_id', 'options_model' => '\Numbers\Users\Organizations\Model\Organization\BusinessHour\Days'],
		'on_orgbhour_start_time' => ['name' => 'Start Time', 'type' => 'time'],
		'on_orgbhour_end_time' => ['name' => 'End Time', 'type' => 'time'],
		'on_orgbhour_timezone_code' => ['name' => 'Timezone', 'domain' => 'timezone_code'],
		'on_orgbhour_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_organization_business_hours_pk' => ['type' => 'pk', 'columns' => ['on_orgbhour_tenant_id', 'on_orgbhour_organization_id', 'on_orgbhour_day_id']],
		'on_orgbhour_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_orgbhour_tenant_id', 'on_orgbhour_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}