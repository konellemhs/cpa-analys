<?php

namespace App\DTO\AdmitadApi;

use App\Enum\OfferActionType;

class ActionData
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var OfferActionType
     */
    private OfferActionType $type;

    /**
     * @var int
     */
    private int $payment;

    /**
     * @var int
     */
    private int $holdTime;

    /**
     * @var string
     */
    private string $name;
}
