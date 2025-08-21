<?php

namespace Src\modules\catalogs\marital\domain\value_objects;

use Src\modules\catalogs\marital\domain\exceptions\MaritalException;
use Src\shared\domain\Validator;

class MaritalStatusName
{

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;

        $validator = new Validator($this->name, MaritalException::class);

        $validator->required('Marital status name is required')
            ->minLength(2, 'Marital status name must be at least 2 characters long')
            ->maxLength(100, 'Marital status name must be at most 100 characters long');
    }

    public function value(): string
    {
        return $this->name;
    }
}
