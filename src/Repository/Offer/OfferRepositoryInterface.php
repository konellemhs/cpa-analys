<?php

namespace App\Repository\Offer;

use App\Entity\Offer\Offer;

interface OfferRepositoryInterface
{
    /**
     * add offer to database
     *
     * @param Offer $offer
     *
     * @return Offer
     */
    public function add(Offer $offer): Offer;
}
