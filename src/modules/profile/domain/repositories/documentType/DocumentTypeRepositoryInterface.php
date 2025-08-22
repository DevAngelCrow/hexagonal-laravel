<?php
namespace Src\modules\profile\domain\repositories\documentType;
use Src\modules\profile\domain\entities\documentType\DocumentType;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;


interface DocumentTypeRepositoryInterface{
    public function create(DocumentType $address) : void;
    public function update(DocumentType $address) : void;
    /**
     * @return DocumentType[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(DocumentTypeId $id): ?DocumentType;
    public function delete(DocumentTypeId $id) : void;
}
