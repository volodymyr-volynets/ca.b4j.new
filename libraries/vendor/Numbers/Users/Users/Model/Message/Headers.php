<?php

namespace Numbers\Users\Users\Model\Message;
class Headers extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Message Headers';
	public $schema;
	public $name = 'um_message_headers';
	public $pk = ['um_mesheader_tenant_id', 'um_mesheader_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_mesheader_';
	public $columns = [
		'um_mesheader_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_mesheader_id' => ['name' => 'Message #', 'domain' => 'message_id_sequence'],
		'um_mesheader_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'default' => 10, 'options_model' => '\Numbers\Users\Users\Model\Message\HeaderTypes'],
		'um_mesheader_notification_code' => ['name' => 'Notification Code', 'domain' => 'feature_code', 'null' => true],
		'um_mesheader_important' => ['name' => 'Important', 'type' => 'boolean'],
		'um_mesheader_from_email' => ['name' => 'From Email', 'domain' => 'email', 'null' => true],
		'um_mesheader_from_name' => ['name' => 'From Name', 'domain' => 'name', 'null' => true],
		'um_mesheader_subject' => ['name' => 'Subject', 'type' => 'text', 'null' => true],
		'um_mesheader_body_id' => ['name' => 'Body #', 'domain' => 'message_id', 'null' => true],
		'um_mesheader_keywords' => ['name' => 'Keywords', 'type' => 'text', 'null' => true],
		'um_mesheader_chat_group_id' => ['name' => 'Group #', 'domain' => 'group_id', 'null' => true],
		'um_mesheader_chat_user_id' => ['name' => 'Chat User #', 'domain' => 'user_id', 'null' => true],
	];
	public $constraints = [
		'um_message_headers_pk' => ['type' => 'pk', 'columns' => ['um_mesheader_tenant_id', 'um_mesheader_id']],
		'um_mesheader_body_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_mesheader_tenant_id', 'um_mesheader_body_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Message\Bodies',
			'foreign_columns' => ['um_mesbody_tenant_id', 'um_mesbody_id']
		]
	];
	public $indexes = [
		'um_message_headers_fulltext_idx' => ['type' => 'fulltext', 'columns' => ['um_mesheader_keywords']]
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

	public $who = [
		'inserted' => true
	];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];
}