<?php

class InvalidEnfermedadNivelGravedadException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The severity level (nivelGravedad) must not be empty.');
    }

    public static function becauseValueIsInvalid($nivel)
    {
        return new self('The severity level (nivelGravedad) is invalid: ' . $nivel);
    }

    public static function becauseValueIsOutOfRange($min, $max)
    {
        return new self('The severity level (nivelGravedad) must be between ' . $min . ' and ' . $max . '.');
    }
}
