<?php

namespace BeeDelivery\Acqio;

use BeeDelivery\Acqio\Utils\Connection;
use BeeDelivery\Acqio\Utils\Helpers;

class QueryByReference
{
    protected $helpers;
    protected $http;

    public function __construct()
    {
        $this->http = new Connection();
        $this->helpers = new Helpers();
    }
    
    public function cancelByReference($params)
    {
        try {
            $this->helpers->validateCancelByReference($params);

            return $this->http->put('/api/querytransaction', $params);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
        }
    }
}
