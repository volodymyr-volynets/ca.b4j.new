<?php

namespace Form\Register;
class Collection extends \Object\Form\Wrapper\Collection {
	public $collection_link = 'b4_register_collection';
	const GLOBAL_WIZARD = [
		'model' => '\Object\Form\Wrapper\Wizard',
		'options' => [
			'segment' => null,
			'percent' => 100,
			'wizard' => [
				'type' => 'primary',
				'options' => [
					//1 => ['name' => 'Registration Code'],
					2 => ['name' => 'Information'],
					3 => ['name' => 'Waiver'],
					4 => ['name' => 'Confirm Your Email'],
					5 => ['name' => 'Complete']
				]
			]
		],
		'order' => 1
	];
	const GLOBAL_OPTIONS = [
		'segment' => [
			'type' => 'primary',
			'header' => [
				'icon' => ['type' => 'fab fa-firstdraft'],
				'title' => 'Register your children:'
			]
		]
	];
	public $data = [
	    /*
		'step1' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 1000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'register_step1' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_register_step1' => [
							'model' => '\Form\Register\Step1',
							'bypass_values' => ['__wizard_step', 'b4_register_id'],
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
			]
		],
	    */
		'step2' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'register_step2' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_register_step2' => [
							'model' => '\Form\Register\Step2',
							'bypass_values' => ['__wizard_step', 'b4_register_id'],
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step3' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'register_step3' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_register_step3' => [
							'model' => '\Form\Register\Step3',
							'bypass_values' => ['__wizard_step', 'b4_register_id'],
							'options' => [
								'segment' => null,
								'percent' => 100
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step4' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2001,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'register_step4' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'b4_register_step4' => [
							'model' => '\Form\Register\Step4',
							'bypass_values' => ['__wizard_step', 'b4_register_id'],
							'options' => [
								'segment' => null,
								'percent' => 100,
							],
							'order' => 1
						]
					]
				]
			]
		],
		'step5' => [
			'options' => self::GLOBAL_OPTIONS,
			'order' => 2000,
			self::ROWS => [
				self::HEADER_ROW => [
					'order' => 100,
					self::FORMS => [
						'register_step5' => self::GLOBAL_WIZARD
					]
				],
				self::MAIN_ROW => [
					'order' => 200,
					self::FORMS => [
						'register_step5' => [
							'model' => '\Form\Register\Step5',
							'options' => [
								'segment' => null,
								'percent' => 100,
							],
							'order' => 1
						]
					]
				]
			]
		],
	];

	public function distribute() {
		$this->values['__wizard_step'] = (int) ($this->values['__wizard_step'] ?? 2);
		if (empty($this->values['__wizard_step'])) $this->values['__wizard_step'] = 2;
		$this->collection_screen_link = 'step' . $this->values['__wizard_step'];
		// make everything look success
		if ($this->values['__wizard_step'] == 5) {
			$this->data['step5'][$this::ROWS][self::HEADER_ROW][$this::FORMS]['register_step5']['options']['wizard']['type'] = 'success';
			$this->data['step5']['options']['segment']['type'] = 'success';
		}
	}
}