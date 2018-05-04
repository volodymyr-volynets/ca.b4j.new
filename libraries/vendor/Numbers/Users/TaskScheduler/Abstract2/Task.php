<?php

namespace Numbers\Users\TaskScheduler\Abstract2;
abstract class Task {

	/**
	 * Task code
	 *
	 * @var string
	 */
	public $task_code;

	/**
	 * Task data
	 *
	 * @var array
	 */
	public $task_data;

	/**
	 * Parameters
	 *
	 * @var array
	 */
	public $parameters = [];

	/**
	 * Options
	 *
	 * @var array
	 */
	public $options = [];

	/**
	 * Execute
	 *
	 * @param array $parameters
	 * @param array $options
	 * @return array
	 *		success
	 *		error
	 *		data
	 */
	abstract public function execute(array $parameters, array $options = []) : array;

	/**
	 * Constructor
	 *
	 * @param array $parameters
	 * @param array $options
	 */
	public function __construct(array $parameters, array $options = []) {
		$this->parameters = $parameters ?? [];
		$this->options = $options ?? [];
		// sanity check
		if (empty($this->task_code)) {
			Throw new \Exception('task code?');
		}
		// load task
		$model = new \Numbers\Users\TaskScheduler\Model\Collection\Tasks();
		$data = $model->get([
			'where' => [
				'ts_task_code' => $this->task_code
			]
		]);
		if (!$data['success'] || empty($data['data'][$this->task_code])) {
			Throw new \Exception('task code?');
		}
		$this->task_data = $data['data'][$this->task_code];
	}

	/**
	 * Process
	 *
	 * @return array
	 */
	public function process(array $options = []) {
		$result = [
			'success' => false,
			'error' => []
		];
		// process parameters
		foreach ($this->task_data['\Numbers\Users\TaskScheduler\Model\TaskParameters'] as $k => $v) {
			if (!empty($v['ts_tskparam_mandatory'])) {
				if (empty($this->parameters[$v['ts_tskparam_name']])) {
					$result['error'][] = 'Missing parameter: ' . $v['ts_tskparam_name'];
				}
			}
		}
		if (!empty($result['error'])) return $result;
		// execute
		$this->options = array_merge_hard($this->options, $options);
		$result = $this->execute($this->parameters, $this->options);
		// todo: send email notification
		return $result;
	}
}
