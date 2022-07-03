<?php 

namespace Meroseo\Sdk\Modules;

class Auth extends Generic
{
  
    /**
     * Initial method to be called...
     */
    public function login($apiId, $apiSecrete) {
        $response = $this->post('/auth/login/', [
            'apiId' => $apiId,
            'apiSecret' => $apiSecrete
        ]);

        var_dump($response);

        if (!$response['access_token']) {
        	return false;
        }

        return $response['access_token'];
    }

}