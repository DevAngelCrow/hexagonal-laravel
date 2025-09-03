<?php
namespace Src\modules\storage\application\services\storageFiles;

use Src\modules\storage\application\dtos\StorageFilesDto;
use Src\modules\storage\application\useCases\storageFiles\StorageFilesCreate;
use Src\modules\storage\domain\entities\storageFiles\StorageFiles;

class StorageFilesUploadService {
    private readonly StorageFilesCreate $storageFilesCreate;

    public function __construct(StorageFilesCreate $storage_files_create)
    {
        $this->storageFilesCreate = $storage_files_create;
    }

    public function createImgForUser(StorageFilesDto $storageFilesDto, string $providerStorageCode) : StorageFiles {
        return $this->storageFilesCreate->run($storageFilesDto, $providerStorageCode);
    }
}