<?php

namespace App\DTO\AdmitadApi;

use JetBrains\PhpStorm\Pure;

class AdmitadTraffic
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
     * @var bool
     */
    private bool $enabled;

    /**
     * @param int    $id
     * @param string $name
     * @param bool   $enabled
     */
    public function __construct(int $id, string $name, bool $enabled)
    {
        $this->id = $id;
        $this->name = $name;
        $this->enabled = $enabled;
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
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Combine object from data
     *
     * @param array $data
     *
     * @return AdmitadTraffic
     */
    #[Pure] public static function fromArray(array $data): self
    {
        return new self(id: $data['id'], name: $data['name'], enabled: $data['enabled']);
    }
}
