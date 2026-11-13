<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadRequiereIncapacidadException.php';

class EnfermedadRequiereIncapacidad
{
    private $value;

    public function __construct($value)
    {
        if (is_null($value)) {
            throw InvalidEnfermedadRequiereIncapacidadException::becauseValueIsNull();
        }

        if (!is_bool($value)) {
            throw InvalidEnfermedadRequiereIncapacidadException::becauseValueIsNotBoolean($value);
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

    public function equals(EnfermedadRequiereIncapacidad $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value ? 'true' : 'false';
    }
}
