<?php

namespace Src\modules\profile\application\useCases\documentType;

use Src\modules\profile\application\dtos\DocumentTypeDto;
use Src\modules\profile\domain\entities\documentType\DocumentType;
use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeName;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeDescription;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeActive;



class DocumentTypeCreate {
    private DocumentTypeRepositoryInterface $repository;

    public function __construct(
        DocumentTypeRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function run(
        DocumentTypeDto $documentType
    ): void {
        $documentType = new DocumentType(
            id: new DocumentTypeId($documentType->id),
            name: new DocumentTypeName($documentType->name),
            description: new DocumentTypeDescription($documentType->description),
            active: new DocumentTypeActive($documentType->active)
        );
        $this->repository->create($documentType);
    }
}

