<?php

namespace App\Service\Action;

use App\Entity\Action\Action;
use App\Entity\Action\OfferAction;
use App\Entity\Offer\Offer;
use App\Enum\OfferActionType;
use App\Repository\Action\ActionRepositoryInterface;
use App\Repository\Action\OfferActionRepositoryInterface;

class ActionService
{
    /**
     * @var ActionRepositoryInterface
     */
    private ActionRepositoryInterface $actionRepository;

    /**
     * @var OfferActionRepositoryInterface
     */
    private OfferActionRepositoryInterface $offerActionRepository;

    /**
     * @param ActionRepositoryInterface      $actionRepository
     * @param OfferActionRepositoryInterface $offerActionRepository
     */
    public function __construct(
        ActionRepositoryInterface $actionRepository,
        OfferActionRepositoryInterface $offerActionRepository
    ) {
        $this->actionRepository = $actionRepository;
        $this->offerActionRepository = $offerActionRepository;
    }

    /**
     * @param string $name
     *
     * @return Action
     */
    public function getAction(string $name): Action
    {
        $action = $this->actionRepository->findActionByName($name);

        if (is_null($action)) {
            $action = $this->createAction($name);
        }

        return $action;
    }

    /**
     * @param string $name
     *
     * @return Action
     */
    public function createAction(string $name): Action
    {
        return $this->actionRepository->save(new Action(name: $name));
    }

    /**
     * @param Offer           $offer
     * @param string          $actionName
     * @param OfferActionType $actionType
     *
     * @return OfferAction
     */
    public function createOfferAction(
        Offer $offer,
        string $actionName,
        OfferActionType $actionType,
    ): OfferAction {
        $action = $this->getAction(name: $actionName);

        $offerAction = $this->offerActionRepository->findOfferAction(
            action: $action,
            offer: $offer,
            actionType: $actionType
        );

        if (is_null($offerAction)) {
//            $offerAction = new OfferAction(offer: $offer, )
        }
    }
}
