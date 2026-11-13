<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadEsContagiosaException.php';

class EnfermedadEsContagiosa
{
    private $value;

    public function __construct($value)
    {
        if (is_null($value)) {
            throw InvalidEnfermedadEsContagiosaException::becauseValueIsNull();
        }

        if (!is_bool($value)) {
            throw InvalidEnfermedadEsContagiosaException::becauseValueIsNotBoolean($value);
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

    public function equals(EnfermedadEsContagiosa $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value ? 'true' : 'false';
    }
}
