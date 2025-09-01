<?php
namespace Src\modules\storage\domain\value_objects\storage_files_value_object;

class StorageFilesActive {
    private bool $value;
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value() : bool {
        return $this->value;
    }
}