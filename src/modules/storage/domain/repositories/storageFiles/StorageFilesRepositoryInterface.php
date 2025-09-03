<?php
namespace Src\modules\storage\domain\repositories\storageFiles;

use Src\modules\storage\domain\entities\storageFiles\StorageFiles;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFileContentFile;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesId;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesPath;

interface StorageFilesRepositoryInterface {
    public function upload(StorageFileContentFile $storageFilesContent, int $providerStoreCode) : StorageFiles;
    public function create(StorageFiles $storageFiles) : StorageFiles;
    public function download(StorageFilesId $id) : StorageFiles;
    public function getDataStorageFile(StorageFilesId $id) : StorageFiles;
    public function delete(StorageFilesId $id) : void;
}