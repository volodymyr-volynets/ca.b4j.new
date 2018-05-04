<?php

namespace Numbers\Users\Users\DataSource\User;
class Password extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['um_user_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row = true;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model;
	public $parameters = [
		'user_id' => ['name' => 'User #', 'domain' => 'user_id', 'required' => true],
	];

	public function query($parameters, $options = []) {
		// create a query object
		$this->query = \Numbers\Users\Users\Model\Users::queryBuilderStatic([
			'alias' => 'a',
			'skip_acl' => true
		])->select();
		// columns
		$this->query->columns([
			'a.um_user_id',
			'a.um_user_email',
			'a.um_user_login_username',
			'a.um_user_login_password',
			'a.um_user_login_last_set'
		]);
		// where
		$this->query->where('AND', ['a.um_user_login_enabled', '=', 1]);
		$this->query->where('AND', ['a.um_user_inactive', '=', 0]);
		$this->query->where('AND', ['a.um_user_id', '=', (int) $parameters['user_id']]);
	}
}