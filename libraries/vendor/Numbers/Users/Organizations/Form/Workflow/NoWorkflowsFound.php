<?php

namespace Numbers\Users\Organizations\Form\Workflow;
class NoWorkflowsFound {

	/**
	 * Render
	 *
	 * @return string
	 */
	public function render() {
		$input = \Request::input();
		$options = [
			'type' => 'warning',
			'options' => [
				i18n(null, \Object\Content\Messages::NO_ROWS_FOUND),
			]
		];
		return \HTML::message($options);
	}
}