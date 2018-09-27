<?php

namespace Numbers\Users\Organizations\Model\Queue;
class OwnerTypes extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Owner Types';
	public $name = 'on_owner_types';
	public $pk = ['on_ownertype_tenant_id', 'on_ownertype_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_ownertype_';
	public $columns = [
		'on_ownertype_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_ownertype_id' => ['name' => 'Type #', 'domain' => 'type_id_sequence'],
		'on_ownertype_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_ownertype_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_ownertype_multiple' => ['name' => 'Multiple', 'type' => 'boolean'],
		'on_ownertype_can_delete' => ['name' => 'Can Delete', 'type' => 'boolean'],
		'on_ownertype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_owner_types_pk' => ['type' => 'pk', 'columns' => ['on_ownertype_tenant_id', 'on_ownertype_id']],
		'on_ownertype_code_un' => ['type' => 'unique', 'columns' => ['on_ownertype_tenant_id', 'on_ownertype_code']],
	];
	public $indexes = [
		'on_owner_types_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_ownertype_name', 'on_ownertype_code']]
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_ownertype_tenant_id' => 'wg_audit_tenant_id',
			'on_ownertype_id' => 'wg_audit_owner_type_id'
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