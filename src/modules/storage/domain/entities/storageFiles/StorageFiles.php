<?php

namespace Src\modules\storage\domain\entities\storageFiles;

use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesActive;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesFileName;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesId;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesIdProvider;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesIdUser;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesMimeType;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesPath;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesSize;

class StorageFiles
{
    private readonly ?StorageFilesId $id;
    private readonly StorageFilesFileName $filename;
    private readonly ?StorageFilesPath $path;
    private readonly StorageFilesIdProvider $id_provider;
    private readonly StorageFilesSize $size;
    private readonly StorageFilesMimeType $mime_type;
    private readonly ?StorageFilesIdUser $id_user;
    private readonly StorageFilesActive $active;

    public function __construct(
        StorageFilesFileName $filename,
        StorageFilesIdProvider $id_provider,
        StorageFilesSize $size,
        StorageFilesMimeType $mime_type,
        StorageFilesActive $active,
        ?StorageFilesPath $path = null,
        ?StorageFilesIdUser $id_user = null,
        ?StorageFilesId $id = null
    ) {
        $this->id = $id;
        $this->filename = $filename;
        $this->path = $path;
        $this->id_provider = $id_provider;
        $this->size = $size;
        $this->mime_type = $mime_type;
        $this->active = $active;
        $this->id_user = $id_user;
    }
    public function getId(): ?StorageFilesId
    {
        return $this->id;
    }

    public function getFilename(): StorageFilesFileName
    {
        return $this->filename;
    }

    public function getPath(): ?StorageFilesPath
    {
        return $this->path;
    }

    public function getIdProvider(): StorageFilesIdProvider
    {
        return $this->id_provider;
    }

    public function getSize(): StorageFilesSize
    {
        return $this->size;
    }

    public function getMimeType(): StorageFilesMimeType
    {
        return $this->mime_type;
    }

    public function getIdUser(): ?StorageFilesIdUser
    {
        return $this->id_user;
    }

    public function getActive(): StorageFilesActive
    {
        return $this->active;
    }
}
