<?php

namespace Numbers\Users\Users\Model\Message;
class Bodies extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Message Bodies';
	public $schema;
	public $name = 'um_message_bodies';
	public $pk = ['um_mesbody_tenant_id', 'um_mesbody_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_mesbody_';
	public $columns = [
		'um_mesbody_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_mesbody_id' => ['name' => 'Message #', 'domain' => 'message_id_sequence'],
		'um_mesbody_type_id' => ['name' => 'Type #', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Users\Model\Message\BodyTypes'],
		'um_mesbody_body' => ['name' => 'Body', 'type' => 'text']
	];
	public $constraints = [
		'um_message_bodies_pk' => ['type' => 'pk', 'columns' => ['um_mesbody_tenant_id', 'um_mesbody_id']],
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

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}