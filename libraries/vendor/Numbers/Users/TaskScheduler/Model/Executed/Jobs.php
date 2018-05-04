<?php

namespace Numbers\Users\TaskScheduler\Model\Executed;
class Jobs extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TS';
	public $title = 'T/S Executed Jobs';
	public $name = 'ts_executed_jobs';
	public $pk = ['ts_execjb_tenant_id', 'ts_execjb_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'ts_execjb_';
	public $columns = [
		'ts_execjb_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'ts_execjb_id' => ['name' => 'Executed Job #', 'domain' => 'big_id_sequence'],
		'ts_execjb_job_id' => ['name' => 'Job #', 'domain' => 'group_id'],
		'ts_execjb_status' => ['name' => 'Status', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\TaskScheduler\Model\Executed\Statuses'],
		'ts_execjb_daemon_code' => ['name' => 'Daemon Code', 'domain' => 'type_code'],
		'ts_execjb_task_code' => ['name' => 'Task Code', 'domain' => 'group_code'],
		'ts_execjb_name' => ['name' => 'Name', 'domain' => 'name'],
		'ts_execjb_datetime' => ['name' => 'Execution Datetime', 'type' => 'timestamp', 'null' => true],
		'ts_execjb_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'ts_execjb_cron_expression' => ['name' => 'Cron (Minutes)', 'domain' => 'code'],
		'ts_execjb_timezone_code' => ['name' => 'Timezone', 'domain' => 'timezone_code', 'null' => true],
		'ts_execjb_parameters' => ['name' => 'Parameters', 'type' => 'json', 'null' => true],
		'ts_execjb_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ts_executed_jobs_pk' => ['type' => 'pk', 'columns' => ['ts_execjb_tenant_id', 'ts_execjb_id']],
		'ts_execjb_daemon_code_fk' => [
			'type' => 'fk',
			'columns' => ['ts_execjb_daemon_code'],
			'foreign_model' => '\Numbers\Users\TaskScheduler\Model\Daemons',
			'foreign_columns' => ['ts_daemon_code']
		],
		'ts_execjb_task_code_fk' => [
			'type' => 'fk',
			'columns' => ['ts_execjb_daemon_code'],
			'foreign_model' => '\Numbers\Users\TaskScheduler\Model\Daemons',
			'foreign_columns' => ['ts_daemon_code']
		],
		'ts_execjb_job_id_fk' => [
			'type' => 'fk',
			'columns' => ['ts_execjb_tenant_id', 'ts_execjb_job_id'],
			'foreign_model' => '\Numbers\Users\TaskScheduler\Model\Jobs',
			'foreign_columns' => ['ts_job_tenant_id', 'ts_job_id']
		],
		'ts_execjb_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['ts_execjb_tenant_id', 'ts_execjb_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'ts_execjb_timezone_code_fk' => [
			'type' => 'fk',
			'columns' => ['ts_execjb_tenant_id', 'ts_execjb_timezone_code'],
			'foreign_model' => '\Numbers\Internalization\Internalization\Model\Timezones',
			'foreign_columns' => ['in_timezone_tenant_id', 'in_timezone_code']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];
}