<?php

namespace Numbers\Users\Organizations\Form\List2\Location;
class Territories extends \Object\Form\Wrapper\List2 {
	public $form_link = 'on_location_territories_list';
	public $module_code = 'ON';
	public $title = 'O/N Location Territories List';
	public $options = [
		'segment' => self::SEGMENT_LIST,
		'actions' => [
			'refresh' => true,
			'new' => true,
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
			'on_territory_id' => [
				'on_territory_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Territory #', 'domain' => 'territory_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.on_territory_id;>='],
				'on_territory_id2' => ['order' => 2, 'label_name' => 'Territory #', 'domain' => 'territory_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.on_territory_id;<='],
				'on_territory_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.on_territory_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.on_territory_name'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'on_territory_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Territory #', 'domain' => 'territory_id', 'percent' => 10, 'url_edit' => true],
				'on_territory_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 70],
				'on_territory_type_id' => ['order' => 3, 'label_name' => 'Type', 'domain' => 'type_id', 'percent' => 15, 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territory\Types'],
				'on_territory_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'__blank' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'percent' => 10],
				'on_territory_parent_territory_id' => ['order' => 2, 'label_name' => 'Parent', 'domain' => 'territory_id', 'percent' => 40, 'options_model' => '\Numbers\Users\Organizations\Model\Location\Territories'],
				'on_territory_postal_codes' => ['order' => 3, 'label_name' => 'Postal Codes', 'domain' => 'type_code', 'percent' => 50],
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\Organizations\Model\Location\Territories';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'on_territory_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'on_territory_id' => ['name' => 'Location #'],
		'on_territory_name' => ['name' => 'Name']
	];
}