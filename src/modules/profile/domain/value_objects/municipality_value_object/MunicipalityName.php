<?php
namespace Src\modules\profile\domain\value_objects\municipality_value_object;

use Src\modules\profile\domain\exceptions\MunicipalityException;
use Src\shared\domain\HttpStatusCode;

class MunicipalityName
{
    private string $value;
    
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->required();
    }

    private function required()
    {
        if (!$this->value) {
            throw new MunicipalityException("El campo nombre es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    public function value() : string {
        return $this->value;
    }
}
