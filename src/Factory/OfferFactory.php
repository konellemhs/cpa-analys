<?php

namespace App\Factory;

use App\DTO\AdmitadApi\AdmitadOfferData;
use App\DTO\OfferDataInterface;
use App\Entity\Offer\Offer;
use App\Service\Offer\OfferService;

/**
 * Factory, which responsibility is combine data to offer
 */
class OfferFactory
{
    /**
     * @var OfferService
     */
    private OfferService $offerService;

    /**
     * @var ActionService
     */
    private ActionService $actionService;

    /**
     * @param OfferService  $offerService
     * @param ActionService $actionService
     */
    public function __construct(
        OfferService $offerService,
        ActionService $actionService
    ) {
        $this->offerService = $offerService;
        $this->actionService = $actionService
    }

    /**
     * @param OfferDataInterface $offerData
     *
     * @return Offer
     */
    public function createOffer(OfferDataInterface $offerData): Offer
    {
        if ($offerData instanceof AdmitadOfferData) {

            $actions = $offerData->getActions();

            $offer = $this->offerService->createAdmitadOffer(
                currency: $offerData->getCurrency(),


            );
        }

        return $offer;
    }
}
