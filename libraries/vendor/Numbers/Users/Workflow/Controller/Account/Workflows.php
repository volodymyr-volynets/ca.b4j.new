<?php

namespace Numbers\Users\Workflow\Controller\Account;
class Workflows extends \Object\Controller\Authorized {
	public function actionIndex() {
		$input = \Request::input();
		$input['ww_execwflow_user_id'] = \User::id();
		$form = new \Numbers\Users\Workflow\Form\List2\Account\Workflows([
			'input' => $input
		]);
		echo $form->render();
	}
	public function actionEdit() {
		$form = new \Numbers\Users\Workflow\Form\Account\ContinueWorkflow([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionNew() {
		$form = new \Numbers\Users\Workflow\Form\Account\StartWorkflow([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionJsonMenuName() {
		// fetch number of messages
		$query = \Numbers\Users\Workflow\Model\Executed\Workflows::queryBuilderStatic()->select();
		$query->columns(['count' => 'COUNT(*)']);
		$query->where('AND', ['a.ww_execwflow_status_id', '<>', 30]);
		$query->where('AND', ['a.ww_execwflow_user_id', '=', \User::id()]);
		$data = $query->query();
		// generate message
		$label = '<table width="100%"><tr><td width="99%">' . \HTML::icon(['type' => 'fab fa-hubspot']) . ' ' . i18n(null, 'Workflows') . '</td><td width="1%">' . \HTML::label2(['type' => 'primary', 'value' => \Format::id($data['rows'][0]['count'])]) . '</td></tr></table>';
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'data' => $label,
			'item' => \Request::input('item')
		], 'application/json');
	}
}