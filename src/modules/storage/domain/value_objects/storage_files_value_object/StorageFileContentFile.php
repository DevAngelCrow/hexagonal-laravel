<?php
namespace Src\modules\storage\domain\value_objects\storage_files_value_object;

use Src\modules\storage\domain\exceptions\StorageFilesException;
use Src\shared\domain\Validator;

class StorageFileContentFile {
    private mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;

        // $validator = new Validator($this->value, StorageFilesException::class);

        // $validator->required('Archivo multimedia es requerido');
    }

    public function value():mixed{
        return $this->value;
    }
}