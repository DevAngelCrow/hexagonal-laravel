<?php

namespace Src\modules\catalogs\marital\domain\value_objects;

use Src\modules\catalogs\marital\domain\exceptions\MaritalException;
use Src\shared\domain\Validator;

class MaritalStatusId
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        $validator = new Validator($this->id, MaritalException::class);

        $validator->required('Marital status ID is required')
            ->positiveInteger('Marital status ID must be a positive integer');
    }

    public function value(): int
    {
        return $this->id;
    }
}
