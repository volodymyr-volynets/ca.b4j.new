<?php

namespace Numbers\Users\Monitoring\Model;
class Usages extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'SM';
	public $title = 'S/M Monitoring Usages';
	public $name = 'sm_monitoring_usages';
	public $pk = ['sm_monusage_tenant_id', 'sm_monusage_session_id', 'sm_monusage_timestamp'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'sm_monusage_';
	public $columns = [
		'sm_monusage_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'sm_monusage_session_id' => ['name' => 'Session #', 'type' => 'bigint'],
		'sm_monusage_timestamp' => ['name' => 'Timestamp', 'type' => 'timestamp'],
		'sm_monusage_user_id' => ['name' => 'User #', 'domain' => 'user_id', 'null' => true],
		'sm_monusage_user_ip' => ['name' => 'User IP', 'domain' => 'ip'],
		'sm_monusage_resource_id' => ['name' => 'Resource #', 'domain' => 'resource_id', 'null' => true],
		'sm_monusage_resource_name' => ['name' => 'Resource Name', 'domain' => 'name', 'null' => true],
		'sm_monusage_duration' => ['name' => 'Duration (Seconds)', 'domain' => 'quantity'],
		'sm_monusage_actions' => ['name' => 'Actions', 'type' => 'json'] // array of actions in json format
	];
	public $constraints = [
		'sm_monitoring_usages_pk' => ['type' => 'pk', 'columns' => ['sm_monusage_tenant_id', 'sm_monusage_session_id', 'sm_monusage_timestamp']],
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