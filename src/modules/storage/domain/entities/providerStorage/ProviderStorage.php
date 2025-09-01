<?php

namespace Src\modules\storage\domain\entities\providerStorage;

use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageActive;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageDescription;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageId;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageName;

class ProviderStorage
{
    private readonly ?ProviderStorageId $id;
    private readonly ProviderStorageName $name;
    private readonly ProviderStorageDescription $description;
    private readonly ProviderStorageActive $active;

    public function __construct(
        ProviderStorageName $name,
        ProviderStorageDescription $description,
        ProviderStorageActive $active,
        ?ProviderStorageId $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
        $this->id = $id;
    }
    public function getId(): ?ProviderStorageId
    {
        return $this->id;
    }

    public function getName(): ProviderStorageName
    {
        return $this->name;
    }

    public function getDescription(): ProviderStorageDescription
    {
        return $this->description;
    }

    public function getActive(): ProviderStorageActive
    {
        return $this->active;
    }
}
