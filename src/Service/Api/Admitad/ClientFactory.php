<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;

final class ClientFactory
{
    private string $clientId;
    private string $clientSecret;
    private string $clientHeader;

    /**
     * @param string $admitadApiClientId
     * @param string $admitadApiClientSecret
     * @param string $admitadApiClientHeader
     */
    public function __construct(
        string $admitadApiClientId,
        string $admitadApiClientSecret,
        string $admitadApiClientHeader
    ) {
        $this->clientId = $admitadApiClientId;
        $this->clientSecret = $admitadApiClientSecret;
        $this->clientHeader = $admitadApiClientHeader;
    }

    /**
     * @return Api
     */
    public static function getApi(): Api
    {
        return new Api();
    }
}
