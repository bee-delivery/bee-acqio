<?php

namespace BeeDelivery\Acqio;

use BeeDelivery\Acqio\Utils\Connection;
use BeeDelivery\Acqio\Utils\Helpers;

class Capture
{
    protected $helpers;
    protected $http;

    public function __construct()
    {
        $this->http = new Connection();
        $this->helpers = new Helpers();
    }

    public function Capture($transactionId)
    {
        try {
            $this->helpers->validateCapture(['transactionId' => $transactionId]);

            return $this->http->put('/api/capture/' . $transactionId);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
        }
    }
}
