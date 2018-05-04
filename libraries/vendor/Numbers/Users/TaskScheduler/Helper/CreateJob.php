<?php

namespace Numbers\Users\TaskScheduler\Helper;
class CreateJob {

	/**
	 * Create
	 *
	 * @param string $task_code
	 * @param object $form
	 */
	public static function create(string $task_code, & $form) {
		$params = [
			'ts_job_task_code' => $task_code,
			'ts_job_name' => $form->title,
			'\Numbers\Users\TaskScheduler\Model\JobParameters' => []
		];
		foreach ($form->values as $k => $v) {
			if ($k[0] == '_') continue;
			$params['\Numbers\Users\TaskScheduler\Model\JobParameters'][] = [
				'ts_jbparam_name' => $k,
				'ts_jbparam_value' => $v
			];
		}
		\Request::redirect('/Numbers/Users/TaskScheduler/Controller/Jobs/_Edit?' . http_build_query2($params));
	}
}
