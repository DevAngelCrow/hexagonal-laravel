<?php

namespace Src\modules\storage\infrastructure\dtos\storageFilesDtoHttpResponse;

use Src\modules\storage\domain\entities\storageFiles\StorageFiles;

class StorageFilesDtoHttp
{
    public function __construct(
        public readonly string $filename,
        public readonly int $id_provider,
        public readonly int $size,
        public readonly string $mime_type,
        public readonly bool $active,
        public readonly ?string $path = null,
        public readonly ?int $id_user = null,
        public readonly ?int $id = null
    ) {}

    public static function fromEntity(StorageFiles $storageFiles): self
    {
        return new self(
            $storageFiles->getFilename()->value(),
            $storageFiles->getPath()->value(),
            $storageFiles->getIdProvider()->value(),
            $storageFiles->getSize()->value(),
            $storageFiles->getMimeType()->value(),
            $storageFiles->getActive()->value(),
            $storageFiles->getIdUser()->value(),
            $storageFiles->getId()->value()
        );
    }
}
