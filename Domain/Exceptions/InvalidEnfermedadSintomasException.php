<?php

class InvalidEnfermedadSintomasException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The symptoms list (sintomas) must not be empty.');
    }

    public static function becauseListIsEmpty()
    {
        return new self('The symptoms list (sintomas) must contain at least one symptom.');
    }

    public static function becauseSintomaIsTooShort($minLength)
    {
        return new self('Each symptom in sintomas must contain at least ' . $minLength . ' characters.');
    }
}
