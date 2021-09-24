<?php

namespace App\Entity\Traffic;

use App\Entity\Offer\Offer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="offer_traffic", uniqueConstraints={
 *     @ORM\UniqueConstraint(
 *          name="offer_traffic_unique_idx",
 *          columns={"traffic_id", "offer_id"}
 *     )
 * })
 */
class OfferTraffic
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private bool $isEnabled;

    /**
     * @var Traffic
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Traffic\Traffic", inversedBy="offers")
     * @ORM\JoinColumn(referencedColumnName="id", name="traffic_id")
     */
    private Traffic $traffic;

    /**
     * @var Offer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer\Offer", inversedBy="traffics")
     * @ORM\JoinColumn(referencedColumnName="id", name="offer_id")
     */
    private Offer $offer;

    /**
     * @param bool    $isEnabled
     * @param Traffic $traffic
     * @param Offer   $offer
     */
    public function __construct(Traffic $traffic, Offer $offer, bool $isEnabled)
    {
        $this->isEnabled = $isEnabled;
        $this->traffic = $traffic;
        $this->offer = $offer;
    }
}
