<?php

namespace Numbers\Users\APIs\Model;
class Roles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UA';
	public $title = 'U/A API Roles';
	public $schema;
	public $name = 'ua_api_roles';
	public $pk = ['ua_apirol_tenant_id', 'ua_apirol_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ua_apirol_';
	public $columns = [
		'ua_apirol_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ua_apirol_id' => ['name' => 'Role #', 'domain' => 'role_id_sequence'],
		'ua_apirol_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'ua_apirol_name' => ['name' => 'Name', 'domain' => 'name'],
		'ua_apirol_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'ua_apirol_weight' => ['name' => 'Weight', 'domain' => 'weight', 'null' => true], // based on this field priorities would be set
		'ua_apirol_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ua_api_roles_pk' => ['type' => 'pk', 'columns' => ['ua_apirol_tenant_id', 'ua_apirol_id']],
		'ua_apirol_code_un' => ['type' => 'unique', 'columns' => ['ua_apirol_tenant_id', 'ua_apirol_code']],
	];
	public $indexes = [
		'ua_api_roles_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ua_apirol_code', 'ua_apirol_name']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'ua_apirol_tenant_id' => 'wg_audit_tenant_id',
			'ua_apirol_id' => 'wg_audit_role_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'ua_apirol_name' => 'name',
		'ua_apirol_icon' => 'icon_class'
	];
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