<?php

namespace App\Entity\Action;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="action")
 */
class Action
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
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private string $name;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Action\OfferAction", mappedBy="action")
     */
    private Collection $offers;

    /**
     * @param string $name
     * @param array  $offers
     */
    public function __construct(
        string $name,
        array $offers = []
    ) {
        $this->name = $name;
        $this->offers = new ArrayCollection(array_unique($offers, SORT_REGULAR));
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @return Collection<OfferAction>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    /**
     * @param OfferAction $offerAction
     *
     * @return Action
     */
    public function addOffer(OfferAction $offerAction): self
    {
        if (!$this->offers->contains($offerAction)) {
            $this->offers->add($offerAction);
        }

        return $this;
    }
}
