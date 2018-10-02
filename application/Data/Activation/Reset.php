<?php

namespace Data\Activation;
class Reset extends \Numbers\Backend\System\Modules\Abstract2\Reset {
	public function execute() {
		$this->clearTable(new \Model\Counselors);
		$this->clearTable(new \Model\Registrations);
		$this->clearTable(new \Model\Register);
		$this->clearTable(new \Model\Periods);
	}
}