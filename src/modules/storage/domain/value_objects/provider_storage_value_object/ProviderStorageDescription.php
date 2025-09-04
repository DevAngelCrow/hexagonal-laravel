<?php
namespace Src\modules\storage\domain\value_objects\provider_storage_value_object;

use Src\modules\storage\domain\exceptions\StorageFilesException;
use Src\shared\domain\Validator;

class ProviderStorageDescription {
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;

        $validator = new Validator($this->value, StorageFilesException::class);
        
        $validator->required("El campo description es obligatorio");
    }

    public function value() : string {
        return $this->value;
    }
}