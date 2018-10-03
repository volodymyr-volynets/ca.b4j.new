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
			'text4' => [
				'text4' => ['order' => 1, 'row_order' => 251, 'label_name' => '', 'method' => 'b', 'value' => '', 'percent' => 100, 'skip_i18n' => true]
			],
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
		$form->values['text1'] = i18n(null, "PARENTAL / GUARDIAN AUTHORIZATION WAIVER");
		$form->values['text2'] = i18n(null, "I am satisfied that all foreseeable and reasonable measures will be taken for the care of my son/daughter. I do hereby release the Ukrainian Catholic Episcopal Corporation of Eastern Canada and the Sisters Servants of Mary Immaculate from all claims in respect to actions, accident, or negligence on the part of these religious organizations, their employees, volunteers and others acting in the course of this 'Break for Jesus Catechetical Camp' which my child is attending [period] at Mount Mary Retreat Centre in Ancaster, Ontario.", [
			'replace' => [
				'[period]' => $form->values['b4_register_period']
			]
		]);
		$form->values['text3'] = i18n(null, "I hereby consent to the administration of any medical treatment deemed by any qualified medical practitioner to be necessary for the health and welfare of my child including the administration of an anesthetic and the performance of any necessary operation during the period of this camp.");
		$form->values['text4'] = i18n(null, "This authorizes the Break For Jesus Committee to use the picture of my son/daughter [children] in a website pertaining to the operation of the Break For Jesus Catechetical Camp and release them from any liability arising there from that use.", [
			'replace' => [
				'[children]' => $form->values['b4_register_children']
			]
		]);
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