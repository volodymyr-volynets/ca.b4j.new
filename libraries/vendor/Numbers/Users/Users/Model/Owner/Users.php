<?php

namespace Numbers\Users\Users\Model\Owner;
class Users extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Owner Users';
	public $schema;
	public $name = 'um_owner_users';
	public $pk = ['um_owneruser_tenant_id', 'um_owneruser_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_owneruser_';
	public $columns = [
		'um_owneruser_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_owneruser_id' => ['name' => '#', 'domain' => 'big_id_sequence'],
		'um_owneruser_type_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_owneruser_type_code' => ['name' => 'Type Code', 'domain' => 'group_code'],
		'um_owneruser_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_owneruser_linked_type_code' => ['name' => 'Linked Type', 'domain' => 'group_code', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Executed\Linked\Types'],
		'um_owneruser_linked_module_id' => ['name' => 'Linked Module #', 'domain' => 'module_id'],
		'um_owneruser_linked_id' => ['name' => 'Linked #', 'domain' => 'big_id'], // we do not have fk for this field
		'um_owneruser_queue_hash' => ['name' => 'Queue Hash', 'domain' => 'code', 'null' => true],
		'um_owneruser_queue_selection' => ['name' => 'Queue Selection', 'type' => 'json', 'null' => true],
		'um_owneruser_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_owner_users_pk' => ['type' => 'pk', 'columns' => ['um_owneruser_tenant_id', 'um_owneruser_id']],
		'um_owneruser_user_id_un' => ['type' => 'unique', 'columns' => ['um_owneruser_tenant_id', 'um_owneruser_type_id', 'um_owneruser_user_id', 'um_owneruser_linked_type_code', 'um_owneruser_linked_module_id', 'um_owneruser_linked_id']],
		'um_owneruser_type_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_owneruser_tenant_id', 'um_owneruser_type_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes',
			'foreign_columns' => ['on_ownertype_tenant_id', 'on_ownertype_id']
		],
		'um_owneruser_linked_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_owneruser_tenant_id', 'um_owneruser_linked_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
		],
		'um_owneruser_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_owneruser_tenant_id', 'um_owneruser_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
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

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}