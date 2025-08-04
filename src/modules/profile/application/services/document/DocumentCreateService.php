<?php

namespace Src\modules\profile\application\services\document;

use Src\modules\profile\application\dtos\DocumentDto;
use Src\modules\profile\application\useCases\document\DocumentCreate;

class DocumentCreateService
{
    private readonly DocumentCreate $documentCreate;

    public function __construct(DocumentCreate $document_create)
    {
        $this->documentCreate = $document_create;
    }

    public function createDocumentForUser(
        DocumentDto $documentDto
    ) {
        $document = $this->documentCreate->run(
            $documentDto
        );

        return $document;
    }
}
