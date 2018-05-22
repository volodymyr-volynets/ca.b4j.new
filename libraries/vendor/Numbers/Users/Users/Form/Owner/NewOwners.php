<?php

namespace Numbers\Users\Users\Form\Owner;
class NewOwners extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_new_owners_form';
	public $module_code = 'ON';
	public $title = 'U/M New Owners Form';
	public $options = [
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'um_owneruser_linked_type_code' => ['label_name' => 'Linked Type Code', 'domain' => 'group_code', 'method' => 'hidden'],
				'um_owneruser_linked_module_id' => ['label_name' => 'Linked Module #', 'domain' => 'module_id', 'method' => 'hidden'],
				'um_owneruser_linked_id' => ['label_name' => 'Linked #', 'domain' => 'big_id', 'method' => 'hidden'],
			],
			'um_owneruser_type_id' => [
				'um_owneruser_type_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Type', 'domain' => 'type_id', 'null' => true, 'percent' => 30, 'method' => 'select', 'options_model' => '\Numbers\Users\Organizations\Model\Queue\OwnerTypes', 'onchange' => 'this.form.submit();'],
				'um_owneruser_user_id' => ['order' => 2, 'label_name' => 'User', 'domain' => 'user_id', 'null' => true, 'percent' => 70, 'method' => 'select', 'options_model' => '\Numbers\Users\Users\DataSource\Users'],
			]
		],
	];
	public $collection = [];

	public function __construct($options = []) {
		// call parent constructor
		parent::__construct($options);
	}

	public function refresh(& $form) {

	}

	public function validate(& $form) {

	}

	public function save(& $form) {
		return true;
	}

	public function success(& $form) {
		$form->redirectOnSuccess();
	}
}