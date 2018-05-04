<?php

namespace Numbers\Users\Monitoring\Helper;
class Monitor {

	/**
	 * Usage
	 *
	 * @var array
	 */
	public static $usage = [];

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
		self::$usage = [
			'sm_monusage_tenant_id' => \Tenant::id(),
			'sm_monusage_session_id' => $_SESSION['numbers']['flag_monitoring_session_id'],
			'sm_monusage_timestamp' => \Format::now('timestamp'),
			'sm_monusage_user_id' => \User::id(),
			'sm_monusage_user_ip' => \Request::ip(),
			'sm_monusage_resource_id' => null,
			'sm_monusage_resource_name' => null,
			'sm_monusage_duration' => microtime(true),
			'sm_monusage_actions' => []
		];
	}

	/**
	 * Action
	 *
	 * @param string $description
	 */
	public function action(string $description) {
		
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
			// add data to database
			$model = new \Numbers\Users\Monitoring\Model\Usages();
			$model->db_object->insert($model->full_table_name, [self::$usage]);
		}
	}
}