<?php

namespace Numbers\Users\Monitoring\Form\Report\Account;
class ActivityLog extends \Object\Form\Wrapper\Report {
	public $form_link = 'account_activity_log_report';
	public $module_code = 'SM';
	public $title = 'S/M Account Activity Log Report';
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
				'sm_monusage_timestamp1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Date & Time', 'type' => 'datetime', 'percent' => 25, 'required' => true, 'method'=> 'calendar', 'calendar_icon' => 'right', 'null' => true, 'query_builder' => 'a.sm_monusage_timestamp;>='],
				'sm_monusage_timestamp2' => ['order' => 2, 'label_name' => 'Date & Time', 'type' => 'datetime', 'percent' => 25, 'required' => true, 'method'=> 'calendar', 'calendar_icon' => 'right', 'null' => true, 'query_builder' => 'a.sm_monusage_timestamp;<='],
				'sm_monusage_session_id1' => ['order' => 3, 'row_order' => 200, 'label_name' => 'Session #', 'domain' => 'big_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_session_id;>='],
				'sm_monusage_session_id2' => ['order' => 4, 'label_name' => 'Session #', 'domain' => 'big_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_session_id;<='],
			],
			self::HIDDEN => [
				'sm_monusage_user_id1' => ['order' => 3, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_user_id;>=', 'method' => 'hidden'],
				'sm_monusage_user_id2' => ['order' => 4, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_user_id;<=', 'method' => 'hidden'],
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
		'sm_monusage_id' => ['name' => 'Usage #'],
		'sm_monusage_timestamp' => ['name' => 'Timestamp'],
	];
	public $report_default_sort = [
		'sm_monusage_id' => SORT_DESC
	];
	public function buildReport(& $form) {
		// create new report
		$report = new \Object\Form\Builder\Report();
		$report->addReport(DEF, $form);
		// add header
		$report->addHeader(DEF, 'row1', [
			'sm_monusage_id' => ['label_name' => 'Usage #', 'percent' => 20],
			'sm_monusage_session_id' => ['label_name' => 'Session #', 'percent' => 20],
			'sm_monusage_timestamp' => ['label_name' => 'Timestamp', 'percent' => 20],
			'sm_resource_name' => ['label_name' => 'Resource Name', 'percent' => 30],
			'sm_monusage_duration' => ['label_name' => 'Duration', 'percent' => 10, 'data_align' => 'right']
		]);
		$report->addHeader(DEF, 'row2', [
			'_blank' => ['label_name' => '', 'percent' => 20],
			'sm_monusage_user_id' => ['label_name' => 'User #', 'percent' => 20],
			'sm_monusage_user_ip' => ['label_name' => 'User IP', 'percent' => 20],
			'um_user_name' => ['label_name' => 'User Name', 'percent' => 40],
		]);
		$report->addHeader(DEF, 'row3', [
			'_blank' => ['label_name' => '', 'percent' => 20],
			'_actions' => ['label_name' => 'Actions:', 'percent' => 10],
			'sm_monusgact_usage_code' => ['label_name' => 'Usage Type', 'percent' => 20],
			'sm_monusgact_affected_rows' => ['label_name' => 'Affected rows', 'percent' => 20],
			'sm_monusgact_error_rows' => ['label_name' => 'Error rows', 'percent' => 20],
			'sm_monusgact_url' => ['label_name' => 'URL', 'percent' => 10],
		],
		[
			'skip_rendering' => true
		]);
		$report->addHeader(DEF, 'row4', [
			'_blank' => ['label_name' => '', 'percent' => 30],
			'sm_monusgact_message' => ['label_name' => 'Message', 'percent' => 70],
		],
		[
			'skip_rendering' => true
		]);
		// query the data
		$query = \Numbers\Users\Monitoring\Model\Usages::queryBuilderStatic()->select();
		$query->columns('a.*');
		// join to get resource name
		$query->join('LEFT', new \Numbers\Backend\System\Modules\Model\Resources(), 'b', 'ON', [
			['AND', ['a.sm_monusage_resource_id', '=', 'b.sm_resource_id', true], false]
		]);
		$query->columns(['sm_resource_name' => 'COALESCE(b.sm_resource_name, a.sm_monusage_resource_name)']);
		// join to get user name
		$query->join('LEFT', new \Numbers\Users\Users\Model\Users(), 'c', 'ON', [
			['AND', ['a.sm_monusage_user_id', '=', 'c.um_user_id', true], false]
		]);
		$query->columns('c.um_user_name');
		$form->processReportQueryFilter($query);
		$form->processReportQueryOrderBy($query);
		$data = $query->query(null, ['cache' => false]);
		// load actions
		$usage_ids = [];
		foreach ($data['rows'] as $k => $v) {
			$usage_ids[]= $v['sm_monusage_id'];
		}
		$query2 = \Numbers\Users\Monitoring\Model\Usage\Actions::queryBuilderStatic()->select();
		$query2->columns('a.*');
		$query2->where('AND', ['a.sm_monusgact_usage_id', '=', $usage_ids, false]);
		$data2 = $query2->query(['sm_monusgact_usage_id' , 'sm_monusgact_action_id'], ['cache' => false]);
		// preload models
		$usage_codes = \Object\Controller\Model\UsageCodes::optionsStatic(['i18n' => true]);
		// build report
		$counter = 1;
		foreach ($data['rows'] as $k => $v) {
			// replaces
			$v['sm_monusage_timestamp'] = \Format::datetime($v['sm_monusage_timestamp']);
			$v['sm_monusage_user_id'] = ['value' => \Format::id($v['sm_monusage_user_id']), 'url' => \Request::buildURL('/Numbers/Users/Users/Controller/Users/_Edit', ['um_user_id' => $v['sm_monusage_user_id']])];
			// add main rows
			$even = $counter % 2 ? ODD : EVEN;
			$report->addData(DEF, 'row1', $even, $v);
			$report->addData(DEF, 'row2', $even, $v);
			// actions
			if (!empty($data2['rows'][$v['sm_monusage_id']])) {
				$report->addData(DEF, 'row3', $even, $report->getHeaderForRender(DEF, 'row3'));
				$report->addData(DEF, 'row4', $even, $report->getHeaderForRender(DEF, 'row4'));
				$counter2 = $even + 1;
				foreach ($data2['rows'][$v['sm_monusage_id']] as $k2 => $v2) {
					$v2['sm_monusgact_url'] = ['value' => i18n(null, \Object\Content\Messages::CLICK_HERE), 'url' => $v2['sm_monusgact_url']];
					$v2['sm_monusgact_usage_code'] = $usage_codes[$v2['sm_monusgact_usage_code']]['name'];
					$report->addData(DEF, 'row3', $even, $v2, [
						'cell_even' => $counter2 % 2 ? ODD : EVEN
					]);
					$report->addData(DEF, 'row4', $even, [
						'sm_monusgact_message' => \I18n::processMessage($v2['sm_monusgact_message'], $v2['sm_monusgact_replace']),
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
		unset($data, $data2);
		// we must return report object
		return $report;
	}
}