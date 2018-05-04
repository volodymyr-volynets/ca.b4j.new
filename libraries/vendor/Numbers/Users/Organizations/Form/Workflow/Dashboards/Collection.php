<?php

namespace Numbers\Users\Organizations\Form\Workflow\Dashboards;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'on_workflow_dashboards_collection';
	public $data = [];

	public function __construct($options = []) {
		// load data
		$model = new \Numbers\Users\Organizations\DataSource\Workflow\Dashboards();
		$dashboard_data = $model->get([
			'where' => [
				'module_id' => (int) $options['input']['on_execwflow_linked_module_id'],
				'entry_type' => $options['input']['on_execwflow_linked_type_code'] ?? []
			]
		]);
		$dashboards = \Numbers\Users\Organizations\Model\Service\Workflow\Dashboards::getStatic([
			'pk' => ['on_workdashboard_id']
		]);
		$linked_types = \Numbers\Users\Organizations\Model\Service\Executed\Linked\Types::optionsStatic(['i18n' => true]);
		$index = 0;
		foreach ($dashboard_data as $k => $v) {
			$table = [
				'header' => [
					'row_number' => '',
					'row_data' => ''
				],
				'options' => [],
				'skip_header' => true
			];
			$data = [
				'options' => []
			];
			$data['options']['row1']['id']['id'] = [
				'label' => i18n(null, 'Workflow #'),
				'options' => [
					'percent' => 15
				]
			];
			$data['options']['row1']['type']['type'] = [
				'label' => i18n(null, 'Type'),
				'options' => [
					'percent' => 15
				]
			];
			$data['options']['row1']['linked_id']['linked_id'] = [
				'label' => i18n(null, 'Transaction #'),
				'options' => [
					'percent' => 15
				]
			];
			$data['options']['row1']['workflow_name']['workflow_name'] = [
				'label' => i18n(null, 'Workflow Name'),
				'options' => [
					'percent' => 30
				]
			];
			$data['options']['row1']['workflow_name']['workflow_name'] = [
				'label' => i18n(null, 'Workflow Name'),
				'options' => [
					'percent' => 30
				]
			];
			$data['options']['row1']['alarm_name']['alarm_name'] = [
				'label' => i18n(null, 'Alarm'),
				'options' => [
					'percent' => 25
				]
			];
			$data['options']['row2']['id']['id'] = [
				'label' => ' ',
				'options' => [
					'percent' => 15
				]
			];
			$data['options']['row2']['customer_name']['customer_name'] = [
				'label' => i18n(null, 'Customer Name'),
				'options' => [
					'percent' => 35
				]
			];
			$data['options']['row2']['customer_phone']['customer_phone'] = [
				'label' => i18n(null, 'Customer Phone'),
				'options' => [
					'percent' => 25
				]
			];
			$data['options']['row2']['customer_email']['customer_email'] = [
				'label' => i18n(null, 'Customer Email'),
				'options' => [
					'percent' => 25
				]
			];
			// add a row to a table
			$table['options']['__header'] = [
				'row_number' => ['value' => '&nbsp;', 'width' => '1%'],
				'row_data' => ['value' => \HTML::grid($data), 'width' => '99%'],
			];
			$row_number = 1;
			foreach ($v as $k2 => $v2) {
				$data = [
					'options' => []
				];
				$data['options']['row1']['id']['id'] = [
					'value' => \Format::id($v2['id']),
					'options' => [
						'percent' => 15
					]
				];
				$data['options']['row1']['type']['type'] = [
					'value' => $linked_types[$v2['type']]['name'],
					'options' => [
						'percent' => 15
					]
				];
				$url = \Numbers\Users\Organizations\Helper\Workflow\Helper::generateLinkedIdURL($v2['type'], $v2['module_id'], $v2['linked_id']);
				$data['options']['row1']['linked_id']['linked_id'] = [
					'value' => \HTML::a(['href' => $url, 'value' => \Format::id($v2['linked_id'])]),
					'options' => [
						'percent' => 15
					]
				];
				$data['options']['row1']['workflow_name']['workflow_name'] = [
					'value' => i18n(null, $v2['workflow_name']),
					'options' => [
						'percent' => 30
					]
				];
				$data['options']['row1']['alarm_name']['alarm_name'] = [
					'value' => i18n(null, $v2['alarm_name']),
					'options' => [
						'percent' => 30
					]
				];
				$data['options']['row2']['id']['id'] = [
					'value' => ' ',
					'options' => [
						'percent' => 15
					]
				];
				$data['options']['row2']['customer_name']['customer_name'] = [
					'value' => $v2['customer_name'],
					'options' => [
						'percent' => 35
					]
				];
				$data['options']['row2']['customer_phone']['customer_phone'] = [
					'value' => $v2['customer_phone'],
					'options' => [
						'percent' => 25
					]
				];
				$data['options']['row2']['customer_email']['customer_email'] = [
					'value' => $v2['customer_email'],
					'options' => [
						'percent' => 25
					]
				];
				$table['options'][$row_number] = [
					'row_number' => ['value' => \Format::id($row_number) . '.', 'width' => '1%'],
					'row_data' => ['value' => \HTML::grid($data), 'width' => (!empty($options['details_11']) ? '100%' : '98%')],
				];
				$row_number++;
			}
			$html = \HTML::segment([
				'type' => 'primary',
				'value' => \HTML::table($table),
				'header' => [
					'icon' => ['type' => $dashboards[$k]['on_workdashboard_icon']],
					'title' => i18n(null, $dashboards[$k]['on_workdashboard_name']),
				]
			]);
			$this->data[self::MAIN_SCREEN][self::ROWS]['dashboard_row_' . $k]['order'] = $index;
			$this->data[self::MAIN_SCREEN][self::ROWS]['dashboard_row_' . $k][self::FORMS]['dashboard_form_' . $k] = [
				'html' => $html,
				'order' => $index
			];
			$index++;
		}
		parent::__construct($options);
	}

	public function distribute() {

	}
}