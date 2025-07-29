<?php
namespace Src\modules\profile\infrastructure\implementation\DocumentRepositoryImplementation;

use LogicException;
use Src\modules\profile\domain\entities\documents\Document;
use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\DocumentId;

class ImplDocumentRepository implements DocumentRepositoryInterface {
    public function create(Document $document): void
    {
        throw new LogicException("Método no implementado");
    }
    public function update(Document $document): void
    {
        throw new LogicException("Método no implementado");
    }
    public function getOneById(DocumentId $id): ?Document
    {
        throw new LogicException("Método no implementado");
    }
    public function getAll(int $page, int $per_page): array
    {
        throw new LogicException("Método no implementado");
    }
    public function delete(DocumentId $id): void
    {
        throw new LogicException("Método no implementado");
    }
}