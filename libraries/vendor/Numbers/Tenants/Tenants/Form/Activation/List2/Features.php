<?php

namespace Numbers\Tenants\Tenants\Form\Activation\List2;
class Features extends \Object\Form\Wrapper\List2 {
	public $form_link = 'tm_feature_activation_list';
	public $module_code = 'TM';
	public $title = 'T/M Activation Features List';
	public $options = [
		'segment' => self::SEGMENT_LIST,
		'actions' => [
			'refresh' => true,
			'new' => ['value' => 'Activate Feature', 'onclick' => ''],
			'filter_sort' => ['value' => 'Filter/Sort', 'sort' => 32000, 'icon' => 'fas fa-filter', 'onclick' => 'Numbers.Form.listFilterSortToggle(this);']
		]
	];
	public $containers = [
		'tabs' => ['default_row_type' => 'grid', 'order' => 1000, 'type' => 'tabs', 'class' => 'numbers_form_filter_sort_container'],
		'filter' => ['default_row_type' => 'grid', 'order' => 1500],
		'sort' => self::LIST_SORT_CONTAINER,
		'buttons' => ['default_row_type' => 'grid', 'order' => 2000, 'class' => 'numbers_form_filter_sort_container'],
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
			'tm_module_id' => [
				'tm_feature_module_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Module #', 'domain' => 'module_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.tm_feature_module_id;>='],
				'tm_feature_module_id2' => ['order' => 2, 'label_name' => 'Module #', 'domain' => 'module_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.tm_feature_module_id;<='],
				'tm_feature_module_code1' => ['order' => 3, 'label_name' => 'Module Type', 'domain' => 'module_code', 'percent' => 50, 'null' => true, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Backend\System\Modules\Model\Modules', 'query_builder' => 'a.tm_feature_module_code', 'onchange' => 'this.form.submit();'],
			],
			'tm_feature_feature_code' => [
				'tm_feature_feature_code1' => ['order' => 1, 'row_order' => 200, 'label_name' => 'Feature Name', 'domain' => 'feature_code', 'percent' => 50, 'null' => true, 'query_builder' => 'a.tm_feature_feature_code', 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Numbers\Backend\System\Modules\Model\Module\Feature\Options', 'options_depends' => ['sm_feature_module_code' => 'tm_feature_module_code1']],
				'tm_feature_inactive1' => ['order' => 2, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.tm_feature_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['tm_module_name', 'tm_feature_feature_code', 'sm_feature_name'], 'placeholder' => 'Search in Module Name, Feature Code, Feature Name', 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'tm_feature_module_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Module #', 'domain' => 'module_id', 'percent' => 10],
				'tm_module_name' => ['order' => 2, 'label_name' => 'Module Name', 'domain' => 'name', 'percent' => 25],
				'tm_feature_feature_code' => ['order' => 3, 'label_name' => 'Feature Code', 'domain' => 'feature_code', 'percent' => 30],
				'sm_feature_name' => ['order' => 4, 'label_name' => 'Feature Name', 'domain' => 'name', 'percent' => 30],
				'tm_feature_inactive' => ['order' => 5, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5]
			]
		]
	];
	public $query_primary_model = '\Numbers\Tenants\Tenants\Model\Module\Features';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'tm_feature_module_id' => SORT_ASC,
			'sm_feature_name' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'tm_feature_module_id' => ['name' => 'Module #'],
		'tm_module_name' => ['name' => 'Module Name'],
		'tm_feature_feature_code' => ['name' => 'Feature Code'],
		'sm_feature_name' => ['name' => 'Feature Name'],
	];

	public function listQuery(& $form) {
		$form->query->join('INNER', new \Numbers\Backend\System\Modules\Model\Module\Features(), 'b', 'ON', [
			['AND', ['a.tm_feature_feature_code', '=', 'b.sm_feature_code', true], false]
		]);
		$form->query->join('INNER', new \Numbers\Tenants\Tenants\Model\Modules(), 'c', 'ON', [
			['AND', ['a.tm_feature_module_id', '=', 'c.tm_module_id', true], false]
		]);
		$form->query->columns([
			'a.*',
			'sm_feature_name' => 'b.sm_feature_name',
			'tm_module_name' => 'c.tm_module_name'
		]);
	}
}