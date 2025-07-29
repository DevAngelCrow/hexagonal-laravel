<?php
namespace Src\modules\profile\application\useCases\document;

use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;

class DocumentGetAll {
    private readonly DocumentRepositoryInterface $documentRepository;

    public function __construct(DocumentRepositoryInterface $document_repository)
    {
        $this->documentRepository = $document_repository;
    }

    public function run(int $page, int $per_page) : array {
        return $this->documentRepository->getAll($page, $per_page);
    }
}