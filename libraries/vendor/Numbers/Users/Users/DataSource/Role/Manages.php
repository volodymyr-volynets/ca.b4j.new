<?php

namespace Numbers\Users\Users\DataSource\Role;
class Manages extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['um_usrrol_user_id'];
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

	public $primary_model = '\Numbers\Users\Users\Model\User\Roles';
	public $parameters = [
		'selected_roles' => ['name' => 'Selected Roles', 'domain' => 'role_id', 'multiple_column' => true],
		'selected_users' => ['name' => 'Selected Users', 'domain' => 'user_id', 'multiple_column' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'um_usrrol_user_id' => 'a.um_usrrol_user_id'
		]);
		$manages_model = new \Numbers\Users\Users\Model\Role\Manages();
		$manages_data = $manages_model->get([
			'where' => [
				'um_rolman_inactive' => 0
			],
			'pk' => ['um_rolman_parent_role_id', 'um_rolman_child_role_id']
		]);
		$this_query = & $this->query;
		$manage_children = [];
		$this->query->where('AND', function (& $query) use ($parameters, $manages_data, $this_query, & $manage_children) {
			foreach ($parameters['selected_roles'] as $k => $v) {
				// exclude roles that do not manage other roles
				if (empty($manages_data[$v])) continue;
				// loop through all manages
				foreach ($manages_data[$v] as $k2 => $v2) {
					// exclude if we cannot view users
					if (empty($v2['um_rolman_view_users_type_id'])) continue;
					// if we do not have assignment
					if (empty($v2['um_rolman_assignment_code'])) {
						$query->where('OR', ['a.um_usrrol_role_id', '=', $v2['um_rolman_child_role_id']]);
						$query->where('OR', ['a.um_usrrol_user_id', '=', $parameters['selected_users']]);
					} else { // if we have assignment
						// we left join
						$this_query->join('LEFT', new \Numbers\Users\Users\Model\User\Assignments(), 'inner_a_' . $k2, 'ON', [
							['AND', ['inner_a_' . $k2 . '.um_usrassign_assignment_code', '=', $v2['um_rolman_assignment_code'], false], false],
							['AND', ['inner_a_' . $k2 . '.um_usrassign_parent_user_id', '=', $parameters['selected_users'], false], false],
							['AND', ['inner_a_' . $k2 . '.um_usrassign_child_user_id', '=', 'a.um_usrrol_user_id', true], false]
						]);
						$query->where('OR', ['inner_a_' . $k2 . '.um_usrassign_assignment_code', 'IS NOT', null]);
						$query->where('OR', ['a.um_usrrol_user_id', '=', $parameters['selected_users']]);
					}
					// if we have inherited children
					if (!empty($v2['um_rolman_manage_children']) && !empty($manages_data[$v2['um_rolman_child_role_id']])) {
						foreach ($manages_data[$v2['um_rolman_child_role_id']] as $k3 => $v3) {
							// exclude if we cannot assign roles
							if (empty($v3['um_rolman_view_users_type_id'])) continue;
							// if we do not have assignment
							if (empty($v3['um_rolman_assignment_code'])) {
								$query->where('OR', ['a.um_usrrol_role_id', '=', $v3['um_rolman_child_role_id']]);
							} else { // if we have assignment
								$manage_children[$v3['um_rolman_assignment_code']] = $v3['um_rolman_assignment_code'];
							}
						}
					}
				}
			}
			$query->where('OR', 'FALSE');
		});
		// if we have manage children
		if (!empty($manage_children)) {
			$parents_sql = $this->query->sql();
			//$this->query->
			$this->query->union('UNION', function (& $query) use ($parents_sql, $manage_children) {
				$query = \Numbers\Users\Users\Model\User\Assignments::queryBuilderStatic(['alias' => 'union_a'])->select();
				// columns
				$query->columns([
					'um_usrrol_user_id' => 'union_a.um_usrassign_child_user_id'
				]);
				// where
				$query->where('AND', ['union_a.um_usrassign_parent_user_id', 'IN', $query->wrapSqlIntoTabs($parents_sql)]);
				$query->where('AND', ['union_a.um_usrassign_assignment_code', 'IN', $manage_children]);
			});
		}
	}
}