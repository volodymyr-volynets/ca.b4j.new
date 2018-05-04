<?php

namespace Numbers\Users\Organizations\Model\Service\ServiceScript\Question;
class Answers extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Script Answers';
	public $schema;
	public $name = 'on_service_script_question_answers';
	public $pk = ['on_servquesanswer_tenant_id', 'on_servquesanswer_service_script_id', 'on_servquesanswer_question_id', 'on_servquesanswer_name'];
	public $tenant = true;
	public $orderby = [
		'on_servquesanswer_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_servquesanswer_';
	public $columns = [
		'on_servquesanswer_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servquesanswer_service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id'],
		'on_servquesanswer_question_id' => ['name' => 'Question #', 'domain' => 'question_id'],
		'on_servquesanswer_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_servquesanswer_name' => ['name' => 'Name', 'domain' => 'name'],
	];
	public $constraints = [
		'on_service_script_question_answers_pk' => ['type' => 'pk', 'columns' => ['on_servquesanswer_tenant_id', 'on_servquesanswer_service_script_id', 'on_servquesanswer_question_id', 'on_servquesanswer_name']],
		'on_servquesanswer_question_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servquesanswer_tenant_id', 'on_servquesanswer_service_script_id', 'on_servquesanswer_question_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'foreign_columns' => ['on_servquestion_tenant_id', 'on_servquestion_service_script_id', 'on_servquestion_id']
		]
	];
	public $indexes = [
		'on_service_script_question_answers_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_servquesanswer_name']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'on_servquesanswer_name' => 'name'
	];
	public $options_active = [
		'on_servquesanswer_inactive' => 0
	];
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