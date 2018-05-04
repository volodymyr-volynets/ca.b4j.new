<?php

namespace Numbers\Users\Users\Model\User\Assignment;
class Queues extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Assignment Queues';
	public $name = 'um_user_assignment_queues';
	public $pk = ['um_usrassqueue_tenant_id', 'um_usrassqueue_user_id', 'um_usrassqueue_queue_type_id', 'um_usrassqueue_owner_type_id'];
	public $tenant = true;
	public $orderby = [
		'um_usrassqueue_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrassqueue_';
	public $columns = [
		'um_usrassqueue_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrassqueue_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_usrassqueue_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrassqueue_queue_type_id' => ['name' => 'Queue Type #', 'domain' => 'type_id'],
		'um_usrassqueue_owner_type_id' => ['name' => 'Owner Type #', 'domain' => 'type_id'],
		'um_usrassqueue_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_assignment_queues_pk' => ['type' => 'pk', 'columns' => ['um_usrassqueue_tenant_id', 'um_usrassqueue_user_id', 'um_usrassqueue_queue_type_id', 'um_usrassqueue_owner_type_id']],
		'um_usrassqueue_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassqueue_tenant_id', 'um_usrassqueue_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrassqueue_queue_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassqueue_tenant_id', 'um_usrassqueue_queue_type_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Queue\Types',
			'foreign_columns' => ['on_quetype_tenant_id', 'on_quetype_id']
		],
		'um_usrassqueue_owner_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrassqueue_tenant_id', 'um_usrassqueue_owner_type_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes',
			'foreign_columns' => ['on_ownertype_tenant_id', 'on_ownertype_id']
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