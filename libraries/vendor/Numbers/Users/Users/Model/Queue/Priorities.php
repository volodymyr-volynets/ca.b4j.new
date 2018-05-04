<?php

namespace Numbers\Users\Users\Model\Queue;
class Priorities extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Queue Priorities';
	public $schema;
	public $name = 'um_queue_priorities';
	public $pk = ['um_quepriority_tenant_id', 'um_quepriority_user_id', 'um_quepriority_queue_type_id', 'um_quepriority_owner_type_id', 'um_quepriority_service_id', 'um_quepriority_location_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_quepriority_';
	public $columns = [
		'um_quepriority_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_quepriority_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_quepriority_queue_type_id' => ['name' => 'Queue Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Types'],
		'um_quepriority_owner_type_id' => ['name' => 'Owner Type #', 'domain' => 'type_id'],
		'um_quepriority_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'um_quepriority_location_id' => ['name' => 'Location #', 'domain' => 'location_id'],
		'um_quepriority_priority' => ['name' => 'Priority', 'domain' => 'percent'],
		'um_quepriority_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_queue_priorities_pk' => ['type' => 'pk', 'columns' => ['um_quepriority_tenant_id', 'um_quepriority_user_id', 'um_quepriority_queue_type_id', 'um_quepriority_owner_type_id', 'um_quepriority_service_id', 'um_quepriority_location_id']],
		'um_quepriority_queue_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_quepriority_tenant_id', 'um_quepriority_queue_type_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Queue\Types',
			'foreign_columns' => ['on_quetype_tenant_id', 'on_quetype_id']
		],
		'um_quepriority_owner_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_quepriority_tenant_id', 'um_quepriority_owner_type_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes',
			'foreign_columns' => ['on_ownertype_tenant_id', 'on_ownertype_id']
		],
		'um_quepriority_service_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_quepriority_tenant_id', 'um_quepriority_service_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Services',
			'foreign_columns' => ['on_service_tenant_id', 'on_service_id']
		],
		'um_quepriority_location_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_quepriority_tenant_id', 'um_quepriority_location_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Locations',
			'foreign_columns' => ['on_location_tenant_id', 'on_location_id']
		],
		'um_quepriority_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_quepriority_tenant_id', 'um_quepriority_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
	];
	public $indexes = [];
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

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}