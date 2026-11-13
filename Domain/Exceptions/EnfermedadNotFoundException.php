<?php

class EnfermedadNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id)
    {
        return new self('The disease with id ' . $id . ' was not found.');
    }

    public static function becauseNombreWasNotFound($nombre)
    {
        return new self('The disease with name "' . $nombre . '" was not found.');
    }
}
