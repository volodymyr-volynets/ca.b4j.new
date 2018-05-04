<?php

namespace Numbers\Users\Organizations\Model\Service\ServiceScript\Question;
class Description extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Script Description';
	public $schema;
	public $name = 'on_service_script_question_descirption';
	public $pk = ['on_servquesdesc_tenant_id', 'on_servquesdesc_service_script_id', 'on_servquesdesc_question_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'on_servquesdesc_';
	public $columns = [
		'on_servquesdesc_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servquesdesc_service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id'],
		'on_servquesdesc_question_id' => ['name' => 'Question #', 'domain' => 'question_id'],
		'on_servquesdesc_description' => ['name' => 'Description', 'domain' => 'description'],
	];
	public $constraints = [
		'on_service_script_question_descirption_pk' => ['type' => 'pk', 'columns' => ['on_servquesdesc_tenant_id', 'on_servquesdesc_service_script_id', 'on_servquesdesc_question_id']],
		'on_servquesdesc_question_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servquesdesc_tenant_id', 'on_servquesdesc_service_script_id', 'on_servquesdesc_question_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'foreign_columns' => ['on_servquestion_tenant_id', 'on_servquestion_service_script_id', 'on_servquestion_id']
		]
	];
	public $indexes = [
		'on_service_script_question_descirption_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_servquesdesc_description']],
	];
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