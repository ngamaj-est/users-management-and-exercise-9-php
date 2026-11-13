<?php

class InvalidEnfermedadRequiereIncapacidadException extends InvalidArgumentException
{
    public static function becauseValueIsNotBoolean($value)
    {
        return new self('The disability requirement flag (requiereIncapacidad) must be a boolean value, got: ' . gettype($value));
    }

    public static function becauseValueIsNull()
    {
        return new self('The disability requirement flag (requiereIncapacidad) must not be null.');
    }
}
