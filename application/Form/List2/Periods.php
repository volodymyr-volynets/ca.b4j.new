<?php

namespace Form\List2;
class Periods extends \Object\Form\Wrapper\List2 {
	public $form_link = 'b4_periods_list';
	public $module_code = 'B4';
	public $title = 'B/J Periods List';
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
			'b4_period_id' => [
				'b4_period_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Period #', 'domain' => 'group_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.b4_period_id;>='],
				'b4_period_id2' => ['order' => 2, 'label_name' => 'Period #', 'domain' => 'group_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.b4_period_id;<='],
				'b4_period_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.b4_period_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.b4_period_name'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'b4_period_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Period #', 'domain' => 'group_id', 'percent' => 10, 'url_edit' => true],
				'b4_period_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 85],
				'b4_period_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'percent' => 10],
				'b4_period_code' => ['order' => 2, 'label_name' => 'Code', 'domain' => 'code', 'percent' => 40],
				'b4_period_start_date' => ['order' => 3, 'label_name' => 'Reg. Start Date', 'type' => 'datetime', 'percent' => 25],
				'b4_period_end_date' => ['order' => 4, 'label_name' => 'Reg. End Date', 'type' => 'datetime', 'percent' => 25],
			],
			'row3' => [
				'blank' => ['order' => 1, 'row_order' => 300, 'label_name' => '', 'percent' => 10],
				'b4_period_max_registrations' => ['order' => 2, 'label_name' => 'Max Registrations', 'domain' => 'counter', 'percent' => 40],
				'b4_period_new_registrations' => ['order' => 3, 'label_name' => 'New Registrations', 'domain' => 'counter', 'percent' => 25],
				'b4_period_confirmed_registrations' => ['order' => 4, 'label_name' => 'Confirmed Registrations', 'domain' => 'counter', 'percent' => 25],
			]
		]
	];
	public $query_primary_model = '\Model\Periods';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'b4_period_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'b4_period_id' => ['name' => 'Period #'],
		'b4_period_name' => ['name' => 'Name']
	];
}