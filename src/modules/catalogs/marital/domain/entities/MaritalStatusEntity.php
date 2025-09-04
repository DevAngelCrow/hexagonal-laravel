<?php

namespace Src\modules\catalogs\marital\domain\entities;

use Src\modules\catalogs\marital\domain\value_objects\MaritalStatusCaption;
use Src\modules\catalogs\marital\domain\value_objects\MaritalStatusId;
use Src\modules\catalogs\marital\domain\value_objects\MaritalStatusName;

class MaritalStatusEntity
{
    private ?MaritalStatusId $id;
    private MaritalStatusName $name;
    private ?MaritalStatusCaption $description;

    private function __construct(?MaritalStatusId $id, MaritalStatusName $name, MaritalStatusCaption $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }


    // Factory method for creating a new MaritalStatusEntity
    public static function create(
        string $name,
        ?string $description,
    ): self {
        return new self(
            id: null,
            name: new MaritalStatusName($name),
            description: new MaritalStatusCaption($description)
        );
    }

    // Factory method for reconstituting an existing MaritalStatusEntity
    public static function reconstitute(
        int $id,
        string $name,
        ?string $description
    ): self {
        return new self(
            id: new MaritalStatusId($id),
            name: new MaritalStatusName($name),
            description: new MaritalStatusCaption($description)
        );
    }

    public function getId(): MaritalStatusId
    {
        return $this->id;
    }

    public function getName(): MaritalStatusName
    {
        return $this->name;
    }

    public function getDescription(): MaritalStatusCaption
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id?->value(),
            'name' => $this->name->value(),
            'description' => $this->description?->value()
        ];
    }
}
