<?php

namespace Numbers\Users\Chat\Model;
class Groups extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'CT';
	public $title = 'C/T Groups';
	public $schema;
	public $name = 'ct_groups';
	public $pk = ['ct_group_tenant_id', 'ct_group_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ct_group_';
	public $columns = [
		'ct_group_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ct_group_id' => ['name' => 'Group #', 'domain' => 'group_id_sequence'],
		'ct_group_owner_user_id' => ['name' => 'Owner User #', 'domain' => 'user_id'],
		'ct_group_name' => ['name' => 'Name', 'domain' => 'name', 'null' => true],
		'ct_group_important' => ['name' => 'Important', 'type' => 'boolean'],
	];
	public $constraints = [
		'ct_groups_pk' => ['type' => 'pk', 'columns' => ['ct_group_tenant_id', 'ct_group_id']],
		'ct_group_owner_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ct_group_tenant_id', 'ct_group_owner_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		]
	];
	public $indexes = [
		'ct_groups_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ct_group_name']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'ct_group_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}