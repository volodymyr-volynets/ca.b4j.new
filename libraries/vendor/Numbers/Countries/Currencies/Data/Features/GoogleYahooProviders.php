<?php

namespace Numbers\Countries\Currencies\Data\Features;
class GoogleYahooProviders extends \Object\Activation\Base {
	public function activate(array $options = []) : array {
		$import = new \Numbers\Countries\Currencies\Data\Features\Import\Providers($options);
		return $import->process();
	}
}