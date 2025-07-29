<?php
namespace Src\modules\profile\domain\repositories\documents;

use Src\modules\profile\domain\entities\documents\Document;
use Src\modules\profile\domain\value_objects\address_value_object\DocumentId;

interface DocumentRepositoryInterface {
    public function create(Document $document) : void;
    public function update(Document $document) : void;
    /**
     * @return Address[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(DocumentId $id): ?Document;
    public function delete(DocumentId $id) : void;
}