<?php

namespace App\DTO\AdmitadApi;

use App\Enum\Currency;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var Collection<ActionData>
     */
    private Collection $actions;

    /**
     * @var Collection<array<int, string>>
     */
    private Collection $regions;

    /**
     * @var Collection<AdmitadCategoryData>
     */
    private Collection $categories;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var string
     */
    private string $imageLink;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $activationTime;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $modifiedTime;

    /**
     * @var Collection<AdmitadTraffic>
     */
    private Collection $traffics;

    /**
     * @var int | null
     */
    private ?int $averageHoldTime;

    /**
     * @var int | null
     */
    private ?int $averageMoneyTransferTime;

    /**
     * @param int                        $id
     * @param string                     $name
     * @param string | null              $description
     * @param Currency                   $currency
     * @param float                      $rating
     * @param float                      $ecps
     * @param float                      $epc
     * @param float                      $cr
     * @param array<ActionData>          $actions
     * @param array<string>              $regions
     * @param array<AdmitadCategoryData> $categories
     * @param string                     $status
     * @param string                     $imageLink
     * @param DateTimeImmutable          $activationTime
     * @param DateTimeImmutable          $modifiedTime
     * @param array<AdmitadTraffic>      $traffics
     * @param int | null                 $averageHoldTime
     * @param int | null                 $averageMoneyTransferTime
     */
    public function __construct(
        int $id,
        string $name,
        ?string $description,
        Currency $currency,
        float $rating,
        float $ecps,
        float $epc,
        float $cr,
        array $actions,
        array $regions,
        array $categories,
        string $status,
        string $imageLink,
        DateTimeImmutable $activationTime,
        DateTimeImmutable $modifiedTime,
        array $traffics,
        ?int $averageHoldTime,
        ?int $averageMoneyTransferTime
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->currency = $currency;
        $this->rating = $rating;
        $this->ecps = $ecps;
        $this->epc = $epc;
        $this->cr = $cr;
        $this->actions = new ArrayCollection(array_unique($actions, SORT_REGULAR));
        $this->regions = new ArrayCollection(array_unique($regions, SORT_REGULAR));
        $this->categories = new ArrayCollection(array_unique($categories, SORT_REGULAR));
        $this->status = $status;
        $this->imageLink = $imageLink;
        $this->activationTime = $activationTime;
        $this->modifiedTime = $modifiedTime;
        $this->traffics = new ArrayCollection(array_unique($traffics, SORT_REGULAR));
        $this->averageHoldTime = $averageHoldTime;
        $this->averageMoneyTransferTime = $averageMoneyTransferTime;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @return float
     */
    public function getEcps(): float
    {
        return $this->ecps;
    }

    /**
     * @return float
     */
    public function getEpc(): float
    {
        return $this->epc;
    }

    /**
     * @return float
     */
    public function getCr(): float
    {
        return $this->cr;
    }

    /**
     * @return Collection<ActionData>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    /**
     * @return Collection<string>
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    /**
     * @return Collection<AdmitadCategoryData>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Combine object from data
     *
     * @param array $data
     *
     * @return AdmitadOfferData
     *
     * @throws \Exception
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'],
            currency: new Currency($data['currency']),
            rating: $data['rating'],
            ecps: $data['ecpc'],
            epc: $data['epc'],
            cr: $data['cr'],
            actions: array_map(
                static fn(array $actionData): ActionData => ActionData::fromArray($actionData),
                $data['actions']
            ),
            regions: array_map(
                static fn(array $regionsData): string => $regionsData['region'],
                $data['regions']
            ),
            categories: array_map(
                static fn(array $categoryData): AdmitadCategoryData => AdmitadCategoryData::fromArray($categoryData),
                $data['categories']
            ),
            status: $data['status'],
            imageLink: $data['image'],
            activationTime: new DateTimeImmutable($data['activation_date']),
            modifiedTime: new DateTimeImmutable($data['modified_date']),
            traffics: array_map(
                static fn(array $trafficData): AdmitadTraffic => AdmitadTraffic::fromArray($trafficData),
                $data['traffics']
            ),
            averageHoldTime: $data['avg_hold_time'],
            averageMoneyTransferTime: $data['avg_money_transfer_time'],
        );
    }
}
