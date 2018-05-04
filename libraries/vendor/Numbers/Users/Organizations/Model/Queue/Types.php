<?php

namespace Numbers\Users\Organizations\Model\Queue;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Queue Types';
	public $schema;
	public $name = 'on_queue_types';
	public $pk = ['on_quetype_tenant_id', 'on_quetype_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'on_quetype_';
	public $columns = [
		'on_quetype_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_quetype_id' => ['name' => 'Type #', 'domain' => 'type_id_sequence'],
		'on_quetype_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_quetype_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_quetype_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_quetype_method_id' => ['name' => 'Method', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Methods'],
		'on_quetype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_queue_types_pk' => ['type' => 'pk', 'columns' => ['on_quetype_tenant_id', 'on_quetype_id']],
	];
	public $indexes = [
		'on_queue_types_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_quetype_name']],
	];
	public $history = false;
	public $audit = [
		'map' => [
			'on_quetype_tenant_id' => 'wg_audit_tenant_id',
			'on_quetype_id' => 'wg_audit_type_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_quetype_name' => 'name',
		'on_quetype_icon' => 'icon_class'
	];
	public $options_active = [
		'on_quetype_inactive' => 0
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