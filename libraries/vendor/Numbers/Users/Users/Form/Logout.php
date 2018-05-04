<?php

namespace Numbers\Users\Users\Form;
class Logout extends \Object\Form\Wrapper\Base {
	public $form_link = 'um_logout';
	public $module_code = 'UM';
	public $title = 'U/M Logout';
	public $options = [
		'segment' => [
			'type' => 'danger',
			'header' => [
				'icon' => ['type' => 'fas fa-sign-out-alt'],
				'title' => 'Sign Out:'
			]
		],
		'no_ajax_form_reload' => true
	];
	public $containers = [
		'login' => ['default_row_type' => 'grid', 'order' => 1]
	];
	public $rows = [];
	public $elements = [
		'login' => [
			'confirmation' => [
				'confirmation' => ['order' => 1, 'row_order' => 100, 'label_name' => null, 'value' => 'Do you really want to sign out?', 'method' => 'div', 'type' => 'text', 'percent' => 100]
			],
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA
			]
		]
	];

	public function save(& $form) {
		\Numbers\Users\Users\Model\User\Authorize::signOut();
		\Request::redirect('/Numbers/Users/Users/Controller/Logout/Confirmed');
		return true;
	}
}