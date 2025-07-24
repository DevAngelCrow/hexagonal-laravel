<?php
namespace Src\modules\profile\domain\value_objects\people_value_object;
use Src\modules\profile\domain\exceptions\PeopleException;

class PeopleImgPath{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->required();
    }

    
    private function required()
    {
        if (!$this->value) {
            throw new PeopleException("El campo img_path es obligatorio");
        }
    }
}