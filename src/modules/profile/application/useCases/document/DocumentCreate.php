<?php
namespace Src\modules\profile\application\useCases\document;

use Src\modules\profile\domain\entities\documents\Document;
use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentIdPeople;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentIdTypeDocument;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentDescription;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentNumberDoc;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentState;

class DocumentCreate {
    private readonly DocumentRepositoryInterface $documentRepository;

    public function __construct(DocumentRepositoryInterface $document_repository)
    {
        $this->documentRepository = $document_repository;
    }

    public function run(int $id_type_document, int $id_people, string $description, string $document_number, bool $state) : void {

        $document = new Document(
            new DocumentNumberDoc($document_number),
            new DocumentDescription($description),
            new DocumentIdPeople($id_people),
            new DocumentIdTypeDocument($id_type_document),
            new DocumentState($state)
        );

        $this->documentRepository->create($document);
    }
}