<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadNivelGravedadException.php';
require_once __DIR__ . '/../Enums/EnfermedadNivelGravedadEnum.php';

class EnfermedadNivelGravedad
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidEnfermedadNivelGravedadException::becauseValueIsEmpty();
        }

        EnfermedadNivelGravedadEnum::ensureIsValid($normalizedValue);

        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(EnfermedadNivelGravedad $other)
    {
        return $this->value === $other->value();
    }

    public function isMoreSevereThan(EnfermedadNivelGravedad $other)
    {
        $order = array_flip(EnfermedadNivelGravedadEnum::values());
        return $order[$this->value] > $order[$other->value()];
    }

    public function __toString()
    {
        return $this->value;
    }
}
