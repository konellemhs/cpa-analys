<?php

namespace App\Repository\Offer;

use App\Entity\Offer\AdmitadOffer;
use App\Entity\Offer\Offer;

interface OfferRepositoryInterface
{
    /**
     * Search admitad offer by unique field
     *
     * @param int $admitadOfferId
     *
     * @return AdmitadOffer | null
     */
    public function findAdmitadOfferByAdmitadOfferId(int $admitadOfferId): ?AdmitadOffer;

    /**
     * save offer
     *
     * @param Offer $offer
     *
     * @return Offer
     */
    public function save(Offer $offer): Offer;
}
