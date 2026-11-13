<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadMedicamentosException.php';

class EnfermedadMedicamentos
{
    const MIN_MEDICAMENTO_LENGTH = 3;

    private $value;

    public function __construct($value)
    {
        if (empty($value)) {
            throw InvalidEnfermedadMedicamentosException::becauseValueIsEmpty();
        }

        if (!is_array($value)) {
            $value = array($value);
        }

        $normalized = array();
        foreach ($value as $medicamento) {
            $item = trim((string) $medicamento);
            if ($item === '') {
                continue;
            }
            if (mb_strlen($item) < self::MIN_MEDICAMENTO_LENGTH) {
                throw InvalidEnfermedadMedicamentosException::becauseMedicamentoIsTooShort(self::MIN_MEDICAMENTO_LENGTH);
            }
            $normalized[] = $item;
        }

        if (count($normalized) === 0) {
            throw InvalidEnfermedadMedicamentosException::becauseListIsEmpty();
        }

        $this->value = $normalized;
    }

    public function value()
    {
        return $this->value;
    }

    public function count()
    {
        return count($this->value);
    }

    public function contains($medicamento)
    {
        return in_array(trim((string) $medicamento), $this->value, true);
    }

    public function equals(EnfermedadMedicamentos $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return implode(', ', $this->value);
    }
}
