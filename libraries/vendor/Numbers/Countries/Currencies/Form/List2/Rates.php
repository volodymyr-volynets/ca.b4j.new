<?php

namespace Numbers\Countries\Currencies\Form\List2;
class Rates extends \Object\Form\Wrapper\List2 {
	public $form_link = 'cy_currency_rates_list';
	public $module_code = 'CY';
	public $title = 'C/Y Currency Rates List';
	public $options = [
		'segment' => self::SEGMENT_LIST,
		'actions' => [
			'refresh' => true,
			'new' => ['onclick' => null],
			'filter_sort' => ['value' => 'Filter/Sort', 'sort' => 32000, 'icon' => 'fas fa-filter', 'onclick' => 'Numbers.Form.listFilterSortToggle(this);']
		]
	];
	public $containers = [
		'tabs' => ['default_row_type' => 'grid', 'order' => 1000, 'type' => 'tabs', 'class' => 'numbers_form_filter_sort_container'],
		'filter' => ['default_row_type' => 'grid', 'order' => 1500],
		'sort' => self::LIST_SORT_CONTAINER,
		self::LIST_CONTAINER => ['default_row_type' => 'grid', 'order' => PHP_INT_MAX],
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
			'cy_currrate_id' => [
				'cy_currrate_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Rate #', 'domain' => 'currency_rate_id_sequence', 'percent' => 25, 'null' => true, 'query_builder' => 'a.cy_currrate_id;>='],
				'cy_currrate_id2' => ['order' => 2, 'label_name' => 'Rate #', 'domain' => 'currency_rate_id_sequence', 'percent' => 25, 'null' => true, 'query_builder' => 'a.cy_currrate_id;<='],
				'cy_currrate_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.cy_currrate_inactive;=']
			],
			'cy_currrate_currency_type' => [
				'cy_currrate_datetime1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Datetime', 'type' => 'datetime', 'percent' => 25, 'null' => true, 'method' => 'calendar', 'calendar_icon' => 'right', 'query_builder' => 'a.cy_currrate_datetime;>='],
				'cy_currrate_datetime2' => ['order' => 2, 'label_name' => 'Datetime', 'type' => 'datetime', 'percent' => 25, 'null' => true, 'method' => 'calendar', 'calendar_icon' => 'right', 'query_builder' => 'a.cy_currrate_datetime;<='],
				'cy_currrate_currency_type1' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'currency_type', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Countries\Currencies\Model\Types', 'query_builder' => 'a.cy_currrate_currency_type;=']
			]
		],
		'sort' => [
			'__sort' => [
				'__sort' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Sort', 'domain' => 'code', 'details_unique_select' => true, 'percent' => 50, 'null' => true, 'method' => 'select', 'options' => self::LIST_SORT_OPTIONS, 'onchange' => 'this.form.submit();'],
				'__order' => ['order' => 2, 'label_name' => 'Order', 'type' => 'smallint', 'default' => SORT_ASC, 'percent' => 50, 'null' => true, 'method' => 'select', 'no_choose' => true, 'options_model' => '\Object\Data\Model\Order', 'onchange' => 'this.form.submit();'],
			]
		],
		self::LIST_BUTTONS => self::LIST_BUTTONS_DATA,
		self::LIST_CONTAINER => [
			'row1' => [
				'cy_currrate_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Rate #', 'domain' => 'currency_rate_id_sequence', 'percent' => 15, 'url_edit' => true],
				'cy_currrate_datetime' => ['order' => 2, 'label_name' => 'Datetime', 'type' => 'datetime', 'percent' => 15],
				'cy_currrate_currency_type' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'currency_type', 'null' => false, 'percent' => 65, 'options_model' => '\Numbers\Countries\Currencies\Model\Types'],
				'cy_currrate_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => ' ', 'percent' => 15],
				'cy_currrate_source_currency_code' => ['order' => 2, 'label_name' => 'Source Currency', 'domain' => 'currency_code', 'percent' => 15],
				'cy_currrate_home_currency_code' => ['order' => 3, 'label_name' => 'Home Currency', 'domain' => 'currency_code', 'percent' => 15],
				'cy_currrate_rate' => ['order' => 4, 'label_name' => 'Rate', 'domain' => 'currency_rate', 'percent' => 10],
				'blank2' => ['order' => 5, 'label_name' => ' ', 'percent' => 5],
				'cy_currrate_provider_name' => ['order' => 6, 'label_name' => 'Provider Name', 'domain' => 'name', 'null' => true, 'percent' => 45],
			]
		]
	];
	public $query_primary_model = '\Numbers\Countries\Currencies\Model\Rates';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'cy_currrate_id' => SORT_DESC
		]
	];
	const LIST_SORT_OPTIONS = [
		'cy_currrate_id' => ['name' => 'Rate #'],
		'cy_currrate_datetime' => ['name' => 'Datetime']
	];
}