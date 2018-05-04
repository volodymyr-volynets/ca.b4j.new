<?php

namespace Numbers\Users\Organizations\Model\Service\Channel;
class Map extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Channel Map';
	public $name = 'on_service_channel_map';
	public $pk = ['on_servmap_tenant_id', 'on_servmap_service_id', 'on_servmap_channel_id'];
	public $tenant = true;
	public $orderby = [
		'on_servmap_timestamp' => SORT_ASC
	];
	public $limit;
	public $column_prefix = 'on_servmap_';
	public $columns = [
		'on_servmap_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servmap_timestamp' => ['name' => 'Timestamp', 'domain' => 'timestamp_now'],
		'on_servmap_service_id' => ['name' => 'Service #', 'domain' => 'service_id'],
		'on_servmap_channel_id' => ['name' => 'Channel #', 'domain' => 'channel_id'],
		'on_servmap_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_service_channel_map_pk' => ['type' => 'pk', 'columns' => ['on_servmap_tenant_id', 'on_servmap_service_id', 'on_servmap_channel_id']],
		'on_servmap_service_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servmap_tenant_id', 'on_servmap_service_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Services',
			'foreign_columns' => ['on_service_tenant_id', 'on_service_id']
		],
		'on_servmap_channel_id_fk' => [
			'type' => 'fk',
			'columns' => ['on_servmap_tenant_id', 'on_servmap_channel_id'],
			'foreign_model' => '\Numbers\Users\Organizations\Model\Service\Channels',
			'foreign_columns' => ['on_servchannel_tenant_id', 'on_servchannel_id']
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