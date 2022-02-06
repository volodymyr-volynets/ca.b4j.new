<?php

namespace Form\Register;
class Step3 extends \Object\Form\Wrapper\Base {
	public $form_link = 'b4_register_step3';
	public $module_code = 'B4';
	public $title = 'B/4 Register Step 3 Form';
	public $options = [
		'segment' => self::SEGMENT_FORM,
		'actions' => [
			'refresh' => true,
			'back' => true,
		]
	];
	public $containers = [
		'top' => ['default_row_type' => 'grid', 'order' => 100],
		'signature' => ['default_row_type' => 'grid', 'order' => 800],
		'buttons' => ['default_row_type' => 'grid', 'order' => 900],
	];
	public $rows = [];
	public $elements = [
		'top' => [
			self::HIDDEN => [
				'__wizard_step' => ['label_name' => 'Wizzard Step', 'domain' => 'type_id', 'null' => true, 'method' => 'hidden'],
				'b4_register_id' => ['label_name' => 'Register #', 'domain' => 'big_id', 'null' => true, 'method' => 'hidden', 'validate_through_session' => true],
				'b4_register_children' => ['label_name' => 'Children', 'type' => 'text', 'null' => true, 'method' => 'hidden'],
				'b4_register_period' => ['label_name' => 'Period', 'type' => 'text', 'null' => true, 'method' => 'hidden'],
			],
			'text1' => [
				'text1' => ['order' => 1, 'row_order' => 100, 'label_name' => '', 'method' => 'b', 'value' => '', 'percent' => 100, 'skip_i18n' => true]
			],
			'text2' => [
				'text2' => ['order' => 1, 'row_order' => 200, 'label_name' => '', 'method' => 'b', 'value' => '', 'percent' => 100, 'skip_i18n' => true]
			],
			'text3' => [
				'text3' => ['order' => 1, 'row_order' => 250, 'label_name' => '', 'method' => 'b', 'value' => '', 'percent' => 100, 'skip_i18n' => true]
			],
//			'text4' => [
//				'text4' => ['order' => 1, 'row_order' => 251, 'label_name' => '', 'method' => 'b', 'value' => '', 'percent' => 100, 'skip_i18n' => true]
//			],
		],
		'signature' => [
			'medication' => [
				self::SEPARATOR_HORIZONTAL => ['order' => 100, 'row_order' => 100, 'label_name' => 'SIGNATURE', 'icon' => 'fas fa-american-sign-language-interpreting', 'percent' => 100],
			],
			'b4_registration_waiver_signature' => [
				'b4_registration_waiver_signature' => ['order' => 1, 'row_order' => 999, 'label_name' => 'Signature of Parent', 'domain' => 'signature', 'null' => true, 'required' => true, 'percent' => 50, 'method' => 'signature'],
				'b4_registration_waiver_signing_date' => ['order' => 2, 'label_name' => 'Signing Date', 'type' => 'date', 'null' => true, 'default' => NUMBERS_FLAG_TIMESTAMP_DATE, 'required' => true, 'method' => 'calendar', 'calendar_icon' => 'right'],
			],
		],
		'buttons' => [
			self::BUTTONS => [
				self::BUTTON_CONTINUE => self::BUTTON_CONTINUE_DATA
			]
		]
	];
	public $collection = [
		'name' => 'B4 Register',
		'readonly' => true,
		'model' => '\Model\Register',
	];

	public function refresh(& $form) {
		$form->options['actions']['back'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=2&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->options['actions']['refresh'] = [
			'href' => \Application::get('mvc.full') . '?__wizard_step=3&b4_register_id=' . $form->values['b4_register_id']
		];
		$form->values['__wizard_step'] = 3;
		// preload data
		if (empty($form->is_ajax_reload)) {
			if (!empty($form->values['b4_register_id']) && empty($form->process_submit[self::BUTTON_CONTINUE])) {
				\Object\Table\Complementary::jsonPreloadData(
					new \Model\Register(),
					[
						'b4_register_id' => $form->values['b4_register_id']
					],
					['b4_register_step3', 'b4_register_children', 'b4_register_period'],
					$form->values
				);
			}
		}
		
		// waiver text se store
		$form->values['text1'] = i18n(null, "Break for Jesus Catechetical Day Camp 2022Break for Jesus Catechetical Day Camp 2022");
		$form->values['text1'] = i18n(null, "PARENTAL/GUARDIAN AUTHORIZAITON WAIVER");
		$form->values['text3'] = i18n(null, <<<TTT
By signing this waiver, I am granting permission for my son/daughter to participate in the Break for Jesus Catechetical Day Camp 2022 (“B4J”) which will be held at the T. Shevchenko Ukrainian Cultural Centre (482 Horner Ave., Etobicoke, On), March 14-18, daily between 9am and 4 pm.<br/><br/>
I agree that I am satisfied that all foreseeable and reasonable measures will be taken for the care of my son/daughter, including the privacy and safety of my child. I do hereby release The Ukrainian Catholic Episcopal Corporation of Eastern Canada, its parishes, agents, employees, and volunteers (collectively “The Camp Operators”) from any and all claims arising in respect to injury, damage or loss, whether by accident, or negligence in the course of the conduct and activities of B4J, which my child is attending.<br/><br/>
This authorizes The Camp Operators to use the picture and/or video of my son/daughter in a website pertaining to the operation of the B4J and releases The Camp Operators from any liability arising from such use.<br/><br/>
COVID-19 Virus (“the Virus”) Protocol:  In the event that my child exhibits symptoms of the Virus, tests positive for the Virus, is exposed to anyone who has tested positive for the Virus, or has been recommended to self-isolate due to the Virus, I will immediately notify The Camp Operators of such fact.

TTT
		);
	}

	public function validate(& $form) {

	}

	public function save(& $form) {
		// write data
		$result = \Object\Table\Complementary::jsonSaveData(
			new \Model\Register(),
			[
				'b4_register_step_id' => 3,
				'b4_register_step3' => json_encode($form->values)
			],
			$form,
			'b4_register_id'
		);
		// send email
		\Helper\Notifications::sendConfirmEmailMessage($form->values['b4_register_id']);
		return $result;
	}

	public function success(& $form) {
		if (!empty($form->values['b4_register_id'])) {
			$form->redirect(\Application::get('mvc.full') . '?__wizard_step=4&b4_register_id=' . $form->values['b4_register_id']);
		}
	}
}