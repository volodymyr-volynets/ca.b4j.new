<?php

namespace Numbers\Users\TaskScheduler\Controller\External;
class CronDaemon extends \Object\Controller {
	public $title = 'Cron Daemon';
	public function actionIndex() {
		// process input
		$input = \Request::input();
		$is_cli = false;
		if (!empty($input['daemon_token']) && !empty($input['daemon_code'])) {
			$is_cli = \Numbers\Users\TaskScheduler\Model\Daemons::checkIfValidDaemonToken($input['daemon_code'] . '', $input['daemon_token'] . '');
		}
		if (!\Application::get('debug.toolbar') && !$is_cli) {
			Throw new Exception('You must enabled toolbar to view Dev. Portal.');
		}
		if (empty($input['datetime'])) {
			$input['datetime'] = \Format::now('datetime');
		}
		// form to get parameters
		$form = new \Numbers\Users\TaskScheduler\Form\External\CronDaemon([
			'input' => $input
		]);
		$result = $form->apiResult();
		if (!$result['success'] || empty($form->form_object->values['__submit_button'])) {
			if ($is_cli) {
				\Layout::renderAs($result, 'application/json');
			} else {
				echo $form->render();
			}
		} else {
			$model = new \Numbers\Users\TaskScheduler\Helper\ProcessJobs();
			$result = $model->process($form->form_object->values);
			if ($is_cli) {
				\Layout::renderAs($result, 'application/json');
			} else {
				if (!$result['success']) {
					$form->form_object->error(DANGER, $result['error']);
				} else {
					$form->form_object->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
				}
				echo $form->render();
			}
		}
	}
}