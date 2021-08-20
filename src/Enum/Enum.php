<?php

namespace App\Enum;

abstract class Enum
{
    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!in_array($value, $this->getValidValues(), true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid object value %s: %s',
                    static::class,
                    $value
                )
            );
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValueEqualTo(string $value): bool
    {
        return $this->value === $value;
    }

    /**
     * Return valid values in array
     *
     * @return array
     */
    abstract protected function getValidValues(): array;
}
