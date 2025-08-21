<?php

namespace Src\modules\profile\domain\entities\documentType;

use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeActive;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeName;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeDescription;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;



class DocumentType
{
    private readonly ?DocumentTypeId $id;
    private readonly DocumentTypeName $name;
    private readonly DocumentTypeDescription $description;
    private readonly DocumentTypeActive $active;

    public function __construct(
        DocumentTypeName $name,
        DocumentTypeDescription $description,
        DocumentTypeActive $active,
        ?DocumentTypeId $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
    }

    public function getId(): ?DocumentTypeId
    {
        return $this->id;
    }

    public function getName(): DocumentTypeName
    {
        return $this->name;
    }

    public function getDescription(): DocumentTypeDescription
    {
        return $this->description;
    }

    public function getActive(): DocumentTypeActive
    {
        return $this->active;
    }
}
