<?php

namespace App\Entity\Offer;

use App\Entity\Action\OfferAction;
use App\Entity\Region;
use App\Enum\Currency;
use DateTimeImmutable;
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
     * @var Collection<Category>
     */
    private Collection $categories;

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
}
