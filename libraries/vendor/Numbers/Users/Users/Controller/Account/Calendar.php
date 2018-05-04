<?php

namespace Numbers\Users\Users\Controller\Account;
class Calendar extends \Object\Controller\Authorized {
	public function actionIndex() {
		$form = new \Numbers\Users\Users\Form\Account\Calendar([
			'input' => \Request::input()
		]);
		echo $form->render();
	}
	public function actionJsonMenuName() {
		// todays appointments
		$query = \Numbers\Users\Users\Model\Scheduling\Intervals::queryBuilderStatic()->select();
		$query->columns(['count' => 'COUNT(*)']);
		$query->where('AND', ['um_schedinterval_user_id', '=', \User::id()]);
		$query->where('AND', function (& $query) {
			$today = \Format::now('date');
			$query->where('AND', [$query->db_object->cast('a.um_schedinterval_work_starts', 'date'), '>=', $today]);
			$query->where('AND', [$query->db_object->cast('a.um_schedinterval_work_ends', 'date'), '<=', $today]);
		});
		$query->where('AND', ['um_schedinterval_inactive', '=', 0]);
		$data = $query->query();
		// generate message
		$label = '<table width="100%"><tr><td width="99%">' . \HTML::icon(['type' => 'fas fa-calendar-alt']) . ' ' . i18n(null, 'Calendar') . '</td><td width="1%">' . \HTML::label2(['type' => 'info', 'value' => \Format::id($data['rows'][0]['count'])]) . '</td></tr></table>';
		\Layout::renderAs([
			'success' => true,
			'error' => [],
			'data' => $label,
			'item' => \Request::input('item')
		], 'application/json');
	}
}