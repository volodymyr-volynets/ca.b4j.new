<?php

namespace Numbers\Users\News\Helper;
class Dashboard extends \Numbers\Users\Users\Helper\Dashboard\Builder {

	/**
	 * Data
	 *
	 * @var array
	 */
	public $data = [];

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Render
	 *
	 * @return string
	 */
	public function render() {
		$model = new \Numbers\Users\News\DataSource\News();
		$model->cache = true;
		$data = $model->get();
		$summary = $model->prepareSummary($data);
		$result = '';
		foreach ($summary['summary'] as $k => $v) {
			if (!empty($v)) {
				$result.= \HTML::a(['href' => '/Numbers/Users/News/Controller/Preview?' . strtolower($k) . '=1', 'value' => i18n(null, $k) . ' (' . \Format::id($v) . ')']) . ' ';
			}
		}
		// categories
		if (!empty($summary['categories'])) {
			if (!empty($result)) $result.= '<br/>';
			$result.= i18n(null, 'Categories:') . ' ';
			foreach ($summary['categories'] as $k => $v) {
				$result.= \HTML::a(['href' => '/Numbers/Users/News/Controller/Preview?ns_new_category_id=' . $k, 'value' => $v['name'] . ' (' . \Format::id($v['count']) . ')']) . ' ';
			}
		}
		// latest title
		if (!empty($data)) {
			$latest = current($data);
			if (!empty($result)) $result.= '<br/>';
			$result.= i18n(null, 'Latest Title:') . ' ' . \HTML::a(['href' => '/Numbers/Users/News/Controller/Preview?ns_new_category_id=' . $latest['ns_new_category_id'], 'value' => i18n(null, $latest['ns_new_title'])]);
		}
		return $result;
	}

	/**
	 * Acl
	 */
	public function acl() : bool {
		$model = new \Numbers\Users\News\DataSource\News();
		$model->cache = true;
		$data = $model->get();
		return \Can::systemModuleExists('NS') && !empty($data);
	}
}