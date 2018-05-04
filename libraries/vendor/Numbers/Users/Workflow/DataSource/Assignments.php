<?php

namespace Numbers\Users\Workflow\DataSource;
class Assignments extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['ww_assignment_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'ww_assignment_name' => 'name',
		'ww_assignment_icon' => 'icon_class'
	];
	public $options_active =[
		'ww_assignment_inactive' => 0
	];
	public $column_prefix = 'ww_assignment_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Workflow\Model\Assignments';
	public $parameters = [
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
		'skip_acl' => ['name' => 'Skip ACL', 'type' => 'boolean']
	];

	public function query($parameters, $options = []) {
		// columns
		$this->query->columns([
			'a.ww_assignment_id',
			'a.ww_assignment_name',
			'a.ww_assignment_icon',
			'a.ww_assignment_inactive'
		]);
		// acl for not super admins
		if (!\User::get('super_admin') && empty($parameters['skip_acl'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.ww_assignment_id', '=', $parameters['existing_values']]);
				}
				// user can see roles he can assign
				$query->where('OR', function (& $query) {
					$organizations = \User::get('organizations');
					if (!empty($organizations)) {
						$query->where('AND', function (& $query) use ($organizations) {
							$query = \Numbers\Users\Workflow\Model\Assignment\Organizations::queryBuilderStatic(['alias' => 'inner_o'])->select();
							$query->columns(1);
							$query->where('AND', ['inner_o.ww_assignorg_assignment_id', '=', 'a.ww_assignment_id', true]);
							$query->where('AND', ['inner_o.ww_assignorg_organization_id', 'IN', $organizations, false]);
							$query->where('AND', ['inner_o.ww_assignorg_inactive', '=', 0]);
						}, true);
					} else {
						$query->where('AND', 'FALSE');
					}
					$query->where('AND', function (& $query) {
						$query->where('OR', ['a.ww_assignment_all_roles', '=', 1]);
						$roles = \User::get('role_ids');
						if (!empty($roles)) {
							$query->where('OR', function (& $query) use ($roles) {
								$query = \Numbers\Users\Workflow\Model\Assignment\Roles::queryBuilderStatic(['alias' => 'inner_r'])->select();
								$query->columns(1);
								$query->where('AND', ['inner_r.ww_assignrol_assignment_id', '=', 'a.ww_assignment_id', true]);
								$query->where('AND', ['inner_r.ww_assignrol_role_id', 'IN', $roles, false]);
								$query->where('AND', ['inner_r.ww_assignrol_inactive', '=', 0]);
							}, true);
						} else {
							$query->where('AND', 'FALSE');
						}
					});
				});
			});
		}
	}
}