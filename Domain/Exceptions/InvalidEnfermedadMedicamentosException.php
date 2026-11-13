<?php

class InvalidEnfermedadMedicamentosException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The medications list (medicamentos) must not be empty.');
    }

    public static function becauseListIsEmpty()
    {
        return new self('The medications list (medicamentos) must contain at least one medication.');
    }

    public static function becauseMedicamentoIsTooShort($minLength)
    {
        return new self('Each medication in medicamentos must contain at least ' . $minLength . ' characters.');
    }
}
