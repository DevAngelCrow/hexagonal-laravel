<?php

namespace Src\modules\profile\domain\entities\documentType;

use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeActive;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeName;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeDescription;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeMask;

class DocumentType
{
    private readonly ?DocumentTypeId $id;
    private readonly DocumentTypeName $name;
    private readonly DocumentTypeDescription $description;
    private readonly DocumentTypeActive $active;
    private readonly ?DocumentTypeMask $mask;

    public function __construct(
        DocumentTypeName $name,
        DocumentTypeDescription $description,
        DocumentTypeActive $active,
        ?DocumentTypeMask $mask = null,
        ?DocumentTypeId $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
        $this->mask = $mask;
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
    public function getMask(): ?DocumentTypeMask {
        return $this->mask;
    }
}
