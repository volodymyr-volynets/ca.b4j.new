<?php

namespace Numbers\Users\Users\DataSource;
class Users extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['um_user_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map = [
		'um_user_name' => 'name',
		'um_user_company' => 'name',
		'um_user_photo_file_id' => 'photo_id',
		'um_user_inactive' => 'inactive'
	];
	public $options_active = [
		'um_user_inactive' => 0
	];
	public $column_prefix = 'um_user_';

	public $cache = true;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\Users\Model\Users';
	public $parameters = [
		'selected_organizations' => ['name' => 'Selected Organizations', 'domain' => 'organization_id', 'multiple_column' => true],
		'selected_roles' => ['name' => 'Selected Roles', 'domain' => 'role_id', 'multiple_column' => true],
		'existing_values' => ['name' => 'Existing Values', 'type' => 'mixed'],
		'skip_acl' => ['name' => 'Skip ACL', 'type' => 'boolean'],
		'include_all_columns' => ['name' => 'Include All Columns', 'type' => 'boolean'],
		'only_id_column' => ['name' => 'Only ID Column', 'type' => 'boolean'],
		'include_himself' => ['name' => 'Include Himself', 'type' => 'boolean'],
		'skip_himself' => ['name' => 'Skip Himself', 'type' => 'boolean'],
		/* queue filter */
		'owners_id' => ['name' => 'Owners #', 'domain' => 'type_id', 'multiple_column' => true],
		'queue_type_id' => ['name' => 'Queue Type #', 'domain' => 'type_id', 'multiple_column' => true],
	];

	public function query($parameters, $options = []) {
		// columns
		if (!empty($parameters['include_all_columns'])) {
			$this->query->columns(['a.*']);
		} else if (!empty($parameters['only_id_column'])) {
			$this->query->columns([
				'um_user_id' => 'a.um_user_id'
			]);
		} else {
			$this->query->columns([
				'um_user_id' => 'a.um_user_id',
				'um_user_name' => 'a.um_user_name',
				'um_user_company' => 'a.um_user_company',
				'um_user_photo_file_id' => 'a.um_user_photo_file_id',
				'um_user_inactive' => 'a.um_user_inactive'
			]);
		}
		// skip himself
		if (!empty($parameters['skip_himself'])) {
			$this->query->where('AND', ['a.um_user_id', '!=', \User::id(), false]);
		}
		// selected roles
		if (!empty($parameters['selected_roles'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.um_user_id', '=', $parameters['existing_values']]);
				}
				$query->where('OR', function (& $query) use ($parameters) {
					$query = \Numbers\Users\Users\Model\User\Roles::queryBuilderStatic(['alias' => 'inner_r'])->select();
					$query->columns(1);
					$query->where('AND', ['inner_r.um_usrrol_user_id', '=', 'a.um_user_id', true]);
					$query->where('AND', ['inner_r.um_usrrol_role_id', '=', $parameters['selected_roles']]);
				}, true);
			});
		}
		// selected roles
		if (!empty($parameters['selected_organizations'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.um_user_id', '=', $parameters['existing_values']]);
				}
				$query->where('OR', function (& $query) use ($parameters) {
					$query = \Numbers\Users\Users\Model\User\Organizations::queryBuilderStatic(['alias' => 'inner_o'])->select();
					$query->columns(1);
					$query->where('AND', ['inner_o.um_usrorg_user_id', '=', 'a.um_user_id', true]);
					$query->where('AND', ['inner_o.um_usrorg_organization_id', '=', $parameters['selected_organizations']]);
				}, true);
			});
		}
		// acl for not super admins
		if (!\User::get('super_admin') && empty($parameters['skip_acl'])) {
			$this->query->where('AND', function (& $query) use ($parameters) {
				// allow existing values
				if (!empty($parameters['existing_values'])) {
					$query->where('OR', ['a.um_user_id', '=', $parameters['existing_values']]);
				}
				// user can see him self
				if (!empty($parameters['include_himself'])) {
					$query->where('OR', ['a.um_user_id', '=', \User::id(), false]);
				}
				// user can see roles he can assign
				$query->where('OR', function (& $query) {
					$manages_datasource_model = new \Numbers\Users\Users\DataSource\Role\Manages();
					$manages_datasource_sql = $manages_datasource_model->sql([
						'where' => [
							'selected_roles' => \User::get('role_ids'),
							'selected_users' => \User::id()
						]
					], $this->cache_tags);
					$query->where('AND', ['a.um_user_id', 'IN', $manages_datasource_sql, true]);
					// user is assigned to organization
					$organizations = \User::get('organizations');
					if (!empty($organizations)) {
						$query->where('AND', function (& $query) use ($organizations) {
							$query = \Numbers\Users\Users\Model\User\Organizations::queryBuilderStatic(['alias' => 'inner_d'])->select();
							$query->columns(1);
							$query->where('AND', ['inner_d.um_usrorg_user_id', '=', 'a.um_user_id', true]);
							$query->where('AND', ['inner_d.um_usrorg_organization_id', 'IN', $organizations, false]);
						}, true);
					} else {
						$query->where('AND', 'FALSE');
					}
				});
			});
		}
	}
}