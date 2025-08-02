<?php
namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\documents\Document;

class DocumentDto
{

    public function __construct(
        
        public readonly int $id_type_document,
        public readonly int $id_people,
        public readonly string $description,
        public readonly string $document_number,
        public readonly bool $state,
        public readonly ?int $id = null
    ) {}

    public static function fromEntity(Document $document){
        return new self(
            
            $document->getIdTypeDocument()->value(),
            $document->getIdPeople()->value(),
            $document->getDescription()->value(),
            $document->getNumberDocument()->value(),
            $document->getState()->value(),
            $document->getId()->value() ?: null,
        );
    }
}
