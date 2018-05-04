<?php

namespace Numbers\Users\Users\Model\Security;
class Questions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Security Questions';
	public $name = 'um_security_questions';
	public $pk = ['um_secquestion_id'];
	public $tenant;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_secquestion_';
	public $columns = [
		'um_secquestion_id' => ['name' => 'Security Question #', 'domain' => 'group_id_sequence'],
		'um_secquestion_name' => ['name' => 'Name', 'domain' => 'name'],
		'um_secquestion_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'um_security_questions_pk' => ['type' => 'pk', 'columns' => ['um_secquestion_id']],
	];
	public $indexes = [
		'um_security_questions_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_secquestion_name']]
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
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}