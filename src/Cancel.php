<?php

namespace BeeDelivery\Acqio;

use BeeDelivery\Acqio\Utils\Connection;
use BeeDelivery\Acqio\Utils\Helpers;

class Cancel
{
    protected $helpers;
    protected $http;

    public function __construct()
    {
        $this->http = new Connection();
        $this->helpers = new Helpers();
    }

    public function cancel($transactionId)
    {
        try {
            $this->helpers->validateCancel(['transactionId' => $transactionId]);

            return $this->http->put('/api/cancel/'. $transactionId);
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
        }
    }
}
