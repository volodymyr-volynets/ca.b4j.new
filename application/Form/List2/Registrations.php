<?php

namespace Form\List2;
class Registrations extends \Object\Form\Wrapper\List2 {
	public $form_link = 'b4_registrations_list';
	public $module_code = 'B4';
	public $title = 'B/J Registrations List';
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
			'b4_registration_id' => [
				'b4_registration_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Reg. #', 'domain' => 'big_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.b4_registration_id;>='],
				'b4_registration_id2' => ['order' => 2, 'label_name' => 'Reg. #', 'domain' => 'big_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.b4_registration_id;<='],
				'b4_registration_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.b4_registration_inactive;=']
			],
			'b4_registration_period_id' => [
				'b4_registration_period_id1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Period', 'domain' => 'group_id', 'percent' => 50, 'placeholder' => \Object\Content\Messages::PLEASE_CHOOSE, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Model\Periods', 'query_builder' => 'a.b4_registration_period_id;='],
				'b4_registration_status_id1' => ['order' => 2, 'label_name' => 'Status', 'domain' => 'status_id', 'percent' => 50, 'placeholder' => \Object\Content\Messages::PLEASE_CHOOSE, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Model\Registration\Statuses', 'options_options' => ['i18n' => 'skip_sorting'], 'query_builder' => 'a.b4_registration_status_id;='],
			],
			'b4_registration_timestamp' => [
				'b4_registration_timestamp1' => ['order' => 1, 'row_order' => 250, 'label_name' => 'Timestamp', 'type' => 'datetime', 'method' => 'calendar', 'calendar_icon' => 'right', 'percent' => 50, 'null' => true, 'query_builder' => 'a.b4_registration_timestamp;>='],
				'b4_registration_timestamp2' => ['order' => 2, 'label_name' => 'Timestamp', 'type' => 'datetime', 'method' => 'calendar', 'calendar_icon' => 'right', 'percent' => 50, 'null' => true, 'query_builder' => 'a.b4_registration_timestamp;<='],				
			],
			'b4_registration_payment_received' => [
				'b4_registration_payment_received1' => ['order' => 1, 'row_order' => 270, 'label_name' => 'Payment Received', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.b4_registration_payment_received;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.b4_registration_child_name', 'a.b4_registration_parents_name', 'a.b4_registration_parish', 'a.b4_registration_email', 'a.b4_registration_phone'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'b4_registration_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Reg. #', 'domain' => 'big_id', 'percent' => 10, 'url_edit' => true],
				'b4_registration_child_name' => ['order' => 2, 'label_name' => 'Child Name', 'domain' => 'name', 'percent' => 45],
				'b4_registration_parents_name' => ['order' => 3, 'label_name' => 'Parents Name', 'domain' => 'name', 'percent' => 40],
				'b4_registration_inactive' => ['order' => 4, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'percent' => 10],
				'b4_registration_timestamp' => ['order' => 2, 'label_name' => 'Reg. Date', 'type' => 'datetime', 'percent' => 25],
				'b4_registration_period_id' => ['order' => 3, 'label_name' => 'Period', 'domain' => 'group_id', 'percent' => 40, 'options_model' => '\Model\Periods'],
				'b4_registration_parish' => ['order' => 4, 'label_name' => 'Parish', 'domain' => 'name', 'null' => true, 'percent' => 25],
			],
			'row3' => [
				'blank' => ['order' => 1, 'row_order' => 300, 'label_name' => '', 'percent' => 10],
				'b4_registration_status_id' => ['order' => 1, 'label_name' => 'Status', 'domain' => 'status_id', 'options_model' => '\Model\Registration\Statuses', 'percent' => 15],
				'b4_registration_register_id' => ['order' => 2, 'label_name' => 'Register #', 'domain' => 'big_id', 'percent' => 15],
				'b4_registration_email' => ['order' => 3, 'label_name' => 'Email', 'domain' => 'email', 'percent' => 30],
				'b4_registration_phone' => ['order' => 4, 'label_name' => 'Phone', 'domain' => 'phone', 'percent' => 30],
			]
		]
	];
	public $query_primary_model = '\Model\Registrations';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'b4_registration_id' => SORT_DESC
		]
	];
	const LIST_SORT_OPTIONS = [
		'b4_registration_id' => ['name' => 'Registration #'],
		'b4_registration_timestamp' => ['name' => 'Timestamp']
	];
}