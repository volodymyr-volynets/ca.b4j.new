<?php

namespace Numbers\Users\Users\Model\Role;
class Children extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Role Children';
	public $name = 'um_role_children';
	public $pk = ['um_rolrol_tenant_id', 'um_rolrol_parent_role_id', 'um_rolrol_child_role_id'];
	public $tenant = true;
	public $orderby = [
		'um_rolrol_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_rolrol_';
	public $columns = [
		'um_rolrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_rolrol_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_rolrol_parent_role_id' => ['name' => 'Parent Role #', 'domain' => 'role_id'],
		'um_rolrol_child_role_id' => ['name' => 'Child Role #', 'domain' => 'role_id'],
		'um_rolrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_role_children_pk' => ['type' => 'pk', 'columns' => ['um_rolrol_tenant_id', 'um_rolrol_parent_role_id', 'um_rolrol_child_role_id']],
		'um_rolrol_parent_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolrol_tenant_id', 'um_rolrol_parent_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
		],
		'um_rolrol_child_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_rolrol_tenant_id', 'um_rolrol_child_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Roles',
			'foreign_columns' => ['um_role_tenant_id', 'um_role_id']
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