<?php
namespace Src\modules\storage\domain\value_objects\provider_storage_value_object;

class ProviderStorageActive {
    private bool $value;
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value() : bool {
        return $this->value;
    }
}   