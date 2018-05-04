<?php

namespace Numbers\Users\Workflow\Model\Workflow\Canvas;
class LineTypes extends \Object\Data {
	public $column_key = 'ww_wrkcnvslntp_id';
	public $column_prefix = 'ww_wrkcnvslntp_';
	public $orderby;
	public $columns = [
		'ww_wrkcnvslntp_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'ww_wrkcnvslntp_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['ww_wrkcnvslntp_name' => 'Line'],
		20 => ['ww_wrkcnvslntp_name' => 'Arrow'],
		30 => ['ww_wrkcnvslntp_name' => 'Circle'],
	];
}