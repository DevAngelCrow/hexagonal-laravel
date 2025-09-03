<?php

namespace Src\modules\storage\application\useCases\providerStorage;

use Src\modules\storage\application\dtos\ProviderStorageDto;
use Src\modules\storage\domain\entities\providerStorage\ProviderStorage;
use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageActive;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageCode;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageDescription;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageId;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageName;
use Src\shared\application\exceptions\ApplicationException;

class ProviderStorageUpdate
{
    private readonly ProviderStorageRepositoryInterface $providerStorageRepository;

    public function __construct(ProviderStorageRepositoryInterface $provider_storage_repository)
    {
        $this->providerStorageRepository = $provider_storage_repository;
    }

    public function run(ProviderStorageDto $providerStorageDto): void
    {


        $providerStorageDb = $this->providerStorageRepository->getOneById(new ProviderStorageId($providerStorageDto->id));

        if (!$providerStorageDb) {
            throw new ApplicationException("Identificador de proveedor no encontrado");
        }

        $providerStorageUpdate = new ProviderStorage(
            new ProviderStorageName($providerStorageDto->name),
            new ProviderStorageCode($providerStorageDto->code),
            new ProviderStorageDescription($providerStorageDto->description),
            new ProviderStorageActive($providerStorageDto->active),
            new ProviderStorageId($providerStorageDto->id)
        );

        $this->providerStorageRepository->update($providerStorageUpdate);
    }
}
