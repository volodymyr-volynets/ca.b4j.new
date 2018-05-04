<?php

namespace Numbers\Users\Users\DataSource;
class Messages extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['message_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $options_active =[];
	public $column_prefix = '';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Users\Model\Message\Recipients';
	public $parameters = [
		'user_id' => ['name' => 'User #', 'domain' => 'user_id'],
		'message_id' => ['name' => 'Message #', 'domain' => 'message_id'],
		'chat_group_id' => ['name' => 'Chat Group #', 'domain' => 'group_id', 'multiple_column' => 1],
		'chat_unread' => ['name' => 'Chat Unread', 'type' => 'boolean'],
		'chat_by_group' => ['name' => 'Chat By Group', 'type' => 'boolean'],
	];

	public function query($parameters, $options = []) {
		if (empty($parameters['user_id'])) {
			$parameters['user_id'] = \User::id();
		}
		// columns
		$this->query->columns([
			'message_id' => 'a.um_mesrecip_message_id',
			'timestamp' => 'b.um_mesheader_inserted_timestamp',
			'read' => 'a.um_mesrecip_read',
			'subject' => 'b.um_mesheader_subject',
			'to_user_id' => 'a.um_mesrecip_user_id',
			'to_name' => 'd.um_user_name',
			'to_email' => 'a.um_mesrecip_user_email',
			'to_photo_file_id' => 'd.um_user_photo_file_id',
			'to_type_id' => 'a.um_mesrecip_type_id',
			'from_name' => 'b.um_mesheader_from_name',
			'from_email' => 'b.um_mesheader_from_email',
			'important' => 'b.um_mesheader_important',
			'body' => 'c.um_mesbody_body',
			'keywords' => 'b.um_mesheader_keywords',
			'chat_group_id' => 'b.um_mesheader_chat_group_id',
			'chat_user_id' => 'b.um_mesheader_chat_user_id',
			'chat_user_photo_file_id' => 'e.um_user_photo_file_id',
			'type' => 'b.um_mesheader_type_id'
		]);
		// joins
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\Message\Headers(), 'b', 'ON', [
			['AND', ['a.um_mesrecip_message_id', '=', 'b.um_mesheader_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\Message\Bodies(), 'c', 'ON', [
			['AND', ['b.um_mesheader_body_id', '=', 'c.um_mesbody_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\Users(), 'd', 'ON', [
			['AND', ['a.um_mesrecip_user_id', '=', 'd.um_user_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\Users(), 'd', 'ON', [
			['AND', ['a.um_mesrecip_user_id', '=', 'd.um_user_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\Users(), 'e', 'ON', [
			['AND', ['b.um_mesheader_chat_user_id', '=', 'e.um_user_id', true], false]
		]);
		// by group
		if (!empty($parameters['chat_by_group'])) {
			$this->query->join('INNER', function (& $query) use ($parameters) {
				$query = \Numbers\Users\Users\Model\Message\Recipients::queryBuilderStatic(['alias' => 'inner_a'])->select();
				$query->columns([
					'inner_a.um_mesrecip_chat_group_id',
					'last_message' => 'MAX(inner_a.um_mesrecip_message_id)'
				]);
				$query->groupby(['inner_a.um_mesrecip_chat_group_id']);
				//$query->where('AND', ['inner_a.um_mesrecip_user_id', '=', $parameters['user_id']]);
			}, 'f', 'ON', [
				['AND', ['a.um_mesrecip_chat_group_id', '=', 'f.um_mesrecip_chat_group_id', true], false],
				['AND', ['a.um_mesrecip_message_id', '=', 'f.last_message', true], false]
			]);
		}
		// where
		$this->query->where('AND', ['a.um_mesrecip_user_id', '=', $parameters['user_id']]);
		if (!empty($parameters['message_id'])) {
			$this->query->where('AND', ['a.um_mesrecip_message_id', '=', $parameters['message_id']]);
		}
		if (!empty($parameters['chat_group_id'])) {
			$this->query->where('AND', ['b.um_mesheader_chat_group_id', '=', $parameters['chat_group_id']]);
		}
		if (!empty($parameters['chat_unread'])) {
			$this->query->where('AND', function (& $query) {
				$query->where('OR', ['a.um_mesrecip_read', '=', 0, false]);
				$query->where('OR', ['CURRENT_DATE - ' . $query->db_object->cast('b.um_mesheader_inserted_timestamp', 'date'), '<', 3, false]);
			});
		}
		$this->query->orderby(['timestamp' => SORT_ASC]);
	}
}