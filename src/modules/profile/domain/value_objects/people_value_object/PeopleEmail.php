<?php
namespace Src\modules\profile\domain\value_objects\people_value_object;
use Src\modules\profile\domain\exceptions\PeopleException;

class PeopleEmail {
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->required();
        $this->validEmail();
    }

    private function required()
    {
        if (!$this->value) {
            throw new PeopleException("El campo bloque es obligatorio");
        }
    }

    private function validEmail(){
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/";
        if(!preg_match($pattern, $this->value)){
            throw new PeopleException("El correo no es válido"); 
        }
    }

    public function value() : string {
        return $this->value;
    }
}