<?php

namespace Numbers\Users\Users\Model\User\Team;
class Map extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Team Map';
	public $name = 'um_user_team_map';
	public $pk = ['um_usrtmmap_tenant_id', 'um_usrtmmap_user_id', 'um_usrtmmap_team_id'];
	public $orderby = [
		'um_usrtmmap_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrtmmap_';
	public $columns = [
		'um_usrtmmap_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrtmmap_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_usrtmmap_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrtmmap_team_id' => ['name' => 'Group #', 'domain' => 'team_id'],
		'um_usrtmmap_role_id' => ['name' => 'Role #', 'domain' => 'role_id'],
		'um_usrtmmap_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_team_map_pk' => ['type' => 'pk', 'columns' => ['um_usrtmmap_tenant_id', 'um_usrtmmap_user_id', 'um_usrtmmap_team_id']],
		'um_usrtmmap_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrtmmap_tenant_id', 'um_usrtmmap_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrtmmap_team_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrtmmap_tenant_id', 'um_usrtmmap_team_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\User\Teams',
			'foreign_columns' => ['um_team_tenant_id', 'um_team_id']
		],
		'um_usrtmmap_role_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrtmmap_tenant_id', 'um_usrtmmap_role_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\User\Team\Roles',
			'foreign_columns' => ['um_usrtmrol_tenant_id', 'um_usrtmrol_id']
		]
	];
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