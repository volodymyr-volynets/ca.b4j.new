<?php

namespace Numbers\Users\Users\DataSource\ACL\Form;
class Overrides extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['field_code'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = true;

	public $primary_model = '\Numbers\Users\Users\Model\Form\Overrides';
	public $parameters = [
		'form_model' => ['name' => 'Form Model', 'domain' => 'code', 'required' => true],
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'field_code' => 'a.um_formoverride_form_field_code',
			'action' => 'MAX(a.um_formoverride_action)'
		]);
		// where
		$this->query->where('AND', function (& $query) {
			$query->where('OR', ['a.um_formoverride_role_id', '=', \User::get('role_ids')]);
			$query->where('OR', function (& $query) {
				$query->where('AND', ['a.um_formoverride_role_weight', 'IS NOT', null]);
				$query->where('AND', ['a.um_formoverride_role_weight', '>=', \User::get('maximum_role_weight')]);
			});
			$query->where('OR', 'FALSE');
		});
		$module_id = isset(\Application::$controller) ? \Application::$controller->module_id : 0;
		$this->query->where('AND', ['a.um_formoverride_module_id', '=', $module_id]);
		$this->query->where('AND', ['a.um_formoverride_inactive', '=', 0]);
		$this->query->where('AND', ['a.um_formoverride_form_code', '=', $parameters['form_model']]);
		$this->query->groupby(['field_code']);
	}
}