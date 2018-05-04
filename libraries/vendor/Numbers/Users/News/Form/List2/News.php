<?php

namespace Numbers\Users\News\Form\List2;
class News extends \Object\Form\Wrapper\List2 {
	public $form_link = 'ns_news_list';
	public $module_code = 'NS';
	public $title = 'N/S News List';
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
			'ns_new_id' => [
				'ns_new_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'News #', 'domain' => 'group_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.ns_new_id;>='],
				'ns_new_id2' => ['order' => 2, 'label_name' => 'News #', 'domain' => 'group_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.ns_new_id;<='],
				'ns_new_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.ns_new_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.ns_new_title', 'a.ns_new_content'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'ns_new_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'News #', 'domain' => 'group_id', 'percent' => 10, 'url_edit' => true],
				'ns_new_title' => ['order' => 2, 'label_name' => 'Title', 'domain' => 'name', 'percent' => 50],
				'ns_new_language_code' => ['order' => 3, 'label_name' => 'Language', 'domain' => 'language_code', 'percent' => 15, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'ns_new_start_date' => ['order' => 4, 'label_name' => 'Start Date', 'type' => 'date', 'null' => true, 'percent' => 10],
				'ns_new_end_date' => ['order' => 5, 'label_name' => 'End Date', 'type' => 'date', 'null' => true, 'percent' => 10],
				'ns_new_inactive' => ['order' => 6, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'percent' => 10],
				'ns_new_content' => ['order' => 2, 'label_name' => 'Content', 'domain' => 'name', 'percent' => 85],
				'ns_new_hot' => ['order' => 3, 'label_name' => 'Hot', 'type' => 'boolean', 'percent' => 5]
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\News\Model\News';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'ns_new_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'ns_new_id' => ['name' => 'News #'],
		'ns_new_title' => ['name' => 'Name']
	];
}