<?php

namespace Numbers\Users\Users\Form\Report\Security;
class ResourceSetupReport extends \Object\Form\Wrapper\Report {
	public $form_link = 'um_resource_setup_report';
	public $module_code = 'UM';
	public $title = 'U/M Security Resource Setup Report';
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
				'sm_resource_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Resource #', 'domain' => 'resource_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_resource_id;>='],
				'sm_resource_id2' => ['order' => 2, 'label_name' => 'Resource #', 'domain' => 'resource_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_resource_id;<='],
				'sm_resource_module_code1' => ['order' => 3, 'label_name' => 'Module', 'type' => 'module_code', 'percent' => 50, 'null' => true, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Backend\System\Modules\Model\Modules', 'query_builder' => 'a.sm_resource_module_code;=']
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
		'sm_resource_id' => ['name' => 'Resource #'],
		'sm_resource_name' => ['name' => 'Resource Name'],
	];
	public $report_default_sort = [
		'sm_resource_id' => SORT_ASC
	];
	public function buildReport(& $form) {
		// create new report
		$report = new \Object\Form\Builder\Report();
		$report->addReport(DEF, $form);
		// add header
		$report->addHeader(DEF, 'row1', [
			'sm_resource_id' => ['label_name' => 'Resource #', 'percent' => 10],
			'sm_resource_name' => ['label_name' => 'Resource Name', 'percent' => 40],
			'sm_resource_module_code' => ['label_name' => 'Module', 'percent' => 20],
			'acl' => ['label_name' => 'ACL', 'percent' => 30],
		]);
		$report->addHeader(DEF, 'row2', [
			'blank' => ['label_name' => ' ', 'percent' => 10],
			'sm_resource_classification' => ['label_name' => 'Classification', 'percent' => 20],
			'sm_resource_description' => ['label_name' => 'Description', 'percent' => 70]
		]);
		$report->addHeader(DEF, 'separator', [
			'blank' => ['label_name' => ' ', 'percent' => 100]
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'actions', [
			'blank' => ['label_name' => ' ', 'percent' => 10],
			'name' => ['label_name' => 'Actions:', 'percent' => 40],
			'action_id' => ['label_name' => 'Action #', 'percent' => 10],
			'action_name' => ['label_name' => 'Action Name', 'percent' => 40],
		],
		[
			'skip_rendering' => true
		]);
		// query the data
		$query = \Numbers\Backend\System\Modules\Model\Resources::queryBuilderStatic()->select();
		$query->columns([
			'sm_resource_id' => 'a.sm_resource_id',
			'sm_resource_name' => 'a.sm_resource_name',
			'sm_resource_classification' => 'a.sm_resource_classification',
			'sm_resource_description' => 'a.sm_resource_description',
			'sm_resource_module_code' => 'a.sm_resource_module_code',
			'sm_resource_acl_public' => 'a.sm_resource_acl_public',
			'sm_resource_acl_authorized' => 'a.sm_resource_acl_authorized',
			'sm_resource_acl_permission' => 'a.sm_resource_acl_permission',
			'actions' => 'b.actions'
		]);
		// join
		$query->join('LEFT', function (& $query) {
			$query = \Numbers\Backend\System\Modules\Model\Resource\Map::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.sm_rsrcmp_resource_id',
				'actions' => $query->db_object->sqlHelper('string_agg', ['expression' => "concat_ws('::', inner_a.sm_rsrcmp_action_id)", 'delimiter' => ';;'])
			]);
			// join
			$query->join('INNER', new \Numbers\Backend\System\Modules\Model\Resource\Actions(), 'inner_b', 'ON', [
				['AND', ['inner_a.sm_rsrcmp_action_id', '=', 'inner_b.sm_action_id', true], false]
			]);
			$query->groupby(['inner_a.sm_rsrcmp_resource_id']);
			$query->where('AND', ['inner_a.sm_rsrcmp_inactive', '=', 0]);
			$query->where('AND', ['inner_b.sm_action_inactive', '=', 0]);
		}, 'b', 'ON', [
			['AND', ['a.sm_resource_id', '=', 'b.sm_rsrcmp_resource_id', true], false]
		]);
		$query->where('AND', ['a.sm_resource_type', '=', 100]);
		$query->where('AND', ['a.sm_resource_inactive', '=', 0]);
		$query->where('AND', function (& $query) {
			$query = \Numbers\Tenants\Tenants\Model\Modules::queryBuilderStatic(['alias' => 'exists_a'])->select();
			$query->columns(['exists_a.tm_module_module_code']);
			$query->where('AND', ['exists_a.tm_module_module_code', '=', 'a.sm_resource_module_code', true]);
		}, 'EXISTS');
		$form->processReportQueryFilter($query);
		$form->processReportQueryOrderBy($query);
		$data = $query->query(null, ['cache' => false]);
		// preload models
		$modules = \Numbers\Backend\System\Modules\Model\Modules::optionsStatic(['i18n' => true]);
		$actions = \Numbers\Backend\System\Modules\Model\Resource\Actions::optionsStatic(['i18n' => true]);
		// add data to report
		$counter = 1;
		foreach ($data['rows'] as $k => $v) {
			// replaces
			$v['sm_resource_id'] = \Format::id($v['sm_resource_id']);
			$v['sm_resource_classification'] = i18n(null, $v['sm_resource_classification']);
			$v['sm_resource_name'] = i18n(null, $v['sm_resource_name']);
			$v['sm_resource_module_code'] = $modules[$v['sm_resource_module_code']]['name'];
			$v['acl'] = [];
			if (!empty($v['sm_resource_acl_public'])) $v['acl'][] = i18n(null, 'Public');
			if (!empty($v['sm_resource_acl_authorized'])) $v['acl'][] = i18n(null, 'Authorized');
			if (!empty($v['sm_resource_acl_permission'])) $v['acl'][] = i18n(null, 'Permission');
			$v['acl'] = implode(', ', $v['acl']);
			$even = $counter % 2 ? ODD : EVEN;
			$report->addData(DEF, 'row1', $even, $v);
			$report->addData(DEF, 'row2', $even, $v);
			// actions
			if (!empty($v['actions'])) {
				$report->addData(DEF, 'separator', $even, ['blank' => ' ']);
				$report->addData(DEF, 'actions', $even, $report->getHeaderForRender(DEF, 'actions'));
				$temp = explode(';;', $v['actions']);
				$counter2 = $even + 1;
				foreach ($temp as $v0) {
					$report->addData(DEF, 'actions', $even, [
						'action_id' => \Format::id($v0),
						'action_name' => $actions[(int) $v0]['name']
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