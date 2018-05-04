<?php

namespace Numbers\Tenants\Tenants\DataSource\Activation\Feature;
class Modules extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['tm_module_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'tm_module_name' => 'name',
		'sm_module_icon' => 'icon_class'
	];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Tenants\Tenants\Model\Modules';
	public $parameters = [];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'tm_module_id' => 'a.tm_module_id',
			'tm_module_name' => 'a.tm_module_name',
			'sm_module_icon' => 'b.sm_module_icon'
		]);
		$this->query->join('INNER', new \Numbers\Backend\System\Modules\Model\Modules(), 'b', 'ON', [
			['AND', ['a.tm_module_module_code', '=', 'b.sm_module_code', true], false],
		]);
	}
}