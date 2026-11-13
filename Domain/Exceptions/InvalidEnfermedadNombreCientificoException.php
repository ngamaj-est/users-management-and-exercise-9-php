<?php

class InvalidEnfermedadNombreCientificoException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The scientific name (nombreCientifico) must not be empty.');
    }

    public static function becauseLengthIsTooLong($maxLength)
    {
        return new self('The scientific name (nombreCientifico) must not exceed ' . $maxLength . ' characters.');
    }

    public static function becauseFormatIsInvalid($nombre)
    {
        return new self('The scientific name format is invalid: ' . $nombre);
    }
}
