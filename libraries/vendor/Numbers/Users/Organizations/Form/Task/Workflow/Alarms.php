<?php

namespace Numbers\Users\Organizations\Form\Task\Workflow;
class Alarms extends \Object\Form\Wrapper\Base {
	public $form_link = 'on_tasks_workflow_alarms';
	public $module_code = 'ON';
	public $title = 'O/N Workflow Alarm Task';
	public $options = [
		'segment' => self::SEGMENT_TASK,
		'actions' => [
			'refresh' => true
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT_SAVE => self::BUTTON_SUBMIT_DATA,
				self::BUTTON_SUBMIT_POST => ['order' => 150, 'button_group' => 'left', 'value' => 'Create Job', 'type' => 'danger', 'method' => 'button2', 'accesskey' => 'p', 'process_submit' => 'other']
			]
		]
	];

	public function validate(& $form) {
		if ($form->hasErrors()) return;
		// if we are creating a job
		if (!empty($form->values['__submit_post'])) {
			\Numbers\Users\TaskScheduler\Helper\CreateJob::create('ON_TASK_WORKFLOW_ALARMS', $form);
		}
		$model = new \Numbers\Users\Organizations\Task\Workflow\Alarms($form->values);
		$result = $model->process();
		if ($result['success']) {
			$form->error(SUCCESS, \Object\Content\Messages::OPERATION_EXECUTED);
		} else {
			$form->error(DANGER, $result['error']);
		}
	}
}