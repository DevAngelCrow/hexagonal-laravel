<?php
namespace Src\modules\storage\domain\value_objects\provider_storage_value_object;

use Src\modules\storage\domain\exceptions\StorageFilesException;
use Src\shared\domain\Validator;

class ProviderStorageId {
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;

        $validator = new Validator($this->value, StorageFilesException::class);
        
        $validator->required("Id de provider storage es requerido")
        ->number("Id de provider storage debe ser de tipo entero");
    }

    public function value() : int {
        return $this->value;
    }
}