<?php

namespace App\Types;

use App\Enum\OfferActionType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

class TypeOfferActionType extends Type
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'offer_action_type';
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
     * @return OfferActionType | null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?OfferActionType
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof OfferActionType) {
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
     * @return OfferActionType | null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?OfferActionType
    {
        return empty($value) ? null : new OfferActionType($value);
    }
}
