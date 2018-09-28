<?php

namespace Numbers\Backend\ABAC\DataSource;
class AttributesWithModels extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['sm_abacattr_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Backend\ABAC\Model\Attributes';
	public $parameters = [];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
		    'a.*',
		    'b.*'
		]);
		// join
		$this->query->join('LEFT', new \Numbers\Backend\Db\Common\Model\Models(), 'b', 'ON', [
			['AND', ['a.sm_abacattr_model_id', '=', 'b.sm_model_id', true], false]
		]);
		// where
		$this->query->where('AND', ['a.sm_abacattr_inactive', '=', 0]);
		$this->query->where('AND', ['b.sm_model_inactive', '=', 0]);
	}
}