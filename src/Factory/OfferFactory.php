<?php

namespace App\Factory;

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
     * @param OfferService $offerService
     */
    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }
    //
    // /**
    //  * @param OfferDataInterface $offerData
    //  *
    //  * @return Offer
    //  */
    // public function createOffer(OfferDataInterface $offerData): Offer
    // {
    //     $this->offerService->createAdmitadOffer();
    // }
}
