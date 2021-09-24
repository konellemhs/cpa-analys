<?php

namespace App\Service\Offer;

use App\Entity\Offer\AdmitadOffer;
use App\Enum\Currency;
use App\Repository\Offer\OfferRepositoryInterface;
use App\VO\OfferData\Common\AdmitadOfferCommonData;
use App\VO\OfferData\Statistics\AdmitadOfferStatisticsData;
use DateTimeImmutable;
use Exception\Entity\EntityExistsException;

class OfferService
{
    /**
     * @var OfferRepositoryInterface
     */
    private OfferRepositoryInterface $offerRepository;

    /**
     * @param OfferRepositoryInterface $offerRepository
     */
    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param Currency          $currency
     * @param array             $actions
     * @param array             $regions
     * @param array             $traffics
     * @param array             $categories
     * @param int               $admitadOfferId
     * @param string            $name
     * @param string            $description
     * @param string            $status
     * @param DateTimeImmutable $activationTime
     * @param DateTimeImmutable $modifiedTime
     * @param string            $imageLink
     * @param int | null        $ecps
     * @param int | null        $epc
     * @param int | null        $cr
     * @param int | null        $averageHoldTime
     * @param int | null        $averageMoneyTransferTime
     * @param int               $rating
     *
     * @return AdmitadOffer
     *
     * @throws EntityExistsException
     */
    public function createAdmitadOffer(
        Currency $currency,
        array $actions,
        array $regions,
        array $traffics,
        array $categories,
        int $admitadOfferId,
        string $name,
        string $description,
        string $status,
        DateTimeImmutable $activationTime,
        DateTimeImmutable $modifiedTime,
        string $imageLink,
        ?int $ecps,
        ?int $epc,
        ?int $cr,
        ?int $averageHoldTime,
        ?int $averageMoneyTransferTime,
        int $rating
    ): AdmitadOffer {
        $offer = $this->offerRepository->findAdmitadOfferByAdmitadOfferId($admitadOfferId);

        if (!is_null($offer)) {
            throw new EntityExistsException(sprintf('Admitad offer %d is exists', $admitadOfferId));
        }

        $offer = new AdmitadOffer(
            currency: $currency,
            actions: $actions,
            regions: $regions,
            traffics: $traffics,
            categories: $categories,
            admitadOfferId: $admitadOfferId,
            commonData: new AdmitadOfferCommonData(
                name: $name,
                description: $description,
                status: $status,
                imageLink: $imageLink,
                activationTime: $activationTime,
                modifiedTime: $modifiedTime
            ),
            statisticsData: new AdmitadOfferStatisticsData(
                ecps: $ecps,
                epc: $epc,
                cr: $cr,
                averageHoldTime: $averageHoldTime,
                averageMoneyTransferTime: $averageMoneyTransferTime,
                rating: $rating
            )
        );

        $this->offerRepository->save($offer);

        return $offer;
    }
}
