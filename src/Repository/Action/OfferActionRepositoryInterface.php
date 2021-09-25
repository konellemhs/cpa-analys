<?php

namespace App\Repository\Action;

use App\Entity\Action\Action;
use App\Entity\Action\OfferAction;
use App\Entity\Offer\Offer;
use App\Enum\OfferActionType;

interface OfferActionRepositoryInterface
{
    /**
     * Save Offer Action in database
     *
     * @param OfferAction $offerAction
     *
     * @return OfferAction
     */
    public function saveOfferAction(OfferAction $offerAction): OfferAction;

    /**
     * Find offer_action row by offer and action
     *
     * @param Action          $action
     * @param Offer           $offer
     * @param OfferActionType $actionType
     *
     * @return OfferAction | null
     */
    public function findOfferAction(
        Action $action,
        Offer $offer,
        OfferActionType $actionType
    ): ?OfferAction;
}
