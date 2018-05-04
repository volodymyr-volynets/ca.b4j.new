<?php

namespace Numbers\Users\Users\DataSource;
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
		'user_id' => ['name' => 'User #', 'domain' => 'user_id'],
	];

	public function query($parameters, $options = []) {
		// create a query object
		$this->query = \Numbers\Users\Users\Model\Users::queryBuilderStatic([
			'alias' => 'a',
			'skip_acl' => true
		])->select();
		// columns
		$this->query->columns([
			'id' => 'a.um_user_id',
			'code' => 'a.um_user_code',
			'type' => 'a.um_user_type_id',
			'name' => 'a.um_user_name',
			'company' => 'a.um_user_company',
			// contact
			'email' => 'a.um_user_email',
			'phone' => 'a.um_user_phone',
			'cell' => 'a.um_user_cell',
			'fax' => 'a.um_user_fax',
			// login
			'login_username' => 'a.um_user_login_username',
			'login_password' => 'a.um_user_login_password',
			'login_last_set' => 'COALESCE(a.um_user_login_last_set, a.um_user_inserted_timestamp)',
			// inactive & hold
			'hold' => 'a.um_user_hold',
			'inactive' => 'a.um_user_inactive',
			// roles
			'roles' => 'b.roles',
			'role_ids' => 'b.role_ids',
			'permissions' => 'f.permissions',
			'organizations' => 'c.organizations',
			'super_admin' => 'b.super_admin',
			'handle_exceptions' => 'b.handle_exceptions',
			'maximum_role_weight' => 'b.maximum_role_weight',
			'linked_accounts' => 'g.linked_accounts',
			// internalization
			'i18n_group_id' => 'd.um_usri18n_group_id',
			'i18n_language_code' => 'd.um_usri18n_language_code',
			'i18n_locale_code' => 'd.um_usri18n_locale_code',
			'i18n_timezone_code' => 'd.um_usri18n_timezone_code',
			'i18n_organization_id' => 'd.um_usri18n_organization_id',
			'i18n_format_date' => 'd.um_usri18n_format_date',
			'i18n_format_time' => 'd.um_usri18n_format_time',
			'i18n_format_datetime' => 'd.um_usri18n_format_datetime',
			'i18n_format_timestamp' => 'd.um_usri18n_format_timestamp',
			'i18n_format_amount_frm' => 'd.um_usri18n_format_amount_frm',
			'i18n_format_amount_fs' => 'd.um_usri18n_format_amount_fs',
			'i18n_format_uom' => 'd.um_usri18n_format_uom',
			'i18n_print_format' => 'd.um_usri18n_print_format',
			'i18n_print_font' => 'd.um_usri18n_print_font',
			// primary organization
			'organization_id' => 'e.um_usrorg_organization_id',
			'photo_file_id' => 'a.um_user_photo_file_id',
			'operating_country_code' => 'a.um_user_operating_country_code',
			'operating_province_code' => 'a.um_user_operating_province_code'
		]);
		// joins
		$this->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\User\Roles::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_usrrol_user_id',
				'roles' => $query->db_object->sqlHelper('string_agg', ['expression' => "inner_b.um_role_code", 'delimiter' => ';;']),
				'role_ids' => $query->db_object->sqlHelper('string_agg', ['expression' => $query->db_object->cast('inner_b.um_role_id', 'character varying'), 'delimiter' => ';;']),
				'super_admin' => 'SUM(inner_b.um_role_super_admin)',
				'handle_exceptions' => 'SUM(inner_b.um_role_handle_exceptions)',
				'maximum_role_weight' => 'MAX(inner_b.um_role_weight)'
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Users\Model\Roles(), 'inner_b', 'ON', [
				['AND', ['inner_a.um_usrrol_role_id', '=', 'inner_b.um_role_id', true], false]
			]);
			$query->groupby(['inner_a.um_usrrol_user_id']);
			$query->where('AND', ['inner_a.um_usrrol_inactive', '=', 0]);
			$query->where('AND', ['inner_b.um_role_inactive', '=', 0]);
		}, 'b', 'ON', [
			['AND', ['a.um_user_id', '=', 'b.um_usrrol_user_id', true], false]
		]);
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
		// where
		$this->query->where('AND', ['a.um_user_login_enabled', '=', 1]);
		$this->query->where('AND', ['a.um_user_inactive', '=', 0]);
		$this->query->orderby([
			'um_user_id' => SORT_DESC
		]);
		$this->query->limit(1);
		if (!empty($parameters['user_id'])) {
			$this->query->where('AND', ['a.um_user_id', '=', (int) $parameters['user_id']]);
		} else {
			$parameters['username'] = strtolower($parameters['username'] . '');
			if (strpos($parameters['username'], '@') !== false) {
				$this->query->where('AND', ['a.um_user_email', '=', $parameters['username']]);
			} else if (is_numeric($parameters['username'])) {
				$this->query->where('AND', ['a.um_user_numeric_phone', '=', (int) $parameters['username']]);
			} else {
				$this->query->where('AND', ['a.um_user_login_username', '=', $parameters['username']]);
			}
		}
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
			// organizations
			if (!empty($v['organizations'])) {
				$data[$k]['organizations'] = [];
				foreach (explode(';;', $v['organizations']) as $v2) {
					$data[$k]['organizations'][] = (int) $v2;
				}
			} else {
				$data[$k]['organizations'] = [];
			}
			// process i18n
			$data[$k]['internalization'] = [];
			foreach ($v as $k2 => $v2) {
				if (strpos($k2, 'i18n_') === 0) {
					$data[$k]['internalization'][str_replace('i18n_', '', $k2)] = $v2;
					unset($data[$k][$k2]);
				}
			}
			// process permissions, the same logic as in roles datasource!!!
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
			//linked_accounts
			if (!empty($v['linked_accounts'])) {
				$data[$k]['linked_accounts'] = [];
				$temp = explode(';;', $v['linked_accounts']);
				foreach ($temp as $v2) {
					$v2 = explode('::', $v2);
					$data[$k]['linked_accounts'][$v2[1]][(int) $v2[0]] = (int) $v2[2];
				}
			} else {
				$data[$k]['linked_accounts'] = [];
			}
		}
		return $data;
	}
}