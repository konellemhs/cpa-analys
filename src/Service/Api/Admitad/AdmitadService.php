<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;
use Admitad\Api\Response;
use App\DTO\AdmitadApi\AdmitadOfferData;
use App\Exception\ExternalApi\UnsuccessfulRequestException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class AdmitadService
{
    /**
     * getting offers endpoint
     */
    private const ADVCAMPAIGNS_URL = '/advcampaigns/';

    /**
     * http codes success responses
     */
    private const HTTP_SUCCESS_CODES = [200, 201];

    /**
     * @var Api
     */
    private Api $api;

    /**
     * @var string
     */
    private string $temporaryDirectory;

    /**
     * @param AdmitadClientFactory $factory
     * @param string               $temporaryCacheDirectory
     */
    public function __construct(
        AdmitadClientFactory $factory,
        string $temporaryCacheDirectory
    ) {
        $this->api = $factory->getApi();
        $this->temporaryDirectory = $temporaryCacheDirectory;
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function getActiveOffers(): array
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', -1);

        $result = $this->getJsonResponse(
            $this->api->get(self::ADVCAMPAIGNS_URL, ['limit' => 100])
        );


        // $result = $this->getJsonCache();

        $cacheResult = file_put_contents($this->temporaryDirectory . uniqid(), $result);


        $results = json_decode($result, true)['results'];

        foreach ($results as $offerData) {

            if ($offerData['actions'])
                try {
                    $offers[] = AdmitadOfferData::fromArray($offerData);
                } catch(\Exception $exception) {
                        dd($offerData, $exception);

                }
        }

        dd($offers);

        return [];
    }

    /**
     * @param Response $response
     *
     * @return string
     *
     * @throws UnsuccessfulRequestException
     */
    private function getJsonResponse(Response $response): string
    {
        $responseBody = $response->getContent();

        $responseCode = $response->getStatusCode();

        if (!in_array($responseCode, self::HTTP_SUCCESS_CODES, true)) {
            throw new UnsuccessfulRequestException(
                sprintf('AdmitadApi return not expected http code %d', $responseCode)
            );
        }

        return $responseBody;
    }

    private function getJsonCache(): string
    {
        return file_get_contents('C:\OpenServer\domains\self-workspace\cpa-analys\temp\6123d94861bf6');
    }
}

