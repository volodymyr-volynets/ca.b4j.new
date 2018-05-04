<?php

namespace Numbers\Users\Users\Helper\Role;
class Manages {

	/**
	 * Cached manages data
	 *
	 * @var array
	 */
	private static $cached_manages;

	/**
	 * Can
	 *
	 * @param array $current_user_roles
	 * @param array $target_user_roles
	 * @param string $field
	 * @param type $value
	 * @return bool
	 */
	public static function can(array $current_user_roles, array $target_user_roles, string $field, $value) : bool {
		// super administrator can do everything
		if (\User::get('super_admin')) return true;
		// cache data
		if (!isset(self::$cached_manages)) {
			$manages_model = new \Numbers\Users\Users\Model\Role\Manages();
			self::$cached_manages = $manages_model->get([
				'where' => [
					'um_rolman_inactive' => 0
				],
				'pk' => ['um_rolman_parent_role_id', 'um_rolman_child_role_id']
			]);
		}
		//
		foreach ($current_user_roles as $v) {
			// exclude roles that do not manage other roles
			if (empty(self::$cached_manages[$v])) continue;
			// loop through all manages
			foreach (self::$cached_manages[$v] as $k2 => $v2) {
				// if we have inherited children
				if (!empty($v2['um_rolman_manage_children']) && !empty(self::$cached_manages[$v2['um_rolman_child_role_id']])) {
					foreach (self::$cached_manages[$v2['um_rolman_child_role_id']] as $k3 => $v3) {
						// todo: process another layer of manage children here!
						// skip not target roles
						if (!in_array($k3, $target_user_roles)) continue;
						// see if field is set
						if (isset($v3[$field])) {
							if ($v3[$field] === $value) return true;
						}
					}
				}
				// skip not target roles
				if (!in_array($k2, $target_user_roles)) continue;
				// see if field is set
				if (isset($v2[$field])) {
					if ($v2[$field] === $value) return true;
				}
			}
		}
		return false;
	}
}