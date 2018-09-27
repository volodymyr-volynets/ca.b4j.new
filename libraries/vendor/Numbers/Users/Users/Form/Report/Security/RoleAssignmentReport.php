<?php

namespace Numbers\Users\Users\Form\Report\Security;
class RoleAssignmentReport extends \Object\Form\Wrapper\Report {
	public $form_link = 'um_role_assignment_report';
	public $module_code = 'UM';
	public $title = 'U/M Security Role Assignment Report';
	public $options = [
		'segment' => self::SEGMENT_REPORT,
		'actions' => [
			'refresh' => true,
			'filter_sort' => ['value' => 'Filter/Sort', 'sort' => 32000, 'icon' => 'fas fa-filter', 'onclick' => 'Numbers.Form.listFilterSortToggle(this);']
		]
	];
	public $containers = [
		'tabs' => ['default_row_type' => 'grid', 'order' => 1000, 'type' => 'tabs', 'class' => 'numbers_form_filter_sort_container'],
		'filter' => ['default_row_type' => 'grid', 'order' => 1500],
		'sort' => self::LIST_SORT_CONTAINER,
		self::REPORT_BUTTONS => ['default_row_type' => 'grid', 'order' => 2000, 'class' => 'numbers_form_filter_sort_container'],
	];
	public $rows = [
		'tabs' => [
			'filter' => ['order' => 100, 'label_name' => 'Filter'],
			'sort' => ['order' => 200, 'label_name' => 'Sort'],
		]
	];
	public $elements = [
		'tabs' => [
			'filter' => [
				'filter' => ['container' => 'filter', 'order' => 100]
			],
			'sort' => [
				'sort' => ['container' => 'sort', 'order' => 100]
			]
		],
		'filter' => [
			'date' => [
				'um_role_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Role #', 'domain' => 'role_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_role_id;>='],
				'um_role_id2' => ['order' => 2, 'label_name' => 'Role #', 'domain' => 'role_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_role_id;<='],
				'um_role_type_id1' => ['order' => 3, 'label_name' => 'Type', 'type' => 'type_id', 'percent' => 50, 'null' => true, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Users\Users\Model\Role\Types', 'query_builder' => 'a.um_role_type_id;=']
			]
		],
		'sort' => [
			'__sort' => [
				'__sort' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Sort', 'domain' => 'code', 'details_unique_select' => true, 'percent' => 50, 'null' => true, 'method' => 'select', 'options' => self::REPORT_SORT_OPTIONS, 'onchange' => 'this.form.submit();'],
				'__order' => ['order' => 2, 'label_name' => 'Order', 'type' => 'smallint', 'default' => SORT_ASC, 'percent' => 50, 'null' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Object\Data\Model\Order', 'onchange' => 'this.form.submit();'],
			]
		],
		self::REPORT_BUTTONS => self::REPORT_BUTTONS_DATA
	];
	const REPORT_SORT_OPTIONS = [
		'um_role_id' => ['name' => 'Role #'],
		'um_role_name' => ['name' => 'Role Name'],
	];
	public $report_default_sort = [
		'um_role_id' => SORT_ASC
	];
	public function buildReport(& $form) {
		// create new report
		$report = new \Object\Form\Builder\Report();
		$report->addReport(DEF, $form);
		// add header
		$report->addHeader(DEF, 'row1', [
			'um_role_id' => ['label_name' => 'Role #', 'percent' => 10],
			'um_role_name' => ['label_name' => 'Role Name', 'percent' => 50],
			'um_role_global' => ['label_name' => 'Global', 'percent' => 10, 'data_align' => 'center'],
			'um_role_super_admin' => ['label_name' => 'Super Admin', 'percent' => 10, 'data_align' => 'center'],
			'um_role_handle_exceptions' => ['label_name' => 'Exceptions', 'percent' => 10, 'data_align' => 'center'],
			'um_role_inactive' => ['label_name' => 'Active', 'percent' => 10, 'data_align' => 'center'],
		]);
		$report->addHeader(DEF, 'row2', [
			'blank' => ['label_name' => ' ', 'percent' => 10],
			'um_role_code' => ['label_name' => 'Role Code', 'percent' => 20],
			'um_role_type_id' => ['label_name' => 'Type', 'percent' => 20],
			'um_role_department_id' => ['label_name' => 'Department', 'percent' => 50]
		]);
		$report->addHeader(DEF, 'separator', [
			'blank' => ['label_name' => ' ', 'percent' => 100]
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'organizations', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => 'Organizations:', 'percent' => 20],
			'organization_id' => ['label_name' => 'Organization #', 'percent' => 10],
			'organization_name' => ['label_name' => 'Organization Name', 'percent' => 60],
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'users', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => 'Users:', 'percent' => 20],
			'user_id' => ['label_name' => 'User #', 'percent' => 10],
			'user_name' => ['label_name' => 'User Name', 'percent' => 25],
			'granted_on' => ['label_name' => 'Granted On', 'percent' => 10],
			'granted_by' => ['label_name' => 'Granted By', 'percent' => 25],
		],
		[
			'skip_rendering' => true
		]);
		// query the data
		$query = \Numbers\Users\Users\Model\Roles::queryBuilderStatic()->select();
		$query->columns([
			'um_role_id' => 'a.um_role_id',
			'um_role_code' => 'a.um_role_code',
			'um_role_type_id' => 'a.um_role_type_id',
			'um_role_department_id' => 'a.um_role_department_id',
			'um_role_name' => 'a.um_role_name',
			'um_role_global' => 'a.um_role_global',
			'um_role_super_admin' => 'a.um_role_super_admin',
			'um_role_handle_exceptions' => 'a.um_role_handle_exceptions',
			'um_role_inactive' => 'a.um_role_inactive',
			'organizations' => 'b.organizations',
			'users' => 'c.users'
		]);
		// join organizations
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\Role\Organizations::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_rolorg_role_id',
				'organizations' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.um_rolorg_organization_id)", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Organizations\Model\Organizations(), 'inner_b', 'ON', [
				['AND', ['inner_a.um_rolorg_organization_id', '=', 'inner_b.on_organization_id', true], false]
			]);
			$query->groupby(['inner_a.um_rolorg_role_id']);
			$query->where('AND', ['inner_a.um_rolorg_inactive', '=', 0]);
			$query->where('AND', ['inner_b.on_organization_inactive', '=', 0]);
		}, 'b', 'ON', [
			['AND', ['a.um_role_id', '=', 'b.um_rolorg_role_id', true], false]
		]);
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\User\Roles::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_usrrol_role_id',
				'users' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.um_usrrol_user_id, inner_a.um_usrrol_inserted_timestamp, COALESCE(inner_a.um_usrrol_inserted_user_id, 0))", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Users\Model\Users(), 'inner_b', 'ON', [
				['AND', ['inner_a.um_usrrol_user_id', '=', 'inner_b.um_user_id', true], false]
			]);
			$query->groupby(['inner_a.um_usrrol_role_id']);
			$query->where('AND', ['inner_a.um_usrrol_inactive', '=', 0]);
			$query->where('AND', ['inner_b.um_user_inactive', '=', 0]);
		}, 'c', 'ON', [
			['AND', ['a.um_role_id', '=', 'c.um_usrrol_role_id', true], false]
		]);
		$form->processReportQueryFilter($query);
		$form->processReportQueryOrderBy($query);
		$data = $query->query(null, ['cache' => false]);
		// preload models
		$types = \Numbers\Users\Users\Model\Role\Types::optionsStatic(['i18n' => true]);
		$departments = \Numbers\Users\Organizations\Model\Departments::optionsStatic(['i18n' => true]);
		$organizations = \Numbers\Users\Organizations\Model\Organizations::optionsStatic(['i18n' => true]);
		$roles = \Numbers\Users\Users\Model\Roles::optionsStatic(['i18n' => true]);
		$users = \Numbers\Users\Users\Model\Users::optionsStatic(['i18n' => false]);
		// add data to report
		$counter = 1;
		foreach ($data['rows'] as $k => $v) {
			// replaces
			$role_id = $v['um_role_id'];
			$v['um_role_id'] = ['value' => \Format::id($v['um_role_id']), 'url' => \Request::buildURL('/Numbers/Users/Users/Controller/Roles/_Edit', ['um_role_id' => $v['um_role_id']])];
			$v['um_role_global'] = \Object\Content\Messages::active($v['um_role_global']);
			$v['um_role_super_admin'] = \Object\Content\Messages::active($v['um_role_super_admin']);
			$v['um_role_handle_exceptions'] = \Object\Content\Messages::active($v['um_role_handle_exceptions']);
			$v['um_role_inactive'] = \Object\Content\Messages::active($v['um_role_inactive'], true);
			$v['um_role_type_id'] = $types[$v['um_role_type_id']]['name'];
			$v['um_role_department_id'] = $departments[$v['um_role_department_id']]['name'] ?? null;
			// add data
			$even = $counter % 2 ? ODD : EVEN;
			$report->addData(DEF, 'row1', $even, $v);
			$report->addData(DEF, 'row2', $even, $v);
			// add organizations
			if (!empty($v['organizations'])) {
				$report->addData(DEF, 'separator', $even, ['blank' => ' ']);
				$report->addData(DEF, 'organizations', $even, $report->getHeaderForRender(DEF, 'organizations'));
				$temp = explode(';;', $v['organizations']);
				$counter2 = $even + 1;
				foreach ($temp as $v0) {
					$report->addData(DEF, 'organizations', $even, [
						'organization_id' => $v0,
						'organization_name' => $organizations[(int) $v0]['name']
					], [
						'cell_even' => $counter2 % 2 ? ODD : EVEN
					]);
					$counter2++;
				}
			}
			// add users
			if (!empty($v['users'])) {
				$report->addData(DEF, 'separator', $even, ['blank' => ' ']);
				$report->addData(DEF, 'users', $even, $report->getHeaderForRender(DEF, 'users'));
				$temp = explode(';;', $v['users']);
				$counter2 = $even + 1;
				foreach ($temp as $v0) {
					$temp2 = explode('::', $v0);
					$report->addData(DEF, 'users', $even, [
						'user_id' => $temp2[0],
						'user_name' => $users[(int) $temp2[0]]['name'],
						'granted_on' => \Format::date($temp2[1]),
						'granted_by' => !empty($temp2[2]) ? $users[(int) $temp2[2]]['name'] : ' ',
					], [
						'cell_even' => $counter2 % 2 ? ODD : EVEN
					]);
					$counter2++;
				}
			}
			$counter++;
		}
		// add number of rows
		$report->addNumberOfRows(DEF, count($data['rows']));
		// free up memory
		unset($data);
		// we must return report object
		return $report;
	}
}