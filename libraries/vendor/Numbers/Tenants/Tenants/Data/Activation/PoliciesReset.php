<?php

namespace Numbers\Tenants\Tenants\Data\Activation;
class PoliciesReset extends \Numbers\Backend\System\Modules\Abstract2\Reset {
	public function execute() {
		$this->clearTable(new \Numbers\Tenants\Tenants\Model\Policy\Folders);
		$this->clearTable(new \Numbers\Tenants\Tenants\Model\Policy\Roots);
	}
}