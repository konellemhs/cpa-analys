<?php

namespace App\DTO\AdmitadApi;

use App\Enum\Currency;
use Doctrine\Common\Collections\Collection;

class AdmitadOfferData
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string | null
     */
    private ?string $description;

    /**
     * @var Currency
     */
    private Currency $currency;

    /**
     * @var float
     */
    private float $rating;

    /**
     * @var float
     */
    private float $ecps;

    /**
     * @var float
     */
    private float $epc;

    /**
     * @var float
     */
    private float $cr;

    /**
     * @var ActionData[] | Collection
     */
    private Collection | array $actions;




}
