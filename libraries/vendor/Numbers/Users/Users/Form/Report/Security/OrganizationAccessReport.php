<?php

namespace Numbers\Users\Users\Form\Report\Security;
class OrganizationAccessReport extends \Object\Form\Wrapper\Report {
	public $form_link = 'um_organization_access_report';
	public $module_code = 'UM';
	public $title = 'U/M Security Organization Access Report';
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
				'user_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_user_id;>='],
				'user_id2' => ['order' => 2, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_user_id;<='],
				'um_user_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.um_user_inactive;=']
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
		'um_user_id' => ['name' => 'User #'],
		'um_user_name' => ['name' => 'User Name'],
	];
	public $report_default_sort = [
		'um_user_id' => SORT_ASC
	];
	public function buildReport(& $form) {
		// create new report
		$report = new \Object\Form\Builder\Report();
		$report->addReport(DEF, $form);
		// add header
		$report->addHeader(DEF, 'row1', [
			'um_user_id' => ['label_name' => 'User #', 'percent' => 10],
			'um_user_name' => ['label_name' => 'User Name', 'percent' => 40],
			'um_user_type_id' => ['label_name' => 'User Type', 'percent' => 10],
			'organization' => ['label_name' => 'Organization', 'percent' => 30],
			'primary' => ['label_name' => 'Primary', 'percent' => 5, 'data_align' => 'center'],
			'um_user_inactive' => ['label_name' => 'Active', 'percent' => 5, 'data_align' => 'center']
		]);
		// query the data
		$query = \Numbers\Users\Users\Model\Users::queryBuilderStatic()->select();
		$query->columns([
			'um_user_id' => 'a.um_user_id',
			'um_user_name' => 'a.um_user_name',
			'um_user_type_id' => 'a.um_user_type_id',
			'um_user_inactive' => 'a.um_user_inactive',
			'organizations' => 'b.organizations'
		]);
		// join
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Users\Model\User\Organizations::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.um_usrorg_user_id',
				'organizations' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.um_usrorg_organization_id, inner_a.um_usrorg_primary)", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Users\Organizations\Model\Organizations(), 'inner_b', 'ON', [
				['AND', ['inner_a.um_usrorg_organization_id', '=', 'inner_b.on_organization_id', true], false]
			]);
			$query->groupby(['inner_a.um_usrorg_user_id']);
			$query->where('AND', ['inner_a.um_usrorg_inactive', '=', 0]);
			$query->where('AND', ['inner_b.on_organization_inactive', '=', 0]);
		}, 'b', 'ON', [
			['AND', ['a.um_user_id', '=', 'b.um_usrorg_user_id', true], false]
		]);
		$form->processReportQueryFilter($query);
		$form->processReportQueryOrderBy($query);
		$data = $query->query(null, ['cache' => false]);
		// preload models
		$types = \Numbers\Users\Users\Model\User\Types::optionsStatic(['i18n' => true]);
		$organizations = \Numbers\Users\Organizations\Model\Organizations::optionsStatic(['i18n' => true]);
		// add data to report
		$counter = 1;
		foreach ($data['rows'] as $k => $v) {
			// replaces
			$v['um_user_id'] = ['value' => \Format::id($v['um_user_id']), 'url' => \Request::buildURL('/Numbers/Users/Users/Controller/Users/_Edit', ['um_user_id' => $v['um_user_id']])];
			$v['um_user_type_id'] = $types[$v['um_user_type_id']]['name'];
			$temp = explode(';;', $v['organizations']);
			$orgs = [];
			foreach ($temp as $v0) {
				$orgs[] = explode('::', $v0);
			}
			$temp = array_shift($orgs);
			$v['organization'] = $organizations[(int) $temp[0]]['name'];
			$v['primary'] = \Object\Content\Messages::active($temp[1] ?? false);
			$v['um_user_inactive'] = \Object\Content\Messages::active($v['um_user_inactive'], true);
			$even = $counter % 2 ? ODD : EVEN;
			$report->addData(DEF, 'row1', $even, $v);
			if (!empty($orgs)) {
				foreach ($orgs as $v0) {
					$v = [
						'organization' => $organizations[(int) $v0[0]]['name'],
						'primary' => i18n(null, !empty($v0[1]) ? 'Yes' : 'No')
					];
					$report->addData(DEF, 'row1', $even, $v);
				}
			}
			$counter++;
		}
		$report->addSeparator(DEF);
		// add number of rows
		$rows = count($data['rows']);
		$report->addLegend(DEF, i18n(null, \Object\Content\Messages::REPORT_ROWS_NUMBER, ['replace' => ['[Number]' => \Format::id($rows)]]));
		// free up memory
		unset($data);
		// we must return report object
		return $report;
	}
}