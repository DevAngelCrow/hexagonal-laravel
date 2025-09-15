<?php
namespace Src\modules\profile\application\useCases\documentType;

use Src\modules\profile\application\dtos\DocumentTypeDto;
use Src\modules\profile\domain\entities\documentType\DocumentType;
use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeName;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeDescription;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeActive;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeMask;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DocumentTypeUpdate {
    private readonly DocumentTypeRepositoryInterface $documentTypeRepository;

    public function __construct(DocumentTypeRepositoryInterface $documentType_repository)
    {
        $this->documentTypeRepository = $documentType_repository;
    }

    public function run(DocumentTypeDto $documentType) : void {

        $idDocumentType = new DocumentTypeId($documentType->id);

        $documentTypeDb =  $this->documentTypeRepository->getOneById($idDocumentType);

        if(!$documentTypeDb){
            throw new ApplicationException("Identificador de dirección no encontrado", HttpStatusCode::HTTP_NOT_FOUND->value);
        }

        $documentTypeUpdate = new DocumentType(
            name: new DocumentTypeName($documentType->name),
            description: new DocumentTypeDescription($documentType->description),
            active: new DocumentTypeActive($documentType->active),
            mask: new DocumentTypeMask($documentType->mask),
            id: new DocumentTypeId($documentType->id)
        );

        $this->documentTypeRepository->update($documentTypeUpdate);

    }
}
