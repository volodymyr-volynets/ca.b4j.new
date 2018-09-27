<?php

namespace Numbers\Users\Organizations\Model;
class Markets extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Markets';
	public $schema;
	public $name = 'on_markets';
	public $pk = ['on_market_tenant_id', 'on_market_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_market_';
	public $columns = [
		'on_market_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_market_id' => ['name' => 'District #', 'domain' => 'market_id_sequence'],
		'on_market_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_market_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_market_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'on_market_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_markets_pk' => ['type' => 'pk', 'columns' => ['on_market_tenant_id', 'on_market_id']],
		'on_market_code_un' => ['type' => 'unique', 'columns' => ['on_market_tenant_id', 'on_market_code']],
		'on_market_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_market_tenant_id', 'on_market_organization_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Organizations',
			'foreign_columns' => ['on_organization_tenant_id', 'on_organization_id']
		]
	];
	public $indexes = [
		'on_markets_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_market_code', 'on_market_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_market_tenant_id' => 'wg_audit_tenant_id',
			'on_market_id' => 'wg_audit_market_id'
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