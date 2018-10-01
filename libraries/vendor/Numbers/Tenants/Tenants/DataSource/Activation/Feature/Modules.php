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
	public $parameters = [
		'flag_have_reset_model' => ['name' => 'Flag have reset model', 'type' => 'boolean'],
		'tm_module_id' => ['name' => 'Module #', 'domain' => 'module_id']
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'tm_module_id' => 'a.tm_module_id',
			'tm_module_name' => 'a.tm_module_name',
			'sm_module_icon' => 'b.sm_module_icon',
			'sm_module_code' => 'b.sm_module_code',
			'sm_module_activation_model' => 'b.sm_module_activation_model',
			'sm_module_reset_model' => 'b.sm_module_reset_model',
		]);
		$this->query->join('INNER', new \Numbers\Backend\System\Modules\Model\Modules(), 'b', 'ON', [
			['AND', ['a.tm_module_module_code', '=', 'b.sm_module_code', true], false],
		]);
		if (!empty($parameters['flag_have_reset_model'])) {
			$this->query->where('AND', ['b.sm_module_reset_model', 'IS NOT', null]);
		}
		if (!empty($parameters['tm_module_id'])) {
			$this->query->where('AND', ['a.tm_module_id', '=', $parameters['tm_module_id']]);
		}
	}
}