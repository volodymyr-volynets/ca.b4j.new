<?php

namespace Numbers\Users\TaskScheduler\Model;
class Daemons extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'TS';
	public $title = 'T/S Daemons';
	public $name = 'ts_daemons';
	public $pk = ['ts_daemon_code'];
	public $tenant;
	public $orderby;
	public $limit;
	public $column_prefix = 'ts_daemon_';
	public $columns = [
		'ts_daemon_code' => ['name' => 'Code', 'domain' => 'type_code'],
		'ts_daemon_name' => ['name' => 'Name', 'domain' => 'name'],
		'ts_daemon_token' => ['name' => 'Token', 'domain' => 'token', 'null' => true],
		'ts_daemon_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'ts_daemons_pk' => ['type' => 'pk', 'columns' => ['ts_daemon_code']],
	];
	public $indexes = [
		'ts_daemons_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['ts_daemon_name', 'ts_daemon_code']]
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [
		'ts_daemon_name' => 'name'
	];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $data_asset = [
		'classification' => 'proprietary',
		'protection' => 1,
		'scope' => 'global'
	];

	/**
	 * Check if valid daemon token
	 *
	 * @param string $daemon_code
	 * @param string $daemon_token
	 * @return bool
	 */
	public static function checkIfValidDaemonToken(string $daemon_code, string $daemon_token) : bool {
		$model = new \Numbers\Users\TaskScheduler\Model\Daemons();
		$result = $model->get([
			'where' => [
				'ts_daemon_code' => $daemon_code,
				'ts_daemon_token' => $daemon_token
			]
		]);
		return !empty($result);
	}
}