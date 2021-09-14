<?php

namespace App\Types;

use App\Enum\Currency;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class CurrencyType extends Type
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'currency';
    }

    /**
     * @param array            $column
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($column);
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return Currency | null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?Currency
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Currency) {
            throw new InvalidArgumentException(
                sprintf('Invalid argument for enum %s', $this->getName())
            );
        }

        return $value;
    }

    /**
     * @param string           $value
     * @param AbstractPlatform $platform
     *
     * @return Currency | null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Currency
    {
        return empty($value) ? null : new Currency($value);
    }
}
