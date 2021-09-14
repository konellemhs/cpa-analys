<?php

namespace App\VO\OfferData\Common;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class AdmitadOfferCommonData extends OfferCommonData
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="offer_link")
     */
    private string $imageLink;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="offer_activation_time")
     */
    private DateTimeImmutable $activationTime;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="offer_last_modified_time")
     */
    private DateTimeImmutable $modifiedTime;

    /**
     * @param string            $name
     * @param string | null     $description
     * @param string            $status
     * @param string            $imageLink
     * @param DateTimeImmutable $activationTime
     * @param DateTimeImmutable $modifiedTime
     */
    public function __construct(
        string $name,
        ?string $description,
        string $status,
        string $imageLink,
        DateTimeImmutable $activationTime,
        DateTimeImmutable $modifiedTime
    ) {
        parent::__construct(name: $name, description: $description, status: $status);

        $this->imageLink = $imageLink;
        $this->activationTime = $activationTime;
        $this->modifiedTime = $modifiedTime;
    }
}
