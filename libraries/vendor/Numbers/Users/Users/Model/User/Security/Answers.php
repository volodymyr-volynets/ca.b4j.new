<?php

namespace Numbers\Users\Users\Model\User\Security;
class Answers extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M User Security Answers';
	public $name = 'um_user_security_answers';
	public $pk = ['um_usrsecanswer_tenant_id', 'um_usrsecanswer_user_id', 'um_usrsecanswer_question_id'];
	public $tenant = true;
	public $orderby = [
		'um_usrsecanswer_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'um_usrsecanswer_';
	public $columns = [
		'um_usrsecanswer_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_usrsecanswer_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'um_usrsecanswer_user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'um_usrsecanswer_question_id' => ['name' => 'Question #', 'domain' => 'group_id'],
		'um_usrsecanswer_answer' => ['name' => 'Answer', 'type' => 'text'],
	];
	public $constraints = [
		'um_user_security_answers_pk' => ['type' => 'pk', 'columns' => ['um_usrsecanswer_tenant_id', 'um_usrsecanswer_user_id', 'um_usrsecanswer_question_id']],
		'um_usrsecanswer_user_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrsecanswer_tenant_id', 'um_usrsecanswer_user_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Users',
			'foreign_columns' => ['um_user_tenant_id', 'um_user_id']
		],
		'um_usrsecanswer_question_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_usrsecanswer_question_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Security\Questions',
			'foreign_columns' => ['um_secquestion_id']
		]
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
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