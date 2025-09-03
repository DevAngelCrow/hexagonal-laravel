<?php
namespace Src\modules\storage\application\useCases\storageFiles;

use Src\modules\storage\application\dtos\StorageFilesDto;
use Src\modules\storage\domain\entities\storageFiles\StorageFiles;
use Src\modules\storage\domain\enums\StorageEnums;
use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\repositories\storageFiles\StorageFilesRepositoryInterface;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageCode;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFileContentFile;


class StorageFilesCreate {
    private readonly StorageFilesRepositoryInterface $storageFilesRepository;
    private readonly ProviderStorageRepositoryInterface $providerStorageRepository;

    public function __construct(StorageFilesRepositoryInterface $storage_files_repository, ProviderStorageRepositoryInterface $provider_storage_repository)
    {
        $this->storageFilesRepository = $storage_files_repository;
        $this->providerStorageRepository = $provider_storage_repository;
    }

    public function run(StorageFilesDto $storageFilesDto, string $providerStorageCode) : StorageFiles {

        if(!$providerStorageCode){
            $providerStorageCode = StorageEnums::LOCAL->value;
        }

        $providerStorage = $this->providerStorageRepository->getOneByCode(new ProviderStorageCode($providerStorageCode));

        $storageFileCreate = $this->storageFilesRepository->upload(new StorageFileContentFile($storageFilesDto->content_file), $providerStorage->getId()->value());

        return $this->storageFilesRepository->create($storageFileCreate);
    }
}