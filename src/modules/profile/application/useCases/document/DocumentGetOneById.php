<?php

namespace Src\modules\profile\application\useCases\document;

use Src\modules\profile\domain\entities\documents\Document;
use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentId;

class DocumentGetOneById
{
    private readonly DocumentRepositoryInterface $documentRepository;

    public function __construct(DocumentRepositoryInterface $document_repository)
    {
        $this->documentRepository = $document_repository;
    }

    public function run(int $id): Document
    {
        return $this->documentRepository->getOneById(new DocumentId($id));
    }
}
