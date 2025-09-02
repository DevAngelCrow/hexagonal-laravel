<?php
namespace Src\modules\storage\application\dtos;

use Src\modules\storage\domain\entities\storageFiles\StorageFiles;

class StorageFilesDto {
    public function __construct(
        public readonly mixed $content_file,
        public readonly ?string $filename = null,
        public readonly ?int $id_provider = null,
        public readonly ?int $size = null,
        public readonly ?string $mime_type = null,
        public readonly ?bool $active = null,
        public readonly ?string $path = null,
        public readonly ?int $id_user = null,
        public readonly ?int $id = null
    )
    {
        
    }

    public static function fromEntity(StorageFiles $storageFiles) : self {
        return new self(
            $storageFiles->getContentFile()->value(),
            $storageFiles->getFilename()->value(),
            $storageFiles->getIdProvider()->value(),
            $storageFiles->getSize()->value(),
            $storageFiles->getMimeType()->value(),
            $storageFiles->getPath()->value(),
            $storageFiles->getActive()->value(),
            $storageFiles->getIdUser()->value(),
            $storageFiles->getId()->value()
        );
    }
}