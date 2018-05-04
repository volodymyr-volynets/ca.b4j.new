<?php

namespace Numbers\Users\Users\Helper;
class ACL {

	/**
	 * Preset role and resource
	 * @param string $role_code
	 * @param string $resource_code
	 * @return array
	 */
	public static function presetRoleAndResource(string $role_code, string $resource_code) : array {
		$query = \Numbers\Tenants\Tenants\Model\Modules::queryBuilderStatic()->select();
		$query->columns([
			'um_rolperm_tenant_id' => 'a.tm_module_tenant_id',
			'um_rolperm_role_id' => 'b.um_role_id',
			'um_rolperm_module_id' => 'a.tm_module_id',
			'um_rolperm_resource_id' => 'c.sm_resource_id',
			'um_rolperm_method_code' => "'AllActions'",
			'um_rolperm_action_id' => '-1'
		]);
		$query->join('INNER', new \Numbers\Users\Users\Model\Roles(), 'b', 'ON', [
			['AND', ['b.um_role_code', '=', $role_code, false], false],
			['AND', ['a.tm_module_tenant_id', '=', 'b.um_role_tenant_id', true], false]
		]);
		$query->join('INNER', new \Numbers\Backend\System\Modules\Model\Resources(), 'c', 'ON', [
			['AND', ['c.sm_resource_code', '=', $resource_code, false], false]
		]);
		$query->where('AND', ['a.tm_module_module_code', '=', 'OM']);
		$data = $query->query();
		return $data['rows'];
	}
}