<?php

namespace Numbers\Users\Users\Model\Form;
class ActionTypes extends \Object\Data {
	public $column_key = 'um_frmactiontype_id';
	public $column_prefix = 'um_frmactiontype_';
	public $orderby;
	public $columns = [
		'um_frmactiontype_id' => ['name' => 'Type #', 'domain' => 'type_id'],
		'um_frmactiontype_name' => ['name' => 'Name', 'type' => 'text']
	];
	public $data = [
		10 => ['um_frmactiontype_name' => 'Readonly'],
		//20 => ['um_frmactiontype_name' => 'Mask'],
		30 => ['um_frmactiontype_name' => 'Hide']
	];
}