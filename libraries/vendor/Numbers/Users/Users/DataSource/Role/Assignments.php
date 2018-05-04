<?php

namespace Numbers\Users\Users\DataSource\Role;
class Assignments extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['um_rolassign_assignment_code'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'um_assigntype_name' => 'name'
	];
	public $column_prefix;

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Users\Model\Role\Assignments';
	public $parameters = [
		'parent_role_ids' => ['name' => 'Parent Roles', 'domain' => 'role_id', 'multiple_column' => true],
		'child_role_ids' => ['name' => 'Child Roles', 'domain' => 'role_id', 'multiple_column' => true]
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'um_rolassign_assignment_code' => 'a.um_rolassign_assignment_code',
			'um_rolassign_parent_role_id' => 'a.um_rolassign_parent_role_id',
			'um_rolassign_child_role_id' => 'a.um_rolassign_child_role_id',
			'um_rolassign_mandatory' => 'a.um_rolassign_mandatory',
			'um_assigntype_name' => 'b.um_assigntype_name',
			'um_assigntype_multiple' => 'b.um_assigntype_multiple'
		]);
		// join
		$this->query->join('INNER', new \Numbers\Users\Users\Model\User\Assignment\Types(), 'b', 'ON', [
			['AND', ['a.um_rolassign_assignment_code', '=', 'b.um_assigntype_code', true]]
		]);
		if (!empty($parameters['parent_role_ids'])) {
			$this->query->where('AND', ['a.um_rolassign_parent_role_id', '=', $parameters['parent_role_ids']]);
		} else if (!empty($parameters['child_role_ids'])) {
			$this->query->where('AND', ['a.um_rolassign_child_role_id', '=', $parameters['child_role_ids']]);
		} else {
			$this->query->where('AND', 'FALSE');
		}
	}
}