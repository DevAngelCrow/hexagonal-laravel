<?php

namespace Src\modules\profile\domain\entities\documents;

use Src\modules\profile\domain\value_objects\address_value_object\DocumentId;
use Src\modules\profile\domain\value_objects\address_value_object\DocumentIdPeople;
use Src\modules\profile\domain\value_objects\address_value_object\DocumentIdTypeDocument;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentDescription;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentState;

class Document
{
    private readonly DocumentDescription $description;
    private readonly DocumentIdPeople $id_people;
    private readonly DocumentIdTypeDocument $id_type_document;
    private readonly DocumentState $state;
    private readonly DocumentId $id;

    public function __construct(
        DocumentDescription $description,
        DocumentIdPeople $id_people,
        DocumentIdTypeDocument $id_type_document,
        DocumentState $state,
        ?DocumentId $id = null,
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->id_people = $id_people;
        $this->id_type_document = $id_type_document;
        $this->state = $state;
    }

    public function getDescription(): DocumentDescription
    {
        return $this->description;
    }

    public function getIdPeople(): DocumentIdPeople
    {
        return $this->id_people;
    }

    public function getIdTypeDocument(): DocumentIdTypeDocument
    {
        return $this->id_type_document;
    }

    public function getState(): DocumentState
    {
        return $this->state;
    }

    public function getId(): ?DocumentId
    {
        return $this->id;
    }
}
