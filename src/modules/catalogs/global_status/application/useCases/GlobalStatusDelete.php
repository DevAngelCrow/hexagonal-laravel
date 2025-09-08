<?php
namespace Src\modules\profile\application\useCases\documentType;
use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class GlobalStatusDelete {
    private readonly DocumentTypeRepositoryInterface $documentTypeRepository;

    public function __construct(DocumentTypeRepositoryInterface $documentType_repository)
    {
        $this->documentTypeRepository = $documentType_repository;
    }

    public function run(int $id) : void {
        $documentType = $this->documentTypeRepository->getOneById(new DocumentTypeId($id));

        if(!$documentType){
            throw new ApplicationException("Identificador de dirección no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->documentTypeRepository->delete($documentType->getId());
    }
}
