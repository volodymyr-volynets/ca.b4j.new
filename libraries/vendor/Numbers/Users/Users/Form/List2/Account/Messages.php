<?php

namespace Numbers\Users\Users\Form\List2\Account;
class Messages extends \Object\Form\Wrapper\List2 {
	public $form_link = 'um_account_messages_list';
	public $module_code = 'UM';
	public $title = 'U/M Account Messages List';
	public $options = [
		'segment' => self::SEGMENT_LIST,
		'actions' => [
			'refresh' => true,
			'new' => ['href' => '/Numbers/Users/Users/Controller/Account/Messages/_New'],
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
			'full_text_search' => [
				'full_text_search' => ['order' => 1, 'row_order' => 300, 'label_name' => 'Text Search', 'full_text_search_columns' => ['a.keywords'], 'placeholder' => true, 'domain' => 'name', 'percent' => 100, 'null' => true],
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
				'message_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Message #', 'domain' => 'message_id', 'percent' => 10, 'url_edit' => true],
				'subject' => ['order' => 2, 'label_name' => 'Subject / Chat', 'type' => 'text', 'percent' => 70, 'custom_renderer' => '\Numbers\Users\Users\Form\List2\Account\Messages::renderSubjectAndBody'],
				'from_name' => ['order' => 3, 'label_name' => 'From', 'type' => 'text', 'null' => true, 'percent' => 20, 'custom_renderer' => '\Numbers\Users\Users\Form\List2\Account\Messages::renderSubjectAndBody']
			],
			'row2' => [
				'blank' => ['order' => 1, 'row_order' => 200, 'label_name' => null, 'domain' => 'name', 'null' => true, 'percent' => 10],
				'body' => ['order' => 2, 'label_name' => 'Body', 'type' => 'text', 'null' => true, 'percent' => 80, 'custom_renderer' => '\Numbers\Users\Users\Form\List2\Account\Messages::renderSubjectAndBody'],
				'timestamp' => ['order' => 3, 'label_name' => 'Timestamp', 'type' => 'timestamp', 'percent' => 10, 'format' => 'niceTimestamp', 'custom_renderer' => '\Numbers\Users\Users\Form\List2\Account\Messages::renderSubjectAndBody'],
			]
		]
	];
	public $query_primary_model = '\Numbers\Users\Users\DataSource\Messages';
	public $query_primary_parameters = [];
	public $list_options = [
		'pagination_top' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'pagination_bottom' => '\Numbers\Frontend\HTML\Form\Renderers\HTML\Pagination\Base',
		'default_limit' => 30,
		'default_sort' => [
			'message_id' => SORT_DESC
		]
	];
	const LIST_SORT_OPTIONS = [
		'message_id' => ['name' => 'Message #']
	];

	public function listQuery(& $form) {
		$result = [
			'success' => false,
			'error' => [],
			'total' => 0,
			'rows' => []
		];
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
			if (!empty($v['body'])) {
				$temp2 = strip_tags2($v['body']);
				$temp2 = str_replace("\n", ' ', $temp2);
				if (strlen($temp2) > 120) {
					$temp2 = substr($temp2, 0, 120) . '...';
				}
				$temp['rows'][$k]['body'] = $temp2;
			}
		}
		$result['rows'] = & $temp['rows'];
		$result['success'] = true;
		return $result;
	}

	public function renderSubjectAndBody(& $form, & $options, & $value, & $neighbouring_values) {
		// important
		if (!empty($neighbouring_values['important'])) {
			$value = \HTML::span(['style' => 'color: red;', 'value' => $value]);
		}
		if (empty($neighbouring_values['read'])) {
			return \HTML::b(['value' => $value]);
		} else {
			return $value;
		}
	}
}