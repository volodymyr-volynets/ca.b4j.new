<?php

namespace Numbers\Users\Chat\Model\Group;
class Users extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CT';
	public $title = 'C/T Group Users';
	public $schema;
	public $name = 'ct_group_users';
	public $pk = ['ct_grpuser_tenant_id', 'ct_grpuser_group_id', 'ct_grpuser_user_id'];
	public $tenant = true;
	public $orderby = [
		'ct_grpuser_user_id' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'ct_grpuser_';
	public $columns = [
		'ct_grpuser_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ct_grpuser_group_id' => ['name' => 'Group #', 'domain' => 'group_id'],
		'ct_grpuser_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
	];
	public $constraints = [
		'ct_group_users_pk' => ['type' => 'pk', 'columns' => ['ct_grpuser_tenant_id', 'ct_grpuser_group_id', 'ct_grpuser_user_id']],
		'ct_grpuser_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ct_grpuser_tenant_id', 'ct_grpuser_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'ct_grpuser_group_id_fk' => [
			'type' => 'fk',
			'columns' => ['ct_grpuser_tenant_id', 'ct_grpuser_group_id'],
			'foreign_model' => '\Numbers\Users\Chat\Model\Groups',
			'foreign_columns' => ['ct_group_tenant_id', 'ct_group_id']
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