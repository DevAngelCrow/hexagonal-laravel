<?php

namespace Src\modules\storage\application\useCases\storageFiles;

use Src\modules\storage\application\dtos\StorageFilesDto;
use Src\modules\storage\domain\entities\storageFiles\StorageFiles;
use Src\modules\storage\domain\enums\StorageEnums;
use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\repositories\storageFiles\StorageFilesRepositoryInterface;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageCode;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFileContentFile;

class StorageFilesUpload
{
    private readonly StorageFilesRepositoryInterface $storageFilesRepository;


    public function __construct(StorageFilesRepositoryInterface $storage_files_repository, ProviderStorageRepositoryInterface $provider_storage_repository)
    {
        $this->storageFilesRepository = $storage_files_repository;
    }

    public function run(StorageFilesDto $storageFilesDto, int $idProviderStorage): StorageFiles
    {
        $storageFileUpload = new StorageFileContentFile($storageFilesDto->content_file);
        return $this->storageFilesRepository->upload($storageFileUpload, $idProviderStorage);
    }
}
