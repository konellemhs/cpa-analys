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
     * @var string
     */
    private string $payment;

    /**
     * @var int
     */
    private int $holdTime;

    /**
     * @var string
     */
    private string $name;

    /**
     * @param int             $id
     * @param OfferActionType $type
     * @param string          $payment
     * @param int             $holdTime
     * @param string          $name
     */
    public function __construct(
        int $id,
        OfferActionType $type,
        string $payment,
        int $holdTime,
        string $name
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->payment = $payment;
        $this->holdTime = $holdTime;
        $this->name = $name;
    }

    /**
     * Combine object from data
     *
     * @param array $data
     *
     * @return ActionData
     */
    public static function fromArray(array $data): self
    {
        if (!is_int($data['id'])) {
            throw new \Exception();
        }

        return new self(
            id: $data['id'],
            type: new OfferActionType($data['type']),
            payment: $data['payment_size'],
            holdTime: $data['hold_time'],
            name: $data['name']
        );
    }
}
