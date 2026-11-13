<?php

class EnfermedadAlreadyExistsException extends DomainException
{
    public static function becauseNombreAlreadyExists($nombre)
    {
        return new self('A disease with name "' . $nombre . '" already exists.');
    }

    public static function becauseNombreCientificoAlreadyExists($nombreCientifico)
    {
        return new self('A disease with scientific name "' . $nombreCientifico . '" already exists.');
    }
}
