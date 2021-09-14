<?php

namespace App\VO\OfferData\Statistics;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class AdmitadOfferStatisticsData extends OfferStatisticsData
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="offer_rating")
     */
    private int $rating;

    /**
     * @param int | null $ecps
     * @param int | null $epc
     * @param int | null $cr
     * @param int | null $averageHoldTime
     * @param int | null $averageMoneyTransferTime
     * @param int        $rating
     */
    public function __construct(
        ?int $ecps,
        ?int $epc,
        ?int $cr,
        ?int $averageHoldTime,
        ?int $averageMoneyTransferTime,
        int $rating
    ) {
        parent::__construct(
            ecps: $ecps,
            epc: $epc,
            cr: $cr,
            averageHoldTime: $averageHoldTime,
            averageMoneyTransferTime: $averageMoneyTransferTime
        );

        $this->rating = $rating;
    }
}
