<?php

namespace Numbers\Users\Users\Model\User;
class Titles extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Titles';
	public $name = 'um_user_titles';
	public $pk = ['um_usrtitle_tenant_id', 'um_usrtitle_name'];
	public $tenant = true;
	public $orderby = [
		'um_usrtitle_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrtitle_';
	public $columns = [
		'um_usrtitle_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrtitle_name' => ['name' => 'Name', 'domain' => 'personal_title'],
		'um_usrtitle_order' => ['name' => 'Order', 'domain' => 'order'],
		'um_usrtitle_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_user_titles_pk' => ['type' => 'pk', 'columns' => ['um_usrtitle_tenant_id', 'um_usrtitle_name']]
	];
	public $indexes = [
		'um_user_titles_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_usrtitle_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [];
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