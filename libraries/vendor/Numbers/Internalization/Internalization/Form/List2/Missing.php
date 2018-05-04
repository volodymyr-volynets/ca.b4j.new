<?php

namespace Numbers\Internalization\Internalization\Form\List2;
class Missing extends \Object\Form\Wrapper\List2 {
	public $form_link = 'in_missing_list';
	public $module_code = 'IN';
	public $title = 'I/N Missing List';
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
			'in_translmiss_id1' => [
				'in_translmiss_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 25, 'null' => true, 'query_builder' => 'a.in_translmiss_id;>='],
				'in_translmiss_id2' => ['order' => 2, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 25, 'null' => true, 'query_builder' => 'a.in_translmiss_id;<='],
				'in_translmiss_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.in_translmiss_inactive;=']
			],
			'in_translmiss_from_language_code' => [
				'in_translmiss_from_language_code1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'From Language', 'domain' => 'language_code', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes', 'query_builder' => 'a.in_translmiss_from_language_code;='],
				'in_translmiss_to_language_code1' => ['order' => 2, 'label_name' => 'To Language', 'domain' => 'language_code', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes', 'query_builder' => 'a.in_translmiss_to_language_code;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.in_translmiss_from_text'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'in_translmiss_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 15, 'url_edit' => true],
				'in_translmiss_from_language_code' => ['order' => 2, 'row_order' => 200, 'label_name' => 'From Language', 'domain' => 'language_code', 'percent' => 15, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translmiss_to_language_code' => ['order' => 3, 'row_order' => 200, 'label_name' => 'To Language', 'domain' => 'language_code', 'percent' => 15, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translmiss_from_text' => ['order' => 4, 'label_name' => 'From Text', 'type' => 'varchar', 'length' => 2500, 'percent' => 55],
			]
		]
	];
	public $query_primary_model = '\Numbers\Internalization\Internalization\Model\Translation\Missing';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'in_translmiss_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'in_translmiss_id' => ['name' => 'Missing #'],
		'in_translmiss_from_text' => ['name' => 'From Text']
	];
}