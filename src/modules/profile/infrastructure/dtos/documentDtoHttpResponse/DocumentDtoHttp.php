<?php

namespace Src\modules\profile\infrastructure\dtos\documentDtoHttpResponse;

use Src\modules\profile\domain\entities\documents\Document;

class DocumentDtoHttp
{

    public function __construct(
        public readonly int $id,
        public readonly int $id_type_document,
        public readonly int $id_people,
        public readonly string $description,
        public readonly string $document_number,
        public readonly bool $state
    ) {}

    public static function fromEntity(Document $document){
        return new self(
            $document->getId()->value(),
            $document->getIdTypeDocument()->value(),
            $document->getIdPeople()->value(),
            $document->getDescription()->value(),
            $document->getNumberDocument()->value(),
            $document->getState()->value()
        );
    }
}
