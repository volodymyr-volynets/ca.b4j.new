<?php

namespace Numbers\Countries\Countries\Form\List2;
class PostalCodes extends \Object\Form\Wrapper\List2 {
	public $form_link = 'cm_postal_codes_list';
	public $module_code = 'CM';
	public $title = 'C/M Postal Codes List';
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
			'cm_postal_country_code1' => [
				'cm_postal_country_code1' => ['order' => 1, 'row_order' => 95, 'label_name' => 'Country', 'domain' => 'country_code', 'percent' => 100, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Countries\Countries\Model\Countries', 'query_builder' => 'a.cm_postal_country_code;='],
			],
			'in_locale_code1' => [
				'cm_postal_postal_code1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'percent' => 25, 'null' => true, 'query_builder' => 'a.cm_postal_postal_code;>='],
				'cm_postal_postal_code2' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'percent' => 25, 'null' => true, 'query_builder' => 'a.cm_postal_postal_code;<='],
				'cm_postal_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.cm_postal_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.cm_postal_postal_code'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'cm_postal_country_code' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Country', 'domain' => 'country_code', 'percent' => 30, 'url_edit' => true, 'options_model' => '\Numbers\Countries\Countries\Model\Countries'],
				'cm_postal_postal_code' => ['order' => 2, 'label_name' => 'Postal Code', 'domain' => 'postal_code', 'percent' => 65, 'url_edit' => true],
				'cm_postal_inactive' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => ' ', 'percent' => 10],
				'cm_postal_province_code' => ['order' => 2, 'label_name' => 'Province', 'domain' => 'province_code', 'null' => true, 'percent' => 45, 'options_model' => '\Numbers\Countries\Countries\Model\Provinces', 'options_depends' => ['cm_province_country_code' => 'cm_postal_country_code']],
				'cm_postal_city' => ['order' => 3, 'label_name' => 'City', 'domain' => 'name', 'null' => true, 'percent' => 45],
			]
		]
	];
	public $query_primary_model = '\Numbers\Countries\Countries\Model\PostalCodes';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'cm_postal_postal_code' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'cm_postal_postal_code' => ['name' => 'Postal Code']
	];
}

/**
 * 		'cm_postal_country_code' => ['name' => 'Country Code', 'domain' => 'country_code'],
		'cm_postal_province_code' => ['name' => 'Province Code', 'domain' => 'province_code', 'null' => true],
		'cm_postal_postal_code' => ['name' => 'Postal Code', 'domain' => 'postal_code'],
		'cm_postal_city' => ['name' => 'City', 'domain' => 'name', 'null' => true],
		'cm_postal_latitude' => ['name' => 'Latitude', 'domain' => 'geo_coordinate', 'null' => true],
		'cm_postal_longitude' => ['name' => 'Longitude', 'domain' => 'geo_coordinate', 'null' => true],
		'cm_postal_inactive' => ['name' => 'Inactive', 'type' => 'boolean']
 */