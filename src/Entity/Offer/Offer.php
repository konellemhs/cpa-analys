<?php

namespace App\Entity\Offer;

use App\Entity\Action\OfferAction;
use App\Entity\Region;
use App\Entity\Traffic\OfferTraffic;
use App\Entity\Traffic\Traffic;
use App\Enum\Currency;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Category;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="offer")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "offer" = "App\Entity\Offer\Offer",
 *     "admitad_offer" = "App\Entity\Offer\AdmitadOffer"
 * })
 */
abstract class Offer
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="uuid")
     */
    private string $id;

    /**
     * @var DateTimeImmutable
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $lastUpdatedAt;

    /**
     * @var DateTimeImmutable
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @var Currency
     *
     * @ORM\Column(type="currency", name="currency")
     */
    private Currency $currency;

    /**
     * @var Collection<OfferAction>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Action\OfferAction", mappedBy="offer")
     */
    private Collection $actions;

    /**
     * @var Collection<Region>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Region")
     * @ORM\JoinTable(name="offers_regions",
     *      joinColumns={@ORM\JoinColumn(name="offer_id", referencedColumnName="")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="region_id", referencedColumnName="id")}
     * )
     */
    private Collection $regions;

    /**
     * @var Collection<OfferTraffic>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Traffic\OfferTraffic", mappedBy="offer")
     */
    private Collection $traffics;

    /**
     * @param Currency            $currency
     * @param array<OfferAction>  $actions
     * @param array<Region>       $regions
     * @param array<OfferTraffic> $traffics
     */
    public function __construct(
        Currency $currency,
        array $actions,
        array $regions,
        array $traffics
    ) {
        $this->currency = $currency;
        $this->actions = new ArrayCollection(array_unique($actions, SORT_REGULAR));
        $this->regions = new ArrayCollection(array_unique($regions, SORT_REGULAR));
        $this->traffics = new ArrayCollection(array_unique($traffics, SORT_REGULAR));
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getLastUpdatedAt(): DateTimeImmutable
    {
        return $this->lastUpdatedAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return Collection<OfferAction>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    /**
     * @return Collection<Region>
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    /**
     * @return Collection<Traffic>
     */
    public function getTraffics(): Collection
    {
        return $this->traffics;
    }
}
