<?php

namespace Numbers\Users\Users\Model;
class Queues extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Queues';
	public $schema;
	public $name = 'um_queues';
	public $pk = ['um_queue_tenant_id', 'um_queue_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_queue_';
	public $columns = [
		'um_queue_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_queue_id' => ['name' => 'Queue #', 'domain' => 'queue_id_sequence'],
		'um_queue_type_id' => ['name' => 'Queue Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Types'],
		'um_queue_hash' => ['name' => 'Hash', 'domain' => 'code'],
		'um_queue_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_queue_temporary_until' => ['name' => 'Temporary Until', 'type' => 'timestamp', 'null' => true],
		'um_queue_operator' => ['name' => 'Operator', 'domain' => 'type_id', 'default' => 1], // 1 or -1
		'um_queue_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_queues_pk' => ['type' => 'pk', 'columns' => ['um_queue_tenant_id', 'um_queue_id']],
	];
	public $indexes = [
		'um_queue_hash_idx' => ['type' => 'btree', 'columns' => ['um_queue_hash']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map;
	public $options_active;
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true,
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}