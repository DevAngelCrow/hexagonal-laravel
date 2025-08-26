<?php

namespace Src\modules\catalogs\marital\domain\value_objects;

use Src\modules\catalogs\marital\domain\exceptions\MaritalException;
use Src\shared\domain\Validator;

class MaritalStatusCaption
{
    private string $caption;

    public function __construct(string $caption)
    {
        $this->caption = $caption;

        $validator = new Validator($this->caption, MaritalException::class);

        $validator->required('Marital status caption is required')
            ->minLength(4, 'Marital status caption must be at least 4 characters long')
            ->maxLength(200, 'Marital status caption must be at most 100 characters long');
    }

    public function value(): string
    {
        return $this->caption;
    }
}
