<?php
namespace Src\modules\security\domain\value_objects\user_role_value_object;

use DomainException;

class UserRoleIdRol
{
    /**
     * @var int[]
     */
    private array $values;

    /**
     * @param int[] $values
     */
    public function __construct(array $values)
    {
        $this->validateArray($values);
        $this->values = $values;
    }

    private function validateArray(array $values): void
    {
        if (empty($values)) {
            throw new DomainException("El arreglo de ids de rol no puede estar vacío");
        }
        foreach ($values as $value) {
            if (!is_int($value) || $value <= 0) {
                throw new DomainException("Cada id de rol debe ser un entero positivo");
            }
        }
    }

    /**
     * @return int[]
     */
    public function values(): array
    {
        return $this->values;
    }
}