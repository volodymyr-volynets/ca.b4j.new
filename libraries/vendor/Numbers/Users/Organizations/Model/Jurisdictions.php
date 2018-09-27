<?php

namespace Numbers\Users\Organizations\Model;
class Jurisdictions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Jurisdictions';
	public $schema;
	public $name = 'on_jurisdictions';
	public $pk = ['on_jurisdiction_tenant_id', 'on_jurisdiction_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_jurisdiction_';
	public $columns = [
		'on_jurisdiction_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_jurisdiction_id' => ['name' => 'Jurisdictions #', 'domain' => 'jurisdiction_id_sequence'],
		'on_jurisdiction_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_jurisdiction_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_jurisdiction_type' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Jurisdiction\Types'],
		'on_jurisdiction_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_jurisdictions_pk' => ['type' => 'pk', 'columns' => ['on_jurisdiction_tenant_id', 'on_jurisdiction_id']],
		'on_jurisdiction_code_un' => ['type' => 'unique', 'columns' => ['on_jurisdiction_tenant_id', 'on_jurisdiction_code']]
	];
	public $indexes = [
		'on_jurisdictions_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_jurisdiction_code', 'on_jurisdiction_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_jurisdiction_tenant_id' => 'wg_audit_tenant_id',
			'on_jurisdiction_id' => 'wg_audit_jurisdiction_id'
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}