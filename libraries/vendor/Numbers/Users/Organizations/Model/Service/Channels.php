<?php

namespace Numbers\Users\Organizations\Model\Service;
class Channels extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'ON';
	public $title = 'O/N Service Channels';
	public $name = 'on_service_channels';
	public $pk = ['on_servchannel_tenant_id', 'on_servchannel_id'];
	public $tenant = true;
	public $orderby = [];
	public $limit;
	public $column_prefix = 'on_servchannel_';
	public $columns = [
		'on_servchannel_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'on_servchannel_id' => ['name' => 'Channel #', 'domain' => 'channel_id_sequence'],
		'on_servchannel_code' => ['name' => 'Code', 'domain' => 'group_code'],
		'on_servchannel_name' => ['name' => 'Name', 'domain' => 'name'],
		'on_servchannel_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Organizations\Model\Service\Types'],
		'on_servchannel_icon' => ['name' => 'Icon', 'domain' => 'icon', 'null' => true],
		'on_servchannel_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
	];
	public $constraints = [
		'on_service_channels_pk' => ['type' => 'pk', 'columns' => ['on_servchannel_tenant_id', 'on_servchannel_id']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = [
		'map' => [
			'on_servchannel_tenant_id' => 'wg_audit_tenant_id',
			'on_servchannel_id' => 'wg_audit_channel_id'
		]
	];
	public $optimistic_lock = true;
	public $options_map = [
		'on_servchannel_name' => 'name',
		'on_servchannel_icon' => 'icon_class'
	];
	public $options_active = [
		'on_servchannel_inactive' => 0
	];
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