<?php

namespace Numbers\Users\Users\DataSource\ACL\Menu;
class Permissions {

	/**
	 * Get
	 *
	 * @param array $options
	 * @return array
	 */
	public function get(array $options = []) : array {
		$datasource = new \Numbers\Users\Users\DataSource\ACL\Menu();
		$data = $datasource->get();
		$result = [];
		$always_show = \Application::get('flag.numbers.frontend.menu.always_show');
		$menu_id = 1;
		foreach ($data as $k => $v) {
			// handle permission
			if ($v['type'] !== 299) {
				// see if module has been activated
				if (!\Can::systemModuleExists($v['module_code'])) continue;
				// if we have permission
				if (!empty($v['acl_permission'])) {
					if (!\Application::$controller->canExtended($v['acl_resource_id'], $v['acl_method_code'], $v['acl_action_id'])) {
						if (!$always_show) {
							continue;
						} else {
							$v['name'].= ' (Hidden)';
						}
					}
				} else { // public & authorized
					if (\User::authorized()) {
						// menu items with resources
						if (!empty($v['acl_resource_id'])) {
							if (!\Application::$controller->canExtended($v['acl_resource_id'], $v['acl_method_code'], $v['acl_action_id'])) continue;
						}
						if (empty($v['acl_authorized'])) continue;
					} else {
						if (empty($v['acl_public'])) continue;
					}
				}
			}
			// add item to the list
			$key = [$v['type']];
			for ($i = 1; $i <= 9; $i++) {
				if (empty($v['group' . $i])) break;
				$key[] = $v['group' . $i];
				// check if group exists
				$existing = array_key_get($result, $key);
				if (empty($existing)) {
					// grab icon & title
					$group = [];
					if ($v['type'] !== 299) {
						$key2 = $key;
						array_shift($key2);
						array_unshift($key2, 299);
						$group = array_key_get($result, $key2);
						if (!empty($group)) {
							$group['options'] = [];
						}
					}
					if (empty($group)) {
						$group = [
							'name' => $v['group' . $i],
							'title' => null,
							'icon' => null,
							'child_ordered' => $v['child_ordered'],
							'order' => $v['order'],
							'separator' => $v['separator'],
							'name_generator' => $v['name_generator'],
							'options' => [],
							'menu_id' => $menu_id,
						];
						$menu_id++;
					}
					array_key_set($result, $key, $group);
				}
				$key[] = 'options';
			}
			$key[] = $v['name'];
			$item = [
				'name' => $v['name'],
				'title' => $v['description'],
				'icon' => $v['icon'],
				'url' => $v['url'],
				'child_ordered' => $v['child_ordered'],
				'order' => $v['order'],
				'separator' => $v['separator'],
				'name_generator' => $v['name_generator'],
				'menu_id' => $menu_id,
				'__menu_id' => $v['id']
			];
			$menu_id++;
			$existing = array_key_get($result, $key);
			if (!empty($existing)) {
				$existing = array_merge($existing, $item);
			} else {
				$existing = $item;
				$existing['options'] = [];
			}
			array_key_set($result, $key, $existing);
		}
		return $result;
	}
}