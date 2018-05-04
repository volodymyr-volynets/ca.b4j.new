<?php

namespace Numbers\Users\Users\Form\List2\Scheduling;
class Holidays extends \Object\Form\Wrapper\List2 {
	public $form_link = 'um_scheduling_holidays_list';
	public $module_code = 'UM';
	public $title = 'U/M Scheduling Holidays List';
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
			'um_schedholi_id' => [
				'um_schedholi_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Holiday #', 'domain' => 'holiday_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_schedholi_id;>='],
				'um_schedholi_id2' => ['order' => 2, 'label_name' => 'Holiday #', 'domain' => 'holiday_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_schedholi_id;<='],
				'um_schedholi_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.um_schedholi_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.um_schedholi_name'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'um_schedholi_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Holiday #', 'domain' => 'holiday_id', 'percent' => 10, 'url_edit' => true],
				'um_schedholi_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 75],
				'um_schedholi_date' => ['order' => 3, 'label_name' => 'Date', 'type' => 'date', 'percent' => 10],
				'um_schedholi_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'percent' => 10],
				'um_schedshift_organization_id' => ['order' => 2, 'label_name' => 'Organization', 'domain' => 'organization_id', 'percent' => 20, 'options_model' => '\Numbers\Users\Organizations\Model\Organizations'],
				'um_schedshift_location_id' => ['order' => 3, 'label_name' => 'Location', 'domain' => 'location_id', 'null' => true, 'percent' => 20, 'options_model' => '\Numbers\Users\Organizations\Model\Locations'],
				'um_schedholi_country_code' => ['order' => 4, 'label_name' => 'Country', 'domain' => 'country_code', 'null' => true, 'percent' => 25, 'options_model' => '\Numbers\Countries\Countries\Model\Countries'],
				'um_schedholi_province_code' => ['order' => 5, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'percent' => 25, 'options_model' => '\Numbers\Countries\Countries\Model\Provinces', 'options_depends' => ['cm_province_country_code' => 'um_schedholi_country_code']],
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\Users\Model\Scheduling\Holidays';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'um_schedholi_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'um_schedholi_id' => ['name' => 'Holiday #'],
		'um_schedholi_name' => ['name' => 'Name']
	];
}