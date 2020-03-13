<?php

namespace Controller;
class Index extends \Object\Controller {

	public $title = 'Home';

	public function actionIndex() {
		\Layout::addMessage('It is with heavy hearts that we announce the cancelling of Break for Jesus 2020. On the advice of medical personnel, in consultation with our committee, educational and eparchial advisers, we believe this to be the most prudent course to stay safe and prevent the spread of the virus. We are very sorry that this is happening. This decision is not being taken lightly. We realize that this will cause inconvenience to many parents, but the risks outweigh the benefits. All parents will receive full refunds.<br/><br/>B4J Organizing Committee', 'danger');
	}
}