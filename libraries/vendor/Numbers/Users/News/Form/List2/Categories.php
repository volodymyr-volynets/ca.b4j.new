<?php

namespace Numbers\Users\News\Form\List2;
class Categories extends \Object\Form\Wrapper\List2 {
	public $form_link = 'ns_categories_list';
	public $module_code = 'NS';
	public $title = 'N/S Categories List';
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
			'ns_category_id' => [
				'ns_category_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Category #', 'domain' => 'group_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.ns_category_id;>='],
				'ns_category_id2' => ['order' => 2, 'label_name' => 'Category #', 'domain' => 'group_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.ns_category_id;<='],
				'ns_category_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.ns_category_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.ns_category_name'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'ns_category_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Category #', 'domain' => 'group_id', 'percent' => 10, 'url_edit' => true],
				'ns_category_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 75],
				'ns_category_order' => ['order' => 3, 'label_name' => 'Order', 'domain' => 'order', 'percent' => 10, 'required' => true],
				'ns_category_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\News\Model\Categories';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'ns_category_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'ns_category_id' => ['name' => 'Group #'],
		'ns_category_name' => ['name' => 'Name']
	];
}