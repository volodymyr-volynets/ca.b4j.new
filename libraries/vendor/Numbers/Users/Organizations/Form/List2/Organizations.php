<?php

namespace Numbers\Users\Organizations\Form\List2;
class Organizations extends \Object\Form\Wrapper\List2 {
	public $form_link = 'on_organizations_list';
	public $module_code = 'ON';
	public $title = 'O/N Organizations List';
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
			'on_organization_id' => [
				'on_organization_id1' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Organization #', 'domain' => 'organization_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.on_organization_id;>='],
				'on_organization_id2' => ['order' => 2, 'label_name' => 'Organization #', 'domain' => 'organization_id', 'percent' => 25, 'null' => true, 'query_builder' => 'a.on_organization_id;<='],
				'on_organization_inactive1' => ['order' => 3, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 50, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Object\Data\Model\Inactive', 'query_builder' => 'a.on_organization_inactive;=']
			],
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.on_organization_name', 'a.on_organization_code', 'a.on_organization_phone', 'a.on_organization_email'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'on_organization_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Org. #', 'domain' => 'organization_id', 'percent' => 10, 'url_edit' => true],
				'on_organization_name' => ['order' => 2, 'label_name' => 'Name', 'domain' => 'name', 'percent' => 60],
				'on_organization_code' => ['order' => 3, 'label_name' => 'Organization Code', 'domain' => 'group_code', 'percent' => 25],
				'on_organization_inactive' => ['order' => 5, 'label_name' => 'Inactive', 'type' => 'boolean', 'percent' => 5],
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => null, 'domain' => 'name', 'null' => true, 'percent' => 10],
				'types' => ['order' => 2, 'label_name' => 'Types', 'domain' => 'type_code', 'null' => true, 'percent' => 35, 'options_model' => '\Numbers\Users\Organizations\Model\Organization\Types'],
				'on_organization_email' => ['order' => 3, 'label_name' => 'Email', 'domain' => 'email', 'null' => true, 'percent' => 25],
				'on_organization_phone' => ['order' => 4, 'label_name' => 'Phone', 'domain' => 'phone', 'null' => true, 'percent' => 25],
				'on_organization_hold' => ['order' => 6, 'label_name' => 'Hold', 'type' => 'boolean', 'percent' => 5],
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\Organizations\Model\Organizations';
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'on_organization_id' => SORT_ASC
		]
	];
	const LIST_SORT_OPTIONS = [
		'on_organization_id' => ['name' => 'Organization #'],
		'on_organization_name' => ['name' => 'Name']
	];

	public function listQuery(& $form) {
		$result = [
			'success' => false,
			'error' => [],
			'total' => 0,
			'rows' => []
		];
		// joins
		$form->query->join('LEFT', function (& $query) {
			$query = \Numbers\Users\Organizations\Model\Organization\Type\Map::queryBuilderStatic(['alias' => 'inner_a'])->select();
			$query->columns([
				'inner_a.on_orgtpmap_organization_id',
				'types' => $query->db_object->sqlHelper('string_agg', ['expression' => 'on_orgtpmap_type_code', 'delimiter' => ';;'])
			]);
			$query->groupby(['inner_a.on_orgtpmap_organization_id']);
		}, 'b', 'ON', [
			['AND', ['a.on_organization_id', '=', 'b.on_orgtpmap_organization_id', true], false]
		]);
		// query #1 get counter
		$counter_query = clone $form->query;
		$counter_query->columns(['counter' => 'COUNT(*)'], ['empty_existing' => true]);
		$temp = $counter_query->query();
		if (!$temp['success']) {
			array_merge3($result['error'], $temp['error']);
			return $result;
		}
		$result['total'] = $temp['rows'][0]['counter'];
		// query #2 get rows
		$form->processListQueryOrderBy();
		$form->query->offset($form->values['__offset'] ?? 0);
		$form->query->limit($form->values['__limit']);
		$temp = $form->query->query();
		if (!$temp['success']) {
			array_merge3($result['error'], $temp['error']);
			return $result;
		}
		foreach ($temp['rows'] as $k => $v) {
			if (empty($v['types'])) {
				$temp['rows'][$k]['types'] = [];
			} else {
				$temp['rows'][$k]['types'] = explode(';;', $v['types']);
			}
		}
		$result['rows'] = & $temp['rows'];
		$result['success'] = true;
		return $result;
	}
}