<?php
namespace Src\modules\profile\domain\repositories\documentType;
use Src\modules\profile\domain\entities\documentType\DocumentType;

interface DocumentTypeRepositoryInterface{
    public function create(DocumentType $address) : void;
    public function update(DocumentType $address) : void;
    /**
     * @return DocumentType[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(int $id): ?int;
    public function delete(int $id) : void;
}
