<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;

class AdmitadService
{
    /**
     * getting offers endpoint
     */
    private const ADVCAMPAIGNS_URL = '/advcampaigns/';

    /**
     * @var Api
     */
    private Api $api;

    public function __construct(AdmitadClientFactory $factory)
    {
        $this->api = $factory->getApi();
    }

    /**
     * @return array
     */
    public function getActiveOffers(): array
    {
        $response = $this->api->get(self::ADVCAMPAIGNS_URL);


        dd(current(json_decode($response->getContent(), true)['results']));

        return [];
    }
}

