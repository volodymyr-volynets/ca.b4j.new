<?php

namespace Numbers\Users\News\Controller;
class Preview extends \Object\Controller\Permission {
	public function actionIndex() {
		$input = \Request::input();
		$model = new \Numbers\Users\News\DataSource\News();
		$model->cache = true;
		$data = $model->get([
			'where' => [
				'include_content' => true
			]
		]);
		$summary = $model->prepareSummary($data);
		// open specific tab
		if (!empty($input['unread'])) {
			$_GET['tab_news_id_active_hidden'] = 'unread';
		}
		if (!empty($input['hot'])) {
			$_GET['tab_news_id_active_hidden'] = 'hot';
		}
		if (!empty($input['ns_new_category_id'])) {
			$_GET['tab_news_id_active_hidden'] = 'category_id_' . $input['ns_new_category_id'];
		}
		// render
		$tab_header = [];
		if (!empty($summary['summary']['Unread'])) {
			$tab_header['unread'] = i18n(null, 'Unread') . \HTML::label2(['type' => 'primary', 'value' => \Format::id($summary['summary']['Unread'])]);
			$tab_options['unread'] = '';
			$update = [];
			foreach ($data as $k => $v) {
				if (empty($v['ns_new_read_user'])) {
					if (!empty($tab_options['unread'])) $tab_options['unread'].= '<hr/>';
					$tab_options['unread'].= '<h2>' . i18n(null, $v['ns_new_title']) . ' (' . \Format::niceTimestamp($v['ns_new_inserted_timestamp'])  . ')'. '</h2>';
					$tab_options['unread'].= i18n($v['ns_new_i18n_id'], $v['ns_new_content'], ['from_language' => $v['ns_new_language_code']]);
					$update[] = [
						'ns_nwsusr_news_id' => $v['ns_new_id'],
						'ns_nwsusr_user_id' => \User::id()
					];
				}
			}
			// logic to update news if opened
			$update_result = \Numbers\Users\News\Model\News\Users::collectionStatic()->mergeMultiple($update);
		}
		if (!empty($summary['summary']['Hot'])) {
			$tab_header['hot'] = i18n(null, 'Hot') . \HTML::label2(['type' => 'primary', 'value' => \Format::id($summary['summary']['Hot'])]);
			$tab_options['hot'] = '';
			foreach ($data as $k => $v) {
				if (!empty($v['ns_new_hot'])) {
					if (!empty($tab_options['hot'])) $tab_options['hot'].= '<hr/>';
					$tab_options['hot'].= '<h2>' . i18n(null, $v['ns_new_title']) . ' (' . \Format::niceTimestamp($v['ns_new_inserted_timestamp'])  . ')'. '</h2>';
					$tab_options['hot'].= i18n($v['ns_new_i18n_id'], $v['ns_new_content'], ['from_language' => $v['ns_new_language_code']]);
				}
			}
		}
		foreach ($summary['categories'] as $k0 => $v0) {
			$tab_header['category_id_' . $k0] = $v0['name'] . \HTML::label2(['type' => 'primary', 'value' => \Format::id($v0['count'])]);
			$tab_options['category_id_' . $k0] = '';
			foreach ($data as $k => $v) {
				if ($v['ns_new_category_id'] == $k0) {
					if (!empty($tab_options['category_id_' . $k0])) $tab_options['category_id_' . $k0].= '<hr/>';
					$tab_options['category_id_' . $k0].= '<h2>' . i18n(null, $v['ns_new_title']) . ' (' . \Format::niceTimestamp($v['ns_new_inserted_timestamp'])  . ')'. '</h2>';
					$tab_options['category_id_' . $k0].= i18n($v['ns_new_i18n_id'], $v['ns_new_content'], ['from_language' => $v['ns_new_language_code']]);
				}
			}
		}
		if (!empty($data)) {
			echo \HTML::tabs([
				'id' => 'tab_news_id',
				'header' => $tab_header,
				'options' => $tab_options,
				'tab_options' => [],
				'vertical' => true
			]);
		} else {
			echo \HTML::message(['type' => WARNING, 'options' => i18n(null, \Object\Content\Messages::NO_ROWS_FOUND)]);
		}
	}
	public function actionJsonMenuName() {
		// fetch number of news
		$model = new \Numbers\Users\News\DataSource\News();
		$model->cache = true;
		$data = $model->get();
		$unred = 0;
		foreach ($data as $k => $v) {
			if (empty($v['ns_new_read_user'])) {
				$unred++;
			}
		}
		// generate message
		$label = '<table width="100%"><tr><td width="99%">' . \HTML::icon(['type' => 'fas fa-newspaper']) . ' ' . i18n(null, 'News') . '</td><td width="1%">' . \HTML::label2(['type' => 'primary', 'value' => \Format::id($unred)]) . '</td></tr></table>';
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'data' => $label,
			'item' => \Request::input('item')
		], 'application/json');
	}
}