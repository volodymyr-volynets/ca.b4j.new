<?php

namespace Numbers\Users\Organizations\Model;
class CostCenters extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Cost Center';
	public $schema;
	public $name = 'on_cost_centers';
	public $pk = ['on_costcenter_tenant_id', 'on_costcenter_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_costcenter_';
	public $columns = [
		'on_costcenter_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_costcenter_id' => ['name' => 'Cost Center #', 'domain' => 'cost_center_id_sequence'],
		'on_costcenter_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_costcenter_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_costcenter_department_id' => ['name' => 'Department #', 'domain' => 'department_id'],
		'on_costcenter_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_cost_centers_pk' => ['type' => 'pk', 'columns' => ['on_costcenter_tenant_id', 'on_costcenter_id']],
		'on_costcenter_code_un' => ['type' => 'unique', 'columns' => ['on_costcenter_tenant_id', 'on_costcenter_code']],
		'on_costcenter_department_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_costcenter_tenant_id', 'on_costcenter_department_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Departments',
			'foreign_columns' => ['on_department_tenant_id', 'on_department_id']
		]
	];
	public $indexes = [
		'on_cost_centers_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_costcenter_code', 'on_costcenter_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_costcenter_tenant_id' => 'wg_audit_tenant_id',
			'on_costcenter_id' => 'wg_audit_department_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $relation = [
		'field' => 'on_costcenter_id',
	];

	public $who = [
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}