<?php
namespace Src\modules\profile\application\useCases\documentType;

use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;

class DocumentTypeGetAll {
    private readonly DocumentTypeRepositoryInterface $documentTypeRepository;

    public function __construct(DocumentTypeRepositoryInterface $documentType_repository)
    {
        $this->documentTypeRepository = $documentType_repository;
    }

    public function run(?int $page, ?int $per_page) : array {

        return $this->documentTypeRepository->getAll($page, $per_page);

    }
}
