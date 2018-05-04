<?php

namespace Numbers\Tenants\Widgets\Attributes\DataSource;
class Models extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['sm_model_id'];
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

	public $primary_model = '\Numbers\Backend\Db\Common\Model\Models';
	public $parameters = [];

	public function query($parameters, $options = []) {
		// where
		$this->query->where('AND', ['a.sm_model_widget_attributes', '=', 1]);
		$this->query->where('AND', ['a.sm_model_inactive', '=', 0]);
	}

	/**
	 * @see $this->options();
	 */
	public function optionsJson(array $options = []) : array {
		// load and process modules
		$temp = \Numbers\Tenants\Tenants\Model\Modules::getStatic([
			'pk' => ['tm_module_id'],
			'where' => [
				'tm_module_inactive' => 0
			]
		]);
		$modules = [];
		foreach ($temp as $k => $v) {
			$modules[$v['tm_module_module_code']][$k] = $v;
		}
		$sm = \Numbers\Backend\System\Modules\Model\Modules::getStatic();
		// load controllers
		$data = $this->get($options);
		$result = [];
		foreach ($data as $k => $v) {
			if (empty($modules[$v['sm_model_module_code']])) continue;
			foreach ($modules[$v['sm_model_module_code']] as $k2 => $v2) {
				$key = \Object\Table\Options::optionJsonFormatKey(['module_id' => $k2, 'model_id' => $k]);
				// filter
				if (!\Object\Table\Options::processOptionsExistingValuesAndSkipValues($key, $options['existing_values'] ?? null, $options['skip_values'] ?? null)) continue;
				// parent
				$parent = \Object\Table\Options::optionJsonFormatKey(['module_id' => $k2]);
				// add parent
				if (!isset($result[$parent])) {
					$result[$parent] = [
						'name' => $v2['tm_module_name'],
						'icon_class' => \HTML::icon(['type' => $sm[$v['sm_model_module_code']]['sm_module_icon'], 'class_only' => true]),
						'parent' => null,
						'disabled' => true
					];
				}
				// add item
				$result[$key] = [
					'name' => $v['sm_model_name'],
					'__selected_name' => i18n(null, $v2['tm_module_name']) . ': ' . i18n(null, $v['sm_model_name']),
					'parent' => $parent
				];
			}
		}
		if (!empty($result)) {
			$converted = \Helper\Tree::convertByParent($result, 'parent');
			$result = [];
			\Helper\Tree::convertTreeToOptionsMulti($converted, 0, ['name_field' => 'name'], $result);
		}
		return $result;
	}
}