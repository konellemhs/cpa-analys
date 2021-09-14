<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AdmitadCategory extends Category
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="admitad_category_external_id")
     */
    private int $admitadId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="admitad_language")
     */
    private string $language;

    /**
     * @param string               $name
     * @param int                  $admitadId
     * @param string               $language
     */
    public function __construct(
        string $name,
        int $admitadId,
        string $language
    ) {
        parent::__construct($name);

        $this->admitadId = $admitadId;
        $this->language = $language;
    }
}
