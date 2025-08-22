<?php

namespace Src\modules\profile\application\services\documentType;

use Src\modules\profile\application\dtos\DocumentTypeDto;
use Src\modules\profile\application\useCases\documentType\DocumentTypeCreate;

class DocumentTypeCreateService
{
    private readonly DocumentTypeCreate $documentTypeCreate;

    public function __construct(DocumentTypeCreate $documentType_create)
    {
        $this->documentTypeCreate = $documentType_create;
    }

    public function createDocumentTypeForUser(
        DocumentTypeDto $documentTypeDto
    ) {

        $documentType = $this->documentTypeCreate->run(
            $documentTypeDto
        );

        return $documentType;
    }
}
