<?php

namespace Numbers\Users\Workflow\Model\Workflow\Canvas;
class LineStyles extends \Object\Data {
	public $column_key = 'ww_wrkflwcnvsstyle_id';
	public $column_prefix = 'ww_wrkflwcnvsstyle_';
	public $orderby;
	public $columns = [
		'ww_wrkflwcnvsstyle_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'ww_wrkflwcnvsstyle_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['ww_wrkflwcnvsstyle_name' => 'Regular'],
		20 => ['ww_wrkflwcnvsstyle_name' => 'Double'],
		30 => ['ww_wrkflwcnvsstyle_name' => 'Tripple'],
	];
}