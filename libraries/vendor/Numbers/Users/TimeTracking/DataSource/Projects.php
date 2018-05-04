<?php

namespace Numbers\Users\TimeTracking\DataSource;
class Projects extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['tt_project_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map = [];
	public $options_active =[];
	public $column_prefix = 'tt_project_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\TimeTracking\Model\Projects';
	public $parameters = [];

	public function query($parameters, $options = []) {
		$this->query->columns(['a.*']);
		$this->query->where('AND', ['a.tt_project_user_id', '=', \User::id()]);
	}
}