<?php
namespace Src\modules\profile\application\useCases\document;

use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentId;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DocumentDelete {
    private readonly DocumentRepositoryInterface $documentRepository;

    public function __construct(DocumentRepositoryInterface $document_repository)
    {   
        $this->documentRepository = $document_repository;
    }

    public function run(int $id) : void {
        
        $document = $this->documentRepository->getOneById(new DocumentId($id));

        if(!$document){
            throw new ApplicationException("Identificador del documento no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->documentRepository->delete($document->getId());
    }
}