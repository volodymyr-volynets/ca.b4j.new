<?php

namespace Numbers\Tenants\Tenants\Model\Policy;
class Folders extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Policy Folders';
	public $name = 'tm_policy_folders';
	public $pk = ['tm_polfolder_tenant_id', 'tm_polfolder_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'tm_polfolder_';
	public $columns = [
		'tm_polfolder_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_polfolder_id' => ['name' => 'Folder #', 'domain' => 'folder_id_sequence'],
		'tm_polfolder_polroot_code' => ['name' => 'Root Code', 'domain' => 'type_code'],
		'tm_polfolder_parent_polfolder_id' => ['name' => 'Parent Folder #', 'domain' => 'folder_id', 'null' => true],
		'tm_polfolder_name' => ['name' => 'Name', 'domain' => 'name'],
		'tm_polfolder_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'tm_polfolder_counter' => ['name' => 'Counter', 'domain' => 'counter', 'default' => 0],
		'tm_polfolder_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_policy_folders_pk' => ['type' => 'pk', 'columns' => ['tm_polfolder_tenant_id', 'tm_polfolder_id']],
		'tm_polfolder_polroot_code_un' => ['type' => 'unique', 'columns' => ['tm_polfolder_tenant_id', 'tm_polfolder_polroot_code', 'tm_polfolder_id']],
		'tm_polfolder_polroot_code_fk' => [
			'type' => 'fk',
			'columns' => ['tm_polfolder_tenant_id', 'tm_polfolder_polroot_code'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Policy\Roots',
			'foreign_columns' => ['tm_polroot_tenant_id', 'tm_polroot_code']
		],
		'tm_polfolder_parent_polfolder_id_fk' => [
			'type' => 'fk',
			'columns' => ['tm_polfolder_tenant_id', 'tm_polfolder_polroot_code', 'tm_polfolder_parent_polfolder_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Policy\Folders',
			'foreign_columns' => ['tm_polfolder_tenant_id', 'tm_polfolder_polroot_code', 'tm_polfolder_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}