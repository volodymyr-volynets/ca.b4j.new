<?php

namespace Numbers\Users\News\DataSource;
class News extends \Object\DataSource {
	public $db_link;
	public $db_link_flag;
	public $pk = ['ns_new_id'];
	public $columns;
	public $orderby;
	public $limit;
	public $single_row;
	public $single_value;
	public $options_map =[
		'ns_new_title' => 'name'
	];
	public $options_active =[];
	public $column_prefix = 'ns_new_';

	public $cache = false;
	public $cache_tags = [];
	public $cache_memory = false;

	public $primary_model = '\Numbers\Users\News\Model\News';
	public $parameters = [
		'include_content' => ['name' => 'Include Content', 'type' => 'boolean'],
	];

	public function query($parameters, $options = []) {
		$this->query->columns([
			'ns_new_id' => 'a.ns_new_id',
			'ns_new_title' => 'a.ns_new_title',
			'ns_new_hot' => 'a.ns_new_hot',
			'ns_new_category_id' => 'a.ns_new_category_id',
			'ns_category_name' => 'b.ns_category_name',
			'ns_new_read_user' => 'c.ns_nwsusr_user_id',
			'ns_new_language_code' => 'a.ns_new_language_code'
		]);
		if (!empty($parameters['include_content'])) {
			$this->query->columns([
				'ns_new_content' => 'a.ns_new_content',
				'ns_new_i18n_id' => 'a.ns_new_i18n_id',
				'ns_new_inserted_timestamp' => 'a.ns_new_inserted_timestamp'
			]);
		}
		// joins
		$this->query->join('INNER', new \Numbers\Users\News\Model\Categories(), 'b', 'ON', [
			['AND', ['a.ns_new_category_id', '=', 'b.ns_category_id', true], false]
		]);
		$this->query->join('LEFT', new \Numbers\Users\News\Model\News\Users(), 'c', 'ON', [
			['AND', ['a.ns_new_id', '=', 'c.ns_nwsusr_news_id', true], false],
			['AND', ['c.ns_nwsusr_user_id', '=', \User::id()], false]
		]);
		// where
		$this->query->where('AND', ['a.ns_new_inactive', '=', 0, false]);
		$organizations = \User::get('organizations');
		if (!empty($organizations)) {
			$this->query->where('AND', function (& $query) use ($organizations) {
				$query = \Numbers\Users\News\Model\News\Organizations::queryBuilderStatic(['alias' => 'inner_d'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_d.um_nwsorg_news_id', '=', 'a.ns_new_id', true]);
				$query->where('AND', ['inner_d.um_nwsorg_organization_id', 'IN', $organizations, false]);
			}, true);
		}
		$this->query->where('AND', function (& $query) {
			$query->where('OR', ['a.ns_new_show_to_all_roles', '=', 1]);
			$query->where('OR', function (& $query) {
				$query = \Numbers\Users\News\Model\News\Roles::queryBuilderStatic(['alias' => 'inner_r'])->select();
				$query->columns(1);
				$query->where('AND', ['inner_r.ns_nwsrol_news_id', '=', 'a.ns_new_id', true]);
				$query->where('AND', ['inner_r.ns_nwsrol_role_id', '=', \User::get('role_ids')]);
			}, true);
		});
		$this->query->where('AND', function (& $query) {
			$query->where('OR', ['a.ns_new_start_date', 'IS', null]);
			$query->where('OR', ['a.ns_new_start_date', '<=', \Format::now('date')]);
		});
		$this->query->where('AND', function (& $query) {
			$query->where('OR', ['a.ns_new_end_date', 'IS', null]);
			$query->where('OR', ['a.ns_new_end_date', '>=', \Format::now('date')]);
		});
		// order
		$this->query->orderby(['a.ns_new_id' => SORT_DESC]);
	}

	/**
	 * Prepare summary
	 *
	 * @param array $data
	 * @return array
	 */
	public function prepareSummary(array $data) {
		$result = [
			'summary' => [
				'Unread' => 0,
				'Hot' => 0
			],
			'categories' => []
		];
		foreach ($data as $k => $v) {
			if (!empty($v['ns_new_hot'])) {
				$result['summary']['Hot']+= 1;
			}
			if (empty($v['ns_new_read_user'])) {
				$result['summary']['Unread']+= 1;
			}
			if (!isset($result['categories'][$v['ns_new_category_id']]['name'])) {
				$result['categories'][$v['ns_new_category_id']]['name'] = i18n(null, $v['ns_category_name']);
			}
			$result['categories'][$v['ns_new_category_id']]['count'] = ($result['categories'][$v['ns_new_category_id']]['count'] ?? 0) + 1;
		}
		// sort is a must
		array_key_sort($result['categories'], ['name' => SORT_ASC]);
		return $result;
	}
}