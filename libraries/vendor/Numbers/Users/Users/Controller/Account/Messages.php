<?php

namespace Numbers\Users\Users\Controller\Account;
class Messages extends \Object\Controller\Authorized {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\List2\Account\Messages([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$input = \Request::input();
		if (!empty($input['message_id'])) {
			$model = new \Numbers\Users\Users\DataSource\Messages();
			$data = $model->get([
				'where' => [
					'user_id' => \User::id(),
					'message_id' => $input['message_id']
				],
				'pk' => null
			]);
		}
		// we redirect back if message not found
		if (empty($input['message_id']) || empty($data)) {
			\Request::redirect('/Numbers/Users/Users/Controller/Account/Messages');
		}
		$data = current($data);
		// if unread we must mark it as read
		if (empty($data['read'])) {
			$read_model = new \Numbers\Users\Users\Model\Message\Recipients();
			$read_model->markAsRead($input['message_id'], $data['to_type_id'], \User::id());
		}
		// generate html
		$table = \HTML::table([
			'skip_header' => 1,
			'options' => [
				'from' => [
					'name' => ['value' => i18n(null, 'From'), 'width' => '1%'],
					'sep' => ['value' => ' ', 'width' => '1%'],
					'value' => $data['from_name'] . ' &lt;' . $data['from_email'] . '&gt;'
				],
				'to' => [
					'name' => ['value' => i18n(null, 'To'), 'width' => '1%'],
					'sep' => ['value' => ' ', 'width' => '1%'],
					'value' => $data['to_name'] . ' &lt;' . $data['to_email'] . '&gt;'
				],
				'date' => [
					'name' => ['value' => i18n(null, 'Date'), 'width' => '1%'],
					'sep' => ['value' => ' ', 'width' => '1%'],
					'value' => \Format::niceTimestamp($data['timestamp'])
				],
				'important' => [
					'name' => ['value' => i18n(null, 'Important'), 'width' => '1%'],
					'sep' => ['value' => ' ', 'width' => '1%'],
					'value' => ($data['important'] ? i18n(null, 'Yes') : i18n(null, 'No'))
				],
				'subject' => [
					'name' => ['value' => ($data['type'] == 20) ? i18n(null, 'Message') : i18n(null, 'Subject'), 'width' => '1%'],
					'sep' => ['value' => ' ', 'width' => '1%'],
					'value' => \HTML::b(['value' => $data['subject']])
				],
			],
			'class' => '',
			'cellpadding' => 2
		]);
		$grid = [
			'options' => [
				'Links Row' => [
					'Header' => [
						'Header' => [
							'value' => \HTML::a(['href' => '/Numbers/Users/Users/Controller/Account/Messages', 'value' => \HTML::icon(['type' => 'fas fa-arrow-left']) . ' ' . i18n(null, 'Back')]),
							'options' => [
								'percent' => 100,
								'style' => 'text-align: right;'
							]
						]
					]
				],
				'Separator Row 1' => [
					'Separator' => [
						'Separator' => [
							'value' => '<hr/>',
							'options' => [
								'percent' => 100,
							]
						]
					]
				],
				'Header Row' => [
					'Header' => [
						'Header' => [
							'value' => $table,
							'options' => [
								'percent' => 100,
							]
						]
					]
				],
				'Separator Row 2' => [
					'Separator' => [
						'Separator' => [
							'value' => '<hr/>',
							'options' => [
								'percent' => 100,
							]
						]
					]
				],
				'Body Row' => [
					'Body' => [
						'Header' => [
							'value' => $data['body'],
							'options' => [
								'percent' => 100,
							]
						]
					]
				]
			]
		];
		$grid = \HTML::grid($grid);
		echo \HTML::segment([
			'type' => 'primary',
			'value' => $grid,
			'header' => [
				'icon' => ['type' => 'fas fa-pen-square'],
				'title' => i18n(null, 'View Message:')
			]
		]);
	}
	public function actionNew() {
		$form = new \Numbers\Users\Users\Form\Account\Message([
			'input' => \Request::input(null, false)
		]);
		echo $form->render();
	}
	public function actionJsonMenuName() {
		// fetch number of messages
		$query = \Numbers\Users\Users\Model\Message\Recipients::queryBuilderStatic()->select();
		$query->columns(['count' => 'COUNT(*)']);
		$query->where('AND', ['a.um_mesrecip_read', '=', 0]);
		$query->where('AND', ['a.um_mesrecip_user_id', '=', \User::id()]);
		$data = $query->query();
		// generate message
		$label = '<table width="100%"><tr><td width="99%">' . \HTML::icon(['type' => 'far fa-envelope']) . ' ' . i18n(null, 'Messages') . '</td><td width="1%">' . \HTML::label2(['type' => 'primary', 'value' => \Format::id($data['rows'][0]['count'])]) . '</td></tr></table>';
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'data' => $label,
			'item' => \Request::input('item')
		], 'application/json');
	}
}