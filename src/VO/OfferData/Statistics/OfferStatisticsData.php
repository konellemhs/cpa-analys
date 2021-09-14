<?php

namespace App\VO\OfferData\Statistics;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
abstract class OfferStatisticsData
{
    /**
     * @var int | null
     *
     * @ORM\Column(type="integer", name="offer_ecps")
     */
    private ?int $ecps;

    /**
     * @var int | null
     *
     * @ORM\Column(type="integer", name="offer_epc")
     */
    private ?int $epc;

    /**
     * @var int | null
     *
     * @ORM\Column(type="integer", name="offer_cr")
     */
    private ?int $cr;

    /**
     * @var int | null
     *
     * @ORM\Column(type="integer", name="offer_average_hold_time")
     */
    private ?int $averageHoldTime;

    /**
     * @var int | null
     *
     * @ORM\Column(type="integer", name="offer_average_money_transfer_time")
     */
    private ?int $averageMoneyTransferTime;

    /**
     * @param int | null $ecps
     * @param int | null $epc
     * @param int | null $cr
     * @param int | null $averageHoldTime
     * @param int | null $averageMoneyTransferTime
     */
    public function __construct(
        ?int $ecps,
        ?int $epc,
        ?int $cr,
        ?int $averageHoldTime,
        ?int $averageMoneyTransferTime
    ) {
        $this->ecps = $ecps;
        $this->epc = $epc;
        $this->cr = $cr;
        $this->averageHoldTime = $averageHoldTime;
        $this->averageMoneyTransferTime = $averageMoneyTransferTime;
    }
}