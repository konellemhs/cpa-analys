<?php

namespace App\Enum;

class Currency extends Enum
{
    /**
     * Payment in rubles
     */
    public const RUB = 'RUB';

    /**
     * Payment in US dollars
     */
    public const USD = 'USD';

    /**
     * Payment in EURO
     */
    public const EUR = 'EUR';

    /**
     * Array of valid values
     */
    private const VALID_VALUES = [
        self::RUB,
        self::USD,
        self::EUR,
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
