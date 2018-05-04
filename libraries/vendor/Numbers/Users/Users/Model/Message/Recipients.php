<?php

namespace Numbers\Users\Users\Model\Message;
class Recipients extends \Object\Table {
	public $db_link;
	public $db_link_flag;
	public $module_code = 'UM';
	public $title = 'U/M Message Recipients';
	public $schema;
	public $name = 'um_message_recipients';
	public $pk = ['um_mesrecip_tenant_id', 'um_mesrecip_message_id', 'um_mesrecip_type_id', 'um_mesrecip_user_id'];
	public $tenant = true;
	public $orderby;
	public $limit;
	public $column_prefix = 'um_mesrecip_';
	public $columns = [
		'um_mesrecip_tenant_id' => ['name' => 'Tenant #', 'domain' => 'tenant_id'],
		'um_mesrecip_message_id' => ['name' => 'Message #', 'domain' => 'message_id'],
		'um_mesrecip_type_id' => ['name' => 'Type', 'domain' => 'type_id', 'options_model' => '\Numbers\Users\Users\Model\Message\RecipientTypes'],
		'um_mesrecip_user_id' => ['name' => 'User #', 'domain' => 'user_id'], // fk constraint purposely ommited to allow 0 for non user notifications
		'um_mesrecip_user_email' => ['name' => 'User Email', 'domain' => 'email', 'null' => true],
		'um_mesrecip_read' => ['name' => 'Read', 'type' => 'boolean'],
		'um_mesrecip_chat_group_id' => ['name' => 'Chat Group #', 'domain' => 'group_id', 'null' => true],
	];
	public $constraints = [
		'um_message_recipients_pk' => ['type' => 'pk', 'columns' => ['um_mesrecip_tenant_id', 'um_mesrecip_message_id', 'um_mesrecip_type_id', 'um_mesrecip_user_id']],
		'um_mesrecip_message_id_fk' => [
			'type' => 'fk',
			'columns' => ['um_mesrecip_tenant_id', 'um_mesrecip_message_id'],
			'foreign_model' => '\Numbers\Users\Users\Model\Message\Headers',
			'foreign_columns' => ['um_mesheader_tenant_id', 'um_mesheader_id']
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

	public $who = [];

	public $data_asset = [
		'classification' => 'client_confidential',
		'protection' => 2,
		'scope' => 'enterprise'
	];

	/**
	 * Mark message as read
	 *
	 * @param int $message_id
	 * @return array
	 */
	public function markAsRead(int $message_id, int $type_id, int $user_id) : array {
		return $this->collection()->merge([
			'um_mesrecip_message_id' => $message_id,
			'um_mesrecip_type_id' => $type_id,
			'um_mesrecip_user_id' => $user_id,
			'um_mesrecip_read' => 1
		]);
	}
}