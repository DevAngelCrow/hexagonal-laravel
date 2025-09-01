<?php
namespace Src\modules\storage\application\dtos;

use Src\modules\storage\domain\entities\providerStorage\ProviderStorage;

class ProviderStorageDto {
    public function __construct(
        public readonly string $name, 
        public readonly string $description, 
        public readonly bool $active, 
        public readonly ?int $id = null
    )
    {
        
    }

    public static function fromEntity(ProviderStorage $providerStorage) : self {
        return new self(
            $providerStorage->getName()->value(),
            $providerStorage->getDescription()->value(),
            $providerStorage->getActive()->value(),
            $providerStorage->getId()->value()
        );
    }
}