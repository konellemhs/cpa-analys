<?php

namespace App\Entity\Action;

use App\Entity\Offer\Offer;
use App\Enum\OfferActionType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="offer_action")
 */
class OfferAction
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="uuid")
     */
    private string $id;

    /**
     * @var Offer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer\Offer", inversedBy="actions")
     * @ORM\JoinColumn(referencedColumnName="id", name="offer_id")
     */
    private Offer $offer;

    /**
     * @var Action
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Action\Action", inversedBy="offers")
     * @ORM\JoinColumn(referencedColumnName="id", name="action_id")
     */
    private Action $action;

    /**
     * @var OfferActionType
     *
     * @ORM\Column(type="offer_action_type")
     */
    private OfferActionType $actionType;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="payment_amount")
     */
    private int $payment;

    /**
     * @var int | null
     *
     * @ORM\Column(type="integer", name="external_id", nullable=true)
     */
    private ?int $externalId;

    /**
     * @param Offer           $offer
     * @param Action          $action
     * @param OfferActionType $actionType
     * @param int             $payment
     * @param int | null      $externalId
     */
    public function __construct(
        Offer $offer,
        Action $action,
        OfferActionType $actionType,
        int $payment,
        ?int $externalId
    ) {
        $this->offer = $offer;
        $this->action = $action;
        $this->actionType = $actionType;
        $this->payment = $payment;
        $this->externalId = $externalId;
    }
}
