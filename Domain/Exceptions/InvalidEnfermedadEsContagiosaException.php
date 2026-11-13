<?php

class InvalidEnfermedadEsContagiosaException extends InvalidArgumentException
{
    public static function becauseValueIsNotBoolean($value)
    {
        return new self('The contagious flag (esContagiosa) must be a boolean value, got: ' . gettype($value));
    }

    public static function becauseValueIsNull()
    {
        return new self('The contagious flag (esContagiosa) must not be null.');
    }
}
