<?php
namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\documentType\DocumentType;

class DocumentTypeDto {

    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly bool $active,
        public readonly ?string $mask,
        public readonly ?int $id = null){
    }

    public static function fromEntity(DocumentType $documentType): self {
        return new self(
            $documentType->getName()->value(),
            $documentType->getDescription()->value(),
            $documentType->getActive()->value(),
            $documentType->getMask()->value(),
            $documentType->getId()->value() ?: null
        );
    }
}
