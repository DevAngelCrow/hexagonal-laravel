<?php

namespace Src\modules\profile\infrastructure\dtos\documentTypeDtoHttpResponse;

use Src\modules\profile\domain\entities\documentType\DocumentType;

class DocumentTypeDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly bool $active,
    ) {}

    public static function fromEntity(DocumentType $documentType){
        //dd($address);
        return new self(
            $documentType->getId()->value(),
            $documentType->getName()->value(),
            $documentType->getDescription()->value(),
            $documentType->getActive()->value(),
        );
    }
}
