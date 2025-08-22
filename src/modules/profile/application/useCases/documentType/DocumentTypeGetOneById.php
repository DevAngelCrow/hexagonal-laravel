<?php
namespace Src\modules\profile\application\useCases\documentType;

use Src\modules\profile\domain\entities\documentType\DocumentType;
use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;

class DocumentTypeGetOneById {
    private readonly DocumentTypeRepositoryInterface $documentTypeRepository;

    public function __construct(DocumentTypeRepositoryInterface $documentType_repository)
    {
        $this->documentTypeRepository = $documentType_repository;
    }

    public function run (int $id) : DocumentType {

        return $this->documentTypeRepository->getOneById(new DocumentTypeId($id));

    }
}
