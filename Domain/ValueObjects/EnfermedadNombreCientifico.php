<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadNombreCientificoException.php';

class EnfermedadNombreCientifico
{
    const MAX_LENGTH = 200;

    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidEnfermedadNombreCientificoException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidEnfermedadNombreCientificoException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        // Scientific names follow the binomial nomenclature: "Genus species" (capitalized genus, lowercase species)
        if (!preg_match('/^[A-ZÁÉÍÓÚÑÜ][a-záéíóúñü]+(\s[a-záéíóúñü]+)+$/', $normalizedValue)) {
            throw InvalidEnfermedadNombreCientificoException::becauseFormatIsInvalid($normalizedValue);
        }

        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(EnfermedadNombreCientifico $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
