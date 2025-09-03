<?php
namespace Src\modules\storage\domain\value_objects\storage_files_value_object;

use Src\modules\storage\domain\exceptions\StorageFilesException;
use Src\shared\domain\Validator;

class StorageFilesIdUser {
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;

        $validator = new Validator($this->value, StorageFilesException::class);
        
        $validator->number("Id de storage files provider debe ser de tipo entero");
    }

    public function value() : int {
        return $this->value;
    }
}