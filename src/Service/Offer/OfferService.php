<?php

namespace App\Service\Offer;

use App\Entity\Offer\AdmitadOffer;
use App\Repository\Offer\OfferRepositoryInterface;

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

    // /**
    //  *
    //  */
    // public function createAdmitadOffer(): AdmitadOffer
    // {
    //     $offer = new AdmitadOffer(
    //
    //     )
    // }

}
