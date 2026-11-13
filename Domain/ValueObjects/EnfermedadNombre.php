<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadNombreException.php';

class EnfermedadNombre
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 150;

    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidEnfermedadNombreException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < self::MIN_LENGTH) {
            throw InvalidEnfermedadNombreException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidEnfermedadNombreException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(EnfermedadNombre $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
