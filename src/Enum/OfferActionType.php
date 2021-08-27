<?php

namespace App\Enum;

class OfferActionType extends Enum
{
    /**
     * Purpose of the offer is sale
     */
    private const SALE = 'sale';

    /**
     * Purpose of the offer is lead
     */
    private const LEAD = 'lead';

    /**
     * Purpose of the offer is click
     */
    private const CLICK = 'click';

    /**
     * Array of valid values
     */
    private const VALID_VALUES = [
        self::SALE,
        self::LEAD,
        self::CLICK,
    ];

    /**
     * Return valid values in array
     *
     * @return array
     */
    protected function getValidValues(): array
    {
        return self::VALID_VALUES;
    }
}
