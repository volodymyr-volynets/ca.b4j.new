<?php

namespace Numbers\Backend\System\Modules\Model\Module;
class Types extends \Object\Data {
	public $module_code = 'SM';
	public $title = 'S/M Module Types';
	public $column_key = 'sm_mdltype_id';
	public $column_prefix = 'sm_mdltype_';
	public $orderby;
	public $columns = [
		'sm_mdltype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'sm_mdltype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['sm_mdltype_name' => 'System'],
		20 => ['sm_mdltype_name' => 'General'],
		30 => ['sm_mdltype_name' => 'Ledger'],
		40 => ['sm_mdltype_name' => 'Subledger'],
	];
}