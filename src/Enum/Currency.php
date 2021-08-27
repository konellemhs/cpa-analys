<?php

namespace App\Enum;

/**
 * Currency in ISO_4217 standart
 */
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
     * Turkish lira
     */
    public const TRY = 'TRY';

    /**
     * Chech koruna
     */
    public const CZK = 'CZK';

    /**
     * United Arab Emirates dirham
     */
    public const AED = 'AED';

    /**
     * Polish zloty
     */
    public const PLN = 'PLN';

    /**
     * Kazakhstani tenge
     */
    public const KZT = 'KZT';

    /**
     * Singapore dollar
     */
    public const SGD = 'SGD';

    /**
     * Pound sterling
     */
    public const GBP = 'GBP';

    /**
     * Chinese yuan
     */
    public const CNY = 'CNY';

    /**
     * Danish crone
     */
    public const DKK = 'DKK';

    /**
     * Saudi riyal
     */
    public const SAR = 'SAR';

    /**
     * Philippine peso
     */
    public const PHP = 'PHP';

    /**
     * Indonesian rupiah
     */
    public const IDR = 'IDR';

    /**
     * Brazilian real
     */
    public const BRL = 'BRL';

    /**
     * Array of valid values
     */
    public const VALID_VALUES = [
        self::RUB,
        self::USD,
        self::EUR,
        self::UAH,
        self::BYN,
        self::INR,
        self::TRY,
        self::PLN,
        self::AED,
        self::CZK,
        self::IDR,
        self::PHP,
        self::SAR,
        self::DKK,
        self::CNY,
        self::GBP,
        self::SGD,
        self::KZT,
        self::BRL,
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
