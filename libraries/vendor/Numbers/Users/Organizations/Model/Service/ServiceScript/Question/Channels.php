<?php

namespace Numbers\Users\Organizations\Model\Service\ServiceScript\Question;
class Channels extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Script Channels';
	public $schema;
	public $name = 'on_service_script_question_channels';
	public $pk = ['on_servqueschan_tenant_id', 'on_servqueschan_service_script_id', 'on_servqueschan_question_id', 'on_servqueschan_channel_id'];
	public $tenant = true;
	public $orderby = [
		'on_servqueschan_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_servqueschan_';
	public $columns = [
		'on_servqueschan_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servqueschan_service_script_id' => ['name' => 'Service Script #', 'domain' => 'service_script_id'],
		'on_servqueschan_question_id' => ['name' => 'Question #', 'domain' => 'question_id'],
		'on_servqueschan_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_servqueschan_channel_id' => ['name' => 'Channel #', 'domain' => 'channel_id'],
		'on_servqueschan_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_service_script_question_channels_pk' => ['type' => 'pk', 'columns' => ['on_servqueschan_tenant_id', 'on_servqueschan_service_script_id', 'on_servqueschan_question_id', 'on_servqueschan_channel_id']],
		'on_servqueschan_question_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servqueschan_tenant_id', 'on_servqueschan_service_script_id', 'on_servqueschan_question_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\ServiceScript\Questions',
			'foreign_columns' => ['on_servquestion_tenant_id', 'on_servquestion_service_script_id', 'on_servquestion_id']
		],
		'on_servqueschan_channel_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servqueschan_tenant_id', 'on_servqueschan_channel_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Channels',
			'foreign_columns' => ['on_servchannel_tenant_id', 'on_servchannel_id']
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