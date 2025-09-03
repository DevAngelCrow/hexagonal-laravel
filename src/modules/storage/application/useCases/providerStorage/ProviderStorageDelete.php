<?php
namespace Src\modules\storage\application\useCases\providerStorage;

use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageId;
use Src\shared\application\exceptions\ApplicationException;

class ProviderStorageDelete {
    private readonly ProviderStorageRepositoryInterface $providerStorageRepository;

    public function __construct(ProviderStorageRepositoryInterface $provider_storage_repository)
    {
        $this->providerStorageRepository = $provider_storage_repository;
    }

    public function run(int $id) : void {
        $idProviderStorage = new ProviderStorageId($id);
        $providerStorageDb = $this->providerStorageRepository->getOneById($idProviderStorage);

        if (!$providerStorageDb) {
            throw new ApplicationException("Identificador de proveedor no encontrado");
        }

        $this->providerStorageRepository->delete($idProviderStorage);
    }
}