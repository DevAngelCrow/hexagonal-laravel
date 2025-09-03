<?php
namespace Src\modules\storage\domain\value_objects\storage_files_value_object;

use Src\modules\storage\domain\exceptions\StorageFilesException;
use Src\shared\domain\Validator;

class StorageFilesMimeType {
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;

        $validator = new Validator($this->value, StorageFilesException::class);
        
        $validator->required("El campo mimetype es obligatorio");
    }

    public function value() : string {
        return $this->value;
    }
}