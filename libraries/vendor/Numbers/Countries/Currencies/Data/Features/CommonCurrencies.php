<?php

namespace Numbers\Countries\Currencies\Data\Features;
class CommonCurrencies extends \Object\Activation\Base {
	public function activate(array $options = []) : array {
		$import = new \Numbers\Countries\Currencies\Data\Features\Import\Currencies($options);
		return $import->process();
	}
}