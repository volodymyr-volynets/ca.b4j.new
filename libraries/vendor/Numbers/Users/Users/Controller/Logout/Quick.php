<?php

namespace Numbers\Users\Users\Controller\Logout;
class Quick extends \Object\Controller {
	public $title = 'Quick Logout';
	public $icon = 'fas fa-sign-out-alt';
	public function actionIndex() {
		\Numbers\Users\Users\Model\User\Authorize::signOut();
		\Request::redirect('/Numbers/Users/Users/Controller/Logout/Confirmed');
	}
}