<?php

namespace Numbers\Users\Organizations\Model;
class Departments extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Departments';
	public $schema;
	public $name = 'on_departments';
	public $pk = ['on_department_tenant_id', 'on_department_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_department_';
	public $columns = [
		'on_department_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_department_id' => ['name' => 'SBU #', 'domain' => 'department_id_sequence'],
		'on_department_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_department_sbu_id' => ['name' => 'SBU #', 'domain' => 'sbu_id'],
		'on_department_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_department_primary_contact' => ['name' => 'Primary Contact', 'domain' => 'name'],
		'on_department_head' => ['name' => 'Department Head', 'domain' => 'name'],
		'on_department_description' => ['name' => 'Description', 'domain' => 'description'],
		'on_department_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_departments_pk' => ['type' => 'pk', 'columns' => ['on_department_tenant_id', 'on_department_id']],
		'on_department_code_un' => ['type' => 'unique', 'columns' => ['on_department_tenant_id', 'on_department_code']],
		'on_department_sbu_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_department_tenant_id', 'on_department_sbu_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\StrategicBusinessUnits',
			'foreign_columns' => ['on_sbu_tenant_id', 'on_sbu_id']
		]
	];
	public $indexes = [
		'on_departments_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_department_code', 'on_department_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_department_tenant_id' => 'wg_audit_tenant_id',
			'on_department_id' => 'wg_audit_department_id'
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
		'field' => 'on_department_id',
	];

	public $who = [
		'inserted' => true
	];

	public $addresses = [
		'map' => [
			'on_department_tenant_id' => 'wg_address_tenant_id',
			'on_department_id' => 'wg_address_department_id'
		]
	];

	public $attributes = [
		'map' => [
			'on_department_tenant_id' => 'wg_attribute_tenant_id',
			'on_department_id' => 'wg_attribute_department_id'
		]
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}