<?php

namespace Numbers\Users\APIs\DataSource;
class Login extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row = true;
	public $single_value;
	public $options_map =[];
	public $column_prefix;

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model;
	public $parameters = [
		'username' => ['name' => 'Username', 'domain' => 'login'],
	];

	public function query($parameters, $options = []) {
		// create a query object
		$this->query = \Numbers\Users\APIs\Model\Users::queryBuilderStatic([
			'alias' => 'a',
			'skip_acl' => true
		])->select();
		// columns
		$this->query->columns([
			'id' => 'a.ua_apiusr_id',
			'code' => 'a.ua_apiusr_code',
			'name' => 'a.ua_apiusr_name',
			'user_id' => 'a.ua_apiusr_user_id',
			// login
			'login_username' => 'a.ua_apiusr_login_username',
			'login_password' => 'a.ua_apiusr_login_password',
			// roles
			'roles' => 'b.roles',
			'role_ids' => 'b.role_ids',
			//'permissions' => 'f.permissions',
			'maximum_role_weight' => 'b.maximum_role_weight',
			// other
			'hold' => 'a.ua_apiusr_hold',
			'inactive' => 'a.ua_apiusr_inactive',
		]);
		// joins
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\APIs\Model\User\Roles::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.ua_apiusrrol_user_id',
				'roles' => $query->db_object->sqlHelper('string_agg', ['expression' => 'inner_b.ua_apirol_code', 'delimiter' => ';;']),
				'role_ids' => $query->db_object->sqlHelper('string_agg', ['expression' => $query->db_object->cast('inner_b.ua_apirol_id', 'varchar'), 'delimiter' => ';;']),
				'maximum_role_weight' => 'MAX(COALESCE(inner_b.ua_apirol_weight, 0))'
			]);
			// join
			$query->join('INNER', new \Numbers\Users\APIs\Model\Roles(), 'inner_b', 'ON', [
				['AND', ['inner_a.ua_apiusrrol_role_id', '=', 'inner_b.ua_apirol_id', true], false]
			]);
			$query->groupby(['inner_a.ua_apiusrrol_user_id']);
			$query->where('AND', ['inner_a.ua_apiusrrol_inactive', '=', 0]);
			$query->where('AND', ['inner_b.ua_apirol_inactive', '=', 0]);
		}, 'b', 'ON', [
			['AND', ['a.ua_apiusr_id', '=', 'b.ua_apiusrrol_user_id', true], false]
		]);
		/*
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\User\Organizations::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_usrorg_user_id',
				'organizations' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.um_usrorg_organization_id)", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Organizations\Model\Organizations(), 'inner_b', 'ON', [
				['AND', ['inner_a.um_usrorg_organization_id', '=', 'inner_b.on_organization_id', true], false]
			]);
			$query->groupby(['inner_a.um_usrorg_user_id']);
			$query->where('AND', ['inner_a.um_usrorg_inactive', '=', 0]);
			$query->where('AND', ['inner_b.on_organization_inactive', '=', 0]);
		}, 'c', 'ON', [
			['AND', ['a.um_user_id', '=', 'c.um_usrorg_user_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\User\Internalization(), 'd', 'ON', [
			['AND', ['a.um_user_id', '=', 'd.um_usri18n_user_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\Users\Model\User\Organizations(), 'e', 'ON', [
			['AND', ['a.um_user_id', '=', 'e.um_usrorg_user_id', true], false],
			['AND', ['e.um_usrorg_primary', '=', 1, false], false]
		]);
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\User\Permissions::queryBuilderStatic(['alias' => 'inner_c'])->select();
			$query->columns([
				'inner_c.um_usrperm_user_id',
				'permissions' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_c.um_usrperm_resource_id, inner_c.um_usrperm_method_code, inner_c.um_usrperm_action_id, inner_c.um_usrperm_inactive, inner_c.um_usrperm_module_id)", 'delimiter' => ';;'])
			]);
			$query->groupby(['inner_c.um_usrperm_user_id']);
		}, 'f', 'ON', [
			['AND', ['a.um_user_id', '=', 'f.um_usrperm_user_id', true], false]
		]);
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\User\Linked\Accounts::queryBuilderStatic(['alias' => 'inner_d'])->select();
			$query->columns([
				'inner_d.um_usrlinked_user_id',
				'linked_accounts' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_d.um_usrlinked_module_id, inner_d.um_usrlinked_type_code, inner_d.um_usrlinked_linked_id)", 'delimiter' => ';;'])
			]);
			$query->where('AND', ['inner_d.um_usrlinked_inactive', '=', 0]);
			$query->groupby(['inner_d.um_usrlinked_user_id']);
		}, 'g', 'ON', [
			['AND', ['a.um_user_id', '=', 'g.um_usrlinked_user_id', true], false]
		]);
		*/
		// where
		$this->query->where('AND', ['a.ua_apiusr_login_username', '=', strtolower($parameters['username'] . '')]);
		$this->query->where('AND', ['a.ua_apiusr_inactive', '=', 0]);
		$this->query->where('AND', ['a.ua_apiusr_hold', '=', 0]);
		// limit
		$this->query->limit(1);
	}

	public function process($data, $options = []) {
		foreach ($data as $k => $v) {
			// roles
			if (!empty($v['roles'])) {
				$data[$k]['roles'] = explode(';;', $v['roles']);
			} else {
				$data[$k]['roles'] = [];
			}
			// role ids
			if (!empty($v['role_ids'])) {
				$data[$k]['role_ids'] = explode(';;', $v['role_ids']);
				foreach ($data[$k]['role_ids'] as $k2 => $v2) {
					$data[$k]['role_ids'][$k2] = (int) $v2;
				}
			} else {
				$data[$k]['role_ids'] = [];
			}
			// process permissions, the same logic as in roles datasource!!!
			/*
			if (!empty($v['permissions'])) {
				$data[$k]['permissions'] = [];
				$temp = explode(';;', $v['permissions']);
				foreach ($temp as $v2) {
					$v2 = explode('::', $v2);
					$data[$k]['permissions'][(int) $v2[0]][$v2[1]][(int )$v2[2]][(int) $v2[4]] = (int) $v2[3];
				}
			} else {
				$data[$k]['permissions'] = [];
			}
			*/
		}
		return $data;
	}
}