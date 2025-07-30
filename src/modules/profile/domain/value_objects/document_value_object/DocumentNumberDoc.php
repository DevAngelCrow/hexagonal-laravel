<?php
namespace Src\modules\profile\domain\value_objects\document_value_object;

use Src\modules\profile\domain\exceptions\DocumentException;
use Src\shared\domain\HttpStatusCode;

class DocumentNumberDoc
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
            throw new DocumentException("El campo número de documento es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    public function value() : string {
        return $this->value;
    }
}
