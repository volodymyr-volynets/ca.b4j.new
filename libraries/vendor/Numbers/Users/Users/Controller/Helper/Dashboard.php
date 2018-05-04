<?php

namespace Numbers\Users\Users\Controller\Helper;
class Dashboard extends \Object\Controller\Authorized {
	public function actionIndex() {
		\Layout::addCss('/numbers/media_submodules/Numbers_Users_Users_Media_CSS_Base.css');
		$dashboards = \Object\ACL\Resources::getStatic('postlogin_dashboard');
		array_key_sort($dashboards, ['order' => SORT_ASC]);
		$grid = [
			'options' => []
		];
		$counter = 1;
		$row_number = 1;
		foreach ($dashboards as $k => $v) {
			$class = $v['model'];
			$model = new $class();
			// continue loop
			if (!$model->acl()) {
				continue;
			}
			if ($counter % 2) {
				$row_number++;
			}
			$percent = 50;
			if (!empty($v['double'])) {
				$row_number++;
				$percent = 100;
			}
			$name = i18n(null, $v['name']);
			if (!empty($v['icon'])) {
				$name = \HTML::icon(['type' => $v['icon']]) . ' ' . $name;
			}
			$grid['options'][$row_number][$counter][$counter] = [
				'value' => \HTML::segment(['type' => 'primary', 'header' => $name, 'value' => $model->render()]) . '<br/>',
				'options' => [
					'percent' => $percent
				]
			];
			$counter++;
			if (!empty($v['double'])) {
				$counter++;
			}
		}
		echo \HTML::grid($grid);
	}
}