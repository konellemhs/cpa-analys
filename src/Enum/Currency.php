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
     * Payment in Ukrainian hryvnia
     */
    public const UAH = 'UAH';

    /**
     * Payment in BYN
     */
    public const BYN = 'BYN';

    /**
     * Indian rupee
     */
    public const INR = 'INR';

    /**
     * Array of valid values
     */
    private const VALID_VALUES = [
        self::RUB,
        self::USD,
        self::EUR,
        self::UAH,
        self::BYN,
        self::INR,
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
