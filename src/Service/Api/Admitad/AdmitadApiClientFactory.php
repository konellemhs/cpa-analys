<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;

final class AdmitadApiClientFactory
{
    /**
     * scope
     */
    private const APPLICATION_SCOPE = 'advcampaigns';

    /**
     * The field in response where access key is stored
     */
    private const ACCESS_TOKEN_FIELD = 'access_token';

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
     * Combine AdmitadApiClient
     *
     * @return Api
     *
     * @see https://github.com/admitad/admitad-php-api
     */
    public function getClient(): Api
    {
        $accessTokenResponse = (new Api())->authorizeByPassword(
            $this->clientId,
            $this->clientSecret,
            self::APPLICATION_SCOPE,
            $this->admitadLogin,
            $this->admitadPass
        );

        return new Api($accessTokenResponse->getResult(self::ACCESS_TOKEN_FIELD));
    }
}
