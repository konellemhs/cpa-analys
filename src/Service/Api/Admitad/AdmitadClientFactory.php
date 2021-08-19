<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;

final class AdmitadClientFactory
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
    public function getApi(): Api
    {
        try {
            $accessTokenResponse = (new Api())->authorizeByPassword(
                $this->clientId,
                $this->clientSecret,
                'advcampaigns',
                'login',
                'password'
            );
            
            $api = new Api($accessTokenResponse->getResult('access_token'));

            dd($api->get('/advcampaigns/')->getResult());

        }catch (\Exception $exception) {
            dd($exception);
        }




        dd($authorizeUrl);

        $authorizeUrl = $api->requestAccessToken($this->clientId, $this->clientSecret, $scope);
        return new Api();
    }
}
