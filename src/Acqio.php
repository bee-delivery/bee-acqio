<?php

namespace BeeDelivery\Acqio;

class Acqio
{
    public function authorize()
    {
        return new Authorize();
    }

    public function cancel()
    {
        return new Cancel();
    }

    public function cancelByReference()
    {
        return new CancelByReference();
    }

    public function capture()
    {
        return new Capture();
    }

    public function query()
    {
        return new Query();
    }

    public function queryByReference()
    {
        return new QueryByReference();
    }
}
