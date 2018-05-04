<?php

namespace Numbers\Users\Users\Model\Role;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Role Types';
	public $name = 'um_role_types';
	public $pk = ['um_roltype_id'];
	public $orderby;
	public $limit;
	public $column_prefix = 'um_roltype_';
	public $columns = [
		'um_roltype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_roltype_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_roltype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_role_types_pk' => ['type' => 'pk', 'columns' => ['um_roltype_id']]
	];
	public $history = false;
	public $audit = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 2,
		'scope' => 'global'
	];
}