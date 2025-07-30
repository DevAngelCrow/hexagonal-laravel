<?php
namespace Src\modules\profile\domain\value_objects\country_value_object;

use Src\modules\profile\domain\exceptions\CountryException;
use Src\shared\domain\HttpStatusCode;

class CountryState
{
    private bool $value;
    
    public function __construct(bool $value)
    {
        $this->value = $value;
        //$this->required();
    }

    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new CountryException("El campo abreviación es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
    //     }
    // }

    public function value() : string {
        return $this->value;
    }
}
