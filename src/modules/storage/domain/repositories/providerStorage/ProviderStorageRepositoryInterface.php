<?php
namespace Src\modules\storage\domain\repositories\providerStorage;

use Src\modules\storage\domain\entities\providerStorage\ProviderStorage;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageCode;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageId;

interface ProviderStorageRepositoryInterface {
    public function create(ProviderStorage $providerStorage) : void;
    public function update(ProviderStorage $providerStorage) : void;
    /**
     * @return providerStorage[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(ProviderStorageId $id): ?ProviderStorage;
    public function delete(ProviderStorageId $id) : void;
    public function getOneByCode(ProviderStorageCode $code) : ?ProviderStorage;
}