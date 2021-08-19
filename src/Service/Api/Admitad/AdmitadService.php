<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;

class AdmitadService
{
    /**
     * @var Api
     */
    private Api $api;

    public function __construct(AdmitadClientFactory $factory)
    {
        $this->api = $factory->getApi();
    }

    public function test(): void
    {
        dd($this);
    }
}

