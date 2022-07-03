<?php

namespace Meroseo\Sdk\Modules;

use Laminas\Http\Client;

abstract class Generic {

	const METHOD_GET = 'get';
    const METHOD_POST = 'post';

	protected $endpoint = null;	
	protected $accessToken = null;
	


	function __construct($endpoint, $accessToken = null) {
		$this->endpoint = $endpoint;
		$this->accessToken = $accessToken;
	}

	private function request($method, $url, $parameters, $options) {

		$client = new Client();
		$client->setUri($this->endpoint . $url);
		
		print 'Will be calling: "' . $this->endpoint . $url . '"';

		$parameters = array_merge(
			$parameters, 
			[ 'access_token' => $this->accessToken ]
		);

		print_r($parameters);

		switch ($method) {
			case static::METHOD_GET:
				$client->setParameterGet($parameters);	
			break;
			case static::METHOD_POST:
				$client->setMethod('POST');
				$client->setParameterPost($parameters);	
			break;
		}

		$response = $client->send();		
		
		return $this->parseResponse($response);
	}



	protected function get($url, $parameters = [], $options = []) {

		return $this->request(static::METHOD_GET, $url, $parameters, $options);
	}



	protected function post($url, $parameters = [], $options = []) {
		
		return $this->request(static::METHOD_POST, $url, $parameters, $options);
	}



	private function parseResponse($response) {

		if (!$response->isSuccess()) {
			return false;
		}

		$responseJson = json_decode($response->getBody(), true);

		if (!isset($responseJson['ok'])) {
			print_r($responseJson);
			print 'fooo \n\n\n';
			die();
		}

		if (!$responseJson['ok']) {
			throw new \Exception(
				$responseJson['response']['data']['error']['message'], 
				$responseJson['response']['data']['error']['code']
			);
		}


		
		return !empty($responseJson['response']['data']) ? $responseJson['response']['data'] : null ;
	} 

}