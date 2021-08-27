<?php

namespace App\Service\Api\Admitad;

use Admitad\Api\Api;
use Admitad\Api\Response;
use App\Exception\ExternalApi\UnsuccessfulRequestException;
use Psr\Log\LoggerInterface;

class AdmitadApiService
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
     * Limit for request (it is necessary, since the second side does not hold the load)
     */
    private const ADMITAD_API_REQUEST_LIMIT = 10;

    /**
     * @var Api
     */
    private Api $client;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param AdmitadApiClientFactory $factory
     * @param LoggerInterface         $logger
     */
    public function __construct(
        AdmitadApiClientFactory $factory,
        LoggerInterface $logger
    ) {
        $this->client = $factory->getClient();
        $this->logger = $logger;
    }

    /**
     * Return all admitad offers.
     * When using, keep in mind that this function will be performed for about 20 minutes.
     * DO`T USE IN USER RUNTIME REQUEST!
     *
     * @return array
     *
     * @throws UnsuccessfulRequestException
     * @throws \JsonException
     */
    public function getAllOffers(): array
    {
        // Turning off the memory and time limits
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', -1);

        $this->logger->info('Request first results at AdmitadApi');

        // Request first result.
        $firstResultCount = self::ADMITAD_API_REQUEST_LIMIT;
        $firstRequest = $this->getOffersByPagination(limit: $firstResultCount);

        $meta = $firstRequest['_meta'];
        $results = $firstRequest['results'];

        // Count is need send request to admitad api to get all rows
        $requestCount = ceil(($meta['count'] - $firstResultCount) / self::ADMITAD_API_REQUEST_LIMIT);

        // Variable with current offset
        $currentOffset = $firstResultCount;

        // In the loop, we request data in turn
        for ($i = 0; $i < $requestCount; $i++) {
            $response = $this->getOffersByPagination(offset: $currentOffset);

            foreach ($response['results'] as $item) {
                $results[] = $item;
            }

            $currentOffset += self::ADMITAD_API_REQUEST_LIMIT;

            unset($response);
        }

        return $results;
    }

    /**
     * @param int | null $limit
     * @param int | null $offset
     *
     * @return array<string, array<string, array>>
     *
     * @throws UnsuccessfulRequestException
     * @throws \JsonException
     */
    public function getOffersByPagination(
        ?int $limit = self::ADMITAD_API_REQUEST_LIMIT,
        ?int $offset = 0
    ): array {
        $this->logger->info(
            sprintf('Request in AdmitadApi with limit = %d and offset %d', $limit, $offset)
        );

        return $this->getResponse(
            $this->client->get(
                self::ADVCAMPAIGNS_URL,
                [
                    'offset' => $offset,
                    'limit' => $limit,
                ],
            )
        );
    }

    /**
     * @param Response $response
     *
     * @return array
     *
     * @throws UnsuccessfulRequestException
     * @throws \JsonException
     */
    private function getResponse(Response $response): array
    {
        $responseBody = $response->getContent();

        $responseCode = $response->getStatusCode();

        if (!in_array($responseCode, self::HTTP_SUCCESS_CODES, true)) {
            throw new UnsuccessfulRequestException(
                sprintf('AdmitadApi return not expected http code %d', $responseCode)
            );
        }

        return json_decode($responseBody, true, 1024, JSON_THROW_ON_ERROR);
    }
}

