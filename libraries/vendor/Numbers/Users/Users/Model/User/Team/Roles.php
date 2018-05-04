<?php

namespace Numbers\Users\Users\Model\User\Team;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Team Roles';
	public $name = 'um_user_team_roles';
	public $pk = ['um_usrtmrol_tenant_id', 'um_usrtmrol_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrtmrol_';
	public $columns = [
		'um_usrtmrol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrtmrol_id' => ['name' => 'Role #', 'domain' => 'role_id_sequence'],
		'um_usrtmrol_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_usrtmrol_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'um_usrtmrol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_team_roles_pk' => ['type' => 'pk', 'columns' => ['um_usrtmrol_tenant_id', 'um_usrtmrol_id']],
	];
	public $indexes = [
		'um_user_team_roles_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_usrtmrol_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'um_usrtmrol_tenant_id' => 'wg_audit_tenant_id',
			'um_usrtmrol_id' => 'wg_audit_role_id'
		]
	];
	public $options_map = [
		'um_usrtmrol_name' => 'name',
		'um_usrtmrol_icon' => 'icon_class',
	];
	public $options_active = [
		'um_usrtmrol_inactive' => 0
	];
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