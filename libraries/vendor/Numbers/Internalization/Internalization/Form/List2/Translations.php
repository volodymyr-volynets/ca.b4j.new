<?php

namespace Numbers\Internalization\Internalization\Form\List2;
class Translations extends \Object\Form\Wrapper\List2 {
	public $form_link = 'in_translations_list';
	public $module_code = 'IN';
	public $title = 'I/N Translations List';
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
			'in_translation_id1' => [
				'in_translation_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 25, 'null' => true, 'query_builder' => 'a.in_translation_id;>='],
				'in_translation_id2' => ['order' => 2, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 25, 'null' => true, 'query_builder' => 'a.in_translation_id;<='],
				'in_translation_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.in_translation_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.in_translation_from_text', 'a.in_translation_to_text'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'in_translation_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Translation #', 'domain' => 'big_id_sequence', 'percent' => 20, 'url_edit' => true],
				'in_translation_i18n_id' => ['order' => 2, 'label_name' => 'I18n #', 'domain' => 'group_id', 'percent' => 20],
				'in_translation_javascript' => ['order' => 2, 'label_name' => 'Javascript', 'type' => 'boolean', 'percent' => 5],
				'in_translation_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'in_translation_from_language_code' => ['order' => 1, 'row_order' => 200, 'label_name' => 'From Language', 'domain' => 'language_code', 'percent' => 20, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translation_from_text' => ['order' => 2, 'label_name' => 'From Text', 'type' => 'varchar', 'length' => 2500, 'percent' => 80],
			],
			'row3' => [
				'in_translation_to_language_code' => ['order' => 1, 'row_order' => 300, 'label_name' => 'To Language', 'domain' => 'language_code', 'percent' => 20, 'options_model' => '\Numbers\Internalization\Internalization\Model\Language\Codes'],
				'in_translation_to_text' => ['order' => 2, 'label_name' => 'To Text', 'type' => 'varchar', 'length' => 2500, 'percent' => 80],
			]
		]
	];
	public $query_primary_model = '\Numbers\Internalization\Internalization\Model\Translations';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'in_translation_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'in_translation_id' => ['name' => 'Translation #'],
		'in_translation_from_text' => ['name' => 'From Text'],
		'in_translation_to_text' => ['name' => 'To Text']
	];
}