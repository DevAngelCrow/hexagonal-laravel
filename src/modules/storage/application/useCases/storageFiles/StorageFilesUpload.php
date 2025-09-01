<?php

namespace Src\modules\storage\application\useCases\storageFiles;

use Src\modules\storage\application\dtos\StorageFilesDto;
use Src\modules\storage\domain\entities\storageFiles\StorageFiles;
use Src\modules\storage\domain\repositories\storageFiles\StorageFilesRepositoryInterface;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesActive;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesFileName;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesId;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesIdProvider;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesIdUser;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesMimeType;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesPath;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesSize;

class StorageFilesUpload
{
    private readonly StorageFilesRepositoryInterface $storageFilesRepository;

    public function __construct(StorageFilesRepositoryInterface $storage_files_repository)
    {
        $this->storageFilesRepository = $storage_files_repository;
    }

    public function run(StorageFilesDto $storageFilesDto): StorageFilesPath
    {
        $storageFileUpload = new StorageFiles(
            new StorageFilesFileName($storageFilesDto->filename),
            new StorageFilesIdProvider($storageFilesDto->id_provider),
            new StorageFilesSize($storageFilesDto->size),
            new StorageFilesMimeType($storageFilesDto->mime_type),
            new StorageFilesActive($storageFilesDto->active),
            new StorageFilesPath($storageFilesDto->path),
            new StorageFilesIdUser($storageFilesDto->id_user)
        );

        return $this->storageFilesRepository->upload($storageFileUpload);
    }
}
