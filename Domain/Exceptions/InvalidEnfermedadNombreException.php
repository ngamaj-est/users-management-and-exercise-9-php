<?php

class InvalidEnfermedadNombreException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The disease name (nombre) must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The disease name (nombre) must contain at least ' . $minLength . ' characters.');
    }

    public static function becauseLengthIsTooLong($maxLength)
    {
        return new self('The disease name (nombre) must not exceed ' . $maxLength . ' characters.');
    }
}
