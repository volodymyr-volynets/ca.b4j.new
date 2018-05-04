<?php

namespace Numbers\Users\Organizations\Helper\ClearModule;
class ClearServiceScripts {

	/**
	 * Execute
	 *
	 * @param int $module_id
	 * @param array|string $type_code
	 * @return array
	 */
	public function execute(int $module_id, $type_code) : array {
		$query = \Numbers\Users\Organizations\Model\Service\Executed\ServiceScripts::queryBuilderStatic()->delete();
		$query->where('AND', ['a.on_execsscript_linked_module_id', '=', $module_id]);
		$query->where('AND', ['a.on_execsscript_linked_type_code', '=', $type_code]);
		return $query->query();
	}
}