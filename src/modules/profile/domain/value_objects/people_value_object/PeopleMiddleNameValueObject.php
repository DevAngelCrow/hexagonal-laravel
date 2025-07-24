<?php
namespace Src\modules\profile\domain\value_objects\people_value_object;
use Src\modules\profile\domain\exceptions\PeopleException;

class PeopleMiddleName{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
        //$this->required();
    }

    
    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new PeopleException("El campo last_name es obligatorio");
    //     }
    // }
}