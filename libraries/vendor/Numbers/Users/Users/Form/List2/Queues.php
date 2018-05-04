<?php

namespace Numbers\Users\Users\Form\List2;
class Queues extends \Object\Form\Wrapper\List2 {
	public $form_link = 'um_queues_list';
	public $module_code = 'UM';
	public $title = 'U/M Queues List';
	public $options = [
		'segment' => self::SEGMENT_LIST,
		'actions' => [
			'refresh' => true,
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
			'um_queue_id' => [
				'um_queue_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Queue #', 'domain' => 'queue_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_queue_id;>='],
				'um_queue_id2' => ['order' => 2, 'label_name' => 'Queue #', 'domain' => 'queue_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.um_queue_id;<='],
				'um_queue_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.um_queue_inactive;=']
			],
			/*
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.um_usrgrp_name'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
			]
			*/
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
				'um_queue_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Queue #', 'domain' => 'queue_id', 'percent' => 20],
				'um_queue_type_id' => ['order' => 2, 'label_name' => 'Queue Type #', 'domain' => 'type_id', 'percent' => 20, 'options_model' => '\Numbers\Users\Organizations\Model\Queue\Types'],
				'um_queue_hash' => ['order' => 3, 'label_name' => 'Hash', 'domain' => 'code', 'percent' => 30],
				'um_queue_user_id' => ['order' => 4, 'label_name' => 'User #', 'domain' => 'user_id', 'percent' => 25, 'options_model' => '\Numbers\Users\Users\Model\Users'],
				'um_queue_inactive' => ['order' => 5, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\Users\Model\Queues';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'um_queue_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'um_queue_id' => ['name' => 'Group #'],
		'um_queue_hash' => ['name' => 'Hash']
	];
}