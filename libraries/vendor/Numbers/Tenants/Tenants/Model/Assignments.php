<?php

namespace Numbers\Tenants\Tenants\Model;
class Assignments extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TM';
	public $title = 'T/M Assignments';
	public $name = 'tm_assignments';
	public $pk = ['tm_assignment_tenant_id' , 'tm_assignment_id'];
	public $tenant = true;
	public $module;
	public $orderby;
	public $limit;
	public $column_prefix = 'tm_assignment_';
	public $columns = [
		'tm_assignment_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'tm_assignment_id' => ['name' => 'Assignment #', 'domain' => 'assignment_id_sequence'],
		'tm_assignment_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'tm_assignment_name' => ['name' => 'Name', 'domain' => 'name'],
		'tm_assignment_bidirectional' => ['name' => 'Bidirectional', 'type' => 'boolean'],
		'tm_assignment_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'tm_assignments_pk' => ['type' => 'pk', 'columns' => ['tm_assignment_tenant_id', 'tm_assignment_id']],
		'tm_assignment_code_un' => ['type' => 'unique', 'columns' => ['tm_assignment_tenant_id', 'tm_assignment_code']],
	];
	public $indexes = [
		'tm_assignments_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['tm_assignment_code', 'tm_assignment_name']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [
		'tm_assignment_name' => 'name',
		'tm_assignment_code' => 'name',
		'tm_assignment_id' => 'name'
	];
	public $options_active = [
		'tm_assignment_inactive' => 0
	];
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