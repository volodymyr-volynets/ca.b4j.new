<?php

namespace Numbers\Users\Monitoring\Form\Report;
class ActivityLog extends \Object\Form\Wrapper\Report {
	public $form_link = 'activity_log_report';
	public $module_code = 'SM';
	public $title = 'S/M Activity Log Report';
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
				'sm_monusage_user_id1' => ['order' => 3, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_user_id;>='],
				'sm_monusage_user_id2' => ['order' => 4, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_user_id;<='],
			],
			'session' => [
				'sm_monusage_session_id1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Session #', 'type' => 'bigint', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_session_id;>='],
				'sm_monusage_session_id2' => ['order' => 2, 'label_name' => 'Session #', 'type' => 'bigint', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_session_id;<='],
				'sm_monusage_user_ip1' => ['order' => 3, 'label_name' => 'User IP', 'domain' => 'ip', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_user_ip;>='],
				'sm_monusage_user_ip2' => ['order' => 4, 'label_name' => 'User IP', 'domain' => 'ip', 'percent' => 25, 'null' => true, 'query_builder' => 'a.sm_monusage_user_ip;<='],
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
		'sm_monusage_timestamp' => ['name' => 'Timestamp']
	];
	public $report_default_sort = [
		'sm_monusage_timestamp' => SORT_DESC
	];
	public function buildReport(& $form) {
		// create new report
		$report = new \Object\Form\Builder\Report();
		$report->addReport(DEF, $form);
		// add header
		$report->addHeader(DEF, 'row1', [
			'sm_monusage_session_id' => ['label_name' => 'Session #', 'percent' => 20],
			'sm_monusage_timestamp' => ['label_name' => 'Timestamp', 'percent' => 20],
			'sm_monusage_user_id' => ['label_name' => 'User #', 'percent' => 10],
			'sm_monusage_user_ip' => ['label_name' => 'User IP', 'percent' => 10],
			'sm_monusage_resource_name' => ['label_name' => 'Resource Name', 'percent' => 30],
			'sm_monusage_duration' => ['label_name' => 'Duration', 'percent' => 10, 'data_align' => 'right']
		]);
		// query the data
		$query = \Numbers\Users\Monitoring\Model\Usages::queryBuilderStatic()->select();
		$query->columns('a.*');
		$form->processReportQueryFilter($query);
		$form->processReportQueryOrderBy($query);
		$data = $query->query(null, ['cache' => false]);
		$counter = 1;
		foreach ($data['rows'] as $k => $v) {
			// replaces
			$v['sm_monusage_timestamp'] = \Format::datetime($v['sm_monusage_timestamp']);
			$even = $counter % 2 ? ODD : EVEN;
			$report->addData(DEF, 'row1', $even, $v);
			$counter++;
		}
		$report->addSeparator(DEF);
		// add number of rows
		$rows = count($data['rows']);
		$report->addLegend(DEF, i18n(null, \Object\Content\Messages::REPORT_ROWS_NUMBER, ['replace' => ['[Number]' => $rows]]));
		// free up memory
		unset($data);
		// we must return report object
		return $report;
	}
}