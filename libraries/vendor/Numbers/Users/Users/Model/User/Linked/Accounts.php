<?php

namespace Numbers\Users\Users\Model\User\Linked;
class Accounts extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Linked Accounts';
	public $name = 'um_user_linked_accounts';
	public $pk = ['um_usrlinked_tenant_id', 'um_usrlinked_module_id', 'um_usrlinked_user_id', 'um_usrlinked_type_code', 'um_usrlinked_linked_id'];
	public $tenant = true;
	public $module = true;
	public $orderby = [
		'um_usrlinked_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrlinked_';
	public $columns = [
		'um_usrlinked_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrlinked_module_id' => ['name' => 'Module #', 'domain' => 'module_id'],
		'um_usrlinked_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_usrlinked_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrlinked_type_code' => ['name' => 'Type', 'domain' => 'group_code', 'options_model' => '\Numbers\Users\Users\Model\User\Linked\Types'],
		'um_usrlinked_linked_id' => ['name' => 'Linked #', 'domain' => 'big_id'], // we do not have fk for this field
		'um_usrlinked_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_linked_accounts_pk' => ['type' => 'pk', 'columns' => ['um_usrlinked_tenant_id', 'um_usrlinked_module_id', 'um_usrlinked_user_id', 'um_usrlinked_type_code', 'um_usrlinked_linked_id']],
		'um_usrlinked_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrlinked_tenant_id', 'um_usrlinked_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrlinked_module_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrlinked_tenant_id', 'um_usrlinked_module_id'],
			'foreign_model' => '\Numbers\Tenants\Tenants\Model\Modules',
			'foreign_columns' => ['tm_module_tenant_id', 'tm_module_id']
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