<?php

namespace Numbers\Users\Users\Model\Message\Sender;
class Common extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Message Sender Common';
	public $schema;
	public $name = 'um_message_sender_common';
	public $pk = ['um_sendercmn_tenant_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_sendercmn_';
	public $columns = [
		'um_sendercmn_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_sendercmn_from_email' => ['name' => 'From Email', 'domain' => 'email'],
		'um_sendercmn_from_name' => ['name' => 'From Name', 'domain' => 'name'],
	];
	public $constraints = [
		'um_message_sender_common_pk' => ['type' => 'pk', 'columns' => ['um_sendercmn_tenant_id']],
	];
	public $indexes = [];
	public $history = false;
	public $audit = false;
	public $optimistic_lock = true;
	public $options_map = [];
	public $options_active = [];
	public $engine = [
		'MySQLi' => 'InnoDB'
	];

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}