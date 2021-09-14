<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="region")
 */
class Region
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
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
