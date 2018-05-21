<?php

namespace Numbers\Users\Users\DataSource\ACL;
class Controllers extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['code'];
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

	public $primary_model = '\Numbers\Backend\System\Modules\Model\Resources';
	public $parameters = [
		'sm_resource_acl_permission' => ['name' => 'Acl Permission', 'type' => 'boolean'],
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'id' => 'a.sm_resource_id',
			'code' => 'a.sm_resource_code',
			'name' => 'a.sm_resource_name',
			'description' => 'a.sm_resource_description',
			'classification' => 'a.sm_resource_classification',
			'icon' => 'a.sm_resource_icon',
			'module_code' => 'a.sm_resource_module_code',
			'breadcrumbs' => "concat_ws('::', b.sm_module_name, a.sm_resource_group1_name, a.sm_resource_group2_name, sm_resource_group3_name, sm_resource_group4_name, sm_resource_group5_name, sm_resource_group6_name, sm_resource_group7_name, sm_resource_group8_name, sm_resource_group9_name)",
			'actions' => 'c.actions',
			'acl_public' => 'a.sm_resource_acl_public',
			'acl_authorized' => 'a.sm_resource_acl_authorized',
			'acl_permission' => 'a.sm_resource_acl_permission',
			'missing_features' => 'COALESCE(d.missing_features, 0)'
		]);
		// join
		$this->query->join('LEFT', new \Numbers\Backend\System\Modules\Model\Modules(), 'b', 'ON', [
			['AND', ['a.sm_resource_module_code', '=', 'b.sm_module_code', true], false]
		]);
		$this->query->join('LEFT', function (& $query) {
			// need to see if modules have not been activated
			$query = \Numbers\Backend\System\Modules\Model\Resource\Map::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.sm_rsrcmp_resource_id',
				'actions' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.sm_rsrcmp_method_code, inner_a.sm_rsrcmp_action_id, inner_b.sm_action_code)", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Backend\System\Modules\Model\Resource\Actions(), 'inner_b', 'ON', [
				['AND', ['inner_a.sm_rsrcmp_action_id', '=', 'inner_b.sm_action_id', true], false]
			]);
			$query->groupby(['sm_rsrcmp_resource_id']);
			$query->where('AND', ['inner_a.sm_rsrcmp_inactive', '=', 0]);
			$query->where('AND', ['inner_b.sm_action_inactive', '=', 0]);
		}, 'c', 'ON', [
			['AND', ['a.sm_resource_id', '=', 'c.sm_rsrcmp_resource_id', true], false]
		]);
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Backend\System\Modules\Model\Resource\Features::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'resource_id' => 'inner_a.sm_rsrcftr_resource_id',
				'missing_features' => 'SUM(CASE WHEN inner_b.tm_feature_feature_code IS NULL THEN 1 ELSE 0 END)'
			]);
			$query->join('LEFT', new \Numbers\Tenants\Tenants\Model\Module\Features(), 'inner_b', 'ON', [
				['AND', ['inner_b.tm_feature_feature_code', '=', 'inner_a.sm_rsrcftr_feature_code', true]]
			]);
			$query->groupby(['resource_id']);
		}, 'd', 'ON', [
			['AND', ['a.sm_resource_id', '=', 'd.resource_id', true], false]
		]);
		// where
		$this->query->where('AND', ['a.sm_resource_type', '=', 100]);
		$this->query->where('AND', ['a.sm_resource_inactive', '=', 0]);
		if (!empty($parameters)) {
			foreach ($parameters as $k => $v) {
				$this->query->where('AND', ["a.{$k}", '=', $v]);
			}
		}
		// limit by activated modules
		$this->query->where('AND', function (& $query) {
			$query->where('OR', ['a.sm_resource_module_code', 'IN', ['SM', 'TM']]);
			$query->where('OR', function (& $query) {
				$query = \Numbers\Tenants\Tenants\Model\Modules::queryBuilderStatic(['alias' => 'exists_a'])->select();
				$query->columns(['exists_a.tm_module_module_code']);
				$query->where('AND', ['exists_a.tm_module_module_code', '=', 'a.sm_resource_module_code', true]);
			}, 'EXISTS');
		});
	}

	public function process($data, $options = []) {
		foreach ($data as $k => $v) {
			$data[$k]['breadcrumbs'] = explode('::', $v['breadcrumbs']);
			$data[$k]['actions'] = [];
			if (!empty($v['actions'])) {
				$actions = explode(';;', $v['actions']);
				foreach ($actions as $v2) {
					$temp = explode('::', $v2);
					$data[$k]['actions'][$temp[0]][(int) $temp[1]] = $temp[2];
				}
			}
			// unset codes
			unset($data[$k]['code']);
		}
		return $data;
	}
}