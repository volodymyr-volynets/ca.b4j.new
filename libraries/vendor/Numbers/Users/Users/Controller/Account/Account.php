<?php

namespace Numbers\Users\Users\Controller\Account;
class Account extends \Object\Controller {
	public $title = 'Account Name and Avatar';
	public function actionJsonMenuName() {
		if (\User::authorized()) {
			if (\User::get('photo_file_id')) {
				$avatar = \HTML::img(['src' => \Numbers\Users\Documents\Base\Base::generateURL(\User::get('photo_file_id'), true), 'class' => 'navbar-menu-item-avatar-img', 'alt' => 'Avatar', 'width' => 25, 'height' => 25]);
			} else {
				$avatar = \HTML::icon(['type' => 'fas fa-address-card']);
			}
			$label = '<span>' . $avatar . ' ' . \User::get('name') . '</span>';
			\Layout::renderAs([
				'success' => true,
				'error' => [],
				'data' => $label,
				'item' => \Request::input('item'),
			], 'application/json');
		} else {
			\Layout::renderAs([
				'success' => false,
				'error' => [],
				'data' => null,
				'item' => null,
				'avatar' => null
			], 'application/json');
		}
	}
}