<?php

namespace BeeDelivery\Acqio;

use BeeDelivery\Acqio\Utils\Connection;
use BeeDelivery\Acqio\Utils\Helpers;

class Authorize
{
    protected $helpers;
    protected $http;

    public function __construct()
    {
        $this->http = new Connection();
        $this->helpers = new Helpers();
    }

    public function authorizeWithCardNumber($params)
    {
        try {
//             dd($params);
            $this->helpers->validateWithCardNumber($params);
            
            return $this->http->post('/api/authorize', $params);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
        }
    }

    public function authorizeWithTokenId($params)
    {
        try {
            $this->helpers->validateWithTokenId($params);

            return $this->http->post('/api/authorize', $params);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
        }
    }
}
