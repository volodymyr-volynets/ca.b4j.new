<?php

namespace Numbers\Tenants\Tenants\DataSource\Activation\Feature;
class Features extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['sm_feature_code'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'sm_feature_name' => 'name',
		'sm_feature_icon' => 'icon_class'
	];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Backend\System\Modules\Model\Module\Features';
	public $parameters = [
		'tm_feature_module_id' => ['name' => 'Module #', 'domain' => 'module_id', 'required' => true],
		'flag_have_reset_model' => ['name' => 'Flag have reset model', 'type' => 'boolean'],
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'sm_feature_code' => 'a.sm_feature_code',
			'sm_feature_name' => 'a.sm_feature_name',
			'sm_feature_icon' => 'a.sm_feature_icon',
			'sm_feature_activation_model' => 'a.sm_feature_activation_model'
		]);
		// join
		$this->query->join('INNER', new \Numbers\Tenants\Tenants\Model\Modules(), 'b', 'ON', [
			['AND', ['a.sm_feature_module_code', '=', 'b.tm_module_module_code', true], false],
			['AND', ['b.tm_module_id', '=', $parameters['tm_feature_module_id'], false], false]
		]);
		$this->query->join('LEFT', new \Numbers\Tenants\Tenants\Model\Module\Features(), 'c', 'ON', [
			['AND', ['c.tm_feature_module_id', '=', $parameters['tm_feature_module_id'], false], false],
			['AND', ['c.tm_feature_feature_code', '=', 'a.sm_feature_code', true], false],
		]);
		// where
		$this->query->where('AND', ['a.sm_feature_inactive', '=', 0]);
		if (!empty($parameters['flag_have_reset_model'])) {
			$this->query->where('AND', ['a.sm_feature_reset_model', 'IS NOT', null]);
		} else {
			$this->query->where('AND', function(& $query) {
				$query->where('OR', ['c.tm_feature_feature_code', 'IS', null]);
				$query->where('OR', ['a.sm_feature_type', '=', 30]);
			});
		}
	}
}