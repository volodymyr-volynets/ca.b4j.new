<?php

namespace Form;
class ResendEmails extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_resend_emails';
	public $module_code = 'B4';
	public $title = 'B/J Resend Emails Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900]
	];
	public $rows = [];
	public $elements = [
		'top' => [
			'b4_period_id' => [
				'b4_period_id' => ['order' => 1, 'row_order' => 100, 'label_name' => 'Period', 'domain' => 'group_id', 'null' => true, 'required' => true, 'percent' => 100, 'placeholder' => \Object\Content\Messages::PLEASE_CHOOSE, 'method' => 'multiselect', 'multiple_column' => 1, 'options_model' => '\Model\Periods'],
			],
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_SUBMIT => self::BUTTON_SUBMIT_DATA,
			]
		]
	];

	public function validate(& $form) {
		if ($form->hasErrors()) return;
		// fetch all registrations
		$registrations = \Model\Register::getStatic([
			'columns' => [
				'b4_register_id',
				'b4_register_parents_email',
				'b4_register_parents_name',
				'b4_register_period_id'
			],
			'where' => [
				'b4_register_step_id' => 3,
				'b4_register_status_id' => 10,
				'b4_register_period_id' => array_keys($form->values['b4_period_id'])
			],
			'pk' => ['b4_register_id']
		]);
		if (empty($registrations)) {
			$form->error(DANGER, 'No pending registration found!');
			return;
		}
		foreach ($registrations as $k => $v) {
			$temp = \Helper\Notifications::sendConfirmEmailMessage((int) $k);
			$form->error(SUCCESS, 'Resent to [Email]!', null, ['replace' => ['[Email]' => $v['b4_register_parents_email']]]);
		}
	}
}