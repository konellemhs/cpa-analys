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
     * @ORM\ManyToOne(targetEntity="App\Entity\Action\OfferAction", inversedBy="action")
     */
    private Collection $offers;

    /**
     * @param string $id
     * @param string $name
     * @param array  $offers
     */
    public function __construct(
        string $id,
        string $name,
        array $offers = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->offers = new ArrayCollection(array_unique($offers, SORT_REGULAR));
    }
}