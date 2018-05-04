<?php

namespace Numbers\Users\TaskScheduler\Model;
class JobParameters extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TS';
	public $title = 'T/S Job Parameters';
	public $name = 'ts_job_parameters';
	public $pk = ['ts_jbparam_tenant_id', 'ts_jbparam_job_id', 'ts_jbparam_name'];
	public $tenant;
	public $orderby;
	public $limit;
	public $column_prefix = 'ts_jbparam_';
	public $columns = [
		'ts_jbparam_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ts_jbparam_job_id' => ['name' => 'Job #', 'domain' => 'group_id_sequence'],
		'ts_jbparam_name' => ['name' => 'Name', 'domain' => 'name'],
		'ts_jbparam_value' => ['name' => 'Value', 'type' => 'text', 'null' => true]
	];
	public $constraints = [
		'ts_job_parameters_pk' => ['type' => 'pk', 'columns' => ['ts_jbparam_tenant_id', 'ts_jbparam_job_id', 'ts_jbparam_name']],
		'ts_jbparam_job_id_fk' => [
			'type' => 'fk',
			'columns' => ['ts_jbparam_tenant_id', 'ts_jbparam_job_id'],
			'foreign_model' => '\Numbers\Users\TaskScheduler\Model\Jobs',
			'foreign_columns' => ['ts_job_tenant_id', 'ts_job_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map;
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}