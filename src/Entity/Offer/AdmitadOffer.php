<?php

namespace App\Entity\Offer;

use App\Entity\Action\OfferAction;
use App\Entity\Category\AdmitadCategory;
use App\Entity\Region;
use App\Entity\Traffic\OfferTraffic;
use App\Enum\Currency;
use App\VO\OfferData\Common\AdmitadOfferCommonData;
use App\VO\OfferData\Statistics\AdmitadOfferStatisticsData;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Admitad offer.
 *
 * @see https://developers.admitad.com/ru/doc/api_ru/methods/advcampaigns/advcampaigns-list/#api
 *
 * @ORM\Entity
 */
class AdmitadOffer extends Offer
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="admitad_offer_id", unique=true)
     */
    private int $admitadOfferId;

    /**
     * @var AdmitadOfferCommonData
     *
     * @ORM\Embedded(class="App\VO\OfferData\Common\AdmitadOfferCommonData", columnPrefix="admitad_")
     */
    private AdmitadOfferCommonData $commonData;

    /**
     * @var AdmitadOfferStatisticsData
     *
     * @ORM\Embedded(class="App\VO\OfferData\Statistics\AdmitadOfferStatisticsData", columnPrefix="admitad_")
     */
    private AdmitadOfferStatisticsData $statisticsData;

    /**
     * @var Collection<AdmitadCategory>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Category\AdmitadCategory")
     * @ORM\JoinTable(name="admitad_category_offers",
     *      joinColumns={@ORM\JoinColumn(name="admitad_category_id", referencedColumnName="")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="admitad_offer_id", referencedColumnName="id")}
     * )
     */
    private Collection $categories;

    /**
     * @param Currency                   $currency
     * @param array<OfferAction>         $actions
     * @param array<Region>              $regions
     * @param array<OfferTraffic>        $traffics
     * @param array<AdmitadCategory>     $categories
     * @param int                        $admitadOfferId
     * @param AdmitadOfferCommonData     $commonData
     * @param AdmitadOfferStatisticsData $statisticsData
     */
    public function __construct(
        Currency $currency,
        array $actions,
        array $regions,
        array $traffics,
        array $categories,
        int $admitadOfferId,
        AdmitadOfferCommonData $commonData,
        AdmitadOfferStatisticsData $statisticsData
    ) {
        parent::__construct(
            $currency,
            $actions,
            $regions,
            $traffics
        );

        $this->categories = new ArrayCollection(array_unique($categories, SORT_REGULAR));
        $this->admitadOfferId = $admitadOfferId;
        $this->commonData = $commonData;
        $this->statisticsData = $statisticsData;
    }
}