<?php

namespace Meroseo\Sdk;

class Main {

    private $accessToken = null;

    private $modules = [];
    static private $modulesAvailable = [
        'page',
        'auth',
        'event',
        'user'
    ];

    // Will need to direct this to the server... there should be an option to use a test environment
    private $config = [
        'endpoint' => 'http://api.meroseo.test'
    ];


    

    public function authenticate($apiId, $apiSecret) {
        $auth = new \Meroseo\Sdk\Modules\Auth($this->config['endpoint']);
        $accessToken = $auth->login($apiId, $apiSecret);
        if (empty($accessToken)) {
            throw new \Exception('Invalid Credentials');
        }

        $this->accessToken = $accessToken;

        var_dump($this->accessToken);
    }
 
	

    public function __construct($apiCredentials = null, $config = []) {
        if (!empty($apiCredentials)) {
            $this->authenticate($apiCredentials['id'], $apiCredentials['secret']);
        }

        $this->config = array_merge($this->config, $config);
	}

	

    public function __get($name)
    {   
        if (!in_array($name, static::$modulesAvailable)) {
            throw new \Exception('Module ' . $name . ' does not exist.');
        }

        if (empty($this->modules[$name])) {
            $class = '\\Meroseo\\Sdk\\Modules\\' . ucfirst($name);

            $this->modules[$name] = new $class($this->config['endpoint'], $this->accessToken);
        }

        return $this->modules[$name];
    }

}