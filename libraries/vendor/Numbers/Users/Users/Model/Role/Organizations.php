<?php

namespace Numbers\Users\Users\Model\Role;
class Organizations extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Role Organizations';
	public $name = 'um_role_organizations';
	public $pk = ['um_rolorg_tenant_id', 'um_rolorg_role_id', 'um_rolorg_organization_id'];
	public $tenant = true;
	public $orderby = [
		'um_rolorg_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_rolorg_';
	public $columns = [
		'um_rolorg_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_rolorg_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_rolorg_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'um_rolorg_organization_id' => ['name' => 'Organization #', 'domain' => 'organization_id'],
		'um_rolorg_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_role_organizations_pk' => ['type' => 'pk', 'columns' => ['um_rolorg_tenant_id', 'um_rolorg_role_id', 'um_rolorg_organization_id']],
		'um_rolorg_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolorg_tenant_id', 'um_rolorg_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_rolorg_organization_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolorg_tenant_id', 'um_rolorg_organization_id'],
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