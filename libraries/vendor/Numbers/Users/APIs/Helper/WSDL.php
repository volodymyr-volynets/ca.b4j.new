<?php

namespace Numbers\Users\APIs\Helper;
class WSDL {

	/**
	 * Generate WSDL
	 *
	 * @param string $endpoint
	 * @return string
	 */
	public static function generate(string $endpoint) : string {
		$result = '<?xml version="1.0" encoding="UTF-8"?>' ."\n";
		$result.= '<definitions name="Numbers" targetNamespace="urn:Numbers" xmlns:tns="urn:Numbers" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns="http://schemas.xmlsoap.org/wsdl/">' . "\n";
		// get a list of apis
		$apis = \Numbers\Backend\System\Modules\Model\Resources::getStatic([
			'where' => [
				'sm_resource_type' => 150,
				'sm_resource_inactive' => 0
			],
			'columns' => ['sm_resource_id', 'sm_resource_code'],
			'pk' => ['sm_resource_id']
		]);
		$all_apis = [];
		$all_aliases = [];
		foreach ($apis as $k => $v) {
			$model = \Factory::model($v['sm_resource_code']);
			if (empty($model->instructions)) continue;
			foreach ($model->instructions as $k2 => $v2) {
				$method = str_replace('\\', '', $v['sm_resource_code']) . '_' . $k2;
				$all_apis[$method] = $v2;
				// handle aliases
				foreach ($model->aliases as $k3 => $v3) {
					if ($v3 == $k2) {
						$method2 = str_replace('\\', '', $v['sm_resource_code']) . '_' . $k3;
						if ($method != $method2) {
							$all_aliases[$method][$method2] = 1;
						}
					}
				}
			}
		}
		// types
		$result.= '<types>' . "\n";
			$result.= '<schema targetNamespace = "http://example.com/stockquote.xsd" xmlns = "http://www.w3.org/2000/10/XMLSchema">' . "\n";
				foreach ($all_apis as $k => $v) {
					// request
					$result.= '<element name = "' . $k . '_Request_Type">' . "\n";
						$result.= '<complexType>' . "\n";
							$result.= '<all>' . "\n";
								foreach ($v['input'] as $k2 => $v2) {
									$result.= '<element name = "' . $k2 . '" type = "' . $v2['type'] . '"/>' . "\n";
								}
							$result.= '</all>' . "\n";
						$result.= '</complexType>' . "\n";
					$result.= '</element>' . "\n";
					// response
					$result.= '<element name = "' . $k . '_Response_Type">' . "\n";
						$result.= '<complexType>' . "\n";
							$result.= '<all>' . "\n";
								foreach ($v['output'] as $k2 => $v2) {
									$result.= '<element name = "' . $k2 . '" type = "' . $v2['type'] . '"/>' . "\n";
								}
							$result.= '</all>' . "\n";
						$result.= '</complexType>' . "\n";
					$result.= '</element>' . "\n";
				}
			$result.= '</schema>' . "\n";
		$result.= '</types>' . "\n";
		// messages
		foreach ($all_apis as $k => $v) {
			$result.= '<message name="' . $k . '_Request">' . "\n";
				$result.= '<part name="options" type="xsd:' . $k . '_Request_Type"/>' . "\n";
			$result.= '</message>' . "\n";
			$result.= '<message name="' . $k . '_Response">' . "\n";
				$result.= '<part name="options" type="xsd:' . $k . '_Response_Type"/>' . "\n";
			$result.= '</message>' . "\n";
		}
		// port
		$result.= '<portType name="FilterPort">' . "\n";
			foreach ($all_apis as $k => $v) {
				$result.= '<operation name="' . $k . '">' . "\n";
					$result.= '<input message="tns:' . $k . '_Request"/>' . "\n";
					$result.= '<output message="tns:' . $k . '_Response"/>' . "\n";
				$result.= '</operation>' . "\n";
				if (!empty($all_aliases[$k])) {
					foreach ($all_aliases[$k] as $k2 => $v2) {
						$result.= '<operation name="' . $k2 . '">' . "\n";
							$result.= '<input message="tns:' . $k . '_Request"/>' . "\n";
							$result.= '<output message="tns:' . $k . '_Response"/>' . "\n";
						$result.= '</operation>' . "\n";
					}
				}
			}
		$result.= '</portType>' . "\n";
		// binding
		$result.= '<binding name="FilterBinding" type="tns:FilterPort">' . "\n";
			$result.= '<soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>' . "\n";
			foreach ($all_apis as $k => $v) {
				$result.= '<operation name="' . $k . '">' . "\n";
					$result.= '<soap:operation soapAction="urn:FilterAction"/>' . "\n";
					$result.= '<input>' . "\n";
						$result.= '<soap:body use="encoded" namespace="urn:Numbers" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>' . "\n";
					$result.= '</input>' . "\n";
					$result.= '<output>' . "\n";
						$result.= '<soap:body use="encoded" namespace="urn:Numbers" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>' . "\n";
					$result.= '</output>' . "\n";
				$result.= '</operation>' . "\n";
				if (!empty($all_aliases[$k])) {
					foreach ($all_aliases[$k] as $k2 => $v2) {
						$result.= '<operation name="' . $k2 . '">' . "\n";
							$result.= '<soap:operation soapAction="urn:FilterAction"/>' . "\n";
							$result.= '<input>' . "\n";
								$result.= '<soap:body use="encoded" namespace="urn:Numbers" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>' . "\n";
							$result.= '</input>' . "\n";
							$result.= '<output>' . "\n";
								$result.= '<soap:body use="encoded" namespace="urn:Numbers" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>' . "\n";
							$result.= '</output>' . "\n";
						$result.= '</operation>' . "\n";
					}
				}
			}
		$result.= '</binding>' . "\n";
		// endpoint
		$result.= '<service name="WSDLService">' . "\n";
			$result.= '<port name="FilterPort" binding="tns:FilterBinding">' . "\n";
				$result.= '<soap:address location="' . $endpoint . '"/>' . "\n";
			$result.= '</port>' . "\n";
		$result.= '</service>' . "\n";
		$result.= '</definitions>';
		return $result;
	}
}