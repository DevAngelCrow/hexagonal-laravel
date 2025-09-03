<?php
namespace Src\modules\storage\application\useCases\providerStorage;

use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;

class ProviderStorageGetAll {
    private readonly ProviderStorageRepositoryInterface $providerStorageRepository;

    public function __construct(ProviderStorageRepositoryInterface $provider_storage_repository)
    {
        $this->providerStorageRepository = $provider_storage_repository;
    }

    public function run(?int $page, ?int $per_page) : array{
        return $this->providerStorageRepository->getAll($page, $per_page);
    }
}