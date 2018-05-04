<?php

namespace Numbers\Users\Users\Model\User\Group;
class Map extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Group Map';
	public $name = 'um_user_group_map';
	public $pk = ['um_usrgrmap_tenant_id', 'um_usrgrmap_user_id', 'um_usrgrmap_group_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrgrmap_';
	public $columns = [
		'um_usrgrmap_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrgrmap_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrgrmap_group_id' => ['name' => 'Group #', 'domain' => 'group_id']
	];
	public $constraints = [
		'um_user_group_map_pk' => ['type' => 'pk', 'columns' => ['um_usrgrmap_tenant_id', 'um_usrgrmap_user_id', 'um_usrgrmap_group_id']],
		'um_usrgrmap_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrgrmap_tenant_id', 'um_usrgrmap_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrgrmap_group_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrgrmap_tenant_id', 'um_usrgrmap_group_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\User\Groups',
			'foreign_columns' => ['um_usrgrp_tenant_id', 'um_usrgrp_id']
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