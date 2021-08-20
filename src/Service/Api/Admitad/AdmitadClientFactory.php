<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;

final class AdmitadClientFactory
{
    /**
     * scope
     */
    private const ADV_CAMPAIGNS_SCOPE = 'advcampaigns';

    /**
     * @var string
     */
    private string $clientId;

    /**
     * @var string
     */
    private string $clientSecret;

    /**
     * @var string
     */
    private string $admitadLogin;

    /**
     * @var string
     */
    private string $admitadPass;

    /**
     * @param string $admitadApiClientId
     * @param string $admitadApiClientSecret
     * @param string $admitadLogin
     * @param string $admitadPass
     */
    public function __construct(
        string $admitadApiClientId,
        string $admitadApiClientSecret,
        string $admitadLogin,
        string $admitadPass,
    ) {
        $this->clientId = $admitadApiClientId;
        $this->clientSecret = $admitadApiClientSecret;
        $this->admitadLogin = $admitadLogin;
        $this->admitadPass = $admitadPass;
    }

    /**
     * @return Api
     */
    public function getApi(): Api
    {
        $accessTokenResponse = (new Api())->authorizeByPassword(
            $this->clientId,
            $this->clientSecret,
            self::ADV_CAMPAIGNS_SCOPE,
            $this->admitadLogin,
            $this->admitadPass
        );

        return new Api(
            $accessTokenResponse->getResult('access_token')
        );
    }
}
