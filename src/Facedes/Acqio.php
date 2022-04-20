<?php

namespace BeeDelivery\Acqio\Facades;

use Illuminate\Support\Facades\Facade;

class Acqio extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'acqio';
    }
}