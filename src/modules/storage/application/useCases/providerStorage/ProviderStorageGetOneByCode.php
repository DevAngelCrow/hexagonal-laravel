<?php
namespace Src\modules\storage\application\useCases\providerStorage;

use Src\modules\storage\domain\entities\providerStorage\ProviderStorage;
use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageCode;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageId;

class ProviderStorageGetOneById {
    private readonly ProviderStorageRepositoryInterface $providerStorageRepository;

    public function __construct(ProviderStorageRepositoryInterface $provider_storage_repository)
    {
        $this->providerStorageRepository = $provider_storage_repository;
    }

    public function run(string $code) : ProviderStorage {
        return $this->providerStorageRepository->getOneByCode(new ProviderStorageCode($code));
    }
}