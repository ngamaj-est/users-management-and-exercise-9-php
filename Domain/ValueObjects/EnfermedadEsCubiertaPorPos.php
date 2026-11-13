<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadEsCubiertaPorPosException.php';

class EnfermedadEsCubiertaPorPos
{
    private $value;

    public function __construct($value)
    {
        if (is_null($value)) {
            throw InvalidEnfermedadEsCubiertaPorPosException::becauseValueIsNull();
        }

        if (!is_bool($value)) {
            throw InvalidEnfermedadEsCubiertaPorPosException::becauseValueIsNotBoolean($value);
        }

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function isTrue()
    {
        return $this->value === true;
    }

    public function equals(EnfermedadEsCubiertaPorPos $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value ? 'true' : 'false';
    }
}
