<?php

namespace App\VO\OfferData\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
abstract class OfferCommonData
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="offer_name")
     */
    private string $name;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", name="offer_description")
     */
    private ?string $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="offer_status")
     */
    private string $status;

    /**
     * @param string        $name
     * @param string | null $description
     * @param string        $status
     */
    public function __construct(string $name, ?string $description, string $status)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
