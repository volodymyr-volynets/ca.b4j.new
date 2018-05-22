<?php

namespace Numbers\Users\Users\Helper\ClearModule;
class Owners {

	/**
	 * Execute
	 *
	 * @param int $module_id
	 * @param array|string $type_code
	 * @return array
	 */
	public function execute(int $module_id, $type_code) : array {
		$query = \Numbers\Users\Users\Model\Owner\Users::queryBuilderStatic()->delete();
		$query->where('AND', ['a.um_owneruser_linked_module_id', '=', $module_id]);
		$query->where('AND', ['a.um_owneruser_linked_type_code', '=', $type_code]);
		return $query->query();
	}
}