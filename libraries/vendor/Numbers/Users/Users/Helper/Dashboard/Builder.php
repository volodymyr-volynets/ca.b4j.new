<?php

namespace Numbers\Users\Users\Helper\Dashboard;
class Builder {

	/**
	 * Render
	 */
	public function render() {
		$grid = [
			'options' => [],
			'cell_class' => 'col-sm-'
		];
		$flag_have_access = false;
		foreach ($this->data as $k => $v) {
			foreach ($v as $k2 => $v2) {
				$name = '';
				if (!empty($v2['name'])) {
					$name = i18n(null, $v2['name']);
				}
				if (!empty($v2['icon'])) {
					if (!empty($v2['name'])) {
						$name = \HTML::icon(['type' => $v2['icon'], 'class' => 'numbers_postlogin_dashboard_icon']) . '<br/>' . $name;
						if (!(empty($name) || $name == '&nbsp;')) {
							$flag_have_access = true;
						}
					} else {
						$name = '<br/>' . \HTML::icon(['type' => $v2['icon']]);
					}
				}
				$name = '<div class="numbers_postlogin_dashboard_div">' . $name . '</div>';
				// url
				if (!empty($v2['acl']) && \Application::$controller->canExtended($v2['acl']['resource_id'], $v2['acl']['method_code'], $v2['acl']['action_id'])) {
					$name = \HTML::a(['href' => $v2['url'], 'value' => $name]);
					$flag_have_access = true;
				}
				$grid['options'][$k][$k2][$k2] = [
					'value' => $name,
					'options' => [
						'percent' => 100 / 6
					]
				];
			}
		}
		if (!$flag_have_access) return '';
		return \HTML::grid($grid);
	}

	/**
	 * Acl
	 */
	public function acl() : bool {
		return true;
	}
}