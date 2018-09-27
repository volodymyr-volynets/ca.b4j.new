<?php

namespace Numbers\Users\Monitoring\Helper;
class Monitor {

	/**
	 * Usage
	 *
	 * @var array
	 */
	private static $usage = [];

	/**
	 * History #
	 *
	 * @var int
	 */
	private static $__history_id;

	/**
	 * Initialize
	 */
	public function initialize() {
		// generate session #
		if (empty($_SESSION['numbers']['flag_monitoring_session_id'])) {
			$model = new \Numbers\Users\Monitoring\Model\SessionSequence();
			$result = $model->nextval();
			$_SESSION['numbers']['flag_monitoring_session_id'] = $result['simple'];
		}
		if (!isset($_SESSION['numbers']['flag_monitoring_steps'])) {
			$_SESSION['numbers']['flag_monitoring_steps'] = [];
		}
		self::$__history_id = \Application::get('flag.global.__history_id');
		if (isset(self::$__history_id)) {
			self::$__history_id = (int) self::$__history_id;
			if (!isset($_SESSION['numbers']['flag_monitoring_steps'][self::$__history_id])) {
				self::$__history_id = null;
			}
		}
		self::$usage = [
			'sm_monusage_tenant_id' => \Tenant::id(),
			'sm_monusage_session_id' => $_SESSION['numbers']['flag_monitoring_session_id'],
			'sm_monusage_timestamp' => \Format::now('timestamp'),
			'sm_monusage_user_id' => \User::id(),
			'sm_monusage_user_ip' => \Request::ip(),
			'sm_monusage_resource_id' => null,
			'sm_monusage_duration' => microtime(true),
			'sm_monusage_method' => \Request::method(),
			'\Numbers\Users\Monitoring\Model\Usage\Actions' => []
		];
		// back link
		if (!empty($_SESSION['numbers']['flag_monitoring_steps'])) {
			if (!isset(self::$__history_id)) {
				end($_SESSION['numbers']['flag_monitoring_steps']);
				$last = current($_SESSION['numbers']['flag_monitoring_steps']);
			} else if (self::$__history_id == 0) {
				$last = null;
			} else {
				$last = null;
				foreach ($_SESSION['numbers']['flag_monitoring_steps'] as $k => $v) {
					if ($k == self::$__history_id) break;
					$last = $v;
				}
			}
			if (!empty($last)) {
				\Layout::addAction(
					'monitoring_back',
					[
						'value' => 'Back',
						'title' => i18n(null, 'Back to [title].', ['replace' => ['[title]' => i18n(null, $last['title'])]]),
						'icon' => 'fas fa-backward', 'href' => $last['url'],
						'order' => -100002
					]
				);
			}
		}
		// forward link
		if (isset(self::$__history_id)) {
			$last = null;
			foreach (array_reverse($_SESSION['numbers']['flag_monitoring_steps'], true) as $k => $v) {
				if ($k == self::$__history_id) break;
				$last = $v;
			}
			if (!empty($last)) {
				\Layout::addAction(
					'monitoring_forward',
					[
						'value' => 'Forward',
						'title' => i18n(null, 'Forward to [title].', ['replace' => ['[title]' => i18n(null, $last['title'])]]),
						'icon' => 'fas fa-forward', 'href' => $last['url'],
						'order' => -100001
					]
				);
			}
		}
	}

	/**
	 * Destroy
	 */
	public function destroy() {
		if (!empty(self::$usage) && !\Application::get('flag.global.__ajax') && !\Helper\Cmd::isCli() && empty(\Application::$controller->skip_monitoring)) {
			self::$usage['sm_monusage_user_id'] = \User::id();
			self::$usage['sm_monusage_duration'] = round(microtime(true) - self::$usage['sm_monusage_duration'], 4);
			self::$usage['sm_monusage_resource_id'] = \Application::$controller->controller_id ?? null;
			self::$usage['sm_monusage_resource_name'] = \Application::$controller->title ?? get_class(\Application::$controller);
			// usage actions
			$usage_actions = \Application::$controller->getUsageActions();
			$history_added = false;
			if (!empty($usage_actions)) {
				foreach ($usage_actions as $k => $v) {
					self::$usage['\Numbers\Users\Monitoring\Model\Usage\Actions'][] = [
						'sm_monusgact_action_id' => ($k + 1),
						'sm_monusgact_usage_code' => $v['usage_code'],
						'sm_monusgact_message' => $v['message'],
						'sm_monusgact_replace' => $v['replace'],
						'sm_monusgact_affected_rows' => $v['affected_rows'],
						'sm_monusgact_error_rows' => $v['error_rows'],
						'sm_monusgact_url' => $v['url'],
						'sm_monusgact_history' => $v['history']
					];
					// update history
					if (!empty($v['history']) && !$history_added) {
						$this->updateHistory($v['url'], \Application::$controller->title ?? '');
						$history_added = true;
					}
				}
			}
			// add data to database
			$collection = new \Numbers\Users\Monitoring\Model\Collection\Usages();
			$collection->merge(self::$usage);
		}
	}

	/**
	 * Update history
	 *
	 * @param string $url
	 * @param string $title
	 */
	private function updateHistory(string $url, string $title) {
		// we do not add history if we preview history link
		if (isset(self::$__history_id)) return;
		$_SESSION['numbers']['flag_monitoring_steps'][] = [
			'url' => $url,
			'title' => $title,
		];
		end($_SESSION['numbers']['flag_monitoring_steps']);
		$key = key($_SESSION['numbers']['flag_monitoring_steps']);
		$_SESSION['numbers']['flag_monitoring_steps'][$key]['url'].= '&__history_id=' . $key;
		// we only keep 5 items in history
		$counter = count($_SESSION['numbers']['flag_monitoring_steps']) - 5;
		foreach ($_SESSION['numbers']['flag_monitoring_steps'] as $k => $v) {
			if ($counter <= 0) break;
			if ($k == $key) break;
			array_shift($_SESSION['numbers']['flag_monitoring_steps']);
			$counter--;
		}
	}
}