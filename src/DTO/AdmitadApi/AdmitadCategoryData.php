<?php

namespace App\DTO\AdmitadApi;

class AdmitadCategoryData
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $id;

    /**
     * @var AdmitadCategoryData | null
     */
    private ?AdmitadCategoryData $parentCategory;

    /**
     * @var string
     */
    private string $language;

    /**
     * @param string                     $name
     * @param int                        $id
     * @param AdmitadCategoryData | null $parentCategory
     * @param string                     $language
     */
    public function __construct(
        string $name,
        int $id,
        ?AdmitadCategoryData $parentCategory,
        string $language
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->parentCategory = $parentCategory;
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return AdmitadCategoryData | null
     */
    public function getParentCategory(): ?AdmitadCategoryData
    {
        return $this->parentCategory;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Combine object from data
     *
     * @param array $data
     *
     * @return AdmitadCategoryData
     */
    public static function fromArray(array $data): self
    {
        $parentCategoryData = $data['parent'] ?? null;

        return new self(
            name: $data['name'],
            id: $data['id'],
            parentCategory: is_null($parentCategoryData) ? null : self::fromArray($parentCategoryData),
            language: $data['language']
        );
    }
}