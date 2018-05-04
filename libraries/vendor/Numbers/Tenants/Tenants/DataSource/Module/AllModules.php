<?php

namespace Numbers\Tenants\Tenants\DataSource\Module;
class AllModules extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'name' => 'name'
	];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Tenants\Tenants\Model\Modules';
	public $parameters = [];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'id' => 'a.tm_module_id',
			'name' => 'a.tm_module_name',
			'module_code' => 'a.tm_module_module_code',
			'module_multiple' => 'b.sm_module_multiple',
			'features' => 'c.features'
		]);
		// join
		$this->query->join('INNER', new \Numbers\Backend\System\Modules\Model\Modules(), 'b', 'ON', [
			['AND', ['b.sm_module_code', '=', 'a.tm_module_module_code', true], false],
		]);
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Tenants\Tenants\Model\Module\Features::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.tm_feature_module_id',
				'features' => $query->db_object->sqlHelper('string_agg', ['expression' => "inner_a.tm_feature_feature_code", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Backend\System\Modules\Model\Module\Features(), 'inner_c', 'ON', [
				['AND', ['inner_a.tm_feature_feature_code', '=', 'inner_c.sm_feature_code', true], false]
			]);
			// where
			$query->where('AND', ['inner_a.tm_feature_inactive', '=', 0]);
			$query->where('AND', ['inner_c.sm_feature_inactive', '=', 0]);
			// group by
			$query->groupby(['inner_a.tm_feature_module_id']);
		}, 'c', 'ON', [
			['AND', ['a.tm_module_id', '=', 'c.tm_feature_module_id', true], false]
		]);
		// where
		$this->query->where('AND', ['a.tm_module_inactive', '=', 0]);
		$this->query->where('AND', ['b.sm_module_inactive', '=', 0]);
	}

	public function process($data, $options = []) {
		foreach ($data as $k => $v) {
			// roles
			if (!empty($v['features'])) {
				$data[$k]['features'] = explode(';;', $v['features']);
			} else {
				$data[$k]['features'] = [];
			}
		}
		return $data;
	}
}