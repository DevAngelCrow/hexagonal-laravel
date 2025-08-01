<?php

namespace Src\modules\profile\application\services\document;

use Src\modules\profile\application\useCases\document\DocumentCreate;

class DocumentCreateService
{
    private readonly DocumentCreate $documentCreate;

    public function __construct(DocumentCreate $document_create)
    {
        $this->documentCreate = $document_create;
    }

    public function createDocumentForUser(
        int $id_type_document,
        int $id_people,
        string $description,
        string $document_number, 
        bool $state
    ) {
        $document = $this->documentCreate->run(
            $id_type_document,
            $id_people,
            $description,
            $document_number,
            $state
        );

        return $document;
    }
}
