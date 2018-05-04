<?php

namespace Numbers\Users\Users\Model\User;
class Types extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Types';
	public $name = 'um_user_types';
	public $pk = ['um_usrtype_id'];
	public $orderby;
	public $limit;
	public $column_prefix = 'um_usrtype_';
	public $columns = [
		'um_usrtype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_usrtype_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_usrtype_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_types_pk' => ['type' => 'pk', 'columns' => ['um_usrtype_id']]
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

	public $relation = [
		'field' => 'um_usrtype_id',
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}