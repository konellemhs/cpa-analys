<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "category" = "App\Entity\Category\Category",
 *     "admitad_category" = "App\Entity\Category\AdmitadCategory"
 * })
 */
abstract class Category
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
     * @ORM\Column(type="string", name="category_name")
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
