<?php

namespace Numbers\Users\TaskScheduler\Helper;
class ProcessJobs {

	/**
	 * Process
	 *
	 * @param array $parameters
	 * @return array
	 */
	public function process(array $parameters) : array {
		$result = [
			'success' => false,
			'error' => []
		];
		do {
			// step 1 load all jobs with active user/tenant
			$query = \Numbers\Users\TaskScheduler\Model\Jobs::queryBuilderStatic(['skip_tenant' => true, 'skip_acl' => true])->select();
			$query->columns('a.*');
			$query->join('INNER', new \Numbers\Tenants\Tenants\Model\Tenants(), 'b', 'ON', [
				['AND', ['a.ts_job_tenant_id', '=', 'b.tm_tenant_id', true]]
			]);
			$query->join('INNER', new \Numbers\Users\Users\Model\Users(['skip_tenant' => true]), 'c', 'ON', [
				['AND', ['a.ts_job_tenant_id', '=', 'c.um_user_tenant_id', true]],
				['AND', ['a.ts_job_user_id', '=', 'c.um_user_id', true]]
			]);
			$query->where('AND', ['a.ts_job_daemon_code', '=', $parameters['daemon_code']]);
			if (!empty($parameters['tenant_id'])) {
				$query->where('AND', ['a.ts_job_tenant_id', '=', $parameters['tenant_id']]);
			}
			$query->where('AND', ['a.ts_job_inactive', '=', 0]);
			$jobs = $query->query();
			// exit if we have no jobs
			if (empty($jobs['rows'])) goto success;
			// new expression model
			$expression_model = new \Numbers\Users\TaskScheduler\Helper\Expression();
			$parameters_model = new \Numbers\Users\TaskScheduler\Model\JobParameters();
			$executed_jobs_collection = \Numbers\Users\TaskScheduler\Model\Executed\Jobs::collectionStatic();
			$executed_jobs_threads = [];
			// loop though jobs
			foreach ($jobs['rows'] as $k => $v) {
				$cron_expression = $v['ts_job_cron_minute'] . ' ' . $v['ts_job_cron_hour'] . ' ' . $v['ts_job_cron_day_of_month'] . ' ' . $v['ts_job_cron_month'] . ' ' . $v['ts_job_cron_day_of_week'] . ' ' . $v['ts_job_cron_year'];
				$expression_result = $expression_model->addExpression($cron_expression);
				// skip bad expressions
				if (!$expression_result['success']) continue;
				// check time
				$datetime = $parameters['datetime'];
				// todo: process timezone
				if (!$expression_model->isTime($datetime)) continue;
				// insert into database
				$sequence_model = new \Numbers\Users\TaskScheduler\Model\Executed\Jobs();
				$ts_execjb_id = $sequence_model->sequence('ts_execjb_id', 'nextval', $v['ts_job_tenant_id']);
				$executed_data = [
					'ts_execjb_tenant_id' => $v['ts_job_tenant_id'],
					'ts_execjb_id' => $ts_execjb_id,
					'ts_execjb_job_id' => $v['ts_job_id'],
					'ts_execjb_status' => 10,
					'ts_execjb_daemon_code' => $v['ts_job_daemon_code'],
					'ts_execjb_task_code' => $v['ts_job_task_code'],
					'ts_execjb_name' => $v['ts_job_name'],
					'ts_execjb_datetime' => $datetime,
					'ts_execjb_user_id' => $v['ts_job_user_id'],
					'ts_execjb_cron_expression' => $cron_expression,
					'ts_execjb_timezone_code' => $v['ts_job_timezone_code'],
					'ts_execjb_parameters' => [],
					'ts_execjb_inactive' => 0,
				];
				// load parameteres
				$parameters_data = $parameters_model->get([
					'where' => [
						'ts_jbparam_tenant_id' => $v['ts_job_tenant_id'],
						'ts_jbparam_job_id' => $v['ts_job_id']
					],
					'pk' => ['ts_jbparam_name']
				]);
				foreach ($parameters_data as $k2 => $v2) {
					$executed_data['ts_execjb_parameters'][$k2] = $v2['ts_jbparam_value'];
				}
				$executed_jobs_result = $executed_jobs_collection->merge($executed_data);
				// if we inserted
				if ($executed_jobs_result['success']) {
					$crypt_model = new \Crypt();
					$url = \Request::tenantHost('system') . 'Numbers/Users/TaskScheduler/Controller/External/SingleCronJob?__token=' . $crypt_model->tokenCreate($executed_jobs_result['new_pk']['ts_execjb_tenant_id'], $v['ts_job_user_id'], $executed_jobs_result['new_pk']['ts_execjb_id']);
					$executed_jobs_threads[] = [
						'tenant_id' => $executed_jobs_result['new_pk']['ts_execjb_tenant_id'],
						'executed_job_id' => $executed_jobs_result['new_pk']['ts_execjb_id'],
						'user_id' => $v['ts_job_user_id'],
						'url' => $url
					];
				} else {
					$result['error'] = array_merge($result['error'], $executed_jobs_result['error']);
					return $result;
				}
			}
			// success if we have no jobs to execute
			if (empty($executed_jobs_threads)) goto success;
			// debug
			//print_r2($executed_jobs_threads);
			//goto success;
			// call urls
			$curl_result = \Helper\cURL::multiExecGet($executed_jobs_threads);
			if (!$curl_result['success']) {
				$result['error'] = array_merge($result['error'], $curl_result['error']);
				return $result;
			}
			// success if we got here
success:
			$result['success'] = true;
		} while(0);
		return $result;
	}
}
