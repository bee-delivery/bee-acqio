<?php

namespace BeeDelivery\Acqio;

use BeeDelivery\Acqio\Utils\Connection;
use BeeDelivery\Acqio\Utils\Helpers;

class TokenizeCard
{
    protected $helpers;
    protected $http;

    public function __construct()
    {
        $this->http = new Connection();
        $this->helpers = new Helpers();
    }

    public function tokenizeCard($params)
    {
        try {
            $data = array_merge($params, ['client_id' => config('acqio.client_id')]);
            $this->helpers->validateTokenizeCard($data);
            
            return $this->http->post('/api/tokenize-card', $data);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
        }
    }
}
