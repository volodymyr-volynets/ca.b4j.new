<?php

namespace Numbers\Users\Monitoring\Model\Usage;
class Actions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'SM';
	public $title = 'S/M Monitoring Usage Actions';
	public $name = 'sm_monitoring_usage_actions';
	public $pk = ['sm_monusgact_tenant_id', 'sm_monusgact_usage_id', 'sm_monusgact_action_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'sm_monusgact_';
	public $columns = [
		'sm_monusgact_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'sm_monusgact_usage_id' => ['name' => 'Usage #', 'type' => 'bigint'],
		'sm_monusgact_action_id' => ['name' => 'Action #', 'type' => 'smallint'],
		'sm_monusgact_usage_code' => ['name' => 'Usage Code', 'type' => 'varchar', 'length' => 100],
		'sm_monusgact_message' => ['name' => 'Message', 'type' => 'text'],
		'sm_monusgact_replace' => ['name' => 'Replace', 'type' => 'json', 'null' => true],
		'sm_monusgact_affected_rows' => ['name' => 'Affected rows', 'domain' => 'counter', 'default' => 0],
		'sm_monusgact_error_rows' => ['name' => 'Error rows', 'domain' => 'counter', 'default' => 0],
		'sm_monusgact_url' => ['name' => 'URL', 'type' => 'text', 'null' => true],
		'sm_monusgact_history' => ['name' => 'History', 'type' => 'boolean'],
	];
	public $constraints = [
		'sm_monitoring_usage_actions_pk' => ['type' => 'pk', 'columns' => ['sm_monusgact_tenant_id', 'sm_monusgact_usage_id', 'sm_monusgact_action_id']],
		'sm_monusgact_usage_id_fk' => [
			'type' => 'fk',
			'columns' => ['sm_monusgact_tenant_id', 'sm_monusgact_usage_id'],
			'foreign_model' => '\Numbers\Users\Monitoring\Model\Usages',
			'foreign_columns' => ['sm_monusage_tenant_id', 'sm_monusage_id']
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

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}