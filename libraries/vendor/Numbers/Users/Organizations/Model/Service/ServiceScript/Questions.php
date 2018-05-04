<?php

namespace Numbers\Users\Organizations\Model\Service\ServiceScript;
class Questions extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Script Questions';
	public $schema;
	public $name = 'on_service_script_questions';
	public $pk = ['on_servquestion_tenant_id', 'on_servquestion_service_script_id', 'on_servquestion_id'];
	public $tenant = true;
	public $orderby = [
		'on_servquestion_order' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_servquestion_';
	public $columns = [
		'on_servquestion_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servquestion_service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id'],
		'on_servquestion_id' => ['name' => 'Question #', 'domain' => 'question_id'],
		'on_servquestion_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_servquestion_order' => ['name' => 'Order', 'domain' => 'order'],
		'on_servquestion_type_code' => ['name' => 'Type', 'domain' => 'type_code', 'options_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Question\Types'],
		'on_servquestion_model_id' => ['name' => 'Model #', 'domain' => 'group_id', 'null' => true],
		'on_servquestion_required' => ['name' => 'Required', 'type' => 'boolean'],
		'on_servquestion_all_regions' => ['name' => 'All Regions', 'type' => 'boolean'],
		'on_servquestion_all_channels' => ['name' => 'All Channels', 'type' => 'boolean'],
		'on_servquestion_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_service_script_questions_pk' => ['type' => 'pk', 'columns' => ['on_servquestion_tenant_id', 'on_servquestion_service_script_id', 'on_servquestion_id']],
		'on_servquestion_service_script_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servquestion_tenant_id', 'on_servquestion_service_script_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScripts',
			'foreign_columns' => ['on_servscript_tenant_id', 'on_servscript_id']
		]
	];
	public $indexes = [
		'on_service_script_questions_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['on_servquestion_name']],
	];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = false;
	public $options_map = [
		'on_servquestion_name' => 'name'
	];
	public $options_active = [
		'on_servquestion_inactive' => 0
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