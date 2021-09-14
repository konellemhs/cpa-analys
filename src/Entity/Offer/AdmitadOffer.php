<?php

namespace App\Entity\Offer;

use App\Entity\Category\AdmitadCategory;
use App\VO\OfferData\Common\AdmitadOfferCommonData;
use App\VO\OfferData\Statistics\AdmitadOfferStatisticsData;
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
     * @var Collection<array<int, string>>
     */
    private Collection $regions;

    /**
     * @var Collection<AdmitadTraffic>
     */
    private Collection $traffics;


}