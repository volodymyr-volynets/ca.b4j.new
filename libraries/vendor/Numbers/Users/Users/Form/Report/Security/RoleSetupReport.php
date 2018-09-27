<?php

namespace Numbers\Users\Users\Form\Report\Security;
class RoleSetupReport extends \Object\Form\Wrapper\Report {
	public $form_link = 'um_role_setup_report';
	public $module_code = 'UM';
	public $title = 'U/M Security Role Setup Report';
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
		$report->addHeader(DEF, 'inherits', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => 'Inherited Roles:', 'percent' => 20],
			'role_id' => ['label_name' => 'Role #', 'percent' => 10],
			'role_name' => ['label_name' => 'Role Name', 'percent' => 60],
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'permissions', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => 'Permissions:', 'percent' => 20],
			'module_name' => ['label_name' => 'Module Name', 'percent' => 25],
			'resource_name' => ['label_name' => 'Resource Name', 'percent' => 25],
			'action_name' => ['label_name' => 'Action Name', 'percent' => 20],
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'notifications', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => 'Notifications:', 'percent' => 20],
			'module_name' => ['label_name' => 'Module Name', 'percent' => 25],
			'notification_name' => ['label_name' => 'Notification Name', 'percent' => 45],
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'manages1', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => 'Manages:', 'percent' => 20],
			'role_name' => ['label_name' => 'Role Name', 'percent' => 25],
			'um_rolman_view_users_type_id' => ['label_name' => 'View Users', 'percent' => 10],
			'um_rolman_manage_children' => ['label_name' => 'Manage Children', 'percent' => 15],
			'um_rolman_assignment_code' => ['label_name' => 'Follow Assignment', 'percent' => 20],
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'manages2', [
			'blank' => ['label_name' => '', 'percent' => 10],
			'name' => ['label_name' => '', 'percent' => 20],
			'um_rolman_assign_roles' => ['label_name' => 'Assign Roles', 'percent' => 15],
			'um_rolman_reset_password' => ['label_name' => 'Reset Password', 'percent' => 15],
			'blank2' => ['label_name' => ' ', 'percent' => 40],
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
			'inherits' => 'c.inherits',
			'permissions' => 'd.permissions',
			'notifications' => 'e.notifications',
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
		// join children
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\Role\Children::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_rolrol_child_role_id',
				'inherits' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.um_rolrol_parent_role_id)", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Users\Model\Roles(), 'inner_b', 'ON', [
				['AND', ['inner_a.um_rolrol_parent_role_id', '=', 'inner_b.um_role_id', true], false]
			]);
			$query->groupby(['inner_a.um_rolrol_child_role_id']);
			$query->where('AND', ['inner_a.um_rolrol_inactive', '=', 0]);
			$query->where('AND', ['inner_b.um_role_inactive', '=', 0]);
		}, 'c', 'ON', [
			['AND', ['a.um_role_id', '=', 'c.um_rolrol_child_role_id', true], false]
		]);
		// join permissions
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\Role\Permissions::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_rolperm_role_id',
				'permissions' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.um_rolperm_module_id, inner_a.um_rolperm_resource_id, inner_a.um_rolperm_action_id)", 'delimiter' => ';;'])
			]);
			$query->groupby(['inner_a.um_rolperm_role_id']);
			$query->where('AND', ['inner_a.um_rolperm_inactive', '=', 0]);
		}, 'd', 'ON', [
			['AND', ['a.um_role_id', '=', 'd.um_rolperm_role_id', true], false]
		]);
		// join notifications
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\Role\Notifications::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_rolnoti_role_id',
				'notifications' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('**', inner_a.um_rolnoti_module_id, inner_a.um_rolnoti_feature_code)", 'delimiter' => ';;'])
			]);
			$query->groupby(['inner_a.um_rolnoti_role_id']);
			$query->where('AND', ['inner_a.um_rolnoti_inactive', '=', 0]);
		}, 'e', 'ON', [
			['AND', ['a.um_role_id', '=', 'e.um_rolnoti_role_id', true], false]
		]);
		$form->processReportQueryFilter($query);
		$form->processReportQueryOrderBy($query);
		$data = $query->query(null, ['cache' => false]);
		// preload models
		$types = \Numbers\Users\Users\Model\Role\Types::optionsStatic(['i18n' => true]);
		$departments = \Numbers\Users\Organizations\Model\Departments::optionsStatic(['i18n' => true]);
		$organizations = \Numbers\Users\Organizations\Model\Organizations::optionsStatic(['i18n' => true]);
		$roles = \Numbers\Users\Users\Model\Roles::optionsStatic(['i18n' => true]);
		$modules = \Numbers\Tenants\Tenants\Model\Modules::optionsStatic(['i18n' => true]);
		$resources= \Numbers\Backend\System\Modules\Model\Resources::optionsStatic(['i18n' => true]);
		$actions = \Numbers\Backend\System\Modules\Model\Resource\Actions::optionsStatic(['i18n' => true]);
		$features = \Numbers\Backend\System\Modules\Model\Module\Features::optionsStatic(['i18n' => true]);
		$view_user_types = \Numbers\Users\Users\Model\Role\Manage\ViewUsersTypes::optionsStatic(['i18n' => true]);
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
			// inherits
			if (!empty($v['inherits'])) {
				$report->addData(DEF, 'separator', $even, ['blank' => ' ']);
				$report->addData(DEF, 'inherits', $even, $report->getHeaderForRender(DEF, 'inherits'));
				$temp = explode(';;', $v['inherits']);
				$counter2 = $even + 1;
				foreach ($temp as $v0) {
					$report->addData(DEF, 'inherits', $even, [
						'role_id' => $v0,
						'role_name' => $roles[(int) $v0]['name']
					], [
						'cell_even' => $counter2 % 2 ? ODD : EVEN
					]);
					$counter2++;
				}
			}
			// permissions
			if (!empty($v['permissions'])) {
				$report->addData(DEF, 'separator', $even, ['blank' => ' ']);
				$report->addData(DEF, 'permissions', $even, $report->getHeaderForRender(DEF, 'permissions'));
				$temp = explode(';;', $v['permissions']);
				$counter2 = $even + 1;
				foreach ($temp as $v0) {
					$temp2 = explode('::', $v0);
					$report->addData(DEF, 'permissions', $even, [
						'module_name' => $modules[(int) $temp2[0]]['name'],
						'resource_name' => $resources[(int) $temp2[1]]['name'],
						'action_name' => $actions[(int) $temp2[2]]['name']
					], [
						'cell_even' => $counter2 % 2 ? ODD : EVEN
					]);
					$counter2++;
				}
			}
			// notifications
			if (!empty($v['notifications'])) {
				$report->addData(DEF, 'separator', $even, ['blank' => ' ']);
				$report->addData(DEF, 'notifications', $even, $report->getHeaderForRender(DEF, 'notifications'));
				$temp = explode(';;', $v['notifications']);
				$counter2 = $even + 1;
				foreach ($temp as $v0) {
					$temp2 = explode('**', $v0);
					$report->addData(DEF, 'notifications', $even, [
						'module_name' => $modules[(int) $temp2[0]]['name'],
						'notification_name' => $features[$temp2[1]]['name']
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